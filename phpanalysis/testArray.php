<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
    $list = array(); 
    Array_push($list,0); 
    print_r($list); 
    echo $list[0];
unset($list);
echo "------------------<br>";
print_r($list); 

echo "------------------<br>";
 $str='1 @#-=';

    $in=strstr($str,'#');

    echo $in;//输出结果为:#
if($in) echo 111;
else echo 222;

if($str == "#")
	echo "yes";


echo "<br>--------------";

$tt = "123123.docx";
echo substr($tt, 0, stripos($tt,"."));  

echo "<hr>";
// $tmptmp = "<span class='redtxt'></span>";
$tmptmp = "我们的#";

print_r (containRedKey($tmptmp));

function containRedKey($tmptmp){
if(strstr($tmptmp,"<")||strstr($tmptmp,"s")||strstr($tmptmp,"p")||strstr($tmptmp,"a")||strstr($tmptmp,"n")||strstr($tmptmp,"c")||strstr($tmptmp,"l")||strstr($tmptmp,"s")||strstr($tmptmp,"=")||strstr($tmptmp,"'")||strstr($tmptmp,"r")||strstr($tmptmp,"e")||strstr($tmptmp,"d")||strstr($tmptmp,"t")||strstr($tmptmp,"x")||strstr($tmptmp,"'")||strstr($tmptmp,">")||strstr($tmptmp,"/"))
	return 1;
else
	return 0;
}
echo "<hr>";
echo mb_strlen($tmptmp);
echo "<hr>";
echo mb_substr($tmptmp, 6, 3);

echo "<hr>";
 $content_tmp = "中国###2015";
 $content_tmp = str_replace(array("###","##"), '#', $content_tmp);
echo  $content_tmp;
echo "<hr>";



echo "<hr>";
 $teststr = "中国#2015有一个好故事#";
 $tmp = "#2015";
 $val = 0;
$filename ="9000.docx";
 $pos_sentence_tmp=$pos_sentence = 0;
  if(strstr($tmp,'#')) 
                    {
                        $pos_sentence_tmp=$pos_sentence+1; 
// 为了让#所在的词或者#处于的句子是前一个句子，而不是后一个句子。添加了一个变量$pos_sentence_tmp实现了推迟sentence+1
                    }else{
                        if($pos_sentence_tmp!=$pos_sentence) $pos_sentence=$pos_sentence_tmp;
                    }
                $val = mb_strpos($teststr, $tmp,$val);  // 这个bug彻底解决了，$val作为上一个pos位置，终于再次作为offset偏置量 mb_strpos ( string $haystack , string $needle [, int $offset = 0]  )
 //@朱俭  查找某个字符在指定的字符串中所有出现的位置.. http://blog.csdn.net/lansexingkong/article/details/6297511
echo "<br>";
echo $val;

$article_sentence = substr($filename, 0, stripos($filename,"."))+$pos_sentence*0.0001; 
        if($exec_str==""){
         $exec_str=$exec_str."('".$tmp."','".$filename."','".$val."',".$pos_sentence.",".$article_sentence.")";
     }else{
          $exec_str=$exec_str.",('".$tmp."','".$filename."','".$val."',".$pos_sentence.",".$article_sentence.")";
                        }
echo "<br>";
echo $exec_str;

echo "<hr>";

 $teststr = "中国#2015有一个好故事#";
 $tmp = "#2015";
 $val = 0;
$filename ="9000.docx";
 $pos_sentence_tmp=$pos_sentence = 0;
$exec_str ="";
echo mb_substr($teststr, 0,6);
// $kk = explode('#', $teststr);
// print_r($kk);
// echo "<br>";


//   遇到 #在 字前面的问题，比如#2015年  需要分2次插入。 再比如： 故事# 就不用处理。
if(strstr($tmp,'#') && strstr($tmp,'#')!='#')
 {
     $teststr = str_replace('#', '&#&', $teststr);  
     $array_tmp = explode('&', $teststr );
     print_r($array_tmp);
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
 }

 echo $exec_str;
  echo "<hr>";


$t = microtime(true);   
$array = array();   
for($i = 0; $i < 10000; $i++) {   
    $array[] = $i;   
}   
echo 'array[]提速近一倍啊！';
print microtime(true) - $t;   
print '<br>';   
$t = microtime(true);   
$array = array();   
for($i = 0; $i < 10000; $i++) {   
    array_push($array, $i);   
}   
echo 'array_push';
print microtime(true) - $t;  
  echo "<hr>";
  ?>
