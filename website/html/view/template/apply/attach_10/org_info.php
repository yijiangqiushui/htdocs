<?php
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
 <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/table.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/button.css"/>
    
    <script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
    <script src="../../../../../../common/html/plugin/datapicker/moment.min.js"></script>
    <script src="../../../../../../common/html/js/datecommon.js"></script>
    
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.cookie.js" ></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
    
    <script src="../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
    <script src="../../../../../../common/html/js/tablecommon.js"></script>
    <script src="../../../../../../common/html/js/validation.js"></script>
    <script type="text/javascript" src="../../../js/apply/10org_info.js"></script>

<style type="text/css">
td {
	height: 35px;
	text-align: left;
	cellpadding: 0px;
}

body {
	font-family: "微软雅黑";
	margin: auto 0;
	font-size: 16px;
	margin: auto 0;
}

div {
	text-align: center;
	margin: auto 0;
	line-height: 100%;
}

table {
	margin: 0 auto;
	font-size: 14px;
	width: 100%;
}

table td {
    text-align: left;
    border: solid 2px #ffffff;
}

table table {
	width: 100%;
}

input[type='text'] {
	height: 100%;
	width: 99.5%;
	border: 1px;
}

input[type='button'] {
	height: 100%;
	width: 99.5%;
	border: 1px;
}

.radio_input {
	width:15px;
	height:10px;	
	margin-top:8px;
}

.other_input {
	width:150px !important;
	height:25px !important;	
	line-height:25px;
	border:none;
	border-bottom:1px solid #7AB5ED !important;
	padding-left:5px;
}

lable {
	line-height:20px;
}
</style>
</head>

<body>
 <form method="post" id="10org_info_fm">
	<div class="project_content">
	  <div class="table_title clearfix">
	      <div class="title_pic left">基本信息</div>
	      <div class="right back_pic" id="back"></div>
      </div>
      <div class="table_content back-long">
		<table cellspacing="0" cellpadding="0" class="basic_info">
				<tr>
					<td colspan="4" class="border_left_none" style="background-color:#7AB5ED;">
							<div class="title_top p-b10">项目申请书</div>
				   </td>
				</tr>
				<tr>
					<th width="180px"><p align="center">单位名称</p></th>
					<td colspan="3"><input type="text" name="org_name" title="只读信息，若有误请联系管理员修改" readonly/></td>
				</tr>
				<tr>
					<th >单位类型</th>
					<td colspan="3" style="padding:10px 0;">
					   <lable><input class="radio_input org_radio" name="org_type" type="radio" value="事业单位" />事业单位</lable><br/>
					   <lable><input class="radio_input org_radio" name="org_type" type="radio" value="国有资本控股的有限公司" />国有资本控股的有限公司</lable><br/>
					   <lable><input class="radio_input org_radio" name="org_type" type="radio" value="国有独资企业" />国有独资企业</lable><br/>
					   <lable><input class="radio_input org_radio" name="org_type" type="radio" value="民营资本为主的有限公司" />民营资本为主的有限公司</lable><br/>
					   <lable><input class="radio_input org_radio" id="other_in11" name="org_type" type="radio" value="其他" />其他(请注明)
					   <input class="other_input" id="other_in1" name="org_type" type="text" disabled/></lable>			   
					  <!--  <p>1.事业单位 2.国有资本控股的有限公司</p>
					   <p>3.国有独资企业 4.民营资本为主的有限公司</p>  
					   <input  required="true" style="width: 99%; height: 100%" type="text" name="org_type" />-->
					</td>
				</tr>
				<tr>
					<th >机构投资建设主体</th>
					<!--没有字段-->
					<td colspan="3" style="padding:10px 0;">
					   <lable><input class="radio_input invest_radio "   name="investment" type="radio" value="国有企业" />国有企业</lable><br/>
					   <lable><input class="radio_input invest_radio" name="investment" type="radio" value="民营企业" />民营企业</lable><br/>
					   <lable><input class="radio_input invest_radio" name="investment" type="radio" value="大学" />大学</lable><br/>
					   <lable><input class="radio_input invest_radio" name="investment" type="radio" value="研究院所" />研究院所</lable><br/>
					   <lable><input class="radio_input invest_radio" name="investment" type="radio" value="政府" />政府</lable><br/>
					   <lable><input class="radio_input invest_radio" name="investment" type="radio" value="投资机构" />投资机构</lable><br/>
					   <lable><input class="radio_input invest_radio" name="investment" type="radio" value="自然人" />自然人</lable><br/>
					   <lable><input class="radio_input invest_radio" id="other_in22" name="investment" type="radio" value="其他" />其他(请注明)
					   <input class="other_input" id="other_in2" name="investment" type="text" disabled/></lable>
					</td>
				</tr>
				<tr>
				<th >机构服务类型</th>
					<!--没有字段-->
					<td colspan="3">
					   <lable><input class="radio_input service_radio" name="service_type" type="radio" value="综合型" />综合型</lable><br/>
					   <lable><input class="radio_input service_radio" id="other_in33" name="service_type" type="radio" value="专业型" />专业型：技术领域(请注明)
					   <input class="other_input" id="other_in3" name="service_type" type="text" disabled/></lable>
					</td>
				</tr>
				<tr>
					<th rowspan="3">投资主体</th>

				</tr>
				<tr>
					<td colspan="5">
					<table cellspacing="0" cellpadding="0" border="0px"   id="addtable">
							<tr>
								<th><p align="center">股东名称</p></th>
								<th><p align="center">股权比例(%)</p></th>
								<th><p align="center">操作</p></th>
							</tr>
		    		
		<?php
		$org_code = $_SESSION['org_code'];
		$sql = "Select * from shareholder_info where org_code='$org_code'";
		$db = new DB ();
		$result = $db->SelectOri ( $sql );
		$tableRow = mysql_num_rows ( $result );
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td><input type='text' name='shareholder_name[$i]' value='$row->shareholder_name'/></td>";
				echo "<td><input type='text' name='stock_ratio[$i]'  datatype='float3'   value='$row->stock_ratio'/></td>";
				echo "<td><input type='button' value='删除' class='pointer but'  onclick='delLine(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td width='110'><input type='text' name='shareholder_name[0]'/></td>";
			echo "<td width='267'><input type='text' datatype='float3' name='stock_ratio[0]'/></td>";
			echo "<td width='40' ><input type='button' value='删除' class='pointer but'   onclick='delLine(this)'/></td>";
			echo "</tr>";
		}
		?>
		    	</table>
						<tr>
							<th colspan="9" height="25"><input type="button" class='pointer' value="添加"
								onclick="addLine()" /></th>
							<!-- 没有字段-->
						</tr>
					</td>
					<!-- 没有字段-->
				</tr>

				<tr>
					<th><p align="center">通讯地址/邮编</p></th>
					<td colspan="3"><input    name="org_address" /></td>
				</tr>
				<tr>
					<th>法人代表</th>
					<td width="168"><input  name="org_leader" readonly/></td>
					<th><p align="center">总经理</p></th>
					<td><input  name="manager" /></td>
				</tr>
				<tr>
					<th><p align="center">联系人</p></th>
					<td><input  name="linkman" /></td>
					<th><p align="center">电话</p></th>
					<td><input  name="linkman_contact"  datatype="phone"/></td>
				</tr>
				<tr>
					<th><p align="center">传真</p></th>
					<td><input type="text" name="fax" datatype="fax"/></td>
					<th><p align="center">手机</p></th>
					<td><input  name="phone" datatype="telephone"/></td>
				</tr>
				<tr>
					<th><p align="center">网址</p></th>
					<td><input   name="website" datatype="website" /></td>
					<!--没有字段-->
					<th><p align="center">电子邮件</p></td>
					<td><input name="email" datatype="email" readonly/></td>
				</tr>
				<tr>
					<th><p align="center">注册地址</p></th>
					<td><input  name="register_address"readonly /></td>
					<!--没有字段-->
				   <th><p align="center">注册时间</p></th>
                    <td><input id="register_time" name="register_time" class='dateplu'/></td>
				</tr>
				<tr>
					<th><p align="center">注册资金（万）</p></th>
					<td><input  name="register_fund" datatype="float" /></td>
					<!--没有字段-->
					<th><p align="center">资产总额（万）</p></th>
					<td><input  name="asset_total" datatype="float" /></td>
					<!--没有字段-->
				</tr>
			</table>
		 <div class="button_wrapper clearfix">
          <!--       <div class="submit" >提交</div> -->
                <div class="save" >保存</div>
                <!-- <div class="reset" >重置</div> -->
            </div>
		</div>
	 </div>
 </form>
</body>
</html>
