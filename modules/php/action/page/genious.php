<?php 
	require_once '../../../../common/php/config.ini.php';
	require_once '../../../../common/php/lib/db.cls.php';

     $db = new DB();
	  $id = $_GET['id'];
	  $sql = "SELECT * FROM project_type WHERE id = '$id'";
	  $result = $db->Select($sql);
      $attatch_name = $result[0]['attatch_name'];
      
      if($attatch_name == '19' || $attatch_name == '20'){
      	echo 1;
      }else{
      	echo 0;
      }