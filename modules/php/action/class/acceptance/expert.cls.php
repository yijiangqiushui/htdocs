<?php

class Expert {

    function updateInfo($table_name, $project_id, $expert_arguments) {
        $db = new DB();
        $result = $db->updateInfo('project_info', $project_id, $expert_arguments);
        echo $result;
        $db->Close();
    }

    function sign($table_name, $project_id, $sign, $project_sign,$leader) {

        $db = new DB();
        $db->UpdateData1("project_info", $project_id, $project_sign, "project_id");
        $db->UpdateData1("project_principal", $project_id, $leader, "project_id");
        $sql = "delete from experts where  project_id = '$project_id'  ";
        $db->Delete($sql);
        foreach ($sign as $tem) {
            $db->InsertData("experts", $tem);
        }
        $db->Close();
    }

    function zj_sign($table_name, $project_id, $sign, $project_sign) {

        $db = new DB();
        $db->UpdateData1("project_info", $project_id, $project_sign, "project_id");
        $sql = "delete from experts where  zj_project_id = '$project_id'  ";
        $db->Delete($sql);
        foreach ($sign as $tem) {
            $db->InsertData("experts", $tem);
        }
        $db->Close();
    }

    /*  function saveArguments($table_name,$project_id,$expert_sign)
      {
      $project_id = $_SESSION['project_id'];
      $db = new DB();
      foreach ($expert_sign as $tmp)
      {
      if($tmp['expert_name'] !=null || $tmp['expert_org'] !=null || $tmp['expert_id'] !=null || $tmp['expert_job'] !=null
      || $tmp['expert_major'] !=null || $tmp['expert_phone'] !=null || $tmp['expert_sign'] !=null)
      {
      $result = $db->updateInfo($table_name,$project_id,$tmp);
      }
      }
      $data['last_modify'] = strtotime("now");
      $data['table_status'] = 2;
      $result_table = $db->UpdateData2('table_status','专家名单及专家论证意见',$data,'table_name',$project_id,'project_id');
      $db->Close();

      } */

    /**
     * 显示论证专家组意见;
     *
     * */
    function findProExpert($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findProjectExpert($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    /**
     * 显示论证专家组意见;
     *
     * */
    function findzj_ProExpert($project_id, $name, $tid, $flag) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
//     			'project_id'=>$result['project_id'],
            'project_name' => $result['project_name'],
            'expert_arguments' => $result['zj_expert_opinion']
        );
        if ($result ['expert_arguments'] != null) {
            $appJSON ['mark'] = '1';
        } else {
            $appJSON ['mark'] = '0';
        }

        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    function findProjectExpert($project_id, $name, $tid, $flag) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
//     			'project_id'=>$result['project_id'],
            'project_name' => $result['project_name'],
            'expert_arguments' => $result['expert_opinion']
        );
        if ($result ['expert_arguments'] != null) {
            $appJSON ['mark'] = '1';
        } else {
            $appJSON ['mark'] = '0';
        }

        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /*
     * 
     *  
     *  项目报告书pdf */

    function findProjectExpert_pdf($project_id, $name, $tid) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            //  'project_id'=>$result['project_id'],
            'project_name' => $result['project_name'],
            'expert_arguments' => $result['expert_opinion']
        );

        return $appJSON;
        $db->close();
    }

    function finds_pdf($project_id, $name, $tid) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $result2 = $db->GetInfo1($result['undertake_id'], "org_info", "org_code");
        $result3 = $db->GetInfo1($project_id, "project_principal", $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'project_name' => $result['project_name'],
            'promoney' => $result['promoney'],
            'argument_time' => $result['argument_time'],
            'undertake_id' => $result2['org_name'],
            'principal_id' => $result3['leader_name'],
        );
        return $appJSON;
        $db->close();
    }

    function findsign($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->finds($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function finds($project_id, $name, $tid, $flag) {
        $db = new DB ();
        //$result_pro = $db->GetInfo1 ( $id, $name, $tid );
        //$project_id = $_SESSION ['project_id'];
        $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
        //项目负责人
        $result2 = $db->GetInfo1($project_id, 'project_principal', 'project_id');
        // 承担单位
        $usertake_org = $db->GetInfo1($result['org_code'], 'org_info', 'org_code');
        
        $project_money=$this->GetProject_monney($project_id);
        
        $appJSON = array(
            'project_name' => $result ['project_name'],
            'business_id' => $result ['business_id'],
// 				'project_org' => $result ['project_org'],
            'org_name' => $usertake_org ['org_name'],
            'project_leader' => $result2['leader_name'],
            'zj_project_lzsj' => $result['zj_project_lzsj'],
            'project_money' => $project_money,
            'project_argtime' => $result ['project_argtime'],
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }
    function GetProject_monney($project_id){
    	$db = new DB ();
    	$res1=$db->GetInfo1($project_id, 'project_info', 'project_id');
    	$res2=$db->GetInfo1($res1["project_type"], 'project_type', 'id');
    	if($res2['isfather']==1){
    		return $res2["name"];
    	}else{
    		$res3=$db->GetInfo1($res2["father"], 'project_type', 'id');
    		return $res3["name"];
    	}
    }
    function getbusiness_id($project_id){

        $db=new DB();
        $res=$db->GetInfo1($project_id, 'project_info', 'project_id');
        $arrjson=array(
            "business_id"=>$res["business_id"]
        );
        $db->Close();
        return $arrjson;
    }

}
