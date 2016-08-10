<?php 
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title><link rel="stylesheet" type="text/css"
	href="../../../../../website/html/view/css/tablestyle.css" />
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css">
	<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
	<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../html/view/js/setProject.js"></script>
    <script type="text/javascript" src="../../../../html/view/js/check_list.js"></script>

</head>
<style>
/* table{border-right:1px solid #4F4F4F;border-bottom:1px solid #4F4F4F}
table td{border-left:1px solid #4F4F4F;border-top:1px solid #4F4F4F} */
table{ background:#000;}
table th{background:#FFFAF0;font-size:15px;height:35px;font-family: 黑体}
table tr td{ background:#FFFAF0;font-family: 黑体;font-size: 1.5em;}
table tr td {text-align:center;}
#sidebar { float:left;}
td{height:35px;}
body{
	margin:0;
}
</style>
<body>
    
<?php
    function check_list($stage){
        $db = new DB();
        $department = $_GET['department'];
        $min_status = empty($_GET['min'])?0:$_GET['min'];
        $max_status = empty($_GET['max'])?PHP_INT_MAX:$_GET['max'];
        $project_type = $_GET['name'];
        $max_status = $_GET['max'];
        if($stage != 4){
            $sql = "Select * from project_info where department = '$department' and project_type = '$project_type' and project_stage = $stage";
        }
        else {
            $sql = "Select * from project_info where department = '$department' and project_type = '$project_type'";
            
        }
        echo '<div id="sidebar">
                    <table   border="1" class="table" style="width: 100%;height:100%;margin:1;" height="800px" name="checklist" >
                    <th width="300px"  name="id" align="center" ><h2>序号</h2></th>
                    <th width="550px"  name="name" align="center"><h2>项目名称</h2></th>
                    <th width="550px"  name="project_stage" align="center"><h2>项目阶段</h2></th>
                    <th width="550px"  name="project_status" align="center"><h2>项目状态</h2></th>
                    <th width="222px"  name="operation" align="center"><h2>操作</h2></th>
                    <th width="222px"   align="center"><h2>中期报告</h2></th>
					<th width="222px"   align="center"><h2>验收阶段</h2></th>';
        
        $result = $db -> SelectOri($sql);
        $row_n = mysql_num_rows($result);
        $number = 0;
        for($i = 1; $i <=  $row_n;$i++){
            $project_sci = mysql_fetch_object($result);
            $project_id = $project_sci->project_id;
            $sql_table = "Select * from table_status where project_id = '$project_id' and project_stage = '$project_sci->project_stage'";
            $result_table = $db -> SelectOri($sql_table);
            $table_n = mysql_num_rows($result_table);
            
            $min = 100;
            for($j = 1;$j <= $table_n;$j++){
                $row_table = mysql_fetch_object($result_table);
                $open = $row_table->open;
                if((($row_table -> table_status) < $max_status && ($row_table -> table_status) > $min_status)||($row_table -> table_name)=='项目中期报告'){
                    $number = $number + 1;

                    echo "<tr>";
                    echo "<td align='center' >".$number."</td>";
                    echo "<td align='center' >".$project_sci->project_name."</td>";
                     
                    //项目阶段
                    switch($project_sci->project_stage){
                    	case 0:
                        	$stage = "申报阶段";break;
                    	case 1:
                            $stage = "立项阶段";break;
                        case 2:
                            $stage = "实施阶段";break;
                        case 3:
                            $stage = "验收阶段";break;
                        default: $stage = "状态出错";break;
                    }
                    echo "<td align='center'>".$stage."</td>";
                        //要以当前最后一个表格的状态为最终的状态值.****************************
                
                    switch ($row_table -> table_status){
                        case 1:
                            $condition = "待提交";break;
                        case 2:
                            $condition = "审核中";break;
                        case 3:
                            $condition = "驳回修改";break;
                        case 4:
                            $condition = "审核通过";break;
                        case 5:
                            $condition = "审核未通过";break;
                        default: $condition= "无状态";break;
                }
                    echo "<td align='center'>".$condition."</td>";
                    echo "<td align='center'><a href = '#' style='text-decoration:none;' onclick=\"setProject("."'".$project_id."'".");\" >审批</a></td>";
                    if($project_sci->project_stage < 2)	{
                    	echo "<td>未开启</td>";
                    }
                    else if($project_sci->project_stage = 2){
                    	if($open == 0){
	                        echo "<td><a href = '#' style='text-decoration:none;' onclick=\"checkstage("."'".$project_id."'".");\" >开启</a></td>";
                   		}
                   		else{
                   			echo "<td>已开启</td>";
                   		}  
	               }
                   else if($project_sci->project_stage = 3){
                        echo "<td>已开启</td>";
                    }
                    echo "</tr>";
                    break;
                }
            }
        }
        echo "</table>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<br><br><br>";
        echo "<input type='button' value='待提交的项目' style='font-family:黑体; width:175px;height:40px; font-size:1.5em;' onclick='checklist(\"".$department."\",0,2);' />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input type='button' value='待审核的项目 ' style='font-family:黑体;width:175px;height:40px; font-size:1.5em;' onclick='checklist(\"".$department."\",1,4);' />";
        echo ' </table></div>
            ';
    }
            

 ?>
 <div class="easyui-tabs" >
	    <div title="全部" style="padding:10px; width:655px;">
	    <?php 
	    check_list(4);
	    ?>
	    </div>
		<div title="申报阶段" style="padding: 10px;width:655px;">
		<?php
		  check_list (0);
		?>
		</div>
		<div title="立项阶段" style="padding: 10px;width:655px;">
		<?php
		  check_list (1);
		?>
	    </div>
		<div title="实施阶段" style="padding: 10px;width:655px;">
		<?php
		  check_list (2);
		?>
	    </div>
		<div title="验收阶段" style="padding: 10px;width:655px;">
		<?php
		  check_list (3);
		?>
	    </div>

	</div>
</body>
</html>

 


