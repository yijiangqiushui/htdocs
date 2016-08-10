<?php
use Zend\Form\Element\Submit;
/**
 * author:Gao Xue
 * date:2014-05-23
 */

include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/iprproject1_2.cls.php';

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

/* iprproject1_1/org_info.php */
$name = ( array ) $_POST ['name'];
$length = 0;
foreach ( $name as $val ) {
	$material_list [$length] ['project_id'] = $project_id;
	$material_list [$length] ['name'] = $name [$length];
	$length = $length + 1;
}

/* 投资表 */
$project_invest ['invest_total'] = $_POST ['invest_total'];
$project_invest ['invested'] = $_POST ['invested'];
$project_invest ['invested_bank'] = $_POST ['invested_bank'];
$project_invest ['invested_gov'] = $_POST ['invested_gov'];

// 接受固定资产 还有 流动资金
$project_invest ['planadd_bank'] = $_POST ['planadd_bank'];
$project_invest ['planadd_gov'] = $_POST ['planadd_gov'];

$project_invest ['planadd'] = $_POST ['planadd'];
$project_invest ['planaddsrc_com'] = $_POST ['planaddsrc_com'];
$project_invest ['planaddsrc_bank'] = $_POST ['planaddsrc_bank'];
$project_invest ['planaddsrc_fin'] = $_POST ['planaddsrc_fin'];
$project_invest ['planaddsrc_finpat'] = $_POST ['planaddsrc_finpat'];
$project_invest ['planaddsrc_finother'] = $_POST ['planaddsrc_finother'];
$project_invest ['planaddsrc_other'] = $_POST ['planaddsrc_other'];
$project_invest ['patent_use'] = $_POST ['patent_use'];

// project_member
$name = ( array ) $_POST ['name'];
$sex = ( array ) $_POST ['sex'];
$age = ( array ) $_POST ['age'];
$job = ( array ) $_POST ['job'];
$major = ( array ) $_POST ['major'];
$org = ( array ) $_POST ['org'];
$mission = ( array ) $_POST ['mission'];
$length = 0;
foreach ( $name as $val ) {

	$project_member [$length] ['project_id'] = $project_id;
	$project_member [$length] ['name'] = $name [$length];
	$project_member [$length] ['sex'] = $sex [$length];
	$project_member [$length] ['age'] = $age [$length];
	$project_member [$length] ['job'] = $job [$length];
	$project_member [$length] ['org'] = $org [$length];
	$project_member [$length] ['mission'] = $mission [$length];
	$project_member [$length] ['major'] = $major [$length];
	$length = $length + 1;
}
$apply = new APPLY ();
switch ($action) {
	case 'material_list' :
		$apply->material_list ( $material_list, $project_id );
		break;
	case 'project_invest' :
		$apply->project_invest ( $project_invest, $project_id );
		break;
	case 'project_member' :
		$apply->project_member ( $project_member, $project_id );
		break;
	
	case 'findproject_invest' :
		$apply->findproject_invest ( $project_id );
		break;
		case 'findproject_member' :
			$apply->findproject_member ( $project_id );
			break;
	default :
		;
}
?>