<?php
include '../class/ActionBase.cls.php';


class privilageControl extends ActionBase{
	
	function test(){
		
	}
	
	function index(){
		$ret = Pri::instance()->getPri("check_pri");
		echo Pri::instance()->checkPri("ccgl");
		//var_dump($ret);
	}
	
	function checkPart(){
		
		$msgcode = 100;
		
		$module = $_POST['module'];
		$ret = Pri::instance()->checkPri($module);
		$code = 0;
		if($ret){
			$code =1;
		}
		
		$this->response($msgcode, $code);
		
	}
	
	
	function run(){
		
		$action = $_GET['action'];
		if(empty($action)){
			$action = 'index';
		}
		$this->$action();
		return $ret;
		
	}
	
	
}


$task = new privilageControl();

$task->run();









