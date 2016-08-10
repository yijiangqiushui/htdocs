<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>项目列表</title>
<!--     <link rel="stylesheet" type="text/css" href="../../../../website/html/view/css/tablestyle.css"/> -->
<link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../css/table.css"/>

<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../modules/html/view/js/project/generate_devcode.js"></script>
<style type="text/css">
body {
	font-size: 14px;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
input {
	height: 100%;
	width: 100%;
	background-color:transparent;	
}
.panel-body {
	font-size: 14px;
}
tr:nth-child(odd) {
	background-color: #D1E4F3;
	border: solid 1px #ffffff;
}

tr:nth-child(even) {
	background-color: #EAF3FA;
	border: solid 1px #ffffff;
}

td {
	text-align: center;
	border: solid 1px #ffffff;
	line-height: 25px;
}

th {
	height: 32px;
	fond-family: '黑体';
	color: #FFFFFF;
	background-color: #0066FF;
	border: solid 1px #ffffff;
}
body {
	text-align: center;
	margin: auto 0;
}

.button4 {
	background: #0066FF;
	color: #FFF;
	width: 100%;
	height: 100%;
	font-family: '黑体';
}

.button5 {
	background: #33CCCC;
	color: #FFF;
	width: 100%;
	height: 100%;
	font-family: '黑体';
}

.button6 {
	background: #FF9900;
	color: #FFF;
	width: 100%;
	height: 100%;
	font-family: '黑体';
}
.easyui-panel{
	width: auto !important;
}
</style>
</head>

<body>
	<div class="easyui-panel" title="选取项目类型" collapsible="false"
		resizable="false" style="position: relative;float: left;margin-right: 181px;">
		<table style="margin: auto 0; width: 100%" border="1" cellspacing="0"
			cellpadding="0">
			<tr>
				<th name="id" align="center"style="width:50px">序号</th>
				<th name="name" align="center"style="width:300px">项目类别</th>
				<th name="start_time" align="center"style="width:100px">申报开始日期</th>
				<th name="end_time" align="center"style="width:100px">申报截止日期</th>
				<th name="status" align="center"style="width:30px">申报状态</th>
			</tr>
  <?php
		include '../../../../common/php/config.ini.php';
		include '../../../../common/php/lib/db.cls.php';
		//2016.01.07 david modify
		$db = new DB ();
		$user_id = $_SESSION ['user_id']; // 获取登录的用户id
		$sql_new = "SELECT a.user_id,a.project_type_id,b.father_id,b.name FROM project_type_inherit a JOIN (SELECT c.id AS father_id,d.* FROM project_type c JOIN (SELECT * FROM project_type) d ON (c.id = d.inherit_val)) b ON (a.project_type_id = b.id) WHERE a.user_id = $user_id";
// 		echo $sql_new;
		$result_new = $db -> Select($sql_new);
		//获取需要更换的父类的id数组
		foreach($result_new as $item){
		    $inherit_father[] = $item['father_id'];
		    $father_children[$item['father_id']] = $item['project_type_id'];
		}
// 		var_dump($father_children);
		$sql = "Select * from project_type where isfather=1 and is_delete = 0 and is_public=1 and inherit_val = 0";
		
		$color="";
		unset($_SESSION['project_id']);
		$result = $db->SelectOri ($sql);
		$row_n = mysql_num_rows ($result);
		//echo $row_n;exit;
		for($i = 1; $i <= $row_n; $i ++){
			$father = mysql_fetch_object ($result);
			$id = $father->id;
			//需要判断这个id是不是需要进行替换的
			if(count($inherit_father) > 0){
			    if(in_array($id, $inherit_father)){
			        //如果是需要进行替换的
			        $childrenReplace = $father_children[$id];
			        $children_sql = "select * from project_type where id = $childrenReplace";
			        // 			    echo $children_sql;
			        $children_result = $db->SelectOri ($children_sql);
			        $father = mysql_fetch_object ($children_result);
			        // 			    var_dump($father);
			        $id = $father->id;
			    }
			}
			
			// 判断初始的是什么阶段
			$stage = "";
			if ($father->apply_stage > 0) {
				$stage = $stage . "0,";
			}
			if ($father->setup_stage > 0) {
				$stage = $stage . "1,";
			}
			if ($father->carry_stage > 0) {
				$stage = $stage . "2,";
			}
			if ($father->check_stage > 0) {
				$stage = $stage . "3,";
			}
			$stage = trim( $stage, "," );
			echo "<tr>";
			echo "<th align='center' style='background-color: #7AB5ED'><strong>" . $i . "</strong></th>";
			echo "<td  align='center'style='background-color: #7AB5ED'><strong>" . $father->name . "</strong></td>";
			$apply_status = "";
			
			if (($father->id == $father->father || $father->father == $father->inherit_val) && $father->father != 0) {
			    $apply_status_case = $father->apply_status;
			     if($father -> inherit_val != 0){
				    $apply_status_case = 1;
				 }
				switch ($apply_status_case) {
					case 0 :
					   $color="style='background-color:silver;font-color:#ffffff'"."disabled='disabled'" ;
						$apply_status = "项目未开启";
						break;
					case 1 :
					    $color="";
						$apply_status = "正在申报";
						break;
					case 2 :
					    $color="style='background-color:gray;font-color:#ffffff'"."disabled='disabled'" ;
						$apply_status = "申报截止";
						break;
				}
				
				//$start_time = date ( "Y-m-d", $father->apply_start );
				//echo $father->apply_start;exit;
				if($father->apply_start != null){
					$start_time = date('Y/m/d',$father->apply_start);
				}else{
					$start_time = null;
				}
				if ($father->apply_end != null) {
					$end_time = date ( "Y-m-d", $father->apply_end );
				}else{
					$end_time = null;
				}
				echo "<td  align='center'> $start_time</td>";
				echo "<td  align='center'>$end_time</td>";
				if ($father->apply_status != "" && $father->apply_status != null) {
					$now = strtotime('now');
					if($now < $father->apply_start && $father -> inherit_val == 0){
						echo "<td><div><input  style='background-color: gray;color:#ffffff; cursor:pointer;' type='submit' class='button1'  value='申报未开始' disabled='disabled' /></div></td>";
					}else{
						  if($end_time !=null && $now > $father->apply_end){
						  	echo "<td><div><input  style='background-color: gray;color:#ffffff; cursor:pointer;' type='submit' class='button1'  value='申报已结束' disabled='disabled' /></div></td>";
						  }else{
							  switch ($father->dep_type) { // <td bgcolor='#0080FF'>  
							    
							/* 	case - 1 :
									echo "<td><div align='center' ".$color."><input type='submit' class='button3'  value=" . $apply_status . " onclick='getProject_id(" . $father->dep_type . "," . "\"" . $father->name . "\"" . "," . "\"" . $father->attatch_name . "\"" . "," . "\"" . $stage . "\"" . ");'/></div></td>";
									break; */
								/* case 0 :
									echo "<td ><div align='center' ><input ".$color."  type='submit' class='button4' value=" . $apply_status . " onclick='getProject_id(" . $father->dep_type . "," . "\"" . $father->name . "\"" . "," . "\"" . $father->attatch_name . "\"" . "," . "\"" . $stage . "\"" . ");'/></div></td>";
									break;
								case 1 :
									echo "<td ><div align='center'  ><input ".$color."   type='submit' class='button5' value=" . $apply_status . " onclick='getProject_id(" . $father->dep_type . "," . "\"" . $father->name . "\"" . "," . "\"" . $father->attatch_name . "\"" . "," . "\"" . $stage . "\"" . ");'/></div></td>";
									break;
								case 2 :
									echo "<td ><div align='center'   ><input  ".$color."   type='submit' class='button6' value=" . $apply_status . " onclick='getProject_id(" . $father->dep_type . "," . "\"" . $father->name . "\"" . "," . "\"" . $father->attatch_name . "\"" . "," . "\"" . $stage . "\"" . ");'/></div></td>";
									break; */
							    case 0 :
							        echo "<td ><div align='center' ><input ".$color."  type='submit' class='button4' value=" . $apply_status . " onclick='getProject_id(". $father->id  . "," . "\"" . $stage . "\"" . ");' style='cursor:pointer;'/></div></td>";
							        break;
							    case 1 :
							        echo "<td ><div align='center' ><input ".$color."  type='submit' class='button5' value=" . $apply_status . " onclick='getProject_id(". $father->id  . "," . "\"" . $stage. "\"" . ");' style='cursor:pointer;'/></div></td>";
							        break;
							    case 2 :
							        echo "<td ><div align='center' ><input ".$color."  type='submit' class='button6' value=" . $apply_status . " onclick='getProject_id(". $father->id  . "," . "\"" . $stage . "\"" . ");' style='cursor:pointer;'/></div></td>";
							        break;
								default :
									echo "<td bgcolor='#FF9000'  ><div    align='center'><input type='submit' class='button6' value='出问题啦！'";
							  }
						  }
					}
				} else {
					echo "<td></td>";
				}
			} else {
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
			}
			
			echo "</tr>";
			//2016.0107 david modify
			$sql1 = "Select * from project_type where father='$id' and is_delete = 0 and is_public=1 and inherit_val = 0";
			$result1 = $db->SelectOri ( $sql1 );
			$row_m = mysql_num_rows ( $result1 );
// 			var_dump($inherit_father);exit();
			for($j = 1; $j <= $row_m; $j ++) {
				$children = mysql_fetch_object ( $result1 );
				if(count($inherit_father) > 0){
				    if(in_array($children->id, $inherit_father)){
				        $childrenReplace = $father_children[$children->id];
				        $children_sql = "select * from project_type where id = $childrenReplace";
// 				        var_dump($children_sql);exit();
				        $children_result = $db->SelectOri ($children_sql);
				        $children = mysql_fetch_object ($children_result);
				        // 				    $id = $father->id;
				    }
				}
				
				$apply_status_case = $children->apply_status;
				if($children -> inherit_val != 0){
				    $apply_status_case = 1;
				}
				switch ($apply_status_case) {
					case 0 :       
                      $color="style='background-color:silver;font-color:#ffffff'"."disabled='disabled'" ;
						$apply_status = "项目未开启";
						break;
					case 1 :
					    $color="";
						$apply_status = "正在申报";
						break;
					case 2 :
						$color="style='background-color:gray;font-color:#ffffff'"."disabled='disabled'" ;
						$apply_status = "申报截止";
						break;
				}
				if ($children->father != $children->id) {
					$stage = "";
					if ($children->apply_stage > 0) {
						$stage = $stage . "0,";
					}
					if ($children->setup_stage > 0) {
						$stage = $stage . "1,";
					}
					if ($children->carry_stage > 0) {
						$stage = $stage . "2,";
					}
					if ($children->check_stage > 0) {
						$stage = $stage . "3,";
					}
					$stage = trim ( $stage, "," );
					echo "<tr>";
					echo "<td  align='center'>" . $i . "." . $j . "</td>";
					echo "<td  align='left' width='550px'>" . $children->name . "</td>";
					//$start_time = date ( "Y-m-d", $children->apply_start );
					
					if ($children->apply_start != null) {
						$start_time = date ( "Y-m-d", $children->apply_start );
					} else {
						$start_time = null;
					}
					
					if ($children->apply_end != null) {
						$end_time = date ( "Y-m-d", $children->apply_end );
					} else {
						$end_time = null;
					}
					echo "<td  align='center' width='140px'>" . $start_time . "</td>";
					echo "<td  align='center' width='140px'>" . $end_time . "</td>";
					if ($children->apply_status != "" && $children->apply_status != null) {
						$now = strtotime ( "now" );
						if ($now < $children->apply_start  && $children -> inherit_val == 0) {
							echo "<td  ><div><input  type='submit'  style='background-color: gray;color:#ffffff; cursor:pointer;'  value='申报未开始' disabled='disabled' /></div></td>";
						} else {
							// echo "<td><div><input type='submit' class='button' value=".$apply_status." onclick='getProject_id(".$children->dep_type.","."\"".$children->name."\"".");'/></div></td>";
							if ($children->apply_end != null && $now > $children->apply_end  && $children -> inherit_val == 0) {
								echo "<td><div><input  style='background-color: gray;color:#ffffff; cursor:pointer;' type='submit' class='button1'  value='申报已结束' disabled='disabled' /></div></td>";
							} else {
								switch ($children->dep_type) {
									
								    case 0 :
					                    echo "<td ><div align='center' ><input ".$color."  type='submit' class='button4' value=" . $apply_status . " onclick='getProject_id(". $children->id  . "," . "\"" . $stage . "\"" . ");' style='cursor:pointer;'/></div></td>";
								        break;
								    case 1 :
					                    echo "<td ><div align='center' ><input ".$color."  type='submit' class='button5' value=" . $apply_status . " onclick='getProject_id(". $children->id  . "," . "\"" . $stage . "\"" . ");'style='cursor:pointer;'/></div></td>";
								        break;
								    case 2 :
					                    echo "<td ><div align='center' ><input ".$color."  type='submit' class='button6' value=" . $apply_status . " onclick='getProject_id(". $children->id  . "," . "\"" . $stage . "\"" . ");'style='cursor:pointer;'/></div></td>";
								        break;
									default :
										echo "<td ><div align='center'><input  type='submit' class='button6' value='出问题啦！'";
								}
							}
						}
					} else {
						echo "<td></td>";
					}
					echo "</tr>";
				}
			}
		}
		?>
</table>

	</div>
	<div style="position: fixed; top:40px;right:20px; width: 160px;">
		<table width="" cellspacing="0">
			<tr>
				<td>发展计划科:</td>
				<td bgcolor="#0066FF"height=15px width=20px></td>
			</tr>
		</table>
		<p></p>
		<table width="">
			<tr>
				<td>科技综合科:</td>
				<td bgcolor="#33CCCC"height=15px width=20px ></td>
			</tr>
		</table>
		<p></p>
		<table width="">
			<tr>
				<td>知识产权科:</td>
				<td bgcolor="#FF9900" height=15px width=20px ></td>
			</tr>
		</table>
	</div>
</body>
</html>
