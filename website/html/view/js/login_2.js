$(function()
  {
     loadApplyInfo();
  });
	function loadApplyInfo(){
		var org_code = GetQueryString("org_code");
		$.get('../../../../../modules/php/action/page/register/register.act.php?action=findOrg&org_code=' + org_code,function(result){
			if(result!='0'){
//				alert(result);
				var res=eval("("+result+")");
				$('#fm').form('load',res);
			}
		});
		
		
	}
/*
 * 获取URL里面的参数
 */
function GetQueryString(name){
   var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
   var r = window.location.search.substr(1).match(reg);
   if(r!=null)return  unescape(r[2]); return null;
}
	


function addOrg(){
	
	var str='';
	
	if($('input[name="orgCode"]').val()==''){
		str+='组织机构代码 ';	
	}
	if($('input[name="orgName"]').val()==''){
		str+='申报单位名称 ';	
	}

	if($('input[name="email"]').val()==''){
		str+='电子邮箱 ';	
	}

	if($('input[name="legalPerson"]').val()==''){
		str+='企业法人 ';	
	}
	if($('input[name="contact"]').val()==''){
		str+='联系人 ';	
	}
	if($('input[name="telphone"]').val()==''){
		str+='联系人手机 ';	
	}
	if($('input[name="address"]').val()==''){
		str+='通讯地址 ';	
	}
	if($('input[name="phone"]').val()==''){
		str+='联系电话 ';	
	}
	
	if(str!=''){
		$.messager.alert('提示',str+'输入项不能为空','info');
		return;		
	}	
	
	/*if($('input[name="file"]').val()==''){
		$.messager.alert('提示','请上传税务登记证文件','info');
		return;	
	}*/
	
	if($('input[name="file"]').val()!=''){
		var a=$('input[name="file"]').val();
		a=a.substr(a.lastIndexOf('.'));
		if(!(a=='.jpg'||a=='.jpeg'||a=='.png'||a=='.gif')){
			$.messager.alert('提示','请上传正确的税务登记证文件','info');
			return;		
		}
	}
	
	/*if($('input[name="file1"]').val()==''){
		$.messager.alert('提示','请上传工商营业执照文件','info');
		return;	
	}*/
	
	if($('input[name="file1"]').val()!=''){
		var b=$('input[name="file1"]').val();
		b=b.substr(b.lastIndexOf('.'));
		if(!(b=='.jpg'||b=='.jpeg'||b=='.png'||b=='.gif')){
			$.messager.alert('提示','请上传正确工商营业执照文件','info');
			return;		
		}
	}
	
		$('#fm').form('submit',{
			url:'../../../php/action/page/applyOrg_add.act.php',
			onSubmit: function(){
			},
			success: function(result){
/*				if(result == "orgexist"){
					$.messager.alert("操作提示", "该公司已注册账号，账号信息请咨询贵公司管理员！","info");
				}*/
//				else{
					$.messager.alert('提示',"信息完善完成！",'info',function(){
						window.location.href="../main-xmsbxt.html";
						$('#fm').each(function(){
							$(this).find('input').val('');
						});
					});
			}	
		});	
}

function tologinhtml(){
	window.location.href="index.html";	
}
