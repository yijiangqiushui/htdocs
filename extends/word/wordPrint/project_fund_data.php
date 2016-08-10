<?php

// require_once '../../../modules/php/action/class/projectapp/projectapp.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';


$org_code = $_SESSION ['org_code'];
// $project_id = $_SESSION ['project_id'];
$org_code = 'zgf001';
$project_id = 'dev1451718105';

$temp = TableData::get($project_id, 31);
$data = $temp['data'];

$arr['project_name'] = $data['project_name'];
$arr['business_id'] = $data['business_id'];
$arr['start_end_time'] = $data['start_end_time'];

foreach ($data['bgt_fund'] as $key => $value){
	$bgt_fund['bgt_fund'.$key] = $value;
}
foreach ($data['actual_fund1'] as $key => $value){
	$actual_fund1['actual_fund1'.$key] = $value;
}
$arr = array_merge($arr,$bgt_fund);
$arr = array_merge($arr,$actual_fund1);
$arr['bgt_fund_total'] = $data['bgt_fund_total'];
$arr['actualsrc_fund_total'] = $data['actualsrc_fund_total'];

foreach ($data['budget_fund'] as $key => $value){
	$budget_fund['budget_fund'.$key] = $value;
}
foreach ($data['patent_out'] as $key => $value){
	$patent_out['patent_out'.$key] = $value;
}
foreach ($data['actual_fund'] as $key => $value){
	$actual_fund['actual_fund'.$key] = $value;
}
$arr = array_merge($arr,$budget_fund);
$arr = array_merge($arr,$patent_out);
$arr = array_merge($arr,$actual_fund);

foreach ($data['total'] as $key => $value){
	$total['total'.$key] = $value;
}
$arr = array_merge($arr,$total);
//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,26);
$attach = array();
if(!empty($project_file_obj)){
    foreach($project_file_obj as $item){
        foreach($item as $key => $value){
            $attach[$key][] = $value;
        }

    }
}
if(!empty($attach)){
    $count=0;
    foreach ($attach["introduction"] as $val){
        $attach["introduction"][$count]=($val==null?"无":$val);
        $count++;
    }
    $arr['ATTACH'] = $attach; }

/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

$arr = array_merge($arr,$time);
echo datatoword($arr,'26.docx' , 26);
