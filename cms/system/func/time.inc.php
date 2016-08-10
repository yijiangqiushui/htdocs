<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

/**
* 获取某年某个月的天数
**/
function GetMonDays($year,$month){
	$days=0;
	switch($month){
		case 1:
		case 3:
		case 5:
		case 7:
		case 8:
		case 10:
		case 12:$days=31;break;
		case 4:
		case 6:
		case 9:
		case 11:$days=30;break;
		default:
		if(($year%4==0&&$year%100!=0) || $year%400==0)
			$days=28;
		else
			$days=29;
	}
	return $days;
}

/**
* 比较两个时间差
**/
function DateDiff($d1,$d2){ 
	 if(is_string($d1))
	 	$d1=strtotime($d1);
	 if(is_string($d2))
	 	$d2=strtotime($d2);
	 return ($d2-$d1); //这里返回的是秒值，如果除以3600就是返回小时了，依此类推
}
?>