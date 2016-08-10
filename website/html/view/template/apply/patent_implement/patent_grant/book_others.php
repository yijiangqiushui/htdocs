<?php
include '../../../../../../../common/php/config.ini.php';
include '../../../../../../../extends/Table/TableData.php';
session_start();
$org_name=$_SESSION['org_name'];
$org_code=$_SESSION['org_code'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link rel="stylesheet" type="text/css"
	href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/button.css" />
<link rel="stylesheet"
	href="../../../../../../../common/html/lib/css/datapicker/daterangepicker.css" />

<script src="../../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script
	src="../../../../../../../common/html/plugin/datapicker/moment.min.js"></script>

<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

<script
	src="../../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/apply/patent_grant/book_others.js"></script>
</head>

<body>
<div style="width: 100%; height: 100%; border: 1px;">
	<form id="book_others" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">协议书各方</div>
				<div class="right back_pic" id="back"></div>
			</div>

			<div class="table_content back-long "  >
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="6">
							<p class="title_top p-b10">协议书各方</p>
						</td>
					</tr>

					<tr>
						<th rowspan="14"><p align="center">乙方</p></th>
						<th rowspan="1" colspan="2"><p align="center">单位名称</p></th>
					<!--	<td colspan="3"><input name="b_name" value="<?php echo $org_name; ?>" readOnly="readonly" /></td>  -->
							<td colspan="3"><input name="org_name"  readOnly="readonly" /></td>
					</tr>
					<tr>
						<th rowspan="1" colspan="2"><p align="center">组织机构代码</p></th>
						<td colspan="3"><input name="b_code" value="<?php echo $org_code; ?>" readOnly="readonly" /></td>
					</tr>
					<tr>
						<th rowspan="1" colspan="2"><p align="center">联 系 人</p></th>
						<td colspan="3"><input name="linkman" id="linkman" ></input></td>
					</tr>
					<tr>
						<th rowspan="1" colspan="2"><p align="center">通讯地址</p></th>
						<td colspan="3"><input name="contact_address"  readonly="readonly"></input></td>
					</tr>
					<tr>
						<th rowspan="1" colspan="2"><p align="center">邮政编码</p></th>
						<td colspan="3"><input name="b_postal"  datatype="postcode"  '></input></td>
					</tr>
					<tr>
						<th rowspan="1"><p align="center">电 话</p></th>
						<td><input name="b_phone" id="b_phone"  value="" datatype="phandtel"  ></input></td>
						<th rowspan="1" colspan="2"><p align="center">传 真</p></th>
						<td><input name="b_fax"   datatype="fax" placeholder='正确格式：010-xxxxxxxx'></input></td>
					</tr>
					<tr>
						<th rowspan="1" colspan="2"><p align="center">电子信箱</p></th>
						<td colspan="3"><input name="b_email" id="b_email"  value="" datatype="email"  ></input></td>
					</tr>
					<tr>
						<th rowspan="1" colspan="2"><p align="center">户 名</p></th>
						<td colspan="3"><input name="b_count" ></input></td>
					</tr>
					<tr>
						<th rowspan="1" colspan="2"><p align="center">开户银行</p></th>
						<td colspan="3"><input name="b_bank" ></input></td>
					</tr>
					<tr>
						<th rowspan="1" colspan="2"><p align="center">帐 号</p></th>
						<td colspan="3"><input name="b_number"  datatype="number"></input></td>
					</tr>

				</table>
				<input type="hidden" name="save_display" id="save_display"></input>
				<div class="button_wrapper clearfix d-n">
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>
		</div>

	</form>
</div>

</body>
</html>
