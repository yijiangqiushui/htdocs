<?php
// include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../modules/php/action/class/projectapp/util.cls.php'; 

class checkReport {
	function findCheck($project_id) {
		$db = new DB ();
		$result1 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
// 		$result_check = $db -> GetInfo1($project_id, 'check_status', 'project_id');
// 		$check_table_id = $result_check['table_id'];
        //项目类型需要知道
        $project_stage = $result1['project_stage'];
        $project_type_id = $result1['project_type'];
        $sql_subtable = "Select * from project_check_relative A JOIN (Select * from table_type where stage = $project_stage) B ON (A.table_type_id = B.id) where A.project_type_id = $project_type_id and A.status = 0  and A.weight > 0 order by weight desc";
        
//         $sql_subtable = "select *  from  project_check_relative where project_type_id = $project_type_id order by weight desc";
/*         $sql_table_type_relative = "select * from table_type_relative where project_type_id = $project_type_id";
        $table_type_relative = $db -> Select($sql_table_type_relative); */
        
//         echo $sql_subtable;
// echo $sql_subtable;exit();
        $subtable_list = $db -> Select($sql_subtable);
        $count = 0;
        foreach($subtable_list as $item){
            $subtable_id = $item['subtable_id'];
            $subtable_result =  $db -> GetInfo ($subtable_id, 'subtable_list');
            if($subtable_result['relative_fields'] == 'project_id'){
                $data = $project_id;
            }else{
                $data = $_SESSION['org_code'];
            }
            $weight = $item['weight'];
            $status = $item['status'];
            if($weight != 0 && $status !=-1){
                $relative_fields = $subtable_result['relative_fields'];
                $db_table = $subtable_result['db_table'];
                $sql_content = "select * from  $db_table where $relative_fields = '$data'" ;
                $result_content = $db -> Select($sql_content);
                $appJSON[$subtable_id]['title'] = $subtable_result['name'];
                $appJSON[$subtable_id]['weight'] = $weight;
                //需要将所有的字段全都连到一起去。
                $db_fields = explode(",",$subtable_result['db_fields']);
                foreach($db_fields as $fields_item){
                    foreach($result_content as $result_item){
                        $appJSON[$subtable_id]['content'] = $appJSON[$subtable_id]['content'].$result_item[$fields_item];
                    }
                }
                
            }
        }
        
        if(isset($result1['extra_info'])){
            $extra_data = json_decode($result1['extra_info']);

            foreach($extra_data as $key  => $value){
//                 var_dump($key);
                $items = $value->items;
                foreach($items as $tmp){
                    $appJSON[$key]['content'] = $appJSON[$key]['content'] . $tmp->val;
                }
            }
        }
        
        //循环将为
        if($appJSON != null){
            foreach ($appJSON as $array_item){
                $arrayJSON1[$count] = $array_item;
                $count++;
            } 
        }else{
            $arrayJSON1 = array();
        }
         
        echo json_encode($arrayJSON1);
		$db->close ();
	}
	
	//查重插入数据表
	function checkStatus( $project_id,$isPass,$opinion ,$url){
	    $db = new DB();
	    $check['project_id'] = $project_id;
	    $check['ispass'] = $isPass;
	    $check['pdf_url'] = $url;
	    $check['opinion'] = $opinion;
	    $result = $db->UpdateData3('check_status',$project_id,$check,'project_id');	
// 	    echo $result;
	    $db->close ();
	}
	
}