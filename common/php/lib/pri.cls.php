<?php


class Pri {
    
    public $handle;
    public $pri_list;
    public $pri_arr = array();
    public $is_super;
    public $admin_tag; //用户类型 科长 和 超级管理员
    public $is_special = false; //监察科
	public $jcqx = true;
	public $jcqx_dep;
	public $jcqx_part; //监察项目类型
	
    static function instance(){
        $obj = new Pri();
        $obj->checkAdmin();
        $obj->init();
        return $obj;
    }
    
    function init(){
        //pri
        $db=new DB();
        
        $uid = $_SESSION['user_id'];
        //找出这个用户所对应的项目类型列表
		$sql = "select a.*,b.name as pname from pro_check_pri_map as a join project_type as b on(a.project_type_id=b.id) where a.admin_info_id={$uid}";
        $clist = $db->Select($sql);
        
        //查找这个用户所拥有的监察权限
        $sql = "select * from pro_pri_list where admin_info_id={$uid}";

//         echo $sql;exit();
        $slist = $db->Select($sql);
        
        $pril = $this->formatPri($slist,$clist);
        
        $_SESSION['pri_list'] = $pril;
        //var_dump($_SESSION['pri_list']);exit;
    }
    
    private function checkAdmin(){
    	$status = 0; //1，表示超级管理员或者管理员授权  2表示普通用户
    	if($_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3){
    		$status = 1;
    	}
    	$this->admin_tag = $status;
    
    	if(3 == $_SESSION['user_type']){
    		$this->is_super = true;
    	}
		
		if($_SESSION['department'] == 3){
			$this->is_special = true;
		}
    
    }
    
    
    function checkPri($module){
        
        if(isset($this->pri_list[$module])||$this->admin_tag){
            return true;
        }else{
            return false;
        }
        
    }
    
    function getPri($module){
        if(isset($this->pri_list[$module])){
            return $this->pri_list[$module];
        }else{
            false;
        } 
    }
    
	function get_check_ptids($para_id,$format=false){
		$ch_arr = array();
		foreach($this->pri_list["check_pri"] as $item){
			if($item['project_type_para_id'] == $para_id){
				$ch_arr[] = $item['project_type_id'];
			}
		}
		
		if($format){
			return implode(',',$ch_arr);
		}
		
		return $ch_arr;
	}
	
	function get_all_ptids($format=false){
		$ch_arr = array();
		foreach($this->pri_list["check_pri"] as $item){
			if(!in_array($item['project_type_id'],$ch_arr)){
				$ch_arr[] = $item['project_type_id'];
			}
		}
		
		if($format){
			return implode(',',$ch_arr);
		}
		
		return $ch_arr;
	}
	
	function get_sp_ptids($format=false){
		$ch_arr = array();
		
		if($format){
			return implode(',',$this->jcqx_part);
		}
		
		return $ch_arr;
	}
	
	function get_sp_deps($format=false){
		$ch_arr = array();
		
		if($format){
			return implode(',',$this->jcqx_dep);
		}
		
		return $ch_arr;
	}
	
	function check_sp_dep($id){
		if(in_array($id,$this->jcqx_dep)){
			return true;
		}
		return false;
	}
	
	
	function check_pri_pt($ptid,$para_id){
		$tag = false;
		
		if($this->admin_tag){
			$tag = true;
		}
		
		foreach($this->pri_list["check_pri"] as $item){
			if($item['project_type_id'] == $ptid && $item['project_type_para_id'] == $para_id ){
				$tag = true;
			}
		}
		
		return $tag;
	}
	
	function get_check_ptnames($para_id,$format=false){
		$ch_arr = array();
		foreach($this->pri_list["check_pri"] as $item){
			if($item['project_type_para_id'] == $para_id){
				$ch_arr[] = "'".$item['pname']."'";
			}
		}
		if($format){
			return implode(',',$ch_arr);
		}
		return $ch_arr;
	}
	
	
	/*
	 * 格式化这个权限信息
	 */
    function formatPri($slist,$clist){
        foreach($slist as $item){
            $this->pri_list[$item['prival']] = 1;
            $this->pri_arr[]= $item['prival'];
        }
        
        $this->pri_list["check_pri"] = $clist;
		
		if($this->is_special){
			
			$dep_arr = array(-100);
			$dep_types = array(0);
			foreach($this->pri_list as $key=>$val){
				if(stristr($key,"jcqxDep_")){
					$dep_arr[] = str_replace("jcqxDep_","",$key);
				}
				
				if(stristr($key,"jcqxPart_")){
					$rest = str_replace("jcqxPart_","",$key);
					$rest_arr = explode("_",$rest);
					$dep_types[] = $rest_arr[1];
				}	
			}
			$this->jcqx_dep = $dep_arr;
			$this->jcqx_part = $dep_types;
			
		}
        
    }
    
    
}
