<?php
/**
 * PHPExcel封装的简单使用
 *
 * @author 风格独特
 */

require_once __DIR__ . '/lib/Excel.php';


// 创建Excel实例
$excel = new Excel();

$data1 = array(
    'title' => 'aaa',
    'test' => 'bbb',
    'test33' => 'ddd',
);
$data2 = array(
    '1',
    '2',
    '3'
);

// 为每一行添加数据，每个数组都是一行数据，会自动忽略数组的key键
$excel->addRow($data1);
$excel->addRow($data2);

// 下载，其中‘中文’为下载的文件名称
$excel->down('中文');