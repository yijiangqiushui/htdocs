<?php
include './form.doact.php';

$table_name = $_POST['table_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$action = $_GET['action'];
$formAction = new formAction();
switch($action)
{
    case 'generateid':
        $formAction->generateID($username,$password);
        break;
}