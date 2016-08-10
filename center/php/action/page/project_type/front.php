<?php
include '../../class/ActionBase.cls.php';
include CENTER_ROOTPATH."/modules/service/ProjectTypeService.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectInfoService.cls.php";
include CENTER_ROOTPATH."/modules/service/TableTypeRelativeService.cls.php";

class ProjectTypeFront extends ActionBase{
    
    public $view_dir = "action/page/project_type";
    
    function edit_front_data(){
        $msgcode = 100;
    
        $val_data = $_POST['val_data'];
        //var_dump($edit_data);exit;
        if(empty($val_data)){
            $this->response($msgcode,null);
        }
    
        $id = intval($_POST['str_id']);
        $project_id = $_SESSION['project_id'];
    
        $condition = array(
            "id"=>$id
        );
    
        $ret = TableTypeRelativeService::instance()->get($condition);
        
        $subtable_list_id = 0;
        if($ret&&$ret[0]){
            $subtable_list_id = $ret[0]['subtable_list_id'];
        }else{
            $this->response($msgcode,null);
        }
        
        
        $condition = array(
            "project_id"=>$project_id
        );
        
        $project_info = ProjectInfoService::instance()->get($condition);
        
        $project = array();
        
        if($project_info&&$project_info[0]){
            $project = $project_info[0];
        }else{
            $this->response($msgcode,null);
        }
        
        $extra_info_arr = array();
        
        $extra_info = $project['extra_info'];
        
        if(!empty($extra_info)){
            $extra_info_arr = json_decode($extra_info,true);
        }
        
        $extra_info_arr[$subtable_list_id] = json_decode($val_data,true);
        
        $data = array(
            "extra_info"=>mysql_real_escape_string(json_encode($extra_info_arr))
        );
        
        $ret = ProjectInfoService::instance()->update($condition,$data);
        $ret = array("status"=>$ret,"pid"=>$project_id);
        
        $this->response($msgcode,$ret);
    
    }
    
    
    function get_front_data(){
        $msgcode = 100;
    
        $id = intval($_POST['str_id']);
        $project_id = $_SESSION['project_id'];
    
        $condition = array(
            "id"=>$id
        );
    
        $ret = TableTypeRelativeService::instance()->get($condition);
        
        $subtable_list_id = 0;
        if($ret&&$ret[0]){
            $subtable_list_id = $ret[0]['subtable_list_id'];
        }else{
            $this->response($msgcode,null);
        }
        
        
        $condition = array(
            "project_id"=>$project_id
        );
        
        $project_info = ProjectInfoService::instance()->get($condition);
        
        $project = array();
        
        if($project_info&&$project_info[0]){
            $project = $project_info[0];
        }else{
            $this->response($msgcode,null);
        }
        
        $extra_info_arr = array();
        
        $extra_info = $project['extra_info'];
        
        $out_data = array();
        
        if(!empty($extra_info)){
            $extra_info_arr = json_decode($extra_info,true);
            $out_data = isset($extra_info_arr[$subtable_list_id])?$extra_info_arr[$subtable_list_id]:array();
        }
        
        $this->response($msgcode,$out_data);
    
    }
    
    
}

$task = new ProjectTypeFront();

$task->run();