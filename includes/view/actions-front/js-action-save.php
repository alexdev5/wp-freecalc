<?
require_once(FREECALC_PATH . 'plugins/dompdf/autoload.inc.php');
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$html = view('includes/view/actions-front/template-pdf', [
	'details'=>$_POST['details'],
	'data'=>$_POST['data'],
	'size'=>$_POST['size'],
]);
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
// portrait, landscape
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Вывод файла в браузер:
//$dompdf->stream();
// ---------------------------------------------------------

$dirUpload = FREECALC_PATH.'upload/';
$fileName = date("Y-m-d_H-i-s") . '.pdf';
$fileFullName = $dirUpload . $fileName;

if (file_exists($fileFullName)){
	$cFiles = count(scandir($dirUpload))-2;
	$fileName = date("Y-m-d_H-i-s") . $cFiles . '-.pdf';
	$fileFullName = $dirUpload . $fileName;
}

$fileURL = FREECALC_URL . 'upload/' . $fileName;
$filePath = FREECALC_PATH . 'upload/' . $fileName;
$pdf = $dompdf->output();
//$text_pdf = $pdf->Output('', 'S');

file_put_contents($fileFullName, $pdf);
return ['file_url'=>$fileURL, 'file_path'=>$filePath];
?>