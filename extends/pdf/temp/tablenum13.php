<h2 style="white-space: normal; text-align: center;">
    专家名单及专家论证意见表
</h2>
<table style="border:2px solid #999;" width="600">
    <tbody>
        <tr class="firstRow">
            <td valign="top" rowspan="1" colspan="4" style="word-break: break-all; border:1px solid #999;">
                <h2 style="white-space: normal; text-align: center;">
                    专家组论证意见
                </h2>
            </td>
        </tr>
        <tr>
            <td colspan="1" valign="top" style="word-break: break-all; border:1px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    &nbsp; &nbsp;<span style="font-size: 18px;border:1px solid #999;">项目名称</span>
                </h2>
            </td>
            <td valign="top" rowspan="1" colspan="3"><?php echo $data['project_name'];?></td>
        </tr>
        <tr>
            <td colspan="1" valign="top" style="word-break: break-all; border:1px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px; line-height: normal;">
                    <br/>
                </h2>
                <h2 style="white-space: normal; padding: 0px; margin: 0px; line-height: normal;">
                    &nbsp; &nbsp;<span style="font-size: 18px;">论证意见</span>
                </h2>
            </td>
            <td valign="top" rowspan="1" colspan="3" style="font-size:18px;word-break: break-all; border:1px solid #999;">
                <?php echo $data['expert_opinion'];?>
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="1" rowspan="1"></td>
            <td valign="top" colspan="1" rowspan="1"></td>
            <td valign="top" colspan="1" rowspan="1" style="word-break: break-all;">
                <span style="text-align: right;">论证专家组组长（签字）:</span>
            </td>
            <td valign="top" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td valign="top" colspan="1" style="word-break: break-all;"></td>
            <td valign="top" colspan="1"></td>
            <td valign="top" colspan="1" style="word-break: break-all;"></td>
            <td valign="top" colspan="1" style="word-break: break-all;">
                <span style="text-align: right;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 年&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;日</span>
            </td>
        </tr>
    </tbody>
</table>
<h2 style="text-align:center;">
    <span style="font-size: 16px;"></span>
</h2>
<table data-sort="sortDisabled" style="border:2px solid #999;" width="600">
    <tbody>
        <tr class="firstRow">
            <td valign="top" style="word-break: break-all; border:2px solid #999;" rowspan="1" colspan="4">
                <h2 style="white-space: normal; text-align: center;">
                    专家信息
                </h2>
            </td>
        </tr>
        <tr>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">项目名称</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $data['project_name'];?></td>
            <td valign="center" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">项目编号</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $data['project_id'];?></td>
        </tr>
        <tr>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">承担单位</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $data['project_org'];?></td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">项目负责人</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $data['project_leader'];?></td>
        </tr>
        <tr>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">所属资金专项名称</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo isset($data['project_money']) ? $data['project_money']:'' ;?></td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size:18px">论证时间</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo isset($data['project_argument_time']) ? $data['project_argument_time']:'';?></td>
        </tr>
    </tbody>
</table>
<h2 style="text-align:center;">
    <span style="font-size: 16px;"></span>
</h2>
<table style="border:2px solid #999;" width="600">
    <tbody>
        <tr class="firstRow">
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size:18px">专家姓名</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">分工</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">所在单位</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">身份证号</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">职务/职称</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">从事专业</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">联系电话（手机）</span>
                </h2>
            </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">
                <h2 style="white-space: normal; padding: 0px; margin: 0px;">
                    <span style="font-size: 18px;">签字</span>
                </h2>
            </td>
        </tr>
        <?php if(!empty($data['experts'])) { foreach($data['experts'] as $row): ?>
        <tr>
        
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $row['expert_name']?></td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $row['expert_divide']?> </td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $row['expert_org']?></td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $row['expert_id']?></td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $row['expert_job']?></td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $row['expert_major']?></td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;"><?php echo $row['expert_phone']?></td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">&nbsp;</td>
        </tr>
        <?php endforeach;} else {?>
        <tr>
        
            <td valign="top" style="word-break: break-all; border:2px solid #999;">无</td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">无</td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">无</td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">无</td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">无</td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">无</td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">无</td>
            <td valign="top" style="word-break: break-all; border:2px solid #999;">&nbsp;</td>
        </tr>
        <?php }?>
    </tbody>
</table>
<h2 style="text-align:center;">
    <span style="font-size: 16px;"></span>
</h2>
<table width="600" data-sort="sortDisabled" style="border:2px solid #999;">
    <tbody>
        <tr class="firstRow">
            <td valign="top" style="word-break: break-all; border:2px solid #999;" rowspan="1" colspan="4">
                <h2 style="white-space: normal; text-align: center;">审核意见 </h2>
            </td>
        </tr>
        <tr>
            <td valign="top" style="word-break: break-all; border:2px solid #999;" rowspan="1" colspan="4">
                <?php echo $data['approval_opinion'];?>                   
            </td>
        </tr>
    </tbody>
</table>