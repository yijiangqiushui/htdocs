<?php
if(!class_exists("DaoBase")){
	include dirname(__FILE__)."/../dao/DaoBase.php";
}
class ProPriListDao extends DaoBase{
    
    public $table_name = "pro_pri_list";
    public $handle = null;
    
    function insert($data){
        $ret = $this->db->InsertData($this->table_name,$data);
        return $ret;
    }
    
    static function instance(){
        if($handle == null){
           $handle = new ProPriListDao(); 
        }
        return $handle;
    }
    
    public function get_pri_list_by_uid($uid,$status = -1){
        if($status == -1){
            $sql = "select * from {$this->table_name} where admin_info_id={$uid}";
        }else{
            $sql = "select * from {$this->table_name} where admin_info_id={$uid} and status={$status}";
        }
        $ret = $this->db->Select($sql);
        return $ret;
    }
    
    
    public function get($condition,$order=null,$limit=null){
    
    	$ret = $this->find($condition,$order,$limit);
    	return $ret;
    }

    public function getVisorPriByPtid($ptid){
        $sql = "select * from {$this->table_name} where prival like 'jcqxPart%_{$ptid}'";
        $ret = $this->db->Select($sql);
        return $ret;
    }
    
    public function delete_pri($data){
        $where_str = "";
		
		$like_str = "";
		
		if(isset($data['like'])){
			$like_str = " ".$data['like'][0]." like '".$data['like'][1]."'";
			unset($data['like']);
		}
		
		$where_str .= $like_str;
		
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