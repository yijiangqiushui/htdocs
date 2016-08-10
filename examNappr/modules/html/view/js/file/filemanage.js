/**
author:Zhao Xiaogang 
date:2015-03-18
*/
var upid=0,uptext='',upcat,edtid;
var upper_cat,is_leaf,is_zero;
var url;
var pridge;
var contentID='';
var flag2='';
var editid='';
var detailid='';
var loadsuccess=false;
function myformatter(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
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
		url:'../../../../php/action/page/file/file.act.php?action=treeData&contentID='+contentID,
		onBeforeExpand:function(node){
			var node1=$('#treeData').tree('getParent',node.target);
			if(node1==null){
				$(this).tree('collapseAll');	
			}else{
				var child = $("#treeData").tree('getChildren',node1.target);
				for(var i=0; i<child.length; i++){
					$(this).tree('collapse',child[i].target);	
				}
			}
			$(this).tree('options').url='../../../../php/action/page/file/file.act.php?action=treeData&up_id='+node.id+'&is_zero='+node.is_zero;
		},
		onSelect:function(node){
			if(node.state=='closed'){
				var node1=$('#treeData').tree('getParent',node.target);
				if(node1==null){
					$(this).tree('collapseAll');	
				}else{
					var child = $("#treeData").tree('getChildren',node1.target);
					for(var i=0; i<child.length; i++){
						$(this).tree('collapse',child[i].target);	
					}
				}
				$(this).tree('expand',node.target);
			}else{
				$(this).tree('collapse',node.target);
			}
			$(this).tree('options').url='../../../../php/action/page/file/file.act.php?action=treeData&up_id='+node.id+'&is_zero='+node.is_zero;
		},
		onClick:function(node){
			if(node.id==0){
				upper_cat='.';
				contentID='.'
			}else{
				upper_cat=node.upper_cat+node.id+'.';
				contentID=node.upper_cat+node.id+'.';
				is_zero=node.is_zero;
			}				
			$('#infoGrid').datagrid('load',{'upper_cat':upper_cat,'flag1':0,'is_zero':is_zero});

			upid=node.id;
			uptext=node.text;
			upcat=node.upper_cat;
			is_leaf=node.is_leaf;
		}
	});
}

$(function(){
	$.messager.defaults = { ok: "确定", cancel: "取消" };
	$('body').css('display','none');
	$.get('../../../../php/action/page/jdgPge1.act.php',function(data){
		pridge=eval("("+data+")");
		$('body').css('display','block');
		if(pridge.priviledges=='super'){
			loadPage();	
		}else{
			if(pridge.priviledges.indexOf('file_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');			
			}else{	
				var temp = pridge.priviledges.split(',')[1].split('.');
				contentID=isNaN(parseInt(temp[temp.length-1]))?'':temp[temp.length-1];
				if(pridge.priviledges.indexOf('file_add')<0){
					$("a[onclick='newFile()']").css('display','none');				
				}
				if(pridge.priviledges.indexOf('file_del')<0){
						$("a[iconCls='icon-remove']").css('display','none');			
				}
				if(pridge.priviledges.indexOf('file_report')<0){
					$("a[onclick='countFile()']").css('display','none');				
				}
				loadPage();
				/*var str=pridge.priviledges.split(',');
				if(str[1]=='concats_0' || str[1]=='concats_'){
					loadPage();
				}else{
					var str1=str[1].toString();
					var str2=str1.indexOf('.');
					var str3=str1.substr(str2,str1.length-1);
					upper_cat=str3+'.';
					loadPage();
					if(pridge.priviledges.indexOf('maker')<0){
						if(pridge.exclusive_name.indexOf('drafter')<0){
							$('#infoGrid').datagrid('load',{'upper_cat':upper_cat});
						}
						else{
							if(pridge.priviledges.indexOf('file_self')<0){
								$('#infoGrid').datagrid('load',{'upper_cat':upper_cat,'flag1':0});
							}
							else{
								$('#infoGrid').datagrid('load',{'flag1':0,'file_self':1});
							}	
								
						}
					}
					
				}*/
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
		   
			createElementNT199();
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
				   
		url:'../../../../php/action/page/file/file.act.php?action=getDateGrid',//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'file_name',title:'文件名称'},
			{field:'types',title:'文件类型'},
			{field:'file_no',title:'文件编号',
				formatter:function(value,row,index){
					var s='';
					if(value=='' || value==null){
						s='暂未生成编码';
					}
					else{
						s=value;
					}
					return s;
				}},
			{field:'author',title:'拟稿人'},
			{field:'department',title:'拟稿部门'},
			{field:'file_level',title:'加密级别',align:'center'},
			{field:'ismake',title:'当前状态',align:'center',
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='未上传';
					}
					if(value=='1'){
						s='通过';
					}
					if(value=='2'){
						s='核对';
					}
					if(value=='3'){
						s='未通过';
					}
					return s;
				}},
			{field:'addedDate',title:'拟稿日期',align:'center'},
			{field:'number',title:'份数',align:'center'},
			{field:'action',title:'操作',width:80,
				formatter:function(value,row,index){
					var a=' | '+'<a href="javascript:void(0)" onclick="edtInfo('+row.id+')">编辑</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="delInfo('+row.id+')">删除</a>';	
					var e=' | '+'<a href="javascript:void(0)" onclick="checkInfo('+row.id+')">详情</a>';	
					var g=' | '+'<a href="javascript:void(0)" onclick="upload('+row.id+','+1+')">上传红头文件</a>';	
					var h=' | '+'<a href="javascript:void(0)" onclick="findUpload('+row.id+','+1+')">查看红头文件</a>';	
					var k=' | '+'<a href="javascript:void(0)" onclick="makeRed('+row.id+','+1+')">红头文件通过</a>';	
					var l=' | '+'<a href="javascript:void(0)" onclick="makeRed('+row.id+','+3+')">红头文件否决</a>';	
					var m=' | '+'<a href="javascript:void(0)" onclick="cancelFile('+row.id+')">撤销文件</a>';	
					var n=' | '+'<a href="javascript:void(0)" onclick="getword('+row.id+')">导出审批单</a>';
					var rn='';
					if(row.isInvalid==1){
						rn='  无效文件';
					}else if(pridge.priviledges=='super'){
						rn='  无操作权限';
						//rn=a+b+e+g+h+k+l+m;
					}else{
						if(pridge.priviledges.indexOf('file_edit')>=0 && row.flag2!=1 &&row.ismake!=1 &&row.file_no==null && row.isOwn==1){
							rn+=a;
						}
						if(pridge.priviledges.indexOf('file_del')>=0 && row.flag2!=1 &&row.ismake!=1 &&row.file_no==null && row.isOwn==1){
							rn+=b;
							$("a[iconCls='icon-remove']").css('display','');			

						}
						if(pridge.priviledges.indexOf('file_detail')>=0 && row.flag1!=1){
							rn+=e;
						}
						if(pridge.priviledges.indexOf('file_red')>=0){
							if(row.ismake==0){
								rn+=g;
							}
						}
						if(pridge.priviledges.indexOf('find_red')>=0){
							if(row.ismake!=0){
								rn+=h;
							}
						}
						if(pridge.priviledges.indexOf('make_red')>=0 && row.isOwn==1){
							if(row.ismake!=0){
								//rn+=k;
							}
						}
						if(pridge.priviledges.indexOf('remakes_red')>=0 && row.isOwn==1){
							if(row.ismake!=0){
								//rn+=l;
							}
						}
						if(pridge.priviledges.indexOf('file_cancel')>=0){
							rn+=m;
						}
						rn+=n;
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
	
	var author=$('#author2').val();
	var file_name=$('#file_name1').val();
	var file_no=$('#file_no1').val();
	var beginDate=$("#beginDate").datebox("getValue");
	var endDate=$("#endDate").datebox("getValue");
	var file_type=$('#file_type').combobox('getValue');

	$('#expertfm').form('clear');
	$('#author3').val(author);
	$('#file_name3').val(file_name);
	$('#file_no3').val(file_no);
	$('#file_type3').val(file_type);
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

	$('#infoGrid').datagrid('reload',{'file_name':file_name,'beginDate':beginDate,'endDate':endDate,'file_no':file_no,'file_type':file_type,'upper_cat':upper_cat,'author':author,'flag1':0});
	$('#queDlg').dialog('close');
}

/**
* 创建制发文件
*/
function newFile(){
	$('#newdlg').dialog('open').dialog('setTitle','创建制发文件');
	$('#newfm').form('clear');
	var curr_time = new Date();
	$('#newfm').form('load',{'types':'党组','file_level':'非密','addedDate':myformatter(curr_time)});
	uploadify();

}

/**
* 导出文件审批记录表
*/
function exportApply(){
	$('#exportdlg').dialog('open').dialog('setTitle','导出文件审批记录表');
}

/**
* 确定导出
*/
function expertData(){
	var file_name=$('#expertfm input[name="file_name3"]').val();
	var file_no=$('#expertfm input[name="file_no3"]').val();
	var file_type=$('#expertfm input[name="file_type3"]').val();
	var beginDate=$('#expertfm input[name="beginDate3"]').val();
	var endDate=$('#expertfm input[name="endDate3"]').val();
	var file_self;
	if(pridge.priviledges.indexOf('file_self')<0){
		file_self=0;
	}
	else{
		file_self=1;
	}	
	window.open('../../../../php/action/page/downFile.php?action=Excel&upper_cat='+upper_cat+'&file_name='+file_name+'&file_no='+file_no+'&file_type='+file_type+'&beginDate='+beginDate+'&endDate='+endDate+'&file_self='+file_self);
	$('#exportdlg').dialog('close');
}

/*
功能：编辑
*/
function edtInfo(id){
	editid=id;
	$.post('../../../../php/action/page/file/file.act.php?action=find_maker_flag',{id:id},function(data){
		if(data!=1){
			$('#edtFm').form('clear');
			$('#edtDlg').dialog({closable: false});
			$.post('../../../../php/action/page/file/file.act.php?action=getDetail',{id:id},function(res){
				$('#edtDlg').dialog('open').dialog('setTitle','编辑文件信息');
				$('#edtFm').form('load',res);
				$('#edtFm').form('load',{department:res.category.substring(0,res.category.length-1)});
			},'json');
			 url = '../../../../php/action/page/file/file.act.php?action=editFile&id='+id;
			 path = '../../../../php/action/page/file/file.act.php?action=cancelInfo&id='+id+'&flag='+0;
		}
		else{
			alert('您暂时不能进行该操作！');
			$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'flag1':0,'is_zero':is_zero});
		}
	});
}

function check(){
   //editor.sync();
   var addedDate = $.trim($('#addedDate').datebox('getValue')); 
   var types = $.trim($('#types').combobox('getValue')); 
   var file_level = $.trim($('#file_level').combobox('getValue')); 
   var file_name = $.trim(document.getElementById("file_name").value);
   var file_content = $.trim(document.getElementById("file_content").value);
   var number = $.trim(document.getElementById("number").value);
   if(addedDate ==  null || addedDate == ''){
        alert("日期不能为空");
        return false;
   }
   if(types ==  null || types == ''){
        alert("文件类型不能为空");
        return false;
   }
   if(file_level ==  null || file_level == ''){
        alert("加密级别不能为空");
        return false;
   }
   if(file_name ==  null || file_name == ''){
        alert("文件名不能为空");
  		$('#file_name').focus();
        return false;
   }
   if(file_content ==  null || file_content == ''){
        alert("内容不能为空");
  		$('#file_content').focus();
        return false;
   }
   if(number ==  null || number == ''){
        alert("印制份数不能为空");
  		$('#number').focus();
        return false;
   }
	saveInfo();
}

function saveInfo(){
	$('#edtFm').form('submit',{
		url:url,
		success:function(result){
					$('#edtDlg').dialog('close');
					getword(editid);
					$('#infoGrid').datagrid('load',{'upper_cat':upper_cat,'flag1':0,'is_zero':is_zero});
						
		}
	});
}
/*
**提交验证
*/
function saveNewFile(){
   var name_data;
   var addedDate = $.trim($('#addedDate0').datebox('getValue')); 
   var types = $.trim($('#types0').combobox('getValue')); 
   var file_level = $.trim($('#file_level0').combobox('getValue')); 
   var file_name = $.trim(document.getElementById("file_name0").value);
   var file_content = $.trim(document.getElementById("file_content0").value);
   var number = $.trim(document.getElementById("number0").value);
	
	if(addedDate ==  null || addedDate == ''){
		alert("日期不能为空");
		return false;
	}
	if(types ==  null || types == ''){
		alert("文件类型不能为空");
		return false;
	}
	if(file_level ==  null || file_level == ''){
		alert("加密级别不能为空");
		return false;
	}
	if(file_name ==  null || file_name == ''){
		alert("文件名不能为空");
		$('#file_name0').focus();
		return false;
	}
	if(file_content ==  null || file_content == ''){
		alert("内容不能为空");
		$('#file_content0').focus();
		return false;
	}
	if(number ==  null || number == ''){
		alert("印制份数不能为空");
		$('#number0').focus();
		return false;
	}
	if($.trim($('#file_upload0-queue').html())==''){
		save();
	}else{
		attach();
	}
}

//上传附件
function attach(){
   $('#file_upload0').uploadify('settings', 'formData', {'typeCode':document.getElementById('id_file0').value});$('#file_upload0').uploadify('upload','*');
}

/*
*保存创建的制发文件
*/
function save(){
	$('#newfm').form('submit',{
		url:'../../../../php/action/page/file/file.act.php?action=save',
		success:function(result){
			if(result=='file_name_exit'){
				alert('文件名称已存在，请重新填写');
			}else{
				if(result>0){
					$('#newfm').form('clear');
					var curr_time = new Date();
					$('#newfm').form('load',{'types':'党组','file_level':'非密','addedDate':myformatter(curr_time)});
					$('#types0').val('党组');
					$('#file_level0').val('非密');
					getword(result);
					alert('创建文件成功！');
					$('#newdlg').dialog('close');
					$('#infoGrid').datagrid('load',{'upper_cat':upper_cat,'flag1':0,'is_zero':is_zero});
				}else{
					alert('创建文件失败！');
					return;
				}
			}
		}
	});
}

/*
*上传附件
*/
function uploadify(){
	$('#file_upload0').uploadify({
		'auto' : false,//关闭自动上传
		'removeTimeout' : 1,//文件队列上传完成1秒后删除
		'swf' : '../../../../../common/html/plugin/uploadify/uploadify.swf',
		'uploader' : '../../../../php/action/page/file/uploadify.php',
		'method' : 'post',//方法，服务端可以用$_POST数组获取数据
		'buttonText' : '上传附件',//设置按钮文本
		'width' : 60,
		'height' :24,
		'multi' : true,//允许同时上传多张文件
	/*'fileExt' :'*.doc;*.pdf;*.rar;',*/
		'uploadLimit' : 10,//一次最多只允许上传10张文件
		'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端
			var img_id_upload=new Array();//初始化数组，存储已经上传的文件名
			var i=0;//初始化数组下标
			img_id_upload[i]=data;
			i++;
			var res = eval("("+data+")");
			$('#attach_name0').val(res.filename+','+$("#attach_name0").val());
			$('#file_auto_name0').val(res.file_auto_filename+','+$("#file_auto_name0").val());
		},
		'onQueueComplete' : function(queueData) {//上传队列全部完成后执行的回调函数
			save();
			// if(img_id_upload.length>0)
			// alert('成功上传的文件有：'+encodeURIComponent(img_id_upload));
		}  
	});
};

function getword(id){
	if(id==''){
		id=detailid;
	}
	window.location='http://'+window.location.host+':83/MS-Word/docWord_table/getword.htm?id='+id;
}

/*
*功能：取消编辑
*/
function cancelInfo(){
	$('#edtFm').form('submit',{
		url:path,
		success:function(result){
			$('#edtDlg').dialog('close');
		}
	});
}

/*
功能：删除单条
*/
function delInfo(id){
	$.post('../../../../php/action/page/file/file.act.php?action=find_maker_flag',{id:id},function(data){
		if(data!=1){
			$.get( '../../../../php/action/page/file/file.act.php?action=cancelInfo',{id:id,flag:1},function(data){});					 
			
			$.messager.confirm('提示信息','确定删除吗？',function(r){
				if (r){
					$.post( '../../../../php/action/page/file/file.act.php?action=delFile',{idList:id},function(data){						
						$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'flag1':0});
					});					 
				}
				else{
					$.get( '../../../../php/action/page/file/file.act.php?action=cancelInfo',{id:id,flag:0},function(data){
												
					});					 
				}
			});
			$('.panel-tool-close').hide();
		
		}else{
			alert('您暂时不能进行该操作！');	
			$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'flag1':0});
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
		$.post('../../../../php/action/page/file/file.act.php?action=find_maker_flag',{id:list.toString()},function(data){
			if(data!=1){
				$.messager.confirm('消息提示','确定删除吗？',function(r){
					if(r){
						$.post('../../../../php/action/page/file/file.act.php?action=delFile',{idList:list.toString()},function(data){
							$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'flag1':0});
						});
					}
					else{
						$.get( '../../../../php/action/page/file/file.act.php?action=cancelInfo',{id:list.toString(),flag:0},function(data){
													
						});					 
					}
				});$('.panel-tool-close').hide();
			}
			else{
				alert('您暂时不能进行该操作！');	
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'flag1':0});
			}
	   });
	}
}

/**
* 获取拟稿部门  已不用
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
/**function getWord(id){
	window.open('http://'+window.location.host+':83/MS-Word/docWord_table/getword.htm?id='+id);
}*/
/**
* 查询详情
*/
function checkInfo(id){
		detailid=id;
		$.post('../../../../php/action/page/file/file.act.php?action=find_usr_flag',{id:id},function(data){
			if(data!=1){
				$.ajaxSetup({async:false});
				if(pridge.priviledges.indexOf('maker')>=0){
					addFileNo(id);
				}
				$('#newDlg-detail').dialog('open').dialog('setTitle','信息详情');
				
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'flag1':0,'is_zero':is_zero});
					
				$.post('../../../../php/action/page/file/file.act.php?action=attachGrid',{id:id},function(data){
							$('#attach').html(data);
					});
				$.ajax({
						url: '../../../../php/action/page/file/file.act.php?action=getInfoById&id='+id,
						success: function(data){
							var res = eval("("+data+")");
							$('#department1').html((res.department=='' ||res.department==null)? '无' :res.department);
							$('#author1').html(res.author);
							$('#addedDate2').html(res.addedDate);
							$('#types1').html(res.types);
							$('#file_level1').html(res.file_level);
							$('#file_no2').html(res.file_no);
							$('#file_name2').html(res.file_name);
							$('#file_content1').html(res.file_content);
							//$('#attach').html('<a href="../../../../../common/'+res.file_path+'">'+res.file_type+'</a>');
							$('#number1').html(res.number);
						}
					});
			}
			else{
				alert('您暂时不能进行该操作！');	
			}
		});	
}
/**
* 控制编码的日期格式
*/
function myformatter1(date){
	var y = (/yy|YY/,(date.getYear() % 100)>9?(date.getYear() % 100).toString():'0' + (date.getYear() % 100));
	var m = date.getMonth()+1;
	var d = date.getDate();
	return y+(m<10?('0'+m):m)+(d<10?('0'+d):d);
}
/**
* 生成编码
*/
function addFileNo(id){
	var curr_time = new Date();
	$.post( '../../../../php/action/page/file/file.act.php?action=fileTotal',{},function(data){
		
		var num=(parseInt(data)+1)<10?('0'+(parseInt(data)+1)):(parseInt(data)+1);
		var file_no="kwzf"+myformatter1(curr_time)+num;
		$.post( '../../../../php/action/page/file/file.act.php?action=addFileNo',{id:id,file_no:file_no},function(data){
			return data;
			/*if(data==1){
				alert('文件编码生成成功！');
				$('#infoGrid').datagrid('reload');
			}
			else if(data==0){
				alert('文件编码生成失败！');
			}
			else{
				alert('该文件编码('+data+')已存在！');
			}*/	
			
		});
	});
	
}

/*
功能：上传附件
*/
function upload(id,isred){
	$.post( '../../../../php/action/page/file/file.act.php?action=checkRed',{id:id},function(data){
		if(data[0]['isRed']>0){
			alert('红头文件已上传！');
		} else if(data[0]['file_no']=='' || data[0]['file_no']==null){
			alert('请先查看详情！');
		}else{
			$('#loadDlg').dialog('open').dialog('setTitle','上传红头文件');
			$('#loadFm').form('clear');
			
			url='../../../../php/action/page/file/file.act.php?action=load&id='+id+'&isred='+isred;
		}
	},'json');
}

function loadInfo(){
	$('#loadFm').form('submit',{
		url:url,
		success:function(result){
			if(result=='error'){
				$.messager.alert('消息提示','请选择需要上传的文件','info');
			}else{
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'flag1':0,'is_zero':is_zero});
				$('#loadDlg').dialog('close');
			}
		}
	});
}

/*
功能：查看附件
*/
function findUpload(id){
	$('#checkDlg').dialog('open').dialog('setTitle','查看红头文件');
	$('#attachGrid').datagrid({
		height:250,
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
		toolbar:'#toolbar1',
				   
		url:'../../../../php/action/page/file/file.act.php?action=redAttachGrid&id='+id,//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'file_name',title:'红头文件名称',width:250},
			{field:'file_size',title:'红头文件大小',width:80},
			{field:'brief_ctnt',title:'红头文件描述',width:100},
			{field:'action',title:'操作',align:'center',
				formatter:function(value,row,index){
					var rn='';
					var a='<a href="javascript:void(0)" onclick="delAttach('+row.id+')"> 删除</a>'+' | ';							
					var b='<a href="javascript:void(0)" onclick="checkAttach('+row.id+')">查看详情</a>';	
					var c=' | '+'<a href="javascript:void(0)" onclick="makeRed('+id+','+1+')">通过</a>';	
					var d=' | '+'<a href="javascript:void(0)" onclick="makeRed('+id+','+3+')">否决</a>';	
					//if(pridge.catName.indexOf('拟稿人')<0){
					if(row.ismake!=1){
						if(pridge.priviledges.indexOf('maker')>=0){
							if(pridge.priviledges.indexOf('drafter')>=0&&row.isOwn==1){
								rn+=a+b;
							}else{
								if(row.isopen==1){
									rn+=b;
								}else{
									rn+=a+b;
								}
							}
						}
						else{
							rn+=b;
						}
					}else{
						rn+=b;
					}
	
					if(pridge.priviledges.indexOf('make_red')>=0 && row.isOwn==1&& row.ismake==2){
						rn+=c;
					}
					if(pridge.priviledges.indexOf('remakes_red')>=0 && row.isOwn==1&& row.ismake==2){
						rn+=d;
					}
	

					return rn;					
				}
			}															
		]]						  
	});
				
	var p = $('#attachGrid').datagrid('getPager');			  
	$(p).pagination({  
		pageSize: 20,  
		pageList: [10,20,30], 
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
}
/*
功能：查看附件详情
*/
function checkAttach(id){
	makeOpen(id);
	window.open('../../../../php/action/page/file/file.act.php?action=checkAttach&attach='+id);
}

/*
功能：删除
*/
function delAttach(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.post( '../../../../php/action/page/file/file.act.php?action=delAttach&id='+id,function(data){	
				$('#checkDlg').dialog('close');					
				$('#attachGrid').datagrid('reload');                      
				$('#infoGrid').datagrid('reload');
			});					 
		}
	}); 
}

/*
功能：标注无效
*/
function cancelFile(id){
	$.messager.confirm('提示信息','确定撤销该文件吗？',function(r){
		if (r){
			$.post( '../../../../php/action/page/file/file.act.php?action=cancelFile&id='+id,function(data){	
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'flag1':0,'is_zero':is_zero});
			});					 
		}
	}); 
}
/*
*功能：通知是否生成红头文件
*/
function makeRed(id,ismake){
	$.post('../../../../php/action/page/file/file.act.php?action=makeRed',{id:id,ismake:ismake},function(data){
		if(data==1){
			$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat,'flag1':0});
			alert('已通知制文人！');
			$('#checkDlg').dialog('close');
		}
		if(data=='noUpload'){
			alert('文件还未上传！');
		}
	});
}
function makeOpen(id){
	$.post('../../../../php/action/page/file/file.act.php?action=makeOpen',{id:id},function(data){
		
	});
}

function countFile(){
	window.location.href='chart_recommend.html';
}