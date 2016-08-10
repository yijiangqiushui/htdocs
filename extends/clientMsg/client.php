<?php 
//  function getTable($user_name='david'){
require __DIR__ . '/../../common/php/config.ini.php';
include __DIR__.'/../../common/php/lib/db.cls.php';
include __DIR__.'/../../modules/php/action/class/center/center.cls.php';

        $checknum = 0;
        $db = new DB();
        $center = new Center();
        $user_result = $db -> GetInfo1($user_name,'login_info','david');
        $department = $user_result['department'];
        $sql = 'select * project_type where dep_type='.$department;       
        $res = $db->Select($sql);       
        foreach ($res as $temp){
           $checknum = $center->checkNum($temp['dep_type']);
           $checknum += $checknum;
        }
        echo $checknum.'hhhh';
        $rejson = array(
            'totalnum' => $checknum
        );
//         return json_encode($rejson);
        $db->Close();
//   }