// JavaScript Document
//获取管理分类列表
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

$(function(){
	$('body').css('display','none');
		$.get('../../../../php/action/page/jdgPge.act.php',function(data){
			if(data=='super'){
				$('body').css('display','block');
			}else{
				if(data.indexOf('seal_add')<0){
					$('body').html('<h2>您没有操作权限</h2>');
					$('body').css('display','block');
				}else{
					$('body').css('display','block');
				}	
			}
		});
	$('#use_time').datebox('setValue',myformatter(new Date()));
	//getCatList('contentcat_id');
	getDept();
	$('#select').change(function(){
		if($(this).children('option:selected').val()==0){
			$('#endt').hide();
		}else{
			$('#endt').show();
		}
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
/**
* 获取用章部门或科室列表
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
* 提交用章申请
*/
function saveInfo(){
	var pdg=$("input[type='radio']:checked").val();
	$('#content').val(pdg);
	var total = $('#total').val();
	var use_time = $('#use_time').datebox('getValue'); 
	var end_time = $('#end_time').datebox('getValue'); 
	//var contentcat_id = $('#contentcat_id').datebox('getValue'); 
	var reason = $('#reason').val();
	var content = $('#content').val();
	//var admin = $('#admin').val();
	//var user = $('#user').val();
	  
    if(total ==  null || total == ''){
			alert("件数不能为空");
			$('#total').focus();
			return false;
	}
	if(use_time ==  null || use_time == ''){
			alert("开始日期不能为空");
		   return false;
	}
	if($("#select").val()==1){
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
			$('#reason').focus();
			return false;
	}
    if(pdg==undefined){
			alert("用章内容不能为空");
			$('#content').focus();
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
	$('#form1').form('submit',{
     	url:'../../../../php/action/page/file/seal.act.php?action=saveApply&category='+$('#category').val(),
     	onSubmit: function(){
    	},
     	success: function(result){
			if(result>0){
				var flag=0;
				if($("#select").val()==1){
					flag=1;
				}
				$('#form1').form('clear');
				$('#use_time').datebox('setValue',myformatter(new Date()));
				$('#select').val('0');
				$('#endt').hide();
				$('#dept').val($('#deptName').val());
				//$.messager.alert('消息提示','提交申请成功','info
				
				getword(result,flag);
				getDept();
			}else{
				$.messager.alert('消息提示','打印申请失败','info');
			}
			
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
//获取用章人所在部门或科室
function getDept(){
	$.post('../../../../php/action/page/file/seal.act.php?action=getDept',function(data){
		$('#dept').val(data.deptName);
		$('#deptName').val(data.deptName);
		$('#category').val(data.category);
	},'json');	
}