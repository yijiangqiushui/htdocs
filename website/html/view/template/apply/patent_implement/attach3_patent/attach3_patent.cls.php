<?php 
include __DIR__ . '/../../../../../../../extends/common/common.php';
class ProjectApp{
    
    function attach3_patent_fund($project_id,$data){
        $db=new DB();
       // print_r($data);
        $db->UpdateData3('project_invest', $project_id, $data,'project_id');
        $db->Close();  
    }
    
    
    function findattach3_patent_fund($project_id,$flag){
        $db= new DB();
        $res=$db->GetInfo1($project_id, 'project_invest', 'project_id');
        $appJSON = array(
            'invest_total'=>$res['invest_total'],
            'invested'=>$res['invested'],
            'fixed_invest'=>$res['fixed_invest'],
            'invested_bank'=>$res['invested_bank'],
            'invested_gov'=>$res['invested_gov'],
            'planadd'=>$res['planadd'],
            'planadd_bank'=>$res['planadd_bank'],
            'planadd_gov'=>$res['planadd_gov'],
            'planaddsrc'=>$res['planaddsrc'],
            'planaddsrc_com'=>$res['planaddsrc_com'],
            'planaddsrc_bank'=>$res['planaddsrc_bank'],
            'planaddsrc_fin'=>$res['planaddsrc_fin'],
            'planaddsrc_finpat'=>$res['planaddsrc_finpat'],
            'planaddsrc_finother'=>$res['planaddsrc_finother'],
            'planaddsrc_othe'=>$res['planaddsrc_other'],
//             'patent_use'=>$res['patent_use'],
			'checkbox1'=>$res['checkbox1'],
        	'checkbox2'=>$res['checkbox2'],
        	'checkbox3'=>$res['checkbox3'],
        	'checkbox4'=>$res['checkbox4']
        );

        if($appJSON["patent_use"]==null||$appJSON["patent_use"]==""){
        	unset($appJSON["patent_use"]);
        }
        if($flag=="pdf"){
            $db->Close();
            return $appJSON;
        }
        else{
            echo json_encode($appJSON);
            $db->Close();
        }
    }
    
    function project_fund($project_id,$arr2,$project_summmary,$project_summmary1,$arr2_2){
        $db= new DB();
        $db->UpdateData3('project_info', $project_id, $project_summmary,'project_id');
        $db->UpdateData3('fund_src', $project_id, $project_summmary1,'project_id');
        //save  two-dimensional array to database,input
        for($i=0;$i<count($arr2);$i++){
            $temp=$arr2[$i];
            for($j=0;$j<count($temp);$j++){
                //indexed array====>associative array
                $temp_two=array(
                    'project_id'=>$project_id,
                    'src_type'=>$temp[0],
                    'bgt_fund'=>$temp[1],
                    'actual_fund'=>$temp[2]
 
                );
                //save 

            }
            
            $db->UpdateData2('fund_src', $project_id, $temp_two,'project_id',$temp_two[1],'src_type');
        }
        
        //save  two-dimensional array to database.output
        for($i=0;$i<count($arr2_2);$i++){
            $temp=$arr2_2[$i];
            for($j=0;$j<count($temp);$j++){
                //indexed array====>associative array
                $temp_two1=array(
                    'project_id'=>$project_id,
                    'subject'=>$temp[0],
                    'budget_fund'=>$temp[1],
                    'actual_fund'=>$temp[2],
                    'patent_out'=>$temp[3]
        
                );
                //save
        
            }
        
            $db->UpdateData2('project_fund_other', $project_id, $temp_two1,'project_id',$temp_two1[1],'subject');
        }

        $db->Close();
        
    }
    
    function find_patent_fund($project_id){
        $db=new DB();
        $res=$db->GetInfo_new($project_id, 'project_fund_other');
        $i=0;
        $temp_data=array();
        $arrJson='';
        foreach($res as $temp){
            $arrJson=array(
                'budget_fund['.$i.']'=>$temp['budget_fund'],
                'actual_fund['.$i.']'=>$temp['actual_fund'],
                'patent_out['.$i.']'=>$temp['patent_out']
                    
            );
           
            //var_dump($arrJson);
            $arrJson = array_merge($arrJson,$temp_data);
            $temp_data=$arrJson;
            $i++;
        }
        //var_dump($arrJson);
        echo json_encode($arrJson);
    }

   function community_opinion($project_id,$data){
       $db=new DB();
       $db->UpdateData3('project_info', $project_id, $data, 'project_id');
       $db->Close();
       
   }
   function findcommunity_opinion($project_id,$flag){
       $db=new DB();
       $res=$db->GetInfo1($project_id, 'project_info','project_id');
       $arrJson=array(
           'expert_opinion'=>$res['expert_opinion']
       );
       if($flag=='pdf'){
           $db->Close();
           return $arrJson;
       }else{
           echo json_encode($arrJson);
           $db->Close();
       }
   }
   function findStart_time($project_id){
   	$db=new DB();
   	$res=$db->GetInfo1($project_id, 'project_info','project_id');
   	$arrJson=array(
   			'start_time'=>date('Y',$res['start_time'])
   	);
   	$db->Close();
   	return $arrJson;
   }
   function pro_target($project_id,$data){
       $db=new DB();
       $db->UpdateData3('project_info', $project_id, $data, 'project_id');
       $db->Close();
   }
   function findpro_target($project_id,$flag){
       $db=new DB();
       $res=$db->GetInfo1($project_id, 'project_info','project_id');
       $arrJson=array(
           'task_project_kpi'=>$res['task_project_kpi']
       );
       if($flag=="pdf"){
       	$db->Close();
       	return $arrJson;
       }
       echo json_encode($arrJson);
       $db->Close();
   }
   function pro_meaning($project_id,$data){
      $db=new DB();
       $db->UpdateData3('project_info', $project_id, $data, 'project_id');
       $db->Close();
   }
   function findpro_meaning($project_id,$flag){
       $db=new DB();
       $res=$db->GetInfo1($project_id, 'project_info','project_id');
       $arrJson=array(
           'project_meaning'=>$res['project_meaning']
       );
       if($flag=="pdf"){
       	$db->Close();
       	return $arrJson;
       }
       echo json_encode($arrJson);
       $db->Close();
   }
   function pro_doing($project_id,$data){
       $db=new DB();
       $db->UpdateData3('project_mission', $project_id, $data, 'project_id');
       $db->Close();
   }
   function findpro_doing($project_id,$flag){
       $db=new DB();
       $res=$db->GetInfo1($project_id, 'project_mission','project_id');
       $arrJson=array(
           'year'=>$res['year'],
           'sessionone'=>$res['sessionone'],
           'sessiontwo'=>$res['sessiontwo'],
           'sessionthree'=>$res['sessionthree'],
           'sessionfour'=>$res['sessionfour']
       );
       if($flag=="pdf"){
       	$db->Close();
       	return $arrJson;
       }
       echo json_encode($arrJson);
       $db->Close();
   }
   function pro_belong($project_id,$data){
       $db=new DB();
       $db->UpdateData3('project_info', $project_id, $data, 'project_id');
       $db->Close();
   }
   function findpro_belong($project_id,$flag){
       $db=new DB();
       $res=$db->GetInfo1($project_id, 'project_info','project_id');
       $arrJson=array(
           'task_project_expect'=>$res['patent_project_expect'],
        
       );
       if($flag=="pdf"){
       	$db->Close();
       	return $arrJson;
       }
       echo json_encode($arrJson);
       $db->Close();
   
   }
   
   
   function pro_member($project_id,$data){
       $db=new DB();
       //项目承担单位直接回显,不用入库
       $db->UpdateData3('project_info', $project_id, $data, 'project_id');
     
       $db->Close();
   }
   
 function   savebook_others($project_id,$org_code,$book_others1,$book_others_pro,$book_others3){
 	$db=new DB();
 	print_r($book_others_pro);
 	$db->updateInfo4("org_info", "org_code", $org_code, $book_others1);
 	$res = $db->updateInfo4("project_info", "project_id", $project_id, $book_others_pro);
 	$db->updateInfo4("project_info", "project_id", $project_id, $book_others3);
 	$db->Close();
 }
   function findpro_member($project_id){
       $db=new DB();
       $res=$db->GetInfo1($project_id, 'project_info','project_id');
       $org_code=$res['org_code'];
       $res1=$db->GetInfo1($org_code, 'org_info','org_code');
       $arrJson=array(
           'coorg'=>$res['coorg'],
           'org_name'=>$res1['org_name']
       );
       echo json_encode($arrJson);
       $db->Close();
   }
   function other_rule($project_id,$data){
       $db=new DB();
       $db->UpdateData3('project_info', $project_id, $data, 'project_id');
        
       $db->Close();
   }
   function findother_rule($project_id,$flag){
       $db=new DB();
       $res=$db->GetInfo1($project_id, 'project_info','project_id');
       $arrJson=array(
           'other_condition'=>$res['patent_other_condition']
          
       );
       if($flag=="pdf"){
       	$db->Close();
       	return $arrJson;
       }
       echo json_encode($arrJson);
       $db->Close();
   }
   
   
  function patent3_orginfo($org_code, $patent3_orginfo, $patent3_legal, $patent3_staff, $patent3_intellectual, $patent3_profit, $patent_prora,$linkmanInfo,$project_id) {
        $db = new DB();
        $db->UpdateData3("project_info", $project_id, $linkmanInfo, 'project_id');exit();
        $db->UpdateData3("org_info", $org_code, $patent3_orginfo, 'org_code');
        $db->UpdateData3("legal_person", $org_code, $patent3_legal, 'org_code');
        $db->UpdateData3("staff_info", $org_code, $patent3_staff, 'org_code');
        $db->UpdateData3("intellectual_property", $org_code, $patent3_intellectual, 'org_code');
        $db->UpdateData3("profit_tax", $org_code, $patent3_profit, 'org_code');

        $sql = "DELETE FROM main_product WHERE org_code='$org_code'";
        $db->Delete($sql);
        foreach ($patent_prora as $key => $value) {
            $db->InsertData('main_product', $value);
        }

        $db->Close();
    }
 function find_patent3_orginfo($org_code, $project_id,$flag) {
  $db = new DB();
        //var_dump($org_code);
        $res1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
        $res2 = $db->GetInfo1($org_code, 'legal_person', 'org_code');
        $res3 = $db->GetInfo1($org_code, 'staff_info', 'org_code');
        $res4 = $db->GetInfo1($org_code, 'intellectual_property', 'org_code');
        $res5 = $db->GetInfo1($org_code, 'profit_tax', 'org_code');
         $result5 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
//          print_r($result5);
		$login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
		$linkman=$result5["linkman"];  
		$linkman_contact=$result5["linkman_contact"];
		$linkman_fax=$result5["linkman_fax"];
		if($linkman==null||$linkman==""){
			$linkman=$login_info["realname"];
		}
		if($linkman_contact==null||$linkman_contact==""){
			$linkman_contact=$login_info["celphone"];
		}
		if($linkman_fax==null||$linkman_fax==""){
			$linkman_fax=$login_info["phone"];
		}
		 
//         print_r($res2);
        $arrjson = array(
            "register_time" => $res1['register_time'],
            "contact_address" => $res1['contact_address'],
            "postal" => $res1['postal'],
            "email" =>  $res1['email'],
            "linkman" => $linkman,
            "linkman_contact" =>$linkman_contact,
            "fax" => $linkman_fax,
            "org_bank" => $result5['account_bank'],
            "account" => $result5['account_number'],
            "credit_rate" => $result5['credit_rate'],
            "org_trade" => $res1['org_trade'],
            "org_name" => $res1['org_name'],
            "register_fund" => $res1['register_fund'],
            "local_foreign" => $res1['local_foreign'],
             "legal_sex" => $res2['legal_sex'], 
             "org_type" => $res1['org_type'], 
            "legal_birth" => $res2['legal_birth'],
            "legal_edu" => $res2['legal_edu'],
            "legal_time" => $res2['legal_time'],
            "legal_phone" => $res2['legal_phone'],/*  */
            "legal_name" => $res2['legal_name'],
            "staff_num" => $res3['staff_num'],
            "junior" => $res3['junior'],
            "researcher_num" => $res3['researcher_num'],
            "patent_num" => $res4['patent_num'],
            "invent_patent" => $res4['invent_patent'],
            "lasthalf_profit" => $res5['lasthalf_profit'],
            "lasthalf_tax" => $res5['lasthalf_tax'],
            "last_totalincome" => $res5['last_totalincome'],
            "last_industrytax" => $res5['last_industrytax'],
            "last_industryadd" => $res5['last_industryadd'],
            "last_industrycreative" => $res5['last_industrycreative'],
            "last_productsale" => $res5['last_productsale'],
            "last_techexpend" => $res5['last_techexpend'],
            "main_product" => $res5['main_product'],
            "sale_ratio" => $res5['sale_ratio'],
        );
        
        //用于清除空值，确保下拉列表默认值能够显示
        
        if(empty($arrjson['org_type'])){
            unset($arrjson['org_type']);
        }
        if(empty($arrjson['legal_sex'])){
            unset($arrjson['legal_sex']);
        }
        if(empty($arrjson['legal_edu'])){
            unset($arrjson['legal_edu']);
        }
        $temp = array();
        $temp = json_decode($res1['feature']);
        if(!empty($temp)){
        foreach ($temp as $key=>$value){
        	$arrjson['checkbox'.$key] = $value;
        }
        }
//         var_dump($appjson);
//         exit;

        if ($flag == "pdf") {
            $db->Close();
            return $arrjson;
        } else {
            echo json_encode($arrjson);
            $db->Close();
        }
    }
    
   function patent3_projectinfo($project_id,$patent3_project,$patent3_principle,$patent3_patent,$patent3_last,$patent3_finish){
       $db=new DB();
       $db->UpdateData3("project_info", $project_id, $patent3_project, 'project_id');
       $db->UpdateData3("project_principal", $project_id, $patent3_principle, 'project_id');
       $db->UpdateData3("project_patent", $project_id, $patent3_patent, 'project_id');
       $db->UpdateData3("last_target", $project_id, $patent3_last, 'project_id');
       $db->UpdateData3("finishtarget", $project_id, $patent3_finish, 'project_id');
       $db->Close();
        
        
   }
   function find_patent3_projectinfo($project_id,$flag){ 
       $db = new DB(); 
        //var_dump($project_id);
       $res1 = $db->GetInfo1($project_id, 'project_info', 'project_id');
       $res2 = $db->GetInfo1($project_id, 'project_principal', 'project_id');
       $res3 = $db->GetInfo1($project_id, 'project_patent', 'project_id');
       $res4 = $db->GetInfo1($project_id, 'last_target', 'project_id');
       $res5 = $db->GetInfo1($project_id, 'finish_target', 'project_id');
       $data = (array)json_decode($res1['project_advantage']);
       
       $arrjson=array(
		   'project_name'=>$res1['project_name'],
       		'planfinish_time'=>$res1['planfinish_time']==null?date('Y-m-d',$res1["end_time"]):$res1['planfinish_time'],
       		 
           'coproject_summary'=>$res1['coproject_summary'],
       		'tech_level' => $res1['tech_level'],
       		'tech_area' => $res1['tech_area'],
       		'project_step' => $res1['project_step'],
           
           
           'leader_name'=>$res2['leader_name'],
           'leader_sex'=>$res2['leader_sex'],
//            'leader_birth'=>$res2['leader_birth'],
           'leader_edu'=>$res2['leader_edu'],
           
           
           'patent_num'=>$res3['patent_num'],
           'invent_num'=>$res3['invent_num'],
           'function_patent'=>$res3['function_patent'],
           'patent_design'=>$res3['patent_design'],
           
           
           
                'lemploy_num'=>$res4['employ_num'],
           'lyear_profit'=>$res4['year_profit'],
           'lindustry_num'=>$res4['industry_num'],
           'ltax_sum'=>$res4['tax_sum'],
           'lindustry_add'=>$res4['industry_add'],
           'lforeign_tax'=>$res4['foreign_tax'],
           'lsell_sum'=>$res4['sell_sum'],
           'lmarket_share'=>$res4['market_share'],
           
           
           'employ_num1'=>$res5['employ_num'],
           'year_profit1'=>$res5['year_profit'],
           'industry_num1'=>$res5['industry_num'],
           'tax_sum1'=>$res5['tax_sum'],
           'industry_add1'=>$res5['industry_add'],
           'foreign_tax1'=>$res5['foreign_tax'],
           'sell_sum1'=>$res5['sell_sum'],
           'market_share1'=>$res5['market_share']
        ); 
               if($res2['leader_birth'] != null){
           $temp = explode('-' , $res2['leader_birth']);
           $arrjson['leader_year'] = $temp[0];
           $arrjson['leader_month'] = $temp[1];
       }
       if($arrjson["leader_edu"]==null){
       	unset($arrjson["leader_edu"]);
       }
       if($arrjson["leader_sex"]==null){
           unset($arrjson["leader_sex"]);
       }
       if($arrjson["tech_level"]==null){
       	$arrjson["tech_level"]="国际领先水平";
       }
       if($arrjson["project_step"]==null){
       	$arrjson["project_step"]="研发阶段";
       }
       foreach ($data  as $key => $value){
       	$arrjson['checkbox'.$key] = $value;
       }
        if ($flag == "pdf") {
            $db->Close();
            return $arrjson;
        } else {
            echo json_encode($arrjson);
            $db->Close();
        }
   }
   
   function findproject_member($org_code,$flag){
   	$db=new DB();
   	$res1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
   	$arrjson=array(
   			"org_name"=>$res1["org_name"],
            "b_contact"=>$res1["realname"],
            "b_phone"=>$res1["celphone"],
            "b_email"=>$res1["email"]
   	);
   	echo json_encode($arrjson);
   	$db->Close();
   }
  function findBook_others($project_id,$org_code,$flag){
  	$db=new DB();
  	$res1 = $db->GetInfo1($project_id, 'project_info', 'project_id');
  	$res2= $db->GetInfo1($org_code, 'org_info', 'org_code');
  	 
  	$login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
  	$linkman=$res1["linkman_contact"];
  	$linkman_email=$res1["linkman_email"];
  	if($linkman==''||empty($linkman)){
  		$linkman=$login_info["celphone"];
  	}
  	if($linkman_email==''||empty($linkman_email)){
  		$linkman_email=$login_info["email"];
  	}
  	$arrjson=array(
  			"org_name"=>         $res2["org_name"],
  			"b_code"=>               $res2["org_code"],
  			"b_contact"=>          $res2["linkman"],
  			"b_con_address"=>$res2["contact_address"],
  			"b_postal"=>             $res2["postal"],
  	        "b_fax"=>                  $res2["fax"],
  	        "contact_address"=>             $res2["contact_address"],
  			"b_phone"=>$linkman,
  			'linkman'=>$res1["linkman"],
  			"b_email"=>$linkman_email,
  			"b_count"=>$res1["account_name"],
  			"b_bank"=>$res1["account_bank"],
  			"b_number"=>$res1["account_number"],
  	);
  	if ($flag == "pdf") {
  		$db->Close();
  		return $arrjson;
  	} else {
  		echo json_encode($arrjson);
  		$db->Close();
  	}
   }
   
   function findtime($project_id,$flag){
   	$db=new DB();
   	$res=$db->GetInfo1($project_id, 'project_info', 'project_id');
   	$arrjson=array(
   			"project_name"=>$res["project_name"],
   			"start_time"=>date("Y-m-d",$res['start_time']),
   			"end_time"=>date("Y-m-d",$res["end_time"])
   	);
   	if ($flag == "pdf") {
  		$db->Close();
  		return $arrjson;
  	} else {
  		echo json_encode($arrjson);
  		$db->Close();
  	}
   }
   //find time applied in work_summary_data.php
   function find_start_end_time($project_id){
       $db=new DB();
      $res=$db->GetInfo1($project_id, 'project_info', 'project_id');
      $arrjson=array(
          "project_name"=>$res["project_name"],
          "start_time"=>$res['start_time'],
          "end_time"=>$res["end_time"]
      );
      $db->Close();
      return $arrjson;
       
   }
    function findother_info($project_id){
        $db=new DB();
        $res=$db->GetInfo1($project_id, 'project_info', 'project_id');
        $arrjson=array(
            "business_id"=>$res["business_id"],
        		"start_time"=>date("Y",$res["start_time"])
        );
        $db->Close();
        return $arrjson;
    }
    function findOrg_info($org_code){
    	$db=new DB();
    	$res=$db->GetInfo1($org_code, 'org_info', 'org_code');
    	$arrjson=array(
    			"org_name"=>$res["org_name"]
    	);
    	$db->Close();
    	return $arrjson;
    }
}