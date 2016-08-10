<?php
//进行查重的操作
global $filename;
$threshold = 0.4;  //控制查重的阈值的！
  
					//停用词列表
$array_forbidden=array("领域","承担","单位", "项目", "名称", "技术", "方案", "所属","公司");

$changeHide_num=0;

function containRedKey($tmptmp){
if(strstr($tmptmp,"<")||strstr($tmptmp,"s")||strstr($tmptmp,"p")||strstr($tmptmp,"a")||strstr($tmptmp,"n")||strstr($tmptmp,"c")||strstr($tmptmp,"l")||strstr($tmptmp,"s")||strstr($tmptmp,"=")||strstr($tmptmp,"'")||strstr($tmptmp,"r")||strstr($tmptmp,"e")||strstr($tmptmp,"d")||strstr($tmptmp,"t")||strstr($tmptmp,"x")||strstr($tmptmp,"'")||strstr($tmptmp,">")||strstr($tmptmp,"/"))
    return 1;
else
    return 0;
}

function getmicrotime() {  
    list($usec, $sec) = explode(" ",microtime());  
    return ((float)$usec + (float)$sec);  
}  
// 就页面加载开始的时间
$time_start_loadPage = getmicrotime();  

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

header('Content-Type: text/html; charset=utf-8');//200拍下00
$memory_info = '';
print_memory('没任何操作', $memory_info);

require_once 'phpanalysis.class.php';

// $str = (isset($_POST['source']) ? $_POST['source'] : '');

$loadtime = $endtime1  = $endtime2 = $slen = 0;

$do_fork = $do_unit = true;
$do_multi = $do_prop = $pri_dict = false;


$word = new COM("word.application") or die ("Could not initialise MS Word object.");
$word->Documents->Open(realpath("./".$filename));  //路径

// Extract content.
global $teststr;
$teststr = (string) $word->ActiveDocument->Content;
$teststr = iconv( 'gbk','utf-8', $teststr);//这里是解决中文编码问题


//echo "~~~~~".$teststr;

$word->ActiveDocument->Close(false);

$word->Quit();
$word = null;
unset($word);
global $array;
global $array_unq;

// if($str != '')
// {
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
        $OriginContent = $teststr;
    $teststr = str_replace(array("\r\n", "\n", "\r","。","？","！","?","!"), '#', $teststr);
    $teststr = str_replace(array("#####","####","###","##"), '#', $teststr);
    // echo "<hr>";    //print_r($teststr);    echo "<hr>";
    //执行分词
    $mystr=$teststr;
    
    $OriginContent_array=explode("#",$mystr);

   // echo $mystr;
    $pa->SetSource($teststr);
    $pa->differMax = $do_multi;
    $pa->unitWord = $do_unit;
    
    $pa->StartAnalysis( $do_fork );
    print_memory('执行分词', $memory_info);
    

    global  $num;
    $okresult = $pa->GetFinallyResult(' ', $do_prop);
    
    $okresult = urlencode($okresult);
    //过滤标点符号
   // echo urlencode(" ");
    $okresult = preg_replace("/(%7E|%E3%80%81|%E3%80%82|%60|%21|%40|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1)+/",'',$okresult);
    $okresult = urldecode($okresult);

//为毛入库还有##啊~！！！ 然并卵！ 自从97行替换之后，再次替换一次吧。 确实被查文章，真的有##存在。 我估计是116行替换为空的原因。让两个#在一起了
    // $okresult = str_replace(array("#####","####","###","##"), '#', $okresult);

   // echo $okresult;
    $array = explode(" ",$okresult);  //这是没有任何符号的，分过词的数组
    // echo "<hr>";     //print_r($array);     echo "<hr>";

        
    $val=0;
//  ----start！伟大入库开始！ -----------记录开始时间，可以放到if里面-------------
$time_start_insert_word_DB = getmicrotime();    
//分词入库   ---- 插入一个sentence
    if(isset($_POST["Submit1"])){
 
        $con = mysql_connect("localhost","root","") or die ("你的数据库连接错误");
        mysql_select_db("check", $con);
       // echo "erwe-------=======-------------we";
        $pos_sentence = 1;
        $pos_sentence_tmp =1;
        $exec_str="";
// 为了让#所在的词或者#处于的句子是前一个句子，而不是后一个句子。添加了一个变量$pos_sentence_tmp实现了推迟sentence+1
        foreach($array as $tmp){            // 这里有一个bug， 他们只入库 $array_unq， 每个词出现的第一个位置，没有记录 出现的后面的位置。
            if(!empty($tmp))
            {

//   2015-11-28 遇到 #在 字前面的问题，比如#2015年  需要分2次插入。 再比如： 故事# 就不用处理。    	
if(strstr($tmp,'#') && strstr($tmp,'#')!='#')
 {
     $tmp = str_replace('#', '&#&', $tmp);  
     $array_tmp = explode('&', $tmp );
     // //print_r($array_tmp);
     foreach($array_tmp as $tmp2){
            if(!empty($tmp2))
            {
                if(strstr($tmp2,'#')) 
                    {
                        $pos_sentence_tmp=$pos_sentence+1; 
// 为了让#所在的词或者#处于的句子是前一个句子，而不是后一个句子。添加了一个变量$pos_sentence_tmp实现了推迟sentence+1
                    }else{
                        if($pos_sentence_tmp!=$pos_sentence) $pos_sentence=$pos_sentence_tmp;
                    }
                    $val = mb_strpos($teststr, $tmp2,$val);  // 这个bug彻底解决了，$val作为上一个pos位置，终于再次作为offset偏置量 mb_strpos ( string $haystack , string $needle [, int $offset = 0]  )
             //@朱俭  查找某个字符在指定的字符串中所有出现的位置.. http://blog.csdn.net/lansexingkong/article/details/6297511

                    $article_sentence = substr($filename, 0, stripos($filename,"."))+$pos_sentence*0.0001; 
                    if($exec_str==""){
                     $exec_str=$exec_str."('".$tmp2."','".$filename."','".$val."',".$pos_sentence.",".$article_sentence.")";
                     }else{
                      $exec_str=$exec_str.",('".$tmp2."','".$filename."','".$val."',".$pos_sentence.",".$article_sentence.")";
                                    }                            
                  }  // end  if(strstr($tmp2,'#')) 
            } //end foreach
 }//end if
else{
	                if(strstr($tmp,'#')) 
	                    {
	                        $pos_sentence_tmp=$pos_sentence+1; 
	// 为了让#所在的词或者#处于的句子是前一个句子，而不是后一个句子。添加了一个变量$pos_sentence_tmp实现了推迟sentence+1
	                    }else{
	                        if($pos_sentence_tmp!=$pos_sentence) $pos_sentence=$pos_sentence_tmp;
	                    }
	                $val = mb_strpos($teststr, $tmp,$val);  // 这个bug彻底解决了，$val作为上一个pos位置，终于再次作为offset偏置量 mb_strpos ( string $haystack , string $needle [, int $offset = 0]  )
	 //@朱俭  查找某个字符在指定的字符串中所有出现的位置.. http://blog.csdn.net/lansexingkong/article/details/6297511

	$article_sentence = substr($filename, 0, stripos($filename,"."))+$pos_sentence*0.0001; 
	        if($exec_str==""){
	         $exec_str=$exec_str."('".$tmp."','".$filename."','".$val."',".$pos_sentence.",".$article_sentence.")";
	     }else{
	          $exec_str=$exec_str.",('".$tmp."','".$filename."','".$val."',".$pos_sentence.",".$article_sentence.")";
	                        }
}//else

            } // end if(!empty($tmp))
         //   echo "=========".$pos_sentence;
        }
        $exec="insert into check_articles (checkName,article_id,offset,sentence,article_sentence) values ".$exec_str.";";
 echo $exec;
        mysql_query("SET NAMES UTF-8");
        mysql_query($exec, $con);
 
// $exec1 = "insert into check_articles (checkName,article_id,offset,sentence,article_sentence) values ('1','1','1','1','1')";

        $exec1 = "update article_overview set db_into = 0 where db_into = 1";
        mysql_query($exec1, $con);
        mysql_close($con);
//     }

/* 
    print_memory('输出分词结果', $memory_info);
    
    $pa_foundWordStr = $pa->foundWordStr;
    
    $t2 = microtime(true);
    $endtime = sprintf('%0.4f', $t2 - $t1);
    
    $slen = mb_substr($str);
    $slen = sprintf('%0.2f', $slen/1024);
    
    $pa = '';  */
}
// 入库完成！！
$time_end_insert_word_DB = getmicrotime(); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>

<meta
 http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style 
type="text/css">
.redtxt{
  color:#F00;
  font-size:14px;
  /* font-style:italic; */
  font-weight:bolder;
}

.str{

	style="width:50%;
}
body{
    width: 1000px;
    height: 1000px;
    margin: 0 auto;
    font-family: 微软雅黑;
}
.clc{
    font-size: 16px;
    cursor: pointer;
}
.left{
    height: 1000px;
    width: 450px;
    line-height: 150%;
    font-size: 16px;
    float: right;
    background:#efefef;    
}
.right{
    font-size: 14px;
    height: 1000px;
    width: 550px;
    float: right;
}
.header{
    width: 1000px;
    height: 84px;
    background: url(images/u7.png);

}
.title{
    width: 1000px;
    height: 41px;
    background: url(images/title-bg.png);
    
}
.title_button{
    float: right;
}
.header_span{
    font-size: 12px;
    color: #F9F6F6;
    font-family: 微软雅黑
}
.button_bar{
    border-top: 1px #E0E0E0 solid;
    height: 30px;
    
}
textarea{
    display: inline;
    border: none;
    resize:none;
}
textarea:focus{
    outline: none;
}
.remark_area{

    border: 2px #CBCBCB solid;
}
a{
    color: #fff;
}
.button_title{
    display:block; width:123px; height:27px; color:#000; background:url(images/button.png);
    float: right;
    text-align: center;
    margin: 2px;
}
</style>
<title>分词测试</title>
</head>
<body>

<div class="header">
    <div style="float:left"><img style="margin-left:30px" src="images/logo.png">
    <img src="images/widget.png"></div>
    <div style="float:left; padding:10px">
    <img src="images/welcome.png"><span class="header_span">欢迎您&nbsp;</span>
    <img src="images/welcome-exit-bar.png">
    <img src="images/exit.png"><span class="header_span">退出系统</span>
    </div>
    
</div>
<div class="title">
    <div class="title_button">

<!--     <input type="text"  /> -->
    <a class="button_title">再次查重</a>
    <a class="button_title">查重通过</a>
    <a class="button_title">下载报告</a>

    </div>
</div>
<div class="table">
<div class="remark_area"><textarea name="233" id="233" cols="133" rows="4" placeholder="请填写意见，例如：查重通过。 或 重复率较高，查重不通过。"  ></textarea>
<div class="button_bar">
<div >
<!-- <a  style="float:left; background:#1586CA">点点我试试</a> -->

<!-- <div><ul>
    <li>好烦啊</li>
    <li>为什么我写这些</li>
    <li>还要看懂js</li>
    <li>算了用jq试试</li>
    <li>烦</li>
</ul></div> -->
</div>



<a style="margin:1px; height:27px; width:123px;  text-align:center; float:right; background:url(images/button_remark.png)">提交意见</a></div>

</div>

<div class="right">
<table width='90%' align='center'>



<td>


<form id="form2" name="form2" method="post" action="?file=<?php echo $filename?>">

  <b>查重结果1：</b>&nbsp; <br/>
    <!--<textarea name="source" style="width:98%;height:400px;font-size:14px;">  --><p class="str">



    <?php

    if(!isset($_POST["Submit1"])){
        $conn2 = mysql_connect("localhost","root","");
        mysql_select_db("check",$conn2);
        $dup_num = 0.0;
        
        // $list_dup_num_sentence = array(0);  //第1句话 就是 存在 $list_dup_num_sentence[0]
        // $list_total_sentence = array(0);  //第1句话 就是 存在 $list_total_sentence[0]
        // $list_file_name= array("");  // 但是 第2句话 不一定存储  $list_file_name[1]中。
        // $list_allow_sentence_print= array(0); 
        // $list_dup_words= array("");  

        // //print_r($array);  // 注意，不要打印 array_unq

        $sentence_word_num =0;  //这就是临时统计每个句子分词的数量
        $tmp_word_query = "";   //这就是临时sql
        $one_sentence_origin_words="";  //临时拼接出来的句子中的重复的词
        $tmp_count_words=0;  //随时可以删，为了统计第几个词，便于调试用的

        $offsetOrigen=0;
        $offsetOrigenEnd=0;
        $dum_num = 0; //记录重复的句子。
        $tmp_count_sentence=1;  //存储被查文章的句子的数量
        $myOriginStr="";   //最后显示您的句子
        $myOriginStrCopy=""; //最后显示您的句子Copy

        $class_num=0;  //class 的序列号
        $array_click_sentence = array();

        $sentence_dup_list=array(); //存储所有原文的句子，包括重复的。就是所有显示您的 句子。 最后用repace替换原文为红色的
                foreach((array)$array as $tmp){
         // $array_unq 是需要查重的文件test，里面所有的分词。形成一个数组
//一定要把上面的分词保留句号和回车。
// 如果 $tmp 是回车或者是句号，   $list_dup_num_sentence[0] ++;  $list_total_sentence[0] =100; 


// $offsetOrigenEnd =$offsetOrigenEnd + mb_strlen($tmp); //不再利用354行找到下一个#的弱智方法来确定一句话，

        if(trim($tmp)=="") continue;//不判定为空的情况了。



        // echo "--------------1";
        if(strstr($tmp,"#")){
        $tmp_count_sentence ++ ;        	
                    //这时候一句话的结束，就开始判断 
        //10-31：句子结束，SELECT * FROM check_articles WHERE checkName="我喜欢" OR  checkName="便利" GROUP BY article_id  HAVING COUNT(article_id)>=2
        //echo $offsetOrigen;

        $offsetOrigenEnd = mb_strpos($mystr,"#",$offsetOrigen+1 );
        // $mystr被查的文章  整段原文（不是入库的文章），// 这时候会不会造成乱码？

        $myOriginStr = mb_substr($mystr, $offsetOrigen,$offsetOrigenEnd-$offsetOrigen);  //显示您的句子
        $myOriginStr =str_replace("#", '', $myOriginStr);

         $tmpStart= $offsetOrigen; //记得删除

        $offsetOrigen = $offsetOrigenEnd;

// 之前的程序会造成查询不出来结果where后面是空的，要判断$tmp_word_query 为空
  if(trim($tmp_word_query)=="")  continue;
//2015-11-27孩子满月，这里确认绝对没有问题的！ 
// echo "一句话开始的pos:".$tmpStart."一句话结束的pos:".$offsetOrigenEnd."原文的一句话".$myOriginStr."~~~~~";

  // $var = "SELECT * FROM check_articles WHERE id IN (SELECT MIN(id) FROM check_articles WHERE ".$tmp_word_query." GROUP BY article_sentence  HAVING COUNT(article_sentence)>=".$sentence_word_num * 0.7.")";// 
  $var = "SELECT MIN(offset) offset,article_sentence,article_id FROM check_articles WHERE ".$tmp_word_query." GROUP BY article_sentence  HAVING COUNT(article_sentence)>=".$sentence_word_num * $threshold ;//  这个是入库的文章
  
  // 这是某天晚上解决的核心问题，比如有待检测文章句子中10个词，库中文档句子是10个词，当超过阈值 文章词语* 0.5 时，也就是重复率是50%，则判断是重复的句子
// echo "<br>".$var."<br>";
  // ".$sentence_word_num * 0.33;   6";
  
            // 去数据库查分词相同的 ，库里已有1 (1).docx的分词
            $resultSet = mysql_query($var,$conn2);
//             $tmp1 = mysql_fetch_array($resultSet);
// //print_r($resultSet);   

// echo "|||||||||||".$tmp_count_sentence."|||||||||||";         
// if($tmp_count_sentence==97)
// {
//         $tmp2 = mysql_fetch_array($resultSet);

//     echo "|||||||||||".$tmp2['checkName']."|||||||||||";         
// }
// //print_r($var."++++");
//下一步是先判断$resultSet没有设置值，且每次fetch到一行数据
      

      $tmp_has_plus = 0;// span的class_num已经加过值了。 0表示没有加过值
           
      
        while(isset($resultSet)  && $tmp1=mysql_fetch_array($resultSet)){
            if($tmp_has_plus==0)         
            {
                $tmp_has_plus=1;
                $class_num++;  //class 的序列号
            }  

           //  echo "符合阈值，就应该打印！0";
// *--------start 打印开始--，因为重复符合阈值2---------------------------------

//如果原句长度小于5个；$sentence_word_num<5;认为太短不给显示；
// if ($sentence_word_num<=5) {  continue; }

// // //有些相似的句子过长，其实并不是相似，相似句子的长度应该在  $sentence_word_num * 0.7 ~ $sentence_word_num / 0.7 
//  $sql_filter = "SELECT COUNT(*) FROM check_articles WHERE article_sentence = ".$tmp1['article_sentence'];  //
//  $result_filter = mysql_query($sql_filter,$conn2);
//  $overview_filter = mysql_fetch_array($result_filter);
//  if ($overview_filter[0]<$sentence_word_num * 0.7 || $overview_filter[0]>$sentence_word_num / 0.7) {  continue; }

// echo $sql_filter;
 // //print_r($overview_filter);

            $var1 = "select content from article_content where article_id = '".$tmp1['article_id']."'";  //这个是文章的重复的内容，居然打出来全篇文章了
            $var2 = "select title,domain,org from article_overview where article_id = '".$tmp1['article_id']."'"; //这个是文章的名称、单位、作者
            $offset = $tmp1['offset'];
            //$result:文章 內容
            $result = mysql_query($var1,$conn2);
            //$result1":文章的基本信息
            $result1 = mysql_query($var2,$conn2);
            $overview = mysql_fetch_array($result1);
            $title = $overview['title'];
            $domain = $overview['domain'];
            $org = $overview['org'];
            $tmp2 = mysql_fetch_array($result);
            $content = $tmp2['content'];

//  $content 需要处理一下，恢复当时分词入库的时候，同样的处理手段，把一些字符都改为#  
 $content_tmp = str_replace(array("\r\n", "\n", "\r","。","？","！","?","!"), '#', $content);
 $content_tmp = str_replace(array("#####","####","###","##"), '#', $content_tmp);
// echo "!". $content_tmp."!";
// echo $offset.'---'.$content_tmp."11";
   $pos_zhu =  mb_strpos($content_tmp,"#",$offset+1 );  // 这里可能会有bug，这了假定都是。 以后可以测试下array，去testArray.php测试下
            $substr = mb_substr($content_tmp, $offset,$pos_zhu-$offset)."。";
        $substr = str_replace('#',"。" , $substr);
// echo "=====".$offset."=====".$pos_zhu."=====".$substr;    
// echo $substr;
// echo "<b>上面內容是重复的句子----下面是标红的：</b>"."<br/>";

// *--------end 打印结束----因为重复符合阈值2-------------------------------

// echo $offset."~~".$pos_zhu."~~".$substr."~~";
  




  // ------start 开始重复的词标红--------------
  

        // $pos_zhu =  mb_strpos($content_tmp,"#",$offset );  // 这里可能会有bug，这了假定都是。 以后可以测试下array，去testArray.php测试下
        // $myOriginStr = mb_substr($content_tmp, $offset,$pos_zhu-$offset)."。";
        $arr = explode("@",$one_sentence_origin_words);   //开始对所有的重复的词进行标红！
// echo "_____".$myOriginStr."_____";




if($myOriginStrCopy=='' || strip_tags($myOriginStr)!=$myOriginStrCopy)  //mb_substr($myOriginStrCopy, 0,3)
{
	$myOriginStrCopy=$myOriginStr;
	$sentence_dup_list[] = $myOriginStrCopy; //这个有问题，但是我真心看不懂为啥，好在完全不影响啊程序！！这个比Array_push效果高1倍
    $dum_num++;
}
$array_click_sentence[] = $myOriginStr; 
        foreach($arr as $word_dup_tmp){    //开始对所有的重复的词进行标红！
                        if(containRedKey($word_dup_tmp)) continue;//自己写个函数，过滤显示红色的代码的关键字span class='redtxt'。否则会出现：<Span <Span claSS='redtxt'>CSpan> 这样的错误
                        $substr= str_replace($word_dup_tmp, "<span class='redtxt'>".$word_dup_tmp."</span>",$substr);

 						
//错误！ if(strstr($myOriginStr,'redtxt')) continue; //防止一句话里有多个关键词，反复变红色
                        $myOriginStr= str_replace($word_dup_tmp, "<span class='redtxt'>".$word_dup_tmp."</span>",$myOriginStr);
 
                    } //end for



echo "<span class=\"span txt".$class_num."\">您的句子：".$myOriginStr."<br>";  //出现乱码，中文被截取了一半，原因是。都被改为半角的#，我们需要一个Origin_offset,  //class 的序列号
// 警告，警告， content_tmp 是# 之后的全文，  content是 原本的全文，就是Origin_content


// //print_r($arr);
echo "相似的句子：".$substr."<br>";  
// *-------------start 相似句子前后的100个偏置
$pos_str_head = $offset-100;
$pos_str_end = $offset+100;

if($offset-100 < 0)  $pos_str_head = 0;
if($offset+100 > mb_strlen($content_tmp)-6)  $pos_str_end = mb_strlen($content_tmp)-6;
 $pos_start =  mb_strpos($content_tmp,"#",$pos_str_head );  // 这里可能会有bug，这了假定都是。 以后可以测试下array，去testArray.php测试下
$pos_end =  mb_strpos($content_tmp,"#",$pos_str_end );  

        $myContextStr = mb_substr($content_tmp, $pos_start,$pos_end-$pos_start)."...";

// 2015-10-31 溢出offset问题，还有界面
         $myContextStr= str_replace('#',' ',$myContextStr);//不能打印出#来呀，所以这里替换。@朱俭 2015-11-28
 echo "相似句子的原文段落：".$myContextStr."<br>";  


                    echo "<b>项目名称:</b>".$title."  "."<br/>";
                    echo "<b>承担单位:</b>".$org."<br/>";
                    echo "<b>所属领域:</b>".$domain."<br/>";
                    echo "<br/><hr></span>";
// ------end 开始重复的词标红--------------   

        }

// if($list_dup_num_sentence[0]/$list_total_sentence[0] >=0.1){
//10-31：符合阈值，就应该打印！
                 // $list_allow_sentence_print[0] =1; 
               
                
       // }
/*如果出现#，说明一句的结尾， 那么久应该 就 Array_push($list_XXXXX, 0 );  五遍！  */
         // Array_push($list_allow_sentence_print, 0 );   
        // $list_total_sentence = array(0); 
        // $list_file_name= array("");  
        // $list_allow_sentence_print= array(0); 
        // $list_dup_words= array("");  
/*如果出现#，说明一句的结尾， 那么久应该 就 Array_push($list_XXXXX, 0 );  五遍！  */

// 恢复临时变量的初始值！
$sentence_word_num =0;  //这就是临时统计每个句子分词的数量
$tmp_word_query = "";   //这就是临时sql
$one_sentence_origin_words="";
        }//判断每一句话的结束  end if(strstr($tmp,"#"))
        else  {

//  加上停用词组的判断 $tmp   领域  承担 单位 项目 
            if (in_array($tmp,$array_forbidden)) continue;


//10-31：句子没有结束，把分词$tmp累加起来变成string，且    !!!!!!!!!!!!
                if($tmp_word_query ==""){
                    $tmp_word_query = $tmp_word_query.' checkName="'.$tmp.'" ';
                }
                else{
                    $tmp_word_query = $tmp_word_query.'OR  checkName="'.$tmp.'" ';
                }
                $one_sentence_origin_words= $one_sentence_origin_words."@".$tmp;
$sentence_word_num ++;
//  checkName="我喜欢" OR  checkName="便利" 

        
            } // end else 判断每一句话的结束 end if(strstr($tmp,"#"))
// 每一句话结束的时候，开始打印 $list_allow_sentence_print[0]


        } // end 判断 需要测试的文章里面的所有的分词结束--- foreach((array)$array as $tmp)

//对数组 $list_allow_sentence_print 来一个循环，只要发现符合阈值的要求，就开始打印出来
//
 //如果重复率大于 $list_dup_num_sentence[0]/$list_total_sentence[0] >0.3   
        // echo "--------------2===$list_allow_sentence_print[0]===".$list_file_name[0];

$sentence_dup_list = array_unique($sentence_dup_list); //  一个函数就可以去除数组中重复的值，厉害！！！





// foreach($sentence_dup_list as $sdl){
//     //echo $sdl."____";

//         // $sdl= str_replace(array("<span class='redtxt'>","</span>"),"",$sdl);
// 		if(containRedKey($sdl)) continue;//自己写个函数，过滤显示红色的代码的关键字span 

//         // $OriginContent= str_replace($sdl, "<a class='redtxt changeHide".$changeHide_num."'>".$sdl."</a>",$OriginContent);
//                     } //end for


        mysql_close($conn2);
        
    }
     
        ?></p>
    <br/>
    <input type="submit" name="Submit1" value="文章入库" />
    <a href="./upload.html" >返回伟大的上传程序</a>

    <br/>



<?php
//print_r($sentence_dup_list);

//print_r($OriginContent_array);
// $j=0;

// for($i=0;$i<sizeof($sentence_dup_list);$i++)
// {
//     if($j<sizeof($OriginContent_array)) break;

//     //if(strstr($OriginContent_array[$j],$sentence_dup_list[$i]))  
        
//      if($OriginContent_array[$j]==$sentence_dup_list[$i])     

//         //$sentence_dup_list[$i] = "<a class='redtxt changeHide".($i+1)."'>".$sentence_dup_list[$i]."</a>";
// $OriginContent= str_replace($sentence_dup_list[$i], "<a class='redtxt changeHide".($i+1)."'>".$sentence_dup_list[$i]."</a>",$OriginContent);
// // echo "####".$OriginContent."<br>";

// $j++;
// }
$h=1;

for($j=0;$j<sizeof($OriginContent_array);$j++){

for($i=0;$i<sizeof($sentence_dup_list);$i++)
{

        
     // if(strstr($OriginContent_array[$j],$sentence_dup_list[$i]))    
    if($OriginContent_array[$j]==$sentence_dup_list[$i])    
        //$sentence_dup_list[$i] = "<a class='redtxt changeHide".($i+1)."'>".$sentence_dup_list[$i]."</a>";
{

$OriginContent_array[$j]="<a class='clc redtxt' id='changeHide".$h."'>".$OriginContent_array[$j]."</a>";
$h++;
//break;
}
}

}
$OriginContent_print="";
for($j=0;$j<sizeof($OriginContent_array);$j++){
  $OriginContent_print.= $OriginContent_array[$j]."。";//拼接
}
// foreach($sentence_dup_list as $tmp_change){

// $changeHide_num++;
// $OriginContent= str_replace($tmp_change, "<a class='redtxt changeHide".$changeHide_num."'>".$tmp_change."</a>",$OriginContent);
           
// }
echo "<hr>";
//print_r($OriginContent);


$time_end_loadPage = getmicrotime();  
$loadtime_loadPage = $time_end_loadPage - $time_start_loadPage;  
echo "PHP:页面加载时间:".round($loadtime_loadPage,3).'秒';


$loadtime_insert_word_DB = $time_end_insert_word_DB - $time_start_insert_word_DB;  
if(!empty($loadtime_insert_word_DB) && $loadtime_insert_word_DB>0) //（初始化入库时间为0，没有入库）
	echo "<br/>PHP:本文入库的时间:".round($loadtime_insert_word_DB,3).'秒';
?>

</form>

</td>
<tr/>


<br />


</table>

</div>
</div>
<?php 
echo "<div class=\"left\">";
// echo sizeof($sentence_dup_list).'--'.$tmp_count_sentence; 看看查重率对不对！
//输出查重结果, 只能用 $dum_num了， 不能用 sizeof($sentence_dup_list)，里面的颜色他太多了，重复太多了，@11-28
echo "【查重率】".number_format(($dum_num / $tmp_count_sentence *100),2)."%";
// 临时解决下最后句号显示多的问题。 最后那个...
$OriginContent_print = str_replace(array("。。。。","。。。","。。","。。"), '。', $OriginContent_print);
echo "<br>需要查重的原文是：".$OriginContent_print."<br>";
echo "<br>";
// //print_r( $sentence_dup_list);

echo "</div>";
//print_r($array_click_sentence);
?>

<script type="text/javascript"> 

    $(document).ready(function(){
         // for (int i=1;i++;i<=3){
    $(".clc").click(function(){
        $(".span").hide();   
        var li_id = $(this).attr("id");
        id = li_id.replace("changeHide","");
        $("." +"txt"+id).show();    
     // showcontent(i);
        
        }); 
    }); 


</script>
<div class="footer">
</div>
</body>
</html>
