var org_code;

$(function() {
     loadApplyInfo();//不要注释掉  zgf
     var ts;
     var token;
      $.ajax({
               url : "/website/html/view/template/Projectapp/uploadify.php?action=getUpinfo",
               type : 'POST',
               async: false,
               dataType : 'json',
               success : function(data) {
                   ts = data.timestamp;
                   token = data.token;
               },
               error : function(data) {
                   //alert("修改失败，请重试，或联系管理员！");
               }
       });
      
      
    //david 20160303 增加
      var permit_url;
      var certi_url;
  	  var pub_pic_url;
  	  
      $.ajax({
          url : "/website/html/view/template/Projectapp/uploadify.php?action=getOrgfile",
          type : 'POST',
          async: false,
          dataType : 'json',
          success : function(data) {
          	permit_url = data.permit_url;
          	certi_url = data.certi_url;
          },
          error : function(data) {
              //alert("修改失败，请重试，或联系管理员！");
          }
  	});
      
      //需要将数据url重新绑定到 a标签上去
      if(permit_url != null  && permit_url != ''){
    	$('#lookPermit').show();
      	$('#lookPermit').attr("href",permit_url);
      }else{
      	$('#lookPermit').hide();
      }
      if(certi_url != null && certi_url != ''){
    	$('#lookCerti').show();
      	$('#lookCerti').attr("href",certi_url);
      }else{
      	$('#lookCerti').hide();
      }
      $('#pub_pic').uploadify({
  		   'formData'     : {
  			   'timestamp' : ts,
  			   'token'     : token
  		   },
  		   'fileSizeLimit' : '2MB',
            'multi'    : false,
  		   'swf'      : '/website/html/view/js/uploadify.swf',
  		   'uploader' : '/website/html/view/template/Projectapp/uploadify.php?action=legal&permit_certi=0',   //这样子的写法到最后是找不到文件的。
  		   'buttonText' : '选择上传文件',
  		   'fileTypeExts' : '*.gif; *.jpg; *.png',
  		   'overrideEvents' : ['onSelectError','onUploadError'],
  		   'onUploadSuccess' : function(file, data, response){
  			   //alert('文件' + data + ' 上传完成。');
  			   $.ajax({
  			        url : "/website/html/view/template/Projectapp/uploadify.php?action=getOrgfile",
  			        type : 'POST',
  			        async: false,
  			        dataType : 'json',
  			        success : function(data) {
  			        	permit_url = data.permit_url;
  			        	certi_url = data.certi_url;
  			        },
  			        error : function(data) {
  			            //alert("修改失败，请重试，或联系管理员！");
  			        }
  				});
  			    
  			    //需要将数据url重新绑定到 a标签上去
  			    if(permit_url != null && permit_url != ''){
  			    	$('#lookPermit').show();
  			    	$('#lookPermit').attr("href",permit_url);
  			    }else{
  			    	$('#lookPermit').hide();
  			    }
  			},
  			'onSelectError' : function() {
  				$.messager.alert("提示",'单个文件大小超过了2M，请重新检查后上传');return;
  	        },
  	        'onUploadError' : function(file, errorCode, errorMsg, errorString){
  				alert("111");
  	        }
  	   });
      
  	var reg_pic_url="";
      $('#reg_pic').uploadify({
  		   'formData'     : {
  			   'timestamp' : ts,
  			   'token'     : token
  		   },
  		   'fileSizeLimit' : '2MB',
            'multi'    : false,
  		   'swf'      : '/website/html/view/js/uploadify.swf',
  		   'uploader' : '/website/html/view/template/Projectapp/uploadify.php?action=legal&permit_certi=1',
  		   'buttonText' : '选择上传文件',
  		   'fileTypeExts' : '*.gif; *.jpg; *.png',
  		   'overrideEvents' : ['onSelectError','onUploadError'],
  		   'onUploadSuccess' : function(file, data, response) {
  			   $.ajax({
  			        url : "/website/html/view/template/Projectapp/uploadify.php?action=getOrgfile",
  			        type : 'POST',
  			        async: false,
  			        dataType : 'json',
  			        success : function(data) {
  			        	permit_url = data.permit_url;
  			        	certi_url = data.certi_url;
  			        },
  			        error : function(data) {
  			            //alert("修改失败，请重试，或联系管理员！");
  			        }
  				});
  			    
  			    //需要将数据url重新绑定到 a标签上去
  			    if(certi_url != null && certi_url!= ''){
  			    	$('#lookCerti').show();
  			    	$('#lookCerti').attr("href",certi_url);
  			    }else{
  			    	$('#lookCerti').hide();
  			    }
  			},
  			'onSelectError' : function() {
  				$.messager.alert("提示",'单个文件大小超过了2M，请重新检查后上传');return;
  	        },
  	        'onUploadError' : function(file, errorCode, errorMsg, errorString){
  				alert("111");
  	        }
  	   });
  	


});

function loadApplyInfo(){
    org_code = GetQueryString("org_code");
    $.get('../../../../../modules/php/action/page/register/register.act.php?action=findOrg&org_code=' + org_code,function(result){
        if(result!='0'){
            var res=eval("("+result+")");
            $('#fm').form('load',res);
        }
    });
    
    
}
function showPic($url){
	window.open($url);
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

	if($('input[name="org_name"]').val()==''){
		str+='申报单位名称 ';	
	} 
	
	if($('input[name="phone"]').val()==''){
		str+='联系电话 ';	
	}
	
	if($('input[name="email"]').val()==''){
		str+='电子邮箱 ';	
	}
	if($('input[name="legalPerson"]').val()==''){
		str+='企业法人 ';	
	}
	
	if($('input[name="legal_phone"]').val()==''){
		str+='法人电话 ';	
	}
	
	if($('input[name="register_address"]').val()==''){
		str+='注册地址 ';	
	}
	
	if($('input[name="contact_address"]').val()==''){
		str+='通讯地址 ';	
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
	
	
	if(str!=''){
		$.messager.alert('提示',str+'输入项不能为空','info');
		return;		
	}	
	
	/*if($('input[name="file"]').val()==''){
		$.messager.alert('提示','请上传税务登记证文件','info');
		return;	
	}*/
	
/*	if($('input[name="file"]').val()!=''){
		var a=$('input[name="file"]').val();
		a=a.substr(a.lastIndexOf('.'));
		if(!(a=='.jpg'||a=='.jpeg'||a=='.png'||a=='.gif')){
			$.messager.alert('提示','请上传正确的税务登记证文件','info');
			return;		
		}
	}*/
	
	/*if($('input[name="file1"]').val()==''){
		$.messager.alert('提示','请上传工商营业执照文件','info');
		return;	
	}*/
	
/*	if($('input[name="file1"]').val()!=''){
		var b=$('input[name="file1"]').val();
		b=b.substr(b.lastIndexOf('.'));
		if(!(b=='.jpg'||b=='.jpeg'||b=='.png'||b=='.gif')){
			$.messager.alert('提示','请上传正确工商营业执照文件','info');
			return;		
		}
	}*/
	$('#fm').form('submit',{
		url:'../../../php/action/page/applyOrg_add.act.php?org_code=' + org_code,
		onSubmit: function(){
		},
		success: function(result){
			var res = eval("(" + result + ")");
			
			if(res.code == 0){
				$.messager.alert("错误提示", "发生错误！请联系管理员","info");
				window.location.href = "index.php";
			}
			else{
				$.messager.alert('提示',"注册成功，点击确定进行跳转",'info',function(){
//					window.location.href="index.php";
					window.location.href="main-xmsbxt.html";
					$('#fm').each(function(){
						$(this).find('input').val('');
					});
				});
			}
			//$('#fm').form('clear');
		}	
	});
}

function tologinhtml(){
//	window.location.href="index.php";
	//2015.12.29 修改了注册完成后的返回界面
	window.location.href="main-xmsbxt.html";	
	
}
