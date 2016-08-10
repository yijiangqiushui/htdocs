<?php

session_start();
session_destroy();

setcookie('isAutoLogin','');
setcookie('S_A_ID','');
setcookie('S_A_name','');
setcookie('S_A_roleName','');
?>
<script type="text/javascript">
//用于跳出框架
if (self!=top)
	window.top.location.replace(self.location);


window.location.href="./dataBackup_logout.php";



</script>