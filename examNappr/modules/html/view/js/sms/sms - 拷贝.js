/**
author:Gao Xue
date:2014-09-10
*/
var url,pridge,sendId,sendPhoneStr,sendTimeStr,flag,timer1;
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
	setTimeout(setInterval(reload_replys,600000),600000);
	getYE();
});

function loadPage(){
	$('#smsgrid').datagrid({
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
								{field:'action',title:'操作',width:10,align:'center',
									formatter:function(value,row,index){
										//var a='<a href="javascript:void(0)" onclick="delSms('+row.id+')">删除</a>'+' | ';
										var a='<a href="javascript:void(0)" onclick="getReplyMess(\''+row.replyContent+'\')">信息内容</a>';
										var str='';
										if(pridge=='super'){
											str=a;//a+
										}else{
												str+=a;
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
			{field:'smsName',title:'收件人',width:10},
			//{field:'content',title:'发送内容',width:150},
			{field:'sendtime',title:'发送时间',width:10},
			{field:'isSent',title:'发送状态',width:10},
			
			{field:'action',title:'操作',width:45,align:'center',
				formatter:function(value,row,index){
					var e='<a href="javascript:void(0)" onclick="adminSendSms(\''+row.id+'\',\''+row.smsPhone+'\')">发送此信息</a>'+' | ';
					var f='已发送 | ';
					var a='<a href="javascript:void(0)" onclick="getOtherReply('+row.id+',\''+row.smsPhone+'\',\''+row.sendtime+'\')">无编号回复</a>'+' | ';
					var b='<a href="javascript:void(0)" onclick="exploreReply1('+row.id+',\''+row.smsPhone+'\',\''+row.sendtime+'\')">导出回复</a>'+' | ';
					var c='<a href="javascript:void(0)" onclick="delSms('+row.id+')">删除</a>'+' | ';
					var d='<a href="javascript:void(0)" onclick="getSendMess(\''+row.id+'\',\''+row.smsName+'\',\''+row.content+'\',\''+row.sendtime+'\',\''+row.isSent+'\',\''+row.faileSent+'\',\'send\')">信息详情</a>';
					var str='';
					if(pridge=='super'){
						if(row.Sent=='1'){
							str+=e;
						}else{
							str+=f;
						}
						str+=a+b+c+d;//
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
						if(pridge.indexOf('sms_del')>=0){
							str+=c;
						}
						str+=d;
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
	alert(replyContent);
}

function getSendMess(id,smsName,replyContent,sendtime,isSent,faileSent,flag_str){//\''+row.smsPhone+'\',\''+row.content+'\',\''+row.sendtime+'\',\''+row.isSent+'\'
	$('#smsDetails').dialog('open').dialog('setTitle','查看短信详细信息');
	$('#smsPhone1').html(smsName);
	$('#replyContent1').html(replyContent);
	$('#sendtime1').html(sendtime);
	$('#isSent1').html(isSent);
	$('#noSuccess1').html(isSent);
	if(flag_str=='send'){
		faileSentArr=faileSent.split('@');
		$('.send_faile').html('<td width="80">发送失败：</td><td id="">'+(faileSentArr[0]==''?'无':faileSentArr[0])+'</td>');
		$('.send_reload').html('<td width="80">重新发送：</td><td>对发送失败的短信,核对号码，如无误 <a href="#" onclick="reSendFaile(\''+id+'\',\''+replyContent+'\',\''+faileSentArr[1]+'\')">重新发送</a></td>');
		
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

function reSendFaile(id,faileMessage,failePhone){
	if(failePhone==''){
		alert('没有发送失败的短信，无需重新发送！');
	}else{
		timer1=setInterval("getProgress(\'"+id+"\',\'"+failePhone+"\')",5000);
		setTimeout(timer1,5000); 	
		
		$.post('../../../../php/action/page/sms/sms.act.php?action=reSendFaileSms',{'id':id,'faileMessage':faileMessage,'failePhone':failePhone},function(data){
			alert(data.message);
			if(data.message=='保存成功，请找管理员进行短信发送！'){
				clearInterval(timer1);
				$('.progress').css('display','none');
				$('#addInfo').dialog('close');
				$('#smsgrid').datagrid('reload');
			}
			if(data.success){
				$('#addInfo').dialog('close');
				$('#smsgrid').datagrid('reload');
			}
		},'json');
	}
}

function newSms(){
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

function sendSms(){
	/*
	var create = DetectNT199Plugin();
	var retVal=0;
	if(create==false){
		retVal = NT199_Find();
		if(retVal > 1){
			alert('插入了多把Ukey，请拔出多余的Ukey！');
			return;
		}
	}
	alert(retVal);return;
*/
	if($("input[name='smsPhone']")[0].value==''){
		alert('请输入收件人！');
		return;
	}
	if($('.content').val()==''){
		alert('请输入短信内容！');
		return;
	}	
	var sms_Phone=$("input[name='smsPhone']")[0].value;
	timer1=setInterval("getProgress(0,\'"+sms_Phone+"\')",5000);
	setTimeout(timer1,5000); 	
	$.post('../../../../php/action/page/sms/sms.act.php?action=getSmsTotal',{isReply:$('#radio')[0].checked,content:$('.content').val(),inscribe:$('.inscribe').val(),smsPhone:$("input[name='smsPhone']")[0].value},function(data){//,retVal:retVal},function(data){
		alert(data.message);
		if(data.message=='保存成功，请找管理员进行短信发送！'){
			clearInterval(timer1);
			$('.progress').css('display','none');
			$('#addInfo').dialog('close');
			$('#smsgrid').datagrid('reload');
		}
		if(data.success){
			$('#addInfo').dialog('close');
			$('#smsgrid').datagrid('reload');
		}
	},'json');
}

function getProgress(id,smsPhonestr){
	$.post('../../../../php/action/page/sms/sms.act.php?action=getProgress',{id:id,smsPhonestr:smsPhonestr},function(data){
		if(data!=0){
			$('.progress-span').html('');
			$('.progress-span').html(data.count+'/'+data.total);
			if(data.count==data.total){
				clearInterval(timer1);
				$('#smsgrid').datagrid('reload');
			}
		}
	},'json');
}

function adminSendSms(id,smsPhone){
	timer1=setInterval("getProgress(\'"+id+"\',\'"+smsPhone+"\')",5000);
	
	setTimeout(timer1,5000); 	
	
	$.post('../../../../php/action/page/sms/sms.act.php?action=adminSendSms',{'id':id},function(data){
		alert(data.message);
		if(data.message=='保存成功，请找管理员进行短信发送！'){
			clearInterval(timer1);
			$('#addInfo').dialog('close');
			$('#smsgrid').datagrid('reload');
		}
		if(data.success){
			$('#addInfo').dialog('close');
			$('#smsgrid').datagrid('reload');
		}
	},'json');
}

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

function getCommunicate(){
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
					//var a='<a href="javascript:void(0)" onclick="delAttach('+row.id+')"> 删除</a>';							
					//var a='<a href="javascript:void(0)" onclick="getSendMess(\''+row.replyContent+'\')">查看信息内容</a>';
					var a='<a href="javascript:void(0)" onclick="getSendMess(\''+row.id+'\',\''+row.replyName+'\',\''+row.replyContent+'\',\''+row.replyTime+'\',\''+row.replyPhone+'\',0,\'reply\')">查看信息内容</a>';
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
	//sendId=id;
	//sendPhoneStr=phoneStr;
	//sendTimeStr=sendtime;
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
	window.location.href='http://'+window.location.host+':83/message/replyexport.htm?id_str='+id_str+'&phoneStr='+phoneArr_str+'';//&sendtime=$sendtime";
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
		if(data.flag!=0){
			$('#myYE').css('display','block');
			$('.balance').html(data.balance);
		}
	},'json');
}

function close_progress(){
	clearInterval(timer1);
	$('.progress').css('display','none');
}




