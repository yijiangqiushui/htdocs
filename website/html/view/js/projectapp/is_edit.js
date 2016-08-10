/**
 * edit mode js
 */
document.write('<script type="text/javascript" src="/common/html/js/log.js"></script>');
var subtitle_html = '<input type="text" class="edit_input xtitle" width="100px" value="EDIT_TAG" />';
var toptitle_html = '<input type="text" class="edit_input toptitle" width="100px" value="EDIT_TAG" />';
var tip_html = '<input width="300px" class="edit_input tip" type="text" value="EDIT_TAG" />';
var del_html = '<input type="button" value="EDIT_TAG" class="edit_del" style="color:#f00" />';
var table_name = ""; //big table name

function change_mode(){
	var add_html = '<div style="overflow:hidden"><input type="button" value="添加" class="edit_add" style="color:#f00" /></div>';
	var str_id = getQueryStringByName('str_id');
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
				$(this).hide();
				$(this).next().hide();
			}else{
				//change title for it
				$(this).find(".stitle_name").first().text(ch_item.subtitle);
				$(this).find(".stitle_tip").first().text(ch_item.tip);
			}
		}
		
	});
	
	edit_org.table_name = $(".basic_info .title_top").first().text();
	
	console.log(edit_org);
	
	
	$.each(edit_data.items,function(i,val){
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
	
	$(".basic_info .subtitle").each(function(){
		if($(this).next().is(":hidden")){
			var item = get_item($(this));
			$(this).before(del_html.replace(/EDIT_TAG/, "恢复 "+item.subtitle));
		}else{
			$(this).before(del_html.replace(/EDIT_TAG/, "删除"));
		}
	});
	$(".basic_info .text_wrap").last().after(add_html);
	$(".basic_info .button_wrapper").children().hide();
	$(".basic_info .button_wrapper").show();
	$(".basic_info .button_wrapper").append('<div style="margin-left:135px;" class="save saveEdit">保存定制表单</div>');
	$(".basic_info .edit_del").on("click",delTextarea);
	$(".basic_info .edit_add").on("click",addTextarea);
	$(".basic_info .saveEdit").on("click",saveTextarea);
	$(".basic_info .title_top").on("click",editTitle);
	$(".basic_info .stitle_name").on("click",snameMod);
	$(".basic_info .stitle_tip").on("click",tipMod);
}

function editTitle(){
	$(this).hide();
	$(this).after(toptitle_html.replace(/EDIT_TAG/, $(this).text()));
	var obj = $(this);
	$(".basic_info .toptitle").on("blur",function(){
		//alert("ss");
		obj.text($(this).val());
		obj.show();
		$(this).remove();
	});
}

function snameMod(){
	var item = get_item($(this).parent());
	$(this).hide();
	$(this).after(subtitle_html.replace(/EDIT_TAG/, item.subtitle));
	var obj = $(this);
	$(".basic_info .subtitle .xtitle").on("blur",function(){
		//alert("ss");
		obj.text($(this).val());
		obj.show();
		$(this).remove();
	});
}

function tipMod(){
	var item = get_item($(this).parent());
	$(this).hide();
	$(this).after(tip_html.replace(/EDIT_TAG/, item.tip));
	var obj = $(this);
	$(".basic_info .subtitle .tip").on("blur",function(){
		//alert("ss");
		obj.text($(this).val());
		obj.show();
		$(this).remove();
	});
}

function delTextarea(){
	var obj = $(this);
	edit_data = "{}";
	if(obj.next().is(':hidden')){
		obj.val("删除");
		obj.next().show();
		obj.next().next().show();
		obj.css("color","#f00");
	}else{
		obj.next().hide();
		obj.next().next().hide();
		obj.css("color","#f00");
		var item = get_item(obj.next());
		obj.val("恢复 "+item.subtitle);
	}
}

function addTextarea(){
	var obj = $(this);
	var name = "extra_"+(Date.parse(new Date()));
	var subtitle = del_html.replace(/EDIT_TAG/, "删除")+'<p class="subtitle"> \
		x、'+span_subtitle_html.replace(/EDIT_TAG/, "请输入小标题")+'：（'+span_tip_html.replace(/EDIT_TAG/, "请输入说明")+'）</p>';
	var text_wrap = '<div class="text_wrap"> \
		<textarea name="'+name+'" id="'+name+'" class="text_content"></textarea> \
		</div>';
	
	obj.before(subtitle);
	obj.before(text_wrap);
	
	$(".basic_info .edit_del").on("click",delTextarea);
	$(".basic_info .stitle_name").on("click",snameMod);
	$(".basic_info .stitle_tip").on("click",tipMod);
	
}

function getQueryStringByName(name) {
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function saveTextarea(){
	var str_id = getQueryStringByName('str_id');
	//initialize the form json
	$(".basic_info .subtitle").each(function(){
//		alert($(this).text());
		var item = get_item($(this)); //subtable property
		if(item.name.search("extra_") == -1){
			if($(this).next().is(':hidden')){
				item.status = -1;
			}
			ch_org.items.push(item);
		}else{
			if(!$(this).next().is(':hidden')){
				ch_org.items.push(item);
			}
		}
	});
	
	ch_org.table_name = $(".basic_info .title_top").first().text();
	console.log(ch_org);
	//return false;
	
	$.ajax({
		url : "/center/php/action/page/project_type/control.php?action=edit_east_data",
		data : {
			'str_id':str_id,
			'edit_data' : JSON.stringify(ch_org)
		},
		type : 'POST',
		dataType : 'json',
		success : function(data) {
			if(data.msgcode == 100){
				  var  params=new Array();
				  params[0]=str_id;
	        	   insertLogInfo("LogModyProSub",params);
	        	   alert("修改成功");
	        	   window.location.reload();
			}else{
				alert("修改失败，请重试，或联系管理员！");
			}
		},
		error : function(data) {
			alert("修改失败，请重试，或联系管理员！");
		}
	});
}


$(function(){
	change_mode()
});