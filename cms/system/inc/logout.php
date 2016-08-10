<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

session_start();
session_destroy();

setcookie('isAutoLogin','',time()-3600,'/');
setcookie('S_A_ID','',time()-3600,'/');
setcookie('S_A_name','',time()-3600);
setcookie('S_A_roleName','',time()-3600,'/');

setcookie('is_N_AutoLogin','',time()-3600,'/');
setcookie('N_A_ID','',time()-3600,'/');
setcookie('N_A_name','',time()-3600,'/');
?>
<script type="text/javascript">
//用于跳出框架setcookie('u_username','',time()-3600);
if (self!=top)
	window.top.location.replace(self.location);
window.location.href="../../";
</script>