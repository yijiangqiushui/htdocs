<?php
//Modified By Gao Xue 2015-04-08
class CSVList{
	public function import_list($admin_id,$isRecovery){
	 	$filename = $_FILES['file']['tmp_name']; 
		if (empty ($filename)) { 
			echo '请选择要导入的CSV文件！'; 
			exit; 
		}else{
			$ext=substr(strrchr($_FILES['file']['name'], '.'), 1);
			if($ext=='csv'){
				$handle = fopen($filename, 'r'); 
				$result = $this->input_csv($handle); //解析csv 
				$len_result = count($result);
				if($len_result==0){ 
					echo '没有任何数据！'; 
					exit; 
				} 
				/*
				for($i = 0; $i < $len_result; $i++){
					$csv_arr[$i]=array(
						'name'=>iconv('gb2312', 'utf-8', $result[$i+1][0]),
						'tel'=>$result[$i+1][1],
						'company'=>iconv('gb2312', 'utf-8', $result[$i+1][2]),
						'job'=>iconv('gb2312', 'utf-8', $result[$i+1][3]),
						'catName'=>iconv('gb2312', 'utf-8', $result[$i+1][4]),
					);
				}
				$db=new DB();
				//覆盖原分组
				if($isRecovery=='1'){
					for($i = 0; $i < $len_result; $i++){
						$catnameArr=explode('-',$csv_arr[$i]['catName']);
						for($j = 0; $j < count($catnameArr); $j++){
							if($j==0){
								$catname_sql="select * from smslistcat where cat_name='".$catnameArr[$j]."' and user_id=".$_SESSION['admin_id'];
							}else{
								$catname_sql="select * from smslistcat where cat_name='".$catnameArr[$j]."' and user_id=".$_SESSION['admin_id'];
							}
							$listcat=$db->Select($catname_sql);
							if(count($listcat)>0){
								
							}
						}
					}
					
				}else{
				//不覆盖原分组
					
				}
				return;
				*/
				$dept=array();
				$dept1=array();
				for ($i = 1; $i < $len_result; $i++) { //循环获取各字段值 
					$name = iconv('gb2312', 'utf-8', $result[$i][0]); //中文转码 
					$tel = $result[$i][1];
					$company=iconv('gb2312', 'utf-8', $result[$i][2]);
					$job=iconv('gb2312', 'utf-8', $result[$i][3]);
					$cat_names=iconv('gb2312', 'utf-8', $result[$i][4]);
					$arrs=explode("-",$cat_names);
					$cat_name=$arrs[0];
					$dept[$i-1]=$cat_name;
					$dept1[$i-1]="'".$cat_name."'";
					$data_values .= "('.".$cat_name.".','$name','$tel','$company','$job','$admin_id'),"; 
				}
				$sql_cat="select * from smslistcat where user_id=$admin_id";
				$db=new DB();
				$cat=$db->Select($sql_cat);
				$cat2=array();$k=0;
				for($i=0;$i<count($cat);$i++){
					for($j=count($dept)-1;$j>=0;$j--){
						if($cat[$i]['cat_name']==$dept[$j]){
							array_splice($dept,$j,1);
						}
					}
				}
				$str='';
				for($i=0;$i<count($dept);$i++){
					$str.=" ('".$dept[$i]."','0','.','".$admin_id."'), " ;
				}
				if(count($dept)>0){
					$sql_insert_cat="insert into smslistcat (cat_name,upper_id,upper_cat,user_id) values ".substr($str,0,-2);
					$query = mysql_query($sql_insert_cat);
					//$sql_del_cat="DELETE FROM smslistcat WHERE id IN (SELECT c.id FROM (SELECT b.id FROM smslistcat b GROUP BY CONCAT(b.cat_name,b.upper_cat,b.upper_id)  HAVING COUNT(*)>1) c)";
					$sql_del_cat="DELETE a FROM smslistcat a LEFT JOIN( SELECT id FROM smslistcat GROUP BY cat_name,upper_cat,upper_id,user_id )b ON a.id=b.id WHERE b.id IS NULL";
					$res0=$db->Delete($sql_del_cat);
				}
				$sql_query_cat="select *, concat(upper_cat,id,'.') as category from smslistcat where cat_name in (".implode(',',$dept1)." ) and user_id=$admin_id";
				//echo $sql_query_cat.'---';return;
				$query_cat=$db->Select($sql_query_cat);
				for($i=0;$i<count($query_cat);$i++){
					$data_values=str_replace(".".$query_cat[$i]['cat_name'].".",$query_cat[$i]['category'],$data_values);
				}
				$data_values = substr($data_values,0,-1); //去掉最后一个逗号
				fclose($handle); //关闭指针
				
				$query = mysql_query("insert into smslistinfo (category,name,tel,company,job,admin_id) values $data_values");//批量插入数据表中
				//$sql_del="DELETE FROM smslistinfo WHERE id IN (SELECT c.id FROM (SELECT b.id FROM smslistinfo b GROUP BY b.name, b.category  HAVING COUNT(*)>1) c)";
				$sql_del="DELETE  a FROM smslistinfo a LEFT JOIN( SELECT id FROM (SELECT * FROM smslistinfo ORDER BY add_time DESC) c  GROUP BY NAME,category )b ON a.id=b.id WHERE b.id IS NULL";
				$res1=$db->Delete($sql_del);
				$db->Close(); 
				if($query){ 
					echo '导入成功！'; 
				}else{ 
					echo '导入失败！'; 
				} 	
			}else{
				echo '请导入csv文件';
				return;
			}
		}
	}
	
	public function export_list($admin_id,$category,$otherListID,$admin_other){
		$db=new DB();
		if($otherListID=='0'){
			  $sql="SELECT a.name, a.tel, a.company, a.job, a.admin_id, b.cat_name, b.id, a.category, b.upper_cat FROM smslistinfo a ,smslistcat b WHERE a.category= CONCAT(b.upper_cat,b.id,'.') ";
				if($category!="."){
					$sql.=" AND a.category like '".$category."%' ";
				}
				//if($admin_id!=1){
					if($admin_other==0){		      
						$sql.=" AND admin_id = ".$admin_id;
					}else{
						$sql.=" AND admin_id = ".$admin_other;
					}
				//}
				$sql.=" ORDER BY cat_name, a.admin_id ";
		}else{
				$sql="select a.*,b.cat_name,b.id,b.upper_cat from smslistinfo a,smslistcat b WHERE a.category= CONCAT(b.upper_cat,b.id,'.') and b.id in (".$otherListID.") and a.category like '".$category."%'  order by b.cat_name, a.admin_id ";
		}
		$result=mysql_query($sql);
		$sql1="select * from smslistcat";
		$res=$db->Select($sql1);
		//$result=mysql_query("SELECT a.*,b.cat_name FROM smslistinfo a, smslistcat b WHERE CONCAT(b.upper_cat,b.id,'.') = a.category AND a.category='$category'");
		$db->Close();
		$str = "姓名,联系电话,公司,职务,分组名称\n";
		$str = iconv('utf-8','gb2312',$str);
		while($row=mysql_fetch_array($result)){
			$catName='';
			$upper_catArr=explode(".",$row['upper_cat']);
			for($i=0;$i<count($upper_catArr);$i++){
				for($j=0;$j<count($res);$j++){
					if($upper_catArr[$i]==$res[$j]['id']){
						$catName.=$res[$j]['cat_name'].'-';
					}
				}
			}
			$catName=$catName.$row['cat_name'];
			$name = iconv('utf-8','gb2312',$row['name']);
			$company = iconv('utf-8','gb2312',$row['company']);
			$job = iconv('utf-8','gb2312',$row['job']);
			//$cat_name=iconv('utf-8','gb2312',$row['cat_name']);
			$cat_name=iconv('utf-8','gb2312',$catName);
			$str .= $name.",".$row['tel'].",".$company.",".$job.",".$cat_name."\n";
		}
		$filename = '通讯录'.date('YmdHms').'.csv';
		$this->export_csv($filename,$str);	
	}
	
	public function input_csv($handle){
		$out = array ();
		$n = 0;
		while ($data = fgetcsv($handle, 10000)) {
			$num = count($data);
			for ($i = 0; $i < $num; $i++) {
				$out[$n][$i] = $data[$i];
			}
			$n++;
		}
		return $out;
	}
	function export_csv($filename,$data) {
		if( stripos($_SERVER['HTTP_USER_AGENT'], 'MSIE')!==false )
		$filename = urlencode($filename);
		header("Content-type:text/csv");
		header("Content-Disposition:attachment;filename=".$filename);
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		header('Expires:0');
		header('Pragma:public');
		echo $data;
	}
}