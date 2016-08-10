<?php
/**
author:Gao Xue
date:2014-04-30
Modified by Ma Jun Wei 2014/09/05
Modified by Gao Xue 2015/04/08
*/

class ADMININFO{
	
	function queryAdmin($isDel,$page,$rows,$upCatory,$usr,$isForbidden){
		$page=($page-1)*$rows;
		$sql='select * from admininfo where isDel='.$isDel.' and id!=1';
		$sqlCount='select count(id) as "count" from admininfo where isDel='.$isDel.' and id!=1';
		if($_SESSION['admin_id']!=1){
			$priviledgesArr=explode(',',$_SESSION['priviledges']);
			$admin_arr=explode('_',$priviledgesArr[2]);
			if($admin_arr[1]>0){
				$str='"%.'.$admin_arr[1].'.%"';
				$sql=$sql.' and category like '.$str;
				$sqlCount=$sqlCount.' and category like '.$str;
			}
		}
		if($upCatory!==''&&$upCatory!==null){
			$str='"%'.$upCatory.'%"';
			$sql=$sql.' and category like '.$str;
			$sqlCount=$sqlCount.' and category like '.$str;
		}
		if($usr!==''&&$usr!==null){
			$str='"%'.$usr.'%"';
			$sql=$sql.' and usr like '.$str;
			$sqlCount=$sqlCount.' and usr like '.$str;
		}
		if($isForbidden!==''&&$isForbidden!==null){
			$sql=$sql.' and isForbidden = '.$isForbidden;
			$sqlCount=$sqlCount.' and isForbidden = '.$isForbidden;
		}
		$db=new DB();
		$count=$db->select($sqlCount);
		$count=$count[0][count];
		$sql =$sql.' limit '.$page.','.$rows;
		$result=$db->select($sql);

		if(sizeof($result)>0){
			for($i=0;$i<count($result);$i++){
				
				$pri=$result[$i]['userPrivileges'];				
				if(strpos($pri,',')>0){
					//把所管分类屏蔽掉
					if(strpos($pri,'concats_')>-1){
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
					if(strpos($pri,'remakes_red')>0){
						$pri=str_replace('remakes_red','重新制作红头文件',$pri);	
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
					/*
					if(strpos($pri,'smslistinfo_disable')>0){
						$pri=str_replace('smslistinfo_disable','禁用通讯录分类',$pri);	
					}
					if(strpos($pri,'smslistinfo_enable')>0){
						$pri=str_replace('smslistinfo_enable','启用通讯录分组',$pri);	
					}
					*/
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
						$pri=str_replace('admincat_query','查看用户分组信息',$pri);	
					}
					if(strpos($pri,'admincat_add')>0){
						$pri=str_replace('admincat_add','添加用户分组',$pri);	
					}
					if(strpos($pri,'admincat_edit')>0){
						$pri=str_replace('admincat_edit','修改用户分组',$pri);	
					}
					if(strpos($pri,'admincat_del')>0){
						$pri=str_replace('admincat_del','删除用户分组',$pri);	
					}
					if(strpos($pri,'admincat_disable')>0){
						$pri=str_replace('admincat_disable','禁用用户分组',$pri);	
					}
					if(strpos($pri,'admincat_enable')>0){
						$pri=str_replace('admincat_enable','启用用户分组',$pri);	
					}
					if(strpos($pri,'admininfo_query')>0){
						$pri=str_replace('admininfo_query','查看用户信息',$pri);	
					}
					if(strpos($pri,'admininfo_add')>0){
						$pri=str_replace('admininfo_add','添加用户',$pri);	
					}
					if(strpos($pri,'admininfo_edit')>0){
						$pri=str_replace('admininfo_edit','修改用户',$pri);	
					}
					if(strpos($pri,'admininfo_del')>0){
						$pri=str_replace('admininfo_del','删除用户',$pri);	
					}
					if(strpos($pri,'admininfo_disable')>0){
						$pri=str_replace('admininfo_disable','禁用用户',$pri);	
					}
					if(strpos($pri,'admininfo_enable')>0){
						$pri=str_replace('admininfo_enable','启用用户',$pri);	
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
				$adminArr[$i]=array('id'=>$result[$i]['id'],'realname'=>$result[$i]['realname'],'usr'=>$result[$i]['usr'],'phone'=>$result[$i]['phone'],
									 'email'=>$result[$i]['email'],'qq'=>$result[$i]['qq'],'isForbidden'=>$result[$i]['isForbidden'],
									 'addedDate'=>$result[$i]['addedDate'],'userPrivileges'=>$pri);
			}
			$adminJSON='{"total":'.$count.',"rows":'.json_encode($adminArr).'}';
		}else{
			$adminJSON='{"total":0,"rows":[]}';
		}
		echo $adminJSON;
		
		$db->Close();
	}
	
	
	function saveAdmin($admininfo,$upperID){
		$name=$admininfo['usr']; 
		$db=new DB();
		$sql="select count(id) from admininfo where usr='$name'";
		$sql_cat="select userPrivileges from admincat where id=$upperID";
		$cat_arr=$db->Select($sql_cat);
		$privilegesArr=explode(',',$admininfo['userPrivileges']);
		$adminPriArr=explode(',',$cat_arr[0]['userPrivileges']);
		$admincat_str=$cat_arr[0]['userPrivileges'];
		for($i=1;$i<count($privilegesArr);$i++){
			if($i<3){
				$change = array($adminPriArr[$i]=>$privilegesArr[$i]);
				$admincat_str=strtr($admincat_str,$change);
			}else{
				if(strpos($admincat_str, $privilegesArr[$i])===false){
					if($privilegesArr[$i]!='file_self'){
						$admincat_str.=','.$privilegesArr[$i];
					}
				}
			}
		}
		$admincat['userPrivileges']=$admincat_str;
		$all=$db->Select($sql);
		if($all[0][0]>0){
			$result='notnull';	
		}else{
			$result=$db->InsertData('admininfo',$admininfo);
			$db->UpdateData('admincat',$upperID,$admincat);
			if($admininfo['isManager']!='1'){
				$sql_info="select id,userPrivileges from admininfo where isManager=1 and category like '%.$upperID.'";
				$pri_arr=$db->Select($sql_info);
				$catPriArr=explode(',',$admincat_str);
				for($i=0;$i<count($pri_arr);$i++){
					$admininfos['userPrivileges']='';
					$managetPriArr=explode(',',$pri_arr[$i]['userPrivileges']);
					$admininfo_str=$pri_arr[$i]['userPrivileges'];
					for($j=3;$j<count($catPriArr);$j++){
						if(strpos($admininfo_str, $catPriArr[$j])===false){
							$admininfo_str.=','.$catPriArr[$j];
						}
					}
					$admininfos['userPrivileges']=$admininfo_str;
					$db->UpdateData('admininfo',$pri_arr[$i]['id'],$admininfos);
				}
			}
		}
		echo $result;
		$db->Close();
	}
	
	function getPri($id,$newEdit){
		$db=new DB();
		$result=$db->GetInfo($id,'admincat');
		$labinfoJSON=array('userPrivileges'=>$result['userPrivileges']);
		if(!empty($result['userPrivileges'])){
			$arr=explode(',',$result['userPrivileges']);
			$r='';
			if(count($arr)>0){
				for($j=0;$j<count($arr);$j++){
					if(strpos($arr[$j],'concats_')>-1){
						$labinfoJSON['concats_role']=str_replace('concats_','',$arr[$j]);
					}else if(strpos($arr[$j],'admincats_')>-1){
						$labinfoJSON['admincats_role']=str_replace('admincats_','',$arr[$j]);
					}else{
						$labinfoJSON[$arr[$j].$newEdit]=$arr[$j];
					}
				}
			}
		}
		echo json_encode($labinfoJSON);
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
		
		
return;


		$db=new DB();
		$result[0]=$db->GetInfo($id,'admininfo');
		if($result[0]['category']!=='.'){
			$upidArr=explode('.',$result[0]['category']);
			$upperID=intval($upidArr[sizeof($upidArr)-2]);
		}else{
			$upperID=0;
		}
		$labinfoJSON=array('id'=>$result[0]['id'],'usr'=>$result[0]['usr'],'ntid'=>$result[0]['ntid'],'seed'=>$result[0]['seed'],'phone'=>$result[0]['phone'],'email'=>$result[0]['email'],'qq'=>$result[0]['qq'],'isForbidden'=>$result[0]['isForbidden'],'pwd'=>$result[0]['pwd'],'upperID'=>$upperID,'addedDate'=>$result[0]['addedDate'],'lastIP'=>$result[0]['lastIP'],'category'=>$result[0]['category']);
		echo json_encode($labinfoJSON);
		$db->Close();
	}
	
	function updateAdmin($id,$upAdmin,$upper_id){
		$db=new DB();
		$db->UpdateData('admininfo',$id,$upAdmin);
		//$sql_cat="select userPrivileges from admincat where id=$upper_id";
		$sql_cat="SELECT userPrivileges FROM admininfo WHERE category LIKE '%.$upper_id.' and isManager!=1";
		$cat_arr=$db->Select($sql_cat);
		$concats=mb_substr($upAdmin['category'], 0, mb_strlen($upAdmin['category'],'utf8')-1, 'utf-8');
		$admincat_str='priviliges,concats_'.$concats.',admincats_';
		//$admincat_str='priviliges,concats_.'.$upper_id.',admincats_';
		for($i=0;$i<count($cat_arr);$i++){
			$privilegesArr=explode(',',$cat_arr[$i]['userPrivileges']);
			for($j=3;$j<count($privilegesArr);$j++){
				if(strpos($admincat_str, $privilegesArr[$j])===false){
					if($privilegesArr[$j]!='file_self'){
						$admincat_str.=','.$privilegesArr[$j];
					}
					//$admincat_str.=','.$privilegesArr[$j];
				}
			}
		}
		$admincat['userPrivileges']=$admincat_str;
		/*
		$privilegesArr=explode(',',$upAdmin['userPrivileges']);
		$adminPriArr=explode(',',$cat_arr[0]['userPrivileges']);
		$admincat_str=$cat_arr[0]['userPrivileges'];
		for($i=1;$i<count($privilegesArr);$i++){
			if($i<3){
				$change = array($adminPriArr[$i]=>$privilegesArr[$i]);
				$admincat_str=strtr($admincat_str,$change);
			}else{
				if(strpos($admincat_str, $privilegesArr[$i])===false){
					$admincat_str.=','.$privilegesArr[$i];
				}
			}
		}
		$admincat['userPrivileges']=$admincat_str;
		*/
		$db->UpdateData('admincat',$upper_id,$admincat);

		if($upAdmin['isManager']!='1'){
			$sql_info="select id,userPrivileges from admininfo where isManager=1 and category like '%.$upper_id.'";
			$pri_arr=$db->Select($sql_info);
			$catPriArr=explode(',',$admincat_str);
			for($i=0;$i<count($pri_arr);$i++){
				$admininfos['userPrivileges']='';
				$managetPriArr=explode(',',$pri_arr[$i]['userPrivileges']);
				$admininfo_str=$pri_arr[$i]['userPrivileges'];
				for($j=3;$j<count($catPriArr);$j++){
					if(strpos($admininfo_str, $catPriArr[$j])===false){
						$admininfo_str.=','.$catPriArr[$j];
					}
				}
				$admininfos['userPrivileges']=$admininfo_str;
				$db->UpdateData('admininfo',$pri_arr[$i]['id'],$admininfos);
			}
		}

		$db->Close();
	}
	
	/**function updateAdmin($id,$upAdmin){
		//echo $upAdmin['category'].'    '.$upAdmin['usr'].'    '.$upAdmin['phone'].'    '.$upAdmin['email'].'    '.$upAdmin['qq'].'    '.$upAdmin['isForbidden'];
		$sql='update admininfo set category="'.$upAdmin['category'].'" ,usr="'.$upAdmin['usr'].'" ,phone="'.$upAdmin['phone'].'" ,email="'.$upAdmin['email'].'" ,qq="'.$upAdmin['qq'].'" ,isForbidden='.$upAdmin['isForbidden'].' where id='.$id;
		//echo $sql;
		$db=new DB();
		$db->Update($sql);
		$db->Close();
	}*/

//删除数据
	function delAdmin($id){
		$db=new DB();
		$sql_edit="update admininfo set isDel=1 where id=$id";
		$db->Update($sql_edit);
		$db->Close();
	}
	
	function delArrAdmin($arrId){
		$idarray=explode(',',$arrId);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql_edit='update admininfo set isDel=1 where id='.$idarray[$i];
			$db->Update($sql_edit);
		}	
		$db->Close();
	}

//物理删除	
	function delAdmin_($id){
		$db=new DB();
		$db->DelData($id,'admininfo');
		$db->Close();
	}
	
	function delArrAdmin_($arrId){
		$db=new DB();
		$db->DelArrIdData($arrId,'admininfo');
		$db->Close();
	}
	
	function disableAdmin($list,$flag){
		$idarray=explode(',',$list);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql_edit='update admininfo set isForbidden='.$flag.' where id='.$idarray[$i];
			$db->Update($sql_edit);
		}	
		$db->Close();
	}
	
	//恢复删除的数据
	function uptisDel($id){
		$db=new DB();	
		$admininfoArr['isDel']=0;
		$db->UpdateData('admininfo',$id,$admininfoArr);
		$db->Close();	
	}	
	
	//批量恢复删除的数据
	function uptisDelList($idlist){
		//global $idlist;全局参数改为传参形式
		$idarray=explode(',',$idlist);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$admininfoArr['isDel']=0;
			$db->UpdateData('admininfo',$idarray[$i],$admininfoArr);
		}
		$db->Close();
		echo $idlist;
	}
	
	
	// modify:heyangyang
	function getIP(){
		if(getenv('HTTP_CLIENT_IP')){
			$onlineip = getenv('HTTP_CLIENT_IP');
		}
		elseif(getenv('HTTP_X_FORWARDED_FOR')){
			$onlineip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif(getenv('REMOTE_ADDR')){
			$onlineip = getenv('REMOTE_ADDR');
		}
		else{
			$onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
		}
		return $onlineip;
	}
	//获取他人用户信息(排除自己和super)
	function getOthers(){
		$sql="select * from admininfo where isDel=0 and id !=1 and id != ".$_SESSION['admin_id'];
		$db=new DB();
		$arr=$db->Select($sql);
		$db->Close();
		$result=array();
		for($i=0;$i<count($arr);$i++){
			$reslut[$i]=array(
				'id'=>$arr[$i]['id'],
				'usr'=>$arr[$i]['usr'],
				'realname'=>$arr[$i]['realname']
			);
		}
		echo json_encode($reslut);
	}
	//获取可导入通讯录的人员列表
	function getOthersList(){
		$db=new DB();
		if($_SESSION['admin_name']=='super'){
			$sql="SELECT * from admininfo where usr!='super' and isDel=0 and isForbidden=0";
			$res=$db->Select($sql);
			for($i=0;$i<count($res)-1;$i++){
				$result[$i]=array(
					'id'=>$res[$i]['id'],
					'usr'=>$res[$i]['usr'],
					'realname'=>$res[$i]['realname'],
					'listID'=>'0'
				);
			}
		}else{
			$sql="SELECT ids FROM admininfo WHERE id=".$_SESSION['admin_id'];
		//$sql="SELECT a.usr,a.id,a.realname FROM admininfo a ,smslistinfo b WHERE a.id=b.admin_id AND b.ids LIKE '%,".$_SESSION['admin_id'].",%' group by id";	//2015-05-16
		//$sql="SELECT a.usr,a.id,a.realname FROM admininfo a,smslistinfo b WHERE a.id=b.admin_id AND b.ids LIKE '%,38,%' group by id";	//2015-05-16以前
			$res=$db->Select($sql);
			$arr=explode("-",$res[0]['ids']);
			$result=array();
			for($i=0;$i<count($arr)-1;$i++){
				$idArr=explode(":",$arr[$i]);
				$id=$idArr[0];
				$sql1="select id,usr,realname from admininfo where id=".$idArr[0];
				$rest=$db->Select($sql1);
				$result[$i]=array(
					'id'=>$rest[0]['id'],
					'usr'=>$rest[0]['usr'],
					'realname'=>$rest[0]['realname'],
					'listID'=>$idArr[1]
				);
			}
		}
		$db->Close();
		echo json_encode($result);
	}
}
?>