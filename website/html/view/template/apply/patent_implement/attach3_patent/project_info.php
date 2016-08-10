<?php
include '../../../../../../../common/php/config.ini.php';
include '../../../../../../../common/php/lib/db.cls.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>申报单位基本情况</title>
        <link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css"></link>
        <link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/icon.css" />
        <link rel="stylesheet" type="text/css" href="../../../../css/table.css"/>
        <link rel="stylesheet" type="text/css" href="../../../../css/button.css" />
        <link rel="stylesheet" type="text/css" href="../../../../css/date_common.css" />
        
        <script src="../../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
        <script src="../../../../../../../common/html/js/datecommon.js"></script>
        
<!--         <script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.min.js"></script> -->
        <script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
        <script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
        <script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
        <script type="text/javascript" src="../../../../js/apply/attach3_patent/project_info.js"></script>
        <script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>
        <style>
            textarea {
				width:97.5%;
			}
        </style>
    </head>
    <body>
        <form method="post" id="project_info">
            <div class="project_content">
                <div class="table_title clearfix">
                    <div class="title_pic left">专利实施项目申报书</div>
                    <div class="right back_pic" id="back"></div>
                </div>
                <div class="table_content back-long">
                    <table cellspacing="0" cellpadding="0" class="basic_info">
                        <tr>
                            <td colspan="8" class="border_left_none" style="background-color:#7AB5ED;">
                                <div class="title_top p-b10">二、项目基本情况</div>
                            </td>
                        </tr>

                        <tr>
                            <th ><p align="center">项目名称</p></th>
                            <td colspan="3"><input name="project_name"  /></td>
                            <th width=""><p align="center">计划完成时间</p></th>
                            <td colspan="3"><input name="planfinish_time" class = "dateplu" readonly></td>
                        </tr>

                        <tr>
                            <th ><p align="center">项目负责人</p></th>
                            <td ><input name="leader_name" type="text" /></td>
                            <th ><p align="center">性别</p></th>
                            <td><select name="leader_sex" class="leader_sex" >
                                    <option value='男' selected>男</option>
                                    <option value='女'>女</option>
                                </select>
                            </td>
                            <th ><p align="center">出生年月</p></th>
<!--                             <td ><input name="leader_birth"  class="dateplu" readonly></td> -->
                            <td>
								<select  class='year'  name='leader_year'>
								</select>
								<select class='month'  name='leader_month'>
								</select>
							</td>
                            <th>最高学历</th>
                            <th ><select name="leader_edu" id = 'leader_edu'>
                                    <option value='小学'  selected="selected">小学</option>
                                    <option value='初中'>初中</option>
                                    <option value='高中'>高中</option>
                                    <option value='中专'>中专</option>
                                    <option value='大专'>大专</option>
                                    <option value='本科'>本科</option>
                                    <option value='研究生'>研究生</option>
                                    <option value='其他'>其他</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>技术领域</th>
                            <td>
                                  <select id="tech_area" name="tech_area" style="width: 100%; height: 100%;">
                        <option value=""></option>
                        <option value="电子信息">电子信息</option>
                        <option value="生物医药">生物医药</option>
                        <option value="新材料">新材料</option>
                        <option value="先进制造与自动化">先进制造与自动化</option>
                        <option value="能源与节能">能源与节能</option>
                        <option value="环境保护">环境保护</option>
                        <option value="农业">农业</option>
                        <option value="社会事业">社会事业</option>
                        <option value="其他" id="areaother" >其他</option>
                    </select>
       <input id="tech_area_other" name="" style="width: 40%; background: #FFF;display: none;" /> 
                            </td>
                            <th>技术水平</th>
                            <td>
                                <select name="tech_level">
                                    <option value='国际领先水平' selected="selected">国际领先水平</option>
                                    <option value='国际先进水平'>国际先进水平</option>
                                    <option value='国内领先水平'>国内领先水平</option>
                                    <option value='国内先进水平'>国内先进水平</option>
                                </select>
                            </td>
                            <th>项目阶段</th>
                            <td>
                                <select name="project_step">
                                    <option value="研发阶段" selected="selected">研发阶段</option>
                                    <option value="中试阶段">中试阶段</option>
                                    <option value="批量（规模）生产">批量（规模）生产</option>
                                </select>
                            </td>
                            <td colspan='2'>
                            </td>
                        </tr>
                        <tr>
                            <th>项目主要优势</th>
                            <td valign="top"><input type='checkbox' name="checkbox0" style='width:20px;'  value='1'/><p style="margin: 10px; width:150px;">1.市场发展前景好</p></td>
                            <td  valign="top"><input type='checkbox' name="checkbox1" style='width:20px;' value='2'/><p style="margin: 10px;">2.产品或工艺创新突出</p></td>
                            <td  valign="top"><input type='checkbox' name="checkbox2" style='width:20px;' value='3'/><p style="margin: 10px;">3.经济效益显著</p></td>
                            <td  valign="top"><input type='checkbox' name="checkbox3" style='width:20px;' value='4'/><p style="margin: 10px;">4.社会效益显著</p></td>
                            <td  valign="top"><input type='checkbox' name="checkbox4" style='width:20px;'  value='5'/><p style="margin: 10px; width:70px;">5.其他</p></td>
                            <td colspan='2'></td>
                        </tr>

                        <tr>
                            <th rowspan="3"><p align="center">项目专利情况</p></th>
                            <th rowspan="3"><p align="center">已获专利授权</p></th>
                            <td rowspan="3" colspan="3"><input type="text" name="patent_num" readonly="readonly" datatype='number' placeholder="已获专利授权为后三项之和，自动计算" style='width: 80%;'/><p style='float:left; margin-top:5px;'>项</p></td>
                            <th ><p align="center">发明</p></th>
                            <td colspan="2"><input type="text" name="invent_num" datatype='number'  class='change' placeholder="请输入整数" style='width: 80%;'/><p style='float:left; margin-top:5px;'>项</p></td>
                        </tr>
                        <tr>
                            <th ><p align="center">实用新型</p></th>
                            <td colspan="2"><input type="text" name="function_patent" datatype='number' class='change'  placeholder="请输入整数" style='width: 80%;'/><p style='float:left; margin-top:5px;'>项</p></td>
                        </tr>

                        <tr>
                            <th ><p align="center">外观设计</p></th>
                            <td colspan="2"><input type="text" name="patent_design" datatype='number' class='change' placeholder="请输入整数" style='width: 80%;'/><p style='float:left; margin-top:5px;'>项</p></td>
                        </tr>

                        <tr>
                            <th><p align="center">专利名称</p></th>
                            <td colspan="9">
                                <table id="addtable">
                                    <?php
                                    $project_id = $_SESSION['project_id'];
                                    $sql = "SELECT * FROM patent_list WHERE project_id = '$project_id' ";
                                    $db = new DB();
                                    $result = $db->SelectOri($sql);
									$tableRow = array();
									if($result != false){
										$tableRow = mysql_num_rows ( $result );
									}
                                    if ($tableRow) {
                                        for ($i = 0; $i < $tableRow; $i ++) {
                                            $row = mysql_fetch_object($result);
                                            echo "<tr>";
                                            echo "<td  colspan=\"2\"><input type=\"text\" name=\"patent_name[$i]\" value='$row->patent_name'/></td>";
                                            echo "<th><p align=\"center\">专利号</p></th>";
                                            echo "<td  colspan=\"2\"><input type=\"text\" name=\"patent_code[$i]\" value='$row->patent_code'/></td>";
                                            echo "<td  colspan=\"2\"><input type='button' class='pointer but' value='删除' onclick='delRow(this)'/></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td  colspan=\"2\"><input type=\"text\" name=\"patent_name[0] value='$result->patent_name'\"/></td>";
                                        echo "<th><p align=\"center\">专利号</p></th>";
                                        echo "<td  colspan=\"2\"><input type=\"text\" name=\"patent_code[0]\" value='$result->patent_code'/></td>";
                                        echo "<td  colspan=\"2\"><input type='button'  class='pointer but' value='删除' onclick='delRow(this)'/></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            </td>


                        </tr>

                        <tr>
                            <td colspan="9" height="25"><input type="button" class='pointer' value="添加" style="background-color: #7AB5ED; color: #ffffff; font-size: 12px" onclick="addLine()" /></td>
                        </tr>





                        <tr>
                            <th ><p align="center">项目简介</p></th>
                            <td  colspan="7" class="special-row">
                                <textarea style="padding:10px;" name="coproject_summary"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <th rowspan="4"><p align="center">项目上一年度指标</p></th>
                            <th colspan="2"><p align="center">就业人数</p></th>
                            <td colspan="2"><input type="text" name="lemploy_num" datatype='number' value="0"  placeholder="请输入整数"/></td>
                            <th ><p align="center">年净利润（万元）</p></th>
                            <td colspan="2"><input type="text" name="lyear_profit"  datatype="float"  value='0'  placeholder="请输入整数或小数" /></td>
                        </tr>

                        <tr>
                            <th colspan="2"><p align="center">年工业总产值（万元）</p></th>
                            <td colspan="2"><input type="text" name="lindustry_num" datatype="float"   value='0' placeholder="请输入整数或小数" /></td>
                            <th ><p align="center">年缴税总额（万元）</p></th>
                            <td colspan="2"><input type="text" name="ltax_sum" datatype="float"  value='0'  placeholder="请输入整数或小数" /></td>
                        </tr>

                        <tr>
                            <th colspan="2"><p align="center">年工业增加值（万元）</p></th>
                            <td colspan="2"><input type="text" name="lindustry_add" datatype="float"  value='0'  placeholder="请输入整数或小数" /></td>
                            <th ><p align="center">年创汇（万美元）</p></th>
                            <td colspan="2"><input type="text" name="lforeign_tax" datatype="float"   value='0' placeholder="请输入整数或小数" /></td>
                        </tr>

                        <tr>
                            <th colspan="2"><p align="center">年产品销售额（万元）</p></th>
                            <td colspan="2"><input type="text" name="lsell_sum" datatype="float" value='0'   placeholder="请输入整数或小数" /></td>
                            <th ><p align="center">市场占有率（%）</p></th>
                            <td colspan="2"><input type="text" name="lmarket_share" datatype="float"  value='0'  placeholder="请输入整数或小数" /></td>
                        </tr>

                        <tr>
                            <th rowspan="4"><p align="center">项目计划完成时年付指标</p></th>
                            <th colspan="2"><p align="center">就业人数</p></th>
                            <td colspan="2"><input type="text" name="employ_num1" datatype='number' value="0"  placeholder="请输入整数"/></td>
                            <th ><p align="center">年净利润（万元）</p></th>
                            <td colspan="2"><input type="text" name="year_profit1" datatype="float"  value='0'  placeholder="请输入整数或小数" /></td>
                        </tr>


                        <tr>
                            <th colspan="2"><p align="center">年工业总产值（万元）</p></th>
                            <td colspan="2"><input type="text" name="industry_num1" datatype="float"  value='0'  placeholder="请输入整数或小数" /></td>
                            <th ><p align="center">年缴税总额（万元）</p></th>
                            <td colspan="2"><input type="text" name="tax_sum1" datatype="float" value='0'   placeholder="请输入整数或小数" /></td>
                        </tr>

                        <tr>
                            <th colspan="2"><p align="center">年工业增加值（万元）</p></th>
                            <td colspan="2"><input type="text" name="industry_add1" datatype="float"  value='0'  placeholder="请输入整数或小数" /></td>
                            <th ><p align="center">年创汇（万美元）</p></th>
                            <td colspan="2"><input type="text" name="foreign_tax1" datatype="float" value='0'   placeholder="请输入整数或小数" /></td>
                        </tr>
                        <tr>
                            <th colspan="2"><p align="center">年产品销售额（万元）</p></th>
                            <td colspan="2"><input type="text" name="sell_sum1" datatype="float" value='0'   placeholder="请输入整数或小数" /></td>
                            <th ><p align="center">市场占有率（%）</p></th>
                            <td colspan="2"><input type="text" name="market_share1" datatype="float"  value='0'  placeholder="请输入整数或小数" /></td>
                        </tr>

                    </table>
                    <div class="button_wrapper clearfix">
                        <div class="save">保存</div>
                        <!-- <div class="reset" >重置</div> -->
                    </div> 
                </div>
            </div>
        </form>
        <script type="application/javascript">
    $(function() {
        $('#tech_area').change(function() {
            $v = $(this).val();
            if ($v == '其他') {
                $('#tech_area_other').show();
                $('#tech_area_other').attr('name', 'tech_area');
                $(this).attr('name', '');

              var obj = document.getElementById('tech_area');
                 var oobj = document.getElementById('tech_area_other');
                 obj.style.width = '65px';
//                  obj.val=oobj.val;
            } else {
                $('#tech_area_other').hide();
                $(this).attr('name', 'tech_area');
                $('#tech_area_other').attr('name', '');
                var obj = document.getElementById('tech_area');
                var oobj = document.getElementById('tech_area_other');
                obj.style.width = '100%';
            }
        })


        $invent_num = $("input[name='invent_num']");
        $function_patent = $("input[name='function_patent']");
        $patent_design = $("input[name='patent_design']");

        $patent_num = $("input[name='patent_num']");

        $invent_num.bind('input propertychange', count1);
        $function_patent.bind('input propertychange', count1);
        $patent_design.bind('input propertychange', count1);

        function count1() {
            $patent_num.val(wt_add($invent_num.val(), $function_patent.val(), $patent_design.val()));
        }
    });
</script>
    </body>
</html>
