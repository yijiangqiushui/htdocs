<?php
if(!class_exists("DaoBase")){
    include dirname(__FILE__)."/../dao/DaoBase.php";
}

class ProjectCheckUserListService extends DaoBase{
    
    public $table_name = "pro_check_user_list";
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