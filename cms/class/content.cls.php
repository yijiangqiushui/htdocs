<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/
require_once(ROOTPATH.'../../cms/system/class/db.cls.php');

class content extends DBSQL{
	
	public function __construct(){
		parent::__construct();
	}

	/*!- 内容类型相关 start --*/	
	public function isCatExist($catId,$catName,$upperCat){
		$sql="select id from contentCat where id<>$catId and catName='$catName' and upperCat='$upperCat' limit 0,1";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function addCat($data){
		return $this->insertData('contentCat',$data);
	}
	
	public function editCat($catId,$data){
		$sql="select upperCat from contentCat where id=$catId limit 0,1";
		$r=$this->select($sql);
		$sql="update contentCat set upperCat=concat('".$data[upperCat]."',replace(substring(upperCat,locate('s".$catId."e',upperCat)),'s".$r[0][0]."e','s".$data[upperId]."e')) where upperCat like '%s".$catId."e%'";
		$this->update($sql);
		$sql="update contentCat set isLast=0 where id=".$data[upperId];
		$this->update($sql);
		$sql="update contentInfo set category=concat('".$data[upperCat]."',replace(substring(category,locate('s".$catId."e',category)),'s".$r[0][0]."e','s".$data[upperId]."e')) where category like '%s".$catId."e%'";
		$this->update($sql);
		return $this->updateData('contentCat',$catId,$data);
	}
	
	public function deleteCat($catId){
		return $this->delData($catId,'contentCat');
	}
	
	public function getCat($catId){
		$r=array();
		$sql="select * from contentCat where id=$catId limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getUpperCat($upperCat){
		$r=array();
		$sql="select * from contentCat where upperCat=$upperCat limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}	
	public function getBatchCat($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchCat($idArr){
		$arr=split(',',$idArr);
		for($i=0;$i<count($arr);$i++){
			$sql="delete from contentInfo where category like '%s".$arr[$i]."e%'";
			$this->delete($sql);
			$sql="delete from contentCat where upperCat like '%s".$arr[$i]."e%'";
			$this->delete($sql);
		}
		return $this->delArrIdData($idArr,'contentCat');
	}
	/*!- 内容类型相关 end --*/	

	/*!- 内容信息相关 start --*/	
	public function addInfo($data){
		return $this->insertData('contentInfo',$data);
	}
	
	public function editInfo($infoId,$data){
		return $this->updateData('contentInfo',$infoId,$data);
	}
	
	public function deleteInfo($infoId){
		return $this->delData($infoId,'contentInfo');
	}
	
	public function getInfo($infoId){
		$data=array();
		$sql="select * from contentInfo where id=$infoId limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchInfo($sql){

		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchInfo($idArr){
		$sql="delete from contentReply where infoId in ($idArr)";
		$this->delete($sql);
		return $this->delArrIdData($idArr,'contentInfo');
	}
	/*!- 内容信息相关 end --*/	
	
	/*!- 内容回复相关 start --*/	
	public function addReply($data){
		return $this->insertData('contentReply',$data);
	}
	
	public function editReply($id,$data){
		return $this->updateData('contentReply',$id,$data);
	}
	
	public function deleteReply($id){
		return $this->delData($id,'contentReply');
	}
	
	public function getReply($id){
		$sql="select * from contentReply where id=$id  limit 0,1 ";
		$r = $this->select($sql);
		return $r[0];
	}
/*获得刚刚插入的回复的那个reply表的id*/	
	public function getReplyMaxId($id){
		$sql="select  max(id) from contentReply where infoId=$id ";
		$r = $this->select($sql);
		return $r[0];
	}
	public function getBatchReply($sql){
		$r=$this->select($sql);
		return $r;
	}
	public function getReplyOne($sql){
		$r=$this->select($sql);
		return $r[0];
	}
	
	public function delBatchReply($idArr){
		return $this->delArrIdData($idArr,'contentReply');
	}
	/*!- 内容回复相关 end --*/	
	
	/*!- 餐饮评论 星级、服务环境、口味 ,可以加1个标签 相关 start --*/	
public function addReview($data){
		return $this->insertData('contentReview',$data);
	}
	
	public function editReview($id,$data){
		return $this->updateData('contentReview',$id,$data);
	}
	
	public function deleteReview($id){
		return $this->delData($id,'contentReview');
	}
	
	public function getReview($id){
		$sql="select * from contentReview where id=$id limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchReview($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchReview($idArr){
		return $this->delArrIdData($idArr,'contentReview');
	}
		
	/*!- 餐饮评论 星级、服务环境、口味 相关 end --*/	
	
	
	/* 函数能够汇总所有的单价口味环境和星级地址，函数一定要在前面声明*/
	public function getAllReview($review,$recordCountReview){
	$averagePrice = 0; $averagetaste=0;  $averageenvironment=0;  $averagestar=0; 
	$arrayAllReview=array(); 
	for($j=0;$j<$recordCountReview;$j++){
		$averagePrice += $review[$j][price];
		$averagetaste += $review[$j][taste];
		$averageenvironment += $review[$j][environment];
		$averagestar += $review[$j][star];
	}
	$averagePrice =($recordCountReview==0) ? 0:($averagePrice / $recordCountReview);
	$arrayAllReview['averagePrice']=round($averagePrice,1);
	$averagetaste = ($recordCountReview==0)?0:($averagetaste / $recordCountReview);
	$arrayAllReview['averageTaste']=round($averagetaste,1);
	$averageenvironment = ($recordCountReview==0)?0:($averageenvironment / $recordCountReview);
	$arrayAllReview['averageEnvironment']=round($averageenvironment,1);
	$averagestar = ($recordCountReview==0)?0:($averagestar / $recordCountReview);
	$arrayAllReview['averageStar']=round($averagestar,1);

	return $arrayAllReview;	
}
/* end 函数能够汇总所有的单价口味环境和星级地址，		*/

/* 函数能够提取内容中的图片地址*/
	public function getImgPath($content){
	/**------------start 获取新闻中的图片*/	
	 
     if(strpos($content,"<img")===false)
          { $img_path = "images/blank_news.jpg";}
     else//说明存在图片
          {
               $img_pic_content_sub = substr($content,strpos($img_pic_content,"<img"));
               if( strpos($content,"/>")===false || strpos($img_pic_content_sub,"/ueditor/")===false)
               {
				   $img_path = "images/blank_news.jpg";
				}
               else
               {

                    $img_pic_content_result = substr($img_pic_content_sub,strpos($img_pic_content_sub,"/ueditor/"));
//  /ueditor/ 这是一个新的开头

                    $img_path = substr($img_pic_content_result,0,strpos($img_pic_content_result,"\""));
// \"  这是一个新的结尾
               }
          }//end 说明文章里有图片
/** ------------end 获取新闻中的图片----*/
	
	return $img_path;
	}


/* 函数能够提取内容中视频地址*/
	public function getVideoPath($content){//不过没有用到，因为可能有循环图片呢，detail.php里面有多个图片
	/**------------start 获取新闻中的图片*/	
	 
     if(strpos($content,"<video")===false)
          { }
     else//说明存在图片
          {
               $img_pic_content_sub = substr($content,strpos($img_pic_content,"<video"));
               if( strpos($content,"/video>")===false || strpos($img_pic_content_sub,"/ueditor/")===false)
               {
				}
               else
               {

                    $img_pic_content_result = substr($img_pic_content_sub,strpos($img_pic_content_sub,"/ueditor/"));
//  /ueditor/ 这是一个新的开头

                    $img_path = substr($img_pic_content_result,0,strpos($img_pic_content_result,"\""));
// \"  这是一个新的结尾
               }
          }//end 说明文章里有图片
/** ------------end 获取新闻中的图片----*/
	
	return $img_path;
	}
	/**
* UTF-8 中文切字
* @param    string    需要切分的字符串
* @param    int    切分开始处
* @param    int    切分的长度
* @return    int    切分后的字符串
*/

public function msubstr($str, $start, $length=NULL)
{
    preg_match_all("/./u", $str, $ar);

    if(func_num_args() >= 3) {
       $end = func_get_arg(2);
       return join("",array_slice($ar[0],$start,$end));
    } else {
       return join("",array_slice($ar[0],$start));
    }
}	

function getLeftFitStr($str,$start)/*从前向后取合适的字符，多余加...就好，2个数字算1个汉字的长度，注意和left函数像,*/
{	
		$len=0.0;
	preg_match_all("/./u", $str, $ar);
	
	for($i=0;;$i++)
	{
		$str_tmp = join("",array_slice($ar[0],$i,1));
		if( join("",array_slice($ar[0],$i,1))==="") { break;}
		if (eregi('[0-9]', $str_tmp) ){ 
			$len=$len+0.5;
		}else if (ereg('[a-z]', $str_tmp)){ 
			$len=$len+0.5;
		}else if (ereg('[A-Z]', $str_tmp)){ /*大写字母按汉字算*/
			$len=$len+0.8;	
		}else if (preg_match("/ /", $str_tmp)){ /*空格*/
			$len=$len+0.2;	
		}else if (preg_match("/\(/", $str_tmp)){ /*空格*/
			$len=$len+0.2;	
		}else if (preg_match("/\)/", $str_tmp)){ /*空格*/
			$len=$len+0.2;	
		}else if (preg_match("/\[/", $str_tmp)){ /*空格*/
			$len=$len+0.2;	
		}else if (preg_match("/\]/", $str_tmp)){ /*空格*/
			$len=$len+0.2;	
		}else if (preg_match("/\:/", $str_tmp)){ /*空格*/
			$len=$len+0.2;
		}else if (eregi('[^\x00-\x7F]', $str_tmp) ){ 
			$len=$len+1;
		}
		else $len=$len;
	//	echo '<br/>len='.$len;
//		if($len>=$start||$len+0.5>$start) 
//		{//echo '<br/>-len='.$len.' start='.$start; echo ' i='.$i.' ';
//		 break;}
		if($len>$start) { break;} 
		 
	}	
	//if($len>=$start||$len+0.5>$start) { $str_end='...';}
//	else $str_end='';
//注释：开始循环按照$i循环，一个汉字i+1,一个字母a,i+1
//$len是环，一个汉字len+1,一个字母a，len+0.5
//start是我需要取start个全角字符，start-0.5 ~start都可以接受
	 $str_end='...';
	if( $len <= $start)
		 return $str; //退出函数了
	if($len>$start) { 
		return join("",array_slice($ar[0],0,$i)).$str_end;  
	}
//	 return join("",array_slice($ar[0],0,$i+1)).$str_end;
}/*需要的2个数字算1个汉字的长度,这才是我们需要的长度 */


/*!- 记录很重要的系统日志 start --*/
public function addLog($data){
		return $this->insertData('contentlog',$data);
	}
	
	public function editLog($id,$data){
		return $this->updateData('contentlog',$id,$data);
	}
	
	public function deleteLog($id){
		return $this->delData($id,'contentlog');
	}
	
	public function getLog($id){
		$sql="select * from contentlog where id=$id limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchLog($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchLog($idArr){
		return $this->delArrIdData($idArr,'contentlog');
	}
		
	/*!- 餐饮评论 标签 特色，可以加多个标签，所以是个新表  end --*/		
function getCategory($str)
{
	$cat_= $str;
	$category='1';
		do
		{
			$cat_result= substr($cat_,strpos($cat_,"s"),strpos($cat_,"e")-strpos($cat_,"s")+1);
			$cat_= substr($cat_,strpos($cat_,"e")+1);
			if($cat_result=='s1e')	$category .= $catName[$cat_result];
			else	$category .= " > ".$catName[$cat_result]."";
		}while(strstr($cat_,"e")); 
	return $category;
}	

/*!-废弃了 餐饮评论 标签 特色，可以加多个标签，所以是个新表 ,目前需要去掉这个表，废弃了 相关 start --*/	
public function addLabel($data){
		return $this->insertData('contentLabel',$data);
	}
	
	public function editLabel($id,$data){
		return $this->updateData('contentLabel',$id,$data);
	}
	
	public function deleteLabel($id){
		return $this->delData($id,'contentLabel');
	}
	
	public function getLabel($id){
		$sql="select * from contentLabel where id=$id limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchLabel($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchLabel($idArr){
		return $this->delArrIdData($idArr,'contentLabel');
	}
		
	/*!- 餐饮评论 标签 特色，可以加多个标签，所以是个新表  end --*/		
}
?>