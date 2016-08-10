<?php
// include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/pri.cls.php';
include '../../class/center/center.cls.php';
include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
$project_id = $_GET['project_id'];
$departmentpro = $_GET['department'];
$id = $_GET['id'];

$project_id1 = $_SESSION['project_id'];
$department = $_SESSION['department'];
// $department = 0;
// $user_type = 1;
$user_type = $_SESSION['user_type'];
$login_type = $_GET['login_type'];
// echo $user_type;
// echo $department."hhhh";
// $department = 1;
//暂时用发展计划科ent'];  
    

//     printf($project_array[2]."fff");
$admin['name'] = $_POST['project_type'];
$admin['apply_start'] = strtotime($_POST['apply_start']);
$admin['apply_end'] = strtotime($_POST['apply_end']);
$admin['isfather'] = 0;
$admin['father'] = 0;
$admin['apply_status'] = 1;

switch($_POST['department'])
{
	case '发展计划科':
		$admin['dep_type'] = 0;
		break;
	case '知识产权科':
		$admin['dep_type'] = 1;
		break;
	case '科技综合科':
		$admin['dep_type'] = 2;
		break;
}

$project_type = $_GET['project_type'];
//2015.12.01加入
$department_check = $_POST['department'];
$stage = $_POST['state'];
//0 1 2 代表不同的科室
$dept=$_POST['dept'];

//用来处理用户查询
$linkman = $_POST['linkman'];
$username = $_POST['user_name'];
$org_name = $_POST['org_name'];

$page = isset($_POST['page']) ? $_POST['page'] : 15;
$rows = isset($_POST['rows']) ? $_POST['rows'] : 15;

$center=new Center();
switch($action){
	case 'findLookFile':
		$page = $_POST['page'];
		$rows = $_POST['rows'];

    $project_type = $_GET['project_type'];
    $year = $_GET['year'];
    $name = urldecode($_GET['name']);
    $id = $_GET['id'];
    $engineer = $_GET['engineer'];
    $start = $_GET['start'];
    $end = $_GET['end']; 
	$center-> findLookFile($page,$rows,$project_type,$year,$name,$id,$engineer,$start,$end);
    //$center-> findLookFile($page,$rows,$project_type,$year);
		break;
    case 'OpenMid':
        $center-> openmid($project_id);
        $db = new DB();
        $title = "科委通知";
   //     $project_id = $project_id;
        $result = $db -> GetInfo1($project_id, 'project_info', 'project_id');
        $project_name = $result['project_name'];
        $str = "您的项目 " . $project_name . " 已开启《项目工作中期报告》，请及时登录系统填写。";
        $center->email_send($project_id,$title,$str);
//         $center-> email_send($project_id);
        break;
   case 'stageMid':
        $center-> stagemid($project_id);
        break;
   case 'project_main':
	   $center-> projectMain($page,$rows,$departmentpro); 
        break;
   case 'project_all':
       if(!isset($_GET['department']) || !is_numeric($_GET['department'])){
           $department = $_SESSION['department'];
       }else{
           $department = $_GET['department'];
       }
	   	$center-> projectall($page,$rows,$department,$user_type);

   		break;
   case 'applyExecheck':
       $ptid = $_GET['ptid'];
       $user_id = $_GET['user_id'];
       $center->checkApplyExe($ptid,$user_id);
       break;
   case 'projectIscheck':
       $ptid = $_GET['ptid'];
       $user_id = $_GET['user_id'];
       $center->projectIscheck($ptid,$user_id);
       break;
   case 'userProject':
       $center -> userProject();
       break;
   case 'getUserDep':
       $center-> getUserDep();
       break;
   case 'addApply':
       $ptid = $_POST['ptid'];
       $user_id = $_POST['user_id'];
       $center->addApply($ptid,$user_id);
       break;
   case 'deleteApply':
       $ptid = $_POST['ptid'];
       $user_id = $_POST['user_id'];
       $center->deleteApply($ptid,$user_id);
       break;
   case 'deleteNewProject':
       $ptid = $_POST['ptid'];
       $user_id = $_POST['user_id'];
       $center->deleteNewProject($ptid,$user_id);
       break;
   case 'deleteCheckExe':
       $ptid = $_POST['ptid'];
       $user_id = $_POST['user_id'];
       $table_id = $_POST['table_id'];
       $center->deleteCheckExe($ptid,$user_id,$table_id);
       break;
       
   case 'deleteApplyStage':
       $ptid = $_POST['ptid'];
       $user_id = $_POST['user_id'];
       $center->deleteApplyStage($ptid,$user_id);
       break;
       
   case 'addCheckExe':
       $ptid = $_POST['ptid'];
       $user_id = $_POST['user_id'];
       $table_id = $_POST['table_id'];
       $center->addCheckExe($ptid,$user_id,$table_id);
       break;
   case 'copyNew':
       $ptid = $_GET['ptid'];
       $user_id = $_GET['user_id'];
       $center->copyNew($ptid,$user_id);
       break;
   case 'inherit':
       $project_type_id = $_POST['ptid'];
       $user_id = $_POST['user_id'];
       $center->inherit($project_type_id,$user_id);
       break;
   case 'OpenAcc':
   		$center-> openaccet($project_id);
   		$db = new DB();
   		$title = "科委通知";
   		$result = $db -> GetInfo1($project_id, 'project_info', 'project_id');
   		$project_name = $result['project_name'];
   		$str = "您的项目 " . $project_name . " 已开启验收阶段，请及时登录系统填写验收相关文件";
   		$center->email_send($project_id,$title,$str);
   	    break;  
   case 'OpenAccet':
   	   $center-> openaccet($project_id);
   	   break;
   	   
   case 'isopenAcc':
       $selRows = $_POST['selRows'];
       $center->isopenAcc($selRows);
       break;
       
   case 'isopenMiddle':
       $selRows = $_POST['selRows'];
       $center->isopenMiddle($selRows);
       break;
    case 'isCheckBatch':
        $selRows = $_POST['selRows'];
        $status = $_POST['status'];
        $check_opnion = $_POST['check_opnion'];
//       echo $check_opnion."1";  exit();
        $center->isCheckBatch($selRows,$status,$check_opnion);
        break;
   //增加存档 2015.12.13
    case 'CanisCheckBatch':
    	$selRows = $_POST['selRows'];
    	$status = $_POST['status'];
    	$center->CanisCheckBatch($selRows,$status);
    	break;
   case 'Opensave':
   //  $year = $_GET['year'];
   //    $center -> opensave($project_id,$year);
       $center -> opensave($project_id);
       break;
   case 'queryUser':
   	   	if($user_type == 3){
   	   		$center-> queryuserall($page,$rows);
   	   	}
   	   	else {
   	   		$center->queryuser($page,$rows,$department,"0 or user_type=-1");
   	   	}
   	   	
   	   	break;
   case 'queryUserus':
	   	$center->queryuser($page,$rows,$login_type);
	   	break;
    case 'querySearchUser':
        $linkman = urldecode($_GET['linkman']);
        $username = urldecode($_GET['username']);
        $org_name = urldecode($_GET['org_name']);
        $center->querySearchUser($page,$rows,$linkman,$username,$org_name);
        break;
   case 'delUser':	
   		$center->deluser($id);
   		break;
   case 'queryDelUser':
   		$center->querydelusers($page,$rows,$department);
   		break;
   //单个恢复
   case 'recover':
   		$center->recover($id);
   		break;
   //批量恢复;
   case 'recUsers':
       $list_id = $_GET['list_id']; 
       $center->recUsers($list_id);
       break;		
   case 'newadmin':
        $center->newAdmin('project_type', $admin);
       break; 
   case 'delAdmin':
       $center->delProject($project_type);
       break;
   case 'delArrproject_type':
       $arrproject_type=$_GET['arrproject_type'];
       $center->delArrProject_type($arrproject_type);
       break;
   case 'processControl':
       $center -> processControl($page,$rows,$departmentpro);
       break;
   case 'processControlAll':
	   	if($user_type == 3){
	   		$center-> processControlAll($page,$rows);
	   	}
	   	else{
	   		$center-> processControl($page,$rows,$department);
	   	}
	   	break;
   case 'isSuper':
//    	   $center->issuper($department,$user_type);
		$tag = Pri::instance() -> is_special?1:0;
	   	$isSuper = array(
	   	   	   		'user_type' => $user_type,
	   	    		'department' => $department,
					'special'	=> $tag
	   	   	   );
	   	echo json_encode($isSuper);
   	   break;
           
      //显示点击收受理后的数据            
   case 'project_info':
       
       $center->checklist($department, $project_type, $stage);
       break;    
       
   //列出当前用户的tree
   case 'treedata':
       $center->treeData();
       break;
   //开启验收阶段
   case 'MidStatus':
       $center->MidStatus($project_id);
       break;
   case 'checkHtml':
       $center->checkHtml($project_id);
       break;
   case 'passStatus':
       $center->passStatus($project_id);
       break;
   //加入查询工程师
   case 'findengineer':
       $center->findEngineer($project_id);
       break;
   //加入查重入库;
  /*  case 'addCheck':
       $url = $_GET['url'];
       $username = $_GET['username'];
       $password = $_GET['password'];
       $database = $_GET['database'];
       $center -> addCheck($project_id, $url, $username, $password, $database);
       break; */
   default:;

  }
