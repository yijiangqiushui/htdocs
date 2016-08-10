<?php 

header("content-type:text/html;charset=utf-8");

date_default_timezone_set("PRC");

$pImg=$_FILES['pImg'];
$timestamp = strtotime("now");
// print_r($pImg);
global $filename;

if($pImg['error']==UPLOAD_ERR_OK){

  //取得扩展名

$tt = explode('.',$pImg['name']);
  $extName=strtolower(end($tt));

  //echo $extName;

  $filename=$timestamp.".".$extName;

  //echo $filename;

 $dest="./".$filename;

  move_uploaded_file($pImg['tmp_name'],$dest);

  echo "上传成功";

}else{

  echo "上传错误";

}


?>


<script text="text/javascript">
window.location="./dup_check.php?file=<?php echo $filename?>";

</script>