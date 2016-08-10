<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
?>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../modules/html/view/js/project/generate_devcode.js"></script>
<style type="text/css">
* {
	margin: 0px;
	padding: 0px;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.head img {
	margin-left: 20px;
	margin-top: 20px;
}
body {
	font-size: 14px;
}
img {
	border: none;
}
.content-div1 {
	height: 42px;
	width: 90%;
	border: 1px solid #CDCDCD;
	background-color: #F0F0F0;
	margin-left: 30px;
	margin-top: 15px;
}
.content-div7 {
	width: 95%;
	border: 1px solid #CDCDCD;
	background-color: #F0F0F0;
	margin-left: 30px;
	margin-top: 15px;
}
.content-div2 {
	height: auto;
	width: 95%;
	border: 1px solid #CDCDCD;
	background-color: #F0F0F0;
	margin-left: 30px;
}

.content ul {
	margin-left: 10px;
	margin-top: 8px;
	list-style-type: none;
}

.content ul li {
	display: inline-block;
	text-align: center;
	height: 28px;
	line-height: 28px;
	width: 123px;
	position: relative;
	margin-left: 8px;
	margin-bottom: 10px;
}

.content ul li a {
	text-decoration: none;
	font-size: 12px;
	font-weight: bold;
}

.l1 {
	background-image: url('../../img/新建项目.png');
}

.l1 a {
	color: white;
}

.l2 {
	background-image: url('../../img/申报.png');
}

table {
	border: 1px solid #1B63AB;
	margin-top: 10px;
	margin-left: 20px;
	margin: 10px 20px 30px 20px;
	background: url("../../img/灰条申报-2.png");
	top: 15px;
}

th {
	background-color: #78B5EC;
}

tr:nth-child(odd) {
	background-color: #D1E4F3;
}

tr:nth-child(even) {
	background-color: #EAF3FA;
}

td, th {
	border-right: 1px solid #A9CEEB;
	text-align: center;
}

tr {
	height: 30px;
}

.left {
	float: left;
}

.clearfix:after {
	clear: both;
	display: block;
	content: '';
	visibility: hidden;
	height: 0;
}
</style>
<script>
function change(obj){ 
	//判断是谁 把当前的设置为 可以显示  把其他的设置为隐藏
	if(obj==4){
		$('li').css('backgroundImage',"url('../../img/申报.png')");
		$('li a').css("color",'black');
		$('#li4').css('backgroundImage',"url('../../img/新建项目.png')");
		$('#li4 a').css("color",'white');
		$('#content-div0').css('display','none');
		$('#content-div1').css('display','none');
		$('#content-div2').css('display','none');
		$('#content-div3').css('display','none');
		$('#content-div6').css('display','none');
		$('#content-div4').css('display','block');
		}
	if(obj==0){
		$('li').css('backgroundImage',"url('../../img/申报.png')");
		$('li a').css("color",'black');                       
		$('#li0').css('backgroundImage',"url('../../img/新建项目.png')");
		$('#li0 a').css("color",'white');
		$('#content-div4').css('display','none');
		$('#content-div1').css('display','none');
		$('#content-div2').css('display','none');
		$('#content-div3').css('display','none');
		$('#content-div6').css('display','none');
		$('#content-div0').css('display','block');
		
		
		}
	if(obj==1){
		$('li').css('backgroundImage',"url('../../img/申报.png')");
		$('li a').css("color",'black');
		$('#li1').css('backgroundImage',"url('../../img/新建项目.png')");
		$('#li1 a').css("color",'white');
		$('#content-div0').css('display','none');
		$('#content-div4').css('display','none');
		$('#content-div2').css('display','none');
		$('#content-div3').css('display','none');
		$('#content-div6').css('display','none');
		$('#content-div1').css('display','block');
		}
	if(obj==2){
		$('li').css('backgroundImage',"url('../../img/申报.png')");
		$('li a').css("color",'black');
		$('#li2').css('backgroundImage',"url('../../img/新建项目.png')");
		$('#li2 a').css("color",'white');
		$('#content-div0').css('display','none');
		$('#content-div1').css('display','none');
		$('#content-div4').css('display','none');
		$('#content-div3').css('display','none');
		$('#content-div6').css('display','none');
		$('#content-div2').css('display','block');
		}
	if(obj==3){
		$('li').css('backgroundImage',"url('../../img/申报.png')");
		$('li a').css("color",'black');
		$('#li3').css('backgroundImage',"url('../../img/新建项目.png')");
		$('#li3 a').css("color",'white');
		$('#content-div0').css('display','none');
		$('#content-div1').css('display','none');
		$('#content-div2').css('display','none');
		$('#content-div4').css('display','none');
		$('#content-div6').css('display','none');
		$('#content-div3').css('display','block');
    }
	if(obj==6){
		$('li').css('backgroundImage',"url('../../img/申报.png')");
		$('li a').css("color",'black');
		$('#li6').css('backgroundImage',"url('../../img/新建项目.png')");
		$('#li6 a').css("color",'white');
		$('#content-div0').css('display','none');
		$('#content-div1').css('display','none');
		$('#content-div3').css('display','none');
		$('#content-div2').css('display','none');
		$('#content-div4').css('display','none');
		$('#content-div6').css('display','block');
     }
  }
</script>
<?php
function showlist($state) {
    global $global_project_stage;
    echo "
	<div>
		<table width='95%' cellspacing='0'>
			<tr>
			<th width='40px' name='id' align='center' >序号</th>
				<th width='400px' name='name' align='center' >项目名称</th>
				<th width='300px' name='start_end' align='center'>申报起止日期</th>
				<th width='80px'name='project_stage' align='center'>项目阶段</th>
				<th width='100px' name='status' align='center'>申报状态</th>
				<th width='80px' name='opinion' align='center'>受理</th>
					</tr>

	";
    // 待提交：立项：1，实施：2，验收：3，default:1（立项）
    $db = new DB ();
    $org_code = $_SESSION ['org_code'];
    $user_id = $_SESSION ['user_id'];
    unset($_SESSION['project_id']);
    if (! $state) {
        $state = 0;
    }
    if ($state != 4) {
        if($state==5){$state=$state-1;}

        $sql = "Select * from project_info where user_id = $user_id and  project_stage = '$state' and isDelete=0  order by create_time desc";
        if($state==6){$sql = "Select * from project_info where user_id = $user_id  and isDelete = 1   order by create_time desc";}
        if($state==7){$sql = "Select * from project_info where user_id = $user_id and  project_stage <> 4 and isDelete=0  order by create_time desc";}
        // 		echo $sql;
    } else {
        $sql = "select * from project_info where user_id = '$user_id' and  isDelete=0  order by create_time desc  ";
        // 		echo $sql;
    }
	//echo $sql;
    $result = $db->SelectOri ( $sql );
    $row_n = mysql_num_rows ( $result );
    for($i = 1; $i <= $row_n; $i ++) {
        echo "<tr>";
        $row = mysql_fetch_object ( $result );
        $project_id = $row->project_id;
        $project_stage = $row->project_stage;
        $project_type = $row->project_type;
        $sql_type = "Select * from project_type where id = '$project_type' ";
        $result_type = $db->SelectOri ( $sql_type );
        $row_type = mysql_fetch_object ( $result_type );
        $project_start = date ( 'Y/m/d', isset($row_type->apply_start) ? floatval($row_type->apply_start) : null);
        if($row_type->apply_end != null){
            $project_end = date ( 'Y/m/d', floatval($row_type->apply_end));
        }
        else{
            $project_end = null;
        }
        //开始加入查重的部分;
        $sql_recheck = "select * from check_status where project_id = '$project_id'";
        $result_recheck = $db->Select($sql_recheck);
        $flag = false;
        if(count($result_recheck)>0)
        {
            $flag = true;
        }
        if($flag){
            $ispass = $result_recheck['ispass'];
            $pdf_url = $result_recheck['pdf_url'];
        }
        // 		$project_end = date ( 'Y/m/d', floatval ( isset($row_type->apply_end) ? $row_type->apply_end : null) );
        echo "<td  >" . $i . "</td>";
        echo "<td >" . $row->project_name . "</td>";
        echo "<td  >" . $project_start . "--" . $project_end . "</td>";
        $stage = $global_project_stage[$project_stage]['stage'];
        if($row->project_stage == 1 && $row->is_check == 0){
            $stage = "申报阶段";
        } 
        echo "<td >" . $stage . "</td>";
        // 		echo $project_stage;
        $sql_table = "Select * from table_status where project_id = '$project_id' and project_stage = '$project_stage'";
        // 		echo $sql_table;
        // $result_table = mysql_query($sql_table,$conn);
        $result_table = $db->SelectOri ( $sql_table );
        $table_n = mysql_num_rows ( $result_table );
        $min = 100;
        for($j = 1; $j <= $table_n; $j ++) {
            $row_table = mysql_fetch_object ( $result_table );
            if($row_table ->table_status == 3){
                $min = 3;
                break;
            }
            if (($row_table->table_status) < $min) {
            //	if($min)
                $min = $row_table->table_status;
            }
        }
        if($row->isDelete==1){
            $condition = "审核未通过";
        }else{
            if(($row->project_stage == 0 && $min == 4) || ($row->project_stage == 1 && $row->is_check == 0)){
                $min = 2;
            }
            switch ($min) {
                case 1 :
                    $condition = "待提交";
                    break;
                case 2 :
                    $condition = "审核中";
                    break;
                case 3 :
                    $condition = "驳回修改";
                    break;
                case 4 :
                    $condition = "审核通过";
                    break;
                case 5 :
                    $condition = "审核未通过";
                    break;
                default :
                    if($row->project_stage==4){
                        $condition = "审核通过";
                    }
                    else if($row->project_stage==5){
                        $condition = "待审核";
                    }else{
                        $condition = "无状态 ";
                    }
                    break;
            }}
            //onmouseover=\"showPic(" . $min . ")\"  去掉了这个事件  wy
            echo "<td    onmouseout='cancelEvent()'>" . $condition . "</td>";
            echo "<div align='center' id = 'test'  ></div>";
            // echo "<td align='center' >" . $row->head_opinion . "</td>";
            $project_id = $row->project_id;
            // if(($row->project_condition) != 1){
             if(!$flag){
                    if($row->isDelete!=1){
                        if($row->project_stage == 5) {
                            echo "<td align='center'>无法处理</td>";
                        } 
                        else {
                            echo "<td align='center'><a href='#' style='text-decoration:none;' onclick='showDetail(";
                            echo "\"";
                            echo ( string ) $project_id;
                            echo "\"";
                            $res = null;
                                $sql = "SELECT table_status FROM table_status WHERE project_id = '$row->project_id' and project_stage = $row->project_stage and (table_status = 1 or table_status = 3)";
                                $res = $db->Select($sql);
							if(!empty($res) && $res != null ){
								if($project_stage == 1 && $row -> is_check == 0){
									echo ");'>受理中</a></td>";
								}else{
									echo ");'>填报中</a></td>";
								}
							}else{
								echo ");'>受理中</a></td>";
							}
                        }
                    }
                    else{
                        echo "<td align='center'><a href='#' style='text-decoration:none;' onclick='showDetail(";
                        echo "\"";
                        echo ( string ) $project_id;
                        echo "\"";
                        echo ");'>项目终止</a></td>";
                    }
                }
                else{ 
                    switch ($ispass){
                        case 0:
                            if($row->isDelete!=1){
                                if($row->project_stage == 5) {
                                    echo "<td align='center'>无法处理</td>";
                                }
                                else {
                                    echo "<td align='center'><a href='#' style='text-decoration:none;' onclick='showDetail(";
                                    echo "\"";
                                    echo ( string ) $project_id;
                                    echo "\"";
                                    $res = null;
                                        $sql = "SELECT table_status FROM table_status WHERE project_id = '$row->project_id' and project_stage = $row->project_stage and (table_status = 1 or table_status = 3)";
    							        $res = $db->Select($sql);
							       if(!empty($res) && $res != null){
							       	 if($row -> is_check == 0 && $project_stage == 1){
							       	 	echo ");'>受理中</a></td>";
							       	 }else{
							       	 	echo ");'>填报中</a></td>";
							       	 }
							       }else{
								     	echo ");'>受理中</a></td>";
							       }
                                }
                            }
                            else{
                                echo "<td align='center'><a href='#' style='text-decoration:none;' onclick='showDetail(";
                                echo "\"";
                                echo ( string ) $project_id;
                                echo "\"";
                                echo ");'>项目终止</a></td>";
                            }
                            break;
                            
                        case 1:
                            if($row->isDelete!=1){
                                if($row->project_stage == 5) {
                                    echo "<td align='center'>无法处理</td>";
                                }
                                else {
                                    echo "<td align='center'><a href='#' style='text-decoration:none;' onclick='showDetail(";
                                    echo "\"";
                                    echo ( string ) $project_id;
                                    echo "\"";
                                    $res = null;
                                        $sql = "SELECT table_status FROM table_status WHERE project_id = '$row->project_id' and project_stage = $row->project_stage  and (table_status = 1 or table_status = 3)";
    							        $res = $db->Select($sql);
							      if(!empty($res) && $res != null){
							      	if($row -> is_check == 0 && $project_stage == 1){
							      		echo ");'>受理中</a></td>";
							      	}else{
							      		echo ");'>填报中</a></td>";
							      	}
							     }else{
								    echo ");'>受理中</a></td>";
							     }
                                }
                            }
                            else{
                                echo "<td align='center'><a href='#' style='text-decoration:none;' onclick='showDetail(";
                                echo "\"";
                                echo ( string ) $project_id;
                                echo "\"";
                                echo ");'>项目终止</a></td>";
                            }
                            break;
                        case 2:
                            echo "<td align='center'>";
                            echo "<a href='$pdf_url' style='text-decoration:none;'>下载查重报告</a></td>";
                            break;
                    }
                }
            echo "</tr>";
    }
    echo "</table>
	</div>";
}	
?>
<div class="content">

		<div class="content-div7">
			<ul class="clearfix">
				<li id="li4" class="l1 left"><div  onclick="change(4)" style='cursor: pointer;   font-weight: bold;'>全部项目</div></li>
				<li id="li0" class="l2 left"><div onclick="change(0)" style='cursor: pointer;   font-weight: bold;'>申报阶段</div></li>
				<li id="li1" class="l2 left"><div onclick="change(1)" style='cursor: pointer;   font-weight: bold;'>立项阶段</div></li>
				<li id="li2" class="l2 left"><div onclick="change(2)" style='cursor: pointer;   font-weight: bold;'>实施阶段</div></li>
				<li id="li3" class="l2 left"><div onclick="change(3)" style='cursor: pointer;   font-weight: bold;'>验收阶段</div></li>
				<li id="li6" class="l2 left"><div onclick="change(6)" style='cursor: pointer;   font-weight: bold;'>未通过项目</div></li>
			</ul>
		</div>
		
		<div id="content-div4" class="content-div2">
			 <?php
				showlist ( 7 );
			 ?>
		</div>
		<div id="content-div0" class="content-div2" style="display: none">
			 <?php
				showlist ( 0 );
			 ?>
		</div>
		<div id="content-div1" class="content-div2" style="display: none">
			 <?php
				showlist ( 1 );
			 ?>
		</div>
		<div id="content-div2" class="content-div2"  style="display: none">
			<?php
				showlist ( 2 );
			 ?>
		</div>
		<div id="content-div3" class="content-div2" style="display: none">
			<?php
				showlist ( 3 );
			 ?>
		</div>
		<div id="content-div6" class="content-div2" style="display: none">
			<?php
				showlist ( 6 );
			 ?>
		</div>
	</div>
