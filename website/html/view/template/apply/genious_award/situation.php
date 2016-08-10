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
        <script type="text/javascript"
        src="../../../js/projectapp/situation.js"></script>

    </head>

    <body>
        <form id="situation" method="post">
            <div class="project_content">
                <div class="table_title clearfix">
                    <div class="title_pic left">人才奖励申报推荐表</div>
                    <div class="right back_pic" id="back"></div>
                </div>
                <div class="table_content back-long">
                    <div class="basic_info bg_blue">

                        <div class="title_top p-b10">申报科技创新人才奖励项目情况阐述</div>
          <p class="subtitle">（符合资助、奖励的对象与条件（六）至（九）条之一者填写，符合多个条件，按承担项目分别填写）</p>
                        <div class="text_wrap">
                            <textarea name="situation" id="" class="text_content"placeholder="项目名称：
下达部门：
担任角色：
起止时间：
获奖情况：（全称）
项目完成人情况：按贡献大小顺序，分别填写序号、姓名、性别、身份证号码、职称（职务）、专业、单位、在本项目中分担任务等。
项目简介：项目所属科学技术领域、主要研究内容及解决的主要技术问题、特点、技术创新点、对科学技术进步的推动作用、推广应用及经济和社会效益情况等。
                            "></textarea>
                        </div>
                        <!-- 	<tr>
                                <th width='70px'><p align="center">项目名称：</p></th>
                                <td><input name="project_name" /></td>

                        </tr>
                        <tr>
                                <th><p align="center">下达部门：</p></th>
                                <td><input name="bottom_dep" /></td>

                        </tr>
                        <tr>
                                <th><p align="center">担任角色：</p></th>
                                <td><input name="" /></td>

                        </tr>
                        <tr>
                                <th><p align="center">起止时间：</p></th>
                                <td><input name="" /></td>

                        </tr>
                        <tr>
                                <th><p align="center">获奖情况：</p></th>
                                <td><input name="" placeholder="（全称）" /></td>

                        </tr>


                        <tr>
                                <th><p align="center">项目完成人情况：</p></th>
                                <td width='70px'><textarea class="" name=""
                                                placeholder="按贡献大小顺序，分别填写序号、姓名、性别、身份证号码、职称（职务）、专业、单位、在本项目中分担任务等。"></textarea></td>
                        </tr>
                        <tr>
                                <th><p align="center">项目简介：</p></th>
                                <td><textarea class="" name=""
                                                placeholder="项目所属科学技术领域、主要研究内容及解决的主要技术问题、特点、技术创新点、对科学技术进步的推动作用、推广应用及经济和社会效益情况等。"></textarea></td>
                        </tr> -->








                        <input type="hidden" name="save_display" id="save_display" />
                        <div class="button_wrapper clearfix d-n">
                            <div class="save">保存</div>
                            <!-- <div class="reset" >重置</div> -->
                        </div>
                    </div>
                </div>
            </div>

        </form>


    </body>
</html>
