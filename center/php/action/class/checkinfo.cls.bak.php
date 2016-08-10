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
	
	
	function generateSql($time,$sql,$flag){
        switch($flag){
            case 'start':
                if($time){
                    $time = strtotime($time." 00:00:00");
                    $sql = $sql." and a.start_time <= $time";
                }
                break;
            case 'end':
                if($time){
                    if($time) {
                        $time = strtotime($time." 00:00:00");
                        $sql = $sql." and a.end_time >= $time";
                    }
                }
                break;
        }
        return $sql;	    
	}
	
	
	//该阶段的查重文件是否都提交了
	//查重文件如果没有提交的话，不显示查重的任何信息
	//0:显示空的   1：不显示空
	function showBlank($project_id,$project_stage,$project_type){
	    $db = new DB();
	    $submit_status = 1;
	    $sql = "Select * from project_check_relative A JOIN (Select * from table_type where stage = $project_stage) B ON (A.table_type_id = B.id) where A.project_type_id = $project_type and A.status = 0 group by A.table_type_id";
// 	    echo $sql;exit();
	    $result = $db -> Select($sql);
	    $db->Close();
	    foreach($result as $item){
	        $db = new DB();
	        $table_result = $db -> GetInfo2($item['table_type_id'], 'table_status', 'table_name', $project_id, 'project_id');
	        if($table_result['table_status'] == 1){   //代表这个是未提交的状态
	            $submit_status = 0;
	        }
	    }
	    return $submit_status;
	}
	
	//查看查重结果    or  下载查重结果
	//0:查看查重结果  1：下载查重报告  -1：不需要查重，不显示任何查重信息  
	
	function showCheck($project_id,$project_stage,$project_type){
	    $db = new DB();
	    //这个还要分阶段进行查重的操作
	    $sql = "Select * from project_check_relative A JOIN (Select * from table_type where stage = $project_stage) B ON (A.table_type_id = B.id) where A.project_type_id = $project_type and A.status = 0 group by A.table_type_id";
// 	    echo $sql;exit();
        $sql_status = "Select * from project_check_relative where project_type_id = $project_type and status = 0 group by table_type_id";
//         echo $sql_status;exit();
/*         $sql_project = $db -> GetInfo($project_type, 'project_type');
        $prcessStage = $sql_project['attatch_name'];
        $prcessStageString = explode(",", $prcessStage); */
        $result_status = $db -> Select($sql_status);
	    $result = $db -> Select($sql);
	    /* foreach($result_status as $item){
	        if(in_array($item, $prcessStageString)){
	            
	        }
	    } */
	    
	    //如果该项目没有查重文件，或者该项目的该阶段没有查重文件，则不显示查重的任何信息
	    if(count($result_status) == 0){
	        return -1;
	    }else if(count($result_status) == 1 && $result_status[0]['table_type_id'] == 12 && $project_stage < 1){
	        return -1;
	    }else{
	        $checkInfo = $db->GetInfo1($project_id, 'check_status', 'project_id');
	        if($checkInfo != null && $checkInfo != ''){
	           /* if($project_stage != 0){
	               //查找该阶段的查重文件是不是都提交了
	               $submit_status = $this->showBlank($project_id,$project_stage,$project_type);
	               if($submit_status == 1){  //都提交了
	                   return $checkInfo['ispass'];
	               }else{
	                   return -1;
	               }
	           }else{
	               return $checkInfo['ispass'];
	           } */
	            
	            //去除了上面的判断当前阶段是否不为申报阶段，如果不为申报阶段则进行判断该项目 是否查重
	            $submit_status = $this->showBlank($project_id,$project_stage,$project_type);
	            if($submit_status == 1){  //都提交了
	                return $checkInfo['ispass'];
	            }else{
	                return -1;
	            }
	        } else {
	           return -1;
	        }
	    }
	    $db->Close();
	}
	

	//是否审核 or 查看  or 什么都不显示(如果所有的都是)                                                                                              
	function showCheckorlook($project_id,$project_stage){
	    $db = new DB();
	    $tableInfo_sql = "Select * from table_status where project_id = '$project_id' ";
	    $tableInfo_result = $db->Select($tableInfo_sql);
	    $check = 0;
	    $apply_table = 1;
	    foreach($tableInfo_result as $tableItem){
	        if($tableItem['table_status'] == 2){
	            $check = 1;
	        }
	        if($tableItem['project_stage'] == 0 && $tableItem['table_status'] > 1){
	            $apply_table = 0;
	        }
	    }
	    //如果是申报阶段，则需要做特殊判断
	    if($project_stage == 0 && $apply_table == 1){
	        $check = -1;
	    }
	    $db -> Close();
	    
	    return $check;
	    
	}
	
	//是否显示开启立项     //还有一个就是查重必须要通过才行
	//当前的阶段是申报的阶段，则开始进行立项操作
	function showApproval($project_id,$stage,$project_type){
	    //这里则用来判断当前的是否该项目的申报文件都为提交以上的状态。
	    $db = new DB();
	    $declare_status = 1;
	    $declare_sql = "select * from table_status where project_id = '$project_id' and project_stage = $stage";
	    $project_type_info = $db -> GetInfo($project_type, 'project_type');
	    if(!$project_type_info['setup_stage']){
	        $declare_status = 0;
	    }else{
	        if($stage != 0){
	            $declare_status = 0;
	        }else{
	            $declare_result = $db -> Select($declare_sql);
	            foreach($declare_result as $item){
	                if($item['table_status'] < 2){
	                    $declare_status = 0;
	                }
	            }
	            
	            //查重必须也要通过才行  //这个通过的话必须是该阶段的查重通过，如果是别的阶段则不需要判断这个
	            $checkStage = $this->checkStage($project_type);
// 	            echo "vv".$checkStage;exit();
	            if($checkStage == $stage){
	                $check_status = $db -> GetInfo1($project_id, 'check_status', 'project_id');
	                if($check_status != null){
	                    $pass_status = $check_status['ispass'];
	                    if($pass_status != 1){
	                        $declare_status = 0;
	                    }
	                }
	            }
	        } 
	    }
	    $db -> Close();
	    return $declare_status;
	}
	
	/*
	 * 判断在什么阶段进行查重操作
	 * 
	 */
	function checkStage($project_type){
	    $db = new DB();
	    $check_sql = "Select * from project_check_relative where project_type_id = $project_type and status = 0 group by table_type_id";
// 	    echo $check_sql;exit();
	    $check_table = $db -> Select($check_sql);
	    if(count($check_table) > 0){
	        if(count($check_table) == 1 && $check_table[0]['table_type_id'] == 12){
	            return 1;
	        }else{
	            return 0;
	        }
	    }else{  //不需要进行查重的操作
	        return -1;
	    }
	}
	
 	/*
	 * 是否开启储备
	 */
	function showStore($project_id,$project_stage,$project_type){
	    //return $this->showApproval($project_id,$project_stage,$project_type);
	    $db = new DB();
	    $store_status = 1 ;
	    if($project_stage != 0){
	        $store_status = 0;
	    }else if($project_type == 54 || $project_type == 53){
	        $store_status = 0;
	    }else{
	        $sql = "select * from table_status where project_id = '$project_id' and project_stage = $project_stage";
	        $result = $db->Select($sql);
	        foreach($result as $tmp){
	            if($tmp['table_status']!=4){
	                $store_status = 0;
	            }
	        }
	        $status = $this->showCheck($project_id,$project_stage,$project_type);
	        if($status == 0){
	            $store_status = 0;
	        }
	        
	    }
	    $db ->Close();
	    return $store_status;
	    
	} 
	

	//是否开中期
	//1.是否有实施阶段   2.当前是否处于实施阶段  3.是否有中期报告   4.中期报告是否处于关闭状态open为0的时候
	function showMiddle($project_id,$project_stage,$project_type){
	    $db = new DB();
	    $carry_status = 0;
	    $projectType_info = $db -> GetInfo($project_type, 'project_type');
	    if(!$projectType_info['carry_stage']){
	        $carry_status = 0;
	    }else{
	        if($project_stage != 2){
	            $carry_status = 0;
	        }else{
	            $middle_info = $db -> GetInfo2($project_id, 'table_status', 'project_id', 15, 'table_name');
	            if(!isset($middle_info)){
	                $carry_status = 0;
	            }else if(!$middle_info['open']){
	                $carry_status = 1;
	            }
	        }
	    }
	    $db -> Close();
	    return $carry_status;
	}
	//关闭验收撤销回退到上一步
	/**
	 * 
	 */
	function clearIsComplete($project_id,$table_name){
		$db=new DB();
		$sql="update table_status set iscomplete =''  where project_id='$project_id'  and  table_name ='$table_name' ";
		$db->Update($sql);
		$db->Close();
		
	}
	 function closeAccept($project_id){
	    $db = new DB();
	    $project_info = $db -> GetInfo1($project_id, 'project_info', 'project_id');
	    $project_type = $db -> GetInfo($project_info['project_type'],'project_type');
	    if($project_type['carry_stage'] == 1){
	        $sql = "update project_info set project_stage = 2 ,isclose=1  where project_id = '$project_id'";
	    }else if($project_type['setup_stage'] == 1){
	        $sql = "update project_info set project_stage = 1 ,isclose=1  where project_id = '$project_id'";
	    }else{
	        $sql = "update project_info set project_stage = 0 ,isclose=1  where project_id = '$project_id'";
	    }
	    $result = $db -> Update($sql);
	    $sql1 = "update table_status set table_status = 1 ,approval_opinion='' ,approval_time =''  where project_id = '$project_id' and project_stage = 3";
	    $result1 = $db -> Update($sql1);
	    $sql2 = "select * from table_status where project_id = '$project_id' and table_name = 14";
	    $result2 = $db->Select($sql2);
	    if($result2[0]['table_status']==6){
	        $sql = "update table_status set table_status = 1 where project_id = '$project_id' and table_name = 14";
	        $result3 = $db -> Update($sql);
	        $data['code'] = $result * $result1*$result3;
	    }
	    $data['code'] = $result * $result1;
	    
	    //判断是专利的还是其他类型的流程
	    
	    $res=$db->GetInfo1($project_id, "project_info", "project_id");
	    $project_type=$res["project_type"];
	    if($project_type==11){
	    //如果是专利
	    //项目负责人：职务 职称   project_principal  leader_job     tech_pos
	    //产品标准  ：check_material product_standard  identify_date host_org
	    //产品获奖情况：produce_award  ALL
	    //认证情况      check_material  quality_approve
	    //指标完成的情况  project_assessment ALL
	    //技术转让   tech_transfer  ALL
	    //合作建厂    co_construct  ALL
	    //市场开拓情况  check_material    market_open
	    //产品名称   produce ALL
	    //	开发新产品情况 check_material   :  tec_num  tec_hour  manage_num  manage_hour  total_class  total_person
	    //项目资金使用情况    48
	    //生产设备明细  equipment_list   ALL
	    //检测仪器  instrument_list  ALL
	    //房面积    check_material      factory_area  factory_sum  rebuild_area  rebuild_sum
	    //项目单位意见   check_material        org_suggest
	    //attach_list  附件表  subtable_id   24  25
	    // 工作报告：  47    46   45  44   42   43
	    //专利总决算表：  31
	    $db->Update("update project_principal   set leader_job='' , tech_pos=''  where project_id ='$project_id' ");
	    $SetNull=array(
	    		"final_opinion"=>null,
	    		"factory_area"=>null,
	    		"org_suggest"=>null,
	    		"factory_area"=>null,
	    		"factory_sum"=>null,
	    		"rebuild_area"=>null,
	    		"rebuild_sum"=>null,
	    		"tec_num"=>null,
	    		"tec_hour"=>null,
	    		"manage_hour"=>null,
	    		"manage_num"=>null,
	    		"total_class"=>null,
	    		"total_person"=>null,
	    		"market_open"=>null,
	    		"quality_approve"=>null,
	    		"product_standard"=>null,
	    		"identify_date"=>null,
	    		"host_org"=>null
	    );
	    $db->updateInfo4("check_material", "project_id", $project_id, $SetNull);
	    $db->DeleteAll($project_id,"produce_award");
	    $db->DeleteAll($project_id,"project_assessment");
	    $db->DeleteAll($project_id,"tech_transfer");
	    $db->DeleteAll($project_id,"co_construct");
	    $db->DeleteAll($project_id,"produce");
	    $db->DeleteBySub("table_data",$project_id,48);
	    $db->DeleteBySub("table_data",$project_id,42);
	    $db->DeleteBySub("table_data",$project_id,43);
	    $db->DeleteBySub("table_data",$project_id,44);
	    $db->DeleteBySub("table_data",$project_id,45);
	    $db->DeleteBySub("table_data",$project_id,46);
	    $db->DeleteBySub("table_data",$project_id,47);
	    $db->DeleteBySub("table_data",$project_id,31);
	    $db->DeleteAll($project_id,"equipment_list");
	    $db->DeleteAll($project_id,"instrument_list");
	    //删除附件
	    $db->DeleteBySub("attach_list",$project_id,24);
	    $db->DeleteBySub("attach_list",$project_id,25);
	    $this->clearIsComplete($project_id,24);
	    $this->clearIsComplete($project_id,25);
	    $this->clearIsComplete($project_id,26);
	    }
	    else{
	    //如果是其他的表
	    $db->Update("update project_info set zj_expert_opinion='' , zj_project_lzsj ='' where project_id ='$project_id' ");
	    $db->DeleteAll($project_id,"experts");
	    $db->DeleteBySub("table_data",$project_id,1954);
	    $db->DeleteAll($project_id,"project_summary");
	    $this->clearIsComplete($project_id,16);
	    $this->clearIsComplete($project_id,1);
	    $this->clearIsComplete($project_id,17);
	    $this->clearIsComplete($project_id,18);
	    
	    }
	    echo json_encode($data);
	    $db -> Close();
	} 
	
	//显示隐藏"开启验收"的按钮
	function showAccept($project_id,$project_stage,$project_type){
	    $adopt = 0;
	    $middle = 0;
	    $check_stage = 0;
	    $db = new DB();
	    $projectType_info = $db -> GetInfo($project_type, 'project_type');
	    $middle_info = $db -> GetInfo2($project_id, 'table_status', 'project_id', 15, 'table_name');
	    if(!$projectType_info['check_stage']){
	        $check_stage = 0;
	    }else if($projectType_info['carry_stage'] == 1){
	        if($project_stage != 2){
	            /* else if($projectType_info['apply_stage']==1 && $project_stage == 0){
	                $sql = "Select MIN(table_status) as Mintable_Status from table_status where project_id = '$project_id' and project_stage = $project_stage";
	                $result = $db -> Select($sql);
	                if($result[0]['Mintable_Status'] == 4){
	                    $check_stage = 1;
	                }else{
	                    $check_stage = 0;
	                }
	            } */
	            $check_stage = 0;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
	        }else if($middle_info['open'] == 0){
	            $check_stage = 1;
	        }else{
	            $sql = "select * from table_status where project_id = '$project_id' and project_stage = 2";
	            $result = $db -> Select($sql);
	            	
	            foreach($result as $tmp){
	                if($tmp['table_name'] == 15){
	                    if($tmp['table_status'] == 4){
	                        $middle = 1;
	                    }
	                }
	                if($tmp['table_name'] == 14){
	                    if($tmp['table_status']==1 || $tmp['table_status']==4){
	                        $adopt = 1;
	                    }
	                }
	            }
	            $check_stage = $adopt*$middle;
	        }
	    }else if($projectType_info['setup_stage'] == 1 && $project_stage == 1){
	                $sql = "Select MIN(table_status) as Mintable_Status from table_status where project_id = '$project_id' and project_stage = $project_stage";
	                $result = $db -> Select($sql);
	                if($result[0]['Mintable_Status'] == 4){
	                    $check_stage = 1;
	                }else{
	                    $check_stage = 0;
	                }
        }else if($projectType_info['apply_stage']==1 && $project_stage == 0){
            $sql = "Select MIN(table_status) as Mintable_Status from table_status where project_id = '$project_id' and project_stage = $project_stage";
            $result = $db -> Select($sql);
            if($result[0]['Mintable_Status'] == 4){
                $check_stage = 1;
            }else {
                $check_stage = 0;
            }
        }else{
            $check_stage = 0;
        }
	    $db -> Close();
	    return $check_stage;
	}
	
	//是否开启存档
	function showSaveFile($project_id){
	    $db = new DB();
	    $is_save = 1;
	    $is_saved = 1;
	    $talents = 0;
	    $sql = "select * from table_status where project_id = '$project_id' and project_stage = 3";
	    $result = $db -> Select($sql);
	    foreach ($result as $tmp){
	        if($tmp['table_status']!=4){
	             $is_save = 0;
	        }
	    }
	    $result = $db -> GetInfo1($project_id, 'project_info', 'project_id');
	    if($result['is_save'] == 1 && $result['project_stage'] == 4){
	        $is_saved = 0;
	    }
	    $is_save = $is_save * $is_saved;
	    //加入人才的判断;
	    $sql = "Select * from table_status where project_id = '$project_id' and (table_name = 19 OR table_name = 20)";
	    $result = $db -> Select($sql);
	    if(count($result)>0){
	        foreach($result as $tmp){
	            if($tmp['table_name'] == 19 || $tmp['table_name'] == 20){
	                if($tmp['table_status'] == 4){
	                    $talents = 1;
	                }
	            }
	        }
	        $is_save = $is_save * $talents;
	    }
	    $db -> Close();
	    return $is_save;
	}
	
	//是否变色
	function showColor($project_id){
	    $db = new DB();
	    $project_result = $db -> GetInfo1($project_id, 'project_info', 'project_id');
	    $end_time = $project_result['end_time'];
	    $between = ($end_time - strtotime("now")  ) / ((3600*24) * (30 * 2));
// 	    var_dump($between);exit;
	    $db -> Close();
	    if($between > 1){
	        return 0;
	    }else{
	        return 1;
	    }
	    
	}
	
/* 	//判断是否显示查重
	//如果有查重的文件我需要判断查重的内容有没有进行提交 ,这个应该也按照阶段来进行判断吗？
	function showBlank($project_type,$project_id,$project_stage){
	    $db = new DB();
	    if($project_stage != 0){
	        return 0;
	    }else{
	        $sql = "select * from project_check_relative where project_type_id = $project_type and status = 0  group by table_type_id";
	     
	    $result = $db -> Select($sql);
	    $submit = 1;
	    $db->Close();
	    foreach($result as $item ){
	        $table_status = $this->tableStatus($project_id, $item['table_type_id']);
	        if($table_status == 1 ){
	            return 0;
	        }
	    }
	       return 1;
	    }
// 	    $sql = "select * from project_check_relative where project_type_id = $project_type and status = 0 and table_type_id <> 12 group by table_type_id";
	    
	} */
	
	function projectList($sort,$order,$page,$rows,$project_type,$class){
	    $db = new DB();
	    global $global_project_stage;
	    global $global_table_status;
	    $page = ($page - 1) * $rows;
	    $sql_projectArray = "Select * from project_type where inherit_val = $project_type or id = $project_type";
	    if($class == 1){
	        $sql_projectArray = $sql_projectArray." and setup_stage = 1";
	    }
	    $projectArray_result = $db -> Select($sql_projectArray);
// 	    echo $sql_projectArray;exit;
	    foreach($projectArray_result as $item){
	        $array[] = $item['id'];
	    }
	    $arrayToString = implode(",", $array);
	    $arrayToString = "(" . $arrayToString . ")";
// 	    var_dump($array);exit();
    	    switch ($class){
    	        case 0: //全部内容
                    //$sql = "Select * from project_info where project_type = $project_type and project_stage < 4 and isDelete = 0 order by create_time desc";

					//$sql = "Select * from project_info where project_type IN $arrayToString and project_stage < 4 and isDelete = 0 and user_id <> 0 ";
//      				$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND project_type IN $arrayToString and project_stage = 0 and isDelete = 0 and user_id <> 0 ";
    	            $sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND project_type IN $arrayToString and isDelete = 0 and user_id <> 0 and project_stage < 4 ";
//
//            echo $sql;exit();
    	            break;
                case 1: //待立项
                    //$sql = "Select * from project_info where project_type IN $arrayToString and waitapproval = 1 and isDelete = 0 and user_id <> 0 ";
					$sql = "Select * from project_info where project_type IN $arrayToString and isDelete = 0 and user_id <> 0 and waitapproval = 1 and project_stage = 0 ";
					/* $sql = "SELECT * FROM project_info WHERE project_type IN $arrayToString AND project_id NOT IN (SELECT project_id FROM check_status) and project_stage = 0 and isDelete = 0 and user_id <> 0
                           UNION 
                           SELECT * FROM project_info b WHERE b.project_type IN $arrayToString AND b.project_id IN (SELECT project_id FROM check_status WHERE ispass = 1) and b.project_stage = 0 and b.isDelete = 0 and b.user_id <> 0 "; */
                    break;
                case 2://待审核
                  //$sql = "SELECT B.maxStatus,B.minStatus,project_info.* FROM project_info JOIN (SELECT project_id ,MAX(table_status) AS maxStatus ,MIN(table_status) AS minStatus FROM table_status GROUP BY project_id) B ON project_info.project_id = B.project_id WHERE B.maxStatus = $class AND project_info.isDelete = 0 AND project_info.project_type = $project_type AND B.maxStatus < 4 order by project_info.create_time desc";
//                  $sql = "SELECT B.maxStatus,B.minStatus,project_info.* FROM project_info JOIN (SELECT project_id ,MAX(table_status) AS maxStatus ,MIN(table_status) AS minStatus FROM table_status where project_stage <= project_info.project_stage GROUP BY project_id) B ON project_info.project_id = B.project_id WHERE B.maxStatus = $class AND project_info.isDelete = 0 AND project_info.project_type = $project_type AND B.maxStatus < 4 ";
     /*               $sql = "SELECT B.maxStatus,B.minStatus,project_info.* FROM project_info JOIN
                    (SELECT project_info.project_stage AS maxStage,table_status.project_id,MAX(table_status) 
                    AS maxStatus,MIN(table_status) AS minStatus 
                    FROM table_status,project_info 
                    WHERE project_info.project_id = table_status.project_id AND 
                    table_status.project_stage <= project_info.project_stage  
                    GROUP BY table_status.project_id) B ON project_info.project_id = B.project_id  
                    WHERE (B.maxStatus = $class OR B.minStatus = $class ) AND project_info.isDelete = 0 AND project_info.project_type IN $arrayToString and project_info.user_id <> 0 ";
//                     echo $sql;exit();
					*/
					$sql = "SELECT B.maxStatus,B.minStatus,project_info.*,org_info.org_code,org_info.org_name FROM org_info,project_info JOIN
                    (SELECT project_info.project_stage AS maxStage,table_status.project_id,MAX(table_status)
                    AS maxStatus,MIN(table_status) AS minStatus
                    FROM table_status,project_info
                    WHERE project_info.project_id = table_status.project_id AND
                    table_status.project_stage <= project_info.project_stage
                    GROUP BY table_status.project_id) B ON project_info.project_id = B.project_id
                    WHERE (B.maxStatus = $class OR B.minStatus = $class ) AND org_info.org_code = project_info.org_code AND project_info.isDelete = 0 AND project_info.project_type IN $arrayToString and project_info.user_id <> 0 AND project_info.project_stage < 4 ";
//                     echo $sql;exit();
                    break;
				case 3://中期开启
					//$sql = "SELECT project_info.*,B.* FROM project_info JOIN (SELECT * FROM table_status WHERE table_name = 15) B ON (B.project_id = project_info.project_id) WHERE project_info.project_stage = 2 AND B.open = 0 AND project_info.isDelete = 0 AND project_info.project_type = $project_type ";
					$sql = "SELECT project_info.*,B.*,org_info.org_code,org_info.org_name FROM org_info,project_info JOIN (SELECT * FROM table_status WHERE table_name = 15) B ON (B.project_id = project_info.project_id) WHERE org_info.org_code = project_info.org_code AND project_info.project_stage = 2 AND B.open = 0 AND project_info.isDelete = 0 AND project_info.project_type = $project_type and project_info.user_id <> 0 and project_info.project_stage < 4 ";
					break;
				case 4://验收开启
					//$sql = "SELECT project_info.* FROM project_info JOIN (SELECT * FROM table_status WHERE (table_name = 15 AND (`open` = 0 OR table_status = 4)) OR (table_name = 14 AND (`open` = 0 OR table_status = 5 OR table_status = 4))) B ON (B.project_id = project_info.project_id) WHERE project_info.project_stage = 2 AND project_info.isDelete = 0 AND project_info.project_type = $project_type order by project_info.create_time desc";
					//$sql = "SELECT project_info.* FROM project_info JOIN (SELECT * FROM table_status WHERE (table_name = 15 AND (`open` = 0 OR table_status = 4)) OR (table_name = 14 AND (`open` = 0 OR table_status = 5 OR table_status = 4))) B ON (B.project_id = project_info.project_id) WHERE project_info.project_stage = 2 AND project_info.isDelete = 0 AND project_info.project_type = $project_type and project_info.user_id != 0 ";
					// $sql = "SELECT * FROM project_info WHERE project_type IN $arrayToString AND project_stage = 2 AND isDelete = 0 AND user_id != 0 AND project_info.project_id IN (SELECT project_id FROM ((SELECT project_id,table_name modify_tab,table_status modify_status,OPEN modify_open FROM table_status WHERE table_name = 14 AND project_stage = 2 GROUP BY project_id) A JOIN (SELECT project_id middle_project_id,table_name middle_tab,table_status middle_status,OPEN middle_open FROM table_status WHERE table_name = 15 AND project_stage = 2 GROUP BY project_id) B ON A.project_id = B.middle_project_id) WHERE (modify_tab = 14 AND (modify_open = 0 OR modify_status = 1 OR modify_status = 4 OR modify_status = 5)) AND (middle_tab = 15 AND (middle_open = 0 OR middle_status = 4)))";
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND project_type IN $arrayToString AND project_stage = 2 AND isDelete = 0 AND user_id != 0 AND project_info.project_id IN (SELECT project_id FROM ((SELECT project_id,table_name modify_tab,table_status modify_status,OPEN modify_open FROM table_status WHERE table_name = 14 AND project_stage = 2 GROUP BY project_id) A JOIN (SELECT project_id middle_project_id,table_name middle_tab,table_status middle_status,OPEN middle_open FROM table_status WHERE table_name = 15 AND project_stage = 2 GROUP BY project_id) B ON A.project_id = B.middle_project_id) WHERE (modify_tab = 14 AND (modify_open = 0 OR modify_status = 1 OR modify_status = 4 OR modify_status = 5)) AND (middle_tab = 15 AND (middle_open = 0 OR middle_status = 4)))";

					break;
				case 5://存档项目
					//$sql = "SELECT B.maxStatus,B.minStatus,project_info.* FROM project_info JOIN (SELECT project_id ,MAX(table_status) AS maxStatus ,MIN(table_status) AS minStatus FROM table_status WHERE project_stage = 3 GROUP BY project_id) B ON project_info.project_id = B.project_id WHERE project_info.project_stage = 3 AND B.minStatus = 4 AND project_info.isDelete = 0 AND project_info.project_type = $project_type order by project_info.create_time desc";
					$sql = "SELECT B.maxStatus,B.minStatus,project_info.*,org_info.org_code,org_info.org_name FROM org_info,project_info JOIN
					(SELECT project_id ,MAX(table_status) AS maxStatus ,MIN(table_status) AS minStatus FROM table_status WHERE project_stage = 3 GROUP BY project_id)
					 B ON project_info.project_id = B.project_id
					 WHERE org_info.org_code = project_info.org_code AND project_info.project_stage = 3 AND B.minStatus = 4 AND project_info.isDelete = 0 AND project_info.project_type IN $arrayToString and project_info.user_id <> 0 ";
					break;
				case 6: //储存项目
					//$sql = "SELECT * from project_info where project_stage=5 and project_type = $project_type AND project_info.isDelete = 0 AND project_info.project_type = $project_type order by project_info.create_time desc";
					// $sql = "SELECT * from project_info where project_stage=5 and project_type IN $arrayToString AND project_info.isDelete = 0  and user_id <> 0 ";
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND project_stage=5 and project_type IN $arrayToString AND project_info.isDelete = 0  and user_id <> 0 ";


					break;
				case 10:  //项目待办
					//david 2016.01.18
					// 	            $sql = "SELECT * from project_info where project_stage > 0 and project_stage < 5 and project_type = $project_type AND project_info.isDelete = 0 order by project_info.create_time desc";
					//$sql = "SELECT * from project_info where project_stage < 4 and project_type = $project_type AND project_info.isDelete = 0 order by project_info.create_time desc";
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND project_stage < 4 and project_type IN $arrayToString AND project_info.isDelete = 0 and user_id <> 0 ";
					break;
				case 11: //权限待审
					//$sql = "SELECT * from project_info where is_check=0 and project_type = $project_type and isDelete = 0 order by project_info.create_time desc";
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND is_check = 0 and project_type IN $arrayToString and isDelete = 0 and project_stage = 1 and user_id <> 0 ";
					break;
				case 16:
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND project_type IN $arrayToString and isDelete = 0 and project_stage < 4 and user_id <> 0 ";
					break;
				case -1: //
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND isDelete = 1 and project_type IN $arrayToString and user_id <> 0 ";
					break;
				case 12:
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND  isDelete = 0 and project_stage = 0 and project_type IN $arrayToString and user_id <> 0 ";
					break;
				case 13:
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND isDelete = 0 and project_stage = 1 and project_type IN $arrayToString and user_id <> 0 ";
					break;
				case 14:
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND isDelete = 0 and project_stage = 2 and project_type IN $arrayToString and user_id <> 0 ";
					break;
				case 15:
					$sql = "Select project_info.*,org_info.org_code,org_info.org_name from project_info ,org_info  where org_info.org_code = project_info.org_code AND isDelete = 0 and project_stage = 3 and project_type IN $arrayToString and user_id <> 0 ";
					break;
			}
		// 	    echo $sql;
//     	    var_dump($sql);exit();
		if(!Pri::instance()->admin_tag && !Pri::instance()->is_special){
			$sql .= "and (project_info.id in(".$this->getIdsAvail($db).") or project_info.project_type in(".$this->getPtidAvail($db).")) ";
		}
// 		echo $sql;exit();
		if(!empty($_REQUEST['sort'])){
		    $asc_field = $_REQUEST['sort'];
		    if($asc_field == "name"){
		        $asc_field = "project_name";
		    }
		    
		    if($asc_field == "leader_name"){
		        $asc_field = "linkman";
		    }
		    
		    $asc_tag = "asc";
		    if(!empty($_REQUEST['order'])){
		        $asc_tag = $_REQUEST['order'];
		    }
		    $sql = $sql." order by {$asc_field} {$asc_tag}";
		}else{
		    $sql = $sql." order by project_info.create_time desc";
		}
 		//   echo $sql;
	    $count = count($db -> Select($sql));
	    if($page > $count){
	        $page = 0;
	    }
        $sql = $sql .  " limit " . $page . "," . $rows;         
//         echo $sql;exit();
	    $projectList_result = $db -> Select($sql);
	    $db ->Close();
	    $projectCount = 0;
	    if(count($projectList_result) > 0){
    	    foreach($projectList_result as $project_item){
    	        //首先将一些基础的数据存入进去
    	        //项目联系人信息
    	        $db = new DB();
    	        $leaderInfo = $db -> GetInfo($project_item['user_id'], 'login_info');
    	        //公司信息
    	        $org_info = $db -> GetInfo1($project_item['org_code'], 'org_info', 'org_code');
    	        //查重信息
    	        $check_result = $db -> GetInfo1($project_item['project_id'], 'check_status', 'project_id');
    	        //select project leader
    	        $leader=$db -> GetInfo1($project_item['project_id'], 'project_principal', 'project_id');
    	        //查询table_status的方法
    	        $db -> Close();
    	        $project_status = $this->projectOverAllStatus($project_item['project_id'],$project_item['project_stage']);
				if($project_item['is_check'] == 0 && $project_item['project_stage'] == 1){
					$project_status = 7;
				}
                $typeList[$projectCount] = array(
                    'id' => $projectCount + 1,
                    'project_id' => $project_item['project_id'],
                    'project_stage'=> $global_project_stage[$project_item['project_stage']]['stage'],
					'stage_val'=>$project_item['project_stage'],
                    'org_code' => $project_item['org_code'],
                    'name' => $project_item['project_name'],
                    'project_status' => $global_table_status[$project_status]['manageStatus'],
                    'leader_name'=> $project_item['linkman'],
                    'leader_phone' => $project_item['linkman_contact'],
                    'org_code' => $project_item['org_code'],
                    'org_name' => $org_info['org_name'],
    				'is_check'=>$project_item['is_check'],
    				'is_ownPri'=>$this->checkOwner($project_item['project_engineer'],$project_item['project_id']),
    				'is_owner'=>($project_item['project_engineer']==$_SESSION['realname'])?1:0,
                    'pdf_url' => $check_result['pdf_url'],
                    'isDelete' => $project_item['isDelete'],
                    'project_engineer' => $project_item['project_engineer'],
    				'delegate_engineer' => $this->checkDelegate($project_item['project_id']),
                    //0:查看查重报告，1：下载查重报告
                    'showCheck' => $this->showCheck($project_item['project_id'],$project_item['project_stage'],$project_item['project_type']),
                    //0：查看，1：审核,-1 ：不显示查看或者审核的任何一个
                    'showCheckorlook' => $this->showCheckorlook($project_item['project_id'],$project_item['project_stage']),
                    //开启储备
                    'showStore' => $this->showStore($project_item['project_id'], $project_item['project_stage'], $project_item['project_type']),
                    //开启立项
                    'showDeclare' => $this->showApproval($project_item['project_id'], $project_item['project_stage'], $project_item['project_type']),
                    //开启中期
                    'showMiddle' => $this->showMiddle($project_item['project_id'], $project_item['project_stage'], $project_item['project_type']),
                    //开启验收
                    'showAccept' => $this-> showAccept($project_item['project_id'], $project_item['project_stage'],  $project_item['project_type']),
                    //存档
                    'showSaveFile' => $this->showSaveFile($project_item['project_id']),
                    //是否显示变色
                    'changeColor' => $this->showColor($project_item['project_id']),
                    //显示空的界面
//                     'showBlank' => $this->showBlank($project_item['project_id'],$project_item['project_stage'],$project_item['project_type'])
//                     'showBlank' => $this->showBlank($project_item['project_type'],$project_item['project_id'],$project_item['project_stage'])
                );
                $projectCount ++;
    	     }
	    }
	    //判断是不是人才$project_type
	   /*  $db=new DB();
	    $res= $db->GetInfo1($project_type,"project_info","project_type");
	    if($res["attach_name"]==19){
	    	
	    } */
	    if($projectCount == 0){
	        $typeList = array();
	    }
	    $typeJSON = '{"total":' . $count . ',"rows":' . json_encode ($typeList) . '}';
	    echo $typeJSON;
	}
	//恢复项目;
	function recoverProject($project_id){
	    $db = new DB();
	    $result_pro = 0;
	    $result_tab = 0;
	    $sql = "update project_info set isDelete = 0 where project_id = '$project_id'";
	    if($db->Update($sql)){
	        $result_pro = 1;
	    }
	    $sql = "Select count(id) as count from table_status where project_id = '$project_id' and table_status = 5";
	    $result = $db->Select($sql);
	    if(empty($result[0]['count'])){
	        $data['code'] = $result_pro;
	    }else{
	        $sql = "update table_status set table_status = 2 where project_id = '$project_id' and table_status = 5";
	        if($db->Update($sql)){
	            $result_tab = 1;
	        }
	        $data['code'] = $result_pro * $result_tab;
	    }
	    $sql="update check_status  set   ispass=0  , pdf_url='' ,rate=0 ,opinion='' ,check_time='',html='',report='',array_sections='',array_paras='' ";
	    $db->Update($sql);
	    echo json_encode($data);
	    $db->Close();
	}
	//筛选数据;
	function filterData($page,$rows,$project_type,$project_name, $leader_name,$project_id,$project_engineer,$start_time,$end_time,$department){
	    $db = new DB();
	    global $global_project_stage;
	    global $global_table_status;
	    global $global_department;
	    
	    $page = ($page - 1) * $rows;
	   
	    $sql = "Select * from project_info a left join (select login_info.realname,org_info.* from org_info,login_info where org_info.org_code = login_info.org_code) b on a.org_code = b.org_code where a.isDelete = 0 and a.is_save = 0";
	    $sql = $this->generateSql($start_time, $sql, 'start');
	    $sql = $this->generateSql($end_time, $sql, 'end');
	    if(!empty($project_name)||$project_name != null){
	        $sql = $sql. " and a.project_name like '%$project_name%'";
	    } 
	    if(!empty($project_id)||$project_id != null){
	        $sql = $sql." and a.project_id like '%$project_id%'";
	    } 
	    if(!empty($project_engineer)||$project_engineer != null){
	        $sql = $sql." and a.project_engineer like '%$project_engineer%'";
	    }
	    if(!empty($leader_name)||$leader_name != null){
	        $sql = $sql." and b.realname like '%$leader_name%' or a.linkman like '%$leader_name%'";
	    }
	    if(!empty($project_type)|| $project_type != null){
	        $sql = $sql." and a.project_type = $project_type";
	    } 
	    if(!empty($department) || $department != null){
	        if($department != -1){
	            $department = $global_department[$department]['name'];
	            $sql = $sql." and a.department = '$department'";
	        }
	    }
	    $sql = $sql."  group by a.project_id";
	    $count = count($db -> Select($sql));
	    $sql = $sql .  " limit " . $page . "," . $rows;
	    $projectList_result = $db -> Select($sql);
	    $db ->Close();
	    $projectCount = 0;
	    foreach($projectList_result as $project_item){
	        //首先将一些基础的数据存入进去
	        //项目联系人信息
	        $db = new DB();
	         
	        $leaderInfo = $db -> GetInfo($project_item['user_id'], 'login_info');
	        //公司信息
	        $org_info = $db -> GetInfo1($project_item['org_code'], 'org_info', 'org_code');
	        //查重信息
	        $check_result = $db -> GetInfo1($project_item['project_id'], 'check_status', 'project_id');
	        //select project leader
	        $leader=$db -> GetInfo1($project_item['project_id'], 'project_principal', 'project_id');
	        //查询table_status的方法
	        $db -> Close();
	        $project_status = $this->projectOverAllStatus($project_item['project_id'],$project_item['project_stage']);
			if($project_item['is_check'] == 0 && $project_item['project_stage'] == 1){
				$project_status = 7;
			}
	        $typeList[$projectCount] = array(
	            'id' => $projectCount + 1,
	            'project_id' => $project_item['project_id'],
	            'project_stage'=> $global_project_stage[$project_item['project_stage']]['stage'],
	            'org_code' => $project_item['org_code'],
	            'name' => $project_item['project_name'],
	            'project_status' => $global_table_status[$project_status]['manageStatus'],
	            'leader_name'=> $leaderInfo['realname'],
	            'leader_phone' => $leaderInfo['phone'],
	            'org_code' => $project_item['org_code'],
	            'org_name' => $org_info['org_name'],
	            'is_check'=>$project_item['is_check'],
	            'is_ownPri'=>$this->checkOwner($project_item['project_engineer'],$project_item['project_id']),
	            'is_owner'=>($project_item['project_engineer']==$_SESSION['realname'])?1:0,
	            'pdf_url' => $check_result['pdf_url'],
	            'project_engineer' => $project_item['project_engineer'],
	            'delegate_engineer' => $this->checkDelegate($project_item['project_id']),
	            //0:查看查重报告，1：下载查重报告
	            'showCheck' => $this->showCheck($project_item['project_id'],$project_item['project_stage'],$project_item['project_type']),
	            //0：查看，1：审核
	            'showCheckorlook' => $this->showCheckorlook($project_item['project_id'],$project_item['project_stage']),
	            //开启储备
	            'showStore' => $this->showStore($project_item['project_id'], $project_item['project_stage'], $project_item['project_type']),
	            //开启立项
	            'showDeclare' => $this->showApproval($project_item['project_id'], $project_item['project_stage'], $project_item['project_type']),
	            //开启中期
	            'showMiddle' => $this->showMiddle($project_item['project_id'], $project_item['project_stage'], $project_item['project_type']),
	            //开启验收
	            'showAccept' => $this-> showAccept($project_item['project_id'], $project_item['project_stage'],  $project_item['project_type']),
	            //存档
	            'showSaveFile' => $this->showSaveFile($project_item['project_id']),
	            //是否显示变色
	            'changeColor' => $this->showColor($project_item['project_id']),
	        );
	        $projectCount ++;
	    }
	    if($projectCount == 0){
	        $typeList = array();
	    }
	    $typeJSON = '{"total":' . $count . ',"rows":' . json_encode ($typeList) . '}';
	    echo $typeJSON;
	}
	//获取当前项目状态,和前台不同的是后台显示项目状态的时候应该按照最新的状态来显示。
	//如果是全部都审核通过的状态则显示审核通过，否则只有一个审核通过不算的
	//只要有一个为审核不通过的状态则，这个项目就是审核不通过的状态。
	//还有对于6的状态来说是不行的。不可以在状态栏出现这个状态。
	function projectOverAllStatus($project_id,$project_stage){
        $db = new DB();
        global $global_table_status;
//         $projectTable_statue_sql = "Select * from table_status where project_id = '$project_id' and project_stage = $project_stage";
        $projectTable_statue_sql = "Select * from table_status where project_id = '$project_id' and project_stage = $project_stage";
        
        $projectTable_statue_result = $db -> Select($projectTable_statue_sql);
        
        $max = -1;
        $noPass = false;
        $pass = true;
        foreach($projectTable_statue_result as $tableStatus_item){
            //用来判断除了6以外的最大值
            if($tableStatus_item['table_status'] > $max && $tableStatus_item['table_status'] < 4 ){
                $max = $tableStatus_item['table_status'];
            }
            //判断当前是否所有的
            if($tableStatus_item['table_status'] != 4){
                $pass = false;
            }
            if($tableStatus_item['table_status'] == 5){
                $noPass = true;
            }
            
        }
        $db -> Close();
        if($pass){
            return 4;
        }else if($noPass){
            return 5;
        }else{
            return $max;
        }
	}
	
	function tableStatus($project_id,$table_id){
	    $db = new DB();
	    $tableStatus_result = $db -> GetInfo2($project_id, 'table_status', 'project_id', $table_id, 'table_name');
	    return $tableStatus_result['table_status'];
	    $db->Close();
	}

	function getPtidAvail($db){

		/*
		 * 根据项目类型来获取适配类型
		 * */
		$ptids = Pri::instance()->get_all_ptids();
		$ptid_str = null;
		$ret = array();
		//赋予一个默认值  
		$ret[] = '-1';
		foreach($ptids as $val){
			$ret[] = "'".$val."'";
		}

		$ptid_str = implode(',',$ret);
		
		
		
		return $ptid_str;

	}


	function getIdsAvail($db){
		$realname = $_SESSION['realname'];
		$user_id = $_SESSION['user_id'];
		/**
		 *  获取适配项目
		 */
		$sql = "select id,project_id from pro_check_user_list where admin_info_id={$user_id}";

		$result = ( array ) $db->select ( $sql );

		$result[] = 0;
		$ret_str = implode(',',$result);
		$ret = array();
		foreach($result as $val){
			$ret[] = "'".$val['project_id']."'";
		}
		$ret_str = implode(',',$ret);

		$sql = "select id,project_type from project_info where project_engineer='{$realname}' or project_id in ({$ret_str})";
//         echo $sql;exit();
		$result = ( array ) $db->select ( $sql );
		$ret = array();

		foreach($result as $val){
		    if(!empty($val['id'])){
		        $ret[] = $val['id'];
		    }
		}

		$id_str = implode(',',$ret);
		return $id_str;

	}

	function checkOwner($engineer,$project_id = ""){

		$db_conn = new DB ();

		$is_owner = $engineer == $_SESSION['realname']?1:0;

		if($_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3){
		    if($_SESSION['department'] != 3)
			 $is_owner = 1;
		}

		if(!$is_owner){
			$sql = "select * from pro_check_user_list where project_id='{$project_id}' and admin_info_id={$_SESSION['user_id']}";

			$ret = $db_conn->Select($sql);

			if($ret){
				$is_owner = 1;
			}
		}
		
		$db_conn -> Close();
		return $is_owner;
		
	}
	
	function checkDelegate($project_id){
		
		$db_conn = new DB ();
		
		$users = "";
		
		$sql  = "select group_concat(b.realname) as gc_name  from pro_check_user_list as a join admininfo as b on(a.admin_info_id=b.id)
    	where project_id = '{$project_id}'";
		//echo $sql;exit;
		$ret = $db_conn->Select($sql);
		if($ret == false){
			$db_conn = new DB ();
			$ret = $db_conn->Select($sql);
			$db_conn -> Close();
		}
		$users = $ret[0]['gc_name'];
		
		$db_conn -> Close();
		return $users;
		
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
		
		$db->Close ();
	}
	
	function unfoldTree($index,$project_type){
	    switch ($_SESSION['department']){
	        case 0:
	            $dep = '发展计划科';
	            break;
	        case 1:
	            $dep = '科技综合科';
	            break;
	        case 2:
	            $dep = '知识产权科';
	            break;
	        default:
	            $dep = $_SESSION['department'];
	            break;
	    }
	   // print_r('department为'.$_SESSION['department']);
	    $db = new DB();
	    switch($index){
	        case 5:
	            if($_SESSION['department'] != -1){
	                $sql = "Select distinct store_year from project_info where project_stage = 5 and department = '$dep' and project_type = $project_type";
	            }else{
	                $sql = "Select distinct store_year from project_info where project_stage = 5 and project_type = $project_type";
	            }
	            $result = $db -> Select($sql);
	            $i = 0;
	            foreach($result as $k => $v){
	                if(isset($v['store_year'])){
	                    $childJson[$i] = array(
	                        'id' => $i,
	                        'text' => $v['store_year'],
	                        'state' => "open",
	                    );
	                    $i++;
	                }
	            }
	            if(!count($childJson)){
	                $childJson[0] = array(
	                    'id'=>0,
	                    'text'=>"当前没有项目",
	                    'state'=>"colse",
	                );
	            }
	            $treeJson[0] = array(
	                'id'=>0,
	                'text'=>"储存项目",
	                'state'=>"open",
	                'children'=>$childJson
	            );
	            break;
	        case 1:
	            if($_SESSION['department'] != -1){
	                $sql = "Select distinct nopass_year from project_info where isDelete = 1 and department = '$dep' and project_type = $project_type";
	            }else{
	                $sql = "Select distinct nopass_year from project_info where isDelete = 1 and project_type = $project_type";
	            }
	            $result = $db -> Select($sql);
	            $j = 0;
	            foreach($result as $k => $v){
	                if(isset($v['nopass_year'])){
	                    $childJson[$j] = array(
	                        'id' => $j,
	                        'text' => $v['nopass_year'],
	                        'state' => "open",
	                    );
	                    $j ++;
	                }
	            }
	            if(!count($childJson)){
	                $childJson[0] = array(
	                    'id'=>0,
	                    'text'=>"当前没有项目",
	                    'state'=>"close",
	                );
	            }
	            $treeJson[0] = array(
	                'id'=>0,
	                'text'=>"未通过项目",
	                'state'=>"open",
	                'children'=>$childJson
	            );
	            break;
	    }
	    
	 //   var_dump($result);
	    $db -> Close();
	    // var_dump($treeJson);
	    //var_dump($treeJson);
	    echo json_encode($treeJson);
	}
	 
	/* function childData($year,$index){
	    $user_type = $_SESSION['user_type'];
	//    print_r('用户类型为'.$user_type);
	    $ptid_str = Pri::instance()->get_check_ptids(4,true);
	    switch ($_SESSION['department']){
	        case 0:
	            $dep = '发展计划科';
	            break;
	        case 1:
	            $dep = '科技综合科';
	            break;
	        case 2:
	            $dep = '知识产权科';
	            break;
	        default:
	            $dep = $_SESSION['department'];
	            break;
	    }
	    $db = new DB();

	    switch($index){
	        case 5:
	            if($_SESSION['department']!=-1){
	                $sql = "Select * from project_info where department = '$dep' and project_stage = 5 and store_year = $year and project_type in (select id from project_type where inherit_val = 0) group by project_type";
	            }else{
	                $sql = "Select * from project_info where project_stage = 5 and store_year = $year group by project_type";
	            }
	            break;
	        case 1:
	            if($_SESSION['department']!=-1){
	                $sql = "Select * from project_info where department = '$dep' and isDelete = 1 and nopass_year = $year and project_type in (select id from project_type where inherit_val = 0) group by project_type";
	            }else{
	                $sql = "Select * from project_info where isDelete = 1 and nopass_year = $year group by project_type";
	            }
	            break;
	    }
	    $result = $db -> Select($sql);
	    if($user_type != 3){
	        $department = $_SESSION['department'];
	        $project_type_sql = "select * from project_type where dep_type = $dep and inherit_val = 0";
	        if($user_type !=2 ){
	            $project_type_sql .= " and id in ({$ptid_str})";
	        }
	    }else{
	        $project_type_sql = "select * from project_type where dep_type > -1";
	    }
	    $project_type = $db -> Select($project_type_sql);
	    $i = 0;
	    foreach($project_type as $tmp){
	        foreach ($result as $temp){
	            if($temp['project_type'] == $tmp['id']){
	                $childrenJson[$i] = array(
	                    'id'=>$tmp['id'],
	                    'text'=>$tmp['name'],
	                    'checked'=>false,
	                );
	                $i ++;
	            }
	        }
	    }
	    return $childrenJson;
	    $db -> Close();
	} */
	
	function findTreeData($page,$rows,$project_type,$year,$project_stage){
	    $db = new DB();
	    switch ($_SESSION['department']){
	        case 0:
	            $dep = '发展计划科';
	            break;
	        case 1:
	            $dep = '科技综合科';
	            break;
	        case 2:
	            $dep = '知识产权科';
	            break;
	        default:
	            $dep = $_SESSION['department'];
	            break;
	    }
	    global $global_project_stage;
	    global $global_table_status;
	    $page = ($page - 1) * $rows;
	    $sql_projectArray = "Select * from project_type where inherit_val = $project_type or id = $project_type";
	    $projectArray_result = $db -> Select($sql_projectArray);
	    foreach($projectArray_result as $item){
	        $array[] = $item['id'];
	    }
	    $arrayToString = implode(",", $array);
	    $arrayToString = "(" . $arrayToString . ")";
	    switch($project_stage){
	        case 5:
	            if($dep != -1){
	                $sql = "Select * from project_info where project_stage = $project_stage  and project_type in $arrayToString and store_year = $year and department = $dep AND project_info.isDelete = 0  and user_id <> 0 order by create_time desc";
	            }
	            $sql = "Select * from project_info where project_stage = $project_stage and project_type in $arrayToString and store_year = $year AND project_info.isDelete = 0  and user_id <> 0 order by create_time desc";
	            break;
	        case 1:
	            if($dep != -1){
	                $sql = "Select * from project_info where project_type in $arrayToString and nopass_year = $year and department = $dep AND isDelete = 1  and user_id <> 0 order by create_time desc";
	            }
	            $sql = "Select * from project_info where project_type in $arrayToString and nopass_year = $year AND isDelete = 1  and user_id <> 0 order by create_time desc";
	            break;
	    }
	    $count = count($db -> Select($sql));
	    $sql = $sql .  " limit " . $page . "," . $rows;
	    $projectList_result = $db -> Select($sql);
	    
	    $db ->Close();
	    $projectCount = 0;
	    foreach($projectList_result as $project_item){
	        //首先将一些基础的数据存入进去
	        //项目联系人信息
	        $db = new DB();
	    
	        $leaderInfo = $db -> GetInfo($project_item['user_id'], 'login_info');
	        //公司信息
	        $org_info = $db -> GetInfo1($project_item['org_code'], 'org_info', 'org_code');
	        //查重信息
	        $check_result = $db -> GetInfo1($project_item['project_id'], 'check_status', 'project_id');
	        //select project leader
	        $leader=$db -> GetInfo1($project_item['project_id'], 'project_principal', 'project_id');
	        //查询table_status的方法
	        $db -> Close();
	        $project_status = $this->projectOverAllStatus($project_item['project_id'],$project_item['project_stage']);
	        $typeList[$projectCount] = array(
	            'id' => $projectCount + 1,
	            'project_id' => $project_item['project_id'],
	            'project_stage'=> $global_project_stage[$project_item['project_stage']]['stage'],
	            'org_code' => $project_item['org_code'],
	            'name' => $project_item['project_name'],
	            'project_status' => $global_table_status[$project_status]['manageStatus'],
	            'leader_name'=> empty($project_item['linkman'])?$leaderInfo['realname']:$project_item['linkman'],
	            'leader_phone' => empty($project_item['linkman_contact'])?$leaderInfo['celphone']:$project_item['linkman_contact'],
	            'org_code' => $project_item['org_code'],
	            'org_name' => $org_info['org_name'],
	            'is_check'=>$project_item['is_check'],
	            'is_ownPri'=>$this->checkOwner($project_item['project_engineer'],$project_item['project_id']),
	            'is_owner'=>($project_item['project_engineer']==$_SESSION['realname'])?1:0,
	            'isDelete' => $project_item['isDelete'],
	            'project_engineer' => $project_item['project_engineer'],
	            'delegate_engineer' => $this->checkDelegate($project_item['project_id']),
	            //开启储备
	            'showStore' => $this->showStore($project_item['project_id'], $project_item['project_stage'], $project_item['project_type']),
	        );
	        $projectCount ++;
	    }
	    if($projectCount == 0){
	        $typeList = array();
	    }
	    $typeJSON = '{"total":' . $count . ',"rows":' . json_encode ($typeList) . '}';
	    echo $typeJSON;
	}
}
?>