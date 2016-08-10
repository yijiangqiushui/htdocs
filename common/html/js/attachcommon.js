document.write('<script type="text/javascript" src="/common/html/js/common.js"></script>')
var ifSumbmit=false;
$(function(){
	getAttr();
	checkSubmitShow();
	eventBind();
//	adapt_height()
});

function adapt_height() {
	
//	alert($('.menus').height());
//	return ;
	var pheight;
	if(user_type > '0'){
		pheight = $(window).height();
	}else{
		pheight=$(window.parent).height()-120;
	}
//	var pheight = 500;
//	var height=$(".menus").height();
	var height = $(window).height();
//	alert(height);
//	alert("pheight:" +pheight + ",height" + height);
	if(height != pheight) {
		$(".menus").css({"overflow-y":"scroll","overflow-x":"hidden","height":pheight});
		$(".pic").css("margin-right","5px");
	}
}

function resetWNH(){
	$('.menus-scroll-hidden').height($(window).height());
	$('.menus').height($(window).height());
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
}


function eventBind(){	
	hs();
		$('.imp_plan').bind('click',function(){
			$('.iframe iframe').attr('src','/website/html/view/template/Projectapp/uploadFile.php?table_status='+table_status+'&table_id='+table_id + '&user_type='+user_type);
		});
		if (user_type == 1 || user_type == 2 || user_type == 3) {  
		/*    if(table_status==2){  
				$(".menu").mousedown(function(){
					var dk = $("#iframe2").attr("src"); 
					if(dk.indexOf("uploadFile")==-1){//如果是上传文件的话 就不提示
						var nowPage=$(this);
					     $.messager.confirm("操作提示", "不点击保存填写的信息会丢失，是否进行下一步？", function (data) {
					            if (data) {
					            	nowPage.click();
					            }
					            else {
					               //不做任何操作
					            }
						});	
						if(confirm("不点击保存填写的信息会丢失，是否进行下一步？")){
							nowPage.click();
						}
					}
					else{
						//不是文件上传 就不会提示
					}
				 });	     
			    }*/
		}
		if(user_type == 0 || user_type == -1){ 
			if(table_status==1||table_status==3){ 
				$(".menu").mousedown(function(){
					var dk = $("#iframe2").attr("src"); 
					if(dk.indexOf("uploadFile")==-1){//如果是上传文件的话 就不提示
						var nowPage=$(this);
					/*	$.messager.confirm("操作提示", "不点击保存填写的信息会丢失，是否进行下一步？", function (data) {
							if (data) {
								nowPage.click();
							}
							else {
								//不做任何操作
							}
						});*/	
						if(confirm("不点击保存填写的信息会丢失，是否进行下一步？")){
							nowPage.click();
						}
					}
					else{
						//不是文件上传 就不会提示
					}
				});	     
			}
		}
 
		//审核意见单独提取出来了
		$('.check').bind('click',function(){
			$('.iframe iframe').attr('src','/center/php/action/page/check_opinion.php?table_status='+table_status+'&table_id='+table_id + '&user_type=' + user_type);
		});
		
}

function checkSubmitShow(){
	if(user_type > 0){
		//后台什么时候显示 审核？
		  if(table_status >=2 && getDepartment() != 3)
	      {
		    $('.check').css({display:'block'});
		  }
		  
		  if(table_status != 2){
			  $('.imp_plan').text('查看附件');
		  }
	}

	//是申报用户  后台生成用户
	if(user_type == 0 || user_type == -1){ 
		//待提交
	   if(table_status == 1 ){	 
		   $('.submit').css({display:'block'});
	       $('.check').css({display:'none'});
	   }
	   //或者驳会修改
	   else if(table_status == 3 ){ 
		   $('.submit').css({display:'block'});
		   $('.check').css({display:'block'});
	   }
	   else{
		   $('.imp_plan').text('查看附件');
	       $('.check').css({display:'block'});
	   }
	}
	//如果这个表单处于已经提交的状态，或者是后台用户的话
//	var iscomplete = eval("("+res.iscomplete+")");

}

function getAttr(){
	table_id = getQueryStringByName('table_id');
	$.ajax({  
         type : "post",  
         url : '/modules/php/action/page/attach/attach1.act.php?action=attach_attr&table_id='+table_id,  
         async : false,  
         success : function(data){  
        	var res = eval("("+data+")");
 	    	table_status = res.table_status;
 	    	user_type = res.user_type;
 	    	loadpic(res.iscomplete);
         }  
    }); 
}

function execute(){
	$.messager.confirm("提示" , "您是否提交，提交后将不能再修改？" , function(data){ 
		if(data){
			$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=isFinish&name='+table_id,function(result){
			if(result == 1){
				$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=execute&name='+table_id,function(result){
					if(result['code']!=0){
						//需要改成confirm
						alert("提交成功！");
						window.location.href='/website/html/view/template/user_project.php';
					}
				});
			  }else{
				  alert("提交失败！请填写完所有表格再提交！");  
			  }
	      }); 
		}
	});

//	$.messager.confirm('确定','您是否提交，提交后将不能再修改？',function(r){  
//		if(r){
//		$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=isFinish&name='+table_id,function(result){
//				if(result == 1){
//					$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=execute&name='+table_id,function(result1){
//						if(result1!=0){
//							//还需要判断是否进行相应的提交查重操作。
//							//判断当前的查重表单的状态。
//							$.get('/modules/php/action/page/projectapp/projectapp.act.php?action=checkOpp&name=' + table_id,function(result2){
//								var res = JSON.parse(result2);
////								alert(res.code + "bb");
//								//code == 0 表示不可以进行查重 
//								if(res.code == 1){
////									alert("查重了！！");
//									submitCheck();
//								}
//							});
//							$.messager.alert("提示","提交成功！","",function(){
//								if(table_id == '19' || table_id == '20'){
//									window.location.href='/website/html/view/template/user_project_genious.php';
//								}else{
//									window.location.href='/website/html/view/template/user_project.php';
//								}
//							});
//						}
//					});
//				}else{
//					$.messager.alert("提示","提交失败！请填写完所有表格再提交！");
//				}
//			});
//		}
//	});
}

//进行查重项目的提交
function submitCheck(){
	$.get('/modules/php/action/page/projectapp/projectapp.act.php?action=projectMeg',function(result){
		var res = JSON.parse(result);
		$.ajax({
			url:'/extends/chachong/api.php?project_id=' + res.project_id + '&project_type=' + encodeURIComponent(res.project_type) + '&org_name=' + encodeURIComponent(res.org_name) + '&project_name=' + encodeURIComponent(res.project_name)+'&linkman='+encodeURIComponent(res.linkman)+'&linkman_contact='+res.linkman_contact+'$tech_area='+encodeURIComponent(res.tech_area),
			type:'GET', 
			success:function(data){
				
			}
		});
	});
}



function hs(){
	$('#swich2').bind('click',
			function() {
				var iframe_width = $("#iframe2").width();
				if ($('.menus-scroll-hidden').css('display') != 'none') {
					$('.menus-scroll-hidden').css('display', 'none');
					$('.menu-bar').css('display', 'none');
					$('.menu-bar').css('background-image',
							'url(../../url)');
					$('#iframe2').css('width', iframe_width + 200);
				} else {
					$('.menus-scroll-hidden').css('display', 'block');
					$('.menu-bar').css('display', 'block');
					$('.menu-bar')
							.css('background-image',
									'url(/website/html/view/img/main-xmsbxt/manage.png)');
					$('#iframe2').css('width', iframe_width - 200);
				}
			});
}

