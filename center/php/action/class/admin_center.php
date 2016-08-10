<?php
/**************************************************
#	Veion 1.0		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2014/03/24
**************************************************/

/**
 * 功能：控制面板相关
 */
class ADMIN_CENTER{
	public function init(){
		$data_arr=array();
		if($_SESSION['admin_id']==''){
			$data_arr['type']='forbidden';
		}
		else{
			$data_arr['type']='success';
			
			//其他操作
		}
		echo json_encode($data_arr);
	}
}
?>