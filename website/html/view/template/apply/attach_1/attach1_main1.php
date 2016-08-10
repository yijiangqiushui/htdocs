<?php
include '../../../../../../center/php/config.ini.php';
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';
  session_start();
  $db = new DB();
  $project_id = $_SESSION['project_id'];
  $user_type = $_SESSION['user_type'];
  $sql = "Select * from table_status where project_id = '$project_id' and table_name = '北京市通州区科技计划项目实施方案' ";

  $result = $db -> SelectOri($sql);
  $result_table = mysql_fetch_object($result);
  $table_status = $result_table -> table_status; 
//    echo $table_status;
//   echo $user_type;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>北京市通州区科技计划项目实施方案</title>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/jquery.cookie.js"></script> -->
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/layout.js"></script>
<link href="../../../../../../common/html/plugin/jquery-hlui-2.0/css/layout.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
href="../../../../../../website/html/view/css/tablestyle.css" />
<script type="text/javascript" src="../../../js/apply/attach_1/attach1_main.js"></script>
<link href="../../../css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="default_left">
<div class="menus">
  <h1>申报阶段</h1>
  <ul class="apply">
    <label>北京市通州区科技计划项目实施方案<span></span></label>
    <!-- <li><a href="Projectapp/project_summary.html">&nbsp;&nbsp;&nbsp;&nbsp;1.1 项目基本信息</a><span></span></li> -->
    <li><a href="../../Projectapp/org_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.1 项目承担单位基本信息</a><span></span></li>
    <li><a href="../../Projectapp/project_meaning.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.2 项目的目的、意义及必要性</a><span></span></li>
    <li><a href="../../Projectapp/project_status.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.3 相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础</a><span></span></li>
    <li><a href="../../Projectapp/project_target.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.4 项目任务与目标、考核指标</a><span></span></li>
    <li><a href="../../Projectapp/project_content.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.5 项目研究开发内容</a><span></span></li>
    <li><a href="../../Projectapp/project_techway.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.6 项目技术方案与技术路线</a><span></span></li>
    <li><a href="../../Projectapp/project_ann_plan.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.7 项目各年度任务目标、考核指标及研究开发内容完成的计划进度</a><span></span></li>
    <li><a href="../../total_fund.php">&nbsp;&nbsp;&nbsp;&nbsp;1.8 项目经费预算</a><span></span></li>
    <li><a href="../../Projectapp/project_risk.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.9 项目实施的风险分析及规避预案</a><span></span></li>
    <li><a href="../../Projectapp/project_expert_form.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.10 预期成果形式、知识产权归属与管理</a><span></span></li>
    <li><a href="../../Projectapp/project_economy_effect.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.11 项目完成后的经济社会效益分析与成果推广方案</a><span></span></li>
    <li><a href="../../Projectapp/project_member.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.12 项目承担单位、参加单位、项目负责人、项目研究人员</a><span></span></li>
    <li><a href="../../Projectapp/project_opinion_promise.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.13 签署意见及承诺</a><span></span></li>
    
    <?php 
         if($user_type == 0){
         	if($table_status >2 ){
//          		echo "<li><a href=\"../../check_opinion.php?status=".$table_status."&table_name='北京市通州区科技计划项目实施方案'\">&nbsp;&nbsp;&nbsp;&nbsp;1.14 审核意见</a><span></span></li>";
         		echo "<li><a href=\"/website/html/view/template/check_opinion.php?status=".$table_status."&table_name='北京市通州区科技计划项目实施方案'\">&nbsp;&nbsp;&nbsp;&nbsp;审核意见</a><span></span></li>";
         	}               
            
//             if($table_status > 2){
// //                 echo "<li><a href=\"Projectapp/project_check_opinion.php?status=". $table_status."&table_name="."北京市通州区科技计划项目实施方案"."\"".">&nbsp;&nbsp;&nbsp;&nbsp;1.14 审核意见</a><span></span></li>";
//                 echo "<li><a href=\"check_opinion.php?status=".$table_status."&table_name='北京市通州区科技计划项目实施方案'\">&nbsp;&nbsp;&nbsp;&nbsp;审核意见</a><span></span></li>";
                                
//             }
            
        }
        else{
//             echo "<li><a href=\"Projectapp/project_check_opinion.php?status=". $table_status."&table_name="."项目实施方案"."\"".">&nbsp;&nbsp;&nbsp;&nbsp;1.14 审核意见</a><span></span></li>";
                echo "<li><a href=\"/website/html/view/template/check_opinion.php?status=".$table_status."&table_name='北京市通州区科技计划项目实施方案'\">&nbsp;&nbsp;&nbsp;&nbsp;审核意见</a><span></span></li>";
                        
        } 
    echo "</ul>";
    if($user_type == 0){
        if($table_status == 1 || $table_status == 3){
            echo "<h1>提交实施方案</h1>";
            echo "<ul class='apply'>";
            echo "<li><a href='#' onclick='execute();'>&nbsp;&nbsp;&nbsp;&nbsp;提交北京市通州区科技计划项目实施方案</a></li>";
        }
    }
  ?>
  
  
  <!-- <li><a href="#" onclick="javascript:window.open('fruits1.html');window.close();">&nbsp;&nbsp;&nbsp;&nbsp;提交立项申请</a></li> -->
  
  </ul>
</div>
</div><!--default_left-->
<?php 
$type=$_GET['type'];
if($type==1){
    //前台显示,没有通过的按钮 
    
}else if($type==2){
    //后台显示，有通过的按扭
    $name=$_GET['name'];
    echo "<input type='button' onclick='ischeck(1,$name)' value='通过'/><br/>";
    echo "<input type='button' onclick='ischeck(0,$name)' value='不通过'/>";
}
?>



</body>
</html>
