<?php
/**
author:Zhao Xiaogang
date:2014-12-19
*/
class makeFile{
	function get_depart(){
		$db=new DB();
		//$sql="select * from contentcat where isDel=0";
		$sql="select * from admincat where isDel=0";
		$result=$db->Select($sql);
		echo $result;
		$db->Close();
	}
	/*
	*功能：提交制发文件
	*/
	function save($Info,$admin_id,$attach_name,$file_auto_name){
		$db=new DB();
		$id=$_SESSION['admin_id'];
		$sql2="select count(id) as count from document where file_name='".$Info['file_name']."' and author=(select realname from admininfo where id=$id) and file_no is null";
		$res2=$db->Select($sql2);
		if($res2[0]['count']!=0){
			echo 'file_name_exit';
		}
		else{
			$sql1="select realname,category from admininfo where id=$admin_id";
			$res=$db->Select($sql1);
			if($res>0){
				//判定$res[0]['category']是 '.'还是'.123'样式
				if($res[0]['category']!='.'){
					$category=explode('.',$res[0]['category']);
					$categorycount=count($category)-2;
					//$sql2="select userPrivileges from admincat where id=".$category[$categorycount];
					$sql2="select userPrivileges from admininfo where id=$admin_id";
					$concat=$db->Select($sql2);
					$concat1=explode(',',$concat[0][0]);
					$dept=explode('_',$concat1[1]);
					$Info['author']=$res[0]['realname'];
					if($dept[1]!=0){
						$Info['category']=$dept[1].'.';
						$department=explode('.',$dept[1]);
						$Info['department']=$department[count($department)-1];
					}else{
						//全部，为选择部门，dept[1]=0
						$Info['category']='.';
						$Info['department']='0';
					}
					
				}
				else{
					//超级管理员super
					$Info['author']=$res[0]['realname'];
					$Info['category']='.';
					$Info['department']='0';
				}
			}
			$result=$db->InsertData('document',$Info);
			
			/*---------------插入附件----------------*/
			if($result!=0){
				$file_name=explode(',',$attach_name);
				$file_auto_name=explode(',',$file_auto_name);
				for($i=0;$i<count($file_name)-1;$i++){
					$time=time();
					$y=date('Y',$time);
					$m=date('m',$time);
					$d=date('d',$time);
	
					$tmparr=explode('.',$file_name[$i]);
					$file_ext=$tmparr[1];;
					
					$file_path="upload/".$y."/".$m."/".$d."/".$file_auto_name[$i];
					
					$sql="insert into attachment(content_id,file_path,file_name,file_ext) value($result,'$file_path','$file_name[$i]','$file_ext')";
					$attach=$db->Insert($sql);
				}
			}	
			echo $result;
		}
		$db->Close();
	}
	
	/**
	* 查询文件审批列表
	*/
	public function getDateGrid($page,$rows,$upper_cat,$is_zero,$beginDate,$endDate,$file_name,$file_no,$flag1,$file_self,$file_type,$author){
		$db=new DB();
		$page=($page-1)*$rows;
		$upper_cat = isset($upper_cat) ? $upper_cat : '.';
		$id=$_SESSION['admin_id'];
		
		//是否为科长
		$manager=$db->Select("SELECT isManager FROM admininfo WHERE id=".$_SESSION['admin_id']." limit 0,1");
		//判断是否为领导
		$isLeader=$db->Select("SELECT b.exclusive_name FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id']);

		if(strpos($_SESSION['priviledges'],'maker')){//制文人
			if($upper_cat=='.'){//全部
					$sql="select * from document where 1=1";
					$sql_count="select count(*) as total_num from document where 1=1";
					$flagSql="update document set flag2=0";
			}else{
				if($is_zero=='-1'){
					if($upper_cat=='.-1.'){//个人
						$sql="select * from document where author=(select realname from admininfo where id=$id)";
						$sql_count="select count(*) as total_num from document where author=(select realname from admininfo where id=$id)";
						$flagSql="update document set flag2=0 where author=(select realname from admininfo where id=$id)";
					}
				}
				else if($is_zero=='-2'){//待审
					if($upper_cat=='.-2.'){//全部待审数据
						//$sql="select * from document where file_no is null";
						//$sql_count="select count(*) as total_num from document where file_no is null";
						$sql="select * from document where ismake!=1";
						$sql_count="select count(*) as total_num from document where ismake!=1";
						$flagSql="update document set flag2=0 where file_no is null";
					}else{//某部门待审数据
						$sql="select * from document where file_no is null and category like '$upper_cat%'";
						$sql_count="select count(*) as total_num from document where file_no is null and category like '$upper_cat%'";
						$flagSql="update document set flag2=0 where file_no is null and category like '$upper_cat%'";
					}
				}
				else if($is_zero=='-3'){
					if($upper_cat=='.-3.'){//全部已审
						//$sql="select * from document where file_no is not null";
						//$sql_count="select count(*) as total_num from document where file_no is not null";
						$sql="select * from document where ismake=1 or isInvalid=1";
						$sql_count="select count(*) as total_num from document where ismake=1 or isInvalid=1";
						$flagSql="update document set flag2=0 where file_no is not null";
					}else{//某部门已审
						$sql="select * from document where file_no is not null and category like '$upper_cat%'";
						$sql_count="select count(*) as total_num from document where file_no is not null and category like '$upper_cat%'";
						$flagSql="update document set flag2=0 where file_no is not null and category like '$upper_cat%'";
					}
				}
			}
			
		}
		else if($manager[0]['isManager']==1 && strpos($_SESSION['priviledges'],'maker')==''){//科长并且不是制文人
			//获取科长所在的部门
			$sql="select category from admininfo where id=$id";
			$catInfo=$db->Select($sql);
			$categ=$catInfo[0][0];
			if($upper_cat=='.'){//本部门全部
				$sql="select * from document where category like '%$categ%'";
				$sql_count="select count(*) as total_num from document where category like '%$categ%'";
				$flagSql="update document set flag1=$flag1 where category like '%$categ%'";
			}else if($upper_cat=='.-1.'){//个人
				$sql="select * from document where category like '%$categ%' and author=(select realname from admininfo where id=$id)";
				$sql_count="select count(*) as total_num from document where category like '%$categ%' and author=(select realname from admininfo where id=$id)";
				$flagSql="update document set flag1=$flag1 where category like '%$categ%' and author=(select realname from admininfo where id=$id)";
			}else if($upper_cat=='.-2.'){//本部门他人
				$sql="select * from document where category like '%$categ%' and author<>(select realname from admininfo where id=$id)";
				$sql_count="select count(*) as total_num from document where category like '%$categ%' and author<>(select realname from admininfo where id=$id)";
				$flagSql="update document set flag1=$flag1 where category like '%$categ%' and author<>(select realname from admininfo where id=$id)";
			}
		}
		else if($isLeader[0][0]=='leader'){//领导
			$result=$db->Select("select managerMoreBm from admininfo where id=".$_SESSION['admin_id']);
			if($result[0][0]!=''){
				$managerMoreBmStr=explode(',',$result[0][0]);
				$str='';
				for($i=0;$i<count($managerMoreBmStr);$i++){
					$deptId=trim(str_replace('.', ' ',$managerMoreBmStr[$i]));
					$str.=$deptId;
					if($i!=count($managerMoreBmStr)-1){
						$str.=',';
					}
				}
				$deptId=trim(str_replace(' ', ',',$str));
				
				if($upper_cat=='.'){//所管部门全部和自己的
					$sql="select * from document where department in($deptId) or author=(select realname from admininfo where id=$id)";
					$sql_count="select count(*) as total_num from document where department in($deptId) or author=(select realname from admininfo where id=$id)";
					$flagSql="update document set flag1=$flag1 where department in($deptId)";
				}else{
					if($is_zero=='-1'){//个人
						$sql="select * from document where author=(select realname from admininfo where id=$id)";
						$sql_count="select count(*) as total_num from document where author=(select realname from admininfo where id=$id)";
						$flagSql="update document set flag1=$flag1 where author=(select realname from admininfo where id=$id)";
					}else{//所管部门人
						if($upper_cat=='.-2.'){
							$sql="select * from document where department in($deptId) and author<>(select realname from admininfo where id=$id)";
							$sql_count="select count(*) as total_num from document where department in($deptId) and author<>(select realname from admininfo where id=$id)";
							$flagSql="update document set flag1=$flag1 where department in($deptId) and author<>(select realname from admininfo where id=$id)";
						}else{
							$sql="select * from document where category like '%$upper_cat%' and author<>(select realname from admininfo where id=$id)";
							$sql_count="select count(*) as total_num from document where category like '%$upper_cat%' and author<>(select realname from admininfo where id=$id)";
							$flagSql="update document set flag1=$flag1 where category like '%$upper_cat%' and author<>(select realname from admininfo where id=$id)";
						}						
					}
				}
			}else{
				$sql="select * from document where author=(select realname from admininfo where id=$id)";
				$sql_count="select count(*) as total_num from document where author=(select realname from admininfo where id=$id)";
				$flagSql="update document set flag1=0 where author=(select realname from admininfo where id=$id)";
			}
		}else if($_SESSION['admin_name']=='super'){
				$sql="select * from document where category like '%$upper_cat%'";
				$sql_count="select count(*) as total_num from document where category like '%$upper_cat%'";
				$flagSql="update document set flag1=$flag1 WHERE category like '%$upper_cat%'";
		}
		else{//普通用户
				$sql="select * from document where author=(select realname from admininfo where id=$id)";
				$sql_count="select count(*) as total_num from document where author=(select realname from admininfo where id=$id)";
				$flagSql="update document set flag1=0 where author=(select realname from admininfo where id=$id)";
			
		}
		
		if($beginDate!=null &&$beginDate!='' && $endDate!=null &&$endDate!=''){
			$sql=$sql." and addedDate between '".$beginDate."' and '".$endDate."'";
			$sqlCount.=" and addedDate between '".$beginDate."' and '".$endDate."'";
		}
		if($file_name!=null&&$file_name!=''){
			$sql.=" and file_name like '%$file_name%' ";
			$sql_count.=" and file_name like '%$file_name%' ";
		}
		if($file_no!=null&&$file_no!=''){
			$sql.=" and file_no like '%$file_no%' ";
			$sql_count.=" and file_no like '%$file_no%' ";
		}
		if($file_type!=null&&$file_type!=''){
			$sql.=" and types like '%$file_type%' ";
			$sql_count.=" and types like '%$file_type%' ";
		}
		if($author!=null&&$author!=''){
			$sql.=" and author like '%$author%' ";
			$sql_count.=" and author like '%$author%' ";
		}
		
		if(strpos($_SESSION['priviledges'],'maker') && $is_zero=='-2'){
			$sql.=" and isInvalid=0 ORDER BY id desc LIMIT $page, $rows ";
			$sql_count.=" and isInvalid=1";
		}else{
			$sql.=" and (isInvalid=0 or isInvalid=1) ORDER BY id desc LIMIT $page, $rows ";
			$sql_count.=" and (isInvalid=0 or isInvalid=1)";
		}
		$db->Update($flagSql);
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sql_count);
		$count=$arr_cou[0]['total_num'];
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';
		}else{
			for($i=0;$i<count($arr);$i++){
				$sqldept="select catName from admincat where isDel=0 and id=".$arr[$i]['department'];
				$dept=$db->Select($sqldept);
				$arr2[$i]=array('id'=>$arr[$i]['id'],
								'department'=>($dept[0]['catName']==''||$dept[0]['catName']=='null')?'无':$dept[0]['catName'],
								'addedDate'=>$arr[$i]['addedDate'],
								'author'=>$arr[$i]['author'],//==$_SESSION['realname']?'1':'0',
								'category'=>$arr[$i]['category'],
								'file_level'=>$arr[$i]['file_level'],
								'file_no'=>$arr[$i]['file_no'],
								'file_name'=>mb_substr($arr[$i]['file_name'],0,25,'utf-8'),
								'file_content'=>$arr[$i]['file_content'],
								'file_type'=>$arr[$i]['file_type'],
								'types'=>$arr[$i]['types'],
								'number'=>$arr[$i]['number'],
								'ismake'=>$arr[$i]['ismake'],
								'flag1'=>$arr[$i]['flag1'],
								'flag2'=>$arr[$i]['flag2'],
								'isInvalid'=>$arr[$i]['isInvalid'],
								'isOwn'=>$arr[$i]['author']==$_SESSION['realname']?'1':'0',
								'sql'=>$sql
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
		$sql="update document set flag1=1 where id=$id";
		$db->Update($sql);
		$db->Close();
		echo json_encode($res);
	}

	/**
	* 修改文件信息
	*/
	public function editFile($info,$id,$addedDate,$types,$file_level,$file_name,$file_content,$number){
		$db=new DB();
		$sql="update document set addedDate='$addedDate',types='$types',file_level='$file_level',file_name='$file_name',file_content='$file_content',number='$number' where id=$id";
		$res=$db->Update($sql);
		$sqlFlag="update document set flag1=0 where id=$id";
		$db->Update($sqlFlag);
		$db->Close();
		echo $res;
	}
	
	/**
	* 删除文件信息
	*/
	public function delFile($id_arr){
		$db=new DB();
		$sql="delete from document where id in ($id_arr)";
		$sqlAttach="delete from attachment where content_id in ($id_arr)";
		$sqlArrattach="select file_path from attachment where content_id in ($id_arr)";
		$arrAttach=$db->Select($sqlArrattach);
		$res=$db->Delete($sql);
		$attach=$db->Delete($sqlAttach);
		if($res=='1' && $attach=='1'){
			for($i=0;$i<count($arrAttach);$i++){
				$file=new FILE();
			    echo $file->del_file(SP_BASEPATH.$arrAttach[$i]['file_path']);
							
			}
		}
		$attach=$db->Delete($sqlAttach);
		$flagSql="update document set flag1=0 where id in ($id_arr)";
		$db->Update($flagSql);
		$db->Close();
		//echo $res;
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
	功能：查找普通附件
	*/
	function attachGrid($id){
						
		$sql='select * from attachment where content_id='.$id.' and isred=0';
		$sqlCount='select count(id) as "count" from attachment where content_id='.$id.'  and isred=0';
		$db=new DB();
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sqlCount);
		$count=$arr_cou[0]['count'];
		
		if(count($arr)!==0){
			for($i=0;$i<count($arr);$i++){
				if($i==(count($arr)-1)){
					$htmlstr.='<a href="javascript:void(0)" onclick="checkAttach('.$arr[$i]['id'].')">'.$arr[$i]['file_name'].'</a>';
				}
				else{
					$htmlstr.='<a href="javascript:void(0)" onclick="checkAttach('.$arr[$i]['id'].')">'.$arr[$i]['file_name'].'</a>'.' , ';
				}
			}
		}
		echo $htmlstr;	
		$db->Close();
	}
	
	//产品详情
	function getInfoById($id){
		$sql="select * from document where id = ".$id;
		$db=new DB();
		$arr=$db->Select($sql);
		//$sqldept="select cat_name from contentcat where isDel=0 and id=".$arr[0]['department'];
		$sqldept="select catName from admincat where isDel=0 and id=".$arr[0]['department'];
		$dept=$db->Select($sqldept);
		$sqlAttach="select id,file_name,file_path from attachment where content_id=$id";
		$attach=$db->Select($sqlAttach);
		$arr=array(
					'department'=>$dept[0][0]==''?'无':$dept[0][0],
					'author'=>$arr[0]['author'],
					'addedDate'=>$arr[0]['addedDate'],
					'types'=>$arr[0]['types'],
					'file_level'=>$arr[0]['file_level'],
					'file_no'=>$arr[0]['file_no'],
					'file_name'=>$arr[0]['file_name'],
					'file_content'=>$arr[0]['file_content'],
					//'file_type'=>$arr[0]['file_type'],
					'file_type'=>$attach[0]['file_name'],
					'file_path'=>$attach[0]['file_path'],
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
		$admin_name=$_SESSION['realname'];
		//$admin_name=$_SESSION['admin_name'];
		$sql="select file_no from document where id=$id";
		$res=$db->Select($sql);
		if($res[0]['file_no']==null || $res[0]['file_no']==''){
			$sql="update document set file_no='$file_no',addtime='$addtime',admin='$admin_name' where id=$id";
			$result=$db->Update($sql);
			echo $result;
		}
		$sqlFlag="update document set flag2=1 where id=$id";
		$db->Update($sqlFlag);
		$db->Close();			
	}
	
	/**
	* 获取附件详情信息
	*/
	public function checkAttach($id){
		$db=new DB();
		//if(strpos($_SESSION['catName'],'拟稿人')>-1){
		if(strpos($_SESSION['exclusive_name'],'drafter')>-1){
			 $isoprn="update attachment set isopen=1 where id=$id";
			 $db->Update($isoprn);
		}
		$sql="select file_path from attachment where id=$id";
		$attachment=$db->Select($sql);
		$attach='../../../../../common/'.$attachment[0][0];
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
		$db->Close();
	}
	/*
	*功能：判断红头文件是否存在
	*/
	function checkRed($id){
		$db= new DB();
		$sql="select * from attachment where content_id=$id and isred=1";
		$res=$db->Select($sql);
		$sql2="select file_no from document where id=$id";
		$res2=$db->Select($sql2);
		$json[0]=array(
			'file_no'=>$res2[0][0],
			'isRed'=>count($res),
		);
		echo json_encode($json);
	}
	/*
	*功能：上传红头文件
	*/
	function load($id,$isred,$attach){
		$db=new DB();
		$attach['content_id']=$id;
		$attach['isred']=$isred;
		
		if(!($_FILES['file']['error'])){
			$time=time();
			$y=date('Y',$time);
			$m=date('m',$time);
			$d=date('d',$time);
			
			$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';
			$vars=array(
				'file'=>'file',
				'limit_size'=>50*1024*1024,
				'savepath'=>$savepath,
				'rootpath'=>SP_BASEPATH,
				'allowed_ext'=>''
			);
			$file=new FILE($vars);
			$attach['file_path']=$file->get_savepath().$file->get_auto_filename();
			$attach['file_ext']=$file->get_file_ext();
			$attach['file_size']=$file->get_filesize();
			$attach['file_name']=$file->get_filename();
			$result=$db->InsertData('attachment',$attach);
			$sql="update document set ismake=2 where id=$id";
			$db->Update($sql);
			echo $result;
		}else{
			echo 'error';
		}
		$db->Close();
	}
	/*
	*功能：加载红头文件列表
	*/
	function redAttachGrid($id,$page,$rows){
				
		$page=($page-1)*$rows;
		
		$sql='select * from attachment where content_id='.$id.' and isred=1 order by id desc ';
		$sqlCount='select count(id) as "count" from attachment where content_id='.$id.' and isred=1 order by id desc ';
		
		$sql=$sql.' limit '.$page.','.$rows;
		$db=new DB();
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sqlCount);
		$count=$arr_cou[0]['count'];
		$sql1="select * from document where id=$id";
		$res=$db->Select($sql1);
		
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array(
					'id'=>$arr[$i]['id'],
					'file_name'=>$arr[$i]['file_name'],
					'file_path'=>$arr[$i]['file_path'],
					'file_ext'=>$arr[$i]['file_ext'],
					'file_size'=>$arr[$i]['file_size'],	
					'brief_ctnt'=>$arr[$i]['brief_ctnt'],
					'isopen'=>$arr[$i]['isopen'],				
					'ismake'=>$res[$i]['ismake'],				
					'isOwn'=>$res[$i]['author']==$_SESSION['realname']?'1':'0'
				);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();
	}
	/*
	*功能：通知制作/重制作红头文件
	*/
	function makeRed($id,$ismake){
		$db=new DB();
		$att=$db->Select("select * from attachment where content_id=$id");
		if(count($att)==0){
			echo 'noUpload';//文件还未上传！
		}
		else{
			if($ismake==3){
				 $isopen="update attachment set isopen=0 where content_id=$id and isred=1";
				 $db->Update($isopen);
			}
			$sql="update document set ismake=$ismake where id=$id";
			$res=$db->Update($sql);
			echo $res;
		}
		$db->Close();
	}
	/*
	*功能：查看制文人是否正在操作该文件
	*/
	function find_maker_flag($id){
		$db=new DB();
		$sql="select flag2 from document where id in($id)";
		$res=$db->Select($sql);
		if($res!=0){
			for($i=0;$i<count($res);$i++){
				if($res[$i]['flag2']=='1'){
					echo 1;
				}
				else{
					echo 0;
				}	
			}
		}
	}
	/*
	*功能：通知制作/重制作红头文件
	*/
	function makeOpen($id){
		$db=new DB();
		if(strpos($_SESSION['priviledges'],'drafter')){
			$isopen="update attachment set isopen=1 where id=$id and isred=1";
			$db->Update($isopen);
		}
		$db->Close();
	}
	/*
	*功能：查看拟稿人是否正在操作该文件
	*/
	function find_usr_flag($id){
		$db=new DB();
		$sql="select flag1 from document where id=$id";
		$res=$db->Select($sql);
		echo $res[0][0];
	}
	/*
	*功能：取消编辑
	*/
	function cancelInfo($id,$flag){
		$db=new DB();
		$sql="update document set flag1=$flag where id in($id)";
		$res=$db->Update($sql);
		echo $res;
	}
	/**
	功能：加载树结构
	*/
	function treeData($up_id,$is_zero){
		$res=$this->getDeptByAdmin_id();
		$db=new DB();
		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		
		//判断是否为科长
		$manager=$db->Select("SELECT isManager FROM admininfo WHERE id=".$_SESSION['admin_id']." limit 0,1");
		//判断是否为领导
		$isLeader=$db->Select("SELECT b.exclusive_name FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id']);

		if($manager[0]['isManager']==1 && strpos($_SESSION['priviledges'],'maker')==''){
			$arr=$db->Select($sql);
				$node[0]['id']=0;
				$node[0]['text']='全部';
				$node[0]['state']='open';
				$node[0]['upper_cat']='.';
				
				$node[1]['id']='-1';
				$node[1]['text']='个人';
				$node[1]['state']='open';
				$node[1]['upper_cat']='.';
				
				$node[2]['id']='-2';
				$node[2]['text']='他人';
				$node[2]['state']='open';
				$node[2]['upper_cat']='.';
		}
		else if($isLeader[0][0]=='leader'){
			$result=$db->Select("select managerMoreBm from admininfo where id=".$_SESSION['admin_id']);
			if($result[0][0]!=''){
				$managerMoreBmStr=explode(',',$result[0][0]);
				$str='';
				for($i=0;$i<count($managerMoreBmStr);$i++){
					$deptId=trim(str_replace('.', ' ',$managerMoreBmStr[$i]));
					$str.=$deptId;
					if($i!=count($managerMoreBmStr)-1){
						$str.=',';
					}
				}
				$deptId=trim(str_replace(' ', ',',$str));
				if($up_id=='-2'){
					$sql="select * from admincat where isDel=0 and upperID = 0 and id in ($deptId)";
				}
				else{
					$sql="select * from admincat where isDel=0 and upperID = $up_id and id in ($deptId)";
				}
				
			}else{
				$rest=$db->Select("select a.id from admincat a,admininfo b where b.category=CONCAT(a.upperCat,a.id,'.') and b.id=".$_SESSION['admin_id']);
				$sql='select * from admincat where isDel=0 and id='.$rest[0][0];
			}
			$arr=$db->Select($sql);
			if($up_id!==0){
				for($i=0;$i<count($arr);$i++){
					$node[$i]['id']=$arr[$i]['id'];
					$node[$i]['text']=$arr[$i]['catName'];
					$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
					$node[$i]['upper_cat']=$arr[$i]['upperCat'];
					$node[$i]['is_leaf']=$arr[$i]['isLast'];
					$node[$i]['is_zero']=$is_zero;
				}
			}else{
				$node[0]['id']=0;
				$node[0]['text']='全部';
				$node[0]['state']='open';
				$node[0]['upper_cat']='.';

				$node[1]['id']='-1';
				$node[1]['text']='个人';
				$node[1]['state']='open';
				$node[1]['upper_cat']='.';
				$node[1]['is_zero']='-1';
				if($result[0][0]!=''){
					$node[2]['id']='-2';
					$node[2]['text']='所管科室';
					$node[2]['state']='closed';
					$node[2]['upper_cat']='.';
					$node[2]['is_zero']='-2';
				}
			}
		}
		else if(strpos($_SESSION['priviledges'],'maker')){//判断是否为制文人
			/*if($up_id=='-2'){//待审核
				$sql="SELECT b.* FROM document a, admincat b WHERE a.department=b.id AND a.file_no IS NULL AND isDel=0 GROUP BY b.catName";
			}
			else if($up_id=='-3'){//已审核
				$sql="SELECT b.* FROM document a, admincat b WHERE a.department=b.id AND a.file_no IS NOT NULL AND isDel=0 GROUP BY b.catName";
			}
			else if($is_zero=='-2'){
				$sql="SELECT b.* FROM document a, admincat b WHERE a.department=b.id AND a.file_no IS NULL AND isDel=0 AND upperID =$up_id GROUP BY b.catName";
			}
			else if($is_zero=='-3'){
				$sql="SELECT b.* FROM document a, admincat b WHERE a.department=b.id AND a.file_no IS NOT NULL AND isDel=0 AND upperID =$up_id GROUP BY b.catName";
			}*/
			if($up_id=='-2' || $up_id=='-3'){
				$sql="select * from admincat where isDel=0 and upperID=0";	
			}else{
				$sql="select * from admincat where isDel=0  and upperID =$up_id";	
			}
			$arr=$db->Select($sql);
			if($up_id!==0){
				for($i=0;$i<count($arr);$i++){
					$node[$i]['id']=$arr[$i]['id'];
					$node[$i]['text']=$arr[$i]['catName'];
					$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
					$node[$i]['upper_cat']=$arr[$i]['upperCat'];
					$node[$i]['is_leaf']=$arr[$i]['isLast'];
					$node[$i]['is_zero']=$is_zero;
				}
			}else{
				$node[0]['id']=0;
				$node[0]['text']='全部';
				$node[0]['state']='open';
				$node[0]['upper_cat']='.';
				
				$node[1]['id']='-1';
				$node[1]['text']='个人';
				$node[1]['state']='open';
				$node[1]['upper_cat']='.';
				$node[1]['is_zero']='-1';
				
				$node[2]['id']='-2';
				$node[2]['text']='待审核';
				$node[2]['state']='closed';
				$node[2]['upper_cat']='.';
				$node[2]['is_zero']='-2';
				
				$node[3]['id']='-3';
				$node[3]['text']='已审核';
				$node[3]['state']='closed';
				$node[3]['upper_cat']='.';
				$node[3]['is_zero']='-3';
			}
		}
		else{
			if($_SESSION['admin_name']=='super'){//超级管理员
				$sql='select * from admincat where isDel=0 and upperID = '.$up_id;
				$arr=$db->Select($sql);
				if($up_id!==0){
					for($i=0;$i<count($arr);$i++){
						$node[$i]['id']=$arr[$i]['id'];
						$node[$i]['text']=$arr[$i]['catName'];
						$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
						$node[$i]['upper_cat']=$arr[$i]['upperCat'];
						$node[$i]['is_leaf']=$arr[$i]['isLast'];
					}
				}else{
					$node[0]['id']=0;
					$node[0]['text']='全部';
					$node[0]['state']='open';
					$node[0]['upper_cat']='.';
							
					for($i=0;$i<count($arr);$i++){
						$node[$i+1]['id']=$arr[$i]['id'];
						$node[$i+1]['text']=$arr[$i]['catName'];
						$node[$i+1]['upper_cat']=$arr[$i]['upperCat'];
						$node[$i+1]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
						$node[$i+1]['is_leaf']=$arr[$i]['isLast'];
					}				
				}	
			}else{
				$node[0]['id']=0;
				$node[0]['text']='全部';
				$node[0]['state']='open';
				$node[0]['upper_cat']='.';
				
				$node[1]['id']='-1';
				$node[1]['text']='个人';
				$node[1]['state']='open';
				$node[1]['upper_cat']='.';
				$node[1]['is_zero']='-1';
			}
				
		}
		echo json_encode($node);
		$db->Close();
	}
	
	//查询申请人所在部门
	public function getDeptByAdmin_id(){
		$db=new DB();
		$sql="SELECT userPrivileges FROM admininfo WHERE id=".$_SESSION['admin_id'];
		$arr=$db->Select($sql);
		$concat1=explode(',',$arr[0]['userPrivileges']);
		$dept=explode('_',$concat1[1]);
		//$sql1="SELECT cat_name FROM contentcat WHERE isDel=0 and CONCAT(upper_cat,id) = ".$dept[1]."limit 0, 1 ";
		$sql1="SELECT catName FROM admincat WHERE isDel=0 and CONCAT(upperCat,id) like '%".$dept[1]."' limit 0, 1 ";
		$res=$db->Select($sql1);
		$result=array(
			//'deptName'=>$res[0]['cat_name'],
			'deptName'=>$res[0]['catName'],
			'category'=>$dept[1].'.'
		);
		$db->Close();
		return $result;
	}
	/**
	功能：删除附件
	*/
	function delAttach($id){
		$db=new DB();
		$file=new FILE();
		$attachment=$db->GetInfo($id,'attachment');
		$file_path=SP_BASEPATH.$attachment['file_path'];
		$result=$db->DelData($id,'attachment');
		if($result=='1'){
			$db->Update("UPDATE document SET ismake=0 WHERE id=".$attachment['content_id']);
			$file=new FILE();
			$file->del_file($file_path);//删除附件
		}
		$db->Close();
	}
	/*
	*功能：标注无效
	*/
	function cancelFile($id){
		$db=new DB();
		$sql="update document set isInvalid=1 where id=$id";
		$res=$db->Update($sql);
		echo $res;
		$db->Close();	
	}	
	/**
	功能：加载树结构
	
	function treeData($up_id){
		$res=$this->getDeptByAdmin_id();
		$db=new DB();
		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		
		//判断是否为leader
		$isLeader=$db->Select("SELECT b.exclusive_name FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id']);
		if($isLeader[0][0]=='leader'){
			$result=$db->Select("select managerMoreBm from admininfo where id=".$_SESSION['admin_id']);
			if($result[0][0]!=''){
				$managerMoreBmStr=explode(',',$result[0][0]);
				$str='';
				for($i=0;$i<count($managerMoreBmStr);$i++){
					$deptId=trim(str_replace('.', ' ',$managerMoreBmStr[$i]));
					$str.=$deptId;
					if($i!=count($managerMoreBmStr)-1){
						$str.=',';
					}
				}
				$rest=$db->Select("select a.id from admincat a,admininfo b where b.category=CONCAT(a.upperCat,a.id,'.') and b.id=".$_SESSION['admin_id']);
				$str.=','.$rest[0][0];
				$deptId=trim(str_replace(' ', ',',$str));
				$sql="select * from admincat where isDel=0 and upperID =$up_id and id in ($deptId)";
			}else{
				if($up_id!=0){
						$sql="select * from admincat where isDel=0 and upperID =$up_id";
				}else{
					$rest=$db->Select("select a.id from admincat a,admininfo b where b.category=CONCAT(a.upperCat,a.id,'.') and b.id=".$_SESSION['admin_id']);
					$sql='select * from admincat where isDel=0 and id='.$rest[0][0];
				}
			}
		}
		else{
			$temp=explode(' ',trim(str_replace('.', ' ',$res['category'])));  //.1.3.
			$tmp=trim(str_replace('.', ' ',$res['category']));
			if($_SESSION['admin_name']=='super' || $temp[0]==0  || strpos($_SESSION['priviledges'],'maker')){
				$sql='select * from admincat where isDel=0 and upperID = '.$up_id;
			}else{
				if($up_id!=0){
					$isin = in_array($up_id,$temp);
					if($isin && !strpos($_SESSION['priviledges'],'file_self')){
						 $sql="select * from admincat where isDel=0 and upperID =$up_id";
					}else{
						$sql="select * from admincat where isDel=0 and upperID =$up_id and id in (".implode(',',$temp).")";
					}
				}else{
					$sql='select * from admincat where isDel=0 and id='.$temp[0];
				}
			}
		}
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
				$node[$i]['id']=$arr[$i]['id'];
				$node[$i]['text']=$arr[$i]['catName'];
				$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upper_cat']=$arr[$i]['upperCat'];
				$node[$i]['is_leaf']=$arr[$i]['isLast'];
			}
		}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			$node[0]['upper_cat']='.';
			
			$node[1]['id']='-1';
			$node[1]['text']='个人';
			$node[1]['state']='closed';
			$node[1]['upper_cat']='.';
			
			
			$node[2]['id']='-2';
			$node[2]['text']='他人';
			$node[2]['state']='closed';
			$node[2]['upper_cat']='.';
		}	
		echo json_encode($node);
		$db->Close();
	}
	*/
	/**
	* 查询文件审批列表
	
	public function getDateGrid($page,$rows,$upper_cat,$is_zero,$beginDate,$endDate,$file_name,$file_no,$flag1,$file_self,$file_type,$author){
		$db=new DB();
		$page=($page-1)*$rows;
		$upper_cat = isset($upper_cat) ? $upper_cat : '.';
		$id=$_SESSION['admin_id'];
		if($file_self==1 || $is_zero==-1){
			$sql="SELECT * FROM document WHERE author=(select realname from admininfo where id=$id) and category like '$upper_cat%'";
			$sql_count="SELECT count(*) as total_num FROM document WHERE author=(select realname from admininfo where id=$id) and category like '$upper_cat%'";
			
			$flagSql="update document set flag1=$flag1 where author=(select realname from admininfo where id=$id) and category like '$upper_cat%'";
		}
		else{
			if($_SESSION['admin_name']=='super' || strpos($_SESSION['priviledges'],'maker')){
					$sql="SELECT * FROM document WHERE category like '$upper_cat%' ";
					$sql_count="SELECT count(*) as total_num FROM document WHERE category like '$upper_cat%'";
					$flagSql="update document set flag1=$flag1 where category like '$upper_cat%' ";
			}else{
				$sql1="SELECT userPrivileges FROM admininfo WHERE id=".$id;
				$arr=$db->Select($sql1);
				$concat1=explode(',',$arr[0]['userPrivileges']);
				$dept=explode('_',$concat1[1]);
				$category=$dept[1].'.';
				
				if($upper_cat=='.'){
					$isLeader=$db->Select("SELECT b.exclusive_name FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id']);
					if($isLeader[0][0]=='leader'){
						
						$sql="SELECT * FROM document WHERE 1=0";
						$sql_count="SELECT count(*) as total_num FROM document WHERE 1=0";
						$flagSql="update document set flag1=$flag1 WHERE 1=0";
						
						$result=$db->Select("select managerMoreBm from admininfo where id=$id");
						if($result[0][0]!=''){
							$arrId=explode(',',$result[0][0]);
							for($i=0;$i<count($arrId);$i++){
								$sql.=" or category like '$arrId[$i]%'";
								$sql_count.=" or category like '$arrId[$i]%'";
								$flagSql.=" or category like '$arrId[$i]%'";
							}
						}else{
							$sql="SELECT * FROM document WHERE category like '$category%' ";
							$sql_count="SELECT count(*) as total_num FROM document WHERE category like '$category%'";
							
							$flagSql="update document set flag1=$flag1 where category like '$category%' ";
						}
					}
					else{
						if($category=='.'||$category=='0.'){
							$sql="SELECT * FROM document WHERE category like '$category%' ";
							$sql_count="SELECT count(*) as total_num FROM document WHERE category like '$category%'";
							
							$flagSql="update document set flag1=$flag1 where category like '$category%' ";
						}else{
							$sql="SELECT * FROM document WHERE category like '$category%' ";
							$sql_count="SELECT count(*) as total_num FROM document WHERE category like '$category%'";
							
							$flagSql="update document set flag1=$flag1 where category like '$category%' ";
						}
					}
				}
				else{
					$cat_id=$db->Select("SELECT id FROM admincat WHERE upperID=(SELECT b.upperCat FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id'].')');
					if($cat_id[0][0]==''){
						$idArr=$db->Select("SELECT b.id FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id']);
						$admincat_id=$idArr[0][0];
						$sql="SELECT * FROM document WHERE category like '%.$admincat_id.' and category like '$upper_cat%'";
						$sql_count="SELECT count(*) as total_num FROM document WHERE category like '%.$admincat_id.' and category like '$upper_cat%'";
						$flagSql="update document set flag1=$flag1 where category like '%.$admincat_id.' and category like '$upper_cat%'";
					}else{
						$sql="SELECT * FROM document WHERE category like '$upper_cat%' ";
						$sql_count="SELECT count(*) as total_num FROM document WHERE category like '$upper_cat%'";
						$flagSql="update document set flag1=$flag1 where category like '$upper_cat%' ";
					}
				}
			}
		}
		if($beginDate!=null &&$beginDate!='' && $endDate!=null &&$endDate!=''){
			$sql=$sql." and addedDate between '".$beginDate."' and '".$endDate."'";
			$sqlCount.=" and addedDate between '".$beginDate."' and '".$endDate."'";
		}
		if($file_name!=null&&$file_name!=''){
			$sql.=" and file_name like '%$file_name%' ";
			$sql_count.=" and file_name like '%$file_name%' ";
		}
		if($file_no!=null&&$file_no!=''){
			$sql.=" and file_no like '%$file_no%' ";
			$sql_count.=" and file_no like '%$file_no%' ";
		}
		if($file_type!=null&&$file_type!=''){
			$sql.=" and types like '%$file_type%' ";
			$sql_count.=" and types like '%$file_type%' ";
		}
		if($author!=null&&$author!=''){
			$sql.=" and author like '%$author%' ";
			$sql_count.=" and author like '%$author%' ";
		}
		$sql.=" and (isInvalid=0 or isInvalid=1) ORDER BY id desc LIMIT $page, $rows ";
		$sql_count.=" and (isInvalid=0 or isInvalid=1)";
		$db->Update($flagSql);
		
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sql_count);
		$count=$arr_cou[0]['total_num'];
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';
		}else{
			for($i=0;$i<count($arr);$i++){
				$sqldept="select catName from admincat where isDel=0 and id=".$arr[$i]['department'];
				$dept=$db->Select($sqldept);
				$arr2[$i]=array('id'=>$arr[$i]['id'],
								'department'=>($dept[0]['catName']==''||$dept[0]['catName']=='null')?'无':$dept[0]['catName'],
								'addedDate'=>$arr[$i]['addedDate'],
								'author'=>$arr[$i]['author'],//==$_SESSION['realname']?'1':'0',
								'category'=>$arr[$i]['category'],
								'file_level'=>$arr[$i]['file_level'],
								'file_no'=>$arr[$i]['file_no'],
								'file_name'=>mb_substr($arr[$i]['file_name'],0,25,'utf-8'),
								'file_content'=>$arr[$i]['file_content'],
								'file_type'=>$arr[$i]['file_type'],
								'types'=>$arr[$i]['types'],
								'number'=>$arr[$i]['number'],
								'ismake'=>$arr[$i]['ismake'],
								'flag1'=>$arr[$i]['flag1'],
								'flag2'=>$arr[$i]['flag2'],
								'isInvalid'=>$arr[$i]['isInvalid'],
								'isOwn'=>$arr[$i]['author']==$_SESSION['realname']?'1':'0'
								);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();	
	}*/
}
?>