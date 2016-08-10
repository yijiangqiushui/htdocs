<?php
/**
author:Gao Xue
date:2014-05-07
*/
class CONTENTINFO{
	
	function infoGrid(){
		global $upper_cat;
		global $page;
		global $rows;
		global $title;
		global $tags;
		global $content;
		
		$page=($page-1)*$rows;
		$upper_cat = isset($upper_cat) ? $upper_cat : '.';
		$sql='select * from contentinfo where category like "%'.$upper_cat.'%"';
		$sqlCount='select count(id) as "count" from contentinfo where category like "%'.$upper_cat.'%"';
		
		
		if($title!==null&&$title!==''){
			$str='"%'.$title.'%"';
			$sql=$sql.' and title like '.$str;
			$sqlCount=$sqlCount.' and title like '.$str;
		}
		if($tags!==null&&$tags!==''){
			$str='"%'.$tags.'%"';
			$sql=$sql.' and tags like '.$str;
			$sqlCount=$sqlCount.' and tags like '.$str;
		}
		if($content!==null&&$content!==''){
			$str='"%'.$content.'%"';
			$sql=$sql.' and content like '.$str;
			$sqlCount=$sqlCount.' and content like '.$str;
		}
		
		$sql=$sql.' order by id desc limit '.$page.','.$rows;
		$db=new DB();
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sqlCount);
		$count=$arr_cou[0]['count'];
		
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],'cat_id'=>$arr[$i]['cat_id'],'category'=>$arr[$i]['category'],'title'=>$arr[$i]['title'],'tags'=>$arr[$i]['tags'],'brief_ctnt'=>$arr[$i]['brief_ctnt'],'add_time'=>$arr[$i]['add_time'],'brief_title'=>$arr[$i]['brief_title'],'is_checked'=>$arr[$i]['is_checked'],'is_forbidden'=>$arr[$i]['is_forbidden'],'is_recommended'=>$arr[$i]['is_recommended']);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();
	}
	
	function saveInfo(){
		global $conInfo;
		
		if(!($_FILES['file']['error'])){
			$time=time();
			$y=date('Y',$time);
			$m=date('m',$time);
			$d=date('d',$time);
			
			$rootpath=SP_BASEPATH;
			$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';

			$vars=array(
				'file'=>'file',
				'limit_size'=>50*1024*1024,
				'savepath'=>$savepath,
				'rootpath'=>$rootpath,
				'allowed_ext'=>''
			);
			$file=new FILE($vars);
			$conInfo['thumbnail']=$file->get_savepath().$file->get_auto_filename();
		}
		$db=new DB();
		$result=$db->InsertData('contentinfo',$conInfo);
		echo $result;
		$db->Close();
	}
	
	function getAttach(){
		global $id;
		$db=new DB();
		$contentInfo=$db->GetInfo($id,'contentinfo');
		
		$json='{id:'.$contentInfo['id'].',catId:'.$contentInfo['cat_id'].',category:"'.$contentInfo['category'].'",title:"'.$contentInfo['title'].'",tags:"'.$contentInfo['tags'].'",brief_ctnt:"'.$contentInfo['brief_ctnt'].'",content:\''.$this->htmlstr_process($contentInfo['content']).'\',brief_title:"'.$contentInfo['brief_title'].'",info_source:"'.$contentInfo['source'].'"}';
		echo $json;
		$db->Close();
	}
	
	function htmlstr_process($str){
		$returnstr=$str;
		$returnstr=str_replace("'","\'",$returnstr);
		$returnstr=str_replace("\r\n","",$returnstr);
		$returnstr=str_replace("\r","",$returnstr);
		$returnstr=str_replace("\n","<br />",$returnstr);
		
		return $returnstr;
	}
	
	/*-----------------------------------------------------------------------------------------------*/
	function getPath($id,$db){
		$contentInfo=$db->GetInfo($id,'contentinfo');
		return $contentInfo['thumbnail'];
	}
	
	function updInfo(){
		global $id;
		global $conInfo;
		$db=new DB();
		
		if($_FILES['file']['error']==0){
			$oldPath=SP_BASEPATH.$this->getPath($id,$db);
			$time=time();
			$y=date('Y',$time);
			$m=date('m',$time);
			$d=date('d',$time);
			
			$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';//获取新文件存储路径		
		
			$vars=array(
				'file'=>'file',
				'limit_size'=>50*1024*1024,
				'savepath'=>$savepath,
				'rootpath'=>SP_BASEPATH,
				'old_file'=>$oldPath,
				'allowed_ext'=>''
			);
			
			$file=new FILE($vars);
			$conInfo['thumbnail']=$file->get_savepath().$file->get_auto_filename();
			$conInfo['edit_time']=date("Y-m-d H:i:s");
		}
		$db->UpdateData('contentinfo',$id,$conInfo);
		$db->Close();
	}
	
	/*-----------------------------------------------------------------------------------------------*/
	
	function delInfo(){
		global $id;
		$db=new DB();
		$file=new FILE();
		$path=SP_BASEPATH.$this->getPath($id,$db);
		$result=$db->DelData($id,'contentinfo');
		if($result=='1'){
			$file->del_file($path);//删除附件
			$attachArr=$this->getAllById('attachment','content_id',$id,$db);
			for($i=0;$i<count($attachArr);$i++){
				
				$attach=$db->GetInfo($attachArr[$i]['id'],'attachment');
				$file_path=SP_BASEPATH.$attach['file_path'];
				
				$result1=$db->DelData(intval($attachArr[$i]['id']),'attachment');
				if($result1=='1'){
					$file->del_file($file_path);//删除附件
				}
			}
		}
		$db->close();
	}
	
	function delArrInfo(){
		global $arrId;
		$db=new DB();
		$db->DelArrIdData($arrId,'contentinfo');
		$db->close();
	}
	
	
	function getAllById($name,$column,$id,$db){
		$sql="select * from ".$name." where ".$column." = ".$id;
		$arr=$db->Select($sql);
		return $arr;
	}
	
	function load(){
		$db=new DB();
		global $id;
		global $attach;
		$attach['content_id']=$id;
		
		if(!($_FILES['file1']['error'])){
			$time=time();
			$y=date('Y',$time);
			$m=date('m',$time);
			$d=date('d',$time);
			
			//$rootpath=SP_BASEPATH;
			$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';
			$vars=array(
				'file'=>'file1',
				'limit_size'=>50*1024*1024,
				'savepath'=>$savepath,
				'rootpath'=>SP_BASEPATH,
				'allowed_ext'=>''
			);
			$file=new FILE($vars);
			$attach['file_path']=$file->get_savepath().$file->get_auto_filename();
			$attach['file_ext']='.jpg';
			$attach['file_size']='100';
			
			$result=$db->InsertData('attachment',$attach);
			echo $result;
		}else{
			echo 'error';
		}
		$db->Close();
	}
	
	function attachGrid(){
		global $id;
		global $page;
		global $rows;
		
		$page=($page-1)*$rows;
		
		$sql='select * from attachment where content_id='.$id.' order by id desc ';
		$sqlCount='select count(id) as "count" from attachment where content_id='.$id.' order by id desc ';
		
		$sql=$sql.' limit '.$page.','.$rows;
		$db=new DB();
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sqlCount);
		$count=$arr_cou[0]['count'];
		
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],'file_path'=>$arr[$i]['file_path'],'file_ext'=>$arr[$i]['file_ext'],'file_size'=>$arr[$i]['file_size'],	'brief_ctnt'=>$arr[$i]['brief_ctnt']);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();
	}
	
	function delAttach($id){
		//global $id;
		$db=new DB();
		$file=new FILE();
		$attachment=$db->GetInfo($id,'attachment');
		$file_path=SP_BASEPATH.$attachment['file_path'];
		$result=$db->DelData($id,'attachment');
		if($result=='1'){
			$file->del_file($file_path);//删除附件
		}
	}
	
	function delArrAttach(){
		global $arrId;
		$db=new DB();
		$db->DelArrIdData($arrId,'attachment');
		$db->close();
	}

}
?>