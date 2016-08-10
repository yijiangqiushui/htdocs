

<?php
/**
* 文件描述
*
* @author david <david55555.hi@gmail.com>
* @date 2015年11月18日 上午10:51:19
* @version 1.0.0
* @copyright 
*/
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';

$db = new DB();
$department = $_SESSION['department'];
$sql = "Select * from project_type where dep_type=$department and dep_type>=0";
$result = $db->SelectOri($sql);
