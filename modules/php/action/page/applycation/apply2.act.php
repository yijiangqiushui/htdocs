<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/apply2.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET ['action'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

$project_id = $_SESSION ['project_id'];
// echo $project_id;
// $project_id = '012';
$org_code = $_SESSION ['org_code'];

// $org_code = '012';

/* coorg_info 附件2 */
$coorg2_info ['org_code'] = $org_code;
$coorg2_info ['coorg_code'] = $_POST ['coorg_code'];
$coorg2_info ['coorg_name'] = $_POST ['coorg_name'];
$coorg2_info ['register_fund'] = $_POST ['register_fund'];
$coorg2_info ['register_address'] = $_POST ['register_address'];
$coorg2_info ['org_type'] = $_POST ['org_type'];
$coorg2_info ['contact_address'] = $_POST ['contact_address'];
$coorg2_info ['postal'] = $_POST ['postal'];
$coorg2_info ['linkman'] = $_POST ['linkman'];
$coorg2_info ['linkman_email'] = $_POST ['linkman_email'];
$coorg2_info ['linkman_contact'] = $_POST ['linkman_contact'];
$coorg2_info ['coorg_summary'] = $_POST ['coorg_summary'];

// $db = new DB();
// $sql = "select coorg_code from coorg_info where org_code='$org_code'";
// $reslut=$db->Select($sql);
// $coorg_code=$reslut[0][0];

$coorg2_legal ['org_code'] = $_POST ['coorg_code'];
$coorg2_legal ['legal_name'] = $_POST ['legal_name'];
$coorg2_legal ['legal_id'] = $_POST ['legal_id'];
$coorg2_legal ['legal_phone'] = $_POST ['legal_phone'];

$coorg2_patent ['org_code'] = $_POST ['coorg_code'];
$coorg2_patent ['patent_num'] = $_POST ['patent_num'];
$coorg2_patent ['invent_patent'] = $_POST ['invent_patent'];
$coorg2_patent ['functional_patent'] = $_POST ['functional_patent'];
$coorg2_patent ['patent_design'] = $_POST ['patent_design'];
$coorg2_patent ['other_patent'] = $_POST ['other_patent'];

/* org_info 附件2 */
$org2_info ['org_code'] = $org_code;
$org2_info ['org_name'] = $_POST ['org_name'];
$org2_info ['register_fund'] = $_POST ['register_fund'];
$org2_info ['register_address'] = $_POST ['register_address'];
$org2_info ['org_type'] = $_POST ['org_type'];
$org2_info ['contact_address'] = $_POST ['contact_address'];
$org2_info ['postal'] = $_POST ['postal'];
/* $org2_info ['linkman'] = $_POST ['linkman'];
$org2_info ['linkman_email'] = $_POST ['linkman_email'];
$org2_info ['linkman_contact'] = $_POST ['linkman_contact']; */
$org2_info ['listed'] = $_POST ['listed'];
$org2_info ['listed_code'] = $_POST ['listed_code'];
$org2_info ['org_trade'] = $_POST ['org_trade'];
$org2_info ['main_product'] = $_POST ['main_product'];

$linkmanInfo["linkman"]=$_POST ['linkman'];
$linkmanInfo["linkman_email"]=$_POST ['linkman_email'];
$linkmanInfo["linkman_contact"]=$_POST ['linkman_contact'];
$org2_legal ['org_code'] = $org_code;
$org2_legal ['legal_name'] = $_POST ['legal_name'];
$org2_legal ['legal_id'] = $_POST ['legal_id'];
$org2_legal ['legal_phone'] = $_POST ['legal_phone'];

$org2_patent ['org_code'] = $org_code;
$org2_patent ['patent_num'] = $_POST ['patent_num'];
$org2_patent ['invent_patent'] = $_POST ['invent_patent'];
$org2_patent ['functional_patent'] = $_POST ['functional_patent'];
$org2_patent ['patent_design'] = $_POST ['patent_design'];
$org2_patent ['other_patent'] = $_POST ['other_patent'];

$org2_staff ['org_code'] = $org_code;
$org2_staff ['staff_num'] = $_POST ['staff_num'];
$org2_staff ['junior'] = $_POST ['junior'];
$org2_staff ['researcher_num'] = $_POST ['researcher_num'];

$org2_profit ['org_code'] = $org_code;
$org2_profit ['predict_tax'] = $_POST ['predict_tax'];
$org2_profit ['predict_inspectax'] = $_POST ['predict_inspectax'];
$org2_profit ['predict_profit'] = $_POST ['predict_profit'];
$org2_profit ['lasthalf_income'] = $_POST ['lasthalf_income'];
$org2_profit ['lasthalf_tax'] = $_POST ['lasthalf_tax'];
$org2_profit ['lasthalf_profit'] = $_POST ['lasthalf_profit'];

/* project_info 附件2 */
$project2_info ['org_code'] = $org_code;
$project2_info ['project_id'] = $project_id;
$project2_info ['project_name'] = $_POST ['project_name'];
$project2_info ['project_place'] = $_POST ['project_place'];
$project2_info ['tech_area'] = $_POST ['tech_area'];
$project2_info ['tech_level'] = $_POST ['tech_level'];
$project2_info ['coproject_summary'] = $_POST ['coproject_summary'];
$project2_info ['tech_achieve'] = $_POST ['tech_achieve'];
$project2_info ['social_benefit'] = $_POST ['social_benefit'];
$project2_info ['others_material'] = $_POST ['others_material'];


$project2_invest ['project_id'] = $project_id;
$project2_invest ['invest_total'] = $_POST ['invest_total'];
$project2_invest ['invested'] = $_POST ['invested'];
$project2_invest ['fixed_invest'] = $_POST ['fixed_invest'];

$intel_property = ( array ) $_POST ['intel_property'];
$type = ( array ) $_POST ['type'];
$auth_code = ( array ) $_POST ['auth_code'];
$coount = 0;
foreach ( $intel_property as $val ) {
	$tech_material [$coount] ['project_id'] = $project_id;
	$tech_material [$coount] ['type'] = $type [$coount];
	$tech_material [$coount] ['intel_property'] = $intel_property [$coount];
	$tech_material [$coount] ['auth_code'] = $auth_code [$coount];
	$coount ++;
}
$tech_material[others]=$_POST['others'];

$apply = new APPLY ();
switch ($action) {
	case 'coorg2Info' :
		$apply->coorg2_info ( $coorg2_info, $project_id,$coorg2_legal, $coorg2_patent, $org_code, $_POST ['coorg_code'] );
		break;
	case 'org2Info' :
		$apply->org2_info ( $org2_info, $project_id,$org2_legal, $org2_patent, $org2_staff, $org2_profit, $org_code,$linkmanInfo );
		break;
	case 'project2Info' :
		$apply->project2_info ($project_id,$tech_material, $project2_info, $project2_invest, $project_id );
		break;
	case 'find2OrgInfo' :
		$apply->find2OrgInfo ( $org_code,$project_id,"" );
		break;
	case 'find2CoorgInfo' :
		$apply->find2CoorgInfo ( $org_code ,"");
		break;
	case 'find2ProInfo' :
		$apply->find2ProInfo ( $project_id,"" );
		break;
	
	default :
		;
}
?>