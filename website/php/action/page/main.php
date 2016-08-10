<?php
/**************************************************
 #	Version 1.2		PHP MySQL JavaScript
 #	Copyright (c) 2009 http://www.fangbian123.com
 #	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
 #	Date: 2009/10/10
 #	Modified by Li Zhixiao	2014/03/14
 **************************************************/
include '../../../../common/php/config.ini.php';
include '../../config.ini.php';
include ROOTPATH . 'lib/db.cls.php';
include ROOTPATH . 'lib/user.cls.php';
include ROOTPATH . 'lib/main.cls.php';

/**
 * *功能：处理管理面板信息
 */
{
	$main = new MAIN ();
	
	$action = $_GET ['action'];
	switch ($action) {
		case 'init' :
			{
				$main->Init ();
			}
			;
			break;
		case 'isdeny' :
			// if($_SESSION['org_code']<1){
			if ($_SESSION ['org_code'] == null || $_SESSION ['org_code'] == '') {
				echo 'deny';
			} else {
				echo 'allow';
			}
			;
			break;
		case 'logout' :
			{
				session_start ();
				session_destroy ();
				
				$data_arr = array ();
				$data_arr ['type'] = 'success';
				echo json_encode ( $data_arr );
			}
			;
			break;
		case 'removeSession' :
			{
				if ($_SESSION ['app_id'] !== '' && $_SESSION ['app_id'] !== null) {
					unset ( $_SESSION ['app_id'] );
				}
				if ($_SESSION ['app_award'] !== '' && $_SESSION ['app_award'] !== null) {
					unset ( $_SESSION ['app_award'] );
				}
				if ($_SESSION ['app_unit'] !== '' && $_SESSION ['app_unit'] !== null) {
					unset ( $_SESSION ['app_unit'] );
				}
				if ($_SESSION ['app_people'] !== '' && $_SESSION ['app_people'] !== null) {
					unset ( $_SESSION ['app_people'] );
				}
				if ($_SESSION ['app_proof1'] !== '' && $_SESSION ['app_proof1'] !== null) {
					unset ( $_SESSION ['app_proof1'] );
				}
				if ($_SESSION ['app_proof2'] !== '' && $_SESSION ['app_proof2'] !== null) {
					unset ( $_SESSION ['app_proof2'] );
				}
				if ($_SESSION ['app_proof3'] !== '' && $_SESSION ['app_proof3'] !== null) {
					unset ( $_SESSION ['app_proof3'] );
				}
				if ($_SESSION ['app_proof4'] !== '' && $_SESSION ['app_proof4'] !== null) {
					unset ( $_SESSION ['app_proof4'] );
				}
				if ($_SESSION ['app_proof5'] !== '' && $_SESSION ['app_proof5'] !== null) {
					unset ( $_SESSION ['app_proof5'] );
				}
				if ($_SESSION ['app_proof6'] !== '' && $_SESSION ['app_proof6'] !== null) {
					unset ( $_SESSION ['app_proof6'] );
				}
				if ($_SESSION ['app_proof7'] !== '' && $_SESSION ['app_proof7'] !== null) {
					unset ( $_SESSION ['app_proof7'] );
				}
				if ($_SESSION ['app_proof'] !== '' && $_SESSION ['app_proof'] !== null) {
					unset ( $_SESSION ['app_proof'] );
				}
			}
			;
			break;
	}
}
?>