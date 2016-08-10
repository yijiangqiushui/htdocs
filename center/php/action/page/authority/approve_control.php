<?php
include '../../class/ActionBase.cls.php';
include CENTER_ROOTPATH."/modules/service/ProCheckPriMapDao.cls.php";
include CENTER_ROOTPATH."/modules/service/ProPriListDao.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectCheckUserListService.cls.php";
include CENTER_ROOTPATH."/modules/service/AdminInfoService.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectInfoService.cls.php";

class ApproveControl extends ActionBase{
    
    private $admin_tag;
    private $is_super = false;
    
    function __construct(){
        $this->checkAdmin();
    }

    function getUserPriJson(){
        $msgcode = 200;
        $data = array(
            'is_super'=>Pri::instance()->is_super?1:0,
            'admin_tag'=>Pri::instance()->admin_tag?1:0,
            'is_special'=>Pri::instance()->is_special?1:0
        );

        $res = array('content'=>$data);
        $this->response($msgcode,$res);
    }

    function getProListByUid(){

        $uid = intval($_GET['uid']);
        $ptid = intval($_GET['ptid']);

        $msgcode = 100;

        //获取用户信息
        $condition = array(
            'id'=>$uid
        );

        $ret = AdminInfoService::instance()->get($condition);

        if(empty($ret)){
            echo json_encode(array());exit;
        }

        $uname = $ret[0]['name'];
        //获取主管列表
        $condition = array(
            'project_engineer'=>$uname,
            'project_type'=>$ptid
        );

        $ret = ProjectInfoService::instance()->get($condition);

        foreach($ret as &$val){
            $val['engi_tag'] = 1;
            $val['dl_tag'] = 0;
        }

        //获取代管列表

        $sub_ret = ProjectInfoService::instance()->getByPcul($ptid,$uid);

        foreach($sub_ret as &$val){
            $val['engi_tag'] = 0;
            $val['dl_tag'] = 1;
        }

        $ret_all = array_merge($ret,$sub_ret);
        echo json_encode($ret_all);exit;

    }

    //检查审核控制权限
    function proCheckPriList(){
        $msgcode = 200;
        
        $admin_info_id = intval($_GET['admin_info_id']);
        //根据用户id获取用户信息
        $ret = ProCheckPriMapDao::instance()->get_pri_map_by_uid($admin_info_id);
        
        if(false === $ret){
            $msgcode = 201;
        }
        $res = array('content'=>$ret);
        ob_clean();
        return $this->response($msgcode,$res);
    }

    //获取可转让权限
    function proTranPriList(){
        $msgcode = 200;

        $ptid = intval($_GET['ptid']);
        //根据用户id获取用户信息
        $data = array(
            'admin_info_id'=>$_SESSION['user_id'],
            'project_type_id'=>$ptid
        );
        $ret = ProCheckPriMapDao::instance()->get($data);

        if(false === $ret){
            $msgcode = 201;
        }

        $fc_arr = array(0,0);

        if($ret){
            foreach($ret as $val){
                $fc_arr[$val['project_type_para_id']] = 1;
            }
        }

        if($this->admin_tag == 0){
            $fc_arr = array(1,1);
        }

        $res = array('content'=>$fc_arr);
        ob_clean();
        return $this->response($msgcode,$res);
    }

    //检查其他权限
    function proPriList(){
    	$msgcode = 200;
    
    	$admin_info_id = intval($_GET['admin_info_id']);
    	//根据用户id获取用户信息
    	$ret = ProPriListDao::instance()->get_pri_list_by_uid($admin_info_id);
    
    	if(false === $ret){
    		$msgcode = 201;
    	}
    	$res = array('content'=>$ret);
    	ob_clean();
    	return $this->response($msgcode,$res);
    }
    
    function proCheckPriListByPtid(){
        $msgcode = 200;
        
        $admin_info_id = $_SESSION['user_id'];
        $admin_department = $_SESSION['department'];
        
        //这里的type已经变成了id
        $project_type = $_POST['project_type'];
       
        //get project_type_id
		//echo $project_type;
// 		$sql = "select * from project_type where `name`='{$project_type}' limit 1";
        $sql = "Select * from project_type where `id` = '{$project_type}' limit 1" ;
		$pt_info = ProCheckPriMapDao::instance()->db->Select($sql);
		if(!$pt_info){
			$msgcode = 201;
		}else{
			$pt_info = $pt_info[0];
		}
		
		$project_type_id = $pt_info['id'];
		
        //根据用户id获取用户信息
        $ret = ProCheckPriMapDao::instance()->get_pri_map_by_uid($admin_info_id);
        
        if(false === $ret){
            $msgcode = 202;
        }
        
		if($this->admin_tag){ //not admin
			$para_ids = array(0,0,0,0,0,0);
			foreach($ret as $item){
				if($item['project_type_id'] == $project_type_id){
					$para_ids[$item['project_type_para_id']] = 1;
				}
			}
		}else{
			$para_ids = array(1,1,1,1,1,1);
		}
		
		if(Pri::instance()->is_special){
			$para_ids = array(0,0,0,0,0,0);
		}
        $res = array('content'=>$para_ids,
            'department'=>$admin_department
        );
        return $this->response($msgcode,$res);
    }
    
    function proCheckPriMod(){
        $msgcode = 100;
        $admin_info_id = intval($_GET['admin_info_id']);
        $project_type_id = intval($_GET['project_type_id']);
        if($this->admin_tag){
            $admin_info_lend_id = $_SESSION['user_id'];
        }else{
            $admin_info_lend_id = 0;
        }
        $project_type_para_id = intval($_GET['para_id']);
        $status = 1; //授权等级 0，表示超级管理员或者管理员授权  1表示权利暂时出让
        if($_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3){
            $status = 0;
        }
        
        $data = array(
            'admin_info_id'=>$admin_info_id,
            'project_type_id'=>$project_type_id,
            'admin_info_lend_id'=>$admin_info_lend_id,
            'project_type_para_id'=>$project_type_para_id,
            'status'=>$status
        );
        
        $ret = ProCheckPriMapDao::instance()->insert($data);
        
        if($ret == 0){
            $msgcode = 101;
        }
        $res = array('content'=>$ret);
        //var_dump($res);
        
        return $this->response($msgcode,$res);
    }
    
    function proCheckOtherPriMod(){
    	$msgcode = 100;
    	$admin_info_id = intval($_GET['admin_info_id']);

    	if($this->admin_tag){
    		$admin_info_lend_id = $_SESSION['user_id'];
    	}else{
    		$admin_info_lend_id = 0;
    	}
    	$prival = $_GET['prival'];
    	$status = 1; //授权等级 0，表示超级管理员或者管理员授权  1表示权利暂时出让
    	if($_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3){
    		$status = 0;
    	}
    
    	$data = array(
    			'admin_info_id'=>$admin_info_id,
    			'prival'=>$prival,
    			'status'=>$status
    	);
    
    	$ret = ProPriListDao::instance()->insert($data);
    
    	if($ret == 0){
    		$msgcode = 101;
    	}
    	$res = array('content'=>$ret);
    	//var_dump($res);
    
    	return $this->response($msgcode,$res);
    }
    
    private function checkAdmin(){
        $status = 1; //0，表示超级管理员或者管理员授权  1表示普通用户
        if($_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3){
            $status = 0;
        }
        $this->admin_tag = $status;
        
        if(3 == $_SESSION['user_type']){
            $this->is_super = true;
        }
        
    }

    function proUserPriSpecial(){
        $msgcode = 100;
        //remove rubbish
        $pids = $_GET['pids'];
        $pt_arr = explode("|",$pids);
        //add new
        $val_owner = $_GET['val_owner'];

        $val_owner_arr = explode("|",$val_owner);

        foreach($pt_arr as $val){
            $condition = array(
                'project_id'=>$val
            );

            $ret[] = ProjectCheckUserListService::instance()->delete($condition);

            //change visor
            foreach($val_owner_arr as $item){
                if(!$item) continue;
                $data = array(
                    'project_id'=>$val,
                    'admin_info_id'=>$item
                );

                $ret[] = ProjectCheckUserListService::instance()->insert($data);

            }

        }

        $res = array('content'=>$ret);
        return $this->response($msgcode,$res);

    }

    function proOtherPriSpecail(){
        $msgcode = 100;
        //remove rubbish
        $prival = $_GET['prival'];
        $pt_arr = explode("|",$prival);
        //add new
        $val_visor = $_GET['val_visor'];

        $val_visor_arr = explode("|",$val_visor);

        foreach($pt_arr as $val){
            $condition = array(
                'prival'=>$val
            );

            $ret[] = ProPriListDao::instance()->delete($condition);

            //change visor
            foreach($val_visor_arr as $item){
                $data = array(
                    'prival'=>$val,
                    'admin_info_id'=>$item
                );

                $ret[] = ProPriListDao::instance()->insert($data);

            }

        }

        $res = array('content'=>$ret);
        return $this->response($msgcode,$res);

    }
    
    function proCheckPriSpecail(){
        $msgcode = 100;
    	//remove rubbish
    	$ptid = $_GET['ptid'];
    	$pt_arr = explode("|",$ptid);
    	//add new
    	$val_assign = $_GET['val_assign'];
    	$val_engi = $_GET['val_engi'];
    	
    	$val_assign_arr = explode("|",$val_assign);
    	$val_engi_arr = explode("|",$val_engi);
    	
    	foreach($pt_arr as $val){
    		$condition = array(
    				'project_type_id'=>$val
    		);
    		
    		$condition['project_type_para_id'] = 0;
    		$ret[] = ProCheckPriMapDao::instance()->delete($condition);
    		
    		$condition['project_type_para_id'] = 1;
    		$ret[] = ProCheckPriMapDao::instance()->delete($condition);

    		//change engineer
            foreach($val_engi_arr as $item){
                $data = array(
                    'project_type_id'=>$val,
                    'project_type_para_id'=>1,
                    'admin_info_id'=>$item
                );

                $ret[] = ProCheckPriMapDao::instance()->insert($data);

            }
    		//change asigneese
            foreach($val_assign_arr as $item){
                $data = array(
                    'project_type_id'=>$val,
                    'project_type_para_id'=>0,
                    'admin_info_id'=>$item
                );

                $ret[] = ProCheckPriMapDao::instance()->insert($data);
            }
    		
    	}

        $res = array('content'=>$ret);
        return $this->response($msgcode,$res);
    	
    }
    
    function proCheckPriModAll(){
        $msgcode = 300;
        
        $status = $this->admin_tag;
            
        $cval = intval($_GET['cval']);
        $admin_info_id = intval($_GET['admin_info_id']);
        $project_type_id = intval($_GET['project_type_id']);
        if($this->admin_tag){
            $admin_info_lend_id = $_SESSION['user_id'];
        }else{
            $admin_info_lend_id = 0;
        }
        
        $pri_list = ProCheckPriMapDao::instance()->get_pri_map_by_uid($_SESSION['user_id'],0);
        
        $para_ids = array();
        if(!$this->admin_tag){
            $para_ids = array(0,1,2,3,4,5);
        }else{
            foreach($pri_list as $item){
                if($item['project_type_id'] == $project_type_id){
                    $para_ids[] = $item->project_type_para_id;
                }
            }
        }
        
        
        if($cval){
            //delete
            $msgcode = 400;
            
            $para_ids = array(0,1,2,3,4,5);
            
            $ret = array();
            
            foreach($para_ids as $val){
            
                $data = array(
                    'admin_info_id'=>$admin_info_id,
                    'project_type_id'=>$project_type_id,
                    //'admin_info_lend_id'=>$admin_info_lend_id,
                    'project_type_para_id'=>$val
                );
                
                if($admin_info_lend_id){
                    $data['admin_info_lend_id'] = $admin_info_lend_id;
                }
                
                $ret[$val] = ProCheckPriMapDao::instance()->delete_pri($data);
                
                $data = array(
                    'project_type_id'=>$project_type_id,
                    'admin_info_lend_id'=>$admin_info_id, //出让id
                    'project_type_para_id'=>$project_type_para_id
                );
            }
            
            //if($ret == 0){
            //    $msgcode = 402; //删除失败
            //}
            
        }else{
            
            $para_ids = array(0,1,2,3,4,5);
            
            $ret = array();
            
            foreach($para_ids as $val){
            
                $data = array(
                    'admin_info_id'=>$admin_info_id,
                    'project_type_id'=>$project_type_id,
                    'admin_info_lend_id'=>$admin_info_lend_id,
                    'project_type_para_id'=>$val,
                    'status'=>$status
                );
                
                $ret[$val] = ProCheckPriMapDao::instance()->insert($data);
            }
            
            //if(!$ret){
            //    $msgcode = 301;
            //}
        }
        
        $res = array('content'=>$ret);
        return $this->response($msgcode,$res);
    }
    
    
    
    function proCheckPriDel(){
        //echo 'proCheckPriDel'.'2222';
        $msgcode = 100;
        
        $admin_info_id = intval($_GET['admin_info_id']);
        $project_type_id = intval($_GET['project_type_id']);
        if($this->admin_tag){
            $admin_info_lend_id = $_SESSION['user_id'];
        }else{
            $admin_info_lend_id = 0;
        }
        $project_type_para_id = intval($_GET['para_id']);
        
        $data = array(
            'admin_info_id'=>$admin_info_id,
            'project_type_id'=>$project_type_id,
            //'admin_info_lend_id'=>$admin_info_lend_id,
            'project_type_para_id'=>$project_type_para_id
        );
        
        if($admin_info_lend_id){
            $data['admin_info_lend_id'] = $admin_info_lend_id;
        }
        
        $ret = ProCheckPriMapDao::instance()->delete_pri($data);
        
        $data = array(
            'project_type_id'=>$project_type_id,
            'admin_info_lend_id'=>$admin_info_id, //出让id
            'project_type_para_id'=>$project_type_para_id
        );
        
        if($ret == 0){
            $msgcode = 102; //删除失败
        }
        $res = array('content'=>$ret);
        return $this->response($msgcode,$res);
    }
    
    
    function proCheckOtherPriDel(){
    	//echo 'proCheckPriDel'.'2222';
    	$msgcode = 100;
    	$admin_info_id = intval($_GET['admin_info_id']);
    	$prival = $_GET['prival'];
    	if($this->admin_tag){
    		$admin_info_lend_id = $_SESSION['user_id'];
    	}else{
    		$admin_info_lend_id = 0;
    	}
    
    	$data = array(
    			'admin_info_id'=>$admin_info_id,
    			'prival'=>$prival,
    	);
    
    	$ret = ProPriListDao::instance()->delete_pri($data);
    	if($ret == 0){
    		$msgcode = 102; //删除失败
    	}else{
			//如果prival是depart,在监察科授权的时候，需要清除子项
			if(stristr($prival,"jcqxDep_")){
				$dep_id = str_replace("jcqxDep_","",$prival);
				//dep_list
				$dep_like = "jcqxPart_".$dep_id."_%";
				$data = array(
					"like"=>array("prival",$dep_like)
				);
				
				$sret = ProPriListDao::instance()->delete_pri($data);
			}
		}
    	$res = array('content'=>$ret);
    	return $this->response($msgcode,$res);
    }
    function ifNeedSet(){
    	$t_str = $_POST['ids'];
    	$t_str_arr = explode("|",$t_str);
        //看看是不是所有的都需要发布 是 0  success     不是 0  fail
    	$db=new DB();
    	foreach ($t_str_arr as  $val){
    	$res=$db->GetInfo1($val, "project_type", "id");
    	if($res["is_public"]==1){
    		return $this->response(0,"fail");
    		}
    	}
    	
    	return $this->response(0,"success");
    }
}

$approve_control = new ApproveControl();
$approve_control->run();