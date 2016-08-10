<?php
/**
author:Gao Xue
date:2014-06-27
Modify:Wang Le
data:2014-10-13
*/
header("Content-Type:text=html;charset=utf-8");
include '../../../../common/php/config.ini.php';
include ROOTPATH.'lib/db.cls.php';

$action=$_GET['action'];

$sqlText=$_POST['sqlQuery'];
$filename=$_POST['fileName'];
$makeType=$_POST['fileType'];
$fileFolder=$_POST['fileFolder'];

$list=$_GET['arrId'];

switch($action){
	case 'makeModel':
		makeModel($sqlText,$filename,$makeType,$fileFolder);
		break;
	case 'remakeModel':
		remakeModel($sqlText,$filename,$makeType,$fileFolder);
		break;
	case 'makeArrModel':
		makeArrModel($list);
		break;
	default:;
}

function makeModel($sqlText,$filename,$makeType,$fileFolder){
	$db=new DB();
	$result=$db->Select(str_replace('\\','',$sqlText));
	$sql_insert="insert into makemodel (sqlQuery,fileName,fileType,fileFolder) values ('$sqlText','$filename','$makeType','$fileFolder')";
echo $sqlText;
	$res=$db->Insert($sql_insert);
	if($fileFolder=='json') { 
		write2file('../../../../website/html/view/inc/'.$filename.'.json',getJsonStr($result,$makeType,$filename)); 
	}else{
		write2file('../../../../website/html/view/inc/'.$filename.'_list.html',genHtmlStr($result,$makeType,$filename));
	}
//	write2file('../../../../'.$fileFolder.'/html/view/inc/'.$filename.'.html',genHtmlStr($result,$makeType,$filename));
	$db->Close();
	echo '文件生成成功';
}


function remakeModel($sqlText,$filename,$makeType,$fileFolder){
	$db=new DB();
	$result=$db->Select(str_replace('/','\\',str_replace("\\",'',$sqlText)));

	if($fileFolder=='json') { 
		write2file('../../../../website/html/view/inc/'.$filename.'.json',getJsonStr($result,$makeType,$filename)); 
	}else{ 
		write2file('../../../../website/html/view/inc/'.$filename.'_list.html',genHtmlStr($result,$makeType,$filename));
	}
/**	write2file('../../../../'.$fileFolder.'/html/view/inc/'.$filename.'.html',genHtmlStr($result,$makeType,$filename));*/
	$db->Close();
	echo '文件重新生成成功';
}

function write2file($filename,$str){
	$fp=fopen($filename,'w+');
	@fwrite($fp,$str);
	@fclose($fp);
} 

function makeArrModel($list){
	$db=new DB();
	$sql='select * from makemodel';
	$result=$db->Select($sql);
	for($i=0;$i<count($result);$i++){
		$sqlQuery=$result[$i]['sqlQuery'];
		$fileName=$result[$i]['fileName'];
		$fileType=$result[$i]['fileType'];
		$fileFolder=$result[$i]['fileFolder'];
		remakeModel($sqlQuery,$fileName,$fileType,$fileFolder);
	}
//}
/*	$db1=new DB()
	//$idArray=explode(",",$list);
	//for($i=0;$i<count($idArray);$i++){
		$sql='select * from makemodel where id='.$idArray[$i];
		$result=$db1->Select($sql);
		$sqlQuery=$result[0]['sqlQuery'];
		$fileName=$result[0]['fileName'];
		$fileType=$result[0]['fileType'];
		$fileFolder=$result[0]['fileFolder'];
		remakeModel($sqlQuery,$fileName,$fileType,$fileFolder);
	//}
*/
}

/**
* 获取json格式的字符串
*/
function getJsonStr($result,$makeType,$filename){
	$json_arr=array();
	switch($makeType){
		case 'img-txt':
			if(is_array($result)&&count($result)>0){
				for($i=0;$i<count($result);$i++){
					$title=$result[$i]['title'];
					$json_arr[$i]=array(
						'id'=>$result[$i]['id'],
						'title'=>mb_strlen($title)>9?utf8_substr($title,0,9).'...':$title,
						'img'=>'../../../../common/'.$result[$i]['thumbnail'],
						'href'=>'news_detail.html?id='.$result[$i]['id']
					);
				}
			}
			break;
		case 'activityimgslide':
			if(is_array($result)&&count($result)>0){
				$arr=explode('-',$result[0]['exclusive_name']);
				for($i=0;$i<count($result);$i++){
					$title=$result[$i]['title'];
					$thumbnail=str_replace('.','-200-130-0.',$result[$i]['thumbnail']);
					$json_arr[$i]=array(
						'id'=>$result[$i]['id'],
						'title'=>mb_strlen($title)>9?utf8_substr($title,0,9).'...':$title,
						'imgurl'=>'../../../../common/'.$thumbnail,
						'href'=>$arr[0].'_detail.html?id='.$result[$i]['id']
					);
				}
			}
			break;
		case 'recognitionimgslide':
			if(is_array($result)&&count($result)>0){
				$arr=explode('-',$result[0]['exclusive_name']);
				for($i=0;$i<count($result);$i++){
					$title=$result[$i]['title'];
					$thumbnail=str_replace('.','-130-80-0.',$result[$i]['thumbnail']);
					$json_arr[$i]=array(
						'id'=>$result[$i]['id'],
						'title'=>mb_strlen($title)>9?utf8_substr($title,0,9).'...':$title,
						'imgurl'=>'../../../../common/'.$thumbnail,
						'href'=>$arr[0].'_detail.html?id='.$result[$i]['id']
					);
				}
			}
			break;
		case 'notitle-imgslide':
			if(is_array($result)&&count($result)>0){
				$arr=explode('-',$result[0]['exclusive_name']);
				for($i=0;$i<count($result);$i++){
					$title=$result[$i]['title'];
					$thumbnail=str_replace('.','-140-100-0.',$result[$i]['thumbnail']);
					$json_arr[$i]=array(
						'id'=>$result[$i]['id'],
						//'title'=>mb_strlen($title)>9?utf8_substr($title,0,9).'...':$title,
						//'imgurl'=>'../../../../common/'.$result[$i]['thumbnail'],
						'imgurl'=>'../../../../common/'.$thumbnail,
						'href'=>$arr[0].'_detail.html?id='.$result[$i]['id']
					);
				}
			}
			break;
		case 'list':
			if(is_array($result)&&count($result)>0){
				for($i=0;$i<count($result);$i++){
					$title=$result[$i]['title'];
					$json_arr[$i]=array(
						'id'=>$result[$i]['id'],
						'title'=>mb_strlen($title)>20?utf8_substr($title,0,20).'...':$title,
						'content'=>$result[$i]['content'],
						'add_time'=>$result[$i]['add_time'],
						'brief_ctnt'=>$result[$i]['brief_ctnt'],
						'viewnum'=>$result[$i]['viewnum'],
						'source'=>$result[$i]['source']
					);	
				}
			}
			break;
		case 'updateSituation-list':
			if(is_array($result)&&count($result)>0){
				for($i=0;$i<count($result);$i++){
					$title=$result[$i]['title'];
					$json_arr[$i]=array(
						'id'=>$result[$i]['id'],
						'title'=>mb_strlen($title)>30?utf8_substr($title,0,30).'...':$title,
						'content'=>$result[$i]['content'],
						'add_time'=>$result[$i]['add_time'],
						'brief_ctnt'=>$result[$i]['brief_ctnt'],
						'viewnum'=>$result[$i]['viewnum'],
						'source'=>$result[$i]['source']
					);	
				}
			}
			break;
		case 'notice-list':
			if(is_array($result)&&count($result)>0){
				for($i=0;$i<count($result);$i++){
					$title=$result[$i]['title'];
					$json_arr[$i]=array(
						'id'=>$result[$i]['id'],
						'title'=>mb_strlen($title)>12?utf8_substr($title,0,12).'...':$title,
						'content'=>$result[$i]['content'],
						'add_time'=>$result[$i]['add_time'],
						'brief_ctnt'=>$result[$i]['brief_ctnt'],
						'viewnum'=>$result[$i]['viewnum'],
						'source'=>$result[$i]['source']
					);	
				}
			}
			break;
		case 'right-list':
			if(is_array($result)&&count($result)>0){
				for($i=0;$i<count($result);$i++){
					$title=$result[$i]['title'];
					$json_arr[$i]=array(
						'id'=>$result[$i]['id'],
						'title'=>mb_strlen($title)>12?utf8_substr($title,0,12).'...':$title,
						'content'=>$result[$i]['content'],
						'add_time'=>$result[$i]['add_time'],
						'brief_ctnt'=>$result[$i]['brief_ctnt'],
						'viewnum'=>$result[$i]['viewnum'],
						'source'=>$result[$i]['source']
					);	
				}
			}
			break;
		case 'last-news':
			if(is_array($result)&&count($result)>0){
				$title=$result[0]['title'];
				$content=$result[0]['content'];
				$json_arr[0]['id']=$result[0]['id'];	
				$json_arr[0]['add_time']=$result[0]['add_time'];	
				$json_arr[0]['title']=mb_strlen($title)>15?utf8_substr($title,0,15).'...':$title;
				if(strlen($content)>270){
					$json_arr[0]['content']=utf8_substr($content,0,60);
					$json_arr[0]['flag']=1;
				}else{
					$json_arr[0]['content']=$content;
					$json_arr[0]['flag']=0;
				}
			}
			break;
		case 'both-hotline':
			if(is_array($result)&&count($result)>0){
				$json_arr[0]['id']=$result[0]['id'];	
				$json_arr[0]['add_time']=$result[0]['add_time'];	
				$title=$result[0]['title'];
				$content=$result[0]['content'];
				$json_arr[0]['title']=mb_strlen($title)>25?utf8_substr($title,0,25).'...':$title;
				$json_arr[0]['content']=mb_strlen($content)>20?utf8_substr($content,0,20).'...':$content;
			}
	}
	return json_encode($json_arr);
}


/**
* 获取html
*/
function genHtmlStr($result,$makeType,$filename){
	$htmlstr='';
	switch($makeType){
		case 'notice-list':
			for($i=0;$i<sizeof($result);$i++){
				$title=$result[$i]['title'];
				$tit=mb_strlen($title)>12?utf8_substr($title,0,12).'...':$title;
				$j=$i+1;
				$htmlstr.='<li><a href="../template/'.$filename.'_detail.html?id='.$result[$i]['id'].'" target="_blank" >'.'<<'.' '.$tit.'</a><div style="clear:both;"></div></li>';
			}
			break;
		case 'updateSituation-list':
			for($i=0;$i<sizeof($result);$i++){
				$title=$result[$i]['title'];
				$tit=mb_strlen($title)>28?utf8_substr($title,0,28).'...':$title;
				$j=$i+1;
				$htmlstr.='<li><a href="../template/'.$filename.'_detail.html?id='.$result[$i]['id'].'" target="_blank" >'.'<<'.' '.$tit.'</a><div class="add-time">'.$result[$i]['add_time'].'</div><div style="clear:both;"></div></li>';
			}
			break;
		case 'list':
			for($i=0;$i<sizeof($result);$i++){
				$title=$result[$i]['title'];
				$tit=mb_strlen($title)>15?utf8_substr($title,0,15).'...':$title;
				$j=$i+1;
				$htmlstr.='<li><a href="../template/'.$filename.'_detail.html?id='.$result[$i]['id'].'" target="_blank" >'.'<<'.' '.$tit.'</a><div class="add-time">'.$result[$i]['add_time'].'</div><div style="clear:both;"></div></li>';
			}
			break;
		case 'right-list':
			for($i=0;$i<sizeof($result);$i++){
				$title=$result[$i]['title'];
				$tit=mb_strlen($title)>12?utf8_substr($title,0,12).'...':$title;
				$j=$i+1;
				$htmlstr.='<li><a href="../template/'.$filename.'_detail.html?id='.$result[$i]['id'].'" target="_blank" >'.'<<'.' '.$tit.'</a><div style="clear:both;"></div></li>';
			}
			break;
		case 'hotline-list':
			for($i=0;$i<sizeof($result);$i++){
				$j=$i+1;
				$title=$result[$i]['title'];
				$tit=mb_strlen($title)>28?utf8_substr($title,0,28).'...':$title;
				$content=$result[$i]['content'];
				$cont=mb_strlen($content)>25?utf8_substr($content,0,25).'...':$content;
				$htmlstr.='<li>'.$tit.'<br>'.$cont.'<div style="clear:both;"></div></li>';
			}
			break;
		case 'focusnews-index'://需要改
			$img_large='';
			$img_small='';
			for($i=0;$i<sizeof($result);$i++){
				$str=explode(".",$result[$i]['thumbnail']);
				$str_large=$str[0].'_large'.'.'.$str[1];
				$str_small=$str[0].'_small'.'.'.$str[1];
				$img_large.=($i==0?'':',').'../../../../common/'.$str_large;
				$img_small.=($i==0?'':',').'../../../../common/'.$str_small;
			}
			$htmlstr='<div class="focus-news" bg-arr="'.$img_large.'" thumbnail-arr="'.$img_small.'">';
			$htmlstr.='<div class="slide-img">';
			$htmlstr.='<div class="slide-img-holder">';
			$htmlstr.='<div class="slide-img-holder-l"></div>';
			$htmlstr.='<div class="slide-img-holder-r"></div>';
			$htmlstr.='<div class="clearboth"></div>';
			$htmlstr.='</div>';
			$htmlstr.='</div>';	
			
		  for($i=0;$i<sizeof($result);$i++){
			  $title=utf8_substr($result[$i]['title'],0,15).(strlen($result[$i]['title'])>45?'...':'');
			  $htmlstr.='<div class="slide-txt">';
			  $htmlstr.='<h1>'.$title.'</h1>';
			  $htmlstr.='<div>';
			  $htmlstr.='<p>'.$result[$i]['brief_ctnt'].'</p>';
			  $htmlstr.='<p>'.utf8_substr($result[$i]['content'],0,120).'</p><p style="text-indent:2em;">[<a href="detail.php?id='.$result[$i]['id'].'" target="_blank">详细...</a>]</p>';
			  $htmlstr.='</div>';
			  $htmlstr.='</div>';
		  }
		  $htmlstr.='<div class="clearboth"></div>';
		  $htmlstr.='</div><!--focus-news-->';
        
		  	break;
		case 'banner':
			$htmlstr.='<div class="banner">'."\n";
			$htmlstr.='<div class="banner-holder">'."\n";
			for($i=0;$i<sizeof($result);$i++){
				$htmlstr.='<a href="detail.php?id='.$result[$i]['id'].'" target="_blank" style="background-image:url(../../../../common/'.$result[$i]['thumbnail'].');"></a>'."\n";
			}
			$htmlstr.='<div class="clearboth"></div>'."\n";
			$htmlstr.='</div>'."\n";
			$htmlstr.='</div><!--banner-->'."\n";
			$htmlstr.='<div class="banner-intro">'."\n";
			for($i=0;$i<sizeof($result);$i++){
				$bannerswitch.='<a href="javascript:void(0);"></a>';
				$htmlstr.='<div>';
				$htmlstr.='<h1>'.$result[$i]['title'].'</h1>';
				$htmlstr.='<p>'.utf8_substr($result[$i]['content'],0,50).'</p>';
				$htmlstr.='</div>';
			}
			$htmlstr.=' </div><!--banner-intro-->';
			$htmlstr.=' <div class="banner-switch">'.$bannerswitch.'</div>';
			break;
		case 'notice':
			$htmlstr=$result[0]['content'];
			break;
		case 'focusnews-catlist':
			$htmlstr='<div class="focusnews">';
			$htmlstr.='<div class="focusnews-img">';
			for($i=0;$i<sizeof($result);$i++){
				$switchbutton.='<a href="javascript:void(0);"></a>';
				$txt.=($i==0?'':',').$result[$i]['title'];
				$str=explode(".",$result[$i]['thumbnail']);
				$htmlstr.='<a href="detail.php?id='.$result[$i]['id'].'" target="_blank" style="background-image:url('.('../../../../common/'.$str[0].'_large'.'.'.$str[1]).');"></a>';
			}
			$htmlstr.='</div>';
			$htmlstr.='<div class="focusnews-txt">';
			$htmlstr.='<div class="focusnews-txt-bg"></div>';
			$htmlstr.='<div class="focusnews-txt-text" txt="'.$txt.'"></div>';
			$htmlstr.='</div>';
			$htmlstr.=' <div class="focusnews-btn">'.$switchbutton.'</div>';
			$htmlstr.='</div><!--focusnews-->';
			break;
		case 'txt-source':
			$htmlstr='<ul class="ui-listitem-l">';
			for($i=0;$i<sizeof($result);$i++){
				$title=utf8_substr($result[$i]['title'],0,32).(strlen($result[$i]['title'])>96?'...':'');
				$htmlstr.='<li><a href="'.($result[$i]['link']==''?'detail.php?id='.$result[$i]['id']:$result[$i]['link']).'" target="_blank" class="ui-listitem-l-l">'.$title.'</a><span class="ui-listitem-l-r">'.$result[$i]['source'].'</span><span class="clearboth"></span></li>';
			}
			$htmlstr.='</ul><!--ui-listitem-l-->';
			break;
		case 'txt-time':
			$htmlstr='<ul class="ui-listitem-l">';
			for($i=0;$i<sizeof($result);$i++){
				$title=utf8_substr($result[$i]['title'],0,32).(strlen($result[$i]['title'])>96?'...':'');
				$htmlstr.='<li><a href="'.($result[$i]['link']==''?'detail.php?id='.$result[$i]['id']:$result[$i]['link']).'" target="_blank" class="ui-listitem-l-l">'.$title.'</a><span class="ui-listitem-l-r">'.$result[$i]['add_time'].'</span><span class="clearboth"></span></li>';
			}
			$htmlstr.='</ul><!--ui-listitem-l-->';
			break;
		case 'imgslide':
			$htmlstr='<div class="hlui-imgrotate" id="img-rotate-'.$id.'"><div class="ui-imgrotate-button-l"><a href="javascript:void(0);"></a></div><div class="ui-imgrotate-holder"><div class="ui-imgrotate-holder-slide">';
			for($i=0;$i<sizeof($result);$i++){
				$title=utf8_substr($result[$i]['title'],0,9).(strlen($result[$i]['title'])>27?'...':'');
				$str=explode(".",$result[$i]['thumbnail']);
				$htmlstr.='<div class="ui-imgrotate-block">';
				$htmlstr.='<a href="'.($result[$i]['link']==''?'detail.php?id='.$result[$i]['id']:$result[$i]['link']).'" target="_blank" class="ui-imgrotate-block-holder">';
				$htmlstr.='<div class="ui-imgrotate-block-img"><div class="ui-imgrotate-block-img-holder" style="background-image:url('.('../../../../common/'.$str[0].'_small'.'.'.$str[1]).');"></div></div>';
				$htmlstr.='<div class="ui-imgrotate-block-title">'.$title.'</div>';
				$htmlstr.='<div class="ui-imgrotate-block-intro">'.'&nbsp;'.'</div>';
				$htmlstr.='</a>';
				$htmlstr.='</div><!--ui-imgrotate-block-->';
			}
			$htmlstr.='<div class="ui-imgrotate-clear"></div></div></div><!--ui-imgrotate-holder--><div class="ui-imgrotate-button-r"><a href="javascript:void(0);"></a></div><div class="ui-imgrotate-clear"></div></div><!--hlui-imgrotate-->';
			break;
		case 'notitle-imgslide':
			$htmlstr='<div class="hlui-imgrotate" id="img-rotate-'.$id.'"><div class="ui-imgrotate-button-l"><a href="javascript:void(0);"></a></div><div class="ui-imgrotate-holder"><div class="ui-imgrotate-holder-slide">';
			for($i=0;$i<sizeof($result);$i++){
				$title=utf8_substr($result[$i]['title'],0,9).(strlen($result[$i]['title'])>27?'...':'');
				$str=explode(".",$result[$i]['thumbnail']);
				$htmlstr.='<div class="ui-imgrotate-block">';
				$htmlstr.='<a href="'.($result[$i]['link']==''?'detail.php?id='.$result[$i]['id']:$result[$i]['link']).'" target="_blank" class="ui-imgrotate-block-holder">';
				$htmlstr.='<div class="ui-imgrotate-block-img"><div class="ui-imgrotate-block-img-holder" style="background-image:url('.('../../../../common/'.$str[0].'_small'.'.'.$str[1]).');"></div></div>';
				if($title!=''&&$title!=null){
					$htmlstr.='<div class="ui-imgrotate-block-title">'.$title.'</div>';
				}
				$htmlstr.='<div class="ui-imgrotate-block-intro">'.'&nbsp;'.'</div>';
				$htmlstr.='</a>';
				$htmlstr.='</div><!--ui-imgrotate-block-->';
			}
			$htmlstr.='<div class="ui-imgrotate-clear"></div></div></div><!--ui-imgrotate-holder--><div class="ui-imgrotate-button-r"><a href="javascript:void(0);"></a></div><div class="ui-imgrotate-clear"></div></div><!--hlui-imgrotate-->';
			break;
		case 'img-txt':
			$htmlstr='<div class="imgNlistblock">';
			for($i=0;$i<sizeof($result);$i++){
				$title=utf8_substr($result[$i]['title'],0,9).(strlen($result[$i]['title'])>27?'...':'');
				$str=explode(".",$result[$i]['thumbnail']);
				if($i<sizeof($result)-1){
					$htmlstr.='<div class="imgNlistblock-left-block">';
				}else{
					$htmlstr.='<div class="imgNlistblock-left-block" style="margin-bottom:0;"><!--最后一个加  style="margin-bottom:0;"-->';
				}
				$htmlstr.='<a href="'.($result[$i]['link']==''?'detail.php?id='.$result[$i]['id']:$result[$i]['link']).'" target="_blank">';
				$htmlstr.='<div class="imgNlistblock-left-img"><img src="'.('../../../../common/'.$str[0].'_small'.'.'.$str[1]).'" width="138" height="90" /></div>';
				$htmlstr.='<div class="imgNlistblock-left-title">'.$title.'</div>';
				$htmlstr.='<div class="imgNlistblock-left-intro">'.'&nbsp;'.'</div>';
				$htmlstr.='</a>';
				$htmlstr.='</div><!--imgNlistblock-left-block-->';
			}
			$htmlstr.='<div style="clear:both;"></div></div>';
			break;
		case 'txt':
		/*	$htmlstr='<ul class="ui-listitem-r">';
			for($i=0;$i<sizeof($result);$i++){
				$title=utf8_substr($result[$i]['title'],0,9).(strlen($result[$i]['title'])>9?'...':'');
				$htmlstr.='<li><a href="'.($result[$i]['link']==''?'detail.php?id='.$result[$i]['id']:$result[$i]['link']).'" target="_blank">'.$title.'</a></li>';
			}
			$htmlstr.='</ul>';
		*/
			for($i=0;$i<sizeof($result);$i++){
				//$title=utf8_substr($result[$i]['title'],0,6).(strlen($result[$i]['title'])>24?'...':'');
				$title=(strlen($result[$i]['title'])>24?utf8_substr($result[$i]['title'],0,6).'...':utf8_substr($result[$i]['title'],0,8));
				$htmlstr.='<div class="institution"><a href="../template/'.$filename.'_detail.html?id='.$result[$i]['id'].'" target="_blank">'.$title.'</a></div>';
			}
				break;
		case 'img':
			$str=explode(".",$result[0]['thumbnail']);
			$htmlstr='<div class="imgitem"><div class="imgitem-img"><img src="'.('../../../../common/'.$str[0].'_small'.'.'.$str[1]).'" width="182" height="128" /></div><div class="imgitem-txt"><a href="detail.php?id='.$result[0]['id'].'">'.$result[0]['brief_title'].'</a></div></div><!--imgitem-->';
			break;
		case 'video':
			$htmlstr='<div id="mp4" mp4src="../../../../common/'.$result[0]['file_path'].'"></div><div class="video-title"><a href="detail.php?id='.$result[0]['id'].'" target="_blank">'.$result[0]['title'].'</a></div>';
			break;
		case 'special-block':
			for($i=0;$i<sizeof($result);$i++){
				$str=explode(".",$result[$i]['thumbnail']);
				$htmlstr.='<div class="special-block">';
				$htmlstr.='<a href="'.($result[$i]['link']==''?'detail.php?id='.$result[$i]['id']:$result[$i]['link']).'" target="_blank">';
				$htmlstr.='<div class="special-block-l"><img src="'.('../../../../common/'.$str[0].'_small'.'.'.$str[1]).'" width="100" height="75" /></div>';
				$htmlstr.=' <div class="special-block-r">';
				$htmlstr.='<h1>'.$result[$i]['title'].'</h1>';
				$htmlstr.='<div>'.utf8_substr($result[$i]['content'],0,30).(strlen($result[$i]['content'])>90?'...':'').'</div>';
				$htmlstr.='</div>';
				$htmlstr.='<div class="clearboth"></div>';
				$htmlstr.='</a>';
				$htmlstr.='</div><!--special-block-->';
			}
			break;
		case 'txt-more':
			$htmlstr='<ul>';
			for($i=0;$i<sizeof($result);$i++){
				$title=utf8_substr($result[$i]['title'],0,9).(strlen($result[$i]['title'])>27?'...':'');
				$htmlstr.='<li><a href="'.($result[$i]['link']==''?'detail.php?id='.$result[$i]['id']:$result[$i]['link']).'" target="_blank">'.$title.'</a></li>';
			}
			$htmlstr.='<li><a href="search.php?type=4&key=" target="_blank">更多...</a></li>';
			$htmlstr.='</ul>';
			break;
		case 'link-img':
			for($i=0;$i<sizeof($result);$i++){
				$htmlstr.='<a href="'.$result[$i]['exclusive_name'].'_detail.html?id='.$result[$i]['id'].'" target="_blank"><img src="../../../../common/'.$result[$i]['thumbnail'].'" width="210" height="48" /></a><br>';
			}
			break;
		case 'link-txt':
			for($i=0;$i<sizeof($result);$i++){
				$title=utf8_substr($result[$i]['title'],0,6).(strlen($result[$i]['title'])>20?'...':'');
				$htmlstr.='<div class="institution"><a href="'.$result[$i]['link'].'" target="_blank">'.$title.'</a></div>';
			}
			break;//专题主题
		case 'topic-Theme':
			$htmlstr.=$result[0]['content'];
			break;//历届回顾
		case 'topic-history':
			for($i=0;$i<sizeof($result);$i++){
				$htmlstr.='<div class="review-list-item-block"  onclick="show_detail('.$result[$i]['id'].',\'txt\');"><div class="review-list-item-block-pic">';
				if(empty($result[$i]['thumbnail'])){
					$htmlstr.='</div>';
				}else{
					$htmlstr.='<img src="../../../../common/"'.$result[$i]['thumbnail'].'/></div>';
				}
				$htmlstr.='<div class="review-list-item-block-title">'.$result[$i]['title'].'</div><div class="review-list-item-block-intro"><p>'.$result[$i]['content'].'</p></div></div>';
			}
			$htmlstr.='<div style="clear:both;"></div>';
			break;//专题活动快讯
		case 'topic-activity':
			for($i=0;$i<sizeof($result);$i++){
				$htmlstr.='<div class="list-content-block" onclick="show_detail('.$result[$i]['id'].',\'txt\');"><div class="pic">';
				if(empty($result[$i]['thumbnail'])){
					$htmlstr.='</div>';
				}else{
					$htmlstr.='<img src="../../../../common/"'.$result[$i]['thumbnail'].'/></div>';	
				}
				$htmlstr.='<div class="title">'.$result[$i]['title'].'</div><div class="intro">'.$result[$i]['content'].'</div></div>';
			}
			$htmlstr.='<div style="clear:both;"></div>';
			break;//专题精彩纷呈
		case 'topic-wonderful':
			for($i=0;$i<sizeof($result);$i++){
				if(strpos($result[$i]['exclusive_name'], 'video') !== false){
					$htmlstr.='<div class="wonderful-video-list-item-block"  onclick="show_detail('.$result[$i]['id'].',\'video\');">';
				}else{
					$htmlstr.='<div class="wonderful-pic-list-item-block" onclick="show_detail('.$result[$i]['id'].',\'pic\');">';
				}
				$htmlstr.='<div class="title">'.$result[$i]['title'].'</div><div class="title-bg">';
				if(empty($result[$i]['thumbnail'])){
					$htmlstr.='</div></div>';
				}else{
					$htmlstr.='<img src="../../../../common/"'.$result[$i]['thumbnail'].'/></div></div>';	
				}
			}
			$htmlstr.='<div style="clear:both;"></div>';
			break;//专题活动介绍指南
		case 'topic-intr-guide':
				$htmlstr.='<p>'.$result[0]['content'].'</p>';
			break;//大赛获奖名单
		case 'topic-banner':
				$htmlstr.='<p>'.$result[0]['content'].'</p>';
			break;
		case 'txt-txt':
			for($i=0;$i<sizeof($result);$i++){
				$title=utf8_substr($result[$i]['title'],0,30).(strlen($result[$i]['title'])>90?'...':'');
				$htmlstr.='<div style="'.($i>0?'border-top:1px dashed #ccc; padding-top:10px;':'').' font-size:12px;"><div style=" line-height:24px;"><a href="'.($result[$i]['link']==''?'detail.php?id='.$result[$i]['id']:$result[$i]['link']).'" target="_blank">'.$title.'</a></div><div style="color:#000;">'.utf8_substr($result[$i]['comment'],0,120).'</div><div style=" text-align:right; line-height:20px;">'.$result[$i]['user_name'].'</div></div>';
			}
			break;
		default:;
	}
	return $htmlstr;
}


function utf8_substr($str,$start,$end) {
	$str=clearStr($str);
	$null = "";
   preg_match_all("/./u", $str, $ar);
   if(func_num_args() >= 3) {
       $end = func_get_arg(2);
       return join($null, array_slice($ar[0],$start,$end));
   } else {
       return join($null, array_slice($ar[0],$start));
   }
}

function clearStr($str){
	return str_replace('&nbsp;','',str_replace("\r\n",'',str_replace(' ','',strip_tags($str))));
}

?>