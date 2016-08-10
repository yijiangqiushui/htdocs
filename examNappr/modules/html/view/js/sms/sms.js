/**
author:Gao Xue
date:2014-09-10
*/
var url,pridge,sendId,sendPhoneStr,sendTimeStr,flag;
$(function(){
	
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
	$('body').css('display','none');
	
	$.post('../../../../php/action/page/sms/sms.act.php?action=getSession',function(data){
		flag=data;
		if(flag!=0){
			//setTimeout(setInterval(reload_replys,90000),90000);
			getYE();
		}
	});
	
	$.get('../../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('sms_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');			
			}else{			
				if(data.indexOf('sms_add')<0){
						$("a[onclick='newSms()']").css('display','none');			
				}
				if(data.indexOf('sms_del')<0){
						$("a[onclick='delArrSms()']").css('display','none');			
				}
				if(data.indexOf('sms_report')<0){
					$("a[onclick='countSms()']").css('display','none');				
				}
				loadPage();
			}	
		}
	});
	$.extend($.fn.validatebox.defaults.rules, {
		mobile : {// 验证手机号码
			validator : function(value) {
				return /^1[3|4|5|8][0-9]\d{4,8}$/i.test(value);
			},
			message : "手机号码格式不正确"
		}
	});
	reload_replys();
});

function loadPage(){
	$('#smsgrid').datagrid({
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
		view:detailview,
		
		detailFormatter:function(index,row){
        return '<div style="padding:2px"><table class="ddv"></table></div>';
    },
    onExpandRow: function(index,row){
			var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
			ddv.datagrid({
				url:'../../../../php/action/page/sms/sms.act.php?action=get_replySms&id='+row.id,
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
	
				loadMsg:'',
				height:'auto',
				columns:[[
					{field:'replyName',title:'回复人',width:10},
					{field:'replyPhone',title:'回复人电话',width:10},
					{field:'replyContent',title:'回复内容',width:10},
					{field:'replyTime',title:'回复时间',width:10},
					{field:'action',title:'操作',align:'center',
						formatter:function(value,row,index){
							//var a='<a href="javascript:void(0)" onclick="delSms('+row.id+')">删除</a>'+' | ';
							//var a='<a href="javascript:void(0)" onclick="getReplyMess(\''+row.replyContent+'\')">信息内容</a>';
							var a='<a href="javascript:void(0)" onclick="getSendMess(\''+row.id+'\',\''+row.replyName+'\',\''+row.replyTime+'\',\''+row.replyPhone+'\',0,\'reply\')">信息内容</a>';
							
							var str='';
							if(pridge=='super'){
								str=a;//a+
							}else{
									str+=a;
							}
							if(str==''){
								str='无操作权限';	
							}
							return str;	
						}
					}
        ]],
				onResize:function(){
					$('#dg').datagrid('fixDetailRowHeight',index);
				},
				onLoadSuccess:function(){
					setTimeout(function(){
						$('#dg').datagrid('fixDetailRowHeight',index);
					},0);
				}
			});
			$('#dg').datagrid('fixDetailRowHeight',index);
    },
		/**/
				   
		url:'../../../../php/action/page/sms/sms.act.php?action=gridData&flag='+flag,//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'smsName',title:'收件人',width:200},
			{field:'name',title:'发件人'},
			{field:'sendtime',title:'发送时间'},
			{field:'isSent',title:'发送状态'},
			
			{field:'action',title:'操作',align:'center',
				formatter:function(value,row,index){
					var e='<a href="javascript:void(0)" onclick="sendToPhone(\''+row.id+'\',\''+row.admin_id+'\',\''+row.smsPhone+'\',\''+row.Sent+'\')">发送此信息</a>'+' | ';
					var f='已发送 | ';
					var a='<a href="javascript:void(0)" onclick="getOtherReply('+row.id+',\''+row.smsPhone+'\',\''+row.sendtime+'\')">无编号回复</a>'+' | ';
					var b='<a href="javascript:void(0)" onclick="exploreReply1('+row.id+',\''+row.smsPhone+'\',\''+row.sendtime+'\')">导出回复</a>'+' | ';
					var c='<a href="javascript:void(0)" onclick="delSms('+row.id+')">删除</a>'+' | ';
					var d='<a href="javascript:void(0)" onclick="getSendMess(\''+row.id+'\',\''+row.smsName+'\',\''+row.sendtime+'\',\''+row.isSent+'\',\''+row.faileSent+'\',\'send\')">信息详情</a>';
					var str='';
					if(pridge=='super'){
						if(row.Sent=='1'){
							str+=e;
						}else{
							str+=f;
						}
						str+=a+b+d;//
					}else{
						if(flag!=0){
							if(row.Sent=='1'){
								str+=e;
							}else{
								str+=f;
							}
						}
						if(pridge.indexOf('sms_add')>=0){
							str+=a;
						}
						if(pridge.indexOf('sms_reply')>=0){
							str+=b;
						}
						if(pridge.indexOf('sms_del')>=0&&row.myid==row.admin_id){
							str+=c;
						}
						str+=d;
					}
					if(str==''){
						str='无操作权限';	
					}
					return str;	
				}
			}
		]]						  
	});
	
	var p = $('#smsgrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	}); 
}

function getReplyMess(replyContent){
	$('#smsDetails').dialog('open').dialog('setTitle','查看回复信息详情');
	alert(replyContent);
}

function getSendMess(id,smsName,sendtime,isSent,faileSent,flag_str){//\''+row.smsPhone+'\',\''+row.content+'\',\''+row.sendtime+'\',\''+row.isSent+'\'
	$('#smsDetails').dialog('open').dialog('setTitle','查看短信详细信息');
	if(flag_str=='reply'){
		$.post('../../../../php/action/page/sms/sms.act.php?action=getReplyContent&id='+id,function(data){
			$('#smsPhone1').html(smsName=='null'?isSent:smsName);
			$('#replyContent1').html(data.replyContent);
		},'json');
	}else{
		$('#smsPhone1').html(smsName);
		$.post('../../../../php/action/page/sms/sms.act.php?action=findById',{id:id},function(data){
			$('#replyContent1').html(data.content);
		},'json')
	}
	$('#sendtime1').html(sendtime);
	$('#isSent1').html(isSent);
	$('#noSuccess1').html(isSent);
	if(flag_str=='send'){
		var faileSentArr=faileSent.split('@');
		var faileSent_phone_Arr=faileSentArr[1].split(';');
		var faileSent_id_Arr=faileSentArr[0].split(';');
		var faile_html='';
		for(var i=0;i<faileSent_id_Arr.length-1;i++){
			faile_html+='<a href="javascript:void(0)" onclick="getSmsList('+id+',\''+faileSent_phone_Arr[i]+'\')">'+faileSent_id_Arr[i]+'</a>; ';
			/*
			if(faileSent_id_Arr[i].length>11){
				faile_html+='<a href="#" onclick="edtInfo(\''+faileSent_phone_Arr[i]+'\')">'+faileSent_id_Arr[i]+'</a>; ';
			}else{
				faile_html+='<a href="#" onclick="editSmsPhoneDlg('+id+',\''+faileSent_phone_Arr[i]+'\')">'+faileSent_id_Arr[i]+'</a>; ';
			}
			*/
			/*
			var phone_id_arr=faileSent_id_Arr[i].split('-');
			if(phone_id_arr.length>1){
				faile_html+='<a href="#" onclick="edtInfo('+phone_id_arr[0]+')">'+phone_id_arr[1]+'</a>; ';
				id_str+=phone_id_arr[0]+';';
			}else{
				faile_html+='<a href="#" onclick="alert(\'通讯录无此信息\');">'+phone_id_arr[0]+'</a>; ';
				id_str+='0;';
			}
			*/
		}
		if(flag!=0||pridge=='super'){
			if(isSent!='未发送'){
				$('.send_faile').html('<td width="80">发送失败：</td><td id="">'+(faileSentArr[0]==''?'无':faile_html)+'</td>');
				if(faileSentArr[0]!=''){
					$('.send_reload').html('<td width="80">重新发送：</td><td>对发送失败的短信,核对号码，如无误 <a href="JavaScript:void(0)" onclick="reSendFaile(\''+id+'\',\''+faileSentArr[1]+'\')">重新发送</a></td>');
				}
			}else{
				$('.send_faile').html('');
			}
		}
		$('#smsPhone0').html('收件人：');
		$('#replyContent0').html('短信内容：');
		$('#sendtime0').html('发送时间：');
		$('#isSent0').html('发送状态：');
	}else if(flag_str=='reply'){
		$('.send_td').html('');
		$('#smsPhone0').html('回复人：');
		$('#replyContent0').html('回复内容：');
		$('#sendtime0').html('回复时间：');
		$('#isSent0').html('回复号码：');
	}

	//alert(replyContent);
}

function getSmsList(id,filePhoneNum){
	$.post('../../../../php/action/page/sms/sms.act.php?action=getAllSmsList&phone='+filePhoneNum,function(data){
		if(data!=''){
			edtInfo(filePhoneNum);
		}else{
			editSmsPhoneDlg(id,filePhoneNum);
		}
	},'json');
}

function reSendFaile(id,failePhone){
	if(failePhone==''){
		alert('没有发送失败的短信，无需重新发送！');
	}else{
		$.post('../../../../php/action/page/sms/sms.act.php?action=reSendFaileSms',{'id':id,'failePhone':failePhone},function(data){
			sendToPhone(data.id,data.admin_id,data.smsPhone,data.isSent);
			$('#smsDetails').dialog('close');
		},'json');
	}
}

function newSms(){
	$('#seach-list').val('');
	showlist();	
	$('#addInfo').dialog('open').dialog('setTitle','发送短消息');
	$('#add-form').form('clear');
	$('.inscribe')[0].value="通州科委";
	$('#radio1')[0].checked="checked";
	getCommunicate();
	setInterval(message_length,100);
	url = '../../../../php/action/page/sms/sms.act.php?action=sendSms';
	
}

function message_length(){
	$("#textCount").text($(".content").val().length);
}
//保存短信，并发送
function sendSms(){
	if($("textarea[name='smsPhone']")[0].value==''){
		alert('请输入收件人！');
		return;
	}
	if($.trim($('.content').val())==''){
		alert('请输入短信内容！');
		return;
	}	
	var sms_Phone=$("textarea[name='smsPhone']")[0].value;
	$.post('../../../../php/action/page/sms/sms.act.php?action=getSmsTotal',{isReply:$('#radio')[0].checked,content:$.trim($('.content').val()),inscribe:$('.inscribe').val(),smsPhone:$("textarea[name='smsPhone']")[0].value},function(data){
		if(data.message=='error'){
			alert('保存失败！');
		}else{
			if(data.message!=0||pridge=='super'){
				$('#addInfo').dialog('close');
				sendToPhone(data.id,data.admin_id,data.phone,data.isSent);
			}else{
				alert('保存成功，请找管理员进行短信发送！');
				$('#addInfo').dialog('close');
				$('#smsgrid').datagrid('reload');
			}
		}
	},'json');
}

function sendToPhone(id,admin_id,phone,isSent){
	var phoneArr=phone.split(";");
	var length;
	if(phoneArr[phoneArr.length-1]==''){
		length=phoneArr.length-1;
	}else{
		length=phoneArr.length;
	}
	$('#sentprogress').dialog('open').dialog('setTitle','发送短信进度');
	$('.progress-span').html('');
	$('.progress-bili').html('');
	$('.progress-line hr').css('width',0);
	var k=1;
	for(var i=0;i<length;i++){
		$.post('../../../../php/action/page/sms/sms.act.php?action=sendToPhone',{id:id,admin_id:admin_id,smsPhone:phoneArr[i],isSent:isSent},function(data){
			//alert(data.message);
			$('.progress-span').html('第'+k+'条 / 共'+length+'条');
			var scale=(k/length)*100;
			if(parseInt(scale)!=scale)scale=scale.toFixed(2);
			$('.progress-line hr').css('width',scale+'%');
			$('.progress-bili').html('已完成 '+scale+'%');
			//$('.progress-bili').html('已完成 '+(k/length).toFixed(2).slice(2,4)+'%');
			if(k==length){
				setTimeout(function(){
				$('#sentprogress').dialog('close');
				$('#smsgrid').datagrid('reload');
				},1000)
			}
			k+=1;
	/*
			alert(data.message);
			if(data.message=='保存成功，请找管理员进行短信发送！'){
				$('#sentprogress').dialog('close');
				$('#addInfo').dialog('close');
				$('#smsgrid').datagrid('reload');
			}
			if(data.success){
				$('#sentprogress').dialog('close');
				$('#addInfo').dialog('close');
				$('#smsgrid').datagrid('reload');
			}
	*/
		});
	}
}
/*
function getProgress(id,smsPhonestr){
	$('#sentprogress').dialog('open').dialog('setTitle','发送短信进度');
	$.post('../../../../php/action/page/sms/sms.act.php?action=getProgress',{id:id,smsPhonestr:smsPhonestr},function(data){
		if(data!=0){
			$('.progress-span').html('');
			$('.progress-span').html('第'+data.count+'条 / 共'+data.total+'条');
			
			$('.progress-line hr').css('width',(parseInt(data.count)/parseInt(data.total)).toFixed(2).slice(2,4)+'%');
			$('.progress-bili').html('已完成 '+(parseInt(data.count)/parseInt(data.total)).toFixed(2).slice(2,4)+'%');
			//$('.progress-line hr').css('width','100%');
			if(data.count==data.total){
				$('#sentprogress').dialog('close');
				$('#addInfo').dialog('close');
				$('#smsgrid').datagrid('reload');
			}
		}
	},'json');
}
//发送此信息，此方法暂停使用
function adminSendSms(id,smsPhone){
	
	$.post('../../../../php/action/page/sms/sms.act.php?action=adminSendSms',{'id':id},function(data){
		alert(data.message);
		if(data.success){
			$('#sentprogress').dialog('close');
			$('#addInfo').dialog('close');
			$('#smsgrid').datagrid('reload');
		}
	},'json');
}
*/
function edtSms(id){
	$.post('../../../../php/action/page/sms/sms.act.php?action=findById',{'id':id},function(data){
		$('#addInfo').dialog('open').dialog('setTitle','修改短消息');
		$('#add-form').form('load',data);
	},'json');
	url='../../../../php/action/page/sms/sms.act.php?action=editSms&id='+id;
}

function delSms(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
     	if (r){
			$.post('../../../../php/action/page/sms/sms.act.php?action=delSms',{'id':id},function(data){
				$('#smsgrid').datagrid('reload');
			});				 
     	}
	}); 
}

function delArrSms(){
	var rows = $("#smsgrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的数据信息','info');
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;
		}
		$.messager.confirm('消息提示','确定删除吗？',function(r){
			if (r){
				$.get('../../../../php/action/page/sms/sms.act.php?action=delArrSms&idlist='+list,function(data){
					$('#smsgrid').datagrid('reload');
				});
			}
		});
	}	
}

function importList(){
	$('#importList').dialog('open').dialog('setTitle','导入通讯录');
}

function exportList(){
	$('#exportList').dialog('open').dialog('setTitle','导出通讯录');
}

function importCSV(){
	alert('导入通讯录CSV');
}

function importExcel(){
	alert('导入通讯录Excel');
}

function exportCSV(){
	alert('导出通讯录CSV');
}

function exportExcel(){
	alert('导出通讯录Excel');
}
//获取通讯录
function getCommunicate(){
	getMyCommunicate();
	$.post('../../../../php/action/page/admin/admininfo.act.php?action=getOthersList',function(data){
		var html_str='';
		for(var i=0;i<data.length;i++){
			html_str+='<div class="otherList'+i+'"><a href="#" class="otherSmsList'+i+'" onclick="getOtherList('+i+','+data[i].id+',\''+data[i].listID+'\','+data.length+')">'+data[i].realname+'</a><ul id="otherTreeData'+i+'" style="display:none;"></ul></div>';
		}
		$('.othersCommunicate').html(html_str);
	},'json');
	$('#myCommunicate').bind('click',function(){
		$('.othersCommunicate').css('display','none');
		if($('.myCommunicate').css('display')=='block'){
			$('.myCommunicate').css('display','none');
		}else{
			$('.myCommunicate').css('display','block');
		}
	});
	$('#othersCommunicate').bind('click',function(){
		$('.myCommunicate').css('display','none');
		if($('.othersCommunicate').css('display')=='block'){
			$('.othersCommunicate').css('display','none');
		}else{
			$('.othersCommunicate').css('display','block');
		}
	});

}

function getMyCommunicate(){
	$(".myCommunicate").tree({
		url:'../../../../php/action/page/sms/sms.act.php?action=treeData',
		checkbox:true,
		animate:true,
		lines:false,
		
		onBeforeExpand:function(node){
			var node1=$('.myCommunicate').tree('getParent',node.target);
			if(node1==null){
					$(this).tree('collapseAll');	
			}else{
					var child = $(".myCommunicate").tree('getChildren',node1.target);
					for(var i=0; i<child.length; i++){
						$(this).tree('collapse',child[i].target);	
					}
			}
			$(this).tree('options').url='../../../../php/action/page/sms/sms.act.php?action=treeData&up_id='+node.id;
		},
		onSelect:function(node){
			if(node.state=='closed'){
				var node1=$('.myCommunicate').tree('getParent',node.target);
				if(node1==null){
						$(this).tree('collapseAll');	
				}else{
						var child = $(".myCommunicate").tree('getChildren',node1.target);
						for(var i=0; i<child.length; i++){
							$(this).tree('collapse',child[i].target);	
						}
				}
				$(this).tree('expand',node.target);
			}else{
				$(this).tree('collapse',node.target);
			}
			$(this).tree('options').url='../../../../php/action/page/sms/sms.act.php?action=treeData&up_id='+node.id;
		},
		onCheck:function(node){
			getMyChecked();
		},
		onLoadSuccess: function (node,data) {
			//$(".myCommunicate").tree("expandAll"); 
			//$(".myCommunicate").tree("collapseAll"); 
		},
	});
}

function getOtherList(index,otherID,listID,length){
	otherListID=listID;
	for(var i=0; i<length; i++){
		$("#otherTreeData"+i).css("display","none");
	}
	/*$("#otherTreeData"+index).css("display","block");
	upper_cat=".";

	if($("#otherTreeData"+index).css("display")=="block"){
		upper_cat=".";
		$("#otherTreeData"+index).css("display","none");
	}else{*/
		$("#otherTreeData"+index).css("display","block");
		upper_cat=".";
		$("#otherTreeData"+index).tree({
			url:'../../../../php/action/page/sms/sms.act.php?action=otherTreeData&otherID='+otherID+'&listID='+listID,
			checkbox:true,
			animate:true,
			lines:false,
			
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
			    $(this).tree('options').url='../../../../php/action/page/sms/sms.act.php?action=otherTreeData&up_id='+node.id+'&otherID='+otherID+'&listID='+listID;
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
				}
				else{
					$(this).tree('collapse',node.target);
				}
			    $(this).tree('options').url='../../../../php/action/page/sms/sms.act.php?action=otherTreeData&up_id='+node.id+'&otherID='+otherID+'&listID='+listID;
			},
			onCheck:function(node){
				getOthersChecked(index);
			},
			onLoadSuccess: function (node,data) {
				//$("#otherTreeData"+index).tree("expandAll"); 
				//$("#otherTreeData"+index).tree("collapseAll"); 
			},
		});
	//}
	//alert(treeID);
}

function getOthersChecked(index){
	var node1 = $('#otherTreeData'+index).tree('getChecked');
	var node2 = $('#otherTreeData'+index).tree('getChecked','unchecked');
	//选择的他人通讯录中的人
	for (var i = 0; i < node1.length; i++) {
		var phoneStr = '';
		if (node1[i].phone!= undefined){
			//nameStr = node1[i].text+';';
			//nameStr = node1[i].text+'<'+node1[i].phone+'-'+node1[i].id+'>;';
			nameStr = node1[i].text+'<'+node1[i].phone+'>;';
			if(nameStr!=''&&$("textarea[name='smsPhone']")[0].value.indexOf(node1[i].phone)<0){
				$("textarea[name='smsPhone']")[0].value+=nameStr;
			}
		}
	}
	//取消选择的他人通讯录中的人
	for (var i = 0; i < node2.length; i++) {
		var nameStr = '';
		if (node2[i].phone!= undefined){
			//nameStr = node2[i].text+';';
			//nameStr = node2[i].text+'<'+node2[i].phone+'-'+node2[i].id+'>;';
			nameStr = node2[i].text+'<'+node2[i].phone+'>;';
			if(nameStr!=''&&$("textarea[name='smsPhone']")[0].value.indexOf(nameStr)>-1){
				$("textarea[name='smsPhone']")[0].value=$("textarea[name='smsPhone']")[0].value.replace(nameStr,"");
			}
		}
	}
}
function getMyChecked(){
	var node3 = $('.myCommunicate').tree('getChecked');
	var node4 = $('.myCommunicate').tree('getChecked','unchecked');
	//选择的我的通讯录中的人
	for (var i = 0; i < node3.length; i++) {
		var nameStr = '';
		if (node3[i].phone!= undefined){
			//nameStr = node3[i].text+';';
			//nameStr = node3[i].text+'<'+node3[i].phone+'-'+node3[i].id+'>;';
			nameStr = node3[i].text+'<'+node3[i].phone+'>;';
			if(nameStr!=''&&$("textarea[name='smsPhone']")[0].value.indexOf(node3[i].phone)<0){
				$("textarea[name='smsPhone']")[0].value+=nameStr;
			}
		}
	}
	//取消选择的我的通讯录中的人
	for (var i = 0; i < node4.length; i++) {
		var nameStr = '';
		if (node4[i].phone!= undefined){
			//nameStr = node4[i].text+';';
			//nameStr = node4[i].text+'<'+node4[i].phone+'-'+node4[i].id+'>;';
			nameStr = node4[i].text+'<'+node4[i].phone+'>;';
			if(nameStr!=''&&$("textarea[name='smsPhone']")[0].value.indexOf(nameStr)>-1){
				$("textarea[name='smsPhone']")[0].value=$("textarea[name='smsPhone']")[0].value.replace(nameStr,"");
			}
		}
	}
}


						
function getCommunicate_(){
	$('.communicate-list').html('');
	$.post('../../../../php/action/page/sms/sms.act.php?action=getCommunicate',function(data){
		var htmlstr='';
		for(var i=0;i<data.length;i++){
			htmlstr+='<div class="group-block group-block'+data[i].id+'">\
          <div class="communicate-group communicate-group'+data[i].id+'"><input type="checkbox" class="group-check'+data[i].id+'"><span>'+data[i].cat_name+'</span></div>\
        </div><!--group-block-->\
			';
			get_comm_list(data[i].id);
		}
		$('.communicate-list').html(htmlstr);
	},'json');
}

function get_comm_list(group_id){
	$.post('../../../../php/action/page/sms/sms.act.php?action=get_comm_list',{group_id:group_id},function(data){
		var htmlstr='';
		if(data!=null){
			for(var i=0;i<data.length;i++){
				htmlstr+='<div class="communicate-person communicate-person'+data[i].id+'" onclick="get_tel('+group_id+','+data[i].id+','+data[i].tel+')"><input type="checkbox" onclick="get_tel('+group_id+','+data[i].id+','+data[i].tel+')"><span>'+data[i].name+'</span></div>';
			}
		}
		$('.communicate-group'+group_id).after(htmlstr);
		if(data!=null){
			$('.communicate-group'+group_id).bind('click',function(){
				//显示或者隐藏所点击类别下的通讯录
				if($('.group-block'+group_id+' .communicate-person').css("display")=="block"){
					$('.group-block'+group_id+' .communicate-person').css({'display':'none'});
				}else{
					$('.group-block'+group_id+' .communicate-person').css({'display':'block'});
				}
				
				//正选或反选某类下的通讯录
				var tel_str='';
				if($('.group-check'+group_id).is(':checked')){
					var tel_str='';
					for(var i=0;i<data.length;i++){
						$('.group-block'+group_id+' .communicate-person input')[i].checked="checked";
						tel_str+=data[i].tel+';';
					}
					if($("input[name='smsPhone']")[0].value.indexOf(tel_str)<0){
						$("input[name='smsPhone']")[0].value+=tel_str;
					}else{
						$("input[name='smsPhone']")[0].value+='';
					}
					/*
					for(var i=0;i<data.length;i++){
						$('.group-block'+group_id+' .communicate-person input')[i].checked="checked";
						if($("input[name='smsPhone']")[0].value.indexOf(data[i].tel)<0){
							$("input[name='smsPhone']")[0].value+=data[i].tel+';';
						}else{
							$("input[name='smsPhone']")[0].value+='';
						}
					}
					*/
				}else{
					for(var i=0;i<data.length;i++){
						$('.group-block'+group_id+' .communicate-person input')[i].checked="";
						$("input[name='smsPhone']")[0].value=$("input[name='smsPhone']")[0].value.replace(data[i].tel+';',"");
					}
				}
			});//分类绑定点击事件
		}
	},'json');
}

function get_tel(group_id,person_id,tel){
	if($('.communicate-person'+person_id+' input').is(":checked")){
		$('.communicate-person'+person_id+' input')[0].checked="";
		$('.group-check'+group_id)[0].checked="";
		$("input[name='smsPhone']")[0].value=$("input[name='smsPhone']")[0].value.replace(tel+';',"");
	}else{
		$('.communicate-person'+person_id+' input')[0].checked="checked";
		if($("input[name='smsPhone']")[0].value.indexOf(tel)<0){
			$("input[name='smsPhone']")[0].value+=tel+';';
		}else{
			$("input[name='smsPhone']")[0].value+='';
		}
	}
}

function replySms(id){
	$.post('../../../../php/action/page/sms/sms.act.php?action=get_replySms',{id:id},function(data){
		var str='';
		if(data!=0){
			for(var i=0;i<data.length;i++){
				str+=(data[i].replyName==null?data[i].replyPhone:data[i].replyName)+'：'+data[i].replyContent+'   ';
			}
			alert(str);
		}else{
			alert('暂无回复！');
		}
	},'json');
	//alert(id);
}

function reload_reply(){
	$.post('../../../../php/action/page/sms/sms.act.php?action=reload_reply',function(data){
		alert(data.message);
	},'json');
}

function reload_replys(){
	$.post('../../../../php/action/page/sms/sms.act.php?action=reload_reply',function(data){
	},'json');
}

/*
功能：查看无编号回复
*/
function getOtherReply(id,phoneStr,sendtime){
	sendId=id;
	sendPhoneStr=phoneStr;
	sendTimeStr=sendtime;
	$('#checkDlg').dialog('open').dialog('setTitle','查看无编号回复');
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
				   
		url:'../../../../php/action/page/sms/sms.act.php?action=getOtherReply&id='+id+'&phoneStr='+phoneStr+'&sendtime='+sendtime,
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'replyPhone',title:'回复人电话',width:50},
			{field:'replyName',title:'回复人姓名',width:50},
			{field:'replyContent',title:'回复内容',width:200},
			{field:'replyTime',title:'回复时间',width:100},
			{field:'action',title:'操作',width:80,align:'center',
				formatter:function(value,row,index){
					//var a='<a href="javascript:void(0)" onclick="getSendMess(\''+row.id+'\',\''+row.replyName+'\',\"'+row.replyContent+'\",\''+row.replyTime+'\',\''+row.replyPhone+'\',0,\'reply\')">查看信息内容</a>';
					var a='<a href="javascript:void(0)" onclick="getSendMess(\''+row.id+'\',\''+row.replyName+'\',\''+row.replyTime+'\',\''+row.replyPhone+'\',0,\'reply\')">查看信息内容</a>';
					return a;	
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
function exportReply(){
	sendTimeStr=sendTimeStr.substr(0,10)+' 00:00:00';
	//sendId=id;
	//sendPhoneStr=phoneStr;
	/*
	$.post('../../../../php/action/page/sms/sms.act.php?action=exportReply',{id:sendId,phoneStr:sendPhoneStr,sendtime:sendTimeStr},function(data){
		alert(data.message);
	},'json');
	*/
	var id_str='';
	id_str=sendId>14?(sendId>254?(sendId>4094?sendId.toString(16):'0'+sendId.toString(16)):'00'+sendId.toString(16)):'000'+sendId.toString(16);
	phoneArr=sendPhoneStr.split(';');
	var phoneArr_str='';
	for(var i=0;i<phoneArr.length;i++){
		phoneArr_str+='\''+phoneArr[i]+'\',\'86'+phoneArr[i]+'\'';
		if(i<phoneArr.length-1){
			phoneArr_str+=',';
		}
	}
	//alert(phoneArr_str);return;
	window.location.href='http://'+window.location.host+':83/message/replyexport.htm?id_str='+id_str+'&phoneStr='+phoneArr_str+'&sendTimeStr='+sendTimeStr;//&sendtime=sendTimeStr";
}


function exploreReply1(id,smsPhone,sendtime){
	var id_str='';
	//id_str=id>9?(id>99?(id>999?id:'0'+id):'00'+id):'000'+id;
	id_str=id>14?(id>254?(id>4094?id.toString(16):'0'+id.toString(16)):'00'+id.toString(16)):'000'+id.toString(16);
	phoneArr=smsPhone.split(';');
	var phoneArr_str='';
	for(var i=0;i<phoneArr.length;i++){
		phoneArr_str+='\''+phoneArr[i]+'\',\'86'+phoneArr[i]+'\'';
		if(i<phoneArr.length-1){
			phoneArr_str+=',';
		}
	}
	//alert(phoneArr_str);return;
	window.location.href='http://'+window.location.host+':83/message/replyexport1.htm?id_str='+id_str+'&phoneStr='+phoneArr_str+'';//&sendtime=$sendtime";
}

function getYE(){
	$.post('../../../../php/action/page/sms/sms.act.php?action=getYE',function(data){
		if(data.flag!=0&&data.balance!=''){
			$('#myYE').css('display','block');
			$('.balance').html(data.balance);
		}
	},'json');
}

function close_sendSms(){
	$('#addInfo').dialog('close');
	$('#sentprogress').dialog('close');
	//$('.progress').css('display','none');
}

function closeDetail(){
	$('#sentprogress').dialog('close');
	$('#smsDetails').dialog('close');
}



function close_progress(){
	$('#sentprogress').dialog('close');
}

/*
功能：修改通讯录信息
*/
	var smsList_id=0;
function edtInfo(phone){
	$('#newFm').form('clear');
	$.post('../../../../php/action/page/sms/sms.act.php?action=getAllSmsList&phone='+phone,function(result){
		res = result;
		$('#newDlg').dialog('open').dialog('setTitle','修改通讯录信息');
		//$('#name').html(res.name);
		//$('#company').html(res.company);
		//$('#job').html(res.job);
		smsList_id=res.id;
		$('#newFm').form('load',res);
		$('#newFm').form('load',{'cat_id':parseInt(res.catId)});
	},'json');
	url = '../../../../php/action/page/sms/sms.act.php?action=updInfo&phone='+phone;
}

function saveInfo(){
	url+='&id='+smsList_id;
	if($('input[name="cat_id"]').val()==0){
		alert('请选择分组！');
		return;
	}
		$('#newFm').form('submit',{
			url:url,
			success:function(result){
				$('#newDlg').dialog('close');
				$('#smsDetails').dialog('close');
				$('#smsgrid').datagrid('reload');
			}
		});
}

function editSmsPhoneDlg(id,phone){
	$('#editSmsPhoneDlg').form('clear');
	$('#editSmsPhoneDlg').dialog('open').dialog('setTitle','修改此手机号');
	$('#editSmsPhoneDlg').form('load',{'smsphone':phone});
	url='../../../../php/action/page/sms/sms.act.php?action=editSmsPhone&id='+id+'&phone='+phone;
}

function editSmsPhone(phone){
	url+='&smsphone='+$('#smsphone').val();
	$.post(url,function(result){
		if(result>0){
			alert('修改成功！');
			$('#editSmsPhoneDlg').dialog('close');
			$('#smsDetails').dialog('close');
			$('#smsgrid').datagrid('reload');
		}else{
			alert('修改失败！');
		}
	});
}

function countSms(){
	window.location.href='sms_recommend.html';
}

//获取通讯录搜索结果
function getSearch(){
	var catList=new Array();
	var condition=$('#seach-list').val();
	if(condition=='' || condition==null){
		$('.communicate-list').css('display','block');
		$('.seach-list').css('display','none');
	}else{
		if(pridge=='super'){
			catList='';
		}else{
			$('.communicate-list').css('display','none');
			$('.seach-list').css('display','block');

			$.post('../../../../php/action/page/admin/admininfo.act.php?action=getOthersList',function(result){
				for(var j=0; j<result.length; j++){
					catList[j]=result[j].listID;	
				}
				$.post('../../../../php/action/page/sms/sms.act.php?action=getSearch',{condition:condition,catList:catList},function(data){
					var htmlStr='';
					for(var i=0; i<data.length; i++){
						htmlStr+='<li><a href="javascript:void(0)" onclick="rendPlist(\''+data[i].name+'\',\''+data[i].tel+'\')">'+data[i].name+'<div>('+data[i].tel+')</div></a></li>'
					}
					$('.seach-list ul').html(htmlStr);
				},'json')	
			},'json')
		}
		
	}
}
function rendPlist(name,tel){
	var tellist=name+'<'+tel+'>;';
	if($("textarea[name='smsPhone']")[0].value.indexOf(tellist)<0){
		$("textarea[name='smsPhone']")[0].value+=tellist;	
	}
	setTimeout(showlist,3000);
}
function showlist(){
	$('.communicate-list').css('display','block');
	$('.seach-list').css('display','none');
}