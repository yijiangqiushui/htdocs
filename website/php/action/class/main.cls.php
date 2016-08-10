<?php
class MAIN{
    function logout(){
        session_start();
        session_destroy();
        $data_arr=array();
        $data_arr['type']='success';
        echo json_encode($data_arr);
    }
    
    function get_user(){
        $data_arr=array();
        $data_arr['username'] = $_SESSION['username'];
        $data_arr['org_name'] = $_SESSION['org_name'];
        echo json_encode($data_arr);
    }
    
    function checklogin(){
        $user_type = $_SESSION['user_type'];
        if($user_type != null){
            if($user_type > 0){
                $data['code'] = "exit";
            }else{
                $data['code'] = "keep";
            }
        }else{
            $data['code'] = "nologin";
        }
        echo json_encode($data);
        
        
    }
}