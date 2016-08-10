<?php
/**
author:Zhao Xiaogang
date:2014-12-19
*/
class File{
	function get_depart(){
		$db=new DB();
		$sql="select * from contentcat";
		$result=$db->Select($sql);
		return $result;
		$db->Close();
	}
	
	function save($Info,$admin_id){
		
		$db=new DB();
		$sql1="select usr,category from admininfo where id=$admin_id";
		$res=$db->Select($sql1);
		if($res>0){
			//判定$res[0]['category']是 '.'还是'.123'样式
			if($res[0]['category']!='.'){
				$category=explode('.',$res[0]['category']);
				$categorycount=count($category)-2;
				$sql2="select userPrivileges from admincat where id=".$category[$categorycount];
				$concat=$db->Select($sql2);
				$concat1=explode(',',$concat[0][0]);
				$dept=explode('_',$concat1[1]);
				$Info['author']=$res[0]['usr'];
				if($dept[1]!=0){
					$Info['category']=$dept[1].'.';
					$department=explode('.',$dept[1]);
					$Info['department']=$department[1];
				}else{
					//全部，为选择部门，dept[1]=0
					$Info['category']='.'.$dept[1].'.';
					$Info['department']='0';
				}
				
			}
			else{
				//超级管理员super
				$Info['author']=$res[0]['usr'];
				$Info['category']='.';
				$Info['department']='0';
			}
		}
		$result=$db->InsertData('document',$Info);
		echo $result;
		$db->Close();
	}
	
	/**
	* 查询文件审批列表
	*/
	public function getDateGrid($page,$rows,$upper_cat,$addedDate,$file_name,$file_no){
		$page=($page-1)*$rows;
		$upper_cat = isset($upper_cat) ? $upper_cat : '.';
		$sql="SELECT * FROM document WHERE category like '".$upper_cat."%' ";
		$sql_count="SELECT count(*) as total_num FROM document WHERE category like '".$upper_cat."%'";
		if($addedDate!=null &&$addedDate!=''){
			$str='"%'.$addedDate.'%"';
			$sql=$sql." and addedDate like ".$str;
			$sqlCount.=" and addedDate like ".$str;
		}
		if($file_name!=null&&$file_name!=''){
			$sql.=" and file_name like '%$file_name%' ";
			$sql_count.=" and file_name like '%$file_name%' ";
		}
		if($file_no!=null&&$file_no!=''){
			$sql.=" and file_no like '%$file_no%' ";
			$sql_count.=" and file_no like '%$file_no%' ";
		}
		$sql.=" ORDER BY id LIMIT $page, $rows ";
		$db=new DB();
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sql_count);
		$count=$arr_cou[0]['total_num'];
		
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$sqldept="select cat_name from contentcat where id=".$arr[$i]['department'];
				$dept=$db->Select($sqldept);
				$arr2[$i]=array('id'=>$arr[$i]['id'],
								'department'=>$dept[0]['cat_name'],
								'addedDate'=>$arr[$i]['addedDate'],
								'author'=>$arr[$i]['author'],
								'category'=>$arr[$i]['category'],
								'file_level'=>$arr[$i]['file_level'],
								'file_no'=>$arr[$i]['file_no'],
								'file_name'=>$arr[$i]['file_name'],
								'file_content'=>$arr[$i]['file_content'],
								'file_type'=>$arr[$i]['file_type'],
								'types'=>$arr[$i]['types'],
								/*'is_forbidden'=>$arr[$i]['is_forbidden'],
								'is_checked'=>$arr[$i]['is_checked'],
								'is_recommend'=>$arr[$i]['is_recommend'],
								'leader1'=>$arr[$i]['leader1'],
								'leader2'=>$arr[$i]['leader2'],
								'leader3'=>$arr[$i]['leader3'],
								'leader1_check'=>$arr[$i]['leader1_check'],
								'leader2_check'=>$arr[$i]['leader2_check'],
								'leader3_check'=>$arr[$i]['leader3_check'],*/
								'number'=>$arr[$i]['number']
								);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();	
	}
	
	/**
	* 按id查询文件信息
	*/
	public function getDetail($id){
		$db=new DB();
		$res=$db->GetInfo($id,'document');
		$db->Close();
		echo json_encode($res);
	}


	/**
	* 修改文件信息
	*/
	public function editFile($info,$id){//echo json_encode($info);
		$db=new DB();
		$res=$db->UpdateData('document',$id,$info);
		$db->Close();
		echo $res;
	}
	
	
	/**
	* 删除文件信息
	*/
	public function delFile($id_arr){
		$sql="delete from document where id in ($id_arr)";
		$db=new DB();
		$res=$db->Delete($sql);
		$db->Close();
		echo $res;
	}
	/**
	* 领导审批
	*/
	public function saveLeaderInfo($flag,$con,$id,$leader_check){
		$sql="update document set leader".$flag." = '$con' , leader".$flag."_time = '".date('Y-m-d',time())."', leader".$flag."_check =$leader_check where id = $id";
		$db=new DB();
		$res=$db->Update($sql);
		$db->Close();
		echo $res;
	}
	/**
	* 设置禁用，启用
	*/
	public function setForbidden($id_arr,$val){
		$sql="update document set is_forbidden = $val where id in ($id_arr)";
		$db=new DB();
		$res=$db->Update($sql);
		$db->Close();
		echo $res;
	}
	/**
	功能：审核
	*/
	public function checkInfo($id){
		$db=new DB();
		$sql="update document set is_checked =1 where id= $id";
		$result=$db->Update($sql);
		$db->close();
	}
	/**
	* 批量审核
	*/
	public function setCheck($id_arr){
		$sql="update document set is_checked = 1 where id in ($id_arr)";
		$db=new DB();
		$res=$db->Update($sql);
		$db->Close();
		echo $res;
	}
	//产品详情
	function getInfoById($id){
		$sql="select * from document where id = ".$id;
		$db=new DB();
		$arr=$db->Select($sql);
		$sqldept="select cat_name from contentcat where id=".$arr[0]['department'];
		$dept=$db->Select($sqldept);
		$arr=array(
					'department'=>$dept[0][0]==''?'无':$dept[0][0],
					'author'=>$arr[0]['author'],
					'addedDate'=>$arr[0]['addedDate'],
					'types'=>$arr[0]['types'],
					'file_level'=>$arr[0]['file_level'],
					'file_no'=>$arr[0]['file_no'],
					'file_name'=>$arr[0]['file_name'],
					'file_content'=>$arr[0]['file_content'],
					'file_type'=>$arr[0]['file_type'],
					/*'leader1'=>$arr[0]['leader1'],
					'leader2'=>$arr[0]['leader2'],
					'leader3'=>$arr[0]['leader3'],
					'leader1_check'=>$arr[0]['leader1_check'],
					'leader2_check'=>$arr[0]['leader2_check'],
					'leader3_check'=>$arr[0]['leader3_check'],*/
					'number'=>$arr[0]['number'],
				);
		echo json_encode($arr);
		$db->Close();
	}
	//获取当天文件总数
	function fileTotal($addtime){
		
		$db=new DB();
		$sql="select count(*) as count from document where addtime='$addtime'";
		$res=$db->Select($sql);
		echo $res[0]['count'];
		$db->Close();
	}
	
	//保存文件编号
	function addFileNo($id,$file_no,$addtime){
		$db=new DB();
		$sql="select file_no from document where id=$id";
		$res=$db->Select($sql);
		if($res[0]['file_no']!=null || $res[0]['file_no']!=''){
			echo $res[0]['file_no'];//该文件编号已存在
		}
		else{
			$sql="update document set file_no='$file_no',addtime='$addtime' where id=$id";
			$result=$db->Update($sql);
			echo $result;
		}
		$db->Close();			
	}
	
	/**
	* 获取附件信息
	*/
	public function checkAttach($id){
		$db=new DB();
		$sql="select file_path from attachment where id=$id";
		$attachment=$db->Select($sql);
		$attach='../../../../../common/'.$attachment[0][0];
		//echo $attach;
		if(empty($attach)){
			echo '非法链接';
		}else{
			$file_arr=explode("/",$attach);
			$file_name=$file_arr[sizeof($file_arr)-1];
			if(!file_exists($attach)){
				echo '文件找不到';
				exit;
			}else{
				$file=fopen($attach,"r");
				header("Content-type:application/octet-stream");
				header("Accept-Ranges: bytes");
				header("Accept-Length:".filesize($attach));
				header("Content-Disposition: attachment; filename=".$file_name);
				echo fread($file,filesize($attach));
				fclose($file);
				exit;
			}
		}
	}
	
}
?>