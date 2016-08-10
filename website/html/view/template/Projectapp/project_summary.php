<?php
    //该项目的id。
    $id = $_GET ['id'];
    //该项目所要经历的阶段。
    $stage = $_GET ['stage'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>无标题文档</title>
    <link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
 <link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/table.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/button.css"/>
    
    <script src="../../../../../common/html/js/datecommon.js"></script>
    
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.cookie.js" ></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
    <script type="text/javascript" src="../../js/projectapp/project_summary.js"></script>
    <style>
        tr:nth-child(odd) {
            background-color: #D1E4F3;
        }

        tr:nth-child(even) {
            background-color: #EAF3FA;
        }

        td {
            text-align: left;
            padding-left: 5px;
        }

        th {
            height: 32px;
            fond-family: '黑体';
            color: #FFFFFF;
            font-size: 1.0em;
            background-color: #7AB5ED;
            border: solid 1px #ffffff;
        }

        body {
            text-align: center;
            margin: auto 0;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
        }
    </style>
</head>
<body>
<form id="project_summary" method="post">
    <div style="margin: 40px 20px 40px 20px; max-width: 900px">

        <table style="border-color:#D1E4F3" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td colspan="4" class="" style="background-color:#7AB5ED;height:35px;font-size:14px;"><div style="font-weight: bold; line-height:30px;color:#FFF002;text-align: center;">项目信息</div></td>
            </tr>
               
                
            <tr>
                <th>项目名称</th>
                <td width="" colspan="3" align="center" style="">
                    <input type="text" id="project_name" name="project_name" />
                </td>
            </tr>
            <tr>
                <th width="125">主管科室</th>
                <td align="center" colspan="3">
                    <input type="text" id="department" name="department" readonly />
                </td>
            </tr>
            <tr>
                <th>所属领域</th>
                <td width=280px>
                    <select id="tech_area" name="tech_area" style="width: 95%; height: 100%;">
                        <option value="电子信息">电子信息</option>
                        <option value="生物医药">生物医药</option>
                        <option value="新材料">新材料</option>
                        <option value="先进制造与自动化">先进制造与自动化</option>
                        <option value="能源与节能">能源与节能</option>
                        <option value="环境保护">环境保护</option>
                        <option value="农业">农业</option>
                        <option value="社会事业">社会事业</option>
                        <option value="其他">其他</option>
                    </select>&nbsp;&nbsp;
                    <input id="tech_area_other" name="" style="width: 150px; background: #FFF;display: none;float:right;" />
                </td>
                <th>承担单位</th>
                <td align="center" style="">
                    <input type="text"id="org_name" name="org_name" style="/*background-color: #D1E4F3*/" readonly />
                </td>
            </tr>
            <tr>
                <th>开始时间</th>
                <td align="center">
                    <input type="text" id="start_time" name="start_time" class='dateplu' readonly/></td>
                <th width="125">结束时间</th>
                <td width="300" align="center">
                    <input type="text" id="end_time" name="end_time"  class='dateplu' readonly/>
                </td>
            </tr>
            <tr>
                <th>项目类型</th>
                <td colspan="3">
                    <input type="text" name="project_type" id="project_type" readonly />
                </td>
            </tr>
        </table>
        <div class="wrapper"  style="cursor: pointer;margin: 20px 400px; width: 360px;" >
            <?php
//                echo "<div class='submit'  onclick='project_sum(" .$id . "," . "\"" . $stage . "\"" . ");'>保存</div></td>";

            //2016.01.07 david modify
            echo "<div class='savesum submit'  onclick='project_sum(" .$id . "," . "\"" . $stage . "\"" . ");'>保存</div></td>";
            ?>
          <!--  <div class="reset" style="margin-left: 100px;" onclick="cz();">重置</div> --> 
        </div>
    </div>
    <!-- ********************************************* -->
</form>

<script type="application/javascript">
    $(function() {
        $('#tech_area').change(function() {
            $v = $(this).val();
            if ($v == '其他') {
                $('#tech_area_other').show();
                $('#tech_area_other').attr('name', 'tech_area');
                $('#tech_area_other').css('width', '60%');
                $('#tech_area').css('width', '30%');
                $(this).attr('name', '');
            } else {
                $('#tech_area_other').hide();
                $(this).attr('name', 'tech_area');
                $('#tech_area_other').attr('name', '');
                $('#tech_area').css('width', '95%');
            }
        })
    });
</script>
</body>
</html>








