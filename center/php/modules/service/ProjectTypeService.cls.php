<?php
if(!class_exists("DaoBase")){
    include dirname(__FILE__)."/../dao/DaoBase.php";
}
class ProjectTypeService extends DaoBase{
    
    public $table_name = "project_type";
    public $handle = null;
    
    static function instance(){
        if($handle == null){
           $handle = new self();
        }
        return $handle;
    }
    
    function insert($data){
        $ret = $this->db->InsertData($this->table_name,$data);
        return $ret;
    }
    
    public function get_project_type($condition,$order=null,$limit=null){
        $ret = $this->find($condition,$order,$limit);
        return $ret;
    }
    
    //2016.01.07 david add
    public function update_project_type($condition,$data){
        $ret = $this->update($condition,$data);
        return $ret;
    }
    
}