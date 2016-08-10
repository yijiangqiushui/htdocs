<?php
require_once '../../../website/html/view/template/apply/patent_implement/attach3_patent/attach3_patent.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
include '../../../website/php/action/class/projectFile.cls.php';

require_once __DIR__ . '/../word.php';
$db=new DB();
$apply = new ProjectApp ();
$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];
//
$res1=$apply->findpro_target($project_id,"pdf");
$res2=$apply->findpro_meaning($project_id,"pdf");
$res3=$apply->findpro_doing($project_id,"pdf");

$res4=TableData::get($project_id, 29);
$temp=$res4["data"];
$res5=array(
		"first_year"=>$temp["first_year"],
		"second_year"=>$temp["second_year"],
		"third_year"=>$temp["third_year"],
		"first"=>$temp["first"],
		"second"=>$temp["second"],
		"third"=>$temp["third"],
		"fund_tech_total"=>$temp["fund_tech_total"],
		"fund_other_total"=>$temp["fund_other_total"],
		"con_way"=>$temp["con_way"],
		'all_fund_tech_total' => $temp['all_fund_tech_total'],
		'teach_reduce_fund_total' => $temp['teach_reduce_fund_total'],
		'adjust_fund_total' => $temp['adjust_fund_total'],
		'total_total' => $temp['total_total'],
		'fund_tech_total' => $temp['fund_tech_total'],
		'fund_other_total' => $temp['fund_other_total'],
);
if(!empty($temp['names'])){
$TBL1= array(
		'names' => $temp['names'],
		'types' => $temp['types'],
		'nums' => $temp['nums'],
		'pays' => $temp['pays'],
		'sour' => $temp['sour'],
		'time' => $temp['time'],
		'function' => $temp['function']
		
	);
}
$res1["TBL1"]=$TBL1;

//get project_name
$res=$apply->find_start_end_time($project_id);
$res1['project_name']=$res['project_name'];
//经费循环
if(!empty($temp['first_value'])){
	foreach ($temp['first_value'] as $key => $value){
		$res5['first_value'.$key] = $value;
	}}

	if(!empty($temp['second_value'])){
		foreach ($temp['second_value'] as $key => $value){
			$res5['second_value'.$key] = $value;
		}}
		if(!empty($temp['third_value'])){
			foreach ($temp['third_value'] as $key => $value){
				$res5['third_value'.$key] = $value;
			}}
			if(!empty($temp['total'])){
				foreach ($temp['total'] as $key => $value){
					$res5['total'.$key] = $value;
				}}
				
				if(!empty($temp['total_queue'])){
					foreach ($temp['total_queue'] as $key => $value){
						$res5['total_queue'.$key] = $value;
					}}
					if(!empty($temp['out_year'])){
						foreach ($temp['out_year'] as $key => $value){
							$res5['out_year'.$key] = $value;
						}}
						
						if(!empty($temp['teach_budget_fund'])){
							foreach ($temp['teach_budget_fund'] as $key => $value){
								$res5['teach_budget_fund'.$key] = $value;
							}}
							if(!empty($temp['teach_reduce_fund'])){
								foreach ($temp['teach_reduce_fund'] as $key => $value){
									$res5['teach_reduce_fund'.$key] = $value;
								}}
								if(!empty($temp['teach_adjust_fund'])){
									foreach ($temp['teach_adjust_fund'] as $key => $value){
										$res5['teach_adjust_fund'.$key] = $value;
									}}
									if(!empty($temp['teach_actual_fund'])){
										foreach ($temp['teach_actual_fund'] as $key => $value){
											$res5['teach_actual_fund'.$key] = $value;
										}}
										if(!empty($temp['other_budget_fund'])){
											foreach ($temp['other_budget_fund'] as $key => $value){
												$res5['other_budget_fund'.$key] = $value;
											}}
											if(!empty($temp['other_reduce_fund'])){
												foreach ($temp['other_reduce_fund'] as $key => $value){
													$res5['other_reduce_fund'.$key] = $value;
												}}
												if(!empty($temp['other_adjust_fund'])){
													foreach ($temp['other_adjust_fund'] as $key => $value){
														$res5['other_adjust_fund'.$key] = $value;
													}}
													if(!empty($temp['other_actual_fund'])){
														foreach ($temp['other_actual_fund'] as $key => $value){
															$res5['other_actual_fund'.$key] = $value;
														}}

														
 $res6=$apply->findpro_belong($project_id,"pdf");
 $res7=TableData::get($project_id, 30);
 $temp=$res7["data"];
 $res5["org_name"]=$temp["org_name"];
 $res5["coorg"]=$temp["coorg"];
 $res8=array();
if(!empty($temp['name'])){
	$count=0;
	foreach ($temp['name'] as  $val){ 
		$res8["name"][$count]=$temp["name"][$count];
		$res8["gender"][$count]=$temp["gender"][$count];
		$res8["ages"][$count]=$temp["ages"][$count];
		$res8["edu"][$count]=$temp["edu"][$count];
		$res8["pos"][$count]=$temp["pos"][$count];
		$res8["sub"][$count]=$temp["sub"][$count];
		$res8["work"][$count]=$temp["work"][$count];
		$res8["mission"][$count]=$temp["mission"][$count];
		$count++;
}
}

$res9=$apply->findother_rule($project_id,"pdf");
/* $data=TableData::get($project_id, 32);
$res10=$data["data"]; */
$res10=$apply->findBook_others($project_id,$org_code,"pdf");


$res1["TBL2"]=$res8;
$res1=array_merge($res1,$res2);
$res1=array_merge($res1,$res3);
$res1=array_merge($res1,$res5);
$res1=array_merge($res1,$res6);
$res1=array_merge($res1,$res9);
if(!empty($res10)){
$res1=array_merge($res1,$res10);
}

//获取项目编号
$res10=$apply->findother_info($project_id);
$res1["business_id"]=$res10["business_id"];
$res1["start_time"]=$res10["start_time"];

//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,23);
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

$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();
// echo $res1["b_name"];exit();
$res1["b_name"]=$res1["org_name"];
if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($res1,'23.docx',23);
}else{
    echo datatoword($res1,'230.docx',23);
}