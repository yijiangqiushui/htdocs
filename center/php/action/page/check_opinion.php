<?php
// include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
//    session_start();
   $project_id = $_SESSION['project_id'];
   $table_name = $_GET['table_id'];
   $user_type=$_GET['user_type'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- <link rel="stylesheet" type="text/css" href="../../css/style.css" /> -->
<title>审核意见</title>
<link rel="stylesheet" type="text/css" href="../../../../website/html/view/css/tablestyle.css" />
<link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
<link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/icon.css"/>
<script type="text/javascript" src="../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../html/view/js/check_opinion.js"></script>
<link rel="stylesheet" type="text/css" href="../../../../website/html/view/css/button.css" />
<link rel="stylesheet" type="text/css" href=".../../../../../../website/html/view/css/table.css" />
<style>
p {
font-size: 16px;	
}
textarea {
	text-align: left;
}
</style>
</head>
<body>
				
<form id="check_opinion" method="post" action="#">
    <div class="project_content">
          <div class="table_title clearfix">
              <div class="title_pic left">审核意见</div>
              <div class="right back_pic" id="back"></div>
          </div>
          <div class="table_content back-long">
              <div class="basic_info bg_blue">
                  <p class="title_top p-b10">审核意见</p>
                  <div class="text_wrap">
                      <textarea name="approval_opinion" id="approval_opinion" class="text_content" onmousedown="fix_mouse(event,this)"><?php 
                            $db = new DB();
                            $sql = "select * from table_status where project_id ='$project_id' and table_name ='$table_name'";
//                             echo $sql;
                            $result = $db -> SelectOri($sql);
                            $result_table = mysql_fetch_array($result);
                            $table_opinion = $result_table['approval_opinion'];
                            //2016.01.10加入;
                            $result2 = $db->GetInfo1($project_id, 'project_info', 'project_id');
                            if($table_opinion != null){
                                if(($result_table ['table_status'] != 4 || $user_type != 0)){
                                    echo $table_opinion;
                                }else{ 
                                    if($result2['project_stage'] != 0 ){
                                       //if(!($result2['project_stage'] == 1 && $result2['is_check'] == 0))
                                    	  echo $table_opinion;
                                    }
                                }
                            }
                       ?>       
                      </textarea>
                  </div>
                  <div class="button_wrapper2 clearfix" style="text-align: center; display: inline-block">
                  <?php
                        
                       if($user_type==0||$user_type==-1||$result_table['table_status']==3 || $result_table['table_status']==4||$result_table['table_status']==5){
                  
                       }
                       
                       else{
                       
//                         echo "<input type='reset' value='重   置'  style='margin-left:10px;margin-right:10px;width:80px;' class='save'/>";
                        ///echo "<div style='width:700px; position:relative;'>";
                        echo "<input type='button' value='审核通过' onclick=\"check_pass(".$table_name.");\" class='pass' style='font-weight:bold;font-size:14px;position:static;margin-right:50px' />";
                        echo "<input type='button'  value='驳回修改'  style='font-weight:bold;font-size:14px;position:static;margin-right:50px  ' onclick=\"check_deny(".$table_name.");\" class='save1'/>";
                        echo "<input type='button'  value='审核未通过' style='font-weight:bold;font-size:14px;position:static;;' onclick=\"nopass('".$project_id."',".$table_name.");\"  class='nopass1'/>";
                       // echo "</div>";
                       }
                  ?>
                  </div>
                  
              </div>
          </div>
      </div>
  </form>

</body>
</html>



<?php
