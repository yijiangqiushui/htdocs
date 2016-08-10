<?php

class Project {

    function saveSummary($table_name, $project_id, $project_summary) {
        $db = new DB();
        $result = $db->updateInfo($table_name, $project_id, $project_summary);
        echo $result;
        $db->Close();
    }

    /**
     * 显示项目成果信息
     * 
     * */
    function findProArchieve($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findProjectArchieve($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findProjectArchieve($project_id, $name, $tid, $flag) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'project_achievement' => $result['achievement']
        );
        $sql = "SELECT table_status FROM table_status WHERE project_id = '$project_id' and table_name ='项目总结报告书'";
        $result = $db->Select($sql);
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示项目主要研发内容
     * 
     * */
    function findProChiefContent($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findProjectChiefContent($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findProjectChiefContent($project_id, $name, $tid, $flag) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'project_chief_context' => $result['assign_research']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }

        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示成果及推广计划
     * 
     * */
    function findProPlan($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findProjectPlan($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findProjectPlan($project_id, $name, $tid, $flag) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'project_generalize_plan' => $result['generalize_plan']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示项目考核指标
     * 
     * */
    function findProKpi($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findProjectKpi($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findProjectKpi($project_id, $name, $tid, $flag) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'project_kpi' => $result['assign_target']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示单位意见
     * 
     * */
    function findOrgSugg($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findOrgSuggest($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findOrgSuggest($project_id, $name, $tid, $flag) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'project_org_suggest' => $result['org_suggest']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示其他问题及说明
     * 
     * */
    function findOtherSugg($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findOtherSuggest($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findOtherSuggest($project_id, $name, $tid, $flag) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'project_other_suggest' => $result['other_suggest']
        );
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }

        echo json_encode($appJSON);
        $db->close();
    }

    /**
     * 显示任务目标
     * 
     * */
    function findProSummary($project_id, $name, $tid, $flag) {
        if ($project_id != null) {
            $this->findProjectSummary($project_id, $name, $tid, $flag);
        } else {
            echo '0';
        }
    }

    function findProjectSummary($project_id, $name, $tid, $flag) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'project_process' => $result['assign_plan']);
        if ($flag == "pdf") {
            $db->Close();
            return $appJSON;
        }
        echo json_encode($appJSON);
        $db->close();
    }

    /*
     * 
     * pdf */

    function findProjectSummary_pdf($project_id, $name, $tid) {
        $db = new DB();
        $result = $db->GetInfo1($project_id, $name, $tid);
        $appJSON = array(
            'project_id' => $result['project_id'],
            'project_process' => $result['assign_plan'],
            'project_kpi' => $result['assign_target'],
            'project_other_suggest' => $result['other_suggest'],
            'project_generalize_plan' => $result['generalize_plan'],
            'project_achievement' => $result['achievement'],
            'project_chief_context' => $result['assign_research'],
            'project_org_suggest' => $result['org_suggest']
        );

        return $appJSON;
        $db->close();
    }

}
