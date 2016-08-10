<?php
class APPLY {
	function material_list($material_list, $project_id) {
		$db = new DB ();
		$result1 = $db->Delete ( "delete from  material_list  where project_id =$project_id" );
		
		foreach ( $material_list as $tem ) {
			
			$result2 = $db->InsertData ( "material_list", $tem );
		}
		$db->Close ();
	}
	function project_invest($project_invest, $project_id) {
		$db = new DB ();
		$result1 = $db->UpdateTabData ( "project_invest", $project_id, $project_invest, "project_id" );
	}
	function findproject_invest($project_id) {
		$db = new DB ();
		// 参数分别是： 主键值 数据库表明 主键名
		$result = $db->GetInfo1 ( $project_id, 'project_invest', 'project_id' );
		$appJSON = array (
				// 少两个 流动资金 和固定资金
				'invest_total' => $result ['invest_total'],
				'invested' => $result ['invested'],
				'invested_bank' => $result ['invested_bank'],
				'invested_gov' => $result ['invested_gov'],
				'planadd' => $result ['planadd'],
				'planaddsrc_com' => $result ['planaddsrc_com'],
				'planaddsrc_bank' => $result ['planaddsrc_bank'],
				'planaddsrc_fin' => $result ['planaddsrc_fin'],
				'planaddsrc_finpat' => $result ['planaddsrc_finpat'],
				'planaddsrc_finother' => $result ['planaddsrc_finother'],
				'planaddsrc_other' => $result ['planaddsrc_other'],
				'patent_use' => $result ['patent_use'],
				'planadd_bank' => $result ['planadd_bank'],
				'planadd_gov' => $result ['planadd_gov'] 
		);
		echo json_encode ( $appJSON );
		$db->close ();
	}
	function project_member($project_member, $project_id) {
		$db = new DB ();
		$result1 = $db->Delete ( "delete from  project_member   where project_id =$project_id" );
		
		foreach ( $project_member as $tem ) {
			
			$result2 = $db->InsertData ( "project_member", $tem );
		}
		$db->Close ();
	}
	function findproject_member ( $project_id ){
		$db = new DB ();
		// 参数分别是： 主键值 数据库表明 主键名
		$result = $db->GetInfo1 ( $project_id, 'project_member', 'project_id' );
		$appJSON = array (
				// 少两个 流动资金 和固定资金
				'name' => $result ['name'],
				'sex' => $result ['sex'],
				'age' => $result ['age'],
				'job' => $result ['job'],
				'org' => $result ['org'],
				'mission' => $result ['mission'],
				'major' => $result ['major']
		)
		;
		echo json_encode ( $appJSON );
		$db->close ();
	}
}
?>