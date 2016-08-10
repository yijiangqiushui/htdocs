<?php
include '../../class/applycation/aim_standard.cls.php';

    $action = $_GET['action'];
    $page = $_POST['page'];
    $rows = $_POST['rows'];
    
    // 申请单位基本信息
    // project_id and org_id
//     $project_id = $_SESSION['project_id'];
    $project_id = "01234";
    // $project_id = '0123456';
    $org_code = $_SESSION['org_code'];
    
    // $org_code = '012345678';
    $org_code = '01234567';
    
    
    $project_content['project_id'] = $project_id;
    $project_content['project_target'] = $_POST['aim_standard'];
    
//     echo $project_content['project_id']."666666".$project_content['project_target']."555555";
    
    $project_content1['project_id'] = $project_id;
    $project_content1['project_mean'] = $_POST['project_mean'];
    
    $project_mission['project_id'] = $project_id;
    $project_mission['sessionone'] = $_POST['sessionone'];
    $project_mission['sessiontwo'] = $_POST['sessiontwo'];
    $project_mission['sessionthree'] = $_POST['sessionthree'];
    $project_mission['sessionfour'] = $_POST['sessionfour'];
  
    $apply = new APPLY();
    switch ($action) {
         case 'project_content': //此处为action=的内容
             
                $apply->abc($project_id,$project_content);
              //abc为aim_standard.cls.php里面的函数名
                break;
         case 'project_mean':
                $apply->bcd($project_id,$project_content1);
                break;
         case 'project_plan':
                $apply->cdf($project_id,$project_mission);
                break;
                default:;
    }

?>