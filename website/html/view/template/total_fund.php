<?php
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
session_start();
$db = new DB ();
$table = TableData::get($_SESSION['project_id'], 18);
$tableData = isset($table['data']) ? $table['data'] : null;
?>
<!DOCTYPE html PUBLIC "-//W5C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w5.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w5.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>项目经费总决算表</title>
        <link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
        <link rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/icon.css" />
        <link rel="stylesheet" type="text/css" href="../css/table.css" />
        <link rel="stylesheet" type="text/css" href="../css/button.css" />
        <link rel="stylesheet" type="text/css" href="../css/total_fund.css" />
        
        <script type="text/javascript" src="../../../../common/html/js/datecommon.js"></script>
        
        <script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
        <script src="../../../../common/html/js/tablecommon.js"></script>
        <script type="text/javascript" src="../../../../common/html/js/validation.js"></script>
        <script type="text/javascript" src="../../view/js/total_funds.js"></script>

        <style type="text/css">
          
        </style>
    </head>
    <body>
        <div class="wt_box">

            <div>
                <form method="post" id="total_funds">
                    <div class="project_content">
                        <div class="table_title clearfix">
                            <div class="title_pic left">经费总决算表填写</div>
                            <div class="right back_pic" id="back"></div>
                        </div>
                        <div class="table_content back-long">
                            <table cellspacing="0" cellpadding="0" class="basic_info">
                                <tr>
                                    <td colspan=10 style="background-color: #7AB5ED; height: 20px;">
                                        <div class="title_top p-b10">项目经费总决算表</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="5">项目经费来源：</th>
                                    <th colspan="5">单位：万元</th>
                                </tr>
                                <tr>
                                    <th colspan="5">来 源</th>
                                    <th>任务书预算经费</th>
                                    <th>核减经费</th>
                                    <th colspan="2">实际到位经费</th>
                                </tr>

                                <tr>
                                    <th colspan="5">
                                        <center>区财政科技经费</center>
                                    </th>
                                    <td><input type="text" name="bgt_fund[0]" datatype="float" value="<?php echo 0 + $tableData['year_total'][0]; ?>" readonly="readonly" /></td>
                                    <td><input type="text" name="reduce_fund[0]" datatype="float" /></td>
                                    <td colspan="2"><input type="text" name="actual_fund[0]"
                                                           datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th colspan="5">
                                        <center>项目承担单位自筹经费</center>
                                    </th>
                                    <td><input type="text" name="bgt_fund[1]" datatype="float"  value="<?php echo 0 + $tableData['year_total'][1]; ?>" readonly="readonly"  /></td>
                                    <td><input type="text" name="reduce_fund[1]" datatype="float" /></td>
                                    <td colspan="2"><input type="text" name="actual_fund[1]"
                                                           datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th colspan="5">其 他</th>
                                    <td><input type="text" name="bgt_fund[2]" datatype="float" value="<?php echo 0 + $tableData['year_total'][2]; ?>"  readonly="readonly"  /></td>
                                    <td><input type="text" name="reduce_fund[2]" datatype="float" /></td>
                                    <td colspan="2"><input type="text" name="actual_fund[2]"
                                                           datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th colspan="5">合 计</th>
                                    <td><input type="text" name="bgt_fund_total" datatype="float"  value="<?php echo 0 + $tableData['total_total']; ?>" readonly="readonly"   /></td>
                                    <td><input type="text" name="reduce_fund_total" datatype="float" /></td>
                                    <td colspan="2"><input type="text" name="actual_fund_total"
                                                           datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th colspan="5">项目经费支出：</th>
                                    <th colspan="5">单位：万元</th>
                                </tr>
                                <tr>
                                    <th colspan="9">项目经费支出预算：</th>
                                </tr>
                                <tr>
                                    <th colspan="4">科 目</th>
                                    <th>经费来源</th>
                                    <th>任务书预算经费</th>
                                    <th>核减经费</th>
                                    <th>调整经费</th>
                                    <th>实际支出经费</th>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">设备费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[0]"
                                               datatype="float"  readonly="readonly" value="<?php echo $tableData['teach1_fund'][0] + $tableData['teach2_fund'][0] + $tableData['teach3_fund'][0] ?>" /></td>
                                    <td><input type="text" name="teach_reduce_fund[0]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[0]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_actual_fund[0]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[0]"
                                               datatype="float"  readonly="readonly" value="<?php echo $tableData['other1_fund'][0] + $tableData['other2_fund'][0] + $tableData['other3_fund'][0] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[0]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[0]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[0]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">材料费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[1]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][1] + $tableData['teach2_fund'][1] + $tableData['teach3_fund'][1] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[1]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[1]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_actual_fund[1]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[1]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['other1_fund'][1] + $tableData['other2_fund'][1] + $tableData['other3_fund'][1] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[1]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[1]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[1]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">测试化验加工费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[2]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][2] + $tableData['teach2_fund'][2] + $tableData['teach3_fund'][2] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[2]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[2]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_actual_fund[2]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[2]"
                                               datatype="float"  readonly="readonly"  value="<?php echo $tableData['other1_fund'][2] + $tableData['other2_fund'][2] + $tableData['other3_fund'][2] ?>" /></td>
                                    <td><input type="text" name="other_reduce_fund[2]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[2]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[2]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">燃料动力费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[3]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][3] + $tableData['teach2_fund'][3] + $tableData['teach3_fund'][3] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[3]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[3]"
                                               datatype="float"  readonly="readonly" /></td>
                                    <td><input type="text" name="teach_actual_fund[3]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[3]"
                                               datatype="float"  readonly="readonly" value="<?php echo $tableData['other1_fund'][3] + $tableData['other2_fund'][3] + $tableData['other3_fund'][3] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[3]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[3]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[3]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">国际合作与交流费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[4]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][4] + $tableData['teach2_fund'][4] + $tableData['teach3_fund'][4] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[4]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[4]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_actual_fund[4]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[4]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['other1_fund'][4] + $tableData['other2_fund'][4] + $tableData['other3_fund'][4] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[4]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[4]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[4]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">差旅费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[5]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][5] + $tableData['teach2_fund'][5] + $tableData['teach3_fund'][5] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[5]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[5]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_actual_fund[5]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[5]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['other1_fund'][5] + $tableData['other2_fund'][5] + $tableData['other3_fund'][5] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[5]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[5]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[5]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">会议费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[6]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][6] + $tableData['teach2_fund'][6] + $tableData['teach3_fund'][6] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[6]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[6]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_actual_fund[6]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[6]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['other1_fund'][6] + $tableData['other2_fund'][6] + $tableData['other3_fund'][6] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[6]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[6]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[6]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">档案出版、文献信息传播、知识产权事务费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[7]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][7] + $tableData['teach2_fund'][7] + $tableData['teach3_fund'][7] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[7]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[7]"
                                               datatype="float"  readonly="readonly" /></td>
                                    <td><input type="text" name="teach_actual_fund[7]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[7]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['other1_fund'][7] + $tableData['other2_fund'][7] + $tableData['other3_fund'][7] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[7]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[7]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[7]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">劳务费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[8]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][8] + $tableData['teach2_fund'][8] + $tableData['teach3_fund'][8] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[8]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[8]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_actual_fund[8]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[8]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['other1_fund'][8] + $tableData['other2_fund'][8] + $tableData['other3_fund'][8] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[8]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[8]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[8]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">专家咨询费</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[9]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][9] + $tableData['teach2_fund'][9] + $tableData['teach3_fund'][9] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[9]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[9]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_actual_fund[9]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[9]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['other1_fund'][9] + $tableData['other2_fund'][9] + $tableData['other3_fund'][9] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[9]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[9]"
                                               datatype="float"  readonly="readonly" /></td>
                                    <td><input type="text" name="other_actual_fund[9]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" colspan="4">其他费用</th>
                                    <th>区财政科技经费</th>
                                    <td><input type="text" name="teach_budget_fund[10]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['teach1_fund'][10] + $tableData['teach2_fund'][10] + $tableData['teach3_fund'][10] ?>"  /></td>
                                    <td><input type="text" name="teach_reduce_fund[10]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="teach_adjust_fund[10]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_actual_fund[10]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th>其他来源</th>
                                    <td><input type="text" name="other_budget_fund[10]"
                                               datatype="float" readonly="readonly"  value="<?php echo $tableData['other1_fund'][10] + $tableData['other2_fund'][10] + $tableData['other3_fund'][10] ?>"  /></td>
                                    <td><input type="text" name="other_reduce_fund[10]"
                                               datatype="float" /></td>
                                    <td><input type="text" name="other_adjust_fund[10]"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="other_actual_fund[10]"
                                               datatype="float" /></td>
                                </tr>
                                <tr>
                                    <th colspan="5"><strong>合 计</strong></th>
                                    <td><input type="text" name="all_fund_tech_total"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="teach_reduce_fund_total"
                                               datatype="float" readonly="readonly"  /></td>
                                    <td><input type="text" name="adjust_fund_total" datatype="float"  readonly="readonly" /></td>
                                    <td><input type="text" name="teach_actual_fund_total"
                                               datatype="float"  readonly="readonly" /></td>
                                </tr>
                                <tr>
                                    <th colspan="4">区财政科技经费总合计</th>
                                    <td><input type="text" name="fund_tech_total" datatype="float" readonly="readonly"  /></td>
                                    <th colspan="3">其他来源总合计:</th>
                                    <td><input type="text" name="fund_other_total" datatype="float" readonly="readonly"  /></td>
                                </tr>

                                <tr>
                                    <th colspan="9">仪器设备购置费用明细：（单价在5万元以上，含5万元）</th>
                                </tr>


                                <tr>
                                    <td colspan="9">
                                        <table width="100%" cellspacing="0" style="margin-bottom: 0;"
                                               id="addtable">
                                            <tr>
                                                <th>名 称</th>
                                                <th>型号</th>
                                                <th>任务计划金额（单价）</th>
                                                <th>实际购买数量</th>
                                                <th>实际支付金额（单价）</th>
                                                <th>资金来源</th>
                                                <th>购买时间</th>
                                                <th>主要用途</th>
                                                <th>操作</th>
                                            </tr>
                                            <?php
                                            $project_id = $_SESSION ['project_id'];
                                            $tableData = TableData::get($project_id, 1954);
                                            //var_dump($tableData);
                                            $tableData = $tableData['data'];
                                            if (!empty($tableData) && !empty($tableData['eqpt_name'])) {
                                                $i = 0;
                                                foreach ($tableData['eqpt_name'] as $key => $value) {
                                                    echo "<tr>";
                                                    echo "<td width='110'><input type='text'  name='eqpt_name[$i]' value='{$tableData['eqpt_name'][$key]}'/></td>";
                                                    echo "<td width='267'><input type='text'  name='eqpt_model[$i]' value='{$tableData['eqpt_model'][$key]}'/></td>";
                                                    echo "<td width='267'><input type='text' datatype='float' name='plan_money[$i]' value='{$tableData['plan_money'][$key]}'/></td>";
                                                    echo "<td width='267'><input type='text' datatype='number' name='actual_num[$i]' value='{$tableData['actual_num'][$key]}'/></td>";
                                                    echo "<td width='267'><input type='text' datatype='float' name='actual_pay[$i]' value='{$tableData['actual_pay'][$key]}'/></td>";
                                                    echo "<td width='267'><input type='text' name='fund_src[$i]' value='{$tableData['fund_src'][$key]}'/></td>";
                                                    echo "<td width='267'><input id='buy_time'  class='dateplu' type='text'  name='buy_time[$i]' value='{$tableData['buy_time'][$key]}' readonly/></td>";
                                                    echo "<td width='267'><input  type='text'  name='main_use[$i]' value='{$tableData['main_use'][$key]}'/></td>";
                                                    echo "<td width='267'><input type='button' value='删除' class='pointer'  onclick='delLine(this)'/></td>";
                                                    echo "</tr>";
                                                    $i++;
                                                }
                                            } else {
                                                echo "<tr>";
                                                echo "<td width='110'><input  type='text' name='eqpt_name[0]'/></td>";
                                                echo "<td width='267'><input  type='text'name='eqpt_model[0]'/></td>";
                                                echo "<td width='267'><input  type='text' datatype='float' name='plan_money[0]'/></td>";
                                                echo "<td width='267'><input  type='text' datatype='number' name='actual_num[0]'/></td>";
                                                echo "<td width='267'><input  type='text' datatype='float' name='actual_pay[0]'/></td>";
                                                echo "<td width='267'><input  type='text' name='fund_src[0]'/></td>";
                                                echo "<td width='267'><input id='buy_time' type='text'  datatype='date' class='dateplu' name='buy_time[0]' readonly/></td>";
                                                echo "<td width='267'><input  type='text'name='main_use[0]'/></td>";
                                                echo "<td width='267' ><input type='button' value='删除' class='pointer but'  onclick='delLine(this)'/></td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="9" height="25"><input type="button" class='pointer'  value="添加"
                                                                       onclick="addLine()" /></th>
                                </tr>
                            </table>
                            <div class="button_wrapper clearfix">
                                <!--                         <div class="submit" >提交</div> -->
                                <div class="save">保存</div>
                                <!-- <div class="reset" >重置</div> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </body>
</html>
