<div title="审批管理" style="padding:10px"  >
              <ul>
                <li>文件审批管理
                   <input type="checkbox" class="drafter1" name="drafter1" value="drafter" onchange="getDrafterPri(1)" />拟稿人
                  <input type="checkbox" class="maker1" name="maker1" value="maker" onchange="getMakerPri(1)" />制文人
                </li>
                <li style="list-style-type:none;">
                  <input type="checkbox" value="file_query" name="file_query1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  查看制发文件
                  <input type="checkbox" value="file_add" name="file_add1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  创建制发文件
                  <input type="checkbox" value="file_del" name="file_del1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  删除制发文件
                  <input type="checkbox" value="file_edit" name="file_edit1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  修改制发文件
                  <br />
                   <input type="checkbox" value="file_red" name="file_red1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  上传红头文件
                  <input type="checkbox" value="find_red" name="find_red1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  查看红头文件
                 <input type="checkbox" value="file_detail" name="file_detail1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  查看制发文件详情
                   <br />
                  <input type="checkbox" value="make_red" name="make_red1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  通知制文人制作红头文件
                  <input type="checkbox" value="remakes_red" name="remakes_red1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  通知制文人重新制作红头文件
                  <br />
                  <input type="checkbox" value="file_cancel" name="file_cancel1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  撤销制发文件
                  <input type="checkbox" value="file_self" name="file_self1" class="file_role1" onchange="check_isAll(1,'file')"/>
                  只显示自己的制发文件
                  <input type="checkbox" value="file_report" name="file_report1"/>
                  制发文件统计
              </li>
              <br />
         			<li>印章审批管理   
              	<input type="checkbox" class="sealer1" name="sealer1" value="sealer" onchange="seal_all(1)" />印章管理员
              </li>
                <li style="list-style-type:none;">
                  <input type="checkbox" value="seal_query" name="seal_query1" class="seal_role1" onchange="check_isAll(1,'seal')"/>
                  查看印章申请
                  <input type="checkbox" value="seal_add" name="seal_add1" class="seal_role1"/>
                  添加印章申请
                  <input type="checkbox" value="seal_del" name="seal_del1" class="seal_role1" />
                  删除印章申请
                  <input type="checkbox" value="seal_edit" name="seal_edit1" class="seal_role1" />
                  修改印章申请
                  <br />
                  <input type="checkbox" value="seal_getNo" name="seal_getNo1" class="seal_role1" onchange="check_isAll(1,'seal')"/>
                  生成文件编码
                  <input type="checkbox" value="seal_status" name="seal_status1" class="seal_role1" onchange="check_isAll(1,'seal')"/>
                  设置信息状态
                  <input type="checkbox" value="seal_reject" name="seal_reject1" class="seal_role1" onchange="check_isAll(1,'seal')"/>
                  驳回申请
                  <input type="checkbox" value="seal_cancel" name="seal_cancel1" class="seal_role1" onchange="check_isAll(1,'seal')"/>
                  撤销印章申请
                  <br />
                  <input type="checkbox" value="seal_report" name="seal_report1"/>
                  印章使用统计
                 </li>
             </ul>
            </div>