<?php

class Middle {

    function saveMiddle($table_name, $project_id, $middle) {
        $db = new DB();
        $result = $db->updateInfo($table_name, $project_id, $middle);
        echo $result;
        $db->Close();
    }

    function saveApply($table_name, $project_id, $modify_apply) {
        $db = new DB();
        $result = $db->updateInfo('modify_apply', $project_id, $modify_apply);
        $date = explode('~',$modify_apply['start_end']);
        $project_info = array(
        		'start_time' => strtotime($date[0]),
        		'end_time' => strtotime($date[1])
        );
		$db->updateInfo('project_info', $project_id, $project_info);
        echo $result;
        $db->Close();
    }

    /**
     * 显示项目进展情况
     * 
     * */
    function findMiddle($project_id, $name, $tid) {
        if ($project_id != null) {
            $this->findProMiddle($project_id, $name, $tid);
        } else {
            echo '0';
        }
    }

    function findProMiddle($project_id, $name, $tid) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array('project_id' => $result['project_id'],
            'project_process' => $result['project_process']);


        $sql = "SELECT table_status FROM table_status WHERE project_id = '$project_id' and table_name ='项目工作中期报告'";
        $result = $db->Select($sql);

        if ($result[0]['table_status'] == 1 || $result[0]['table_status'] == 3) {
            $appJSON ['save_display'] = 1;
        } else {
            $appJSON ['save_display'] = 0;
        }

        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示项目经费使用情况
     * 
     * */
    function findProFund($project_id, $name, $tid) {
        if ($project_id != null) {
            $this->findProjectFund($project_id, $name, $tid);
        } else {
            echo '0';
        }
    }

    function findProjectFund($project_id, $name, $tid) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'fund_use' => $result['fund_use']
        );
        $sql = "SELECT table_status FROM table_status WHERE project_id = '$project_id' and table_name ='项目工作中期报告'";
        $result = $db->Select($sql);

        if ($result[0]['table_status'] == 1 || $result[0]['table_status'] == 3) {
            $appJSON ['save_display'] = 1;
        } else {
            $appJSON ['save_display'] = 0;
        }


        echo json_encode($appJSON);
        $db->close();
    }

    /*
     * 中期报告pdf打印
     *   
     *   */

    function findProjectFund_pdf($project_id, $name, $tid) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array('project_id' => $result['project_id'],
            'fund_use' => $result['fund_use']);
        return $appJSON;
        $db->close();
    }

    function findProMiddle_pdf($project_id, $name, $tid) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array('project_id' => $result['project_id'],
            'project_process' => $result['project_process']);
        return ($appJSON);
        $db->close();
    }

    function findProProble_pdf($project_id, $name, $tid) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array('project_id' => $result['project_id'],
            'problem_action' => $result['problem_action']);
        return $appJSON;
        $db->close();
    }

    /**
     * 显示项目存在问题及采取措施
     * 
     * */
    function findProProble($project_id, $name, $tid) {
        if ($project_id != null) {
            $this->findProjectProble($project_id, $name, $tid);
        } else {
            echo '0';
        }
    }

    function findProjectProble($project_id, $name, $tid) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array('project_id' => $result['project_id'],
            'problem_action' => $result['problem_action']);
        $sql = "SELECT table_status FROM table_status WHERE project_id = '$project_id' and table_name ='项目工作中期报告'";
        $result = $db->Select($sql);

        if ($result[0]['table_status'] == 1 || $result[0]['table_status'] == 3) {
            $appJSON ['save_display'] = 1;
        } else {
            $appJSON ['save_display'] = 0;
        }

        echo json_encode($appJSON);
        $db->close();
    }

    function findModifyApp1($project_id) {
        $db = new DB();
        //         echo $project_id;
        // 参数分别是： 主键值   数据库表明   主键名
        $result = $db->GetInfo1($project_id, 'modify_apply', 'project_id');
        $result2 = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $sql = "select project_type  from project_info  where project_id='$project_id' ";
        $res3 = $db->Select($sql);
        $res4 = $db->GetInfo1($res3[0][0], 'project_type', 'name');
        $result5 = $db->GetInfo1($result2['org_code'], 'org_info', 'org_code');
        $appJSON = array(
            'start_time' => date('Y-m-d', $result2['start_time']),
            'end_time' => date('Y-m-d', $result2['end_time']),
            'modify_content' => $result['modify_content'],
            'modify_reason' => $result['modify_reason'],
            'org_suggest' => $result['org_suggest'],
            'office_suggest' => $result['office_suggest'],
            'vice_suggest' => $result['vice_suggest'],
            'director_suggest' => $result['director_suggest'],
            'remark' => $result['remark'],
            'engineer_suggest' => $result['engineer_suggest'],
            'project_money' => $result['project_money'],
            'finmoney' => $result['finmoney'],
            'othermoney' => $result['othermoney'],
            'project_name' => $result2['project_name'],
            'org_name' => $result5['org_name'],
        );
        return $appJSON;
    }

    /**
     * 显示项目申请信息
     * 
     */
    //有些阻断没有定义好!!!!!
    function findModifyApp($project_id) {
        $db = new DB();
//         echo $project_id;
        // 参数分别是： 主键值   数据库表明   主键名
        $result = $db->GetInfo1($project_id, 'modify_apply', 'project_id');
        $result2 = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $sql ="select project_type  from project_info  where project_id='$project_id' ";
        $res3=$db->Select($sql);
        $res4=$db->GetInfo1($res3[0][0], 'project_type', 'name');
        //david modify
        $start_time = isset($result2['start_time'])?date('Y-m-d',$result2['start_time']):null;
        $end_time = isset($result2['end_time'])?date('Y-m-d',$result2['end_time']):null;
        $result5 = $db->GetInfo1($result2['org_code'], 'org_info', 'org_code');
        $appJSON = array(
            'modify_content' => $result['modify_content'],
            'modify_reason' => $result['modify_reason'],
            'org_suggest' => $result['org_suggest'],
            'office_suggest' => $result['office_suggest'],
            'vice_suggest' => $result['vice_suggest'],
            'director_suggest' => $result['director_suggest'],
            'remark' => $result['remark'],
            'engineer_suggest' => $result['engineer_suggest'],
            'project_money' => $result['project_money'],
            'finmoney' => $result['finmoney'],
            'othermoney' => $result['othermoney'],
            'project_name' => $result2['project_name'],
            'start_time' => $start_time ,
            'end_time' => $end_time,
            'org_name' => $result5['org_name'],
        );
        session_start();
        $_SESSION['middle'] = $appJSON;
        $sql = "SELECT table_status FROM table_status WHERE project_id = '$project_id' and table_name ='北京市通州区科技计划项目调整申请表'";
        $result = $db->Select($sql);

        if ($result[0]['table_status'] == 1 || $result[0]['table_status'] == 3) {
            $appJSON ['save_display'] = 1;
        } else {
            $appJSON ['save_display'] = 0;
        }

        echo json_encode($appJSON);
        $db->close();
    }

}
