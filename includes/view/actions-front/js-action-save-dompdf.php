<?
require_once(FREECALC_PATH . 'plugins/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

/*require_once(FREECALC_PATH . 'plugins/vendor/autoload.php');
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;*/

//$html2pdf = new Html2Pdf('P', 'A4');


/*require_once(FREECALC_PATH . 'includes/controller/AdminController.php');*/

// instantiate and use the dompdf class
$cAdmin = new AdminController();
$calcSettings = $cAdmin->getSettings();
$dompdf = new Dompdf();
$dompdf->set_option("isPhpEnabled", true);

$html = view('includes/view/actions-front/template-pdf', [
	'details'=>$_POST['details'],
	'data'=>$_POST['data'],
	'size'=>$_POST['size'],
	'calcSetting'=>$calcSettings->settings,
]);
//$html2pdf->setDefaultFont('helvetica');
//$html2pdf->writeHTML($html);

$dompdf->loadHtml($html, 'utf-8');
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
$pdf = $dompdf->output('', 'S');
//$pdf = $html2pdf->output('', 'S');
//$text_pdf = $pdf->Output('', 'S');

file_put_contents($fileFullName, $pdf);
return ['file_url'=>$fileURL, 'file_path'=>$filePath];
?>