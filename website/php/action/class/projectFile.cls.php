<?php
include __DIR__.'../../../../../center/php/config.ini.php';
include __DIR__.'../../../../../common/php/config.ini.php';
if (!class_exists("DB")) {
	include __DIR__ . '../../../../../common/php/lib/db.cls.php';
}

class projectFile{
    
	private $table_name = "attach_list";
	public $db;
	
	static function instance(){
		$obj =  new projectFile();
		$obj->db = new DB();
		return $obj;
	}
	
    function get_file_path($project_id){
        $db = new DB ();
		$res = $db->Select("select * from project_info where project_id='".$project_id."'");
		$db->Close ();
        if(empty($res)){
            return false;
        }else{
            return $res[0];
        }
    }
	
	function get_attach_lists($project_id,$table_id){
        $db = new DB ();
		$sql = "select * from {$this->table_name} where project_id='".$project_id."' and subtable_id={$table_id}";
		//echo $sql;
		$res = $db->Select($sql);
		$db->Close ();
        return $res;
    }
    
	function insert($data){
		$res = $this->db->InsertData($this->table_name,$data);
        return $res;
	}
	
	function updateById($id,$data){
		$res = $this->db->UpdateData($this->table_name,$id,$data);
		return $res;
	}
	
	
	function delete($id){
		
		$res = $this->db->DelData($id,$this->table_name);
		return $res;
	}
	
}