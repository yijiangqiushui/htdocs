<?php
require_once __DIR__ . '/config.zhujian.php';
require_once __DIR__ . '/db.cls.php';

abstract class ActionBase{

    public $action;
    public $view_dir;
    public $params = array();
    
    function assign($name,$value){
        $this->params[$name] = $value;
    }
    
    function display($filename = null){
        foreach($this->params as $key=>$val){
            $$key = $val;
        }
        if($filename){
            include(ROOTPATH.$this->view_dir."/".$filename);
        }else{
            exit();
        }
    }
    
    /**
     *msgcode:
     *content:
     */
    
    function response($msgcode,$res){
        $result = array(
            "msgcode"=>$msgcode,
            "ret"=>$res
        );
        ob_clean();
        echo json_encode($result);
    }
    
    function run(){
        $action = $_GET['action'];
        if(empty($action)){
            $action = "index";
        }
        $this->$action();
    }
}