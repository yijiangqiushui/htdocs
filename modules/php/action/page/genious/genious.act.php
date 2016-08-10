<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/projectapp/projectapp.cls.php';
include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
include __DIR__ . '/../../../../../extends/common/common.php';
include '../../class/genious/genious.cls.php';

$action = $_GET['action'];
$name = $_GET['name'];

$project_id = $_SESSION['project_id'];
$org_code = $_SESSION['org_code'];
$username = $_SESSION['username'];
/*
 * 通州区科技创新人才资助申报推荐表
 *
 * 1.基本情况
 */
$genious['project_id'] = $project_id;
// $genious['genious_name'] = $_POST['genious_name'];
$genious['genious_sex'] = $_POST['genious_sex'];
$genious_year = $_POST['genious_year'];
$genious_month = $_POST['genious_month'];
$genious['genious_birth'] = $genious_year.'-'.$genious_month;
$genious['genious_nation'] = $_POST['genious_nation'];
$genious['genious_party'] = $_POST['genious_party'];
$genious['genious_native'] = $_POST['genious_native'];
$genious['genious_edu'] = $_POST['genious_edu'];
$genious['genious_grade'] = $_POST['genious_grade'];
$genious['genious_major'] = $_POST['genious_major'];
$genious['genious_devote'] = $_POST['genious_devote'];
$genious['administ_post'] = $_POST['administ_post'];
$genious['major_post'] = $_POST['major_post'];
$genious['genious_address'] = $_POST['genious_address'];
$genious['genious_phone'] = $_POST['genious_phone'];
$genious['company_name'] = $_POST['company_name'];



$applyinfo ['org_code'] = $org_code;
$applyinfo ['register_time'] = $_POST ['register_time'];



$genious['is_hightec_prise'] = $_POST['is_hightec_prise'];
/*$genious['contacts'] = $_POST['contacts'];
$genious['contact_phone'] = $_POST['contact_phone'];
$genious['email'] = $_POST['email'];*/

$linkmanInfo["linkman"]=$_POST['contacts'];
$linkmanInfo["linkman_contact"]=$_POST['contact_phone'];
$linkmanInfo["linkman_email"]=$_POST['email'];
$linkmanInfo['project_name'] = $_POST['project_name'];

/* $genious['corp_name'] = $_POST['corp_name'];
$genious['corp_grade'] = $_POST['corp_grade']; */
$genious['serving_time'] = $_POST['serving_time'];
$genious['work_force'] = $_POST['work_force'];
$genious['college_num'] = $_POST['college_num'];
$genious['research_num'] = $_POST['research_num'];
$genious['job_resume'] = $_POST['job_resume'];
$genious['high_tech'] = $_POST['high_tech'];

$genious_person['org_code'] = $org_code;
$genious_person['legal_name'] = $_POST['corp_name'];
$genious_person['legal_edu'] = $_POST['corp_grade'];



/*
 *
 * 2. 2014年度主要工作实绩
 */
$work_product['project_id'] = $project_id;
$work_product['work_product'] = $_POST['work_product'];
/*
 *
 * 3. 2014年度突出贡献及获得的荣誉称号情况
 */
$honor_title['project_id'] = $project_id;
$honor_title['honor_title'] = $_POST['honor_title'];
/*
 *
 * 4. 申报科技创新人才资助项目情况阐述
 */
$situation['project_id'] = $project_id;
$situation['situation'] = $_POST['situation'];
/*
 * $situation['project_name'] = $_POST['project_name'];
 * $situation['bottom_dep'] = $_POST['bottom_dep'];
 * $situation['role_as'] = $_POST['role_as'];
 * $situation['start_end_time'] = $_POST['start_end_time'];
 * $situation['award_thing'] = $_POST['award_thing'];
 * $situation['project_thing'] = $_POST['project_thing'];
 * $situation['project_introduction'] = $_POST['project_introduction'];
 */
/*
 *
 * 5. 填表声明
 *
 * 这个页面暂时没有字段
 */

/*
 *
 * 6. 推荐单位意见
 */
$unit_opinion['project_id'] = $project_id;
$unit_opinion['unit_opinion'] = $_POST['unit_opinion'];

/*
 *
 * 7. 区科学技术委员会初审意见
 */
$first_opinion['project_id'] = $project_id;
$first_opinion['first_opinion'] = $_POST['first_opinion'];

/*
 *
 * 8. 评审意见
 */
$review_opinion['project_id'] = $project_id;
$review_opinion['review_opinion'] = $_POST['review_opinion'];

/*
 *
 * 9. 区人才工作领导小组审批意见
 */
$final_opinion['project_id'] = $project_id;
$final_opinion['final_opinion'] = $_POST['final_opinion'];

$statement = array();

$projectapp = new ProjectApp();
$genious_cls = new Genious();

switch ($action) {
    // 存入
    case 'save_award':
        $genious['flag'] = 0;
        $projectapp->saveinfo($project_id, $genious,$linkmanInfo,$genious_person,$applyinfo,$org_code);
        break;
    case 'save_support':
        $genious['flag'] = 1;
        $projectapp->saveinfo($project_id, $genious,$linkmanInfo,$genious_person,$applyinfo,$org_code);
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
        $projectapp->findinfo_award($org_code,$project_id, 0 ,'',$username);
        break;
    case 'findwork_product':
        $projectapp->findwork_product($project_id, 0,'');
        break;
    case 'findhonor_title':
        $projectapp->findhonor_title($project_id, 0,'');
        break;
    case 'findsituation':
        $projectapp->findsituation($project_id, 0,'');
        break;
    case 'findunit_opinion':
        $projectapp->findunit_opinion($project_id, 0,'');
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
        $projectapp->findinfo_award($org_code,$project_id, 1,"",$username);
        break;
    case 'support_findwork_product':
        $projectapp->findwork_product($project_id, 1,"");
        break;
    case 'support_findhonor_title':
        $projectapp->findhonor_title($project_id, 1,"");
        break;
    case 'support_findsituation':
        $projectapp->findsituation($project_id, 1,"");
        break;
    case 'support_findunit_opinion':
        $projectapp->findunit_opinion($project_id, 1,"");
        break;
    case 'support_findfirst_opinion':
        $projectapp->findfirst_opinion($project_id, 1,"");
        break;
    case 'support_findreview_opinion':
        $projectapp->findreview_opinion($project_id, 1,"");
        break;
    case 'support_findfinal_opinion':
        $projectapp->findfinal_opinion($project_id, 1,"");
        break;
    case 'save_unit_info':
        $projectapp->save_init_info($project_id,$unit_info);
        break;
    case 'find_support_statement':
        $statement['flag'] = 1;
        $genious_cls -> findStateMent($project_id,$statement,"");
        break;
    case 'save_support_statement':
        $statement['flag'] = 1;
        $statement['project_id'] = $project_id;
        $statement['statement'] = $_POST['statement'];
        $genious_cls -> saveStateMent($project_id, 'genious_info', $statement, 'project_id');
        break;
    case 'find_award_statement':
        $statement['flag'] = 0;
        $genious_cls -> findStateMent($project_id,$statement);
        break;
    case 'save_award_statement':
        $statement['project_id'] = $project_id;
        $statement['flag'] = 0;
        $statement['statement'] = $_POST['statement'];
        $genious_cls -> saveStateMent($project_id, 'genious_info', $statement, 'project_id');
        break;
    default:
        ;
}





