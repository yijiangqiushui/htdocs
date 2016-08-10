<?php
include '../../../../../common/php/config.ini.php';
include '../../../config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/recommend/recommend.cls.php';



$action=$_GET['action'];

$id=$_GET['id'];
$idlist=$_GET['idlist'];
$cid=intval($_GET['commid']);

$page=$_POST['page'];
$rows=$_POST['rows'];

$comm['name']=$_POST['name'];
$comm['address']=$_POST['address'];
$comm['tel']=$_POST['tel'];
$comm['email']=$_POST['email'];
$comm['type']=$_POST['type'];
$comm['phone']=$_POST['phone'];
$comm['fax']=$_POST['fax'];
$comm['linkman']=$_POST['linkman'];
$comm['postcode']=$_POST['postcode'];

$commAct=new CommAct();

switch($action){
	case 'add':  //添加推荐单位信息
		addCommend($comm);
		break;
	case 'query'://查询推荐单位信息
		queryCommend($comm);
		break;
	case 'update';//修改推荐单位信息
		updateCommend($comm,$id);
		break;
	case 'delete';//删除推荐单位信息
		deleteCommend($id,$commAct);
		break;
	case 'deletelist';//批量删除推荐单位信息
		deleteCommendList();
		break;
	case 'findbyid';//根据id查询推荐单位信息
		findById($id);
		break;
}
//-----------------------------------------------------------------推荐单位信息-----------------------------------------------------------------
function findById($id){
	global $commAct;	
	$comm=$commAct->findById('recommend_org',$id);	
	$res=$commAct->toJson2($comm);	
	echo $res;
}

function queryCommend($comm){

	global $page;
	global $rows;	
	global $commAct;	
	if(($comm['name']===null||$comm['name']==='')&&($comm['type']===null||$comm['type']==='')){
		//分页查询
		$count=$commAct->getCount('recommend_org');
		$commArr=$commAct->pageList('recommend_org',$page,$rows,$count);
		$commJson=$commAct->toJson($commArr,$count);
	}else{
		//条件查询
		$sql='select * from recommend_org where 1=1';
		$sql_cou='select count(id) as "count" from recommend_org where 1=1';	
	
		if($comm['name']!==null&&$comm['name']!==''){
			$str='"%'.$comm['name'].'%"';
			$sql=$sql.' and name like '.$str;
			$sql_cou=$sql_cou.' and name like '.$str;
		}
	
		/*if($comm['address']!==null&&$comm['address']!==''){
			$str2='"%'.$comm['address'].'%"';
			$sql=$sql.' and address like '.$str2;
			$sql_cou=$sql_cou.' and address like '.$str2;
		}*/
		if($comm['type']!==null&&$comm['type']!==''){
			$str3='"%'.$comm['type'].'%"';
			$sql=$sql.' and type like '.$str3;
			$sql_cou=$sql_cou.' and type like '.$str3;
		}
		
		//echo $sql;
		
		$count=$commAct->getCountByCon($sql_cou);
		$commArr=$commAct->pageListByCon($page,$rows,$count,$sql);
		$commJson=$commAct->toJson($commArr,$count);
	}
	echo $commJson;
}
//增加
function addCommend($comm){
	global $commAct;			
	$commAct->addInfo('recommend_org',$comm);
}
//单条删除
function deleteCommend($id,$commAct){
	$commAct->delInfo('recommend_org',$id);
	
	
}
//批量删除
function deleteCommendList(){
	global $commAct;
	global $idlist;
	$idarray=explode(',',$idlist);
	for($i=0;$i<count($idarray);$i++){
		deleteCommend($idarray[$i],$commAct);
			$commAct->delInfo('recommend_org',$idarray[$i]);	
		}	
}
//修改
function updateCommend($comm,$id){
	global $commAct;	
	$commAct->editInfo('recommend_org',$comm,$id);
	
}

?>