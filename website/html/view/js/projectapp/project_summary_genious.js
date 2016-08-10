function project_sum($id,$stage){
	var str = '';
	if($('input[name="genious_name"]').val()==''){
		str+='项目名称 不能为空 ';	
	}
	else if($('input[name="department"]').val()==''){
		str+='主管科室 不能为空';
	}
    //这种方式不能获取select标签的值wy
	else if($('select[name="tech_area"]').val()==''){
		str+='所属领域 不能为空';	
	}
	if(str == ''){
//		event.preventDefault();
		
		var onclick = $('.savesum').attr('onclick');
		
		$('.savesum').attr('onclick', '');
		//2015.12.30 修改了按钮点击时候的图片替换
		$('.savesum').removeClass('submit');
		$('.savesum').addClass('saved');
		
		$.ajax({
		url:"/modules/php/action/page/project/dep_code.php",
		data:{'id':$id,'stage':$stage},
		type:"POST",
		success:function(data){
			$('#project_summary').form('submit',{
				url:'../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=project_summary_genious',
				success:function(result){
//					$('#project_summary').form('reset');
				//	window.location.href="../userlist.php";
//					window.location.href="../main-xmsbxt.html";
					window.location.href="/website/html/view/template/user_project_genious.php?target=../main-xmsbxt.html";
					$('.my-project', window.top.document).click();
				}
			});
		},
		error:function(){
			alert("出错了！");
			$('.savesum').attr('onclick', onclick);
			return false;
			}
		});
	}
	else {
		$.messager.alert('提示',str,'info');
		return;		
	}
}

$(function() {
	loadApplyInfo();
});

function loadApplyInfo(){
	var project_id = getQueryStringByName("id");
	$.get('/modules/php/action/page/projectapp/projectapp.act.php?action=findProSum_genious&id=' + project_id, function(result){
		if(result != '0'){
			var res = eval("("+result+")");
			$('#department').val(res.department);
			$('#project_engineer').val(res.project_engineer);
			$('#org_name').val(res.org_name);
			$('#project_type').val(res.project_type);
		}
	});
}
	
	/**
	 * 获取URL中参数，并进行编码转换
	 */
function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}
