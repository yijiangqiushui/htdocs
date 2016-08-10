<?php
include '../../../../../../center/php/config.ini.php';
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通州区高新技术企业认定服务机构资助资金申请表</title>
    <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/table.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/button.css"/>
    
    <script src="../../../../../../common/html/js/datecommon.js"></script>
    
    
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.cookie.js" ></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script src="../../../../../../common/html/js/validation.js"></script>
    <script src="../../../../../../common/html/js/tablecommon.js"></script>
	<script type="text/javascript" src="../../../js/apply/11org_info.js"></script>
</head>
<body>
<form method="post" id="11org_info_fm">
  <div class="project_content">
  <div class="table_title clearfix">
      <div class="title_pic left">项目内容</div>
      <div class="right back_pic" id="back"></div>
  </div>
  <div class="table_content back-long"> 
   <table cellspacing="0" cellpadding="0" class="basic_info">
				<tr>
					<td colspan="7" class="border_left_none" style="background-color:#7AB5ED;">
						<div class="title_top p-b10">高新技术企业认定服务机构资助资金申请表</div>
					</td>
				</tr>
				<tr>
					<th width="180px"><p align="center">单位名称</p></th>
					<td colspan="6"><input   id="org_name" name="org_name" title="只读信息，若有误请联系管理员修改" readonly/></td>
				</tr>
				<tr>
					<th><p align="center">注册地址</p></th>
					<td colspan="4"><input   name="register_address" readonly/></td>
					<th width="180px"><p align="center">注册资金</p></th>
					<td><input   name="register_fund"  datatype="float"/></td>
				</tr>
				<tr>
					<th> <p align="center">通讯地址 </p></th>
					<td colspan="4"><input   name="contact_address" readonly/></td>
					<th><p align="center">邮政编码</p></th>
					<td><input   name="postal" datatype="postcode" readonly/></td>
				</tr>
				<tr>
					<th rowspan="2">法定代表人</th>
					<th colspan="2"><p align="center">姓名</p></th>
					<th colspan="2"><p align="center">身份证号码</p></th>
					<th colspan="2"><p align="center">联系电话(手机/座机)</p></th>
				</tr>
				<tr>
					<td colspan="2"><input   name="legal_name" readonly/></td>
					<td colspan="2"><input datatype="IDcard"  name="legal_id" /></td>
					<td colspan="2"><input  name="legal_phone" readonly/></td>
				</tr>
				
				<tr>
					<th rowspan="2">联系人</th>
					<th colspan="2">姓名</th>
					<th colspan="2">E-mail</th>
					<th colspan="2">联系电话（手机/座机）</th>
				</tr>
				
				<tr>
					<td colspan="2"><input   name="linkman"  /></td>
					<td colspan="2"><input  name="linkman_email"  datatype="email" /></td>
					<td colspan="2"><input   name="linkman_contact"  datatype="phandtel"/></td>
				</tr>
				<tr>
					<th>注册登记类型</th>
					<td colspan="3"><input   name="org_type" /></td>
					<th>所属行业</th>
					<td colspan="2"><input   name="org_trade" /></td>
				</tr>
				<tr>
					<th colspan="3">开户银行</th>
					<th colspan="2">开户名称</th>
					<th colspan="2">银行账号</th>
				</tr>
				<tr>
					<td colspan="3"><input   name="org_bank" /></td>
					<td colspan="2"><input   name="username" /></td>
					<td colspan="2"><input datatype="number"  name="account" /></td>
				</tr>
				<tr>
					<td colspan="7" cellpadding="0">
						<table width="570" cellspacing="0" cellpadding="0"
							style="margin-bottom: 0;" id="addtable">
					<tr>
					<th rowspan="40">上年度登记技术合同情况</th>
					<th>合同编号</th>
					<th>项目名称</th>
					<th>认定时间</th>
					<th>合同金额(万元)</th>
					<th colspan="2">操作</th>
				</tr>
		    		
  <?php
		$org_code = $_SESSION['org_code'];
		$db=new DB();
		$sql = "Select * from technical_contract where org_code = '$org_code'";
//         echo $sql;
		$result=$db->SelectOri($sql);
		$tableRow = mysql_num_rows ( $result );
		
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td><input type='text' style='width:99.5%;height:100%;' name='contract_code[$i]' value='$row->contract_code'/></td>";
				echo "<td ><input type='text' name='project_name[$i]' value='$row->project_name'/></td>";
				echo "<td><input type='text' class='dateplu'  name='affirm_time[$i]' value='$row->affirm_time' /></td>";
				echo "<td><input type='text'  datatype='float' name='contract_price[$i]' value='$row->contract_price'/></td>";
				echo "<td colspan='2'><input type='button' value='删除' class='pointer but'  onclick='delLine(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td ><input type='text' style='width:99.5%;height:100%;' name='contract_code[0]'/></td>";
			echo "<td ><input type='text' style='width:99.5%;height:100%;' name='project_name[0]'/></td>";
			echo "<td ><input type='text' class='dateplu' style='width:99.5%;height:100%;' name='affirm_time[0]'/></td>";
			echo "<td ><input type='text' datatype='float' style='width:99.5%;height:100%;' name='contract_price[0]'/></td>";
			echo "<td colspan='2' ><input type='button' style='width:99.5%;height:100%;' value='删除' class='pointer but'  onclick='delLine(this)'/></td>";
			echo "</tr>";
		}
		?>
		  </table>
		 </td>
	    </tr>
		<tr>
		<th colspan="9"><input type="button" value="添加" class='pointer'  onclick="addLine()" /></th>
	    </tr>

		<tr>
		<th colspan="4"><p align="center">合同总额(万元)</p></th>
		<td colspan="3"><input   name="contractMoney" datatype="float"/></td>
	    </tr>
		<tr>
		<th><p align="center">本年度预计登记合同份数</p></th>
		  <td colspan="2"><input   name="expect_contractNums" datatype="number"/></td>
		  <th><p align="center">本年度预计登记技术合同总额</p></th>
		  <td colspan="3"><input   name="expect_contractMoney" datatype="float" /></td>
	    </tr>
		<tr>
		  <th><p align="center">上半年上缴税金（万元）</p></th>
		  <td colspan="6"><input   name="previous_taxes" datatype="float"/></td>
		</tr>
		<tr>
		  <th rowspan="2"><p align="center">区科委主管科室意见</p></th>
		    <th><p align="center">核定金额（万元）</p></th>
			<td colspan="5"><input   name="check_amount" datatype="float" /></td>
		</tr>
		<tr>
			<th><p align="center">资助金额（万元）</p></th>
			<td colspan="5"><input   name="award_level" datatype="float" /></td>
	    </tr>
	  
	  </table>
                <div class="button_wrapper clearfix">
            <!--     <div class="submit" >提交</div> -->
                <div class="save" >保存</div>
                <!-- <div class="reset" >重置</div> -->
            </div>
        </div>
	</div>
</form>
</body>
</html>
