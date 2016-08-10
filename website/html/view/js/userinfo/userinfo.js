function submit_data(){
	 
	    var complete = completeInput();
	    if(complete)
	    {
			$('#user_info').form('submit' ,{
				url: '/modules/php/action/page/applycation/userinfo.act.php?action=userinfo',
				success: function(result){
					$.messager.alert('提示','信息修改成功！','info',function(){
						window.location.href="/website/html/view/template/userinfo/userinfo.html";

					});
				}
			});
	    }else{
	    	$.messager.alert('提示','信息不完整，请完善信息后提交！');
	    }
	}


//自动获取数据库
$(function(){
    //用来获取当前的文件的url

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
			    if(certi_url != null && certi_url != ''){
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
    if(certi_url != null && certi_url != ''){
    	$('#lookCerti').show();
    	$('#lookCerti').attr("href",certi_url);
    }else{
    	$('#lookCerti').hide();
    }
		loadApplyInfo();
	});
	function loadApplyInfo(){	
		$.get('/modules/php/action/page/applycation/userinfo.act.php?action=findUserInfo',function(result){
			if(result!='0'){
				var res = JSON.parse(result);
				$('#user_info').form('load',res);
			}
		});
	}
	
	
function cancel_readonly(){
	 var obj=document.getElementsByTagName("input");
	 for(var i=0;i<obj.length;i++){
		   if(obj[i].name != 'org_code'){
			 obj[i].readOnly=false; 
			 obj[i].style.backgroundColor="#d2d2d2"; 
			 //obj[i].style.backgroundColor="#fff";
		   }
	 }
}

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if($(this).attr("id") == 'pub_pic_1' || $(this).attr("id") == 'pub_pic' || $(this).attr("id") == 'reg_pic_1' || $(this).attr("id") == 'reg_pic'){
			 return true;s
		}
		if(!$(this).val()) {
			returnValue = false;
		}
	});
	return returnValue;
}

function reset(){
	$("#user_info")[0].reset();
}