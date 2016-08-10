document.write('<script type="text/javascript" src="/common/html/js/log.js"></script>');
function convert(rows){
	function exists(rows, parentId){
		for(var i=0; i<rows.length; i++){
			if (rows[i].id == parentId) return true;
		}
		return false;
	}
	
	var nodes = [];
	// get the top level nodes
	for(var i=0; i<rows.length; i++){
		var row = rows[i];
		if (!exists(rows, row.parentId)){
			nodes.push({
				id:row.id,
				text:row.name,
				ptag:0
			});
		}
	}
	var toDo = [];
	for(var i=0; i<nodes.length; i++){
		toDo.push(nodes[i]);
	}
	while(toDo.length){
		var node = toDo.shift();	// the parent node
		// get the children nodes
		for(var i=0; i<rows.length; i++){
			var row = rows[i];
			if (row.parentId == node.id){
				var child = {id:row.id,text:row.name,ptag:1,attributes:{url:row.tpl_url,stid:row.id}};
				if(row.status == 0){
					child.checked = true;
				}else{
					child.checked = false;
				}
				if (node.children){
					node.children.push(child);
				} else {
					node.children = [child];
				}
				toDo.push(child);
			}
		}
	}
	//console.log(nodes);
	return nodes;
}


$(function(){
	$('#stwest').tree({
		url: 'control.php?action=get_west_data',
		loadFilter: function(rows){
			return convert(rows);
		},
		onCheck:function(node,checked){
			//alert(".....");
			console.log(checked);
			$.ajax({
				url : "/center/php/action/page/project_type/control.php?action=check_status",
				data : {
					'check':checked,
					'str_id':node.id
				},
				type : 'POST',
				async: false,
				dataType : 'json',
				success : function(data) {
					if(data.msgcode == 100){
						if (data.ret) {
		                    console.log(data.ret);
		                }else{
		                	console.log(data.ret);
		                }
					}else{
						alert("error");
					}
				},
				error : function(data) {
					//alert("修改失败，请重试，或联系管理员！");
				}
			});
		},
		onClick: function(node){
			console.log(node);
			if(node.ptag){
				//alert(node.id); 
				$("#stdefine").parent().find(".panel-title").text(node.text);
				$('#stframe').attr('src',node.attributes.url+"?is_edit=1&str_id="+node.attributes.stid);
			}
		},
		onLoadSuccess:function(node,data){
			$("#stwest li:eq(1)").find("div").click();   //设置第一个节点高亮
			//var root = $("#stwest").tree('getRoot');
			//var childs = $("#stwest").tree('getChildren', root.target);
            //
			//var n = $("#stwest").tree("getSelected");
			//if(n!=null){
			//	//$("#stwest").tree("select",n.target);    //相当于默认点击了一下第一个节点，执行onSelect方法
			//	$('#stwest').tree('select', childs[0].target);
			//}
		},
		checkbox:true
	});
});
