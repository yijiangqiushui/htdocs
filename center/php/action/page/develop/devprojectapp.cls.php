<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
	session_start();
	
	class AgreeApp{
		
		 function attach($name,$project_id){
		    $db = new DB();
			$last_modify = strtotime("now");
			$table_status = 4;
 			$project_condition = 4;
 			$project_stage=1;
			
			/* $conn = mysql_connect("david","FRED","123456");
			mysql_select_db("project",$conn); */
			
			$sql = "update table_status set last_modify = $last_modify,table_status=$table_status where project_id='$project_id' and table_name='$name'";
			$result = $db -> SelectOri($sql);
			
			$sql1 = "select table_status from table_status where table_name='北京市通州区科技计划项目实施方案' and project_id='$project_id'";
		    $sql2 = "select table_status from table_status where table_name='通州区支持产学研合作项目申请书' and project_id='$project_id'";
		    $result1 = $db -> SelectOri($sql1);
		    $result2 = $db -> SelectOri($sql2);
		    $res1 = mysql_fetch_object($result1);
		    $res2 = mysql_fetch_object($result2);
//  		    echo $res1->table_status;
//  		    echo $res2->table_status;
		    
		    if($res1->table_status == 4 && $res2->table_status == 4)
		    {
		    	$sql2 = "update project_info set project_condition=$project_condition,project_stage=$project_stage where project_id='$project_id'";
		   		echo $sql2;
		    	$db -> SelectOri($sql2);
		    }	
			echo $result ;
			
		    
			$db -> Close();
			
		}
		
		function execute_solution($name,$project_id){
		    $db = new DB();
			$last_modify = strtotime("now");
			$table_status = 4;
			$project_condition = 4;
			$project_stage=2;
			
			/* $conn = mysql_connect("david","FRED","123456");
			mysql_select_db("project", $conn); */
			
			$sql = "update table_status set last_modify=$last_modify,table_status=4 where project_id='$project_id' and table_name='$name'";
// 			echo $sql;
			$result = $db->SelectOri($sql);
			
			$sql1 = "select table_status from table_status where table_name='项目实施方案' and project_id='$project_id'";
			$sql2 = "select table_status from table_status where table_name='项目任务书' and project_id='$project_id'";
			$sql3 = "select table_status from table_status where table_name='专家名单及专家论证意见' and project_id='$project_id'";
			$result1 = $db->SelectOri($sql1);
			$result2 = $db->SelectOri($sql2);
			$result3 = $db->SelectOri($sql3);
			$res1 = mysql_fetch_object($result1);
			$res2 = mysql_fetch_object($result2);
			$res3 = mysql_fetch_object($result3);
			
			if($res1->table_status == 4 && $res2->table_status == 4 && $res3->table_status == 4)
			{
				$sql2 = "update project_info set project_condition=$project_condition,project_stage=$project_stage where project_id='$project_id'";
				$db->SelectOri($sql2);
			}
			echo $result;
			$db->Close();
		}
		
		function middle_solution($name,$project_id){
		    $db = new DB();
			$last_modify = strtotime("now");
			$table_status = 4;
			$project_condition = 4;
			$project_stage=3;
				
			/* $conn = mysql_connect("david","FRED","123456");
			mysql_select_db("project", $conn); */
// 			echo $sql;
			$sql = "update table_status set last_modify=$last_modify,table_status=4 where project_id='$project_id' and table_name='$name'";	
			$result = $db->SelectOri($sql);
			
			$sql1 = "select table_status from table_status where table_name='北京市通州区科技计划项目调整申请表' and project_id='dev1447641248'";
			$sql2 = "select table_status from table_status where table_name='项目中期报告' and project_id='dev1447641248'";
			$result1 = $db->SelectOri($sql1);
			$result2 = $db->SelectOri($sql2);
			$res1 = mysql_fetch_object($result1);
			$res2 = mysql_fetch_object($result2);
			
			if($res1->table_status == 4 && $res2->table_status == 4)
			{
				$sql2 = "update project_info set project_condition=$project_condition,project_stage=$project_stage where project_id='$project_id'";
				mysql_query($sql2);
			}
			echo $result ;
			$db->Close();
		}
		
	function expertproaccept($name,$project_id){
	    $db = new DB();
		$last_modify = strtotime("now");
		$table_status = 4;
		$project_condition = 4;
		$project_stage=3;
		
/* 		$conn = mysql_connect("david","FRED","123456");
		mysql_select_db("project", $conn); */
		
		$sql = "update table_status set last_modify=$last_modify,table_status=4 where project_id='$project_id' and table_name='$name'";
		echo $sql;
		$result = $db->SelectOri($sql);
			
		$sql1 = "select table_status from table_status where table_name='项目验收专家组意见' and project_id='$project_id'";
		$sql2 = "select table_status from table_status where table_name='项目中期报告' and project_id='$project_id'";
		$sql3 = "select table_status from table_status where table_name='项目经费总决算表' and project_id='$project_id'";
		$result1 = $db->SelectOri($sql1);
		$result2 = $db->SelectOri($sql2);
		$result3 = $db->SelectOri($sql3);
		$res1 = mysql_fetch_object($result1);
		$res2 = mysql_fetch_object($result2);
		$res3 = mysql_fetch_object($result3);
			
		if($res1->table_status == 4 && $res2->table_status == 4 && $res3->table_status == 4)
		{
			$sql2 = "update project_info set project_condition=$project_condition,project_stage=$project_stage where project_id='$project_id'";
			mysql_query($sql2);
		}
		echo $result ;
		$db->Close();
		}
}
?>