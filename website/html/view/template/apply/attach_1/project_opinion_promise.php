<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>无标题文档</title>
        <link rel="stylesheet" type="text/css"
              href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
        <link rel="stylesheet" type="text/css"
              href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
        <script type="text/javascript"
        src="../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
        <script type="text/javascript"
        src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript"
        src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
        <script type="text/javascript"
        src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
        <script type="text/javascript"
        src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/tablecommon.js"></script>
        <script type="text/javascript" src="../../../js/projectapp/project_opin_promise.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../css/table.css" />
        <link rel="stylesheet" type="text/css" href="../../../css/button.css" />
        <link rel="stylesheet" type="text/css" href="../../../css/style.css" />

    </head>

    <body>
        <form id="project_opin_promise" method="post">
            <div class="project_content">
                <div class="table_title clearfix">
                    <div class="title_pic left">项目实施方案填写</div>
                    <div class="right back_pic" id="back"></div>
                </div>
                <div class="table_content back-long">
                    <table cellspacing="0" cellpadding="0" class="basic_info">
                        <tr>
                            <td style="background-color:#7AB5ED;height:20px;"colspan="2">
                                <p class="title_top p-b10">项目各年度任务目标、考核指标及研究开发内容完成的计划进度</p>
                            </td>
                        </tr>

                        <tr style="background-color:#D1E4F3 ">
                            <th><p align="center">1、项目负责人意见：</p></th>
                            <td>
                                <textarea id="leader_opinion" name="leader_opinion" style="margin-bottom : 10px;margin-top: 10px;width: 80%" class="opinion_text"></textarea>
                            </td>
                        </tr>

                        <tr style="background-color:#D1E4F3 ">
                            <th style="width:200px"><p align="center">2、项目承担单位意见：</p></th>
                            <td><textarea id="org_opinion" name="org_opinion"  style="margin-bottom : 10px;margin-top: 10px;width: 80%"   class="opinion_text"></textarea></td>
                        </tr>

                    </table>
                    <input type="hidden" name="save_display" id="save_display"/>
                    <div class="button_wrapper clearfix d-n" >
                        <div class="save" >保存</div>
                        <!-- <div class="reset" >重置</div> -->
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>
