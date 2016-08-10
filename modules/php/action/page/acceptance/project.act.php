<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/acceptance/project.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action=$_GET['action'];

$project_id = $_SESSION['project_id'];
//任务目标
$project_summary['project_id'] =$project_id;
$project_summary['assign_plan'] = $_POST['project_process'];

//任务成果信息
$project_archievement['achievement'] = $_POST['project_achievement'];

//主要研发内容
$project_chief_content['assign_research'] = $_POST['project_chief_context'];

//成果及推广计划
$project_gen_plan['generalize_plan'] = $_POST['project_generalize_plan'];

//考核指标
$project_kpi['assign_target'] = $_POST['project_kpi'];

//单位意见;
$project_org_suggest['org_suggest'] = $_POST['project_org_suggest'];

//其他意见
$project_oth_suggest['other_suggest'] = $_POST['project_other_suggest'];


$project = new Project();

switch ($action)
{
    case 'saveSummary':
        $project->saveSummary('project_summary',$project_id,$project_summary);
        break;
    case 'saveArchievement':
        $project->saveSummary('project_summary',$project_id,$project_archievement);
        break;
    case 'saveChiefContent':
        $project->saveSummary('project_summary',$project_id,$project_chief_content);
        break;
    case 'saveGenPlan':
        $project->saveSummary('project_summary',$project_id,$project_gen_plan);
        break;
    case 'saveProjectKpi':
        $project->saveSummary('project_summary',$project_id,$project_kpi);
        break;
    case 'saveOrgSuggest':
        $project->saveSummary('project_summary',$project_id,$project_org_suggest);
        break;
    case 'saveOthSuggest':
        $project->saveSummary('project_summary',$project_id,$project_oth_suggest);
        break;
        //
    case 'findProArchieve':
        $project->findProArchieve($project_id, 'project_summary', 'project_id',"");
        break;
        //2
    case 'findProChiefContent':
        $project->findProChiefContent($project_id, 'project_summary', 'project_id',"");
        break;
        //3
    case 'findProPlan':
        $project->findProPlan($project_id, 'project_summary', 'project_id',"");
        break;
        //4
    case 'findProKpi':
        $project->findProKpi($project_id, 'project_summary', 'project_id',"");
        break;
        //5
    case 'findOrgSug':
        $project->findOrgSugg($project_id, 'project_summary', 'project_id',"");
        break;
        //6
    case 'findOtherSugg':
        $project->findOtherSugg($project_id, 'project_summary', 'project_id',"");
        break;
        //7
    case 'findProSummary':
        $project->findProSummary($project_id, 'project_summary', 'project_id',"");
        break;
}