<?php
class APPLY {
	function project_expect($project_expect, $project_id)
	{
		$db = new DB();
		$result = $db->updateInfo('project_info', $project_id, $project_expect);
		$db->Close();
	}
	
	function findproject_expect($project_id){
		
		$db = new DB();
		// 参数分别是： 主键值   数据库表明   主键名
		$result = $db->GetInfo1($project_id,"project_info",project_id);
		//$result2 = $db->GetInfo1($org_code, 'shareholder_info', 'org_code');如果不是动态加载 就把结果从这里传过去  如果是那就在html页面直接加载
		$appJSON = array(
				'project_expect' => $result['project_expect']
				
		);
		echo json_encode($appJSON);
		$db->close();
	}
}
?>