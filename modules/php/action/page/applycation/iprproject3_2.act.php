<?php
use Zend\Form\Element\Submit;
/**
 * author:Gao Xue
 * date:2014-05-23
 */

include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/iprproject3_2.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET ['action'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

// 申请单位基本信息s
// project_id and org_id
// $project_id = $_SESSION['project_id'];
$project_id = '121212';
// $org_code = $_SESSION['org_code'];
$org_code = '01234567';

//
$project_expect ["project_expect"] = $_POST ['project_expect'];
//project_fund 的参数
$project_expectss ['aaa'] = $_POST ['xxx'];
$apply = new APPLY ();
switch ($action) {
	case 'project_expect' :
		$apply->project_expect ( $project_expect, $project_id );
		break;
		case 'findproject_expect':
			$apply->findproject_expect ( $project_id );
			break;
	case 'project_fund' :
		$apply->project_fund ( $project_expect, $project_id );
		break;

	default :
		;
}
?>							