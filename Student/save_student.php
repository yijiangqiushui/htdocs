<?php
$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$address = $_REQUEST['address'];
include 'conn.php';
$sql = "insert into student(name,phone,address) values('$name','$phone','$address')";
$result = @mysql_query($sql);
if($result)
{
    echo json_encode(array('success'=>true));
}
else
{
    echo json_encode(array('msg'=>'Some errors occured.'));
}
?>