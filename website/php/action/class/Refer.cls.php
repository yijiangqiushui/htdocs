<?php
/**
 author:Gao Xue
 date:2014-07-07
 */
class REFER {
	function commitRec($id, $flag) {
		$db = new DB ();
		if ($flag != '0') {
			$sql = 'update application set isRefer=1,proState=0 where id= ' . $id;
		} else {
			if ($_SESSION ['app_id'] != '' && $_SESSION ['app_id'] != null) {
				$sql = 'update application set isRefer=1,proState=0 where id= ' . $_SESSION ['app_id'];
			}
		}
		$result = $db->Update ( $sql );
		echo $result;
		$db->close ();
	}
}
?>