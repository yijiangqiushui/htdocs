
<?php
global $filename;
$filename = $_REQUEST['file'];
//获取文件名
/* 
// 严格开发模式
ini_set('display_errors', 'On');
ini_set('memory_limit', '64M');
error_reporting(E_ALL);

$t1 = $ntime = microtime(true);
$endtime = '未执行任何操作，不统计！';
function print_memory($rc, &$infostr)
{
    global $ntime;
    $cutime = microtime(true);
    $etime = sprintf('%0.4f', $cutime - $ntime);
    $m = sprintf('%0.2f', memory_get_usage()/1024/1024);
    $infostr .= "{$rc}: &nbsp;{$m} MB 用时：{$etime} 秒<br />\n";
    $ntime = $cutime;
}

header('Content-Type: text/html; charset=utf-8');
$memory_info = '';
print_memory('没任何操作', $memory_info);

require_once 'phpanalysis.class.php';

 $str = (isset($_POST['source']) ? $_POST['source'] : '');

$loadtime = $endtime1  = $endtime2 = $slen = 0;

$do_fork = $do_unit = true;
$do_multi = $do_prop = $pri_dict = false; */
$str = (isset($_POST['source']) ? $_POST['source'] : '');
echo $str;


$word = new COM("word.application") or die ("Could not initialise MS Word object.");
$word->Documents->Open(realpath("./".$filename));
$realpaths = (string)realpath("./".$filename);

$realpaths = str_replace("\\","\\\\",$realpaths);

// Extract content.
global $teststr;
$teststr = (string) $word->ActiveDocument->Content;
$teststr = iconv( 'gbk','utf-8', $teststr);


$word->ActiveDocument->Close(false);

$word->Quit();
$word = null;
unset($word);

/* if($str != '')
  { */
//     //岐义处理
//     $do_fork = empty($_POST['do_fork']) ? false : true;
//     //新词识别
//     $do_unit = empty($_POST['do_unit']) ? false : true;
//     //多元切分
//     $do_multi = empty($_POST['do_multi']) ? false : true;
//     //词性标注
//     $do_prop = empty($_POST['do_prop']) ? false : true;
//     //是否预载全部词条
//     $pri_dict = empty($_POST['pri_dict']) ? false : true;
    
//     $tall = microtime(true);
    
//     //初始化类
//     PhpAnalysis::$loadInit = false;//初始化PhpAnalysis的静态变量loadInit
//     $pa = new PhpAnalysis('utf-8', 'utf-8', $pri_dict);
//     print_memory('初始化对象', $memory_info);
    
//     //载入词典
//     $pa->LoadDict();
//     print_memory('载入基本词典', $memory_info);    
        
//     //执行分词
//     $pa->SetSource($str);
//     $pa->differMax = $do_multi;
//     $pa->unitWord = $do_unit;
    
//     $pa->StartAnalysis( $do_fork );
//     print_memory('执行分词', $memory_info);
   $randnum = rand(1,10000);
//     //截取标题文字
    // $title_start = mb_strpos($teststr,"项目名称：");
    // $title_end = mb_strpos($teststr,"所属领域：");
    // $title = mb_substr($teststr,$title_start + mb_strlen("项目名称："),$title_end-$title_start-mb_strlen("所属领域："));
$title = "项目名称".$randnum;

//     // echo  $title;
    //截取所属领域
    // $domain_start = mb_strpos($teststr,"所属领域：");
    // $domain_end = mb_strpos($teststr,"项目承担单位：");
    // $domain = mb_substr($teststr,$domain_start + mb_strlen("所属领域："),$domain_end - $domain_start - mb_strlen("项目承担单位："));
$domain = "所属领域".$randnum;

//     //echo  $domain;
    //截取项目承担单位
    // $org_start = mb_strpos($teststr,"项目承担单位：");
    // $org_end = mb_strpos($teststr,"区科委主管科室：");
    // $org = mb_substr($teststr, $org_start + mb_strlen("项目承担单位："), $org_end - $org_start - mb_strlen("项目承担单位："));
$org = "承担单位".$randnum;

//     // echo  $org;
//     //对标题等基本信息入库
    $conn1 = mysql_connect("localhost","root","") or die("你的数据库连接错误");
    mysql_select_db("check",$conn1);
    
    $exce1 = "insert into article_overview (article_id,path,title,domain,org,db_into) values ('".$filename."','".$realpaths."','".$title."','".$domain."','".$org."','0')";
    $excel1= "insert into article_content(article_id,content) values('".$filename."','".$teststr."')";
//     $excel3= "select path from article_overview";
    mysql_query("SET NAMES UTF-8");
    mysql_query($exce1,$conn1);
    mysql_query($excel1,$conn1);
//     $path = mysql_query($excel3,$conn1);
//     $result = mysql_fetch_array($path);
    $pa = $result['path']; 
//     echo $pa.'asdfdasdasdasds'.'<br/>';
    mysql_close($conn1);
//     global  $num;
//     $sql = "select count(*) as total from articles";
//     $rs = mysql_query($sql, $conn1);
//     $count=mysql_fetch_array($rs);
//     $num = $count['total'];   
//     mysql_close($conn1);
//     $okresult = $pa->GetFinallyResult(' ', $do_prop);

//     $okresult = urlencode($okresult);
//     //过滤标点符号
//     $okresult = preg_replace("/(%7E|%E3%80%81|%E3%80%82|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1)+/",'',$okresult);
//     $okresult = urldecode($okresult);
//     $array = explode(" ",$okresult);
//     /*      foreach($array as $tmp){
//      echo $tmp.'<br />';
//     } */
//     //去重
//     $array_unq = array_unique($array);
//     //查重开始////////////////////////////////////////////////
//     $conn2 = mysql_connect("localhost","root","");
//     mysql_select_db("check",$conn2);
//     $dup_num = 0.0;
//     foreach($array_unq as $tmp){
//         $var = "select * from checkarticles where checkName = '".$tmp."'";
//         $checkname = mysql_query($var,$conn2);
//         $tmp1 = mysql_fetch_array($checkname);
// //         echo $tmp1[0]."heheh"."<br/>";
//         if(!empty($tmp1)){
//             $dup_num = $dup_num + 1;
//         }
//     }

//     //输出查重结果
//     echo "查重率为:".($dup_num / count($array_unq)*100)."%";

//     print_memory('输出分词结果', $memory_info);
    
//     $pa_foundWordStr = $pa->foundWordStr;
    
//     $t2 = microtime(true);
//     $endtime = sprintf('%0.4f', $t2 - $t1);
    
//     $slen = strlen($str);
//     $slen = sprintf('%0.2f', $slen/1024);
    
//     $pa = ''; 
// }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查新系统</title>
</head>
<body>
<table width='90%' align='center'>
<tr>
    <td>    

<hr size='1' />

<form id="form1" name="form1" method="post" action="check_result.php?file=<?php echo $filename;?>">
  <b>源文本：</b>&nbsp; <br/>
   <textarea name="source" style="width:98%;height:150px;font-size:14px;"><?php echo $teststr;?></textarea>
    <br/>
    <input type="submit" name="Submit" value="开始查重" />
</form>
<br />
</td>
</tr>
</table>
</body>
</html>