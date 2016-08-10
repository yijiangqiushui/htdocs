<?php 
	require_once '../../../../../../common/php/config.ini.php';
	require_once '../../../../../../common/php/lib/db.cls.php';
	session_start();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/icon.css" />

<script type="text/javascript" src="../../../../../../common/html/js/datecommon.js"></script>

<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/js/validation.js"></script>
<script src="../../../../../../common/html/js/tablecommon.js"></script>
<script src="../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript" src="../../../js/apply/influence.js"></script>
<link rel="stylesheet" type="text/css" href="../../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../../css/button.css" />
<style type="">
	input{
		text-align:center;	
	}
</style>
</head>

<body>
	<form id="influence" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">项目申请书填写</div>
				<div class="right back_pic" id="back"></div>
			</div>
			<div class="table_content back-long">
				<div class="basic_info bg_blue">
                     <table id="tbl">
                        <tr>
                            <td colspan="6" class="border_left_none" style="background-color:#7AB5ED;">
                                <div class="title_top p-b10">申报单位近两年发生的对单位发展有影响的事件</div>
                                 <p class="subtitle">如与其他单位建立合作关系、国外或外地业务扩展、提升专业服务能力、规范公司管理的事件等</p>
					        </td>
				        </tr>
                     	<tr>
                     		<th>名称</th>
                     		<th>时间</th>
                     		<th>地点</th>
                     		<th>活动主题</th>
                     		<th>活动效果</th>
                     		<th>操作</th>
                     	</tr>
                     	<?php 
                     	    $org_code = $_SESSION['org_code'];
                     		$db = new DB();
                     		$sql = "SELECT * FROM influ_event where org_code = '$org_code'";
                     		$res = $db -> SelectOri($sql);
                     		$table_Row = array();
                     		if($res != false){
                     			$table_Row = mysql_num_rows ( $res );
                     		}
                     		if($table_Row){

                     			 for($i=0 ; $i<$table_Row ; $i++){
                                     $row = mysql_fetch_object($res);
                     			 	echo "<tr>";
                     			 	echo "<td '><input type='text' name='name[$i]' value='$row->name'/></td>";
                     			 	echo "<td><input type='text' name='time[$i]' value='$row->time' class='dateplu' readonly/></td>";
                     			 	echo "<td><input type='text' name='place[$i]' value='$row->place'/></td>";
                     			 	echo "<td><input type='text' name='theme[$i]' value='$row->theme'/></td>";
                     			 	echo "<td><input type='text' name='effect[$i]' value='$row->effect'/></td>";
                     			 	echo "<td><input type='button' value='删除' class='pointer but'  onclick='delRow(this)'/></td>";
                     			 	echo "</tr>";
                     			 }
                     		}
                     		else{
//                      			echo "<tr>";
//                      			echo "<td><input type='text' name='effect[0]' value='$res->effect'/></td>";
//                      			echo "<td><input type='button' value='删除' onclick='delRow(this)'/></td>";
//                      			echo "</tr>";
                     			echo "<tr>";
                     			echo "<td><input type='text' name='name[0]' value='$res->name'/></td>";
                     			echo "<td><input type='text' name='time[0]' value='$res->time' class='dateplu' readonly/></td>";
                     			echo "<td><input type='text' name='place[0]' value='$res->place'/></td>";
                     			echo "<td><input type='text' name='theme[0]' value='$res->theme'/></td>";
                     			echo "<td><input type='text' name='effect[0]' value='$res->effect'/></td>";
                     			echo "<td><input type='button' value='删除' class='pointer but' onclick='delRow(this)'/></td>";
                     			echo "</tr>";
                     		}
                     	?>
                    </table>
                    <div>

				      <input type="button" name="Submit"style="height: 30px; background: #7AB5ED; color: #ffffff; font-size: 12px;width: 100%;bottom: 20px;"  class='pointer' value="添加事件" onclick="AddSignRow();" />
			        </div>
				<!-- 	<p class="title_top p-b10">申报单位近两年发生的对单位发展有影响的事件</p>
					<p class="subtitle">如与其他单位建立合作关系、国外或外地业务拓展、提升专业服务能力、规范公司管理的事件等</p>
					<div class="text_wrap">
						<textarea name="influence" id="influence" class="text_content"
							title=""
							placeholder="名称:
						
						时间:
						
						地点:
						
						活动主题:
						
						活动效果:"></textarea>
					</div> -->

					<div class="button_wrapper clearfix">
						<div class="save" style="margin: 20px  auto;">保存</div>
					</div>
				</div>

			</div>
		</div>
	</form>
</body>
</html>
