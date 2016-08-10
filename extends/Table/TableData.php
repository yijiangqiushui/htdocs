<?php
/**
 * 读取和保存table的数据
 *
 * @author 风格独特
 */

require_once __DIR__ . '/../../common/php/config.ini.php';
require_once __DIR__ . '/../../common/php/lib/db.cls.php';

class TableData
{
    public static function save($project_id, $subtable_id, $data)
    {
        $db = new DB();
        $subtable_id = (int) $subtable_id;
       $data = mysql_real_escape_string(json_encode($data));

        //project exist or not 
        $project = $db->GetInfo1($project_id, 'project_info', 'project_id');
        //不存在
        if (empty($project)) {
            return false;
        }
        //view link
        $subtable = $db->GetInfo($subtable_id, 'subtable_list');
        if (empty($subtable)) {
            return false;
        }
        //projet_id and view link are valid
        $sql = "select * from `table_data` where `project_id`='{$project_id}' and `subtable_id`={$subtable_id}";
        $row = $db->Select($sql);
        //inexistence :insert;existence : update;
        if (count($row) < 1) {
            $insert_data = array(
                'project_id'    => $project_id,
                'subtable_id'   => $subtable_id,
                'data'          => $data,
            );
            return $db->InsertData('table_data', $insert_data);
        }

        $sql = $sql = "update `table_data` set `data`='{$data}' where `project_id`='{$project_id}' and `subtable_id`={$subtable_id}";
        return $db->Update($sql);
    }

    public static function get($project_id, $subtable_id)
    {
        $db = new DB();

        $subtable_id = (int) $subtable_id;
        $sql = "select * from table_data where project_id='{$project_id}' and subtable_id={$subtable_id}";
        $row = $db->Select($sql);
        if (count($row) < 0) {
            return null;
        }
        
        //$data:array format
        $data = @json_decode($row[0]['data'], true);
//         if($data['project_name'] == null){
//         	$db = new DB();
// 	   		$res1 = $db -> GetInfo1($project_id, 'project_info', 'project_id');
// // 	   		var_dump($res1);
// // 	   		exit();
// 	   		$org_code = $res1['org_code'];
// 	   		$res2 = $db -> GetInfo1($org_code, 'org_info', 'org_code');
// 	   		$start_end_time = date('Y-m-d',$res1['start_time']) .'~'. date('Y-m-d',$res1['end_time']);
//    		    $db -> Close();
//    		    $data['project_name'] = $res1['project_name'];
//    		    $data['business_id'] = $res1['business_id'];
//    		    $data['start_end_time'] = $start_end_time;
//    		    $data['org_name'] = $res2['org_name'];
//         }
         //var_dump($data);
        //exit();
        if (is_null($data)) { 
            return null;
        }
        
        return array(
            'project_id'    => $project_id,
            'subtable_id'   => $subtable_id,
            'data'          => $data,
        );
    }

    public static function easyuiJson($array)
    {
        $return = array();
        
        //david modify 
        if($array != null){
        	
        	foreach($array as $key1 => $value) {
        		if (is_array($value)) {
        			foreach($value as $key2 => $value2) {
        				$return[$key1 . "[{$key2}]"] = $value2;
        			}
        		} else {
        			$return[$key1] = $value;
        		}
        	}
        }


        return json_encode($return);
    }
}

// TableData::save('dev1451714872', 1, array(1, 2, 3));
// TableData::get('dev1451714872', 11);
