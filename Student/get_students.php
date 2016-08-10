<?php
/* $result = array();
include 'conn.php';
$sql = "select * from student";
$result = mysql_query($sql);
$items = array();
while($rs=mysql_fetch_object($result))
{
    array_push($items, $rs);
}
json_encode($items); */
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page-1)*$rows;
$result = array();

include 'conn.php'; //

$rs = mysql_query("select count(*) from student");
$row = mysql_fetch_row($rs);
$result["total"] = $row[0];
$rs = mysql_query("select * from student limit $offset,$rows");

$items = array();
while($row = mysql_fetch_object($rs)){
    array_push($items, $row);
}
$result["rows"] = $items;

echo json_encode($result);
?>