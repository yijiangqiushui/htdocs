<?php
if(!class_exists("DaoBase")){
    include dirname(__FILE__)."/../dao/DaoBase.php";
}

class TableStatusService extends DaoBase{
    
    public $table_name = "table_status";
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
    
    public function get($condition,$order=null,$limit=null){
        $ret = $this->find($condition,$order,$limit);
        return $ret;
    }
    
    public function del($condition){
        $ret = $this->delete($condition);
        return $ret;
    }
}