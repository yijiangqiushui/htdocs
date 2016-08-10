<?php
session_start ();
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<style>
th {
	width:80px;
}
select{
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
	font-size: 14px;
	margin: auto 0;
	text-align: center;
	width:100%;
	float:left;
	height:99%;
	margin: 0 auto;
	padding: 0 auto ;
	background-color: #D1E4F3;
	
}
tr:nth-child(even) select {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
	font-size: 14px;
	margin: auto 0;
	text-align: center;
	width:100%;
	float:left;
	height:99%;
	margin: 0 auto;
	padding: 0 auto ;
	background-color: #EAF3FA;
}
option {
	font-style:inherit;
	font-size:16px;
	margin: 0 auto;
	padding: 0 auto ;
	background-color: #EAF3FA;
}
</style>
    <link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/table.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/button.css"/>
    
    <script type="text/javascript" src="../../../../../common/html/js/datecommon.js"></script>
    
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.cookie.js" ></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="../../../../../common/html/js/validation.js"></script>
	<script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
	<script type="text/javascript" src="../../js/projectapp/expert_sign.js"></script>
</head>
<body>
	<div class="project_content">
        <div class="table_title clearfix">
            <div class="title_pic left">论证专家信息填写</div>
            <div class="right back_pic" id="back"></div>
        </div>
        
        <div class="table_content back-long"><form method="post" action="" id="expert_sign">
            <table cellspacing="0" cellpadding="0" class="basic_info">
				<tr>
					<td colspan="9"><h2>
							 <div class="title_top p-b10">论证专家信息</div>
						</h2></td>
				</tr>
				<tr>
					 <th class="bt" width="96"><p align="center">项目名称</p></th>
					<td colspan="3" valign="top"><input  name="project_name"   /></td>
					 <th class="bt" width="120"><p align="center">项目编号</p></th>
					<td colspan="3" valign="top"><input name="business_id" readonly  class="input" /></td>
				</tr>
				<tr>
					 <th class="bt" width="96"><p align="center">承担单位</p></th>
					<td colspan="3" valign="top"><input   name="org_name" class="input" readonly  /></td>
					 <th class="bt" width="96"><p align="center">项目负责人</p></th>
					<td colspan="3" valign="top"><input  name="project_leader" class="input" readonly /></td>
				</tr>
				<tr>
					 <th class="bt" width="96"><p align="center">所属资金专项名称</p></th>
					<td colspan="3" valign="top"><input  name="project_money" class="input"  /></td>
				 <th class="bt" width="96"><p align="center">论证时间</p></th>
					<td colspan="3" valign="top"><input  name="zj_project_lzsj" id="register_time" class='dateplu' readonly/></td>
				</tr>
				<tr>
					<td colspan="7">
						<table id="addtable">
							<tr>
								<th><p align="center">专家姓名</p></th>
								<th width="54"><p  align="center">分工</p></th>
								<th width="173"><p align="center">所在单位</p></th>
								<th width="134"><p align="center">身份证号</p></th>
								<th><p align="center">职务/职称</p>
									</th>
									<th width="113"><p align="center">从事专业</p></th>
									<th width="129"><p align="center">联系电话（手机）</p></th>
									<th width="108"><p align="center">操作</p></th>
							
							</tr>
					    		
		<?php
$project_id = $_SESSION['project_id'];
$sql = "Select * from experts where zj_project_id= '$project_id'";
// echo $sql;
$db = new DB();
$result = $db->SelectOri($sql);
$tableRow = array();
if($result != false){
	$tableRow = mysql_num_rows ( $result );
}
if ($tableRow) {
    for ($i = 0; $i < $tableRow; $i ++) {
        $row = mysql_fetch_object($result);
        echo "<tr>";
        echo "<td width='110'><input type='text'    name='expert_name[$i]'  value='$row->expert_name'    /></td>";
        echo "<td width='267'><select type='text' name='expert_divide[$i]' value='$row->expert_divide' >
        <option value='1'>组员</option>  <option value='0'";
			if($row->expert_divide==0){
				echo "selected>组长</option>
        </select></td>";
			}else {
				echo ">组长</option>
        </select></td>";
			}
				
				
				
        echo "<td width='267'><input type='text'  name='expert_org[$i]'  value='$row->expert_org'  /></td>";
        echo "<td width='267'><input type='text' name='expert_id[$i]' value='$row->expert_id' datatype='idcard'/></td>";
        echo "<td width='267'><input type='text' name='expert_job[$i]'  value='$row->expert_job'   /></td>";
        echo "<td width='267'><input type='text' name='expert_major[$i]' value='$row->expert_major' /></td>";
        echo "<td width='267'><input type='text' name='expert_phone[$i]' value='$row->expert_phone'   datatype='telephone'/></td>";
        echo "<td width='40' ><input type='button' value='删除' class='pointer'  onclick='delRow(this)'/></td>";
        echo "</tr>";
    }
} else {
    echo "<tr>";
    echo "<td width='110'><input type='text' name='expert_name[0]' /></td>";
   echo "<td width='267'><select type='text' name='expert_divide[0]' value='0' >
        <option value='1'>组员</option>  <option value='0'>组长</option>
        </select></td>";
    echo "<td width='267'><input type='text'name='expert_org[0]' /></td>";
    echo "<td width='267'><input type='text'name='expert_id[0]' datatype='idcard'/></td>";
    echo "<td width='267'><input type='text'name='expert_job[0]' /></td>";
    echo "<td width='267'><input type='text'name='expert_major[0]'/></td>";
    echo "<td width='267'><input type='text'name='expert_phone[0]' datatype='telephone'/></td>";
    echo "<td width='40' ><input type='button' value='删除' class='pointer'  onclick='delRow(this)'/></td>";
    echo "</tr>";
}
?></table>
</td>
</tr>
	<tr><th colspan="9">
			<div style="width:100%;height:30px; background-color:#7AB5ED;line-height:30px;cursor: pointer;" class='pointer'  onclick="AddSignRow();">添加专家</div> </th></tr>
</table>

  <div class="button_wrapper clearfix">
              <!--   <div class="submit" >提交</div> -->
                <div class="save" >保存</div>
                <!-- <div class="reset" >重置</div> -->
            </div>
</div>
				


</form>
	
</body>
</html>
