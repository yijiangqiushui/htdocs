<?php
include '../../../../php/config.ini.php';
include 'config.ini.php';
include ROOTPATH.'lib/db.cls.php';

$db=new DB();

$sql="select id,cat_name,upper_cat from contentcat order by concat(upper_cat,id,'.')";
$rs=$db->select($sql);

$ft=new FormatTree($rs);
echo json_encode($ft->recursiveCat($rs));

class FormatTree{
	private $data_arr;
	
	public function recursiveCat($rs,$upper_cat='.',$depth=1){
		if(sizeof($rs)>0){
			$select_count=0;
			$data_arr_tmp=array();
			for($i=0;$i<sizeof($rs);$i++){
				if($rs[$i][upper_cat]==$upper_cat && substr_count($rs[$i][upper_cat],'.')==$depth){
					$data_arr_tmp[$select_count]['id']=$rs[$i][id];
					$data_arr_tmp[$select_count]['cat_name']=$rs[$i][cat_name];
					$data_arr_tmp[$select_count]['upper_cat']=$rs[$i][upper_cat];
					
					$select_count_next=0;
					for($j=0;$j<sizeof($rs);$j++){
						if($rs[$j][upper_cat]==($rs[$i][upper_cat].$rs[$i][id].'.')){
							$select_count_next++;
						}
					}
					if($select_count_next>0){
						$data_arr_tmp[$select_count]["children"]=$this->recursiveCat($rs,($rs[$i][upper_cat].$rs[$i][id].'.'),$depth+1);
					}
					$this->data_arr=$data_arr_tmp;
					$select_count++;
					
				}
			}
			return $this->data_arr;
		}
		return array();
	}
}


?>