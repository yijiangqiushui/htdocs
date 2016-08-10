<?php
require_once __DIR__ . '/pdf.php';

// require_once '../../modules/php/action/page/applycation/apply9.act.php';
require_once '../../modules/php/action/class/applycation/apply2.cls.php';
require_once '../../modules/php/action/class/projectapp/projectapp.cls.php';
require_once '../../common/php/config.ini.php';
require_once '../../common/php/lib/db.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$apply = new APPLY ();
$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];
//org_info 
$org_info=$apply->find2OrgInfo ( $org_code,"pdf" );
$coorg_info=$apply->find2CoorgInfo ( $org_code,"pdf" );
$coor_info_rep= array(
		'coorg_name' => $coorg_info ['coorg_name'],
		'coorg_code' => $coorg_info ['coorg_code'],
		'co_register_fund' => $coorg_info ['register_fund'],//
		'co_register_address' => $coorg_info ['register_address'],//
		'co_org_type' => $coorg_info ['org_type'],//
		'co_contact_address' => $coorg_info ['contact_address'],//
		'co_postal' => $coorg_info ['postal'],//
		'co_linkman' => $coorg_info ['linkman'],//
		'co_linkman_email' => $coorg_info ['linkman_email'],//
		'co_linkman_contact' => $coorg_info ['linkman_contact'],//
		'co_coorg_summary' => $coorg_info ['coorg_summary'],//
		
		'co_legal_name' => $coorg_info ['legal_name'],//
		'co_legal_id' => $coorg_info ['legal_id'],//
		'co_legal_phone' => $coorg_info ['legal_phone'],//
		
		'co_patent_num' => $coorg_info ['patent_num'],//
		'co_invent_patent' => $coorg_info ['invent_patent'],//
		'co_functional_patent' => $coorg_info ['functional_patent'],//
		'co_patent_design' => $coorg_info ['patent_design'],//
		'co_other_patent' => $coorg_info ['other_patent']//
		
);
$arr1=array_merge($org_info,$coor_info_rep);
$project_info=$apply->find2ProInfo ( $project_id,"pdf" );
// print_r($project_info);
$arr2=array_merge($arr1,$project_info);
//approve
$ProjectApp = new ProjectApp ();
$approve=$ProjectApp->findOpin (  $project_id, 'project_info', 'project_id',"pdf" );
// print_r(array_merge($arr1,$findman_state));
// array_merge($a1,$a2) 合并数组
datatopdf('attach2',array_merge($arr2,$approve));