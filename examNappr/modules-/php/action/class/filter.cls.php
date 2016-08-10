<?php

class Filter{
	function get_filter($title,$content){
		$db=new DB();
		$sql="select title from sensitiveinfo";
		$sensitiveArr=$db->Select($sql);
		for($i=0;$i<count($sensitiveArr);$i++){
			if(strstr($title,$sensitiveArr[$i]['title'])!=''||strstr($content,$sensitiveArr[$i]['title'])!=''){
				//$db->Close();
				return $sensitiveArr[$i]['title'];
			}
		}
		//$db->Close();
		return 'success';
		$db->Close();
	}
	
}
?>
