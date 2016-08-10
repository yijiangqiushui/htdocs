<?php
include '../../../../php/action/class/projectFile.cls.php';
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
class Uploadify{
	
	function add(){
		// Define a destination
		$msg = array(
			"status"=>0,
			"tip"=>"",
		);
		$targetFolder = '/website/html/upload/'.$_SESSION['project_id']; // Relative to the root
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);
		
		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			if(!file_exists($targetPath)){
				mkdir($targetPath,0777,true);
			}
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
			if(stristr(PHP_OS, 'WIN')){
				$targetFile = iconv("UTF-8", "GB2312//IGNORE",$targetFile);
			}
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png','pdf','doc','docx','txt'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			if (in_array(strtolower($fileParts['extension']),$fileTypes)) {
				if(is_uploaded_file($tempFile)){
					//echo "10";
					move_uploaded_file($tempFile,$targetFile);
				}else{
					//echo "11";
				}
				//store the file
				
				$data = array(
					'name'=>$_FILES['Filedata']['name'],
					'project_id'=>$_SESSION['project_id'],
					'file_type'=>$fileParts['extension'],
					'size'=>$this->getNaturalSize($_FILES['Filedata']['size']),
				    'subtable_id'=>intval($_GET['table_id']),
					'path'=>$targetFolder . '/' . $_FILES['Filedata']['name']
				);
				
				$ret = projectFile::instance()->insert($data);
				$msg['status']=1;
				echo json_encode($msg);
			} else {
				$msg['tip']="上传失败，只允许上传jpg,jpeg,gif,png,pdf,doc,docx,txt 格式的文件";
				echo json_encode($msg);
			}
		}
	}
	
	function getNaturalSize($size){
	    if($size/1024 < 1){
	        return $size."B";
	    }else if($size/(1024*1024) < 1){
	        return round($size/1024,2) . "KB";
	    }else{
	        return round($size/(1024*1024),2)."MB";
	    }
	}
	
	/*
	 * 20160303 david add 用来增加 工商营业执照 的文件信息
	 * 信息分类（0:工商营业执照,1:税务登记证）
	 */
	
	function legal(){
	    $db = new DB();
	    if($_SESSION['org_code'] == null){
	        $org_code = $_GET['org_code'];
	    }else{
	        $org_code = $_SESSION['org_code'];
	    }
	    $permit_certi = $_GET['permit_certi'];
		$folder = date("Y-m-d");
		$msg = array(
			"name"=>"",
			"url"=>""
		);
		// Define a destination
		$targetFolder = '/website/html/upload/legal/'.$org_code.'/'.$folder; // Relative to the root
		
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);
		
		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			if(!file_exists($targetPath)){
				mkdir($targetPath,0777,true);
			}
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png','pdf','doc','docx'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				
				$tf =  md5($_FILES['Filedata']['name']).strtotime("now").".".$fileParts['extension'];
				
				$targetFile = rtrim($targetPath,'/') . '/' . $tf;
			
				if(stristr(PHP_OS, 'WIN')){
					$targetFile = iconv("UTF-8", "GB2312//IGNORE",$targetFile);
				} 
				
				move_uploaded_file($tempFile,$targetFile);
				
				//david 增加上传到数据库中去  20160303
				$data = array(
				    'name'=>$_FILES['Filedata']['name'],
				    'project_id'=>$_SESSION['project_id'],
				    'file_type'=>$fileParts['extension'],
				    'size'=>$this->getNaturalSize($_FILES['Filedata']['size']),
				    'permit_certi'=>$permit_certi,
				    //这里需要获取的是org_code
				    'org_code'=>$org_code,
				    'path'=>$targetFolder . '/' . $tf
				);
				//首先需要先删除掉原来的文件才能上传
				
				$delete_sql = "Delete from attach_list where org_code = $org_code and permit_certi = $permit_certi";
				$db -> Delete($delete_sql);
				$db->Close();
				
   				//上传到数据库中去
				$ret = projectFile::instance()->insert($data);
				
				//上面的是david add  20160303
				
				//echo $targetFile;
				
				//echo $targetFolder.'/'.$tf;
				$msg = array(
					"name"=>$tf,
					"url"=>$targetFolder.'/'.$tf
				);
				
				
				echo json_encode($msg);
			} else {
				echo 'Invalid file type.';
			}
		}
	}
	
	
	/*
	 * david 20160303 add
	 * 用来获取当前公司注册时文件的路径（按道理应该是两个文件）
	 */
	function getOrgfile(){
	    $db = new DB();
	    $org_code = $_SESSION['org_code'];
	    $sql = "Select * from attach_list where org_code = '$org_code'";
	    $result = $db -> Select($sql);
	    foreach($result as $item){
            if($item['permit_certi'] == 0){ // 代表工商营业执照
                $permit_url =  $item['path'];
            }else if($item['permit_certi'] == 1){ // 税务登记证
                $certi_url = $item['path'];
            }
	    }
	    $data = array(
	        "permit_url" => iconv("UTF-8", "GB2312//IGNORE",$permit_url),
	        "certi_url" => iconv("UTF-8", "GB2312//IGNORE",$certi_url),
	    );
	    echo json_encode($data);
	}
	
	function getUpinfo(){
		$timestamp = time();
		$token = md5('unique_salt' . $timestamp);
		
		$ret = array(
			'timestamp'=>$timestamp,
			'token'=>$token
		);
		
		echo json_encode($ret);
		exit;
		
	}
	
	function run(){
		$action = $_GET['action'];
		
		$this->$action();
		
	}
	
	function editIntro(){
	    
	    $msgcode = 100;
		
		$id = intval($_POST['cid']);
		$content = $_POST['content'];
		
		$data = array(
			'introduction'=>$content
		);
		
		$res = projectFile::instance()->updateById($id,$data);
		
		
		if(!$res){
		    $msgcode = 101;
		}
		
		$ret = array(
		    'msgcode'=>$msgcode,
		    'content'=>$res
		);
		
		echo json_encode($ret);
		exit;
	}
	
	
	function del(){
		$id = intval($_GET['id']);	
		projectFile::instance()->delete($id);
		
		$url = $_SERVER['HTTP_REFERER'];
		header("Location:{$url}");
	}
	
}

$task = new Uploadify();

$task->run();
