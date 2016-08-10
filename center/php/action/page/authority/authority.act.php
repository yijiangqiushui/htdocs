<?php
include '../../../../../common/php/config.ini.php';
include ROOTPATH.'lib/common.cls.php';
include ROOTPATH.'lib/db.cls.php';
include ROOTPATH.'lib/user.cls.php';
/*
 * 实现党用户进行开启和关闭项目是的具体操作
 * 1:代表更新成功
 * 0：代表更新失败
 */
class authorityapp{
    function closeProject($type_id){
        $db = new DB();
        $sql = "update project_type set apply_status=0,apply_start=null,apply_end=null where id = $type_id";
        $result = $db -> Update($sql);
        if($result){
            $data = 1;
        }
        else{
            $data = 0;
        }
        echo $data;
    }
    
    function openProject($type_id,$openProject){
        $db = new DB();
        $result = $db -> UpdateData1('project_type',$type_id,$openProject,'id');
        if($result){
            $data= 1;
        }
        else{
            $data = 0;
        }
        echo $data;
        
    }
    
    function queryAdminAll($page,$rows){
        $page = ($page-1)*$rows;
        $sql = "select * from admininfo ";
        $sqlCount = "select count(id) as 'count' from admininfo";
//          echo $sql;
//         echo $sqlCount;  */
        $db = new DB();
        $sql = $sql.' limit '.$page.','.$rows;
        $result = (array)$db->select($sql);
        $count = $db -> select($sqlCount);
        $count = $count[0][count];
        $i = 0;
        foreach($result as $tmp){
            $adminArr[$i] = array('id'=>$tmp['id'],
                                  'realname'=>$tmp['realname'],
                                  'phone'=>$tmp['phone'],
                                  'email'=>$tmp['email'],
                                  'qq'=>$tmp['qq'],
                                  'isForbidden' =>$tmp['isForbidden']
            );
            $i = $i + 1;
        }
        $adminJSON='{"total":'.$count.',"rows":'.json_encode($adminArr).'}';
        echo $adminJSON;
        $db->Close();
    }
    
    function queryAdmin($page,$rows,$departmentauth){
    	$page = ($page-1)*$rows;
    	$sql = "select * from admininfo where department='$departmentauth'";
    	$sqlCount = "select count(id) as 'count' from admininfo where department='$departmentauth'";
    	//          echo $sql;
    	//         echo $sqlCount;  */
    	$db = new DB();
    	$sql = $sql.' limit '.$page.','.$rows;
    	$result = (array)$db->select($sql);
    	$count = $db -> select($sqlCount);
    	$count = $count[0][count];
    	$i = 0;
    	foreach($result as $tmp){
    		$adminArr[$i] = array('id'=>$tmp['id'],
    				'realname'=>$tmp['realname'],
    				'phone'=>$tmp['phone'],
    				'email'=>$tmp['email'],
    				'qq'=>$tmp['qq'],
    				'isForbidden' =>$tmp['isForbidden']
    		);
    		$i = $i + 1;
    	}
    	$adminJSON='{"total":'.$count.',"rows":'.json_encode($adminArr).'}';
    	echo $adminJSON;
    	$db->Close();
    }
    
    function queryUsers($department){
        $db = new DB();
        $sql = "select * from admininfo where department = $department";
        $sqlCount = "select count(id) as 'count' from admininfo where department = $department";
        $result = (array)$db->Select($sql);
        $count = $db -> select($sqlCount);
        $count = $count[0][count];
        $i = 0;
        $userArr = array();
        
        foreach($result as $tmp){
            $userArr[$i] = array('id'=> $tmp['id'],
                                  'text'=>$tmp['realname']
            );
            $i = $i + 1;
        }
        echo json_encode($userArr);
        $db->Close();
    }
   /*  function updateDate($name,$date,$project_name)
    {
        $db = new DB();
        $result = $db->UpdateData1($name, $project_name, $date, 'name');
        echo $result;
        $db->Close();
    } */
    function updateUser($id,$data){
    	$msgcode = 101;
    	$db = new DB();
    	$col = array();
        foreach ($data as $key => $value){
            $col[] = $key . "='" . $value . "'";
        }
        $sql = "update admininfo SET " . implode(',',$col)." where id = $id";
        if($db->update($sql)){
        	$msgcode = 100;
        };
        $res = array(
        		'msgcode' =>$msgcode
        );
        echo json_encode($res);
        $db ->Close();
        //echo "test";		
    }
    function deleteUser($id){
    	$msgcode = 101;
    	$db = new DB();
    	if($db ->DelData($id,'admininfo')){
    		$msgcode = 100;
    	};
    	$res = array(
    			'msgcode' =>$msgcode
    	);
    	echo json_encode($res);
    	$db ->Close();
    	//echo "test";
    }
    
    
    
    
    
}