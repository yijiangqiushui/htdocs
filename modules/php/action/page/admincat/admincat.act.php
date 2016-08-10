<?php
/**
*author:贺央央
*Modified by Gao Xue  2014/04/30  function treeData
*Modified by Gao Xue  2014/05/23
*Modified by Ma Jun Wei  2014/11/03
**/
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';



/*include '../../../config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';*/

$action=$_GET['action'];
$up_id=$_GET['up_id'];
$upid=$_POST['upid'];

$page=$_POST['page'];
$rows=$_POST['rows'];
$idlist=$_GET['idlist'];
$flag=intval($_GET['flag']);
$id=intval($_GET['id']);

$role['upperID']=intval($_POST['upperID']);
$role['catName']=$_POST['catName'];
$role['userPrivileges']=$_POST['userPrivileges'];
$role['isForbidden']=$_POST['isForbidden'];
$role['lab_school']=intval($_POST['lab_school']);

switch($action){

	case 'treeData':
		treeData();
		break;
	case 'show':
		show();
		break;
	case 'add':
		add($role);
		break;
	case 'findbyid':
		findbyid($id);
		break;
	case 'delEle':
		delEle($id);
		break;
	case 'delByIdList':
		delByIdList();
		break;
	case 'saveEdtEle':
		saveEdtEle($id,$role);
		break;
	case 'disableEle':
		disableEle();
		break;
	case 'content_tree':
		content_tree($_GET['up_id'],$_GET['table_name']);
		break;
	default:;
	
}

function saveEdtEle($id,$role){
	
	$db=new DB();
	
	
	$sql='select * from admincat where id='.$id;
	
	$res=$db->Select($sql);
	if($res[0]['upperID']==$role['upperID']){
		//节点位置没改变
		$sql_edt1='update admincat set catName="'.$role['catName'].'",userPrivileges="'.$role['userPrivileges'].'" where id='.$id;	
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
		$sql_edt1='update admincat set catName="'.$role['catName'].'",userPrivileges="'.$role['userPrivileges'].'",upperCat="'.$role['upperCat'].'",upperID='.$role['upperID'].' where id='.$id;	
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
		setleaf($db,$res[0]['upperID']);	
		setleaf($db,$role['upperID']);			
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
	
	if($cat['userPrivileges']!=''||$cat['userPrivileges']!=null){
		$arr=explode(',',$cat['userPrivileges']);
		$r='';
		if(count($arr)>0){
			for($j=0;$j<count($arr);$j++){
				 if(strpos($arr[$j],'concat_')>-1){
						$r==''?$r='concat_expert'.':"'.str_replace('concat_','',$arr[$j]).'"':$r=$r.', concat_expert'.':"'.str_replace('concat_','',$arr[$j]).'"';
					}else{
						$r==''?$r=$arr[$j].':"'.$arr[$j].'"':$r=$r.','.$arr[$j].':"'.$arr[$j].'"';
					}
				/**if($r==''||$r==null){
					$r=$arr[$j].':"'.$arr[$j].'"';
				}else{
					$r=$r.','.$arr[$j].':"'.$arr[$j].'"';
				}*/
			}
		}
	}
	$r1=$r==''?'':','.$r;
	$json='{id:'.$cat['id'].',catName:"'.$cat['catName'].'",upperCat:"'.$cat['upperCat'].'",upperID:'.$cat['upperID'].',isForbidden:'.$cat['isForbidden'].',userPrivileges:"'.$cat['userPrivileges'].'",isLast:'.$cat['isLast'].$r1.'}';

	echo $json;
	
	$db->Close();	
}

/**
*树形结构数据
**/
function treeData(){
	
	global $up_id;
	$up_id = isset($up_id) ? intval($up_id) : 0;
	$sql='select * from admincat where upperID ='.$up_id;
	$db=new DB();
	
	$arr=$db->Select($sql);
	if($up_id!==0){
		for($i=0;$i<count($arr);$i++)
		{
			$node[$i]['id']=$arr[$i]['id'];
			$node[$i]['text']=$arr[$i]['catName'];
			$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
			$node[$i]['upperCat']=$arr[$i]['upperCat'];
			$node[$i]['isLast']=$arr[$i]['isLast'];
		}
	}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			
			for($i=0;$i<count($arr);$i++)
			{
			$node[$i+1]['id']=$arr[$i]['id'];
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
function show(){
	global $role;	
	global $upid;
	global $page;
	global $rows;
	
	$page=($page-1)*$rows;
	$upid = isset($upid) ? intval($upid) : 0;

	$sql='select * from admincat where upperID = '.$upid;
	$sql_cou='select count(id) as "count" from admincat where upperID = '.$upid;	
	
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
	
	$sql=$sql.' limit '.$page.','.$rows;
	
	$db=new DB();	
	$arr=$db->Select($sql);
	$arr_cou=$db->Select($sql_cou);
	$count=$arr_cou[0]['count'];
	$db->Close();
	
	if(count($arr)===0){
		$json='{"total":0,"rows":[]}';	
	}else{
		for($i=0;$i<count($arr);$i++){
			
			$pri=$arr[$i]['userPrivileges'];
			
			if(strpos($pri,',')>0){
				
				if(strpos($pri,'concat_')>-1){
					$pri=substr($pri,strpos($pri,',')+1);
				}
				if(strpos($pri,',')===false){
					$pri=substr($pri,0,strpos($pri,','));
				}
				
				if(strpos($pri,'Recunit_query')>0){
					$pri=str_replace('Recunit_query','查看推荐单位信息',$pri);	
				}
				
				if(strpos($pri,'Recunit_add')>0){
					$pri=str_replace('Recunit_add','添加推荐单位信息',$pri);	
				}
				
				if(strpos($pri,'Recunit_del')>0){
					$pri=str_replace('Recunit_del','删除推荐单位信息',$pri);	
				}
				if(strpos($pri,'Recunit_edit')>0){
					$pri=str_replace('Recunit_edit','修改推荐单位信息',$pri);	
				}
				
				
				if(strpos($pri,'Orgunit_query')>0){
					$pri=str_replace('Orgunit_query','查看申报单位信息',$pri);	
				}
				if(strpos($pri,'Orgunit_del')>0){
					$pri=str_replace('Orgunit_del','删除申报单位信息',$pri);	
				}
				if(strpos($pri,'Orgunit_edit')>0){
					$pri=str_replace('Orgunit_edit','修改申报单位信息',$pri);	
				}
				
				if(strpos($pri,'fruitsCat_query')>0){
					$pri=str_replace('fruitsCat_query','查看申报分类',$pri);	
				}
				if(strpos($pri,'fruitsCat_add')>0){
					$pri=str_replace('fruitsCat_add','添加申报分类',$pri);	
				}
				if(strpos($pri,'fruitsCat_del')>0){
					$pri=str_replace('fruitsCat_del','删除申报分类',$pri);	
				}
				if(strpos($pri,'fruitsCat_edit')>0){
					$pri=str_replace('fruitsCat_edit','修改申报分类',$pri);	
				}
				
				
				if(strpos($pri,'fruits_query')>0){
					$pri=str_replace('fruits_query','查看申报成果',$pri);	
				}
				if(strpos($pri,'fruits_score')>0){
					$pri=str_replace('fruits_score','评分',$pri);	
				}
				if(strpos($pri,'score0')>0){
					$pri=str_replace('score0','评分表1',$pri);	
				}
				if(strpos($pri,'score1')>0){
					$pri=str_replace('score1','评分表2',$pri);	
				}
				if(strpos($pri,'fruitsStore_query')>0){
					$pri=str_replace('fruitsStore_query','查看评分',$pri);	
				}
				if(strpos($pri,'fruits_check')>0){
					$pri=str_replace('fruits_check','项目审核',$pri);	
				}
				if(strpos($pri,'fruits_RecAdvice')>0){
					$pri=str_replace('fruits_RecAdvice','推荐单位意见',$pri);	
				}
				
				
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
				
				if(strpos($pri,'loginfo_query')>0){
					$pri=str_replace('loginfo_query','查看日志信息',$pri);	
				}
				if(strpos($pri,'data_backup')>0){
					$pri=str_replace('data_backup','备份数据',$pri);	
				}
				if(strpos($pri,'data_restore')>0){
					$pri=str_replace('data_restore','恢复数据',$pri);	
				}
				$pri=substr($pri,strpos($pri,',')+1);
				
			}else{
				$pri='';	
			}
			
		
				
			$arr2[$i]=array('id'=>$arr[$i]['id'],'catName'=>$arr[$i]['catName'],'upperCat'=>$arr[$i]['upperCat'],'upperID'=>$arr[$i]['upperID'],'isForbidden'=>$arr[$i]['isForbidden']?'禁用':'可用','userPrivileges'=>$pri,'isLast'=>$arr[$i]['isLast']?'是':'否');		
		}
			
		$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
	
	}
	
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

//删除
function delEle($id){

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
	
	setleaf($db,$upid);

	$db->Close();	
}

//批量删除
function delByIdList(){
	global $idlist;
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
		
		setleaf($db,$upid);

	}
	
	$db->Close();
	
	echo $idlist;
	
}

//禁用操作
function disableEle(){
	global $idlist;
	global $flag;
	$idarray=explode(',',$idlist);
	
	$db=new DB();
	
	for($i=0;$i<count($idarray);$i++){

		$sql_edit='update admincat set isForbidden='.$flag.' where id='.$idarray[$i];
		$db->Update($sql_edit);	
	
	}	
	
	$db->Close();	
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
		$sql="select * from ".$table_name." where upper_id =".$up_id;
		$db=new DB();
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
//				$node[$i]['id']=$arr[$i]['id'];
				$node[$i]['id']=$arr[$i]['upper_cat'].$arr[$i]['id'];
				$node[$i]['text']=$arr[$i]['cat_name'];
				$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
				$node[$i]['catname_all']=$arr[$i]['catname_all'];
			}
		}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			$node[0]['upper_cat']='.';
			
			for($i=0;$i<count($arr);$i++){
				//$node[$i+1]['id']=$arr[$i]['id'];
				$node[$i+1]['id']=$arr[$i]['upper_cat'].$arr[$i]['id'];
				$node[$i+1]['text']=$arr[$i]['cat_name'];
				$node[$i+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i+1]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i+1]['is_leaf']=$arr[$i]['is_leaf'];
				$node[$i+1]['catname_all']=$arr[$i]['catname_all'];
			}				
		}	
		echo json_encode($node);
	}	


?>