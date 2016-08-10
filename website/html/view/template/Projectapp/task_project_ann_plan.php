<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
	<script type="text/javascript" src="../../../../../common/html/js/validation.js"></script>
<script type="text/javascript" src="../../js/projectapp/task_project_ann.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
  <style>
        input[type='text'] {
            width: 100px;
            border: 0;
        	height:80%;
            background: #fff;
        }
        textarea{
	         margin-top: 200px;
        	margin-left: 200px;
        }
    </style>
</head>
<body> 
 <div class="project_content">
   <div class="table_title clearfix">
       <div class="title_pic left">项目任务书填写</div>
       <div class="right back_pic" id="back"></div>
   </div>
   <div class="table_content back-long">
       <form action="" id='project_ann'  method="post">
           <table border="0" cellpadding="0" cellspacing="0" class="basic_info">
             <tr>
                <td style="background-color:#7AB5ED;height:20px;" colspan="2"> <div class="title_top p-b10">项目各年度任务目标、考核指标及研究开发内容完成的计划进度</div> </td>
		     </tr>
		     <tr>
		      <td colspan="3">
		       <table id='addtable' >
					 <?php 
					 echo "<tr >";
					 echo "<td style='width:20%;'><input  style='text-align:center' value='年度'/> </td>";
					 echo " <td ><textarea   readonly='readonly' style=' padding:10px;margin:10px;background-color:#D1E4F3;height: auto;width:90%;overflow-y:hidden;'>分年度研发内容、目标及考核指标（项目应按季度填写计划进度与阶段目标，阶段任务目标应明确、可考核，并能够满足项目及相关项目计划进度的要求）</textarea></td>";
					 echo "<td width='76px;'><input type='button' value='操作' /></td>";
					 echo "</tr>";
					    session_start();
					  	$project_id = $_SESSION['project_id'];
							$sql = "Select * from project_ann_plan where task_project_id= '$project_id' ";
// 							echo $sql;
							$db = new DB (); 
							$result = $db->SelectOri ( $sql );
							$tableRow = array();
							if($result != false){
								$tableRow = mysql_num_rows ( $result );
							}
							if ($tableRow) {  
								for($i = 0; $i < $tableRow; $i ++) {
									$row = mysql_fetch_object ( $result );
									echo "<tr style='background-color:#D1E4F3 '>";
									echo "<td style=\"width:20%;\"><p>
									<input   name='plan_year[$i]' class='current_year' style='width:50px;' datatype='num4year'/><label>年</label></p>
									</td>";

									echo " <td ><textarea name='plan_content[$i]'  value='' style='padding:10px;margin:10px;' ></textarea></td>";
									echo "<td width='66px;' class='pointer but'><input type='button'  value='删除' class='pointer' onclick='delLine(this)'/></td>";
									echo "</tr>";
								}
							} else {
									echo "<tr>";
                                    echo '<td style="width:20%;"><p>
									<input  name="plan_year[0]" class="current_year" style="width:50px;" datatype="num4year"/><label>年</label></p>
									</td>';
                                    echo " <td ><textarea name='plan_content[0]' value='' style='padding:10px;margin:10px;'></textarea></td>";
									echo "<td width='66px;' class='pointer but'><input type='button'  value='删除' class='pointer' onclick='delLine(this)'/></td>";
									echo "</tr>";
							}
					?>
				  </table>
			    </td>
              </tr>
  
            <tr>
				<th colspan="9" height="25"><input type="button" class='pointer' value="添加" onclick="addLine()" /></th>
		   </tr>
      </table>
       <div class="button_wrapper clearfix">
              <!--   <div class="submit" >提交</div> -->
                <div class="save" >保存</div>
                <!-- <div class="reset" >重置</div> -->
       </div>
       </form>
     </div>
 <!-- *********************************************我是分割线*************************************************************************** -->
</div>
</body>
</html>
