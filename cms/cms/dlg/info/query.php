<?php
/************************************************************************************************************
# PHP Version 1.2   MySQL  JavaScript
# Copyright (c) 2009 http://www.cnalog.com
# Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
# Date: 2009/10/10
************************************************************************************************************/

require_once('../../../../common/php/config.ini.php');

$dlgTitle='内容查询';
$dlgWidth=650;
$category=$_REQUEST['category'];

?>
<!--添加编辑对话框 start-->
<?php require_once(ROOTPATH.'../../cms/system/inc/dlg/dlg_start.php');?>
  <form action="?" method="post" name="queryForm" id="queryForm">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="formFolder">
    <tr>
      <td width="90">标题：</td>
      <td><input name="title" type="text" class="borderStyle inputWidth_10" id="title" maxlength="50" /></td>
    </tr>
    <tr>
      <td>负责人：</td>
      <td><input name="operator" type="text" class="borderStyle inputWidth_10" id="operator" maxlength="10" /></td>
    </tr>
    <tr>
      <td>发布时间段：</td>
      <td><input name="releaseTime_s" type="text" class="borderStyle" style="width:138px" id="releaseTime_s" maxlength="20" />
        <span style="font-weight:normal;margin:0 5px 0 5px"> <input name="chooseSTBtn" type="button" id="chooseSTBtn" class="buttonStyle" value="选择" onclick="ShowCalendar(releaseTime_s);" /> -</span>
          <input name="releaseTime_e" type="text" class="borderStyle" style="width:138px" id="releaseTime_e" maxlength="20" />
          <span class="promptBlue"> <input name="chooseOTBtn" type="button" id="chooseOTBtn" class="buttonStyle" value="选择" onclick="ShowCalendar(releaseTime_e);" /> * 时间格式如：20090725</span></td>
    </tr>
    <tr>
      <td>内容：</td>
      <td><label>
        <input name="content" type="text" class="borderStyle inputWidth_10" id="content" maxlength="50" />
      </label></td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td><input name="querySubmit" type="submit" id="querySubmit" value="开始检索" class="buttonStyle" />
      &nbsp; <input name="queryAll" type="button" id="queryAll" value="取消" class="buttonStyle" onclick="hideDlg();" />    </td>
    </tr>
  </table>

  <input type="text" value="<?php echo $category;?>" id="category" name="category"/>
  </form>
<?php require_once(ROOTPATH.'../../cms/system/inc/dlg/dlg_end.php');?>
<!--检索对话框 end-->