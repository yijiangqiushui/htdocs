<?php

/**
 author:Gao Xue
 date:2014-05-23
 */
class APPLY {
	function queryApply($applyinfo) {
		$db = new DB ();
		global $page;
		global $rows;
		global $upper_cat;
		global $flag;
		global $con_cat;
		global $num;
		// echo $flag.'------'.$upper_cat.'------';
		$page = ($page - 1) * $rows;
		$upper_cat = isset ( $upper_cat ) ? $upper_cat : '.';
		if ($num != 1) {
			$upper_cat = $flag == 'expertCat' ? $upper_cat = $con_cat : $upper_cat;
		}
		$sql = 'select * from application where isRefer=1 and ' . $flag . ' like "%' . $upper_cat . '%"';
		$sqlCount = 'select count(id) as "count" from application where isRefer=1 and ' . $flag . ' like "%' . $upper_cat . '%"';
		
		if ($applyinfo ['aname'] !== null && $applyinfo ['aname'] !== '') {
			$str = '"%' . $applyinfo ['aname'] . '%"';
			$sql = $sql . ' and aname like ' . $str;
			$sqlCount = $sqlCount . ' and aname like ' . $str;
		}
		if ($applyinfo ['impPerson'] !== null && $applyinfo ['impPerson'] !== '') {
			$str = '"%' . $applyinfo ['impPerson'] . '%"';
			$sql = $sql . ' and impPerson like ' . $str;
			$sqlCount = $sqlCount . ' and impPerson like ' . $str;
		}
		if ($applyinfo ['completeOrg'] !== null && $applyinfo ['completeOrg'] !== '') {
			$str = '"%' . $applyinfo ['completeOrg'] . '%"';
			$sql = $sql . ' and completeOrg like ' . $str;
			$sqlCount = $sqlCount . ' and completeOrg like ' . $str;
		}
		$sql = $sql . ' order by id desc limit ' . $page . ',' . $rows;
		
		$result = $db->Select ( $sql );
		$resCount = $db->Select ( $sqlCount );
		$count = $resCount [0] ['count'];
		
		if (count ( $result ) === 0) {
			$applyJSON = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $result ); $i ++) {
				$sqlSel = 'select * from recommend_org where id=' . $result [$i] ['rec_org'];
				$res = $db->Select ( $sqlSel );
				
				$sql_1 = 'select * from apply_org where id=' . $result [$i] ['org_id'];
				$res_1 = $db->Select ( $sql_1 );
				
				$arr [$i] = array (
						'id' => $result [$i] ['id'],
						'aname' => $result [$i] ['aname'],
						'impPerson' => $result [$i] ['impPerson'],
						'completeOrg' => $result [$i] ['completeOrg'],
						'completePhone' => $result [$i] ['completePhone'],
						'recOrg' => $res [0] ['name'],
						'recPhone' => $res [0] ['tel'],
						'planID' => $result [$i] ['planID'],
						'proStart' => $result [$i] ['proStart'],
						'proEnd' => $result [$i] ['proEnd'],
						'proState' => $result [$i] ['proState'],
						'checkAdvice' => $result [$i] ['checkAdvice'],
						'expertCat' => $result [$i] ['expertCat'],
						'orgName' => $res_1 [0] ['orgName'] 
				);
			}
			// $arr=array();
			$applyJSON = '{"total":' . $count . ',"rows":' . json_encode ( $arr ) . '}';
			
			/*
			 * $applyJSON=array(
			 * 'total'=>$count,
			 * 'rows'=>$arr
			 * );
			 */
		}
		// echo json_encode($applyJSON);
		echo $applyJSON;
		$db->Close ();
	}
	
	/**
	 *
	 * @param unknown $applyinfo
	 *        	项目承担单位基本信息
	 */
	function org_info($table_name, $applyinfo, $org_id, $tid) {
		$db = new DB ();
		// $applyinfo['year']=date('Y',time());
		// if($_SESSION['app_id']==''&&$_SESSION['app_id']==null){
		// $applyinfo['org_id']=$_SESSION['org_id'];
		$result = $db->UpdateTabData ( $table_name, $org_id, $applyinfo, $tid );
		
		// $_SESSION['app_id']=$result;
		// }else{
		// $result=$db->UpdateData('application',$_SESSION['app_id'],$applyinfo);
		// }
		echo $result;
		$db->Close ();
	}
	
	/**
	 * 项目目的、意义及必要性
	 */
	function project_mean($table_name, $project_id, $project_mean) {
		$db = new DB ();
		/* 缺少存入project_id 的值 */
		$result = $db->updateInfo ( $table_name, $project_id, $project_mean );
		echo $result;
		$db->Close ();
	}
	function unit_provement($project_id, $check_material, $instrument_list, $equipment_list) {
		$db = new DB ();
		
		$result1 = $db->updateInfo ( "check_material", $project_id, $check_material );
		
		$result2 = $db->Delete ( "delete from shareholder_info  where project_id=$project_id" );
		
		foreach ( $instrument_list as $tem ) {
			$result3 = $db->InsertData ( 'instrument_list', $tem );
		}
		
		foreach ( $equipment_list as $tem ) {
			$result4 = $db->InsertData ( 'equipment_list', $tem );
		}
		
		$db->Close ();
	}
	function project_status($table_name, $project_id, $project_status) {
		$db = new DB ();
		$result = $db->updateInfo ( $table_name, $project_id, $project_status );
		echo $result;
		$db->Close ();
	}
	function project_target($table_name, $project_id, $project_target) {
		$db = new DB ();
		$result = $db->updateInfo ( $table_name, $project_id, $project_target );
		echo $result;
		$db->Close ();
	}
	function project_content($table_name, $project_id, $project_content) {
		$db = new DB ();
		$result = $db->updateInfo ( $table_name, $project_id, $project_content );
		echo $result;
		$db->Close ();
	}
	
	/**
	 * 2015.09.28注释
	 */
	function project_techway($table_name, $project_id, $project_techway) {
		$db = new DB ();
		$result = $db->updateInfo ( $table_name, $project_id, $project_techway );
		echo $result;
		$db->Close ();
	}
	function project_ann($table_name, $project_id, $project_ann) {
		$db = new DB ();
		$sql_del = "delete from project_ann_plan where project_id = '$project_id' ";
		$result_del = $db->Delete ( $sql_del );
		foreach ( $project_ann as $tmp ) {
			$result = $db->InsertData ( $table_name, $tmp );
		}
	}
	function task_project_ann($table_name, $project_id, $project_ann) {
		$db = new DB ();
		$sql_del = "delete from project_ann_plan where task_project_id = '$project_id' ";
	    echo $sql_del;
		$result_del = $db->Delete ( $sql_del );
		foreach ( $project_ann as $tmp ) {
			$result = $db->InsertData ( $table_name, $tmp );
			echo $result.'\n';
		}
		$db->Close();
	}
	function project_risk($table_name, $project_id, $project_risk) {
		$db = new DB ();
		$result = $db->updateInfo ( 'project_info', $project_id, $project_risk );
		$db->Close ();
	}
	function project_expect($table_name, $project_id, $project_expect) {
		$db = new DB ();
		$result = $db->updateInfo ( 'project_info', $project_id, $project_expect );
		$db->Close ();
	}
	function project_effect($table_name, $project_id, $project_effect) {
		$db = new DB ();
		$result = $db->updateInfo ( 'project_info', $project_id, $project_effect );
		$db->Close ();
	}
	function project_member( $table, $project_leader,$project_id, $project_researcher, $project_joinorg) {
		$db = new DB ();
		$sql = "delete from researchers where project_id = '$project_id'";
		//var_dump($project_joinorg);
		$result_del = $db->Delete ( $sql );
		
		foreach ( $project_researcher as $tmp ) {
			$result = $db->InsertData ( "researchers", $tmp );
		}
		
		
		$result_principal = $db->updateInfo ( 'project_principal', $project_id, $project_leader );
		
		$db->Delete("delete from project_org  where project_id= '$project_id' ");
		
		foreach ( $project_joinorg as $tmp ) {
				$result = $db->InsertData( 'project_org', $tmp );
			}
// 		}
	}
	
	
	function task_project_member( $table, $project_leader,$project_id, $project_researcher, $project_joinorg) {
		$db = new DB ();     
		$sql = "delete from researchers where task_project_id = '$project_id'";
		$result_del = $db->Delete ( $sql );
		// echo count($project_researcher);将项目研究人员的基本信息进行入库的操作
		foreach ( $project_researcher as $tmp ) {
			$result = $db->InsertData ( "researchers", $tmp );
		}
// 		print_r($project_leader);
		$result_principal = $db->updateInfo4('project_principal',"task_project_id", $project_id, $project_leader);
		
		$db->Delete("delete from project_org  where task_project_id= '$project_id' ");
		foreach ( $project_joinorg as $tmp ) { 
				$result = $db->InsertData( 'project_org', $tmp );
		}
	}
	function expert_sign($name,$project_id,$expert_list, $project_info ) {
		$db = new DB ();
		$result1 = $db->UpdateTabData ( 'project_info', $project_id, $project_info, 'project_id' );
		
		$result3 = $db->Delete ( "delete from experts where project_id=$project_id" );
		foreach ( $expert_list as $tem ) {
			$result2 = $db->InsertData ( 'experts', $tem );
		}
		$db->Close ();
	}
	
	/**
	 */
	function uptApply($applyinfo, $id, $flag) {
		$db = new DB ();
		$result = $db->UpdateData ( 'application', $id, $applyinfo );
		echo $result;
	}
	
	/**
	 */
	function saveBrief($brief) {
		if ($_SESSION ['app_id'] == '' && $_SESSION ['app_id'] == null) {
			echo '0';
		} else {
			$db = new DB ();
			$query = $db->Select ( "select count(*) as count from application_brief where app_id = " . $_SESSION ['app_id'] );
			if ($query [0] ['count'] > 0) {
				$sql = 'update application_brief set proBrief="' . $brief ['proBrief'] . '" where app_id=' . $_SESSION ['app_id'];
				$result = $db->Update ( $sql );
			} else {
				$result = $db->InsertData ( 'application_brief', $brief );
			}
			echo $result;
			$db->Close ();
		}
	}
	
	/**
	 */
	function uptBrief($brief, $id, $flag) {
		$db = new DB ();
		$sqlQuery = 'select * from application_brief where app_id=' . $id;
		$result = $db->Select ( $sqlQuery );
		if (count ( $result ) == '1') {
			$sql = 'update application_brief set proBrief="' . $brief ['proBrief'] . '" where app_id=' . $id;
			$result = $db->Update ( $sql );
		} else {
			$brief ['app_id'] = $id;
			$result = $db->InsertData ( 'application_brief', $brief );
		}
		echo $result;
		$db->Close ();
	}
	
	/**
	 */
	function saveCreate($create) {
		if ($_SESSION ['app_id'] == '' && $_SESSION ['app_id'] == null) {
			echo '0';
		} else {
			$db = new DB ();
			$query = $db->Select ( "select count(*) as count from application_create where app_id = " . $_SESSION ['app_id'] );
			if ($query [0] ['count'] > 0) {
				$sql = 'update application_create set proCreat="' . $create ['proCreat'] . '" where app_id=' . $_SESSION ['app_id'];
				$result = $db->Update ( $sql );
			} else {
				$result = $db->InsertData ( 'application_create', $create );
			}
			echo $result;
			$db->Close ();
		}
	}
	
	/**
	 */
	function uptCreate($create, $id) {
		$db = new DB ();
		$sqlQuery = 'select * from application_create where app_id=' . $id;
		$result = $db->Select ( $sqlQuery );
		if (count ( $result ) == '1') {
			$sql = 'update application_create set proCreat="' . $create ['proCreat'] . '" where app_id=' . $id;
			$result = $db->Update ( $sql );
		} else {
			$create ['app_id'] = $id;
			$result = $db->InsertData ( 'application_create', $create );
		}
		echo $result;
		$db->Close ();
	}
	
	/**
	 */
	function checkApply($id) {
		$db = new DB ();
		$sql = 'update application set isCheck=1 where id= ' . $id;
		$result = $db->Update ( $sql );
		echo $result;
	}
	
	/**
	 */
	function scoreApply($id, $score) {
		$db = new DB ();
		$score ['applyId'] = $id;
		$result = $db->InsertData ( 'scoreinfo', $score );
		echo $result;
		$db->Close ();
	}
	
	/**
	 */
	function getScore($applyId) {
		$db = new DB ();
		$sql = 'select flag from scoreinfo where applyId=' . $applyId . ' and expertId=' . $_SESSION ['admin_id'];
		
		$result = $db->Select ( $sql );
		
		if ($result [0] ['flag'] == 1) {
			echo json_encode ( 'error' );
		} else {
			echo json_encode ( 'ok' );
		}
	}
	
	/**
	 */
	function queryScore($id) {
		$db = new DB ();
		global $page;
		global $rows;
		
		$page = ($page - 1) * $rows;
		$upper_cat = isset ( $upper_cat ) ? $upper_cat : '.';
		
		$sql = 'select * from scoreinfo where applyId=' . $id;
		$sqlCount = 'select count(id) as "count" from scoreinfo where applyId=' . $id;
		
		$sql = $sql . ' limit ' . $page . ',' . $rows;
		
		$result = $db->Select ( $sql );
		$resCount = $db->Select ( $sqlCount );
		$count = $resCount [0] ['count'];
		
		if (count ( $result ) === 0) {
			$scoreJSON = '{"total":0,"rows":[]}';
		} else {
			for($i = 0; $i < count ( $result ); $i ++) {
				$sqlUsr = 'select * from admininfo where id=' . $result [$i] ['expertId'];
				$res = $db->Select ( $sqlUsr );
				$arr [$i] = array (
						'id' => $result [$i] ['id'],
						'creative' => $result [$i] ['creative'],
						'scientific' => $result [$i] ['scientific'],
						'difficulty' => $result [$i] ['difficulty'],
						'advanced' => $result [$i] ['advanced'],
						'benefits' => $result [$i] ['benefits'],
						'effectiveness' => $result [$i] ['effectiveness'],
						'prospect' => $result [$i] ['prospect'],
						'popularize' => $result [$i] ['popularize'],
						'close1' => $result [$i] ['closes'],
						'affect' => $result [$i] ['affect'],
						'property' => $result [$i] ['property'],
						'technology' => $result [$i] ['technology'],
						'expertId' => $res [0] ['realname'] 
				);
			}
			$scoreJSON = '{"total":' . $count . ',"rows":' . json_encode ( $arr ) . '}';
		}
		echo $scoreJSON;
		$db->Close ();
	}
	function queryRecOrg() {
		$sql = 'select * from recommend_org';
		$db = new DB ();
		$result = $db->Select ( $sql );
		
		for($i = 0; $i < count ( $result ); $i ++) {
			$node [$i] ['id'] = $result [$i] ['id'];
			$node [$i] ['text'] = $result [$i] ['name'];
			$node [$i] ['iconCls'] = 'icon-blank';
		}
		echo json_encode ( $node );
	}
	
	/**
	 */
	function findApply($id) {
		$db = new DB ();
		$result = $db->GetInfo ( $id, 'application' );
		$sql = 'SELECT * FROM recommend_org where id=' . $result ['rec_org'];
		$resRec = $db->Select ( $sql );
		
		$appJSON = array (
				'id' => $result ['id'],
				'aname' => $result ['aname'],
				'impPerson' => $result ['impPerson'],
				'completeOrg' => $result ['completeOrg'],
				'completeAdress' => $result ['completeAdress'],
				'completeCode' => $result ['completeCode'],
				'completePerson' => $result ['completePerson'],
				'completeTel' => $result ['completeTel'],
				'completePhone' => $result ['completePhone'],
				'completeFax' => $result ['completeFax'],
				'completeEmail' => $result ['completeEmail'],
				'rec_org' => $resRec [0] ['id'],
				'recOrg' => $resRec [0] ['name'],
				'recAdress' => $resRec [0] ['address'],
				'recCode' => $resRec [0] ['postcode'],
				'recPerson' => $resRec [0] ['linkman'],
				'recTel' => $resRec [0] ['tel'],
				'recPhone' => $resRec [0] ['phone'],
				'recFax' => $resRec [0] ['fax'],
				'recEmail' => $resRec [0] ['email'],
				'economic' => $result ['economic'],
				'science' => $result ['science'],
				'scienceCat' => $result ['scienceCat'],
				'source' => $result ['source'],
				'planID' => $result ['planID'],
				'proStart' => $result ['proStart'],
				'proEnd' => $result ['proEnd'],
				'year' => $result ['year'],
				'isCheck' => $result ['isCheck'],
				'isSave' => $result ['isSave'],
				'checkAdvice' => $result ['checkAdvice'],
				'org_id' => $result ['org_id'],
				'isRefer' => $result ['isRefer'] 
		);
		echo json_encode ( $appJSON );
		$db->close ();
	}
	
	/**
	 */
	function findBrief($id) {
		$db = new DB ();
		$sql = 'select * from application_brief where app_id= ' . $id;
		$result = $db->Select ( $sql );
		$briefJSON = array (
				'id' => $result [0] ['id'],
				'proBrief' => $result [0] ['proBrief'],
				'app_id' => $result [0] ['app_id'],
				'isSave' => $result [0] ['isSave'] 
		);
		echo json_encode ( $briefJSON );
		$db->close ();
	}
	
	/**
	 */
	function findCreate($id) {
		$db = new DB ();
		$sql = 'select * from application_create where app_id= ' . $id;
		$result = $db->Select ( $sql );
		$briefJSON = array (
				'id' => $result [0] ['id'],
				'proCreat' => $result [0] ['proCreat'],
				'app_id' => $result [0] ['app_id'],
				'isSave' => $result [0] ['isSave'] 
		);
		echo json_encode ( $briefJSON );
		$db->close ();
	}
	
	/**
	 * 项目详细内容
	 */
	function findDetail($id) {
		$db = new DB ();
		$sql = 'select * from application_detail where app_id= ' . $id;
		$result = $db->Select ( $sql );
		$briefJSON = array (
				'id' => $result [0] ['id'],
				'background' => $result [0] ['background'],
				'scienceCon' => $result [0] ['scienceCon'],
				'extend' => $result [0] ['extend'],
				'effect' => $result [0] ['effect'],
				'socialeffect' => $result [0] ['socialeffect'],
				'invest' => $result [0] ['invest'],
				'recoverDate' => $result [0] ['recoverDate'],
				'casculBasis' => $result [0] ['casculBasis'],
				'economicBenefit' => $result [0] ['economicBenefit'],
				'app_id' => $result [0] ['app_id'] 
		);
		echo json_encode ( $briefJSON );
		$db->close ();
	}
	
	/**
	 * 推荐单位意见
	 */
	function findRecommend($id) {
		$db = new DB ();
		$sql = 'select * from application_recommend where app_id= ' . $id;
		$result = $db->Select ( $sql );
		$briefJSON = array (
				'id' => $result [0] ['id'],
				'content' => $result [0] ['content'],
				'app_id' => $result [0] ['app_id'] 
		);
		echo json_encode ( $briefJSON );
		$db->close ();
	}
	
	/**
	 */
	function findApplyInfo() {
		if ($_SESSION ['app_id'] !== '' && $_SESSION ['app_id'] != null) {
			$this->findApply ( $_SESSION ['app_id'] );
		} else {
			echo '0';
		}
	}
	
	/**
	 */
	function findBriefInfo() {
		if ($_SESSION ['app_id'] !== '' && $_SESSION ['app_id'] != null) {
			$this->findBrief ( $_SESSION ['app_id'] );
		} else {
			echo '0';
		}
	}
	
	/**
	 */
	function findCreatInfo() {
		if ($_SESSION ['app_id'] !== '' && $_SESSION ['app_id'] != null) {
			$this->findCreate ( $_SESSION ['app_id'] );
		} else {
			echo '0';
		}
	}
	function findDetailInfo() {
		if ($_SESSION ['app_id'] !== '' && $_SESSION ['app_id'] != null) {
			$this->findDetail ( $_SESSION ['app_id'] );
		} else {
			echo '0';
		}
	}
	function resetCheck($id, $str) {
		$db = new DB ();
		$sql = 'update application set ' . $str . ' = " ' . '" where id= ' . $id;
		$result = $db->Update ( $sql );
		echo $result;
	}
	function uptProState($id, $proState) {
		$db = new DB ();
		if ($proState ['checkAdvice'] == '') {
			$str = '';
		} else {
			$str = ',checkAdvice="' . $proState ['checkAdvice'] . '"';
		}
		$sql = 'update application set proState= ' . $proState ['proState'] . $str . ' where id=' . $id;
		$result = $db->Update ( $sql );
		echo $result;
	}
	function service_team_info($service_team_info, $org_code) {
		$db = new DB ();
		$result1 = $db->UpdateTabData ( 'service_team', $org_code, $service_team_info, 'org_code' );
		$db->Close ();
	}
	/**
	 * manager_info
	 */
	function manager_info($manager_info) {
		$db = new DB ();
		$result1 = $db->UpdateTabData ( 'manager', '', $manager_info, '' );
		$db->Close ();
	}
	function queryExpertList() {
		$db = new DB ();
		$sql = 'select * from admincat where catName="专家"';
		$resultOne = $db->Select ( $sql );
		$id = $resultOne [0] ['id'];
		$upperCat = $resultOne [0] ['upperCat'];
		
		$sqlExpert = 'select * from admininfo where category like "' . $upperCat . $id . '.' . '%"';
		$resultList = $db->Select ( $sqlExpert );
		
		for($i = 0; $i < count ( $resultList ); $i ++) {
			$node [$i] ['id'] = $resultList [$i] ['id'];
			$node [$i] ['text'] = $resultList [$i] ['usr'];
			$node [$i] ['iconCls'] = 'icon-blank';
		}
		echo json_encode ( $node );
	}
	function queryYear() {
		$year = YEAR;
		$arr = explode ( ',', $year );
		
		for($i = 0; $i < count ( $arr ); $i ++) {
			$yearArr [$i] = array (
					'id' => $i + 1,
					'text' => $arr [$i] 
			);
		}
		echo json_encode ( $yearArr );
	}
	function queryScience() {
		$sql = "select * from applycatTechnical";
		$db = new DB ();
		$result = $db->Select ( $sql );
		for($i = 0; $i < count ( $result ); $i ++) {
			$scienceArr [$i] = array (
					'id' => $result [$i] ['id'],
					'cat_name' => $result [$i] ['cat_name'],
					'upper_cat' => $result [$i] ['upper_cat'],
					'upper_id' => $result [$i] ['upper_id'],
					'is_leaf' => $result [$i] ['is_leaf'] 
			);
		}
		
		$db->Close ();
		/*
		 * $science=SCIENCE;
		 * $arr=explode(',',$science);
		 *
		 * for($i=0;$i<count($arr);$i++){
		 * $scienceArr[$i]=array('id'=>$i+1,'text'=>$arr[$i]);
		 * }
		 */
		echo json_encode ( $scienceArr );
	}
	function queryEconomic() {
		$economic = ECONOMIC;
		$arr = explode ( ',', $economic );
		
		for($i = 0; $i < count ( $arr ); $i ++) {
			$economicArr [$i] = array (
					'id' => $i + 1,
					'text' => $arr [$i] 
			);
		}
		echo json_encode ( $economicArr );
	}
	function arrClassify($idlist, $expertTeam) {
		$idarray = explode ( ',', $idlist );
		$db = new DB ();
		for($i = 0; $i < count ( $idarray ); $i ++) {
			$sql_edit = 'update application set expertCat="' . $expertTeam . '" where id=' . $idarray [$i];
			$res = $db->Update ( $sql_edit );
		}
		$db->Close ();
	}
	function queryRepeat($id, $page, $rows) {
		$db = new DB ();
		$sql = "select a.aname,a_b.proBrief,a_c.proCreat,a_d.background,a_d.scienceCon,a_d.extend,a_d.effect,a_d.socialeffect from application a,application_brief a_b,application_create a_c,application_detail a_d where a.id=a_b.app_id and a.id=a_c.app_id and a.id=a_d.app_id and a.id=$id limit 0,1";
		$rs = $db->Select ( $sql );
		
		$page = ($page - 1) * $rows;
		$page = $page > 0 ? $page : 0;
		
		// if($_COOKIE['application_id']!=$id){//第一次查询后把结果保存到cookie中，如果已经在Cookie中保存，则不再分析查重，直接从cookie查询，加快查询速度
		// $_COOKIE['application_id']=$id;
		$cd = new CheckDuplicate ();
		
		$sql = "select a.id,a.aname,a_b.proBrief,a_c.proCreat,a_d.background,a_d.scienceCon,a_d.extend,a_d.effect,a_d.socialeffect from application a,application_brief a_b,application_create a_c,application_detail a_d where a.id=a_b.app_id and a.id=a_c.app_id and a.id=a_d.app_id and a.id<>$id order by a.id desc";
		$result = $db->Select ( $sql );
		$id_arr = array ();
		$idCount = 0;
		if (count ( $result ) === 0) {
			$json_arr = array (
					"total" => 0,
					"rows" => array () 
			);
		} else {
			$arr_count = count ( $result );
			$config = array (
					'charset' => 'utf-8',
					'checklength' => 18 
			);
			$cd->set_config ( $config ); // 配置相关参数
			for($i = 0; $i < $arr_count; $i ++) {
				if ($cd->checkRepeat ( $rs [0] ['aname'], $result [$i] ['aname'] ) || $cd->checkRepeat ( $rs [0] ['proBrief'], $result [$i] ['proBrief'] ) || $cd->checkRepeat ( $rs [0] ['proCreat'], $result [$i] ['proCreat'] ) || $cd->checkRepeat ( $rs [0] ['background'], $result [$i] ['background'] ) || $cd->checkRepeat ( $rs [0] ['scienceCon'], $result [$i] ['scienceCon'] ) || $cd->checkRepeat ( $rs [0] ['extend'], $result [$i] ['extend'] ) || $cd->checkRepeat ( $rs [0] ['effect'], $result [$i] ['effect'] ) || $cd->checkRepeat ( $rs [0] ['socialeffect'], $result [$i] ['socialeffect'] )) {
					$id_arr [$idCount ++] = $result [$i] ['id'];
				}
			}
			if (count ( $id_arr ) < 1) {
				$_COOKIE ['app_repeat_total'] = 0;
				$_COOKIE ['app_id_arr'] = '';
				$json_arr = array (
						"total" => 0,
						"rows" => array () 
				);
			} else {
				$_COOKIE ['app_repeat_total'] = count ( $id_arr );
				$_COOKIE ['app_id_arr'] = implode ( ',', $id_arr );
				$json_arr = $this->queryRepeatResult ( $db, $page, $rows );
			}
		}
		// }
		// else{
		// $json_arr=$this->queryRepeatResult($db,$page,$rows);
		// }
		echo json_encode ( $json_arr );
		$db->Close ();
	}
	function queryRepeatResult($db, $page, $rows) {
		$json_arr = array (
				"total" => $_COOKIE ['app_repeat_total'],
				"rows" => array () 
		);
		$sql = "select id,aname,impPerson,completeOrg,completePhone from application where id in(" . $_COOKIE ['app_id_arr'] . ") limit $page,$rows";
		$result = $db->Select ( $sql );
		$arr = array ();
		for($i = 0; $i < count ( $result ); $i ++) {
			$arr [$i] = array (
					'id' => $result [$i] ['id'],
					'aname' => $result [$i] ['aname'],
					'impPerson' => $result [$i] ['impPerson'],
					'completeOrg' => $result [$i] ['completeOrg'],
					'completePhone' => $result [$i] ['completePhone'] 
			);
		}
		$json_arr ['rows'] = $arr;
		return $json_arr;
	}
	function queryScoreCat($expertCat) {
		$db = new DB ();
		$sql = 'select userPrivileges from admincat where userPrivileges like "%' . $expertCat . '%"';
		$result = $db->Select ( $sql );
		if (strpos ( $result [0] ['userPrivileges'], 'score0' ) > 0) {
			echo json_encode ( array (
					'score' => 'score0' 
			) );
		}
		if (strpos ( $result [0] ['userPrivileges'], 'score1' ) > 0) {
			echo json_encode ( array (
					'score' => 'score1' 
			) );
		}
	}
}

?>