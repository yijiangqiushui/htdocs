<?php
/************************************************************************************************************
#	PHP Version 1.01   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/04/05
#	北京兼职(www.beijingjianzhi.com)
************************************************************************************************************/

//对BBCODE进行还原
function bbcode_format($str) { 
//    $str = htmlentities($str); 
    $simple_search = array( 
                '/\[face\](.*?)\[\/face\]/is',                                 
                '/\[reply\](.*?)\[\/reply\]/is',                                 
                '/\[b\](.*?)\[\/b\]/is',                                 
                '/\[i\](.*?)\[\/i\]/is',                                 
                '/\[u\](.*?)\[\/u\]/is',                                 
                '/\[url\=(.*?)\](.*?)\[\/url\]/is',                          
                '/\[url\](.*?)\[\/url\]/is',                              
                '/\[align\=(left|center|right)\](.*?)\[\/align\]/is',     
                '/\[img\](.*?)\[\/img\]/is',                             
                '/\[swf\](.*?)\[\/swf\]/is',                             
                '/\[mail\=(.*?)\](.*?)\[\/mail\]/is',                     
                '/\[mail\](.*?)\[\/mail\]/is',                             
                '/\[font\=(.*?)\](.*?)\[\/font\]/is',                     
                '/\[size\=(.*?)\](.*?)\[\/size\]/is',                     
                '/\[color\=(.*?)\](.*?)\[\/color\]/is',         
                ); 
    $simple_replace = array( 
                '<img src="/cms/system/img/bbcode/face/$1.gif" />', 
                '<div class="replyVeryContent">回复：$1</div>', 
                '<strong>$1</strong>', 
                '<em>$1</em>', 
                '<u>$1</u>', 
                '<a href="$1" target="_blank">$2</a>', 
                '<a href="$1" target="_blank">$1</a>', 
                '<div style="text-align: $1;">$2</div>', 
                '<img src="$1" />', 
                '<embed src="$1" type="application/x-shockwave-flash" width="480" height="395"></embed>', 
                '<a href="mailto:$1">$2</a>', 
                '<a href="mailto:$1">$1</a>', 
                '<span style="font-family: $1;">$2</span>', 
                '<span style="font-size: $1;">$2</span>', 
                '<span style="color: $1;">$2</span>', 
                ); 
    // Do simple BBCode's 
    $str = preg_replace ($simple_search, $simple_replace, $str); 
    // Do <blockquote> BBCode 
    $str = bbcode_quote ($str); 
    return $str; 
} 

function bbcode_quote($str) { 
    $open = '<blockquote>'; 
    $close = '</blockquote>'; 
    // How often is the open tag? 
    preg_match_all ('/\[quote\]/i', $str, $matches); 
    $opentags = count($matches['0']); 
    // How often is the close tag? 
    preg_match_all ('/\[\/quote\]/i', $str, $matches); 
    $closetags = count($matches['0']); 
    // Check how many tags have been unclosed 
    // And add the unclosing tag at the end of the message 
    $unclosed = $opentags - $closetags; 
    for ($i = 0; $i < $unclosed; $i++) {
        $str .= '</blockquote>'; 
    } 
    // Do replacement 
    $str = str_replace ('[' . 'quote]', $open, $str); 
    $str = str_replace ('[/' . 'quote]', $close, $str); 
    return $str; 
} 

?>