<?php
require_once '../../../modules/php/action/class/acceptance/expert.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$apply = new Expert ();
$db = new DB();
$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];
//org_info
$arguments=$apply->findProjectExpert ($project_id, 'project_info', 'project_id',"pdf" );
$sign=$apply->finds ($project_id, 'project_info', 'project_id',"pdf");
$res1=array_merge($sign,$arguments);
$TBL1= $db->getDyData('experts', 'project_id', $project_id );
if(!empty($TBL1)){
	$count=0;
	foreach ($TBL1["expert_divide"] as $val){
		$TBL1["expert_divide"][$count]=$val==1?"组员":"组长";
		$count++;
	}
	$res1['TBL1'] = $TBL1;
}
$res1['TBL1']=$TBL1;
//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,16);
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
    $res1['ATTACH'] = $attach; }
/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

$res1 = array_merge($res1,$time);
echo datatoword($res1,'16.docx',16);