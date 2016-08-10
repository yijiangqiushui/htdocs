<?php
include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css"
		href="../../../../common/html/plugin/easyui/themes/icon.css">
		<script type="text/javascript"
			src="../../../../common/html/plugin/easyui/jquery.min.js"></script>
		<script type="text/javascript"
			src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript"
			src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
		<script type="text/javascript"
			src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
		<script type="text/javascript"
			src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

</head>
<script type="text/javascript">
        window.customResize = function () {  
            var width = $(window).width() - 10;  
            var height = $(window).height();  
            var panelHeight = parseInt(height / 2); //每个1/3高度  
            $('#div1').panel('resize', { width: width, height: panelHeight });  
            $('#div2').panel('resize', { width: width, height: panelHeight });  
            $('#div0').layout('resize', { width: width, height: height });
        };
    </script>
<script type="text/javascript">
        //窗口缩放时，重绘布局控件尺寸   
        $(function () {  
            redraw();  
        });  
  
        $(window).resize(function () {
            redraw();  
        });  
  
        function redraw() {  
            if (window.customResize) {  
                customResize(); //自定义缩放函数，页面若使用多个布局控件，需自定义缩放函数处理  
            } else {  
                var width = $(window).width();  
                var height = $(window).height();  
  
                //没有自定义缩放函数时，默认对panel，layout，treegrid，datagrid等控件进行调整  
                $('.easyui-panel').panel('resize', { width: width, height: height });  
                $('.easyui-layout').layout('resize', { width: width, height: height });  
                $('.easyui-treegrid').treegrid('resize', { width: width, height: height });  
                $('.easyui-datagrid').datagrid('resize', { width: width, height: height });  
            }  
        }   
    </script>
<style>
table {
	border-right: 1px solid #4F4F4F;
	border-bottom: 1px solid #4F4F4F;
}

table td {
	border-left: 1px solid #858585;
	border-top: 1px solid #858585;
}

td {
	height: 35px;
	font-size: 1.5em;
	text-align: center;
}

th {
	font-size: 1.5em;
}
body{
	margin:0;
}
input{
	height:100%;
	width:99.5%;
}
</style>
<body>
	<form id="approve" method="post" action="">
		<div id="div0" class="easyui-layout" border="false"
			style="width: 100%; height: 1000px;">
			<div id="div1" data-options="region:'north',split:true"
				title="项目基本信息">
				<table  width="100%" border="1" cellpadding="0" cellspacing="0">
					<tr>
					</tr>
					<tr>
						<th height="35">项目名称</th>
						<td><input class="easyui-validatebox" required="true" type="text"
							id="project_name" name="project_name" style="border: 0;" /></td>

						<th height="35">项目编号</th>
						<td><input class="easyui-validatebox" required="true" type="text"
							id="project_id" name="project_id" style="border: 0;" /></td>

					</tr>
					<tr>
						<th height="38">主管科室</th>
						<td><input class="easyui-validatebox" required="true" type="text"
							id="department" name="department" style="border: 0;" readonly /></td>
						<th>主管工程师</th>
						<td><input class="easyui-validatebox" required="true" type="text"
							id="project_engineer" name="project_engineer" style="border: 0;" /></td>
					</tr>
					<tr>
						<th height="45">所属领域</th>
						<td> <select id="tech_area" name="tech_area" style="width:100%; height:100%;">
								<option >软件和信息技术服务业</option>
								<option >互联网和相关服务</option>
								<option >技术推广和应用服务业</option>
							</select>
						</td>
							
						<th height="42">承担单位</th>
						<td><input class="easyui-validatebox" required="true" type="text"
							id="org_name" name="org_name" style="border: 0;" readonly /></td>
					</tr>
					<tr>
						<th height="45">开始时间</th>
						<td><input class="easyui-validatebox" required="true" type="text"
							id="project_start" name="project_start" style="border: 0;" readonly /></td>
						<th height="42">结束时间</th>
						<td><input class="easyui-validatebox" required="true" type="text"
							id="project_end" name="project_end" style="border: 0;" readonly /></td>
					</tr>
					<tr>
						<th>项目类型</th>
						<td colspan="3"><input type="text" name="project_type" style="border: 0;" readonly/></td>
					</tr>
				</table>
				<div style="padding: 5px; backgroud:#fafafa;border:1px; solid #ccc">
					<a href="#" class="easyui-linkbutton" iconcls="icon-ok" onclick="changeOk()">确定</a>
					<a href="#" class="easyui-linkbutton" iconcls="icon-reload" onclick="reload()">重置</a>
				</div>
			</div>
			<p>&nbsp;</p>
			<div id="div2" data-options="region:'center',split:true" title="标题基本信息">
				<table width="100%" border="1" cellpadding="0" cellspacing="0">
					<tr>
						<th width="48" height="35"></th>
						<th width="238" align='center'>填写事项</th>
						<th width="185" align='center'>用户最近办理时间</th>
						<th width="218" align='center'>当前状态</th>
						<th width="218" align='center'>审核时间</th>
						<!--     <th width="169">交互信息</th> -->
						<th width="199" align='center'>管理</th>
						<!--     <th width="178">历史信息</th> -->
					</tr>
				 	 <?php
						
// 						$project_id = $_SESSION['project_id'];
						$project_id= 'dev1448717534';
						$sql_project = "Select * from project_info where project_id='$project_id'";
						$db = new DB();
						// 查找
						$result_project = $db->SelectOri($sql_project);
						$project = mysql_fetch_object($result_project);
						$project_stage = $project->project_stage;
						//2015.11.27改动
						$sql = "Select * from table_status where project_id='$project_id' and table_status > 1 order by project_stage asc,table_status asc";
// 						echo $sql;8
						$result = $db->SelectOri($sql);
						$row_n = mysql_num_rows($result);
						for ($i = 1; $i <= $row_n; $i ++) {
						    echo "<tr>";
						    $row = mysql_fetch_object($result);
						    echo "<td></td>";
						    echo "<td>" . $row->table_name . "</td>";
						    $last_modify = date('Y/m/d', $row->last_modify);
						    echo "<td>" . $last_modify . "</td>";
					    // 这个之后可以通过计算当前填完的表格来判断当前的状态
					    switch ($row->table_status) {
					        // case 0: echo "<td> 暂时不可填写 </td>";break;
					        case 1:
					            echo "<td> 待提交</td>";
					            break;
					        case 2:
					            echo "<td> 待审核 </td>";
					            break;
					        case 3:
					            echo "<td> 驳回，正在修改 </td>";
					            break;
					        case 4:
					            echo "<td> 审核通过 </td>";
					            break;
					        case 5:
					            echo "<td> 审核未通过</td>";
					            break;
					        }
					    if ($row->approval_time != null) {
					        $approve_time = date('Y/m/d', $row->approval_time);
					        echo "<td>$approve_time</td>";
					    } else {
					        echo "<td></td>";
					    }
    
			        
			        switch($row->table_name){
			           /*  case "项目实施方案":
			                echo "<td align='center'><a href='execute_solution.php'>查看</a></td>";break; */
			            case "项目任务书":
			                echo "<td align='center'><a href='assignment.php'>查看</a></td>";break;
			            case "专家名单及专家论证意见":
			                echo "<td align='center'><a href='expert_solution.php'>查看</a></td>";break;
			            case "北京市通州区科技计划项目调整申请表":
			                echo "<td align='center'><a href='modify_solution.php'>查看</a></td>";break;
			            case "项目中期报告":
			                echo "<td align='center'><a href='middle_solution.php'>查看</a></td>";break;
			            case "项目验收专家组意见":
			                echo "<td align='center'><a href='expertProAccept.php'>查看</a></td>";break;
			            case "项目总结报告书":
			                echo "<td align='center'><a href='accept_project_summary.php'>查看</a></td>";break;
			            case "项目经费总决算表":
			                echo "<td align='center'><a href='total_fund.php'>";break;
			             case "北京市通州区科技计划项目实施方案":
			                echo "<td align='center'><a href='attach_1.php'>";break; 
			            case "通州区支持产学研合作项目申请书":
			             	echo "<td align='center'><a href='develop/attach_2.php'>";break;
			            case "通州区支持科技成果转化项目申报书":
			                echo "<td align='center'><a href='develop/attach_3.php'>";break;
			            case "通州区支持承担市级以上科技项目申报书":
			                echo "<td align='center'><a href='develop/attach_4.php'>";break;
			            case "通州区支持创新平台建设项目申报书":
			                echo "<td align='center'><a href='develop/attach_5.php'>";break;
			            case "通州区技术合同登记奖励资金申报表":
			                echo "<td align='center'><a href='knowledge/attach_6.php'>";break;
			            case "通州区支持技术输出能力提升项目申报书":
			                echo "<td align='center'><a href='knowledge/attach_7.php'>";break;
			            case "通州区支持购买区内单位技术服务项目申报书":
			                echo "<td align='center'><a href='knowledge/attach_8.php'>";break;
			            case "通州区支持科技企业孵化器大学科技园发展项目申报书":
			                echo "<td align='center'><a href='science/attach_9.php'>";break;
			            case "通州区支持科技服务机构发展项目申报书":
			                echo "<td align='center'><a href='knowledge/attach_10.php'>";break;
			            //没有
			            case "通州区高新技术企业认定服务机构资助资金申请表":
			                echo "<td align='center'><a href='develop/attach_11.php'>";break;
				//             	echo "<td align='center'><a href='/website/html/view/template/apply/attach_2/attach2_main.php'>";break;
				        }
				        if($row->table_status == 2){
				        	echo "审核</a></td>";
				        }
				        else{
				        	echo "查看</a></td>";
				        }
	
	      		echo "</tr>";
			}
			?>
		</table>
	</div>
</div>
</form>

	<p>&nbsp;</p>
</body>
</html>
