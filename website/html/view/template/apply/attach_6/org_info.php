<?php
session_start();
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>无标题文档</title>

    <link rel="stylesheet" type="text/css"
          href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/table.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/button.css"/>

    <script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
    <script src="../../../../../../common/html/js/datecommon.js"></script>

    <script type="text/javascript"
            src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
    <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/validation.js"></script>
    <script src="../../../../../../common/html/js/tablecommon.js"></script>
    <script type="text/javascript" src="../../../js/apply/6org_info.js" charset="utf-8"></script>
    <style>
        input {
            height: 100%;
            width: 100%;
            font-size: 14px;
            background-color: transparent;
            border-color: #fff;
        }

        tr:nth-child(odd) {
            background-color: #D1E4F3;
        }

        tr:nth-child(even) {
            background-color: #EAF3FA;
        }

        td {
            text-align: center;
            line-height: 30px;
            height: 30px;
        }

        tr {
            text-align: center;
            line-height: 30px;

        }

        th {
            font-weight: normal;
            color: #fff;
            font-size: 1.0em;
            background-color: #7AB5ED;
            line-height: 30px;
        }

        p {
            padding: 0;
            margin: 2px 0;
        }

        body {
            text-align: center;
            margin: auto 0;
        }
    </style>

</head>
<body>
<form id="6org_info_fm" method="post">
    <div class="project_content">
        <div class="table_title clearfix">
            <div class="title_pic left">项目申报表</div>
            <div class="right back_pic" id="back"></div>
        </div>
        <div class="table_content back-long">
            <table cellspacing="0" cellpadding="0" class="basic_info">
                <tr>
                    <td colspan="7" class="border_left_none" style="background-color:#7AB5ED;width:1365px;">
                        <div class="title_top p-b10">通州区技术合同登记奖励资金申报表</div>
                    </td>
                </tr>
                <tr>
                    <th width="100px"><p align="center">单位名称</p></th>
                    <td colspan="6"><input name="app_com_name" readonly="readonly"/></td>
                </tr>
                <tr>
                    <th width="100px"><p align="center">注册地址</p></th>
                    <td colspan="2"><input name="com_reg_add"/></td>
                    <th ><p align="center">注册资金（万）</p></th>
                    <td colspan="3"><input name="app_com_fund" id="test"
                                           datatype="float"/></td>
                </tr>
                <tr>
                    <th width="100px"><p align="center">ͨ通讯地址</p></th>
                    <td colspan="2"><input name="com_com_add" readonly="readonly"/></td>
                    <th ><p align="center">邮政编码</p></th>
                    <td colspan="3"><input name="app_com_post" datatype="postcode"/></td>
                </tr>
                <tr>
                    <th width="100px" rowspan="2"><p align="center">法定代表人</p></th>
                    <th colspan="1"><p align="center">姓名</p></th>
                    <th colspan="2"><p align="center">身份证号码</p></th>
                    <th colspan="3"><p align="center">联系电话（手机/座机）</p></th>
                </tr>
                <tr>
                    <td colspan="1" style='min-width: 50px;'><input name="com_legal_name"  readonly/></td>
                    <td colspan="2" style='min-width: 200px;'><input name="com_legal_ID" datatype="idcard"/></td>
                    <td colspan="3" style='min-width: 200px;'><input name="com_legao_tel" class="smallwid" datatype="phandtel" readonly/></td>
                </tr>
                <tr>
                    <th width="100px" rowspan="2"><p align="center">联系人</p></th>
                    <th colspan="1"><p align="center">姓名</p></th>
                    <th colspan="2"><p align="center">E-mail</p></th>
                    <th colspan="3"><p align="center">联系电话（手机/座机）</p></th>
                </tr>
                <tr>
                    <td colspan="1"><input name="com_contact_name"  /></td>
                    <td colspan="2"><input name="com_contact_email" datatype="email"/></td>
                    <td colspan="3"><input name="com_contact_tel" datatype="phandtel"  /></td>
                </tr>
                <tr>
                    <th width="100px"><p align="center">注册登记类型</p></th>
                    <td colspan="2"><input name="reg_type"/></td>
                    <th colspan="1"><p align="center">所属行业</p></th>
                    <td colspan="2"><input name="com_trade"/></td>
                </tr>
                <tr>
                    <th colspan="2"><p align="center">开户银行</p></th>
                    <th colspan="2"><p align="center">开户名称</p></th>
                    <th colspan="3"><p align="center">银行账号</p></th>
                </tr>
                <tr>
                    <td colspan="2"><input name="com_bank"/></td>
                    <td colspan="2"><input name="bank_name"/></td>
                    <td colspan="3"><input name="com_trade" datatype="number"/></td>
                </tr>
                <tr>
                    <th rowspan="3" width="100px"><p align="center">上年度登记技术合同情况</p></th>
                    <th width="350px"><p align="center">合同编号</p></th>
                    <th width="200px"><p align="center">项目名称</p></th>
                    <th width="200px"><p align="center">认定时间</p></th>
                    <th width="200px"><p align="center">合同金额(万元)</p></th>
                    <th colspan="2"><p align="center"></p></th>
                </tr>
                <tr>
                    <td colspan="6">
                        <table cellspacing="0" style="margin-bottom: 0;"
                               id="addtable">
                            <?php
                          
                            $org_code = $_SESSION ['org_code']; // 修改为session赋值,org_code应该有引号，相对应$_POST
                            $db = new db (); // 修改的地方

                            $sql = "select * from technical_contract where org_code = '$org_code'";
                            $result = $db->SelectOri($sql);
                            $tableRow = mysql_num_rows($result);

                            if ($tableRow) {
                                for ($i = 0; $i < $tableRow; $i++) {
                                    $row = mysql_fetch_object($result);
                                    echo "<tr>";
                                    echo "<td width='350px'><input type='text' name='contract_code[$i]' value='$row->contract_code'/></td>";
                                    echo "<td width='200px'><input type='text' name='project_name[$i]' value='$row->project_name'/></td>";
                                    echo "<td width='200px'><input class='dateplu'  name='affirm_time[$i]' value='$row->affirm_time' readonly/> </td>";
                                    /* echo "<td width='200px'><input type='text' name='affirm_time[$i]' value='$row->affirm_time'/></td>";  */
                                    echo "<td width='200px'><input type='text' name='contract_price[$i]' value='$row->contract_price' datatype='float'/></td>";
                                    echo "<td colspan='2'><input  type='button' value='删除' class='pointer but' onclick='delLine(this)'/></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td width='350px'><input  type='text' name='contract_code[0]' /></td>";
                                echo "<td width='200px'><input  type='text' name='project_name[0]'/></td>";
                                echo "<td width='200px'><input class='dateplu' name='affirm_time[0]' value='$row->affirm_time' readonly/> </td>";
                                /* echo "<td width='200px'><input  type='text' name='affirm_time[0]'/></td>"; */
                                echo "<td width='200px'><input  type='text' name='contract_price[0]' datatype='float''/></td>";
                                echo "<td colspan='2'><input  type='button' value='删除' class='pointer but' onclick='delLine(this)'/></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </td>
                </tr>

                <tr>
                    <th colspan="7" height="25"><input class='pointer' type="button" value="添加"
                                                       onclick="addLine()"/></th>
                    <!-- 没有字段-->
                </tr>


                <tr>
                    <th colspan="4"><p align="center">合同总额（万元）</p></th>
                    <td colspan="3"><input datatype="bignumber" name="contractMoney"/></td>
                </tr>
                <tr>
                    <th width="100px"><p align="center">本年度预计登记合同份数</p></th>
                    <td colspan="2"><input name="execpt_cont_num" datatype="number"/></td>
                    <th width="98"><p align="center">本年度预计登记技术合同总额</p></th>
                    <td colspan="3"><input name="execpt_cont_fund" datatype="float"/></td>
                </tr>
                <tr>
                    <th width="100px"><p align="center">上边年上缴税金（万元）</p></th>
                    <td colspan="6"><input name="first_tax" datatype="bignumber"/></td>
                </tr>
                <tr>
                    <th width="100px" rowspan="3"><p align="center">区科委主管科室意见</p></th>
                    <th ><p align="center">核定金额（万元）</p></th>
                    <td colspan="5"><input datatype="bignumber" name="check_fund"/></td>
                </tr>
                <tr>
                    <th ><p align="center">奖励等级</p></th>
                    <td colspan="5"><input name="reward_level"/></td>
                </tr>
                <tr>
                    <th ><p align="center">科长签字</p></th>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <th width="100px"><p align="center">区科委意见</p></th>
                    <td colspan="6"><input  name="sc_opinion"/></td>
                </tr>
            </table>


            <input type="hidden" name="save_display" id="save_display"/>

            <div class="button_wrapper clearfix d-n">
                <div class="save">保存</div>
                <!-- <div class="reset" >重置</div> -->
            </div>

        </div>
</form>
</body>
</html>
