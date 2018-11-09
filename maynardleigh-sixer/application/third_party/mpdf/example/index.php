<?php
ini_set('display_errors', '1');
error_reporting(1);
require_once('../mpdf.php');
$mpdf = new mPDF('UTF-8-s', 'A4', 0, '', 15, 15, 15, 15, 8, 8);
$datainfo = file_get_contents(dirname(__FILE__)."/template.php");
//echo $datainfo;
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($datainfo);
$fullpath = dirname(__FILE__)."/abd.pdf";
$mpdf->Output($fullpath);
exit;