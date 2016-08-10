<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>无标题文档</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../../../../common/html/plugin/easyui/themes/icon.css"/>
    <script type="text/javascript"
            src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
    <script type="text/javascript"
            src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript"
            src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <script type="text/javascript"
            src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
    <script type="text/javascript"
            src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
    <script type="text/javascript" src="../../js/projectapp/plan_parties.js"></script>
            <script type="text/javascript" src="../../../../../common/html/js/validation.js"></script>
    
    <link rel="stylesheet" type="text/css" href="../../css/table.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/button.css"/>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        p {
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        table input {
            height: 100%;
            width: 100%;
            border: 0;
            font-size: 16px;
            background-color: transparent;
        }
        table td {
            line-height: 30px;
            text-align: center;
        }
    </style>
</head>

<body>

<form id="plan_parties" method="post">
     <div class="project_content">
        <div class="table_title clearfix">
            <div class="title_pic left">项目任务书填写</div>
            <div class="right back_pic" id="back"></div>
        </div>
        
        <div class="table_content back-long">
            <table cellspacing="0" cellpadding="0" class="basic_info">
                <tr>
                    <td style="background-color:#7AB5ED;height:50px;" colspan="7">
                        <div style="line-height:32px;color:#FFF002;font-weight: bold;  font-size:18px;">任务书各方</div>
                    </td>
                </tr>
                <tr>

                      <th class="bt" rowspan="12"><p align="center">项目承担单位</p></th>
                   <th class="bt"  ><p align="center">单位名称 </p></th>
                    <td colspan="3" ><input type="text" name="org_name" readonly/></td>
                </tr>
                <tr>
                     <th class="bt"  ><p align="center">法人代表</p></th>
                    <td ><input type="text" readonly="readonly" name="legal_code" /></td>
                    <th class="bt" colspan="0"  ><p align="center">邮 编 </p></th>
                    <td ><input type="text" name="postal"  datatype="postcode"  /></td>
                </tr>
          
                <tr>
                    <th class="bt"  ><p align="center">联 系 人</p> </th>
                    <td colspan="3" ><input type="text" name="linkman"  /></td>
                </tr>
                <tr>
                    <th class="bt"  ><p align="center">通讯地址</p> </th>
                    <td colspan="3" ><input type="text" name="contact_address" readonly /></td>
                </tr>
                <tr>
                   <th class="bt"  ><p align="center">电  话</p></th>
                    <td ><input type="text" name="phone"    /></td>
                   <th class="bt" colspan="0" ><p align="center">传 真 </p></th>
                    <td ><input type="text" name="fax"  datatype="fax" /></td>
                </tr>
                <tr>
                   <th class="bt"  ><p align="center">电子信箱 </p></th>
                    <td colspan="4" ><input type="text" name="email"  /></td>
                </tr>
                <tr>
                    <th class="bt"  ><p align="center">户 名 </p></th>
                    <td colspan="4" ><input type="text" name="username"  /></td>
                </tr>
                <tr>
                    <th class="bt"  ><p align="center">开户银行 </p></th>
                    <td colspan="4" ><input type="text" name="org_bank" /></td>
                </tr>
                <tr>
                     <th class="bt"  ><p align="center">帐 号 </p></th>
                    <td colspan="4" >
                      <input type="text" name="account" datatype="number" placeholder="正确格式为：12345678"/>
                    </td>
                </tr>
            </table>
             <div class="button_wrapper clearfix">
               <!--  <div class="submit" >提交</div> -->
                <div class="save" >保存</div>
                <!-- <div class="reset" >重置</div> -->
            </div>
        </div>
    </div>
</form>


</body>
</html>
