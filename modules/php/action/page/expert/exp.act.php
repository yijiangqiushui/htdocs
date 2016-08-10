<?php
/**
*author:贺央央
**/
include '../../class/expert/exp.cls.php';
include '../../../../../common/php/lib/file.cls.php';
include '../../../../../common/php/config.ini.php';
include '../../../config.ini.php';
include '../../../../../common/php/lib/db.cls.php';

$action=$_GET['action'];
$id=$_GET['id'];
$idlist=$_GET['idlist'];
$tid=intval($_GET['tid']);

$page=$_POST['page'];
$rows=$_POST['rows'];

$expAct=new ExpAct();
switch($action){
	
	case 'add':
		$exp['name']=$_POST['name'];
		$exp['sex']=$_POST['sex'];
		$exp['birth']=$_POST['birth'];
		$exp['age']=intval($_POST['age']);
		$exp['tel']=$_POST['tel'];
		$exp['email']=$_POST['email'];
		$exp['degree']=$_POST['degree'];
		$exp['office']=$_POST['office'];
		$exp['work']=$_POST['work'];
		$exp['research']=$_POST['research'];
		addExpert($exp);
		break;
	case 'query':
		$exp['name']=$_POST['name'];
		$exp['degree']=$_POST['degree'];
		queryExpert($exp);
		break;
	case 'update';
		$exp['name']=$_POST['name'];
		$exp['sex']=$_POST['sex'];
		$exp['birth']=$_POST['birth'];
		$exp['age']=intval($_POST['age']);
		$exp['tel']=$_POST['tel'];
		$exp['email']=$_POST['email'];
		$exp['degree']=$_POST['degree'];
		$exp['office']=$_POST['office'];
		$exp['work']=$_POST['work'];
		$exp['research']=$_POST['research'];
		updateExpert($exp,$id);
		break;
	case 'delete';
		deleteExpert($id,$expAct);
		break;
	case 'deletelist';
		deleteExpertList();
		break;
	case 'findbyid';
		findById($id);
		break;
	//------------------------教育经历-----------------------------
	case 'queryEdu':
		queryEdu($tid);
		break;
	case 'addEdu':
		$edu['school']=$_POST['school'];
		$edu['stage']=$_POST['stage'];
		$edu['starttime']=$_POST['starttime'];
		$edu['endtime']=$_POST['endtime'];
		addEdu($tid,$edu);
		break;
	case 'delEdu':
		delEdu($id);
		break;
	case 'findEduById':
		findEduById($id);
		break;
	case 'updateEdu':
		$edu['school']=$_POST['school'];
		$edu['stage']=$_POST['stage'];
		$edu['starttime']=$_POST['starttime'];
		$edu['endtime']=$_POST['endtime'];
		updateEdu($id,$edu,$tid);
		break;
	//--------------------获得荣誉--------------------------------
	case 'queryHor':
		queryHor($tid);
		break;
	case 'addHor':
		$hor['descrip']=$_POST['descrip'];
		$hor['overview']=$_POST['overview'];
		addHor($tid,$hor);
		break;
	case 'delHor':
		delHor($id);
		break;
	case 'findHorById':
		findHorById($id);
		break;
	case 'updateHor':
		$hor['descrip']=$_POST['descrip'];
		$hor['overview']=$_POST['overview'];
		updateHor($id,$hor,$tid);
		break;
		
	//------------------------指导竞赛情况-----------------------------
	case 'queryCom':
		queryCom($tid);
		break;
	case 'addCom':
		$com['name']=$_POST['name'];
		$com['address']=$_POST['address'];
		$com['time']=$_POST['time'];
		$com['result']=$_POST['result'];
		addCom($tid,$com);
		break;
	case 'delCom':
		delCom($id);
		break;
	case 'findComById':
		findComById($id);
		break;
	case 'updateCom':
		$com['name']=$_POST['name'];
		$com['address']=$_POST['address'];
		$com['time']=$_POST['time'];
		$com['result']=$_POST['result'];
		updateCom($id,$com,$tid);
		break;		
	default:;
}

/**
*根据id获取信息
**/
function findById($id){
	global $expAct;
	$exp=$expAct->findById('expert',$id);	
	$res=$expAct->toJson2($exp);
	
	echo $res;
}

/**
*分页显示专家信息
**/
function queryExpert($exp){
		
	global $page;
	global $rows;		
	global $expAct; 

		
	$sql='select * from expert where 1=1';	
	$sql_cou='select count(id) as "count" from expert where 1=1';
		
	if($exp['name']!==null&&$exp['name']!==''){
		$str='"%'.$exp['name'].'%"';
		$sql=$sql.' and name like '.$str;
		$sql_cou=$sql_cou.' and name like '.$str;
	}
	
	if($exp['degree']!==null&&$exp['degree']!==''){
		$str2='"%'.$exp['degree'].'%"';
		$sql=$sql.' and degree like '.$str2;
		$sql_cou=$sql_cou.' and degree like '.$str2;
	}
		
	$count=$expAct->getCount($sql_cou);
	$arr=$expAct->pageList($sql,$page,$rows,$count);
	$json=$expAct->toJson($arr,$count);

	echo $json;
	
}

//添加
function addExpert($exp){
	
	global $expAct;
	if($exp['birth']!==''){	
		$y=date('Y',time());
		$exp['age']=$y-substr($exp['birth'],0,4);
	}

	$expAct->addInfo('expert',$exp);
}

//删除
function deleteExpert($id,$expAct){

	$expAct->delByCon('exp_educate',$id);
	$expAct->delByCon('exp_compet',$id);
	
	$sql='select * from exp_honor where exp_id = '.$id;
	$arr=$expAct->getBySql($sql);
	
	$file=new FILE();
	
	for($i=0;$i<count($arr);$i++){
		if(!($arr[$i]['autoname']===null||$arr[$i]['autoname']==='')){
			$path=SP_BASEPATH.$arr[$i]['savepath'].$arr[$i]['autoname'];
			$file->del_file($path);
		}
		$expAct->delInfo('exp_honor',$arr[$i]['id']);
	}
	

	$expAct->delInfo('expert',$id);
}

//批量删除
function deleteExpertList(){
	
	global $idlist;
	global $expAct;
	$idarray=explode(',',$idlist);
	for($i=0;$i<count($idarray);$i++){
		deleteExpert($idarray[$i],$expAct);
	}
		
}

//修改
function updateExpert($exp,$id){
	
	global $expAct;
	
	if($exp['birth']!==''){
		$y=date('Y',time());
		$exp['age']=$y-substr($exp['birth'],0,4);
	}
	$expAct->editInfo('expert',$id,$exp);	
}

//------------------------------------教育经历----------------------------------------------
function queryEdu($tid){
	global $page;
	global $rows;
	global $expAct;
	
	$sql='select * from exp_educate where exp_id='.$tid;
	$sql_cou='select count(id) as "count" from exp_educate where exp_id='.$tid;

	$cou=$expAct->getCount($sql_cou);
	$eduarr=$expAct->pageList($sql,$page,$rows,$cou);
	
	$json=$expAct->toJson_edu($eduarr,$cou);
	echo $json;
	
}

function addEdu($tid,$edu){
	global $expAct;
	$edu['exp_id']=$tid;
	$expAct->addInfo('exp_educate',$edu);
}

function delEdu($id){
	global $expAct;
	$expAct->delInfo('exp_educate',$id);	
}

function findEduById($id){
	global $expAct;
	$edu=$expAct->findById('exp_educate',$id);
	$json=$expAct->toJson2_edu($edu);
	echo $json;
}

function updateEdu($id,$edu,$tid){
	global $expAct;
	$edu['exp_id']=$tid;
	$expAct->editInfo('exp_educate',$id,$edu);
	
}

//-------------------------------------获得荣誉--------------------------------

function queryHor($tid){
	global $page;
	global $rows;
	global $expAct;
	
	$sql='select * from exp_honor where exp_id='.$tid;
	$sql_cou='select count(id) as "count" from exp_honor where exp_id='.$tid;

	$cou=$expAct->getCount($sql_cou);
	$arr=$expAct->pageList($sql,$page,$rows,$cou);
	
	$json=$expAct->toJson_hor($arr,$cou);
	echo $json;
	
}

function addHor($tid,$hor){
	global $expAct;
	$hor['exp_id']=$tid;
	
	
	if(!(empty($_FILES))){
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
	
		$hor['autoname']=$file->get_auto_filename();
		$hor['attname']=$file->get_filename();
		$hor['savepath']=$file->get_savepath();

	}
	
	$expAct->addInfo('exp_honor',$hor);

}

function delHor($id){
	global $expAct;
	
	$hor=$expAct->findById('exp_honor',$id);
		
	if(!($hor['attname']===''||$hor['attname']===null)){
		$path=SP_BASEPATH.$hor['savepath'].$hor['autoname'];
		$file=new FILE();
		$file->del_file($path);
	}	
	
	$expAct->delInfo('exp_honor',$id);	
}

function findHorById($id){
	global $expAct;
	$hor=$expAct->findById('exp_honor',$id);
	$json=$expAct->toJson2_hor($hor);
	echo $json;
}

function updateHor($id,$hor,$tid){
	global $expAct;
	$hor['exp_id']=$tid;
	
	
	
	if(!(empty($_FILES))){
		$old_hor=$expAct->findById('exp_honor',$id);
		$old_path=SP_BASEPATH.$old_hor['savepath'].$old_hor['autoname'];//获取旧文件存储路径
	
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

		$hor['autoname']=$file->get_auto_filename();
		$hor['attname']=$file->get_filename();
		$hor['savepath']=$file->get_savepath();
	
	}

	$expAct->editInfo('exp_honor',$id,$hor);
	
}

//------------------------------------指导竞赛情况----------------------------------------------
function queryCom($tid){
	global $page;
	global $rows;
	global $expAct;
	
	$sql='select * from exp_compet where exp_id='.$tid;
	$sql_cou='select count(id) as "count" from exp_compet where exp_id='.$tid;

	$cou=$expAct->getCount($sql_cou);
	$eduarr=$expAct->pageList($sql,$page,$rows,$cou);
	
	$json=$expAct->toJson_com($eduarr,$cou);
	echo $json;
	
}

function addCom($tid,$com){
	global $expAct;
	$com['exp_id']=$tid;
	$expAct->addInfo('exp_compet',$com);
}

function delCom($id){
	global $expAct;
	$expAct->delInfo('exp_compet',$id);	
}

function findComById($id){
	global $expAct;
	$com=$expAct->findById('exp_compet',$id);
	$json=$expAct->toJson2_com($com);
	echo $json;
}

function updateCom($id,$com,$tid){
	global $expAct;
	$com['exp_id']=$tid;
	$expAct->editInfo('exp_compet',$id,$com);
	
}
?>