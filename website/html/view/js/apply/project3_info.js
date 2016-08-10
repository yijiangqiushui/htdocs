	$(function(){
		loadApplyInfo();
	});
	
	function getQueryStringByName(name){
	    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
	    if (result == null || result.length < 1) {
	        return "";
	    }
	    return result[1];
	}
	
	function loadApplyInfo(){
		$.get('/modules/php/action/page/applycation/apply3.act.php?action=find3ProInfo',function(result){
			if(result!='0')
				var res = eval("("+result+")");
				$('#3project_info_fm').form('load',res);
		});
		
		$('.save').bind('click',function(){ submitdata(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
		
		/*$('#back').click(function() {
			root = $(window.parent.parent.document).get(0).location.pathname;
			//alert(root)
			reg = /website/;
			result = root.search(reg);
			//alert(result)
			//前台
			if(result != -1){
				$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
			}
			//后台
			else{
				$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
			}
		});*/
	
		
	}
	
	function submitdata(){
		$('#3project_info_fm').form('submit',{
			url: '/modules/php/action/page/applycation/apply3.act.php?action=project3Info',
			success: function(result){
				$.messager.alert("提示","　　　保存成功","info",function(){
					var complete = completeInput();  
					if(complete) {
						window.parent.save_stage('project_info');
					} else{
						window.parent.update_stage('project_info');
					} 
					window.parent.setStep('project_info',complete);
				});
				
			}
		});
	}
	
	function addLine(){
		var newTr = addtable.insertRow(-1);
		var rows = addtable.rows.length-2;
		var cell1 = newTr.insertCell();
		var cell2 = newTr.insertCell();
		var cell3 = newTr.insertCell();
		var cell4 = newTr.insertCell();
		cell1.setAttribute("colspan",'2');
		cell2.setAttribute("colspan",'2');
		cell3.setAttribute("colspan",'2');
		cell4.setAttribute("width",'50px');
		cell1.innerHTML = "<input type='text' name=\"intel_property[" + rows + "]\" />";
		cell2.innerHTML = "<input type='text' name=\"type[" + rows + "]\" />";
		cell3.innerHTML = "<input type='text' name=\"auth_code[" + rows + "]\" />";
		cell4.innerHTML = "<input type='button' value='删除' class='pointer' onclick='delLine(this)'/>";
	}
	



	function delLine(obj) {
		var tbody = $(obj).parents("tbody");//不可调换位置
		var tr = obj.parentNode.parentNode;
		var tbody = tr.parentNode;
		tbody.removeChild(tr);
		var row = 0;
		$(tbody).children("tr").each(function () {
			if (row != 0) {
				$(this).find("input").each(function () {
					var name = $(this).prop("name");
					if (name != "" &&(name.indexOf("[")!=-1)) {
						var newName = name.split("[");
						newName[0] = newName[0] + "[" + (row - 1) + "]";
						$(this).prop("name", newName[0]);
					}
				});

				$(this).find("select").each(function () {
					var name = $(this).prop("name");
					if (name != "" &&(name.indexOf("[")!=-1)) {
						var newName = name.split("[");
						newName[0] = newName[0] + "[" + (row - 1) + "]";
						$(this).prop("name", newName[0]);
					}
				});
			}
			row++;
		});

	}
	
	function completeInput() {
		var returnValue = true;
		$('input').each(function() {
			if(!$(this).val()) {
				returnValue = false;
			}
		})
		return returnValue;
	}
	