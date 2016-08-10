<?php
include '../../class/ActionBase.cls.php';
include CENTER_ROOTPATH."/modules/service/ProjectTypeService.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectTypeRelativeService.cls.php";
include CENTER_ROOTPATH."/modules/service/TableTypeRelativeService.cls.php";
include CENTER_ROOTPATH."/modules/service/TableTypeService.cls.php";
include CENTER_ROOTPATH."/modules/service/AdminInfoService.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectCheckUserListService.cls.php";
include CENTER_ROOTPATH."/modules/service/ProPriListDao.cls.php";
include CENTER_ROOTPATH."/modules/service/ProCheckPriMapDao.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectInfoService.cls.php";
include "../../../../../common/php/lib/log.cls.php";

class ProjectTypeControl extends ActionBase{
    
    public $view_dir = "action/page/project_type";
    private $is_super = false;
    
	function checkAdmin(){
		$status = 1; //0，表示超级管理员或者管理员授权  1表示普通用户
        if($_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3){
            $status = 0;
        }
        $this->admin_tag = $status;
        
        if(3 == $_SESSION['user_type']){
            $this->is_super = true;
        }
	}

    /**
     * get use for checkPri
     */

    function getCheckPri(){

        $this->checkAdmin();
        $data = array();

        $ptid = intval($_GET['ptid']);

        if(!$this->is_super){
            $data['department'] = $_SESSION['department'];
        }

        $users = AdminInfoService::instance()->get($data);
        $ret = array();
        foreach ($users as $val){

            $fc_arr = $this->getUserCheckPri($val['id'],$ptid);

            $ret[] = array(
                'user_id'=>$val['id'],
                'assignee'=>$fc_arr[0],//cjxmlx
                'engineer'=>$fc_arr[1],//cjxmlx
                'realname'=>$val['realname']
            );
        }
        echo json_encode($ret);
        exit;

    }

    /**
     * get visor
     */

    function getVisor(){
        $this->checkAdmin();
        $data = array();

        $ptid = intval($_GET['ptid']);

        $data['department'] = 3;

        $fc_arr = $this->getVisorPriByPtid($ptid);

        $users = AdminInfoService::instance()->get($data);
        $ret = array();
        foreach ($users as $val){

            $ret[] = array(
                'user_id'=>$val['id'],
                'user_status'=>in_array($val['id'],$fc_arr)?1:0,
                'realname'=>$val['realname']
            );
        }
        echo json_encode($ret);
        exit;
    }

    private function getVisorPriByPtid($ptid){
        $ret = ProPriListDao::instance()->getVisorPriByPtid($ptid);
        $arr = array();

        foreach($ret as $val){
            $arr[] = $val['admin_info_id'];
        }

        return $arr;

    }

	/**
	 * get user for pri
	 */
	function getUser()
	{
		$this->checkAdmin();
		$data = array();

		if(!$this->is_super){
			$data['department'] = $_SESSION['department'];
		}

		$users = AdminInfoService::instance()->get($data);
		$ret = array();
		foreach ($users as $val){
			$ret[] = array(
					'user_id'=>$val['id'],
					'user_status'=>$this->getUserPri($val['id'],"cjxmlx")?1:0,//cjxmlx
					'realname'=>$val['realname']
			);
		}
		echo json_encode($ret);
		exit;
	}
	
	function getUserPri($id,$module){
		$condition = array(
				"admin_info_id"=>$id,
				"prival"=>$module
		);
		$rets = ProPriListDao::instance()->get($condition);
		
		if(empty($rets)){
			return false;
		}
		
		return true;
		
	}

    /**
     * get check pri for user
     */
    function getUserCheckPri($uid,$ptid){

        $rets = ProCheckPriMapDao::instance()->get_pri_map_by_uid($uid);
        $fc_arr = array(0,0);

        foreach($rets as $val){
            if($val['project_type_id'] == $ptid){
                $fc_arr[$val['project_type_para_id']] = 1;
            }
        }

        return $fc_arr;

    }
	
    function index(){
        global $global_department;
        $data = array(
            'isfather'=>1,
			'dep_type'=>-1
        );
        $project_types = ProjectTypeService::instance()->get_project_type($data);
        //var_dump($project_types);
        foreach($project_types as $key=>&$val){
            if($val->dep_type < 0){
                $val->dep_name = "";
                //
            }else{
                //$val->dep_name = $global_department[$val->dep_type]['name'];
                //var_dump($global_department);
            }
        }
		
		$this->checkAdmin();
		
		$ret_all = $this->get_table_type();
		
		$this->assign ("table_types",$ret_all);
		$this->assign("is_super",$this->is_super);
        $this->assign("project_types",$project_types);
        $this->assign("departments",$global_department);
        $this->display("define.php");
    }
    
    function get_edit_form(){
        
        $msgcode = 100;
        
        $id = intval($_POST['str_id']);
        $condition = array(
            'id'=>$id
        );
        
        $ret = TableTypeRelativeService::instance()->get($condition);
        
        if($ret){
            $ret = $ret[0]['rules'];
        }else{
            $msgcode = 100;
        }
        
        $this->response($msgcode,$ret);
    }
    
    function edit(){
		global $global_department;
        $data = array(
            'isfather'=>1,
			'dep_type'=>-1
        );
		$ptid  = isset($_GET['ptid'])?intval($_GET['ptid']):0; //father id
		if(empty($ptid)){
			exit("非法参数");
		}
        $project_types = ProjectTypeService::instance()->get_project_type($data);
        //var_dump($project_types);exit;
        foreach($project_types as $key=>&$val){
            if($val['dep_type'] < 0){
                $val['dep_name'] = "";
            }else{
                //$val['dep_name'] = $global_department[$val->dep_type]['name'];
            }
        }
		
		$this->checkAdmin();
		
		$ret_all = $this->get_table_type();
		
		//update father id
		$condition = array('id'=>$ptid);
		$pts_arr = ProjectTypeService::instance()->get_project_type($condition);
		//var_dump($project_types) ;exit;
		if(empty($pts_arr)){
			exit("非法参数");
		}
		
		$pro_type = $pts_arr[0];
		//var_dump($project_types) ;exit; 
		$_SESSION['pt_edit_id'] = $pro_type['id'];
		$this->assign ("pro_type",$pro_type);
		$this->assign ("table_types",$ret_all);
		$this->assign ("edit_table",$this->get_edit_table($pro_type,$ret_all));
		$this->assign("is_super",$this->is_super);
        $this->assign("project_types",$project_types);
        $this->assign("departments",$global_department);
        $this->display("edit.php");
    }
	
	function get_edit_table($pro_type,$table_types){
		
		$tt_selected = explode(",",$pro_type['attatch_name']);
		
		$stage_arr = array(
			array(
			'val'=>'apply_stage',
			'name'=>"申报阶段"
			),
			array(
			'val'=>'setup_stage',
			'name'=>"立项阶段"
			),
			array(
			'val'=>'carry_stage',
			'name'=>"实施阶段"
			),
			array(
			'val'=>'check_stage',
			'name'=>"验收阶段"
			)
		);
		
		$table_str = "";
		foreach($stage_arr as $key=>$item){
			$line_str = '<div><label><input name="Fruit" type="checkbox" checked value="'.$key.'" /> '.'<span name= "'.$key.'">'.$item['name'].'</span>'.' </label>（';
			if(!$pro_type[$item['val']])
			{ 
				$line_str = str_replace("checked","",$line_str);
			}
			$i = 0;  
			foreach($table_types[$key] as $sitem){
				if($i&&($i%2 == 0)){
					$line_str .= "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				}
				$i++;
				$temp_str ='<label><input name="table_list" type="checkbox" checked value="'.$sitem['id'].'" />'.$sitem['name'].'</label>';
				
				if(!in_array($sitem['id'],$tt_selected)){
					$temp_str = str_replace("checked","",$temp_str);
				}
				$line_str .= $temp_str;
			}
			$line_str .= '）</div>';
			
			$table_str .= $line_str;
		}
		
		return $table_str;
		
	}
	
	// 2016.01.7 david modify
	function del_define(){
		$ptid  = isset($_GET['ptid'])?intval($_GET['ptid']):0; //father id
		$t_str = $_GET['t_str'];
		$t_str_arr = explode("|",$t_str);
		$t_str_arr_ly = array($ptid);
		
		foreach($t_str_arr as $val){
			if(intval($val)){
				$t_str_arr_ly[] = intval($val);
			}
		}
		
		foreach($t_str_arr_ly as $val){
			$condition = array(
				'id'=>$val
			);

			//2016.01.07 david
			$data = array(
			    'is_delete'=>1
			);
// 			$ret = ProjectTypeService::instance()->delete($condition);
			$ret = ProjectTypeService::instance()->update($condition, $data);
            
		}
		
		header("Location:control.php?action=admin");
		exit;
	}


    /**
     * update is_public
     */

    function pub_define(){
        $ptid  = isset($_GET['ptid'])?intval($_GET['ptid']):0; //father id
        $t_str = $_GET['t_str'];
        $t_str_arr = explode("|",$t_str);
        $t_str_arr_ly = array($ptid);

        foreach($t_str_arr as $val){
            if(intval($val)){
                $t_str_arr_ly[] = intval($val);
            }
        }

        foreach($t_str_arr_ly as $val){
            $condition = array(
                'id'=>$val
            );

            //2016.01.07 david
            $data = array(
                'is_public'=>1
            );
            $ret = ProjectTypeService::instance()->update($condition, $data);
			
			$ret = ProjectTypeService::instance()->get_project_type($condition);
			
			if($ret[0]['father'] && $ret[0]['father']!=$val){
				$condition = array(
					'id'=>$ret[0]['father']
				);
				
				$ret = ProjectTypeService::instance()->update($condition, $data);
			}
			

        }

        header("Location:control.php?action=admin");
        exit;
    }
	
	function get_table_type(){
		$condition = array(
		);
		
		$order = "stage asc";
		
		$ret = TableTypeService::instance()->get($condition,$order);
		//var_dump($ret);
		$ret_all = array();
		
		foreach($ret as $item){
			$ret_all[$item['stage']][] = $item;
		}
		
		return $ret_all;
		
	}
    
    function create_define(){
        $msgcode = 100;
        $ptname  = $_POST['ptname'];
		$fid  = isset($_POST['ptid'])?intval($_POST['ptid']):0; //father id
		$dpid  = isset($_POST['dpid'])?intval($_POST['dpid']):0; //dp_type id
		$dpid  = $_SESSION['department'];
        $changeFile1  = $_POST['changeFile1'];
        $changeFile2  = $_POST['changeFile2'];
        $cf_arr = array('ssfa'=>2,'rws'=>1);//任务书ID 和 实施方案ID
        $local_tag = intval($_POST['local_tag']);
		$dep_type = $_SESSION['department'];
		$local_str = $_POST['local_str'];
		$t_str = $_POST['t_str'];
		$hasChildren = $_POST['children'];
		$pt_child_name  = $_POST['pt_child_name'];
        if(empty($ptname)){
            $this->response($msgcode,null);
        }
		
		//if($this->is_super&&isset($_POST['dpid'])){
		//	$dpid = intval($_POST['dpid']);
		//}

		if(isset($_POST['dpid'])){
			$dpid = intval($_POST['dpid']);
		}
		
		$local_str_arr = explode("|",$local_str);
		$t_str_arr = explode("|",$t_str);
		$t_str_arr_ly = array();
		
		foreach($t_str_arr as $val){
			if(intval($val)){
				$t_str_arr_ly[] = intval($val);
			}
		}
		
		$t_new_str = implode(",",$t_str_arr_ly);
		
		$stage_arr = array(
			'apply_stage',
			'setup_stage',
			'carry_stage',
			'check_stage'
		);
		
		
		$data = array(
            "name"=>$ptname,
			"dep_type"=>$dep_type,
            "is_new"=>1,
			"dep_type"=>$dpid,
			"attatch_name"=>$t_new_str
        );
		
		
		foreach($stage_arr as $key=>$val){
			if(in_array(strval($key),$local_str_arr)){
				$data[$val] = 1;
			}else{
				$data[$val] = 0;
			}
		}
		
		if($fid){
			$data['father'] = $fid;
		}else{
			$data['isfather'] = 1;
		}
		//处理子类的自定义类型
		if($hasChildren){
			$data['isfather'] = 1;
			$data['dep_type'] = -1;
			$data['father'] = "";
			//先插入父类数据
			$ret = ProjectTypeService::instance()->insert($data);
			if($ret){
				$data['father'] = $ret;
			}
			$data['name'] = $pt_child_name;
			$data['dep_type'] = $dpid;
			$data['isfather'] = 0;
		}
		
        //var_dump($data);exit;
        $ret = ProjectTypeService::instance()->insert($data);
        
        if($ret){
			$ptid = $ret;
			$_SESSION['pt_edit_id'] = $ptid;
			if($data['isfather']&&!$hasChildren){
				//update father id
				$data = array('father'=>$ptid);
				$condition = array('id'=>$ptid);
				ProjectTypeService::instance()->update($condition,$data);
			}
            //copy all the sublist   $t_str_arr_ly
            //if($local_tag){
				//foreach($cf_arr as $key=>$ttid){
				
			//david 2015.1.6  modify  
				foreach($t_str_arr_ly as $table_item ){
				    $condition = array(
				        'project_type_id'=>0,
				        'table_type_id'=>$table_item,
				        //'table_type_id'=>$ttid,
				    );
				    
				    $ret = TableTypeRelativeService::instance()->get($condition);
				    	
				    foreach($ret as $item){
				    
				        $data = array(
				            'project_type_id'=>$ptid,
				            'para_id'=>$item['para_id'],
				            'table_type_id'=>$item['table_type_id'],
				            'subtable_list_id'=>$item['subtable_list_id'],
				            'sort_id'=>$item['sort_id'],
				            'status'=>$item['status'],
				            //2016.01.07 david
				            'is_edit'=>$item['is_edit']
				        );
				        // 						var_dump($data);
				    
				        $r = TableTypeRelativeService::instance()->insert($data);
				    }
				}
				
					
					
					
					
				//}
            //}
			
			/*
			插入新内容，同时更新table_status的关联关系
			*/
		/*	foreach($t_str_arr_ly as $val){
				//get
				$condition = array(
					'id'=>$val,
					//'table_type_id'=>$ttid,
				);
				
				$ret = TableTypeService::instance()->get($condition);
				//update
				if($ret&&$ret[0]){
					$new_str = $val;
					if($ret[0]['project_type']){
						$new_str = $ret[0]['project_type'].",".$ptid;
					}
					$data = array('project_type'=>$new_str);
					TableTypeService::instance()->update($condition,$data);
				}
			}
		*/      
// 				var_dump($t_str_arr_ly);exit();
                //默认的实施方案查重设置
				if(in_array(1, $t_str_arr_ly)){
				    $this->DefaultCarryCheckSet($ptid);
				}
				//默认的专利
				if(in_array(22, $t_str_arr_ly)){
				    $this->DefaultPatentCheckSet($ptid);
				}
				//默认的人才
				if(in_array(20, $t_str_arr_ly)){
				    $this->DefaultTalentCheckSet($ptid);
				}
				
				if(in_array(12, $t_str_arr_ly)){
				    $this->DefaultAssignCheckSet($ptid);
				}
        }
        
        $this->response($msgcode,$ptid);
    }
    
    //用来设置当前的默认实施方案查重设置
    function DefaultCarryCheckSet($ptid){
        $db = new DB();
        $sql = "select * from subtable_list A join (select subtable_list_id,project_type_id,table_type_id from table_type_relative where project_type_id = 0 and table_type_id = 1) B on (A.id = B.subtable_list_id) where A.is_check = 1";
                
        $result = $db -> Select($sql);
        //         var_dump($result);exit();
        foreach($result as $item){
            if($item['id'] == 4 || $item['id'] == 5 || $item['id'] == 6){
                $data = array(
                    'project_type_id'=>$ptid,
                    'table_type_id'=>1,
                    'subtable_id'=>$item['id'],
                    'weight'=>0.2,
                    'status'=>0
                );
                $r = $db->InsertData('project_check_relative', $data);
            }
        }
        $db->Close();
    }
    
    //默认的专利
    function DefaultPatentCheckSet($ptid){
        $db = new DB();
        $sql = "select * from subtable_list A join (select subtable_list_id,project_type_id,table_type_id from table_type_relative where project_type_id = 0 and table_type_id = 22) B on (A.id = B.subtable_list_id) where A.is_check = 1";
//         echo $sql;exit();
        $result = $db -> Select($sql);
        foreach($result as $item){
//             var_dump($item);exit();
            
            if($item['id'] == 1981 || $item['id'] == 1983){
                $data = array(
                    'project_type_id'=>$ptid,
                    'table_type_id'=>22,
                    'subtable_id'=>$item['id'],
                    'weight'=>0.2,
                    'status'=>0
                );
                $r = $db->InsertData('project_check_relative', $data);
            }
        }
        $db->Close();
    }
    
    //默认的人才
    function DefaultTalentCheckSet($ptid){
        $db = new DB();
        $sql = "select * from subtable_list A join (select subtable_list_id,project_type_id,table_type_id from table_type_relative where project_type_id = 0 and table_type_id = 20) B on (A.id = B.subtable_list_id) where A.is_check = 1";
                $result = $db -> Select($sql);
        foreach($result as $item){
            if($item['id'] == 1965){
                $data = array(
                    'project_type_id'=>$ptid,
                    'table_type_id'=>20,
                    'subtable_id'=>$item['id'],
                    'weight'=>0.2,
                    'status'=>0
                );
                $r = $db->InsertData('project_check_relative', $data);
            }
        }
        $db->Close();
    }
    
    //默认的任务书查重设置
    function DefaultAssignCheckSet($ptid){
        $db = new DB();
        $sql = "select * from subtable_list A join (select subtable_list_id,project_type_id,table_type_id from table_type_relative where project_type_id = 0 and table_type_id = 12) B on (A.id = B.subtable_list_id) where A.is_check = 1";
        $result = $db -> Select($sql);
        foreach($result as $item){
            if($item['id'] == 14 || $item['id'] == 15 || $item['id'] == 16){
                $data = array(
                    'project_type_id'=>$ptid,
                    'table_type_id'=>12,
                    'subtable_id'=>$item['id'],
                    'weight'=>0.2,
                    'status'=>0
                );
                $r = $db->InsertData('project_check_relative', $data);
            }
        }
        $db->Close();
    }

    
    function edit_define(){
    	$msgcode = 100;
    	$ptname  = $_POST['ptname'];
    	$fid  = isset($_POST['ptid'])?intval($_POST['ptid']):0; //father id
    	$dpid  = isset($_POST['dpid'])?intval($_POST['dpid']):0; //dp_type id
    	$changeFile1  = $_POST['changeFile1'];
    	$changeFile2  = $_POST['changeFile2'];
    	$cf_arr = array('ssfa'=>2,'rws'=>1);//任务书ID 和 实施方案ID
    	$local_tag = intval($_POST['local_tag']);
    	$dep_type = $_SESSION['department'];
    	$local_str = $_POST['local_str'];
    	$t_str = $_POST['t_str'];
    	if(empty($ptname)){
    		$this->response($msgcode,null);
    	}
    
    	if($this->is_super&&isset($_POST['dpid'])){
    		$dep_type = intval($_POST['dpid']);
    	}
//     	var_dump($local_str);exit();
    	$local_str_arr = explode("|",$local_str);
    	$t_str_arr = explode("|",$t_str);
    	$t_str_arr_ly = array();
    
    	foreach($t_str_arr as $val){
    		if(intval($val)){
    			$t_str_arr_ly[] = intval($val);
    		}
    	}
    
    	$t_new_str = implode(",",$t_str_arr_ly);
    
    	$stage_arr = array(
    			'apply_stage',
    			'setup_stage',
    			'carry_stage',
    			'check_stage'
    	);
    
    
    	$data = array(
    			"name"=>$ptname,
    			"dep_type"=>$dep_type,
    			"is_new"=>1,
    			"dep_type"=>$dpid,
    			"attatch_name"=>$t_new_str
    	);
    
    
    	foreach($stage_arr as $key=>$val){
    		if(in_array(strval($key),$local_str_arr)){
    			$data[$val] = 1;
    		}else{
    			$data[$val] = 0;
    		}
    	}

    	if($fid){
    		$data['father'] = $fid;
    	}else{
    		$data['isfather'] = 1;
    	}
    	$ptid = $_SESSION['pt_edit_id'];
    	$condition = array('id'=>$ptid);
    	
    	$ret = ProjectTypeService::instance()->update($condition,$data);
		if($ret) {

			//删除原来的数据
			$relative_condition = array('project_type_id'=>$ptid);
			TableTypeRelativeService::instance()->del($relative_condition);
			foreach ($t_str_arr_ly as $table_item) {
				$condition = array(
					'project_type_id' => 0,
					'table_type_id' => $table_item,
					//'table_type_id'=>$ttid,
				);
				$ret = TableTypeRelativeService::instance()->get($condition);
				foreach ($ret as $item) {

					$data = array(
						'project_type_id' => $ptid,
						'para_id' => $item['para_id'],
						'table_type_id' => $item['table_type_id'],
						'subtable_list_id' => $item['subtable_list_id'],
						'sort_id' => $item['sort_id'],
						'status' => $item['status'],
						'is_edit' => $item['is_edit']
					);
					$r = TableTypeRelativeService::instance()->insert($data);
				}
			}
		}
    	
    	/*
    	if($ret){
    		$ptid = $ret;
    		$_SESSION['pt_edit_id'] = $ptid;
    		if($data['isfather']){
    			//update father id
    			$data = array('father'=>$ptid);
    			$condition = array('id'=>$ptid);
    			ProjectTypeService::instance()->update($condition,$data);
    		}
    		//copy all the sublist
    		//if($local_tag){
    		//foreach($cf_arr as $key=>$ttid){
    		$condition = array(
    				'project_type_id'=>0,
    				//'table_type_id'=>$ttid,
    		);
    			
    		$ret = TableTypeRelativeService::instance()->get($condition);
    			
    		foreach($ret as $item){
    
    			$data = array(
    					'project_type_id'=>$ptid,
    					'para_id'=>$item['para_id'],
    					'table_type_id'=>$item['table_type_id'],
    					'subtable_list_id'=>$item['subtable_list_id']
    			);
    
    			$r = TableTypeRelativeService::instance()->insert($data);
    		}
    			
    		//}
    		//}
    			
    		
    			插入新内容，同时更新table_status的关联关系
    			*/
    		/*	foreach($t_str_arr_ly as $val){
    		 //get
    		 $condition = array(
    		 'id'=>$val,
    		 //'table_type_id'=>$ttid,
    		 );
    
    		 $ret = TableTypeService::instance()->get($condition);
    		 //update
    		 if($ret&&$ret[0]){
    		 $new_str = $val;
    		 if($ret[0]['project_type']){
    		 $new_str = $ret[0]['project_type'].",".$ptid;
    		 }
    		 $data = array('project_type'=>$new_str);
    		 TableTypeService::instance()->update($condition,$data);
    		 }
    			}
    			
    			
    	}
    */
    	$this->response($msgcode,$ptid);
    
    }
    
    function edit_east_data(){
        $msgcode = 100;
        
        $edit_data = $_POST['edit_data'];
        //var_dump($edit_data);exit;
        if(empty($edit_data)){
            $this->response($msgcode,null);
        }
        
        $id = intval($_POST['str_id']);
        
        $is_new = 1;
        
        $condition = array(
            "id"=>$id
        );
        
        $data = array(
            "rules"=>$edit_data,
            "is_new"=>$is_new
        );
        
        $ret = TableTypeRelativeService::instance()->update($condition,$data);
        
        $this->response($msgcode,$ret);
        
    }
    
    function check_status(){ 
        $msgcode = 100;
    
        $check = $_POST['check'] == "true"?0:-1;
    
        
        if(stristr($_POST['str_id'],"p") === false){
            $id = intval($_POST['str_id']);
        }else{
            
            $table_type_id = intval(str_replace("p","",$_POST['str_id']));
            $ptid = intval($_SESSION['pt_edit_id']); //project_type_id 创建pt的时候留下一个
            
            if(!$ptid){
                $this->response($msgcode,$table_type_id);
            }
            
            $condition = array(
                "table_type_id"=>$table_type_id,
                "project_type_id"=>$ptid
            );
            
            $data = array(
                "status"=>$check
            );
            
            $ret = TableTypeRelativeService::instance()->update($condition,$data);
            
            $this->response($msgcode,$ret);
        }
        
        $id = intval($_POST['str_id']);
    
        $condition = array(
            "id"=>$id
        );
    
        $data = array(
            "status"=>$check
        );
    
        $ret = TableTypeRelativeService::instance()->update($condition,$data);
    
        $this->response($msgcode,$ret);
    
    }
    
    function get_west_data(){
        
        $ptid = $_SESSION['pt_edit_id'];
//         echo $ptid;
        $data = array(
            "project_type_id"=>$ptid,
            "join"=>array(
                "table"=>"subtable_list",
                "fkey"=>"subtable_list_id"
            )
        );
        
        $order = "table_type_id asc,sort_id asc";
        
        //$ret = TableTypeRelativeService::instance()->get($data,$order);
		
//         $sql = "select a.*,b.name,b.id as slid,b.tpl_url from table_type_relative as a join subtable_list as b on(a.subtable_list_id=b.id) where a.project_type_id={$ptid} order by table_type_id asc,sort_id asc";
// 		echo $sql;

        //2015.01.07  david 增加了一个is_edit字段，用来标示哪些表单需要进行自定义编辑操作
        $sql = "select a.*,b.name,b.id as slid,b.tpl_url from table_type_relative as a join subtable_list as b on(a.subtable_list_id=b.id) where a.project_type_id={$ptid} and a.is_edit=1 order by table_type_id asc,sort_id asc";
        
		$ret = TableTypeRelativeService::instance()->db->Select($sql);
		
        $parentId_arr = array();
        
        foreach($ret as &$val){
            $val['parentId'] = "p".$val['table_type_id'];
            if(!in_array($val['table_type_id'],$parentId_arr)){
                $parentId_arr[] = $val['table_type_id'];
            }
        }
        //var_dump($ret);//exit;
        
        foreach($parentId_arr as $item){
            $table_type = TableTypeService::instance()->get(array('id'=>$item));
            $tt_name = "";
            if($table_type){
                $tt_name = $table_type[0]['name'];
            }
            $ret[] = array(
                "id"=>"p".$item,
                "parentId"=>0,
                "name"=>$tt_name
            );
        }
        echo json_encode($ret);exit;
    }
    
    
    function subtable(){
        if($_GET['ptid']){
			$_SESSION['pt_edit_id'] = intval($_GET['ptid']);
		}
        $this->display("subtable.php");
    }
    
    function admin(){

        $this->checkAdmin();

        $pri_xj_tag = false;
        if($this->admin_tag == 0){
            $pri_xj_tag = true;
        }else{
			$pri_xj_tag = Pri::instance()->checkPri("cjxmlx");
		}

        $this->assign("xjadmin",$pri_xj_tag);
        $this->display("admin.php");
    }
    
    function queryAll(){
        
        global $global_department;
        
        $msgcode = 100;
        
        $page = intval($_POST['page']);
        $rows = intval($_POST['rows']);
        
        $page = $page?$page:1;
        $limit = array(($page - 1)*$rows,$rows);

        //2015.12.29 david 修改
        if($_SESSION['user_type']==3){
        	/* $data = array(
        	); */
            $data = "dep_type > -1 and is_delete = 0 and inherit_val = 0";
            $order = "id desc";
        }else{
        	$department = $_SESSION['department'];
        	/* $data = array(
        			'dep_type'=>$department
        	); */
        	
        	//2016.01.07 david
        	$data = "dep_type = $department and is_delete = 0 and inherit_val = 0";
        	$order = "id desc";
        }
		$project_types_all = ProjectTypeService::instance()->get_project_type($data,$order,null);
		$total = count($project_types_all);
		
		if(!isset($_POST['rows'])){
			$limit = null;
		}
		
        $project_types = ProjectTypeService::instance()->get_project_type($data,$order,$limit);
        foreach($project_types as $key=>&$val){
            if($val['dep_type'] < 0){
                $val['dep_name'] = "";
            }else{
                $val['dep_name'] = $global_department[$val['dep_type']]['name'];
            }
            //$start_time = date('Y/m/d',$val['apply_start']);
            
            if($val['apply_start'] != null){
            	$start_time = date('Y/m/d',$val['apply_start']);
            }else{
            	$start_time = '未指定';
            }
            
            if($val['apply_end'] != null){
               $end_time = date('Y/m/d',$val['apply_end']);
            }else{
                $end_time = '未指定';
            }
            $val['date'] = $start_time . "——" .$end_time;
            
            /**
             * 获取受理人和主管工程师列表
             */
        	$accept_name_res = ProCheckPriMapDao::instance()->get_pri_map_by_ptid($val['id'],0);
        	$acceptor = $accept_name_res['0']['gc_name'];
        	$engi_name_res = ProCheckPriMapDao::instance()->get_pri_map_by_ptid($val['id'],1);
        	$engineer = $engi_name_res['0']['gc_name'];
        	
        	$val['accept_list'] = $acceptor;
        	$val['engi_list'] = $engineer;
        	
        }
        ob_clean();
        echo json_encode(
		array(
		"total"=>$total,
		"rows"=>$project_types
		));
        exit();
    }
    
    function queryByDepartment(){
    
    	global $global_department;
    
    	$msgcode = 100;
    
    	$page = intval($_POST['page']);
    	$rows = intval($_POST['rows']);
    	$department = intval($_GET['department']);
    	$data = "dep_type = $department and is_delete = 0 and inherit_val = 0";
    	$page = $page?$page:1;
    	$limit = array(($page - 1)*$rows,$rows);
    	
    	
    	$project_types_all = ProjectTypeService::instance()->get_project_type($data,null,null);
    	$total = count($project_types_all);
    
    	if(!isset($_POST['rows'])){
    		$limit = null;
    	}
    
    	$project_types = ProjectTypeService::instance()->get_project_type($data,null,$limit);
    	foreach($project_types as $key=>&$val){
    		if($val['dep_type'] < 0){
    			$val['dep_name'] = "";
    		}else{
    			$val['dep_name'] = $global_department[$val['dep_type']]['name'];
    		}
    		$start_time = date('Y/m/d',$val['apply_start']);
    		if($val['apply_end'] != null){
    		    $end_time = date('Y/m/d',$val['apply_end']);
    		}else{
    		    $end_time = '未指定';
    		}
    		$val['date'] = $start_time . "——" .$end_time;
    	}
    	ob_clean();
    	echo json_encode(
    			array(
    					"total"=>$total,
    					"rows"=>$project_types
    			));
    
    	exit();
    }
    
    
    function checkApplyOrCancel(){
        $db = new DB();
        $table_type_id = intval($_GET['ttid']);
        $status = intval($_GET['status']);
        $project_type_id = intval($_GET['ptid']);
        $sql = "update table_type_relative set not_check = $status where table_type_id = $table_type_id and project_type_id = $project_type_id";
        $result = $db -> Update($sql);
    }
    
    //返回该项目的表格列表
    function editExamine(){
        $db = new DB();
        global $global_department;
        $msgcode = 100;
        $page = intval($_POST['page']);
        $rows = intval($_POST['rows']);
        $page = ($page - 1) * $rows;
        $project_type_id = intval($_GET['ptid']);
        //找出这个项目所有需要填写的表
        /* $sql = "Select * from table_type_relative where project_type_id = $project_type_id group by table_type_id";
        $table_result = $db -> Select($sql); */
        $condition = "project_type_id = $project_type_id and para_id = 0 group by table_type_id";
        $table_result_all = TableTypeRelativeService::instance()->get($condition,null,null);
        $total = count($table_result_all);
    	//需要联合查询
    	
//     	$table_result = TableTypeRelativeService::instance()->get($condition,null,$limit);
        $sql = "Select * from table_type_relative A JOIN (Select * from table_type) B ON (A.table_type_id = B.id) where A.project_type_id = $project_type_id and A.para_id = 0 group by A.table_type_id  ";
        $sql = $sql . ' limit ' . $page . ',' . $rows;
        $table_result = $db -> Select($sql);
    	echo json_encode(
    	    array(
    	        "total"=>$total,
    	        "rows"=>$table_result
    	    ));
    	exit();
    }
    
    function queryDelproject(){
        global $global_department;
        $msgcode = 100;
        $page = intval($_POST['page']);
        $rows = intval($_POST['rows']);
        $user_type = $_SESSION['user_type'];
        $department = $_SESSION['department'];
        
        $page = $page?$page:1;
        $limit = array(($page - 1)*$rows,$rows);
        if($user_type == 3){
            $data = array(
    			'is_delete'=>1
    	   );
        }else{
            $data = array(
                'is_delete'=>1,
                'dep_type'=>$department
            );
        }
        $del_project_types_all = ProjectTypeService::instance()->get_project_type($data,null,null);
        $total = count($del_project_types_all);
        if(!isset($_POST['rows'])){
    		$limit = null;
    	}
//     	var_dump($expression);
        $del_project_types = ProjectTypeService::instance()->get_project_type($data,null,$limit);
//         var_dump($del_project_types);
        echo json_encode(
            array(
                "total"=>$total,
                "rows"=>$del_project_types
            ));
        
        exit();
    }
    
    
    //2016.01.07 david add   更新删除状态
    function renewProject(){
        $project_type_id = $_POST['pyid'];
        $project_status = $_POST['project_status'];
        $data = array(
            'is_delete'=>$project_status
        );
        $condition = array(
            'id'=> $project_type_id
        );
        $update_project_types = ProjectTypeService::instance()->update_project_type($condition,$data);
        echo $update_project_types;
    }
    
    
    //当当前项目类型中的所有项目都处于存档阶段的时候，这个项目才可以进行删除
    function canDelete(){
        $project_type_id = $_GET['project_type_id'];
        $condition = "project_type = $project_type_id and project_stage <> 4";
        $select_result = ProjectInfoService::instance()->get($condition);
        $data['code'] = count($select_result);
        echo json_encode($data);
//         var_dump($select_result);

    }
    
}

$task = new ProjectTypeControl();

$task->run();
