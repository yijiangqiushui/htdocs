<?php 
require __DIR__ . '/../../common/php/config.ini.php';

class clientMsg{
    public function __construct()
    {

    }

    /**
     * 输入：用户名
     * 输出：json{
     *  科室名称：数量
     * }
     *
     */
   public function getTable($user_name='david'){
        $checknum = 0;
        $db = new DB();
        $center = new Center();
        $user_result = $db -> GetInfo1($user_name,'login_info','username');
        $department = $user_result['department'];
        $sql = 'select * project_type where dep_type='.$department;       
        $res = $db->Select($sql);       
        foreach ($res as $temp){
           $checknum = $center->checkNum($temp['dep_type']);
           $checknum += $checknum;
        }
        echo $checknum;
        $rejson = array(
            'totalnum' => $checknum
        );
//         return json_encode($rejson);
        $db->Close();
    }
}





