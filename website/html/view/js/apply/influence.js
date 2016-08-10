function submit_data(){
		$('#influence').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply9.act.php?action=9influence',
			success: function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();
				if(complete){
					
					window.parent.save_stage('influence');
				}else{
					window.parent.update_stage('influence');
				} 
				window.parent.setStep('influence',complete);
			});
			}
		});
	}

/**
 * 这个方法是判断是不是所有的 信息都填写完了 然后进一步设置是不是显示小对勾
 * 
 * @returns {Boolean}
 */

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	})
	return returnValue;
}


$(function()
		{
		loadApplyInfo();
		dateplu();
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
		
		$(".date_pick").each(function(){
			$(this).dateRangePicker({
				autoClose: true,
				singleDate : true,
				showShortcuts: false 
				});
		  });
		});
	function loadApplyInfo(){
		$.get('/modules/php/action/page/applycation/apply9.act.php?action=9findinfluence',
		function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#influence').form('load',res);
			}
		});

	
		
		$('.save').bind('click',function(){
			submit_data(); 
		});
	}
	function getQueryStringByName(name){
	    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
	    if (result == null || result.length < 1) {
	        return "";
	    }
	    return result[1];
	}
	
function AddSignRow(){
	var rol = tbl.rows.length - 2;
	var newTr = "<tr>";
		newTr += "<td><input type='text' name='name["+ rol +"]'/></td>";
		newTr += "<td><input type='text' name='time["+ rol +"]'class='dateplu' readonly/></td>";
		newTr += "<td><input type='text' name='place["+ rol +"]'/></td>";
		newTr += "<td><input type='text' name='theme["+ rol +"]'/></td>";
		newTr += "<td><input type='text' name='effect["+ rol +"]'/></td>";
		newTr += "<td><input type='button' value='删除' class='pointer but' onclick='delRow(this)'/></td>";
	$('#tbl').append(newTr);
	dateplu();
}

function delRow(obj) {
	var tbody = $(obj).parents("tbody");//不可调换位置
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	var row = -2;//两个表头
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
		}
		row++;
	});
	tbody.removeChild(tr);
}
