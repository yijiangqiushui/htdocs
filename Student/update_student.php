<?php
$id = intval($_REQUEST['id']);
$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$address = $_REQUEST['address'];

include 'conn.php';

$sql = "update student set name='$name',phone='$phone',address='$address' where id=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>