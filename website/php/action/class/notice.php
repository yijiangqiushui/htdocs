<?php
class Notice {
	public function get_detail($id) {
		$db = new DB ();
		$sql = 'select * from contentinfo where id=' . $id;
		$result = $db->Select ( $sql );
		$res = '{id:' . $result [0] ['id'] . ',title:"' . $result [0] ['title'] . '",content:"' . $result [0] ['content'] . '",add_time:"' . $result [0] ['add_time'] . '"';
		
		$sqlAttach = 'select * from attachment where content_id=' . $id;
		$resAttach = $db->Select ( $sqlAttach );
		
		if (count ( $resAttach ) != '0') {
			for($i = 0; $i < count ( $resAttach ); $i ++) {
				if ($i == count ( $resAttach ) - 1) {
					$attach .= 'attach:"' . $resAttach [$i] ['file_path'] . '"';
				} else {
					$attach .= 'attach:"' . $resAttach [$i] ['file_path'] . '",';
				}
			}
		} else {
			$attach .= 'attach:""';
		}
		$res .= ',' . $attach . '}';
		
		return $res;
	}
	public function get_recommend() {
		$db = new DB ();
		$sql = 'select * from contentinfo limit 0,9';
		$result = $db->Select ( $sql );
		return $result;
	}
	public function get_list($page, $size) {
		$page = ($page - 1) * $size;
		$db = new DB ();
		$sql = 'select * from contentinfo';
		$sql = $sql . ' limit ' . $page . ',' . $size;
		$result = $db->Select ( $sql );
		return $result;
	}
	public function get_total() {
		$db = new DB ();
		$sql = 'select count(*) as count from contentinfo';
		$result = $db->Select ( $sql );
		return $result [0] ['count'];
	}
	public function downFile($attach) {
		$attach = '../../../..' . $attach;
		if (empty ( $attach )) {
			echo '非法链接';
		} else {
			$file_arr = explode ( "/", $attach );
			$file_name = $file_arr [sizeof ( $file_arr ) - 1];
			if (! file_exists ( $attach )) {
				echo '文件找不到';
				exit ();
			} else {
				$file = fopen ( $attach, "r" );
				header ( "Content-type:application/octet-stream" );
				header ( "Accept-Ranges: bytes" );
				header ( "Accept-Length:" . filesize ( $attach ) );
				header ( "Content-Disposition: attachment; filename=" . $file_name );
				echo fread ( $file, filesize ( $attach ) );
				fclose ( $file );
				exit ();
			}
		}
	}
}
?>