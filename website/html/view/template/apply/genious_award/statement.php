<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>

        <link rel="stylesheet" type="text/css"
              href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
        <link rel="stylesheet" type="text/css"
              href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
        <link rel="stylesheet" type="text/css" href="../../../css/table.css" />
        <link rel="stylesheet" type="text/css" href="../../../css/button.css" />

        <script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
        <script
        src="../../../../../../common/html/plugin/datapicker/moment.min.js"></script>

        <script type="text/javascript"
        src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript"
        src="../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
        <script type="text/javascript"
        src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
        <script type="text/javascript"
        src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
                  <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/tablecommon.js"></script>
        <script type="text/javascript" src="../../../js/apply/genious_award/statement.js"></script>


    </head>

    <body>
        <form id="statement" method="post">
            <div class="project_content">
                <div class="table_title clearfix">
                    <div class="title_pic left">人才奖励申报推荐表</div>
                    <div class="right back_pic" id="back"></div>
                </div>
                <div class="table_content back-long">
                    <div class="basic_info bg_blue">

                        <p class="title_top p-b10">填表声明</p>

                        <div class="text_wrap">
                            <textarea name="statement" id="" class="text_content"
                                      placeholder="&nbsp;&nbsp;&nbsp;&nbsp;我单位保证上述填报内容及所提供的资料真实性，如有不实，我单位承担由此引起的一切责任。"></textarea>
                        </div>
                        <input type="hidden" name="save_display" id="save_display" />
                        <div class="button_wrapper clearfix d-n">
                            <div class="save">保存</div>
                            <!-- 						<!-- <div class="reset" >重置</div> --> 
                        </div>
                    </div>
                </div>
            </div>

        </form>


    </body>
</html>
