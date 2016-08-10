<?php
include '../../../../php/config.ini.php';
include 'config.ini.php';
include ROOTPATH.'lib/db.cls.php';

$db=new DB();
$sql="select count(id) as total from contentinfo";
$rs=$db->select($sql);
echo $rs[0][total];
?>
