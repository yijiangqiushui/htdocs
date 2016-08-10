<?php
require_once '../../../../common/php/config.ini.php';
require_once '../../../../common/php/lib/db.cls.php';

session_start();
$db = new DB();
$project_id = $_SESSION['project_id'];

$sql1 = "SELECT project_type ,  project_engineer FROM project_info WHERE project_id = '$project_id'";

$result1 = $db -> Select($sql1);
$project_type = $result1[0]['project_type'];
$project_engineer = $result1[0]['project_engineer'];
if(empty($project_engineer)){
	$sql2 = "SELECT admin_info_id FROM pro_check_pri_map WHERE project_type_id = '$project_type' and project_type_para_id= 0";
	$result2 = $db -> Select($sql2);
	$admin_info = $result2[0]['admin_info_id'];
	$sql3 = "SELECT realname FROM admininfo WHERE id = '$admin_info'";
	$result3 = $db -> Select($sql3);
	$project_engineer = $result3[0]['realname'];
}
//受理人

// $project_type = $result1[0];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>通州区科委项目申报系统-我的项目</title>
    <link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/icon.css"/>
    <script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
	<script type="text/javascript" src="../../../../center/html/view/js/common.js"></script>
    <script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
    <script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="../js/user_project.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/table.css"/>
    <script type="text/javascript">
        window.customResize = function () {
            var width = $(window).width() - 10;
            var height = $(window).height();
            var panelHeight = parseInt(height / 2); //每个1/3高度  
            $('#div1').panel('resize', {width: width, height: panelHeight});
            $('#div2').panel('resize', {width: width, height: panelHeight});
            $('#div0').layout('resize', {width: width, height: height});
        };
    </script>
    <script type="text/javascript">
        //窗口缩放时，重绘布局控件尺寸   
        $(function () {
            redraw();
        });

        $(window).resize(function () {
            redraw();
        });
        function redraw() {
            if (window.customResize) {
                customResize(); //自定义缩放函数，页面若使用多个布局控件，需自定义缩放函数处理  
            } else {
                var width = $(window).width();
                var height = $(window).height();
                //没有自定义缩放函数时，默认对panel，layout，treegrid，datagrid等控件进行调整  
                $('.easyui-panel').panel('resize', {width: width, height: height});
                $('.easyui-layout').layout('resize', {width: width, height: height});
                $('.easyui-treegrid').treegrid('resize', {width: width, height: height});
                $('.easyui-datagrid').datagrid('resize', {width: width, height: height});
            }
        }
    </script>

    <style type="text/css">
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
        }
        input {
            font-size: 14px !important;
        }
        table td {
            color: #333;
            font-size: 14px !important;
            line-height: 25px;
/*             padding-left: 15px; */
        }
        table input {
            width: 100%;
        }
    </style>
</head>
<body>

<form id="user_project" method="post" action=""  style="margin-top: 40px; margin-left: 20px;padding-right: 20px;">
    <div id="div0">
        <div class="table_title">
            <div class="title_pic">项目基本信息</div>
            <div class="right back_pic" style='margin-top: -26px;' onclick='back()'></div>
        </div>
        <div id="div1" class="table_content">
            <table border="0" cellpadding="0" cellspacing="0" class="basic_info">
                <tr>
                <th width="130">申报人姓名</th>
                    <td width="" align="center" colspan = '3'>
                        <input type="text" id="project_name" name="project_name" readonly="readonly"/>
                    </td>
                   

                </tr>
                <tr>
                     <th class="border_left_w">项目类型</th>
                    <td >
                        <input type="text" name="project_type" readonly="readonly"/>
                    </td>
                    <?php
                        global $global_project_stage;
                        $db = new DB ();
                        $project_id = $_SESSION ['project_id'];
                        $sql_project = "Select * from project_info where project_id='$project_id'";
                        //echo $project_id;
                        $project = $db->SelectObject($sql_project);
                        $project_stage = $project->project_stage;
                        $temp = $global_project_stage[$project_stage]['stage'];
                        
/*                         //首先需要获得该项目类型
                        $project_type = $project->project_type;
                        $sql_project_relative = "select * from project_check_relative where project_type_id = $project_type";
                        $result_project_relative = $db -> Select($sql_project_relative); */
                        
                        /* //加入查重的阶段值;
                        $sql = "select * from check_status where project_id='$project_id'";
                        $result = $db->Select($sql);
                        $is_recheck = false;
                        if(count($result) > 0){
                            $is_recheck = true;
                            $ispass = $result['ispass'];
                        }
 */
                        
/*                         if(!$is_recheck)
                        {     */
                             echo "<th class='border_left_w'>当前阶段</th>
                              <td><input type='text' name='current_stage' value='$temp' readOnly='readonly'/></td>";
//                         }
/*                         else
                        {
                            switch ($ispass){
                              case 0:
                                    echo "<th class='border_left_w'>当前阶段</th>
                                    <td><input type='text' name='current_stage' value='$temp' readOnly='readonly'/></td>";
                                    break;
                              case 1:
                                echo "<th class='border_left_w'>当前阶段</th>
                                <td><input type='text' name='current_stage' value='$temp' readOnly='readonly'/></td>";
                                break;
                              case 2:
                                echo "<th class='border_left_w'>当前阶段</th>
                                <td><input type='text' name='current_stage' value='审核不通过' readOnly='readonly'/></td>";
                                break;
                            }
                        } */
                    ?>
                     </tr>
                <tr>
                    <th width="125" >主管科室</th>
                    <td width="300" align="center" style="background-color:#EAF3FA">
                        <input type="text" id="department"  name="department" readonly="readonly"/>
                    </td>
                     <th width="125" class="border_left_w">主管工程师</th>
                   <td width="300" align="center"><input type="text" id="project_engineer" name="project_engineer" readonly="readonly" value = '<?php echo $project_engineer;?>'/></td>   
                </tr>
                <tr>
                <th width="125" class="border_left_w">承担单位</th>
                    <td width="300" align="center"><input type="text" id="undertake_id" name="undertake_id" readonly="readonly"/></td>
               
                    <th width="125">所属领域</th>
                    <td width="300" align="center"><input type="text" id="tech_area" name="tech_area" readonly="readonly"/></td>
               </tr>
            </table>
        </div>
    </div>
    <div class="table_title">
        <div class="title_pic">项目管理</div>
    </div>
    <div id="div4" class="table_content">
        <table border="0" cellpadding="0" cellspacing="0"  class="basic_info">
            <tr>
                <th width="300px">填写事项</th>
                <th width="200px">最后一次办理时间</th>
                <th>当前状态</th>
                <th>审核时间</th>
                <th>管理</th>
            </tr>
            <?php
            global $global_table_status;
            $db = new DB ();
            $project_id = $_SESSION ['project_id'];
            $sql_project = "Select * from project_info where project_id='$project_id'";
            $project = $db->SelectObject($sql_project);
            $project_stage = $project->project_stage;
            $project_type = $project->project_type;
            $sql_type = "select * from project_type where name = $project_type";
            /*
             * 2015-11-25 增加了 open=1，用来显示当前已经打开的表单列表
             */
            $sql = "Select * from table_status where project_id = '$project_id' and project_stage <= '$project_stage' and open = 1 order by project_stage asc";
            //echo $sql;exit;
            //加入判断
            /* if($project_stage == 1){
                $is_check = $project->is_check;
                if($is_check==0){
                    $sql = "Select * from table_status where project_id='$project_id' and project_stage <= '($project_stage-1)' and open = 1 order by project_stage asc";;
                } 
            } */
            $result = $db->SelectOri($sql);
            $row_n = mysql_num_rows($result);
            for ($i = 1; $i <= $row_n; $i++) {
                echo "<tr>";
                $row = mysql_fetch_object($result);
                $table_id = $row->table_name;
               
                $sql_table = $db->GetInfo($table_id,'table_type');
                echo "<td>" . $sql_table['name'] . "</td>";
                $last_modify = date('Y/m/d', $row->last_modify);
                echo "<td><center>" . $last_modify . "</center></td>";
                // 这个之后可以通过计算当前填完的表格来判断当前的状态

                $table_status_n = $global_table_status[$row->table_status]['status'];
                if(($project_stage==0 && $row->table_status ==4) /* || ($project_stage == 1 && $project->is_check == 0) */){
                    $table_status_n = '审核中';
                }
                //echo $table_status_n;exit;
                echo '<td height=30> <center>'.$table_status_n.'</center></td>';
                if ($row->approval_time != null && $project_stage!=0) {
                    $timestamp = date('Y/m/d', $row->approval_time);
                    echo "<td><center>$timestamp</center></td>";
                } else {
                    echo "<td></td>";
                }
				$flag=0;
                $url = $sql_table['url']."?table_id=". $table_id;
                echo "<td><a href=" . $url.">";
                
                $str = $sql_table['pdf_url'];
                
                    if ($row->table_status == 1) {
                        echo "<center><strong>填写</strong></center></a></td>";
                    }else if($row->table_status == 2 && $project_stage == 0){
                        echo '<center><strong>查看</strong></a> | <a href="#" onclick= "printWord(' . "'" . $str . "'" ."," .$row->table_status.",".$project_type.')"><strong>打 印（无水印）</strong></a></center></td>';
                    }else if ($row->table_status == 4) {
//                         echo "<center><strong>查 看</strong></a> | <a href='$str'><strong>打 印</strong></a></center> </td>";

                        //david  2015.1.06
                    /* if($project_stage == 1 && $project->is_check == 0){
                        echo '<center><strong>查 看</strong></a>';
                    }else */ //if($project_stage != 0){
                     //   echo '<center><strong>查 看</strong></a> | <a href="#" onclick= "printWord(' . "'" . $str . "'" . ')"><strong>打 印</strong></a></center></td>';
                        echo '<center><strong>查 看</strong></a> | <a href="#" onclick= "printWord(' . "'" . $str . "'" .",".$row->table_status.",".$project_type.')"><strong>打 印（带水印）</strong></a></center></td>';
                    /* }else{
                       echo '<center><strong>查 看</strong></a>';
                     } */
                   } 
                    else if ($row->table_status == 3) {
                        echo "<strong><center>修改</center></strong></a></td>";
                    }
                    else {
                        echo "<strong><center>查看</center></strong></a></td>";
                    }
                    echo "</tr>";
                   }
            ?>
        </table>
    </div>

</form>

</body>
</html>
