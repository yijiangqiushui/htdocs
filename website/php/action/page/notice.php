<?php
include '../../../../common/php/config.ini.php';
include '../../../../center/php/config.ini.php';

include '../../../../common/php/lib/db.cls.php';

include '../class/notice.php';

{
	// $page=$_POST['page'];
	// $size=$_POST['size'];
	$notice = new Notice ();
	switch ($_GET ['action']) {
		case 'detail' :
			$result = $notice->get_detail ( intval ( $_POST ['id'] ) );
			echo $result;
			break;
		
		case 'list' :
			$result = $notice->get_list ( $_POST ['page'], $_POST ['size'] );
			for($i = 0; $i < sizeof ( $result ); $i ++) {
				$j = $i + 1;
				$htmlstr .= '<li><a href="notice.html?id=' . $result [$i] ['id'] . '" target="_blank">' . $j . '、' . $result [$i] ['title'] . $_POST ['page'] . '</a> ' . $result [$i] ['add_time'] . '</li>';
			}
			echo $htmlstr;
			break;
		case 'recommend' :
			$result = $notice->get_recommend ();
			for($i = 0; $i < sizeof ( $result ); $i ++) {
				$j = $i + 1;
				$htmlstr .= '<li><a href="notice.html?id=' . $result [$i] ['id'] . '" target="_blank">' . $j . '、' . $result [$i] ['title'] . $_POST ['page'] . '</a> ' . $result [$i] ['add_time'] . '</li>';
			}
			echo $htmlstr;
			break;
		case 'total' :
			$count = $notice->get_total ();
			echo $count;
			break;
		
		case 'downFile' :
			$notice->downFile ( $_GET ['attach'] );
			break;
		default :
			;
	}
}

?>