<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../website/html/view/css/tablestyle.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../js/implement/modify_apply.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<style type="text/css">
body {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	margin: auto 0;
	text-align: center;
}

table {
	width: 100%;
	border: 1px solid #ffffff;
}

img {
	position: absolute;
	z-index: -1;
}

input {
	height: 100%;
	width: 100%;
	background-color: transparent;
}

tr:nth-child(odd) {
	background-color: #D1E4F3;
}

tr:nth-child(even) {
	background-color: #EAF3FA;
}

tr {
	border: 2px solid #ffffff;
}

td {
	text-align: center;
	border: 1px solid #ffffff;
	line-height: 30px;
}

th {
	height: 32px;
	color: #FFFFFF;
	background-color: #7AB5ED;
	border: solid 1px #ffffff;
}

textarea {
	border: 2px solid #ffffff;
	background-color: #ffffdd;
}

p {
	margin: 0;
	padding: 0;
}
</style>

</head>

<body>
<form id="modify_apply" method="post">
         <div class="project_content">
        <div class="table_title clearfix">
            <div class="title_pic left">项目实施方案填写</div>
            <div class="right back_pic" id="back" ></div>
        </div>
        
        <div class="table_content back-long">
            <table cellspacing="0" cellpadding="0" class="basic_info">
                <tr>
                    <td colspan="4" class="border_left_none" style="background-color:#7AB5ED;">
                        <div class="title_top p-b10">北京市通州区科技计划项目调整申请表</div>
                    </td>
                </tr>
            <tr>
                <td width="91"><p align="center">项目名称</p></td>
                <td width="493" colspan="2"><input 
                                                   style="width: 99.5%; height: 100%;" 
                                                   name="project_name" type="text" value="" readonly="readonly"  class="input class="
                                                   easyui-validatebox" required="true" " />
                </td>
            </tr>
            <tr>
                <td width="91"><p align="center">
                        承担单位 <br/> （盖章）
                    </p></td>
                <td width="493" colspan="2"><p>&nbsp;</p></td>
            </tr>
            <tr>
                <td width="91"><p align="center">起止时间</p></td>
                <td width="493" colspan="2"><input  readonly="readonly" 
                                                   style="width: 99.5%; height: 100%;" 
                                                   name="start_end" type="text" class="input class="
                                                   easyui-validatebox" required="true" " />
                </td>
            </tr>
            <tr>
                <td width="91" rowspan="2"><p align="center">项目经费</p></td>
                <td width="246" rowspan="2"><span style="margin-top: 30px;">总经费：</span>
                    <input class="easyui-validatebox"
                           style="width: 300px; height: 100%; float: right;" required="true"
                           type="text" name="project_money" style="height:30px;"/></td>
                <td width="276">财政经费：<input class="easyui-validatebox"
                                            required="true" style="width: 75%; height: 100%; float: right;"
                                            type="text" name="finmoney"/>
                </td>
            </tr>
            <tr>
                <td width="246">其它经费：<input class="easyui-validatebox"
                                            style="width: 75%; height: 100%; float: right;" required="true"
                                            type="text" name="othermoney"/></td>
            </tr>
            <tr>
                <td width="91"><p align="center">申请调整内容</p></td>
                <td width="493" colspan="2"><input class="easyui-validatebox"
                                                   required="true" name="modify_content" value="" type="text"
                                                   style="height: 100%; width: 99.5%; margin-left: 0px; float: top;"/>
                </td>
            </tr>
            <tr>
                <td width="91"><p align="center">调整理由说明</p></td>
                <td width="493" colspan="2"><p align="center">&nbsp;</p> <textarea
                        name="modify_reason"
                        style="height: 200px; width: 99.2%; margin-left: 0px; float: top;"
                        class="easyui-validatebox" required="true"></textarea>
||||||| .r455
<form id="modify_apply" method="post">
         <div class="project_content">
        <div class="table_title clearfix">
            <div class="title_pic left">项目实施方案填写</div>
            <div class="right back_pic" id="back"></div>
        </div>
        
        <div class="table_content back-long">
            <table cellspacing="0" cellpadding="0" class="basic_info">
                <tr>
                    <td colspan="4" class="border_left_none" style="background-color:#7AB5ED;">
                        <div class="title_top p-b10">北京市通州区科技计划项目调整申请表</div>
                    </td>
                </tr>
            <tr>
                <td width="91"><p align="center">项目名称</p></td>
                <td width="493" colspan="2"><input 
                                                   style="width: 99.5%; height: 100%;" 
                                                   name="project_name" type="text" value="" readonly="readonly"  class="input class="
                                                   easyui-validatebox" required="true" " />
                </td>
            </tr>
            <tr>
                <td width="91"><p align="center">
                        承担单位 <br/> （盖章）
                    </p></td>
                <td width="493" colspan="2"><p>&nbsp;</p></td>
            </tr>
            <tr>
                <td width="91"><p align="center">起止时间</p></td>
                <td width="493" colspan="2"><input  readonly="readonly" 
                                                   style="width: 99.5%; height: 100%;" 
                                                   name="start_end" type="text" class="input class="
                                                   easyui-validatebox" required="true" " />
                </td>
            </tr>
            <tr>
                <td width="91" rowspan="2"><p align="center">项目经费</p></td>
                <td width="246" rowspan="2"><span style="margin-top: 30px;">总经费：</span>
                    <input class="easyui-validatebox"
                           style="width: 300px; height: 100%; float: right;" required="true"
                           type="text" name="project_money" style="height:30px;"/></td>
                <td width="276">财政经费：<input class="easyui-validatebox"
                                            required="true" style="width: 75%; height: 100%; float: right;"
                                            type="text" name="finmoney"/>
                </td>
            </tr>
            <tr>
                <td width="246">其它经费：<input class="easyui-validatebox"
                                            style="width: 75%; height: 100%; float: right;" required="true"
                                            type="text" name="othermoney"/></td>
            </tr>
            <tr>
                <td width="91"><p align="center">申请调整内容</p></td>
                <td width="493" colspan="2"><input class="easyui-validatebox"
                                                   required="true" name="modify_content" value="" type="text"
                                                   style="height: 100%; width: 99.5%; margin-left: 0px; float: top;"/>
                </td>
            </tr>
            <tr>
                <td width="91"><p align="center">调整理由说明</p></td>
                <td width="493" colspan="2"><p align="center">&nbsp;</p> <textarea
                        name="modify_reason"
                        style="height: 200px; width: 99.2%; margin-left: 0px; float: top;"
                        class="easyui-validatebox" required="true"></textarea>
=======
	<form id="modify_apply" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">调整申请表</div>
				<div class="right back_pic" id="back"></div>
			</div>
>>>>>>> .r471

			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="4" class="border_left_none"
							style="background-color: #7AB5ED;">
							<div class="title_top p-b10">北京市通州区科技计划项目调整申请表</div>
						</td>
					</tr>
					<tr>
						<th><p align="center">项目名称</p></th>
						<td colspan="2"><input style="width: 99.5%; height: 100%;"
							name="project_name" type="text" value="" readonly="readonly" /></td>
					</tr>
					<tr>
						<th>
							<p align="center">
								承担单位 <br /> （盖章）
							</p>
						</th>
						<td colspan="2"><p>&nbsp;</p></td>
					</tr>
					<tr>
						<th><p align="center">起止时间</p></th>
						<td colspan="2"><input readonly="readonly"
							style="width: 99.5%; height: 100%;" name="start_end" type="text"
							class="input class=" easyui-validatebox"  /></td>
					</tr>
					<tr>
						<th rowspan="2"><p align="center">项目经费</p></th>
						<td rowspan="2" class="clearfix">
							<div class="left fund_title">总经费：</div>
							<div class="left fund_input">
								<input type="text" name="project_money" class="border_none" />
							</div>
						</td>
						<td class="clearfix">
							<div class="left fund_title1">财政经费：</div>
							<div class="left fund_input">
								<input class="border_none" type="text" name="finmoney" />
							</div>
						</td>
					</tr>
					<tr>
						<td class="clearfix">
							<div class="left fund_title1">其它经费：</div>
							<div class="left fund_input">
								<input class="border_none" type="text" name="othermoney" />
							</div>
						</td>
					</tr>
					<tr>
						<th><p align="center">申请调整内容</p></th>
						<td colspan="2"><input name="modify_content" value="" type="text"
							style="height: 100%; width: 99.5%; margin-left: 0px; float: top;" />
						</td>
					</tr>
					<tr>
						<th><p align="center">调整理由说明</p></th>
						<td colspan="2"><textarea name="modify_reason" class="text_content"></textarea>

							<p align="right" class="p-r60">
								项目负责人（签字）： 
							</p>
							<p class="p-r10" align="right"> 年    月    日</p>
						</td>
					</tr>
					<tr>
						<th><p align="center">承担单位意见</p></th>
						<td colspan="2"><textarea name="org_suggest" class="text_content"></textarea>

							<p align="right" class="p-r60">
								单位负责人（签字）：
							</p>
							<p class="p-r10" align="right"> 年    月    日</p>
						</td>
					</tr>
					<tr>
						<th rowspan="4"><p align="center">
								区科委 <br /> 处理意见
							</p></th>
						<td colspan="2"><textarea name="engineer_suggest" class="text_content"></textarea>

							<p align="right" class="p-r60">
								主管工程师意见： <br /> （签字）： 
							</p>
							<p class="p-r10" align="right"> 年    月    日</p>
						</td>
					</tr>
					<tr>
						<td colspan="2"><textarea name="office_suggest" class="text_content"></textarea>

							<p align="right" class="p-r60">
								主管科室意见： <br /> （签字）： 
							</p>
							<p class="p-r10" align="right"> 年    月    日</p>
						</td>
					</tr>
					<tr>
						<td colspan="2"><textarea name="vice_suggest" class="text_content"></textarea>

							<p align="right" class="p-r60">
								主管副主任意见： <br /> （签字）： 
							</p>
							<p class="p-r10" align="right"> 年    月    日</p>
						</td>
					</tr>
					<tr>
						<td colspan="2"><textarea name="director_suggest" class="text_content"></textarea>
							<p align="right" class="p-r60">主任意见：</p>
							<p align="right" class="p-r60">
								（签字）：  
							</p>
							<p align="right" class="p-r10">北京市通州区科学技术委员会（盖章）</p>
							<p align="right" class="p-r10"> 年    月    日</p>
						</td>
					</tr>
					<tr>
						<th><p align="center">备注</p></th>
						<td colspan="2"><textarea name="remark" class="text_content"></textarea>
						</td>
					</tr>
				</table>
				<div class="button_wrapper clearfix">
					<div class="submit">提交</div>
					<div class="save" onclick='saveApplys();'>保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>

		</div>
	</form>
</body>
</html>
