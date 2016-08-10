<?php
include '../../class/applycation/util.php';
class APPLY {
	function project_info($project_info, $project_principle, $project_patent, $patent_list, $last_target, $finish_target, $org_code, $project_id) {
		$db = new DB ();
		
		$result = $db->UpdateTabData ( 'last_target', $project_id, $last_target, 'project_id' );
		$result0 = $db->UpdateTabData ( 'finish_target', $project_id, $finish_target, 'project_id' );
		$result1 = $db->UpdateTabData ( 'project_info', $project_id, $project_info, 'project_id' );
		$result2 = $db->UpdateTabData ( 'project_principal', $project_id, $project_principle, 'project_id' );
		$result3 = $db->UpdateTabData ( 'project_patent', $project_id, $project_patent, 'project_id' );
		$result4 = $db->Delete ( "delete from patent_list where project_id=$project_id " );
		echo "delete from patent_list where project_id=" + $project_id;
		foreach ( $patent_list as $tem ) {
			$result5 = $db->InsertData ( "patent_list", $tem );
		}
		
		$db->Close ();
	}
	function org_info($org_product, $org_info, $staff_info, $project_patent, $profit_tax, $legal_person, $org_code, $project_id) {
		$db = new DB ();
		// 更新（添加） 主要产品 和所占比例
		
		$db->Delete ( "delete from org_product where org_code=$org_code" );
		foreach ( $org_product as $tem ) {
			$result0 = $db->InsertData ( 'org_product', $tem );
		}
		$result1 = $db->UpdateTabData ( 'org_info', $org_code, $org_info, 'org_code' );
		$result2 = $db->UpdateTabData ( 'staff_info', $org_code, $staff_info, 'staff_info' );
		$result3 = $db->UpdateTabData ( 'project_patent', $project_id, $project_patent, 'project_id' );
		$result4 = $db->UpdateTabData ( 'profit_tax', $org_code, $profit_tax, 'org_code' );
		$result5 = $db->UpdateTabData ( 'legal_person', $org_code, $legal_person, 'org_code' );
		$db->Close ();
	}
	function findorg_info($org_code, $project_id) {
		$db = new DB ();
		// 参数分别是： 主键值 数据库表明 主键名
		$result1 = $db->GetInfo1 ( $org_code, 'org_info', 'org_code' );
		$result2 = $db->GetInfo1 ( $org_code, 'staff_info', 'org_code' );
		$result3 = $db->GetInfo1 ( $org_code, 'project_patent', 'project_id' );
		$result4 = $db->GetInfo1 ( $org_code, 'profit_tax', 'org_code' );
		$result5 = $db->GetInfo1 ( $org_code, 'legal_person', 'org_code' );
		$result6 = $db->GetInfo1 ( $org_code, 'org_product', 'org_code' );
		// $result2 = $db->GetInfo1($org_code, 'shareholder_info', 'org_code');如果不是动态加载 就把结果从这里传过去 如果是那就在html页面直接加载
		$appJSON = array (
				'org_name' => $result1 ['org_name'],
				'org_name' => $result1 ['org_name'],
				'register_time' => $result1 ['register_time'],
				'contact_address' => $result1 ['contact_address'],
				'postal' => $result1 ['postal'],
				'email' => $result1 ['email'],
				'org_code' => $result1 ['org_code'],
				'linkman' => $result1 ['linkman'],
				'phone' => $result1 ['phone'],
				'fax' => $result1 ['fax'],
				'org_bank' => $result1 ['org_bank'],
				'account' => $result1 ['account'],
				'credit_rate' => $result1 ['credit_rate'],
				'org_type' => $result1 ['org_type'],
				'feature' => $result1 ['feature'],
				'org_trade' => $result1 ['org_trade'],
				'register_fund' => $result1 ['register_fund'],
				'local_foreign' => $result1 ['local_foreign'],
				
				'legal_name' => $result5 ['legal_name'],
				'legal_sex' => $result5 ['legal_sex'],
				'legal_birth' => $result5 ['legal_birth'],
				'legal_edu' => $result5 ['legal_edu'],
				'legal_phone' => $result5 ['legal_phone'],
				'legal_time' => $result5 ['legal_time'],
				
				'staff_num' => $result2 ['staff_num'],
				'junior' => $result2 ['junior'],
				'researcher_num' => $result2 ['researcher_num'],
				
				'junior' => $result3 ['invent_num'],
				'researcher_num' => $result3 ['patent_num'],
				
				'last_totalincome' => $result3 ['last_totalincome'],
				'last_totalprofit' => $result3 ['last_totalprofit'],
				'last_industryval' => $result3 ['last_industryval'],
				'last_industrytax' => $result3 ['last_industrytax'],
				'last_industryadd' => $result3 ['last_industryadd'],
				'last_industrycreative' => $result3 ['last_industrycreative'],
				'last_productsale' => $result3 ['last_productsale'],
				'last_techexpend' => $result3 ['last_techexpend'] 
		);
		
		echo json_encode ( $appJSON );
		$db->close ();
	}
	function findproject_info($org_code, $project_id) {
		$db = new DB ();
		// 参数分别是： 主键值 数据库表明 主键名
		$result1 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
		$result2 = $db->GetInfo1 ( $project_id, 'project_principal', 'project_id' );
		$result3 = $db->GetInfo1 ( $project_id, 'project_patent', 'project_id' );
		$result4 = $db->GetInfo1 ( $project_id, 'finish_target', 'project_id' );
		$result5 = $db->GetInfo1 ( $project_id, 'last_target', 'project_id' );
		
		$appJSON = array (
				'project_name' => $result1 ['project_name'],
				'planfinish_time' => $result1 ['planfinish_time'],
				'tech_level' => $result1 ['tech_level'],
				'project_stage' => $result1 ['project_stage'],
				'project_advantage' => $result1 ['project_advantage'],
				'coproject_summary' => $result1 ['coproject_summary'],
				'planfinish_time' => $result1 ['planfinish_time'],
				'planfinish_time' => $result1 ['planfinish_time'],
				
				'leader_name' => $result2 ['leader_name'],
				'leader_sex' => $result2 ['leader_sex'],
				'leader_birth' => $result2 ['leader_birth'],
				'leader_edu' => $result2 ['leader_edu'],
				'planfinish_time' => $result2 ['planfinish_time'],
				'planfinish_time' => $result2 ['planfinish_time'],
				'planfinish_time' => $result2 ['planfinish_time'],
				
				'patent_num' => $result3 ['patent_num'],
				'invent_num' => $result3 ['invent_num'],
				'function_patent' => $result3 ['function_patent'],
				'patent_design' => $result3 ['patent_design'],
				
				// 上一年度的指标
				'last_employ_num' => $result5 ['employ_num'],
				'last_year_profit' => $result5 ['year_profit'],
				'last_industry_num' => $result5 ['industry_num'],
				'last_tax_sum' => $result5 ['tax_sum'],
				'last_industry_add' => $result5 ['industry_add'],
				'last_foreign_tax' => $result5 ['foreign_tax'],
				'last_sell_sum' => $result5 ['sell_sum'],
				'last_market_share' => $result5 ['market_share'],
				
				// 项目完成指标?
				'employ_num' => $result4 ['employ_num'],
				'year_profit' => $result4 ['year_profit'],
				'industry_num' => $result4 ['industry_num'],
				'tax_sum' => $result4 ['tax_sum'],
				'industry_add' => $result4 ['industry_add'],
				'foreign_tax' => $result4 ['foreign_tax'],
				'sell_sum' => $result4 ['sell_sum'],
				'market_share' => $result4 ['market_share'] 
		);
		echo json_encode ( $appJSON );
		$db->close ();
	}
	function project_fund($project_info, $area_teach_total, $fund_src_first, $fund_src_second, $fund_src_third, $first_teach, $second_teach, $third_teach, $first_other, $second_other, $third_other, $project_id) {
		$db = new DB ();
		
		$result = $db->UpdateTabData2 ( 'project_info', $project_id, $project_info, 'project_id', util::get_YEAR ( - 2 ), 'year' );
		$result = $db->UpdateTabData2 ( 'project_info', $project_id, $project_info, 'project_id', util::get_YEAR ( - 1 ), 'year' );
		$result = $db->UpdateTabData2 ( 'project_info', $project_id, $project_info, 'project_id', util::get_YEAR ( 0 ), 'year' );
		
		$result = $db->UpdateTabData2 ( 'fund_src', $project_id, $area_teach_total, 'project_id', util::get_YEAR ( - 2 ), 'year' );
		$result = $db->UpdateTabData2 ( 'fund_src', $project_id, $area_teach_total, 'project_id', util::get_YEAR ( - 1 ), 'year' );
		$result = $db->UpdateTabData2 ( 'fund_src', $project_id, $area_teach_total, 'project_id', util::get_YEAR ( 0 ), 'year' );
		
		// fund_src 项目经费来源
		// echo util::getparam ( $fund_src_first );
		$result = $db->UpdateTabData2 ( 'fund_src', $project_id, util::getparam ( $fund_src_first ), 'project_id', util::get_YEAR ( - 2 ), 'year' );
		$result = $db->UpdateTabData2 ( 'fund_src', $project_id, util::getparam ( $fund_src_first ), 'project_id', util::get_YEAR ( - 1 ), 'year' );
		$result = $db->UpdateTabData2 ( 'fund_src', $project_id, util::getparam ( $fund_src_first ), 'project_id', util::get_YEAR ( - 0 ), 'year' );
		print_r ( util::getparam ( $first_teach ) );
		
		// project_fund_tech
		$result = $db->UpdateTabData2 ( 'project_fund_tech', $project_id, util::getparam ( $first_teach ), 'project_id', util::get_YEAR ( - 2 ), 'year' );
		$result = $db->UpdateTabData2 ( 'project_fund_tech', $project_id, util::getparam ( $second_teach ), 'project_id', util::get_YEAR ( - 1 ), 'year' );
		$result = $db->UpdateTabData2 ( 'project_fund_tech', $project_id, util::getparam ( $third_teach ), 'project_id', util::get_YEAR ( - 0 ), 'year' );
		$result = $db->UpdateTabData2 ( 'project_fund_other', $project_id, util::getparam ( $first_other ), 'project_id', util::get_YEAR ( - 2 ), 'year' );
		$result = $db->UpdateTabData2 ( 'project_fund_other', $project_id, util::getparam ( $second_other ), 'project_id', util::get_YEAR ( - 1 ), 'year' );
		$result = $db->UpdateTabData2 ( 'project_fund_other', $project_id, util::getparam ( $third_other ), 'project_id', util::get_YEAR ( 0 ), 'year' );
		$db->Close ();
	}
	// 回显
	function findproject_fund($project_id) {
		$db = new DB ();
		$appJSON = array ();
		for($i = 2; $i >= 0; $i --) { // 2-$i 0 1 2
			$result1 = $db->GetInfo2 ( $project_id, 'project_info', 'project_id', util::get_YEAR ( - $i ), 'year' );
			$appJSON ['project_fund[' .( 2 - $i) . ']'] = $result1 ['project_fund'];
			$result2 = $db->GetInfo2 ( $project_id, 'fund_src', 'project_id', util::get_YEAR ( - $i ), 'year' );
			$appJSON ['area_teach_total[' . ( 2 - $i) . ']'] = $result1 ['area_teach_total'];
		}
		
		$result3 = $db->GetInfo2 ( $project_id, 'fund_src', 'project_id', util::get_YEAR ( - 2 ), 'year' );
		$result4 = $db->GetInfo2 ( $project_id, 'project_fund_tech', 'project_id', util::get_YEAR ( - 2 ), 'year' );
		$result5 = $db->GetInfo2 ( $project_id, 'project_fund_other', 'project_id', util::get_YEAR ( - 2 ), 'year' );
		$length = 0;
		foreach ( util::str2arr ( $result3 ['other_fund'] ) as $val ) {
			$appJSON ['first_other_fund[' . $length . ']'] = $val;
			$length ++;
		}
		
		$length = 0;
		foreach ( util::str2arr ( $result4 ['total_fund'] ) as $val ) {
			$appJSON ['first_teach[' . $length . ']'] = $val;
			$length ++;
		}
		
		$length = 0;
		foreach ( util::str2arr ( $result5 ['total_fund'] ) as $val ) {
			$appJSON ['first_other[' . $length . ']'] = $val;
			$length ++;
		}
		
		$result3 = $db->GetInfo2 ( $project_id, 'fund_src', 'project_id', util::get_YEAR ( - 1 ), 'year' );
		$result4 = $db->GetInfo2 ( $project_id, 'project_fund_tech', 'project_id', util::get_YEAR ( - 1 ), 'year' );
		$result5 = $db->GetInfo2 ( $project_id, 'project_fund_other', 'project_id', util::get_YEAR ( - 1 ), 'year' );
		$length = 0;
		foreach ( util::str2arr ( $result3 ['other_fund'] ) as $val ) {
			$appJSON ['second_other_fund[' . $length . ']'] = $val;
			$length ++;
		}
		
		$length = 0;
		foreach ( util::str2arr ( $result4 ['total_fund'] ) as $val ) {
			$appJSON ['second_teach[' . $length . ']'] = $val;
			$length ++;
		}
		
		$length = 0;
		foreach ( util::str2arr ( $result5 ['total_fund'] ) as $val ) {
			$appJSON ['first_other[' . $length . ']'] = $val;
			$length ++;
		}
		
		$result3 = $db->GetInfo2 ( $project_id, 'fund_src', 'project_id', util::get_YEAR ( 0 ), 'year' );
		$result4 = $db->GetInfo2 ( $project_id, 'project_fund_tech', 'project_id', util::get_YEAR ( 0 ), 'year' );
		$result5 = $db->GetInfo2 ( $project_id, 'project_fund_other', 'project_id', util::get_YEAR ( 0 ), 'year' );
		$length = 0;
		foreach ( util::str2arr ( $result3 ['other_fund'] ) as $val ) {
			$appJSON ['third_other_fund[' . $length . ']'] = $val;
			$length ++;
		}
		$length = 0;
		foreach ( util::str2arr ( $result4 ['total_fund'] ) as $val ) {
			$appJSON ['third_teach[' . $length . ']'] = $val;
			$length ++;
		}
		
		$length = 0;
		foreach ( util::str2arr ( $result5 ['total_fund'] ) as $val ) {
			$appJSON ['third_other[' . $length . ']'] = $val;
			$length ++;
		}
		echo json_encode ( $appJSON );
		$db->Close ();
	}
}
?>