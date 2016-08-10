/**
 * is editor common function
 */
var edit_data = {"items":[],"table_name":""}; //json for commit
var edit_org = {"items":[],"table_name":""};
var ch_org = {"items":[],"table_name":""};
var val_data = {"items":[]};
var get_val_data = {"items":[]};
var item = {"name":"","subtitle":"","tip":"","status":0}; //subtable property

var span_subtitle_html = '<span class="stitle_name">EDIT_TAG</span>';
var span_tip_html = '<span class="stitle_tip">EDIT_TAG</span>';

function get_item(obj){
	var item = {"name":"","subtitle":"","tip":"","status":0}; //subtable property
	var name = obj.next().find("textarea").first().attr("name");
	//if(name.search("extra_") == -1){
	    var subtitle  = obj.find(".stitle_name").first().text();
	    var tip = obj.find(".stitle_tip").first().text();
	    
	    /*var re = /(\w+)、(.*)：（(.*)）/ig;
		console.log(obj.text());
	    var r = re.exec(obj.text());
	    subtitle = r[2];
	    tip = r[3]; */ 
	    
	/*}else{
		subtitle = obj.find(".xtitle").first().val();
		tip = obj.find(".tip").first().val();
	}*/
    item.name = name;
	item.subtitle = subtitle;
	item.tip = tip;
	return item;
}


function get_item_val(obj){
	var item = get_item(obj);
	var item_val = obj.next().find("textarea").first().val();
	if(item_val == null){
		item_val = obj.next().find("textarea").first().text();
	}
	var item_val_json = {"name":item.name,"val":item_val};
	return item_val_json;
}

function searchItemsByName(name){
	var item;
	//console.log(edit_data.table_name);
	$.each(edit_data.items,function(i,val){
		if(name == val.name){
			item = val;
		}
	});
	return item;
}



