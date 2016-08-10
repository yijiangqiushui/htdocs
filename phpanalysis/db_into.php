
<?php
//进行查重的操作
global $filename;
$filename = $_REQUEST['file'];
//获取文件名
// echo realpath("./".$filename);
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
$do_multi = $do_prop = $pri_dict = false;


$word = new COM("word.application") or die ("Could not initialise MS Word object.");
$word->Documents->Open(realpath("./".$filename));

// Extract content.
global $teststr;
$teststr = (string) $word->ActiveDocument->Content;
$teststr = iconv( 'gbk','utf-8', $teststr);

// echo $teststr;
$word->ActiveDocument->Close(false);

$word->Quit();
$word = null;
unset($word);

/* if($str != '')
{ */
    //岐义处理
    $do_fork = empty($_POST['do_fork']) ? false : true;
    //新词识别
    $do_unit = empty($_POST['do_unit']) ? false : true;
    //多元切分
    $do_multi = empty($_POST['do_multi']) ? false : true;
    //词性标注
    $do_prop = empty($_POST['do_prop']) ? false : true;
    //是否预载全部词条
    $pri_dict = empty($_POST['pri_dict']) ? false : true;
    
    $tall = microtime(true);
    
    //初始化类
    PhpAnalysis::$loadInit = false;//初始化PhpAnalysis的静态变量loadInit
    $pa = new PhpAnalysis('utf-8', 'utf-8', $pri_dict);
    print_memory('初始化对象', $memory_info);
    
    //载入词典
    $pa->LoadDict();
    print_memory('载入基本词典', $memory_info);    
        
    //执行分词
    $pa->SetSource($teststr);
    $pa->differMax = $do_multi;
    $pa->unitWord = $do_unit;
    
    $pa->StartAnalysis( $do_fork );
    print_memory('执行分词', $memory_info);
/*     

    global  $num;
    $conn2 = mysql_connect("localhost","root","") or die("你的数据库连接错误");
    mysql_select_db("check",$conn2);
    $sql = "select count(*) as total from articles";
    $rs = mysql_query($sql, $conn2);
    $count=mysql_fetch_array($rs);
    $num = $count['total'];   
    mysql_close($conn2); */
    $okresult = $pa->GetFinallyResult(' ', $do_prop);
    $okresult = urlencode($okresult);
    //过滤标点符号
    $okresult = preg_replace("/(%7E|%E3%80%81|%E3%80%82|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1)+/",'',$okresult);
    $okresult = urldecode($okresult);
    $array = explode(" ",$okresult);
    /*      foreach($array as $tmp){
     echo $tmp.'<br />';
    } */
    //去重
//     echo "fghhfh".$array[0]."dgfhdgh";
    $array_unq = array_unique($array);
    //将数据进行入库的操作
    $con = mysql_connect("localhost","root","") or die ("你的数据库连接错误");
    mysql_select_db("check", $con);
    foreach($array_unq as $tmp){
        if(!empty($tmp))
        {
            $val = strpos($teststr, $tmp);
            $exec="insert into checkarticles (checkName,article_id,offset) values ('".$tmp."','".$filename."','".$val."')";
            mysql_query("SET NAMES UTF-8");
            mysql_query($exec, $con);
        }
    }
    
    $exec1 = "update articles set db_into = 0 where db_into = 1";
    mysql_query($exec1, $con);
    mysql_close($con);
//     echo "33333333";
    
    //将article里面的内容
    

/*     print_memory('输出分词结果', $memory_info);
    
    $pa_foundWordStr = $pa->foundWordStr;
    
    $t2 = microtime(true);
    $endtime = sprintf('%0.4f', $t2 - $t1);
    
    $slen = strlen($str);
    $slen = sprintf('%0.2f', $slen/1024);
    
    $pa = '';  */
// }
?>


