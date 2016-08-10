<?php
// heyangyang
include '../../../../common/php/config.ini.php';
include '../../../../modules/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
class App {
	
	/**
	 * 修改添加了没有appid的情况
	 */
	public function addData($name, $obj) {
		$db = new DB ();
		if ($obj ['app_id'] != 0 && $obj ['app_id'] != '' && $obj ['app_id'] != null) {
			$r = $db->InsertData ( $name, $obj );
		} else {
			$r = 0;
		}
		$db->Close ();
		return $r;
	}
	public function findbyid($id, $name) {
		$db = new DB ();
		$res = $db->GetInfo ( $id, $name );
		$db->Close ();
		return $res;
	}
	public function getPath($id) {
		$db = new DB ();
		$det = $db->GetInfo ( $id, 'application_detail' );
		return $det ['filename'];
	}
	public function updateData($name, $obj, $id) {
		$db = new DB ();
		$db->UpdateData ( $name, $id, $obj );
		$db->Close ();
	}
	public function deleteData($name, $id) {
		$db = new DB ();
		$db->DelData ( $id, $name );
		$db->Close ();
	}
	public function deleteList($name, $idlist) {
		$db = new DB ();
		$db->DelArrIdData ( $idlist, $name );
		$db->Close ();
	}
	public function deleteBySql($sql) {
		$db = new DB ();
		$db->Delete ( $sql );
		$db->Close ();
	}
	public function updateBySql($sql) {
		$db = new DB ();
		$db->Update ( $sql );
		$db->Close ();
	}
	public function getListByCon($page, $rows, $count, $sql) {
		$page = ($page - 1) * $rows;
		$db = new DB ();
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		$arr = $db->Select ( $sql );
		$db->Close ();
		return $arr;
	}
	public function getListBySql($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		$db->Close ();
		return $arr;
	}
	public function getCount($sql) {
		$db = new DB ();
		$count = $db->Select ( $sql );
		$count = $count [0] ['count'];
		
		$db->Close ();
		return $count;
	}
	public function printUnit($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'sort' => $arr [$i] ['sort'],
						'name' => $arr [$i] ['name'],
						'contribute' => $arr [$i] ['contribute'],
						'address' => $arr [$i] ['address'],
						'postcode' => $arr [$i] ['postcode'],
						'nature' => $arr [$i] ['nature'],
						'type' => $arr [$i] ['type'],
						'isSeparateLegal' => $arr [$i] ['isSepatateLegal'],
						'registeNum' => $arr [$i] ['registeNum'],
						'organizationCode' => $arr [$i] ['organizationCode'],
						'zone' => $arr [$i] ['zone'],
						'web' => $arr [$i] ['web'],
						'contact' => $arr [$i] ['contact'],
						'phone' => $arr [$i] ['phone'],
						'fax' => $arr [$i] ['fax'],
						'tel' => $arr [$i] ['tel'],
						'email' => $arr [$i] ['email'],
						'proContact' => $arr [$i] ['proContact'],
						'proTel' => $arr [$i] ['proTel'],
						'proEmail' => $arr [$i] ['proEmail'] 
				);
			}
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	public function printPeople($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'sort' => $arr [$i] ['sort'],
						'name' => $arr [$i] ['name'],
						'sex' => $arr [$i] ['sex'],
						'nation' => $arr [$i] ['nation'],
						'birthplace' => $arr [$i] ['birthplace'],
						'birthdate' => $arr [$i] ['birthdate'],
						'idNumber' => $arr [$i] ['idNumber'],
						'eduLeval' => $arr [$i] ['eduLeval'],
						'graduateTime' => $arr [$i] ['graduateTime'],
						'isHomecoming' => $arr [$i] ['isHomecoming'],
						'company' => $arr [$i] ['company'],
						'phone' => $arr [$i] ['phone'],
						'email' => $arr [$i] ['email'],
						'tel' => $arr [$i] ['tel'],
						'address' => $arr [$i] ['address'],
						'graduateSchool' => $arr [$i] ['graduateSchool'],
						'major' => $arr [$i] ['major'],
						'degree' => $arr [$i] ['degree'],
						'profession' => $arr [$i] ['profession'],
						'techTitle' => $arr [$i] ['techTitle'],
						'adminPost' => $arr [$i] ['adminPost'],
						'familiarSubject' => $arr [$i] ['familiarSubject'],
						'techAward' => $arr [$i] ['techAward'],
						'startTime' => $arr [$i] ['startTime'],
						'endTime' => $arr [$i] ['endTime'],
						'contribute' => $arr [$i] ['contribute'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	public function printProof1($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'name' => $arr [$i] ['name'],
						'category' => $arr [$i] ['category'],
						'country' => $arr [$i] ['country'],
						'authorizationNum' => $arr [$i] ['authorizationNum'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	public function printProof2($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'name' => $arr [$i] ['name'],
						'evaluationForm' => $arr [$i] ['evaluationForm'],
						'organizationUnit' => $arr [$i] ['organizationUnit'],
						'evaluationTime' => $arr [$i] ['evaluationTime'],
						'evaluationLevel' => $arr [$i] ['evaluationLevel'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	public function printProof3($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'name' => $arr [$i] ['name'],
						'category' => $arr [$i] ['category'],
						'standardNo' => $arr [$i] ['standardNo'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	public function printProof4($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'testOrg' => $arr [$i] ['testOrg'],
						'client' => $arr [$i] ['client'],
						'proName' => $arr [$i] ['proName'],
						'certificateNo' => $arr [$i] ['certificateNo'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	public function printProof5($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'docName' => $arr [$i] ['docName'],
						'proName' => $arr [$i] ['proName'],
						'examUnit' => $arr [$i] ['examUnit'],
						'examDate' => $arr [$i] ['examDate'],
						'appUnit' => $arr [$i] ['appUnit'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	public function printProof6($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'unit' => $arr [$i] ['unit'],
						'contact' => $arr [$i] ['contact'],
						'phone' => $arr [$i] ['phone'],
						'startTime' => $arr [$i] ['startTime'],
						'endTime' => $arr [$i] ['endTime'],
						'benefit' => $arr [$i] ['benefit'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	public function printProof7($sql) {
		$db = new DB ();
		$arr = $db->Select ( $sql );
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'name' => $arr [$i] ['name'],
						'descrip' => $arr [$i] ['descrip'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
	
	// 主要完成单位json转换
	public function toJson($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'sort' => $arr [$i] ['sort'],
						'name' => $arr [$i] ['name'],
						'contribute' => $arr [$i] ['contribute'],
						'address' => $arr [$i] ['address'],
						'postcode' => $arr [$i] ['postcode'],
						'nature' => $arr [$i] ['nature'],
						'type' => $arr [$i] ['type'],
						'isSeparateLegal' => $arr [$i] ['isSepatateLegal'],
						'registeNum' => $arr [$i] ['registeNum'],
						'organizationCode' => $arr [$i] ['organizationCode'],
						'zone' => $arr [$i] ['zone'],
						'web' => $arr [$i] ['web'],
						'contact' => $arr [$i] ['contact'],
						'phone' => $arr [$i] ['phone'],
						'fax' => $arr [$i] ['fax'],
						'tel' => $arr [$i] ['tel'],
						'email' => $arr [$i] ['email'],
						'proContact' => $arr [$i] ['proContact'],
						'proTel' => $arr [$i] ['proTel'],
						'proEmail' => $arr [$i] ['proEmail'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	public function toJson2($obj) {
		$res = '{"id":' . $obj ['id'] . ',"sort":' . $obj ['sort'] . ',"name":"' . $obj ['name'] . '","contribute":"' . $obj ['contribute'] . '","address":"' . $obj ['address'] . '","postcode":"' . $obj ['postcode'] . '","nature":"' . $obj ['postcode'] . '","type":"' . $obj ['type'] . '","isSeparateLegal":"' . $obj ['isSeparateLegal'] . '","registeNum":"' . $obj ['registeNum'] . '","organizationCode":"' . $obj ['organizationCode'] . '","zone":"' . $obj ['zone'] . '","web":"' . $obj ['web'] . '","contact":"' . $obj ['contact'] . '","phone":"' . $obj ['phone'] . '","fax":"' . $obj ['fax'] . '","tel":"' . $obj ['tel'] . '","email":"' . $obj ['email'] . '","proContact":"' . $obj ['proContact'] . '","proTel":"' . $obj ['proTel'] . '","proEmail":"' . $obj ['proEmail'] . '"}';
		return json_encode ( json_decode ( $res, true ) );
	}
	
	// 主要完成人json转换
	public function toJsonPeo($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'sort' => $arr [$i] ['sort'],
						'name' => $arr [$i] ['name'],
						'sex' => $arr [$i] ['sex'],
						'nation' => $arr [$i] ['nation'],
						'birthplace' => $arr [$i] ['birthplace'],
						'birthdate' => $arr [$i] ['birthdate'],
						'idNumber' => $arr [$i] ['idNumber'],
						'eduLeval' => $arr [$i] ['eduLeval'],
						'graduateTime' => $arr [$i] ['graduateTime'],
						'isHomecoming' => $arr [$i] ['isHomecoming'],
						'company' => $arr [$i] ['company'],
						'phone' => $arr [$i] ['phone'],
						'email' => $arr [$i] ['email'],
						'tel' => $arr [$i] ['tel'],
						'address' => $arr [$i] ['address'],
						'graduateSchool' => $arr [$i] ['graduateSchool'],
						'major' => $arr [$i] ['major'],
						'degree' => $arr [$i] ['degree'],
						'profession' => $arr [$i] ['profession'],
						'techTitle' => $arr [$i] ['techTitle'],
						'adminPost' => $arr [$i] ['adminPost'],
						'familiarSubject' => $arr [$i] ['familiarSubject'],
						'techAward' => $arr [$i] ['techAward'],
						'startTime' => $arr [$i] ['startTime'],
						'endTime' => $arr [$i] ['endTime'],
						'contribute' => $arr [$i] ['contribute'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	
	/**
	 * 转json
	 */
	public function toJson2Peo($obj) {
		$res = array (
				'id' => $obj ['id'],
				'sort' => $obj ['sort'],
				'name' => $obj ['name'],
				'sex' => $obj ['sex'],
				'nation' => $obj ['nation'],
				'birthplace' => $obj ['birthplace'],
				'birthdate' => $obj ['birthdate'],
				'idNumber' => $obj ['idNumber'],
				'eduLeval' => $obj ['eduLeval'],
				'graduateTime' => $obj ['graduateTime'],
				'isHomecoming' => $obj ['isHomecoming'],
				'company' => $obj ['company'],
				'phone' => $obj ['phone'],
				'email' => $obj ['email'],
				'tel' => $obj ['tel'],
				'address' => $obj ['address'],
				'graduateSchool' => $obj ['graduateSchool'],
				'major' => $obj ['major'],
				'degree' => $obj ['degree'],
				'profession' => $obj ['profession'],
				'techTitle' => $obj ['techTitle'],
				'adminPost' => $obj ['adminPost'],
				'familiarSubject' => $obj ['familiarSubject'],
				'techAward' => $obj ['techAward'],
				'startTime' => $obj ['startTime'],
				'endTime' => $obj ['endTime'],
				'contribute' => $obj ['contribute'],
				'app_id' => $obj ['app_id'] 
		);
		return json_encode ( $res );
	}
	
	/**
	 * public function toJson2Peo($obj){
	 * $res='{"id":'.$obj['id'].',"sort":'.$obj['sort'].',"name":"'.$obj['name'].'","sex":"'.$obj['sex'].'","nation":"'.$obj['nation'].'","birthplace":"'.$obj['birthplace'].'","birthdate":"'.$obj['birthdate'].'","idNumber":"'.$obj['idNumber'].'","eduLeval":"'.$obj['eduLeval'].'","graduateTime":"'.$obj['graduateTime'].'","isHomecoming":"'.$obj['isHomecoming'].'","company":"'.$obj['company'].'","phone":"'.$obj['phone'].'","email":"'.$obj['email'].'","tel":"'.$obj['tel'].'","address":"'.$obj['address'].'","graduateSchool":"'.$obj['graduateSchool'].'","major":"'.$obj['major'].'","degree":"'.$obj['degree'].'","profession":"'.$obj['profession'].'","techTitle":"'.$obj['techTitle'].'","adminPost":"'.$obj['adminPost'].'","familiarSubject":"'.$obj['familiarSubject'].'","techAward":"'.$obj['techAward'].'","startTime":"'.$obj['startTime'].'","endTime":"'.$obj['endTime'].'","contribute":"'.$obj['contribute'].'","app_id":'.$obj['app_id'].'}';
	 * return json_encode(json_decode($res,true));
	 * }
	 */
	
	// 知识产权json转换
	public function toJsonKnow($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'name' => $arr [$i] ['name'],
						'category' => $arr [$i] ['category'],
						'country' => $arr [$i] ['country'],
						'authorizationNum' => $arr [$i] ['authorizationNum'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	public function toJson2Know($obj) {
		$res = '{id:' . $obj ['id'] . ',name:"' . $obj ['name'] . '",category:"' . $obj ['category'] . '",country:"' . $obj ['country'] . '",authorizationNum:"' . $obj ['authorizationNum'] . '",app_id:' . $obj ['app_id'] . '}';
		return $res;
	}
	
	// 主要技术评价json转换
	public function toJsonTech($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'name' => $arr [$i] ['name'],
						'evaluationForm' => $arr [$i] ['evaluationForm'],
						'organizationUnit' => $arr [$i] ['organizationUnit'],
						'evaluationTime' => $arr [$i] ['evaluationTime'],
						'evaluationLevel' => $arr [$i] ['evaluationLevel'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	public function toJson2Tech($obj) {
		$res = '{id:' . $obj ['id'] . ',name:"' . $obj ['name'] . '",evaluationForm:"' . $obj ['evaluationForm'] . '",organizationUnit:"' . $obj ['organizationUnit'] . '",evaluationTime:"' . $obj ['evaluationTime'] . '",evaluationLevel:"' . $obj ['evaluationLevel'] . '",app_id:' . $obj ['app_id'] . '}';
		return $res;
	}
	
	// 产品技术标准json转换
	public function toJsonSta($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'name' => $arr [$i] ['name'],
						'category' => $arr [$i] ['category'],
						'standardNo' => $arr [$i] ['standardNo'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	public function toJson2Sta($obj) {
		$res = '{id:' . $obj ['id'] . ',name:"' . $obj ['name'] . '",category:"' . $obj ['category'] . '",standardNo:"' . $obj ['standardNo'] . '",app_id:' . $obj ['app_id'] . '}';
		return $res;
	}
	
	// 产品检测报告json转换
	public function toJsonTest($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'testOrg' => $arr [$i] ['testOrg'],
						'client' => $arr [$i] ['client'],
						'proName' => $arr [$i] ['proName'],
						'certificateNo' => $arr [$i] ['certificateNo'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	public function toJson2Test($obj) {
		$res = '{id:' . $obj ['id'] . ',testOrg:"' . $obj ['testOrg'] . '",client:"' . $obj ['client'] . '",proName:"' . $obj ['proName'] . '",certificateNo:"' . $obj ['certificateNo'] . '",app_id:' . $obj ['app_id'] . '}';
		return $res;
	}
	
	// 行业审批文件json转换
	public function toJsonDoc($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'docName' => $arr [$i] ['docName'],
						'proName' => $arr [$i] ['proName'],
						'examUnit' => $arr [$i] ['examUnit'],
						'examDate' => $arr [$i] ['examDate'],
						'appUnit' => $arr [$i] ['appUnit'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	public function toJson2Doc($obj) {
		$res = '{id:' . $obj ['id'] . ',docName:"' . $obj ['docName'] . '",proName:"' . $obj ['proName'] . '",examUnit:"' . $obj ['examUnit'] . '",examDate:"' . $obj ['examDate'] . '",appUnit:"' . $obj ['appUnit'] . '",app_id:' . $obj ['app_id'] . '}';
		return $res;
	}
	// 应用证明材料json转换
	public function toJsonCer($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'unit' => $arr [$i] ['unit'],
						'contact' => $arr [$i] ['contact'],
						'phone' => $arr [$i] ['phone'],
						'startTime' => $arr [$i] ['startTime'],
						'endTime' => $arr [$i] ['endTime'],
						'benefit' => $arr [$i] ['benefit'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	public function toJson2Cer($obj) {
		$res = '{id:' . $obj ['id'] . ',unit:"' . $obj ['unit'] . '",contact:"' . $obj ['contact'] . '",phone:"' . $obj ['phone'] . '",startTime:"' . $obj ['startTime'] . '",endTime:"' . $obj ['endTime'] . '",benefit:"' . $obj ['benefit'] . '",app_id:' . $obj ['app_id'] . '}';
		return $res;
	}
	
	// 其他证明材料json转换
	public function toJsonOth($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'name' => $arr [$i] ['name'],
						'descrip' => $arr [$i] ['descrip'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		
		return $json;
	}
	public function toJson2Oth($obj) {
		$res = '{id:' . $obj ['id'] . ',name:"' . $obj ['name'] . '",descrip:"' . $obj ['descrip'] . '",app_id:' . $obj ['app_id'] . '}';
		return $res;
	}
	
	// 附件信息json转换
	public function toJsonAtt($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'title' => $arr [$i] ['title'],
						'descrip' => $arr [$i] ['descrip'],
						'attname' => $arr [$i] ['attname'],
						'autoname' => $arr [$i] ['autoname'],
						'savepath' => $arr [$i] ['savepath'],
						'pro' => $arr [$i] ['pro'] 
				);
			}
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		return $json;
	}
	public function toJson2Att($obj) {
		$res = array (
				'id' => $obj ['id'],
				'title' => $obj ['title'],
				'descrip' => $obj ['descrip'],
				'attname' => $obj ['attname'],
				'savepath' => $obj ['savepath'],
				'autoname' => $obj ['autoname'] 
		);
		return $res;
	}
	
	// 经济效益json转换
	public function toJsonBen($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'year' => $arr [$i] ['year'],
						'income' => $arr [$i] ['income'],
						'profit' => $arr [$i] ['profit'],
						'tax' => $arr [$i] ['tax'],
						'foreignCurrency' => $arr [$i] ['foreignCurrency'],
						'totalSavings' => $arr [$i] ['totalSavings'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			$json = '{"total":' . $count . ',"rows":' . json_encode ( $arr2 ) . '}';
		}
		return $json;
	}
	public function toJson2Ben($obj) {
		$res = '{id:' . $obj ['id'] . ',year:' . $obj ['year'] . ',income:' . $obj ['income'] . ',profit:' . $obj ['profit'] . ',tax:' . $obj ['tax'] . ',foreignCurrency:' . $obj ['foreignCurrency'] . ',totalSavings:' . $obj ['totalSavings'] . ',app_id:' . $obj ['app_id'] . '}';
		return $res;
	}
	
	// 推荐单位意见json转换
	public function toJsonRec($obj) {
		$res = '{id:' . $obj ['id'] . ',content:"' . $obj ['content'] . '"}';
		return $res;
	}
	
	// 项目详细信息json转换
	public function toJsonDet($obj) {
		$invest = ($obj ['invest'] != 0) ? floatval ( $obj ['invest'] ) : '""';
		$recoverDate = ($obj ['recoverDate'] != 0) ? intval ( $obj ['recoverDate'] ) : '""';
		/*
		 * $res='{id:'.$obj['id'].',background:"'.str_replace("\r",'------',$obj['background']).'",
		 * scienceCon:"'.$obj['scienceCon'].'",extend:"'.$obj['extend'].'",effect:"'.$obj['effect'].'",
		 * socialeffect:"'.$obj['socialeffect'].'",invest:'.$invest.',recoverDate:'.$recoverDate.',
		 * casculBasis:"'.$obj['casculBasis'].'",economicBenefit:"'.$obj['economicBenefit'].'",app_id:'.$obj['app_id'].',isSave:'.$obj['isSave'].'}';
		 */
		$json = array (
				'id' => $obj ['id'],
				'background' => $obj ['background'],
				'scienceCon' => $obj ['scienceCon'],
				'extend' => $obj ['extend'],
				'effect' => $obj ['effect'],
				'socialeffect' => $obj ['socialeffect'],
				'invest' => $obj ['invest'],
				'recoverDate' => $obj ['recoverDate'],
				'casculBasis' => $obj ['casculBasis'],
				'economicBenefit' => $obj ['economicBenefit'],
				'app_id' => $obj ['app_id'],
				'isSave' => $obj ['isSave'] 
		);
		return json_encode ( $json ); // $res;
	}
	public function queryAdvice($id, $str) {
		$db = new DB ();
		$sql = 'select ' . $str . ' from application where id=' . $id;
		$result = $db->Select ( $sql );
		
		return $result [0] [$str];
	}
	public function toJsonArrayBen($arr, $count) {
		if (count ( $arr ) === 0) {
			$json = '[]';
		} else {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$arr2 [$i] = array (
						'id' => $arr [$i] ['id'],
						'year' => $arr [$i] ['year'],
						'income' => $arr [$i] ['income'],
						'profit' => $arr [$i] ['profit'],
						'tax' => $arr [$i] ['tax'],
						'foreignCurrency' => $arr [$i] ['foreignCurrency'],
						'totalSavings' => $arr [$i] ['totalSavings'],
						'app_id' => $arr [$i] ['app_id'] 
				);
			}
			$json = json_encode ( $arr2 );
		}
		return $json;
	}
}

?>