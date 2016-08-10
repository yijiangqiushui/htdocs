<?php
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/table.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/button.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/date_common.css"/>
    <script type="text/javascript" src="../../../../../../common/html/js/datecommon.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.cookie.js" ></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<!--     <script src="../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script> -->
    <script type="text/javascript" src="../../../../../../common/html/js/tablecommon.js"></script>
    <script type="text/javascript" src="../../../js/projectapp/project_member.js"></script>
       <script type="text/javascript" src="../../../../../../common/html/js/validation.js"></script>
<style>
textarea {
	    padding: 10px;
}

</style>
</head>
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
							<td colspan="5" rowspan="4" ><input id="bear_org_name" name="org_name" readonly style='text-align:center;'/></td>
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
        $tableRow = array();
        if($result != false){
        	$tableRow = mysql_num_rows ( $result );
        }
        if ($tableRow) {
            for ($i = 0; $i < $tableRow; $i ++) {
                $row = mysql_fetch_object($result);
                echo "<tr>";
                echo "<td><input type='text' name='org_name[$i]' value='$row->org_name'/></td>";
                echo "<td><input type='text' name='org_mission[$i]' value='$row->org_duty'/></td>";
                echo "<td><input type='button' value='删除'  class='pointer but' onclick='delRow(this)'/></td>";
                echo "</tr>";
            }
        } 

        else {
            echo "<tr>";
            echo "<td width='110'><input type='text' name='org_name[0]'/></td>";
            echo "<td width='267'><input type='text' name='org_mission[0]'/></td>";
            echo "<td width='40' ><input type='button' value='删除'  class='pointer but' onclick='delRow(this)'/></td>";
            echo "</tr>";
        }
        ?>
								
							</table>

								<tr>
									<th colspan="9" height="25"><input type="button" class='pointer' value="添加"
										style="background-color: #7AB5ED; color: #ffffff; font-size: 12px"
										onclick="addLine()" /></th>
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
									<td><input name="leader_name" datatype=""/></td>
<!-- 				这里缺少性别栏目-->
									<th>出生年月</th>
<!-- 								<td><input name="leader_birth" id="leader_birth" class='dateplu'  readonly/></td> -->
									<td>
										<select  class='year'  name='leader_year'>
										</select>
										<select class='month'  name='leader_month'>
										</select>
									</td>
									<th>身份证号</th>
									<td><input name="leader_ID" datatype="idcard" placeholder="请输入正确位数的身份证号" /></td>
									<th>技术职称</th>
									<td><input name="tech_pos" id="tech_pos" datatype=""/></td>
								</tr>
								<tr>
									<th >学历</th>
									<td><select name="leader_edu" />
										<option value='小学' selected>小学</option>
										<option value='初中'>初中</option>
            							<option value='高中'>高中</option>
            							<option value='中专'>中专</option>
            							<option value='大专'>大专</option>
            							<option value='本科'>本科</option>
									    <option value='研究生'>研究生</option>
									    <option value='其他'>其他</option>
									</td>
									<th>从事专业</th>
									<td><input name="leader_major" /></td>
									<th>性别</th>
									<td><select name="leader_sex" class="leader_sex" >
											<option value='男' selected>男</option> 
											<option value='女'>女</option>
									   </select>
									</td>
									<th>职务</th>
									<td><input name="leader_job"/></td>
								</tr>
								<tr>
									<th>电话</th>
									<td><input name="leader_tele" datatype="phone" placeholder="输入联系电话"/></td>
									<th>通讯地址</th>
									<td colspan="3"><input name="leader_address" /></td>
									<th>邮政编码</th>
									<td><input name="leader_postal" datatype="postcode" placeholder="邮编格式：101100(6位数字)" /></td>
								</tr>
								<tr>
									<th>传真</th>
									<td><input name="leader_fax" datatype="fax" placeholder="传真格式：XXXX-12345678"/></td>
									<th>电子信箱</th>
									<td colspan="3"><input name="leader_email"datatype="email" placeholder="邮箱格式：XXXX@xx.com" /></td>
									<th>手机</th>
									<td><input name="leader_phone" datatype="telephone" placeholder="请输入手机号"/></td>
								</tr>
								<tr>
									<th>主要业绩</th>
									<td colspan="9"><textarea name="leader_achieve" style="height: 100px; width: 98%; background-color: transparent;"></textarea></td>
								</tr>
								<tr>
									<th colspan="11"><h3>4、项目研究人员</h3></th>
								</tr>
					
					</table>
					<table cellspacing="0" cellpadding="0" border="0" id="tbl">
						<tr id="trHeader">
							<th style="width:130px;">姓名</th>
							<th style='width:50px;'>性别</th>
							<th style='width:150px;'>出生年月</th>
							<th>身份证号</th>
							<th>技术职称</th>
							<th>职务</th>
							<th>学历</th>
							<th>从事专业</th>
							<th>主要分工</th>
							<th>工作单位</th>
							<th style="width:40px;">操作</th>
						</tr>
					<?php
    
    $project_id = $_SESSION['project_id'];
    $sql = "Select * from researchers where project_id = '$project_id'";
    $db = new DB();
    $result2 = $db->SelectOri($sql);
    $tableRow = array();
    if($result2 != false){
    	$tableRow = mysql_num_rows ( $result2 );
    }
    if ($tableRow) {
        for ($i = 0; $i < $tableRow; $i ++) {
            $row = mysql_fetch_object($result2);
            $temp = explode('-',$row->researcher_birth);
            echo "<td><input name='researcher_name[$i]' value='$row->researcher_name' datatype=''/></td>";
            echo "<td ><select name='researcher_sex[$i]'  value='$row->researcher_sex'/>
                                            <option value='男'";if($row->researcher_sex == '男') { echo 'selected';} echo ">男</option>
											<option value='女'";if($row->researcher_sex == '女') { echo 'selected';} echo ">女</option>
									       </select> </td>";/*onmousedown='researcher_birth(".'"researcher_birth_'.$i.'"'.")'  */
//             echo "<td><input name='researcher_birth[$i]'  class='dateplu'  value='$row->researcher_birth' readonly /></td>";
			echo "<td>
					<select  class='year'  name='year[$i]' >
					    <script type='text/javascript'>
					    	$(function(){
 					    		$(\"select[name='year[$i]']\").val($temp[0]);
					    	});
					    </script>
					</select>
					<select class='month'  name='month[$i]'>
						<script type='text/javascript'>
					    	$(function(){
 					    		$(\"select[name='month[$i]']\").val($temp[1]);
					    	});
					    </script>
					</select>
				 </td>";
            echo "<td><input name='researcher_ID[$i]' value='$row->researcher_ID' datatype='idcard' placeholder='请输入18位身份证号' /></td>";
            echo "<td><input name='researcher_pos[$i]' value='$row->researcher_pos'/></td>";
            echo "<td><input name='researcher_job[$i]' value='$row->researcher_job'/></td>";
            echo "<td width='60px'> <select  name='researcher_edu[$i]' value='$row->researcher_edu' style='float:left'>
            						<option value='小学'";if($row->researcher_edu == '小学') { echo 'selected';} echo ">小学</option>
            						<option value='初中'";if($row->researcher_edu == '初中') { echo 'selected';} echo ">初中</option>
            						<option value='高中'";if($row->researcher_edu == '高中') { echo 'selected';} echo ">高中</option>
            						<option value='中专'";if($row->researcher_edu == '中专') { echo 'selected';} echo ">中专</option>
            						<option value='大专'";if($row->researcher_edu == '大专') { echo 'selected';} echo ">大专</option>
									<option value='本科'";if($row->researcher_edu == '本科') { echo 'selected';} echo ">本科</option>
									<option value='研究生'";if($row->researcher_edu == '研究生') { echo 'selected';} echo ">研究生</option>
									<option value='其他'";if($row->researcher_edu == '其他') { echo 'selected';} echo ">其他</option>
									</select></td>";
            echo "<td><input name='researcher_major[$i]' value='$row->researcher_major'/></td>";
            echo "<td><input name='researcher_work[$i]' value='$row->researcher_work'/></td>";
            echo "<td><input name='researcher_org[$i]' value='$row->researcher_org'/></td>";
            echo "<td><input type='button' value='删除'  class='pointer but' onclick='delRow(this)'/></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
            echo "<td><input name='researcher_name[0]' value='$result2->researcher_name' datatype=''/></td>";
            echo "<td ><select name='researcher_sex[0]'  value='$result2->researcher_sex'>
                                            <option value='男'>男</option>
											<option value='女'>女</option>
									       </select> </td>";
//             echo "<td><input name='researcher_birth[0]'    class='dateplu' valu='$result2->researcher_birth' readonly/></td>";
            echo "<td>
					<select  class='year'  name='year[0]'>
					</select>
					<select class='month'  name='month[0]'>
					</select>
				 </td>";
            echo "<td><input name='researcher_ID[0]' value='$result2->researcher_ID' datatype='idcard' placeholder='请输入18位身份证号'/></td>";
            echo "<td><input name='researcher_pos[0]' value='$result2->researcher_pos'/></td>";
            echo "<td><input name='researcher_job[0]' value='$result2->researcher_job'/></td>";
            echo "<td width='60px'><select  name='researcher_edu[0]' value='$result2->researcher_edu'style='float:left'>
								    <option value='小学'>小学</option>
								    <option value='初中'>初中</option>
            						<option value='高中'>高中</option>
            						<option value='中专'>中专</option>
            						<option value='大专'>大专</option>
								    <option value='本科'>本科</option>
									<option value='研究生'>研究生</option>
									<option value='其他'>其他</option>
									</select></td>";
            echo "<td><input name='researcher_major[0]' value='$result2->researcher_major'/></td>";
            echo "<td><input name='researcher_work[0]' value='$result2->researcher_work'/></td>";
            echo "<td><input name='researcher_org[0]' value='$result2->researcher_org'/></td>";
        echo "<td><input type='button'   value='删除'  class='pointer but' onclick='delRow(this)' /></td>";
        echo "</tr>";
    }
    ?>
					
					</table>
					<div>
						<input type="button"   class='pointer'  name="Submit"
							style="width:100%;height: 30px; background: #7AB5ED; color: #ffffff; font-size: 12px;float: none"
							value="添加研究人员" onclick="AddSignRow();" />
					</div>

			<!-- 	<input name="txtTRLastIndex" type="hidden" id='txtTRLastIndex'
						value='<?php echo $count_num; ?>' /> -->	
				</div>
				<div  class="button_wrapper clearfix">
<!-- 					<div class="submit">提交</div> -->
					<div class="save" style="left: auto">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
<!-- 				<div id='select_birth' style='border:5px solid red;  width:100px; height:100px; position:absolute;left:10px;top:10px;'>
					
				</div> -->
			</div>
		</div>
		</div>
		
	</form>
</body>
</html>
