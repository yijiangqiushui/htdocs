<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
        table{ background:#000;}
        table th{background:#FFFAF0; font-family: 黑体;font-size: 1.3em;height:35px;}
        table tr td{ background:#FFFAF0;font-family: 微软雅黑;font-size: 1em;height:35px;}
    </style>
</head>
<body>

<div style="background:#A2B5CD;text-align:center;height:50px;"><h1>项目流程控制</h1></div>
<div class="easyui-panel" title=<?php echo $department."项目流程控制" ?> collapsible="false" resizable="false" border="0" >
  <?php
  include '../../../../../center/php/config.ini.php';
  include '../../../../../common/php/config.ini.php';
  include '../../../../../common/php/lib/db.cls.php';
  include CENTER_ROOTPATH."/modules/service/ProCheckPriMapDao.cls.php";
  include CENTER_ROOTPATH."/modules/service/ProjectTypeService.cls.php";
  include CENTER_ROOTPATH."../../common/php/lib/pri.cls.php";
  class showlist{
    
        protected $pri_list;
        protected $pri_list_str;
        protected $is_admin = false;
    
        function get_dpname($dp_id){
            global $global_department;
            if(-1 == $dp_id){
                return null;
            }
            return $global_department[$dp_id]['name'];
        }
		
		static function get_pt_tree(){
			global $global_department;
			
			$pt_arr = array();
			foreach($global_department as $key=>$item){
				
				if($item['status'] == -1){
					continue;
				}
				
				$item['id'] = $key;
				
				$condition = array(
					'dep_type'=>$key
				);
				$item_val = ProjectTypeService::instance()->get_project_type($condition);
				
				$pt_arr[] = array(
					'father'=>$item,
					'children'=>$item_val
				);
				
			}
			
			return $pt_arr;
			
		}
        
        function check_pri_own(){
            $uid = $_SESSION['user_id'];
            $this->pri_list = ProCheckPriMapDao::instance()->get_pri_map_by_uid($uid,0); //获取登陆用户可转移权限
            if(empty($this->pri_list)){
                $this->pri_list = array();
            }else{
                foreach($this->pri_list as $item){
                    $this->pri_list_str[] = $item['project_type_id']."_".$item['project_type_para_id'];
                }
            }
        }
        
        function make_pri_table($id,$val){
            $str = "<td width='100' align='center'>";
            $pri_str = $id."_".$val;
            if($this->is_admin || in_array($pri_str,$this->pri_list_str)){
                $str .= "<input type='checkbox' checked='checked' name='pt_{$id}[]' value='{$val}' ptid='{$id}'/><span>允许</span>";
            }
            $str .= "</td>";
            return $str;
        }
    
        function show(){
            
            if($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 2){
                $this->is_admin = true;
            }
            
            
            //该用户的对所有可操作项目的权限。
            $this->check_pri_own();
            //<th align="center" colspan="2">操作</th>
          echo '<form class="easyui-panel" id="project_process" method="post" action="">
        <table width="1111" border="0" cellpadding="0" cellspacing="1" id="priCheckList">
        <tr>
            <th align="center" >项目编号</th>
            <th align="center">项目名称</th>
            <th align="center">受理人</th>
            <th align="center" width="120px;">主管工程师</th>
            <th align="center">项目负责科室</th>
            <th align="center">项目主管权限</th>
        </tr>';
          $db = new DB();
          $sql = "Select * from project_type where isfather=1 and inherit_val = 0";
          
          $result = $db->SelectOri($sql);
          $row_n = mysql_num_rows($result);
          $num = 0;
          $dep_type = $_SESSION['department'];
          for($i = 1;$i <= $row_n;$i++){
              $father = mysql_fetch_object($result);
          
              //用来判断当前的父节点是否存在子节点
              $id = $father->id;
              //当前父节点中子节点的个数
              $sql1 = "Select * from project_type where father='$id' and inherit_val = 0";
              if($_SESSION['user_type'] != 3){
                $sql1 .= " and dep_type = ".$dep_type;
              }
              $result1 = $db->SelectOri($sql1);
              $row_m = mysql_num_rows($result1);
              if($row_m != 0){
                  $num = $num + 1;
                  echo "<tr>";
                  echo "<td align='center'><strong>".$num."</strong></td>";
                  echo "<td  align='center'><strong>".$father->name."</strong></td>";
                  if($father->id == $father->father){
                      echo $this->make_pri_table($father->id,0);
                      echo $this->make_pri_table($father->id,1);
                      //echo $this->make_pri_table($father->id,4);
                      //echo $this->make_pri_table($father->id,5);
                      //全选和反选
//                       echo "<td width='100' align='center'><input type='radio' cval='0' name='pt_$father->id.radio' ptid='{$father->id}'/><span>全选</span></td>";
//                       echo "<td width='100' align='center'><input type='radio' cval='1' name='pt_$father->id.radio' ptid='{$father->id}'/><span>反选</span></td>";
                      echo "<td align='center'>{$this->get_dpname($father->dep_type)}</td>";
                      echo "<td align='center'><a href='#' onclick='getProList({$father->id});'>项目列表</a></td>";
                  }
                  else{
                      echo "<td></td>";
                      echo "<td></td>";
//                       echo "<td></td>";
//                       echo "<td></td>";
//                       //echo "<td></td>";
                      echo "<td></td>";
                      echo "<td ></td>";
                  }
                  echo "</tr>";
          
                  for($j = 1;$j <= $row_m;$j++){
                      $children = mysql_fetch_object($result1);
          
                      if($children->father != $children->id){
                          echo "<tr>";
                          echo "<div class='$children->name'>";
                          echo "<td  align='center'>".$num.".".$j."</td>";
                          echo "<td  align='center'>".$children->name."</td>";
                          echo $this->make_pri_table($children->id,0);
                          echo $this->make_pri_table($children->id,1);
                          //echo $this->make_pri_table($children->id,4);
                          //echo $this->make_pri_table($children->id,5);
                          //全选和反选
//                           echo "<td width='100' align='center'><input type='radio' cval='0' name='pt_$children->id.radio' ptid='{$children->id}'/><span>全选</span></td>";
//                           echo "<td width='100' align='center'><input type='radio' cval='1' name='pt_$children->id.radio' ptid='{$children->id}'/><span>反选</span></td>";
                          echo "<td align='center'>{$this->get_dpname($children->dep_type)}</td>";
                          echo "<td align='center'><a href='#' onclick='getProList({$children->id});'>项目列表</a></td>";
                          echo "</div>";
                          echo "</tr>";
                      }
                  }
              }
          
          }
          echo "</table>";
          echo "</form>";
      }
  }
	?>

     
</div>
</body>
</html>
