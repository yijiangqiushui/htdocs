<?php
/***********************************************************************
author:贺央央
Modified by Gao Xue  2014/04/30  function treeData
Modified by Ma Jun Wei 2014/09/05 
***********************************************************************/

class USERCAT {
	//获取管理分类列表
	function adminCat(){
		$db=new DB();
		$sql="SELECT catName,CONCAT(upperCat,id,'.')AS category FROM admincat ORDER BY category ASC ";
		$resArr = $db->Select($sql);
		echo json_encode($resArr);
	}
	
	function saveEdtEle($id,$role){
		$db=new DB();
		$sql='select * from admincat where id='.$id;
		$res=$db->Select($sql);
		if($role['upperID']==$res[0]['id']){
			echo 'error';
			return;
		}
		if($res[0]['upperID']==$role['upperID']){
			//节点位置没改变
			$sql_edt1='update admincat set exclusive_name="'.$role['exclusive_name'].'", catName="'.$role['catName'].'" where id='.$id;	
			$db->Update($sql_edt1);	
		}else{
			//节点位置改变
			if($role['upperID']==0){
				$role['upperCat']='.';	
			}else{
				$sql_par='select upperCat from admincat where id='.$role['upperID'];
				$par=$db->Select($sql_par);
				$role['upperCat']=$par[0]['upperCat'].$role['upperID'].'.';
			}
			$sql_edt1='update admincat set exclusive_name="'.$role['exclusive_name'].'", catName="'.$role['catName'].'",upperCat="'.$role['upperCat'].'",upperID='.$role['upperID'].' where id='.$id;	
			$db->Update($sql_edt1);//编辑节点
			if($res['isLast']==0){
				//所编辑的节点不是叶子节点时，修改编辑节点的子节点。
				$oldcat=$res[0]['upperCat'].$id.'.';
				$newcat=$role['upperCat'].$id.'.';
				
				$sql_leaf='select id,upperCat from admincat where upperCat like "'.$oldcat.'%"';
				$leaf=$db->Select($sql_leaf);
				for($i=0;$i<count($leaf);$i++){
					$c=str_replace($oldcat,$newcat,$leaf[$i]['upperCat']);
					$sql_edtleaf='update admincat set upperCat ="'.$c.'" where id='.$leaf[$i]['id'];
					$db->Update($sql_edtleaf);	
				}	
			}
			//编辑完成后修改原父节点和新父节点的isLast属性		
			$this->setleaf($db,$res[0]['upperID']);	
			$this->setleaf($db,$role['upperID']);			
		}	
		$db->Close();
	
		$state=$res[0]['isLast']?'open':'closed';
	
		$jn='[{id:'.$id.',text:"'.$role['catName'].'",state:"'.$state.'",upperID:'.$role['upperID'].'}]';
		echo $jn;
	
	}

	function setleaf($db,$id){
		if($id!=0){
			$sql='select count(id) as "count" from admincat where upperID = '.$id;
			$res=$db->Select($sql);
			if($res[0]['count']==0){
				$leaf=1;	
			}else{
				$leaf=0;	
			}
			$sql2='update admincat set isLast='.$leaf.' where id='.$id;
			$db->Update($sql2);
		}
	}

	/**
	*根据id查找信息
	**/
	function findbyid($id){
		$db=new DB();
		$cat=$db->GetInfo($id,'admincat');
		
		if(!empty($cat['userPrivileges'])){
			$arr=explode(',',$cat['userPrivileges']);
			$r='';
			if(count($arr)>0){
				for($j=0;$j<count($arr);$j++){
					if(strpos($arr[$j],'concats_')>-1){
						$r==''?$r='concats_role'.':"'.str_replace('concats_','',$arr[$j]).'"':$r=$r.', concats_role'.':"'.str_replace('concats_','',$arr[$j]).'"';
					}else if(strpos($arr[$j],'admincats_')>-1){
						$r==''?$r='admincats_role'.':"'.str_replace('admincats_','',$arr[$j]).'"':$r=$r.', admincats_role'.':"'.str_replace('admincats_','',$arr[$j]).'"';
					}else{
						$r==''?$r=$arr[$j].':"'.$arr[$j].'"':$r=$r.','.$arr[$j].':"'.$arr[$j].'"';
					}
				}
			}
		}
		$json='{id:'.$cat['id'].',exclusive_name:"'.$cat['exclusive_name'].'",catName:"'.$cat['catName'].'",upperCat:"'.$cat['upperCat'].'",upperID:'.$cat['upperID'].',isForbidden:'.$cat['isForbidden'].',userPrivileges:"'.$cat['userPrivileges'].'",isLast:'.$cat['isLast'].','.$r.'}';
	
		echo $json;
		
		$db->Close();	
		
	}
	
	/**
	*树形结构数据
	**/
	function treeData($up_id,$table_name){
		
		$db=new DB();
		//global $up_id;全局变量该为传参形式
		$up_id = isset($up_id) ? intval($up_id) : 0;
		//$sql='select * from admincat where upperID ='.$up_id;
		$sql="SELECT *,CONCAT(upperCat,id,'.')AS category FROM ".$table_name." where isDel=0 and upperID = ".$up_id;
		if($_SESSION['admin_id']!=1&&$table_name=='admincat'){
			$priviledgesArr=explode(',',$_SESSION['priviledges']);
			$admin_arr=explode('_',$priviledgesArr[2]);
			if($admin_arr[1]>0){
				$sql2="select upperCat from admincat where id=".$admin_arr[1]; 
				$upperidstr=$db->Select($sql2);
				$str='';
				$upperid_arr=explode('.',$upperidstr[0]['upperCat']);
				for($i=0;$i<count($upperid_arr);$i++){
					if($upperid_arr[$i]!=''){
						$str.=" or id=".$upperid_arr[$i];
					}
				}
				$sql=$sql." and (id=".$admin_arr[1].$str.')';
			}
		}
		$sql.=" ORDER BY category ASC";
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
			
				$node[$i]['id']=$arr[$i]['id'];
				$node[$i]['category']=$arr[$i]['category'];
				$node[$i]['exclusive_name']=$arr[$i]['exclusive_name'];
				$node[$i]['text']=$arr[$i]['catName'];
				$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upperCat']=$arr[$i]['upperCat'];
				$node[$i]['isLast']=$arr[$i]['isLast'];
			}
		}else{
				$node[0]['id']=0;
				$node[0]['upperCat']='';
				$node[0]['category']='.';
				$node[0]['exclusive_name']='';
				$node[0]['text']='全部';
				$node[0]['state']='open';
				
				for($i=0;$i<count($arr);$i++){
			
				$node[$i+1]['id']=$arr[$i]['id'];
				$node[$i+1]['category']=$arr[$i]['category'];
				$node[$i+1]['exclusive_name']=$arr[$i]['exclusive_name'];
				$node[$i+1]['text']=$arr[$i]['catName'];
				$node[$i+1]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i+1]['upperCat']=$arr[$i]['upperCat'];
				$node[$i+1]['isLast']=$arr[$i]['isLast'];
			}				
		}	
		echo json_encode($node);
			
	}
	
	/**
	*表格数据查询
	**/
	function show($isDel,$role, $upid, $page, $rows){
		/**
		全局变量改为传参形式
		global $role;	
		global $upid;
		global $page;
		global $rows;
		*/
		
		$db=new DB();	
		$page=($page-1)*$rows;
		$upid = isset($upid) ? intval($upid) : 0;
		$sql='select * from admincat where isDel='.$isDel.' and upperID = '.$upid;
		$sql_cou='select count(id) as "count" from admincat where isDel='.$isDel.' and upperID = '.$upid;	
		if($role['catName']!==null&&$role['catName']!==''){
			$str='"%'.$role['catName'].'%"';
			$sql=$sql.' and catName like '.$str;
			
			$sql_cou=$sql_cou.' and catName like '.$str;
			
		}
		if($role['isForbidden']!==null&&$role['isForbidden']!==''){
			$i=intval($role['isForbidden']);
			$sql=$sql.' and isForbidden = '.$i;
			$sql_cou=$sql_cou.' and isForbidden ='.$i;
		}
		if($_SESSION['admin_id']!=1){
			$priviledgesArr=explode(',',$_SESSION['priviledges']);
			$admin_arr=explode('_',$priviledgesArr[2]);
			if($admin_arr[1]>0){
				$sql2="select upperCat from admincat where id=".$admin_arr[1]; 
				$upperidstr=$db->Select($sql2);
				$str='';
				$upperid_arr=explode('.',$upperidstr[0]['upperCat']);
				for($i=0;$i<count($upperid_arr);$i++){
					if($upperid_arr[$i]!=''){
						$str.=" or id=".$upperid_arr[$i];
					}
				}
				$sql=$sql." and (id=".$admin_arr[1].$str.')';
			}
		}
		
		$sql=$sql.' limit '.$page.','.$rows;
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sql_cou);
		$count=$arr_cou[0]['count'];
		
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				
				$pri=$arr[$i]['userPrivileges'];
				
				//echo $pri.'-----';
				
				//echo strpos($pri,',').'++++++++';

				
				if(strpos($pri,',')>0){
					//把所管分类屏蔽掉
					if(strpos($pri,'concats_')>-1){
						$pri=substr($pri,strpos($pri,',')+1);
					}
					if(strpos($pri,'linkcats_')>-1){
						$pri=substr($pri,strpos($pri,',')+1);
					}
					if(strpos($pri,'questionscats_')>-1){
						$pri=substr($pri,strpos($pri,',')+1);
					}
					if(strpos($pri,'messcats_')>-1){
						$pri=substr($pri,strpos($pri,',')+1);
					}
					if(strpos($pri,'admincats_')>-1){
						$pri=substr($pri,strpos($pri,',')+1);
					}
					if(strpos($pri,',')===false){
						$pri=substr($pri,0,strpos($pri,','));
					}
					/*******************部门分类********************************/					
					if(strpos($pri,'concat_add')>0){
						$pri=str_replace('concat_add','添加部门分类信息',$pri);	
					}
					
					if(strpos($pri,'concat_query')>0){
						$pri=str_replace('concat_query','查看部门分类信息',$pri);	
					}
					
					if(strpos($pri,'concat_del')>0){
						$pri=str_replace('concat_del','删除部门分类信息',$pri);	
					}
					if(strpos($pri,'concat_edit')>0){
						$pri=str_replace('concat_edit','修改部门分类信息',$pri);	
					}
					if(strpos($pri,'concat_disable')>0){
						$pri=str_replace('concat_disable','禁用部门分类',$pri);	
					}
					if(strpos($pri,'concat_enable')>0){
						$pri=str_replace('concat_enable','启用部门分类',$pri);	
					}
					
					/*******************创建制发文件信息********************************/ 

					if(strpos($pri,'file_add')>0){
						$pri=str_replace('file_add','创建制发文件',$pri);	
					}
					if(strpos($pri,'file_query')>0){
						$pri=str_replace('file_query','查看文件信息',$pri);	
					}
					if(strpos($pri,'file_del')>0){
						$pri=str_replace('file_del','删除文件信息',$pri);	
					}
					if(strpos($pri,'file_edit')>0){
						$pri=str_replace('file_edit','修改文件信息',$pri);	
					}
					if(strpos($pri,'file_red')>0){
						$pri=str_replace('file_red','上传红头文件',$pri);	
					}
					if(strpos($pri,'find_red')>0){
						$pri=str_replace('find_red','查看红头信息',$pri);	
					}
					if(strpos($pri,'make_red')>0){
						$pri=str_replace('make_red','制作红头文件',$pri);	
					}
					if(strpos($pri,'file_detail')>0){
						$pri=str_replace('file_detail','查看文件详情',$pri);	
					}
					if(strpos($pri,'file_no')>0){
						$pri=str_replace('file_no','生成文件编码',$pri);	
					}
					if(strpos($pri,'file_self')>0){
						$pri=str_replace('file_self','只显示自己的制发文件',$pri);	
					}
					if(strpos($pri,'file_report')>0){
						$pri=str_replace('file_report','制发文件统计',$pri);	
					}
					
					/*******************印章使用申请********************************/
					
					if(strpos($pri,'seal_add')>0){
						$pri=str_replace('seal_add','添加印章使用申请',$pri);	
					}
					if(strpos($pri,'seal_query')>0){
						$pri=str_replace('seal_query','查看印章申请',$pri);	
					}
					if(strpos($pri,'seal_del')>0){
						$pri=str_replace('seal_del','删除印章申请',$pri);	
					}
					if(strpos($pri,'seal_edit')>0){
						$pri=str_replace('seal_edit','编辑印章申请',$pri);	
					}
					if(strpos($pri,'seal_getNo')>0){
						$pri=str_replace('seal_getNo','生成文件编码',$pri);	
					}
					if(strpos($pri,'seal_status')>0){
						$pri=str_replace('seal_status','设置信息状态',$pri);	
					}
					if(strpos($pri,'seal_reject')>0){
						$pri=str_replace('seal_reject','驳回申请',$pri);	
					}
					if(strpos($pri,'seal_report')>0){
						$pri=str_replace('seal_report','印章使用统计',$pri);	
					}
					
					/*******************短信管理********************************/
					if(strpos($pri,'sms_query')>0){
						$pri=str_replace('sms_query','查询短消息',$pri);	
					}
					if(strpos($pri,'sms_add')>0){
						$pri=str_replace('sms_add','发送短消息',$pri);	
					}
					if(strpos($pri,'sms_reply')>0){
						$pri=str_replace('sms_reply','查看回复消息',$pri);	
					}
					if(strpos($pri,'sms_del')>0){
						$pri=str_replace('sms_del','删除短消息',$pri);	
					}
					if(strpos($pri,'sms_report')>0){
						$pri=str_replace('sms_report','短信统计',$pri);	
					}
					
					/*******************通讯录分组信息********************************/
					if(strpos($pri,'smslistcat_query')>0){
						$pri=str_replace('smslistcat_query','查看通讯录分组信息',$pri);	
					}
					if(strpos($pri,'smslistcat_add')>0){
						$pri=str_replace('smslistcat_add','添加通讯录分组信息',$pri);	
					}
					if(strpos($pri,'smslistcat_del')>0){
						$pri=str_replace('smslistcat_del','删除通讯录分组信息',$pri);	
					}
					if(strpos($pri,'smslistcat_edit')>0){
						$pri=str_replace('smslistcat_edit','编辑通讯录分组信息',$pri);	
					}
					if(strpos($pri,'smslistinfo_disable')>0){
						$pri=str_replace('smslistinfo_disable','禁用通讯录分类',$pri);	
					}
					if(strpos($pri,'smslistinfo_enable')>0){
						$pri=str_replace('smslistinfo_enable','启用通讯录分组',$pri);	
					}
					/*******************通讯录内容信息********************************/	
					if(strpos($pri,'smslistinfo_query')>0){
						$pri=str_replace('smslistinfo_query','查看通讯录信息',$pri);	
					}
					if(strpos($pri,'smslistinfo_add')>0){
						$pri=str_replace('smslistinfo_add','添加通讯录信息',$pri);	
					}
					if(strpos($pri,'smslistinfo_del')>0){
						$pri=str_replace('smslistinfo_del','删除通讯录信息',$pri);	
					}
					if(strpos($pri,'smslistinfo_import')>0){
						$pri=str_replace('smslistinfo_import','导入通讯录信息',$pri);	
					}
					if(strpos($pri,'smslistinfo_export')>0){
						$pri=str_replace('smslistinfo_export','导出通讯录信息',$pri);	
					}
					
					/*******************设置********************************/
					if(strpos($pri,'admincat_query')>0){
						$pri=str_replace('admincat_query','查看角色信息',$pri);	
					}
					if(strpos($pri,'admincat_add')>0){
						$pri=str_replace('admincat_add','添加角色',$pri);	
					}
					if(strpos($pri,'admincat_edit')>0){
						$pri=str_replace('admincat_edit','修改角色信息',$pri);	
					}
					if(strpos($pri,'admincat_del')>0){
						$pri=str_replace('admincat_del','删除角色',$pri);	
					}
					if(strpos($pri,'admincat_disable')>0){
						$pri=str_replace('admincat_disable','禁用角色',$pri);	
					}
					if(strpos($pri,'admincat_enable')>0){
						$pri=str_replace('admincat_enable','启用角色',$pri);	
					}
					if(strpos($pri,'admininfo_query')>0){
						$pri=str_replace('admininfo_query','查看管理员信息',$pri);	
					}
					if(strpos($pri,'admininfo_add')>0){
						$pri=str_replace('admininfo_add','添加管理员',$pri);	
					}
					if(strpos($pri,'admininfo_edit')>0){
						$pri=str_replace('admininfo_edit','修改管理员信息',$pri);	
					}
					if(strpos($pri,'admininfo_del')>0){
						$pri=str_replace('admininfo_del','删除管理员信息',$pri);	
					}
					if(strpos($pri,'admininfo_disable')>0){
						$pri=str_replace('admininfo_disable','禁用管理员',$pri);	
					}
					if(strpos($pri,'admininfo_enable')>0){
						$pri=str_replace('admininfo_enable','启用管理员',$pri);	
					}
					/*******************扩展********************************/
					if(strpos($pri,'loginfo_query')>0){
						$pri=str_replace('loginfo_query','查看日志信息',$pri);	
					}
					if(strpos($pri,'data_backup')>0){
						$pri=str_replace('data_backup','备份数据',$pri);	
					}
					if(strpos($pri,'data_restore')>0){
						$pri=str_replace('data_restore','恢复数据',$pri);	
					}
					
					if($pri!='')
					$pri=substr($pri,strpos($pri,',')+1);
					
				}else{
					$pri='';	
				}	
				if($arr[$i]['upperID']==0){
					$upperName='全部';
				}else{
					$upperName_sql="select catName from admincat where id=".$arr[$i]['upperID'];
					$res=$db->Select($upperName_sql);
					$upperName=$res[0]['catName'];
				}
				$arr2[$i]=array('id'=>$arr[$i]['id'],'catName'=>$arr[$i]['catName'],'exclusive_name'=>$arr[$i]['exclusive_name'],'upperName'=>$upperName,'upperCat'=>$arr[$i]['upperCat'],'upperID'=>$arr[$i]['upperID'],'isForbidden'=>$arr[$i]['isForbidden']?'禁用':'可用','userPrivileges'=>$pri,'isLast'=>$arr[$i]['isLast']?'是':'否');		
			}
				
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		
		}
		$db->Close();
		
		echo $json;	
	}
	
	/**
	*添加
	**/
	function add($role){
		$db=new DB();
		
		if($role['upperID']==0){
			$role['upperCat']='.';	
		}else{
			$sql='select upperCat,isLast from admincat where id='.$role['upperID'];
			
			$res=$db->Select($sql);
			
			if($res[0]['isLast']==1){
				$sql_edit='update admincat set isLast=0 where id='.$role['upperID'];
				$db->Update($sql_edit);	
			}
			
			$role['upperCat']=$res[0]['upperCat'].$role['upperID'].'.';	
		}
		
		$role['isForbidden']=0;
		$role['isLast']=1;
		
		$db->InsertData('admincat',$role);
		
		$sql_id='select max(id) as id from admincat';
		$maxid=$db->Select($sql_id);
		//echo $maxid[0]['id'];
		
		$nd='[{id:'.$maxid[0]['id'].',text:"'.$role['catName'].'"}]';
		echo $nd;
		
		$db->Close();
		
	}

	//逻辑删除
	function delEle($id){
		$db=new DB();	
		$sql='select upperCat,upperID,isLast from admincat where id='.$id;
			
		$r=$db->Select($sql);
		
		$upid=$r[0]['upperID'];
		$upcat=$r[0]['upperCat'].$id.'.';
		$l=$r[0]['isLast'];
		if($l==1){
			$admincatArr['isDel']=1;
			$db->UpdateData('admincat',$id,$admincatArr);
		}else{
			$admincatArr['isDel']=1;
			$sql_del="update admincat set isDel=1 where upperCat like '.$upcat.%'";
			$db->Update($sql_del);
			$db->UpdateData('admincat',$id,$admincatArr);
		}
		$sqlInfo='update admininfo set isDel=1 where category like "'.$upcat.'%"';
		$db->Update($sqlInfo);
		$this->setleaf($db,$upid);
	
		$db->Close();	
	}

	//批量逻辑删除
	function delByIdList($idlist){
		//global $idlist;全局参数改为传参形式
		$idarray=explode(',',$idlist);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql='select upperCat,upperID,isLast from admincat where id='.$idarray[$i];
			$r=$db->Select($sql);
			$upid=$r[0]['upperID'];
			$upcat=$r[0]['upperCat'].$idarray[$i].'.';
			$l=$r[0]['isLast'];
			if($l==1){	
				$admincatArr['isDel']=1;
				$db->UpdateData('admincat',$idarray[$i],$admincatArr);
			}else{
				$admincatArr['isDel']=1;
				$sql_del="update admincat set isDel=1 where upperCat like '.$upcat.%'";
				$db->Update($sql_del);
				$db->UpdateData('admincat',$idarray[$i],$admincatArr);
			}
			$sqlInfo='update admininfo set isDel=1 where category like "'.$upcat.'%"';
			$db->Update($sqlInfo);
			$this->setleaf($db,$upid);
		}
		$db->Close();
		echo $idlist;
	}

	//物理删除
	function delEle_($id){
		$db=new DB();	
		$sql='select upperCat,upperID,isLast from admincat where id='.$id;
			
		$r=$db->Select($sql);
		
		$upid=$r[0]['upperID'];
		$upcat=$r[0]['upperCat'].$id.'.';
		$l=$r[0]['isLast'];
		if($l==1){
			$db->DelData($id,'admincat');
		}else{
			$sql_del='delete from admincat where upperCat like "'.$upcat.'%"';
			$db->Delete($sql_del);
			
			$db->DelData($id,'admincat');	
		}
		$sqlInfo='delete from admininfo where category like "'.$upcat.'%"';
		$db->Delete($sqlInfo);
		$this->setleaf($db,$upid);
	
		$db->Close();	
	}
	
	//批量物理删除
	function delByIdList_($idlist){
		//global $idlist;全局参数改为传参形式
		$idarray=explode(',',$idlist);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql='select upperCat,upperID,isLast from admincat where id='.$idarray[$i];
			$r=$db->Select($sql);
			$upid=$r[0]['upperID'];
			$upcat=$r[0]['upperCat'].$idarray[$i].'.';
			$l=$r[0]['isLast'];
			if($l==1){	
				$db->DelData($idarray[$i],'admincat');
			}else{
				$sql_del='delete from admincat where upperCat like "'.$upcat.'%"';
				$db->Delete($sql_del);
				$db->DelData($idarray[$i],'admincat');	
			}
			$sqlInfo='delete from admininfo where category like "'.$upcat.'%"';
			$db->Delete($sqlInfo);
			$this->setleaf($db,$upid);
		}
		$db->Close();
		echo $idlist;
	}
	
	//禁用操作
	function disableEle($idlist, $flag){
		/**
		全局参数改为传参形式
		global $idlist;
		global $flag;
		*/
		$idarray=explode(',',$idlist);
		
		$db=new DB();
		
		for($i=0;$i<count($idarray);$i++){
	
			$sql_edit='update admincat set isForbidden='.$flag.' where id='.$idarray[$i];
			$result=$db->Update($sql_edit);	
			
			if($result==1){
				$sqlOne='select * from admincat where id='.$idarray[$i];
				$res=$db->Select($sqlOne);
				if($res[0]['isLast']==0){
					$sql_editLike='update admincat set isForbidden='.$flag.' where upperCat like "%'.$res[0]['upperCat'].$res[0]['id'].'.'.'%"';
					$db->Update($sql_editLike);
				}
				$sql_editInfo='update admininfo set isForbidden='.$flag.' where category like "%'.$res[0]['upperCat'].$res[0]['id'].'.'.'%"';
				$db->Update($sql_editInfo);
			}
		}
		$db->Close();	
	}
	
	//恢复删除的数据
	function uptisDel($id){
		$db=new DB();	
		$sql='select upperCat,upperID,isLast from admincat where id='.$id;
			
		$r=$db->Select($sql);
		
		$upid=$r[0]['upperID'];
		$upcat=$r[0]['upperCat'].$id.'.';
		$l=$r[0]['isLast'];
		if($l==1){
			$admincatArr['isDel']=0;
			$db->UpdateData('admincat',$id,$admincatArr);
		}else{
			$sql_del="update admincat set isDel=0 where id=$id or upperCat like '$upcat%'";
			$db->Update($sql_del);
		}
		$sqlInfo='update admininfo set isDel=0 where category like "'.$upcat.'%"';
		$db->Update($sqlInfo);
		$this->setleaf($db,$upid);
	
		$db->Close();	
	}	
	
	//批量恢复删除的数据
	function uptisDelList($idlist){
		//global $idlist;全局参数改为传参形式
		$idarray=explode(',',$idlist);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql='select upperCat,upperID,isLast from admincat where id='.$idarray[$i];
			$r=$db->Select($sql);
			$upid=$r[0]['upperID'];
			$upcat=$r[0]['upperCat'].$idarray[$i].'.';
			$l=$r[0]['isLast'];
			if($l==1){	
				$admincatArr['isDel']=0;
				$db->UpdateData('admincat',$idarray[$i],$admincatArr);
			}else{
				$sql_del="update admincat set isDel=0 where id='.$idarray[$i] or upperCat like '.$upcat.%'";
				$db->Update($sql_del);
			}
			$sqlInfo='update admininfo set isDel=0 where category like "'.$upcat.'%"';
			$db->Update($sqlInfo);
			$this->setleaf($db,$upid);
		}
		$db->Close();
		echo $idlist;
	}	
	
	/**
	* 功能：加载树结构
	* @param $up_id 上级节点id，$table_name 表名
	*/
	function content_tree($up_id,$table_name){
		$up_id= isset($up_id)?$up_id:0;//判断变量是否存在
		if($up_id!=0){
			$upid=explode('.',$up_id);
//			$up_id=intval($upid[0]);
			$up_id=intval($upid[count($upid)-1]);
		}
		$sql="select * from ".$table_name." where isDel=0 and upperID =".$up_id;
		$db=new DB();
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
//				$node[$i]['id']=$arr[$i]['id'];
				$node[$i]['id']=$arr[$i]['upperCat'].$arr[$i]['id'];
				$node[$i]['text']=$arr[$i]['catName'];
				$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upper_cat']=$arr[$i]['upperCat'];
				$node[$i]['is_leaf']=$arr[$i]['isLast'];
				//$node[$i]['catname_all']=$arr[$i]['catname_all'];
			}
		}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			$node[0]['upper_cat']='.';
			
			for($i=0;$i<count($arr);$i++){
				//$node[$i+1]['id']=$arr[$i]['id'];
				$node[$i+1]['id']=$arr[$i]['upperCat'].$arr[$i]['id'];
				$node[$i+1]['text']=$arr[$i]['catName'];
				$node[$i+1]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i+1]['upper_cat']=$arr[$i]['upperCat'];
				$node[$i+1]['is_leaf']=$arr[$i]['isLast'];
				//$node[$i+1]['catname_all']=$arr[$i]['catname_all'];
			}				
		}	
		echo json_encode($node);
	}	

	/**
	* 功能：加载树结构
	* @param $up_id 上级节点id，$table_name 表名
	*/
	function get_content_tree($up_id,$table_name){
		$up_id= isset($up_id)?$up_id:0;//判断变量是否存在
		if($up_id!=0){
			$upid=explode('.',$up_id);
//			$up_id=intval($upid[0]);
			$up_id=intval($upid[count($upid)-1]);
		}
		$sql="select * from ".$table_name." where isDel=0 and upperID =".$up_id;
		$db=new DB();
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
//				$node[$i]['id']=$arr[$i]['id'];
				$node[$i]['id']=$arr[$i]['upperCat'].$arr[$i]['id'];
				$node[$i]['text']=$arr[$i]['catName'];
				$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upper_cat']=$arr[$i]['upperCat'];
				$node[$i]['is_leaf']=$arr[$i]['isLast'];
				//$node[$i]['catname_all']=$arr[$i]['catname_all'];
			}
		}else{/*
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			$node[0]['upper_cat']='.';
			*/
			for($i=0;$i<count($arr);$i++){
				//$node[$i+1]['id']=$arr[$i]['id'];
				$node[$i]['id']=$arr[$i]['upperCat'].$arr[$i]['id'];
				$node[$i]['text']=$arr[$i]['catName'];
				$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upper_cat']=$arr[$i]['upperCat'];
				$node[$i]['is_leaf']=$arr[$i]['isLast'];
				//$node[$i+1]['catname_all']=$arr[$i]['catname_all'];
			}				
		}	
		echo json_encode($node);
	}	

	/**
	*加载树结构
	**/
	function tree($up_id,$table_name){
		$up_id= isset($up_id)?$up_id:0;//判断变量是否存在
		if($up_id!=0){
			$upid=explode('.',$up_id);
			$up_id=intval($upid[count($upid)-1]);
		}
		$sql="SELECT *,CONCAT(upperCat,id,'.')AS category FROM ".$table_name." where upperID = ".$up_id." ORDER BY category ASC;";
		$db=new DB();
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
			
				//$node[$i]['id']=$arr[$i]['upperCat'].$arr[$i]['id'];
				$node[$i]['id']=$arr[$i]['id'];
				$node[$i]['category']=$arr[$i]['category'];
				$node[$i]['text']=$arr[$i]['catName'];
				$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upperCat']=$arr[$i]['upperCat'];
				$node[$i]['isLast']=$arr[$i]['isLast'];
			}
		}else{
				$node[0]['id']=0;
				$node[0]['upperCat']='';
				$node[0]['category']='.';
				$node[0]['text']='全部';
				$node[0]['state']='open';
				
				for($i=0;$i<count($arr);$i++){
			
				//$node[$i+1]['id']=$arr[$i]['upperCat'].$arr[$i]['id'];
				$node[$i+1]['id']=$arr[$i]['id'];
				$node[$i+1]['category']=$arr[$i]['category'];
				$node[$i+1]['text']=$arr[$i]['catName'];
				$node[$i+1]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i+1]['upperCat']=$arr[$i]['upperCat'];
				$node[$i+1]['isLast']=$arr[$i]['isLast'];
			}				
		}	
		//print_r($node);return;
		echo json_encode($node);
			
	}

}
?>