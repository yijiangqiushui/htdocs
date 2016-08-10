<?php
/**
 * PHPExcel封装的简单使用
 *
 * @author 风格独特
 */

require_once __DIR__ . '/lib/Excel.php';
require_once __DIR__ . '/excel.php';

include '../../common/php/config.ini.php';
include '../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
include '../../modules/php/action/class/projectapp/projectapp.cls.php';
// 创建Excel实例
$excel = new Excel();
$projectapp = new ProjectApp();
global $global_project_stage;

$pidArray = $_GET['selRows'];

$pidArray = explode(',', $pidArray);

$realname = '';
$baseRow = '';
$template = '';
for($j = 0;$j<count($pidArray);$j++){
    $db = new DB();
    $project_item = $db->GetInfo1($pidArray[$j], 'project_info', 'project_id');
    
    $type = -1;
    $attach = $db -> GetInfo($project_item['project_type'], 'project_type');
    $attach_name = explode(",", $attach['attatch_name']);
    foreach($attach_name as $tmp){
        if($tmp == 19 ) $type = 3;
        if($tmp == 20 ) $type = 2;
        if($tmp == 21 || $tmp == 22 || $tmp == 23 || $tmp == 24 || $tmp == 25 || $tmp == 26) $type = 1;
    }
    
    //真实姓名
    $leaderInfo = $db -> GetInfo($project_item['user_id'], 'login_info');
    //公司信息
    $org_info = $db -> GetInfo1($project_item['org_code'], 'org_info', 'org_code');
    //查重信息
    $check_result = $db -> GetInfo1($project_item['project_id'], 'check_status', 'project_id');
    //select project leader
    $leader=$db -> GetInfo1($project_item['project_id'], 'project_principal', 'project_id');
    //查询项目类型
    $project_info = $db->GetInfo($project_item['project_type'], 'project_type');
    //专利情况
    $intellectual_property = $db->GetInfo1($org_info['org_code'], 'intellectual_property', 'org_code');
    //企业专利情况
    $project_patent = $db->GetInfo1($project_item['project_id'],'project_patent','project_id');
    //查询经费
    $tableData = TableData::get($project_item['project_id'], 18);
    $temp = $tableData['data'];
    //专利的经费;
    $tableData_patent = TableData::get($project_item['project_id'], 29);
    $patent = $tableData_patent['data'];
    
    $number = $j + 1;
     switch ($type){
        case 1:
            $content[] = array(
                $number,
                $org_info['org_name'],
                $org_info['register_address'],
                $leaderInfo['realname'],
                $leaderInfo['phone']==0?'':$leaderInfo['phone'],
                $org_info['fax'],
                $org_info['org_trade'],
                "企业已获专利权数".(isset($intellectual_property['patent_num'])?$intellectual_property['patent_num']:0)."，其中发明专利为".(isset($intellectual_property['invent_patent'])?$intellectual_property['invent_patent']:0),
                $project_item['tech_area'],
                '',
                $project_item['project_name'],
                "项目已获专利".(isset($project_patent['patent_num'])?$project_patent['patent_num']:0)."，其中发明".(isset($project_patent['invent_num'])?$project_patent['invent_num']:0)."，实用新型".(isset($project_patent['function_patent'])?$project_patent['function_patent']:0)."，外观设计".(isset($project_patent['patent_design'])?$project_patent['patent_design']:0),
                $patent['total'][1]
            );
            $realname = "专利";
            $baseRow = 6;
            $template = 'demo.xls';
            $index = 0;
            break;
        case 2:
            //人才奖励的内容
            $genious = $db->GetInfo2($project_item['project_id'], 'genious_info', 'project_id',0,'flag');
            $reward[] = array(
                $number,
              //$genious['genious_name'],
                $project_item['project_name'],
                $genious['genious_birth'],
                $genious['genious_sex'],
                $genious['genious_native'],
                $genious['genious_edu'],  
                $genious['genious_grade'],
                $genious['company_name'],
                $genious['genious_major'],
                $genious['administ_post'],    
                $genious['major_post'],
                $genious['genious_devote'],
                $genious['genious_phone'] 
            );
            $support[] = array(
                $number,
              //$genious['genious_name'],
                $project_item['project_name'],
                $genious['situation']
            );
            $flag = true;
            $realname = "人才奖励";
            $baseRow = 4;
            $template = 'talents_reward.xls';
            break;
        case 3:
            $genious = $db->GetInfo2($project_item['project_id'], 'genious_info', 'project_id',1,'flag');
            $reward[] = array(
                $number,
              //$genious['genious_name'],
                $project_item['project_name'],
                $genious['genious_birth'],
                $genious['genious_sex'],
                $genious['genious_native'],
                $genious['genious_edu'],
                $genious['genious_grade'],
                $genious['company_name'],
                $genious['genious_major'],
                $genious['administ_post'],
                $genious['major_post'],
                $genious['genious_devote'],
                $genious['genious_phone']
            );
            $support[] = array(
                $number,
              //$genious['genious_name'],
                $project_item['project_name'],
                $genious['situation']
            );
            $flag = true;
            $realname = "人才资助";
            $baseRow = 4;
            $template = 'talents_support.xls'; 
            break;
        default:
            $content[] = array(
                $number,
                $project_item['project_name'],
                $project_item['business_id'],
                $org_info['org_name'],
                $temp['total1_fund'][3],
                $temp['total2_fund'][3],
                $project_info['name'],
                $org_info['register_address'],
                isset($project_item['end_time'])?date("Y-m-d", $project_item['end_time']):'',
                $leaderInfo['realname'],
                $leaderInfo['phone']==0?'':$leaderInfo['phone']
            );
            $realname = "汇总";
            $baseRow = 3;
            $template = 'general.xls';
            break;
    }
        
    $db ->Close();
}
if($flag){
    $index = 1;
    echo dataToDulExcel($reward,$support,$template,$baseRow,$realname,$index);
}else{
    echo dataToExcel($content,$template,$baseRow,$realname,0);
}


