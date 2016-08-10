<?php
/**
 author:Gao Xue
 date:2014-04-28
 modify:Wang Le
 date:2014-09-05
 */
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';

include '../../../../common/php/lib/log.cls.php';

switch ($_POST ['action']) {
	case 'LogOpenMid' : // 开启中期 1.0
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$res = $db->GetInfo1 ( $params [0], "project_info", "project_id" );
		$loginfo ['opt'] = "开启了 项目：" . $res ["project_name"] . " 的中期报告";
		$log->addLog ( $loginfo );
		$db->Close ();
		break;
	case 'LogBathOpenMid' : // 批量开启项目中期1.0
		$selRows = $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$str = "批量开启了 ";
		foreach ( $selRows as $item ) {
			$res = $db->GetInfo1 ( $item, "project_info", "project_id" );
			$str = $str . $res ["project_name"] . ", ";
		}
		$loginfo ['opt'] = $str . " 的中期报告";
		$log->addLog ( $loginfo );
		$db->Close ();
		break;
	case 'LogCheck_pass' : // 审核通过日志
		$project_id = $_SESSION ['project_id'];
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$res = $db->GetInfo1 ( $params [0], "table_type", "id" );
		$res2 = $db->GetInfo1 ( $project_id, "project_info", "project_id" );
		$loginfo ['opt'] = "审批通过了项目  " . $res2 ["project_name"] . "  的 表： " . $res ["name"];
		$log->addLog ( $loginfo );
		$db->Close ();
		break;
	case 'LogCheck_nopass' : // 审核不通过日志
		$params = ( array ) $_POST ['params'];
		$project_id = $_SESSION ['project_id'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$res = $db->GetInfo1 ( $params[0], "table_type", "id" );
		$res2 = $db->GetInfo1 ( $project_id, "project_info", "project_id" );
		$loginfo ['opt'] = "审批通不通过项目  " . $res2 ["project_name"] . "  的 表： " . $res ["name"];
		$log->addLog ( $loginfo );
		$db->Close ();
		break;
	case 'LogCheck_deny' : // 审核通过日志
		$project_id = $_SESSION ['project_id'];
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$res = $db->GetInfo1 ( $params [0], "table_type", "id" );
		$res2 = $db->GetInfo1 ( $project_id, "project_info", "project_id" );
		$loginfo ['opt'] = "驳回修改了  " . $res2 ["project_name"] . "  的 表： " . $res ["name"];
		$log->addLog ( $loginfo );
		$db->Close ();
		break;
	case 'LogOpenCheck' : // 开启验收
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$res = $db->GetInfo1 ( $params[0], "project_info", "project_id" );
		$loginfo ['opt'] = "开启了 项目：" . $res ["project_name"] . " 的验收";
		$log->addLog ( $loginfo );
		$db->Close ();
		break;
	case 'LogCloseCheck' : // 关闭验收 1.0
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$res = $db->GetInfo1 ( $params [0], "project_info", "project_id" );
		$loginfo ['opt'] = "关闭了 项目：" . $res ["project_name"] . " 的验收";
		$log->addLog ( $loginfo );
		$db->Close ();
		break;
	case 'logBathCheck' ://批量审批
		$selRows = $_POST ['selRows'];
		$status = $_POST ['status'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		if ($status == "yes") {
			$str = "批量审批通过了 项目  ";
		} else {
			$str = "批量审批不通过了 项目  ";
		}
		
		foreach ( $selRows as $item ) {
			$res = $db->GetInfo1 ( $item, "project_info", "project_id" );
			$project_stage = $res ['project_stage'];
			$res2 = $db->GetInfo5 ( $item, "table_status", "project_id", $project_stage, "project_stage" );
			$str = $str . $res ["project_name"] . " 的表:（";
			$count = 0;
			foreach ( $res2 as $val ) {
				$name = $log->getName ( $val ["table_name"] );
				$str = $str . $name . ",";
				$count ++;
			}
			$str = $str . ")、";
		}
		$loginfo ['opt'] = $str;
		$log->addLog ( $loginfo );
		$db->Close ();
		break;
	
	case 'logdelUser' : // 禁用用户日志
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$res = $db->GetInfo1 ( $params[0], "login_info", "id" );
		$loginfo ['opt'] = "禁用了用户：" . $res ["username"];
		$log->addLog ( $loginfo );
		break;
	case 'logrecUser' : // 单个启用用户日志
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$res = $db->GetInfo1 ( $params[0], "login_info", "id" );
		$loginfo ['opt'] = "启用了用户：" . $res ["username"];
		$log->addLog ( $loginfo );
		break;
	case 'LogBatchRecUsers' : // 批量启用用户日志
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$str="批量恢复了用户：";
		foreach ($params as $val){
			$res = $db->GetInfo1 ( $val, "login_info", "id" );
			$str = $str . $res ["username"] . ", ";
		}
		$loginfo ['opt']=$str;
		$log->addLog ( $loginfo );
		break;
		
	case 'LogOpenProject' : // 开启项目
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$res = $db->GetInfo1 ( $params[0], "project_type", "id" );
		$loginfo ['opt'] = "开启了项目：" . $res ["name"];
		$log->addLog ( $loginfo );
		break;
		
	case 'LogCloseroject' : // 开启项目
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$res = $db->GetInfo1 ( $params[0], "project_type", "id" );
		$loginfo ['opt'] = "关闭了项目：" . $res ["name"];
		$log->addLog ( $loginfo );
		break;
		
		
	case 'LogExportExcel' : // 启用用户日志
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$str = "批量导出了 ";
		foreach ( $params[0] as $item ) {
			$res = $db->GetInfo1 ( $item, "project_info", "project_id" );
			$str = $str . $res ["project_name"] . ", ";
		}
		$loginfo ['opt'] = $str . " 的Excel表";
		$log->addLog ( $loginfo );
		break;
		
	case 'LogSendSms' : // 群发送短信
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$str = "给 ";
		foreach ( $params[0] as $item ) {
			$res = $db->GetInfo1 ( $item, "project_info", "project_id" );
			$str = $str . $res ["linkman"] . ", ";
		}
		$loginfo ['opt'] = $str . " 发送了短信";
		$log->addLog ( $loginfo );
		break;
	case 'LogAddUser' : // 添加用户
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db = new DB ();
		$str = "添加了用户 : ";
			$str = $str . $params [0];
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;

	case 'LogAddProType' ://添加项目类型
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$str="添加了项目类型：";
		if($params[1]==null||$params[1]==''){//没有子类
		$str=$str.$params[0];
		}else{//有子类
			$str=$str."父类型：".$params[0].",子类型：$params[0]";
		}
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
	case 'LogEditProType' ://编辑项目类型
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$str="修改了项目类型：".$params[0];
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
	case 'LogDeleteProType' ://删除项目类型
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$res= $db->GetInfo1($params[0], "project_type", "id");
		$str="删除了项目类型：".$res["name"];
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
	case 'LogDelArrProType' ://批量删除项目类型
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$str="批量删除了项目类型：";
		$t_str_arr = explode("|",$params[0]);
		foreach ($t_str_arr as  $val){
			$str.",".$val;
		}
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
	case 'LogSetProType' ://发布项目类型
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$str="发布了项目类型：";
		$t_str_arr = explode("|",$params[0]);
	  foreach ($t_str_arr as  $val){
    	$res=$db->GetInfo1($val, "project_type", "id");
    	$str=$str.$res["name"].",";
	   }
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
	case 'LogRelProType' ://回复项目类型
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$str="恢复了项目类型：";
	    $res= $db->GetInfo1($params[0]["id"], "project_type", "id");
	    $str=$str.$res["name"];
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
	case 'LogDelProType' ://删除项目类型
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$str="删除了项目类型：";
	    $res= $db->GetInfo1($params[0]["id"], "project_type", "id");
	    $str=$str.$res["name"];
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
		//6217981210000173791
	case 'LogModyProSub' ://修改项目子表
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$project_id= $_SESSION ['pt_edit_id'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$res=$db->GetInfo1($project_id,"project_type","id");
		$str="修改了项目 类型：";
	    $str=$str.$res["name"];
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
	case 'LogSetCheck' ://审批设置
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$project_id= $_SESSION ['pt_edit_id'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$res=$db->GetInfo1($params[0],"project_type","id");
		$str="设置了 ：";
	    $str=$str.$res["name"]."的审批";
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
		
	case 'LogSetCheckQ' ://审批设置
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$project_id= $_SESSION ['pt_edit_id'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$res=$db->GetInfo1($params[0],"project_type","id");
		$str="设置了 ：";
	    $str=$str.$res["name"]."的查重权限等信息";
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
		
	case 'LogBuildProject' ://审批设置
		$params = ( array ) $_POST ['params'];
		$loginfo ['username'] = $_SESSION ['realname'];
		$project_id= $_SESSION ['pt_edit_id'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$res=$db->GetInfo1($params[0],"project_info","project_id");
		$str="开启了 ：";
	    $str=$str.$res["project_name"]."的立项";
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
		
	case 'addLog' :
			$log = new LOGINFO ();
			$loginfo ['opt'] = $_POST ['option'];
			$loginfo ['username'] = $_SESSION ['realname'];
			$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
			$log->addLog ( $loginfo );
			break;
	case 'queryLog' :
		$log = new LOGINFO ();
		$page = $_POST ['page'];
		$rows = $_POST ['rows'];
		
		$log->queryLog ( $page, $rows );
		break;
	//=======================================	
	case 'LogcheckPart' ://审批权限设置
		$params =$_POST ['params'];
		$params=explode("|",$params);
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$res_name='';
		for($i=0;$i<count($params);$i++){
			$res=$db->GetInfo1($params[$i],"project_type","id");
			$res_name.=$res['name'].',';
		}
		$str="设置了 ：";
	    $str=$str.$res_name."的审批权限";
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
		
	case 'Logjcqx' ://监察权限设置
		$params =$_POST ['params'];
		$params=explode("|",$params);
		
		$loginfo ['username'] = $_SESSION ['realname'];
		$loginfo ['timedata'] = date ( 'Y-m-d H:i:s', time () );
		$log = new LOGINFO ();
		$db=new DB();
		$res_name='';
		for($i=0;$i<count($params);$i++){
			$paramsId=explode("_",$params[$i]);
			$res=$db->GetInfo1($paramsId[2],"project_type","id");
			$res_name.=$res['name'].',';
		}
		$str="设置了 ：";
	    $str=$str.$res_name."的监察权限";
		$loginfo ['opt'] = $str ;
		$log->addLog ( $loginfo );
		break;
	default :
		;
}

?>