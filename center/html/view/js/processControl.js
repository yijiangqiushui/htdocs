
function processCon(){
	$('#project_process').form('submit',{
		url:'../../../../../modules/php/action/page/center/process.act.php?action=project_process',
		success:function(result){
//			alert(result);
			var res=eval("("+result+")");
			if(res.code == 0){
				alert("请至少选择一个阶段！");
				window.location.reload();
			}
			else{
				window.location.reload();
			}
//			$('#project_process').form('reset');

		}
	});
}
// checkbox和radio进行联动；
function checkAll(id){
	var checktag = document.getElementsByName(id+'[]');
	var radiotag = document.getElementsByName(id+".radio");
	var flag = 0; //  flag=0 代表全都选中，flag=1代表不是全都选中
	for(var i = 0; i < checktag.length;i++){
		if(!checktag[i].checked){
			flag = 1;
			radiotag[0].checked = false;break;
		}
	}
	if(flag == 0){
	   radiotag[0].checked = true;
	}
	radiotag[1].checked = false;
}

//全选的同时还要判断当前如果是全选的，则当前radio为选中的状态
function chooseAll($id){
	var checktag = document.getElementsByName($id+'[]');
	for(var i = 0; i < checktag.length;i++){
		checktag[i].checked = true;
	}
}

//反选
function reverseAll($id){
	var checktag = document.getElementsByName($id+'[]');
	for(var i = 0; i < checktag.length;i++){
		checktag[i].checked = !(checktag[i].checked);
	}
}

//全都不选
function denyAll($id){
	var checktag = document.getElementsByName($id+'[]');
	for(var i = 0; i < checktag.length;i++){
		checktag[i].checked = false;
	}
}

$(function()
		{
		//loadWest();
		loadApplyInfo();
		});
function loadApplyInfo(){
		$.get('../../../../../modules/php/action/page/center/process.act.php?action=find_process',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$.each(res,function(name,value){
					var i = 0;
					var checktag = document.getElementsByName(name+'[]');
					if(value.apply_stage == 1){
						checktag[0].checked = true;
					}
					if(value.setup_stage == 1){
						checktag[1].checked = true;
					}
					if(value.carry_stage == 1){
						checktag[2].checked = true;
					}
					if(value.check_stage == 1){
						checktag[3].checked = true;
					}
					checkAll(name);  //联动
				});
				//alert(res.org_code);
//				$('#project_member').form('load',res);
			}
		});
		
	}
function loadWest(){
//	alert("hhhh");
	$.post('/modules/php/action/page/center/center.act.php?action=isSuper',function(result){
		var res = eval("("+result+")");
//		alert(res.departmesnt);
		if(res.user_type == 3){
//			$("#li0").css('display','block');
			$("#li1").css('display','block');
			$("#li2").css('display','block');
			$("#li3").css('display','block');
//			document.getElementById('body').className = 'easyui-layout'
		}
		else{
			
			$("#_easyui_tree_2").hide();
			$("#_easyui_tree_3").hide();
			$("#_easyui_tree_4").hide();

			if(res.department == 0){
				$("#_easyui_tree_2").show();
				//alert($(".li1"));
			}
			else if(res.department == 1){
				$("#_easyui_tree_3").show();
			}
			else if(res.department == 2){
				$("#_easyui_tree_4").show();
			}
			else{
				
			}
		}
	});
}