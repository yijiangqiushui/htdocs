<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/implement/middle.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action=$_GET['action'];

$project_id=$_SESSION['project_id'];

//期中报告存在的问题;
$problem_action['project_id'] = $project_id;
$problem_action['problem_action'] = $_POST['problem_action'];

//期中报告
$project_middle['project_id'] = $project_id;//这条语句在回写时，重要
$project_middle['project_process'] = $_POST['project_process'];

//期中报告费用
$fund_use['project_id'] = $project_id;
$fund_use['fund_use'] = $_POST['fund_use'];

//申请调整
$modify_apply['project_id'] = $project_id;
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$modify_apply['start_end'] = $start_time.'~'.$end_time;
$modify_apply['modify_content'] = $_POST['modify_content'];
$modify_apply['modify_reason'] = $_POST['modify_reason'];
$modify_apply['engineer_suggest'] = $_POST['engineer_suggest'];
$modify_apply['org_suggest'] = $_POST['org_suggest'];
$modify_apply['office_suggest'] = $_POST['office_suggest'];
$modify_apply['vice_suggest'] = $_POST['vice_suggest']; 
$modify_apply['director_suggest'] = $_POST['director_suggest'];
$modify_apply['remark'] = $_POST['remark'];
//  新加
$modify_apply['project_name'] = $_POST['project_name'];
$modify_apply['othermoney'] = $_POST['othermoney'];
$modify_apply['finmoney'] = $_POST['finmoney'];
$modify_apply['project_money'] = $_POST['project_money'];

$middle = new Middle();

switch ($action)
{
    case 'saveProAction':
        $middle->saveMiddle('project_middle',$project_id,$problem_action);
        break;
    case 'saveMiddle':
        $middle->saveMiddle('project_middle',$project_id,$project_middle);
        break;
    case 'saveProFundUse':
        $middle->saveMiddle('project_middle',$project_id,$fund_use);
        break;
    case 'saveApplys':
        $middle->saveApply('modify_apply',$project_id,$modify_apply);
        break;
    case 'findMiddle':
        $middle->findMiddle($project_id, 'project_middle', 'project_id');
        break;
    case 'findProFund':
        $middle->findProFund($project_id, 'project_middle', 'project_id');
        break;
    case 'findProProblem':
        $middle->findProProble($project_id, 'project_middle', 'project_id');
        break;
    case 'findModifyApp':
        $middle->findModifyApp($project_id);
        break;
}