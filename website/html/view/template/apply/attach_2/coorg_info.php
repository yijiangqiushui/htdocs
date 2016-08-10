<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>合作单位基本情况</title>

<link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../../../../website/html/view/css/tablestyle.css" />
<link rel="stylesheet" type="text/css" href="../../../css/button.css" />
<link rel="stylesheet" type="text/css" href="../../../css/table.css"/>

<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../../../../common/html/js/tablecommon.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript" src="../../../js/apply/coorg2_info.js"></script>
 
</head>
<body>
	<form method="post" id="2coorg_info_fm">
	<div class="project_content">
	   <div class="table_title clearfix">
	       <div class="title_pic left">项目申请书</div>
	       <div class="right back_pic" id="back"></div>
	   </div>
	   
	   <div class="table_content back-long">
		<table cellspacing="0" cellpadding="0" class="basic_info">
			<tr>
				<td colspan="6" class="border_left_none" style="background-color:#7AB5ED;">
				   <div class="title_top p-b10">合作单位基本情况</div>
                </td>
			</tr>
			
			<tr>
				<th width="180px"><p align="center">单位名称</p></th>
				<td colspan="5"><input name="coorg_name" /></td>
			</tr>
			
			<tr>
				<th><p align="center">组织机构代码</p></th>
				<td colspan="3"><input name="coorg_code" /></td>
				<th width="180px"><p align="center">注册资金</p></th>
				<td width="350px"><input name="register_fund" datatype="float" /></td>
			</tr>
			
			<tr>
				<th><p align="center">注册地址</p></th>
				<td colspan="3"><input name="register_address" /></td>
				<th><p align="center">单位类型</p></th>
				<td><input name="org_type" /></td>
			</tr>
			
			<tr>
				<th><p align="center">通讯地址</p></th>
				<td colspan="3"><input name="contact_address" /></td>
				<th><p align="center">邮政编码</p></th>
				<td><input name="postal" datatype="number"/></td>
			</tr>
			
			<tr>
				<th rowspan="2"><p align="center">法定代表人</p></th>
				<th width="180px"><p align="center">姓名</p></th>
				<th colspan="2"><p align="center">身份证号</p></th>
				<th colspan="2"><p align="center">联系电话（手机/座机）</p></th>
			</tr>
			
			<tr>
				<td><input name="legal_name" datatype="chinese_characters"/></td>
				<td colspan="2"><input name="legal_id" datatype="idcard"  style="min-width: 200px;"/></td>
				<td colspan="2"><input name="legal_phone" datatype="phandtel"/></td>
			</tr>
			
			<tr>
				<th rowspan="2"><p align="center">联系人</p></th>
				<th><p align="center">姓名</p></th>
				<th colspan="2"><p align="center">E-mail</p></th>
				<th colspan="2"><p align="center">联系电话（手机/座机）</p></th>
			</tr>
			
			<tr>
				<td><input name="linkman"  datatype="chinese_characters"/></td>
				<td colspan="2"><input name="linkman_email" datatype="email"/></td>
				<td colspan="2"><input name="linkman_contact" datatype="phandtel"/></td>
			</tr>
			
			<tr>
				<th rowspan="3"><p>自主知识产权情况（已授权）</p></th>
				<th>专利授权数</th>
				<th colspan="2">发明专利</th>
				<th>实用型</th>
				<th>外观设计</th>
			</tr>
			
			<tr>
				<td><input name="patent_num" datatype="number"/></td>
				<td colspan="2"><input name="invent_patent" datatype="number"/></td>
				<td><input name="functional_patent" datatype="number"/></td>
				<td><input name="patent_design" datatype="number"/></td>
			</tr>
			
			<tr>
				<th colspan="1"><p align="center">其他知识产权数</p></th>
				<td colspan="4"><input name="other_patent" datatype="number"/></td>
			</tr>
			<tr>
				<th><p align="center">合作单位情况简介（限500字）</p></th>
				<td colspan="5"><div><textarea class="text_content"  style='margin: 20px;    width:90%;' name="coorg_summary" maxlength="500"></textarea></div></td>
			</tr>
			<!--所属行业      主要产品或技术   缺少 -->
		</table>	
		<div class="button_wrapper clearfix">
   			<div class="save">保存</div>
   			<!-- <div class="reset" >重置</div> -->
		</div>
		</div>
    </div>
	</form>
</body>
</html>