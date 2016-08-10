<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/apply3.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET ['action'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

$project_id = $_SESSION ['project_id'];
// $project_id = '012';
$org_code = $_SESSION ['org_code'];
// $org_code = '012';
/* org_info 附件3 */
$org3_info ['org_code'] = $org_code;
$org3_info ['org_name'] = $_POST ['org_name'];
$org3_info ['register_fund'] = $_POST ['register_fund'];
$org3_info ['register_address'] = $_POST ['register_address'];
$org3_info ['org_type'] = $_POST ['org_type'];
$org3_info ['contact_address'] = $_POST ['contact_address'];
$org3_info ['postal'] = $_POST ['postal'];
$org3_info ['linkman'] = $_POST ['linkman'];
$org3_info ['linkman_email'] = $_POST ['linkman_email'];
$org3_info ['linkman_contact'] = $_POST ['linkman_contact'];
$org3_info ['listed'] = $_POST ['listed'];
$org3_info ['listed_code'] = $_POST ['listed_code'];
$org3_info ['org_trade'] = $_POST ['org_trade'];
$org3_info ['main_product'] = $_POST ['main_product'];
/*
 * $org3_info ['linkman'] = $_POST ['linkman'];
$org3_info ['linkman_email'] = $_POST ['linkman_email'];
$org3_info ['linkman_contact'] = $_POST ['linkman_contact'];
 *   */

$linkmanInfo["linkman"]= $_POST ['linkman'];
$linkmanInfo["linkman_email"]= $_POST ['linkman_email'];
$linkmanInfo["linkman_contact"]= $_POST ['linkman_contact'];

$org3_legal ['org_code'] = $org_code;
$org3_legal ['legal_name'] = $_POST ['legal_name'];
$org3_legal ['legal_id'] = $_POST ['legal_id'];
$org3_legal ['legal_phone'] = $_POST ['legal_phone'];

$org3_patent ['org_code'] = $org_code;
$org3_patent ['patent_num'] = $_POST ['patent_num'];
$org3_patent ['invent_patent'] = $_POST ['invent_patent'];
$org3_patent ['functional_patent'] = $_POST ['functional_patent'];
$org3_patent ['patent_design'] = $_POST ['patent_design'];
$org3_patent ['other_patent'] = $_POST ['other_patent'];

$org3_staff ['org_code'] = $org_code;
$org3_staff ['staff_num'] = $_POST ['staff_num'];
$org3_staff ['junior'] = $_POST ['junior'];
$org3_staff ['researcher_num'] = $_POST ['researcher_num'];

$org3_profit ['org_code'] = $org_code;
$org3_profit ['predict_tax'] = $_POST ['predict_tax'];
$org3_profit ['predict_inspectax'] = $_POST ['predict_inspectax'];
$org3_profit ['predict_profit'] = $_POST ['predict_profit'];
$org3_profit ['lasthalf_income'] = $_POST ['lasthalf_income'];
$org3_profit ['lasthalf_tax'] = $_POST ['lasthalf_tax'];
$org3_profit ['lasthalf_profit'] = $_POST ['lasthalf_profit'];

/* project_info 附件3 */
$project3_invest = array ();
$project3_info = array ();
$project3_info ['org_code'] = $org_code;
$project3_info ['project_id'] = $project_id;
$project3_info ['project_name'] = $_POST ['project_name'];
$project3_info ['project_place'] = $_POST ['project_place'];
$project3_info ['others_material'] = $_POST ['others_material'];
$project3_info ['tech_area'] = $_POST ['tech_area'];
$project3_info ['tech_level'] = $_POST ['tech_level'];
$project3_info ['coproject_summary'] = $_POST ['coproject_summary'];
$project3_info ['tech_achieve'] = $_POST ['tech_achieve'];
$project3_info ['social_benefit'] = $_POST ['social_benefit'];

$project3_invest ['project_id'] = $project_id;
$project3_invest ['invest_total'] = $_POST ['invest_total'];
$project3_invest ['invested'] = $_POST ['invested'];
$project3_invest ['fixed_invest'] = $_POST ['fixed_invest'];

$project3_profit1 ['project_id'] = $project_id;
$project3_profit1 ['year'] = 1;
$project3_profit1 ['output'] = $_POST ['output1'];
$project3_profit1 ['sale_income'] = $_POST ['sale_income1'];
$project3_profit1 ['tax'] = $_POST ['tax1'];
$project3_profit1 ['profit'] = $_POST ['profit1'];
$project3_profit1 ['foreign_income'] = $_POST ['foreign_income1'];
$project3_profit1 ['new_member'] = $_POST ['new_member1'];

$project3_profit2 ['project_id'] = $project_id;
$project3_profit2 ['year'] = 2;
$project3_profit2 ['output'] = $_POST ['output2'];
$project3_profit2 ['sale_income'] = $_POST ['sale_income2'];
$project3_profit2 ['tax'] = $_POST ['tax2'];
$project3_profit2 ['profit'] = $_POST ['profit2'];
$project3_profit2 ['foreign_income'] = $_POST ['foreign_income2'];
$project3_profit2 ['new_member'] = $_POST ['new_member2'];

$project3_profit3 ['project_id'] = $project_id;
$project3_profit3 ['year'] = 3;
$project3_profit3 ['output'] = $_POST ['output3'];
$project3_profit3 ['sale_income'] = $_POST ['sale_income3'];
$project3_profit3 ['tax'] = $_POST ['tax3'];
$project3_profit3 ['profit'] = $_POST ['profit3'];
$project3_profit3 ['foreign_income'] = $_POST ['foreign_income3'];
$project3_profit3 ['new_member'] = $_POST ['new_member3'];

/* project_info 动态列表部分 附件3 项目技术水平证明材料 */

$tech3_property = ( array ) $_POST ['intel_property'];
$tech3_type = ( array ) $_POST ['type'];
$tech3_code = ( array ) $_POST ['auth_code'];
$length1 = 0;
foreach ( $tech3_property as $val ) {
	$project3_material [$length1] ['intel_property'] = $tech3_property [$length1];
	$project3_material [$length1] ['type'] = $tech3_type [$length1];
	$project3_material [$length1] ['auth_code'] = $tech3_code [$length1];
	$project3_material [$length1] ['project_id'] = $project_id;
	$length1 ++;
}
// $length = 0;
// while (list ($key, $val) = each($tech3_property)) {
// $project3_material[$length]['project_id'] = $project_id;
// $project3_material[$length]['Intel_property'] = $tech3_property[$key];
// $project3_material[$length]['type'] = $tech3_type[$key];
// $project3_material[$length]['auth_code'] = $tech3_code[$key];
// $length = $length + 1;
// }

$apply = new APPLY ();
switch ($action) {
	case 'org3Info' :
		$apply->org3_info ( $org3_info, $org3_legal, $org3_patent, $org3_staff, $org3_profit, $org_code,$linkmanInfo,$project_id );
		break;
	case 'project3Info' :
		$apply->project3_info ( $project3_info, $project3_invest, $project3_material, $project3_profit1, $project3_profit2, $project3_profit3, $project_id );
		break;
	case 'find3OrgInfo' :
		$apply->find3OrgInfo ( $org_code,$project_id,"" );
		break;
	case 'find3ProInfo' :
		$apply->find3ProInfo ( $project_id ,"");
	default :
		;
}

?>