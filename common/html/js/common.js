
//获取url里面的参数
function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

//区分浏览器的版本
function myBrowser(){
	var userAgent = navigator.userAgent;
	if(userAgent.indexOf("AppleWebKit") > -1){
		return "Firefox";
	}
	if(userAgent.indexOf("Chrome") > -1){
		return "Chrome";
	}
	if(userAgent.indexOf("Opera") > -1){
		return "Opera";
	}
	if(userAgent.indexOf("Firefox") > -1){
		return "Firefox";
	}
	if(userAgent.indexOf("Safari") > -1){
		return "Safari";
	}
	if(userAgent.indexOf("MSIE") > -1 ){
		return "IE";
	}
}

//获取当前的department
function getDepartment(){
	var department;
	$.ajax( {  
		url:"/modules/php/action/page/center/center.act.php?action=getUserDep",//
		type:'post',  
		cache:false,
		async:false,
		dataType:'json',  
		success:function(data) {  
			if(data.msgcode == 200 ){
				// $('#approve').form('load',res);alert(res.project_name);
				department = data.userDep; 
			}else{  
				alert(data.msgcode);
			}  
		},  
		 error : function() {
			  //alert("异常！");
		}  
	});
	return department;
}

