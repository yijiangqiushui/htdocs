<?php
/**
author:Gao Xue 
date:2014-07-15
*/


require_once dirname(__FILE__) . '/../../../../common/html/plugin/PHPExcel1.8.0/Classes/PHPExcel.php';
include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';

$action=$_GET['action'];
//$id=$_GET['id'];
//$expertId=$_GET['expertId'];

//flag为0时按平均分导出打分表,flag为1时按专家导出打分表.

$expertCat=$_GET['expertCat'];
$flag=$_GET['flag'];
$expertId=$_GET['expertId'];
switch($action){
	case 'Excel':
		Excel($expertCat,$flag,$expertId);
		break;
	default:;
}

function Excel($expertCat,$flag,$expertId){	
	$objPHPExcel = new PHPExcel();

	$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
								 ->setLastModifiedBy("Maarten Balliauw")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Test result file");
	//设置单元格的border
	$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('G4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('H4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('I4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('J4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('K4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('L4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('M4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('N4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('O4')->getFont()->setBold(true);
	
	//水平垂直居中
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	//设置字体
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	
				
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6); 
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(34); 
	$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); 
	$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);
	
	$db=new DB();
	
	if($flag==0){//按项目打分
		//合并单元格
		$objPHPExcel->getActiveSheet()->mergeCells('A1:K3');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','通州区科学技术奖初评打分表');
		//$objPHPExcel->getActiveSheet()->mergeCells('A4:K5');
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A4', '序号')
					->setCellValue('B4', '项目名称')
					->setCellValue('C4', '完成单位')
					->setCellValue('D4', '通讯地址')
					->setCellValue('E4', '联系人')
					->setCellValue('F4', '手机')
					->setCellValue('G4', '联系电话')
					->setCellValue('H4', '电子邮箱')
					->setCellValue('I4', '项目起始时间')
					->setCellValue('J4', '完成时间')
					->setCellValue('K4', '总平均分');
					
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(28);
		$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10); 

		$sql='select * from application where expertCat like "%'.$expertCat.'%"';
		
		$result=$db->Select($sql);
		
		for($i = 0;$i<count($result);$i++){
			
			if($i==count($result)-1){
				$idlist.=$result[$i]['id'];
			}else{
				$idlist.=$result[$i]['id'].',';
			}
			
			$id[]=$result[$i]['id'];
			$aname[]=$result[$i]['aname'];
			$completeOrg[]=$result[$i]['completeOrg'];
			$completeAdress[]=$result[$i]['completeAdress'];
			$completePerson[]=$result[$i]['completePerson'];
			$completeTel[]=$result[$i]['completeTel'];
			$completePhone[]=$result[$i]['completePhone'];
			$completeEmail[]=$result[$i]['completeEmail'];
			$source[]=$result[$i]['source'];
			$proStart[]=$result[$i]['proStart'];
			$proEnd[]=$result[$i]['proEnd'];
		}
		/*$get_id=trim($expertCat,'.');
		$get_id=substr($get_id,strrpos($get_id,'.')+1);
		$sql_1='select cat_name from applycat where id='.$get_id;
		$res_1=$db->Select($sql_1);
		
		$sql_2='SELECT id,realname FROM admininfo b,(SELECT expertId FROM scoreinfo WHERE applyId IN('.$idlist.') GROUP BY expertId) a WHERE a.expertId=b.id';
		$res_2=$db->Select($sql_2);
		for($i=0;$i<count($res_2);$i++){
			if($i==count($res_2)-1){
				$str.=$res_2[$i]['realname'];
			}else{
				$str.=$res_2[$i]['realname'].',';
			}
		}
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4','评审组：'.$res_1[0]['cat_name'].'                             评审专家：'.$str);*/
		$k=5;
		$headId=1;
		for($i=0;$i<count($id);$i++){
			$sqlAvg='SELECT AVG(creative) AS creative,AVG(scientific) AS scientific,AVG(difficulty) AS difficulty,AVG(advanced) AS advanced,AVG(benefits) AS benefits,AVG(effectiveness) AS effectiveness,AVG(prospect) AS prospect,AVG(popularize) AS popularize,AVG(closes) AS closes,AVG(affect) AS affect,AVG(property) AS property,AVG(technology) AS technology FROM scoreinfo WHERE applyId= '.$id[$i].' group by applyId';
			$res_avg=$db->Select($sqlAvg);
			
			if(count($res_avg)!=''&&count($res_avg)>0){
				$total=$res_avg[0]['creative']+$res_avg[0]['scientific']+$res_avg[0]['difficulty']+$res_avg[0]['advanced']+$res_avg[0]['benefits']+$res_avg[0]['effectiveness']+$res_avg[0]['prospect']+$res_avg[0]['popularize']+$res_avg[0]['closes']+$res_avg[0]['affect']+$res_avg[0]['property']+$res_avg[0]['technology'];
				
				$total=round($total,0);
				
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $k, $headId);  
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $k, $aname[$i]);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $k, $completeOrg[$i]);
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $k, $completeAdress[$i]); 
				$objPHPExcel->getActiveSheet()->setCellValue('E' . $k, $completePerson[$i]);
				$objPHPExcel->getActiveSheet()->setCellValue('F' . $k, $completeTel[$i]);
				$objPHPExcel->getActiveSheet()->setCellValue('G' . $k, $completePhone[$i]);
				$objPHPExcel->getActiveSheet()->setCellValue('H' . $k, $completeEmail[$i]);
				$objPHPExcel->getActiveSheet()->setCellValue('I' . $k, $proStart[$i]);
				$objPHPExcel->getActiveSheet()->setCellValue('J' . $k, $proEnd[$i]);
				$objPHPExcel->getActiveSheet()->setCellValue('K' . $k, $total); 
			}
			$k++;
			$headId++;
		}
	}else{//按专家打分
		$objPHPExcel->getActiveSheet()->mergeCells('A1:P3');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','通州区科学技术奖初评打分表');
		$objPHPExcel->getActiveSheet()->mergeCells('A4:P5');
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A6', '序号')
					->setCellValue('B6', '项目名称')
					->setCellValue('C6', '完成单位')
					->setCellValue('D6', '技术创新程度')
					->setCellValue('E6', '科学性')
					->setCellValue('F6', '难易程度或复杂程度')
					->setCellValue('G6', '技术经济指标的先进程度')
					->setCellValue('H6', '已获经济效益')
					->setCellValue('I6', '社会效益')
					->setCellValue('J6', '发展前景及潜在效益')
					->setCellValue('K6', '转化、应用、推广程度')
					->setCellValue('L6', '与本区经济、社会、科技发展需求的紧密程度')
					->setCellValue('M6', '对推动行业技术进步的作用')
					->setCellValue('N6', '知识产权情况')
					->setCellValue('O6', '科技查新情况')
					->setCellValue('P6', '总分');
					
		$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('D6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('E6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('F6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('G6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('H6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('I6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('J6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('K6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('L6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('M6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('N6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('O6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('P6')->getFont()->setBold(true);
					
		$objPHPExcel->getActiveSheet()->getStyle('F6')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('G6')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('J6')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('K6')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('L6')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('M6')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('N6')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('O6')->getAlignment()->setWrapText(true);

					
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(16); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(6); 


		$sql='SELECT * FROM admininfo WHERE id='.$expertId;
		$res=$db->Select($sql);
		$get_id=trim($res[0]['category'],'.');
		$get_id=substr($get_id,strrpos($get_id,'.')+1);
		
		$sql_3='select * from admincat where id='.$get_id;
		$res_3=$db->Select($sql_3);
		
		$category=strpos($res_3[0]['userPrivileges'],'concat_.');
		$category=substr($res_3[0]['userPrivileges'],strpos($res_3[0]['userPrivileges'],'concat_.')+7);
		$str=strpos($category,',');
		$cat_str=substr($category,0,$str);
		$catId=explode('.',$cat_str);
		for($i=0;$i<count($catId);$i++){
			if($i==count($catId)-1){
				$sql_5='select * from applycat where id='.$catId[$i];	
				$res_5=$db->Select($sql_5);	
			}
		}
		
		if(strpos($res_3[0]['userPrivileges'],'score0')>0){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N6', '知识产权情况');
		}
		if(strpos($res_3[0]['userPrivileges'],'score1')>0){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N6', '论文等级及篇数');
		}
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4','评审组：'.$res_5[0]['cat_name'].'                             评审专家：');
		
		$k=7;
		$headId=1;
		$sql_1='SELECT * FROM scoreinfo WHERE expertId='.$expertId;
		$res_1=$db->Select($sql_1);
		for($i=0;$i<count($res_1);$i++){
			//SELECT * FROM application a,scoreinfo b WHERE b.applyId=a.id AND b.applyId=4
			$sql_2='select * from application a,scoreinfo b where b.applyId=a.id AND b.applyId='.$res_1[$i]['applyId'];
			$res_2=$db->Select($sql_2);
			
			$total=$res_1[$i]['creative']+$res_1[$i]['scientific']+$res_1[$i]['difficulty']+$res_1[$i]['advanced']+$res_1[$i]['benefits']+$res_1[$i]['effectiveness']+$res_1[$i]['prospect']+$res_1[$i]['popularize']+$res_1[$i]['closes']+$res_1[$i]['affect']+$res_1[$i]['property']+$res_1[$i]['technology'];
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $k, $headId);  
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $k, $res_2[0]['aname']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $k, $res_2[0]['completeOrg']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $k, $res_1[$i]['creative']); 
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $k, $res_1[$i]['scientific']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $k, $res_1[$i]['difficulty']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $k, $res_1[$i]['advanced']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $k, $res_1[$i]['benefits']);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $k, $res_1[$i]['effectiveness']);
			$objPHPExcel->getActiveSheet()->setCellValue('J' . $k, $res_1[$i]['prospect']);
			$objPHPExcel->getActiveSheet()->setCellValue('K' . $k, $res_1[$i]['popularize']);
			$objPHPExcel->getActiveSheet()->setCellValue('L' . $k, $res_1[$i]['closes']);
			$objPHPExcel->getActiveSheet()->setCellValue('M' . $k, $res_1[$i]['affect']);
			$objPHPExcel->getActiveSheet()->setCellValue('N' . $k, $res_1[$i]['property']);
			$objPHPExcel->getActiveSheet()->setCellValue('O' . $k, $res_1[$i]['technology']);
			//$objPHPExcel->getActiveSheet()->setCellValue('N' . $k, $res_avg[0]['realname']);
			$objPHPExcel->getActiveSheet()->setCellValue('P' . $k, $total); 
			$k++;
			$headId++;
			
			/*if($i==count($res_1)-1){
				$j=$k+5;
				$objPHPExcel->getActiveSheet()->setCellValue('M' . $j, '专家签字：');
				$objPHPExcel->getActiveSheet()->getStyle('M'.$j)->getFont()->setBold(true);			
			}*/
		}
	}

	$objPHPExcel->getActiveSheet()->setTitle('专家打分表');

	$objPHPExcel->setActiveSheetIndex(0);
	
	
	// Redirect output to a client's web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="专家打分表.xlsx"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');
	
	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
}

?>