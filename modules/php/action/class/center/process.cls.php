<?php
class Process{
    function projectProcess($department,$project_array){
    
        $db = new DB();
        $arr= (array)$project_array;
        $data['code'] = 0;
        foreach($arr as $tmp){
            if($tmp != ""  || $tmp != null){
                $data['code'] = 1;
            }
        } 
     if($data['code']==0){ 
        echo json_encode($data);exit();
        }
//         $project_array = array_values($project_array);

       foreach ($arr  as $key=>$value)  {
      
        	$str = "";
             //printf($value);exit;
            if($value==null){
            	$value_list="0,0,0,0";
            	//continue;
            	}
            else{
            $value_list = implode(",",$value);}
//             echo $value_list."dfdfdf" ;
/*             echo "value_list:".$value_list;
            echo "ttttt:".strpos($value_list,'9'); */
//             echo "value_list:".$value_list;
            if(strpos($value_list,'0') > -1){
                $str = $str.",apply_stage = 1";
            }
            else{
                $str = $str.",apply_stage = 0";
            }
            if(strpos($value_list,'1') > -1){
                $str = $str.",setup_stage = 1";
            }
            else{
                $str = $str.",setup_stage = 0";
            }
            if(strpos($value_list,'2') > -1){
                $str = $str.",carry_stage = 1";
            }
            else{
                $str = $str.",carry_stage = 0";
            }
            if(strpos($value_list,'3') > -1){
                $str = $str.",check_stage = 1";
            }
            else{
                $str = $str.",check_stage = 0";
            }
           
            $data = trim($str,',');
/*             echo "data:".$data."<br/>";
            echo "str:".$str; */
            
            $sql = "Update project_type set $data where id = $key";
             //echo $sql;
             //exit;
            $result = $db -> Update($sql);
        }
        $db->close();
//         $RES['code'] = 1;
        echo json_encode($data);
      
    }
    
    
    /*
     * david
     * 用来回写当前项目的流程状态
     */
    function findProcess($department){
        $db = new DB();
        if($department == 4){
            $sql = "Select * from project_type where dep_type >= 0";
        }
        else{
            $sql = "Select * from project_type where dep_type = $department";
        }
//         $sql = "Select * from project_type ";
        $process_result = $db->Select($sql);
        $db->close();
        foreach($process_result as $result){
            $processJSON[$result['id']]['apply_stage'] = $result['apply_stage'];
            $processJSON[$result['id']]['setup_stage'] = $result['setup_stage'];
            $processJSON[$result['id']]['carry_stage'] = $result['carry_stage'];
            $processJSON[$result['id']]['check_stage'] = $result['check_stage'];
        }
//         echo "1";
//         print_r($processJSON);
        echo json_encode($processJSON);
    }
}

?>