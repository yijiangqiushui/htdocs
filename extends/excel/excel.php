<?php

/* error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />'); */

date_default_timezone_set('Europe/London');

/** PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

function dataToExcel($data,$fileName,$baseRow,$realName){
    $objReader = PHPExcel_IOFactory::createReader('Excel5');
    $objPHPExcel = $objReader->load('template/'.$fileName);
//     var_dump($objPHPExcel);exit();
    
//     $objPHPExcel->getActiveSheet()->setCellValue('D1', PHPExcel_Shared_Date::PHPToExcel(time()));
    
//     $baseRow = 5;
    foreach($data as $r => $dataRow) {
        $tmp = 65;
        $row = $baseRow + $r;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
        foreach($dataRow as $num => $item){
            $objPHPExcel->getActiveSheet()->setCellValue(chr($tmp + $num).($row), $item);
        }
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
    
    //变为中文名称
    $dataNow = date('Y-m-d-h-m-s', time());
    $file = $realName . '-' .$dataNow . '.xls';
    $file = iconv("UTF-8", "GB2312//IGNORE",$file); 
//   $dir = '/extends/excel/download/'.$realName.'.xls';
    $dir = '/extends/excel/download/'.$file;
//     echo date('H:i:s') , " Write to Excel5 format" , EOL;
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//     $objWriter->save(str_replace('.php', '.xls', __FILE__));
    $objWriter->save(dirname(__FILE__)."/download/".$file);     
//    echo dirname(__FILE__);exit();
    $dir = iconv("GB2312", "UTF-8//IGNORE",$dir);
    return $dir;
    
}

function dataToDulExcel($data,$data1,$filename,$baseRow,$realName,$index){
    $objReader = PHPExcel_IOFactory::createReader('Excel5');
    $objPHPExcel = $objReader->load('template/'.$filename);
    $objPHPExcel->setActiveSheetIndex($index-1);
    foreach($data as $r => $dataRow) {
        $tmp = 65;
        $row = $baseRow + $r;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
        foreach($dataRow as $num => $item){
            $objPHPExcel->getActiveSheet()->setCellValue(chr($tmp + $num).($row), $item);
        }
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
    
    $objPHPExcel->setActiveSheetIndex($index);
    foreach($data1 as $r => $dataRow) {
        $tmp = 65;
        $row = $baseRow + $r;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
        foreach($dataRow as $num => $item){
            $objPHPExcel->getActiveSheet()->setCellValue(chr($tmp + $num).($row), $item);
        }
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
    
    //变为中文名称
    $dataNow = date('Y-m-d-h-m-s', time());
    $file = $realName . '-' .$dataNow . '.xls';
    $file = iconv("UTF-8", "GB2312//IGNORE",$file);
    
//  $dir = '/extends/excel/download/'.$realName.'.xls';
    $dir = '/extends/excel/download/'.$file;
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save(dirname(__FILE__)."/download/".$file);
    $dir = iconv("GB2312", "UTF-8//IGNORE",$dir);
    return $dir;
    
}

