var url;
var upid=0;
//var uptext='顶级';
var uptext='',upCat='',upIsLast,upCagory,exclusive_name='',admin_name;
var edtid,edtUpperID;
var usr,isForbidden;
var pridge;
var isDel=0;
var timer = 0;
$(window).resize(function(){
    clearTimeout(timer);
    timer = setTimeout(function() {
		$('#admingrid').datagrid('resize');
    }, 200);
});

$(function(){
	init();
});

function init(){
	$('body').css('display','none');
	$.get('../../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		admin_name=data;
		$('body').css('display','block');
		if(data=='super'){
			$('#back_loadPage').css({'display':'none'});
			$('#muti_back').css({'display':'none'});
			$("a[onclick='queryAdmin()']").css('display','block');
			$("a[onclick='newAdmin()']").css('display','block');
			$("a[onclick='delArrAdmin()']").css('display','block');
			$("a[onclick='disableAdmin(0)']").css('display','block');
			$("a[onclick='disableAdmin(1)']").css('display','block');
			$("a[onclick='get_isDel()']").css('display','block');

			loadTree();
			loadPage();
		}else{
			if(data.indexOf('admininfo_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');
			}else{
				if(data.indexOf('admininfo_del')<0){
						$("a[onclick='delArrAdmin()']").css('display','none');			
				}else{
						$("a[onclick='delArrAdmin()']").css('display','block');			
				}
				if(data.indexOf('admininfo_add')<0){
						$("a[onclick='newAdmin()']").css('display','none');			
				}else{
						$("a[onclick='newAdmin()']").css('display','block');			
				}
				if(data.indexOf('admininfo_disable')<0){
						$("a[onclick='newAdmin()']").css('display','none');			
				}else{
						$("a[onclick='newAdmin()']").css('display','block');			
				}
				if(data.indexOf('admininfo_enable')<0){
						$("a[onclick='disableAdmin(0)']").css('display','none');		
				}else{
						$("a[onclick='disableAdmin(0)']").css('display','block');		
				}
				$("a[onclick='get_isDel()']").css('display','none');
				loadTree()				
				loadPage();
			}	
		}
	});
	/**$(window).resize(function(){
		setTimeout("reSize()",200); 
	});*/
	$.post('../../../../../center/php/action/page/ukeyOption.act.php?action=getUsr',function(result){
		if(result==2){
			var browser = DetectBrowser();
			if(browser == "Unknown")
			{
				alert("不支持该浏览器， 如果您在使用傲游或类似浏览器，请切换到IE模式");
				return ;
			}
			//createElementIA300() 对本页面加入IA300插件
			   
			createElementNT199();
			//DetectActiveX() 判断IA300Clinet是否安装
			var create = DetectNT199Plugin();
			if(create == false)
			{
				alert("插件未安装,,请直接安装CD区的插件!");
				return false;
			}
			self.setInterval("findNT199()",1000);
		}
	});
}
function reSize(){
	$('#admingrid').datagrid('resize', { 
        width : $('#center').width()<960?960:$('#center').width()
    });  
}
//加载树结构
function loadTree(){
	$("#treeData").tree({
		url:'../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name=admincat',
		checkbox:false,
		animate:true,
		lines:false,
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name=admincat&up_id='+node.id;
		},
		onClick:function(node){
			if(isDel==1){
				loadPage();
			}
			upid=node.id;
			uptext=node.text;
			upCat=node.upperCat;
			upIsLast=node.isLast;
			exclusive_name=node.exclusive_name;
			if(node.id=='0'){
				upCagory='.';
			}else{
				upCagory=node.upperCat+node.id+'.';
			}
			$('#admingrid').datagrid('load',{'upCagory':upCagory});
		},
		onContextMenu:function(e, node){
			e.preventDefault();
			// 查找节点
			$('#treeData').tree('select', node.target);
			// 显示快捷菜单
			upid=node.id;
			uptext=node.text;
			upcat=node.upper_cat;
			is_leaf=node.is_leaf;
			//$('.add_cat').attr({'onClick':'append('+node.id+')'});
			//$('.remove_cat').attr({'onClick':'remove('+node.id+')'});
			if(pridge!='super'){
				if(pridge.indexOf('admincat_query')<0){
					$("div[onclick='newCat()']").css('display','none');			
					$("div[onclick='editCat()']").css('display','none');			
					$("div[onclick='delCat()']").css('display','none');			
				}else{
					if(pridge.indexOf('admincat_add')<0){
						$("div[onclick='newCat()']").css('display','none');			
					}
					if(pridge.indexOf('admincat_edit')<0){
						$("div[onclick='editCat()']").css('display','none');			
					}
					if(pridge.indexOf('admincat_del')<0){
						$("div[onclick='delCat()']").css('display','none');			
					}
				}	
				$("div[onclick='get_isDel_cat()']").css('display','none');			
			}else{
				if(upid==0){
					$("div[onclick='get_isDel_cat()']").css('display','block');			
				}else{
					$("div[onclick='get_isDel_cat()']").css('display','none');			
				}
			}
			$('#mm').menu('show', {
				left: e.pageX,
				top: e.pageY,
			});
		},

	});
}
//添加分组
function newCat(){
	$('#new_catDlg').dialog('open').dialog('setTitle','添加信息');
	$('#new_catfm').form('clear');
	$('#pid').val(upid);
	get_cat("#pritree1",'admincat');
	$('#new_catfm').form('load',{'pritree1':upid});
	url = '../../../../php/action/page/admin/admincat.act.php?action=add';
}

function saveNewCat(){
	$('#new_catfm').form('submit',{
		url:url,
		success: function(result){
			$('#new_catDlg').dialog('close');        
			if(upid==0){
				loadTree();
			}else{
				var node=$("#treeData").tree('find',upid);
				result=eval('('+result+')');
				$("#treeData").tree('append',{
					parent:node.target,
					data:result	
				});
			}
		}
	});
}

//树形下拉菜单
function get_cat(str,str_name){
		$(str).combotree({
			url:'../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name='+str_name,
			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=treeData&up_id='+node.id+'&table_name='+str_name;
			},
			onClick:function(node){
				$('#pid').val(node.id);
			},
			onLoadSuccess:function(node,data){
				$(str).combotree('tree').tree('expandAll');	
			}	
		});
}

//修改分组
function editCat(){
	$.get( '../../../../php/action/page/admin/admincat.act.php?action=findbyid&id='+upid,function(data){
		$('#edit_catform').form('clear');	
		get_cat("#pritree",'admincat');		
		var res=eval("("+data+")");	
		
		$('#edit_catDlg').dialog('open').dialog('setTitle','编辑信息');
		$('#edit_catform').form('load',res);
		$('#edit_catform').form('load',{'pritree':res.upperID});
		edtid=upid;
	
	});
}
	
function saveEditCat(){
	$('#edit_catform').form('submit',{
		url:'../../../../php/action/page/admin/admincat.act.php?action=saveEdtEle&id='+edtid,
		success: function(result){
			var node=$("#treeData").tree('find',upid);
			result=eval('('+result+')');
			if(result=='error'){
				alert('不能编辑到分组本身下！');
				return;
			}
			$('#edit_catDlg').dialog('close');        				
			if(result[0].upperID==upid){
				if(upid!=0){
					var node=$("#treeData").tree('find',upid);
					$("#treeData").tree('reload',node.target);	
				}else{
					loadTree('admincat');	
				}
			}else{
				if(upid==0||result[0].upperID==0){
					loadTree('admincat');
				}else{
					var oldnode=$("#treeData").tree('find',edtid);
					$("#treeData").tree('remove',oldnode.target);
					var n=$("#treeData").tree('find',result[0].upperID);
					$("#treeData").tree('append',{
						parent:n.target,
						data:result	
					});
				}
			}
				edtid=null;
			}
	 });
}
//删除分组
function delCat(){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/admin/admincat.act.php?action=delEle&id='+upid,function(){						
				var node=$("#treeData").tree('find',upid);
				$("#treeData").tree('remove',node.target);
				loadPage();
			});					 
		}
	});         
}


//加载datagrid表格数据
function loadPage(){
	var title='用户信息';
	isDel=0;
	$('#admingrid').datagrid({
		//height:250,
		title:title,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		//fit:true,
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
					
		remoteSort : false,
		toolbar:'#toolbar',
				   
		url:'../../../../php/action/page/admin/admininfo.act.php?action=queryAdmin&isDel=0',//url调用Action方法
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'realname',title:'真实姓名',width:100,align:'center'},
			//{field:'usr',title:'用户名',width:10},
			{field:'phone',title:'联系方式',width:100,align:'center'},
			{field:'email',title:'E-MAIL',width:150,align:'center'},
			//{field:'qq',title:'QQ',width:10},
			//{field:'userPrivileges',title:'权限',width:100,align:'center'},
			{field:'isForbidden',title:'是否禁用',width:80,align:'center',
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='启用';
					}else{
						s='禁用';
					}
					return s;
				}},
			//{field:'addedDate',title:'添加时间',align:'center'},
			
			{field:'action',title:'操作',align:'center',width:100,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="editAdmin('+row.id+')">编辑</a>';
					var b=' | <a href="javascript:void(0)" onclick="delAdmin('+row.id+')"> 删除</a>';							
					var rn='';
					if(pridge=='super'){
							rn=a+b;
					}else{
						if(pridge.indexOf('admininfo_edit')>=0){
							rn+=a;
						}
						if(pridge.indexOf('admininfo_del')>=0){
							rn+=b;
						}
					}
					if(rn==''){
						rn='无操作权限';	
					}
					return rn;
				}
			}															
		]],
		/**onLoadSuccess: function () {
			reSize();
    	return true;
  	}	*/					  
	});
				
	var p = $('#admingrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});   					
	$('#muti_back').css({'display':'none'});
	$('#back_loadPage').css({'display':'none'});
}




//添加按钮事件
function newAdmin(){
	if(upid==0){
		alert('请选择用户分组');
		return;
	}
	$('#newdlg').dialog('open').dialog('setTitle','添加信息');
	if(exclusive_name=='leader'){
		$('.managerBm').html('<td>所管部门：</td>\
      <td colspan="3"><input id="managerMoreBm" class="easyui-combox" style="width:420px;" /></td>'
		);
		//$('.privileges').css('display','none');
		if($(window).height()<$('#newdlg').height()){
			$('#newdlg').dialog('close');
			$('#newdlg').css({'height':$(window).height()-60,'overflow-y':'auto','margin-top':'60px'});
			$('#newdlg').dialog('open').dialog('setTitle','添加信息');
		}else{
			$('#newdlg').dialog('close');
			$('#newdlg').css({'height':''});
			$('#newdlg').dialog('open').dialog('setTitle','添加信息');
		}
		$('.managerKs').html('');
		getBmList('managerMoreBm','admincat','new',0);
	}else{
		$('.privileges').css('display','');
		if($(window).height()<$('#newdlg').height()){
			$('#newdlg').dialog('close');
			$('#newdlg').css({'height':$(window).height()-60,'overflow-y':'auto','margin-top':'60px'});
			$('#newdlg').dialog('open').dialog('setTitle','添加信息');
		}
		$('.managerBm').html('');
		$('.managerKs').html('<td>管理科室：</td>\
        <td><input type="checkbox" class="loadPri0" onchange="loadPri(0)" /></td>'
		);
	}
	$('#newfm').form('clear');
	$('#newfm').form('load',{'isForbidden':'0'});
	if(upid==0){
		$('#pcat').val('.');
	}else{
		$('#pcat').val(upCat+upid+'.');
	}
	$('#up_id').val(upid);
	$('#ptext').val(uptext);
	//getCatList('concat_role','admincat');
	getMemberCatList('admincat_role','admincat');
	url = '../../../../php/action/page/admin/admininfo.act.php?action=saveAdmin';
}

function loadPri(newEdit){
	if(newEdit==0){
		if($('.loadPri0')[0].checked==true){
			$.get('../../../../php/action/page/admin/admininfo.act.php?action=getPri&id='+upid+'&newEdit='+newEdit,function(data){
				var res=eval("("+data+")");
				if(res.userPrivileges==null){
					alert('未选择分类！');
					return;
				}
				$('#newfm').form('load',res);
				//getCatList('concat_role','admincat');
				getMemberCatList('admincat_role','admincat');
				var temp = res.userPrivileges.split(',');
				if(temp.length>=2)
				if(temp[1].indexOf('concats_')>-1)
					$('#newfm').form('load',{'concat_role':temp[1].split('_')[1]});
				if(temp[2].indexOf('admincats_')>-1)
					$('#newfm').form('load',{'role':'.'+upid});
					//$('#newfm').form('load',{'role':temp[2].split('_')[1]});
			})
		}else{
			newAdmin();
		}
	}else{
		if($('.loadPri1')[0].checked==true){
			$.get('../../../../php/action/page/admin/admininfo.act.php?action=getPri&id='+edtUpperID+'&newEdit='+newEdit,function(data){
				var res=eval("("+data+")");
				$('#edtdlgfm').form('load',res);
				//getCatList('concat_role1','admincat');
				getMemberCatList('admincat_role1','admincat');
				if(res.userPrivileges!=null){
					var temp = res.userPrivileges.split(',');
					if(temp.length>=2)
					if(temp[1].indexOf('concats_')>-1)
						$('#edtdlgfm').form('load',{'concat_role':temp[1].split('_')[1]});
					if(temp[2].indexOf('admincats_')>-1)
						$('#edtdlgfm').form('load',{'role':temp[2].split('_')[1]});
				}
			})
		}else{
			//editAdmin(edtid)
		}
	}
}
	
//添加用户
function saveAdmin(){
	if($('input[name="pwd"]').val()==''&&$('input[name="ntid"]').val()==''){
		alert('请输入设备ID或者密码！');
		return;
	}
	if($('input[name="pwd"]').val()!=$('input[name="repwd"]').val()){
		alert('两次输入的密码不一致，请重新输入！');
		return;
	}
	
	//$('#pid').val(upid);
	var pdg="priviliges,";
	//var concat_role=$('#concat_role').combotree('getValue');
	var admincat_role=$('#admincat_role').combotree('getValue');
	var leader_pdg='priviliges,concats_,admincats_';
	leader_pdg+=',file_query,seal_query,sms_query,sms_reply';
	pdg+='concats_'+upCat+upid+',admincats_'+admincat_role+',';
	var exclusive='';
	$("#newfm input[type=checkbox]").each(function(){
		if($(this).val()!='on'){
			if($(this).prop("checked")){
				if($(this).val()=='drafter'){
					exclusive+=$(this).val()+',';
				}
				if($(this).val()=='sealer'){
					exclusive+=$(this).val()+',';
				}
				pdg+=$(this).val()+",";	
			}	
		}
	});
	$("input[name=exclusiveName]").val(exclusive);
	pdg=pdg.substring(0,pdg.length-1);
	//var leader_pdg='priviliges,concats_,admincats_';
	//leader_pdg+=',concat_query,file_query,seal_query,sms_query,sms_reply';
	leader_pdg=pdg;
	/*if($('.loadPri0')[0].checked==true){
		
	}*/
	//根据是否为领导进行权限赋予
	if(exclusive_name!='leader'){
		$("#pridge").val(pdg);
	}else{
		var managerMoreBm=$("#managerMoreBm").combobox('getValues');
		$('#managerMoreBm0').val(managerMoreBm);
		$("#pridge").val(leader_pdg);
	}
	if($('.loadPri0').prop("checked")){
		$('#isManager0').val(1);
	}else{
		$('#isManager0').val(0);
	}
	//alert($("#pridge").val());return;
	$('#newfm').form('submit',{
		url:url,
		success:function(result){
			if(result=='notnull'){
				alert('该用户名已存在！');	
			}else{
				$('#newdlg').dialog('close');
				$('#admingrid').datagrid('load',{'upCagory':upCagory});
			}
		}
	});
}


//编辑用户
function editAdmin(id){
	edtid=id;
	$.get('../../../../php/action/page/admin/admininfo.act.php?action=getAdmin&id='+id,function(data){
		var res=eval("("+data+")");
		//var res=data;
		edtUpperID=res.upperID;
		loadcombotree(res);
		$('#edtdlg').dialog('open').dialog('setTitle','修改信息');
		//$('#edtdlgfm').form('load',{'pritree':res.upperID});
		if(res.exclusive_name=='leader'){
			exclusive_name='leader';
			
			//$('.privileges').css('display','none');
			if($(window).height()<$('#edtdlg').height()){
				$('#edtdlg').dialog('close');
				$('#edtdlg').css({'height':$(window).height()-60,'overflow-y':'auto','margin-top':'60px'});
				$('#edtdlg').dialog('open').dialog('setTitle','修改信息');
			}else{
				$('#edtdlg').dialog('close');
				$('#edtdlg').css({'height':''});
				$('#edtdlg').dialog('open').dialog('setTitle','修改信息');
			}
			$('#edtdlgfm').form('clear');
			$('#edtdlgfm').form('load',res);
			
			$('.managerBm1').html('<td>所管部门：</td>\
				<td colspan="3"><input id="managerMoreBm1" name="managerMoreBm1" class="easyui-combox" style="width:420px;" /></td>'
			);
			$('.managerKs1').html('');
			getBmList('managerMoreBm1','admincat','edit',res);
			//$('#managerMoreBm1').combotree('setValues',res.managerMoreBm.split(','));
		}else{
			exclusive_name='';
			
			$('.privileges').css('display','');
			if($(window).height()<$('#edtdlg').height()){
				$('#edtdlg').dialog('close');
				$('#edtdlg').css({'height':$(window).height()-60,'overflow-y':'auto','margin-top':'60px'});
				$('#edtdlg').dialog('open').dialog('setTitle','添加信息');
			}
			$('#edtdlgfm').form('clear');
			$('#edtdlgfm').form('load',res);
			
			$('.managerBm1').html('');
			$('.managerKs1').html('<td>管理科室：</td>\
					<td><input type="checkbox" class="loadPri1" onchange="loadPri(1)" /></td>'
			);
			if(res.isManager==1){
				$('.loadPri1')[0].checked=true;
			}
		}
		//getCatList('concat_role1','admincat');
		getMemberCatList('admincat_role1','admincat');
		if(res.userPrivileges!=null){
			var temp = res.userPrivileges.split(',');
			if(temp.length>=2)
			if(temp[1].indexOf('concats_')>-1)
				$('#edtdlgfm').form('load',{'concat_role':temp[1].split('_')[1]});
			if(temp[2].indexOf('admincats_')>-1)
				$('#edtdlgfm').form('load',{'admincat_role':temp[2].split('_')[1]});
		}
		url='../../../../php/action/page/admin/admininfo.act.php?action=updateAdmin&id='+id
	});
}

function updateAdmin(){
	url=url+'&upper_id='+$('#catTree').combobox('getValues');
	var pdg="priviliges,";
	//var concat_role=$('#concat_role1').combotree('getValue');
	//var concat_role=$('#catTree').combobox('getValues');
	var concat_role=$('#upCat').val();
	concat_role=concat_role.substring(0,concat_role.length-1);
	var admincat_role=$('#admincat_role1').combotree('getValue');
	pdg+='concats_'+concat_role+',admincats_'+admincat_role+',';

	var exclusive='';

	$("#edtdlgfm input[type=checkbox]").each(function(index){
		if($(this).val()!='on'){
			if($(this).prop("checked")){
				if($(this).val()=='drafter'){
					exclusive+=$(this).val()+',';
				}
				if($(this).val()=='sealer'){
					exclusive+=$(this).val()+',';
				}
				pdg+=$(this).val()+",";	
			}	
		}
	});
	$("input[name=exclusiveName]").val(exclusive);
	
	pdg=pdg.substring(0,pdg.length-1);
	
	var leader_pdg='';
	//var leader_pdg='priviliges,concats_,admincats_';
	//leader_pdg+=',concat_query,file_query,seal_query,sms_query,sms_reply';
	leader_pdg+=pdg;
	
	//if($("#managerMoreBm1").val()!=''||$("#managerMoreBm1").val()!=undefined){
	if(exclusive_name!='leader'){
		if(concat_role==''){
			alert('请在"用户权限"的"审批管理"下选择"所属部门"');
			return;
		}else{
			$("#pridge2").val(pdg);
		}
	}else{
		var managerMoreBm=$("#managerMoreBm1").combobox('getValues');
		$('#managerMoreBm2').val(managerMoreBm);
		$("#pridge2").val(leader_pdg);
	}

	if($('.loadPri1').prop("checked")){
		$('#isManager1').val(1);
	}else{
		$('#isManager1').val(0);
	}
	if($('#newpwd').val()!=$('#confirmpwd').val()){
		alert('两次输入的密码不一致，请重新输入！');
		return;
	}
	$('#edtdlgfm').form('submit',{
		url:url,
		//onSubmit:function(){},
		success:function(result){
			$('#edtdlg').dialog('close');
			$('#admingrid').datagrid('load',{'upCagory':upCagory});
		}
	});
}

//获取部门列表

function getBmList(str,str_table,new_edit,res){
	$('#'+str).combotree({
			//url: '../../../../php/action/page/smslist/smslistinfo.act.php?action=getMyList&table_name='+str_table,
			url: '../../../../php/action/page/admin/admincat.act.php?action=get_content_tree&table_name='+str_table,
			checkbox:false,
			animate:true,
			lines:false,
			multiple: true,

			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=get_content_tree&up_id='+node.id+'&table_name='+str_table;
				//$(this).tree('options').url='../../../../php/action/page/smslist/smslistinfo.act.php?action=getMyList&up_id='+node.id+'&table_name='+str_table;
			},
			onLoadSuccess: function (node,data) {
				$('#'+str).combotree('tree').tree("expandAll");
				if(new_edit=='edit') 
				$('#managerMoreBm1').combotree('setValues',res.managerMoreBm.split(','));
			},
			onClick:function(node){
				$(this).tree('expand',node.target);
			}
		});
}

//获取管理分类列表
function getCatList(str,str_table){
	$('#'+str).combotree({
			url: '../../../../php/action/page/admin/admincat.act.php?action=content_tree&table_name='+str_table,
			checkbox:false,
			animate:true,
			lines:false,

			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=content_tree&up_id='+node.id+'&table_name='+str_table;
			},
			onLoadSuccess: function (node, data) {
				$('#'+str).combotree('tree').tree("expandAll"); 
			},
			onClick:function(node){
				$(this).tree('expand',node.target);
			}
		});
}

//获取用户管理分类列表
function getMemberCatList(str,str_table){
	$('#'+str).combotree({
			url: '../../../../php/action/page/admin/admincat.act.php?action=tree&table_name='+str_table,
			checkbox:false,
			animate:true,
			lines:false,

			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=tree&up_id='+node.id+'&table_name='+str_table;
			},
			onLoadSuccess: function (node,data) {
				$('#'+str).combotree('tree').tree("expandAll"); 
				$('#newfm').form('load',{'role':upid});
			},
			onClick:function(node){
				$(this).tree('expand',node.target);
			}
		});
}

//删除用户
function delAdmin(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/admin/admininfo.act.php?action=delAdmin&id='+id,function(data){						
				$('#admingrid').datagrid('reload',{'upCagory':upCagory});                      
			});					 
		}
	});   
}

//批量删除用户
function delArrAdmin(){
	var rows = $("#admingrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;
		}
		$.messager.confirm('消息提示','确定删除吗？',function(r){
			if(r){
				$.get('../../../../php/action/page/admin/admininfo.act.php?action=delArrAdmin&arrId='+list,function(data){
					$('#admingrid').datagrid('reload',{'upCagory':upCagory});
				});
			}
		});
	}
}

//树形下拉菜单
function loadcombotree(res){
	$("#catTree").combotree({
		url:'../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name=admincat',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name=admincat&up_id='+node.id;
		},
		onClick:function(node){
			$('#upCat').val(node.upperCat+node.id+'.');
		},
		onLoadSuccess: function (node, data) {
			//var n=$('#catTree').combotree('tree').tree("find",up); 
			//$('#catTree').combotree('tree').tree("expand",n.target);
			$('#catTree').combotree('tree').tree("expandAll"); 
		}
	});
}

//查询信息
function queryAdmin(){
	$('#quedlg').dialog('open').dialog('setTitle','查询');
	$('#quefm').form('clear');
	$('#quefm').form('load',{'isForbidden':'0','isDel':'0'});
}

function findAdmin(){
	usr=$('#username').val();
	isForbidden=$("input[name=isForbidden]:checked").val();
	$('#admingrid').datagrid('reload',{usr:usr,isForbidden:isForbidden,upCagory:upCagory,isDel:0});
	$('#quedlg').dialog('close');
}

//禁用操作
function disableAdmin(flag){
	var str;
	var rows = $("#admingrid").datagrid("getChecked");
			
	if(rows.length==0){
		if(flag=='0'){
			str='请选择要启用的数据信息';
		}else{
			str='请选择要禁用的数据信息';
		}
		$.messager.alert('消息提示',str,'info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}	
		if(flag=='0'){
			str='确定启用吗？';
		}else{
			str='确定禁用吗？';
		}
		$.messager.confirm('消息提示',str,function(r){
		   if (r){
				$.get( '../../../../php/action/page/admin/admininfo.act.php?action=disableAdmin&idlist='+list+'&flag='+flag,function(data){			
				   $('#admingrid').datagrid('reload');
				});					 
			}
		});
	}
}

function get_isDel(){
	var title='用户信息';
	title='已删除信息';
	isDel=1;
	$('#admingrid').datagrid({
		//height:250,
		title:title,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
					
		remoteSort : false,
		toolbar:'#toolbar',
				   
		url:'../../../../php/action/page/admin/admininfo.act.php?action=queryAdmin&isDel=1',//url调用Action方法
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			//{field:'usr',title:'用户名',width:100},
			{field:'realname',title:'真实姓名',width:100},
			{field:'phone',title:'联系方式',width:100},
			{field:'email',title:'E-MAIL',width:100},
			//{field:'qq',title:'QQ',width:100},
			{field:'isForbidden',title:'是否禁用',width:100,
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='启用';
					}else{
						s='禁用';
					}
					return s;
				}},
			{field:'addedDate',title:'添加时间',width:150},
			
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="uptisDel('+row.id+')">恢复数据</a>';
					var rn='';
					if(pridge=='super'){
							rn=a;
					}else{
							if(pridge.indexOf('admininfo_del')>=0){
								rn+=a;
							}
						}
							
					return rn;
				}
			}															
		]],
		onLoadSuccess: function () {
			reSize();
			return true;
		}						  
	});
				
	var p = $('#admingrid').datagrid('getPager');			  
	$(p).pagination({  
		pageSize: 15,  
		pageList: [5,10,15,20,30],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});   
	if(admin_name=='super'){					
		$('#muti_back').css({'display':'block'});
		$('#back_loadPage').css({'display':'block'});
		$('#muti_back').unbind();
		$('#muti_back').bind('click',function(){
			uptisDelList();
		});
	}
}

function uptisDel(id){
	$.messager.confirm('提示信息','确定恢复吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/admin/admininfo.act.php?action=uptisDel&id='+id,function(){
					loadPage();
					return;				
					$('#admingrid').datagrid('reload');
			});					 
		}
	});         
}

function uptisDelList(){
	var rows = $("#admingrid").datagrid("getChecked");
			
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要恢复的数据信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}
				
		$.messager.confirm('消息提示','确定恢复吗？',function(r){
			if (r){
				$.get( '../../../../php/action/page/admin/admininfo.act.php?action=uptisDelList&idlist='+list,function(data){	
					loadPage();
					return;					
					$('#admingrid').datagrid('reload');
				});					 
			}
		});
	}
}
//权限的正选与反选
function bm_all(flag){
	var len=$('.bm_role'+flag).length;
	if($('.bm_concat'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
   		$('.bm_role'+flag)[i].checked = true;
  	}
	}else{
		for(var i=0;i<len;i++){
   		$('.bm_role'+flag)[i].checked = false;
  	}
	}
}

function getDrafterPri(flag){
	var len=$('.file_role'+flag).length;
	if($('.drafter'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
			if(i!=4&&i!=9&&i!=10)
   		$('.file_role'+flag)[i].checked = true;
  	}
	}else{
		for(var i=0;i<len;i++){
			if(i!=4&&i!=9&&i!=10)
   		$('.file_role'+flag)[i].checked = false;
  	}
	}
}

function getMakerPri(flag){
	var len=$('.file_role'+flag).length;
	if($('.maker'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
			if(i==1||i==4||i==5||i==6||i==9)
   		$('.file_role'+flag)[i].checked = true;
  	}
	}else{
		for(var i=0;i<len;i++){
			if(i==1||i==4||i==5||i==6||i==9)
   		$('.file_role'+flag)[i].checked = false;
  	}
	}
}

function file_all(flag){
	var len=$('.file_role'+flag).length;
	if($('.file_concat'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
   		$('.file_role'+flag)[i].checked = true;
  	}
	}else{
		for(var i=0;i<len;i++){
   		$('.file_role'+flag)[i].checked = false;
  	}
	}
}

function seal_all(flag){
	var len=$('.seal_role'+flag).length;
	//if($('.seal_concat'+flag)[0].checked==true){
	if($('.sealer'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
			if(i!=1&&i!=2){
   			$('.seal_role'+flag)[i].checked = true;
			}
  	}
	}else{
		for(var i=0;i<len;i++){
			if(i!=1&&i!=2){
   			$('.seal_role'+flag)[i].checked = false;
			}
  	}
	}
}

function sms_all(flag){
	var len=$('.sms_role'+flag).length;
	if($('.sms_concat'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
   		$('.sms_role'+flag)[i].checked = true;
  	}
	}else{
		for(var i=0;i<len;i++){
   		$('.sms_role'+flag)[i].checked = false;
  	}
	}
}

function listcat_all(flag){
	var len=$('.listcat_role'+flag).length;
	if($('.listcat_concat'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
   		$('.listcat_role'+flag)[i].checked = true;
  	}
	}else{
		for(var i=0;i<len;i++){
   		$('.listcat_role'+flag)[i].checked = false;
  	}
	}
}

function listinfo_all(flag){
	var len=$('.listinfo_role'+flag).length;
	if($('.listinfo_concat'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
   		$('.listinfo_role'+flag)[i].checked = true;
  	}
	}else{
		for(var i=0;i<len;i++){
   		$('.listinfo_role'+flag)[i].checked = false;
  	}
	}
}

function admincat_all(flag){
	var len=$('.admincat_role'+flag).length;
	if($('.admincat_concat'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
   		$('.admincat_role'+flag)[i].checked = true;
  	}
	}else{
		for(var i=0;i<len;i++){
   		$('.admincat_role'+flag)[i].checked = false;
  	}
	}
}

function admininfo_all(flag){
	var len=$('.admininfo_role'+flag).length;
	if($('.admininfo_concat'+flag)[0].checked==true){
		for(var i=0;i<len;i++){
   		$('.admininfo_role'+flag)[i].checked = true;
  	}
	}else{
		for(var i=0;i<len;i++){
   		$('.admininfo_role'+flag)[i].checked = false;
  	}
	}
}

function check_isAll(flag,str){
	var len=$('.'+str+'_role'+flag).length;
	var isAll=0;
	if(str=='file'){
		var drafter_flag=true;
		var maker_flag=true;
		for(var i=0;i<len;i++){
			if(i!=4&&i!=6&&i!=9&&i!=10){
				if($('.'+str+'_role'+flag)[i].checked != true){
					drafter_flag=false;
					break;
				}
			}
		}
		for(var i=0;i<len;i++){
			if(i==1||i==4||i==5||i==6||i==9){
				if($('.'+str+'_role'+flag)[i].checked != true){
					maker_flag=false;
					break;
				}
			}
		}

		if(drafter_flag){
			$('.drafter'+flag)[0].checked=true;
		}else{
			$('.drafter'+flag)[0].checked=false;
		}
		if(maker_flag){
			$('.maker'+flag)[0].checked=true;
		}else{
			$('.maker'+flag)[0].checked=false;
		}
	}else{
		for(var i=0;i<len;i++){
			if($('.'+str+'_role'+flag)[i].checked == true){
				isAll++;
			}else{
				break;
			}
		}
		if(isAll==len){
			$('.'+str+'_concat'+flag)[0].checked=true;
		}else{
			$('.'+str+'_concat'+flag)[0].checked=false;
		}
	}
}


function get_isDel_cat(){
	var title='用户信息';
	title='已删除分组';
	$('#admingrid').datagrid({
		title:title,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
					
		remoteSort : false,
		toolbar:'#toolbar',
		
		url:'../../../../php/action/page/admin/admincat.act.php?action=show&isDel=1',//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'catName',title:'名称',width:100},
			{field:'isForbidden',title:'是否禁用',width:100},
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="uptisDelcat('+row.id+')">恢复数据</a>';
					var rn='';
					if(pridge=='super'){
						rn=a;
					}else{
						if(pridge.indexOf('admincat_del')>=0){
							rn+=a;
						}
					}
					return rn;	
				}
			}															
		]],	
		onLoadSuccess: function () {
			reSize();
			return true;
		}						  
	});
		
	var p = $('#admingrid').datagrid('getPager');			  
	$(p).pagination({  
		pageSize: 15,  
		pageList: [5,10,15,20,30],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	}); 	
	$('#back_loadPage').css({'display':'block'});
	$('#muti_back').css({'display':'block'});
	$("a[onclick='queryAdmin()']").css('display','none');
	$("a[onclick='newAdmin()']").css('display','none');
	$("a[onclick='delArrAdmin()']").css('display','none');
	$("a[onclick='disableAdmin(0)']").css('display','none');
	$("a[onclick='disableAdmin(1)']").css('display','none');
	$("a[onclick='get_isDel()']").css('display','none');
	$('#muti_back').unbind();
	$('#muti_back').bind('click',function(){
		uptisDelCatList();
	});
}

function uptisDelcat(id){
	$.messager.confirm('提示信息','确定恢复吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/admin/admincat.act.php?action=uptisDel&id='+id,function(){
					loadTree();						
					loadPage();
					return;			
					$('#admingrid').datagrid('reload');
					var node=$("#treeData").tree('find',id);
					$("#treeData").tree('add',node.target);
			});					 
		}
	});         
}

function uptisDelCatList(){
	var rows = $("#admingrid").datagrid("getChecked");
			
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要恢复的数据信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}
				
		$.messager.confirm('消息提示','确定恢复吗？',function(r){
			if (r){
				$.get( '../../../../php/action/page/admin/admincat.act.php?action=uptisDelList&idlist='+list,function(data){
					loadTree();						
					loadPage();
					return;			
					$('#admingrid').datagrid('reload');
					var arr=data.split(',');					   
					for(var i=0;i<arr.length;i++){
						var node=$("#treeData").tree('find',arr[i]);
						$("#treeData").tree('add',node.target);   
					}
				});					 
			}
		});
	}
}
