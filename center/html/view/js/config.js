// JavaScript Document
/**************************************************
#	Version 1.2		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2014/03/16
**************************************************/

var SYSTEM={name:'通州区科委办公系统',copyright:'copyright &copy; 北京千松科技发展有限公司 all rights reserved'};//系统相关设置常量

var SETTINGARGS={target_frame:'targetFrame',head_height:80,menu_width:136,scrl_btn_height:70,scrl_step:28,switch_width:11,body_padding_right:10,iframe_border_width:4,minus_height:40,menu_padding:10,
logout_link:'index.html?m=admin&c=sp',
head_link:{
		web_home:'http://localhost',
		product_home:'http://www.beijingqiansong.com',
		help:'#'
	}
}//控制面板参数设置


var MENUARR=[
	{	menu_name:'人才中心',
		submenu_arr:[
			{	submenu_name:'学生信息管理',
				item_arr:[
					{	item_name:'学生信息',
						target:'../student/student.html'
					}
				]
			},//<!--submenu-->
			{	submenu_name:'校外铺导员管理',
				item_arr:[
					{	item_name:'校外铺导员',
						target:'../counsellor/counsellorshow.html'
					}//<!--item-->
				]
			}//<!--submenu-->
		]
	},//<!--menu-->
	{	menu_name:'设置',
		submenu_arr:[
			{	submenu_name:'相关设置',
				item_arr:[
					{	item_name:'站点管理',
						target:'index.html'
					},//<!--item-->
					{	item_name:'发布点管理',
						target:'default_iframe.html'
					}//<!--item-->
				]
			},//<!--submenu-->
			{	submenu_name:'管理员设置',
				item_arr:[
					{	item_name:'生成首页',
						target:'http://www.baidu.com'
					}//<!--item-->
				]
			}//<!--submenu-->
		]
	},//<!--menu-->
];

var GLOBALVARS={};//全局变量