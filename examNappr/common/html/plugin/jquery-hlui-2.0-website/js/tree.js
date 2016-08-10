// JavaScript Document
/**
 * jQuery HLUI 1.0.2
 * Tree
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

//need global vars
var Plg_Tree_Global={id_cound:0,show_all:true,parent_count:false};
 
$.extend({
	tree:function(config){
		if(typeof(config['iframe'])=='undefined'){
			config.iframe={src:'',target:'#'};
		}
		$(config.renderTo==''?'body':config.renderTo).append('	<ul id="'+config.id+'" class="hlui-tree" data-opt="json_url:\''+config.json_url+'\',user_func:\''+config.user_func+'\',show_all:'+config.show_all+',parent_count:'+config.parent_count+',iframe:{src:\''+config.iframe.src+'\',target:\''+config.iframe.target+'\'}">\
		  <li><div class="ui-tree-root"><span class="ui-tree-rnode ui-tree-img"></span><span class="ui-tree-txt">'+config.rootname+'</span></div></li>\
		  <li><div class="ui-tree-node" id="_ui_tree_0"><span class="ui-tree-join ui-tree-img"></span><span class="ui-tree-folderopen ui-tree-img"></span><a href="javascript:void(0);" class="ui-tree-txt">'+config.all_name+'</a></div></li>\
		  <ul id="_ui_tree_0_subtree"></ul>\
		</ul><!--hlui-tree-->\
		');
		$.tree_apply(config.id);
	},
	tree_recursive:function(data,parent_id,is_root,prespan,is_parent_last){
		if(is_root==0){
			prespan+='<span class="ui-tree-'+(is_parent_last?'noline':'line')+' ui-tree-img"></span>';
		}
		for(var i=0;i<data.length;i++){
			Plg_Tree_Global.id_cound++;
			htmlstr='<li><div class="ui-tree-node" id="_ui_tree_'+Plg_Tree_Global.id_cound+'" upper_cat="'+data[i].upper_cat+'" cat-id="'+data[i].id+'"><span class="ui-tree-prespan">'+prespan+'</span><span class="ui-tree-'+(typeof(data[i].children)!='undefined'?(i<(data.length-1)?(Plg_Tree_Global.show_all?'minus':'plus'):(Plg_Tree_Global.show_all?'lastminus':'lastplus')):(i<(data.length-1)?'join':'lastjoin'))+' ui-tree-img"></span><span class="ui-tree-'+(typeof(data[i].children)!='undefined'?(Plg_Tree_Global.show_all?'folderopen':'folder'):'page')+' ui-tree-img"></span><a href="javascript:void(0);" class="ui-tree-txt">'+data[i].cat_name+''+(Plg_Tree_Global.parent_count?(typeof(data[i].children)!='undefined'?'('+data[i].children.length+')':''):'')+'</a></div></li>'+(typeof(data[i].children)!='undefined'?'<ul id="_ui_tree_'+Plg_Tree_Global.id_cound+'_subtree"></ul>':'');
				$('#_ui_tree_'+parent_id+'_subtree').append(htmlstr);
			if(typeof(data[i].children)!='undefined'){
				$.tree_recursive(data[i].children,Plg_Tree_Global.id_cound,0,prespan,!(data.length-1-i));
			}
		}
	},
	tree_init:function(){
		$('.hlui-tree').each(function(i){
			$.tree_apply($(this).attr('id'));
		});
	},
	tree_apply:function(tree_id){
		var d_opt=eval('({'+$('#'+tree_id).attr('data-opt')+'})'); 
		Plg_Tree_Global.parent_count=d_opt.parent_count;
		Plg_Tree_Global.show_all=d_opt.show_all;
		$.post(d_opt.json_url,function(data){
			$.tree_recursive(data,0,1,'',0);
			
			$('.ui-tree-node').each(function(i){
				$(this).find('span:nth-child(2)').bind('click',function(){
					var reverse_span_2=$('#_ui_tree_'+i+' span').eq($(this).size()-3);
					var reverse_span_1=$('#_ui_tree_'+i+' span').eq($(this).size()-2);
					if(i>0 && $('#_ui_tree_'+i+'_subtree').length>0){
						if($('#_ui_tree_'+i+'_subtree').css('display')!='block'){
							$('#_ui_tree_'+i+'_subtree').css('display','block');
							if(reverse_span_2.attr('class').indexOf('lastplus')>-1){
								reverse_span_2.removeClass('ui-tree-lastplus');
								reverse_span_2.addClass('ui-tree-lastminus');
							}
							else{
								reverse_span_2.removeClass('ui-tree-plus');
								reverse_span_2.addClass('ui-tree-minus');
							}
							reverse_span_1.removeClass('ui-tree-folder');
							reverse_span_1.addClass('ui-tree-folderopen');
						}
						else{
							$('#_ui_tree_'+i+'_subtree').css('display','none');
							if(reverse_span_2.attr('class').indexOf('lastminus')>-1){
								reverse_span_2.removeClass('ui-tree-lastminus');
								reverse_span_2.addClass('ui-tree-lastplus');
							}
							else{
								reverse_span_2.removeClass('ui-tree-minus');
								reverse_span_2.addClass('ui-tree-plus');
							}
							reverse_span_1.removeClass('ui-tree-folderopen');
							reverse_span_1.addClass('ui-tree-folder');
						}
					}
				});
				$(this).find('a').bind('click',{'id':i,'upper_cat':$(this).attr('upper_cat'),'cat_id':$(this).attr('cat-id')},function(e){
					$('.ui-tree-node').removeClass('ui-tree-node-selected');
					$(this).parent().removeClass('ui-tree-node-over');
					$(this).parent().addClass('ui-tree-node-selected');
					$.tree_action(e.data.id,d_opt.user_func,d_opt.iframe.src,d_opt.iframe.target,e.data.upper_cat,e.data.cat_id);
					
				});/**/
				$(this).find('span:nth-child(3)').bind('click',{'id':i,'upper_cat':$(this).attr('upper_cat'),'cat_id':$(this).attr('cat-id')},function(e){
					$('.ui-tree-node').removeClass('ui-tree-node-selected');
					$(this).parent().removeClass('ui-tree-node-over');
					$(this).parent().addClass('ui-tree-node-selected');
					$.tree_action(e.data.id,d_opt.user_func,d_opt.iframe.src,d_opt.iframe.target,e.data.upper_cat,e.data.cat_id);
					
				});
				$(this).bind('mouseover',{'id':i},function(e){
					if(!$('#_ui_tree_'+e.data.id).hasClass('ui-tree-node-selected')){
						$('#_ui_tree_'+e.data.id).addClass('ui-tree-node-over');
					}
				});
				$(this).bind('mouseout',{'id':i},function(e){
					$('#_ui_tree_'+e.data.id).removeClass('ui-tree-node-over');
				});
			});
		},'json');
	},
	tree_action:function(id,user_func,iframe_src,iframe_target,upper_cat,cat_id){
		if(typeof(upper_cat)=='undefined'){
			upper_cat='.';
		}
		if(typeof(cat_id)=='undefined'){
			cat_id=0;
		}
		if(iframe_src=='' && user_func=='undefined'){
			alert('参数设置错误！');
			return false;
		}
		else if(iframe_src==''){
			eval(user_func+'("'+upper_cat+'",'+cat_id+')');
		}
		else{
			$('iframe[name='+iframe_target+']').attr('src',iframe_src+('?upper_cat='+upper_cat+'&cat_id='+cat_id));
			//$('#_ui_tree_'+id+' a').attr({'href':iframe_src+('?upper_cat='+upper_cat+'&cat_id='+cat_id),'target':iframe_target});
		}
	}
});
