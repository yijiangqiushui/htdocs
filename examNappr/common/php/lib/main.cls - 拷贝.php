<?php
/**************************************************
#	Version 1.0		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2014/03/24
#   Modified By Wang Le 2014-09-18
**************************************************/
/**
 * 功能：控制面板相关
 */
class MAIN{
	/**
	 * 功能：初始化控制面板
	 */
	public function Init(){
		$priviledges=explode(',',$_SESSION['priviledges']);
		$data_arr=array();
		if($_SESSION['admin_id']==''){
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
								array('item_name'=>'资料修改','target'=>'../../../../modules/html/view/template/panel/updateUser.html','show'=>'block'),
								array('item_name'=>'密码修改','target'=>'../../../../modules/html/view/template/panel/updatePwd.html','show'=>'block'),
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'审批管理',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'审批信息管理',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'部门管理','target'=>'../../../../modules/html/view/template/content/contentcat.html','show'=>'block'),
								array('item_name'=>'创建制发文件','target'=>'../../../../modules/html/view/template/file/file.html','show'=>'block'),
								array('item_name'=>'文件审批管理','target'=>'../../../../modules/html/view/template/file/filemanage.html','show'=>'block'),
								array('item_name'=>'制发文件统计','target'=>'../../../../modules/html/view/template/file/chart_recommend.html','show'=>'block'),
								array('item_name'=>'印章使用申请','target'=>'../../../../modules/html/view/template/file/seal.html','show'=>'block'),
								array('item_name'=>'印章审批管理','target'=>'../../../../modules/html/view/template/file/sealmanage.html','show'=>'block'),
								array('item_name'=>'印章使用统计','target'=>'../../../../modules/html/view/template/file/seal_chart_report.html','show'=>'block')
							),
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'通信管理',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'短信管理',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'短信','target'=>'../../../../modules/html/view/template/sms/sms.html','show'=>'block'),
								array('item_name'=>'短信统计','target'=>'../../../../modules/html/view/template/sms/sms_recommend.html','show'=>'block'),
							)
						),//<!--左侧菜单-->
						array(
							'submenu_name'=>'通讯录管理',
							'show'=>'block',
							'item_arr'=>array(
								//array('item_name'=>'分类管理','target'=>'../../../../modules/html/view/template/smslist/smslistcat.html','show'=>'block'),
								array('item_name'=>'通讯录管理','target'=>'../../../../modules/html/view/template/smslist/smslistinfo.html','show'=>'block'),
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'设置',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'用户管理',
							'show'=>'block',
							'item_arr'=>array(
								//array('item_name'=>'用户分组','target'=>'../../../../modules/html/view/template/admin/admincat.html','show'=>'block'),
								array('item_name'=>'用户信息','target'=>'../../../../modules/html/view/template/admin/admininfo.html','show'=>'block')
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'扩展',
					'show'=>'block',
					'submenu_arr'=>array(
					/*
						array(
							'submenu_name'=>'静态生成',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'静态模块管理','target'=>'../../../../modules/html/view/template/model.html','show'=>'block'),
								array('item_name'=>'生成静态页面','target'=>'../../../../modules/php/action/page/makePage.php','show'=>'block'),
							)
						),//<!--左侧菜单-->
						*/
						array(
							'submenu_name'=>'扩展',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'操作日志','target'=>'../../../../modules/html/view/template/log/log.html','show'=>'block')
							)
						),//<!--左侧菜单-->
						array(
							'submenu_name'=>'数据库工具',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'数据备份','target'=>'../../../../modules/html/view/template/data/backup.html','show'=>'block'),
								array('item_name'=>'数据还原','target'=>'../../../../modules/html/view/template/data/restore.html','show'=>'block')
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
			);
			
			//其他操作
		}
		
		$data_arr['menu'][1]['submenu_arr'][0]['item_arr'][0]['show']='none';
		if($_SESSION['admin_name']==''){$data_arr['locked']='true';}
		if($_SESSION['priviledges']!='super'){
			/************审批管理******************/
			if(!in_array('concat_query',$priviledges) && !in_array('file_add',$priviledges) && !in_array('file_query',$priviledges) && !in_array('file_report',$priviledges) && !in_array('seal_add',$priviledges) && !in_array('seal_query',$priviledges) && !in_array('seal_report',$priviledges)){
				 $data_arr['menu'][1]['show']='none';
				}
				
			if(!in_array('concat_query',$priviledges)){
			//if(true){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][0]['show']='none';
				}
			if(!in_array('file_add',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][1]['show']='none';
				}
			if(!in_array('file_query',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][2]['show']='none';
				}
			if(!in_array('file_report',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][3]['show']='none';
				}
			if(!in_array('seal_add',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][4]['show']='none';
				}
			if(!in_array('seal_query',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][5]['show']='none';
				}
			if(!in_array('seal_report',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][6]['show']='none';
				}
			/************短信管理******************/
			if(!in_array('sms_query',$priviledges) && !in_array('sms_report',$priviledges) && !in_array('smslistcat_query',$priviledges) && !in_array('smslistinfo_query',$priviledges)){
				 $data_arr['menu'][2]['show']='none';
				}
			
			if(!in_array('sms_query',$priviledges) && !in_array('sms_report',$priviledges)){
				 $data_arr['menu'][2]['submenu_arr'][0]['show']='none';
				}
			if(!in_array('sms_query',$priviledges)){
				 $data_arr['menu'][2]['submenu_arr'][0]['item_arr'][0]['show']='none';
				}
			if(!in_array('sms_report',$priviledges)){
				 $data_arr['menu'][2]['submenu_arr'][0]['item_arr'][1]['show']='none';
				}
				
			if(!in_array('smslistinfo_query',$priviledges) && !in_array('smslistinfo_query',$priviledges)){
				 $data_arr['menu'][2]['submenu_arr'][1]['show']='none';
				}
			if(!in_array('smslistinfo_query',$priviledges)){
				 $data_arr['menu'][2]['submenu_arr'][1]['item_arr'][0]['show']='none';
				}
			if(!in_array('smslistinfo_query',$priviledges)){
				 //$data_arr['menu'][2]['submenu_arr'][1]['item_arr'][1]['show']='none';
				}
			/************设置******************/
			if(!in_array('admincat_query',$priviledges) && !in_array('admininfo_query',$priviledges)){
				 $data_arr['menu'][3]['show']='none';
				}
			if(!in_array('admincat_query',$priviledges)){
				 $data_arr['menu'][3]['submenu_arr'][0]['item_arr'][0]['show']='none';
				}
			if(!in_array('admininfo_query',$priviledges)){
				 $data_arr['menu'][3]['submenu_arr'][0]['item_arr'][1]['show']='none';
				}
			/************扩展******************/
			if(!in_array('loginfo_query',$priviledges) && !in_array('data_backup',$priviledges) && !in_array('data_restore',$priviledges)){
				 $data_arr['menu'][4]['show']='none';
				}
				
			if(!in_array('loginfo_query',$priviledges)){
				 $data_arr['menu'][4]['submenu_arr'][0]['show']='none';
				}
				
			if(!in_array('data_backup',$priviledges) && !in_array('data_restore',$priviledges)){
				 $data_arr['menu'][4]['submenu_arr'][1]['show']='none';
				}
			if(!in_array('data_backup',$priviledges)){
				 $data_arr['menu'][4]['submenu_arr'][1]['item_arr'][0]['show']='none';
				}
			if(!in_array('data_restore',$priviledges)){
				 $data_arr['menu'][4]['submenu_arr'][1]['item_arr'][1]['show']='none';
				}
		}else{
			 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][1]['show']='none';
			 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][4]['show']='none';
		}
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
		$_SESSION['admin_name']='';
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
		echo $_SESSION['admin_name'].'{|}'.$_SESSION['catName'].'{|}'.$_SESSION['addedDate'].'{|}'.$_SESSION['lastIP'].'{|}'.$_SESSION['lastLoginTime'].'{|}'.$_SESSION['realname'];	
	}
	
}
?>