<?php
if(!class_exists("DaoBase")){
    include dirname(__FILE__)."/../dao/DaoBase.php";
}
class ProjectInfoService extends DaoBase{
    
    public $table_name = "project_info";
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


    public function getByPcul($ptid,$uid){

        $sql = "select * from {$this->table_name} as a join pro_check_user_list as b
on(a.project_id=b.project_id and b.admin_info_id={$uid}) where a.project_type={$ptid}";

        $ret = $this->db->Select($sql);

        return $ret;

    }
    
}