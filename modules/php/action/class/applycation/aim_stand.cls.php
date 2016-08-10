<?php


class APPLY
{
	/**
	 * 附件11单位基本情况
	 */
	function org_info11($org_code,$aim_standard){
	    $db = new DB();
	    $result1 = $db->UpdateTabData('aim_standard',$org_code, $aim_standard,'org_code');	}
}
?>


