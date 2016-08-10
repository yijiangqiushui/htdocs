<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2010/06/12
************************************************************************************************************/

class excel{
	private $_name='';
	
	function excel($name){
		$this->_name=$name;
	}
	
	function create($data,$title=''){
		
		header('Pragma:public');
		header('Pragma:no-cache');
		header('Expires:0');
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Accept-Ranges:bytes");
		header("Content-Type: application/download");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition:attachment;filename='.$this->_name);
		
		if($title!=''){
			echo str_replace(',',"\t",$title)."\n";
		}
		
		foreach($data as $k=> $v){
			foreach($v as $lk=>$lv){
				echo iconv('utf-8','gb2312',$lv)."\t";
			}
			echo "\n";
		}
		
	}
	
	function read($sheet,$rows=0,$cols=10){
		
	}
}

/**
* Example
*

$excel=new excel('test.xls');

$title='name,gender,major';

$student=array(
	array('小李',19,'jisuanji'),
	array('小张',18,'jisuanji'),
	array('xiao liu',19,'jisuanji'),
	array('xiao yuan',20,'计算机'),
	array('xiao wu',20,'jisuanji'),
	array('xiao zhu',18,'jisuanji'),
);

$excel->create($student,$title);
*/
?>