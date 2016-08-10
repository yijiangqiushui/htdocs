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

        <script src="../../../../../../../common/html/js/datecommon.js"></script>
        
        <script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
        <script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
        <script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

                <script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
        <script type="text/javascript" src="../../../../js/apply/attach3_patent/org_info.js"></script>
        <script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>
    </head>
    <body>
        <form method="post" id="org_info" >
            <div class="project_content">
                <div class="table_title clearfix">
                    <div class="title_pic left">专利实施项目申报书</div>
                    <div class="right back_pic" id="back"></div>
                </div>
                <div class="table_content back-long">
                    <table cellspacing="0" cellpadding="0" class="basic_info">
                        <tr>
                            <td colspan="8" class="border_left_none" style="background-color:#7AB5ED;">
                                <div class="title_top p-b10">企业基本情况</div>
                            </td>
                        </tr>

                        <tr>
                            <th ><p align="center">企业名称</p></th>
                            <td colspan="4"><input name="org_name" title="只读信息，若有误请联系管理员修改" readonly/></td>
                            <th width=""><p align="center">注册时间</p></th>
                            <td colspan="2"><input name="register_time"  class="dateplu" readonly></input></td>
                        </tr>

                        <tr>
                            <th ><p align="center">通讯地址</p></th>
                            <td colspan="4"><input name="contact_address" type="text" title="只读信息，若有误请联系管理员修改" readonly /></td>
                            <th  width=""><p align="center">邮编</p></th>
                            <td colspan="2"><input name="postal" type="text" datatype="postcode"  placeholder='邮编格式：101100（6位数字）' /></td>
                        </tr>

                        <tr>
                            <th ><p align="center">E-mail</p></th>
                            <td colspan="7"><input type="text" name="email" datatype="email"  placeholder='邮箱格式：xxxxxxxxx@xx.com' /></td>

                        </tr>

                        <tr>
                            <th rowspan="2"><p align="center">企业法定代表人情况</p></th>
                            <th ><p align="center">姓名</p></th>
                            <th ><p align="center">性别</p></th>
                            <th ><p align="center" >出生年月</p></th>
                            <th ><p align="center" >最高学历</p></th>
                            <th ><p align="center">任现职时间</p></th>
                            <th colspan="2"><p align="center">电话</p></th>
                        </tr>

                        <tr>
                            <td><input name="legal_name"  type="text"  readonly/></td>
                            <td ><select name="legal_sex" style="width:100%;height:100%" >
                                    <option value="男"  selected="selected">男</option>
                                    <option value="女">女</option>
                                </select>
                            </td>
<!--                             <td ><input name="legal_birth" id="birth"  class = "dateplu" readonly></input></td> -->
                            <td>
								<select  class='year'  name='legal_year'>
								</select>
								<select class='month'  name='legal_month'>
								</select>
							</td>
                            <td ><select name="legal_edu" style="width:100%;height:100%">
                                    <option value='小学'  selected="selected">小学</option>
                                    <option value='初中'>初中</option>
                                    <option value='高中'>高中</option>
                                    <option value='中专'>中专</option>
                                    <option value='大专'>大专</option>
                                    <option value='本科'>本科</option>
                                    <option value='研究生'>研究生</option>
                                    <option value='其他'>其他</option>
                                </select>
                            </td>
                            <td ><input name="legal_time" id="employ"  class = "dateplu" readonly></input></td>
                            <td colspan="2"><input name="legal_phone" type="text"  datatype="phandtel"  readonly/></td>
                        </tr>

                        <tr>
                            <th ><p align="center">联系人</p></th>
                            <td><input type="text" name="linkman" /></td>
                            <th><p align="center">电话（手机）</p></th>
                            <td colspan="2"><input type="text" name="linkman_contact" datatype="phandtel" /></td>
                            <th ><p align="center">传真</p></th>
                            <td colspan="2"><input type="text" name="fax" datatype="fax" placeholder="正确格式：010-22541457"  /></td>
                        </tr>

                        <tr>
                            <th><p align="center">开户银行</p></th>
                            <td ><input type="text" name="org_bank"/></td>
                            <th ><p align="center">账号</p></th>
                            <td colspan="2"><input type="text" name="account" datatype="number" placeholder="请输入数字"/></td>
                            <th><p align="center">信用等级</p></th>
                            <td colspan="2"><input type="text" name="credit_rate"/></td>
                        </tr>
                        <tr>
                            <th>注册登记类型</th>
                        	<td colspan='6'>
                        		<select  style='height:100%;width:190px;; float:left;' name='org_type'>
                        			<option value="国有企业" selected="selected">国有企业</option>
                        			<option value="集体企业">集体企业</option>
                        			<option value="股份合作企业">股份合作企业</option>
                        			<option value="联营企业">联营企业</option>
                        			<option value="有限责任公司">有限责任公司</option>
                        			<option value="股份有限公司">股份有限公司</option>
                        			<option value="私营企业">私营企业</option>
                        			<option value="港、澳、台商投资企业">港、澳、台商投资企业</option>
                        			<option value="外商投资企业">外商投资企业</option>
                        			<option value="其他企业">其他企业</option>
                        		</select>
                        	</td>
                        </tr>
                        <tr>
                        	<th>企业特征</th>
                        	<td ><input type='checkbox' style='width: 20px; ' name='checkbox0' value='1'/><p style="margin: 10px;" >高新技术企业</p></td>
                        	<td ><input type='checkbox' style='width: 20px; ' name='checkbox1' value='2'/><p style="margin: 10px;" >大专院校办的企业</p></td>
                        	<td ><input type='checkbox' style='width: 20px;' name='checkbox2' value='3'/><p style="margin: 10px;">科研院所办的企业</p></td>
                        	<td ><input type='checkbox' style='width: 20px;' name='checkbox3' value='4'/><p style="margin: 10px;">留学人员办的企业</p></td>
                        	<td ><input type='checkbox' style='width: 20px;' name='checkbox4' value='5'/><p style="margin: 10px;">科研院所整体专制企业</p></td>
                        	<td ><input type='checkbox' style='width: 20px;' name='checkbox5' value='6'/><p style="margin: 10px;">其他</p></td>
                        </tr>

<!--  	<tr>
        <th ><p align="center">注册登记类型</p></th>
        <td ><input type="text" name=""/></td>
        <td  colspan="6">
        1.国有企业                 2.集体企业   
3.股份合作企业             4.联营企业      
5.有限责任公司             6.股份有限公司
7.私营企业                 8.港、澳、台商投资企业  
9.外商投资企业             10.其他企业
        </td>
</tr>

<tr>
        <th rowspan=""><p align="center">企业特征</p></th>
        <td rowspan=""><input type="text" name=""/></td>
        <td rowspan="" colspan="6">
    1.高新技术企业      2.大专院校办的企业                                     
    3.科研院所办的企业         4.留学人员办的企业
    5.科研院所整体转制企业     6.其他
        </td>
</tr>
                        -->
                        <tr>
                            <th ><p align="center">行业</p></th>
                            <td><input type="text" name="org_trade"/></td>
                            <th ><p align="center">注册资金</p></th>
                            <td colspan="2"><input type="text" name="register_fund" datatype="float" placeholder="请输入整数或小数"/></td>
                            <th ><p align="center">其中外资比例</p></th>
                            <td colspan="2">
                               <!-- <input
                                    type="text" class="calratio"  datatype="float" style="width: 20%; height: 100%"
                                    name="associate_ratio" readonly="readonly"  /><p style='margin-top:-25px; margin-left:100px;'>%</p>-->
                                <input type="text"   name="local_foreign" style="width: 80%; height: 100%;float: left" datatype="float" placeholder="请输入百分比数字，小数点后不超过两位"/><p style='margin-top:10px; margin-left:100px;'>%</p></td>
                        </tr>



                        <tr>
                            <th ><p align="center">职工总数</p></th>
                            <td><input type="text" name="staff_num" datatype="number"  placeholder="请输入整数"/></td>
                            <th ><p align="center">其中大专以上人员</p></th>
                            <td colspan="2"><input type="text" name="junior" datatype="number" placeholder="请输入整数"/></td>
                            <th ><p align="center">其中研究开发人员</p></th>
                            <td colspan="2"><input type="text" name="researcher_num" datatype="number" placeholder="请输入整数"/></td>
                        </tr>



                        <tr>
                            <th colspan="2"><p align="center">企业专利情况</p></th>
                            <th ><p align="center">已获专利授权数</p></th>
                            <td colspan="2"><input type="text" name="patent_num" datatype="number" placeholder="请输入整数"/></td>
                            <th ><p align="center">其中发明专利项</p></th>
                            <td colspan="2"><input type="text" name="invent_patent" datatype="number" placeholder="请输入整数"/></td>
                        </tr>


                        <tr>
                            <th colspan="2"><p align="center">上年度企业总收（万元）</p></th>
                            <td><input type="text"  name="lasthalf_profit" datatype="float" placeholder="请输入整数或小数"/></td>
                            <th colspan="3"><p align="center">上年度企业净利润（万元）</p></th>
                            <td colspan="2"><input type="text" name="lasthalf_tax" datatype="float" placeholder="请输入整数或小数"/></td>

                        </tr>

                        <tr>
                            <th colspan="2"><p align="center">上年度工业总产值（万元）</p></th>
                            <td><input type="text"  name="last_totalincome" datatype="float" placeholder="请输入整数或小数"/></td>
                            <th colspan="3"><p align="center">上年度企业交税总额（万元）</p></th>
                            <td colspan="2"><input type="text" name="last_industrytax" datatype="float" placeholder="请输入整数或小数"/></td>

                        </tr>

                        <tr>
                            <th colspan="2"><p align="center">上年度工业增加值（万元）</p></th>
                            <td><input type="text"  name="last_industryadd" datatype="float" placeholder="请输入整数或小数"/></td>
                            <th colspan="3"><p align="center">上年度企业创汇总额（万元）</p></th>
                            <td colspan="2"><input type="text" name="last_industrycreative" datatype="float" placeholder="请输入整数或小数"/></td>

                        </tr>
                        <tr>
                            <th colspan="2"><p align="center">上年度产品销售总 额（万元）</p></th>
                            <td><input type="text"  name="last_productsale" datatype="float" placeholder="请输入整数或小数"/></td>
                            <th colspan="3"><p align="center">上年度企业技术开发经费支出额（万元）</p></th>
                            <td colspan="2"><input type="text" name="last_techexpend" datatype="float" placeholder="请输入整数或小数"/></td>
                        </tr>
                    </table>
                    <table cellspacing="0" cellpading="0" border="0" id="tbl">
                        <tr>
                            <th colspan="6"><p align="center">主要产品名称</p></th>
                            <th colspan="2"><p align="center">占企业销售收入总额比例(%)</p></th>
                            <th>操作</th>
                        </tr>
                        <?php
                        $org_code = $_SESSION['org_code'];
                        $db = new DB();
                        $sql = "SELECT * FROM main_product WHERE org_code = '$org_code'";
                        $res = $db->SelectOri($sql);
                        $table_row = array();
                        if($res != false){
                        	$table_row = mysql_num_rows ( $res );
                        }
                        if ($table_row) {
                            for ($i = 0; $i < $table_row; $i++) {
                            	$result = mysql_fetch_object($res);
//                             	var_dump($result);
                                echo "<tr>";
                                echo "<td colspan=\"6\"><input type=\"text\" name='main_product[$i]' value=\"$result->main_product\"/></td>";
                                echo "<td colspan=\"2\"><input type=\"text\" name='sale_ratio[$i]' value=\"$result->sale_ratio\" datatype='float' placeholder=\"请输入百分比数字，小数点后不超过两位\"/></td>";
                                echo "<td><input type='button' class=\"pointer but\" value='删除' onclick='delRow(this)';/></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan=\"6\"><input type=\"text\" name='main_product[0]' value=\"$res->main_product\"/></td>";
                            echo "<td colspan=\"2\"><input type=\"text\" name='sale_ratio[0]' datatype=\"float\" value=\"$res->sale_ratio\" placeholder=\"请输入整数或小数\"/></td>";
                            echo "<td><input type='button' class=\"pointer but\" value='删除' onclick='delRow(this)';/></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                    <div>
                        <input type="button" class="pointer" name="Submit"style="width:100%; height: 30px; background: #7AB5ED; color: #ffffff; font-size: 12px;float: none" value="添加" onclick="AddSignRow();" />
                    </div>
                    <div class="button_wrapper clearfix">
                        <div class="save" style="left: auto">保存</div>
                        <!-- <div class="reset" >重置</div> -->
                    </div> 
                </div>
            </div>
        </form>
    </body>
</html>
