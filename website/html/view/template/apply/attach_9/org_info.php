<?php
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
        <link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css"/>
        <link rel="stylesheet" type="text/css" href="../../../css/table.css"/>
        <link rel="stylesheet" type="text/css" href="../../../css/button.css"/>
        <script type="text/javascript"  src="../../../../../../common/html/js/datecommon.js"></script> 
        <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/validation.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/tablecommon.js"></script>
        <script type="text/javascript" src="../../../js/apply/9org_info.js"></script>


     <style type="text/css">
         /*     td {
                height: 35px;
                text-align: left;
                cellpadding: 0px;
            } 

            body {
                font-family: "微软雅黑";
                margin: auto 0;
                font-size: 16px;
                margin: auto 0;
            }

            div {
                text-align: center;
                margin: auto 0;
                line-height: 100%;
            } */

            table {
                margin: 0 auto;
                font-size: 14px;
                width: 100%;
            }

            table td {
                text-align: left;
/*                 border: solid 2px #ffffff; */
            }

            table table {
                width: 100%;
            }

            input[type='text'] {
                height: 100%;
                width: 99.5%;
                border: 1px;
            }

            input[type='button'] {
                height: 100%;
                width: 99.5%;
                border: 1px;
            }

            .radio_input {
                width:15px;
                height:15px;	
                display:inline;
            }

            .other_input {
                width:250px !important;
                height:25px !important;	
                line-height:25px;
                border:none;
                border-bottom:1px solid #7AB5ED !important;
                padding-left:5px;
            }

            lable {
                line-height:20px;
            }


        </style>

    </head>

    <body>
        <form action="" method="post" id="9org_info_fm">
            <div class="project_content">
                <div class="table_title clearfix">
                    <div class="title_pic left">项目申请书填写</div>
                    <div class="right back_pic" id="back"></div>
                </div>

                <div class="table_content back-long">
                    <table cellspacing="0" style="width: 99%; height: 100%; border: solid 2px #ffffff;">
                        <tr>
                            <td colspan="4">
                                <h2>
                                    <div class="title_top p-b10" >基本信息</div>
                                </h2>						
                            </td>
                        </tr>
                        <tr>
                            <th  width="">单位名称</th>
                            <td colspan="3"><input type="text" style="width: 98%; height: 100%" name="org_name" readonly/></td>
                        </tr>
                        <tr>
                            <th  >是否通过认定</th>
                            	<td>
		                             <div style='width: 100%; float:left;'>
		                                <div style="width: 50px; margin-top:8px;      display:inline"><input type="radio"  style="margin-left:40px;"    class="radio_input ismake_radio ismake_radio_1" name="ismake" value="是" /><span style="float: left;">是</span></div>
		                                  <div style="width: 50px; margin-left:60px; margin-top:-12px;display:inline"><input style="margin-left:40px;"   type="radio" class="radio_input ismake_radio ismake_radio_2" name="ismake" value="否" /><span style="float: left;">否</span></div>			
									 	<!--<div style='width: 50px;'><input type="radio"  name="ismake" value="是" style='width: 15px;'/><p style='width: 20px; margin-left:20px;margin-top:20px;'>是</p></div>
		                                <div style='width: 50px;'><input type="radio"  name="ismake" value="否" style='width: 15px;' /><p style='width: 20px;'>否</p></div>-->	
									 </div>
								</td>
                            <th>认定机构名称</th>
                            <td ><input type="text" name="maked_name" class="maked_name"   placeholder="选择是，则可填写"/></td>
                        </tr>
                        <tr>
                            <th >单位类型</th>
                            <td colspan="1" style="padding:10px 0;">
                                <lable><input class="radio_input org_radio" name="org_type" type="radio" value="事业单位" />&nbsp;&nbsp;事业单位</lable><br/>
                                <lable><input class="radio_input org_radio" name="org_type" type="radio" value="国有资本控股的有限公司" />&nbsp;&nbsp;国有资本控股的有限公司</lable><br/>
                                <lable><input class="radio_input org_radio" name="org_type" type="radio" value="国有独资企业" />&nbsp;&nbsp;国有独资企业</lable><br/>
                                <lable><input class="radio_input org_radio" name="org_type" type="radio" value="民营资本为主的有限公司" />&nbsp;&nbsp;民营资本为主的有限公司</lable><br/>
                                <lable><input class="radio_input org_radio" id="other_in11" name="org_type" type="radio" value="其他" />&nbsp;&nbsp;其他(请注明)
                                    <input class="other_input"   id="other_in1" name="org_type" type="text" disabled style="float: right;margin-right:10%;"/></lable>			   
                            </td>
                              <td colspan="2" ></td>
                        </tr>
                        <tr>
                            <th >机构投资建设主体</th>
                            <!--没有字段-->
                            <td colspan="1" style="padding:10px 0;">
                                <lable><input class="radio_input invest_radio" name="investment" id="investment" type="radio" value="国有企业" />&nbsp;&nbsp;国有企业</lable><br/>
                                <lable ><input class="radio_input invest_radio" name="investment" type="radio" value="民营企业" />&nbsp;&nbsp;民营企业</lable><br/>
                                <lable ><input class="radio_input invest_radio" name="investment" type="radio" value="大学" />&nbsp;&nbsp;大学</lable><br/>
                                <lable ><input class="radio_input invest_radio" name="investment" type="radio" value="研究院所" />&nbsp;&nbsp;研究院所</lable><br/>
                                <lable ><input class="radio_input invest_radio" name="investment" type="radio" value="政府" />&nbsp;&nbsp;政府</lable><br/>
                                <lable ><input class="radio_input invest_radio" name="investment" type="radio" value="投资机构" />&nbsp;&nbsp;投资机构</lable><br/>
                                <lable ><input class="radio_input invest_radio" name="investment" type="radio" value="自然人" />&nbsp;&nbsp;自然人</lable><br/>
                                <lable ><input class="radio_input invest_radio" id="other_in22" name="investment" type="radio" value="其他" />&nbsp;&nbsp;其他(请注明)</lable>
                                <lable ><input class="other_input" id="other_in2" name="investment" type="text" disabled style="float: right;margin-right:10%;"/></lable>
                            </td>
                             <td colspan="2" ></td>
                        </tr>
                        <tr>
                            <th >机构服务类型</th>
                            <!--没有字段-->
                            <td colspan="1">
                                <lable><input class="radio_input service_radio" name="service_type" type="radio" value="综合型" />&nbsp;&nbsp;综合型</lable><br/>
                                <lable><input class="radio_input service_radio" id="other_in33" name="service_type" type="radio" value="专业型" />&nbsp;&nbsp;专业型：技术领域(请注明)
                                    <input class="other_input" id="other_in3" name="service_type" type="text"  style="float: left"    disabled/></lable>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>

                            <th  rowspan="3" width="20%">投资主体</th>
                            <!--没有字段-->
                            <th width="32%" colspan="">股东名称</th>
                            <!--没有字段-->
                            <th width="32%">股权比例(%)</th>
                            <!--没有字段-->
                            <th width="20%">操作</th>
                            <!--没有字段-->
                        </tr>

                        <tr>
                            <td colspan="4">
                                <table border="1" cellspacing="0" style="margin-bottom: 0;"
                                       id="addtable">
                                           <?php
                                           $db = new DB ();
                                           $org_code = $_SESSION ['org_code'];

                                           /*
                                            * $conn = mysql_connect("david","FRED","123456");
                                            * mysql_select_db("project",$conn);
                                            */

                                           $sql = "select * from shareholder_info where org_code = '$org_code'";
                                           // $result = mysql_query($sql,$conn);
                                           $result = $db->SelectOri($sql);
                                           $tableRow = array();
                                           if($result != false){
                                           	$tableRow = mysql_num_rows ( $result );
                                           }

                                           if ($tableRow) {
                                               for ($i = 0; $i < $tableRow; $i ++) {
                                                   $row = mysql_fetch_object($result);
                                                   echo "<tr>";
                                                   echo "<td width='40%'><input type='text' name='shareholder_name[$i]' value='$row->shareholder_name'/></td>";
                                                   echo "<td width='40%'><input type='text' name='stock_ratio[$i]' datatype='float'  value='$row->stock_ratio' /></td>";
                                                   echo "<td><input type='button' value='删除' class='pointer but' onclick='delLine(this)'/></td>";
                                                   echo "</tr>";
                                               }
                                           } else {
                                               echo "<tr>";
                                               echo "<td width='40%'><input   type='text' name='shareholder_name[0]' /></td>";
                                               echo "<td width='40%'><input    type='text' name='stock_ratio[0]' datatype='float' style='width:50%;'/></td>";
                                               echo "<td width='20%' ><input    type='button' value='删除' class='pointer but'  onclick='delLine(this)'/></td>";
                                               echo "</tr>";
                                           }
                                           ?>	

                                </table>
                                <tr>
                                    <th colspan="4" height="25"><input   type="button" value="添加" class='pointer' onclick="addLine()" /></td>
                                    <!-- 没有字段-->
                                </tr>
                            </td>
                        </tr>



                        <tr>
                            <th >通讯地址/邮编</th>
                            <td colspan="3"><input   
                                    style="width: 99%; height: 100%" type="text"  name="org_address" /></td>
                        </tr>
                        <tr>
                            <th >法人代表</th>
                            <td width=""><input   
                                    style="width: 99%; height: 100%" type="text" name="legal_person" readonly/></td>
                            <th >总经理</th>
                            <td width=""><input style="width: 99%; height: 100%" type="text" name="manager"  datatype=""/></td>
                            <!--没有字段--> 
                        </tr>
                        <tr>
                            <th >联系人</th>
                            <td><input   
                                    style="width: 99%; height: 100%" type="text" name="linkman" /></td>
                            <th >电话</th>
                            <td width="166"><input style="width: 99%; height: 100%" type="text" datatype="phone"  name="phone" /></td>
                        </tr>
                        <tr>
                            <th >传真</th>
                            <td><input   
                                    style="width: 99%; height: 100%" type="text" name="fax" datatype="fax" /></td>
                            <th >手机</th>
                            <td><input style="width: 99%; height: 100%" type="text" name="telephone"  datatype="telephone"/></td>
                        </tr>
                        <tr>
                            <th >网址</th>
                            <td><input   
                                    style="width: 99%; height: 100%" type="text" name="website"  datatype="website" placeholder='请填写正确的网站格式，如http://www.baidu.com'/></td>
                            <!--没有字段-->
                            <th >电子邮件</th>
                            <td><input   
                                    style="width: 99%; height: 100%" type="text" name="email" datatype="email" /></td>
                        </tr>
                        <tr>
                            <th >注册地址</th>
                            <td><input   
                                    style="width: 99%; height: 100%" type="text"
                                    name="register_address"  readonly/></td>
                            <!--没有字段-->
                            <th >注册时间</th>
                            <td><input style="width: 99%; height: 100%" type="text" name="register_time"  class="dateplu" readonly/></td>
                        </tr>
                        <tr>
                            <th >注册资金（万）</th>
                            <td><input style="width: 99%; height: 100%" type="text" name="register_fund" datatype="float" /></td>
                            <!--没有字段-->
                            <th >资产总额（万）</th>
                            <td><input  style="width: 99%; height: 100%" type="text" name="total_fund"  datatype="float" /></td>
                            <!--没有字段-->
                        </tr>
                    </table>
                    <div class="button_wrapper clearfix">
                        <!--                 <div class="submit" >提交</div> -->
                        <div class="save" >保存</div>
                        <!-- <div class="reset" >重置</div> -->
                    </div>
                </div>
            </div>
        </form>

    </body>
</html>
