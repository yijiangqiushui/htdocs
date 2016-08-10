<?php 
    session_start();
    
    $department_type = $_SESSION['department'];
   
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title><link rel="stylesheet" type="text/css"
	href="../../../../website/html/view/css/tablestyle.css" />
</head>
<style>
    body
    {
         background:#B3B3B3;	
    }
	span
	{

		 width="170"; 
		 font-family:"微软雅黑"; 
		 font-size:28px;
	} 
</style>
<body>
      <!--   <a href="../../../php/action/page/project_list/main.php" target="main_center" style='text-decoration:none;'><span></span></a>
       <br/><br/>
       <a href="../../../php/action/page/authority/user_role.php" target="main_center" style='text-decoration:none;'><span>项目申请权限</span></a>
       <br/><br/>
       <a href="../../../php/action/page/project_list/main.php" target="main_center" style='text-decoration:none;'><span>我的项目</span></a>
		-->
		<a href="../../../php/action/page/project_list/main.php" target="main_center" style='text-decoration:none;'>
		<?php 
		switch($department_type){//后期加上相应科室
		    
        case 0:
      
           echo "<img src='../img/develop.png' width='170' height='40'>";
           echo "<br>";echo "<br>";//解决上下图片间隔高度不一样的丑问题
           echo "<a href='/center/php/action/page/process/processControl.php' target='main_center' style='text-decoration:none;'>
                 <img src='../img/devprocesscontrol.png' width='170' height='40'></a>";
           break;
        case 1:
           echo "<img src='../img/knowledge.png' width='170'height='40'>";break;
        case 2:
           echo "<img src='../img/tech.png'/ width='170'height='40'>";break;
    }
		?>
		</a>
       <br/><br/>
       <a href="../../../php/action/page/authority/user_role.php" target="main_center" style='text-decoration:none;'>
       <img src="../img/permission.png" width="170" ></a>
       <br/><br/>
       <a href="../../../php/action/page/project_list/main.php" target="main_center" style='text-decoration:none;'>
       <img src="../img/myproject.png" width="170" ></a>
       <br/><br/>
       <a href="../../../php/action/page/generate_id/makeuser.html" target="main_center" ><img  src="../img/makeuser.png" width="170"></a>
       <br/><br/>
       <a href="../../../php/action/page/authority/users.php" target="main_center" ><img  src="../img/users.png" width="170"></a>
       </body>
</html>