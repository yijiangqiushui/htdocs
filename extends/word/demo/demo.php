<?php

require_once __DIR__ . '/../word.php';
require_once __DIR__ . '/../../../common/php/config.ini.php';
require_once __DIR__ . '/../../../common/php/lib/db.cls.php';


$data = array(
    'name'  => '王哥',
    'sex'   => '男',

    'TBL1'  => array(
        'course'    => array('数学', '语文'),
        'score'     => array('96', '98'),
    ),

    'TBL2'  => array(
        'box'       => array(1, 2, 3),
        'test'      => array('哈哈', 'ceshi', 'a'),
    ),

    'ATTACH'    => array(
        'path'  => array(
            '/website/upload/1212/15-12-09/c5d4a2c2936337c949b2e6527416cfc9b813b9eb.jpg',
            '/website/upload/1212/15-12-09/测试图片04.jpg',
        )
    )
);

echo datatoword($data, 'test.docx', 20);
