<?php
/**
author:Zhao Xiaogang
date:2015-04-01
*/


require_once dirname(__FILE__) . '/../../../../common/html/plugin/PHPExcel1.8.0/Classes/PHPExcel.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';

$action=$_GET['action'];
$file_name=$_GET['file_name'];
$file_no=$_GET['file_no'];
$file_type=$_GET['file_type'];
$beginDate=$_GET['beginDate'];
$endDate=$_GET['endDate'];
$file_self=$_GET['file_self'];
$upper_cat=$_GET['upper_cat'];
switch($action){
	case 'Excel':
		Excel($file_name,$file_no,$file_type,$beginDate,$endDate,$file_self,$upper_cat);
		break;
	default:;
}

function Excel($file_name,$file_no,$file_type,$beginDate,$endDate,$file_self,$upper_cat){
	
	$id=$_SESSION['admin_id'];
	$objPHPExcel = new PHPExcel();

	$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
								 ->setLastModifiedBy("Maarten Balliauw")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Test result file");
	$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(28);
	//水平垂直居中
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	//设置字体
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
				
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12.71); 
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12.29); 
	$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(7.29); 
	$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);
	
	$db=new DB();

	//合并单元格
	$objPHPExcel->getActiveSheet()->mergeCells('A1:H2');
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','文件审批记录');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('FFFFFF');
	//$objPHPExcel->getActiveSheet()->mergeCells('A4:G5');
	$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3',date('Y').' 年 '.date('m').' 月 ');
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(false);	
	//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(false);
	//$objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->getColor()->setARGB('FF993300');
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A4', '编号')
				->setCellValue('B4', '时间')
				->setCellValue('C4', '份数')
				->setCellValue('D4', '文件名称')
				->setCellValue('E4', '文件类型')
				->setCellValue('F4', '拟稿人')
				->setCellValue('G4', '制文人')
				->setCellValue('H4', '备注');
				
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(34.14);
	$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(19.57);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10.14);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10.14);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10.29);

	$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
	$objPHPExcel->getActiveSheet()->getStyle('B4')->getFont()->setSize(15);
	$objPHPExcel->getActiveSheet()->getStyle('C4')->getFont()->setSize(15);
	$objPHPExcel->getActiveSheet()->getStyle('D4')->getFont()->setSize(15);
	$objPHPExcel->getActiveSheet()->getStyle('E4')->getFont()->setSize(15);
	$objPHPExcel->getActiveSheet()->getStyle('F4')->getFont()->setSize(15);
	$objPHPExcel->getActiveSheet()->getStyle('G4')->getFont()->setSize(15);
	$objPHPExcel->getActiveSheet()->getStyle('H4')->getFont()->setSize(15);
	
	$objPHPExcel->getActiveSheet()->getStyle('A4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('B4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('D4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('E4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('F4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('G4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	$objPHPExcel->getActiveSheet()->getStyle('A4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('B4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('D4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('E4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('F4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('G4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

	if($file_self==1){
		$sql="SELECT * FROM document WHERE author=(select realname from admininfo where id=$id) and category like '$upper_cat%'";
		
	}
	else{
		if($_SESSION['admin_name']=='super'||strpos($_SESSION['priviledges'],'maker')){
			$sql="SELECT * FROM document WHERE category like '$upper_cat%' ";
		}else{
			$sql1="SELECT b.userPrivileges FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$id;
			$arr=$db->Select($sql1);
			$concat1=explode(',',$arr[0]['userPrivileges']);
			$dept=explode('_',$concat1[1]);
			$category=$dept[1].'.';
			if($category=='.'||$category=='0.'){
					$sql="SELECT * FROM document WHERE category like '$upper_cat%' ";
			}else{
					$sql="SELECT * FROM document WHERE category like '$category%' ";
			}
		}
	}
	if(!empty($file_name)){
		$sql.=" and file_name like '%$file_name%' ";
	}
	if(!empty($file_no)){
		$sql.=" and file_no like '%$file_no%' ";
	}
	if(!empty($file_type)){
		$sql.=" and types like '%$file_type%' ";
	}
	if(!empty($beginDate) && !empty($endDate)){
		$sql.=" and addedDate between '$beginDate' and '$endDate' ";
	}
	//$sql.=" and file_no is not null and isInvalid=0";
	$sql.=" and ismake=1 and isInvalid=0";
	$sql.=" order by id desc ";
	$result=$db->Select($sql);

	for($i = 0,$k=5;$i<count($result);$i++,$k++){
		$leader='';
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $k, $result[$i]['file_no']);  
		$objPHPExcel->getActiveSheet()->setCellValue('B' . $k, $result[$i]['addedDate']);
		$objPHPExcel->getActiveSheet()->setCellValue('C' . $k, $result[$i]['number']);
		$objPHPExcel->getActiveSheet()->setCellValue('D' . $k, $result[$i]['file_name']); 
		$objPHPExcel->getActiveSheet()->setCellValue('E' . $k, $result[$i]['types']);
		$objPHPExcel->getActiveSheet()->setCellValue('F' . $k, $result[$i]['author']);
		$objPHPExcel->getActiveSheet()->setCellValue('G' . $k, $result[$i]['admin']);
		$objPHPExcel->getActiveSheet()->setCellValue('H' . $k, '');
		
		$objPHPExcel->getActiveSheet()->getStyle('A'. $k)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('B'. $k)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('C'. $k)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('D'. $k)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E'. $k)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('F'. $k)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('G'. $k)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('H'. $k)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$objPHPExcel->getActiveSheet()->getStyle('A'. $k)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('B'. $k)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('C'. $k)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('D'. $k)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('E'. $k)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('F'. $k)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('G'. $k)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('H'. $k)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		$objPHPExcel->getActiveSheet()->getStyle('A'. $k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('B'. $k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('C'. $k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('D'. $k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('E'. $k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('F'. $k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('G'. $k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('H'. $k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	}


	$objPHPExcel->getActiveSheet()->setTitle('文件审批记录表');

	$objPHPExcel->setActiveSheetIndex(0);
	
	
	// Redirect output to a client's web browser (Excel2007)
	$filename='文件审批记录表.xls';
	if( stripos($_SERVER['HTTP_USER_AGENT'], 'MSIE')!==false )
	$filename = urlencode($filename);
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename='.$filename);
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');
	
	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//'Excel2007');
	$objWriter->save('php://output');
	exit;
}

?>