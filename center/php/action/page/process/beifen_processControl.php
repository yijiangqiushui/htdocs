<?php 
    session_start();
    
//     $department_type = $_SESSION['department'];
    $department_type = 0;
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
<title>权限</title>
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css">
	<script src="../../../../html/view/js/jquery-1.11.2.min.js"></script>
<!--      <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script> -->
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script src="../../../../html/view/js/processControl.js"></script>
</head>

<style>
    table{ background:#000;}
    table th{background:#FFFAF0; font-family: 黑体;font-size: 1.3em;height:35px;}
    table tr td{ background:#FFFAF0;font-family: 微软雅黑;font-size: 1em;height:35px;}
</style>
<body>

<div style="background:#A2B5CD;text-align:center;height:50px;"><h1>项目流程控制</h1></div>
<div class="easyui-panel" title=<?php echo $department."项目流程控制" ?> collapsible="false" resizable="false" border="0" >
<form class="easyui-panel" id="project_process" method="post" action="">
<table width="1111" border="0" cellpadding="0" cellspacing="1">
<tr>

 <th align="center">项目编号</th>
 <th align="center">项目名称</th>
 <th align="center">申报阶段</th>
 <th align="center">立项阶段</th>
 <th align="center">实施阶段</th>
 <th align="center">验收阶段</th>
 <th align="center" colspan='2'>操作</th>

</tr>
  <?php
  include '../../../../../center/php/config.ini.php';
  include '../../../../../common/php/config.ini.php';
  include '../../../../../common/php/lib/db.cls.php';
  
    $db = new DB();
    $sql = "Select * from project_type where isfather=1";
//     $conn = mysql_connect("192.168.1.125","FRED","123456");
//     mysql_select_db("project",$conn);
    
    $result = $db->SelectOri($sql);
    $row_n = mysql_num_rows($result);
    $num = 0;
    for($i = 1;$i <= $row_n;$i++){
        $father = mysql_fetch_object($result);
        
        //用来判断当前的父节点是否存在子节点
        $id = $father->id;
        //当前父节点中子节点的个数
        $sql1 = "Select * from project_type where father='$id' and dep_type =".$department_type;
        $result1 = $db->SelectOri($sql1);
        $row_m = mysql_num_rows($result1); 
        if($row_m != 0){
            $num = $num + 1;
            echo "<tr>";
            echo "<td width='80' align='center'><strong>".$num."</strong></td>";
            echo "<td width='400' align='center'><strong>".$father->name."</strong></td>";
            if($father->id == $father->father){
                echo "<td width='100' align='center'><input type='checkbox' name='$father->id[]' value='0' onclick='checkAll($father->id);'/><span>开启</span></td>";
                echo "<td width='100' align='center'><input type='checkbox' name='$father->id[]' value='1' onclick='checkAll($father->id);'/><span>开启</span></td>";
                echo "<td width='100' align='center'><input type='checkbox' name='$father->id[]' value='2' onclick='checkAll($father->id);'/><span>开启</span></td>";
                echo "<td width='100' align='center'><input type='checkbox' name='$father->id[]' value='3' onclick='checkAll($father->id);'/><span>开启</span></td>";
                //全选和反选
                echo "<td width='100' align='center'><input type='radio' name='$father->id.radio' onclick='chooseAll($father->id)'/><span>全选</span></td>";
                echo "<td width='100' align='center'><input type='radio' name='$father->id.radio' onclick='reverseAll($father->id)'/><span>反选</span></td>";
            }
            else{
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
//                 echo "<td></td>";
            }
            echo "</tr>";
            
            for($j = 1;$j <= $row_m;$j++){
                $children = mysql_fetch_object($result1);
            
                if($children->father != $children->id){
                    echo "<tr>";
                    echo "<div class='$children->name'>";
                    echo "<td  align='center'>".$num.".".$j."</td>";
                    echo "<td  align='center'>".$children->name."</td>";
                    echo "<td align='center'><input type='checkbox' value='0' name='$children->id[]' onclick='checkAll($children->id);'/><span>开启</span></td>";
                    echo "<td align='center'><input type='checkbox' value='1' name='$children->id[]' onclick='checkAll($children->id);'/><span>开启</span></td>";
                    echo "<td align='center'><input type='checkbox' value='2' name='$children->id[]' onclick='checkAll($children->id);'/><span>开dddd启</span></td>";
                    echo "<td align='center'><input type='checkbox' value='3' name='$children->id[]' onclick='checkAll($children->id);'/><span>开启</span></td>";
                    //全选和反选
                    echo "<td width='100' align='center'><input type='radio' name='$children->id.radio' onclick='chooseAll($children->id);'/><span>全选</span></td>";
//                     echo "<td width='100' align='center'><input type='radio' name='$children->id' onclick='denyAll($children->id);'/><span>全不选</span></td>";
                    echo "<td width='100' align='center'><input type='radio' name='$children->id.radio' onclick='reverseAll($children->id);'/><span>反选</span></td>";
                    
                    echo "</div>";
                    echo "</tr>";
                }
            
            } 
        }
        
        
    }
	?>
</table>
</form>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <!--  <a href='../project_list/main.php' target="main_center" style='text-decoration:none;'><input type='button' value='确认并返回' style="width:150px;height:35px;font-family: 黑体;font-size: 1em;"/></a>-->
     <input type='button' value='确认并返回' onclick='processCon();' style="width:150px;height:35px;font-family: 黑体;font-size: 1em;"/>
     
</div>
</body>
</html>
