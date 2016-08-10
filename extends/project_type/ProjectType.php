<?php
require_once __DIR__ . '/../../common/php/config.ini.php';
require_once WWWPATH . 'common/php/lib/db.cls.php';
// echo  WWWPATH . 'common/php/lib/db.cls.php';
class ProjectType
{
    public function __construct()
    {
        
    }
    
    static public function getTable($projec_type_id)
    {
        $db = new DB();
        // $sql = "select * from `project_type` where `id`={$projec_type_id}";
        $row = $db->GetInfo($projec_type_id, 'project_type');
        
        if (! empty($row)) {
            if (! empty($row['attatch_name'])) {
                $attach_name = $row['attatch_name'];
                $sql = "select * from `table_type` where `id` in ({$attach_name})";
                $result = $db->Select($sql);
                return $result;
            }
        }
    }
    
    
    static public function getTableStage($project_type_id, $stage) 
    {
        $tables = self::getTable($project_type_id);
        $table_stage = array();
        
        foreach ($tables as $key => $value) {
            if ($value['stage'] == $stage) {
                $table_stage[] = $value;
            }
        }
        
        return $table_stage;
    }
    
    static public function createTableStatus($project_id, $project_type_id, $stage){
        global $global_department;
        $db = new DB();
        $process = explode(",", $stage);
        $time = strtotime('now');
        foreach($process as $tmp){
            $tables = self::getTableStage($project_type_id, $tmp);
            foreach($tables as $table_tmp){
                $tableArray = array(
//                     'table_name'    => $table_tmp['name'],
                    'table_name' => $table_tmp['id'],
                    'project_id'    => $project_id,
                    'project_stage'    => $tmp,
                    'last_modify' => $time,
                    'open' => $table_tmp['open'],
                );
                $result_insert = $db->InsertData('table_status', $tableArray);
            }
            
        }
        
        $project_name = $db->GetInfo($project_type_id, 'project_type');
        $dep_type = $project_name['dep_type'];
        $dep_name = $global_department[$dep_type]['name'];
        $attach_name = explode(',', $project_name['attatch_name']);
//         echo $dep_name;
        //获取当前项目需要查重的表id
//         $checkTable = $project_name['check_table_id'];
        
        $projectArray = array(
            'project_id' => $project_id,
            'project_type'=>$project_type_id,
            'department' => $dep_name,
            'project_stage' => $process[0],
            'org_code' => $_SESSION['org_code'],
            'user_id' => $_SESSION['user_id'],
            'create_time' => $time,
            'stage_process' => $stage
        );
        //如果需要查重的表id不为空，并且这张表存在于该项目的表中，则可以进行查重初始化的操作。
        
        
        $checkArray = array(
            'project_id' => $project_id,
            'ispass' => 0,
            'rate' => 0
        );
        
        //david add 首先需要判断这个项目类型是否需要进行查重操作。
        $check_status = self::hasTable($project_type_id);
        if($check_status){
            $check_result = $db->InsertData( 'check_status',$checkArray );
        }
        
        //判断该项目类型是否有申报阶段
        $applyStage_result = $db -> GetInfo($project_type_id, "project_type");
        $applyStage = $applyStage_result['apply_stage'];
        $setupStage = $applyStage_result['setup_stage'];
     
        if(!$applyStage || $setupStage == 0){
            $engineerAndnum = self::getApproval($project_type_id,$applyStage_result['dep_type'],$applyStage_result['inherit_val']);
            $attatch_name = $applyStage_result['attatch_name'];
            $projectArray['project_engineer'] = $engineerAndnum["engineer"];
            if($attatch_name != '19' || $attatch_name != '20'){
                $projectArray['business_id'] = $engineerAndnum["buinessCode"];
            }
        }
//         var_dump($engineerAndnum);exit();
        $project_insert = $db->InsertData('project_info', $projectArray);
        $db->Close();
    }
    
    function getApproval($project_type_id,$department,$inherit_val){
        $db = new DB();
        //如果是继承类的项目则需要找出其父类的信息
        if($inherit_val != 0 ){
            $father_projectinfo = $db -> GetInfo($inherit_val, 'project_type');
            $project_type_id = $father_projectinfo['id'];
        }
        $sql  = "select group_concat(b.realname) as gc_name  from pro_check_pri_map as a join admininfo as b on(a.admin_info_id=b.id)
        where project_type_id={$project_type_id} and project_type_para_id = 1 ";
//         var_dump($sql);exit();
        $engineer = $db -> Select($sql);
        if(count($engineer) == 0 || $engineer['0']["gc_name"] == null){
            $sql  = "select group_concat(b.realname) as gc_name  from pro_check_pri_map as a join admininfo as b on(a.admin_info_id=b.id)
            where project_type_id={$project_type_id} and project_type_para_id= 0 ";
            $operator = $db -> Select($sql);
//             var_dump($operator);exit();
            $engineer[0]['gc_name'] = $operator[0]["gc_name"];
        }
        //生成项目编号
        
        $buinessCode = self::genBusid($project_type_id,$department);
        $dataArray = array(
            "engineer" => $engineer[0]['gc_name'],
            "buinessCode" => $buinessCode,
        );
        $db -> Close();
//         var_dump($dataArray);exit();
        return $dataArray;
    }
    
    //生成项目编码;
    function genBusid($project_type_id,$department){
        global $global_department;
        $department = $global_department[$department]["name"];
        $db = new DB();
        
        $sql = "Select count(*) AS count from project_info where department = '$department' ";
        $result = $db -> Select($sql);
        $max = $result[0]['count'];
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
        return $business_id;
        
    }
    
    //是否需要进行查重操作  david add 
    static public function hasTable($project_type_id){
        $db = new DB();
        $sql = "select * from project_check_relative where project_type_id = $project_type_id";
        $result_result = $db -> Select($sql);
        $check_status = false;
        if(isset($result_result)){
            foreach($result_result as $item){
                if($item['status'] == 0 ){
                    $check_status = true;
                }
            }
        }
        return $check_status;
    }

}




