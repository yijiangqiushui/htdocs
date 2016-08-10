<?php
/**
 * 公共的方法
 */

require __DIR__ . '/../../common/php/config.ini.php';

if(!function_exists('common_lock') ){
    
    function common_lock()   { }

    function dep_name($dep_type)
    {
        global $global_department;
        if (isset($global_department[$dep_type])) {
            return $global_department[$dep_type]['name'];
        }
        return '';
    }
    
    function json_out($data)
    {
        header('Content-Type: application/json');
       echo json_encode($data);
        exit;
    }
}


