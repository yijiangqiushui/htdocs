/**
author:Gao Xue 
date:2014-05-07
Modified by Zhao Xiaogang 2014-12-25  188行
*/
var upid=0,uptext='',upcat,edtid;
var upper_cat,is_leaf;
//var editor,editor1;
var url;
var pridge;
var gloablId;
var contentID='';
var editID;
var datacat_id;
function myformatter(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}
function myformatter1(date){
	var y = (/yy|YY/,(date.getYear() % 100)>9?(date.getYear() % 100).toString():'0' + (date.getYear() % 100));
	var m = date.getMonth()+1;
	var d = date.getDate();
	return y+(m<10?('0'+m):m)+(d<10?('0'+d):d);
}
function myparser(s){
	if (!s) return new Date();
	var ss = (s.split('-'));
	var y = parseInt(ss[0],10);
	var m = parseInt(ss[1],10);
	var d = parseInt(ss[2],10);
	if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
		return new Date(y,m-1,d);
	} else {
		return new Date();
	}
}
function loadTree(){
	$("#treeData").tree({
		//url:'../../../../php/action/page/content/contentcat.act.php?action=treeData&contentID='+contentID,
		url:'../../../../php/action/page//file/seal.act.php?action=treeData&contentID='+contentID,
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/file/seal.act.php?action=treeData&up_id='+node.id+'&contentID='+contentID+'&datacat_id='+node.datacat_id;
		},
		onClick:function(node){
			if(node.id==0){
				upper_cat='.';
				contentID='.'
			}else{
				upper_cat=node.upper_cat+node.id+'.';
				contentID=node.upper_cat+node.id+'.';
			}
			datacat_id=node.datacat_id;
			$('#infoGrid').datagrid('load',{'upper_cat':upper_cat,'datacat_id':datacat_id});
			upid=node.id;
			uptext=node.text;
			upcat=node.upper_cat;
			is_leaf=node.is_leaf;
		}
	});
}

/*
功能：编辑
*/
function edtInfo(id){
	$('#select').change(function(){
		if($(this).children('option:selected').val()==0){
			$('#endt').hide();
			$('#end_time').datebox('setValue','');
		}else{
			$('#endt').show();
		}
	});

	//getCatList('contentcat_id');
	$('#form1').form('clear');
	$.post('../../../../php/action/page/file/seal.act.php?action=getDetail',{id:id},function(res){
		if(res.file_no!=''&&res.file_no!=null){
			$('#infoGrid').datagrid('load',{'upper_cat':upper_cat,'datacat_id':datacat_id});
			return;
		}
		if(res.end_time!=null&&res.end_time!=''){
			$("#select").find("option[value='1']").prop("selected",true);
			$('#endt').show();
		}else{
			$("#select").find("option[value='0']").prop("selected",true);
			$('#endt').hide();
			$('#end_time').datebox('setValue','');
		}
		$('#newDlg').dialog('open').dialog('setTitle','修改印章使用申请信息');
		$('#form1').form('load',res);
		var temp=res.category;
		$('#form1').form('load',{'contentcat_id':temp.substring(0,temp.length-1)});
		$("#form1 input[name=checkbox]").each(function(){
			if(res.content.indexOf($(this).val())>-1){
				$(this).prop("checked",'true');
			}	
		});
	},'json');
	url = '../../../../php/action/page/file/seal.act.php?action=editApply&id='+id;
	editID=id;
}

function saveInfo(){
	//if($('#editor_id').val()==''){
	//	$.messager.alert('消息提示','请输入内容','info');
	//}else{
			var r='';
			$('input[name="checkbox"]').each(function(){
				if($(this).prop('checked')){
					r=r+$(this).val()+',';
				}	
			});
			r=r.substr(0,r.length-1);
			$('#content').val(r);
			var flag=0;
			if($("#select").val()==1){
				flag=1;
			}
		    $('#form1').form('submit',{
			url:url,
			success:function(result){
				$('#newDlg').dialog('close');
				$('#infoGrid').datagrid('load',{'upper_cat':upper_cat,'datacat_id':datacat_id});
				getword(editID,flag);
			}
		});
	//}
}

$(function(){
	$.messager.defaults = { ok: "确定", cancel: "取消" };
	$('body').css('display','none');
	$.get('../../../../php/action/page/jdgPge1.act.php',function(data){
		data=eval("("+data+")");
		pridge=data.priviledges;
		$('body').css('display','block');
		if(pridge=='super'){
			$("a[onclick='newSeal()']").css('display','none');				
			loadPage();	
		}else{
			if(pridge.indexOf('seal_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');			
			}else{	
				var temp = pridge.split(',')[1].split('.');
				contentID=isNaN(parseInt(temp[temp.length-1]))?'':temp[temp.length-1];
				if(pridge.indexOf('seal_add')<0){
					$("a[onclick='newSeal()']").css('display','none');				
				}
				if(pridge.indexOf('seal_del')<0){
						$("a[iconCls='icon-remove']").css('display','none');			
				}
				if(pridge.indexOf('seal_report')<0){
					$("a[onclick='countSeal()']").css('display','none');				
				}
				var str=pridge.split(',');
				if(str[1]=='concats_0'){
					loadPage();
				}else{
					var str1=str[1].toString();
					var str2=str1.indexOf('.');
					var str3=str1.substr(str2,str1.length-1);
					//if(data.catName){
					if(data.exclusive_name){
					     upper_cat='.';
					}else{
					     upper_cat=str3+'.';
					}
					loadPage();
					//$('#infoGrid').datagrid('load',{'upper_cat':upper_cat});
				}
			}
		}
	});
	$(window).resize(function(){
		setTimeout("reSize()",200); 
	});
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
});
function reSize(){
	$('#infoGrid').datagrid('resize', { 
        width : $('#center').width()<960?960:$('#center').width()
    });  
}

function loadPage(){
	loadTree();
	$('#infoGrid').datagrid({
		//height:250,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 20,  
		pageList: [10,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
		toolbar:'#toolbar',
		//width:function(){return document.body.clientWidth*0.9;},
				   
		url:'../../../../php/action/page/file/seal.act.php?action=getDateGrid',
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'reason',title:'用章事由',
				formatter:function(value,row,index){
					return '<a href="javascript:void(0)" onclick="showDetail('+row.id+')">'+value+'</a>'
				}
			},
			{field:'content',title:'用章内容'},
			{field:'author',title:'申请人'},
			{field:'dept',title:'用章部门'},
			{field:'use_time',title:'用章时间',
				formatter:function(value,row,index){
					if(row.end_time==null||row.end_time==''){
						return row.use_time;
					}else{
						return row.use_time+" ↔ "+row.end_time;
					}
				}
			},
			{field:'file_no',title:'文件编号',
				formatter:function(value,row,index){
					if(row.file_no==null||row.file_no==''){
						return "暂无生成编号";
					}else{
						return row.file_no;	
					}
				}
			},
			{field:'setStatus',title:'用章状态',
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='未借出';
					}else if(value=='1'){
						s='已借出';
					}else{
						s='已归还';
					}
					return s;
				}
			},
			{field:'action',title:'操作',align:'center',
				formatter:function(value,row,index){
					var flag=0;
					if(row.end_time==null||row.end_time==''){
						flag=0;
					}else{
						flag=1;
					}
					var a=' | '+'<a href="javascript:void(0)" onclick="getword('+row.id+','+flag+')">导出审批单</a>';
					var c=' | '+'<a href="javascript:void(0)" onclick="getFileNo('+row.id+')">生成文件编号</a>';
					var d=' | '+'<a href="javascript:void(0)" onclick="setStatus('+row.id+')">设置状态</a>';
					var e=' | '+'<a href="javascript:void(0)" onclick="edtInfo('+row.id+')">编辑</a>';
					var f=' | '+'<a href="javascript:void(0)" onclick="delInfo('+row.id+')">删除</a>';	
					var g=' | '+'<a href="javascript:void(0)" onclick="setReject('+row.id+')">驳回</a>';	
					var h=' | '+'<a href="javascript:void(0)" onclick="cancelSeal('+row.id+')">撤销文件</a>';	
					var rn='';
					if(row.isInvalid==1){
						rn='  无效文件';
					}else if(pridge=='super'){
						rn+='  无操作权限';
					}else{
						rn+=a;
						//if(pridge.indexOf('seal_getNo')>=0&&row.catName=='印章管理员'){
						if(pridge.indexOf('seal_getNo')>=0&&row.reject==0&&pridge.indexOf('sealer')>=0){
							if(row.file_no==null){
								rn+=c;
							}
						}
						//if(pridge.indexOf('seal_status')>=0&&row.catName=='印章管理员'){
						if(pridge.indexOf('seal_status')>=0&&row.reject==0&&pridge.indexOf('sealer')>=0){
							rn+=d;
						}
						//if(pridge.indexOf('seal_edit')>=0&&row.file_no==null&&row.reject==1&&row.catName!='印章管理员'){
						if(pridge.indexOf('seal_edit')>=0&&row.file_no==null&&row.reject==1&&pridge.indexOf('sealer')<0&&row.isOwn==1){
							rn+=e;
							$("a[iconCls='icon-remove']").css('display','');			
						}
						//if(pridge.indexOf('seal_del')>=0&&row.file_no==null&&row.reject==1&&row.catName!='印章管理员'){
						if(pridge.indexOf('seal_del')>=0&&row.file_no==null&&row.reject==1&&pridge.indexOf('sealer')<0&&row.isOwn==1){
							rn+=f;
						}
						//if(pridge.indexOf('seal_reject')>=0&&row.file_no==null&&row.catName=='印章管理员'){
						if(pridge.indexOf('seal_reject')>=0&&row.file_no==null&&row.reject==0&&pridge.indexOf('sealer')>=0){
							rn+=g;
						}
						//if(pridge.indexOf('seal_cancel')>=0&&row.catName=='印章管理员'){
						if(pridge.indexOf('seal_cancel')>=0&&pridge.indexOf('sealer')>=0){
							rn+=h;
						}
					}
					if(rn==''){
						rn+='  无操作权限';	
					}
					return rn.substring(2,rn.length);								
				}
			}													
		]],
		 onLoadSuccess: function () {
							reSize();
                   		 	return true;
                		}						  
	});
	if(pridge.indexOf('sealer')<0){
		$("#infoGrid").datagrid('hideColumn', 'setStatus');
	}		
	var p = $('#infoGrid').datagrid('getPager');			  
	$(p).pagination({  
		pageSize: 20,  
		pageList: [10,20,30], 
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	
}

/*
功能：查询信息
*/
function queInfo(){
	$('#queDlg').dialog('open').dialog('setTitle','查询');
	$('#queFm').form('clear');
}

function findInfo(){
	var person=$('#person').val();
	var reason=$('#reason1').val();
	var beginDate=$("#beginDate").datebox("getValue");
	var endDate=$("#endDate").datebox("getValue");
	var file_no=$('#file_no1').val();
	var file_content=$('#file_content1').combobox('getValue');
	
	$('#expertfm').form('clear');
	$('#reason3').val(reason);
	$('#content3').val(file_content);
	$('#file_no3').val(file_no);
	$('#beginDate3').val(beginDate);
	$('#endDate3').val(endDate);
	
	if(beginDate!=''&& endDate==''){
		alert('请输入结束时间');
		return false;
		}
	if(beginDate==''&& endDate!=''){
		alert('请输入开始时间');
		return false;
		}
	$('#infoGrid').datagrid('reload',{'person':person,'reason':reason,'beginDate':beginDate,'endDate':endDate,'file_no':file_no,'file_content':file_content,'upper_cat':upper_cat,'datacat_id':datacat_id});
	$('#queDlg').dialog('close');
}

/**
* 创建印章申请
*/
function newSeal(){
	$('#newSealDlg').dialog('open').dialog('setTitle','创建印章申请');
	$('#newSealFm').form('clear');
	$('#use_time0').datebox('setValue',myformatter(new Date()));
	$('#select0').val('0');
	getDept();
	$('#select0').change(function(){
		if($(this).children('option:selected').val()==0){
			$('#endt0').hide();
		}else{
			$('#endt0').show();
		}
	});
}

//获取用章人所在部门或科室
function getDept(){
	$.post('../../../../php/action/page/file/seal.act.php?action=getDept',function(data){
		$('#dept0').val(data.deptName);
		$('#deptName0').val(data.deptName);
		$('#category0').val(data.category);
	},'json');	
}

/**
* 提交用章申请
*/
function saveSeal(){
	var pdg=$("input[type='radio']:checked").val();
	$('#content0').val(pdg);
	var total = $('#total0').val();
	var use_time = $('#use_time0').datebox('getValue'); 
	var end_time = $('#end_time0').datebox('getValue'); 
	//var contentcat_id = $('#contentcat_id').datebox('getValue'); 
	var reason = $('#reason0').val();
	var content = $('#content0').val();
	//var admin = $('#admin').val();
	//var user = $('#user').val();
	  
    if(total ==  null || total == ''){
			alert("件数不能为空");
			$('#total0').focus();
			return false;
	}
	if(use_time ==  null || use_time == ''){
			alert("开始日期不能为空");
		   return false;
	}
	if($("#select0").val()==1){
		if(end_time ==  null || end_time == ''){
			alert("截止日期不能为空");
			return false;
		}else if(end_time<use_time){
			alert("截止日期不能早于开始日期");	
			return false;
		}
	}
	/**if(contentcat_id ==  null || contentcat_id == ''){
			alert("用章部门不能为空");
		   return false;
	}*/
    if(reason ==  null || reason == ''){
			alert("用章事由不能为空");
			$('#reason0').focus();
			return false;
	}
    if(pdg==undefined){
			alert("用章内容不能为空");
			$('#content0').focus();
			return false;
	}
    /*if(admin ==  null || admin == ''){
			alert("管理员不能为空");
			$('#admin').focus();
			return false;
	}
    if(user ==  null || user == ''){
			alert("用章人不能为空");
			$('#user').focus();
			return false;
	}*/
	$('#newSealFm').form('submit',{
     	url:'../../../../php/action/page/file/seal.act.php?action=saveApply&category='+$('#category0').val(),
     	onSubmit: function(){
    	},
     	success: function(result){
			if(result=='exist'){
				$.messager.alert('消息提示','该申请已存在','info');
				return;
			}
			if(result>0){
				var flag=0;
				if($("#select0").val()==1){
					flag=1;
				}
				$('#newSealDlg').dialog('close');
				$('#infoGrid').datagrid('load',{'upper_cat':upper_cat,'datacat_id':datacat_id});
				/*
				$('#newSealFm').form('clear');
				$('#use_time0').datebox('setValue',myformatter(new Date()));
				$('#select0').val('0');
				$('#endt0').hide();
				$('#dept0').val($('#deptName').val());
				*/
				$.messager.alert('消息提示','提交申请成功','info');
				
				getword(result,flag);
				getDept();
			}else{
				$.messager.alert('消息提示','打印申请失败','info');
			}
			
		}
	});	
}

/*
树形下拉菜单  已不用
*/
function loadcombotree(res){
	$("#catTree").combotree({
		url:'../../../../php/action/page/content/contentcat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/content/contentcat.act.php?action=treeData&up_id='+node.id;
		},
		onClick:function(node){
			$('input[name="category"]').val(node.upper_cat+node.id+'.');
			$('input[name="cat_id"]').val(node.id);
		},
		onLoadSuccess: function (node, data) {
			$('#catTree').combotree('tree').tree("expandAll"); 
		}
	});
}

/*
功能：删除单条
*/
function delInfo(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.post( '../../../../php/action/page/file/seal.act.php?action=delApply',{idList:id},function(data){						
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'datacat_id':datacat_id});                      
			});					 
		}
	});  
}

/*
功能：批量删除
*/
function delArrInfo(){
	var rows = $("#infoGrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;
		}
		$.messager.confirm('消息提示','确定删除吗？',function(r){
			if(r){
				$.post('../../../../php/action/page/file/seal.act.php?action=delApply',{idList:list.toString()},function(data){
					$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'datacat_id':datacat_id});
				});
			}
		});
	}
}


/*
功能：审核
*/
function checkInfo(id){
	$.messager.confirm('提示信息','确定审核吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/file/seal.act.php?action=checkInfo&id='+id,function(data){						
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'datacat_id':datacat_id});                     
			});					 
		}
	}); 
}
/*
禁用操作
*/
function disableEle(flag){
	var str;
	var rows = $("#infoGrid").datagrid("getChecked");
			
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
				$.post( '../../../../php/action/page/file/seal.act.php?action=setForbidden',{idList:list.toString(),val:flag},function(data){			
				   $('#infoGrid').datagrid('reload');
				});					 
			}
		});
	}
}


/**
* 获取用章部门或科室列表  已不用
*/
function getCatList(str){
	$('#'+str).combotree({
			url: '../../../../php/action/page/content/contentcat.act.php?action=getAllCat',
			checkbox:false,
			animate:true,
			lines:false,

			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/content/contentcat.act.php?action=getAllCat&up_id='+node.id;
			},
		onLoadSuccess: function (node, data) {
			$('#'+str).combotree('tree').tree("expandAll"); 
		},
			onClick:function(node){
				$(this).tree('expand',node.target);
			}
		});
}

/**
* 科室负责人签批
*/
function leader(flag,id){
	$('#leaderFm').form('clear');
	$('#leader-buttons a').show();
	$('#leader-buttons .close-button').hide();
	$('#leaderFm').form('load',{'leader_check':'1'});
	var con;
	var t;
	var $tit
	var $chk;
	$.post('../../../../php/action/page/file/seal.act.php?action=getDetail',{id:id},function(res){
		if(flag==1){
			con=res.leader1;
			$tit='科室负责人签批';
			$chk=res.leader1_check;
			$('#bear').html('签批结果：');
			$('#advice').html('签批意见：');
		}else if(flag==2){
			con=res.leader2;
			$chk=res.leader2_check;
			$tit='主管领导批示';
			$('#bear').html('批示结果：');
			$('#advice').html('批示意见：');
		}else if(flag==3){
			con=res.leader3;
			$chk=res.leader3_check;
			$('#bear').html('批示结果：');
			$('#advice').html('批示意见：');
			$tit='主要领导批示';	
		}
		if(con!==''&&con!=null&&con!=undefined||$chk!=0){
			$('#leaderFm').form('load',{'leader':con});
			$("input[name=chk]").each(function(){
				if($(this).val()==$chk){
					$(this).prop("checked","checked");
				}
			});
			$('#leader-buttons a').hide();
			$('#leader-buttons .close-button').show();
		}else{
			$("input[name=chk]").each(function(){
				if($(this).val()==1){
					$(this).prop("checked","checked");
				}
			});
		}
		$('#leaderDlg').dialog('open').dialog('setTitle',$tit);
	},'json');
	url='../../../../php/action/page/file/seal.act.php?action=saveLeaderInfo&flag='+flag+'&id='+id;
}
function saveLeaderInfo(){
	$('#leaderFm').form('submit',{
		url:url,
		success:function(data){
			$('#leaderDlg').dialog('close');
		    $('#infoGrid').datagrid('reload'); 
		}
	});
}

/**
* 导出印章启用登记表
*/
function exportApply(){
	$('#exportdlg').dialog('open').dialog('setTitle','导出印章启用登记表');
}

/**
* 确定导出
*/
function expertData(){
	var reason=$('#expertfm input[name="reason3"]').val();
	var content=$('#expertfm input[name="content3"]').val();
	var file_no=$('#expertfm input[name="file_no3"]').val();
	var beginDate=$('#expertfm input[name="beginDate3"]').val();
	var endDate=$('#expertfm input[name="endDate3"]').val();
	window.open('../../../../php/action/page/downExcel.php?action=Excel&reason='+reason+'&content='+content+'&file_no='+file_no+'&beginDate='+beginDate+'&endDate='+endDate+'&upper_cat='+upper_cat);
	$('#exportdlg').dialog('close');
}

/**function getWord(id){
	window.open('http://'+window.location.host+':83/MS-Word/applyWord_table/getapplyword.htm?id='+id);
}*/
//查看详细信息
function showDetail(id){
	$('#form_detail').form('clear');
	$.post('../../../../php/action/page/file/seal.act.php?action=getDetail',{id:id},function(res){
		$('#dlgDetail').dialog('open').dialog('setTitle','查看印章使用申请信息');
		$('#form_detail').form('load',res);
		$('#total1').html(res.total);
		if(res.end_time!=null&&res.end_time!=''){
			$('#useTime').html(res.use_time+' 至 '+res.end_time);
			$('#print-apply').bind('click',function(){
				getword(res.id,1);
			});
		}else{
			$('#useTime').html(res.use_time);
			$('#print-apply').bind('click',function(){
				getword(res.id,0);
			});
		}
		$('#reason2').html(res.reason);
		$('#admin2').html(res.admin);
		//$('#usr2').html(res.user);
		$('#dept2').html(res.dept);
		/**$('#leader1').html((res.leader1==''||res.leader1==null)?'无':res.leader1);
		$('#leader2').html((res.leader2==''||res.leader2==null)?'无':res.leader2);
		$('#leader3').html((res.leader3==''||res.leader3==null)?'无':res.leader3);*/
		$('#fileNo').html(res.file_no);
		var temp=res.category;
		$('#form_detail').form('load',{'contentcat_id':temp.substring(0,temp.length-1)});
		$("#form_detail input[name=checkbox]").each(function(){
			if(res.content.indexOf($(this).val())>-1){
				$(this).prop("checked",'true');
			}	
		});
	},'json');
}

function setStatus(id){
	gloablId=id;
	$.post('../../../../php/action/page/file/seal.act.php?action=getStatus',{'id':id},function(result){
		$('#setdlg').dialog('open').dialog('setTitle','设置用章状态');
		$('#setfm').form('load',{'setStatus':result});
	});
}

function updStatus(){
	$('#setfm').form('submit',{
		url:url='../../../../php/action/page/file/seal.act.php?action=updStatus&id='+gloablId+'&status='+$('#setStatus').val(),
		success:function(data){
			$('#setdlg').dialog('close');
		    $('#infoGrid').datagrid('reload'); 
		}
	});
}

function getFileNo(id){
	$.messager.confirm('提示信息','确定生成文件编号吗？',function(r){
		if (r){
			var curr_time = new Date();
			$.post( '../../../../php/action/page/file/seal.act.php?action=fileTotal',{},function(data){	
				var num=(parseInt(data)+1)<10?('0'+(parseInt(data)+1)):(parseInt(data)+1);
				var file_no="kwyz"+myformatter1(curr_time)+num;
				$.post( '../../../../php/action/page/file/seal.act.php?action=addFileNo',{id:id,file_no:file_no},function(data){	
					if(data==1){
						alert('文件编码生成成功！');
						$('#infoGrid').datagrid('reload');
					}
					else if(data==0){
						alert('文件编码生成失败！');
					}
					else{
						alert('该文件编码('+data+')已存在！');
					}	
				});
			});
		}
	});
}

//驳回操作
function setReject(id){
	$.messager.confirm('提示信息','确定驳回该文件吗？',function(r){
		if (r){
			$.post('../../../../php/action/page/file/seal.act.php?action=setReject',{'id':id},function(result){
				if(result){
					$.messager.alert("操作提示","操作成功","info");
					$('#infoGrid').datagrid('reload');
				}else{
					$.messager.alert("操作提示","操作失败","error");	
				}
			});
		}
	});  
}
function getword(id,flag){
	var url;
	if(flag==0){
		url='http://'+window.location.host+':83/MS-Word/applyWord_table/getapplyword.htm?id='+id;
	}else{
		url='http://'+window.location.host+':83/MS-Word/applyWord_table/getapplyword1.htm?id='+id;
	}
	window.location=url;
}
/*
功能：删除单条
*/
function cancelSeal(id){
	$.messager.confirm('提示信息','确定撤销该文件吗？',function(r){
		if (r){
			$.post( '../../../../php/action/page/file/seal.act.php?action=cancelSeal',{id:id},function(data){						
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'datacat_id':datacat_id});                      
			});					 
		}
	});  
}

function countSeal(){
	window.location.href='seal_chart_report.html';
}
