<?php
/**
 * PDF生成的文件
 *
 * @author 风格独特
 */

require_once __DIR__ . '/tcpdf/tcpdf.php';

function htmltopdf($html, $option = array())
{
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
//    $pdf->SetAuthor('通州区');
//    $pdf->SetTitle('通州区申报');
//    $pdf->SetSubject('通州区申报');
//    $pdf->SetKeywords('消费券');

    // set default header data
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 038', PDF_HEADER_STRING);
    // set header and footer fonts
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    //    $pdf->SetHeaderData('1.png', 30, 'quliantrip.com', '', array(0, 64, 255), array(0, 64, 128));
    //
    //    $pdf->setFooterData('2.png', array(0, 64, 0), array(0, 64, 128));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    //        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    //        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // ---------------------------------------------------------
    // add a page
    $pdf->AddPage();
    $pdf->SetFont('droidsansfallback', '', 10);
    $pdf->writeHTML($html);

    $pdf->Output('download_' . time() . '.pdf', 'I');
}

function datatopdf($temp, $data)
{
    $temp_file = __DIR__ . '/temp/' . $temp . '.php';

    ob_start();
    include $temp_file;
    $html = ob_get_clean();

    htmltopdf($html);
}



