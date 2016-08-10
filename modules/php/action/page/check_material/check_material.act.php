<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/projectapp/projectapp.cls.php';
include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
include __DIR__ . '/../../../../../extends/common/common.php';

$action = $_GET['action'];
$name = $_GET['name'];

$project_id = $_SESSION['project_id'];
$org_code = $_SESSION['org_code'];

/*
 * 专利报告书
 *
 * 1.项目单位基本情况
 */
$genious['project_id'] = $project_id;
$genious['genious_name'] = $_POST['genious_name'];

$projectapp = new ProjectApp();

switch ($action) {
    // 存入
    case 'save_award':
        $genious['flag'] = 0;
        $projectapp->saveinfo($project_id, $genious);
        break;
    case 'save_support':
        $genious['flag'] = 1;
        $projectapp->saveinfo($project_id, $genious);
        break;
    
    case 'savework_product':
        $work_product['flag'] = 0;
        $projectapp->savework_product($project_id, $work_product);
        break;
    case 'savesupportwork_product':
        $work_product['flag'] = 1;
        $projectapp->savework_product($project_id, $work_product);
        break;
    
    case 'savehonor_title':
        $honor_title['flag'] = 0;
        $projectapp->savehonor_title($project_id, $honor_title);
        break;
    case 'savesupporthonor_title':
        $honor_title['flag'] = 1;
        $projectapp->savehonor_title($project_id, $honor_title);
        break;
    
    case 'savesituation':
        $situation['flag'] = 0;
        $projectapp->savesituation($project_id, $situation);
        break;
    case 'savesupportsituation':
        $situation['flag'] = 1;
        $projectapp->savesituation($project_id, $situation);
        break;
    
    case 'saveunit_opinion':
        $unit_opinion['flag'] = 0;
        $projectapp->saveunit_opinion($project_id, $unit_opinion);
        break;
    case 'savesupportunit_opinion':
        $unit_opinion['flag'] = 1;
        $projectapp->saveunit_opinion($project_id, $unit_opinion);
        break;
    
    case 'savefirst_opinion':
        $first_opinion['flag'] = 0;
        $projectapp->savefirst_opinion($project_id, $first_opinion);
        break;
    case 'savesupportfirst_opinion':
        $first_opinion['flag'] = 1;
        $projectapp->savefirst_opinion($project_id, $first_opinion);
        break;
    
    case 'savereview_opinion':
        $review_opinion['flag'] = 0;
        $projectapp->savereview_opinion($project_id, $review_opinion);
        break;
    case 'savesupportreview_opinion':
        $review_opinion['flag'] = 1;
        $projectapp->savereview_opinion($project_id, $review_opinion);
        break;
    
    case 'savefinal_opinion':
        $final_opinion['flag'] = 0;
        $projectapp->savefinal_opinion($project_id, $final_opinion);
        break;
    case 'savesupportfinal_opinion':
        $final_opinion['flag'] = 1;
        $projectapp->savefinal_opinion($project_id, $final_opinion);
        break;
    
    // 奖励表的回写
    case 'findGenious':
        $projectapp->findinfo_award($project_id, 0);
        break;
    case 'findwork_product':
        $projectapp->findwork_product($project_id, 0);
        break;
    case 'findhonor_title':
        $projectapp->findhonor_title($project_id, 0);
        break;
    case 'findsituation':
        $projectapp->findsituation($project_id, 0);
        break;
    case 'findunit_opinion':
        $projectapp->findunit_opinion($project_id, 0);
        break;
    case 'findfirst_opinion':
        $projectapp->findfirst_opinion($project_id, 0);
        break;
    case 'findreview_opinion':
        $projectapp->findreview_opinion($project_id, 0);
        break;
    case 'findfinal_opinion':
        $projectapp->findfinal_opinion($project_id, 0);
        break;
    
    // 资助表的回写
    case 'support_findGenious':
        $projectapp->findinfo_award($project_id, 1);
        break;
    case 'support_findwork_product':
        $projectapp->findwork_product($project_id, 1);
        break;
    case 'support_findhonor_title':
        $projectapp->findhonor_title($project_id, 1);
        break;
    case 'support_findsituation':
        $projectapp->findsituation($project_id, 1);
        break;
    case 'support_findunit_opinion':
        $projectapp->findunit_opinion($project_id, 1);
        break;
    case 'support_findfirst_opinion':
        $projectapp->findfirst_opinion($project_id, 1);
        break;
    case 'support_findreview_opinion':
        $projectapp->findreview_opinion($project_id, 1);
        break;
    case 'support_findfinal_opinion':
        $projectapp->findfinal_opinion($project_id, 1);
        break;
    
    default:
        ;
}





