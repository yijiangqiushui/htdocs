<?
require('html2fpdf.php');

$pdf=new HTML2FPDF();
$pdf->AddGBFont('GB','ËÎÌו');
$pdf->AddPage();
//$fp = fopen("sample.html","r");
$strContent = file_get_contents("sample.html");//fread($fp, filesize("sample.html"));
//fclose($fp);
//$pdf->WriteHTML(iconv("UTF-8","GB2312",$strContent));
$pdf->WriteHTML($strContent);
//ob_clean();
$pdf->Output("tmp.pdf",true);

//echo "PDF file is generated successfully!";
?>