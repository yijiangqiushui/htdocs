<?php

/**
 author:黎明
 date:2015-12-30
 */
class APPLY {
	function saveAbstract($project_id, $Abstract) {
		$db = new DB ();
		$db->updateInfo4 ( "patent_feasibility","project_id" , $project_id, $Abstract);
		$db->Close ();
	}
	function find_Abstract($project_id,$flag) {
		$db=new DB();
		$res=$db->GetInfo1($project_id, "patent_feasibility", "project_id");
		$retunArr=array(
				"project_summary"=>$res['project_summary'],
				"social_mean"=>$res['social_mean'],
				"advan_risks"=>$res['advan_risks'],
				"plan_target"=>$res['plan_target']
		);
		if($flag=="pdf"){
			$db->Close();
			return $retunArr;
		}
	  ob_clean();
	  echo json_encode($retunArr);
	  $db->Close();
	}
	
     function save_orginfo( $project_id,$org_info ){
     	$db = new DB ();
     	$db->updateInfo4 ( "patent_feasibility","project_id" , $project_id, $org_info);
     	$db->Close ();
     }
     
     function find_orginfo($project_id,$flag) {
     	$db=new DB();
     	$res=$db->GetInfo1($project_id, "patent_feasibility", "project_id");
     	$retunArr=array(
     			"org_info"=>$res['org_info'],
     	);
     	if($flag=="pdf"){
     		$db->Close();
     		return $retunArr;
     	}
     	ob_clean();
     	echo json_encode($retunArr);
     	$db->Close();
     }
     
     function save_techOrg( $project_id,$techOrg ){
     	$db = new DB ();
     	$db->updateInfo4 ( "patent_feasibility","project_id" , $project_id, $techOrg);
     	$db->Close ();
     }
     function find_techOrg($project_id,$flag) {
     	$db=new DB();
     	$res=$db->GetInfo1($project_id, "patent_feasibility", "project_id");
     	$retunArr=array(
     			"basic_principle"=>$res['basic_principle'],
     			"foreign_patents"=>$res['foreign_patents'],
     			"coop_org"=>$res['coop_org'],
     	);
     	if($flag=="pdf"){
     		$db->Close();
     		return $retunArr;
     	}
     	ob_clean();
     	echo json_encode($retunArr);
     	$db->Close();
     }
     function save_extent( $project_id,$project_extent ){
     	$db = new DB ();
     	$db->updateInfo4 ( "patent_feasibility","project_id" , $project_id, $project_extent);
     	$db->Close ();
     }
     function find_extent($project_id,$flag) {
     	$db=new DB();
     	$res=$db->GetInfo1($project_id, "patent_feasibility", "project_id");
     	$retunArr=array(
     			"patent_tort"=>$res['patent_tort'],
     			"results_ident"=>$res['results_ident'],
     			"quality_stable"=>$res['quality_stable'],
     	);
     	if($flag=="pdf"){
     		$db->Close();
     		return $retunArr;
     	}
     	ob_clean();
     	echo json_encode($retunArr);
     	$db->Close();
     }
     function save_market( $project_id,$project_extent ){
     	$db = new DB ();
     	$db->updateInfo4 ( "patent_feasibility","project_id" , $project_id, $project_extent);
     	$db->Close ();
     }
     function find_market($project_id,$flag) {
     	$db=new DB();
     	$res=$db->GetInfo1($project_id, "patent_feasibility", "project_id");
     	$retunArr=array(
     			"domestic_market"=>$res['domestic_market'],
     			"international_market"=>$res['international_market'],
     	);
     	if($flag=="pdf"){
     		$db->Close();
     		return $retunArr;
     	}
     	ob_clean();
     	echo json_encode($retunArr);
     	$db->Close();
     }
     function save_invest( $project_id,$project_extent ){
     	$db = new DB ();
     	$db->updateInfo4 ( "patent_feasibility","project_id" , $project_id, $project_extent);
     	$db->Close ();
     }
     function find_invest($project_id,$flag) {
     	$db=new DB();
     	$res=$db->GetInfo1($project_id, "patent_feasibility", "project_id");
     	$retunArr=array(
     			"invest_estimate"=>$res['invest_estimate'],
     			"financing_scheme"=>$res['financing_scheme'],
     			"invest_use_plan"=>$res['invest_use_plan'],
     	);
     	if($flag=="pdf"){
     		$db->Close();
     		return $retunArr;
     	}
     	ob_clean();
     	echo json_encode($retunArr);
     	$db->Close();
     }
     function save_economy( $project_id,$economy_profit ){
     	print_r($economy_profit);
     	$db = new DB ();
     	$db->updateInfo4 ( "patent_feasibility","project_id" , $project_id, $economy_profit);
     	$db->Close ();
     }
     function find_economy($project_id,$flag) {
     	$db=new DB();
     	$res=$db->GetInfo1($project_id, "patent_feasibility", "project_id");
     	$retunArr=array(
     			"thing_estimate"=>$res['thing_estimate'],
     			"financial_analysis"=>$res['financial_analysis'],
     			"un_analy"=>$res['un_analy'],
     			"finan_analy"=>$res['finan_analy'],
     			"social_results"=>$res['social_results']
     	);
     	if($flag=="pdf"){
     		$db->Close();
     		return $retunArr;
     	}
     	ob_clean();
     	echo json_encode($retunArr);
     	$db->Close();
     }
     function save_effect( $project_id,$project_effect ){
     	print_r($economy_profit);
     	$db = new DB ();
     	$db->updateInfo4 ( "patent_feasibility","project_id" , $project_id, $project_effect);
     	$db->Close ();
     }
     function find_effect($project_id,$flag) {
     	$db=new DB();
     	$res=$db->GetInfo1($project_id, "patent_feasibility", "project_id");
     	$retunArr=array(
     			"project_schedule"=>$res['project_schedule'],
     	);
     	if($flag=="pdf"){
     		$db->Close();
     		return $retunArr;
     	}
     	ob_clean();
     	echo json_encode($retunArr);
     	$db->Close();
     }
}

?>