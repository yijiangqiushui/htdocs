<?php
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
$db = new DB ();
session_start();
$project_id = $_SESSION ['project_id'];
$table_name = $_GET ['table_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <!-- <link rel="stylesheet" type="text/css" href="../../css/style.css" /> -->
    <title>无标题文档</title>
    <link rel="stylesheet" type="text/css" href="../../../../website/html/view/css/tablestyle.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/icon.css"/>
    <script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript"  src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <!-- <script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script> -->
    <script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="../js/check_opinion.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/button.css"/>
    <style>
        p {
            font-size: 16px;
        }
    </style>
</head>
<body>
<form id="check_opinion" method="post" action="#">
    <div style="margin: 40px 20px;">
        <table style="border:1px solid #1B63AB;width:100%;">
            <tr>
                <td style="background-color:#7AB5ED;height:20px;">
                    <center><div style="line-height:32px;color:#FFF002;font-weight: bold;">审核意见</div></center>

                </td>
            </tr>
            <tr style="background-color:#D1E4F3 ">
                <td><textarea id="approval_opinion" name="approval_opinion" style="border:1px solid #1B63AB;height:250px;margin-bottom:50px;width:94%; margin-left:3% ;margin-right:10% ;margin-top:15px ;overflow-x:hidden;border:1px solid #76B8EC">
                    <?php
                    $sql = "SELECT * FROM table_status WHERE project_id = '$project_id' and table_name = '$table_name'";
                    $db = new DB ();
                    $result_table = $db->SelectOri($sql);
                    $table_opinion = $result_table ['approval_opinion'];
                    //2016.01.10加入;
                    $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
                    if ($table_opinion != null ) {
                        echo $table_opinion;
                    }

                    ?>
          </textarea></td>
            </tr>
        </table>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </br>&nbsp;&nbsp;
        <div style="margin: 20px auto; width: 500px;padding-bottom: 40px;">

        <?php
        $table_status = $_GET ['status'];
        $user_type = $_SESSION ['user_type'];
        // echo $table_status;
        if ($user_type > 0) {
            if ($table_status == 2) {

                echo "<input type='button' value='审核通过并提交' onclick=\"check_pass(" . $table_name . ");\" class='save' style='width:165px;'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
                echo "<input type='button' value='驳回并提交' onclick=\"check_deny(" . $table_name . ");\" class='save'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
                echo "<input type='reset' value='重   置' class='save'/>";
            }
        } else {
        }

        ?>

        </div>
    </div>
</form>
</body>
</html>
