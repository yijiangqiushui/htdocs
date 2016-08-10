<div title="通信管理" style="padding:10px">
              <ul>
                <li>短信管理   <input type="checkbox" class="sms_concat1" onchange="sms_all(1)"/>全选</li>
                <li style="list-style-type:none;">
                  <input type="checkbox" value="sms_query" name="sms_query1" class="sms_role1" onchange="check_isAll(1,'sms')"/>
                  查询短消息
                  <input type="checkbox" value="sms_add" name="sms_add1" class="sms_role1" onchange="check_isAll(1,'sms')"/>
                  发送短消息
                  <input type="checkbox" value="sms_reply" name="sms_reply1" class="sms_role1" onchange="check_isAll(1,'sms')"/>
                  查看回复消息
                  <input type="checkbox" value="sms_del" name="sms_del1" class="sms_role1" onchange="check_isAll(1,'sms')"/>
                  删除短消息</li>
                	<input type="checkbox" value="sms_report" name="sms_report1" class="sms_role1"/>
                	短信统计
                <br />
                <li>通讯录管理   <input type="checkbox" class="listinfo_concat1" onchange="listinfo_all(1)"/>全选</li>
                <li style="list-style-type:none;">
                  <input type="checkbox" name="smslistcat_add1" value="smslistcat_add" class="listinfo_role1" onchange="check_isAll(1,'listinfo')"/>
                  添加通讯录分组
                  <input type="checkbox" name="smslistcat_edit1" value="smslistcat_edit" class="listinfo_role1" onchange="check_isAll(1,'listinfo')"/>
                  编辑通讯录分组
                  <input type="checkbox" name="smslistcat_del1" value="smslistcat_del" class="listinfo_role1" onchange="check_isAll(1,'listinfo')"/>
                  删除通讯录分组
                  <br />
                  <!--
                  </li>
                <li>通讯录内容信息   <input type="checkbox" class="listinfo_concat1" onchange="listinfo_all(1)"/>全选</li>
                <li style="list-style-type:none;">
                -->
                  <input type="checkbox" name="smslistinfo_query1" value="smslistinfo_query" class="listinfo_role1" onchange="check_isAll(1,'listinfo')"/>
                  查看联系人
                  <input type="checkbox" name="smslistinfo_add1" value="smslistinfo_add" class="listinfo_role1" onchange="check_isAll(1,'listinfo')"/>
                  添加联系人
                  <input type="checkbox" name="smslistinfo_edit1" value="smslistinfo_edit" class="listinfo_role1" onchange="check_isAll(1,'listinfo')"/>
                  修改联系人
                  <input type="checkbox" name="smslistinfo_del1" value="smslistinfo_del" class="listinfo_role1" onchange="check_isAll(1,'listinfo')"/>
                  删除联系人
                  <br />
                  <input type="checkbox" name="smslistinfo_import1" value="smslistinfo_import" class="listinfo_role1" onchange="check_isAll(1,'listinfo')"/>
                  导入通讯录
                  <input type="checkbox" name="smslistinfo_export1" value="smslistinfo_export" class="listinfo_role1" onchange="check_isAll(1,'listinfo')"/>
                  导出通讯录 
                  </li><br />
              </ul>
            </div>