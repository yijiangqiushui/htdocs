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
<!-- 	<link rel="stylesheet" type="text/css" href="../css/table.css">
	<link rel="stylesheet" type="text/css" href="../css/button.css"> -->
</head>
<style>
table{ background:#000;}
table th{background:#FFFAF0;}
table tr td{ background:#FFFAF0;font-family: 黑体;font-size: 1.5em;}
</style>

<div class="easyui-panel" title="知识产权科项目列表" collapsible="false" resizable="false" >
<table width="1286" border="1" class="table">
    <th width="125" height="30" name="id" align="center" ><h2>序号</h2></th>
    <th width="450" height="30" name="name" align="center"><h2>项目名称</h2></th>
    <th width="250" height="30" name="project_type" align="center"><h2>项目类型</h2></th>
    <th width="450" height="30" name="start_end" align="center"><h2>申报起止日期</h2></th>
    <th width="125" height="30" name="project_stage" align="center"><h2>项目阶段</h2></th>
    <th width="136" height="30" name="project_status" align="center"><h2>项目状态</h2></th>
    <th width="136" height="30" name="operation" align="center"><h2>操作</h2></th>
    
    <?php
        include '../../../../../common/php/config.ini.php';
        include '../../../config.ini.php';
        include ROOTPATH.'lib/common.cls.php';
        include ROOTPATH.'lib/db.cls.php';
        include ROOTPATH.'lib/user.cls.php';
        
        $sql = "Select * from project_info where department = '发展计划科'";
        $conn = mysql_connect("192.168.1.125","FRED","123456");
        mysql_select_db("project",$conn);
        $result = mysql_query($sql,$conn);
        $row_n = mysql_num_rows($result);
        for($i = 1; $i <=  $row_n;$i++){
            $project_kno = mysql_fetch_object($result);
            echo "<tr>";
            echo "<td align='center' height='30'>".$i."</td>";
            echo "<td align=center>".$project_kno->project_name."</td>";
            echo "<td align=center>".$project_kno->project_type."</td>";
            $sql_project = "Select * from project_type where name='$project_kno->project_type'";
           
            $result1 = mysql_query($sql_project,$conn);
            $result_project = mysql_fetch_object($result1);
            $start = date("Y/m/d",$result_project->apply_start);
            $end = date("Y/m/d",$result_project->apply_end);
            echo "<td width='250' align=center>".$start."--".$end."</td>";
            
            //项目阶段
            switch($project_kno->project_stage){
                case 1:
                    $stage = "立项阶段";break;
                case 2:
                    $stage = "实施阶段";break;
                case 3:
                    $stage = "验收阶段";break;
            
                default: $stage = "状态出错";break;
            }
            echo "<td align=center>".$stage."</td>";
            //要以当前最后一个表格的状态为最终的状态值.****************************
            $project_id = $project_kno->project_id;
            $sql_table = "Select * from table_status where project_id = '$project_id' and project_stage = '$project_kno->project_stage'";
            $result_table = mysql_query($sql_table,$conn);
            $table_n = mysql_num_rows($result_table);
            $min = 100;
            for($j = 1;$j <= $table_n;$j++){
                $row_table = mysql_fetch_object($result_table);
                if(($row_table -> table_status) < $min){
                    $min = $row_table -> table_status;
                }
            }
            switch ($min){
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
            echo "<td align=center>".$condition."</td>";
            echo "<td><a href = '#' onclick=";" >审批</a></td>";
            echo "</tr>";
        }
        
    ?>
</table>
</div>


