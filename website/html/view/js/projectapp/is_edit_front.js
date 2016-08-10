/**
 * commit save jason data for edit common
 */
 var test_mode  = 1;
 
 
function newGetQueryStringByName(name) {
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}


function get_str_id(){
	
	var str_id = newGetQueryStringByName('str_id');
	
	if(str_id == ""){
		str_id = 0;
	}
	
	return str_id;
}


function illustrate_edit(){
	var str_id = get_str_id();
    if (str_id == 0) {
        return;
    }
	//get json for initialization
	$.ajax({
		url : "/center/php/action/page/project_type/control.php?action=get_edit_form",
		data : {
			'str_id':str_id
		},
		type : 'POST',
		async: false,
		dataType : 'json',
		success : function(data) {
			if(data.msgcode == 100){
				if (data.ret) {
                    edit_data = $.parseJSON(data.ret);
                }else{
                	edit_data = $.parseJSON(edit_data);
                }
			}else{
				alert("error");
			}
		},
		error : function(data) {
			//alert("修改失败，请重试，或联系管理员！");
		}
	});
	var i = 0;
	//initialize the form json
	$(".basic_info .subtitle").each(function(){
		//alert($(this).text());
		i++;
		//console.log(get_item($(this)));
		var item = get_item($(this)); //subtable property
		edit_org.items.push(item);
		
		var ch_item = searchItemsByName(item.name);
		if(ch_item){
			if(ch_item.status == -1){
				i--;
				$(this).hide();
				$(this).next().hide();
				$(this).next().find('textarea').val('1');
			}else{
				//change title for it
				$(this).find(".stitle_num").first().text(i);
				$(this).find(".stitle_name").first().text(ch_item.subtitle);
				$(this).find(".stitle_tip").first().text(ch_item.tip);
			}
		}
	});
	
	edit_org.table_name = $(".basic_info .title_top").first().text();
	
	$.each(edit_data.items,function(j,val){
		//add extra table
		if(val.name.search("extra_") != -1){
			i++;
			var subtitle = '<p class="subtitle"> \
		'+i+'、'+span_subtitle_html.replace(/EDIT_TAG/, val.subtitle)+'：\（'+span_tip_html.replace(/EDIT_TAG/, val.tip)+'）</p>';
			var text_wrap = '<div class="text_wrap"> \
		<textarea name="'+val.name+'" id="'+val.name+'" class="text_content"></textarea> \
		</div>';
			$(".basic_info .subtitle").last().next().after(subtitle + text_wrap);
		}
	});
	
	if (edit_data.table_name != "") {
        $(".basic_info .title_top").first().text(edit_data.table_name);
    }
	
	//insert data from db project_info
	$.ajax({
		url : "/center/php/action/page/project_type/front.php?action=get_front_data",
		data : {
			'str_id':str_id
		},
		type : 'POST',
		async: false,
		dataType : 'json',
		success : function(data) {
			if(data.msgcode == 100){
				//console.log(data);
				if (data.ret) {
                    get_val_data = data.ret;
                }else{
                	get_val_data = $.parseJSON(get_val_data);
                }
				//console.log("ssss");
				//console.log(get_val_data);
				$.each(get_val_data.items,function(j,item){
					//add extra table
					console.log(item);
					if(item.name.search("extra_") != -1){
						//$(".basic_info").find("textarea[name='"+item.name+"']").text(item.val);
						$(".basic_info").find("textarea[name='"+item.name+"']").val(item.val);
					}
				});
				
			}else{
				//alert("error");
			}
		},
		error : function(data) {
			//alert("修改失败，请重试，或联系管理员！");
		}
	});
	
	console.log(get_val_data);
	
}

function saveJsonData(){
	
	var str_id = get_str_id();
    if (str_id == 0) {
        return;
    }
	var val_data = {"items":[]};
	
	//initialize the form json
	$(".basic_info .subtitle").each(function(){
		//alert($(this).text());
		var item_val = get_item_val($(this)); //subtable property
		if(item_val.name.search("extra_") != -1){
			val_data.items.push(item_val);
		}
	});
	//return false;
	
	$.ajax({
		url : "/center/php/action/page/project_type/front.php?action=edit_front_data",
		data : {
			'str_id':str_id,
			'val_data' : JSON.stringify(val_data)
		},
		type : 'POST',
		dataType : 'json',
		async:false,
		success : function(data) {
			if(data.msgcode == 100){
				//alert("修改成功");
				//window.location.reload();
			}else{
				//alert("修改失败，请重试，或联系管理员！");
			}
		},
		error : function(data) {
			//alert("修改失败，请重试，或联系管理员！");
		}
	});
}


$(function(){
	illustrate_edit();
});