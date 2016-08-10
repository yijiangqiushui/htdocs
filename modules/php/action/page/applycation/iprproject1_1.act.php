<?php
use Zend\Form\Element\Submit;

include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/iprproject1_1.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET ['action'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

// 申请单位基本信息s
// project_id and org_id
$project_id = $_SESSION ['project_id'];
// $project_id = '121212';
$org_code = $_SESSION ['org_code'];
// $org_code = '01234567';

/* iprproject1_1/org_info.php */
$org_info ['org_code'] = $org_code;
$org_info ['org_name'] = $_POST ['org_name'];
$org_info ['register_time'] = $_POST ['register_time'];
$org_info ['contact_address'] = $_POST ['contact_address'];
$org_info ['postal'] = $_POST ['postal'];
$org_info ['email'] = $_POST ['email'];
$org_info ['linkman'] = $_POST ['linkman'];
$org_info ['phone'] = $_POST ['phone'];
$org_info ['fax'] = $_POST ['fax'];
$org_info ['org_bank'] = $_POST ['org_bank'];
$org_info ['account'] = $_POST ['account'];
$org_info ['credit_rate'] = $_POST ['credit_rate:'];
$org_info ['org_type'] = $_POST ['org_type'];
$org_info ['feature'] = $_POST ['feature'];
$org_info ['org_trade'] = $_POST ['org_trade'];
$org_info ['register_fund'] = $_POST ['register_fund'];
$org_info ['local_foreign'] = $_POST ['local_foreign'];

$staff_info ['staff_num'] = $_POST ['staff_num'];
$staff_info ['junior'] = $_POST ['junior'];
$staff_info ['researcher_num'] = $_POST ['researcher_num'];

$project_patent ['patent_num'] = $_POST ['patent_num'];
$project_patent ['invent_num'] = $_POST ['invent_num'];

$profit_tax ['last_totalincome'] = $_POST ['last_totalincome'];
$profit_tax ['last_totalprofit'] = $_POST ['last_totalprofit'];
$profit_tax ['last_industryval'] = $_POST ['last_industryval'];
$profit_tax ['last_industrytax'] = $_POST ['last_industrytax'];
$profit_tax ['last_industryadd'] = $_POST ['last_industryadd'];
$profit_tax ['last_industrycreative'] = $_POST ['last_industrycreative'];
$profit_tax ['last_productsale'] = $_POST ['last_productsale'];
$profit_tax ['last_techexpend'] = $_POST ['last_techexpend'];

// 不能传递
$main_product = ( array ) $_POST ['main_product'];
$sale_ratio = ( array ) $_POST ['sale_ratio'];
// 遍历 取值
$length = 0;
foreach ( $main_product as $val ) {
	$org_product [$length] ['org_code'] = $org_code;
	$org_product [$length] ['main_product'] = $main_product [$key];
	$org_product [$length] ['sale_ratio'] = $sale_ratio [$key];
	$length = $length + 1;
}

$egal_person ['legal_name'] = $_POST ['legal_name'];
$egal_person ['legal_sex'] = $_POST ['legal_sex'];
$egal_person ['legal_birth'] = $_POST ['legal_birth'];
$egal_person ['legal_edu'] = $_POST ['legal_edu'];
$egal_person ['legal_time'] = $_POST ['legal_time'];
$egal_person ['legal_phone'] = $_POST ['legal_phone'];

/* iprproject1_1/project_info.php ********************************************************** */
$project_info ['project_name'] = $_POST ['project_name'];
$project_info ['planfinish_time'] = $_POST ['planfinish_time'];
$project_info ['tech_area'] = $_POST ['tech_area'];
$project_info ['tech_level'] = $_POST ['tech_level'];
$project_info ['project_stage'] = $_POST ['project_stage'];
$project_info ['project_advantage'] = $_POST ['project_advantage'];
$project_info ['coproject_summary'] = $_POST ['coproject_summary'];

// 上一年度指标
$last_target ['employ_num'] = $_POST ['last_employ_num'];
$last_target ['year_profit'] = $_POST ['last_year_profit'];
$last_target ['industry_num'] = $_POST ['last_industry_num'];
$last_target ['tax_sum'] = $_POST ['last_tax_sum'];
$last_target ['industry_add'] = $_POST ['last_industry_add'];
$last_target ['sell_sum'] = $_POST ['last_sell_sum'];
$last_target ['market_share'] = $_POST ['last_market_share'];
// 项目计划完成时年度指标
$finish_target ['employ_num'] = $_POST ['employ_num'];
$finish_target ['year_profit'] = $_POST ['year_profit'];
$finish_target ['industry_num'] = $_POST ['industry_num'];
$finish_target ['tax_sum'] = $_POST ['tax_sum'];
$finish_target ['industry_add'] = $_POST ['industry_add'];
$finish_target ['sell_sum'] = $_POST ['sell_sum'];
$finish_target ['market_share'] = $_POST ['market_share'];

// 项目负责人
$project_principle ['leader_name'] = $_POST ['leader_name'];
$project_principle ['leader_sex'] = $_POST ['leader_sex'];
$project_principle ['leader_birth'] = $_POST ['leader_birth'];
$project_principle ['leader_edu'] = $_POST ['leader_edu'];

// 项目专利情况 project_patent
$project_patent ['patent_num'] = $_POST ['patent_num'];
$project_patent ['invent_num'] = $_POST ['invent_num'];
$project_patent ['function_patent'] = $_POST ['function_patent'];
$project_patent ['patent_design'] = $_POST ['patent_design'];

// 专利列表
$patent_name = ( array ) $_POST ['patent_name'];
$patent_code = ( array ) $_POST ['patent_code'];

$length = 0;
foreach ( $patent_name as $val ) {
	$patent_list [$length] ['project_id'] = $project_id;
	$patent_list [$length] ['patent_name'] = $patent_name [$length];
	$patent_list [$length] ['patent_code'] = $patent_code [$length];
	$length = $length + 1;
}

/* project_fund.php 表格的数据 ****************************************************** */

// 经费总额
$poj_fund = ( array ) $_POST ['project_fund'];
$length = 0;
foreach ( $poj_fund as $val ) {
	$project_info [$length] ['project_id'] = $project_id;
	$project_info [$length] ['project_fund'] = $poj_fund [$length];
	$length = $length + 1;
}

// 这个 插入的时候 会分年呢 区财政科技经费总额
$tal = ( array ) $_POST ['area_teach_total'];
$length = 0;
foreach ( $poj_fund as $val ) {
	$area_teach_total [$length] ['project_id'] = $project_id;
	$area_teach_total [$length] ['area_teach_total'] = $tal [$length];
	$length = $length + 1;
}

$f_o_f = ( array ) $_POST ['first_other_fund'];
$s_o_f = ( array ) $_POST ['second_other_fund'];
$t_o_f = ( array ) $_POST ['third_other_fund'];
$length = 0;
foreach ( $f_o_f as $val ) {
	
	$fund_src_first [$length] ['other_fund'] = $f_o_f [$length];
	$fund_src_second [$length] ['other_fund'] = $s_o_f [$length];
	$fund_src_third [$length] ['other_fund'] = $t_o_f [$length];
	$length = $length + 1;
}

// 项目经费支出
$f_t = ( array ) $_POST ['first_teach'];
$s_t = ( array ) $_POST ['second_teach'];
$t_t = ( array ) $_POST ['third_teach'];
$f_o = ( array ) $_POST ['first_other'];
$s_o = ( array ) $_POST ['second_other'];
$t_o = ( array ) $_POST ['third_other'];
$length = 0;
foreach ( $f_o_f as $val ) {
	$first_teach [$length] ['total_fund'] = $f_t [$length];
	$second_teach [$length] ['project_id'] = $project_id;
	$second_teach [$length] ['total_fund'] = $s_t [$length];
	$third_teach [$length] ['total_fund'] = $t_t [$length];
	
	$first_other [$length] ['total_fund'] = $f_o [$length];
	$second_other [$length] ['total_fund'] = $s_o [$length];
	$third_other [$length] ['total_fund'] = $t_o [$length];
	$length = $length + 1;
}


$apply = new APPLY ();
switch ($action) {
	case 'org_info' :
		$apply->org_info ( $org_product, $org_info, $staff_info, $project_patent, $profit_tax, $egal_person, $org_code, $project_id );
		break;
	case 'project_info' :
		$apply->project_info ( $project_info, $project_principle, $project_patent, $patent_list, $last_target, $finish_target, $org_code, $project_id );
		break;
	case 'findorg_info' :
		$apply->findorg_info ( $org_code, $project_id );
		break;
	case 'findproject_info' :
		$apply->findproject_info ( $org_code, $project_id );
		break;
	case 'project_fund' :
		$apply->project_fund ( $project_info, $area_teach_total, $fund_src_first, $fund_src_second, $fund_src_third, $first_teach, $second_teach, $third_teach, $first_other, $second_other, $third_other, $project_id );
		break;
	case 'findproject_fund' :
		$apply->findproject_fund ( $project_id );
		break;
	
	default :
		;
}
?>