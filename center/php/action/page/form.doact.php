
<?php
//0:代表正常
//1：代表有问题
include '../../../../common/php/config.ini.php';
include '../../config.ini.php';
include ROOTPATH.'lib/common.cls.php';
include ROOTPATH.'lib/db.cls.php';
include ROOTPATH.'lib/user.cls.php';
class formAction{
    function generateID($username,$password){
        $data = 0;
        $usr=new USER();
        $password_encript = $usr->EncriptPWD($password);
        $db = new DB();
        $sql = "select * from login_info where username='$username'";
        $result_select = $db->Select1($sql);
        $rows = mysql_num_rows($result_select);
        if($rows == 0){
            $sql_insert = "insert into login_info (username,password,user_type) values ('$username','$password_encript',-1)";
            $result_insert = $db->Insert($sql_insert);
            $data = 0;
        }
        else{
            $data = 1;
        }
        
        echo $data;
    }
}