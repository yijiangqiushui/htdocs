<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
    <title>无标题文档</title>
    <link rel="stylesheet" type="text/css"
          href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../../../../common/html/plugin/easyui/themes/icon.css"/>
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
    <script type="text/javascript" src="../../js/projectapp/project_ann.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/table.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/button.css"/>
    <style>
       textarea {
            border: 1px solid #1B63AB;
            height: 200px;
            width: 95%;
        }
        td {
            padding: 10px;
        }


    </style>
</head>
<body>
<form id="project_ann" method="post">
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
					    session_start();
					  	$project_id = $_SESSION['project_id'];
							$sql = "Select * from project_ann_plan where project_id= '$project_id' ";
// 							echo $sql;
							$db = new DB (); 
							$result = $db->SelectOri ( $sql );
							$tableRow = mysql_num_rows ( $result );
							if ($tableRow) {  
								for($i = 0; $i < $tableRow; $i ++) {
									$row = mysql_fetch_object ( $result );
									echo "<tr style='background-color:#D1E4F3 '>";
									
									
									echo "<td>
									<p align='center'>
									<select name='plan_year[$i]'   class='current_year'>
	                                </select>
	                                &nbsp;&nbsp;年
									</p>
									</td>";

									echo " <td ><textarea name='plan_content[$i]'  value='' style=' margin:10px;' > </textarea></td>";
									echo "<td width='20'><input type='button' value='删除' onclick='delLine(this)'/></td>";
									echo "</tr>";
								}
							} else {
									echo "<tr>";
                                    echo '<td>
									<p align="center">
									<select name="plan_year[0]" class="current_year">
	                                </select>
	                                &nbsp;&nbsp;年
									</p>
									</td>';
                                    echo " <td ><textarea name='plan_content[0]'   ></textarea></td>";
									echo "<td><input type='button' value='删除' onclick='delLine(this)'/></td>";
									echo "</tr>";
							}
					?>
				  </table>
			    </td>
              </tr>
  
            <tr>
				<td colspan="9" height="25"><input type="button" value="添加" onclick="addLine()" /></td>
		   </tr>
      </table>
       <div class="button_wrapper clearfix">
              <!--   <div class="submit" >提交</div> -->
                <div class="save" >保存</div>
                <!-- <div class="reset" >重置</div> -->
       </div>
       </form>
     </div>
    </div>
</form>
</body>
</html>
