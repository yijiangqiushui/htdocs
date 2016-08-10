<?php
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
?>
<!DOCTYPE html PUBLIC "-//W5C//DTD XHTML 1.0 Transitional//EN""http://www.w5.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w5.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


        <title>无标题文档</title>
        <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
        <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css"/>
        <link rel="stylesheet" type="text/css" href="../../../css/table.css"/>
        <link rel="stylesheet" type="text/css" href="../../../css/button.css"/>
        <link rel="stylesheet" href="../../../../../../common/html/lib/css/datapicker/daterangepicker.css" />
        <script type="text/javascript" src='../../../../../../common/html/js/datecommon.js'></script>
<!--        <script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>-->
        <script src="../../../../../../common/html/plugin/datapicker/moment.min.js"></script>


        <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.cookie.js" ></script>
        <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

        <script src="../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/validation.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/tablecommon.js"></script>
        <script type="text/javascript" src="../../../../../../website/html/view/js/projectapp/project_money.js"></script>

    </head>
    <style>
        input{
            float: none;
        }
      
    </style>
    <body>
        <div class="project_content">
            <div class="table_title clearfix">
                <div class="title_pic left">项目实施方案填写</div>
                <div class="right back_pic" id="back"></div>
            </div>

            <div class="table_content back-long">
                <form method="post" id="project_money">
                    <div class="basic_info bg_blue">
                    <table cellspacing="0" cellpadding="0" class="basic_info" id="project_money">
                        <tr>
                            <td colspan="8">
                                <h2>
                                    <div class="title_top p-b10">项目经费预算</div>
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <th class="bt" colspan="4"><p align="center"> 1、项目经费来源：</p></th>
                            <th class="bt" colspan="4"><p align="center"> 单位：万元</p></th>
                        </tr>
                        <tr>
                            <th class="bt" colspan="4"><p align="center"> 来 源</p></th>
                            <td><input type="text"  name="year[0]" style="width: 80%; text-align:center;" readonly>年
                            </td>
                            <td><input type="text"  name="year[1]"  style="width: 80%; text-align:center;" readonly>年
                            </td>
                            <td><input type="text"  name="year[2]"  style="width: 80%; text-align:center;" readonly>年</td>
                            <th class="bt"><p align="center"> 合计</p></th>
                        </tr>

                        <tr>
                            <th class="bt" colspan="4"><p align="center"> 区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="total1_fund[0]"/></td>
                            <td><input type="text" datatype="float"
                                       name="total1_fund[1]"/></td>
                            <td><input type="text" datatype="float"
                                       name="total1_fund[2]"/></td>
                            <td><input type="text" 
                                       name="total1_fund[3]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt" colspan="4"><p align="center"> 项目承担单位自筹经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="total2_fund[0]"/></td>
                            <td><input type="text" datatype="float"
                                       name="total2_fund[1]"/></td>
                            <td><input type="text" datatype="float"
                                       name="total2_fund[2]"/></td>
                            <td><input type="text" name="total2_fund[3]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt" colspan="4"><p align="center"> 其 他</p></th>
                            <td><input type="text" datatype="float"
                                       name="total3_fund[0]"/></td>
                            <td><input type="text" datatype="float"
                                       name="total3_fund[1]"/></td>
                            <td><input type="text" datatype="float"
                                       name="total3_fund[2]"/></td>
                            <td><input type="text" name="total3_fund[3]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt" colspan="4"><p align="center"> 合 计</p></th>
                            <td><input type="text" datatype="float"
                                       name="year_total[0]" readonly/></td>
                            <td><input type="text" datatype="float"
                                       name="year_total[1]" readonly/></td>
                            <td><input type="text" datatype="float"
                                       name="year_total[2]" readonly/></td>
                            <td><input type="text" name="total_total" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt" colspan="4"><p align="center"> 2、项目经费支出：</p></th>
                            <th class="bt" colspan="4"><p align="center">
                                    单位：万元
                                </p></th>
                        </tr>
                        <tr>
                            <th class="bt" colspan="8"><p align="center"> （1）项目经费支出预算：</p></th>
                        </tr>
                        <tr>
                            <th class="bt" colspan="3"><p align="center"> 科 目</p></th>
                            <th class="bt"><p align="center"> 经费来源</p></th>
                            <td><input type="text" name="p_m_year[0]" datatype="number" readonly style="width: 80%; text-align:center;"/>年
                            </td>
                            <td><input type="text" name="p_m_year[1]" datatype="number" readonly style="width: 80%; text-align:center;"/>年
                            </td>
                            <td><input type="text" name="p_m_year[2]" datatype="number" readonly style="width: 80%; text-align:center;"/>年
                            </td>
                            <th class="bt"><p align="center"> 合计</p></th>
                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 设备费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float" name="teach1_fund[0]"/></td>
                            <td><input type="text" datatype="float" name="teach2_fund[0]"/></td>
                            <td><input type="text" datatype="float" name="teach3_fund[0]"/></td>
                            <td rowspan="2"><input type="text" datatype="float" name="teach_actual_fund[0]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>

                            <td><input type="text" datatype="float"
                                       name="other1_fund[0]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[0]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[0]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 材料费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[1]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach2_fund[1]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[1]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[1]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[1]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[1]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[1]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 测试化验加工费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[2]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach2_fund[2]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[2]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[2]" readonly/></td>

                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[2]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[2]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[2]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 燃料动力费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[3]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach2_fund[3]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[3]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[3]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[3]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[3]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[3]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 国际合作与交流费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[4]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach2_fund[4]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[4]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[4]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[4]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[4]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[4]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 差旅费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[5]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach2_fund[5]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[5]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[5]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[5]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[5]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[5]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 会议费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[6]"/></td>
                            <td><input type="text" datatype="nufloatmber"
                                       name="teach2_fund[6]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[6]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[6]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[6]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[6]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[6]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 档案出版、文献信息传播、知识产权事务费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[7]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach2_fund[7]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[7]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[7]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[7]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[7]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[7]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 劳务费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[8]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach2_fund[8]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[8]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[8]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[8]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[8]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[8]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 专家咨询费</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[9]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach2_fund[9]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[9]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[9]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[9]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[9]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[9]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" rowspan="2" colspan="3"><p align="center"> 其他费用</p></th>
                            <th class="bt"><p align="center">区财政科技经费</p></th>
                            <td><input type="text" datatype="float"
                                       name="teach1_fund[10]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach2_fund[10]"/></td>
                            <td><input type="text" datatype="float"
                                       name="teach3_fund[10]"/></td>
                            <td rowspan="2"><input
                                    type="text" datatype="float" name="teach_actual_fund[10]" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt"><p align="center">其他来源</p></th>
                            <td><input type="text" datatype="float"
                                       name="other1_fund[10]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other2_fund[10]"/></td>
                            <td><input type="text" datatype="float"
                                       name="other3_fund[10]"/></td>

                        </tr>
                        <tr>
                            <th class="bt" colspan="4"><p align="center"><strong>合 计</strong></p></th>
                            <td><input type="text" datatype="float"
                                       name="total1" readonly/></td>
                            <td><input type="text" datatype="float"
                                       name="total2" readonly/></td>
                            <td><input type="text" datatype="float"
                                       name="total3" readonly/></td>
                            <td><input type="text" datatype="float"
                                       name="total4" readonly/></td>
                        </tr>
                        <tr>
                            <th class="bt" colspan="3"><p align="center">区财政科技经费总合计</p></th>
                            <td><input type="text" datatype="float"
                                       name="total5" readonly/></td>
                            <th class="bt" colspan="3"><p align="center">其他来源总合计</p></th>
                            <td><input type="text" datatype="float"
                                       name="total_other" readonly/></td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" style="margin-bottom: 0;" id="addtable">
                        <thead>
                        <tr>
                            <th class="bt" colspan="9"><p align="center"> （2）仪器设备购置费用明细：（单价在5万元以上，含5万元）</p></th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            <th class="bt"><p align="center"> 名 称</p></th>
                            <th class="bt"><p align="center"> 型号</p></th>
                            <th class="bt"><p align="center"> 任务计划金额（单价）</p></th><!--这一个th在云协作上是没有的。2016-1-5 by mc-->
                            <th class="bt"><p align="center"> 实际购买数量</p></th>
                            <th class="bt"><p align="center"> 实际支付金额（单价）</p></th>
                            <th class="bt"><p align="center"> 资金来源</p></th>
                            <th class="bt"><p align="center"> 购买时间</p></th>
                            <th class="bt"><p align="center"> 主要用途</p></th>
                            <th class="bt"><p align="center"> 操作</p></th>
                        </tr>
                                    <?php
                                    $project_id = $_SESSION ['project_id'];
                                    $tableData = TableData::get($project_id, 17);
                                    $tableData = $tableData['data'];

                                    if (!empty($tableData) && !empty($tableData['eqpt_name'])) {
                                        $i = 0;
                                        foreach ($tableData['eqpt_name'] as $key => $value) {
                                            echo "<tr>";
                                            echo "<td><input type='text' name='eqpt_name[$i]' value='{$tableData['eqpt_name'][$key]}' /></td>";
                                            echo "<td><input type='text' name='eqpt_model[$i]' value='{$tableData['eqpt_model'][$key]}'/></td>";
                                            echo "<td><input type='text' name='plan_money[$i]' value='{$tableData['plan_money'][$key]}' datatype='float' /></td>";
                                            echo "<td><input type='text' name='actual_num[$i]' value='{$tableData['actual_num'][$key]}' datatype='number' /></td>";
                                            echo "<td><input type='text' name='actual_pay[$i]' value='{$tableData['actual_pay'][$key]}' datatype='float' /></td>";
                                            echo "<td><input type='text' name='fund_src[$i]' value='{$tableData['fund_src'][$key]}'/></td>";
                                            echo "<td><input type='text' name='buy_time[$i]' class='dateplu' value='{$tableData['buy_time'][$key]}' id='buy_time[0]'  readonly/></td>";
                                            echo "<td><input type='text' name='main_use[$i]' value='{$tableData['main_use'][$key]}'/></td>";
                                            echo "<td><input type='button' value='删除'  class='pointer but' onclick='delLine(this)'/></td>";
                                            echo "</tr>";
                                            ++$i;
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td width='110'><input type='text' name='eqpt_name[0]'/></td>";
                                        echo "<td width='267'><input type='text'name='eqpt_model[0]'/></td>";
                                        echo "<td width='267'><input type='text'name='plan_money[0]' datatype='float' /></td>";
                                        echo "<td width='267'><input type='text'name='actual_num[0]' datatype='number'/></td>";
                                        echo "<td width='267'><input type='text'name='actual_pay[0]' datatype='float' /></td>";
                                        echo "<td width='267'><input type='text'name='fund_src[0]'/></td>";
                                        echo "<td width='267'><input type='text'name='buy_time[0]' class='dateplu'  id='buy_time[0]'  readonly/></td>";
                                        echo "<td width='267'><input type='text'name='main_use[0]'/></td>";
                                        echo "<td width='267' ><input type='button' value='删除' class='pointer but'  onclick='delLine(this)'/></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                        </tbody>
                    </table>
                    <table width="100%" border="0" cellspacing="0"
                           style="margin-bottom: 0;">
                        <tr>
                            <th>
                                <input type="button" name="Submit" style="height: 30px; background: #7AB5ED; color: #ffffff; font-size: 12px;float: none" value="添加" class='pointer' onclick="addLine();">
                           </th>
                        </tr>
                        <tr>
                            <th class="bt" colspan="8"><p align="left"> （3）项目研究所需的配套条件及来源（与项目研究相关的其他仪器设备等共享性资源、承担单位的保障措施，包括承诺的研发队伍、资金、研发设备和场地、项目管理等支撑条件。要充分考虑经济、技术等方面的可行性。）
                                    </p></th>
                        </tr>
                        <tr>
                            <td colspan="8">
                                <div class="text_wrap">
                                    <textarea id="project_content" name="project_match" class="text_content"></textarea>
                                </div>
                            </td>
                        </tr>

                    </table>
                    <div class="button_wrapper clearfix">
                        <!--                 <div class="submit" >提交</div> -->
                        <div class="save">保存</div>
                        <!-- <div class="reset" >重置</div> -->
                    </div>
                    </div>
                </form>
            </div>
            <script type="application/javascript">
                // 日期自动填充
                $(function() {
                    $year = $("input[name^='year[']");
                    $p_m_year = $("input[name^='p_m_year[']");
                    $("input[name='year[0]'], input[name='p_m_year[0]']").change(function() {
                        var that = this;
                        $year.each(function(i) {
                            this.value = wt_add(that.value, i);
                        });
                        $p_m_year.each(function(i) {
                            this.value = wt_add(that.value, i);
                        });
                    });
                });

                $(function() {
                // 上半部分计算
                $total1_fund = $("input[name^='total1_fund[']");
                $total2_fund = $("input[name^='total2_fund[']");
                $total3_fund = $("input[name^='total3_fund[']");

                // 先设置为空
                $total1_fund.val('0');
                $total2_fund.val('0');
                $total3_fund.val('0');

                $year_total = $("input[name^='year_total[']");

                $("input[name^='total1_fund['], input[name^='total2_fund['], input[name^='total3_fund[']").change(function() {
                var total = 0;
                $year_total.each(function(i) {
                this.value = wt_add($total1_fund[i].value, $total2_fund[i].value, $total3_fund[i].value);
                total = wt_add(total, this.value);
                });
                $total1_fund[3].value = wt_add($total1_fund[0].value, $total1_fund[1].value, $total1_fund[2].value);
                $total2_fund[3].value = wt_add($total2_fund[0].value, $total2_fund[1].value, $total2_fund[2].value);
                $total3_fund[3].value = wt_add($total3_fund[0].value, $total3_fund[1].value, $total3_fund[2].value);

                $("input[name='total_total").val(total);
                });

                // 下面部分计算
                $teach1_fund = $("input[name^='teach1_fund[']");
                $teach2_fund = $("input[name^='teach2_fund[']");
                $teach3_fund = $("input[name^='teach3_fund[']");

                $other1_fund = $("input[name^='other1_fund[']");
                $other2_fund = $("input[name^='other2_fund[']");
                $other3_fund = $("input[name^='other3_fund[']");

                // 先设置为空
                $teach1_fund.val('0');
                $teach2_fund.val('0');
                $teach3_fund.val('0');
                $other1_fund.val('0');
                $other2_fund.val('0');
                $other3_fund.val('0');

                $teach_actual_fund = $("input[name^='teach_actual_fund[']");

                // 设置为空
                $teach_actual_fund.val('0');
                $("input[name*='total']").val('0');

                $teach1_fund.change(do_change);
                $teach2_fund.change(do_change);
                $teach3_fund.change(do_change);
                $other1_fund.change(do_change);
                $other2_fund.change(do_change);
                $other3_fund.change(do_change);

                function do_change() {
                $teach_actual_fund.each(function(i) {
                    var temp = wt_add($teach1_fund[i].value,
                        $teach2_fund[i].value,
                        $teach3_fund[i].value,
                        $other1_fund[i].value,
                        $other2_fund[i].value,
                        $other3_fund[i].value);
                    this.value = temp;
                });

                var total1 = 0,
                total2 = 0,
                total3 = 0,
                total4 = 0,
                total5 = 0,
                total_other = 0;

                $teach1_fund.each(function(i) {
                total1 = wt_add(total1, $teach1_fund[i].value, $other1_fund[i].value);
                total2 = wt_add(total2, $teach2_fund[i].value, $other2_fund[i].value);
                total3 = wt_add(total3, $teach3_fund[i].value, $other3_fund[i].value);
                total4 = wt_add(total1, total2, total3);
                total5 = wt_add(total5, $teach1_fund[i].value, $teach2_fund[i].value, $teach3_fund[i].value);
                total_other = wt_add(total_other, $other1_fund[i].value, $other2_fund[i].value, $other3_fund[i].value);
                });

                $("input[name='total1']").val(total1);
                $("input[name='total2']").val(total2);
                $("input[name='total3']").val(total3);
                $("input[name='total4']").val(total4);
                $("input[name='total5']").val(total5);
                $("input[name='total_other']").val(total_other);
                }

                });

            </script>
    </body>
</html>


