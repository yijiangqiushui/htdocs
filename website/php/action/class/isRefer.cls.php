<?php
/**
 author:Gao Xue
 date:2014-06-16
 */
class ISREFER {
	function queryRefer() {
		$db = new DB ();
		global $page;
		global $rows;
		
		$page = ($page - 1) * $rows;
		
		$sql = 'select * from application where isRefer=1 and org_id=' . $_SESSION ['org_id'] . ' ORDER BY id DESC';
		$sqlCount = 'select count(id) as "count" from  application where isRefer=1 and org_id=' . $_SESSION ['org_id'] . ' ORDER BY id DESC';
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		
		$result = $db->Select ( $sql );
		$resCount = $db->Select ( $sqlCount );
		$count = $resCount [0] ['count'];
		
		if (count ( $result ) === 0) {
			$applyJSON = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $result ); $i ++) {
				$sqlSel = 'select * from recommend_org where id=' . $result [$i] ['rec_org'];
				$res = $db->Select ( $sqlSel );
				$arr [$i] = array (
						'id' => $result [$i] ['id'],
						'aname' => $result [$i] ['aname'],
						'impPerson' => $result [$i] ['impPerson'],
						'completeOrg' => $result [$i] ['completeOrg'],
						'completePhone' => $result [$i] ['completePhone'],
						'recOrg' => $res [0] ['name'],
						'recPhone' => $res [0] ['tel'],
						'planID' => $result [$i] ['planID'],
						'proStart' => $result [$i] ['proStart'],
						'proEnd' => $result [$i] ['proEnd'] 
				);
			}
			$applyJSON = '{"total":' . $count . ',"rows":' . json_encode ( $arr ) . '}';
		}
		echo $applyJSON;
		$db->Close ();
	}
}
?>