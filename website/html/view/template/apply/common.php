<?php
/* include '../../../../../../common/php/config.ini.php';
include WWWPATH.'common/php/lib/db.cls.php';
 */

include dirname(__FILE__)."/../../../../../common/php/config.ini.php";
include dirname(__FILE__)."/../../../../../common/php/lib/db.cls.php";


class TableCommon{
	
// 	public $table_name;
    public $table_id;
	public $project_id;
	public $is_new = false;
	public $relative_list;
	
	function __construct(){
	    /* if(is_numeric( $_GET['table_id'])){
	        $this->table_id = $_GET['table_id'];
	    }else{
	        $this->table_id = base64_decode($_GET['table_id']);
	    } */
	    $this->table_id = $_GET['table_id'];
// 	    var_dump($_GET['table_id']);
// 	    echo $this->table_id;
		$this->project_id = $_SESSION ['project_id'];
		if(!is_numeric($this->table_id)){
			exit("wrong table_name");
		}
	}
	
	
	function run(){
		$db = new DB ();
		$project_id = $this->project_id;
// 		$sql_tt = "Select * from table_type where name='{$this->table_name}'";
        $sql_tt = "Select * from table_type where id = '{$this->table_id}'";
		$tt = $db->SelectObject($sql_tt);
// 		var_dump($tt);
		
		if(empty($tt)){
			exit("wrong table_name2");
		}
		$table_type_id = $tt->id;
		
		$sql_project = "Select * from project_info where project_id='$project_id'";
		$project = $db->SelectObject($sql_project);
		$project_stage = $project->project_stage;
		$project_type = $project->project_type;
/* 		$sql_type = "select * from project_type where name ='$project_type'";*/
        $sql_type = "Select * from project_type where id = '$project_type'";
		$project_type_obj = $db->SelectObject($sql_type);
		$ptid = $project_type_obj->id; 
		$ptid = $project->project_type;
		if($project_type_obj->is_new){
		    
			$this->is_new = true;
			$sql_re = "select * from table_type_relative where project_type_id={$ptid} and table_type_id={$table_type_id} and status=0 order by sort_id";
			$relative_list = $db->Select($sql_re);
			foreach($relative_list as &$item){
				$sql_sl = "select * from subtable_list where id={$item['subtable_list_id']}";
				$sl_obj = $db->SelectObject($sql_sl);
				$item['sl_name'] = ($sl_obj&&isset($sl_obj->name))?$sl_obj->name:"";
				$item['tpl_url'] = ($sl_obj&&isset($sl_obj->tpl_url))?$sl_obj->tpl_url:"";
				$item['st_name'] = ($sl_obj&&isset($sl_obj->st_name))?$sl_obj->st_name:"";
			}
			$this->relative_list = $relative_list;
		}
	}
}


$app = new TableCommon();

$app->run();