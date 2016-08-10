<?php

if (!class_exists("util")) {
    include __DIR__ . '../../../../../../modules/php/action/class/projectapp/util.cls.php';
}
include __DIR__ . '/../../../../../extends/common/common.php';

class ProjectApp {

    /**
     * 任务书各方入库
     * 
     * @param unknown $project_id        	
     * @param unknown $plan_parties        	
     * @param unknown $plan_parties_t
     *      	
     */
    function savePlanParties($org_code,$project_id, $plan_parties_t, $plan_parties_legal,$plan_parties_tw) {
        //一个是 委托单位  一个是承担单位  等着写入库   --李明
        $db = new DB();
// 		$sql = "SELECT undertake_id from project_info where  project_id ='$project_id' ";
// 		$res=$db->Select($sql);
// 		$undertakeid=$res[0][0];
        $db->UpdateData1('org_info', $org_code, $plan_parties_t, "org_code");
        $db->UpdateData1('legal_person', $org_code, $plan_parties_legal, "org_code");
        $db->UpdateData1('project_info', $project_id, $plan_parties_tw, "project_id");
        $db->Close();
    }

    /**
     * 意见入库
     * 
     * @param unknown $project_id        	
     * @param unknown $project_opin        	
     * @param unknown $org_opinion        	
     */
    function saveOpinPromise($project_id, $project_opin, $org_opinion) {
        // 'project_info','project_principle',$project_opin
        $db = new DB ();
        $db->UpdateData1("project_info", $project_id, $org_opinion, "project_id");
        $data['leader_opinion'] = $project_opin['leader_opinion'];
        $data['project_id'] = $project_id;
        $db->updateInfo("project_principal", $project_id, $data);
        $db->Close();
    }

    function task_project($table_name, $project_id, $project_target) {
        $db = new DB();
        $result = $db->updateInfo($table_name, $project_id, $project_target);
        echo $result;
        $db->Close();
    }

    /**
     *
     * @param unknown $name        	
     * @param unknown $project_id        	
     * @param unknown $project_other        	
     */
    function saveOtherCondition($name, $project_id, $project_other) {
        $db = new DB ();
        $result1 = $db->UpdateTabData($name, $project_id, $project_other, 'project_id');
        $db->Close();
    }

    function check_opinion($table_name, $check_opinion) {
// 		var_dump($table_name);exit();
        $project_id = $_SESSION ['project_id'];
        $db = new DB ();
        $result = $db->UpdateData2('table_status', $project_id, $check_opinion, 'project_id', $table_name, 'table_name');
        if ($result > 0) {
            $data ['code'] = 1;
        } else {
            $data ['code'] = 0;
        }
        echo json_encode($data);
        $db->Close();
    }

    /*
     * 更改项目实施方案的状态信息（更改为审核中的状态）
     */

    function executeSolution($name, $project_id) {
        $db = new DB ();
        $data ['last_modify'] = strtotime("now");
        //这里还需要判断这个项目类型的文件是不是不需要审核的
        $project_info = $db -> GetInfo1($project_id, 'project_info', 'project_id');
        $project_type_id = $project_info['project_type'];
        $table_info = $db -> GetInfo2($project_type_id, 'table_type_relative', 'project_type_id', $name, 'table_type_id');
//         var_dump($table_info);exit();
        if($table_info['not_check'] == 1){
            $data ['table_status'] = 4;
        }else{
            $data ['table_status'] = 2;
        }
        $result_table = $db->UpdateData2('table_status', $name, $data, 'table_name', $project_id, 'project_id');
        if ($result_table > 0) {
            $result_table_status = 1;
        } else {
            $result_table_status = 0;
        }
        echo $result_table_status;
        $db->Close();
    }

    function isfinish($name, $project_id) {
        $db = new DB();
        $sql = "SELECT iscomplete FROM table_status WHERE table_name='$name' and project_id = '$project_id'";
        $result = $db->Select($sql);
        $iscomplete = $result[0]['iscomplete'];
        $array = json_decode($iscomplete, true);
        $array1 = array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
        $result1 = array_diff($array, $array1);
        if ($result1 == null) {
            echo 1;
        } else {
            echo 0;
        }
    }

    /* 	function assignment($name,$project_id) {
      $db = new DB ();
      $data ['last_modify'] = strtotime ( "now" );
      $data ['table_status'] = 2;

      $result_table = $db->UpdateData2 ( 'table_status', $name, $data, 'table_name', $project_id, 'project_id' );
      if ($result_table > 0) {
      $result_table ['code'] = 1;
      } else {
      $result_table ['code'] = 0;
      }
      echo $result_table;
      $db->Close ();
      } */

    /*
     * 更改项目实施方案的状态信息（更改为审核中的状态）
     */
    /* 	function execute_solution($project_id) {
      $db = new DB ();
      $data ['last_modify'] = strtotime ( "now" );
      $data ['table_status'] = 2;
      $result_table = $db->UpdateData2 ( 'table_status', '项目实施方案', $data, 'table_name', $project_id, 'project_id' );
      if ($result_table > 0) {
      $result_table ['code'] = 1;
      } else {
      $result_table ['code'] = 0;
      }
      echo $result_table;
      $db->Close ();
      } */

    /*
     * 更改专家论证意见的状态信息（更改为审核中的状态）
     *
     */
    /* 	function expert_solution($name,$project_id) {
      $db = new DB ();
      $data ['last_modify'] = strtotime ( "now" );
      $data ['table_status'] = 2;
      $result_table = $db->UpdateData2 ( 'table_status', $name, $data, 'table_name', $project_id, 'project_id' );
      if ($result_table > 0) {
      $result_table ['code'] = 1;
      } else {
      $result_table ['code'] = 0;
      }
      echo $result_table;
      $db->Close ();
      } */

    /*
     * 更改北京市通州区科技计划项目调整申请表状态（更改为审核中的状态信息）
     */
    /* 	function modify_solution($name,$project_id) {
      $db = new DB ();
      $data ['last_modify'] = strtotime ( "now" );
      $data ['table_status'] = 2;
      $result_table = $db->UpdateData2 ( 'table_status', $name, $data, 'table_name', $project_id, 'project_id' );
      if ($result_table > 0) {
      $result_table ['code'] = 1;
      } else {
      $result_table ['code'] = 0;
      }
      echo $result_table;
      $db->Close ();
      } */

    /* 	
      function middle_solution($name,$project_id) {
      $db = new DB ();
      $data ['last_modify'] = strtotime ( "now" );
      $data ['table_status'] = 2;
      $result_table = $db->UpdateData2 ( 'table_status', $name, $data, 'table_name', $project_id, 'project_id' );
      if ($result_table > 0) {
      $result_table ['code'] = 1;
      } else {
      $result_table ['code'] = 0;
      }
      // 		echo $result_table;
      $db->Close ();
      } */

    /* 	
      function expertProAccept($name,$project_id) {
      $db = new DB ();
      $data ['last_modify'] = strtotime ( "now" );
      $data ['table_status'] = 2;
      $result_table = $db->UpdateData2 ( 'table_status',$name, $data, 'table_name', $project_id, 'project_id' );
      if ($result_table > 0) {
      $result_table ['code'] = 1;
      } else {
      $result_table ['code'] = 0;
      }
      echo $result_table;
      $db->Close ();
      } */
    /* 	function acceptSummary($name,$project_id) {
      $db = new DB ();
      $data ['last_modify'] = strtotime ( "now" );
      $data ['table_status'] = 2;
      $result_table = $db->UpdateData2 ( 'table_status', $name, $data, 'table_name', $project_id, 'project_id' );
      if ($result_table > 0) {
      $result_table ['code'] = 1;
      } else {
      $result_table ['code'] = 0;
      }
      echo $result_table;
      $db->Close ();
      } */

    function saveOrgInfo($table_name, $project_id, $org_info, $org_info1) {
        $project_id = $_SESSION ['project_id'];
        $db = new DB ();
        $result = $db->updateInfo($table_name, $project_id, $org_info);
        echo $result;
        $result1 = $db->updateInfo($table_name, $project_id, $org_info1);
        echo $result1;
        $data ['last_modify'] = strtotime("now");
        $data ['table_status'] = 1;
        $result_table = $db->UpdateData2('table_status', '项目任务书', $data, 'table_name', $project_id, 'project_id');
        $db->Close();
    }

    /**
     * 显示项目专家意见和主管意见;
     */
    function findOpinInfo($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $res = $this->findOpin($project_id, $name, $tid, $flag);
            return $res;
        } else {
            echo '0';
        }
    }

    function findOpin($id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($id, $name, $tid);
        $result2 = $db->GetInfo1($id, "project_principal", $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'leader_opinion' => $result2 ['leader_opinion'],
            'org_opinion' => $result ['org_opinion'],
        	'business_id' => $result ['business_id']
        );


        $sql = "SELECT table_status FROM table_status WHERE project_id = '$id' and table_name ='通州区支持承担市级以上科技项目申报书'";
        $result = $db->Select($sql);

        if ($result[0]['table_status'] == 1 || $result[0]['table_status'] == 3) {
            $appJSON ['save_display'] = 1;
        } else {
            $appJSON ['save_display'] = 0;
        }
        if ($flag == "pdf") {
// 			var_dump($appJSON);
// 			exit();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示项目意义
     */
    function findProjectMean($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $res = $this->findProMean($project_id, $name, $tid, $flag);
            return $res;
        } else {
            echo '0';
        }
    }

    function findProMean($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $project_id,
            'project_meaning' => $result['project_meaning'],
        	'business_id' => $result['business_id']
        );
        if ($flag == 'pdf') {
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    /**
     * 显示项目国内外发展现状
     */
    function findProStatus($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $res = $this->findProjectStatus($project_id, $name, $tid, $flag);
            return $res;
        } else {
            echo '0';
        }
    }

    function findProjectStatus($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_status' => $result ['project_status']
        );
        if ($flag == 'pdf') {
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    /**
     * 显示项目任务、目标与考核指标
     */
    function findProTarget($project_id, $name, $tid, $flag) {//$task ,
// 		if(!$task) {
// 			$tast = '';
// 		}
        if ($project_id != null) {
            $res = $this->findProjectTarget($project_id, $name, $tid, $flag); //$task,
            return $res;
        } else {
            echo '0';
        }
    }

    /**
     * 显示项目任务、目标与考核指标
     */
    function findtask_ProTarget($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findtaskProjectTarget($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findProjectTarget($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_mission' => $result [$task . 'project_mission'],
            'project_aim' => $result [$task . 'project_aim'],
            'project_kpi' => $result [$task . 'project_kpi']
        );
        if ($flag == 'pdf') {
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    function findtaskProjectTarget($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_mission' => $result ['task_project_mission'],
            'project_aim' => $result ['task_project_aim'],
            'project_kpi' => $result ['task_project_kpi']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示项目研发内容
     */
    function findProContent($project_id, $name, $tid, $task, $flag) {
        if (!$task) {
            $task = '';
        }
        if ($project_id != null) {
            $res = $this->findProjectContent($project_id, $name, $tid, $task, $flag);
            return $res;
        } else {
            echo '0';
        }
    }

    /**
     * 显示项目研发内容
     */
    function findtask_ProContent($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findtaskProjectContent($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findProjectContent($project_id, $name, $tid, $task, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_content' => $result [$task . 'project_content']
        );
        if ($flag == 'pdf') {
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    function findtaskProjectContent($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_content' => $result ['task_project_content']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示项目技术方案与技术路线
     */
    function findProTech($project_id, $name, $tid, $task, $flag) {
        if (!$task) {
            $task = '';
        }
        if ($project_id != null) {
            $res = $this->findProjectTech($project_id, $name, $tid, $task, $flag);
            return $res;
        } else {
            echo '0';
        }
    }

    function findProjectTech($project_id, $name, $tid, $task, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'tech_way' => $result [$task . 'tech_way'],
            'project_manage' => $result [$task . 'project_manage'],
            'delegation_task' => $result [$task . 'delegation_task']
        );
        if ($flag == 'pdf') {

            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    /**
     * 显示项目技术方案与技术路线
     */
    function findtask_ProTech($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findtaskProjectTech($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findtaskProjectTech($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'tech_way' => $result ['task_tech_way'],
            'project_manage' => $result ['task_project_manage'],
            'delegation_task' => $result ['task_delegation_task']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示项目遇到的风险;
     */
    function findProRisk($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $res = $this->findProjectRisk($project_id, $name, $tid, $flag);
            return $res;
        } else {
            echo '0';
        }
    }

    function findProjectRisk($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_risk' => $result ['project_risk']
        );
        if ($flag == 'pdf') {
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    /**
     * 显示项目预期成果形式、知识产权归属及管理
     */
    function findProExpert($project_id, $name, $tid, $task, $flag) {
        if (!$task) {
            $task = '';
        }
        if ($project_id != null) {
            $res = $this->findProjectExpert($project_id, $name, $tid, $task, $flag);
            return $res;
        } else {
            echo '0';
        }
    }

    function findProjectExpert($project_id, $name, $tid, $task, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_expect' => $result [$task . 'project_expect']
        );
        if ($flag == 'pdf') {
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    /**
     * 显示项目预期成果形式、知识产权归属及管理
     */
    function findtask_ProExpert($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findtask_ProjectExpert($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findtask_ProjectExpert($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_expect' => $result ['task_project_expect']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 项目完成后的经济社会效益分析与成果推广方案
     */
    function findProEconomy($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $res = $this->findProjectEconomy($project_id, $name, $tid, $flag);
            return $res;
        } else {
            echo '0';
        }
    }

    function findProjectEconomy($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_effect' => $result ['project_effect']
        );
        if ($flag == "pdf") {
            $db->close();
            return $appJSON;
        } else {
            echo json_encode($appJSON);
            $db->close();
        }
    }

    /**
     *
     * @param project_id $project_id        	
     * @param 数据库名 $name        	
     * @param 字段名 $tid        	
     */
    function findProSummary($user_id, $project_type_id) {
        $db = new DB();
        $project_type = $db->getInfo($project_type_id, 'project_type');
        $user = $db->getInfo($user_id, 'login_info');
        $org = $db->getInfo1($user['org_code'], 'org_info', 'org_code');

        $appJSON = array(
            'project_type' => $project_type['name'],
            'department' => dep_name($project_type['dep_type']),
            'project_engineer' => $project_type['project_leader'],
            'org_name' => $org['org_name']
        );
        return $appJSON;
    }
    
    function findProSummary_genious($user_id, $project_type_id) {
    	$db = new DB();
    	$project_type = $db->getInfo($project_type_id, 'project_type');
    	$user = $db->getInfo($user_id, 'login_info');
    	$org = $db->getInfo1($user['org_code'], 'org_info', 'org_code');
    
    	$appJSON = array(
    			'project_type' => $project_type['name'],
    			'department' => dep_name($project_type['dep_type']),
    			'project_engineer' => $project_type['project_leader'],
    			'org_name' => $org['org_name']
    	);
    	echo json_encode($appJSON);
    }

    function findProjectSummary($org_code, $name, $tid, $dep_type, $type_name) {
        $db = new DB ();
        $result = $db->GetInfo1($org_code, $name, $tid);
        switch ($dep_type) {
            case 0 :
                $department = '发展计划科';
                break;
            case 1 :
                $department = '知识产权科';
                break;
            case 2 :
                $department = '科技综合科';
                break;
        }
        $result_type = $db->GetInfo1($type_name, 'project_type', 'name');
        if ($result_type ['apply_end'] != null) {
            $result ['project_end'] = date("Y-m-d", $result_type ['apply_end']);
        } else {
            $result ['project_end'] = null;
        }
        $result ['project_start'] = date("Y-m-d", $result_type ['apply_start']);

        $org_code = $result ['org_code'];

        $appJSON = array(
            'project_id' => $result ['project_id'],
            'project_name' => $result ['project_name'],
            'tech_area' => $result ['tech_area'],
            'project_type' => $result_type ['name'],
            'project_start' => $result ['project_start'],
            'project_end' => $result ['project_end'],
            'department' => $department,
            'project_engineer' => $result_type ['project_leader'],
            'org_name' => $result ['org_name']
        );
        echo json_encode($appJSON);
        $db->close();
    }

    function findProInfo($project_id) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $result1 = $db->GetInfo1($result ['org_code'], 'org_info', 'org_code');
// 		$result2 = $db->GetInfo1 ( $result ['project_type'], 'project_type', 'name' );
        //由于project_type的内容改变了所以其他的东西也要跟着改变了。
        $result2 = $db->GetInfo1($result ['project_type'], 'project_type', 'id');
        global $global_department;
        //项目类型
        //需要重新找一下项目类型
        $project_type_name = $db->GetInfo($result ['project_type'], 'project_type');
        
        
        
        $appJSON = array(
            'project_name' => $result ['project_name'],
        	'isclose' => $result ['isclose'],
            'business_id' => $result ['business_id'],
            'tech_area' => $result ['tech_area'],
            'project_type' => $project_type_name ['name'],
            'project_engineer' => $result ['project_engineer'],
            'start_time' => date('Y-m-d', $result ['start_time']),
            'end_time' => date('Y-m-d', $result ['end_time']),
            'department' => $global_department[$result2['dep_type']]['name'],
            'undertake_id' => $result1 ['org_name']
        );
        if($appJSON["project_engineer"]==''||$appJSON["project_engineer"]==null){
        	$appJSON["project_engineer"]="";
        }
        
        if($result ['isclose']==1){
        	$sql="update project_info  set isclose=0 where project_id ='$project_id'  ";
        	$db->Update($sql);
        }
        echo json_encode($appJSON);
    }

    function findProInfoB($project_id) {
        $db = new DB ();
        // echo $project_id."hhaa";
        $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $result1 = $db->GetInfo1($result ['org_code'], 'org_info', 'org_code');

        $result2 = $db->GetInfo1($result ['project_type'], 'project_type', 'id');
        $result3 ['project_start'] = date("Y-m-d", floatval($result2 ['apply_start']));
        $result3 ['project_end'] = date("Y-m-d", floatval($result2 ['apply_end']));

        $appJSON = array(
            'project_name' => $result ['project_name'],
            'project_id' => $result ['project_id'],
            'tech_area' => $result ['tech_area'],
            'project_type' => $result2 ['name'],
            'project_engineer' => $result ['project_engineer'],
            'start_time' => date('Y-m-d', $result ['start_time']),
            'end_time' => date('Y-m-d', $result ['end_time']),
            'department' => $result ['department'],
            'undertake_id' => $result1 ['org_name']
        );
        echo json_encode($appJSON);
    }

    /**
     * 显示项目审核意见
     */
    function findProCheck($project_id, $name, $tid) {
        if ($project_id != null) {
            $this->findProjectCheck($project_id, $name, $tid);
        } else {
            echo '0';
        }
    }

    function findProjectCheck($project_id, $name, $tid) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'office_opinion' => $result ['office_opinion'],
            'head_opinion' => $result ['head_opinion'],
            'director_opinion' => $result ['director_opinion']
        );
        echo json_encode($appJSON);
        $db->close();
    }

    function saveProInfo($updateinfo) {
        //定义一个json输出的
        $resultJson = array();
        $db = new DB();
        $project_id = $updateinfo['project_id'];
        $db->UpdateData1('project_info', $project_id, $updateinfo, 'project_id');
        $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $department = $result['department'];
        $project_stage = $result['project_stage'];

        $business_id = '';
        $sql_dev = "select * from project_info where department = '$department'";
//         echo $sql_dev;
        $result_dev = $db->SelectOri($sql_dev);
        $num = mysql_num_rows($result_dev);
        $max = 0;
        if ($project_stage == 0 || $project_stage == 5) {
            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $object = mysql_fetch_object($result_dev);
                    $num2 = (int) substr($object->business_id, 8, 3);
                    if ($max < $num2) {
                        $max = $num2;
                    }
                }

                switch ($department) {
                    case '发展计划科':
                        $business_id = 'KJ' . Date("Y", time()) . 'CX' . sprintf("%03d", $max + 1);
                        break;
                    case '知识产权科':
                        $business_id = 'ZS' . Date("Y", time()) . 'CQ' . sprintf("%03d", $max + 1);
                        break;
                    case '科技综合科':
                        $business_id = 'KJ' . Date("Y", time()) . 'ZH' . sprintf("%03d", $max + 1);
                        break;
                }
            } else {
                switch ($department) {
                    case '发展计划科':
                        $business_id = 'KJ' . Date("Y", time()) . 'CX' . sprintf("%03d", 1);
                        break;
                    case '知识产权科':
                        $business_id = 'ZS' . Date("Y", time()) . 'CQ' . sprintf("%03d", 1);
                        break;
                    case '科技综合科':
                        $business_id = 'KJ' . Date("Y", time()) . 'ZH' . sprintf("%03d", 1);
                        break;
                }
            }
            //插入数据库
            $update_sql = "update project_info set project_stage = 1,is_check=0,business_id = '$business_id' where project_id = '$project_id'";
          //  echo $update_sql;
            $re = $db->Update($update_sql);
        }
        $resultJson['code'] = $re;
        $resultJson['project_id'] = $project_id;
        echo json_encode($resultJson);
        $db -> Close();
    }

    function setsavestage($project_id) {
        $db = new db();
        $result = $db -> GetInfo1($project_id, 'project_info', 'project_id');
        $year = date("Y",$result['start_time']);
        $update_sql = "update project_info set project_stage = 5 , store_year = $year where project_id = '$project_id'";
        $re = $db->Update($update_sql);
        echo $re;
        $db->Close();
    }

    /**
     * 显示项目其他条款
     */
    function findOthCondition($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findOtherCondition($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findOtherCondition($project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result ['project_id'],
            'other_condition' => $result ['other_condition']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示单位基本信息;
     */
    function findProOrg($org_code, $project_id, $flag) {
        $db = new DB ();
        // 参数分别是： 主键值 数据库表名 主键名
        // echo $project_id."haha";
        //echo $org_code;
        $result = $db->GetInfo1($org_code, 'org_info', 'org_code');

        $result2 = $db->GetInfo1($project_id, 'project_principal', 'project_id');
        $result5 = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
        $result4= $db->GetInfo1($org_code, 'legal_person', 'org_code');
        $linkman=$result5["linkman"];
        $linkman_contact=$result5["linkman_contact"];
//         var_dump($result5["linkman"]);
        if($linkman==null||$linkman==""){ 
        $linkman=	$login_info["realname"];
        }
        if($linkman_contact==null||$linkman_contact==""){
        $linkman_contact=	$login_info["celphone"];
        }

        $appJSON = array(
            'org_code' => $result ['org_code'],
            'username' => $result ['username'],
            'org_bank' => $result ['org_bank'],
            'account' => $result ['account'],
            'relationship' => $result ['relationship'],
            'org_name' => $result ['org_name'],
            'legal_person' => $result ['legal_person'],
            'org_type' => $result ['org_type'],
            'contact_address' => $result ['contact_address'],
            'register_town' => $result ['register_town'],
            'register_time' => $result ['register_time'],
            'postal' => $result ['postal'],
            'fax' => $result ['fax'],
            'email' => $result ['email'],
            'phone' => $result ['phone'],
            'certi_code' => $result ['certi_code'],
            'develop_area' => $result ['develop_area'],
            'org_leader' => $result ['org_leader'],
            'leader_contact' => $result ['leader_contact'],
            'dev_leader' => $result ['dev_leader'],
            'dev_contact' => $result ['dev_contact'],
            'finance_leader' => $result ['finance_leader'],
            'finance_contact' => $result ['finance_contact'],
            'linkman' => $linkman,
            'linkman_contact' => $linkman_contact,
            'ratification_num' => $result ['ratification_num'],
            'leader_name' => $result2 ['leader_name'],
            'leader_phone' => $result2 ['leader_phone'],
            'legal_code' => $result4 ['legal_code'],
            'legal_person'=>$result4['legal_name'],
        	'business_id'=> $result5 ['business_id']
        );
        // 这里主要是选择一个用户必须填写的项作为判断当前是否填满的标示，这里选择了注册时间
        if ($result ['register_town'] != null) {
            $appJSON ['mark'] = '1';
        } else {
            $appJSON ['mark'] = '0';
        }
        if ($flag == 'pdf') {
            $db->Close();
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
     /* print_r($appJSON); */
//         if($project_id == null)
//         {print_r('12344321234321');}
//    print_r($org_code);
//    print_r('<br/>');
//    print_r($project_id);
        $db->close();
    }

    // 2015.11.28 李明写
    /**
     * 显示单位基本信息;
     */
    /*
     * function findProOrg($org_code, $name, $tid, $project_id) {
     * if ($org_code != null) {
     * $this->findProjectOrg ( $org_code, $name, $tid, $project_id );
     * } else {
     * echo '0';
     * }
     * }
     * function findProjectOrg($org_code, $name, $tid, $project_id) {
     * $db = new DB ();
     * $result = $db->GetInfo1 ( $org_code, $name, $tid );
     * $result2 = $db->GetInfo1 ( $project_id, "project_principal", "project_id" );
     * $appJSON = array (
     * 'org_code' => $result ['org_code'],
     * 'relationship' => $result ['relationship'],
     * 'org_name' => $result ['org_name'],
     * 'legal_person' => $result ['legal_person'],
     * 'org_type' => $result ['org_type'],
     * 'org_address' => $result ['org_address'],
     * 'register_town' => $result ['register_town'],
     * 'register_time' => $result ['register_time'],
     * 'postal' => $result ['postal'],
     * 'fax' => $result ['fax'],
     * 'email' => $result ['email'],
     * 'certi_code' => $result ['certi_code'],
     * 'develop_area' => $result ['develop_area'],
     * 'org_leader' => $result ['org_leader'],
     * 'leader_contact' => $result ['leader_contact'],
     * 'dev_leader' => $result ['dev_leader'],
     * 'dev_contact' => $result ['dev_contact'],
     * 'finance_leader' => $result ['finance_leader'],
     * 'finance_contact' => $result ['finance_contact'],
     * 'linkman' => $result ['linkman'],
     * 'linkman_contact' => $result ['linkman_contact'],
     * 'ratification_num' => $result ['ratification_num'],
     * 'leader_name' => $result2 ['leader_name'],
     * 'leader_phone' => $result2 ['leader_phone']
     * );
     *
     * // 这里主要是选择一个用户必须填写的项作为判断当前是否填满的标示，这里选择了注册时间
     * if ($result ['register_town'] != null) {
     * $appJSON ['mark'] = '1';
     * } else {
     * $appJSON ['mark'] = '0';
     * }
     * echo json_encode ( $appJSON );
     * $db->close ();
     * }
     */

    /**
     * 显示任务书各方的内容;
     */
    // 这个有问题，不能现在显示出结果啊!!!!!!
    function findPlanPart($org_code,$project_id, $name, $tid, $flag) {
        if ($org_code != null) {
            $this->findPlanParties($org_code,$project_id, $name, $tid, flag);
        } else {
            echo '0';
        }
    }

    function findPlanParties($org_code,$project_id, $name, $tid, $flag) {
        $db = new DB ();
        $result = $db->GetInfo1($org_code, $name, $tid);
        $result1 = $db->GetInfo1($org_code, 'legal_person', $tid);
        $result2=$db->GetInfo1($project_id, 'project_info', 'project_id');
        $appJSON = array(
            'org_name' => $result ['org_name'],
            'legal_code' => $result1['legal_name'],
            'postal' => $result ['postal'],
            'linkman' => $result['linkman'],
            'contact_address' => $result ['contact_address'],
            'phone' => $result ['phone'],
            'fax' => $result ['fax'],
            'email' => $result ['email'],
            'username' => $result ['username'],
            'org_bank' => $result ['org_bank'],
            'account' => $result ['account'],
            'org_leader' => $result ['org_leader'],
            'linkman_contact' => $result ['linkman_contact'],
            'ratification_num' => $result ['ratification_num'],
            'username'=>$result2['account_name'],
            'org_bank'=>$result2['account_bank'],
            'account'=>$result2['account_number']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    function findPlanPartiesevery($org_code,$project_id, $name, $tid, $flag) {
    	$db = new DB ();
    	$result2=$db->GetInfo1($project_id, 'project_info', 'project_id');
    	$appJSON = array(
    			'username'=>$result2['account_name'],
    			'org_bank'=>$result2['account_bank'],
    			'account'=>$result2['account_number']
    	);
    	if ($flag == "pdf") {
    		$db->Close();
    		return $appJSON;
    	}
    	echo json_encode($appJSON);
    	$db->close();
    }
    
    /**
     * 显示项目信息;
     */
    // 这个有问题，不能现在显示出结果啊!!!!!!
    function findProSum1($org_code, $name, $tid) {
        if ($org_code != null) {
            $this->findProjectSum1($org_code, $name, $tid);
        } else {
            echo '0';
        }
    }

    function findProjectSum1($org_code, $name, $tid) {
        $db = new DB ();
        $result = $db->GetInfo1($org_code, $name, $tid);
        $appJSON = array(
            'org_code' => $result ['org_code'],
            'org_name' => $result ['org_name'],
            'org_address' => $result ['org_address'],
            'postal' => $result ['postal'],
            'fax' => $result ['fax'],
            'email' => $result ['email'],
            'org_leader' => $result ['org_leader'],
            'phone' => $result ['phone'],
            'linkman_contact' => $result ['linkman_contact'],
            'ratification_num' => $result ['ratification_num']
        );
        $db->close();
        json_out($appJSON);
    }

    /**
     * 查看项目承担单位信息
     */
    // $org_code, 'org_info', 'org_code',$project_id
    function findProMember($org_code, $name, $tid, $project_id, $flag) {
        $db = new DB ();
        $result_org = $db->GetInfo1($org_code, $name, $tid);
        $project_id = $_SESSION ['project_id'];
        $sql = "select * from project_principal where project_id = '$project_id'";
        $result_pro = $db->Select($sql);
        $sql1 = "select * from project_org where project_id = '$project_id'";
        $result_prorg = $db->Select($sql1);
		
        $appJSON = array(
            'org_name' => $result_org ['org_name'], //
            'leader_name' => $result_pro [0] ['leader_name'], //
//             'leader_sex' => $result_pro [0] ['leader_sex'],
            'leader_ID' => $result_pro [0] ['leader_ID'],
            'tech_pos' => $result_pro [0] ['tech_pos'],
//             'leader_edu' => $result_pro [0] ['leader_edu'],
            'leader_major' => $result_pro [0] ['leader_major'],
        	'leader_birth' => $result_pro [0] ['leader_birth'],
            'leader_job' => $result_pro [0] ['leader_job'],
            'leader_phone' => $result_pro [0] ['leader_phone'], //
            'leader_address' => $result_pro [0] ['leader_address'],
            'leader_postal' => $result_pro [0] ['leader_postal'],
            'leader_fax' => $result_pro [0] ['leader_fax'],
            'leader_email' => $result_pro [0] ['leader_email'],
            'leader_tele' => $result_pro [0] ['leader_tele'],
            'leader_achieve' => $result_pro [0] ['leader_achieve'],
            'org_name0' => $result_prorg [0] ['org_name'],
            'org_name1' => $result_prorg [1] ['org_name'],
            'org_name2' => $result_prorg [2] ['org_name'],
            'org_mission0' => $result_prorg [0] ['org_duty'],
            'org_mission1' => $result_prorg [1] ['org_duty'],
            'org_mission2' => $result_prorg [2] ['org_duty']
        );
        if($result_pro[0]['leader_birth'] != null){
        	$temp = explode('-',$result_pro[0]['leader_birth']);     
        	$appJSON['leader_year'] = $temp[0];
        	$appJSON['leader_month'] = $temp[1];
        }
        if($result_pro [0] ['leader_sex'] != null){
            $appJSON['leader_sex'] = $result_pro [0] ['leader_sex'];
        }
        if($result_pro [0] ['leader_edu'] != null){
            $appJSON['leader_edu'] = $result_pro [0] ['leader_edu'];
        }
        if ($flag == 'pdf') {
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    function findtask_ProMember($org_code, $name, $tid, $project_id, $flag) {
        $db = new DB ();
        $result_org = $db->GetInfo1($org_code, $name, $tid);

        $result_pro=$db->GetInfo1($project_id, 'project_principal', 'task_project_id');

        $appJSON = array(
            'org_name' => $result_org['org_name'],
            'leader_name' => $result_pro['leader_name'],
            /* 'leader_sex' => $result_pro['leader_sex'], */
            'leader_job' => $result_pro['leader_job'],
            /* 'leader_edu' => $result_pro['leader_edu'], */
            'leader_major' => $result_pro['leader_major'],
            'main_division' => $result_pro['main_division'],
            'work_org' => $result_pro['work_org'],
        		'leader_birth' => $result_pro['leader_birth'],
        );
        
		if($result_pro['leader_birth']!=null){
			$temp = explode('-',$result_pro['leader_birth']);
			$appJSON['leader_year'] = $temp[0];
			$appJSON['leader_month'] = $temp[1];
		}
        if($result_pro['leader_sex']!=null){
            $appJSON['leader_sex']=$result_pro['leader_sex'];
        }
        if($result_pro['leader_edu']!=null){
            $appJSON['leader_edu']=$result_pro['leader_edu'];
            
        }
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
//        print_r($appJSON);exit();
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 查询每年的项目进度;
     */
    function findProAnn($name, $id, $tid, $task, $flag) {
        if (!$task) {
            $task = '';
        }
        $db = new DB ();

        $sql = "select * from project_ann_plan where $tid = '$id' ";
        $result = $db->Select($sql);
        $appJSON = array();
        $count = 0;
        foreach ($result as $val) {
            $appJSON['plan_year[' . $count . ']'] = $result [$count] [$task . 'plan_year'];
            $appJSON['plan_content[' . $count . ']'] = $result [$count] [$task . 'plan_content'];
            $count++;
        }
        if ($flag == 'pdf') {
            $db->Close();
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    /**
     * 自动查看专家意见表
     */
    function findExpertSigns($name, $id, $tid, $project_id) {
        $db = new DB ();
        //$result_pro = $db->GetInfo1 ( $id, $name, $tid );
        //$project_id = $_SESSION ['project_id'];

        $result = $db->GetInfo1($project_id, 'project_info', 'project_id');


        $result1 = $db->GetInfo1($result ['org_code'], 'org_info', 'org_code');


        $result2 = $db->GetInfo1($project_id, 'project_principal', 'project_id');


        $appJSON = array(
            'project_name' => $result ['project_name'],
            'project_id' => $result ['business_id'],
            'project_money' => $result ['project_zxzj_name'],
            'project_argtime' => $result ['project_lzsj'],
            //承担单位
            'undertake_id' => $result1 ['org_name'],
            //项目负责人
            'project_leader' => $result2['leader_name'],
        );
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 修改审核的表的状态
     */
    function isCheck($project_id, $value) {
        // 对数据库进行修改操作
        $db = new DB ();
        if ($value == 1) {
            // 说明通过审核
            $data = array(
                'table_status' => '4',
                'project_stage' => 4
            );
            $res = $db->UpdateData1('table_status', $project_id, $data, 'project_id');
            $db->close();
            return $res;
        } else {
            // 审核不通过
            $data = array(
                'table_status' => '5',
                'project_stage' => 5
            );
            $res = $db->UpdateData1('table_status', $project_id, $data, 'project_id');
            $db->close();
            return $res;
        }
    }

    /**
     *
     * @param unknown $applyinfo
     *        	项目承担单位基本信息
     */
    function org_info($org_code, $project_id, $project_principle, $applyinfo,$linkmanInfo) {
        $db = new DB ();
        // $applyinfo['year']=date('Y',time());
        // if($_SESSION['app_id']==''&&$_SESSION['app_id']==null){
        // $applyinfo['org_id']=$_SESSION['org_id'];
        // $result = $db->UpdateTabData ( "org_info", $org_id, $applyinfo, $tid );
        // $result = $db->UpdateTabData ( "project_principal", $project_id, $project_principle, "project_id" );
        // $_SESSION['app_id']=$result;
        // }else{
        // $result=$db->UpdateData('application',$_SESSION['app_id'],$applyinfo);
        // }
        //print_r ( $project_principle );
        //print_r ( $applyinfo );
        $result1 = $db->UpdateTabData('org_info', $org_code, $applyinfo, 'org_code');
        $result2 = $db->UpdateTabData('project_principal', $project_id, $project_principle, 'project_id');
        $result3 = $db->UpdateTabData('project_info', $project_id, $linkmanInfo, 'project_id');
        $db->Close();
    }

    /**
     * 项目目的、意义及必要性
     */
    function project_mean($table_name, $project_id, $project_mean) {
        $db = new DB ();
        /* 缺少存入project_id 的值 */
        $result = $db->updateInfo($table_name, $project_id, $project_mean);
        echo $result;
        $db->Close();
    }

    function project_summary($table_name, $project_id, $project_summary) {
        $db = new DB ();
        /* 缺少存入project_id 的值 */
        //谁新建的项目 就把谁的信息 插入到项目project_info表中  跟着项目走  By  李明
        $user_id=$_SESSION["user_id"];
        if(isset($user_id)){
            $res=$db->GetInfo1($user_id,"login_info","id");
            $project_summary["linkman"]=$res["realname"];
            $project_summary["linkman_contact"]=$res["celphone"];
            $project_summary["linkman_email"]=$res["email"];
        }
        
        $result = $db->updateInfo($table_name, $project_id, $project_summary);
        echo $result;
        $db->Close();
    }
    
    function project_summary_genious( $project_id, $project_summary_genious) {
    	$db = new DB ();
    	$result = $db -> UpdateData1('project_info', $project_id, $project_summary_genious, 'project_id');
    	echo $result;
    	$db->Close();
    }
    

    function project_status($table_name, $project_id, $project_status) {
        $db = new DB ();
        $result = $db->updateInfo($table_name, $project_id, $project_status);
        echo $result;
        $db->Close();
    }

    function project_target($table_name, $project_id, $project_target) {
        $db = new DB ();
        $result = $db->updateInfo($table_name, $project_id, $project_target);
        echo $result;
        $db->Close();
    }

    function project_content($table_name, $project_id, $project_content) {
        $db = new DB ();
        $result = $db->updateInfo('project_info', $project_id, $project_content);
        echo $result;
        $db->Close();
    }

    /**
     * 2015.09.28注释
     */
    function project_techway($table_name, $project_id, $project_techway) {
        $db = new DB ();
        $result = $db->updateInfo($table_name, $project_id, $project_techway);
        echo $result;
        $db->Close();
    }

    function project_ann($table_name, $project_id, $project_ann) {
        $db = new DB ();
        $i = 0;
        foreach ($project_ann as $tmp) {
            if ($tmp ['plan_year'] != '' || $tmp ['plan_content' != '']) {
                $result = $db->updateInfo('project_ann_plan', $project_id, $tmp);
            }
            $i ++;
        }
        $db->Close();
    }

    function project_risk($table_name, $project_id, $project_risk) {
        $db = new DB ();
        $result = $db->updateInfo('project_info', $project_id, $project_risk);
        $db->Close();
    }

    function project_expect($table_name, $project_id, $project_expect) {
        $db = new DB ();
        $result = $db->updateInfo('project_info', $project_id, $project_expect);
        $db->Close();
    }

    function project_effect($table_name, $project_id, $project_effect) {
        $db = new DB ();
        $result = $db->updateInfo('project_info', $project_id, $project_effect);
        $db->Close();
    }

    function project_member($table_name, $table_name1, $project_id, $project_joinorg, $project_leader, $project_researcher) {
        $db = new DB ();
        foreach ($project_joinorg as $tmp) {
            if ($tmp ['org_name'] != '' || $tmp ['org_duty'] != '') {
                $result = $db->updateInfo('project_org', $project_id, $project_id, $tmp);
                echo $result . "<br>";
            }
        }
        $result1 = $db->updateInfo('project_principal', $project_id, $project_leader);
        foreach ($project_researcher as $tmp1) {
            echo $tmp1 ['researcher_name'];
            if ($tmp1 ['researcher_name'] != '' || $tmp1 ['researcher_sex'] != '' || $tmp1 ['researcher_birth'] != '' || $tmp1 ['researcher_ID'] != '' && $tmp1 ['researcher_pos'] != '' || $tmp1 ['researcher_job'] != '' || $tmp1 ['researcher_edu'] != '' || $tmp1 ['researcher_major'] != '' || $tmp1 ['researcher_work'] != '' || $tmp1 ['researcher_org'] != '') {
                $result2 = $db->updateInfo('rsearchers', $project_id, $tmp1);
                echo $result2;
            }
        }
    }

    function setupProject($project_id) {
        $db = new DB ();
        $sql = "update project_info set project_condition=2 where project_id='$project_id'";
        $result = $db->Update($sql);

        if ($result > 0) {
            $data ['code'] = 1;
        } else {
            $data ['code'] = 0;
        }
        echo json_encode($data);
    }

    /**
     * 禁止项目启动;
     */
    function prohibit($name, $data, $prohibit_name) {
        $db = new DB ();
        $result = $db->UpdateData1($name, $prohibit_name, $data, 'name');
        echo $result;
        $db->Close();
    }

    function updateDate($name, $date, $project_name) {
        $db = new DB ();
        $result = $db->UpdateData1($name, $project_name, $date, 'name');
        echo $result;
        $db->Close();
    }

    function saveprojectmoney($project_info, $equipment, $total_fund, $year, $p_m_year, $t_1, $t_2, $t_3, $o_1, $o_2, $o_3, $project_id) {
        $db = new DB ();
// 		$db->UpdateData1 ( "project_info", $project_id, $project_info, "project_id" );
// 		$db->Delete ( "delete  from equipment where project_id= '$project_id' " );
// 		foreach ( $equipment as $val ) {
// 			$db->InsertData ( equipment, $val );
// 		}
        $count = 0;
        foreach ($total_fund as $temp) {
// 			print_r($temp);
// 			$db->UpdateData2 ( "fund_src", $project_id, util::getparame ( 'fund_total', $temp ), 'project_id', util::gettime ( - $count ), "the_year" );
            $db->UpdateData2("fund_src", $project_id, util::getparame('fund_total', $temp, array('project_id' => $project_id, 'the_year' => $year[$count])), 'project_id', $year[$count], "the_year");
            $count++;
        }
// 		$count = 0;
// 		$db->UpdateData2 ( "project_fund_tech", $project_id, util::getparame ( 'tech_total', $t_1 ,array('project_id'=>$project_id,'the_year'=>$p_m_year[$count])), 'project_id', $p_m_year[$count], "the_year" );
// 		$db->UpdateData2 ( "project_fund_other", $project_id, util::getparame ( 'other_total', $o_1,array('project_id'=>$project_id,'the_year'=>$p_m_year[$count])), 'project_id', $p_m_year[$count], "the_year" );
// 		$count ++;
// 		$db->UpdateData2 ( "project_fund_tech", $project_id, util::getparame ( 'tech_total', $t_2 ,array('project_id'=>$project_id,'the_year'=>$p_m_year[$count])), 'project_id', $p_m_year[$count], "the_year" );
// 		$db->UpdateData2 ( "project_fund_other", $project_id, util::getparame ( 'other_total', $o_2 ,array('project_id'=>$project_id,'the_year'=>$p_m_year[$count])), 'project_id', $p_m_year[$count], "the_year" );
// 		$count ++;
// 		$db->UpdateData2 ( "project_fund_tech", $project_id, util::getparame ( 'tech_total', $t_3,array('project_id'=>$project_id,'the_year'=>$p_m_year[$count])), 'project_id',$p_m_year[$count], "the_year" );
// 		$db->UpdateData2 ( "project_fund_other", $project_id, util::getparame ( 'other_total', $o_3,array('project_id'=>$project_id,'the_year'=>$p_m_year[$count]) ), 'project_id',$p_m_year[$count], "the_year" );

        $db->Close();
    }

    /*
     * task 
     */

    function task_project_target($table_name, $project_id, $project_target) {
        $db = new DB();
        $result = $db->updateInfo($table_name, $project_id, $project_target);
        echo $result;
        $db->Close();
    }

    /* 	function findprojectmoney($project_id) {
      $db = new DB ();
      $appJSON = array ();

      $fund_src0 = $db->GetInfo2 ( $project_id, 'fund_src', 'project_id', util::gettime ( - 2 ), "the_year" );
      $fund_src1 = $db->GetInfo2 ( $project_id, 'fund_src', 'project_id', util::gettime ( - 1 ), "the_year" );
      $fund_src2 = $db->GetInfo2 ( $project_id, 'fund_src', 'project_id', util::gettime ( 0 ), "the_year" );
      $t_1 = $db->GetInfo2 ( $project_id, 'project_fund_tech', 'project_id', util::gettime ( - 2 ), "the_year" );

      $t_2 = $db->GetInfo2 ( $project_id, 'project_fund_tech', 'project_id', util::gettime ( - 1 ), "the_year" );

      $t_3 = $db->GetInfo2 ( $project_id, 'project_fund_tech', 'project_id', util::gettime ( 0 ), "the_year" );

      $o_1 = $db->GetInfo2 ( $project_id, 'project_fund_other', 'project_id', util::gettime ( - 2 ), "the_year" );

      $o_2 = $db->GetInfo2 ( $project_id, 'project_fund_other', 'project_id', util::gettime ( - 1 ), "the_year" );

      $o_3 = $db->GetInfo2 ( $project_id, ' project_fund_other', 'project_id', util::gettime ( 0 ), "the_year" );
      $res = $db->GetInfo1 ( "project_id", "project_info", project_id );
      $param1 = ( array ) util::str2arr ( $fund_src0 ['fund_total'] );
      $param2 = ( array ) util::str2arr ( $fund_src1 ['fund_total'] );
      $param3 = ( array ) util::str2arr ( $fund_src2 ['fund_total'] );
      $count = 0;
      foreach ( $param1 as $val ) {
      $appJSON ['total1_fund[' . $count . ']'] = $param1 [$count];
      $appJSON ['total2_fund[' . $count . ']'] = $param2 [$count];
      $appJSON ['total3_fund[' . $count . ']'] = $param3 [$count];
      $count ++;
      }

      $p1 = ( array ) util::str2arr ( $t_1 ['tech_total'] );
      $p2 = ( array ) util::str2arr ( $t_2 ['tech_total'] );
      $p3 = ( array ) util::str2arr ( $t_3 ['tech_total'] );
      $p4 = ( array ) util::str2arr ( $o_1 ['other_total'] );
      $p5 = ( array ) util::str2arr ( $o_1 ['other_total'] );
      $p6 = ( array ) util::str2arr ( $o_1 ['other_total'] );
      for($i = 0; $i < 11; $i ++) {
      $appJSON ['teach1_fund[' . $i . ']'] = $p1 [$i];
      $appJSON ['teach2_fund[' . $i . ']'] = $p2 [$i];
      $appJSON ['teach3_fund[' . $i . ']'] = $p3 [$i];
      $appJSON ['other1_fund[' . $i . ']'] = $p4 [$i];
      $appJSON ['other2_fund[' . $i . ']'] = $p5 [$i];
      $appJSON ['other3_fund[' . $i . ']'] = $p6 [$i];
      }
      $appJSON ['project_match'] = $res ['project_match'];
      echo json_encode ( $appJSON );
      $db->close ();
      } */
// 	function saveTotalFund($project_fund_tech,$fund_src_add,$equipment, $bgt_fund, $reduce_fund, $actual_fund, $teach_budget_fund, $teach_reduce_fund, $teach_adjust_fund, 
// /* 
//     /*
//      * 更改项目实施方案的状态信息（更改为审核中的状态）
//      */
//     function execute_solution($project_id)
//     {
//         $db = new DB();
//         $data['last_modify'] = strtotime("now");
//         $data['table_status'] = 2;
//         $result_table = $db->UpdateData2('table_status', '项目实施方案', $data, 'table_name', $project_id, 'project_id');
//         if ($result_table > 0) {
//             $result_table['code'] = 1;
//         } else {
//             $result_table['code'] = 0;
//         }
//         echo $result_table;
//         $db->Close();
//     }
//     /*
//      * 更改专家论证意见的状态信息（更改为审核中的状态）
//      *
//      */
//     function expert_solution()
//     {
//         $project_id = $_SESSION['project_id'];
//         $db = new DB();
//         $data['last_modify'] = strtotime("now");
//         $data['table_status'] = 2;
//         $result_table = $db->UpdateData2('table_status', '专家名单及专家论证意见', $data, 'table_name', $project_id, 'project_id');
//         if ($result_table > 0) {
//             $result_table['code'] = 1;
//         } else {
//             $result_table['code'] = 0;
//         }
//         echo $result_table;
//         $db->Close();
//     }
//     /*
//      * 更改北京市通州区科技计划项目调整申请表状态（更改为审核中的状态信息）
//      */
//     function modify_solution()
//     {
//         $project_id = $_SESSION['project_id'];
//         $db = new DB();
//         $data['last_modify'] = strtotime("now");
//         $data['table_status'] = 2;
//         $result_table = $db->UpdateData2('table_status', '北京市通州区科技计划项目调整申请表', $data, 'table_name', $project_id, 'project_id');
//         if ($result_table > 0) {
//             $result_table['code'] = 1;
//         } else {
//             $result_table['code'] = 0;
//         }
//         echo $result_table;
//         $db->Close();
//     }
//     /*
//      * 更改项目中期报告状态（更改为审核中的状态信息）
//      */
//     function middle_solution()
//     {
//         $project_id = $_SESSION['project_id'];
//         $db = new DB();
//         $data['last_modify'] = strtotime("now");
//         $data['table_status'] = 2;
//         $result_table = $db->UpdateData2('table_status', '项目中期报告', $data, 'table_name', $project_id, 'project_id');
//         if ($result_table > 0) {
//             $result_table['code'] = 1;
//         } else {
//             $result_table['code'] = 0;
//         }
//         echo $result_table;
//         $db->Close();
//     }
//     /*
//      * 更改项目项目验收专家组意见（更改为审核中的状态信息）
//      */
//     function expertProAccept()
//     {
//         $project_id = $_SESSION['project_id'];
//         $db = new DB();
//         $data['last_modify'] = strtotime("now");
//         $data['table_status'] = 2;
//         $result_table = $db->UpdateData2('table_status', '项目验收专家组意见', $data, 'table_name', $project_id, 'project_id');
//         if ($result_table > 0) {
//             $result_table['code'] = 1;
//         } else {
//             $result_table['code'] = 0;
//         }
//         echo $result_table;
//         $db->Close();
//     }
//     function acceptSummary()
//     {
//         $project_id = $_SESSION['project_id'];
//         $db = new DB();
//         $data['last_modify'] = strtotime("now");
//         $data['table_status'] = 2;
//         $result_table = $db->UpdateData2('table_status', '项目总结报告书', $data, 'table_name', $project_id, 'project_id');
//         if ($result_table > 0) {
//             $result_table['code'] = 1;
//         } else {
//             $result_table['code'] = 0;
//         }
//         echo $result_table;
//         $db->Close();
//     }
//     function saveOrgInfo($table_name, $project_id, $org_info, $org_info1)
//     {
//         $project_id = $_SESSION['project_id'];
//         $db = new DB();
//         $result = $db->updateInfo($table_name, $project_id, $org_info);
//         echo $result;
//         $result1 = $db->updateInfo($table_name, $project_id, $org_info1);
//         echo $result1;
//         $data['last_modify'] = strtotime("now");
//         $data['table_status'] = 1;
//         $result_table = $db->UpdateData2('table_status', '项目任务书', $data, 'table_name', $project_id, 'project_id');
//         $db->Close();
//     }
//     /**
//      * 显示项目专家意见和主管意见;
//      */
//     function findOpinInfo($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findOpin($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findOpin($id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'leader_opinion' => $result['leader_opinion'],
//             'org_opinion' => $result['org_opinion']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 显示项目意义
//      */
//     function findProjectMean($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findProMean($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProMean($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'project_meaning' => $result['project_meaning']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 显示项目国内外发展现状
//      */
//     function findProStatus($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findProjectStatus($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectStatus($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'project_status' => $result['project_status']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 显示项目任务、目标与考核指标
//      */
//     function findProTarget($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findProjectTarget($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectTarget($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'project_mission' => $result['project_mission'],
//             'project_aim' => $result['project_aim'],
//             'project_kpi' => $result['project_kpi']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 显示项目研发内容
//      */
//     function findProContent($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findProjectContent($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectContent($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'project_content' => $result['project_content']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 显示项目技术方案与技术路线
//      */
//     function findProTech($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findProjectTech($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectTech($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'tech_way' => $result['tech_way'],
//             'project_manage' => $result['project_manage'],
//             'delegation_task' => $result['delegation_task']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 显示项目遇到的风险;
//      */
//     function findProRisk($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findProjectRisk($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectRisk($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'project_risk' => $result['project_risk']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 显示项目预期成果形式、知识产权归属及管理
//      */
//     function findProExpert($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findProjectExpert($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectExpert($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'project_expect' => $result['project_expect']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 项目完成后的经济社会效益分析与成果推广方案
//      */
//     function findProEconomy($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findProjectEconomy($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectEconomy($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'project_effect' => $result['project_effect']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      *
//      * @param project_id $project_id            
//      * @param 数据库名 $name            
//      * @param 字段名 $tid            
//      */
//     function findProSummary($org_code, $name, $tid, $dep_type, $type_name)
//     {
//         if ($org_code != null) {
//             $this->findProjectSummary($org_code, $name, $tid, $dep_type, $type_name);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectSummary($org_code, $name, $tid, $dep_type, $type_name)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($org_code, $name, $tid);
//         switch ($dep_type) {
//             case 0:
//                 $department = '发展计划科';
//                 break;
//             case 1:
//                 $department = '知识产权科';
//                 break;
//             case 2:
//                 $department = '科技综合科';
//                 break;
//         }
//         $result_type = $db->GetInfo1($type_name, 'project_type', 'name');
//         if($result_type['apply_end'] != null){
//             $result['project_end'] = date("Y-m-d", $result_type['apply_end']);
//         }
//         else{
//             $result['project_end'] = null;
//         }
//         $result['project_start'] = date("Y-m-d", $result_type['apply_start']);
//         $org_code = $result['org_code'];
//         // $result_org = $db->GetInfo1 ( $org_code, 'org_info', 'org_code' );
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'project_name' => $result['project_name'],
//             'tech_area' => $result['tech_area'],
//             'project_type' => $result_type['name'],
//             'project_start' => $result['project_start'],
//             'project_end' => $result['project_end'],
//             'department' => $department,
//             'project_engineer' => $result_type['project_leader'],
//             'org_name' => $result['org_name']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     function findProInfo($project_id)
//     {
//         $db = new DB();
// //         echo $project_id."hhaa";
//         $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
//         // echo $result['project_type']."1111";
//         $result1 = $db->GetInfo1($result['org_code'], 'org_info', 'org_code');
//         // echo $result['project_type']."hahah";
//         $result2 = $db->GetInfo1($result['project_type'], 'project_type', 'name');
//         $result3['project_start'] = date("Y-m-d", $result2['apply_start']);
//         if($result2['apply_end'] != null){
//             $result3['project_end'] = date("Y-m-d", $result2['apply_end']);
//         }
//         else{
//             $result3['project_end'] = null;
//         }
//         $appJSON = array(
//             'project_name' => $result['project_name'],
//             'business_id' => $result['business_id'],
//             'tech_area' => $result['tech_area'],
//         	'project_type' => $result['project_type'],
//         	'project_engineer' => $result['project_engineer'],
//             'project_start' => $result3['project_start'],
//             'project_end' => $result3['project_end'],
//             'department' => $result['department'],
// //             'project_engineer' => $result['project_leader'],
//             'undertake_id' => $result1['org_name']
//         );
//         echo json_encode($appJSON);
//     }
//     function findProInfoB($project_id)
//     {
//         $db = new DB();
//         //         echo $project_id."hhaa";
//         $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
//         // echo $result['project_type']."1111";
//         $result1 = $db->GetInfo1($result['org_code'], 'org_info', 'org_code');
//         // echo $result['project_type']."hahah";
//         $result2 = $db->GetInfo1($result['project_type'], 'project_type', 'name');
//         $result3['project_start'] = date("Y-m-d", floatval($result2['apply_start']));
//         $result3['project_end'] = date("Y-m-d", floatval ($result2['apply_end']));
//         $appJSON = array(
//             'project_name' => $result['project_name'],
//             'project_id' => $result['project_id'],
//             'tech_area' => $result['tech_area'],
//             'project_type' => $result['project_type'],
//             'project_engineer' => $result['project_engineer'],
//             'project_start' => $result3['project_start'],
//             'project_end' => $result3['project_end'],
//             'department' => $result['department'],
//             //             'project_engineer' => $result['project_leader'],
//             'undertake_id' => $result1['org_name']
//         );
//         echo json_encode($appJSON);
//     }
//     /**
//      * 显示项目审核意见
//      */
//     function findProCheck($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findProjectCheck($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectCheck($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'office_opinion' => $result['office_opinion'],
//             'head_opinion' => $result['head_opinion'],
//             'director_opinion' => $result['director_opinion']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 显示项目其他条款
//      */
//     function findOthCondition($project_id, $name, $tid)
//     {
//         if ($project_id != null) {
//             $this->findOtherCondition($project_id, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findOtherCondition($project_id, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($project_id, $name, $tid);
//         $appJSON = array(
//             'project_id' => $result['project_id'],
//             'other_condition' => $result['other_condition']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     /**
//      * 显示单位基本信息;
//      */
//     function findProOrg($org_code, $project_id)
//     {
//         $db = new DB();
//         // 参数分别是： 主键值 数据库表名 主键名
//         //echo $project_id."haha";
//         //echo $org_code;
//         $result = $db->GetInfo1($org_code, 'org_info', 'org_code');
//         $result2 = $db->GetInfo1($project_id, 'project_principal', 'project_id');
// //         echo $org_code;
//         $appJSON = array(
//             'org_code' => $result['org_code'],
//             'relationship' => $result['relationship'],
//             'org_name' => $result['org_name'],
//             'legal_person' => $result['legal_person'],
//             'org_type' => $result['org_type'],
//             'org_address' => $result['org_address'],
//             'register_town' => $result['register_town'],
//             'register_time' => $result['register_time'],
//             'postal' => $result['postal'],
//             'fax' => $result['fax'],
//             'email' => $result['email'],
//             'certi_code' => $result['certi_code'],
//             'develop_area' => $result['develop_area'],
//             'org_leader' => $result['org_leader'],
//             'leader_contact' => $result['leader_contact'],
//             'dev_leader' => $result['dev_leader'],
//             'dev_contact' => $result['dev_contact'],
//             'finance_leader' => $result['finance_leader'],
//             'finance_contact' => $result['finance_contact'],
//             'linkman' => $result['linkman'],
//             'linkman_contact' => $result['linkman_contact'],
//             'ratification_num' => $result['ratification_num'],
//             'leader_name' => $result2['leader_name'],
//             'leader_phone' => $result2['leader_phone']
//         );
//         // 这里主要是选择一个用户必须填写的项作为判断当前是否填满的标示，这里选择了注册时间
//         if ($result['register_town'] != null) {
//             $appJSON['mark'] = '1';
//         } else {
//             $appJSON['mark'] = '0';
//         }
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     //2015.11.28 李明写
//   /*   function findProOrg($org_code, $name, $tid, $project_id) {
//         if ($org_code != null) {
//             $this->findProjectOrg ( $org_code, $name, $tid, $project_id );
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectOrg($org_code, $name, $tid, $project_id) {
//         $db = new DB ();
//         $result = $db->GetInfo1 ( $org_code, $name, $tid );
//         $result2 = $db->GetInfo1 ( $project_id, "project_principal", "project_id" );
//         $appJSON = array (
//             'org_code' => $result ['org_code'],
//             'relationship' => $result ['relationship'],
//             'org_name' => $result ['org_name'],
//             'legal_person' => $result ['legal_person'],
//             'org_type' => $result ['org_type'],
//             'org_address' => $result ['org_address'],
//             'register_town' => $result ['register_town'],
//             'register_time' => $result ['register_time'],
//             'postal' => $result ['postal'],
//             'fax' => $result ['fax'],
//             'email' => $result ['email'],
//             'certi_code' => $result ['certi_code'],
//             'develop_area' => $result ['develop_area'],
//             'org_leader' => $result ['org_leader'],
//             'leader_contact' => $result ['leader_contact'],
//             'dev_leader' => $result ['dev_leader'],
//             'dev_contact' => $result ['dev_contact'],
//             'finance_leader' => $result ['finance_leader'],
//             'finance_contact' => $result ['finance_contact'],
//             'linkman' => $result ['linkman'],
//             'linkman_contact' => $result ['linkman_contact'],
//             'ratification_num' => $result ['ratification_num'],
//             'leader_name' => $result2 ['leader_name'],
//             'leader_phone' => $result2 ['leader_phone']
//         );
//         // 这里主要是选择一个用户必须填写的项作为判断当前是否填满的标示，这里选择了注册时间
//         if ($result ['register_town'] != null) {
//             $appJSON ['mark'] = '1';
//         } else {
//             $appJSON ['mark'] = '0';
//         }
//         echo json_encode ( $appJSON );
//         $db->close ();
//     } */
//     // 这个有问题，不能现在显示出结果啊!!!!!!
//     function findPlanPart($org_code, $name, $tid)
//     {
//         if ($org_code != null) {
//             $this->findPlanParties($org_code, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findPlanParties($org_code, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($org_code, $name, $tid);
//         $appJSON = array(
//             'org_code' => $result['org_code'],
//             'org_name' => $result['org_name'],
//             'org_address' => $result['org_address'],
//             'postal' => $result['postal'],
//             'fax' => $result['fax'],
//             'email' => $result['email'],
//             'org_leader' => $result['org_leader'],
//             'phone' => $result['phone'],
//             'linkman_contact' => $result['linkman_contact'],
//             'ratification_num' => $result['ratification_num']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     // 这个有问题，不能现在显示出结果啊!!!!!!
//     function findProSum1($org_code, $name, $tid)
//     {
//         if ($org_code != null) {
//             $this->findProjectSum1($org_code, $name, $tid);
//         } else {
//             echo '0';
//         }
//     }
//     function findProjectSum1($org_code, $name, $tid)
//     {
//         $db = new DB();
//         $result = $db->GetInfo1($org_code, $name, $tid);
//         $appJSON = array(
//             'org_code' => $result['org_code'],
//             'org_name' => $result['org_name'],
//             'org_address' => $result['org_address'],
//             'postal' => $result['postal'],
//             'fax' => $result['fax'],
//             'email' => $result['email'],
//             'org_leader' => $result['org_leader'],
//             'phone' => $result['phone'],
//             'linkman_contact' => $result['linkman_contact'],
//             'ratification_num' => $result['ratification_num']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     // $org_code, 'org_info', 'org_code',$project_id
//     function findProMember($org_code, $name, $tid, $project_id)
//     {
//         $db = new DB();
//         $result_org = $db->GetInfo1($org_code, $name, $tid);
//         $project_id = $_SESSION['project_id'];
//         $sql = "select * from project_info where project_id = '$project_id'";
//         $result_pro = $db->Select($sql);
//         $sql1 = "select * from project_org where project_id = '$project_id'";
//         $result_prorg = $db->Select($sql1);
//         $appJSON = array(
//             'org_name' => $result_org['org_name'],
//             'leader_name' => $result_pro[0]['leader_name'],
//             'leader_sex' => $result_pro[0]['leader_sex'],
//             'leader_birth' => $result_pro[0]['leader_birth'],
//             'leader_ID' => $result_pro[0]['leader_ID'],
//             'tech_pos' => $result_pro[0]['tech_pos'],
//             'leader_edu' => $result_pro[0]['leader_edu'],
//             'leader_major' => $result_pro[0]['leader_major'],
//             'leader_job' => $result_pro[0]['leader_job'],
//             'leader_phone' => $result_pro[0]['leader_phone'],
//             'leader_address' => $result_pro[0]['leader_address'],
//             'leader_postal' => $result_pro[0]['leader_postal'],
//             'leader_fax' => $result_pro[0]['leader_fax'],
//             'leader_email' => $result_pro[0]['leader_email'],
//             'leader_tele' => $result_pro[0]['leader_tele'],
//             'leader_achieve' => $result_pro[0]['leader_achieve'],
//             'org_name0' => $result_prorg[0]['org_name'],
//             'org_name1' => $result_prorg[1]['org_name'],
//             'org_name2' => $result_prorg[2]['org_name'],
//             'org_mission0' => $result_prorg[0]['org_duty'],
//             'org_mission1' => $result_prorg[1]['org_duty'],
//             'org_mission2' => $result_prorg[2]['org_duty']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     function findProAnn($name, $id, $tid)
//     {
//         $db = new DB();
//         $sql = "select * from project_ann_plan where $tid = '$id' ";
//         $result = $db->Select($sql);
//         $appJSON = array(
//             'plan_year[0]' => $result[0]['plan_year'],
//             'plan_content[0]' => $result[0]['plan_content'],
//             'plan_year[1]' => $result[1]['plan_year'],
//             'plan_content[1]' => $result[1]['plan_content'],
//             'plan_year[2]' => $result[2]['plan_year'],
//             'plan_content[2]' => $result[2]['plan_content']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     function findExpertSigns($name, $id, $tid)
//     {
//         $db = new DB();
//         $result_pro = $db->GetInfo1($id, $name, $tid);
//         $project_id = $_SESSION['project_id'];
//         $result_pro = $db->GetInfo1($project_id, 'project_info', 'project_id');
//         $appJSON = array(
//             'project_name' => $result_pro['project_name'],
//             'project_id' => $result_pro['project_id'],
//             'undertake_id' => $result_pro['undertake_id'],
//             'principal_id' => $result_pro['principal_id'],
//             'project_money' => $result_pro['project_money'],
//             'project_argtime' => $result_pro['project_argtime']
//         );
//         echo json_encode($appJSON);
//         $db->close();
//     }
//     function isCheck($project_id, $value)
//     {
//         // 对数据库进行修改操作
//         $db = new DB();
//         if ($value == 1) {
//             // 说明通过审核
//             $data = array(
//                 'table_status' => '4',
//                 'project_stage' => 4
//             );
//             $res = $db->UpdateData1('table_status', $project_id, $data, 'project_id');
//             $db->close();
//             return $res;
//         } else {
//             // 审核不通过
//             $data = array(
//                 'table_status' => '5',
//                 'project_stage' => 5
//             );
//             $res = $db->UpdateData1('table_status', $project_id, $data, 'project_id');
//             $db->close();
//             return $res;
//         }
//     }
//     function org_info($org_code, $project_id, $project_principle, $applyinfo)
//     {
//         $db = new DB();
//         // $applyinfo['year']=date('Y',time());
//         // if($_SESSION['app_id']==''&&$_SESSION['app_id']==null){
//         // $applyinfo['org_id']=$_SESSION['org_id'];
//         // $result = $db->UpdateTabData ( "org_info", $org_id, $applyinfo, $tid );
//         // $result = $db->UpdateTabData ( "project_principal", $project_id, $project_principle, "project_id" );
//         // $_SESSION['app_id']=$result;
//         // }else{
//         // $result=$db->UpdateData('application',$_SESSION['app_id'],$applyinfo);
//         // }
//         print_r($project_principle);
//         print_r($applyinfo);
//         $result1 = $db->UpdateTabData('org_info', $org_code, $applyinfo, 'org_code');
//         $result2 = $db->UpdateTabData('project_principal', $project_id, $project_principle, 'project_id');
//         $db->Close();
//     }
//     function project_mean($table_name, $project_id, $project_mean)
//     {
//         $db = new DB();
//         /* 缺少存入project_id 的值 */
//         $result = $db->updateInfo($table_name, $project_id, $project_mean);
//         echo $result;
//         $db->Close();
//     }
//     function project_summary($table_name, $project_id, $project_summary)
//     {
//         $db = new DB();
//         /* 缺少存入project_id 的值 */
//         $result = $db->updateInfo($table_name, $project_id, $project_summary);
//         echo $result;
//         $db->Close();
//     }
//     function project_status($table_name, $project_id, $project_status)
//     {
//         $db = new DB();
//         $result = $db->updateInfo($table_name, $project_id, $project_status);
//         echo $result;
//         $db->Close();
//     }
//     function project_target($table_name, $project_id, $project_target)
//     {
//         $db = new DB();
//         $result = $db->updateInfo($table_name, $project_id, $project_target);
//         echo $result;
//         $db->Close();
//     }
//     function task_project_target($table_name, $project_id, $project_target)
//     {
//         $db = new DB();
//         $result = $db->updateInfo($table_name, $project_id, $project_target);
//         echo $result;
//         $db->Close();
//     }
//     function project_content($table_name, $project_id, $project_content)
//     {
//         $db = new DB();
//         $result = $db->updateInfo('project_info', $project_id, $project_content);
//         echo $result;
//         $db->Close();
//     }
//     function task_project_content($table_name, $project_id, $project_content)
//     {
//         $db = new DB();
//         $result = $db->updateInfo('project_info', $project_id, $project_content);
//         echo $result;
//         $db->Close();
//     }
//     function project_techway($table_name, $project_id, $project_techway)
//     {
//         $db = new DB();
//         $result = $db->updateInfo($table_name, $project_id, $project_techway);
//         echo $result;
//         $db->Close();
//     }
//     function project_ann($table_name, $project_id, $project_ann)
//     {
//         $db = new DB();
//         $i = 0;
//         foreach ($project_ann as $tmp) {
//             if ($tmp['plan_year'] != '' || $tmp['plan_content' != '']) {
//                 $result = $db->updateInfo('project_ann_plan', $project_id, $tmp);
//             }
//             $i ++;
//         }
//         $db->Close();
//     }
//     function project_risk($table_name, $project_id, $project_risk)
//     {
//         $db = new DB();
//         $result = $db->updateInfo('project_info', $project_id, $project_risk);
//         $db->Close();
//     }
//     function project_expect($table_name, $project_id, $project_expect)
//     {
//         $db = new DB();
//         $result = $db->updateInfo('project_info', $project_id, $project_expect);
//         $db->Close();
//     }
//     function project_effect($table_name, $project_id, $project_effect)
//     {
//         $db = new DB();
//         $result = $db->updateInfo('project_info', $project_id, $project_effect);
//         $db->Close();
//     }
//     function project_member($table_name, $table_name1, $project_id, $project_joinorg, $project_leader, $project_researcher)
//     {
//         $db = new DB();
//         foreach ($project_joinorg as $tmp) {
//             if ($tmp['org_name'] != '' || $tmp['org_duty'] != '') {
//                 $result = $db->updateInfo('project_org', $project_id, $project_id, $tmp);
//                 echo $result . "<br>";
//             }
//         }
//         $result1 = $db->updateInfo('project_principal', $project_id, $project_leader);
//         foreach ($project_researcher as $tmp1) {
//             echo $tmp1['researcher_name'];
//             if ($tmp1['researcher_name'] != '' || $tmp1['researcher_sex'] != '' || $tmp1['researcher_birth'] != '' || $tmp1['researcher_ID'] != '' && $tmp1['researcher_pos'] != '' || $tmp1['researcher_job'] != '' || $tmp1['researcher_edu'] != '' || $tmp1['researcher_major'] != '' || $tmp1['researcher_work'] != '' || $tmp1['researcher_org'] != '') {
//                 $result2 = $db->updateInfo('rsearchers', $project_id, $tmp1);
//                 echo $result2;
//             }
//         }
//     }
//     function setupProject($project_id)
//     {
//         $db = new DB();
//         $sql = "update project_info set project_condition=2 where project_id='$project_id'";
//         $result = $db->Update($sql);
//         if ($result > 0) {
//             $data['code'] = 1;
//         } else {
//             $data['code'] = 0;
//         }
//         echo json_encode($data);
//     }
//     function prohibit($name, $data, $prohibit_name)
//     {
//         $db = new DB();
//         $result = $db->UpdateData1($name, $prohibit_name, $data, 'name');
//         echo $result;
//         $db->Close();
//     }
//     function updateDate($name, $date, $project_name)
//     {
//         $db = new DB();
//         $result = $db->UpdateData1($name, $project_name, $date, 'name');
//         echo $result;
//         $db->Close();
//     }
//     function saveprojectmoney($project_info, $equipment, $total_fund, $t_1, $t_2, $t_3, $o_1, $o_2, $o_3, $project_id)
//     {
//         $db = new DB();
//         $db->UpdateData1("project_info", $project_id, $project_info, "task_project_id");
//         $db->Delete("delete  from equipment where project_id= '$project_id' ");
//         foreach ($equipment as $val) {
//             $db->InsertData(equipment, $val);
//         }
//         $count = 2;
//         foreach ($total_fund as $temp) {
//             $db->UpdateData2("fund_src", $project_id, util::getparame('fund_total', $temp), 'task_project_id', util::gettime(- $count), "the_year");
//             $count --;
//         }
//         $count = 2;
//         $db->UpdateData2("project_fund_tech", $project_id, util::getparame('tech_total', $t_1), 'task_project_id', util::gettime(- $count), "the_year");
//         $db->UpdateData2("project_fund_other", $project_id, util::getparame('tech_total', $o_1), 'task_project_id', util::gettime(- $count), "the_year");
//         $count --;
//         $db->UpdateData2("project_fund_tech", $project_id, util::getparame('tech_total', $t_2), 'task_project_id', util::gettime(- $count), "the_year");
//         $db->UpdateData2("project_fund_other", $project_id, util::getparame('tech_total', $o_2), 'task_project_id', util::gettime(- $count), "the_year");
//         $count --;
//         $db->UpdateData2("project_fund_tech", $project_id, util::getparame('tech_total', $t_3), 'task_project_id', util::gettime(- $count), "the_year");
//         $db->UpdateData2("project_fund_other", $project_id, util::getparame('tech_total', $o_3), 'task_project_id', util::gettime(- $count), "the_year");
//         $db->Close();
//     } */

    /**
     * 备份
     * @param unknown $project_info
     * @param unknown $equipment
     * @param unknown $total_fund
     * @param unknown $t_1
     * @param unknown $t_2
     * @param unknown $t_3
     * @param unknown $o_1
     * @param unknown $o_2
     * @param unknown $o_3
     * @param unknown $project_id
     */
    function task_saveprojectmoney($project_info, $equipment, $total_fund, $year, $p_m_year, $t_1, $t_2, $t_3, $o_1, $o_2, $o_3, $project_id) {
        echo $year;
        $db = new DB ();
        $db->UpdateData1("project_info", $project_id, $project_info, "project_id");
        $db->Delete("delete  from equipment where task_project_id= '$project_id' ");
        foreach ($equipment as $val) {
            $db->InsertData(equipment, $val);
        }
        $count = 0;
        foreach ($total_fund as $temp) {
            if (!empty($year[$count])) {
// 			print_r($temp);
// 			$db->UpdateData2 ( "fund_src", $project_id, util::getparame ( 'fund_total', $temp ), 'project_id', util::gettime ( - $count ), "the_year" );
                $db->UpdateData2("fund_src", $project_id, util::getparame('fund_total', $temp, array('task_project_id' => $project_id, 'the_year' => $year[$count])), 'task_project_id', $year[$count], "the_year");
            }
            $count++;
        }
        $count = 0;
        $db->UpdateData2("project_fund_tech", $project_id, util::getparame('tech_total', $t_1, array('task_project_id' => $project_id, 'the_year' => $p_m_year[$count])), 'task_project_id', $p_m_year[$count], "the_year");
        $db->UpdateData2("project_fund_other", $project_id, util::getparame('other_total', $o_1, array('task_project_id' => $project_id, 'the_year' => $p_m_year[$count])), 'task_project_id', $p_m_year[$count], "the_year");
        $count ++;
        $db->UpdateData2("project_fund_tech", $project_id, util::getparame('tech_total', $t_2, array('task_project_id' => $project_id, 'the_year' => $p_m_year[$count])), 'task_project_id', $p_m_year[$count], "the_year");
        $db->UpdateData2("project_fund_other", $project_id, util::getparame('other_total', $o_2, array('task_project_id' => $project_id, 'the_year' => $p_m_year[$count])), 'task_project_id', $p_m_year[$count], "the_year");
        $count ++;
        $db->UpdateData2("project_fund_tech", $project_id, util::getparame('tech_total', $t_3, array('task_project_id' => $project_id, 'the_year' => $p_m_year[$count])), 'task_project_id', $p_m_year[$count], "the_year");
        $db->UpdateData2("project_fund_other", $project_id, util::getparame('other_total', $o_3, array('task_project_id' => $project_id, 'the_year' => $p_m_year[$count])), 'task_project_id', $p_m_year[$count], "the_year");

        $db->Close();
    }

    /*  function task_saveprojectmoney($project_info, $equipment, $total_fund, $t_1, $t_2, $t_3, $o_1, $o_2, $o_3, $project_id)
      {
      $db = new DB();

      $db->UpdateData1("project_info", $project_id, $project_info, "task_project_id");
      $db->Delete("delete  from equipment where task_project_id= '$project_id' ");
      foreach ($equipment as $val) {
      $db->InsertData(equipment, $val);
      }
      $count = 2;
      foreach ($total_fund as $temp) {
      $db->UpdateData2("fund_src", $project_id, util::getparame('fund_total', $temp), 'task_project_id', util::gettime(- $count), "the_year");
      $count --;
      }
      $count = 2;
      $db->UpdateData2("project_fund_tech", $project_id, util::getparame('tech_total', $t_1), 'project_id', util::gettime(- $count), "the_year");
      $db->UpdateData2("project_fund_other", $project_id, util::getparame('tech_total', $o_1), 'project_id', util::gettime(- $count), "the_year");
      $count --;
      $db->UpdateData2("project_fund_tech", $project_id, util::getparame('tech_total', $t_2), 'project_id', util::gettime(- $count), "the_year");
      $db->UpdateData2("project_fund_other", $project_id, util::getparame('tech_total', $o_2), 'project_id', util::gettime(- $count), "the_year");
      $count --;
      $db->UpdateData2("project_fund_tech", $project_id, util::getparame('tech_total', $t_3), 'project_id', util::gettime(- $count), "the_year");
      $db->UpdateData2("project_fund_other", $project_id, util::getparame('tech_total', $o_3), 'project_id', util::gettime(- $count), "the_year");

      $db->Close();
      } */

    function findprojectmoney($project_id, $flag) {
        $db = new DB();
        $appJSON = array();

        $fund_src0 = $db->GetInfo2($project_id, 'fund_src', 'project_id', util::gettime(-2), "the_year");
        $fund_src1 = $db->GetInfo2($project_id, 'fund_src', 'project_id', util::gettime(-1), "the_year");
        $fund_src2 = $db->GetInfo2($project_id, 'fund_src', 'project_id', util::gettime(0), "the_year");
        
        $t_1 = $db->GetInfo2($project_id, 'project_fund_tech', 'project_id', util::gettime(- 2), "the_year");
        $t_2 = $db->GetInfo2($project_id, 'project_fund_tech', 'project_id', util::gettime(- 1), "the_year");
        $t_3 = $db->GetInfo2($project_id, 'project_fund_tech', 'project_id', util::gettime(0), "the_year");
        
        $o_1 = $db->GetInfo2($project_id, 'project_fund_other', 'project_id', util::gettime(- 2), "the_year");
        $o_2 = $db->GetInfo2($project_id, 'project_fund_other', 'project_id', util::gettime(- 1), "the_year");
        $o_3 = $db->GetInfo2($project_id, ' project_fund_other', 'project_id', util::gettime(0), "the_year");
        $res = $db->GetInfo1($project_id, "project_info", "project_id");
        $param0 = (array) util::str2arr($fund_src0['fund_total']);
        $param1 = (array) util::str2arr($fund_src1['fund_total']);
        $param2 = (array) util::str2arr($fund_src2['fund_total']);
        $count = 0;
        foreach ($param1 as $val) {
            $appJSON['total1_fund' . $count] = ${param . $count}[0];
            $appJSON['total2_fund' . $count] = ${param . $count}[1];
            $appJSON['total3_fund' . $count] = ${param . $count}[2];
            $count ++;
        }

        $p1 = (array) util::str2arr($t_1['tech_total']);
        $p2 = (array) util::str2arr($t_2['tech_total']);
        $p3 = (array) util::str2arr($t_3['tech_total']);
        $p4 = (array) util::str2arr($o_1['other_total']);
        $p5 = (array) util::str2arr($o_2['other_total']);
        $p6 = (array) util::str2arr($o_3['other_total']);
        for ($i = 0; $i < 11; $i ++) {
            $appJSON['teach1_fund' . $i] = $p1[$i];
            $appJSON['teach2_fund' . $i] = $p2[$i];
            $appJSON['teach3_fund' . $i] = $p3[$i];
            $appJSON['other1_fund' . $i] = $p4[$i];
            $appJSON['other2_fund' . $i] = $p5[$i];
            $appJSON['other3_fund' . $i] = $p6[$i];
        }
        $appJSON['project_match'] = $res['project_match'];
        $appJSON['year0'] = util::gettime(-3);
        $appJSON['year1'] = util::gettime(-1);
        $appJSON['year2'] = util::gettime(0);
        $appJSON['p_m_year0'] = util::gettime(-2);
        $appJSON['p_m_year1'] = util::gettime(-1);
        $appJSON['p_m_year2'] = util::gettime(0);

        if ($flag == 'pdf') {
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    function findtask_projectmoney($project_id, $flag) {
        $db = new DB();
        $appJSON = array();

        $fund_src0 = $db->GetInfo2($project_id, 'fund_src', 'task_project_id', util::gettime(-2), "the_year");
        $fund_src1 = $db->GetInfo2($project_id, 'fund_src', 'task_project_id', util::gettime(- 1), "the_year");
        $fund_src2 = $db->GetInfo2($project_id, 'fund_src', 'task_project_id', util::gettime(0), "the_year");
        $t_1 = $db->GetInfo2($project_id, 'project_fund_tech', 'task_project_id', util::gettime(- 2), "the_year");
        $t_2 = $db->GetInfo2($project_id, 'project_fund_tech', 'task_project_id', util::gettime(- 1), "the_year");

        $t_3 = $db->GetInfo2($project_id, 'project_fund_tech', 'task_project_id', util::gettime(0), "the_year");

        $o_1 = $db->GetInfo2($project_id, 'project_fund_other', 'task_project_id', util::gettime(- 2), "the_year");

        $o_2 = $db->GetInfo2($project_id, 'project_fund_other', 'task_project_id', util::gettime(- 1), "the_year");

        $o_3 = $db->GetInfo2($project_id, ' project_fund_other', 'task_project_id', util::gettime(0), "the_year");
        $res = $db->GetInfo1($project_id, "project_info", "project_id");
        $param0 = (array) util::str2arr($fund_src0['fund_total']);
        $param1 = (array) util::str2arr($fund_src1['fund_total']);
        $param2 = (array) util::str2arr($fund_src2['fund_total']);
        $count = 0;
        foreach ($param1 as $val) {
            $appJSON['total1_fund[' . $count . ']'] = ${param . $count}[0];
            $appJSON['total2_fund[' . $count . ']'] = ${param . $count}[1];
            $appJSON['total3_fund[' . $count . ']'] = ${param . $count}[2];
            $count ++;
        }
        $appJSON['year[0]'] = util::gettime(-2);
        $appJSON['year[1]'] = util::gettime(-1);
        $appJSON['year[2]'] = util::gettime(0);
        $p1 = (array) util::str2arr($t_1['tech_total']);
        $p2 = (array) util::str2arr($t_2['tech_total']);
        $p3 = (array) util::str2arr($t_3['tech_total']);
        $p4 = (array) util::str2arr($o_1['other_total']);
        $p5 = (array) util::str2arr($o_2['other_total']);
        $p6 = (array) util::str2arr($o_3['other_total']);
        for ($i = 0; $i < 11; $i ++) {
            $appJSON['teach1_fund[' . $i . ']'] = $p1[$i];
            $appJSON['teach2_fund[' . $i . ']'] = $p2[$i];
            $appJSON['teach3_fund[' . $i . ']'] = $p3[$i];
            $appJSON['other1_fund[' . $i . ']'] = $p4[$i];
            $appJSON['other2_fund[' . $i . ']'] = $p5[$i];
            $appJSON['other3_fund[' . $i . ']'] = $p6[$i];
        }
        $appJSON['project_match'] = $res['project_match'];
        $appJSON['p_m_year[0]'] = util::gettime(-2);
        $appJSON['p_m_year[1]'] = util::gettime(-1);
        $appJSON['p_m_year[2]'] = util::gettime(0);

        if ($flag == 'pdf') {
            return $appJSON;
        } else {
            echo json_encode($appJSON);
        }
        $db->close();
    }

    function saveTotalFund($project_fund_tech, $fund_src_add, $equipment, $bgt_fund, $reduce_fund, $actual_fund, $teach_budget_fund, $teach_reduce_fund, $teach_adjust_fund, $teach_actual_fund, $other_budget_fund, $other_reduce_fund, $other_adjust_fund, $other_actual_fund, $project_id) {
        $db = new DB();
        $db->Delete("delete  from equipment where project_id= '$project_id' ");
        foreach ($equipment as $val) {
            $db->InsertData(equipment, $val);
        }
        $param = util::getdata($bgt_fund, $reduce_fund, $actual_fund);
        $param['project_id'] = $project_id;
        $db->updateInfo("fund_src", $project_id, $param);

        $param2 = util::getdata2($teach_budget_fund, $teach_reduce_fund, $teach_adjust_fund, $teach_actual_fund);
        $param2['project_id'] = $project_id;
        $db->updateInfo("project_fund_tech", $project_id, $param2);

        $param3 = util::getdata3($other_budget_fund, $other_reduce_fund, $other_adjust_fund, $other_actual_fund);
        $param3['project_id'] = $project_id;
        $db->updateInfo("project_fund_other", $project_id, $param3);

        $db->Close();
    }

    function findTotalFund($project_id, $flag) {
        $db = new DB();
        $appJSON = array();
        $fund_src = $db->GetInfo1($project_id, "fund_src", "project_id");
        $bgt_fund = util::str2arr($fund_src['bgt_fund']);
        $reduce_fund = util::str2arr($fund_src['reduce_fund']);
        $actual_fund = util::str2arr($fund_src['actual_fund']);
        $count = 0;
        foreach ($fund_src as $val) {
            $appJSON['bgt_fund[' . $count . ']'] = $bgt_fund[$count];
            $appJSON['reduce_fund[' . $count . ']'] = $reduce_fund[$count];
            $appJSON['actual_fund[' . $count . ']'] = $actual_fund[$count];
            $count ++;
        }

        $project_fund_tech = $db->GetInfo1($project_id, "project_fund_tech", "project_id");
        $budget_fund = util::str2arr($project_fund_tech['budget_fund']);
        $reduce_fund = util::str2arr($project_fund_tech['reduce_fund']);
        $adjust_fund = util::str2arr($project_fund_tech['adjust_fund']);
        $actual_fund = util::str2arr($project_fund_tech['actual_fund']);
        $count = 0;
        foreach ($budget_fund as $val) {
            $appJSON['teach_budget_fund[' . $count . ']'] = $budget_fund[$count];
            $appJSON['teach_reduce_fund[' . $count . ']'] = $reduce_fund[$count];
            $appJSON['teach_adjust_fund[' . $count . ']'] = $adjust_fund[$count];
            $appJSON['teach_actual_fund[' . $count . ']'] = $actual_fund[$count];
            $count ++;
        }

        $project_fund_other = $db->GetInfo1($project_id, "project_fund_other", "project_id");
        $budget_fund = util::str2arr($project_fund_other['budget_fund']);
        $reduce_fund = util::str2arr($project_fund_other['reduce_fund']);
        $adjust_fund = util::str2arr($project_fund_other['adjust_fund']);
        $actual_fund = util::str2arr($project_fund_other['actual_fund']);
        $count = 0;
        foreach ($budget_fund as $val) {
            $appJSON['other_budget_fund[' . $count . ']'] = $budget_fund[$count];
            $appJSON['other_reduce_fund[' . $count . ']'] = $reduce_fund[$count];
            $appJSON['other_adjust_fund[' . $count . ']'] = $adjust_fund[$count];
            $appJSON['other_actual_fund[' . $count . ']'] = $actual_fund[$count];
            $count ++;
        }
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->Close();
    }

    function findTotalFund2($project_id) {
        $db = new DB();
        $appJSON = array();
        $fund_src = $db->GetInfo1($project_id, "fund_src", "project_id");
        $bgt_fund = util::str2arr($fund_src['bgt_fund']);
        $reduce_fund = util::str2arr($fund_src['reduce_fund']);
        $actual_fund = util::str2arr($fund_src['actual_fund']);
        $count = 0;
        foreach ($fund_src as $val) {
            $appJSON['bgt_fund[' . $count . ']'] = $bgt_fund[$count];
            $appJSON['reduce_fund[' . $count . ']'] = $reduce_fund[$count];
            $appJSON['actual_fund[' . $count . ']'] = $actual_fund[$count];
            $count ++;
        }

        $project_fund_tech = $db->GetInfo1($project_id, "project_fund_tech", "project_id");
        $budget_fund = util::str2arr($project_fund_tech['budget_fund']);
        $reduce_fund = util::str2arr($project_fund_tech['reduce_fund']);
        $adjust_fund = util::str2arr($project_fund_tech['adjust_fund']);
        $actual_fund = util::str2arr($project_fund_tech['actual_fund']);
        $count = 0;
        foreach ($budget_fund as $val) {
            $appJSON['teach_budget_fund[' . $count . ']'] = $budget_fund[$count];
            $appJSON['teach_reduce_fund[' . $count . ']'] = $reduce_fund[$count];
            $appJSON['teach_adjust_fund[' . $count . ']'] = $adjust_fund[$count];
            $appJSON['teach_actual_fund[' . $count . ']'] = $actual_fund[$count];
            $count ++;
        }

        $project_fund_other = $db->GetInfo1($project_id, "project_fund_other", "project_id");
        $budget_fund = util::str2arr($project_fund_other['budget_fund']);
        $reduce_fund = util::str2arr($project_fund_other['reduce_fund']);
        $adjust_fund = util::str2arr($project_fund_other['adjust_fund']);
        $actual_fund = util::str2arr($project_fund_other['actual_fund']);
        $count = 0;
        foreach ($budget_fund as $val) {
            $appJSON['other_budget_fund[' . $count . ']'] = $budget_fund[$count];
            $appJSON['other_reduce_fund[' . $count . ']'] = $reduce_fund[$count];
            $appJSON['other_adjust_fund[' . $count . ']'] = $adjust_fund[$count];
            $appJSON['other_actual_fund[' . $count . ']'] = $actual_fund[$count];
            $count ++;
        }
        return $appJSON;
        $db->Close();
    }

    function changeOk($project_id, $changeOk) {
        $db = new DB();
        $res = $db->UpdateData1('project_info', $project_id, $changeOk, 'project_id');
        echo $res;
        $db->Close();
    }

    function find_attach1_info($project_id, $user_type, $table_name) {
        $db = new DB();
        $sql = "select * from table_status where project_id = '$project_id' and table_name = '$table_name'";
        $result = $db->SelectOri($sql);
        $object = mysql_fetch_object($result);
        $json = array(
            'table_status' => $object->table_status
        );
        echo json_encode($json);
        $db->Close();
    }

    function modify_repeat($project_id) {
        $db = new DB();
        // check_repeat =2 表示已经查重过了.
        $sql = "update table_status set check_repeat =2 where project_id='" . $project_id . "' and table_name='北京市通州区科技计划项目实施方案'";
        $result = $db->SelectOri($sql);
        if ($result != 0) {
            //成功
            echo "success";
        }
        $db->Close();
    }

    function failrepeat($project_id) {
        $db = new DB();
        $sql = "update project_info set isDelete=1 where project_id='" . $project_id . "'";
        $sql2 = "update table_status set check_repeat =3 where project_id='" . $project_id . "' and table_name='北京市通州区科技计划项目实施方案'";
        //echo $sql;
        $result = $db->SelectOri($sql);
        $result2 = $db->SelectOri($sql2);
        $db->Close();
    }

    function isComplete($length, $position, $table_id, $project_id) {
        $db = new DB();
        $sql = "SELECT iscomplete FROM table_status WHERE table_name='$table_id' and project_id = '$project_id'";
        $result = $db->Select($sql);
        $iscomplete = $result[0]['iscomplete'];
        //iscomplete field in database exist or not 
        if (!$iscomplete) {
            $array = array();
            if($length-1 == 0){
            	for ($i = 0; $i <= $length-1; $i++) {
            		if ($i == $position) {
            			$array[$i] = 1;
            		} else {
            			$array[$i] = 0;
            		}
            	}
            }else{
            	for ($i = 0; $i < $length-1; $i++) {
            		if ($i == $position) {
            			$array[$i] = 1;
            		} else {
            			$array[$i] = 0;
            		}
            	}
            }
           
            $iscomplete = json_encode($array);
        } else {
//    			var_dump($iscomplete);
            $iscomplete_array = json_decode($iscomplete, true);
            $iscomplete_array[$position] = 1;
            $iscomplete = json_encode($iscomplete_array);
        }
        $sql = "UPDATE table_status SET iscomplete = '$iscomplete' WHERE table_name='$table_id' and project_id = '$project_id'";
//    		echo $sql;
        $result = $result = $db->SelectOri($sql);
        $db->Close();
    }

    function update_stage($length, $position, $table_id, $project_id) {
        $db = new DB();
        $sql = "SELECT iscomplete FROM table_status WHERE table_name='$table_id' and project_id = '$project_id'";
        $result = $db->Select($sql);
        $iscomplete = $result[0]['iscomplete'];
        $array = json_decode($iscomplete, true);
        if ($array) {
            for ($i = 0; $i < $length; $i++) {
                if ($i == $position) {
                    $array[$i] = 0;
                }
            }
            $iscomplete = json_encode($array);
            $sql = "UPDATE table_status SET iscomplete = '$iscomplete' WHERE table_name='$table_id' and project_id = '$project_id'";
            $result = $result = $db->SelectOri($sql);
        }
        $db->Close();
    }

    function isComplete2($length, $position, $table_name, $project_id, $complete) {
        $db = new DB();
        $sql = "SELECT iscomplete FROM table_status WHERE table_name='$table_name' and project_id = '$project_id'";
        $result = $db->Select($sql);
        $iscomplete = $result[0]['iscomplete'];
        //iscomplete field in database exist or not 
        if (!$iscomplete) {
            $array = array();
            for ($i = 0; $i < $length-1; $i++) {
                if ($i == $position) {
                    if ($complete) {
                        $array[$i] = 1;
                    } else {
                        $array[$i] = 0;
                    }
                } else {
                    $array[$i] = 0;
                }
            }
            $iscomplete = json_encode($array);
        } else {
            $iscomplete_array = json_decode($iscomplete, true);
            if ($complete) {
                $iscomplete_array[$position] = 1;
            } else {
                $iscomplete_array[$position] = 0;
            }
            $iscomplete = json_encode($iscomplete_array);
        }
        $sql = "UPDATE table_status SET iscomplete = '$iscomplete' WHERE table_name='$table_name' and project_id = '$project_id'";
//    		echo $sql.'aaaa';
        $result = $result = $db->SelectOri($sql);
        $db->Close();
    }

    //             奖励推荐表
    
    function saveinfo($project_id, $genious,$linkmanInfo,$genious_person,$applyinfo,$org_code) {
    	        $db = new DB();
        $res = $db->UpdateData3('project_info', $project_id, $linkmanInfo, 'project_id');
        $res = $db->UpdateData2('genious_info', $project_id, $genious, 'project_id',$genious['flag'],'flag');
        $res = $db->UpdateData3('legal_person', $org_code, $genious_person, 'org_code');
        $res = $db->UpdateData3('org_info', $org_code, $applyinfo, 'org_code');
    	        $db->Close();
    	    }
    
//     function saveinfo($project_id, $genious) {
//         $db = new DB();
//         $res = $db->UpdateData2('genious_info', $project_id, $work_product,'project_id',$work_product['flag'],'flag');
//         $db->Close();
//     }

    function savework_product($project_id, $work_product) {
        $db = new DB();
        $res = $db->UpdateData2('genious_info', $project_id, $work_product, 'project_id', $work_product['flag'], 'flag');
        print_r($res);
        $db->Close();
    }

    function savehonor_title($project_id, $honor_title) {
        $db = new DB();
        $res = $db->UpdateData2('genious_info', $project_id, $honor_title, 'project_id', $honor_title['flag'], 'flag');
        $db->Close();
    }

    function savesituation($project_id, $situation) {
        $db = new DB();
        $res = $db->UpdateData2('genious_info', $project_id, $situation, 'project_id', $situation['flag'], 'flag');
        $db->Close();
    }

    function saveunit_opinion($project_id, $unit_opinion) {
        $db = new DB();
        $res = $db->UpdateData2('genious_info', $project_id, $unit_opinion, 'project_id', $unit_opinion['flag'], 'flag');
        $db->Close();
    }

    function savefirst_opinion($project_id, $first_opinion) {
        $db = new DB();
        $res = $db->UpdateData2('genious_info', $project_id, $first_opinion, 'project_id', $first_opinion['flag'], 'flag');
        $db->Close();
    }

    function savereview_opinion($project_id, $review_opinion) {
        $db = new DB();
        $res = $db->UpdateData2('genious_info', $project_id, $review_opinion, 'project_id', $review_opinion['flag'], 'flag');
        $db->Close();
    }

    function savefinal_opinion($project_id, $final_opinion) {
        $db = new DB();
        $res = $db->UpdateData2('genious_info', $project_id, $final_opinion, 'project_id', $final_opinion['flag'], 'flag');
        $db->Close();
    }





  
  function findinfo_award($org_code,$project_id,$flag,$word,$username){
      $db = new DB();
      $org_code = $_SESSION['org_code'];
      $result = $db -> GetInfo1($org_code, 'org_info', 'org_code');
      $res =  $db->GetInfo2($project_id, 'genious_info', 'project_id',$flag,'flag');
      $login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
      $result5 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
      $linkman=$result5["linkman"];
      $linkman_contact=$result5["linkman_contact"];
      $linkman_email=$result5["linkman_email"];
      $project_name=$result5["project_name"];

      if($linkman==null||$linkman==""){
          $linkman=$login_info["realname"];
      }
      if($linkman_email==null||$linkman_email==""){
          $linkman_email=$login_info["email"];
      }
      if($linkman_contact==null||$linkman_contact==""){
          $linkman_contact=$login_info["celphone"];
      }

      $res3 = $db->GetInfo1($org_code, 'legal_person', 'org_code');
      $appJSON = array(
//           'genious_name'=>  $res['genious_name'],
//       		'register_time'=>  $result["register_time"],
      	  'project_name'=>  $result5["project_name"],
          'genious_sex'=>  $res['genious_sex'],
          'genious_birth'=>  $res['genious_birth'],
          'genious_nation'=>  $res['genious_nation'],
          'genious_party'=>  $res['genious_party'],
          'genious_native'=>  $res['genious_native'],
          'genious_edu'=>  $res['genious_edu'],
          'genious_grade'=>  $res['genious_grade'],
          'genious_major'=>  $res['genious_major'],
          'genious_devote'=>  $res['genious_devote'],
          'administ_post'=>  $res['administ_post'],
          'major_post'=>  $res['major_post'],
          'genious_address'=>  $res['genious_address'],
          'genious_phone'=>  $res['genious_phone'],
          'company_name'=>  $result['org_name'],
//           'regist_time'=>  $res['regist_time'],
          'is_hightec_prise'=>  $res['is_hightec_prise'],
      		
          'contacts'=> $linkman,
          'contact_phone'=>   $linkman_contact,
          'email'=>   $linkman_email,
      		
//            'corp_name'=>  $res['corp_name'], 
//           'corp_grade'=>  $res['corp_grade'],
          'serving_time'=>  $res['serving_time'],
          'work_force'=>  $res['work_force'],
          'college_num'=>  $res['college_num'],
          'research_num'=>  $res['research_num'],
          'job_resume'=>  $res['job_resume'],
          'high_tech'=>  $res['high_tech'],
      		
      	   'corp_grade'=> $res3['legal_edu'],
          'corp_name'=> $res3['legal_name']
          );
      if($res['regist_time'] != null){
      	$appJSON['register_time'] = $res['regist_time'];
      }else{
      	$appJSON['register_time'] = $result["register_time"];
      }
      if($res['genious_birth'] != null){
      	  $temp = explode('-' , $res['genious_birth']);
      	  $appJSON['genious_year'] = $temp[0];
      	  $appJSON['genious_month'] = $temp[1];
      }
      if(empty($res)){
              unset($appJSON['genious_sex']);
              unset($appJSON['genious_edu']);
              unset($appJSON['genious_grade']);
//               unset($appJSON['corp_grade']);
          unset($appJSON['high_tech']);
      }

//       print_r($appJSON); 
      if($word=="pdf"){
      	return $appJSON;
      	$db->Close();
      }
      echo json_encode($appJSON);
      $db->Close();
  }
  
  function findwork_product($project_id,$flag,$word){
      $db = new DB();
      $res =  $db->GetInfo2($project_id, 'genious_info', 'project_id',$flag,'flag');
      $appJSON = array(
          'work_product'=>  $res['work_product']
      );
      if($word=="pdf"){
      	$db->Close();
      	return $appJSON;
      }
      echo json_encode($appJSON);
  
      $db->Close();
  }
  function findhonor_title($project_id,$flag,$word){
      $db = new DB();
      $res =  $db->GetInfo2($project_id, 'genious_info', 'project_id',$flag,'flag');
      $appJSON = array(
          'honor_title'=>  $res['honor_title']
      );
      if($word=="pdf"){
      	$db->Close();
      	return $appJSON;
      }
      echo json_encode($appJSON);
  
      $db->Close();
  }
  function findsituation($project_id,$flag,$word){
      $db = new DB();
      $res =  $db->GetInfo2($project_id, 'genious_info', 'project_id',$flag,'flag');
      $appJSON = array(
          'situation'=>  $res['situation']
      );
      if($word=="pdf"){
      	$db->Close();
      	return $appJSON;
      }
      echo json_encode($appJSON);
  
      $db->Close();
  }
  function findunit_opinion($project_id,$flag,$word){
      $db = new DB();
      $res =  $db->GetInfo2($project_id, 'genious_info', 'project_id',$flag,'flag');
      $appJSON = array(
          'unit_opinion'=>  $res['unit_opinion']
      );
      if($word=="pdf"){
      	$db->Close();
      	return $appJSON;
      }
      echo json_encode($appJSON);
  
      $db->Close();
  }
  function findfirst_opinion($project_id,$flag,$word){
      $db = new DB();
      $res =  $db->GetInfo2($project_id, 'genious_info', 'project_id',$flag,'flag');
      $appJSON = array(
          'first_opinion'=>  $res['first_opinion']
      );
      if($word=="pdf"){
      	$db->Close();
      	return $appJSON;
      }
      echo json_encode($appJSON);
  
      $db->Close();
  }
  function findreview_opinion($project_id,$flag,$word){
      $db = new DB();
      $res =  $db->GetInfo2($project_id, 'genious_info', 'project_id',$flag,'flag');
      $appJSON = array(
           'review_opinion'=>  $res['review_opinion']
      );
      if($word=="pdf"){
      	$db->Close();
      	return $appJSON;
      }
      echo json_encode($appJSON);
  
      $db->Close();
  }
  function findfinal_opinion($project_id,$flag,$word){
      $db = new DB();
      $res =  $db->GetInfo2($project_id, 'genious_info', 'project_id',$flag,'flag');
      $appJSON = array(
        'final_opinion'=>  $res['final_opinion']
      );
      if($word=="pdf"){
      	$db->Close();
      	return $appJSON;
      }
      echo json_encode($appJSON);
  
      $db->Close();
  }
  function array_remove($data, $key){
   	if(!array_key_exists($key, $data)){
   		return $data;
   	}
   	$keys = array_keys($data);
   	$index = array_search($key, $keys);
   	if($index !== FALSE){
   		array_splice($data, $index, 1);
   	}
   	return $data;
   }
   function opinion($project_id){
   	$db = new DB();
   	$res = $db->GetInfo1($project_id, 'project_info', 'project_id');
   	$array = array(
   			'leader_opinion' =>$res['leader_opinion'],
   			'org_opinion' => $res['org_opinion']
   	);
   	return $array;
   	$db->Close();
   }
   function find_material($project_id){
   	$db = new DB();
   	$sql = "SELECT intel_property,type,auth_code FROM tech_material WHERE project_id = '$project_id'";
   	$res = $db->Select($sql);
//    	$array = array(
//    			'inter_property' => $res['inter_property'],
//    			'type' => $res['type'],
//    			'auth_code' => $res['auth_code'],
//    	   	);
	return $res;
	$db->Close();
   }
   
  function patent3_orginfo($org_code, $patent3_orginfo, $patent3_legal, $patent3_staff, $patent3_intellectual, $patent3_profit, $patent_prora,$linkmanInfo,$project_id) {
        $db = new DB();
        $db->UpdateData3("project_info", $project_id, $linkmanInfo, 'project_id'); 
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
            "org_type" =>  $res1['org_type'],
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
//             "legal_birth" => $res2['legal_birth'],
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
        if(!empty($res2['legal_birth'])){
        	$temp = explode('-' , $res2['legal_birth']);
        	$arrjson['legal_year'] = $temp[0];
        	$arrjson['legal_month'] = $temp[1];
        }
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


    function patent3_projectinfo($project_id, $patent3_project, $patent3_principle, $patent3_patent, $patent3_last, $patent3_finish, $patent3_list) {
        $db = new DB();
        $db->UpdateData3("project_info", $project_id, $patent3_project, 'project_id');
        $db->UpdateData3("project_principal", $project_id, $patent3_principle, 'project_id');
        $db->UpdateData3("project_patent", $project_id, $patent3_patent, 'project_id');
        $db->UpdateData3("last_target", $project_id, $patent3_last, 'project_id');
        $db->UpdateData3("finish_target", $project_id, $patent3_finish, 'project_id');

        //下面的内容不要再删除了，要改醉了！
        $sql = "DELETE FROM patent_list WHERE project_id='$project_id'";
        $db->Delete($sql);
        foreach ($patent3_list as $key => $value){
        		 $db->InsertData('patent_list', $value);
        }
        $db->Close();
    }

    function find_patent3_projectinfo($project_id, $flag) {
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

    function projectMeg($project_id){
        $db = new DB();
        $result_project = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $login_info = $db -> GetInfo1($result_project['org_code'], 'login_info', 'org_code');
        $project_name = $result_project['project_name'];
        $org_code = $result_project['org_code'];
        $result_org = $db->GetInfo1($org_code, 'org_info', 'org_code');
        $org_name = $result_org['org_name'];
        $project_type = $result_project['project_type'];
        $result_project_type = $db->GetInfo($project_type, 'project_type');
        $project_type_name = $result_project_type['name'];
        $projectArr = array(
            'project_id' => $project_id,
            'project_type' => $project_type_name,
            'org_name' => $org_name,
            'project_name' => $project_name,
            'linkman' => empty($result_project['linkman'])?$login_info['real_name']:$result_project['linkman'],
            'linkman_contact' => empty($result_project['linkman_contact'])?$login_info['celphone']:$result_project['linkman_contact'],
            'tech_area' => $result_project['tech_area']
        );
        echo json_encode($projectArr);
    }

    function checkOpp($project_id, $table_id) {
        $db = new DB();
        //首先需要判断
        $result_project = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $project_type_id = $result_project['project_type'];
        $sql_table_check = "select * from project_check_relative where project_type_id = $project_type_id and table_type_id = $table_id and status = 0";
//        echo $sql_table_check;
        $result_table_check = $db->Select($sql_table_check);
        if (count($result_table_check) == 0) {
            $data['code'] = 0;
//            echo "a".$data['code'];
        } else {
            $sql_table_check = "select distinct table_type_id  from project_check_relative where project_type_id = $project_type_id and status = 0 and table_type_id <> $table_id";
//            echo $sql_table_check;
            $result_check = $db->Select($sql_table_check);
//            var_dump($result_check);
            if (count($result_check) == 0) {
                $data['code'] = 1;
//                echo "b".$data['code'];
            } else {
                $pass_status = $db -> GetInfo1($project_id, 'check_status', 'project_id');
                $submit_status = true;
                foreach ($result_check as $item) {
                    $table_type_id = $item['table_type_id'];
//                    echo $table_type_id . "www";
                    $result_table_status = $db->GetInfo2($project_id, 'table_status', 'project_id', $table_type_id, 'table_name');
                    if ($result_table_status['table_status'] == 1 ) {
                        $submit_status = false;
                    }
                    if($result_table_status['table_status'] == 3){
                        $recheck = 1;
                    }
                }
                if($pass_status['ispass'] != 0){
                    $submit_status = false;
                }
                if ($submit_status || $recheck) {
                    $data['code'] = 1;
                } else {
                    $data['code'] = 0;
//                    echo "c".$data['code'];
                }
            }
        }
        echo json_encode($data);
    }
    
   function find_opnion($project_id){
   	$db = new DB();
   	$sql = "select * from table_status where project_id ='$project_id' and table_name ='$table_name'";
   	$result = $db -> SelectOri($sql);
   	$result_table = mysql_fetch_array($result);
   	$table_opinion = $result_table['approval_opinion'];
   	$result = $db->GetInfo1($project_id, 'project_info', 'project_id');
   	$data=array();
   	if($table_opinion != null){
   		if(($result_table ['table_status'] != 4 || $user_type != 0)){
   			$data['approval_opinion']= $table_opinion;
   		}else{
   			if($result['project_stage'] != 0){
   				   $data['approval_opinion']= $table_opinion;
   				
   			}
   		}
   	}
   	echo json_encode($data);
   }

   function getProjectInfo($project_id){
   	$db = new DB();
   	$result = $db->GetInfo1($project_id, 'project_info', 'project_id');
   	$ret=array(
   		"project_name"=>$result["project_name"],	
   		"start_time"=>date("Y年m月d",$result["start_time"]),	
   		"end_time"=>date("Y年m月d",$result["end_time"]),	
   	);
   	return $ret;
   }
 function   findProjectInfo($project_id){
 	$db = new DB();
 	$result = $db->GetInfo1($project_id, 'project_info', 'project_id');
 	$result2 = $db->GetInfo1($result["project_type"], 'project_type', 'id');
 	$ret=array(
 			"project_name"=>$result["project_name"],
 			"start_time"=>date("Y年m月d",$result["start_time"]),
 			"end_time"=>date("Y年m月d",$result["end_time"]),
 			"tech_area"=>$result["tech_area"],
 			"project_type"=>$result2["name"],
 			"department"=>$result["department"],
 			
 	);
 	return $ret;
 }
 
 function findLogInfo($page,$rows){
 	$db=new DB();
 	$page = ($page - 1) * $rows;
 	$sql="select *  from loginfo  limit  $page , $rows   order   by  id  desc  ";
 	$res=$db->Select($sql);
	$count = $db->select ("select  count('id') from  loginfo ");
	$count = $count [0] ["count('id')"];
	$typeList=array();
	$i=0;
	if(!empty($res)){
	foreach ( $res as $tmp ) {
		$typeList [$i]=array(
				'id' => $i + 1,
				'opt' => $tmp ['opt'],
				'username' => $tmp ['username'],
				'timedata' => $tmp ['timedata']
		);
		$i++;
	 	}
	}
 	$typeJSON = '{"total":' . $count . ',"rows":' . json_encode ( $typeList ) . '}';
 	echo $typeJSON;
 }
 
}
