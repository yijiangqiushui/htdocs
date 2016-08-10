<?php
/**
*author:贺央央
**/
include '../../../../../common/php/config.ini.php';
include '../../../config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/student/stu.cls.php';
include '../../../../../common/php/lib/file.cls.php';


$action=$_GET['action'];

$id=$_GET['id'];
$idlist=$_GET['idlist'];
$sid=intval($_GET['stuid']);

$page=$_POST['page'];
$rows=$_POST['rows'];

$stuAct=new StuAct();

switch($action){
	case 'add'://添加学生信息
	
		$stu['number']=$_POST['number'];
		$stu['name']=$_POST['name'];
		$stu['sex']=$_POST['sex'];
		$stu['birthday']=$_POST['birthday'];
		$stu['age']=intval($_POST['age']);
		$stu['tel']=$_POST['tel'];
		$stu['email']=$_POST['email'];
		$stu['qq']=$_POST['qq'];
		
		addStudent($stu);
		break;
	case 'query'://查询学生信息
		$stu['number']=$_POST['number'];
		$stu['name']=$_POST['name'];
		queryStudent($stu);
		break;
	case 'update';//修改学生信息
	
		$stu['number']=$_POST['number'];
		$stu['name']=$_POST['name'];
		$stu['sex']=$_POST['sex'];
		$stu['birthday']=$_POST['birthday'];
		$stu['age']=intval($_POST['age']);
		$stu['tel']=$_POST['tel'];
		$stu['email']=$_POST['email'];
		$stu['qq']=$_POST['qq'];
		
		updateStudent($stu,$id);
		break;
	case 'delete';//删除学生信息
		deleteStudent($id,$stuAct);
		break;
	case 'deletelist';//批量删除学生信息
		deleteStudentList();
		break;
	case 'findbyid';//根据id查询学生信息
		findById($id);
		break;
		
	//----------------------------------家长信息----------------------------------
	case 'queryPar'://查询家长信息
		queryPar($sid);
		break;
	case 'addPar'://添加家长信息
	
		$par['name']=$_POST['name'];
		$par['address']=$_POST['address'];
		$par['tel']=$_POST['tel'];
		$par['app']=$_POST['app'];
		
		addPar($sid,$par);
		break;
		
	case 'findParById'://根据id查找家长信息
		findParById($id);
		break;
	case 'edtPar'://修改家长信息
	
		$par['name']=$_POST['name'];
		$par['address']=$_POST['address'];
		$par['tel']=$_POST['tel'];
		$par['app']=$_POST['app'];
	
		edtPar($id,$sid,$par);
		break;
	case 'delPar'://删除家长信息
		delPar($id);
		break;
	//--------------------------------------教育经历----------------------------------------	
	case 'queryEdu'://查询教育经历
		queryEdu($sid);
		break;
	case 'addEdu'://添加教育经历
	
		$edu['school']=$_POST['school'];
		$edu['stage']=$_POST['stage'];
		$edu['begindate']=$_POST['begindate'];
		$edu['enddate']=$_POST['enddate'];
		
		addEdu($sid,$edu);
		break;
		
	case 'findEduById'://根据id查找
		findEduById($id);
		break;
	case 'edtEdu'://修改教育经历
	
		$edu['school']=$_POST['school'];
		$edu['stage']=$_POST['stage'];
		$edu['begindate']=$_POST['begindate'];
		$edu['enddate']=$_POST['enddate'];
	
		edtEdu($id,$sid,$edu);
		break;
	case 'delEdu'://删除教育经历
		delEdu($id);
		break;		
		
	//------------------------------------------------参加活动--------------------------------------
	case 'queryAct':
		queryAct($sid);
		break;
	case 'addAct':
	
		$act['name']=$_POST['name'];
		$act['address']=$_POST['address'];
		$act['time']=$_POST['time'];
		$act['content']=$_POST['content'];
		
		addAct($sid,$act);
		break;
		
	case 'findActById':
		findActById($id);
		break;
	case 'edtAct':
	
		$act['name']=$_POST['name'];
		$act['address']=$_POST['address'];
		$act['time']=$_POST['time'];
		$act['content']=$_POST['content'];
	
		edtAct($id,$sid,$act);
		break;
	case 'delAct':
		delAct($id);
		break;
	//------------------------------------------学生作品---------------------------------------
	case 'queryPro':
		queryPro($sid);
		break;
	case 'addPro':
	
		$pro['title']=$_POST['title'];
		$pro['descrip']=$_POST['descrip'];
		$pro['tea_id']=intval($_POST['tea_id']);
		
		addPro($sid,$pro);
		break;
		
	case 'findProById':
		findProById($id);
		break;
	case 'edtPro':
	
		$pro['title']=$_POST['title'];
		$pro['descrip']=$_POST['descrip'];
		$pro['tea_id']=intval($_POST['tea_id']);
	
		edtPro($id,$sid,$pro);
		break;
	case 'delPro':
		delPro($id);
		break;
	case 'getTeaCombo':
		getTeaCombo();
		break;		
	//------------------------------------获得奖励----------------------------------
	case 'queryAwd':
		queryAwd($sid);
		break;
	case 'addAwd':
	
		$awd['act']=$_POST['act'];
		$awd['rank']=$_POST['rank'];
		$awd['time']=$_POST['time'];
		$awd['descrip']=$_POST['descrip'];
		
		addAwd($sid,$awd);
		break;
		
	case 'findAwdById':
		findAwdById($id);
		break;
	case 'edtAwd':
	
		$awd['act']=$_POST['act'];
		$awd['rank']=$_POST['rank'];
		$awd['time']=$_POST['time'];
		$awd['descrip']=$_POST['descrip'];
	
		edtAwd($id,$sid,$awd);
		break;
	case 'delAwd':
		delAwd($id);
		break;		
	default:;
}

//-----------------------------------------------学生信息-----------------------------------------------------
function findById($id){
	global $stuAct;
	
	$stu=$stuAct->findById('student',$id);	
	$res=$stuAct->toJson2($stu);
	
	echo $res;
}

function queryStudent($stu){
	
	global $page;
	global $rows;	
	global $stuAct;

	
	if(($stu['name']===null||$stu['name']==='')&&($stu['number']===null||$stu['number']==='')){
		//分页查询
		$count=$stuAct->getCount('student');
		$stuArr=$stuAct->pageList('student',$page,$rows,$count);
		$stuJson=$stuAct->toJson($stuArr,$count);
	}else{
		//条件查询
		$sql='select * from student where 1=1';
		$sql_cou='select count(id) as "count" from student where 1=1';	
	
		if($stu['name']!==null&&$stu['name']!==''){
			$str='"%'.$stu['name'].'%"';
			$sql=$sql.' and name like '.$str;
			$sql_cou=$sql_cou.' and name like '.$str;
		}
	
		if($stu['number']!==null&&$stu['number']!==''){
			$str2='"%'.$stu['number'].'%"';
			$sql=$sql.' and number like '.$str2;
			$sql_cou=$sql_cou.' and number like '.$str2;
		}
		
		$count=$stuAct->getCountByCon($sql_cou);
		$stuArr=$stuAct->pageListByCon($page,$rows,$count,$sql);
		$stuJson=$stuAct->toJson($stuArr,$count);
	}
	echo $stuJson;
}

function addStudent($stu){
	global $stuAct;	
	if($stu['birthday']!==null&&$stu['birthday']!==''){
	
		$y=date('Y',time());
		$stu['age']=$y-substr($stu['birthday'],0,4);
	}	
	$stuAct->addInfo('student',$stu);
}

function deleteStudent($id,$stuAct){
	
	$stuAct->delByStuid('stu_educate','stu_id',$id);
	$stuAct->delByStuid('parent','stuid',$id);
	$stuAct->delByStuid('activity','stuid',$id);
	
	$file=new FILE();
	
	$proarr=$stuAct->getAllByStuid('stu_product','stu_id',$id);
	for($i=0;$i<count($proarr);$i++){
		if(!($proarr[$i]['autoname']===null||$proarr[$i]['autoname']==='')){
			$path=SP_BASEPATH.$proarr[$i]['savepath'].$proarr[$i]['autoname'];
			$file->del_file($path);
		}
		$stuAct->delInfo('stu_product',$proarr[$i]['id']);
	}
	
	$awdarr=$stuAct->getAllByStuid('stu_award','stu_id',$id);
	for($i=0;$i<count($awdarr);$i++){
		if(!($awdarr[$i]['autoname']===null||$awdarr[$i]['autoname']==='')){
			$path=SP_BASEPATH.$awdarr[$i]['savepath'].$awdarr[$i]['autoname'];
			$file->del_file($path);
		}
		$stuAct->delInfo('stu_award',$awdarr[$i]['id']);
	}

	$stuAct->delInfo('student',$id);
}

function deleteStudentList(){
	global $stuAct;
	global $idlist;
	$file=new FILE();

	$idarray=explode(',',$idlist);
	for($i=0;$i<count($idarray);$i++){
		deleteStudent($idarray[$i],$stuAct);
		
			$stuAct->delInfo('student',$idarray[$i]);	
		}
		
}

function updateStudent($stu,$id){
	global $stuAct;

	if($stu['birthday']!==null){
		$y=date('Y',time());
		$stu['age']=$y-substr($stu['birthday'],0,4);
	}

	$stuAct->editInfo('student',$stu,$id);
	
}

//----------------------------------家长信息----------------------------------------------

function queryPar($sid){
	global $stuAct;
	global $page;
	global $rows;
	$sql_cou='select count(id) as count from parent where stuid='.$sid;
	$sql='select * from parent where stuid='.$sid;
	$cou=$stuAct->getCountByCon($sql_cou);
	$par=$stuAct->pageListByCon($page,$rows,$cou,$sql);
	$json=$stuAct->toJson_par($par,$cou);
	echo $json;
		
}

function addPar($sid,$par){
	$par['stuid']=$sid;
	
	global $stuAct;
	$stuAct->addInfo('parent',$par);	
}

function findParById($id){
	global $stuAct;
	$par=$stuAct->findById('parent',$id);
	$json=$stuAct->toJson2_par($par);
	echo $json;
}

function edtPar($id,$sid,$par){
	global $stuAct;
	$par['stuid']=$sid;
	$stuAct->editInfo('parent',$par,$id);
}

function delPar($id){
	global $stuAct;
	$stuAct->delInfo('parent',$id);	
}

//----------------------------教育经历-----------------------------------------
function queryEdu($sid){
	global $stuAct;
	global $page;
	global $rows;
	$sql_cou='select count(id) as count from stu_educate where stu_id='.$sid;
	$sql='select * from stu_educate where stu_id='.$sid;
	$cou=$stuAct->getCountByCon($sql_cou);
	$edu=$stuAct->pageListByCon($page,$rows,$cou,$sql);
	$json=$stuAct->toJson_edu($edu,$cou);
	echo $json;
		
}

function addEdu($sid,$edu){
	$edu['stu_id']=$sid;
	
	global $stuAct;
	$stuAct->addInfo('stu_educate',$edu);	
}

function findEduById($id){
	global $stuAct;
	$edu=$stuAct->findById('stu_educate',$id);
	$json=$stuAct->toJson2_edu($edu);
	echo $json;
}

function edtEdu($id,$sid,$edu){
	global $stuAct;
	$edu['stu_id']=$sid;
	$stuAct->editInfo('stu_educate',$edu,$id);
}

function delEdu($id){
	global $stuAct;
	$stuAct->delInfo('stu_educate',$id);	
}

//----------------------------参加活动-----------------------------------------
function queryAct($sid){
	global $stuAct;
	global $page;
	global $rows;
	$sql_cou='select count(id) as count from activity where stuid='.$sid;
	$sql='select * from activity where stuid='.$sid;
	$cou=$stuAct->getCountByCon($sql_cou);
	$act=$stuAct->pageListByCon($page,$rows,$cou,$sql);
	$json=$stuAct->toJson_act($act,$cou);
	echo $json;
		
}

function addAct($sid,$act){
	$act['stuid']=$sid;
	
	global $stuAct;
	$stuAct->addInfo('activity',$act);	
}

function findActById($id){
	global $stuAct;
	$act=$stuAct->findById('activity',$id);
	$json=$stuAct->toJson2_act($act);
	echo $json;
}

function edtAct($id,$sid,$act){
	global $stuAct;
	$act['stuid']=$sid;
	$stuAct->editInfo('activity',$act,$id);
}

function delAct($id){
	global $stuAct;
	$stuAct->delInfo('activity',$id);	
}

//----------------------------学生作品-----------------------------------------
function queryPro($sid){
	global $stuAct;
	global $page;
	global $rows;
	$sql_cou='select count(id) as count from stu_product where stu_id='.$sid;
	$sql='select * from stu_product where stu_id='.$sid;
	$cou=$stuAct->getCountByCon($sql_cou);
	$pro=$stuAct->pageListByCon($page,$rows,$cou,$sql);
	$json=$stuAct->toJson_pro($pro,$cou);
	echo $json;
		
}

function addPro($sid,$pro){	
	global $stuAct;
	
	$pro['stu_id']=$sid;
	
	if($_FILES['file']['error']==0){
		$time=time();
		$y=date('Y',$time);
		$m=date('m',$time);
		$d=date('d',$time);
			
		$rootpath=SP_BASEPATH;
			
		$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';		
		
		$vars=array(
			'file'=>'file',
			'limit_size'=>50*1024*1024,
			'savepath'=>$savepath,
			'rootpath'=>$rootpath,
			//'old_file'=>$path,
			'allowed_ext'=>''
		);
	
	
		$file=new FILE($vars);
	
		$pro['autoname']=$file->get_auto_filename();
		$pro['filename']=$file->get_filename();
		$pro['savepath']=$file->get_savepath();

	}
	$stuAct->addInfo('stu_product',$pro);
		
}

function findProById($id){
	global $stuAct;
	$pro=$stuAct->findById('stu_product',$id);
	$json=$stuAct->toJson2_pro($pro);
	echo $json;
}

function edtPro($id,$sid,$pro){
	global $stuAct;
	
	if($_FILES['file']['error']==0){
		$old_pro=$stuAct->findById('stu_product',$id);
		$old_path=SP_BASEPATH.$old_pro['savepath'].$old_pro['autoname'];//获取旧文件存储路径
	
		$time=time();
		$y=date('Y',$time);
		$m=date('m',$time);
		$d=date('d',$time);
		
		$rootpath=SP_BASEPATH;
		
		$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';//获取新文件存储路径		
	
		$vars=array(
			'file'=>'file',
			'limit_size'=>50*1024*1024,
			'savepath'=>$savepath,
			'rootpath'=>$rootpath,
			'old_file'=>$old_path,
			'allowed_ext'=>''
		);


		$file=new FILE($vars);

		$pro['autoname']=$file->get_auto_filename();
		$pro['filename']=$file->get_filename();
		$pro['savepath']=$file->get_savepath();
	
	}
	
	$pro['stu_id']=$sid;

	$stuAct->editInfo('stu_product',$pro,$id);
}

function delPro($id){
	global $stuAct;
	
	$pro=$stuAct->findById('stu_product',$id);
		
	if(!($pro['filename']===''||$pro['filename']===null)){
		$path=SP_BASEPATH.$pro['savepath'].$pro['autoname'];
		$file=new FILE();
		$file->del_file($path);
	}
	$stuAct->delInfo('stu_product',$id);	
}

function getTeaCombo(){
	global $stuAct;;
	$tea=$stuAct->getTea();
	$json=json_encode($tea);
	echo $json;	
}


//----------------------------获得奖励-----------------------------------------
function queryAwd($sid){
	global $stuAct;
	global $page;
	global $rows;
	$sql_cou='select count(id) as count from stu_award where stu_id='.$sid;
	$sql='select * from stu_award where stu_id='.$sid;
	$cou=$stuAct->getCountByCon($sql_cou);
	$awd=$stuAct->pageListByCon($page,$rows,$cou,$sql);
	$json=$stuAct->toJson_awd($awd,$cou);
	echo $json;
		
}

function addAwd($sid,$awd){
	$awd['stu_id']=$sid;
	
	global $stuAct;

	if($_FILES['file']['error']==0){
		$time=time();
		$y=date('Y',$time);
		$m=date('m',$time);
		$d=date('d',$time);
			
		$rootpath=SP_BASEPATH;
			
		$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';		
		
		$vars=array(
			'file'=>'file',
			'limit_size'=>50*1024*1024,
			'savepath'=>$savepath,
			'rootpath'=>$rootpath,
			//'old_file'=>$path,
			'allowed_ext'=>''
		);
	
	
		$file=new FILE($vars);
	
		$awd['autoname']=$file->get_auto_filename();
		$awd['attname']=$file->get_filename();
		$awd['savepath']=$file->get_savepath();

	}
	
	$stuAct->addInfo('stu_award',$awd);	
}

function findAwdById($id){
	global $stuAct;
	$awd=$stuAct->findById('stu_award',$id);
	$json=$stuAct->toJson2_awd($awd);
	echo $json;
}

function edtAwd($id,$sid,$awd){
	global $stuAct;
	$awd['stu_id']=$sid;
	
	if($_FILES['file']['error']==0){
		$old_awd=$stuAct->findById('stu_award',$id);
		$old_path=SP_BASEPATH.$old_awd['savepath'].$old_awd['autoname'];//获取旧文件存储路径
	
		$time=time();
		$y=date('Y',$time);
		$m=date('m',$time);
		$d=date('d',$time);
		
		$rootpath=SP_BASEPATH;
		
		$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';//获取新文件存储路径		
	
		$vars=array(
			'file'=>'file',
			'limit_size'=>50*1024*1024,
			'savepath'=>$savepath,
			'rootpath'=>$rootpath,
			'old_file'=>$old_path,
			'allowed_ext'=>''
		);


		$file=new FILE($vars);

		$awd['autoname']=$file->get_auto_filename();
		$awd['attname']=$file->get_filename();
		$awd['savepath']=$file->get_savepath();
	
	}
	
	
	$stuAct->editInfo('stu_award',$awd,$id);
}

function delAwd($id){
	global $stuAct;
	
	
	$awd=$stuAct->findById('stu_award',$id);
		
	if(!($awd['attname']===''||$awd['attname']===null)){
		$path=SP_BASEPATH.$awd['savepath'].$awd['autoname'];
		$file=new FILE();
		$file->del_file($path);
	}
	
	$stuAct->delInfo('stu_award',$id);	
}
?>