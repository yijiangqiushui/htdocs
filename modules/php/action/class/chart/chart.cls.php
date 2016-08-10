<?php
/*
author:Hao xiaoqiang
date:2014-06-10
*/
class Chart{
	public function getCount($sql){
		$db=new DB();
		$res=$db->Select($sql);
		return $res[0]['count'];
	}
	public function getData($sql){
		$db=new DB();
		$res=$db->Select($sql);
		return $res;	
		}
	
	//各个类型的推荐单位个数
	public function getTypeData_comm(){
	
		$sql="select type,count(type) as 'count' from recommend_org group by type";
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
			$resarr[$i]=array('type'=>$arr[$i]['type'],'count'=>$arr[$i]['count']);
		}
		$json=json_encode($resarr);		
		echo $json;	
	}
	//各个地域的推荐单位个数
	public function getAddressData_comm(){
	
		$sql="SELECT COUNT(*) AS count,address FROM (SELECT CASE WHEN address LIKE '%通州区%' THEN '通州区' WHEN address LIKE '%朝阳%' THEN '朝阳区' WHEN address LIKE '%东城%' THEN '东城区' WHEN address LIKE '%西城%' THEN '西城区' WHEN address LIKE '%海淀%' THEN '海淀区' WHEN address LIKE '%丰台%' THEN '丰台区' WHEN address LIKE '%昌平%' THEN '昌平区'WHEN address LIKE '%顺义%' THEN '顺义区' WHEN address LIKE '%平谷%' THEN '平谷区' WHEN address LIKE '%怀柔%' THEN '怀柔区' WHEN address LIKE '%门头沟%' THEN '门头沟区' WHEN address LIKE '%石景山%' THEN '石景山区' WHEN address LIKE '%大兴%' THEN '大兴区' ElSE '其他' END AS address FROM recommend_org) a GROUP BY address";
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
			$resarr[$i]=array('address'=>$arr[$i]['address'],'count'=>$arr[$i]['count']);
		}
		$json=json_encode($resarr);		
		echo $json;	
	}
		//各个地域的申报单位个数
	public function getAddressData_app(){
		$sql="SELECT COUNT(*) AS count,address FROM (SELECT CASE WHEN address LIKE '%通州区%' THEN '通州区' WHEN address LIKE '%朝阳区%' THEN '朝阳区' WHEN address LIKE '%东城区%' THEN '东城区' WHEN address LIKE '%西城区%' THEN '西城区' WHEN address LIKE '%海淀区%' THEN '海淀区' WHEN address LIKE '%丰台区%' THEN '丰台区' WHEN address LIKE '%昌平区%' THEN '昌平区'WHEN address LIKE '%顺义区%' THEN '顺义区' WHEN address LIKE '%平谷区%' THEN '平谷区' WHEN address LIKE '%怀柔区%' THEN '怀柔区' WHEN address LIKE '%门头沟区%' THEN '门头沟区'WHEN address LIKE '%石景山区%' THEN '石景山区' WHEN address LIKE '%大兴区%' THEN '大兴区'  END AS address FROM apply_org) a GROUP BY address";
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
			$resarr[$i]=array('address'=>$arr[$i]['address'],'count'=>$arr[$i]['count']);
		}
		$json=json_encode($resarr);		
		echo $json;	
	}
	
	
	
		//按所属国民经济行业 申报成果的统计个数
	public function getEconomic(){	
		$sql="SELECT COUNT(*) AS count,economic FROM (SELECT CASE WHEN economic = 1 THEN '农、林、牧、渔业' WHEN economic = 2 THEN '采矿业' WHEN economic = 3 THEN '制造业' WHEN economic = 4 THEN '电力、燃气及水的生产和供应业' WHEN economic = 5 THEN '建筑业' WHEN economic = 6 THEN '交通运输、仓储和邮政业' WHEN economic = 7 THEN '信息传输、计算机服务和软件业' WHEN economic = 8 THEN '批发和零售业' WHEN economic = 9 THEN '住宿和餐饮业' WHEN economic = 10 THEN '金融业' WHEN economic = 11 THEN '房地产业' WHEN economic = 12 THEN '租赁和商务服务业'  WHEN economic = 13 THEN '科学研究、技术服务和地质勘查业'  WHEN economic = 14 THEN '水利、环境和公共设施管理业'  WHEN economic = 15 THEN '居民服务和其他服务业'  WHEN economic = 16 THEN '教育' WHEN economic = 17 THEN '卫生、社会保障和社会福利业'  WHEN economic = 18 THEN '文化、体育和娱乐业'  WHEN economic = 19 THEN '公共管理和社会组织' WHEN economic = 20 THEN '国际组织'  END AS economic FROM application) a GROUP BY economic";
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
			$resarr[$i]=array('economic'=>$arr[$i]['economic'],'count'=>$arr[$i]['count']);
		}
		$json=json_encode($resarr);		
		echo $json;
		}
		//按 任务来源 统计申报结果的个数
	public function getSource(){
	
		$sql='SELECT COUNT(a.id) AS count,b.name FROM application a LEFT OUTER JOIN source_con b ON a.source=b.source  GROUP BY a.source';
		
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
				$resarr[$i]=array('name'=>$arr[$i]['name'],'count'=>$arr[$i]['count']);
			}
		$json=json_encode($resarr);
		echo $json;
		}
	//按所属科学领域 统计申报结果个数
	public function getScience(){
	
		$sql='SELECT COUNT(a.id) AS count ,b.cat_name AS name FROM application a LEFT OUTER JOIN applycattechnical b ON a.science=b.id GROUP BY a.science';		
				
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
				$resarr[$i]=array('name'=>$arr[$i]['name'],'count'=>$arr[$i]['count']);
			}
		$json=json_encode($resarr);
		echo $json;
		}
}
	

?>