<?php
/**
 * PHP操作Excel封装
 *
 * @author 风格独特
 */

require_once __DIR__ . '/PHPExcel/Classes/PHPExcel.php';
require_once __DIR__ . '/PHPExcel/Classes/Excel2007.php';

class Excel
{
    private $current_line = 0;

    private $dataArray = array();

    private $objPHPExcel;

    public function __construct()
    {
        $this->objPHPExcel = new PHPExcel();

        $this->objPHPExcel->getProperties()->setCreator("通州区政府")
            ->setLastModifiedBy("通州区政府")
            ->setTitle("数据")
            ->setSubject("数据")
            ->setDescription("项目数据")
            ->setKeywords("")
            ->setCategory("");
    }
    
    public function addRow($data)
    {
        array_push($this->dataArray, array_values($data));
        ++$this->current_line;
    }

    public function down($filename)
    {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        $this->objPHPExcel->setActiveSheetIndex(0)
            ->fromArray($this->dataArray);

       $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
       $objWriter->save('.php','.xls','_FILE_');
       exit; 
        
    }
}
