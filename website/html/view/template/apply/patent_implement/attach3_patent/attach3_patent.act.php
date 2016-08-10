<?php
include '../../../../../../../modules/php/action/class/projectapp/util.cls.php';
include '../../../../../../../common/php/config.ini.php';
include '../../../../../../../common/php/lib/db.cls.php';
include 'attach3_patent.cls.php';
include __DIR__ . '/../../../../../../../extends/common/common.php';


$project_id = $_SESSION ['project_id'];
$org_code=$_SESSION ['org_code'];

$project_fund['invest_total']=$_POST['invest_total'];
$project_fund['invested']=$_POST['invested'];
$project_fund['invested_bank']=$_POST['invested_bank'];
$project_fund['invested_gov']=$_POST['invested_gov'];
$project_fund['planadd']=$_POST['planadd'];
$project_fund['planadd_bank']=$_POST['planadd_bank'];
$project_fund['planadd_gov']=$_POST['planadd_gov'];
$project_fund['planaddsrc_com']=$_POST['planaddsrc_com'];
$project_fund['planaddsrc_bank']=$_POST['planaddsrc_bank'];
$project_fund['planaddsrc_fin']=$_POST['planaddsrc_fin'];
$project_fund['planaddsrc_finpat']=$_POST['planaddsrc_finpat'];
$project_fund['planaddsrc_finother']=$_POST['planaddsrc_finother'];
$project_fund['planaddsrc_other']=$_POST['planaddsrc_othe'];
// $project_fund['patent_use']=$_POST['patent_use'];//变成多选 zgf
$project_fund['checkbox1']=$_POST['checkbox1'];
$project_fund['checkbox2']=$_POST['checkbox2'];
$project_fund['checkbox3']=$_POST['checkbox3'];
$project_fund['checkbox4']=$_POST['checkbox4'];
$project_fund['project_id']=$project_id;

//get value of project_summary/project_fund

/* $project_summmary['project_name']=$_POST['project_name'];
$project_summmary['business_id']=$_POST['business_id']; */
$temp=$_GET['value'];
$arr=explode('~',$temp);
$project_summmary['project_id']=$project_id;
$project_summmary['start_time']=$arr[0];
$project_summmary['end_time']=$arr[1];


$project_summmary1['project_id']=$project_id;
$project_summmary1['bgt_fund_total']=$_POST['bgt_fund_total'];
$project_summmary1['actual_fund_total']=$_POST['actual_fund_total'];


//get array
$bgt_fund=$_POST['bgt_fund'];
$actual_fund=$_POST['actual_fund'];

// two-dimensional array
$arr2=array();
for($i=0;$i<count($bgt_fund);$i++){
   $arr2[$i]=array($i,$bgt_fund[$i],$actual_fund[$i]);  
}


//支出

$budget_fund=$_POST['budget_fund'];
$actual_fund=$_POST['actual_fund'];
$patent_out=$_POST['patent_out'];

$arr2_2=array();
for($i=0;$i<count($budget_fund);$i++){
    $arr2_2[$i]=array($i,$budget_fund[$i],$actual_fund[$i],$patent_out[$i]);
}
$community_opinion['project_id']=$project_id;
$community_opinion['expert_opinion']=$_POST['expert_opinion'];


$pro_target['project_id']=$project_id;
$pro_target['task_project_kpi']=$_POST['task_project_kpi'];


$pro_meaning['project_id']=$project_id;
$pro_meaning['project_meaning']=$_POST['project_meaning'];

$pro_doing['project_id']=$project_id;
$pro_doing['year']=$_POST['year'];
$pro_doing['sessionone']=$_POST['sessionone'];
$pro_doing['sessiontwo']=$_POST['sessiontwo'];
$pro_doing['sessionthree']=$_POST['sessionthree'];
$pro_doing['sessionfour']=$_POST['sessionfour'];

$pro_belong['project_id']=$project_id;
$pro_belong['patent_project_expect']=$_POST['task_project_expect'];

$pro_member['project_id']=$project_id;
$pro_member['coorg']=$_POST['coorg'];

$other_rule['patent_other_condition']=$_POST['other_condition'];
// $other_rule['projct_id']=$projct_id;




////专利实施
 //$patent3_orginfo['org_name'] = $_POST['org_name'];
$patent3_orginfo['register_time'] = $_POST['register_time'];
 $patent3_orginfo['contact_address'] = $_POST['contact_address'];
$patent3_orginfo['postal'] = $_POST['postal'];
$patent3_orginfo['email'] = $_POST['email'];
 $patent3_orginfo['linkman'] = $_POST['linkman'];
 $patent3_orginfo['linkman_contact'] = $_POST['linkman_contact'];
$patent3_orginfo['fax'] = $_POST['fax'];
$patent3_orginfo['org_bank'] = $_POST['org_bank'];
$patent3_orginfo['account'] = $_POST['account'];
$patent3_orginfo['credit_rate'] = $_POST['credit_rate'];
$patent3_orginfo['org_trade'] = $_POST['org_trade'];
$patent3_orginfo['register_fund'] = $_POST['register_fund'];
$patent3_orginfo['local_foreign'] = $_POST['local_foreign'];

$patent3_legal['legal_sex'] = $_POST['legal_sex'];
$patent3_legal['legal_birth'] = $_POST['legal_birth'];
$patent3_legal['legal_edu'] = $_POST['legal_edu'];
$patent3_legal['legal_time'] = $_POST['legal_time'];
$patent3_legal['legal_phone'] = $_POST['legal_phone'];
$patent3_legal['legal_name'] = $_POST['legal_name'];

$patent3_staff['project_id'] = $project_id;
$patent3_staff['staff_num'] = $_POST['staff_num'];
$patent3_staff['junior'] = $_POST['junior'];
$patent3_staff['researcher_num'] = $_POST['researcher_num'];

$patent3_intellectual['project_id'] = $project_id;
$patent3_intellectual['patent_num'] = $_POST['patent_num'];
$patent3_intellectual['invent_patent'] = $_POST['invent_patent'];

$patent3_profit['project_id'] = $project_id;
$patent3_profit['lasthalf_profit'] = $_POST['lasthalf_profit'];
$patent3_profit['lasthalf_tax'] = $_POST['lasthalf_tax'];
$patent3_profit['last_totalincome'] = $_POST['last_totalincome'];
$patent3_profit['last_industrytax'] = $_POST['last_industrytax'];
$patent3_profit['last_industryadd'] = $_POST['last_industryadd'];
$patent3_profit['last_industrycreative'] = $_POST['last_industrycreative'];
$patent3_profit['last_productsale'] = $_POST['last_productsale'];
$patent3_profit['last_techexpend'] = $_POST['last_techexpend'];
$patent3_profit['main_product'] = $_POST['main_product'];
$patent3_profit['sale_ratio'] = $_POST['sale_ratio'];

//patent3 project
$patent3_project['project_id'] = $project_id;
// $patent3_project['project_name'] = $_POST['project_name'];
$patent3_project['planfinish_time'] = $_POST['planfinish_time'];
$patent3_project['coproject_summary'] = $_POST['coproject_summary'];


$patent3_principle['project_id'] = $project_id;
$patent3_principle['leader_name']=$_POST['leader_name'];
$patent3_principle['leader_sex']=$_POST['leader_sex'];
$patent3_principle['leader_birth']=$_POST['leader_birth'];
$patent3_principle['leader_edu']=$_POST['leader_edu'];

$patent3_patent['project_id'] = $project_id;
$patent3_patent['patent_num'] = $_POST['patent_num'];
$patent3_patent['invent_num'] = $_POST['invent_num'];
$patent3_patent['function_patent'] = $_POST['function_patent'];
$patent3_patent['patent_design'] = $_POST['patent_design'];

$patent3_last['project_id'] = $project_id;
$patent3_last['employ_num'] = $_POST['lemploy_num'];
$patent3_last['year_profit'] = $_POST['lyear_profit'];
$patent3_last['industry_num'] = $_POST['lindustry_num'];
$patent3_last['tax_sum'] = $_POST['ltax_sum'];
$patent3_last['industry_add'] = $_POST['lindustry_add'];
$patent3_last['foreign_tax'] = $_POST['lforeign_tax'];
$patent3_last['sell_sum'] = $_POST['lsell_sum'];
$patent3_last['market_share'] = $_POST['lmarket_share'];

$patent3_finish['project_id'] = $project_id;
$patent3_finish['employ_num'] = $_POST['employ_num'];
$patent3_finish['year_profit'] = $_POST['year_profit'];
$patent3_finish['industry_num'] = $_POST['industry_num'];
$patent3_finish['tax_sum'] = $_POST['tax_sum'];
$patent3_finish['industry_add'] = $_POST['industry_add'];
$patent3_finish['foreign_tax'] = $_POST['foreign_tax'];
$patent3_finish['sell_sum'] = $_POST['sell_sum'];
$patent3_finish['market_share'] = $_POST['market_share'];


 
 
$book_others_pro["project_id"] = $project_id;
$book_others_pro["linkman"]=$_POST["linkman"];
$book_others_pro["linkman_email"]=$_POST["b_email"];
$book_others_pro["linkman_contact"]=$_POST["b_phone"];

$book_others1["org_code"]=$org_code;
$book_others1["postal"]=$_POST["b_postal"];
$book_others1["fax"]=$_POST["b_fax"];
$book_others1["contact_address"]=$_POST["contact_address"];

$book_others3['project_id']=$project_id;
$book_others3["account_name"]=$_POST["b_count"];
$book_others3["account_bank"]=$_POST["b_bank"];
$book_others3["account_number"]=$_POST["b_number"];







$action = $_GET ['action'];
$name = $_GET ['name'];
// project_id值设置


// echo $project_id;
$org_code = $_SESSION ['org_code'];
$app=new ProjectApp();
switch ($action){
    case "saveProFund":
        $app->attach3_patent_fund($project_id,$project_fund);
        break;
    case "findProFund":
        $app->findattach3_patent_fund($project_id,"");
        break;
    case "project_fund":
        $app->project_fund($project_id,$arr2,$project_summmary,$project_summmary1,$arr2_2);
        break;
    case "find_project_fund":
        $app->find_patent_fund($project_id);
        break;
    case "community_opinion":
        $app->community_opinion($project_id,$community_opinion);
        break;
    case "findcommunity_opinion":
        $app->findcommunity_opinion($project_id,"");
        break;
    case "pro_target":
        $app->pro_target($project_id,$pro_target);
        break;
    case "findpro_target":
        $app->findpro_target($project_id,"");
        break;
    case "pro_meaning":
        $app->pro_meaning($project_id,$pro_meaning);
        break;
    case "findpro_meaning":
        $app->findpro_meaning($project_id,"");
        break;
    case "pro_doing":
        $app->pro_doing($project_id,$pro_doing);
        break;
    case "findpro_doing":
        $app->findpro_doing($project_id,"");
        break;
    case "pro_belong":
        $app->pro_belong($project_id,$pro_belong);
        break;
    case "findpro_belong":
        $app->findpro_belong($project_id,"");
        break;
    case "pro_member":
        $app->pro_member($project_id,$pro_member);
        break;
    case "findpro_member":
        $app->findpro_member($project_id);
        break;
    case "other_rule":
        $app->other_rule($project_id,$other_rule);
        break;
    case "findother_rule":
        $app->findother_rule($project_id,"");
        break;
    case 'patent3_orginfo':
        $app->patent3_orginfo($org_code,$patent3_orginfo,$patent3_legal,$patent3_staff,$patent3_intellectual,$patent3_profit);
        break;
    case 'findpatent3_org':
        $app->find_patent3_orginfo($org_code,$project_id,"");
        break;
    case 'patent3_projectinfo':
        $app->patent3_projectinfo($project_id,$patent3_project,$patent3_principle,$patent3_patent,$patent3_last,$patent3_finish);
        break;
    case 'findpatent3_pro':
        $app->find_patent3_projectinfo($project_id,"");
        break;
    
    case 'findproject_member':
        $app->findproject_member($org_code,"");
        break;
    case 'book_others':
        $app->savebook_others($project_id ,$org_code,$book_others1,$book_others_pro,$book_others3);
        break;
    case 'findBook_others':
        $app->findBook_others($project_id,$org_code,"");
        break;
    case 'findtime':
        $app->findtime($project_id,"");
        break;
    
        
        
        
 
  
}

