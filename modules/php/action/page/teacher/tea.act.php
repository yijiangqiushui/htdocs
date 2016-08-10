<?php
/**
*author:贺央央
**/
include '../../class/teacher/tea.cls.php';
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

$teaAct=new TeaAct();
switch($action){
	
	case 'add':
		$tea['name']=$_POST['name'];
		$tea['sex']=$_POST['sex'];
		$tea['birth']=$_POST['birth'];
		$tea['age']=intval($_POST['age']);
		$tea['tel']=$_POST['tel'];
		$tea['email']=$_POST['email'];
		$tea['degree']=$_POST['degree'];
		$tea['office']=$_POST['office'];
		$tea['work']=$_POST['work'];
		$tea['research']=$_POST['research'];
		addTeacher($tea);
		break;
	case 'query':
		$tea['name']=$_POST['name'];
		$tea['degree']=$_POST['degree'];
		queryTeacher($tea);
		break;
	case 'update':
		$tea['name']=$_POST['name'];
		$tea['sex']=$_POST['sex'];
		$tea['birth']=$_POST['birth'];
		$tea['age']=intval($_POST['age']);
		$tea['tel']=$_POST['tel'];
		$tea['email']=$_POST['email'];
		$tea['degree']=$_POST['degree'];
		$tea['office']=$_POST['office'];
		$tea['work']=$_POST['work'];
		$tea['research']=$_POST['research'];
		updateTeacher($tea,$id);
		break;
	case 'delete':
		deleteTeacher($id,$teaAct);
		break;
	case 'deletelist':
		deleteTeacherList();
		break;
	case 'findbyid':
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
	global $teaAct;
	$tea=$teaAct->findById('teacher',$id);	
	$res=$teaAct->toJson2($tea);
	
	echo $res;
}

/**
*分页显示教师信息
**/
function queryTeacher($tea){
	
	global $page;
	global $rows;		
	global $teaAct; 

		
	$sql='select * from teacher where 1=1';	
	$sql_cou='select count(id) as "count" from teacher where 1=1';
		
	if($tea['name']!==null&&$tea['name']!==''){
		$str='"%'.$tea['name'].'%"';
		$sql=$sql.' and name like '.$str;
		$sql_cou=$sql_cou.' and name like '.$str;
	}
	
	if($tea['degree']!==null&&$tea['degree']!==''){
		$str2='"%'.$tea['degree'].'%"';
		$sql=$sql.' and degree like '.$str2;
		$sql_cou=$sql_cou.' and degree like '.$str2;
	}
		
	$count=$teaAct->getCount($sql_cou);
	$teaArr=$teaAct->pageList($sql,$page,$rows,$count);
	$teaJson=$teaAct->toJson($teaArr,$count);

	echo $teaJson;
}

//添加
function addTeacher($tea){
	
	global $teaAct;
	if($tea['birth']!==''){	
		$y=date('Y',time());
		$tea['age']=$y-substr($tea['birth'],0,4);
	}

	$teaAct->addInfo('teacher',$tea);
}

//删除
function deleteTeacher($id,$teaAct){
	
	$teaAct->delByCon('tea_educate',$id);
	$teaAct->delByCon('tea_compet',$id);
	
	$sql='select * from tea_honor where tea_id = '.$id;
	$arr=$teaAct->getBySql($sql);
	
	$file=new FILE();
	
	for($i=0;$i<count($arr);$i++){
		if(!($arr[$i]['autoname']===null||$arr[$i]['autoname']==='')){
			$path=SP_BASEPATH.$arr[$i]['savepath'].$arr[$i]['autoname'];
			$file->del_file($path);
		}
		$teaAct->delInfo('tea_honor',$arr[$i]['id']);
	}
	
	$teaAct->delInfo('teacher',$id);
}

//批量删除
function deleteTeacherList(){
	global $idlist;
	global $teaAct;
	$idarray=explode(',',$idlist);
	for($i=0;$i<count($idarray);$i++){
		deleteTeacher($idarray[$i],$teaAct);
		
		$teaAct->delInfo('teacher',$idarray[$i]);	
	}
		
}
//修改
function updateTeacher($tea,$id){
	global $teaAct;
	
	if($tea['birth']!==''){
		$y=date('Y',time());
		$tea['age']=$y-substr($tea['birth'],0,4);
	}
	$teaAct->editInfo('teacher',$id,$tea);	
}

//------------------------------------教育经历----------------------------------------------
function queryEdu($tid){
	global $page;
	global $rows;
	global $teaAct;
	
	$sql='select * from tea_educate where tea_id='.$tid;
	$sql_cou='select count(id) as "count" from tea_educate where tea_id='.$tid;

	$cou=$teaAct->getCount($sql_cou);
	$eduarr=$teaAct->pageList($sql,$page,$rows,$cou);
	
	$json=$teaAct->toJson_edu($eduarr,$cou);
	echo $json;
	
}

function addEdu($tid,$edu){
	global $teaAct;
	$edu['tea_id']=$tid;
	$teaAct->addInfo('tea_educate',$edu);
}

function delEdu($id){
	global $teaAct;
	$teaAct->delInfo('tea_educate',$id);	
}

function findEduById($id){
	global $teaAct;
	$edu=$teaAct->findById('tea_educate',$id);
	$json=$teaAct->toJson2_edu($edu);
	echo $json;
}

function updateEdu($id,$edu,$tid){
	global $teaAct;
	$edu['tea_id']=$tid;
	$teaAct->editInfo('tea_educate',$id,$edu);
	
}

//-------------------------------------获得荣誉--------------------------------

function queryHor($tid){
	global $page;
	global $rows;
	global $teaAct;
	
	$sql='select * from tea_honor where tea_id='.$tid;
	$sql_cou='select count(id) as "count" from tea_honor where tea_id='.$tid;

	$cou=$teaAct->getCount($sql_cou);
	$arr=$teaAct->pageList($sql,$page,$rows,$cou);
	
	$json=$teaAct->toJson_hor($arr,$cou);
	echo $json;
	
}

function addHor($tid,$hor){
	global $teaAct;
	$hor['tea_id']=$tid;
	
	
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
	
		$hor['autoname']=$file->get_auto_filename();
		$hor['attname']=$file->get_filename();
		$hor['savepath']=$file->get_savepath();

	}
	
	$teaAct->addInfo('tea_honor',$hor);

}

function delHor($id){
	global $teaAct;
	
	$hor=$teaAct->findById('tea_honor',$id);
		
	if(!($hor['attname']===''||$hor['attname']===null)){
		$path=SP_BASEPATH.$hor['savepath'].$hor['autoname'];
		$file=new FILE();
		$file->del_file($path);
	}	
	
	$teaAct->delInfo('tea_honor',$id);	
}

function findHorById($id){
	global $teaAct;
	$hor=$teaAct->findById('tea_honor',$id);
	$json=$teaAct->toJson2_hor($hor);
	echo $json;
}

function updateHor($id,$hor,$tid){
	global $teaAct;
	$hor['tea_id']=$tid;
	
	
	
	if($_FILES['file']['error']==0){
		$old_hor=$teaAct->findById('tea_honor',$id);
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

	$teaAct->editInfo('tea_honor',$id,$hor);
	
}

//------------------------------------指导竞赛情况----------------------------------------------
function queryCom($tid){
	global $page;
	global $rows;
	global $teaAct;
	
	$sql='select * from tea_compet where tea_id='.$tid;
	$sql_cou='select count(id) as "count" from tea_compet where tea_id='.$tid;

	$cou=$teaAct->getCount($sql_cou);
	$eduarr=$teaAct->pageList($sql,$page,$rows,$cou);
	
	$json=$teaAct->toJson_com($eduarr,$cou);
	echo $json;
	
}

function addCom($tid,$com){
	global $teaAct;
	$com['tea_id']=$tid;
	$teaAct->addInfo('tea_compet',$com);
}

function delCom($id){
	global $teaAct;
	$teaAct->delInfo('tea_compet',$id);	
}

function findComById($id){
	global $teaAct;
	$com=$teaAct->findById('tea_compet',$id);
	$json=$teaAct->toJson2_com($com);
	echo $json;
}

function updateCom($id,$com,$tid){
	global $teaAct;
	$com['tea_id']=$tid;
	$teaAct->editInfo('tea_compet',$id,$com);
	
}

?>