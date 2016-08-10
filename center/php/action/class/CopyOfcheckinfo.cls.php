<?php


class APPLY {
	
	function findchecklist($page, $rows, $department_type, $min, $max, $project_type, $classes){
    
		$status = '';
		$openStatus = '';
		$pstage = '';
		// 根据不同的参数 设置不同的条件
		
		if($classes==0){
			//全部
			$status='';
		
		}
		
		if ($classes == 1) {
			// 待审核 也就是审核中
			$status = 'and table_status =2';
		}
		if ($classes == 2) {
			// 待提交
			$status = 'and table_status =1';
		}
		if ($classes == 3) {
			// 中期开启
			$openStatus = '开启中期';
		}
		
		if ($classes == 4) {
			// 验收开启
			$openStatus = '开启验收';
		}
		// project_stage: 表格所属的项目阶段 int （1：立项，2：实施，3：验收 4项目存档
		if ($classes == 5) {
			// 存档项目
			//$pstage = 'and project_stage =4';
		    $openStatus = '项目存档';
		}
		
		$page = ($page - 1) * $rows;
		$db = new DB ();

		global $global_department;
		$department = $global_department[$department_type]['name'];
		$sql = "Select * from project_info where department = '$department' and project_type = '$project_type'  and isDelete = 0";
		// 		echo $sql;
		$result_table = $db->SelectOri ( $sql );
		$table_n = mysql_num_rows ( $result_table );
		
		$number = 0;
		$sqlCount = "select count(*) as 'count' from project_info where department = '$department' and project_type = '$project_type'  and isDelete = 0 ";
		// 分页 有待完善
		// $sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = ( array ) $db->select ( $sql );
		$count = $db->select ( $sqlCount );
		$count = $count [0] ['count'];
		$i = 0;
		foreach ( $result as $tmp ) {
			$project_id = $tmp ['project_id'];
			$project_stage = $tmp ['project_stage'];
			// 这里有project_stage
			$sql_table = "Select * from table_status where project_id = '$project_id' and project_stage = '$project_stage' " . $status;
			$sql_mid = "Select * from table_status where project_id = '$project_id' and table_name = 15";
			$sql_tz = "Select * from table_status where project_id = '$project_id' and table_name =14";
			$sql_ys = "Select * from table_status where project_id = '$project_id' and project_stage = 3";
			$result_ys = $db->Select($sql_ys);
			$result_mid = $db->GetInfo2 ( $project_id, 'table_status', 'project_id',15, 'table_name' );
			$result_tz = $db->GetInfo2 ( $project_id, 'table_status', 'project_id', 14, 'table_name' );
// 			echo $sql_table;
			$result_table = $db->SelectOri ( $sql_table );
			$table_n = mysql_num_rows ( $result_table );
			// $min = 100;
			for($j = 1; $j <= $table_n; $j ++) {
				$row_table = mysql_fetch_object ( $result_table );
				$open = $row_table->open;
				// if ($row_table->table_status > $min && $row_table->table_status < $max || $tmp ['project_stage'] == 3 || $tmp ['project_stage'] == 2) {
				if ($row_table->table_status==4|| $tmp ['project_stage'] == 4) {
					/* switch ($tmp ['project_stage']) {
						case 0 :
							$stage = "申报阶段";
							break;
						case 1 :
							$stage = "立项阶段";
							break;
						case 2 :
							$stage = "实施阶段";
							break;
						case 3 :
							$stage = "验收阶段";
							break;
					    case 4:
							$stage = "存档阶段";
							break;
						default :
							$stage = "状态出错";
							break;
					} */
				    global $global_project_stage;
				    $stage = $global_project_stage[$tmp ['project_stage']]['stage'];
					global $global_table_status;
					$condition = $global_table_status[$row_table->table_status]['status'];
						
					if ($tmp ['project_stage'] < 2) {
						$p_state = "未开启";
					} else if ($tmp ['project_stage'] == 2) {
						// 这里是判断是否有开启中期的按钮
						if ($result_mid ['open'] == 0) {
							$p_state = "开启中期";
						} else {
							// 这里是判断是否有开启验收阶段的按钮
							if ($result_tz ['table_status'] == 1 || $result_tz ['table_status'] == 4 || $result_tz ['table_status'] == 5) {
		
								if ($result_mid ['table_status'] == 4) {
									$p_state = "开启验收";
								}
							}
						}
					}else if($tmp ['project_stage'] == 3){
					    $returnVal = true;
					    foreach($result_ys as $item){
					        if($item['table_status'] != 4){
					            $returnVal = false;
					        }
					    }
					    if($returnVal){
					        
					    }
					}
					// 如果是按照开启中期 和验收进行分类的话 就要符合条件 一般是进不来这个判断条件的
					if ($classes == 3 || $classes == 4) {
						if ($openStatus == $p_state) {
							$typeList [$number] = array (
									'id' => $number + 1,
									'project_stage' => $stage,
									'project_status' => $condition,
									'zq' => $p_state,
									'project_id' => $tmp ['project_id'],
									'org_code' => $tmp ['org_code'],
									'name' => $tmp ['project_name']
							);
							$number = $number + 1;
							break;
						}
					} else if ($classes == 5) {
						if ($tmp ['project_stage'] == 4) {
							$typeList [$number] = array (
									'id' => $number + 1,
									'project_stage' => $stage,
									'project_status' => $condition,
									'zq' => $p_state,
									'project_id' => $tmp ['project_id'],
									'org_code' => $tmp ['org_code'],
									'name' => $tmp ['project_name']
							);
							$number = $number + 1;break;
						}
		
		
					}
					else{
						$typeList [$number] = array (
								'id' => $number + 1,
								'project_stage' => $stage,
								'project_status' => $condition,
								'zq' => $p_state,
								'project_id' => $tmp ['project_id'],
								'org_code' => $tmp ['org_code'],
								'name' => $tmp ['project_name']
						);
						$number = $number + 1;break;
					}
				}
			}
		}
		$typeJSON = '{"total":' . $count . ',"rows":' . json_encode ( $typeList ) . '}';
		
		echo $typeJSON;
		$db->Close ();
		
	}
	
	//当前的阶段是申报的阶段，则开始进行立项操作
	function showApproval($project_id,$stage){
	    //这里则用来判断当前的是否该项目的申报文件都为提交以上的状态。
	    $db = new DB();
	    $declare_sql = "select * from table_status where project_id = '$project_id' and project_stage = $stage";
// 	    echo $declare_sql;
	    $declare_result = $db -> Select($declare_sql);
	    $declare_status = 1;
	    foreach($declare_result as $item){
	        if($item['table_status'] < 2){
	            $declare_status = 0;
	        }
	    }
	    return $declare_status;
	}
    
	
	function checklistBystatus($page, $rows, $department_type, $min, $max, $project_type, $classes, $project_name, $project_id, $project_engineer,$leader_name, $start_time, $end_time) {
	    global $global_project_stage;
	    global $global_department;
	    
		$status = '';
		$openStatus = '';
		$pstage = '';
		// 根据不同的参数 设置不同的条件
	    $all='';
		  if($classes==0){
		 //全部
		 $status='';	
		 $all=true;
		 }
		
		if ($classes == 3) {
			// 中期开启
			$openStatus = '开启中期';
		}
		
		if ($classes == 4) {
			// 验收开启
			$openStatus = '开启验收';
		}
		if($classes == 5){
		    $openStatus = '项目存档';
		} 
	    
		$page = ($page - 1) * $rows;
		$db = new DB ();

		$department = $global_department[$department_type]['name'];
		$sql = "Select * from project_info a left join org_info b on a.org_code = b.org_code where a.department = '$department' and a.project_type = '$project_type'  and a.isDelete = 0 and a.is_save = 0";
		 if($start_time) {
			$start_time = strtotime($start_time." 00:00:00");
			$sql = $sql." and a.start_time <= $start_time";
		}
		if($end_time) {
			$end_time = strtotime($end_time." 00:00:00");
			$sql = $sql." and a.end_time >= $end_time";
		} 
		$sql = $this->generateSql($start_time, $sql, 'start');
		$sql = $sql. " and a.project_name like '%$project_name%' and a.project_id like '%$project_id%' and a.project_engineer like '%$project_engineer%' and b.linkman like '%$leader_name%'";
		$sql = $sql . ' limit ' . $page . ',' . $rows;

		$result_table = $db->SelectOri ( $sql );
		$table_n = mysql_num_rows ( $result_table );
		
	
		
		$number = 0;
		$sqlCount = "select count(*) as 'count' from project_info a left join org_info b on a.org_code = b.org_code where a.department = '$department' and a.project_type = '$project_type'  and a.isDelete = 0 and a.is_save = 0 ";
		if($start_time) {
			$start_time = strtotime($start_time." 00:00:00");
			$sqlCount = $sqlCount." and a.start_time <= $start_time";
		}
		if($end_time) {
			$end_time = strtotime($end_time." 00:00:00");
			$sqlCount = $sqlCount." and a.end_time >= $end_time";
		}
		$sqlCount = $sqlCount. " and a.project_name like '%$project_name%' and a.project_id like '%$project_id%' and a.project_engineer like '%$project_engineer%' and b.linkman like '%$leader_name%'";
		// 分页 有待完善
		
		$result = ( array ) $db->select ( $sql );
		$count = $db->select ( $sqlCount );
		$count = $count [0] ['count'];
		$i = 0;
		
		foreach ( $result as $tmp ) {
			$remain = 1;
			$project_id = $tmp ['project_id'];
			$project_stage = $tmp ['project_stage'];
			$org_code = $tmp['org_code'];
			$user_id = $tmp['user_id'];
			$declare_status = $this->showApproval($project_id,$project_stage);
			
			// 这里有project_stage
			$sql_table = "Select * from table_status where project_id = '$project_id' and project_stage = '$project_stage'";
 			$sql_mid = "Select * from table_status where project_id = '$project_id' and table_name =15";
			$sql_tz = "Select * from table_status where project_id = '$project_id' and table_name = 14";
			
/* 			//2016.01.09  david add 查询项目的查重状态
			$sql_check = "Select * from check_status where project_id = '$project_id' ";
			$result_isPass = $db -> Select($sql_check);
			$isPass = $result_isPass[0]['ispass']; */
			//2015.12.28
			
			
			$result_mid = $db->GetInfo2 ( $project_id, 'table_status', 'project_id', 15, 'table_name' );
			$result_tz = $db->GetInfo2 ( $project_id, 'table_status', 'project_id', 14, 'table_name' );
			$result_save = $db->GetInfo_save ( $project_id, 'table_status');
			$result_table = $db->SelectOri ( $sql_table );
			$table_n = mysql_num_rows ( $result_table );
			$min = 100;
			$condition='';
			
			$stage = $global_project_stage[$tmp ['project_stage']]['stage'];
			
			
			//获取org_name
			$sql1 = "Select * from org_info where org_code = '$org_code'";
			$res1 = $db->Select( $sql1 );
			$org_name = $res1[0]['org_name'];
			
			//获取leader_name leader_phone
			$sql2 = "Select * from login_info where id = '$user_id'";
			
			$res2 = $db->Select( $sql2 );
			$leader_name = $res1[0]['linkman'];
			$leader_phone = $res1[0]['linkman_contact'];
			
			if ($tmp ['project_stage'] < 2) {
				$p_state = "未开启";
			} else if ($tmp ['project_stage'] == 2) {
				// 这里是判断是否有开启中期的按钮
				if ($result_mid ['open'] == 0 && $result_mid != null) {
					$p_state = "开启中期";
				} else {
					// 这里是判断是否有开启验收阶段的按钮
				    $p_state = "开启验收";
				    $endtime = strtotime($tmp['project_end']." 23:59:59");
				    $remain_time = $endtime - time();
				    if($remain_time < 3600*24*3) {
				        $remain = 0;
				    }
					
				}
			} else if ($tmp ['project_stage'] == 3) {    //2015.12.13  怎加项目存档功能
				// 这里是判断是否有存档资格
				if ($result_save == "true") {
					$p_state = "项目存档";
				}
			}
			
			//这里是全查出来的情况;在之后加入查重的部分;
		    $result_recheck = $db->GetInfo1($project_id, 'check_status', 'project_id');
			$is_pass = $result_recheck['ispass'];
			$pdf_url = $result_recheck['pdf_url'];
			$project_type_id = $tmp['project_type'];
			$sql_recheck = "select * from project_check_relative where project_type_id = $project_type_id";
			$table_type = $db->Select( $sql_recheck );
			$sql_recheck = "Select * from table_status where project_id='$project_id'";
			$result_recheck = $db->Select($sql_recheck); 
			$recheck_min = 100;
			//$table_check  用来记录是否有表格处于待审核
			$table_check = 0;
			for($j = 1; $j <= $table_n; $j ++) {
				$row_table = mysql_fetch_object ( $result_table );
				$open = $row_table->open;
				// if ($row_table->table_status > $min && $row_table->table_status < $max || $tmp ['project_stage'] == 3 || $tmp ['project_stage'] == 2) {
				if($min > ($row_table -> table_status)){
					$min = $row_table -> table_status;
				}
				if($row_table->table_status == 2){
				    $table_check = 1;
				}
			}
			global $global_table_status;
			$condition = $global_table_status[$min]["status"];
			if ($classes == 3 || $classes == 4) {
				if ($openStatus == $p_state) {
					$typeList [$number] = array (
							'id' => $number + 1,
							'project_stage' => $stage,
							'project_stage_id'=>$tmp ['project_stage'],
							'zq' => $p_state,
							'project_id' => $tmp ['project_id'],
							'org_code' => $tmp ['org_code'],
							'name' => $tmp ['project_name'],
							'project_status' => $condition,
							'remain' => $remain,
							'open' => $result_mid ['open'],
					        'org_name' => $org_name,
    					    'leader_name'=> $leader_name,
    					    'leader_phone' =>$leader_phone,
					        'table_check' => $table_check,
					        'isPass' => $is_pass,
					        'declare_status' => $declare_status
					);
				 //查重部分;
					foreach ($result_recheck as $re_val){
					    foreach ($table_type as $ta_val){
					        if($re_val['table_name'] == $ta_val['table_type_id']){
					         if($recheck_min > $re_val['table_status']){
                                     $recheck_min = $re_val['table_status'];					                
					            }
					            $typeList[$number]['ispass'] = $is_pass;
					            $typeList[$number]['pdf_url'] = $pdf_url;
					        }
					    }
					}
					if($recheck_min > 1){ 
				      $typeList[$number]['is_recheck'] = true;
					}
					if($tmp ['project_stage'] == 0 && $min == 4) {
						$typeList[$number]['isopensave'] = 1;
					} else {
						$typeList[$number]['isopensave'] = 0;
					}
					if($tmp['project_stage'] == 5) {
						$typeList[$number]['savetobuild'] = 1;
					} else {
						$typeList[$number]['savetobuild'] = 0;
					}	
					$number = $number+1;
				}
			} else if ($classes == 5) {
				if ($tmp ['project_stage'] == 3 && $result_save) {
					$typeList [$number] = array (
							'id' => $number + 1,
							'project_stage' => $stage,
							'project_stage_id'=>$tmp ['project_stage'],
							'zq' => $p_state,
							'project_id' => $tmp ['project_id'],
							'org_code' => $tmp ['org_code'],
							'name' => $tmp ['project_name'],
							'project_status' => $condition,
							'remain' => $remain,
							'open' => $result_mid ['open'],
    					    'org_name' => $org_name,
    					    'leader_name'=> $leader_name,
    					    'leader_phone' =>$leader_phone,
					        'table_check' => $table_check,
					        'isPass' => $is_pass,
					        'declare_status' => $declare_status
					);
					
				 //查重部分;
					foreach ($result_recheck as $re_val){
					     foreach ($table_type as $ta_val){
					        if($re_val['table_name'] == $ta_val['table_type_id']){
					            if($recheck_min > $re_val['table_status']){
                                     $recheck_min = $re_val['table_status'];					                
					            }
					            $typeList[$number]['ispass'] = $is_pass;
					            $typeList[$number]['pdf_url'] = $pdf_url;
					        }
					    }
					} 
				    if($recheck_min > 1){ 
				        $typeList[$number]['is_recheck'] = true;
					}
					if($tmp ['project_stage'] == 0 && $min == 4) {
						$typeList[$number]['isopensave'] = 1;
					} else {
						$typeList[$number]['isopensave'] = 0;
					}
					if($tmp['project_stage'] == 5) {
						$typeList[$number]['savetobuild'] = 1;
					} else {
						$typeList[$number]['savetobuild'] = 0;
					}	
					$number = $number + 1;
				}
			} else if ($classes == 6) {
				if($tmp['project_stage'] == 5) {
					$typeList [$number] = array (
							'id' => $number + 1,
							'project_stage' => $stage,
							'project_stage_id'=>$tmp ['project_stage'],
							'zq' => $p_state,
							'project_id' => $tmp ['project_id'],
							'org_code' => $tmp ['org_code'],
							'name' => $tmp ['project_name'],
							'project_status' => $condition,
							'remain' => $remain,
							'open' => $result_mid ['open'],
    					    'org_name' => $org_name,
    					    'leader_name'=> $leader_name,
    					    'leader_phone' =>$leader_phone,
					        'table_check' => $table_check,
					        'isPass' => $is_pass,
					        'declare_status' => $declare_status
					);
					//查重部分;
					foreach ($result_recheck as $re_val){
					    foreach ($table_type as $ta_val){
					        if($re_val['table_name'] == $ta_val['table_type_id']){
					            if($recheck_min > $re_val['table_status']){
					                $recheck_min = $re_val['table_status'];
					            }
					            $typeList[$number]['ispass'] = $is_pass;
					            $typeList[$number]['pdf_url'] = $pdf_url;
					        }
					    }
					}
					if($recheck_min > 1){
					    $typeList[$number]['is_recheck'] = true;
					}
					
					if($tmp ['project_stage'] == 0 && $min == 4) {
						$typeList[$number]['isopensave'] = 1;
					} else {
						$typeList[$number]['isopensave'] = 0;
					}
					if($tmp['project_stage'] == 5) {
						$typeList[$number]['savetobuild'] = 1;
					} else {
						$typeList[$number]['savetobuild'] = 0;
					}	
					$number = $number + 1;
				}
			} else if ($classes == 1 || $classes == 2) {
				if($classes == $min) {
					$typeList [$number] = array (
							'id' => $number + 1,
							'project_stage' => $stage,
							'project_stage_id'=>$tmp ['project_stage'],
							'zq' => $p_state,
							'project_id' => $tmp ['project_id'],
							'org_code' => $tmp ['org_code'],
							'name' => $tmp ['project_name'],
							'project_status' => $condition,
							'remain' => $remain,
							'open' => $result_mid ['open'],
    					    'org_name' => $org_name,
    					    'leader_name'=> $leader_name,
    					    'leader_phone' =>$leader_phone,
					        'table_check' => $table_check,
					        'isPass' => $is_pass,
					        'declare_status' => $declare_status
					);
					
					 //查重部分;
					foreach ($result_recheck as $re_val){
					    foreach ($table_type as $ta_val){
					        if($re_val['table_name'] == $ta_val['table_type_id']){
					            if($recheck_min > $re_val['table_status']){
					                $recheck_min = $re_val['table_status'];
					            }
					            $typeList[$number]['ispass'] = $is_pass;
					            $typeList[$number]['pdf_url'] = $pdf_url;
					        }
					    }
					} 
				    if($recheck_min > 1){ 
				      $typeList[$number]['is_recheck'] = true;
					}
					if($tmp ['project_stage'] == 0 && $min == 4) {
						$typeList[$number]['isopensave'] = 1;
					} else {
						$typeList[$number]['isopensave'] = 0;
					}
					if($tmp['project_stage'] == 5) {
						$typeList[$number]['savetobuild'] = 1;
					} else {
						$typeList[$number]['savetobuild'] = 0;
					}	
					$number = $number + 1;
				}
			} else{
				$typeList [$number] = array (
						'id' => $number + 1,
						'project_stage' => $stage,
						'project_stage_id'=>$tmp ['project_stage'],
						'zq' => $p_state,
						'project_id' => $tmp ['project_id'],
						'org_code' => $tmp ['org_code'],
						'name' => $tmp ['project_name'],
						'project_status' => $condition,
						'remain' => $remain,
						'open' => $result_mid ['open'],
						'org_name' => $org_name,
						'leader_name'=> $leader_name,
						'leader_phone' =>$leader_phone,
				        'table_check' => $table_check,
				        'isPass' => $is_pass,
					    'declare_status' => $declare_status
				);
				
			 //查重部分;
				foreach ($result_recheck as $re_val){
				     foreach ($table_type as $ta_val){
				        if($re_val['table_name'] == $ta_val['table_type_id']){
				            if($recheck_min > $re_val['table_status']){
				                $recheck_min = $re_val['table_status'];
				            }
				            $typeList[$number]['ispass'] = $is_pass;
				            $typeList[$number]['pdf_url'] = $pdf_url;
				        }
				    }
				} 
    			if($recheck_min > 1){ 
			      $typeList[$number]['is_recheck'] = true;
				}
				if($tmp ['project_stage'] == 0 && $min == 4) {
					$typeList[$number]['isopensave'] = 1;
				} else {
					$typeList[$number]['isopensave'] = 0;
				}
				if($tmp['project_stage'] == 5) {
					$typeList[$number]['savetobuild'] = 1;
				} else {
					$typeList[$number]['savetobuild'] = 0;
				}	
				$number = $number + 1;
			}
		}
		if(!$typeList) {
			$typeList = array();;
		}
		$typeJSON = '{"total":' . $count . ',"rows":' . json_encode ( $typeList ) . '}';
	//	ob_clean();
		echo $typeJSON;
		$db->Close ();
	}
	
	
	function checklist($page, $rows, $department_type, $min, $max, $project_type, $classes,$project_name,$project_id,$project_engineer,$leader_name,$start_time,$end_time) {
		$this->checklistBystatus ( $page, $rows, $department_type, $min, $max, $project_type, $classes,$project_name,$project_id,$project_engineer,$leader_name,$start_time,$end_time );
	}
	function saveproject_info($project_id, $project_info, $project_time) {
		$db = new DB ();
		$db->UpdateData1 ( "project_info", $project_id, $project_info, "project_id" );
		// 获取 根据org_name 获取 org_code
		
		$org_name = $project_info ['org_name'];
		// 存储日期 是否需要把日期形式 转换成 1444909229 形式
		// print_r($project_time);
		$time ['apply_start'] = strtotime ( $project_time ['apply_start'] );
		$time ['apply_end'] = strtotime ( $project_time ['apply_end'] );
		// print_r($time);
		// 这里需要的不是 org_code 是类型
		$result = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
		$db->UpdateData1 ( "project_type", $result ['project_type'], $time, "name" );
		// $db->UpdateData1 ( "project_type", $project_id,$org_code, "project_id" );
		// 返回真
		echo json_encode ( array (
				"success" => 1 
		) );
		/*
		 * $db = new DB();
		 * // echo $project_id."hhaa";
		 * $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
		 * // echo $result['project_type']."1111";
		 * $result1 = $db->GetInfo1($result['org_code'], 'org_info', 'org_code');
		 * // echo $result['project_type']."hahah";
		 *
		 * $result2 = $db->GetInfo1($result['project_type'], 'project_type', 'name');
		 *
		 * $result3['project_start'] = date("Y-m-d", $result2['apply_start']);
		 * $result3['project_end'] = date("Y-m-d", $result2['apply_end']);
		 *
		 * $appJSON = array(
		 * 'project_name' => $result['project_name'],
		 * 'project_id' => $result['project_id'],
		 * 'tech_area' => $result['tech_area'],
		 * 'project_type' => $result['project_type'],
		 * 'project_engineer' => $result['project_engineer'],
		 *
		 * 'project_start' => $result3['project_start'],
		 * 'project_end' => $result3['project_end'],
		 *
		 * 'department' => $result['department'],
		 * // 'project_engineer' => $result['project_leader'],
		 *
		 * 'org_name' => $result1['org_name']
		 * );
		 * echo json_encode($appJSON);
		 *
		 */
		
		$db->Close ();
	}
}

?>