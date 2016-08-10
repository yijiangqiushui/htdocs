<?php
// 用账号密码登陆， 登陆成功  返回1
// 戴伟反馈


// require_once('../common/php/config.ini.php');
include __DIR__.'../../common/php/config.ini.php';
require_once(ROOTPATH.'../../cms/class/content.cls.php');
require_once(ROOTPATH.'../../cms/system/class/page.cls.php');
require_once(ROOTPATH.'../../cms/system/func/special.inc.php');

require_once(ROOTPATH.'../../common/php/lib/user.cls.php');

require_once(ROOTPATH.'../../common/php/lib/db.cls.php');
require_once(ROOTPATH.'../../modules/php/action/class/center/center.cls.php');




/*!-- 类声明 start --*/
$contentCls=new content();

/*!-- 类声明 end --*/

$nowDate = date('Y-m-d H:i:s');//记下现在的时刻


$type = $_GET['type'];

if(isset($type)&&$type=="login")
{
		$name = $_GET['name'];
		$pwd = $_GET['pwd'];

		// 对  $pwd 加密 开始  ------------
		$usr=new USER();
		$pwd =  $usr->EncriptPWD($pwd);
		// end 加密-----------------------------

		/**
		* 在该部分判断管理员身份，非管理员不进行处理
		**/
		/*!-- 预留位置 start --*/

		$querySQL=" username='".$name."' and password='".$pwd."'";
		//echo $category;

		/*!-- 获取列表信息 start --*/
// 		$sql="select id from login_info where $querySQL";
		$sql="select id from admininfo where $querySQL";
// 		echo $sql;
		$info=$contentCls->getBatchInfo($sql);
		$recordCount=0;
		if($info)
		   $recordCount=count($info);
		/*!-- 获取列表信息 end --*/

		if( $recordCount>0)
			echo $info[0]["id"];
		else
			echo 0;  //0表示根本没有找到嘛
}
else
{
	   $id = $_GET['id'];
		// 仿照上面的写sql，直接返回有多少个项目代办哦。 格式如下,对，我就返回个数字，用逗号分隔：
	    $checknum = 0;
	    $db = new DB();
	    $center = new Center();
	    $user_result = $db -> GetInfo($id,'admininfo');
	    $department = $user_result['department'];
	    global $global_department;
	    
	    $sql = 'select * from project_type where dep_type='.$department;
	    $res = $db->Select($sql);
	    foreach ($res as $temp){
	        
	        $tmp_num = $center->checkNum($temp['id']);
	        $checknum  =  $tmp_num + $checknum;
	    }

	    $department_name = $global_department[$department]['name'];
	    $db->Close();
	
	echo $department_name.'的待办事项数量为：'.$checknum ;
}
?>