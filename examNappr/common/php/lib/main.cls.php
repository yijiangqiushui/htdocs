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
include dirname(__FILE__).'/../../../../common/php/lib/pri.cls.php';
class MAIN{
	/**
	 * 功能：初始化控制面板
	 */
	public function Init(){
		$priviledges=explode(',',$_SESSION['priviledges']);
		$own_pri = Pri::instance()->pri_arr;
		$priviledges = array_merge($priviledges,$own_pri);
		//var_dump($priviledges);exit;
		$data_arr=array();
		if($_SESSION['user_id']==''){   //这个地方不太一样
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
								//array('item_name'=>'创建制发文件','target'=>'../../../../modules/html/view/template/file/file.html','show'=>'block'),
								array('item_name'=>'文件审批管理','target'=>'../../../../modules/html/view/template/file/filemanage.html','show'=>'block'),
								//array('item_name'=>'制发文件统计','target'=>'../../../../modules/html/view/template/file/chart_recommend.html','show'=>'block'),
								//array('item_name'=>'印章使用申请','target'=>'../../../../modules/html/view/template/file/seal.html','show'=>'block'),
								array('item_name'=>'印章审批管理','target'=>'../../../../modules/html/view/template/file/sealmanage.html','show'=>'block'),
								//array('item_name'=>'印章使用统计','target'=>'../../../../modules/html/view/template/file/seal_chart_report.html','show'=>'block')
								
							),
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				
				array(
					'menu_name'=>'通信管理',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'通信管理',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'通讯录管理','target'=>'../../../../modules/html/view/template/smslist/smslistinfo.html','show'=>'block'),
								array('item_name'=>'短信管理','target'=>'../../../../modules/html/view/template/sms/sms.html','show'=>'block'),
								//array('item_name'=>'短信统计','target'=>'../../../../modules/html/view/template/sms/sms_recommend.html','show'=>'block'),
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
					array(
							'menu_name'=>'申报管理',
							'show'=>'block',
							'submenu_arr'=>array(
									array(
											'submenu_name'=>'申报管理',
											'show'=>'block',
											'item_arr'=>array(
								//这个到时候需要做成可以选择科室的
// 								array('item_name'=>'前台公告发布','target'=>'../../../../../cms/cms/frame/list.php?category=1','show'=>'block'),
							    array('item_name'=>'申报项目管理','target'=>'../../../../../center/html/view/template/project_main.html','show'=>'block'),													
													//array('item_name'=>'短信统计','target'=>'../../../../modules/html/view/template/sms/sms_recommend.html','show'=>'block'),
// 								array('item_name'=>'申报项目开关','target'=>'../../../../../center/php/action/page/authority/user_role.php'),
// 								array('item_name'=>'项目流程控制','target'=>'../../../../../center/php/action/page/process/processControl.php'),
								array('item_name'=>'申报用户信息','target'=>'../../../../../center/php/action/page/generate_id/makeuser.html','show'=>'block'),
								array('item_name'=>'查看存档项目','target'=>'../../../../../center/php/action/page/generate_id/lookFile.php','show'=>'block'),
														
											)
									),//<!--左侧菜单-->
							)
					),//<!--顶部导航-->
					
				array(
					'menu_name'=>'项目类型',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'项目类型管理',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'项目类型管理','target'=>'../../../../../center/php/action/page/project_type/control.php?action=admin'),
							    array('item_name'=>'查重系统设置','target'=>'http://226.bjqskj.com:8080/phpanalysis/check_manage4.php'),
							)
						)
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
								array('item_name'=>'管理员信息','target'=>'../../../../../center/php/action/page/authority/users.php'),
								
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
				array(
					'menu_name'=>'扩展',
					'show'=>'block',
					'submenu_arr'=>array(
						array(
							'submenu_name'=>'扩展',
							'show'=>'block',
							'item_arr'=>array(
								array('item_name'=>'操作日志','target'=>'../../../../modules/html/view/template/log/log.html','show'=>'block'),
								array('item_name'=>'数据备份','target'=>'../../../../modules/html/view/template/data/backup.html','show'=>'block'),
								array('item_name'=>'数据还原','target'=>'../../../../modules/html/view/template/data/restore.html','show'=>'block')
							)
						),//<!--左侧菜单-->
					)
				),//<!--顶部导航-->
			);
			//其他操作
		}
// 		if($_SESSION['admin_name']==''){$data_arr['locked']='true';}
		if($_SESSION['priviledges']!='super'){
		    if($_SESSION['user_type'] == 2){  // 科长的权限
		        if(!in_array('sms_query',$priviledges) && !in_array('smslistcat_query',$priviledges) && !in_array('smslistinfo_query',$priviledges)){
		            $data_arr['menu'][2]['show']='none';
		        }
		        	
		        if(!in_array('sms_query',$priviledges) && !in_array('smslistinfo_query',$priviledges)){
		            $data_arr['menu'][2]['submenu_arr'][0]['show']='none';
		        }
		        if(!in_array('smslistinfo_query',$priviledges)){
		            $data_arr['menu'][2]['submenu_arr'][0]['item_arr'][0]['show']='none';
		        }
		        if(!in_array('sms_query',$priviledges)){
		            $data_arr['menu'][2]['submenu_arr'][0]['item_arr'][1]['show']='none';
		        }
		        /************设置******************/
		        /* 			if(!in_array('admincat_query',$priviledges) && !in_array('admininfo_query',$priviledges)){
		         $data_arr['menu'][3]['show']='none';
		         }
		         if(!in_array('admininfo_query',$priviledges)){
		         $data_arr['menu'][3]['submenu_arr'][0]['item_arr'][0]['show']='none';
		         } */
		    }
		    else{
		    	
		    	/************项目类型******************/
		    	if(!in_array('cjxmlx',$priviledges)){
		    	 	$data_arr['menu'][4]['show']='none';
		    	 }
		    	 
		        /************审批管理******************/
				/*if(!in_array('file_add',$priviledges) && !in_array('file_query',$priviledges) && !in_array('file_report',$priviledges) && !in_array('seal_add',$priviledges) && !in_array('seal_query',$priviledges) && !in_array('seal_report',$priviledges)){
		         $data_arr['menu'][1]['show']='none';
		         } */
		         /*if(!in_array('xxfb',$priviledges)){
		         	$data_arr['menu'][3]['submenu_arr'][0]['item_arr'][0]['show']='none';
		         }*/
		         if(!in_array('cjxmlx',$priviledges)){
		         	$data_arr['menu'][3]['submenu_arr'][0]['item_arr'][3]['show']='none';
		         }
		        
		        /*			if(!in_array('file_query',$priviledges)){
		         $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][0]['show']='none';
		         } 
		        			if(!in_array('file_report',$priviledges)){
		         $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][2]['show']='none';
		         }
		         if(!in_array('seal_add',$priviledges)){
		         $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][3]['show']='none';
		         } */
		         
		        /* 			if(!in_array('seal_query',$priviledges)){
		         $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][1]['show']='none';
		         } */
		        /*			if(!in_array('seal_report',$priviledges)){
		         $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][5]['show']='none';
		         }
		         */
		        /************t通信管理******************/
		        if(!in_array('sms_query',$priviledges) && !in_array('smslistcat_query',$priviledges) && !in_array('smslistinfo_query',$priviledges)){
		            $data_arr['menu'][2]['show']='none';
		        }
		        	
		        if(!in_array('sms_query',$priviledges) && !in_array('smslistinfo_query',$priviledges)){
		            $data_arr['menu'][2]['submenu_arr'][0]['show']='none';
		        }
		        if(!in_array('smslistinfo_query',$priviledges)){
		            $data_arr['menu'][2]['submenu_arr'][0]['item_arr'][0]['show']='none';
		        }
		        if(!in_array('sms_query',$priviledges)){
		            $data_arr['menu'][2]['submenu_arr'][0]['item_arr'][1]['show']='none';
		        }
		        /************申报管理******************/
		        /*if(!in_array('admincat_query',$priviledges) && !in_array('admininfo_query',$priviledges)){
		         $data_arr['menu'][3]['show']='none';
		         }
		         if(!in_array('admininfo_query',$priviledges)){
		         $data_arr['menu'][3]['submenu_arr'][0]['item_arr'][0]['show']='none';
		         } 
		        /************扩展******************/
		        if(!in_array('loginfo_query',$priviledges) && !in_array('data_backup',$priviledges) && !in_array('data_restore',$priviledges)){
		            $data_arr['menu'][6]['show']='none';
		        }
		        
		        if(!in_array('loginfo_query',$priviledges) && !in_array('data_backup',$priviledges) && !in_array('data_restore',$priviledges)){
		            $data_arr['menu'][6]['submenu_arr'][0]['show']='none';
		        }
		        
		        if(!in_array('loginfo_query',$priviledges)){
		            $data_arr['menu'][6]['submenu_arr'][1]['item_arr'][0]['show']='none';
		        }
		        if(!in_array('data_backup',$priviledges)){
		            $data_arr['menu'][6]['submenu_arr'][1]['item_arr'][1]['show']='none';
		        }
		        if(!in_array('data_restore',$priviledges)){
		            $data_arr['menu'][6]['submenu_arr'][1]['item_arr'][2]['show']='none';
		        }
		    }
/* 			/************审批管理******************/
/* 			if(!in_array('file_add',$priviledges) && !in_array('file_query',$priviledges) && !in_array('file_report',$priviledges) && !in_array('seal_add',$priviledges) && !in_array('seal_query',$priviledges) && !in_array('seal_report',$priviledges)){
				 $data_arr['menu'][1]['show']='none';
				} */
				
/*			if(!in_array('file_add',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][0]['show']='none';
				}
*/
/* 			if(!in_array('file_query',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][0]['show']='none';
				} */
/*			if(!in_array('file_report',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][2]['show']='none';
				}
			if(!in_array('seal_add',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][3]['show']='none';
				}
*/
/* 			if(!in_array('seal_query',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][1]['show']='none';
				} */
/*			if(!in_array('seal_report',$priviledges)){
				 $data_arr['menu'][1]['submenu_arr'][0]['item_arr'][5]['show']='none';
				}
*/
			/************t通信管理******************/
/* 			if(!in_array('sms_query',$priviledges) && !in_array('smslistcat_query',$priviledges) && !in_array('smslistinfo_query',$priviledges)){
				 $data_arr['menu'][2]['show']='none';
				}
			
			if(!in_array('sms_query',$priviledges) && !in_array('smslistinfo_query',$priviledges)){
				 $data_arr['menu'][2]['submenu_arr'][0]['show']='none';
				}
			if(!in_array('smslistinfo_query',$priviledges)){
				 $data_arr['menu'][2]['submenu_arr'][0]['item_arr'][0]['show']='none';
				}
			if(!in_array('sms_query',$priviledges)){
				 $data_arr['menu'][2]['submenu_arr'][0]['item_arr'][1]['show']='none';
				} */
			/************设置******************/
/* 			if(!in_array('admincat_query',$priviledges) && !in_array('admininfo_query',$priviledges)){
				 $data_arr['menu'][3]['show']='none';
				}
			if(!in_array('admininfo_query',$priviledges)){
				 $data_arr['menu'][3]['submenu_arr'][0]['item_arr'][0]['show']='none';
				} */
			/************扩展******************/
/* 			if(!in_array('loginfo_query',$priviledges) && !in_array('data_backup',$priviledges) && !in_array('data_restore',$priviledges)){
				 $data_arr['menu'][4]['show']='none';
				}
				
			if(!in_array('loginfo_query',$priviledges) && !in_array('data_backup',$priviledges) && !in_array('data_restore',$priviledges)){
				 $data_arr['menu'][4]['submenu_arr'][0]['show']='none';
				}
				
			if(!in_array('loginfo_query',$priviledges)){
				 $data_arr['menu'][4]['submenu_arr'][1]['item_arr'][0]['show']='none';
				}
			if(!in_array('data_backup',$priviledges)){
				 $data_arr['menu'][4]['submenu_arr'][1]['item_arr'][1]['show']='none';
				}
			if(!in_array('data_restore',$priviledges)){
				 $data_arr['menu'][4]['submenu_arr'][1]['item_arr'][2]['show']='none';
				}  */
            if(Pri::instance()->is_special){
				$data_arr['menu'][0]['show']='none';
				$data_arr['menu'][1]['show']='none';
				$data_arr['menu'][2]['show']='none';
				$data_arr['menu'][3]['submenu_arr'][0]['item_arr'][1]['show']='none';
				$data_arr['menu'][3]['submenu_arr'][0]['item_arr'][2]['show']='none';
				$data_arr['menu'][3]['submenu_arr'][0]['item_arr'][3]['show']='none';
				$data_arr['menu'][3]['submenu_arr'][0]['item_arr'][4]['show']='none';
				$data_arr['menu'][3]['submenu_arr'][0]['item_arr'][5]['show']='none';
				if(Pri::instance()->jcqx == false){
					$data_arr['menu'][3]['submenu_arr'][0]['item_arr'][0]['show']='none';
				}
				$data_arr['menu'][4]['show']='none';
				$data_arr['menu'][6]['show']='none';
			}
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
	    $department = "";
	    if($_SESSION['user_type'] != 3){
	        switch($_SESSION['department']){
	            case 0:
	                $department =  "发展计划科";
	                break;
	            case 1:
	                $department =  "科技综合科";
	                break;
	            case 2:
	                $department =  "知识产权科";
					break;
				case 3:
					$department =  "监察科";
	                break;
	        }
	        if($_SESSION['user_type'] == 2){
	            $department = $department."科长";
	        }
	    }
	    else{
	        $department = "超级管理员";
	    }
	    
// 		echo $_SESSION['admin_name'].'{|}'.$_SESSION['catName'].'{|}'.$_SESSION['addedDate'].'{|}'.$_SESSION['lastIP'].'{|}'.$_SESSION['lastLoginTime'].'{|}'.$_SESSION['realname'];	
	    echo $_SESSION['username'].'{|}'.$department.'{|}'.$_SESSION['addedDate'].'{|}'.$_SESSION['lastIP'].'{|}'.$_SESSION['lastLoginTime'].'{|}'.$_SESSION['realname'];
	}
	/*
		判断用户是否在别处登录
	*/
	public function checkLastTime(){
			$db=new DB();
// 			$sql="select lastLoginTime from admininfo where id=".$_SESSION['admin_id'];
			$sql="select lastLoginTime from admininfo where id=".$_SESSION['user_id'];
			$result=$db->Select($sql);
			if($result[0]['lastLoginTime']==$_SESSION['thisLoginTime']){
				echo 'keep';//.'------'.$result[0]['lastLoginTime'].'------'.$_SESSION['thisLoginTime'];
			}else{
				echo 'exit';//.'------'.$result[0]['lastLoginTime'].'------'.$_SESSION['thisLoginTime'];
			}
			$db->Close();
	}

}
?>