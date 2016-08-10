<?php
/**
author:Gao Xue
date:2014-05-07
Modified by Zhao Xiaogang 2014/09/09 delArrInfo($arrId)
*/
class CONTENTINFO{
	
	/**
	功能：加载表结构
	*/
	function infoGrid($upper_cat,$page,$rows,$title,$add_time){
		
		$page=($page-1)*$rows;
		$upper_cat = isset($upper_cat) ? $upper_cat : '.';
		$sql='select * from contentinfo where category like "'.$upper_cat.'%"';
		$sqlCount='select count(id) as "count" from contentinfo where category like "'.$upper_cat.'%"';
		
		if($title!==null&&$title!==''){
			$str='"%'.$title.'%"';
			$sql=$sql.' and title like '.$str;
			$sqlCount=$sqlCount.' and title like '.$str;
		}
		/*if($tags!==null&&$tags!==''){
			$str='"%'.$tags.'%"';
			$sql=$sql.' and tags like '.$str;
			$sqlCount=$sqlCount.' and tags like '.$str;
		}
		if($content!==null&&$content!==''){
			$str='"%'.$content.'%"';
			$sql=$sql.' and content like '.$str;
			$sqlCount=$sqlCount.' and content like '.$str;
		}*/
		if($add_time!==null&&$add_time!==''){
			$str='"%'.$add_time.'%"';
			//$str='"'.$add_time.' 00:00:00'.'"';
			$sql=$sql.' and add_time like '.$str;
			$sqlCount=$sqlCount.' and add_time like '.$str;
		}
		/*if($edit_time!==null&&$end_time!==''){
			//$str='"%'.$end_time.'%"';
			$str='"'.$end_time.' 24:00:00'.'"';
			$sql=$sql.' and add_time <= '.$str;
			$sqlCount=$sqlCount.' and add_time <= '.$str;
		}*/
		
		$sql=$sql.' order by id desc limit '.$page.','.$rows;
		$db=new DB();
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sqlCount);
		$count=$arr_cou[0]['count'];
		
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],'cat_id'=>$arr[$i]['cat_id'],'category'=>$arr[$i]['category'],'title'=>$arr[$i]['title'],'tags'=>$arr[$i]['tags'],
				'brief_ctnt'=>$arr[$i]['brief_ctnt'],'add_time'=>$arr[$i]['add_time'],'brief_title'=>$arr[$i]['brief_title'],'is_checked'=>$arr[$i]['is_checked'],
				'is_forbidden'=>$arr[$i]['is_forbidden'],'is_recommended'=>$arr[$i]['is_recommended']);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();
	}
	
	/**
	功能：添加内容
	*/
	function saveInfo($conInfo){
		$db=new DB();
		
		if(!($_FILES['file']['error'])){			
			$time=time();
			$y=date('Y',$time);
			$m=date('m',$time);
			$d=date('d',$time);
			
			$rootpath=SP_BASEPATH;
			$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';
			$vars=array(
				'file'=>'file',
				'limit_size'=>5*1024*1024,
				'savepath'=>$savepath,
				'rootpath'=>$rootpath,
				'thumbnails_size'=>$conInfo['thumbnails_size']
			);
			$img=new IMG($vars);
			if(get_is_up_succeed){
				$conInfo['thumbnail']=$img->get_savepath().$img->get_auto_filename();
			}
		}
		$result=$db->InsertData('contentinfo',$conInfo);
		echo $rootpath;
		$db->Close();
	}
	
	function getAttach($id){
		
		$db=new DB();
		$contentInfo=$db->GetInfo($id,'contentinfo');
		$r='';
		//$str='';
		if($contentInfo['recOption']!=null&&$contentInfo['recOption']!=''){
			$base=$contentInfo['recOption'];
			$arr=explode(',',$base);
			if(count($arr)>0){
				for($j=0;$j<count($arr);$j++){
					$r==''?$r=$arr[$j].':"'.$arr[$j].'"':$r=$r.','.$arr[$j].':"'.$arr[$j].'"';
				}
			}
		}
//		if($r!=''){
//			$str=','.$r;
//		}
		$jsonArray=array('id'=>$contentInfo['id'],'catId'=>$contentInfo['cat_id'],'category'=>$contentInfo['category'],'title'=>$contentInfo['title'],'exclusive_name'=>$contentInfo['exclusive_name'],'tags'=>$contentInfo['tags'],'brief_ctnt'=>$contentInfo['brief_ctnt'],'content'=>$contentInfo['content'],'brief_title'=>$contentInfo['brief_title'],'thumbnails_size'=>$contentInfo['thumbnails_size'],'info_source'=>$contentInfo['source'],'type'=>$contentInfo['type'],'base'=>$contentInfo['base']);
		$json=json_encode($jsonArray);
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
	
	
	function getPath($id){
		$db=new DB();
		$contentInfo=$db->GetInfo($id,'contentinfo');
		return $contentInfo['thumbnail'];
	}
	
	function updInfo($id,$conInfo){
		$db=new DB();
		
		if($_FILES['file']['error']==0){
			//$oldPath=SP_BASEPATH.$this->getPath($id,$db);
			$oldPath=$this->getPath($id,$db);
			$oldorganizeinfo=$db->GetInfo($id,'messageinfo');
			$old_thumbnails_size=$oldorganizeinfo['thumbnails_size'];
			$time=time();
			$y=date('Y',$time);
			$m=date('m',$time);
			$d=date('d',$time);
			
			$savepath='upload/'.$y.'/'.$m.'/'.$d.'/';//获取新文件存储路径		
		
			$vars=array(
				'file'=>'file',
				'limit_size'=>2*1024*1024,
				'savepath'=>$savepath,
				'rootpath'=>SP_BASEPATH,
				'old_file'=>$oldPath,
				'old_thumb_size'=>$old_thumbnails_size,
				'thumbnails_size'=>$conInfo['thumbnails_size']
			);
			$img=new IMG($vars);
			if(get_is_up_succeed){
				$conInfo['thumbnail']=$img->get_savepath().$img->get_auto_filename();
			}
		}
		$conInfo['edit_time']=date("Y-m-d H:i:s");
		$db->UpdateData('contentinfo',$id,$conInfo);
		$db->Close();
	}
	
	/**
	功能：删除内容
	*/
	function delInfo($id){
		$db=new DB();
		$file=new FILE();
		$path=SP_BASEPATH.$this->getPath($id);
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
		$sql2 = "delete from commentinfo where content_id=".$id;
		$result2 = $db->delete($sql2);
		$db->close();
	}
	
	function del_pic($info){
		$file=new FILE();
		if($info['thumbnail']!=''){
			$t_s_arr=explode(',', $info['thumbnails_size']);
			for($i=0; $i<sizeof($t_s_arr); $i++){
				$filename_arr=explode('.',$info['thumbnail']);
				$tmp_filename=SP_BASEPATH.$filename_arr[0].'-'.str_replace(':','-',$t_s_arr[$i]).'.'.$filename_arr[1];
				$file->del_file($tmp_filename);
			}
			$file->del_file(SP_BASEPATH.$info['thumbnail']);
		}
	}
	/**
	功能：批量删除内容
	*/
	function delArrInfo($arrId){
		$db=new DB();
		$file=new FILE();
		$idStr=implode(',',$arrId);
		echo $idStr;
		$sql=" select * from contentinfo where id in (".$idStr.")";
		$info_arr=$db->Select($sql);
		$result=$db->DelArrIdData($idStr,'contentinfo');
		if($result==1){
			for($i=0;$i<count($info_arr);$i++){
				$this->del_pic($info_arr[$i]);	
				$attachArr=$this->getAllById('attachment','content_id',$arrId[$i],$db);
				$commentArr=$this->getAllById('commentinfo','content_id',$arrId[$i],$db);
			}			
			for($j=0;$j<count($attachArr);$j++){
				$attach=$db->GetInfo($attachArr[$j]['id'],'attachment');
				$file_path=SP_BASEPATH.$attach['file_path'];
				$result1=$db->DelData(intval($attachArr[$j]['id']),'attachment');
				if($result1=='1'){
					$file->del_file($file_path);//删除附件
				}
			}
			for($k=0;$k<count($commentArr);$k++){
				$db->DelData(intval($commentArr[$k]['id']),'commentinfo');
			}
		}
		$db->close();
	}
	
	function getAllById($name,$column,$id,$db){
		$sql="select * from ".$name." where ".$column." = ".$id;
		$arr=$db->Select($sql);
		return $arr;
	}
	
	function load($id,$attach){
		$db=new DB();
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
			$attach['file_ext']=$file->get_file_ext();
			$attach['file_size']=$file->get_filesize();
			if($attach['file_ext']=='jpg'||$attach['file_ext']=='png'||$attach['file_ext']=='gif'){
				$attach['thumbnail']=$attach['file_path'];
			}
			
			$result=$db->InsertData('attachment',$attach);
			echo $result;
		}else{
			echo 'error';
		}
		$db->Close();
	}
	/**
	功能：加载表结构
	*/
	function attachGrid($id,$page,$rows){
				
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
			$file->del_file($file_path);//删除附件
		}
	}
	
	/**
	功能：批量删除附件
	*/
	function delArrAttach($arrId){
		$db=new DB();
		$file=new FILE();
		for($i=0;$i<count($arrId);$i++){
			$attachment=$db->GetInfo($arrId[$i],'attachment');
			$file_path=SP_BASEPATH.$attachment['file_path'];
			$result=$db->DelData($arrId[$i],'attachment');
			if($result=='1'){
				$file->del_file($file_path);//删除附件
			}
		}
		$db->close();
	}
	
	/**
	功能：审核
	*/
	function checkInfo($id){
		$db=new DB();
		$sql='update contentinfo set is_checked =1 where id= '.$id;
		$result=$db->Update($sql);
		//echo $result;
		$db->close();
	}
	
	/**
	功能：禁用/启用
	*/
	function disableInfo($list,$flag){
		$idarray=explode(',',$list);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql_edit='update contentinfo set is_forbidden='.$flag.' where id='.$idarray[$i];
			$db->Update($sql_edit);
		}	
		$db->Close();
	}
	
	/**
	功能：添加评论
	*/
	function saveComment($comment,$id){
		$db=new DB();
		$comment['content_id']=$id;
		$result=$db->InsertData('commentinfo',$comment);
		echo $result;
		$db->Close();
		
	}
	
	/**
	功能：加载表结构
	*/
	function commentGrid($id,$page,$rows){
		
		$page=($page-1)*$rows;
		
		/*if($_SESSION['category']=='.'){
			$sql='select * from commentinfo where content_id='.$id.' order by id desc ';
			$sqlCount='select count(id) as "count" from commentinfo where content_id='.$id.' order by id desc ';
		}else{
			$sql='select * from commentinfo where content_id='.$id.' and admin_id='.$_SESSION['admin_id'].' order by id desc ';
			$sqlCount='select count(id) as "count" from commentinfo where content_id='.$id.' and admin_id='.$_SESSION['admin_id'].' order by id desc ';
		}*/
		$sql='select * from commentinfo where content_id='.$id.' order by id desc ';
		$sqlCount='select count(id) as "count" from commentinfo where content_id='.$id.' order by id desc ';
			
		$sql=$sql.' limit '.$page.','.$rows;
		$db=new DB();
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sqlCount);
		$count=$arr_cou[0]['count'];
		
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$sql_admin='select * from memberinfo where id='.$arr[$i]['member_id'];
				$res=$db->Select($sql_admin);
				$arr2[$i]=array('id'=>$arr[$i]['id'],'comment'=>$arr[$i]['comment'],'comment_grade'=>$arr[$i]['comment_grade'],'comment_time'=>$arr[$i]['comment_time'],'member_name'=>$res[0]['usr']);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();
	}
	
	/**
	功能：删除评论
	*/
	function delComment($id){
		
		$db=new DB();
		$result=$db->DelData($id,'commentinfo');
		echo $result;
		$db->close();
	}
	
	/**
	功能：批量删除评论
	*/
	function delArrComment($arrId){
		
		$db=new DB();
		$db->DelArrIdData($arrId,'commentinfo');
		$db->close();
	}

	
	function getData(){	
		$base=BASE;
		$arr=explode(',',$base);
		
		for($i=0;$i<count($arr);$i++){
			$baseArr[$i]=array('id'=>$i+1,'text'=>$arr[$i]);
		}
		
		echo json_encode($baseArr);
	}
	
	function findById($id){
		$db=new DB();
		$rs[0]=$db->GetInfo($id,'commentinfo');
		$jsonArray=array('id'=>$rs[0]['id'],'comment'=>$rs[0]['comment'],'comment_grade'=>$rs[0]['comment_grade']);
		echo json_encode($jsonArray);
		$db->Close();
	}
	
	/**
	功能：修改评论
	*/
	function uptComment($id,$comment){
		$db=new DB();
		$result=$db->UpdateData('commentinfo',$id,$comment);
		echo $result;
		$db->Close();
	}
	
	//产品详情
	function getInfoById($id){
		$sql="select * from contentinfo where id = ".$id;
		$db=new DB();
		$arr=$db->Select($sql);
		$sql1="select cat_name from contentcat where id = ".$arr[0]['cat_id'];
		$arr_name=$db->Select($sql1);
		$arr[0]['cat_name']=$arr_name[0]['cat_name'];
		$arr2=array(
					'id'=>$arr[0]['id'],
					'cat_id'=>$arr[0]['cat_id'],
					'cat_name'=>$arr[0]['cat_name'],
					'category'=>$arr[0]['category'],
					'title'=>$arr[0]['title'],
					'type'=>$arr[0]['type'],
					'brief_title'=>$arr[0]['brief_title'],
					'tags'=>$arr[0]['tags'],
					'content'=>$arr[0]['content'],
					'brief_ctnt'=>$arr[0]['brief_ctnt'],
					'source'=>$arr[0]['source'],
					'admin_id'=>$arr[0]['admin_id'],
					'thumbnail'=>$arr[0]['thumbnail']
				);
		echo json_encode($arr2);
		$db->Close();
	}

}
?>