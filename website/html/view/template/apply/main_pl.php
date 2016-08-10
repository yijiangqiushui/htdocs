<?php
// include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../modules/php/action/class/projectapp/util.cls.php'; 

class Main {
	function main_plan($project_id) {
		$db = new DB ();
		
		// 参数分别是： 主键值 数据库表明 主键名
		$result1 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
		$result2 = $db->GetInfo1 ( $project_id, 'project_principle', 'project_id' );
		$result3 = $db->GetInfo2 ( $project_id, 'project_ann_plan', 'project_id', util::gettime ( - 2 ), "plan_year" );
		$result4 = $db->GetInfo2 ( $project_id, 'project_ann_plan', 'project_id', util::gettime ( - 1 ), "plan_year" );
		$result5 = $db->GetInfo2 ( $project_id, 'project_ann_plan', 'project_id', util::gettime ( 0 ), "plan_year" );
		
// 		$text = '项目目的:' . "\n" . $result1 ['project_meaning'] . "\n" . '项目相关基础:' . "\n" . $result1 ['project_status'] . "\n" . '考核指标:' . "\n" . $result1 ['project_kpi'] . "\n" . '项目目标:' . "\n" . $result1 ['project_aim'] . "\n" . '项目任务:' . "\n" . $result1 ['project_mission'] . "\n" . '项目内容:' . "\n" . $result1 ['project_content'] . "\n" . '技术方案:' . "\n" . $result1 ['tech_way'] . "\n" . '项目组织实施:' . "\n" . $result1 ['project_manage'] . "\n" . '项目委托任务:' . "\n" . $result1 ['delegation_task'] . "\n" . '项目风险:' . "\n" . $result1 ['project_risk'] . "\n" . '预期成果形式:' . "\n" . $result1 ['project_expect'] . "\n" . '社会效益:' . "\n" . $result1 ['project_effect'] . "\n" . '单位负责人意见:' . "\n" . $result1 ['org_opinion'] . "\n" . '主管意见:' . "\n" . $result2 ['leader_opinion'] . "\n" . '年份:' . "\n" . $result3 ['plan_year'] . "\n" . '项目计划:' . "\n" . $result3 ['plan_content'] . "\n" . '年份1:' . "\n" . $result4 ['plan_year'] . "\n" . '项目计划1:' . "\n" . $result4 ['plan_content'] . "\n" . '年份2:' . "\n" . $result5 ['plan_year'] . "\n" . '项目计划2:' . "\n" . $result5 ['plan_content'];
// 		$text = '项目相关基础:' . $result1 ['project_status'];
		$appJSON = array (
				'项目目的' => $result1 ['project_meaning'],
		        '考核指标' =>  $result1 ['project_kpi'],
		        '项目目标' => $result1 ['project_aim'],
		        '项目任务' => $result1 ['project_aim'],
		        '技术方案' => $result1 ['tech_way'],
		); 
// 		ob_clean();
// 		echo json_encode ( $appJSON );
		// print_r($appJSON) ;

$jsonencode = json_encode($appJSON);
echo $jsonencode;

		$db->close ();
	}
	
/* 	function checkStatus( $project_id,$isPass,$opinion ,$url){
	    $db = new DB();
	    $result = $db -> updateInfo(,$project_id,);
	    
	} */
}