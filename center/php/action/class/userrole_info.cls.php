<?php

class APPLY {	
	function userrole($page, $rows,$department_type) {
		session_start ();
		$page = ($page - 1) * $rows;
		global $global_department;
		$department = $global_department[$department_type]['name'];
		
		$db = new DB ();
		$sql = "Select * from project_type where isfather=1";
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = $db->SelectOri ( $sql );
		$row_n = mysql_num_rows ( $result );
		$num = 0;
		// 总记录数
		$count = -1;
		// 返回结果
		
		for($i = 1; $i <= $row_n; $i ++) {
			$father = mysql_fetch_object ( $result );
			// 用来判断当前的父节点是否存在子节点
			$id = $father->id;
			// 当前父节点中子节点的个数
			
			$sql1 = "Select * from project_type where father='$id' and dep_type = '$department_type'";
// 			echo $sql1;
//			子类
			$result1 = $db->Select1 ( $sql1 );
// 			echo $result1;
			$row_m = mysql_num_rows ( $result1 );
			if ($row_m != 0) {
				// 总记录数加1
				$count=$count+1;
				$num = $num + 1;

				$typeList [$count] ["serial_num"] = $num;
				$typeList [$count] ["id"] = $id;
				$typeList [$count] ["name"] = $father->name;
				$typeList [$count] ["apply_status"] = $father->apply_status;
				$typeList [$count] ["open"] = 1;
				// echo "<td width='400' align='center'><strong>" . $father->name . "</strong></td>";
				
				if ($father->id == $father->father) {
					// 若当前是正在申报的状态则显示当前的时间以及将按钮自动到开启的上面
					if ($father->apply_status == 1) {
						$start_time = date ( 'Y/m/d', $father->apply_start );
						if ($father->apply_end != null) {
							$end_time = date ( 'Y/m/d', $father->apply_end );
						} else {
							$end_time = '未指定';
						}
						// 第5个参数
						$typeList [$count] ["date"] = $start_time . "——" . $end_time;
					} else {
						//$typeList [$count] ["open"] = 0;
						/*
						 * //开启 关闭 有待商榷 怎么样显示这种情况
						 * // echo "<td width='100' align='center'><input type='radio' checked='true' name='$id' onclick='closeProject(this);'/><span>关闭</span></td>";
						 * // echo "<td width='100' align='center'><input type='radio' name='$id' onclick='show(this);'/><span>开启</span></td>";
						 * // 这个地方需要修改，这里是个日期的控件
						 * $start_tmp = ($father->name) . "_start";
						 * $end_tmp = ($father->name) . "_end";
						 * $typeList[$count]["date"]= $start_tmp . "——" . $end_tmp ;
						 * echo "<td width='400' align='center'><div id='$id' style='visibility:hidden;'>
						 * <input id='$start_tmp' style='width:30%;height:25px;font-size:0.8em;text-align:center;' class='dataRange' /> 至 ";
						 * echo "<input id='$end_tmp' style='width:30%;height:25px;font-size:0.8em;text-align:center;' class='dataRange' />";
						 * echo "<input name='$father->name' type='button' value='确定' style='font-size:0.8em;height:25px;' onclick='openProject(this);'/></div></td>";
						 */
					}
				} else {
					// 三个参数
					$typeList [$count] ["date"] = '';
				}
				
				for($j = 1; $j <= $row_m; $j ++) {
					$children = mysql_fetch_object ( $result1 );
					
					if ($children->father != $children->id) {
						$count ++;
						$typeList [$count] ["serial_num"] = $num . "." . $j;
						$typeList [$count] ["name"] = $children->name;
						$typeList [$count] ["id"] = $children->id;
						$typeList [$count] ["apply_status"] = $children->apply_status;
						if ($children->apply_status == 1) {
							$start_time = date ( 'Y/m/d', $children->apply_start );
							if ($children->apply_end != null) {
								$end_time = date ( 'Y/m/d', $children->apply_end );
							} else {
								$end_time = '未指定';
							}
							// 时间参数
							$typeList [$count] ["date"] = $start_time . "——" . $end_time;
						} else {
						}
					}
				}
			}
		}
		$len=0;
		foreach ($typeList as $val){
			$list[$len]['date']=$typeList[$len]['date'];
			$list[$len]['serial_num']=$typeList[$len]['serial_num'];
			$list[$len]['name']=$typeList[$len]['name'];
			$list[$len]['apply_status']=$typeList[$len]['apply_status'];
			//这个是判断前台是否显示 开启和关闭
			$list[$len]['id']=$typeList[$len]['id'];
			$list[$len]['open']=$typeList[$len]['open'];
			$len++;
		}
		//var_dump($typeList);exit;
		$typeJSON = '{"total":' . ($count+1) . ',"rows":' . json_encode ( $list ) . '}';
		ob_clean();
		echo $typeJSON;
		$db->Close ();
	}
	
	
function userroleall($page, $rows) {
		session_start ();
		$page = ($page - 1) * $rows;
		$db = new DB ();
		$sql = "Select * from project_type where dep_type > -1";
		$sqlCount = "Select count(id) as 'count' from project_type where dep_type > -1";
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$result = ( array )$db->Select( $sql );
		$count = $db -> Select($sqlCount);
        $count = $count[0]['count'];
        $i = 0;
        $typeList = array();
        
        foreach($result as $item){
            $start_time = date ( 'Y/m/d', $item['apply_start'] );
            if (isset($item['apply_end'])) {
                $end_time = date ( 'Y/m/d', $item['apply_end'] );
            } else {
            	//echo $item->apply_end;exit;
                $end_time = '未指定';
            }
            if($item['apply_status'] == 1){
                $open = 1;
            }
            else{
                $open = 0;
            }
            //var_dump($item);exit;
            $typeList[$i] = array(
                'id'=>$item['id'],
                'name'=>$item['name'],
//                 'serial_num'=>$item['serial_num'],
                'apply_status'=>$item['apply_status'],
                'open'=>$open,
                "date" =>  $start_time . "——" . $end_time,
            );
            $i++;
        }
       
	/* 	$row_n = mysql_num_rows ( $result );
		$num = 0;
		$count = -1;
		
		for($i = 1; $i <= $row_n; $i ++) {
			$father = mysql_fetch_object ( $result );
			$id = $father->id;
			
			$sql1 = "Select * from project_type where father='$id' ";
			$result1 = $db->Select1 ( $sql1 );
			$row_m = mysql_num_rows ( $result1 );
			if ($row_m != 0) {
				$count=$count+1;
				$num = $num + 1;
				$typeList [$count] ["serial_num"] = $num;
				$typeList [$count] ["id"] = $father->id;
				$typeList [$count] ["open"] = 1;
				$typeList [$count] ["apply_status"] = $father->apply_status;
				$typeList [$count] ["name"] = $father->name;
				if ($father->id == $father->father) {
					if ($father->apply_status == 1) {
						$start_time = date ( 'Y/m/d', $father->apply_start );
						if ($father->apply_end != null) {
							$end_time = date ( 'Y/m/d', $father->apply_end );
						} else {
							$end_time = '未指定';
						}
						$typeList [$count] ["date"] = $start_time . "——" . $end_time;
					} else {
					}
				} else {
					$typeList [$count] ["date"] = '';
					$typeList [$count] ["open"] = 0;
				}
				
				for($j = 1; $j <= $row_m; $j ++) {
					$children = mysql_fetch_object ( $result1 );
					
					if ($children->father != $children->id) {
						$count ++;
						$typeList [$count] ["serial_num"] = $num . "." . $j;
						$typeList [$count] ["id"] = $children->id;
						$typeList [$count] ["open"] = 1;
						$typeList [$count] ["apply_status"] = $children->apply_status;
						$typeList [$count] ["name"] = $children->name;
						if ($children->apply_status == 1) {
							$start_time = date ( 'Y/m/d', $children->apply_start );
							if ($children->apply_end != null) {
								$end_time = date ( 'Y/m/d', $children->apply_end );
							} else {
								$end_time = '未指定';
							}
							$typeList [$count] ["date"] = $start_time . "——" . $end_time;
						} else {
						}
					}
				}
			}
		}
		$len=0;
		foreach ($typeList as $val){
			
			$list[$len]['date']=$typeList[$len]['date'];
			$list[$len]['serial_num']=$typeList[$len]['serial_num'];
			$list[$len]['name']=$typeList[$len]['name'];
			$list[$len]['id']=$typeList[$len]['id'];
			$list[$len]['apply_status']=$typeList[$len]['apply_status'];
			//这个是判断前台是否显示 开启和关闭
			$list[$len]['open']=$typeList[$len]['open'];
			$len++;
		} */
		
	//	$typeJSON = '{"total":' . ($count+1) . ',"rows":' . json_encode ( $list ) . '}';
	    $typeJSON = '{"total":' . $count . ',"rows":' . json_encode ( $typeList ) . '}';
		ob_clean();
		echo $typeJSON;
		$db->Close ();
	}
}

?>