<div title="设置" style="padding:10px">
              <ul>
                <li>用户分组   <input type="checkbox" class="admincat_concat1" onchange="admincat_all(1)"/>全选</li>
                <li style="list-style-type:none;">
                	所管分类
                	<input class="easyui-combox" id="admincat_role1" name="admincat_role"/>
                </li>
                <li style="list-style-type:none;">
                  <input type="checkbox" name="admincat_query1" value="admincat_query" class="admincat_role1" onchange="check_isAll(1,'admincat')"/>
                  查看用户
                  <input type="checkbox" name="admincat_add1" value="admincat_add" class="admincat_role1" onchange="check_isAll(1,'admincat')"/>
                  添加用户
                  <input type="checkbox" name="admincat_edit1" value="admincat_edit" class="admincat_role1" onchange="check_isAll(1,'admincat')"/>
                  修改用户
                  <br />
                  <input type="checkbox" name="admincat_del1" value="admincat_del" class="admincat_role1" onchange="check_isAll(1,'admincat')"/>
                  删除用户
                  <input type="checkbox" name="admincat_disable1" value="admincat_disable" class="admincat_role1" onchange="check_isAll(1,'admincat')"/>
                  禁用用户
                  <input type="checkbox" name="admincat_enable1" value="admincat_enable" class="admincat_role1" onchange="check_isAll(1,'admincat')"/>
                  启用用户 </li>
                <br />
                <li>用户信息   <input type="checkbox" class="admininfo_concat1" onchange="admininfo_all(1)"/>全选</li>
                <li style="list-style-type:none;">
                  <input type="checkbox" name="admininfo_query1" value="admininfo_query" class="admininfo_role1" onchange="check_isAll(1,'admininfo')"/>
                  查看用户信息
                  <input type="checkbox" name="admininfo_add1" value="admininfo_add" class="admininfo_role1" onchange="check_isAll(1,'admininfo')"/>
                  添加用户
                  <input type="checkbox" name="admininfo_edit1" value="admininfo_edit" class="admininfo_role1" onchange="check_isAll(1,'admininfo')"/>
                  修改用户
                  <br />
                  <input type="checkbox" name="admininfo_del1" value="admininfo_del" class="admininfo_role1" onchange="check_isAll(1,'admininfo')"/>
                  删除用户
                  <input type="checkbox" name="admininfo_disable1" value="admininfo_disable" class="admininfo_role1" onchange="check_isAll(1,'admininfo')"/>
                  禁用用户
                  <input type="checkbox" name="admininfo_enable1" value="admininfo_enable" class="admininfo_role1" onchange="check_isAll(1,'admininfo')"/>
                  启用用户 </li>
              </ul>
            </div>