<?php
/**************************************************
#	Version 1.0		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2014/03/24
#   Modified By Gao Xue 2014-04-28
**************************************************/

/**
 * 功能：控制面板相关
 */
class MAIN{
	/**
	 * 功能：初始化控制面板
	 */
	public function Init(){
		$data_arr=array();
// 		if($_SESSION['admin_id']==''){
		if($_SESSION['user_id']==''){
			$data_arr['type']='forbidden';
		}
		else{
			$data_arr['type']='success';
			$data_arr['menu']=array(
				array(
					'menu_name'=>'我的面板',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'个人信息',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'资料修改','target'=>'../../../../modules/html/view/template/updateUser.html','show'=>'block'),
								array('item_name'=>'密码修改','target'=>'../../../../modules/html/view/template/updatePwd.html','show'=>'block'),
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'推荐单位管理',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'推荐单位管理',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'推荐单位管理','target'=>'../../../../modules/html/view/template/recommend_org.html','show'=>'block'),
								array('item_name'=>'推荐单位统计','target'=>'../../../../modules/html/view/template/chart_recommend.html','show'=>'block'),
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'申报单位管理',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'申报单位管理',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'申报单位管理','target'=>'../../../../modules/html/view/template/apply_org.html','show'=>'block'),
								array('item_name'=>'申报单位统计','target'=>'../../../../modules/html/view/template/chart_apply.html','show'=>'block'),
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'申报项目管理',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'申报项目管理',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'按年度专家分组','target'=>'../../../../modules/html/view/template/applycat.html','show'=>'block'),
//								array('item_name'=>'按技术领域分类信息','target'=>'../../../../modules/html/view/template/applycatTechnical.html','show'=>'block'),
								array('item_name'=>'按专家组管理','target'=>'../../../../modules/html/view/template/apply_fruits.html?flag=expertCat','show'=>'block'),
								array('item_name'=>'按技术领域管理','target'=>'../../../../modules/html/view/template/apply_fruits.html?flag=scienceCat','show'=>'block'),
								array('item_name'=>'按经济行业管理','target'=>'../../../../modules/html/view/template/apply_fruits.html?flag=economicCat','show'=>'block'),
								array('item_name'=>'申报项目统计','target'=>'../../../../modules/html/view/template/chart_fruits.html','show'=>'block'),
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'设置',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'管理员',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'角色权限','target'=>'../../../../modules/html/view/template/admincat.html','show'=>'block'),
								array('item_name'=>'管理员信息','target'=>'../../../../modules/html/view/template/admininfo.html','show'=>'block')
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'系统管理',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'扩展',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'操作日志','target'=>'../../../../modules/html/view/template/log.html','show'=>'block')
							)
						),//<!--左侧菜单-->
						array(
							'submenu_name'=>'数据库工具',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'数据备份','target'=>'../../../../modules/html/view/template/backup.html','show'=>'block'),
								array('item_name'=>'数据还原','target'=>'../../../../modules/html/view/template/restore.html','show'=>'block')
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'通知公告管理',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'通知公告信息',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'分类管理','target'=>'../../../../modules/html/view/template/contentcat.html','show'=>'block'),
								array('item_name'=>'信息管理','target'=>'../../../../modules/html/view/template/contentinfo.html','show'=>'block'),
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
			);
			
			//其他操作
		}
		
// 		if($_SESSION['admin_name']==''){$data_arr['locked']='true';}
		if($_SESSION['username']==''){$data_arr['locked']='true';}
		echo json_encode($data_arr);
	}
	
	/**
	 * 功能：初始化控制面板
	 */
	public function Logout(){
		session_start();
		session_destroy();
		
		$data_arr=array();
		$data_arr['type']='success';
		echo json_encode($data_arr);
	}
	
	/**
	* 功能：屏幕上锁
	*/
	public function LockScreen(){
// 		$_SESSION['admin_name']='';
        $_SESSION['username']='';
	}	

	/**
	 * 功能：屏幕解锁
	 */
	public function Unlock(){
		$usr=new USER();
		$usr->CheckUnlock($_POST['slfPWD']);
	}
	
	/*
	*添加：heyangyang
	*获取当前用户及角色
	*/
	public function getCuruser(){
// 		echo $_SESSION['admin_name'].'{|}'.$_SESSION['catName'];	
	    echo $_SESSION['username'].'{|}'.$_SESSION['catName'];
	}
	
}
?>