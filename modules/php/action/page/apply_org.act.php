<?php

/**
*author:heyangyang
**/

include '../../../../common/php/config.ini.php';
include '../../config.ini.php';
include '../class/apply_org.cls.php';
include '../../../../common/php/lib/file.cls.php';
include '../../../../common/php/lib/user.cls.php';

$action=$_GET['action'];
$page=$_POST['page'];
$rows=$_POST['rows'];
$id=$_GET['id'];

//$id=$_SESSION['org_id'];
$idlist=$_GET['idlist'];

$apporg['orgCode']=$_POST['orgCode'];
$apporg['orgName']=$_POST['orgName'];
$apporg['pwd']=$_POST['pwd'];
$apporg['legalPerson']=$_POST['legalPerson'];
$apporg['contact']=$_POST['contact'];
$apporg['telphone']=$_POST['telphone'];
$apporg['address']=$_POST['address'];
$apporg['phone']=$_POST['phone'];
$apporg['email']=$_POST['email'];
$pwd=$_POST['password'];

$apporg1['orgCode']=$_POST['orgCode'];
$apporg1['orgName']=$_POST['orgName'];
$apporg1['pwd']=$_SESSION['pwd'];
$apporg1['legalPerson']=$_POST['legalPerson'];
$apporg1['contact']=$_POST['contact'];
$apporg1['telphone']=$_POST['telphone'];
$apporg1['address']=$_POST['address'];
$apporg1['phone']=$_POST['phone'];
$apporg1['email']=$_POST['email'];

$apporgAct=new ApplyOrg();
$file=new FILE();

switch($action){
	case 'show':
		show($apporg,$page,$rows,$apporgAct);
		break;
	case 'showinfo':
		showinfo();
		break;
	case 'getpwd':
		$pwd=$_POST['pwd'];
		getpwd($pwd);
		break;
	case 'savepwd':
		savepwd($pwd);
		break;
	case 'delete':
		delById($apporgAct,$id,$file);
		break;
	case 'deletelist':
		delByIdList($apporgAct,$idlist,$file);
		break;
	case 'findById':
		findById($apporgAct,$id);
		break;
	case 'update':
		updateById($apporgAct,$id,$apporg1);
		break;
	case 'change_checked':
		$apporgAct->change_checked($_POST['flag'],$_POST['id']);
		break;
	default:;
	
}

function showinfo(){
	$id=$_SESSION['org_id'];//从session中获取
	
	$act=new ApplyOrg();
	$obj=$act->findById('apply_org',$id);
	$sql='SELECT attname FROM attach_apply WHERE orgId='.$id;
	$arr=$act->findBySql($sql);
	$name1=$arr[0]['attname'];
	$name2=$arr[1]['attname'];
	$json='{id:'.$obj['id'].',orgCode:"'.$obj['orgCode'].'",orgName:"'.$obj['orgName'].'",legalPerson:"'.$obj['legalPerson'].'",contact:"'.$obj['contact'].'",phone:"'.$obj['phone'].'",telphone:"'.$obj['telphone'].'",email:"'.$obj['email'].'",address:"'.$obj['address'].'",name1:"'.$name1.'",name2:"'.$name2.'"}';
	echo $json;	
}

function getpwd($pwd){
	$user=new USER();
	$id=$_SESSION['org_id'];//从session中获取
	$act=new ApplyOrg();
	$sql='SELECT pwd FROM apply_org WHERE id='.$id;
	$arr=$act->findBySql($sql);	
	
	if($arr[0]['pwd']==$user->EncriptPWD($pwd)){
		echo  json_encode(array('retflag'=>'success'));
	}
	else{
		echo json_encode(array('retflag'=>'wrong'));
	}
	//echo $arr[0]['pwd'];
}
function savepwd($pwd){
	$user=new USER();
	$id=$_SESSION['org_id'];//从session中获取
	$act=new ApplyOrg();
	$sql='update apply_org set pwd="'.$user->EncriptPWD($pwd).'" WHERE id='.$id;
	$act->updateBySql($sql);
	echo $pwd;	
}

//分页查询
function show($apporg,$page,$rows,$apporgAct){
	
	if(($apporg['orgCode']===null||$apporg['orgCode']==='')&&($apporg['orgName']===null||$apporg['orgName']==='')){
		//分页查询
		$count=$apporgAct->getCount('apply_org');
		$arr=$apporgAct->pageList('apply_org',$page,$rows,$count);
		$json=$apporgAct->toJson($arr,$count);
	}else{
		//条件查询
		$sql='select * from apply_org where 1=1';
		$sql_cou='select count(id) as "count" from apply_org where 1=1';	
	
		if($apporg['orgCode']!==null&&$apporg['orgCode']!==''){
			$str='"%'.$apporg['orgCode'].'%"';
			$sql=$sql.' and orgCode like '.$str;
			$sql_cou=$sql_cou.' and orgCode like '.$str;
		}
	
		if($apporg['orgName']!==null&&$apporg['orgName']!==''){
			$str2='"%'.$apporg['orgName'].'%"';
			$sql=$sql.' and orgName like '.$str2;
			$sql_cou=$sql_cou.' and orgName like '.$str2;
		}
		
		$count=$apporgAct->getCountByCon($sql_cou);
		$arr=$apporgAct->pageListByCon($page,$rows,$count,$sql);
		$json=$apporgAct->toJson($arr,$count);	
	}

	echo $json;	
}

//删除
function delById($apporgAct,$id,$file){
	
	
	$sql='SELECT savepath,autoname FROM attach_apply WHERE orgId='.$id;
	
	$arr=$apporgAct->findBySql($sql);
	for($i=0;$i<count($arr);$i++){
		if(($arr[$i]['autoname']!==null)&&($arr[$i]['autoname']!=='')){
			$path=CUR_ROOTPATH.$arr[$i]['savepath'].$arr[$i]['autoname'];
			$file->del_file($path);
		}	
	}
	
	$sql='delete from attach_apply where orgId='.$id;
	
	$apporgAct->delBySql($sql);
	
	$apporgAct->delInfo('apply_org',$id);	
}

//批量删除
function delByIdList($apporgAct,$idlist,$file){
	$idarray=explode(',',$idlist);
	for($i=0;$i<count($idarray);$i++){
		delById($apporgAct,$idarray[$i],$file);
	}
}

//根据id查询
function findById($apporgAct,$id){
	if($id==0){
		$id=$_SESSION['org_id'];	
	}
	$org=$apporgAct->findById('apply_org',$id);
	$json=$apporgAct->toJson2($org);
	echo $json;	
}

//编辑
function updateById($apporgAct,$id,$apporg1){
	
	if($id==0){
		$id=$_SESSION['org_id'];//从session中获取	
	}
	
	$time=time();
	$y=date('Y',$time);
	$m=date('m',$time);
	$d=date('d',$time);
	$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';//获取新文件存储路径
	
	if($_FILES['file']['error']==0){
	
		$sql='SELECT id,savepath,autoname FROM attach_apply WHERE mark="税务登记证" and orgId='.$id;	
		$arr=$apporgAct->findBySql($sql);
		$old_path=CUR_ROOTPATH.$arr[0]['savepath'].$arr[0]['autoname'];//获取旧文件存储路径
	
		$vars=array(
			'file'=>'file',
			'limit_size'=>LIMIT_SIZE,
			'savepath'=>$savepath,
			'rootpath'=>CUR_ROOTPATH,
			'old_file'=>$old_path,
			'allowed_ext'=>''
		);
		
		$file=new FILE($vars);

		$att['autoname']=$file->get_auto_filename();
		$att['attname']=$file->get_filename();
		$att['savepath']=$file->get_savepath();
		$att['uptime']=date('Y-m-d',$time);
		
		$apporgAct->updateInfo('attach_apply',$att,$arr[0]['id']);
	
	}
	
	if($_FILES['file1']['error']==0){
	
		$sql1='SELECT id,savepath,autoname FROM attach_apply WHERE mark="工商营业执照" and orgId='.$id;	
		$arr1=$apporgAct->findBySql($sql1);
		$old_path1=CUR_ROOTPATH.$arr1[0]['savepath'].$arr1[0]['autoname'];//获取旧文件存储路径
	
		$vars1=array(
			'file'=>'file1',
			'limit_size'=>LIMIT_SIZE,
			'savepath'=>$savepath,
			'rootpath'=>CUR_ROOTPATH,
			'old_file'=>$old_path1,
			'allowed_ext'=>''
		);
		
		$file1=new FILE($vars1);

		$att1['autoname']=$file1->get_auto_filename();
		$att1['attname']=$file1->get_filename();
		$att1['savepath']=$file1->get_savepath();
		$att1['uptime']=date('Y-m-d',$time);
		
		$apporgAct->updateInfo('attach_apply',$att1,$arr1[0]['id']);
	
	}
	
	
	$apporgAct->updateInfo('apply_org',$apporg1,$id);
	findById($apporgAct,$id);	
}

?>