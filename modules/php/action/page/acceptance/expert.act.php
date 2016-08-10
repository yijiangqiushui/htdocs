<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/acceptance/expert.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action=$_GET['action'];
$project_id = $_SESSION['project_id'];

$expert_arguments['project_id'] = $project_id;
$expert_arguments['expert_opinion'] = $_POST['expert_arguments'];

$zj_expert_arguments['project_id'] = $project_id;
$zj_expert_arguments['zj_expert_opinion'] = $_POST['expert_arguments'];

$expert_name=(array)$_POST['expert_name'];
$expert_divide=(array)$_POST['expert_divide'];
$expert_org=(array)$_POST['expert_org'];
$expert_id=(array)$_POST['expert_id'];
$expert_job=(array)$_POST['expert_job'];
$expert_major=(array)$_POST['expert_major'];
$expert_phone=(array)$_POST['expert_phone'];
$expert_sign=(array)$_POST['expert_sign'];
$count=0;
$sign=array();
foreach ($expert_name as $val){
	$sign[$count][project_id]=$project_id;
	$sign[$count][expert_name]=$expert_name[$count];
	$sign[$count][expert_divide]=$expert_divide[$count];
	$sign[$count][expert_org]=$expert_org[$count];
	$sign[$count][expert_id]=$expert_id[$count];
	$sign[$count][expert_job]=$expert_job[$count];
	$sign[$count][expert_major]=$expert_major[$count];
	$sign[$count][expert_phone]=$expert_phone[$count];
	$count++;
}
$count=0;
$zj_sign=array();
foreach ($expert_name as $val){
	$zj_sign[$count]['zj_project_id']=$project_id;
	$zj_sign[$count]['expert_name']=$expert_name[$count];
	$zj_sign[$count]['expert_divide']=$expert_divide[$count];
	$zj_sign[$count]['expert_org']=$expert_org[$count];
	$zj_sign[$count]['expert_id']=$expert_id[$count];
	$zj_sign[$count]['expert_job']=$expert_job[$count];
	$zj_sign[$count]['expert_major']=$expert_major[$count];
	$zj_sign[$count]['expert_phone']=$expert_phone[$count];
	$count++;
}




$project_sign['project_id']=$project_id;
$project_sign['project_argtime']=$_POST['project_argtime'];
// $project_sign['project_money']=$_POST['project_money'];
//echo $project_sign['project_lzsj'];exit;

$leader["leader_name"]=$_POST["project_leader"];

// $zj_project_sign['project_zxzj_name']=$_POST['project_money'];
$zj_project_sign['zj_project_lzsj']=$_POST['zj_project_lzsj'];
//var_dump($zj_sign);
$expert = new Expert();

switch ($action)
{
    case 'saveArguments':	
    	//   expertProAccept.php  
    $expert->updateInfo('project_info',$project_id, $expert_arguments);
    break;
    case 'zj_saveArguments':
    	//   expertProAccept.php
    	$expert->updateInfo('project_info',$project_id, $zj_expert_arguments);
    	break;
    case 'sign':
    $expert->sign('experts',$project_id,$sign,$project_sign,$leader);//researcher
    break;
    case 'zj_sign':
    	$expert->zj_sign('experts',$project_id,$zj_sign,$zj_project_sign);//researcher
    	break;
    case 'findProExpert':
    $expert->findProExpert($project_id, 'project_info', 'project_id',"");
    break;
    case 'zj_findProExpert':
    	$expert->findzj_ProExpert($project_id, 'project_info', 'project_id',"");
    	break;
    case 'findsign' :
    $expert->findsign($project_id, 'project_info', 'project_id',"");
    break;
    case 'findzj_sign' :
    $expert->findsign($project_id, 'project_info', 'project_id',"");
    break;
}