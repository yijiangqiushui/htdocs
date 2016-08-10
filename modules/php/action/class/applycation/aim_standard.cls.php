<?php
use Zend\Mail\Header\Cc;
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
    
class APPLY
{
	/**
	 * 附件11单位基本情况
	 */
	public function abc($project_id,$project_content){
	    $db = new DB();                //   数组名参数
	    if(!empty($project_content))
	    {
	      $result1 = $db->UpdateTabData('project_content',$project_id,$project_content,'project_id');
	    }
	    else 
	    {
	        echo "输入数据为空!!!!!";
	    }
	    $db->Close();
}
function bcd($project_id,$project_content1){
    $db = new DB();                //   数组名                                            参数
   
    $result2 = $db->UpdateTabData('project_content',$project_id, $project_content1,'org_code');
    
}
function cdf($project_id,$project_mission){
    $db = new DB();                //   数组名                                            参数
   
    $result3 = $db->UpdateTabData('project_mission',$org_code, $project_mission,'org_code');
}
}
?>


