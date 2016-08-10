<?php
include '../../../../php/config.ini.php';
include 'config.ini.php';
include ROOTPATH.'lib/db.cls.php';

$db=new DB();
$sql="select id,title,thumbnail,add_time from contentinfo limit ".($_GET['size']*($_GET['page']-1)).",".$_GET['size'];
$rs=$db->select($sql);
$data_arr=array();
if(sizeof($rs)>0){
	for($i=0;$i<sizeof($rs);$i++){
		$data_arr[$i]["id"]=$rs[$i][id];
		$data_arr[$i]["title"]=$rs[$i][title];
		$data_arr[$i]["thumbnail"]=$rs[$i][thumbnail];
		$data_arr[$i]["add_time"]=$rs[$i][add_time];
	}
}
echo json_encode($data_arr);
?>
