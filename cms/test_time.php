<?php

/** 获取当前时间戳，精确到毫秒 */
function microtime_float()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

/** 格式化时间戳，精确到毫秒，x代表毫秒 */
function microtime_format($tag, $time)
{
   list($usec, $sec) = explode(".", $time);
   $date = date($tag,$usec);
   return str_replace('x', $sec, $date);
}

//使用方法：
//1. 获取当前时间戳(精确到毫秒)：microtime_float()
//2. 时间戳转换时间：microtime_format('Y年m月d日 H时i分s秒 x毫秒', 1270626578.
$nowtimeInt = microtime_float();
$nowtime = microtime_format('Y-m-d_H:i:s_x', $nowtimeInt);//切记这个不要有空格
?>

<?php

/*!-- IMEI用户标识码 end --*/
echo $time."-----".$nowtime;

//时间请参考：http://www.cnblogs.com/glory-jzx/archive/2012/09/29/2708396.html
?>

