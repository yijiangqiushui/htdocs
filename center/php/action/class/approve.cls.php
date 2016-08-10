<?php
class APPLY {
	/* function approveinfo($page, $rows, $project_id) {
	    global $global_table_status;
		$sql_project = "Select * from project_info where project_id='".$project_id."'";
// 		echo $sql_project;
		$db = new DB ();
		$url="";
		// 查找
		$result_project = $db->Select1 ( $sql_project );
		$project = mysql_fetch_object ( $result_project );
		$project_stage = $project->project_stage;
		$sql = "Select * from table_status where project_id='".$project_id."' and table_status > 1 order by project_stage asc,table_status asc";
// 		echo $sql;
		$result = $db->Select1 ( $sql );
		$row_n = mysql_num_rows ( $result );
		$count = - 1;  
		for($i = 1; $i <= $row_n; $i ++) {
			$count ++;
			$row = mysql_fetch_object ( $result );
			//table_name现在为id了
			$result_table = $db->GetInfo($row->table_name,'table_type');
			$approlist [$count] ['thing'] = $result_table['name'];
			$last_modify = date ( 'Y/m/d', $row->last_modify );
			$approlist [$count] ['recent_date'] = $last_modify;
			
			//得到check_repeat  的值
			$approlist [$count] ['check_repeat'] =$row->check_repeat;
			//封装project_id,因为后面会用到
			$approlist [$count] ['project_id']=$project_id;
			// 这个之后可以通过计算当前填完的表格来判断当前的状态
			
			$state = $global_table_status[$row->table_status]['status'];
			//2015.12.9加入,实施方案，待审核的状态，提交了相应的资料，需要进入到后台的待查重状态
			//这里改为查重状态，
			
			//2015.12.25加入，david修改。
// 			if($row->table_name == "北京市通州区科技计划项目实施方案" && $state == "待审核" && $row->check_repeat=="1"){
            
			if($row->table_name == "1" && $state == "审核中" && $row->check_repeat=="1"){ 
			    $approlist [$count] ['recent_state'] = "待查重";
			    
			}else{
			    $approlist [$count] ['recent_state'] = $state;
			}
			
			//if($row->table_name == "北京市通州区科技计划项目实施方案" && $state == "待审核" && $row->check_repeat=="3"){
			 if($row->table_name == "1" && $state == "审核中" && $row->check_repeat=="3"){
			    $approlist [$count] ['recent_state'] = "查重未通过";
			}

			if ($row->approval_time != null) {
				$approve_time = date ( 'Y/m/d', $row->approval_time );
				$approlist [$count] ['check_date'] = $approve_time;
			} else {
				$approlist [$count] ['check_date'] = "";
			}
			
			//2015.12.25 david修改
            $url = $result_table['url'];
            $url=$url."?table_id=".$row->table_name;
			$approlist [$count] ['url'] =$url;
			$approlist [$count]['table_status'] = $row->table_status;
			$approlist [$count]['table_id'] = $row->table_name;
			
			//2015.1.02  增加了项目
			$approlist[$count]['project_id'] = $project_id;
		}
		$typeJSON = '{"total":' . ($count + 1) . ',"rows":' . json_encode ( $approlist ) .'}';
		ob_clean();
		echo $typeJSON;
		$db->Close ();
	}  */
    // 新加入的approveinfo()方法;
     function approveinfo($page,$rows,$project_id){
        global $global_table_status;
        $db = new DB();
        $sql = '';
        $result = '';
        $result_name = '';
        $table_type = array();
        //定义分页计数器和编码工具;
        $count = -1;
        $approve = array();
        $i = 0;
        //加入查重部分的内容
        $result = $db->GetInfo1($project_id, 'check_status', 'project_id');
        $ispass = $result['ispass'];
        $pdf_url = $result['pdf_url'];
        $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $project_type_id = $result['project_type'];
        $project_stage = $result['project_stage'];
        $sql = "select * from project_check_relative where project_type_id = $project_type_id";
        $table_type = $db->Select($sql);
        //加入参数值;
        $result = $db->GetInfo1($project_id, 'project_info', 'project_id');
        $project_name = $result['project_name'];
        $org_code = $result['org_code'];
        $project_type = $result['project_type'];
        $result = $db->GetInfo1($org_code, 'org_info', 'org_code');
        $org_name = $result['org_name'];
        //查询table_status表中的数据，并将其进行json编码
        $sql = "Select * from table_status where project_id='$project_id' and table_status > 1 order by project_stage asc,table_status asc";
        $result = $db->Select($sql);
        //进行查询值并编码
        foreach($result as $tmp){
            $count++;
            //获取“填写事项”的值和url;
            $result_name = $db->GetInfo($tmp['table_name'], 'table_type');
            $approve[$count]['name'] = $result_name['name'];
            $url = $result_name['url'];
            $url=$url."?table_id=".$tmp['table_name'];
            $approve[$count]['url'] = $url;
            $approve[$count]['pdf_url'] = $pdf_url;
            //对ispass加入判断;
            foreach($table_type as $temp)
            {
                if($tmp['table_name'] == $temp['table_type_id'])
                {
                    $approve[$count]['ispass'] = $ispass;
                    $approve[$count]['pdf_url'] = $pdf_url;
                }
            }    
            //获取“最近办理时间”;
            $last_modify = date ( 'Y/m/d', $tmp['last_modify'] );
			$approve[$count] ['last_modify'] = $last_modify;
			
			//获取“当前状态” 目前暂定为table_status之后还需要和查重结果相关联;
			$status = $tmp['table_status'];
			$status = $global_table_status[$status]['manageStatus'];
			
			$approve[$count]['status'] = $status;
			
			//获取“审核时间” 
			$approval_time = $tmp['approval_time'];
			if($approval_time != null)
			{
			    $approve[$count]['approval_time'] = date('Y/m/d',$approval_time);
			}
			else
			{
			    $approve[$count]['approval_time'] = "";
			}
			//将table_status和table_id加入approve中
			$print_url =$db->GetInfo( $tmp['table_name'], "table_type");
			$approve[$count]['print_url'] = $print_url["pdf_url"];
			$approve[$count]['table_status'] = $tmp['table_status'];
			$approve[$count]['table_id'] = $tmp['table_name'];
			$approve[$count]['project_id'] = $project_id;
			$approve[$count]['project_type'] = $project_type;
			$approve[$count]['project_name'] = $project_name;
			$approve[$count]['org_name'] = $org_name;
			$approve[$count]['project_stage'] = $project_stage;
        }
        //json编码
        $typeJSON = '{"total":' . ($count + 1) . ',"rows":' . json_encode ( $approve ) .'}';
       // ob_clean();
        echo $typeJSON;
        $db->Close ();
    } 

}
?>