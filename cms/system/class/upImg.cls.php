<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

/**
* 功能文件上传
*
**/
class upImg{
	private $uploadTime;
	private $returnData=array();
	/**
	* 功能：构造函数
	*
	*/
	public function __construct(){
		$this->uploadTime=date('Y-m-d H:i:s');
	}
	
	/**
	* 功能：上传操作函数（可实现按年月创建文件夹）
	* 参数：文件相关（$fileArr）：fileInput 文件域,savePath 保存路径,fileName 文件名,fileSize 文件,大小
	* limitSize 上传文件大小限制,delOrig 是否删除原文件,delOrigName 要删除的原文件名称
	* 图片形状相关（$imgSizeArr）：sysSet 是否默认压缩图片,sysSetWOrH 默认压缩高宽,smallSize 是否生成小图片,
	* smallImgName 小图片文件名,ssWOrH 小图片高宽,delOrigSmall 是否删除原来小图片,delSmallName 要删除的小图片名称
	* 图片形状相关（$imgWatermarkArr）：setWatermark 是否设置水印, watermarkSrcImg 水印图片
	* 返回：文件名、扩展名、存放文件夹、上传时间、文件大小等
	*/
	public function upload($fileArr,$imgSizeArr,$imgWatermarkArr){
		try{
			if($_FILES[$fileArr[fileInput]]['size']==0)
				return false;
			if($_FILES[$fileArr[fileInput]]['size']>$fileArr[limitSize]){
				return false;
			}
			else{
				if($this->isFolderExist($fileArr[savePath])){
					$this->returnData[unlinkErr]='fail';
					$this->returnData[fileExt]=strstr($_FILES[$fileArr[fileInput]]['name'],'.');//文件后缀名
					$this->returnData[fileName]=$fileArr[fileName].$this->returnData[fileExt];//文件名称
					$this->returnData[filePath]=$fileArr[savePath].'/'.$this->returnData[fileName];//文件路径
					$this->returnData[imgTmpName]=$fileArr[savePath].'/imgTmpName'.$this->returnData[fileExt];
					$this->returnData[fileFolder]=$fileArr[fileFolder];//存放文件的文件夹
					$this->returnData[uploadTime]=$this->uploadTime;//上传时间
					$this->returnData[fileSize]=$_FILES[$fileArr[fileInput]]['name'];//文件大小
					$this->returnData[fileType]=$_FILES[$fileArr[fileInput]]['type'];//文件类型，不用于后缀名
					move_uploaded_file($_FILES[$fileArr[fileInput]]['tmp_name'],$this->returnData[filePath]);
					if($imgSizeArr[smallSize]){
						$this->returnData[smallImgName]=$imgSizeArr[smallImgName].$this->returnData[fileExt];//小图片名称
						$this->returnData[smallImgPath]=$fileArr[savePath].'/'.$this->returnData[smallImgName];//小图片路径
						if($imgSizeArr[smallSize]==1)
							$this->genSmallImg_1($this->returnData[filePath],$imgSizeArr,$this->returnData[smallImgPath]);
						if($imgSizeArr[smallSize]==2)
							$this->genSmallImg_2($this->returnData[filePath],$imgSizeArr,$this->returnData[smallImgPath]);//
					}
					if($imgSizeArr[sysSet])//注意位置
						$this->resizeImg($this->returnData[filePath],$imgSizeArr,$imgWatermarkArr);
					if(!$imgSizeArr[sysSet] && $imgWatermarkArr[setWatermark]){
						$this->setWatermark($this->returnData[filePath],$imgWatermarkArr);
						$this->setNameAfterProc($this->returnData[filePath],$this->returnData[imgTmpName]);
					}
					if($fileArr[delOrig]){
						if(@unlink($fileArr[delOrigName]))
							$this->returnData[unlinkErr]='succeed';
					}
					if($imgSizeArr[delOrigSmall]){
						if(@unlink($imgSizeArr[delSmallName]))
							$this->returnData[unlinkErr]='succeed';
					}
				}
				else{
					return false;
				}
			}
		}catch(Exception $e){
			$msg = $e;
			include(ERRFILE);
		}
		return $this->returnData;
	}
	
	/**
	* 功能：重置图片大小
	*
	*/
	public function resizeImg($filePath,$imgSizeArr,$imgWatermarkArr){
		list($widthOrig,$heightOrig)=getimagesize($filePath); 
		$resetImgArr=array();
		if($widthOrig<$imgSizeArr[sysSetWOrH] && $heightOrig<$imgSizeArr[sysSetWOrH])
			if($widthOrig<$heightOrig)
				$resetImgArr[ssWOrH]=$heightOrig;
			else
				$resetImgArr[ssWOrH]=$widthOrig;
		else
			$resetImgArr[ssWOrH]=$imgSizeArr[sysSetWOrH];
		if($imgSizeArr[sysSize]==1)
			$this->genSmallImg_1($filePath,$resetImgArr,$this->returnData[imgTmpName]);
		else
			$this->genSmallImg_2($filePath,$resetImgArr,$this->returnData[imgTmpName]);
		if($imgWatermarkArr[setWatermark]){
			$this->setWatermark($this->returnData[imgTmpName],$imgWatermarkArr);
		}
		$this->setNameAfterProc($this->returnData[filePath],$this->returnData[imgTmpName]);
	}
	
	/**
	* 功能：生成缩略图（直接进行等比例缩小）
	*
	*/
	public function genSmallImg_1($filePath,$imgSizeArr,$smallImgPath){
		// 获取原图片的尺寸
		list($widthOrig,$heightOrig)=getimagesize($filePath); 
		//根据比例，计算新图片的尺寸
		if($widthOrig<$heightOrig){
			$imgW=$imgSizeArr[ssWOrH]*($widthOrig/$heightOrig);
			$imgH=$imgSizeArr[ssWOrH];
		}
		else{
			$imgW=$imgSizeArr[ssWOrH];
			$imgH=$imgSizeArr[ssWOrH]*($heightOrig/$widthOrig);
		}
		//新建一个真彩色图像		  
		$imageP=imagecreatetruecolor($imgW, $imgH); 
		//注意FF下使用'image/jpeg'，IE下使用'image/pjpeg'
		if($this->returnData[fileType]=='image/pjpeg' || $this->returnData[fileType]=='image/jpeg')
			$image=imagecreatefromjpeg($filePath);//从 JPEG 文件或 URL 新建一图
		else if($this->returnData[fileType]=='image/gif')	  
			$image=imagecreatefromgif($filePath);
		else
			$image=imagecreatefrompng($filePath);
		//重采样拷贝部分图像并调整大小		  
		imagecopyresampled($imageP,$image,0,0,0,0,$imgW,$imgH,$widthOrig,$heightOrig);
//		header("Content-Type:$this->returnData[fileType]");
		// 将图片保存到服务器		  
		if($this->returnData[fileType]=='image/pjpeg' || $this->returnData[fileType]=='image/jpeg')
			imagejpeg($imageP,$smallImgPath,100);
		else if($this->returnData[fileType]=='image/gif')
			imagegif($imageP,$smallImgPath,100);
		else
			imagepng($imageP,$smallImgPath,9);//注意，版本问题
		//销毁图片，释放内存
		imagedestroy($imageP);
	}
	
	/**
	* 功能：生成缩略图（缩小并截取最大正方形区域）
	*
	*/
	public function genSmallImg_2($filePath,$imgSizeArr,$smallImgPath){
		list($widthOrig,$heightOrig)=getimagesize($filePath); 
		if($widthOrig<$heightOrig){
			$imgW=$imgSizeArr[ssWOrH];
			$imgH=$imgSizeArr[ssWOrH]*($heightOrig/$widthOrig);
			$src_x=0;
			$src_y=($heightOrig-$widthOrig)/2;
		}
		else{
			$imgW=$imgSizeArr[ssWOrH]*($widthOrig/$heightOrig);
			$imgH=$imgSizeArr[ssWOrH];
			$src_x=($widthOrig-$heightOrig)/2;
			$src_y=0;
		}
		$imageP=imagecreatetruecolor($imgSizeArr[ssWOrH], $imgSizeArr[ssWOrH]); 
		if($this->returnData[fileType]=='image/pjpeg' || $this->returnData[fileType]=='image/jpeg')
			$image=imagecreatefromjpeg($filePath);
		else if($this->returnData[fileType]=='image/gif')	  
			$image=imagecreatefromgif($filePath);
		else
			$image=imagecreatefrompng($filePath);
		imagecopyresampled($imageP,$image,0,0,$src_x,$src_y,$imgW,$imgH,$widthOrig,$heightOrig);
		if($this->returnData[fileType]=='image/pjpeg' || $this->returnData[fileType]=='image/jpeg')
			imagejpeg($imageP,$smallImgPath,100);
		else if($this->returnData[fileType]=='image/gif')
			imagegif($imageP,$smallImgPath,100);
		else
			imagepng($imageP,$smallImgPath,9);
		imagedestroy($imageP); 
	}
	
	/**
	* 功能：设置水印（缩略图免加）
	*
	*/
	public function setWatermark($filePath,$imgWatermarkArr){
		list($widthDst,$heightDst)=getimagesize($filePath);
		list($widthSrc,$heightSrc)=getimagesize($imgWatermarkArr[watermarkSrcImg]);
		if($this->returnData[fileType]=='image/pjpeg' || $this->returnData[fileType]=='image/jpeg')
			$image=imagecreatefromjpeg($filePath);
		else if($this->returnData[fileType]=='image/gif')	  
			$image=imagecreatefromgif($filePath);
		else
			$image=imagecreatefrompng($filePath);
		$imageP=imagecreatefrompng($imgWatermarkArr[watermarkSrcImg]);//水印只用PNG格式文件
		imagecopy($image,$imageP,$widthDst-$widthSrc,$heightDst-$heightSrc,0,0,$widthSrc,$heightSrc);
		if($this->returnData[fileType]=='image/pjpeg' || $this->returnData[fileType]=='image/jpeg')
			imagejpeg($image,$this->returnData[imgTmpName],100);
		else if($this->returnData[fileType]=='image/gif')
			imagegif($image,$this->returnData[imgTmpName],100);
		else
			imagepng($image,$this->returnData[imgTmpName],9);
		imagedestroy($image);
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
	public function setNameAfterProc($filePath,$fileAfterProc){
		if(@unlink($filePath))
			if(@rename($fileAfterProc,$filePath))
				return ;
			else
				die("文件重命名失败！");
		else
			die("删除文件失败！");
	}
	
	/**
	* 功能：删除文件
	*
	*/
	public function delFile($filePath){
		if(@unlink($filePath))
			return true;
		else
			return false;
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