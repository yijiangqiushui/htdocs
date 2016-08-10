var addPrivileges='<div style="margin:20px 0 10px 0;"></div>\
          <div class="easyui-tabs" style="width:480px;height:300px">\
            <div title="审批管理" style="padding:10px">\
              <ul>\
                <li>部门管理   <input type="checkbox" class="bm_concat0" onchange="bm_all(0)" />全选</li>\
                <li style="list-style-type:none;">\
                	所属部门\
                	<input class="easyui-combox" id="concat_role" name="concat_role"/>\
                </li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" value="concat_query" name="concat_query0" class="bm_role0" onchange="check_isAll(0,\'bm\')"/>\
                  查看分类信息\
                  <input type="checkbox" value="concat_add" name="concat_add0" class="bm_role0" onchange="check_isAll(0,\'bm\')"/>\
                  添加分类信息\
                  <input type="checkbox" value="concat_del" name="concat_del0" class="bm_role0" onchange="check_isAll(0,\'bm\')"/>\
                  删除分类信息\
                  <br />\
                  <input type="checkbox" value="concat_edit" name="concat_edit0" class="bm_role0" onchange="check_isAll(0,\'bm\')"/>\
                  修改分类信息\
                  <input type="checkbox" value="concat_disable" name="concat_disable0" class="bm_role0" onchange="check_isAll(0,\'bm\')"/>\
                  禁用分类\
                  <input type="checkbox" value="concat_enable" name="concat_enable0" class="bm_role0" onchange="check_isAll(0,\'bm\')"/>\
                  启用分类 </li>\
                <br />\
                <li>创建制发文件</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" value="file_add" name="file_add0"/>\
                  添加内容信息</li>\
                <br />\
                <li>文件审批管理   <input type="checkbox" class="file_concat0" onchange="file_all(0)" />全选</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" value="file_query" name="file_query0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  查看内容信息\
                  <input type="checkbox" value="file_del" name="file_del0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  删除内容信息\
                  <input type="checkbox" value="file_edit" name="file_edit0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  修改内容信息\
                   <br />\
                  <input type="checkbox" value="file_red" name="file_red0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  上传红头文件\
                  <input type="checkbox" value="find_red" name="find_red0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  查看红头文件\
                  <input type="checkbox" value="make_red" name="make_red0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  制作红头文件\
                   <br />\
                  <input type="checkbox" value="file_detail" name="file_detail0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  查看内容详情\
                   <input type="checkbox" value="remake_red" name="remake_red0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  重新制作红头文件\
                  <input type="checkbox" value="file_self" name="file_self0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  只显示自己的制发文件\
                   <br />\
                  <input type="checkbox" value="file_cancel" name="file_cancel0" class="file_role0" onchange="check_isAll(0,\'file\')"/>\
                  取消文件\
                 </li>\
                   <br />\
                <li>制发文件统计</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" value="file_report" name="file_report0"/>\
                  制发文件统计</li>\
                <br />\
                <li>印章使用申请</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" value="seal_add" name="seal_add0"/>\
                  添加内容信息</li>\
                <br />\
                <li>印章审批管理   <input type="checkbox" class="seal_concat0" onchange="seal_all(0)"/>全选</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" value="seal_query" name="seal_query0" class="seal_role0" onchange="check_isAll(0,\'seal\')"/>\
                  查看内容信息\
                  <input type="checkbox" value="seal_del" name="seal_del0" class="seal_role0" onchange="check_isAll(0,\'seal\')"/>\
                  删除内容信息\
                  <input type="checkbox" value="seal_edit" name="seal_edit0" class="seal_role0" onchange="check_isAll(0,\'seal\')"/>\
                  修改内容信息\
                  <br />\
                  <input type="checkbox" value="seal_getNo" name="seal_getNo0" class="seal_role0" onchange="check_isAll(0,\'seal\')"/>\
                  生成文件编码\
                  <input type="checkbox" value="seal_status" name="seal_status0" class="seal_role0" onchange="check_isAll(0,\'seal\')"/>\
                  设置信息状态\
                  <input type="checkbox" value="seal_reject" name="seal_reject0" class="seal_role0" onchange="check_isAll(0,\'seal\')"/>\
                  驳回申请\
                  <br />\
                  <input type="checkbox" value="seal_cancel" name="seal_cancel0" class="seal_role0" onchange="check_isAll(0,\'seal\')"/>\
                  取消该文件\
                  </li>\
                <br />\
                <li>印章使用统计</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" value="seal_report" name="seal_report0"/>\
                  印章使用统计</li>\
                <br />\
             </ul>\
            </div>\
            <div title="短信管理" style="padding:10px">\
              <ul>\
                <li>短信管理   <input type="checkbox" class="sms_concat0" onchange="sms_all(0)"/>全选</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" value="sms_query" name="sms_query0" class="sms_role0" onchange="check_isAll(0,\'sms\')"/>\
                  查询短消息\
                  <input type="checkbox" value="sms_add" name="sms_add0" class="sms_role0" onchange="check_isAll(0,\'sms\')"/>\
                  发送短消息\
                  <input type="checkbox" value="sms_reply" name="sms_reply0" class="sms_role0" onchange="check_isAll(0,\'sms\')"/>\
                  查看回复消息\
                  <input type="checkbox" value="sms_del" name="sms_del0" class="sms_role0" onchange="check_isAll(0,\'sms\')"/>\
                  删除短消息</li>\
                <br />\
                <li>短信统计</li>\
                <li style="list-style-type:none;">\
                	<input type="checkbox" value="sms_report" name="sms_report0"/>\
                	短信统计\
                </li><br />\
                <li>通讯录分类   <input type="checkbox" class="listcat_concat0" onchange="listcat_all(0)"/>全选</li>\
               <!-- <li style="list-style-type:none;">\
                	所管分类\
                	<input class="easyui-combox" id="smslistcat_role" name="role"/>\
                </li>-->\
                <li style="list-style-type:none;">\
                  <input type="checkbox" name="smslistcat_query0" value="smslistcat_query" class="listcat_role0" onchange="check_isAll(0,\'listcat\')"/>\
                  查看分类信息\
                  <input type="checkbox" name="smslistcat_add0" value="smslistcat_add" class="listcat_role0" onchange="check_isAll(0,\'listcat\')"/>\
                  添加分类信息 \
                  <input type="checkbox" name="smslistcat_del0" value="smslistcat_del" class="listcat_role0" onchange="check_isAll(0,\'listcat\')"/>\
                  删除分类信息 \
                  <input type="checkbox" name="smslistcat_edit0" value="smslistcat_edit" class="listcat_role0" onchange="check_isAll(0,\'listcat\')"/>\
                  编辑分类信息 </li><br />\
                <li>通讯录内容信息   <input type="checkbox" class="listinfo_concat0" onchange="listinfo_all(0)"/>全选</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" name="smslistinfo_query0" value="smslistinfo_query" class="listinfo_role0" onchange="check_isAll(0,\'listinfo\')"/>\
                  查看通讯录\
                  <input type="checkbox" name="smslistinfo_add0" value="smslistinfo_add" class="listinfo_role0" onchange="check_isAll(0,\'listinfo\')"/>\
                  添加通讯录\
                  <input type="checkbox" name="smslistinfo_del0" value="smslistinfo_del" class="listinfo_role0" onchange="check_isAll(0,\'listinfo\')"/>\
                  删除通讯录\
                  <input type="checkbox" name="smslistinfo_edit0" value="smslistinfo_edit" class="listinfo_role0" onchange="check_isAll(0,\'listinfo\')"/>\
                  修改通讯录<br />\
                  <input type="checkbox" name="smslistinfo_import0" value="smslistinfo_import" class="listinfo_role0" onchange="check_isAll(0,\'listinfo\')"/>\
                  导入通讯录\
                  <input type="checkbox" name="smslistinfo_export0" value="smslistinfo_export" class="listinfo_role0" onchange="check_isAll(0,\'listinfo\')"/>\
                  导出通讯录 \
                  <input type="checkbox" name="smslistinfo_disable0" value="smslistinfo_disable" class="listinfo_role0" onchange="check_isAll(0,\'listinfo\')"/>\
                  禁用分类\
                  <input type="checkbox" name="smslistinfo_enable0" value="smslistinfo_enable" class="listinfo_role0" onchange="check_isAll(0,\'listinfo\')"/>\
                  启用分类 </li><br />\
              </ul>\
            </div>\
            <div title="设置" style="padding:10px">\
              <ul>\
                <li>角色权限   <input type="checkbox" class="admincat_concat0" onchange="admincat_all(0)"/>全选</li>\
                <li style="list-style-type:none;">\
                	所管分类\
                	<input class="easyui-combox" id="admincat_role" name="role"/>\
                </li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" name="admincat_query0" value="admincat_query" class="admincat_role0" onchange="check_isAll(0,\'admincat\')"/>\
                  查看角色信息\
                  <input type="checkbox" name="admincat_add0" value="admincat_add" class="admincat_role0" onchange="check_isAll(0,\'admincat\')"/>\
                  添加角色\
                  <input type="checkbox" name="admincat_edit0" value="admincat_edit" class="admincat_role0" onchange="check_isAll(0,\'admincat\')"/>\
                  修改角色信息\
                  <br />\
                  <input type="checkbox" name="admincat_del0" value="admincat_del" class="admincat_role0" onchange="check_isAll(0,\'admincat\')"/>\
                  删除角色\
                  <input type="checkbox" name="admincat_disable0" value="admincat_disable" class="admincat_role0" onchange="check_isAll(0,\'admincat\')"/>\
                  禁用角色\
                  <input type="checkbox" name="admincat_enable0" value="admincat_enable" class="admincat_role0" onchange="check_isAll(0,\'admincat\')"/>\
                  启用角色 </li>\
                <br />\
                <li>管理员信息   <input type="checkbox" class="admininfo_concat0" onchange="admininfo_all(0)"/>全选</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" name="admininfo_query0" value="admininfo_query" class="admininfo_role0" onchange="check_isAll(0,\'admininfo\')"/>\
                  查看管理员信息\
                  <input type="checkbox" name="admininfo_add0" value="admininfo_add" class="admininfo_role0" onchange="check_isAll(0,\'admininfo\')"/>\
                  添加管理员\
                  <input type="checkbox" name="admininfo_edit0" value="admininfo_edit" class="admininfo_role0" onchange="check_isAll(0,\'admininfo\')"/>\
                  修改管理员信息\
                  <br />\
                  <input type="checkbox" name="admininfo_del0" value="admininfo_del" class="admininfo_role0" onchange="check_isAll(0,\'admininfo\')"/>\
                  删除管理员信息\
                  <input type="checkbox" name="admininfo_disable0" value="admininfo_disable" class="admininfo_role0" onchange="check_isAll(0,\'admininfo\')"/>\
                  禁用管理员\
                  <input type="checkbox" name="admininfo_enable0" value="admininfo_enable" class="admininfo_role0" onchange="check_isAll(0,\'admininfo\')"/>\
                  启用管理员 </li>\
              </ul>\
            </div>\
            <div title="扩展" style="padding:10px">\
              <ul>\
                <li>日志</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" name="loginfo_query0" value="loginfo_query"/>\
                  查看日志信息 </li>\
                <br />\
                <li>数据库</li>\
                <li style="list-style-type:none;">\
                  <input type="checkbox" name="data_backup0" value="data_backup"/>\
                  备份数据&nbsp;&nbsp;&nbsp;&nbsp;\
                  <input type="checkbox" name="data_restore0" value="data_restore"/>\
                  恢复数据 </li><br />\
              </ul>\
            </div>\
          </div>'
					;

var editPrivileges='';
