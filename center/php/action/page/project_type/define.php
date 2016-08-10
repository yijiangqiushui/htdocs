<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>自定义项目类型</title>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css"/>

<script type="text/javascript" src="../../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script type="text/javascript" src="../../../../html/view/js/project_type_define.js"></script>
<script type="text/javascript" src="../../../../html/view/js/project_type.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/common.js"></script>

</head>
<body class='easyui-layout'>
	<div id="mm" class="easyui-menu" style="width:120px;">
	  <div onclick="newCat()" class="add_cat" data-options="iconCls:'icon-add'">添加分组</div>
	  <div onclick="editCat()" class="edit_cat" data-options="iconCls:'icon-edit'">编辑分组</div>
	  <div onclick="delCat()" class="remove_cat" data-options="iconCls:'icon-remove'">移除分组</div>
	  <div onclick="get_isDel_cat()" class="reload_cat" data-options="iconCls:'icon-reload'">恢复分组</div>
	</div>
	<!--表结构-->
	<div id="west" data-options="region:'west',title:'部门分类',sqlit:'true'" style="width:200px;padding:5px;" >
		<div style="margin:20px 0;"></div>
		<ul class="easyui-tree">
			<li>
				<span>部门分类</span>
						<span>部门分类</span>
						<ul>
							<li>
								<span><a href="#" onclick="loadPage(0)">发展计划科</a></span>
							</li>
							<li>
								<span><a href="#" onclick="loadPage(1)">科技综合科</a></span>
							</li>
							<li>
								<span><a href="#" onclick="loadPage(2)">知识产权科</a></span>
							</li>
						</ul>
					</li>
			</ul>
	</div>
	<div id='center' data-options="region:'center',split:true">
		<div id="p" class="easyui-panel" title="自定义项目类型" style="width:500px;height:150px;padding:10px;background:#fafafa;"
				data-options="collapsible:true,fit:true">
			<div style="padding:10px 60px 20px 60px">
				<form id="ff" method="post">
					<table cellpadding="5">
						<?php if($is_super){ ?>
						<tr>
							<td>所属科室:</td>
							<td>
								<select class="dp_id" name="dpid">
									<?php
									foreach($departments as $key=>$val){
										if($val['status'] != -1){
											echo '<option value="'.$key.'">'.$val['name'].'</option>';
										}
									}
									?>
								</select>
							</td>
						</tr>
						<?php } ?>
						<tr>
							<td>项目类型:</td>
							<td>
								<select class="pt_fid" name="ptid">
									<option value="0"><span style="color:#f00">自定义类型</span></option>
									<?php
									foreach($project_types as $key=>$val){
										echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
									}
									?>
								</select>
							</td>
							
						</tr>

						<tr>
							<td>项目类型名称:</td>
							<td><input class="easyui-textbox nptname" type="text" name="ptname" data-options="required:true"></input></td>
							
						</tr>
						
						<tr>
							<td>可创建子项目:
							</td>
							<td><input type="checkbox" id="children" name="children" data-options="required:true" value="0"></input>是</td>
						</tr>
						<tr style="display: none;">
							<td>子项类型名称:</td>
							<td><input id="pt_child_name" class="easyui-textbox nptname" type="text" name="pt_child_name" data-options="required:true" ></input></td>
						</tr>
						<tr>
							<td>申报流程:</td>
							<td>
								<div>
									<label><input name="Fruit" type="checkbox" value="0" />申报阶段 </label>
									（
									<?php $i = 0;  foreach($table_types[0] as $item){
										if($i&&($i%2 == 0)){
												echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										}
										$i++;
									?>
									<label><input name="table_list" type="checkbox" value="<?php echo $item['id']; ?>" /><?php echo $item['name']; ?> </label>
									<?php 
									} ?>
									）
								</div>
								<div>
									<label><input name="Fruit" type="checkbox" value="1" />立项阶段 </label>
									（
									<?php $i = 0; foreach($table_types[1] as $item){
										if($i&&($i%2 == 0)){
												echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										}
										$i++;
									?>
									<label><input name="table_list" type="checkbox" value="<?php echo $item['id']; ?>" /><?php echo $item['name']; ?> </label>
									<?php 
									} ?>
									）
								</div>
								<div>
									<label><input name="Fruit" type="checkbox" value="2" />实施阶段 </label>
									（
									<?php $i = 0; foreach($table_types[2] as $item){ 
										if($i&&($i%2 == 0)){
												echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										}
										$i++;
									?>
									<label><input name="table_list" type="checkbox" value="<?php echo $item['id']; ?>" /><?php echo $item['name']; ?> </label>
									<?php } ?>
									）
								</div>
								<div>
									<label><input name="Fruit" type="checkbox" value="3" />验收阶段 </label>
									（
									<?php $i = 0; foreach($table_types[3] as $item){ 
										if($i&&($i%2 == 0)){
												echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										}
										$i++;
									?>
									<label><input name="table_list" type="checkbox" value="<?php echo $item['id']; ?>" /><?php echo $item['name']; ?> </label>
									<?php
									} ?>
									）
								</div>
							</td>
						</tr>
						<!--<tr>
							<td>需要调整的文件：</td>
							<td>
								<label><input name="changeFile1" type="checkbox" value="ssfa" />实施方案 </label>
								<label><input name="changeFile2" type="checkbox" value="rws" />任务书 </label>
							</td>
						</tr>-->
						
						<tr><td colspan="2">
							<div style="text-align:center;padding:5px">
								<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">提交</a>
							<!--	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">重置</a>  -->
							</div>
						</td></tr>
					</table>
				</form>
				
			</div>
		</div>
	</div>  
</body>
</html>