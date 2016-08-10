<?php
if(!class_exists("DaoBase")){
    include dirname(__FILE__)."/../dao/DaoBase.php";
}

class ProCheckPriMapDao extends DaoBase{
    
    public $table_name = "pro_check_pri_map";
    static public $handle = null;
    
    function insert($data){
        $ret = $this->db->InsertData($this->table_name,$data);
        return $ret;
    }
    
    static function instance(){
        if(self::$handle == null){
           self::$handle = new ProCheckPriMapDao();
        }
        return self::$handle;
    }
    
    public function get_pri_map_by_uid($uid,$status = -1){
        if($status == -1){
            $sql = "select * from {$this->table_name} where admin_info_id={$uid}";
        }else{
            $sql = "select * from {$this->table_name} where admin_info_id={$uid} and status={$status}";
        }
        $ret = $this->db->Select($sql);
        return $ret;
    }
    
    public function get_pri_map_by_ptid($ptid,$para_id){
    	$sql  = "select group_concat(b.realname) as gc_name  from pro_check_pri_map as a join admininfo as b on(a.admin_info_id=b.id) 
    	where project_type_id={$ptid} and project_type_para_id={$para_id} ";
    	$ret = $this->db->Select($sql);
    	return $ret;
    }


    public function get($condition,$order=null,$limit=null){

        $ret = $this->find($condition,$order,$limit);
        return $ret;
    }
    
    public function delete_pri($data){
        $where_str = "";
        foreach($data as $key=>$val){
            $val_str = $val;
            if(!is_integer($val)){
                $val_str = "'{$val}'";
            }
            if(!empty($where_str)){
                $where_str .= " and ";
            }
            $where_str .= "`{$key}`={$val_str}";
        }
        $sql = "delete from {$this->table_name} where {$where_str}";
        $ret = $this->db->Delete($sql);      
        return $ret;
    }
    
    
}