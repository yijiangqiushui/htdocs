<?php
/**
 * 对word文档生成的封装
 * 其中word模板放在temp目录中，word文件名不要采用中文
 * 生成的word文档放在dest目录中
 *
 * @author 风格独特
 */
require_once __DIR__ . '/lib/PHPWord.php';

function datatoword($data, $temp,$attach_name_id)
{ 
    if (! is_array($data)) {
        return false;
    }

    $PHPWord = new PHPWord();

    $tempfile = __DIR__ . '/temp/' . $temp;
    if (!file_exists($tempfile)){ 
        return false;
    }    
    $document = $PHPWord->loadTemplate($tempfile);
    foreach ($data as $k => $v){
        if (is_array($v)) { 
            $document->cloneRow($k, $v);
        } else {
            $document->setValue($k, $v);
        }
    }
    if(!empty($data['ATTACH'])){
        $img = array();
        $files = array("jpg","jpeg","png");
        $zipFiles = array("doc","docx");
        //var_dump($data['ATTACH']);exit;
        foreach($data['ATTACH']['path'] as $key=>$value){
            $temp = explode(".",$value);
            $value = iconv("UTF-8//IGNORE", "GB2312", $value);
            if(in_array(strtolower($temp[1]),$files)){
                $imgPath[] = __DIR__."/../.." .$value;
                $imgName[] = $data['ATTACH']['name'][$key];
                $imgIntroduce[] = $data['ATTACH']['introduction'][$key];
            }
            if(in_array(strtolower($temp[1]),$zipFiles)){
                $attachPath[] = __DIR__."/../.." .$value;
            }

        }
        if(!empty($imgPath)){
            $document->replaceStrToImgV2('image',$imgPath,$imgName,$imgIntroduce);
        }

    }
    $dataNow = date('Y-m-d-h-m-s', time());
//     $attach_name = getName(1);  david  modify  2016.1.13
    $attach_name = getName($attach_name_id);
    $file = date('Y-m-d', time()) . '/' . $attach_name . '-' .$dataNow ;
    $zipFileName = $file.".zip";
    $file .=".docx";
    //这个用来转换中文字符的问题。
    if(stristr(PHP_OS, 'WIN')){
        $file = iconv("UTF-8", "GB2312//IGNORE",$file);
        $zipFileName = iconv("UTF-8", "GB2312//IGNORE",$zipFileName);
    }

    $destfile = __DIR__ . '/dest/' . $file;
    $destZipFile = __DIR__ . '/dest/' . $zipFileName;
    $dir = dirname($destfile);
    $uri = '/extends/word/dest/' . $file;
    $zipUrl= '/extends/word/dest/' . $zipFileName;
    if (! file_exists(__DIR__ . '/dest/')){
        mkdir(__DIR__ . '/dest/');
    }
    if (! file_exists($dir)){
        mkdir($dir);
    }
    try {
        $document->clearTemplate("", "");//用来清空模板里的未填写的信息
        $document->save($destfile);
        if(!empty($attachPath)){
            copy($destfile,__DIR__.'/wordPrint/'.get_basename($destfile));
            $attachPath['docx']=get_basename($destfile);
            getZipFile(get_basename($destZipFile).'.zip',$attachPath,$destZipFile);
            $zipUrl = iconv("GB2312", "UTF-8//IGNORE",$zipUrl);
            return $zipUrl;
        }else{
            $uri = iconv("GB2312", "UTF-8//IGNORE",$uri);
            return $uri;
        }
    } catch (Exception $e){
        return false;
    }
}

function getName($attach_name_id){
    $db = new DB();
    $result_name = $db->GetInfo($attach_name_id, 'table_type');
    return $result_name['name'];
}

function getAttr($id,$id1,$id2,$id3,$id4,$arr){
    if($arr[$id]==1){
        $arr[$id]='是';
        if($arr[$id]==0){
            $arr[$id1]="是";
            $arr[$id2]="否";
        }if($arr[$id3]==1){
            $arr[$id3]="是";
        }else{
            $arr[$id3]="否";
        }
    }else{
        $arr[$id]="否";
        $arr[$id1]='';
        $arr[$id2]='';
        $arr[$id3]='';
        $arr[$id4]='';
    }
    return $arr;
}
//用阿拉伯数字形式显示上一年年份
function lastyear(){
	$last = date('Y') - 1;
	$last_year = array(
			'last_year' =>  $last
	);
	return $last_year;
}

//用阿拉伯数字形式显示日期
function showtime(){
	$now_month = date('m');
	if($now_month < 10)
	{ $now_month = substr($now_month, -1);  }
	$time = array();
	$time = array(
			'now_year' => substr(date('Y'), -2),
			'now_month' =>  $now_month
	);
	return $time;
}

function show_font_time(){
	//用中文形式显示日期
	$now_year = substr(date('Y'), -2);
	$now_month = date('m');
	if($now_month < 10)
	{
		$now_month = substr($now_month, -1);
	}
		switch($now_month){
			case 1: $now_month="一";break;
			case 2: $now_month="二";break;
			case 3: $now_month="三";break;
			case 4: $now_month="四";break;
			case 5: $now_month="五";break;
			case 6: $now_month="六"; break;
			case 7: $now_month="七";break;
			case 8: $now_month="八";break;
			case 9: $now_month="九";break;
			case 10: $now_month="十";break;
			case 11: $now_month="十一";break;
			case 12: $now_month="十二";break;
		}
		$year_front = substr($now_year,-2,1);
		switch($year_front){
			case 1: $year_front="一";break;
			case 2: $year_front="二";break;
			case 3: $year_front="三";break;
			case 4: $year_front="四";break;
			case 5: $year_front="五";break;
			case 6: $year_front="六"; break;
			case 7: $year_front="七";break;
			case 8: $year_front="八";break;
			case 9: $year_front="九";break;
			case 10: $year_front="十";break;
			case 11: $year_front="十一";break;
			case 12: $year_front="十二";break;
		}
		$year_behind = substr($now_year,-1);
		switch($year_behind){
			case 1: $year_behind="一";break;
			case 2: $year_behind="二";break;
			case 3: $year_behind="三";break;
			case 4: $year_behind="四";break;
			case 5: $year_behind="五";break;
			case 6: $year_behind="六"; break;
			case 7: $year_behind="七";break;
			case 8: $year_behind="八";break;
			case 9: $year_behind="九";break;
			case 10: $year_behind="十";break;
			case 11: $year_behind="十一";break;
			case 12: $year_behind="十二";break;
		}
		$year_front.=$year_behind;
		$now_year = $year_front;
		$time = array();
		$time = array(
				'now_year' => $now_year,
				'now_month' =>  $now_month
		);
		return $time;
}
//生成压缩文件，目前只能这样处理，否则压缩文件里会包含路径信息
function getZipFile($fileName,$filePath,$destPath){
    $zip=new ZipArchive;
    if($zip->open($fileName,ZipArchive::OVERWRITE)===TRUE){
        foreach($filePath as $key=>$value){
            copy($value,__DIR__.'/wordPrint/'.get_basename($value));
            $zip->addFile(get_basename($value));
        }
        $zip->close();
        foreach($filePath as $key=>$value){
            unlink(get_basename($value));
        }
        rename($fileName, $destPath);

    }


}
//获取中文文件名
function get_basename($filename){
    return preg_replace('/^.+[\\\\\\/]/', '', $filename);
}

























