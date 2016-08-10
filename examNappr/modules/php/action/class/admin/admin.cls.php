<?php

class ADMININFO{
    function queryadmin($isDel,$page,$rows,$upCatory,$usr,$isForbidden){
        $page = ($page-1)*$rows;
        $sql = "select * from admininfo where isDel=$isDel ";
        $sqlCount = "select count(id) as 'count' from admininfo where isDel=$isDel";
        $db = new DB();
        
        $sql = $sql.' limit '.$page.','.$rows;
        $result = $db->select($sql);
        $count = $db->select($sqlCount);
        $count = $count[0][count];
        if(sizeof($result) > 0){
            for($i = 0; $i <count($result);$i++){
                $adminArr[$i]=array('id'=>$result[$i]['id'],'realname'=>$result[$i]['realname'],'usr'=>$result[$i]['usr'],'phone'=>$result[$i]['phone'],
									 'email'=>$result[$i]['email'],'qq'=>$result[$i]['qq'],'isForbidden'=>$result[$i]['isForbidden'],
									 'addedDate'=>$result[$i]['addedDate']);
            }
            $adminJSON='{"total":'.$count.',"rows":'.json_encode($adminArr).'}';
        }
        else{
            $adminJSON='{"total":0,"rows":[]}';
        }
        
        echo $adminJSON;
        $db->Close();
    }
    
    function getAdmin($id){
        $db=new DB();
		$result=$db->GetInfo($id,'admininfo');
		if($result['category']!=='.'){
			$upidArr=explode('.',$result['category']);
			$upperID=intval($upidArr[sizeof($upidArr)-2]);
			$exclu=$db->GetInfo($upperID,'admincat');
			$exclusive_name=$exclu['exclusive_name'];
		}else{
			$upperID=0;
			$exclusive_name='';
		}
		$labinfoJSON=array(
									'id'=>$result['id'],
									'usr'=>$result['usr'],
									'exclusiveName'=>$result['exclusive_name'],
									'realname'=>$result['realname'],
									'ntid'=>$result['ntid'],
									'seed'=>$result['seed'],
									'phone'=>$result['phone'],
									'email'=>$result['email'],
									'qq'=>$result['qq'],
									'isForbidden'=>$result['isForbidden'],
									'pwd'=>$result['pwd'],
									'upperID'=>$upperID,
									'addedDate'=>$result['addedDate'],
									'isManager'=>$result['isManager'],
									'lastIP'=>$result['lastIP'],
									'category'=>$result['category'],
									'upCat'=>$result['category'],
									'userPrivileges'=>$result['userPrivileges'],
									'managerMoreBm'=>$result['managerMoreBm'],
									'exclusive_name'=>$exclusive_name
		);
		if(!empty($result['userPrivileges'])){
			$arr=explode(',',$result['userPrivileges']);
			$r='';
			if(count($arr)>0){
				for($j=0;$j<count($arr);$j++){
					if(strpos($arr[$j],'concats_')>-1){
						//$r==''?$r='concats_role'.':"'.str_replace('concats_','',$arr[$j]).'"':$r=$r.', concats_role'.':"'.str_replace('concats_','',$arr[$j]).'"';
						$labinfoJSON['concats_role']=str_replace('concats_','',$arr[$j]);
					}else if(strpos($arr[$j],'admincats_')>-1){
						//$r==''?$r='admincats_role'.':"'.str_replace('admincats_','',$arr[$j]).'"':$r=$r.', admincats_role'.':"'.str_replace('admincats_','',$arr[$j]).'"';
						$labinfoJSON['admincats_role']=str_replace('admincats_','',$arr[$j]);
					}else{
						//$r==''?$r=$arr[$j].':"'.$arr[$j].'"':$r=$r.','.$arr[$j].':"'.$arr[$j].'"';
						$labinfoJSON[$arr[$j].'1']=$arr[$j];
					}
				}
			}
		}
		echo json_encode($labinfoJSON);
		$db->Close();
    }
}