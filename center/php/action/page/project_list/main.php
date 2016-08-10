<?php 
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
    session_start();
    $department_type = $_SESSION['department'];
    switch($department_type){
        case 0:
            $department = "发展计划科";break;
        case 1:
            $department = "知识产权科";break;
        case 2:
            $department = "科技综合科";break;
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css">
	<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
	<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../html/view/js/check_list.js"></script>

</head>
<style>
   /* td
   	{
	  height:30px;
   	  font-size:1.5em;
   	  text-align:center;
   	}
   	th
   	{
	  font-size:1.5em;
    } */
table{ background:#000;}
table th{background:#FFFAF0; height:35px; font-family: "黑体";font-size: 1.5em;}
table tr td{ background:#FFFAF0; height:35px; font-family: "微软雅黑";font-size: 1.3em;}
</style>
<body>


<div class="easyui-panel" title=<?php echo $department."项目列表" ?>
            collapsible="false" resizable="false" border="false">
<table border="1" cellpadding="0" cellspacing="1"width="80%" height="800px">
  <tr>
    <th width="60"  name="id" align="center" >序号</td>
    <th width="400"   name="name" align="center">项目类别</td>
    <th width="120"   name="start_time" align="center" >申报开始日期</td>
    <th width="120"   name="end_time" align="center">申报结束日期</td>
    <th width="100"  name="check_num" align="center">待审核数量</td>
    <th width="60"  name="operation" align="center">操作</td>
  </tr>
  <?php
    $db = new DB();
    $sql = "Select * from project_type where isfather=1";
    /* $conn = mysql_connect("david","FRED","123456");
    mysql_select_db("project",$conn); */
    $result = $db->SelectOri($sql);
    $row_n = mysql_num_rows($result);
    $num = 0;
    for($i = 1;$i <= $row_n;$i++){
        $father = mysql_fetch_object($result);
        
        //用来判断当前的父节点是否存在子节点
        
        $id = $father->id;
        //当前父节点中子节点的个数
        $sql1 = "Select * from project_type where father='$id' and dep_type ='$department_type' and apply_status = 1";
        $result1 = $db->SelectOri($sql1);
        $row_m = mysql_num_rows($result1); 
        if($row_m != 0){
            $num = $num + 1;
            echo "<tr>";
            echo "<td align='center' >".$num."</td>";
            echo "<th align='center'>".$father->name."</th>";
            if($father->id == $father->father  && $father->apply_status == 1 ){
                $start_time = date("Y-m-d",$father->apply_start);
                if($father->apply_end != null){
                    $end_time = date("Y-m-d",$father->apply_end);
                }
                else{
                    $end_time = null;
                }
                echo "<td  align='center'> $start_time</td>";
                echo "<td  align='center'>$end_time</td>";
                //查询当前项目类别所要处理的待审核数量。
                $check_num = 0;
                $sql_num = "Select * from project_info where project_type = '$father->name' and isDelete = 0";
                $result_num = $db->SelectOri($sql_num);
                $row_k = mysql_num_rows($result_num);
                //寻找当前的最小的状态作为当前的最终状态
                for($k = 1;$k <= $row_k;$k++){
                    $project_sci = mysql_fetch_object($result_num);
                    $project_id = $project_sci -> project_id;
                    $sql_table = "Select * from table_status where project_id = '$project_id' and project_stage = '$project_sci->project_stage'";
                    $result_table = $db->SelectOri($sql_table);
                  /*   $max_object = mysql_fetch_object($result_table);
                    $max = $max_object -> table_status;
                    if($max == 2 || $max == 3 ){
                        $check_num = $check_num + 1;
                    } */
                    if($project_sci -> project_stage == 2 || $project_sci -> project_stage == 3){
                        	$check_num = $check_num + 1;
                    }

                    while($tmp = mysql_fetch_object($result_table)){
                        if($project_sci -> project_stage != 2){
                            if($tmp->table_status == 2 || $tmp->table_status == 3){
                                $check_num = $check_num + 1;
                                break;
                            }
                        }

                    }
                }
                echo "<td align='center' style='color:red;font-weight: bold'>$check_num</td>";
                if($check_num != 0){
                    echo "<td align='center'><input type='button' value='受理' 
                    onclick= 'checklist($father->dep_type,1,4,"."\"".$father->name."\"".");'style='font-family:黑体;font-size:1em;width:130px;'></td>";
                }
                else{
                    echo "<td></td>";
                }
            }
            else{
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
            }
            echo "</tr>";
            /* 这部分复制到上面去了
             * $sql1 = "Select * from project_type where father='$id' and dep_type = 2";
                $result1 = mysql_query($sql1);
                $row_m = mysql_num_rows($result1); 
             */
            
            for($j = 1;$j <= $row_m;$j++){
                $children = mysql_fetch_object($result1);
            
                if($children->father != $children->id  && $children->apply_status == 1){
                    echo "<tr>";
                    echo "<td  align='center'>".$num.".".$j."</td>";
                    echo "<td  >".$children->name."</td>";
                    $start_time = date("Y-m-d",$children->apply_start);
                    if($children->apply_end != null){
                        $end_time = date("Y-m-d",$children->apply_end);
                    }
                    else{
                        $end_time = null;
                    }
                    echo "<td  align='center'>".$start_time."</td>";
                    echo "<td  align='center'>".$end_time."</td>";
            
                    $check_num = 0;
                    $sql_num = "Select * from project_info where project_type = '$children->name' and isDelete = 0";
                    $result_sci = $db->SelectOri($sql_num);
                    $row_k = mysql_num_rows($result_sci);
                    for($k = 1;$k <= $row_k;$k++){
                        $project_sci = mysql_fetch_object($result_sci);
                        $project_id = $project_sci -> project_id;
                        $sql_table = "Select * from table_status where project_id = '$project_id' and project_stage = '$project_sci->project_stage'";
                        $result_table = $db->SelectOri($sql_table);
                /*         $max_object = mysql_fetch_object($result_table);
                        $max = $max_object -> table_status;
                        if($max == 2 || $max == 3 ){
                            $check_num = $check_num + 1;
                        } */
                        if($project_sci -> project_stage == 2 || $project_sci -> project_stage == 3){
                            $check_num = $check_num + 1;
                        }
                        while($tmp = mysql_fetch_object($result_table)){
                            if($project_sci -> project_stage != 2){
                                if($tmp->table_status == 2 || $tmp->table_status == 3){
                                    $check_num = $check_num + 1;
                                    break;
                                }
                            }
              
                        }
                    }
                    echo "<td align='center' style='color:red;font-weight: bold'>$check_num</td>";
                    if($check_num != 0){
                        echo "<td align='center'><input type='button' value='受理' 
                    onclick= 'checklist($children->dep_type,1,4,"."\"".$children->name."\"".");'style='font-family:黑体;font-size:1em;width:130px;'></td>";
                    }
                    else{
                        echo "<td></td>";
                    }
            
                    echo "</tr>";
                }
            
            } 
        }
    }
    

	?>
</table>
</div>
</body>
</html>
