<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

class upFile{
	
	private $fileName;
	
	/**
	* 功能：构造函数
	*
	*/
	public function __construct(){
	}
	
	/**
	* 功能：上传文件
	* 返回文件夹路径，文件名称
	*/
	public function uploadFile($inputFile,$saveFolder,$limitSize,$originalFile){
		if($_FILES[$inputFile]['size']==0)
			return 0;
		if($_FILES[$inputFile]['size']>$limitSize)
			return 0;
		if($this->isFolderExist($saveFolder)){
			if($originalFile!=''){
				$this->delFile(ROOTPATH.$originalFile);
			}
			$this->fileName=$this->setNgetFileName();
			$this->fileName.=strstr($_FILES[$inputFile]['name'],'.');
			if(move_uploaded_file($_FILES[$inputFile]['tmp_name'],$saveFolder.$this->fileName)){
				return $this->fileName;
			}
			return 0;
		}
		return 0;
	}

	/**
	* 功能：检查文件夹是否存在，不存在则新建
	*
	*/
	public function isFolderExist($folderName){
		if(is_dir($folderName))
			return true;
		else{
			if($this->mkdirs($folderName))
				return true;
			return false;
		}
	}
	
	/**
	* 功能：对上传的文件处理后重新命名（删除原上传后的文件）
	*
	*/
	public function renameFile($objectName,$originalName){
		if(@rename($objectName,$originalName))
			return 1;
		else
			return 0;
	}
	
	/**
	* 功能：删除文件
	*
	*/
	public function delFile($filePath){
		if(@unlink($filePath))
			return 1;
		else
			return 0;
	}
	
	/**
	* 功能：设置默认的文件名
	*
	*/
	function setNgetFileName(){
		$timeStr=microtime();
		$timeArr=explode(' ',$timeStr);
		$fileName=$timeArr[1].substr($timeArr[0],2);
		$fileName=md5(strval($fileName));
		return $fileName;
	}

	/**
	* 检查目标文件夹是否存在，如果不存在则自动创建该目录
	*
	* @access      public
	* @param       string      folder     目录路径。不能使用相对于网站根目录的URL
	*
	* @return      bool
	*/
	public function mkdirs($folder){
		$reval = false;	
		if (!file_exists($folder)){
			/* 如果目录不存在则尝试创建该目录 */
			@umask(0);	
			/* 将目录路径拆分成数组 */
			preg_match_all('/([^\/]*)\/?/i', $folder, $atmp);	
			/* 如果第一个字符为/则当作物理路径处理 */
			$base = ($atmp[0][0] == '/') ? '/' : '';	
			/* 遍历包含路径信息的数组 */
			foreach ($atmp[1] AS $val){
				if ('' != $val){
					$base .= $val;	
					if ('..' == $val || '.' == $val){
						/* 如果目录为.或者..则直接补/继续下一个循环 */
						$base .= '/';	
						continue;
					}
				}
				else{
					continue;
				}	
				$base .= '/';	
				if (!file_exists($base)){
					/* 尝试创建目录，如果创建失败则继续循环 */
					if (@mkdir(rtrim($base, '/'), 0777)){
						@chmod($base, 0777);
						$reval = true;
					}
				}
			}
		}
		else{
			/* 路径已经存在。返回该路径是不是一个目录 */
			$reval = is_dir($folder);
		}	
		clearstatcache();	
		return $reval;
	}

}
?>