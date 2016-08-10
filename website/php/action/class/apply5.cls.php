<?php
// heyangyang
include '../../../../common/php/config.ini.php';
include '../../../../modules/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
class ApplicationAwardCls {
	public function addData($name, $obj) {
		$db = new DB ();
		$r = $db->InsertData ( $name, $obj );
		$db->Close ();
		return $r;
	}
	public function findbyid($id, $name) {
		$db = new DB ();
		$res = $db->GetInfo ( $id, $name );
		$db->Close ();
		return $res;
	}
	public function updateData($name, $obj, $id) {
		$db = new DB ();
		$db->UpdateData ( $name, $id, $obj );
		$db->Close ();
	}
	public function deleteData($name, $id) {
		$db = new DB ();
		$db->DelData ( $id, $name );
		$db->Close ();
	}
	public function deleteList($name, $idlist) {
		$db = new DB ();
		$db->DelArrIdData ( $idlist, $name );
		$db->Close ();
	}
	/**
	 * 根据sql条件查询
	 */
	/*
	 * public function pageListByCon($page,$rows,$count,$sql){
	 * $page=($page-1)*$rows;
	 * $db=new DB();
	 *
	 * $sql =$sql.' limit '.$page.','.$rows;
	 *
	 * $stuArr=$db->Select($sql);
	 *
	 * $db->Close();
	 * return $stuArr;
	 * }
	 */
	public function pageListByCon($page, $rows, $count, $sql) {
		$page = ($page - 1) * $rows;
		$db = new DB ();
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$stuArr = $db->Select ( $sql );
		$db->Close ();
		return $stuArr;
	}
	/**
	 * 获得满足条件的对象数量
	 */
	public function getCountByCon($sql) {
		$db = new DB ();
		
		$count = $db->Select ( $sql );
		$count = $count [0] ['count'];
		
		$db->Close ();
		return $count;
	}
	public function toJson($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'awardName' => $arr [$i] ['awardName'],
						'awardTime' => $arr [$i] ['awardTime'],
						'awardGrade' => $arr [$i] ['awardGrade'],
						'depart' => $arr [$i] ['depart'],
						'name' => $arr [$i] ['name'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	public function printAdward($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'awardName' => $arr [$i] ['awardName'],
						'awardTime' => $arr [$i] ['awardTime'],
						'awardGrade' => $arr [$i] ['awardGrade'],
						'depart' => $arr [$i] ['depart'],
						'name' => $arr [$i] ['name'] 
				);
			}
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	public function toJson2($obj) {
		$res = '{id:' . $obj ['id'] . ',awardName:"' . $obj ['awardName'] . '",awardTime:"' . $obj ['awardTime'] . '",awardGrade:"' . $obj ['awardGrade'] . '",depart:"' . $obj ['depart'] . '",name:"' . $obj ['name'] . '"}';
		return $res;
	}
}

?>