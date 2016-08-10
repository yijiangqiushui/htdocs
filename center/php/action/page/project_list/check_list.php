<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/pri.cls.php';
$project_type_id = intval($_GET['name']);
$tag = Pri::instance()->check_pri_pt($project_type_id,0);
$tag_engi = Pri::instance()->check_pri_pt($project_type_id,1);
if(Pri::instance()->is_special){
	$tag = false;
}

header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA div COM NAV OTC NOI DSP COR"');

$department1 = (isset($_GET['department'])) ? $_GET['department'] : '';
$min1 = (isset($_GET['min'])) ? $_GET['min'] : '';
$max1 = (isset($_GET['max'])) ? $_GET['max'] : '';
$project_type1 = (isset($_GET['name'])) ? $_GET['name'] : '';

setcookie('department1', $department1, time() + 3600 * 24, '/');
setcookie('min1', $min1, time() + 3600 * 24, '/');
setcookie('max1', $max1, time() + 3600 * 24, '/');
setcookie('project_type1', $project_type1, time() + 3600 * 24, '/');


$ctag = true;
/*if(Pri::instance()->check_pri_pt($project_type_id,0) || Pri::instance()->check_pri_pt($project_type_id,1) || Pri::instance()->check_pri_pt($project_type_id,2) || Pri::instance()->check_pri_pt($project_type_id,3)){
	$ctag = true;
}*/
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<!-- <script type="text/javascript"
	src="../../../../../common/html/lib/js/jquery-2.1.0.min.js"></script> -->
	<script src="../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
	
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<!-- <script type="text/javascript" src="../../../../html/view/js/setProject.js"></script> -->
<script type="text/javascript" src="../../../../html/view/js/check_list.js" charset="utf-8"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/NTClientJavascript.js"></script>
<style type="text/css">
	#fm {
		margin: 0;
		padding: 10px 30px;
	}
	
	.ftitle {
		font-size: 14px;
		font-weight: bold;
		color: #666;
		padding: 5px 0;
		margin-bottom: 10px;
		border-bottom: 1px solid #ccc;
	}
	
	.fitem {
		margin: 5px 0 5px 0;
	}
	
	.fitem label {
		display: inline-block;
		width: 80px;
	}
	
	a {
		text-decoration: none;
	}
	
	.left {
		float:left;
	}
	.title {
	    margin-left: 10px;
    	font-size: 14px;
    }
    .clear {
    	clear:both;
    }
    .m-b10 {
    	margin-bottom: 10px;
    }
    #b-n1,#b-n2,#b-n3 {
    	border: 1px solid #fff;
    }
    .checkacc{
	   color:#f00;
    }
</style>

<script type="text/javascript">
	//点击保存之后 跳转的页面
	function saveproject_info() {
		url = '/center/php/action/page/project_list/checkinfo.php?action=saveproject_info';
		$('#fm2').form('submit',{
				url : url,
				onSubmit : function() {
					//alert('sub :'+ url); 
					return $(this).form('validate');
				},
				success : function(result) {
					//	alert(result);
					var result = eval('(' + result + ')');
					//alert(result.success); 
					if (result.success) {
						$('#dlg').dialog('close'); // close the dialog 
						$('#projectList').datagrid('reload'); // reload the user data 
					} else {
						$.messager.show({
								title : 'Error',
								msg : result.msg
						});
					}
				}
		});
	}
	function myformatter(date) {
		var y = date.getFullYear();
		var m = date.getMonth() + 1;
		var d = date.getDate();
		return y + '-' + (m < 10 ? ('0' + m) : m) + '-'
				+ (d < 10 ? ('0' + d) : d);
	}
	function myparser(s) {
		if (!s)
			return new Date();
		var ss = (s.split('-'));
		var y = parseInt(ss[0],10);
		var m = parseInt(ss[1],10);
		var d = parseInt(ss[2],10);
		if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
			return new Date(y, m - 1, d);
		} else {
			return new Date();
		}
	}
</script>
</head>
<body class='easyui-layout' cinit="<?php echo $ctag?0:6; ?>" roleTag="<?php echo Pri::instance()->admin_tag?1:0;  ?>">
		<div data-options="region:'west',title:'分类',sqlit:'true'" style="width:200px;padding:5px;">
			<?php if($ctag){ ?>
		 <ul class="easyui-tree" id="all_projects">
<!-- 				loadPage()  方法会按照 传入的参数进行数据的加载  0-5分别是6中状态
 -->					<li data-options="state:'open'">
						<span><a href="#" onclick="loaddata(0)">受理项目</a></span>
						<ul>
							<li>
								<span><a href="#" onclick="loaddata(0)">全部内容</a></span>
							</li>
							<li>
								<span><a href="#" onclick="loaddata(12)">申报阶段</a></span>
							</li>
							<li>
								<span><a href="#" onclick="loaddata(13)">立项阶段</a></span>
							</li>
							<li>
								<span><a href="#" onclick="loaddata(14)">实施阶段</a></span>
							</li>
							<li>
								<span><a href="#" onclick="loaddata(15)">验收阶段</a></span>
							</li>
						</ul>
					</li>
				</ul>
				<?php
			}
			if($tag){ ?>
				
			<?php }

			?>
            <ul class="easyui-tree" id="store_projects">
				</ul>
				<ul class="easyui-tree" id="nopass_projects">	
				</ul>
			<ul class="easyui-tree" id="pre_projects">
				<li data-options="state:'open'">
					<span><a href="#" onclick="loaddata(16)">待办事项</a></span>
					<ul>
						<li>
							<span><a href="#" onclick="loaddata(10)">项目待办</a></span>
							<ul>
							     <li>
								    <span><a href="#" onclick="loaddata(1)">待立项</a></span>
					             </li>
							     <li>
								    <span><a href="#" onclick="loaddata(2)">待审核</a></span>
							     </li>
							     <li>
							        <span><a href="#" onclick="loaddata(3)">中期开启</a></span>
							     </li>
							     <li>
								    <span><a href="#" onclick="loaddata(4)">验收开启</a></span>
							     </li>
							     <li>
								    <span><a href="#" onclick="loaddata(5)">待存档</a></span>
							     </li>
							</ul>
						</li>
						<?php
						if(Pri::instance()->admin_tag){
						?>
						<li>
							<span><a href="#" onclick="loaddata(11)">权限待审</a></span>
						</li>
						<?php } ?>
					</ul>
				</li>
			</ul>
		</div>

		<div id="center" data-options="region:'center',title:'信息',iconCls:'icon-ok',split:true">
		
		<table id="projectList" >
		</table>
		<div id="toolbar" class="datagrid-toolbar">
		    <?php  if( !Pri::instance()->is_special ){ ?>
				<a id="select" class="easyui-linkbutton" plain="true">查询</a> 
				<a href="javascript:void(0)" class="easyui-linkbutton" plain="true" onclick="startMid()">批量开启中期</a> 
				<a href="javascript:void(0)" class="easyui-linkbutton" plain="true" onclick="startHarvest()">批量开启验收</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" plain="true" onclick="exportExcel()">导出excel</a>
			<?php
			if(Pri::instance()->admin_tag) {
				?>
				<a href="javascript:void(0)" class="easyui-linkbutton" plain="true" onclick="checkProgram()">立项审批</a>
				<a href="javascript:void(0)"  id='check' class="easyui-linkbutton" plain="true" >批量审批</a>

				<?php
			}else{ ?>
				<a href="javascript:void(0)"  id='check' class="easyui-linkbutton" plain="true" >批量审批</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" plain="true" onclick="priTransfer()">项目代管</a>
			<?php
			}
			if(Pri::instance()->admin_tag||$tag || $tag_engi){ ?>
				<a href="javascript:void(0)" class="easyui-linkbutton multiSetEngine" onclick="multiSetEngine()" style="display:none" plain="true" >编辑主管工程师</a>
			<?php
				}
			}
			?>
			   <!--   <a href="javascript:void(0)" class="easyui-linkbutton" plain="true" onclick="openEditSms()">发送短信</a> -->
				<a href="/center/html/view/template/project_main.html" style="float:right" class="easyui-linkbutton" iconcls="icon-back" plain="true" >返回</a>
		</div>
		</div>
	<div id="dlg" class="easyui-dialog" style="width: 400px; height: auto; padding: 10px 20px" closed="true">

		<div class="easyui-tabs" style="width: 350px; height: auto">
			<div title="查看">
				<div class="ftitle">项目基本信息</div>
				<form id="fm1" method="post" novalidate>
					<div class="fitem">
						<label>项目名称:</label> <input name="project_name" class="easyui-validatebox"/>
					</div>
					<div class="fitem">
						<label>项目编号:</label> <input name="project_id" readonly="readonly"/>
					</div>
					<div class="fitem">
						<label>主管科室:</label> <input name="department" readonly="readonly"/>
					</div>
					<div class="fitem">
						<label>主管工程师:</label> <input name="project_engineer" readonly="readonly"/>
					</div>
					<div class="fitem">
						<label>所属领域:</label> <input name="tech_area" readonly="readonly"/>
					</div>
					<div class="fitem">
						<label>承担单位:</label> <input name="undertake_id" readonly="readonly"/>
					</div>
					<div class="fitem">
						<label>开始时间:</label> <input name="project_start" readonly="readonly"/>
					</div>
					<div class="fitem">
						<label>结束时间:</label> <input name="project_end" readonly="readonly"/>
					</div>
					<div class="fitem">
						<label>项目类型:</label> <input name="project_type" readonly="readonly"/>
					</div>
					<div style="float: left;">
						<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">关闭</a>
					</div>
				</form>
			</div>

			<div title="修改">
				<div class="ftitle">项目基本信息</div>
				<form id="fm2" method="post" novalidate>
					<div class="fitem">
						<label>项目名称:</label> <input name="project_name" />
					</div>
					<div class="fitem">
						<label>项目编号:</label> <input name="project_id" readonly="readonly" />
					</div>
					<div class="fitem">
						<label>主管科室:</label> <input name="department" />
					</div>
					<div class="fitem">
						<label>主管工程师:</label> <input name="project_engineer"/>
					</div>
					<div class="fitem">
						<label>所属领域:</label> <label style="width: 160px;">
							<select id="tech_area" name="tech_area" style="width: 100%; height: 100%;">
								<option value="电子信息">电子信息</option>
		                        <option value="生物医药">生物医药</option>
		                        <option value="新材料">新材料</option>
		                        <option value="先进制造与自动化">先进制造与自动化</option>
		                        <option value="能源与节能">能源与节能</option>
		                        <option value="环境保护">环境保护</option>
		                        <option value="农业">农业</option>
		                        <option value="社会事业">社会事业</option>
		                        <option value="其他">其他</option>
							</select>
					</div>
					<div class="fitem">
						<label>承担单位:</label> <input name="undertake_id"
							class="easyui-validatebox" required="true" />
					</div>
					<div class="fitem">
						<label>开始时间:</label> <input name="project_start"
							class="easyui-datebox" required="true"  data-options="formatter:myformatter,parser:myparser" />
					</div>
					<div class="fitem">
						<label>结束时间:</label> <input name="project_end"
							class="easyui-datebox" required="true" data-options="formatter:myformatter,parser:myparser" />
					</div>
					<div class="fitem">
						<label>项目类型:</label> <input name="project_type"
							class="easyui-validatebox" required="true" />
					</div>
					<div>
						<label><a href="javascript:void(0);"
							class="easyui-linkbutton" iconCls="icon-ok"
							onclick="saveproject_info();">确认</a></label> <label><a href="#"
							class="easyui-linkbutton" iconCls="icon-cancel"
							onclick="javascript:$('#dlg').dialog('close')">取消</a></label>
					</div>
				</form>
			</div>
</div></div>

	<div id="setproject" class="easyui-dialog" style="width: 340px; height: auto; padding: 10px 20px" closed="true">
				<form id="fm3" method="post" action="/modules/php/action/page/projectapp/projectapp.act.php?action=setsavestage" novalidate>
					<div class="fitem left" style="width:100%;">
						<label class="title">项目名称:</label>
						<input name="project_name" readonly  id="project_name"/>
					</div>
					<div class="fitem left" style="width:100%;">
					<label class="title">主管工程师:</label>
					<input name="project_engineer" id="project_engineer" >
					</input>
					</div>
					<div class="fitem left" style="width:100%;">
						<label class="title">主管科室:</label>
						<input name="department" id="b-n1" readonly="readonly"/>
					</div>
					<div class="fitem left" style="width:100%;">
						<label class="title">项目类型:</label>
						<input name="project_type" id="b-n2" readonly="readonly" />
					</div>
					<div class="fitem left" style="width:100%;">
						<label class="title">承担单位:</label>
						<input name="undertake_id" id="b-n3" readonly="readonly"/>
					</div>
					<div class="fitem left" style="width:100%;">
						<label class="title">所属领域:</label>
						<label style="width: 150px;">
							<select id="tech_area" name="tech_area" style="width: 100%; height: 100%;">
								<option value="电子信息">电子信息</option>
		                        <option value="生物医药">生物医药</option>
		                        <option value="新材料">新材料</option>
		                        <option value="先进制造与自动化">先进制造与自动化</option>
		                        <option value="能源与节能">能源与节能</option>
		                        <option value="环境保护">环境保护</option>
		                        <option value="农业">农业</option>
		                        <option value="社会事业">社会事业</option>
		                        <option value="其他">其他</option>
							</select>
						</label> 
					</div>
					
					<div class="fitem left" style="width:100%;">
						<label class="title">开始时间:</label>
						<!--<input name="start_time" class="easyui-datebox" required="true"  data-options="formatter:myformatter,parser:myparser" />-->
						<input name="start_time" class="easyui-datebox" required="true"  data-options="formatter:myformatter,parser:myparser" class="project_start" />
					</div>
					<div class="fitem left">
						<label class="title">结束时间:</label>
						<!--<input name="end_time" class="easyui-datebox" required="true" data-options="formatter:myformatter,parser:myparser"/>-->
						<input name="end_time" class="easyui-datebox" required="true" data-options="formatter:myformatter,parser:myparser" class="project_end"/>
					</div>
					<input name="project_id" type="hidden" id="project_id"/>
					<div class="clear" >
						<div style="margin-left: 50px;">
							<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-ok" onclick="buildproject_save();">确认</a>
							<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#setproject').dialog('close')">取消</a>
						</div>
					</div>
					
				</form>
	</div>
	
	<div id="select_block" class="easyui-dialog" style="width: 340px; height: auto; padding: 10px 20px;" iconcls="icon-search" plain="true" closed="true">
	   <form id="select_info">
			<div class="fitem left">
				<label class="title">项目名称:</label>
				<input class="easyui-validatebox" id="project_name_select"/>
			</div>
			<div class="fitem left">
				<label class="title">项目编号:</label>
				<input class="easyui-validatebox" id="project_id_select"/>
			</div>
			<div class="fitem left">
				<label class="title">主管工程师:</label>
				<input class="easyui-validatebox" id="project_engineer_select"/>
			</div>
			<div class="fitem left">
				<label class="title">项目联系人:</label>
				<input class="easyui-validatebox" id="leader_name_select"/>
			</div>
			<div class="fitem left">
				<label class="title">开始时间:</label>
				<input name="start_time_select" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" class="project_start" />
			</div>
			<div class="fitem left">
				<label class="title">结束时间:</label>
				<input name="end_time_select" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" class="project_end"/>
			</div>
			<div class="clear"></div>
			<div style="text-align:center; margin-top:5px;">
				<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-ok" onclick="select();">确认</a>
				<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#select_block').dialog('close')">取消</a>
			</div>
		</form>
	</div>

		<div id="check_block" class="easyui-dialog" style="width: 340px; height: auto; padding: 10px 20px;" closed="true">
			<div class="" >
				<label class="title">审批意见:</label>
				<textarea class="easyui-validatebox" id="check_opnion" style="width:97%;height:200px;"  class="check_opnion"></textarea>
			</div>

			<div class="clear"></div>
			<div >
				<a  style="margin-left: 45px;" href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-ok"    onclick="batchCheck('yes');">通过</a>
				<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-cancel"  onclick="batchCheck('no');">不通过</a>
			</div>
		</div>

	<!-- 保存用户 小按钮    取消小按钮-->
	<div id="checkPriDlg" title="项目代管设置" data-options="iconCls:'icon-save'"
		 style="width:600px;height:220px;padding:10px">
		<div id="checkPri"></div>
        <div id="checkPri-linkbutton" style="text-align:center; display:none;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="checkUserForDialog()">确认</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="cancelUserForDialog()">清除代管</a>		   
		   <!--<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#checkPriDlg').dialog('close')">取消</a> -->
        </div>   
	</div>

	<!-- 设置主管工程师-->
	<div id="setEngiDlg" title="设置主管工程师" class="easyui-dialog" data-options="iconCls:'icon-save'"
		 style="width:400px;height:140px;padding:10px" closed="true">
		<div class="fitem">
			<label class="title">主管工程师:</label>
			<input class="easyui-validatebox" name="peEdit" id="project_engineer_edit" style="width:250px;"/>
		</div>
        <div id="fitem-linkbutton" style="text-align:center; display:none; margin-top:10px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="setEngiForDialog()">确认</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#setEngiDlg').dialog('close')">取消</a>
		<!--<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#checkPriDlg').dialog('close')">取消</a> -->
        </div>
	</div>

	<!-- 编辑群发短息的内容 -->
	<div id="editSms" class="easyui-dialog" title="编辑短信" data-options="iconCls:'icon-save'" style="width:400px;height:230px;padding:10px" closed="true">
	   <form id="smsInfo">
	       <label class="title" style="display:block; margin-left:5px; line-height:24px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编辑短信内容</label>
	       <textarea id="sms_context" style="width:85%;height:110px;margin-left:20px"></textarea>
	   <div style="height:30px;margin-left:80px; margin-top:10px;">
			<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-ok" onclick="sendSms();">确认</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#editSms').dialog('close')">取消</a>
	   </div>
	   </form>
	</div>
</body>
</html>




