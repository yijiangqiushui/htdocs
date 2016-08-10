<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../../../center/html/view/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script type="text/javascript"
	src="../../../js/apply/iprproject1_1/org_info.js"></script>

<style type="text/css">
input {
	width: 99.5%;
	border: 1px;
}

td {
	height: 35px;
	text-align: left;
}

body {
	font-family: "微软雅黑";
	margin: auto 0;
	font-size: 16px;
}

div {
	text-align: center;
	margin: auto 0;
	line-height: 100%;
}

table {
	margin: 0 auto;
	border: 1px solid black;
	font-size: 14px;
	width: 50%;
}

table table {
	width: 100%;
}
</style>

</head>

<body>
	<div class="easyui-panel" style="border: 0;">
		<form method="post" id="org_info">
			<table width="500" height="291" border="1" cellspacing="0">
				<tr>
					<td colspan="7"><h2>一、企业基本情况</h2></td>
				</tr>
				<tr>
					<td width="66">企业名称</td>
					<td colspan="4"><input type="text" name="org_name" /></td>
					<td width="60">注册时间</td>
					<td width="103"><input type="text" name="register_time" /></td>
				</tr>
				<tr>
					<td>通讯地址</td>
					<td colspan="4"><input type="text" name="contact_address" /></td>
					<td>邮  编</td>
					<td><input type="text" name="postal" /></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td colspan="6"><input type="text" name="email" /></td>
				</tr>
				<tr>
					<td rowspan="2">企业法定代表人情况</td>
					<td width="78">姓名</td>
					<td width="116">性别</td>
					<td width="76">出生年月</td>
					<td width="71">最高学历</td>
					<td>任职时间</td>
					<td>电话(手机)</td>
				</tr>
				<tr>
					<!-- 这是另一个表中的 -->
					<td><input type="text" name="legal_name" /></td>
					<!-- 判断男女 -->
					<td><input type="radio" value="0" name="legal_sex" style="">女</input>
						<input type="radio" value="1" name="legal_sex" style="">男</input>
					</td>
					<td><input type="text" name="legal_birth" /></td>
					<td><input type="text" name="legal_edu" /></td>
					<td><input type="text" name="legal_time" /></td>
					<td><input type="text" name="legal_phone" /></td>
				</tr>
				<tr>
					<td>联系人</td>
					<td><input type="text" name="linkman " /></td>
					<td>电话（手机）</td>
					<td colspan="2"><input type="text" name="phone" /></td>
					<td>传真</td>
					<td><input type="text" name="fax" /></td>
				</tr>
				<tr>
					<td>开户银行</td>
					<td><input type="text" name="org_bank" /></td>
					<td>账号</td>
					<td colspan="2"><input type="text" name="account" /></td>
					<td>信用等级</td>
					<td><input type="text" name="credit_rate:" /></td>
				</tr>
				<tr>
					<td height="95">注册登记类型</td>

					<td colspan="6"><input type="radio" value="0" name="org_type">1.国有企业</input><br />
						<input type="radio" value="1" name="org_type">2.集体企业</input><br />
						<input type="radio" value="2" name="org_type">3.股份合作企业 </input><br />
						<input type="radio" value="3" name="org_type">4.联营企业 </input><br />
						<input type="radio" value="4" name="org_type">5.有限责任公司</input><br />
						<input type="radio" value="5" name="org_type">6.股份有限公司</input><br />
						<input type="radio" value="6" name="org_type"> 7.私营企业 </input><br />
						<input type="radio" value="7" name="org_type">8.港、澳、台商投资企业</input><br />
						<input type="radio" value="8" name="org_type">9.外商投资企业 </input><br />
						<input type="radio" value="9" name="org_type">10.其他企业</input><br />
					</td>
				</tr>
				<tr>
					<td height="64">企业特征</td>

					<td colspan="6"><input type="radio" value="0" name="feature">1.高新技术企业</input><br />
						<input type="radio" value="1" name="feature">2.大专院校办的企业 </input><br />
						<input type="radio" value="2" name="feature">3.科研院所办的企业</input><br />
						<input type="radio" value="3" name="feature">4.留学人员办的企业</input><br />
						<input type="radio" value="4" name="feature">5.科研院所整体转制企业</input><br />
						<input type="radio" value="5" name="feature">6.其他 </input><br /></td>
				</tr>
				<tr>
					<td>行业</td>
					<td><input type="text" name="org_trade" /></td>
					<td>注册资金</td>
					<td><input type="text" name="register_fund " /></td>
					<td colspan="2">其中外资比例</td>
					<td><input type="text" name="local_foreign" /></td>
				</tr>
				<tr>
					<td>职工总数</td>
					<td><input type="text" name="staff_num" /></td>
					<td>其中大专以上人员</td>
					<td><input type="text" name="junior" /></td>
					<td colspan="2">其中研究开发人员</td>
					<td><input type="text" name="researcher_num  " /></td>
				</tr>
				<tr>
					<td colspan="2">企业专利情况</td>
					<td>已获专利授权数</td>
					<td><input type="text" name="patent_num " /></td>
					<td colspan="2">其中发明专利项</td>
					<td><input type="text" name="invent_num" /></td>
				</tr>
				<tr>
					<td colspan="2">上年度企业总收入</td>
					<td><input type="text" name="last_totalincome" /></td>
					<td colspan="2">上年度企业净利润</td>
					<td colspan="2"><input type="text" name="last_totalprofit" /></td>
				</tr>
				<tr>
					<td colspan="2">上年度工业总产值</td>
					<td><input type="text" name="last_industryval" /></td>
					<td colspan="2">上年度企业交税总额</td>
					<td colspan="2"><input type="text" name="last_industrytax" /></td>
				</tr>
				<tr>
					<td colspan="2">上年度工业增加值</td>
					<td><input type="text" name="last_industryadd" /></td>
					<td colspan="2">上年度企业创汇总额</td>
					<td colspan="2"><input type="text" name="last_industrycreative" /></td>
				</tr>
				<tr>
					<td colspan="2">上年度产品销售总额</td>
					<td><input type="text" name="last_productsale" /></td>
					<td colspan="2">上年度企业技术开发经费支出额</td>
					<td colspan="2"><input type="text" name="last_techexpend " /></td>
				</tr>
				<tr>
					<td colspan="3">主要产品名称</td>
					<td colspan="3">占企业销售收入总额比例</td>
					<td>操作</td>
				</tr>
				<tr>
					<td colspan="8">
						<table width="570" border="1" cellspacing="0"
							style="margin-bottom: 0;" id="addtable">
  	<?php
			// $org_code = $_SESSION['org_code'];
			$org_code = '01234567';
			$sql = "Select * from  org_product where org_code=$org_code";
			$conn = mysql_connect ( "192.168.1.125", "FRED", "123456" );
			mysql_select_db ( "project", $conn );
			$result = mysql_query ( $sql, $conn );
			$tableRow = mysql_num_rows ( $result );
			if ($tableRow) {
				for($i = 0; $i < $tableRow; $i ++) {
					$row = mysql_fetch_object ( $result );
					echo "<tr>";
					echo "<td ><input type='text' name='main_product[$i]' value='$row->main_product'/></td>";
					echo "<td ><input type='text' name='sale_ratio[$i]' value='$row->sale_ratio'/></td>";
					echo "<td><input type='button' value='删除' onclick='delLine(this)'/></td>";
					echo "</tr>";
				}
			} else {
				echo "<tr>";
				echo "<td  width='110'><input type='text' name='main_product[0]' /></td>";
				echo "<td  width='267'><input type='text'  name='sale_ratio[0]' /></td>";
				echo "<td width='40' ><input type='button' value='删除' onclick='delLine(this)'/></td>";
				echo "</tr>";
			}
			?>
  </table>
					</td>
				</tr>
				<tr>
					<td colspan="9" height="25"><input type="button" value="添加"
						onclick="addLine()" /></td>
					<!-- 没有字段-->
				</tr>


			</table>
			<a href="javascript:void(0);" class="easyui-linkbutton"
				iconcls="icon-ok" onclick="submitdata()">确定</a> <a
				href="javascript:void(0);" class="easyui-linkbutton"
				iconcls="icon-no" onclick="reset()">重置</a>
		</form>
	</div>
</body>
</html>
