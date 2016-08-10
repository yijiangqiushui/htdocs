<?php
include '../../../center/php/action/class/ActionBase.cls.php';
require_once('../../../common/php/config.ini.php');
require_once(ROOTPATH.'../../cms/class/content.cls.php');

class editInfoControl extends ActionBase{
	
	function checkRecommend(){
		
	
		$msgcode = 101;
		$infoId = $_GET['infoId'];
		$value = $_GET['value'];
		//echo $infoId;
		$contentCls=new content();
		$condition = array('isRecommend'=>$value);
		//var_dump($condition);
		if($infoId){
			if($ret = $contentCls->editInfo($infoId,$condition)){
				$msgcode = 100;
				
			}
		}
		 $res = array('content'=>$ret);
		$this->response($msgcode,$res);
	}
	
function checkForbidden(){
		
	
		$msgcode = 101;
		$infoId = $_GET['infoId'];
		$value = $_GET['value'];
		//echo $infoId;
		$contentCls=new content();
		$condition = array('isForbidden'=>$value);
		//var_dump($condition);
		if($infoId){
			if($ret = $contentCls->editInfo($infoId,$condition)){
				$msgcode = 100;
				
			}
		}
		 $res = array('content'=>$ret);
		$this->response($msgcode,$res);
	}
	



}

















$approve_control = new editInfoControl();
$approve_control->run();