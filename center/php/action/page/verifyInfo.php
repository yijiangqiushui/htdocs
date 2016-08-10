<?php
/**
* 文件描述
* @author david <david55555.hi@gmail.com>
* @date 2015年11月24日 上午11:07:01
* @version 1.0.0
* @copyright  david
* @function 
*/
// session_start();
include '../../../../common/php/config.ini.php';
// include '../../config.ini.php';
include ROOTPATH.'lib/common.cls.php';
include ROOTPATH.'lib/db.cls.php';
include ROOTPATH.'lib/user.cls.php';
include '../../../../common/php/lib/log.cls.php';
// include 'transform.php';
/*
 * code:0 正常
 * code:1 更新表状态出错
 * code:2 
 */
class Verify
{
	
	
	function nopass($project_id,$table_name){
		$db = new DB();
		//5：审核未通过
		$timestamp = $time = strtotime("now");
		$usql = "update table_status set table_status = 5,approval_time = $timestamp where project_id = '$project_id' and table_name = '$table_name'";
		
		echo $db->Update($usql);
		//isDelete
		$project_info = $db -> GetInfo1($project_id, 'project_info', 'project_id');
		$year = date("Y",$project_info['start_time']);
		$sql="update project_info  set isDelete = 1,nopass_year = $year where project_id ='$project_id' ";
		$db->Update($sql);
		
		
		
		$data["code"] = 1;
		ob_clean();
		echo json_encode($data);
		$db->Close();
	}
	
	//查询当前项目是否已经立项了
	function checkToApprove($project_id,$project_stage,$table_name){
	    $db = new DB();
/* 	    $db = new DB();
	    $result_approve = $db -> GetInfo1($project_id, 'project_id', $tid);
	    $project_type = $result_approve['project_type']; */
        //如果是立项阶段的话，并且审核通过的文件是申报阶段的文件，我则不需要进行阶段的跳转，否则需要进行阶段的跳转过程。
        if($project_stage == 1){
            $result_table_stage = $db -> GetInfo2($project_id, 'table_status', 'project_id', $table_name, 'table_name');
            $table_stage = $result_stage['project_stage'];
            if($table_stage > $project_stage){
                return 0;
            }else{
                return 1;
            }
        }else{
            return 1;
        }
	}
    // 提交更新
    function updateStatus($table_name,$approval_opinion)
    {
        //获取project_id;
        //这个相当于code
        $project_id = $_SESSION['project_id'];
        //建立数据库链接对象
        $db = new DB();
        $timestamp = $time = strtotime("now");
        $usql = "update table_status set table_status = 4,approval_time=$timestamp,approval_opinion='$approval_opinion' where project_id = '$project_id' and table_name = '$table_name'";
        // echo $usql;
        // exit;
        $r = $db->Update($usql);
        //echo $r;
        if($r == 0)
        {
            $data["code"] = 1;
            //后期需要更改其状态值***************************************
            error_log("第一步更新操作不正确");
        }
        else
        {
            //执行第二部分操作;
            $project_stage = $db->GetInfo1($project_id,'project_info','project_id');
            $stage_process = $project_stage['stage_process'];
            $stage_result = $project_stage['project_stage'];
            $project_type = $project_stage['project_type'];
            $department = $project_stage['department'];
//             $sql1 = "select * from table_status where project_id = '$project_id' and project_stage = $stage_result";
            //需要判断之前的所有阶段的文件是否为都为审核通过的状态。 2016.01.11 david modify
            $sql1 = "select * from table_status where project_id = '$project_id' and project_stage <= $stage_result";
//             echo $sql1;
            
            $result = $db->SelectOri($sql1);
            $result_num = mysql_num_rows($result);
            $jump = true;
            
            
            
            for($i=0;$i < $result_num;$i++){
                $row = mysql_fetch_object($result);
                if($row -> table_status != 4){
                    $jump = false;
                }
            }
            
            /* if($jump){
                //如果需要跳阶段，则需要首先判断其查重是否为通过的状态，或者该项目在该阶段没有查重的文件
                $sql_check = "Select * from project_check_relative A JOIN (Select * from table_type where stage = $project_stage) B ON (A.table_type_id = B.id) where A.project_type_id = $project_type and A.status = 0 group by A.table_type_id";
                $check_result = $db -> Select($sql_check);
                $check_num = count($check_result);
                if($check_num != 0){
                    //查询当前项目的查重状态
                    $check_result = $db -> GetInfo1($project_id, "check_status", "project_id");
                    if($check_result['ispass'] == 0){
                        $jump = false;
                    }
                }
            } */
            
            if($jump){
                $jump_stage = $this->checkToApprove($project_id,$project_stage,$table_name);
                if($jump_stage){
                    if($stage_result == 1){//$stage_result != 3
                        $pos = strpos($stage_process,$stage_result);
                        //这里的+2 是为了过一个逗号
                        $stage_result = (int) substr($stage_process,$pos+2,1);
                        $usql1 = "update project_info set project_stage = $stage_result where project_id = '$project_id' ";
                        //                     echo $usql1;
                        $last = $db->Update($usql1);
                        if($last > 0){
                            //                         echo "444";
                            $data["code"] = 0;
                        }
                    } //||$stage_result == 2
                    else if($stage_result == 0 ||$stage_result == 3||$stage_result == 2){   //这里需要做一下归档的操作
                        $data["code"] = 0;
                    }
                    else{
                        $data["code"] = 1;
                    }
                }else{
                    $data["code"] = 0;
                }
                //需要知道当前所属项目类型的项目流程。
                
            }
            else{
                $data["code"] = 0;
            }
        }
        echo json_encode($data);
     }
        //驳回修改;
        function returnModify($table_name){
        //获取project_id;
            $project_id = $_SESSION['project_id'];
    
        //建立数据库链接对象
            $db = new DB();
            $timestamp = $time = strtotime("now");
        //执行第一部分操作;
//         $table_status = $db-> GetInfo2($project_id, 'table_status', 'project_id', $table_name, 'table_name');
//         $table_result = $table_status['table_status'] + 2;
//当驳回修改的时候将审核意见置为空。
            $usql = "update table_status set table_status = 3,approval_time = $timestamp,approval_opinion = '' where project_id = '$project_id' and table_name = '$table_name'";
            //驳回修改的时候还需要判断当前的文件是否是查重的文件
            
            $checksql = "Select * from project_check_relative where table_type_id = $table_name and status = 0";
            $checkResult = $db -> Select($checksql);
            if(count($checkResult) > 0){
                $resetCheck = "Update check_status set ispass = 0 where project_id = '$project_id' ";
                $resetResult = $db -> Update($resetCheck);
            }
            $result = $db->Update($usql);
            $db -> Close();
            if($result){
                $data["code"] = 0;
            }
            else{
                $data["code"] = 1;
            }
            
            //驳回修改后
//             $data["code"] = 0;
            echo json_encode($data);
        }
    
        // 权限部分
        //修改所有项目的截止日期;
        function uptDate($lastdate)
        {
            $db = new DB();
            $sql = "update project_type set apply_end = $lastdate";
            $result = $db->Update($sql);
                echo $result;
        }
    
}