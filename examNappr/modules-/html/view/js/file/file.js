// JavaScript Document
var curr_time = new Date();

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
	//设置拟稿日期默认值
	$("#addedDate").datebox("setValue",myformatter(curr_time));
	uploadify();
	//getCatList('department');
	$.get('../../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		if(data=='super'){
			//loadPage();	
		}else{
			if(data.indexOf('file_add')<0){
				$('body').html('<h1>您没有操作权限!</h1>');			
			}
		}
	});				   						
});

//上传附件
function attach(){
   $('#file_upload').uploadify('settings', 'formData', {'typeCode':document.getElementById('id_file').value});$('#file_upload').uploadify('upload','*');
}
/*
**提交验证
*/
function check(){
   //editor.sync();
   var addedDate =  $.trim($('#addedDate').datebox('getValue')); 
   var types = $.trim($('#types option:selected').val()); 
   var file_level = $.trim($('#file_level option:selected').val()); 
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
   if($.trim($('#file_upload-queue').html())==''){
	save();   
	}
	else{
   attach();
	}
/*   setTimeout(save(),'6000');*/

      /*var attach_name = document.getElementById("attach_name").value;
   setTimeout(alert(attach_name)*/

}
/*
*保存
*/
function save(){
	$('#newfm').form('submit',{
		url:'../../../../php/action/page/file/file.act.php?action=save',
		success:function(result){
			if(result>0){
				//KindEditor.instances[0].html("");
				$('#newfm').form('clear');
				$('#newfm').form('load',{'types':'党组','file_level':'非密','addedDate':myformatter(curr_time)});
				$('#types').val('党组');
				$('#file_level').val('非密');
				getword(result);
				alert('创建文件成功！');
			}else{
				alert('创建文件失败！');
			}
		}
	});
}
/*
*上传附件
*/
function uploadify(){
    $('#file_upload').uploadify({
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
			   $('#attach_name').val(res.filename+','+$("#attach_name").val());
			   $('#file_auto_name').val(res.file_auto_filename+','+$("#file_auto_name").val());
	        },
        'onQueueComplete' : function(queueData) {//上传队列全部完成后执行的回调函数
			save();
			// if(img_id_upload.length>0)
           // alert('成功上传的文件有：'+encodeURIComponent(img_id_upload));
        }  
    });
};
function getword(id){
	window.location='http://'+window.location.host+':83/MS-Word/docWord_table/getword.htm?id='+id;
}
