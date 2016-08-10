<?php
include '../../../../../common/php/lib/common.cls.php';
include '../../../../../modules/php/action/class/projectapp/projectapp.cls.php';
include '../../../../../extends/pdf/pdf.php';
include '../../../../../center/php/action/class/checkinfo.cls.php';

class Center {
    public $totalProNum = 0;
	// 查看存档项目
	public function findLookFile($page, $rows, $project_type, $year, $name, $id, $engineer, $start, $end) {
   // public function findLookFile($page, $rows, $project_type, $year) {
		$page = ($page - 1) * $rows;
		$db = new DB ();

		//对sql查询语句进行修改;
		$sql = "select * from project_info";
		
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
		if($dep != -1){
		    $sql = $sql." where department='$dep' and";
		}else{
		    $sql = $sql." where";
		}
		
		if($project_type) {
		//	$sql = $sql." project_type = '$project_type' and is_save = 1";
		    $sql = $sql." project_type in (Select id from project_type where inherit_val = $project_type or id = $project_type) and is_save = 1";
		    
		} else {
			$sql = $sql." is_save = 1";
			if(!Pri::instance()->admin_tag){
// 				$sql .= " and project_type in (".Pri::instance()->get_check_ptids(4,true).")";
                //2016.2.28 david 修改
			    $user_pri = Pri::instance()->get_check_ptids(4,true);
			    if($user_pri == null || $user_pri == ''){
			        $user_pri = -1;
			    }
			    $sql .= " and project_type in (".$user_pri.")";
			}
		}
		// 2016.01.23 注释;
		if($year) {
			$sql = $sql." and save_year = '$year'";
		} 
		 if($start) {
			$start_time = strtotime($start." 00:00:00");
			$sql = $sql." and start_time <= $start_time";
		}
		if($end) {
			$end_time = strtotime($end." 00:00:00");
			$sql = $sql." and end_time >= $end_time";
		} 
		$count = count($db->select ( $sql ));
       // 2016.01.23注释		
	   if($name !=null || $id != null || $engineer != null){
		  $sql = $sql. " and project_name like '%$name%' and project_id like '%$id%' and project_engineer like '%$engineer%'";
	   }
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = $db->select ( $sql );
		$i = 0;
// 		var_dump($sql);exit();
		if(count($result)) {
			foreach ( $result as $tmp ) {
			    //修改了项目类型的显示
			    $result_project = $db->GetInfo($tmp ['project_type'], 'project_type');
			    $result_time = $db->GetInfo1($tmp['project_id'], 'project_info', 'project_id');
			    $project_start = (isset($result_time['start_time']))?date('Y-m-d',floatval($result_time['start_time'])):null;
			    $project_end = (isset($result_time['end_time']))?date('Y-m-d',floatval($result_time['end_time'])):null;
			     
				$typeList [$i] = array (
						'id' => $i,
						'department' => $tmp ['department'],
                        'project_id' => $tmp['project_id'],
                        'project_type' => $result_project['name'],
						'project_name' => $tmp['project_name'],
						'project_start' => $project_start,
						'project_end' => $project_end
				);
				$i = $i + 1;
			}
		} else {
			$typeList = array();
		} 
       
        $typeJSON = '{"total":' . $count . ',"rows":' . json_encode ( $typeList ) . '}';
	//	ob_clean();
		echo $typeJSON;
		$db->Close ();
	}
	
	// 查找每一项中一共有多少存档
	function findcheckNum($project_type) {
		$db = new DB ();
		$sql = "select * from project_info where project_type = '$project_type' and isDelete=0 ";
		$result = $db->SelectOri ( $sql );
		$check_num = 0;
		while ( $result_object = mysql_fetch_object ( $result ) ) {
// 			$project_id = $result_object->project_id;
			if ($result_object->project_stage == 4) {
				$check_num = $check_num + 1;
			}
		}
		return $check_num;
	}
	
	function openmid($project_id){
	    if($this->openmidAct($project_id)){
	        echo 1;
	    }else{
	        echo 0;
	    }
	}
	
	// 开启中期报告
	public function openmidAct($project_id){    
		$db = new DB ();
		$sql = "update table_status set open = 1 where project_id='$project_id' and table_name='15'";
// 		echo $sql;
		$re = $db->Update ( $sql );
		// echo $re;
		if ($re) {
			return 1;
		} else {
			return 0;
		}
		$db->Close ();
	}
	
	function stagemid($project_id) {
		$db = new DB ();
		$sql = "update project_info set project_stage=3 where project_id = '$project_id'";
		$re = $db->Update ( $sql );
		$db->Close ();
	}
	
	//是否能够开启中期
	
	function isopenMiddle($selRows){
	    $code = 0;
	    $canOpenCount = 0;
	    $noMiddleCount = 0;
	    $notCarrayCount = 0;
	    foreach($selRows as $item){
	        //首先需要判断当前项目的阶段，如果不是实施阶段的话，就不可以开启
	        $project_name = $this->getProjectName($item);
	        $carryStage = $this->getStage($item);
	        $tableStatus = $this->getTableStatus(15, $item);
	        if($carryStage == 2){
	            //还有的就是，我需要判断其是否有中期报告这张表,并且中期报告这张表是否处于没有提交的状态
	            if($tableStatus == 1){
	                //可以开启的项目
	                $canOpen[$canOpenCount]['project_name'] = $project_name;
	                $canOpen[$canOpenCount]['project_id'] = $item;
	                $canOpenCount++;
	            }else{
	                //没有这张中期报告表，或者中期报告表的状态为已经提交后的状态
	                $noMiddle[$noMiddleCount]['project_name'] = $project_name;
	                $noMiddleCount++;
	                $code = 1;
	            }	      
	        }else{
	            //当前的项目没有进入实施阶段，无法打开中期报告书
	            $notCarray[$notCarrayCount]['project_name'] = $project_name;
	            $notCarrayCount++;
	            $code = 2;
	        }
	    }
	    if($code == 0 &&  $canOpenCount != 0){
            $jumpmid = $this->openTable($canOpen,15);
            $dataJson = array(
                "code"=>0,
                "status"=>$jumpmid
            );
            $dataJson = json_encode($dataJson);
	    }else{
	        $dataJson = '{"code":' . $code . ',"canOpen":' . json_encode ( $canOpen ) . ',"noMiddle":'.json_encode($noMiddle).',"notCarray":'.json_encode($notCarray) .'}';
	    }
	    echo $dataJson;
	}

	 function CanisCheckBatch($selRows,$status){
	 	
	 	$flag=false;
	 	$dataJson = array(
	 			"code"=>1
	 	);
	 	
	 	//1. 看是不是都提交了  如果当前阶段没有提交的就不能批量
	 	foreach($selRows as $item){
	 		$db=new DB();
	 		$res= $db->GetInfo1($item,"project_info","project_id");
	 		 
	 		if(1==$this->projectStatus($item,$res["project_stage"])){
	 			$dataJson = array(
	 					"code"=>0
	 			);
	 			echo json_encode($dataJson);return ;
	 		}
	 		$db -> Close();
	 	
	 	}
	 	
	 	
	 	//2. 有没有已经有审核的 有的话不能批量审核
	 	foreach($selRows as $item){
	 	
	 		$db=new DB();
	 		$sql="SELECT * FROM project_info  WHERE project_id = '$item' ";
	 		$res1= $db->Select($sql);
	 		$project_stage=$res1['project_stage'] ;
	 		$sql="select * from table_status where project_id= '$item' and project_stage =$project_stage ";
	 	
	 		$res= $db->Select($sql);
	 		if(!empty($res)){
	 			foreach($res as $val){
	 				if($res["table_status"]!=2){
	 					$dataJson["code"]=2;
	 					echo json_encode($dataJson);return ;
	 				}
	 			}
	 		}
	 		$db -> Close();
	 	
	 	
	 	}
 
	 	
	 	//4.  不通过
	 	if("no"==$status){
	 		$db=new DB();
	 		$res= $db->GetInfo1($item,"project_info","project_id");
	 		$db -> Close();
	 		if($res["project_stage"]==1){
	 			$dataJson["code"]=3;
	 			echo json_encode($dataJson);return ;
	 		}
	 	 
	 	}
	 	
	 	echo json_encode($dataJson);return ;
	 	
	 }
	
	
	function ifJumpNextStage($project_id,$stage){
		$db=new DB();
		
		$project_stage = $db->GetInfo1($project_id,'project_info','project_id');
		$stage_process = $project_stage['stage_process'];
		
		if($stage == 1){//$stage_result != 3
			$pos = strpos($stage_process,$stage);
			//这里的+2 是为了过一个逗号
			$stage_result = (int) substr($stage_process,$pos+2,1);
			$usql1 = "update project_info set project_stage = $stage_result where project_id = '$project_id' ";
			$last = $db->Update($usql1);
		}
	}
	
	function isCheckBatch($selRows,$status,$check_opnion){

		$flag=false;
		$dataJson = array(
			"code"=>1
		);

		//1. 看是不是都提交了  如果当前阶段没有提交的就不能批量
		foreach($selRows as $item){
			$db=new DB();
			$res= $db->GetInfo1($item,"project_info","project_id");

			if(1==$this->projectOverAllStatus($item,$res["project_stage"])){
				$dataJson = array(
					"code"=>0
				);
				echo json_encode($dataJson);return ;
			}
			$db -> Close();

		}


		//2. 有没有已经有审核的 有的话不能批量审核
		foreach($selRows as $item){

			$db=new DB();
			$sql="SELECT * FROM project_info  WHERE project_id = '$item' ";
			$res1= $db->Select($sql);
			$project_stage=$res1['project_stage'] ;
			$sql="select * from table_status where project_id= '$item' and project_stage =$project_stage ";

			$res= $db->Select($sql);
            if(!empty($res)){
				foreach($res as $val){
					if($res["table_status"]!=2){
						$dataJson["code"]=2;
						echo json_encode($dataJson);return ;
					}
				}
			}
			$db -> Close();


		}

		//3. 如果是yes的话 开始批量操作
		if("yes"==$status){
		foreach($selRows as $item){
			$db=new DB();
			//$name, $id, $data, $tid, $id2, $tid2
			$res1= $db->GetInfo1($item,"project_info","project_id");
//			var_dump($res1);exit();
			$project_stage=$res1['project_stage'] ;
			$time=time();
		    $db->UpdateTabData2("table_status",$item,array("table_status"=>4,"approval_opinion"=>$check_opnion,"approval_time"=>$time),"project_id",$project_stage,"project_stage");
			$db -> Close();
		//判断是不是 要进入下一个阶段？
			$this->ifJumpNextStage($item,$project_stage);
			
			
			
			
		}
			$dataJson["code"]=1;
			echo json_encode($dataJson);return ;
	}
	
	
	
	
	

		//4.  不通过
		if("no"==$status){
			$db=new DB();
			$res= $db->GetInfo1($item,"project_info","project_id");
			$db -> Close();
			if($res["project_stage"]==1){
				$dataJson["code"]=3;
				echo json_encode($dataJson);return ;
			}
			else{
				foreach($selRows as $item){
					$db=new DB();
					$res1= $db->GetInfo1($item,"project_info","project_id");
					$nopass=Date("Y",$res1["start_time"]);
					$db->updateInfo4("project_info","project_id",$item,array("isDelete "=>1,"nopass_year"=>$nopass));
					$project_stage=$res1['project_stage'] ;
					$time=time();
					$db->UpdateTabData2("table_status",$item,array("table_status"=>5,"approval_opinion"=>$check_opnion,"approval_time"=>$time),"project_id",$project_stage,"project_stage");
					$db -> Close();
				}
				$dataJson["code"]=1;
				echo json_encode($dataJson);return ;
				}
			}

		$dataJson["code"]=4;
		echo json_encode($dataJson);return ;
	}
	//获取当前项目状态,和前台不同的是后台显示项目状态的时候应该按照最新的状态来显示。
	//如果是全部都审核通过的状态则显示审核通过，否则只有一个审核通过不算的
	//只要有一个为审核不通过的状态则，这个项目就是审核不通过的状态。
	//还有对于6的状态来说是不行的。不可以在状态栏出现这个状态。
	function projectOverAllStatus($project_id,$project_stage){
		$db = new DB();
		global $global_table_status;
//         $projectTable_statue_sql = "Select * from table_status where project_id = '$project_id' and project_stage = $project_stage";
		$projectTable_statue_sql = "Select * from table_status where project_id = '$project_id' and project_stage <= $project_stage";

		$projectTable_statue_result = $db -> Select($projectTable_statue_sql);

		$max = -1;
		$noPass = false;
		$pass = true;
		if(!empty($projectTable_statue_result)){
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

		}}
		$db -> Close();
		if($pass){
			return 4;
		}else if($noPass){
			return 5;
		}else{
			return $max;
		}
	}
	
	function projectStatus($project_id,$project_stage){ 
		$db=new DB();
		$sql ="select  * from table_status  where project_id ='$project_id'  and  project_stage='$project_stage' ";
		$res=$db->Select($sql);
		if(!empty($res)){
			foreach ($res as $val ){
				if($val['table_status']==1||$val['table_status']==3){
					return 1;
				}
			}
			return 2;
		}
		
	}
	function openTable($projectArray,$table_id){
	    $status = 1;
	    foreach($projectArray as $item){
	        if(!$this->openmidAct($item['project_id'])){
	            $status = 0;
	        }
	    }
	    return $status;
	}
	
	function getStage($project_id){
	    $db = new DB();
	    $projectInfo = $db -> GetInfo1($project_id, 'project_info', 'project_id');
	    return $projectInfo['project_stage'];
	}
	
	//是否能够开启验收
/*     code:0  一切正常
    1 不存在验收阶段
    2 该项目还不能开启 */
	
	function isopenAcc($selRows){
        $code = 0;
        $rightCount = 0;  //一切正常
        $noAccCount = 0;  //没有验收阶段
        $notOpenCount = 0; // 有验收阶段，但是还不可以进行打开验收
        foreach($selRows as $item){
            //判断该项目是否可以进行验收操作
            //1.首先需要判断该项目是否有验收阶段
            $project_name = $this->getProjectName($item);
            $projectStage = $this->hasStage($item,3);
            //2.其次需要判断该项目是否可以到达验收阶段。
            $projectopenacc = $this->judgeToStage($item,3,14);
            $getMiddleStatus = $this->getTableStatus(15, $item);
//             echo $projectopenacc; exit();
            if($this->hasStage($item,3)){
                if($projectopenacc &&  ($getMiddleStatus == 1 || $getMiddleStatus == 4)){
                    $right[$rightCount]['project_name'] = $project_name;
                    $right[$rightCount]['project_id'] = $item;
                    $rightCount++;
                }else{
                    $notOpen[$notOpenCount]['project_name'] = $project_name;
                    $notOpenCount++;
                    $code = 2;
                }
            }else{
                $noAcc[$noAccCount]['project_name'] = $project_name;
                $noAccCount++;
                $code = 1;
            }
        }
        if($code == 0 && count($right) != 0 ){
            //集体开验收
            $jumpstage = $this->openStage($right,3);
            $dataJson = array(
               "code"=>0,
               "status"=>$jumpstage
            );
            $dataJson = json_encode($dataJson);
        }else{
            $dataJson = '{"code":' . $code . ',"right":' . json_encode ( $right ) . ',"notopen":'.json_encode($notOpen).',"noAcc":'.json_encode($noAcc) .'}';
        }
        echo $dataJson;
        

	}
	
	function openStage($projectArray,$stage){
// 	    var_dump($projectArray);
        $status = 1;
        foreach($projectArray as $item){
            if(!$this->openaccetAct($item['project_id'])){
                $status = 0;
            }
        }
        return $status;
	}

	
	function judgeToStage($project_id,$stage,$except_id){
	    $db = new DB();
	    $project_tabStatue_sql = "Select * from table_status where project_id='$project_id' and project_stage < $stage and table_status <> 4 and table_name <> $except_id and  table_name<> 15";
// 	    echo $project_tabStatue_sql;exit();
        $project_tabStatue_result = $db -> Select($project_tabStatue_sql);
        if(!count($project_tabStatue_result)){
            if($except_id != null){
                $except_status = $this->getTableStatus($except_id, $project_id);
                if($except_status == 4 || $except_status == 5 || $except_status == 1){
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return 1;
            }
        }else{
            return 0;
        }
	}
	
	function getTableStatus($table_id,$project_id){
	    $db = new DB();
	    $tableInfo = $db -> GetInfo2($table_id, 'table_status', 'table_name', $project_id, 'project_id');
// 	    echo "ccccccccccccc  " . $tableInfo['table_status'] ."bbbbbbbbbbbbbb";exit();
        if($tableInfo != null){
            return $tableInfo['table_status'];
        }else{
            return 0;
        }
	    
	}
	
	//判断是否有某个阶段
	function hasStage($project_id,$valiStage){
	    $db = new DB();
	    $project_info = $db->GetInfo1($project_id, 'project_info', 'project_id');
	    $stage_process = $project_info['stage_process'];
	    $proecssArray = explode(",", $stage_process);
	    if(in_array($valiStage, $proecssArray)){
	        return 1;
	    }else{
	        return 0;
	    }
	}
	
	//获取项目名称
	function getProjectName($project_id){
	    $db = new DB();
	    $projectInfo = $db -> GetInfo1($project_id, 'project_info', 'project_id');
	    return $projectInfo['project_name'];
	}
	
	function openaccet($project_id){
	    if($this->openaccetAct($project_id)){
	        echo 1;
	    }else{
	        echo 0;
	    }
	}
	// 开启验收
	function openaccetAct($project_id){
		$db = new DB ();
		// 修改table_status
		$sql = "update table_status set open = 1 where project_id='$project_id' and project_stage=3 ";
		$re = $db->Update ( $sql );
		// 修改$sql1
		$sql1 = "update project_info set project_stage = 3 ,isclose=0 where project_id='$project_id'";
		$re1 = $db->Update ( $sql1 );
		
		//同时需要将项目调整表的状态为重新置为6.2015.12.26
		//限制加在sql语句中了，只有 当table_status = 1 时才会变成6否则不变
		$sql2 = "Update table_status set table_status = 6 where table_name = 14 and table_status =1 and project_id='$project_id'";
		$re2 = $db->Update ( $sql2 );
		if ($re && $re1 && $re2) {
			return 1;
		} else {
			return 0;
		}
		$db->Close ();
	}
	//用来检查项目调整表的状态
	function checkTable14($project_id){
		$db = new DB();
		$sql = "select * from table_status where table_name = 14 and project_id='$project_id'";
		$re = $db->Select($sql);
		
	}
	
	//开启存档
//	function opensave($project_id,$year){
	function opensave($project_id){    
	    $db = new DB();
	    $sql = '';
	    $result = '';
	    // 查询
	    $sql = "Select * from table_status where project_id = '$project_id' and table_name <> 14";
	    $result = $db->Select($sql);
	    $table_status = true;
	    foreach($result as $tmp){
	        if($tmp['table_status'] != 4 && $tmp['table_name'] != 15){
	            $table_status = false;
	        } 
	    }
	    //增加关于人才的判断;
	    $sql = "Select * from table_status where project_id = '$project_id'";
	    $result = $db ->Select($sql);
	    $talents_status = false;
        foreach($result as $tmp){
            if($tmp['table_name'] == 19 || $tmp['table_name'] == 20){
                if( $tmp['table_status'] == 4){
                    $talents_status = true;
                }
            }
        }
	    //加入当前的年份;
	    if(!$talents_status){
	        $year_info = $db -> GetInfo1($project_id, 'project_info', 'project_id');
	        $year = $year_info['start_time'];
	        $year = date('Y',$year);
	    }else{
	        $year = date("Y",time());
	    }
	    //加入对表单状态的判断
	    if($table_status || $talents_status){
    	    $sql = "update project_info set is_save = 1,project_stage = 4,save_year = '$year' where project_id='$project_id'";
    	    $re = $db->Update ( $sql );
			echo "1";

	    }	 
	    $this->get_all_tables($project_id);
	    $db->Close();
	}
	
	function get_all_tables($project_id){
	    $db = new DB();
	    $selSql1 = "select * from project_info where project_id ='$project_id'";
	    $result1 = $db->Select($selSql1);
	    if(!empty($result1[0])) {
	        $org_code = $result1[0]['org_code'];
	        $pro_type_name = $result1[0]['project_type'];
	        $selSql2 = "select * from project_type where name ='$pro_type_name'";
	        $result2 = $db->Select($selSql2);
	        $project_type = $result2[0]['id'];
	        $start_time = date("Y-m-d",$result2[0]['apply_start']);
	        $project_name = $result1[0]['project_name'];
	    }
	    
	    $selSql3 = "select * from table_type";
	    $result3 = $db->Select($selSql3);
	    $i = 0;
	    $table12 = $db->Select("select * from table_status where project_id ='$project_id'");//一个项目所有的表的状态，对结果貌似没用
	    foreach ($result3 as $row) {	        
	        $i++;
	        if($i == 1) {
	            //北京市通州区科技计划项目实施方案表
	            if(strpos($row['project_type'],$project_type) !== false) { 
	               $table_name = $row['name'];
	               $table11 = $result1;	
	               $project_info = $table11[0];               
	               $table13 = $db->Select("select * from org_info where org_code ='$org_code'");//单位基本情况,一个项目对应一个结果
	               $org_info = $table13[0];
	               $table14 = $db->Select("select * from project_principal where project_id ='$project_id'");//一个项目对应一个结果
	               $project_principal = $table14[0];
	               $table15 = $db->Select("select * from project_ann_plan where project_id ='$project_id'");//项目各年度任务目标、考核指标,一个项目对应三个结果
	               $project_ann_plan =array('project_ann_plan' =>$table15);
	               $table16 = $db->Select("select * from equipment where project_id ='$project_id'");//项目设备,一个项目对应不知道几个结果
	               $equipment = array('equipment'=>$table16);
	               $projectapp = new ProjectApp ();
	               $table17 = $projectapp->findTotalFund2( $project_id );//项目经费来源,一个项目对应一个结果，直接读取就行
	               $fund = $table17;
	               $table18 = $db->Select("select * from project_org where project_id ='$project_id'");//项目-单位表,一个项目对应不知道几个结果
	               $project_org = array('project_org'=>$table18);
	               $table_content = array_merge((array)$project_info,(array)$org_info,(array)$project_principal,(array)$project_ann_plan,(array)$equipment,(array)$fund,(array)$project_org);
	               datasavepdf2('demo', $table_content,$start_time,$pro_type_name,$project_name,$table_name);
	               
	            }	            
	        } else if($i == 13) {
	            //var_dump(empty($row['project_type']));
	            //专家名单及专家论证意见
	            if(strpos($row['project_type'],$project_type) !== false || empty($row['project_type'])) {
	                //var_dump('aaaaaaaaaaaaa');
	                $table_name = $row['name'];
	                $table21 = $result1;
	                $project_info2 = $table21[0];
	                $table22 = $db->Select("select * from experts where project_id ='$project_id'");//专家列表,一个项目对应多个结果
	                $experts2 = array('experts'=>$table22);
	                $table23 = $db->Select("select * from table_status where project_id ='$project_id' and table_name='$table_name'");//专家意见,一个项目对应一个结果
	                $experts3 = $table23;
	                $table_content2 = array_merge((array)$project_info2,(array)$experts2,(array)$experts3);
	                //var_dump($table_content2);
	                
	                datasavepdf2('tablenum13', $table_content2,$start_time,$pro_type_name,$project_name,$table_name);
	                
	            }
	        }
	    }
	    
	    $db->Close ();	    
	}
	
	function processControl($page, $rows, $department_type) {
		
		$page = ($page - 1) * $rows;
		$db = new DB ();
		$sql = "select * from project_type where dep_type = $department_type";
		// $sqlCount = "select count(id) as 'count' from project_type where dep_type >= 0 and dep_type = '$department_type'";
		$sqlCount = "select count(id) as 'count' from project_type where dep_type = $department_type";
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = ( array ) $db->select ( $sql );
		$count = $db->select ( $sqlCount );
		$count = $count [0] ['count'];
		$i = 0;
		foreach ( $result as $tmp ) {
			$typeList [$i] = array (
					'name' => $tmp ['name'],
					'id' => $tmp ['id'] 
			);
			$i ++;
		}
		$typeJSON = '{"total":' . ($count + 1) . ',"rows":' . json_encode ( $typeList ) . '}';
		ob_clean();
		echo $typeJSON;
		$db->Close ();
	}
	
	function processControlAll($page, $rows) {
		
		$page = ($page - 1) * $rows;
		$db = new DB ();
		// $sql = "select * from project_type where dep_type >= 0";
		$sql = "select * from project_type where dep_type >= 0";
		$sqlCount = "select count(id) as 'count' from project_type where dep_type >= 0";
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = ( array ) $db->select ( $sql );
		$count = $db->select ( $sqlCount );
		$count = $count [0] ['count'];
		$i = 0;
		foreach ( $result as $tmp ) {
			$typeList [$i] = array (
					'name' => $tmp ['name'],
					'id' => $tmp ['id'] 
			);
			$i ++;
		}
		$typeJSON = '{"total":' . ($count + 1) . ',"rows":' . json_encode ( $typeList ) . '}';
		ob_clean();
		echo $typeJSON;
		$db->Close ();
	}
	
	//david modify  delete
/* 	function projectMain($page, $rows, $departmentpro) {
		$page = ($page - 1) * $rows;
		$db = new DB ();
		$sql = "select * from project_type where dep_type = $departmentpro and apply_status = 1 ";
		// echo $sql;
		$sqlCount = "select count(id) as 'count' from project_type where dep_type = $departmentpro and apply_status = 1 ";
		
		if(!Pri::instance()->admin_tag && !Pri::instance()->is_special){
			$sql .= " and id in(".Pri::instance()->get_all_ptids(true).")";
			$sqlCount .= " and id in(".Pri::instance()->get_all_ptids(true).")";
		}
		
		if(!Pri::instance()->admin_tag && Pri::instance()->is_special){
			if(!Pri::instance()->check_sp_dep($departmentpro)){
				$sql .= " and id in(".Pri::instance()->get_sp_ptids(true).")";
				$sqlCount .= " and id in(".Pri::instance()->get_sp_ptids(true).")";
			}
		}
		
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = ( array ) $db->select ( $sql );
		$count = $db->select ( $sqlCount );
		$count = $count[0]['count'];
		$i = 0;
		foreach ( $result as $tmp ) {
			$typeList [$i] = array (
					'id' => $tmp ['id'],
					'project_type' => $tmp ['name'],
					'project_start' => date ( "Y-m-d", floatval ( $tmp ['apply_start'] ) ),
					'project_end' => date ( "Y-m-d", floatval ( $tmp ['apply_end'] ) ),
					'check_num' => $this->checkNum ( $tmp ['name'] ),
					'department' => $tmp ['dep_type'] 
			);
			$i = $i + 1;
		}
		$typeJSON = '{"total":' . $count . ',"rows":' . json_encode ( $typeList ) . '}';
		ob_clean();
		echo $typeJSON;
		$db->Close ();
	} */
	function getUserDep(){
	    $userDep = $_SESSION['department'];
	    $data = array(
	        'msgcode'=>200,
	        'userDep'=>$userDep
	    );
	    echo json_encode($data);
	}
	
	/*
	 * 判断该项目是否需要勾选（存在）
	 */
	function projectIscheck($ptid,$user_id){
	    $db = new DB();
	    //这里还是需要一次联合查询的过程
	    $project_type_sql = "Select * from project_type_inherit a join (Select * from project_type where inherit_val = $ptid) b on (a.project_type_id = b.id) where a.user_id = $user_id";
// 	    echo $project_type_sql;
	    $project_type = $db -> Select($project_type_sql);
	    if($project_type != null){
	        $data['code'] = 1;
	    }else{
	        $data['code'] = 0;
	    }
	    echo json_encode($data);
	}
	
	//申报书是否被勾选上了
	/*
	 * code:
	 * 0:代表不需要进行任何的勾选操作
	 * 1:需要进行勾选操作
	 * apply,execute
	 * 0:不被勾选
	 * 1：被勾选
	 */
	function checkApplyExe($ptid,$user_id){
	    $db = new DB();
	    $sql = "select * from project_type_inherit a join (Select * from project_type where inherit_val = $ptid) b on (a.project_type_id = b.id) where a.user_id = $user_id";
// 	    echo $sql;
	    $projectInfo = $db->Select($sql);
	    $data = array(
	        'code'=>1,
	        'apply'=>0,
	        'execute'=>0
	    );
	    if(count($projectInfo) == 0){
	        $data['code'] = 0;
	    }else{
	        $project_type_id = $projectInfo[0]['project_type_id'];
	        //首先需要判断是否有申报书，其次判断是否有实施方案
	        $sql_apply = "Select * from table_type_relative where project_type_id = $project_type_id and para_id = 0 and table_type_id <> 1";
// 	        echo $sql_apply;
	        $executeResult = $db -> GetInfo2($project_type_id, 'table_type_relative', 'project_type_id', 1, 'table_type_id');
	        $applyResult = $db -> Select($sql_apply);
	        if(count($applyResult) > 0){
	            $data['apply'] = 1;
	        }
	        if(count($executeResult) > 0){
	            $data['execute'] = 1;
	        }
	    }
	    echo json_encode($data);
	}
	
	//能否复制新的项目
	/*
	 * 1:需要复制
	 * 0：不需要复制
	 */
	function copyNew($ptid,$user_id){
	    $db = new DB();
        $sql = "Select * from project_type_inherit a join (Select * from project_type where inherit_val = $ptid) b on (a.project_type_id = b.id) where a.user_id = $user_id";
        $projectList = $db -> Select($sql);
        if(count($projectList) > 0){
            $data['code'] = 0;
        }else{
            $data['code'] = 1;
        }
	    echo json_encode($data);
	}
	
	//这个是将原有的项目复制一份出来，并且将其关系存入了project_type_inherit这张表
	//同时复制出来的项目时间是不受限制的
	function inherit($ptid,$user_id){
	    //需要复制出来
	    $db = new DB();
	    $project_result = $db -> GetInfo($ptid, 'project_type');
	    unset($project_result['id']);
	    $project_result['inherit_val'] = $ptid;
	    $insert_result = $db ->InsertData('project_type', $project_result);
        $insert_id = mysql_insert_id();
//         echo $insert_id."aaaaaaa";
        $result_db = $db -> Select($sql_new);  
	    //需要建立项目和用户之间的关系
	    $user_project = array(
	        "user_id"=>$user_id,
	        "project_type_id"=>$insert_id
	    );
	    $insert_userProject = $db -> InsertData('project_type_inherit', $user_project);
	    
	    //还需要同步更新table_type_relative这张表
	    $sql_old = "Select * from table_type_relative where project_type_id = $ptid";
	    $result_old = $db -> Select($sql_old);
	    foreach($result_old as $item){
	        $item['project_type_id'] = $insert_id;
	        unset($item['id']);
	        $newRelative = $db -> InsertData('table_type_relative', $item);
	    }
	    
	    //还需要同步更新查重设置的表
	    $sql_check_old = "Select * from project_check_relative where project_type_id = $ptid";
	    $result_check_old = $db -> Select($sql_check_old);
	    foreach($result_check_old as $item){
	        $item['project_type_id'] = $insert_id;
	        unset($item['id']);
	        $newCheckRelative = $db -> InsertData('project_check_relative', $item);
	    }
	    //复制完成以后，需要将实施方案和申报书给去掉
	    $this->deleteCheckExe($ptid,$user_id,22);
	    $this->deleteCheckExe($ptid,$user_id,1);
	    $this->deleteApply($ptid, $user_id);
	    $db->Close();
	}
	

	//根据父类项目id以及用户的id获取子类项目的id
	function getChildInfo($ptid,$user_id){
	    $db = new DB();
	    $sql = "Select * from project_type_inherit a join (Select * from project_type where inherit_val = $ptid) b on (a.project_type_id = b.id) where a.user_id = $user_id";
	    $result = $db -> Select($sql);
	    return $result[0]['project_type_id'];
	}
	
	//需要增加实施方案或者是其他的文件
	function addCheckExe($ptid,$user_id,$table_id){
	    $db = new DB();
	    $inheritProject = $this->getChildInfo($ptid,$user_id);
	     
	    $project_typeInfo = $db -> GetInfo($inheritProject, 'project_type');
	    $attach_name = $project_typeInfo['attatch_name'];
	    $data['attatch_name'] = $table_id . ",".$attach_name;
	    $db -> UpdateData('project_type', $inheritProject, $data);
	    
	    //还需要同步更新table_type_relative
	    $sql_exe = "Select * from table_type_relative where project_type_id = $ptid and table_type_id = $table_id";
	    $result_exe = $db -> Select($sql_exe);
	    foreach($result_exe as $item){
	        $item['project_type_id'] = $inheritProject;
	        unset($item['id']);
	        $newRelative = $db->InsertData('table_type_relative', $item);
	    }
	    $db -> close();
	}

	//需要删除实施方案或者其他文件
	function deleteCheckExe($ptid,$user_id,$table_id){
	    $db = new DB();
	    $inheritProject = $this->getChildInfo($ptid,$user_id);
	    $project_typeInfo = $db -> GetInfo($inheritProject,'project_type');
	    $attach_name = $project_typeInfo['attatch_name'];
	    $attachArray = explode(",", $attach_name);
	    foreach($attachArray as $key => $value){
	        if($value == $table_id){
	            unset($attachArray[$key]);
	        }
	    }
	    $string = implode(",", $attachArray);
	    $data['attatch_name'] = $string;
	    $update_project_type = $db -> UpdateData('project_type', $inheritProject, $data);
	    
	    //还需要同步更新table_type_relative  //删除table_type_relative里面的实施方案的东西
	    $delete = "Delete from table_type_relative where project_type_id = $inheritProject and table_type_id = $table_id";
// 	    echo $delete;
	    $delete_table = $db -> Delete($delete);
	    $update_check = "Update project_check_relative set status = -1 where project_type_id = $inheritProject and table_type_id = $table_id";
	    $update_check_result = $db -> Update($update_check);
	    
	    $db -> Close();
	}
	
	//需要删除申报阶段
	function deleteApplyStage($ptid,$user_id){
	    $db = new DB();
	    $delete = 1;
	    $inheritProject = $this->getChildInfo($ptid,$user_id);
	    $inherit_info = $db -> GetInfo($inheritProject, 'project_type');
	    $processStage = $inherit_info['attatch_name'];
	    $processString = explode(",", $processStage);
	    foreach($processString as $item){
	        $table = $db -> GetInfo($item, 'table_type');
	        if($table['stage'] == 0){
	            $delete = 0;break;
	        }
	    }
	    if($delete){
	        //更新申报阶段
	        $update_apply = "update project_type set apply_stage = 0 where id = $inheritProject";
	        $update_result = $db -> Update($update_apply);
	        
	       /*  //同时需要更新查重的
	        $update_check = "update project_check_relative set status = -1 "; */
	    }
	}
	
	//增加其需要的申报书
	function addApply($ptid,$user_id){
	    $db = new DB();
	    $inheritProject = $this->getChildInfo($ptid,$user_id);
	    $projectInfo = $db -> GetInfo($inheritProject, 'project_type');
// 	    $inherit_val = $projectInfo['inherit_val'];
/* 	    $inheritProject = $db -> GetInfo($inherit_val, 'project_type');
	    $attatch_name = $inheritProject['attatch_name']; */
	    $sql_apply = "Select * from table_type_relative where project_type_id = $ptid and table_type_id <> 1 and para_id = 0 group by table_type_id";
	    $apply_result = $db -> Select($sql_apply);
	    foreach($apply_result as $item){
	        $strArray[] = $item['table_type_id'];
	    }
	    $arrayStr = implode(",", $strArray);
	    $attatch_name = $projectInfo['attatch_name'].",".$arrayStr;
	    $data['attatch_name'] = $attatch_name;
	    $updateProject = $db->UpdateData('project_type', $inheritProject, $data);
	    
	    //还需要同步更新table_type_relative 这张表
	    $sql_old = "Select * from table_type_relative where project_type_id = $ptid and table_type_id <> 1 and para_id = 0";
	    $old_apply = $db -> Select($sql_old);
	    foreach($old_apply as $item){
	        $item['project_type_id'] = $inheritProject;
	        unset($item['id']);
	        $newRelative = $db->InsertData('table_type_relative', $item);
	    }
	    $db->Close();
	}
	
	//删除申报书
	function deleteApply($ptid,$user_id){
	    $db = new DB();
	    $inheritProject = $this->getChildInfo($ptid,$user_id);
	    $projectInfo = $db -> GetInfo($inheritProject, 'project_type');
	    $sql_apply = "Select * from table_type_relative where project_type_id = $ptid and table_type_id <> 1 and para_id = 0 group by table_type_id";
	    $apply_result = $db -> Select($sql_apply);
	    if(count($apply_result) > 0){
	        foreach($apply_result as $item){
	            $strArray[] = $item['table_type_id'];
	        }
	        $attatch_name = $projectInfo['attatch_name'];
	        $attatchArray = explode(",", $attatch_name);
// 	        var_dump($sql_apply);exit();
	        foreach($attatchArray as $key => $value){
	            if(in_array($value, $strArray)){
	                unset($attatchArray[$key]);
	            }
	        }
	        $attatch_name = implode(",", $attatchArray);
	        $data['attatch_name'] = $attatch_name;
	        $updateProject = $db->UpdateData('project_type', $inheritProject, $data);
	        //david 2.22 修改
	        $delete_sql = "delete from table_type_relative where project_type_id = $inheritProject and para_id = 0 and table_type_id <> 1";
	        $delete_table = $db -> Delete($delete_sql);
	        
	    }
	    $db->Close();
	}
	
	//删除该项目的所有属性
	function deleteNewProject($ptid,$user_id){
	   $db = new DB();
	   $inheritProject = $this->getChildInfo($ptid,$user_id);
	   $project_type_del = "delete from project_type where id = $inheritProject";
	   $table_type_relative_del = "delete from table_type_relative where project_type_id = $inheritProject";
	   $project_type_inherit_del = "delete from project_type_inherit where user_id = $user_id and project_type_id = $inheritProject";
	   $db -> Delete($project_type_del);
	   $db -> Delete($table_type_relative_del);
	   $db -> Delete($project_type_inherit_del);
	   $db -> Close();
	}

	function getPtidAvail($db){
		$realname = $_SESSION['realname'];
		$user_id = $_SESSION['user_id'];

		/**
		 *  获取适配项目类型
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

		$result = ( array ) $db->select ( $sql );
		$result[] = 0;

		/*
		 * 根据项目类型来获取适配类型
		 * */
		$ptids = Pri::instance()->get_all_ptids();

		$ptid_str = null;
		$ret = array();
		foreach($result as $val){
			$ret[] = "'".$val['project_type']."'";
		}
		foreach($ptids as $val){
			$ret[] = "'".$val."'";
		}

		$ptid_str = implode(',',$ret);
		return $ptid_str;

	}
	
	
	function projectall($page, $rows,$department,$user_type){
		$page = ($page - 1) * $rows;
		$db = new DB ();
		//david modify  修改了一个判断的逻辑
		if($department == -1 || Pri::instance()->is_special){
		    $sql = "select * from project_type where apply_status = 1 and dep_type > -1 and is_delete = 0 and inherit_val = 0";
		    $sqlCount = "select count(id) as 'count' from project_type where apply_status = 1 and dep_type > -1 and is_delete = 0 and inherit_val = 0";
		}else{
		    $sql = "select * from project_type where apply_status = 1 and dep_type = $department and is_delete = 0 and inherit_val = 0";
		    $sqlCount = "select count(id) as 'count' from project_type where apply_status = 1 and dep_type = $department and is_delete = 0 and inherit_val = 0";
		}
// 		echo $sql;
		if(!Pri::instance()->admin_tag && Pri::instance()->is_special){
			$sql .= " and (id in(".Pri::instance()->get_sp_ptids(true).")  or dep_type in(".Pri::instance()->get_sp_deps(true)."))";
			$sqlCount .= " and (id in(".Pri::instance()->get_sp_ptids(true).")  or dep_type in(".Pri::instance()->get_sp_deps(true)."))";
		}

		if(!Pri::instance()->admin_tag && !Pri::instance()->is_special){
			$ptid_str = $this->getPtidAvail($db);
			$sql .= " and id in({$ptid_str})";
		}
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = ( array ) $db->select ( $sql );
		$count = $db->select ( $sqlCount );
		$count = $count[0]['count'];
		$i = 0;
		$db->Close ();
		foreach ( $result as $tmp ) {
		    $db = new DB();
			if ($tmp ['apply_end'] != null) {
				$end = $tmp ['apply_end'];
			} else {
				$end = null;
			}
            $sql  = "select group_concat(b.realname) as gc_name  from pro_pri_list as a join admininfo as b on(a.admin_info_id=b.id)
    	where (prival like 'jcqxPart%\_{$tmp['id']}' or prival = 'jcqxDep_{$tmp['dep_type']}')";
            $ret = $db->select($sql);
            $gc_name = $ret[0]['gc_name'];

			$typeList [$i] = array (
					'id' => $tmp ['id'],
// 			        'project_type_id' => $tmp ['id'],
					'project_type' => $tmp ['name'],
					'project_start' => date ( "Y-m-d", $tmp ['apply_start'] ),
					'project_end' => isset($end)?date ( "Y-m-d", $end ):null,
// 					'check_num' => $this->checkNum ($tmp ['name']),
                    'visors'=>$gc_name,
			        'check_num' => $this->checkNum ($tmp ['id']),
					'department' => $tmp ['dep_type']
			);
			$i = $i + 1;
			$db -> Close();
		}
		$typeJSON = '{"total":' . $count . ',"rows":' . json_encode ( $typeList ) . '}';
		echo $typeJSON;
	}
	
	function userProject(){
	    $db = new DB();
	    global $global_department;
	    $msgcode = 100;
	    $sql = "SELECT * FROM project_type WHERE is_delete = 0 AND dep_type <> -1 AND inherit_val = 0";
	    $result = $db -> Select($sql);
	    $i = 0;
	    //需要判断每一个项目是否有申报书
	    $db -> Close();
	    foreach($result as $item){
	       $db = new DB();
	       $apply = array();
	       $project_type_id = $item['id'];
	       $sql_apply = "select * from table_type_relative where project_type_id = $project_type_id and para_id = 0 and table_type_id <> 1 and table_type_id <> 22";
	       $sql_execute = "select * from table_type_relative where project_type_id = $project_type_id and table_type_id = 1";
	       $sql_report = "select * from table_type_relative where project_type_id = $project_type_id and table_type_id = 22";
	       $apply_result = $db->Select($sql_apply);
	       $execute_result = $db ->Select($sql_execute);
	       $report_result = $db -> Select($sql_report);
	       //判断是否有申报阶段
	       
	       $apply_stage = $db -> GetInfo($project_type_id, 'project_type');
	       if($apply_stage['apply_stage'] == 0){
	           $children[$item['dep_type']][] = array(
    	           "id"=>"p".$item['id'],
    	           "name"=>$item['name'],
    	           "project_type_id"=>$item['id'],
    	           "department"=>$item['dep_type'],
	           );
	       }else{
	           if(count($apply_result) > 0){
	           $apply[] = array(
	               "id"=>"a".$item['id'],
	               "name"=>"申报书",
	               "project_type_id"=>$item['id']
	               );
	           }
               if(count($execute_result) > 0){
                   $apply[] = array(
                       "id"=>"e".$item['id'],
                       "name"=>"实施方案",
                       "project_type_id"=>$item['id']
                   );
               }
               if(count($report_result) > 0){
                   $apply[] = array(
                       "id"=>"r".$item['id'],
                       "name"=>"可行性研究报告",
                       "project_type_id"=>$item['id']
                   );
               }
               
               $children[$item['dep_type']][] = array(
                   "id"=>"p".$item['id'],
                   "name"=>$item['name'],
                   "project_type_id"=>$item['id'],
                   "department"=>$item['dep_type'],
                   "state"=>"closed",
                   "children"=>$apply
               );
	       }
	    }
	    foreach($children as $key=>$value){
	        $data[$key] = array(
	            'id'=>"d".$key,
	            'name'=>$global_department[$key]['name'],
	            "state"=>"closed",
	            'children'=>$value,
	        );
	    }
	    $db -> Close();
// 	    $typeJSON = '{"total":' . $count . ',"rows":' . json_encode ( $projectlist ) . '}';
	    echo  json_encode ( $data );
	}
	
	function proTotalNum()
	{
	    echo $totalProNum;
	}
	
	function queryuser($page, $rows,$login_type) {
		$page = ($page - 1) * $rows;
		// 1230修改讲isForbidden去掉了，因为需要加入启用功能了;  
		$sql = "select * from login_info where user_type = $login_type order by id desc";
		$sqlCount = "select count(id) as 'count' from login_info where user_type = $login_type";
		if($login_type==2){
			$sql = "select * from login_info where user_type = 0 or  user_type =-1 order by id desc";
			$sqlCount = "select count(id) as 'count' from login_info where user_type = 0 or user_type =-1";
		}
		//$sqlCount = "select count(id) as 'count' from login_info";
		// echo $sql;
		// echo $sqlCount; */
		$db = new DB ();
		$count = $db->select ( $sqlCount );
		$count = $count [0] ['count'];
		if($page > $count){
		    $page = 0;
		}
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = ( array ) $db->select ( $sql );
		$i = 0;
		foreach ( $result as $tmp ) {
		    //这边加入显示公司名称和公司地址以及公司电话的查询部分
		    $org_code = $tmp['org_code'];
		    if(!empty($org_code)){
		        $sql = "select * from org_info where org_code = '$org_code'";

		        $tmp_result = $db->Select($sql);
		    }
			//echo $sql;exit;
			$adminArr [$i] = array (
					'id' => $tmp ['id'],
					'username' => $tmp ['username'],
					'realname' => $tmp ['realname'],
			        'telephone'=>$tmp['phone'],
					'phone' => empty($org_code)?'':$tmp_result[0]['phone'],
					'email' => $tmp ['email'],
					'isForbidden' => $tmp ['isForbidden'], 
			        'org_name'=>empty($org_code)?'':$tmp_result[0]['org_name'],
			        'org_address'=>empty($org_code)?'':$tmp_result[0]['register_address']
			);
			$i = $i + 1;
		}
		if(!$adminArr) {
		    $adminArr = array();
		}
		$adminJSON = '{"total":' . $count . ',"rows":' . json_encode ( $adminArr ) . '}';
		ob_clean();
		echo $adminJSON;
		$db->Close ();
	}

	function querySearchUser($page, $rows,$realname,$username,$org_name) {
		$page = ($page - 1) * $rows;
		$db = new DB ();
	
		$sql = "Select A.*,B.phone as org_phone,B.org_name,B.org_address from org_info B,login_info A where A.org_code = B.org_code and org_name like '%$org_name%' and realname like '%$realname%' and A.username like '%$username%'";
		
	  //echo $sql.PHP_EOL;
		
		$count = count($db -> Select($sql));
		$sql = $sql." limit ".$page .",".$rows;
		$result = $db -> Select($sql);
		$i = 0;

		foreach ( $result as $tmp ) {
			$adminArr [$i] = array (
				'id' => $tmp ['id'],
				'username' => $tmp ['username'],
				'realname' => $tmp ['realname'],
				'telephone'=>$tmp['phone'],
				'phone' => $tmp ['org_phone'],
				'email' => $tmp ['email'],
				'isForbidden' => $tmp ['isForbidden'],
				'org_name'=>$tmp['org_name'],
				'org_address'=>$tmp['org_address']
			);
			$i = $i + 1;
		}
		if(!$adminArr) {
			$adminArr = array();;
		}
		$adminJSON = '{"total":' . $count . ',"rows":' . json_encode ( $adminArr ) . '}';
		//ob_clean();
		echo $adminJSON;
		$db->Close ();
	}
	
	function queryuserall($page, $rows) {
		$page = ($page - 1) * $rows;
		// 1230修改去掉了isforbidden的限制
		$sql = "select * from login_info order by id desc";
		$sqlCount = "select count(id) as 'count' from login_info";
		// echo $sql;
		// echo $sqlCount; */
		$db = new DB ();
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = ( array ) $db->select ( $sql );
		$count = $db->select ( $sqlCount );
		$count = $count [0] ['count'];
		$i = 0;
		foreach ( $result as $tmp ) {
		    //这边加入显示公司名称和公司地址以及公司电话的查询部分
		    $org_code = $tmp['org_code'];
		    $sql = "select * from org_info where org_code = '$org_code'";
		    $tmp_result = $db->Select($sql);
			$adminArr [$i] = array (
					'id' => $tmp ['id'],
					'username' => $tmp ['username'],
					'realname' => $tmp ['realname'],
					'telephone' => $tmp ['phone'],
					'email' => $tmp ['email'],
					'isForbidden' => $tmp ['isForbidden'],
			        'phone' => $tmp_result[0] ['phone'],
			        'org_name'=>$tmp_result[0]['org_name'],
			        'org_address'=>$tmp_result[0]['register_address']
			);
			$i = $i + 1;
		}
		$adminJSON = '{"total":' . $count . ',"rows":' . json_encode ( $adminArr ) . '}';
		echo $adminJSON;
		$db->Close ();
	}
	
	//是否审核 or 查看
	function showCheckorlook($project_id){
	    $db = new DB();
	    $tableInfo_sql = "Select * from table_status where project_id = '$project_id' ";
	    $tableInfo_result = $db->Select($tableInfo_sql);
	    $check = 0;
	    foreach($tableInfo_result as $tableItem){
	        if($tableItem['table_status'] == 2){
	            $check = 1;
	        }
	    }
	    $db -> Close();
	    return $check;
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
	    $db -> Close();
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
	    if($declare_status == 1){
	        $project_info = $db -> GetInfo1($project_id, 'project_info', 'project_id');
	        if(empty($project_info['waitapproval'])){
	            $sql = "update project_info set waitapproval = 1 where project_id = '$project_id'";
	           // echo $sql.PHP_EOL;
	            //$project['waitapproval'] = 1;
	            //$result = $db -> UpdateData1('project_info', $project_id, $project, 'project_id');
	            $result = $db -> Update($sql);
	            if(!$result){
	               $declare_status = 0;
	            }
	        }
	    }
	    $db -> Close();
	    return $declare_status;
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
	    }else{
	        if($project_stage != 2){
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
	
	// 查询checkNum的方法
	function checkNum($project_type_id) {
		$db = new DB ();
		$sql = "select * from project_info where project_type = $project_type_id and isDelete = 0 ";
		$result = $db->Select($sql);
		$count = count($result);
		$check_num = 0;
		$db->Close();
// 		$apply = new APPLY();
		foreach ($result as $item){
		   // $project_id = $item['project_id'];
		   // $project_stage = $item['project_stage'];
		    $project_id = $item['project_id'];
		    $project_stage = $item['project_stage'];
		    //新加入的对待立项进行操作;
		    $this->showApproval($project_id,$project_stage,$project_type_id);
		    //加快速度，不知道能加快多少。
		    
		    //这个是计算数量的，一定不能删除！！！！！！！
		    /* if($item['project_stage'] == 4 || $item['project_stage'] == 5){
		        $check_num++;
		            continue;
		    }else if(!($this->showCheckorlook($project_id))){
		        $check_num++;
		            continue;
		    } */
		    /////////////////////////
		    
		    
		    /* else if($this->showApproval($project_id,$project_stage,$project_type_id)){
		        $check_num++;
		        continue;
		    }else if($this->showMiddle($project_id,$project_stage,$project_type_id)){
		        $check_num++;
		        continue;
		    }else if($this->showAccept($project_id,$project_stage,$project_type_id)){
		        $check_num++;
		        continue;
		    }else if($this->showSaveFile($project_id)){
		        $check_num++;
		        continue;
		    } */
		    
		}
		$check_num = $count - $check_num;
		return $check_num;
	}
	
	// 添加新的项目类型
	function newAdmin($table_name, $admin) {
		$db = new DB ();
		$result = $db->InsertData ( $table_name, $admin );
		$db->Close ();
		echo $result;
	}
	
	// 删除项目类型
	function delProject($project_type) {
		$db = new DB ();
		$sql = "update project_type set apply_status = 0 where name = '$project_type' ";
		// echo $sql;
		$result = $db->Update ( $sql );
		$db->Close ();
		echo $result;
	}
	
	// 批量删除
	function delArrProject_type($arrproject_type) {
		$project_type_array = explode ( ',', $arrproject_type );
		$db = new DB ();
		for($i = 0; $i < count ( $project_type_array ); $i ++) {
// 			$sql_edit = "update project_type set apply_status = 0 where name='$project_type_array[$i]'";
		    $sql_edit = "update project_type set apply_status = 0 where id = '$project_type_array[$i]'";
			$db->Update ( $sql_edit );
		}
		$db->Close ();
	}
	
	// 查看项目基本信息
	function findProInfo($project_id) {
		$db = new DB ();
		$result = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
		
		$result1 = $db->GetInfo1 ( $result ['org_code'], 'org_info', 'org_code' );
		
		$result2 = $db->GetInfo1 ( $result ['project_type'], 'project_type', 'name' );
		
		$result3 ['project_start'] = date ( "Y-m-d", $result2 ['apply_start'] );
		$result3 ['project_end'] = date ( "Y-m-d", $result2 ['apply_end'] );
		
		$projectList = array (
				'project_name' => $result ['project_name'],
				'project_id' => $result ['project_id'],
				'domain' => $result ['tech_area'],
				'project_type' => $result ['project_type'],
				'project_engineer' => $result ['project_engineer'],
				'apply_start' => $result3 ['project_start'],
				'apply_end' => $result3 ['project_end'],
				'org_name' => $result1 ['org_name'] 
		);
		ob_clean();
		echo json_encode ( $projectList );
		$db->Close ();
	}
	function deluser($id) {
		$db = new DB ();
		$sql = "update login_info set isForbidden=1 where id='$id'";
		$db->Update ( $sql );
		$sql2 = "select project_id  from  project_info   where user_id= $id ";
		$result = $db->Select ( $sql2 );
		$project_id = $result[0]['project_id'];
		$sql3 = "update table_status  set  open =0  where project_id= $project_id";
		$db->Update ( $sql3 );
		// echo $sql;
		$db->Close ();
	}
	function querydelusers($page, $rows, $department) {
		$page = ($page - 1) * $rows;
		// 这里的department 是什么意思
		$sql = "select * from login_info where department = $department and isForbidden = 1";
		$sqlCount = "select count(id) as 'count' from login_info where department = $department and isForbidden = 1";

		$db = new DB ();
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = ( array ) $db->select ( $sql );
		$count = $db->select ( $sqlCount );
		$count = $count [0] ['count'];
		$i = 0;
		foreach ( $result as $tmp ) {
			$adminArr [$i] = array (
					'id' => $tmp ['id'],
					'username' => $tmp ['username'],
					'realname' => $tmp ['realname'],
					'phone' => $tmp ['phone'],
					'email' => $tmp ['email'],
					'isForbidden' => $tmp ['isForbidden'] 
			);
			$i = $i + 1;
		}
		$adminJSON = '{"total":' . $count . ',"rows":' . json_encode ( $adminArr ) . '}';
		ob_clean();
		echo $adminJSON;
		$db->Close ();
	}
	
	//单个启用;
	function recover($id) {
		$db = new DB ();
		$sql = "update login_info set isForbidden = 0 where id='$id'";
		$result = $db->Update ( $sql );
		echo $result;
		$db->Close ();
	}
	//批量启用;
	function recUsers($user_ids)
	{
	    $list_id = explode ( ',', $user_ids );
	    $db = new DB();
	    $sql = 'update login_info set isForbidden = 0 where id=';
	    for($i = 0;$i<count($list_id);$i++)
	    {
	        $db->Update($sql.$list_id[$i]);
	        echo $sql.$list_id[$i];
	    }
	    $db->Close();
	}
	// 2015.12.01加入 临时链接方法
	function checklist($department, $project_type, $stage) {
		$db = new DB ();
		$sql = '';
		$number = 0;
		
		if ($stage != 4) {
			$sql = "Select * from project_info where department = '$department' and project_type = '$project_type' and project_stage = $stage";
		} else {
			$sql = "Select * from project_info where department = '$department' and project_type = '$project_type'";
		}
		$result = $db->SelectOri ( $sql );
		
		// echo $department." ".$project_type;
		
		while ( $object = mysql_fetch_object ( $result ) ) {
			$projectList = array (
					'project_name' => $object->project_name,
					'project_id' => $object->project_id,
					'domain' => $object->tech_area,
					'project_type' => $object->project_type,
					'project_engineer' => $object->project_engineer,
					'apply_start' => $object->project_start,
					'apply_end' => $object->project_end,
					'org_name' => $object->org_name 
			);
			ob_clean();
			echo json_encode ( $projectList );
		}
		$db->Close ();
		
		// 以下是材料的显示啊
		
		while ( $object = mysql_fetch_object ( $result ) ) {
			$sql_tab = "select * from table_status where project_id = '$object->project_id' and project_stage = '$object->project_stage' ";
			$result_tab = $db->SelectOri ( $sql_tab );
			while ( $object_tab = mysql_fetch_object ( $result_tab ) ) {
				if (($object_tab->table_status > 1 && $object_tab->table_status < 4) || $object_tab->table_name == '项目中期报告') {
					$number = $number + 1;
					$typeList = array (
							'id' => $number 
					)
					;
				}
			}
			// function issuper($department,$user_type){
			// $isSuper = array(
			// 'user_type' => $user_type,
			// 'department' => $department
			// );
			// return json_encode($isSuper);
			// }
		}
	}
	
	public function email_send($id,$title,$str) {
		$db = new DB ();
		$sql = "select user_id from project_info where project_id='$id'";
		$result = $db->Select ($sql);
		$user_id = $result [0] ["user_id"];
		$email_sql = "select email from login_info where id='$user_id'";
		$email_result = $db->Select ($email_sql);
		$email = $email_result [0]['email'];
		$common=new COMMON();
		$common->email_send($email,$title,$str);
	}
	
	
	public function treeData(){
	    $db = new DB();
	    /* switch ($_SESSION['department']){
	        case 0:
	            $dep = '发展计划科';
	            break;
	        case 1:
	            $dep = '知识产权科';
	            break;
	        case 2:
	            $dep = '科技综合科';
	            break;
	        default:
	            $dep = $_SESSION['department'];
	            break;
	    } */
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
	    $treeJson = array();
	    if($dep!=-1){
	        $year_sql = "select distinct save_year from project_info where department = '$dep'";
	    }else{
	        $year_sql = "select distinct save_year from project_info";
	    }
	    $year_tree = $db -> Select($year_sql);
	    $j = 0;
	   /*  $treeJson[0] = array(
	        'id'=>0,
	        'text'=>"储存项目",
	        'state'=>"open",
	        //      'children'=>$childrenJson
	        'children'=>$this->treeDataChild($item['save_year'])
	    ); */
	    foreach($year_tree as $item){
            if(isset($item['save_year']) ){
                $treeJson[$j] = array(
                    'id'=>$j,
                    'text'=>$item['save_year']."年项目",
                    'state'=>"open",
              //      'children'=>$childrenJson
                    'children'=>$this->treeDataChild($item['save_year'])
                );
                $j++;
            }
	       
	    }
	    if(!count($treeJson)){
	        $treeJson[$j] = array(
	            'id'=>$j,
	            'text'=>"当前没有存档项目",
	            'state'=>"open",
	            'children'=>null
	        );
	    }
	   
// 	    ob_clean();
	    echo json_encode($treeJson);
	}
	//新加入的函数用来查询存档项目
	function treeDataChild($year){
	    $db = new DB();
	    $user_type = $_SESSION['user_type'];
	    $ptid_str = Pri::instance()->get_check_ptids(4,true);
	    //加入对科室的区分
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
	    if($dep != -1){
	        $sql = "Select * from project_info where department='$dep' and save_year = $year and project_type in (select id from project_type where inherit_val = 0) group by project_type";
	    }else{
	        $sql = "Select * from project_info where save_year = $year and project_type in (select id from project_type where inherit_val = 0) group by project_type";
	    }
	    // echo $sql;
	    //2016.2.28  david add
	    if($ptid_str == null || $ptid_str == ''){
	        $ptid_str = -1;
	    }
	    $result = $db -> Select($sql);
	    if($user_type != 3){
	        $department = $_SESSION['department'];
	        $project_sql = "select * from project_type where dep_type = $department and inherit_val = 0";
	        if($user_type !=2 ){
	            $project_sql .= " and id in ({$ptid_str})";
	         //   echo 'ptid_str'.$ptid_str;
	        }
	    }else{
	        //david 2015.1.05
	        $project_sql = "select * from project_type where dep_type > -1";
	    }
	    $result_tree = $db -> Select($project_sql);
	    $i = 0;
// 	    echo $project_sql;exit();
	    foreach($result_tree as $item){
	        //加入判断
	        foreach($result as $tmp){
	            if($tmp['project_type'] == $item['id']){
	                $childrenJson[$i] = array(
	                    'id'=>$item['id'],
	                    'text'=>$item['name'],
	                    'checked'=>false,
	                );
	                $i++;
	            }
	        }
	    }
	    return $childrenJson;
	    $db ->Close();
	}
	//开启验收阶段;
	public function MidStatus($project_id){
	    $db = new DB();
	    $data = array();
// 	    $sql_project = "Select * from table_status where table_name = 15 and project_id = '$project_id' ";
	    $project_result = $db -> GetInfo2(15, 'table_status', 'table_name', $project_id, 'project_id');
// 	    echo $project_result['table_status'];
	    if($project_result == null){
	        $data['code'] = 0; //0:中期计划表为空
	    }
	    else{
	        if($project_result['table_status'] == 1 || $project_result['table_status'] == 3){
	            $data['code'] = 1; //1:中期报告为待提交的状态
	        }
	        else if($project_result['table_status'] == 2){
	            $data['code'] = 2;//2:为审核中的状态
	        }
	    }
	    $modify_report = $db -> GetInfo2(14, 'table_status', 'table_name', $project_id, 'project_id');
// 	    var_dump($modify_report);exit();
	    if($modify_report['table_status'] == 2 || $modify_report['table_status'] ==3){
	            $data['code'] = 3; 
	    }
	    ob_clean();
	    echo json_encode($data);
	    $db -> Close();
	}
	
	
	public function checkHtml($project_id){
	    $db = new DB();
	    $sql = "select * from check_status where project_id = '$project_id'";
	    $result = $db -> Select($sql);
	    echo $result[0]['html'];
	    $db -> Close();
	}
	
	public function passStatus($project_id){
	    $db = new DB();
	    $sql = "select * from check_status where project_id = '$project_id'";
	    $result = $db -> Select($sql);
	    if(!isset($result)){
	        $data['code'] = 0; 
	    }else{
	        $data['code'] = 1;
	        $data['pass'] = $result[0]['ispass'];
	    }
	    $db -> Close();
	    echo json_encode($data);
	}
	
	//查找项目工程师;
	function findEngineer($project_id){
	    $db = new DB();
	    $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
	    $result = $db->GetInfo1($result['project_type'],'project_type','id');
	    $dep_type = $result['dep_type'];
	    $sql = "select * from admininfo where department = '$dep_type'";
	    $result = $db->Select($sql);
	    $count = 0;
	    foreach ($result as $tmp){
           $json[$count] = array(
                'value'=>$tmp['realname'],
                'text'=>$tmp['realname']
            );
           $count ++;
        }
        $db -> Close();
        echo json_encode($json);
	}
	
	/* //添加项目查重的数据入库;
	function addCheck($project_id,$url,$username,$password,$database){
	    $db = new DB();
	    $result = $db -> GetInfo1($project_id, 'check_status', 'project_id');
	    if(!empty($result) && $result['ispass'] == 1){
	        $conn = mysql_connect($url,$username,$password);
	        mysql_select_db($database,$conn);
	        $sql = "update contentinfo set category = 0 where project_id = '$project_id'";
	       // echo $sql.PHP_EOL;exit();
	        $re = mysql_query($sql);
	        mysql_close($conn);
	        if($re){
	            $resultJson['check'] = true;
	        }else{
	            $resultJson['check'] = false;
	        }
	    }
	    $db -> Close();
	} */
}

