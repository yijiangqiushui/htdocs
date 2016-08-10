<?php
/************************************************************************************************************
#	PHP Version 1.5   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
# 	Modified by: Li Zhixiao
************************************************************************************************************/

/**
 * 功能：图片上传处理
 * 使用示例：$img=new IMG($vars);
 * DEMO参考最后几行代码
 */

class  IMG{
	private $savepath='';
	private $filename='';
	private $filesize=0;
	private $filetype='';
	private $auto_filename='';
	private $auto_thumbnail_namearr=array();
	private $is_up_succeed=false;
	
	/**
	* 功能：构造函数
	*
	*/
	public function __construct($vars=null){
		if($vars!=null){
			$this->upload($vars);
		}
	}
	
	/**
	* 功能：开始上传
	*
	*/
	public function upload($vars){
		if(sizeof($vars)>0){
			$this->set_filesize($_FILES[$vars['file']]['size']);
			$this->set_filetype($_FILES[$vars['file']]['type']);
			
			if($_FILES[$vars['file']]['size']==0){
				$this->set_is_up_succeed(false);
				return false;
			}
			if($_FILES[$vars['file']]['size']>$vars['limit_size']){
				$this->set_is_up_succeed(false);
				return false;
			}
			if($this->is_path_exist($vars['rootpath'].$vars['savepath'])){
				if($vars['old_file']!=''){
					$o_t_s_arr=explode(',',$vars['old_thumb_size']);
					for($i=0;$i<sizeof($o_t_s_arr);$i++){
						$filename_arr=explode('.',$vars['old_file']);
						$tmp_filename=$vars['rootpath'].$filename_arr[0].'-'.str_replace(':','-',$o_t_s_arr[$i]).'.'.$filename_arr[1];
						$this->del_file($tmp_filename);
					}
					$this->del_file($vars['rootpath'].$vars['old_file']);
				}
				$this->set_savepath($vars['savepath']);
				$this->set_filename($_FILES[$vars['file']]['name']);
				$this->set_auto_filename($_FILES[$vars['file']]['name'],$vars['thumbnails_size']);
				if($this->check_allowed_ext($_FILES[$vars['file']]['name'])){
					if(move_uploaded_file($_FILES[$vars['file']]['tmp_name'],$vars['rootpath'].$this->get_savepath().$this->get_auto_filename())){
						//echo 'upload---'.$vars['rootpath'].$this->get_savepath().$this->get_auto_filename();
						$this->generate_thumbnails($vars);
						
						$this->set_is_up_succeed(true);
						return true;
					}
					$this->set_is_up_succeed(false);
					return false;
				}
				$this->set_is_up_succeed(false);
				return false;
			}
			$this->set_is_up_succeed(false);
			return false;
		}
	}
	
	/**
	* 功能：重置图片大小
	*
	*/
	public function generate_thumbnails($vars){
		$thumbnailsArr=explode(',',$vars['thumbnails_size']);
		for($i=0;$i<count($thumbnailsArr);$i++){
			$tmparr=explode(':',$thumbnailsArr[$i]);
			$vars['thumbnails_width']=intval($tmparr[0]);
			$vars['thumbnails_height']=intval($tmparr[1]);
			if($tmparr[2]>0){
				$this->generate_square($vars,$i);
			}
			else{
				$this->generate_ratio($vars,$i);
			}
			if($vars['watermark_src']!=''){
				$this->generate_watermark($vars);
			}
			//$this->auto_thumbnail_namearr[$i]=$tmp_filename.str_replace(':','-',$thumbnailsArr[$i]).$tmp_file_ext;
		}
	}
	
	/**
	* 功能：生成缩略图（直接进行等比例缩小）
	*
	*/
	public function generate_ratio($vars,$i){
		$img=$vars['rootpath'].$vars['savepath'].$this->auto_filename;
		$img_ratio=$vars['rootpath'].$vars['savepath'].$this->auto_thumbnail_namearr[$i];
		// 获取原图片的尺寸
		list($width_orig,$height_orig)=getimagesize($img); 
		//新建一个真彩色图像		  
		$imageP=imagecreatetruecolor($vars['thumbnails_width'],$vars['thumbnails_height']);
		//注意FF下使用'image/jpeg'，IE下使用'image/pjpeg'
		if($this->filetype=='image/pjpeg' || $this->filetype=='image/jpeg'){
			$image=imagecreatefromjpeg($img);//从 JPEG 文件或 URL 新建一图
		}
		else if($this->filetype=='image/gif'){
			$image=imagecreatefromgif($img);
		}
		else{
			$image=imagecreatefrompng($img);
		}
		//重采样拷贝部分图像并调整大小		  
		imagecopyresampled($imageP,$image,0,0,0,0,$vars['thumbnails_width'],$vars['thumbnails_height'],$width_orig,$height_orig);
//		header("Content-Type:$this->returnData[fileType]");
		// 将图片保存到服务器		  
		if($this->filetype=='image/pjpeg' || $this->filetype=='image/jpeg'){
			imagejpeg($imageP,$img_ratio,100);
		}
		else if($this->filetype=='image/gif'){
			imagegif($imageP,$img_ratio,100);
		}
		else{
		//echo $this->filetype;
			imagepng($imageP,$img_ratio,9);//注意，版本问题
		}
		//销毁图片，释放内存
		imagedestroy($imageP);
	}
	
	/**
	* 功能：生成缩略图（缩小并截取最大正方形区域）
	*
	*/
	public function generate_square($vars,$i){
		$img=$vars['rootpath'].$vars['savepath'].$this->auto_filename;
		$img_square=$vars['rootpath'].$vars['savepath'].$this->auto_thumbnail_namearr[$i];
		// 获取原图片的尺寸
		list($width_orig,$height_orig)=getimagesize($img); 
		if($width_orig<$height_orig){
			if($vars['thumbnails_width']>$vars['thumbnails_height']){
				$imgW=$width_orig;
				$imgH=$width_orig*($vars['thumbnails_height']/$vars['thumbnails_width']);
				$src_x=0;
				$src_y=($height_orig-$imgH)/2;
			}
			else{
				$imgW=$height_orig*($vars['thumbnails_width']/$vars['thumbnails_height']);
				$imgH=$height_orig;
				$src_x=($width_orig-$imgW)/2;
				$src_y=0;
			}
		}
		else{
			if($vars['thumbnails_width']>$vars['thumbnails_height']){
				$imgW=$width_orig;
				$imgH=$width_orig*($vars['thumbnails_height']/$vars['thumbnails_width']);
				$src_x=0;
				$src_y=($height_orig-$imgH)/2;
			}
			else{
				$imgW=$height_orig*($vars['thumbnails_width']/$vars['thumbnails_height']);
				$imgH=$height_orig;
				$src_x=($width_orig-$imgW)/2;
				$src_y=0;
			}
		}
		//新建一个真彩色图像		  
		$imageP=imagecreatetruecolor($vars['thumbnails_width'],$vars['thumbnails_height']);
		//注意FF下使用'image/jpeg'，IE下使用'image/pjpeg'
		if($this->filetype=='image/pjpeg' || $this->filetype=='image/jpeg'){
			$image=imagecreatefromjpeg($img);//从 JPEG 文件或 URL 新建一图
		}
		else if($this->filetype=='image/gif'){
			$image=imagecreatefromgif($img);
		}
		else{
			$image=imagecreatefrompng($img);
		}
		//重采样拷贝部分图像并调整大小		  
		imagecopyresampled($imageP,$image,0,0,$src_x,$src_y,$vars['thumbnails_width'],$vars['thumbnails_height'],$imgW,$imgH);
//		header("Content-Type:$this->returnData[fileType]");
		// 将图片保存到服务器		  
		if($this->filetype=='image/pjpeg' || $this->filetype=='image/jpeg'){
			imagejpeg($imageP,$img_square,100);
		}
		else if($this->filetype=='image/gif'){
			imagegif($imageP,$img_square,100);
		}
		else{
		//echo $this->filetype;
			imagepng($imageP,$img_square,9);//注意，版本问题
		}
		//销毁图片，释放内存
		imagedestroy($imageP);
	}
	
	/**
	* 功能：设置水印（缩略图免加）
	*
	*/
	public function generate_watermark($vars){
		$img=$vars['rootpath'].$vars['savepath'].$this->auto_filename;
		list($widthDst,$heightDst)=getimagesize($img);
		list($widthSrc,$heightSrc)=getimagesize($vars['watermark_src']);
		if($this->filetype=='image/pjpeg' || $this->filetype=='image/jpeg'){
			$image=imagecreatefromjpeg($img);//从 JPEG 文件或 URL 新建一图
		}
		else if($this->filetype=='image/gif'){
			$image=imagecreatefromgif($img);
		}
		else{
			$image=imagecreatefrompng($img);
		}
		$imageP=imagecreatefrompng($vars['watermark_src']);//水印只用PNG格式文件
		imagecopy($image,$imageP,$widthDst-$widthSrc,$heightDst-$heightSrc,0,0,$widthSrc,$heightSrc);
		if($this->filetype=='image/pjpeg' || $this->filetype=='image/jpeg'){
			imagejpeg($image,$img,100);
		}
		else if($this->filetype=='image/gif'){
			imagegif($image,$img,100);
		}
		else{
		//echo $this->filetype;
			imagepng($image,$img,9);//注意，版本问题
		}
		imagedestroy($image);
	}
	
	/**
	* 功能：设置文件大小
	*
	*/
	public function set_filesize($filesize){
		return $this->filesize=$filesize;
	}
	
	/**
	* 功能：获取文件大小
	*
	*/
	public function get_filesize(){
		return $this->filesize;
	}

	/**
	* 功能：设置文件类型
	*
	*/
	public function set_filetype($filetype){
		return $this->filetype=$filetype;
	}
	
	/**
	* 功能：获取文件类型
	*
	*/
	public function get_filetype(){
		return $this->filetype;
	}
	
	/**
	* 功能：设置文件实际路径
	*
	*/
	public function set_savepath($savepath){
		return $this->savepath=$savepath;
	}
	
	/**
	* 功能：获取文件实际路径
	*
	*/
	public function get_savepath(){
		return $this->savepath;
	}
	
	/**
	* 功能：判断是否允许上传该文件
	*
	*/
	public function check_allowed_ext($filename){
		$allowed_ext='.jpg,.png,.gif';
		if($allowed_ext=='' || $allowed_ext=='*' || strpos($allowed_ext,strtolower(substr($filename,strrpos($filename,'.'))))>-1){
			return true;
		}
		return false;
	}
	
	/**
	* 功能：获取上传状态
	*
	*/
	public function get_is_up_succeed(){
		return $this->is_up_succeed;
	}
	
	/**
	* 功能：设置上传状态
	*
	*/
	public function set_is_up_succeed($boolean){
		return $this->is_up_succeed=$boolean;
	}
	
	/**
	* 功能：设置真实的文件名
	*
	*/
	public function set_filename($filename){
		return $this->filename=$filename;
	}
	
	/**
	* 功能：获取真实的文件名
	*
	*/
	public function get_filename(){
		return $this->filename;
	}

	/**
	* 功能：获取默认的文件名
	*
	*/
	public function get_auto_filename(){
		return $this->auto_filename;
	}

	/**
	* 功能：设置默认的文件名
	*
	*/
	function set_auto_filename($filename,$thumbnails_size){
		$timeStr=microtime();
		$timeArr=explode(' ',$timeStr);
		$tmp_filename=$timeArr[1].substr($timeArr[0],2);
		$tmp_filename=sha1(md5(strval($tmp_filename)).mt_rand(1,100));
		$tmp_file_ext=substr($filename,strrpos($filename,'.'));
		$this->auto_filename=$tmp_filename.$tmp_file_ext;
		$thumbnailsArr=explode(',',$thumbnails_size);
		for($i=0;$i<count($thumbnailsArr);$i++){
			$this->auto_thumbnail_namearr[$i]=$tmp_filename.'-'.str_replace(':','-',$thumbnailsArr[$i]).$tmp_file_ext;
		}
	}

	/**
	* 功能：检查文件夹是否存在，不存在则新建
	*
	*/
	public function is_path_exist($path){
		if($path=='') 
			return true;
		if(is_dir($path)){
			return true;
		}
		else{
			if($this->mkdirs($path))
				return true;
			else
				return false;
		}
	}
	
	/**
	* 功能：对上传的文件处理后重新命名（删除原上传后的文件）
	*
	*/
	public function rename_file($new_name,$old_name){
		if(@rename($new_name,$old_name))
			return 1;
		else
			return 0;
	}
	
	/**
	* 功能：删除文件
	*
	*/
	public function del_file($filepath){
		if(@unlink($filepath))
			return 1;
		else
			return 0;
	}
	
	/**
	* 检查目标文件夹是否存在，如果不存在则自动创建该目录
	* @access      public
	* @param       string      folder     目录路径。不能使用相对于网站根目录的URL
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


/*************

DEMO：

PHP--
in clude '../common/php/lib/img.cls.php';

$vars=array(
	'file'=>'fileField',
	'limit_size'=>20*1024*1024,
	'savepath'=>'upload/',
	'rootpath'=>'./',
	//'old_file'=>'upload/5bac242b9b7f845eaa46f600fb5f5e70.gif',//不一定在同一个目录下，所以使用完整路径
	'thumbnails_size'=>'600:480:0,400:400:1,80:80:1',//width:height:resampletype(按比例压缩或截取)
	//'watermark_src'=>'../../../upload/watermark.png'//根据实际路径设置
);

$img=new IMG($vars);
if($img->get_is_up_succeed()){
	echo $img->get_auto_filename();
	echo '<br />';
	echo $img->get_filename();
	echo '<br />';
	echo $img->get_savepath();
	echo '<br />';
	echo $img->get_filesize();
	echo '<br />';
	echo $img->get_filetype();
	echo '<br />';
}

HTML--
<form action="test.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label for="fileField"></label>
  <input type="file" name="fileField" id="fileField" />
  <input type="submit" name="button" id="button" value="提交" />
</form>


***/
