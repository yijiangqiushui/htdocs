<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"></link>
      <link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/table.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/button.css"/>
    <link rel="stylesheet" href="../../../../../common/html/lib/css/datapicker/daterangepicker.css" />
    
    <script src="../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
    <script src="../../../../../common/html/plugin/datapicker/moment.min.js"></script>
    
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.cookie.js" ></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
    
    <script src="../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
    <script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
    <script type="text/javascript" src="../../../../../common/html/js/validation.js"></script>
    <script type="text/javascript" src="../../js/projectapp/project_member.js"></script>

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
</style></head>
<body>

	<form id="project_member" method="post">

		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">项目实施方案填写</div>
				<div class="right back_pic" id="back"></div>
			</div>
			<div class="table_content back-long">
				<div class="basic_info">
					<table cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td colspan="11">
								<p class="title_top p-b10">项目承担单位、参加单位、项目负责人、项目研究人员</p>
							</td>
						</tr>
						<tr>
							<th height="56" colspan="5"><h3>1、项目承担单位名称</h3></th>
							<th colspan="5"><h3>2、项目参加单位</h3></th>
						</tr>

						<tr>
							<td colspan="5" rowspan="4"><input id="bear_org_name" name="org_name" /></td>
							<td colspan="5">
								<table id="addtable">
									<tr>
										<th>单位名称</th>
										<th>主要任务分工</th>
										<th>操作</th>
									</tr>
								<?php
        $project_id = $_SESSION['project_id'];
        $sql = "Select * from project_org  where project_id = '$project_id' ";
        $db = new DB();
        
        $result = $db->SelectOri($sql);
        $tableRow = mysql_num_rows($result);
        if ($tableRow) {
            for ($i = 0; $i < $tableRow; $i ++) {
                $row = mysql_fetch_object($result);
                echo "<tr>";
                echo "<td><input type='text' name='org_name[$i]' value='$row->org_name'/></td>";
                echo "<td><input type='text' name='org_mission[$i]' value='$row->org_duty'/></td>";
                echo "<td><input type='button' value='删除' onclick='delRow(this)'/></td>";
                echo "</tr>";
            }
        } 

        else {
            echo "<tr>";
            echo "<td ><input type='text' name='org_name[0]'/></td>";
            echo "<td ><input type='text'name='org_mission[0]'/></td>";
            echo "<td ><input type='button' value='删除' onclick='delRow(this)'/></td>";
            echo "</tr>";
        }
        ?>
								
							</table>

								<tr>
									<td colspan="9" height="25"><input type="button" value="添加"
										style="background-color: #7AB5ED; color: #ffffff; font-size: 12px"
										onclick="addLine()" /></td>
								</tr>
								<tr></tr>
								<tr></tr>
								<tr></tr>
								<tr></tr>
								<tr></tr>
								<tr>
									<th colspan="10"><h3>3、项目负责人(项目负责人应从项目承担单位产生)</h3></th>
								</tr>
								<tr>
									<th>姓名</th>
									<td><input name="leader_name" datatype="chinese_characters"/></td>

									<th>出生年月</th>
<!-- 									placeholder='如:198008' -->
									<td><input name="leader_birth" id="leader_birth"/></td>
									<th>身份证号</th>
									<td><input name="leader_ID" datatype="idcard"/></td>
									<th>技术职称</th>
									<td><input name="tech_pos" id="tech_pos" datatype="chinese_characters"/></td>
								</tr>
								<tr>
									<th>学历</th>
									<td><select name="leader_edu" />
										<option value='0'>初中</option>
            							<option value='1'>高中</option>
            							<option value='2'>大专</option>
            							<option value='3'>本科</option>
									    <option value='4'>硕士</option>
									    <option value='5'>博士</option>
									    <option value='6'>其他</option>
										<!-- <option value='collage'>本科</option>
										<option value='master'>硕士</option>
										<option value='doctor'>博士</option>
										<option value='other'>其他</option> -->
									</td>
									<th>从事专业</th>
									<td><input name="leader_major" /></td>
									<th>性别</th>
									<td><select name="leader_sex" class="leader_sex" >
											<option value='0' selected>男</option> 
											<option value='1'>女</option>
									</select></td>
									<th>职务</th>
									<td><input name="leader_job"/></td>
								</tr>
								<tr>
									<th>电话</th>
									<td><input name="leader_phone" datatype="phone" /></td>
									<th>通讯地址</th>
									<td colspan="3"><input name="leader_address" /></td>
									<th>邮政编码</th>
									<td><input name="leader_postal" datatype="postcode" /></td>
								</tr>
								<tr>
									<th>传真</th>
									<td><input name="leader_fax" datatype="fax"/></td>
									<th>电子信箱</th>
									<td colspan="3"><input name="leader_email"datatype="email" /></td>
									<th>手机</th>
									<td><input name="leader_tele" datatype="telephone"/></td>
								</tr>
								<tr>
									<th>主要业绩</th>
									<td colspan="9"><textarea name="leader_achieve"
											style="height: 100px; width: 99.5%; background-color: transparent;"></textarea></td>
								</tr>
								<tr>
									<td colspan="11"><h3>4、项目研究人员</h3></td>
								</tr>
					
					</table>
					<table cellspacing="0" cellpadding="0" border="0" id="tbl">
						<tr id="trHeader">
							<th>姓名</th>
							<th>性别</th>
							<th>出生年月</th>
							<th>身份证号</th>
							<th>技术职称</th>
							<th>职务</th>
							<th>学历</th>
							<th>从事专业</th>
							<th>主要分工</th>
							<th>工作单位</th>
							<th>操作</th>
						</tr>
					<?php
    
    $project_id = $_SESSION['project_id'];
    $sql = "Select * from researchers where project_id = '$project_id'";
    
    $db = new DB();
    $result2 = $db->SelectOri($sql);
    $tableRow = mysql_num_rows($result2);
    if ($tableRow) {
        for ($i = 0; $i < $tableRow; $i ++) {
            $row = mysql_fetch_object($result2);
            echo "<tr>";
            echo "<td><input name='researcher_name[$i]' value='$row->researcher_name' datatype='chinese_characters'/></td>";
            echo "<td><select name='researcher_sex[$i]' value='$row->researcher_sex'/>
                                            <option value='0'";if($row->researcher_sex == 0) { echo 'selected';} echo ">男</option>
											<option value='1'";if($row->researcher_sex == 1) { echo 'selected';} echo ">女</option>
									       </select> </td>";/*onmousedown='researcher_birth(".'"researcher_birth_'.$i.'"'.")'  */
            echo "<td><input name='researcher_birth[$i]'  class='date_pick'  onclick='researcher_birth(this)'  value='$row->researcher_birth' datatype='birth' placeholder='如:198008' /></td>";
            echo "<td><input name='researcher_ID[$i]' value='$row->researcher_ID' datatype='idcard'/></td>";
            echo "<td><input name='researcher_pos[$i]' value='$row->researcher_pos'/></td>";
            echo "<td><input name='researcher_job[$i]' value='$row->researcher_job'/></td>";
            echo "<td><select name='researcher_edu[$i]' value='$row->researcher_edu'style='float:left'/>
            						<option value='0'";if($row->researcher_edu == 0) { echo 'selected';} echo  ">初中</option>
            						<option value='1'";if($row->researcher_edu == 1) { echo 'selected';} echo  ">高中</option>
            						<option value='2'";if($row->researcher_edu == 2) { echo 'selected';} echo  ">大专</option>
									<option value='3'";if($row->researcher_edu == 3) { echo 'selected';} echo  ">本科</option>
									<option value='4'";if($row->researcher_edu == 4) { echo 'selected';} echo  ">硕士</option>
									<option value='5'";if($row->researcher_edu == 5) { echo 'selected';} echo  ">博士</option>
									<option value='6'";if($row->researcher_edu == 6) { echo 'selected';} echo  ">其他</option>
									</select></td>";
            echo "<td><input name='researcher_major[$i]' value='$row->researcher_major'/></td>";
            echo "<td><input name='researcher_work[$i]' value='$row->researcher_work'/></td>";
            echo "<td><input name='researcher_org[$i]' value='$row->researcher_org'/></td>";
            echo "<td><input type='button' value=\"删除\" onclick='delRow(this)'/></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
            echo "<td><input name='researcher_name[0]' value='$result2->researcher_name' datatype='chinese_characters'/></td>";
            echo "<td><select name='researcher_sex[0]' value='$result2->researcher_sex'/>
                                            <option value='0'>男</option>
											<option value='1'>女</option>
									       </select> </td>";
            echo "<td><input name='researcher_birth[0]'    class='date_pick'/></td>";
            echo "<td><input name='researcher_ID[0]' value='$result2->researcher_ID' datatype='idcard'/></td>";
            echo "<td><input name='researcher_pos[0]' value='$result2->researcher_pos'/></td>";
            echo "<td><input name='researcher_job[0]' value='$result2->researcher_job'/></td>";
            echo "<td><select name='researcher_edu[0]' value='$result2->researcher_edu'style='float:left'/>
								    <option value='0'>初中</option>
            						<option value='0'>高中</option>
            						<option value='0'>大专</option>
								    <option value='0'>本科</option>
									<option value='1'>硕士</option>
									<option value='2'>博士</option>
									<option value='3'>其他</option>
									</select></td>";
            echo "<td><input name='researcher_major[0]' value='$result2->researcher_major'/></td>";
            echo "<td><input name='researcher_work[0]' value='$result2->researcher_work'/></td>";
            echo "<td><input name='researcher_org[0]' value='$result2->researcher_org'/></td>";
        echo "<td><input type='button'   value='删除' onclick='delRow(this);' /></td>";
        echo "</tr>";
    }
    ?>
					
					</table>
					<div>
						<input type="button" name="Submit"
							style="height: 30px; background: #7AB5ED; color: #ffffff; font-size: 12px"
							value="添加研究人员" onclick="AddSignRow();" />
					</div>

			<!--  	<input name="txtTRLastIndex" type="hidden" id='txtTRLastIndex'
						value='<?php echo $count_num; ?>' />-->	
				</div>
				<div class="button_wrapper clearfix">
<!-- 					<div class="submit">提交</div> -->
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>
		</div>
		</div>
	</form>
</body>
</html>
