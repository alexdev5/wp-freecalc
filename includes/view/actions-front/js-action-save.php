<?
require_once FREECALC_PATH.'plugins/pdflayer.class.php';
$cAdmin = new AdminController();
$calcSettings = $cAdmin->getSettings();

$html = view('includes/view/pdf/template-pdf', [
	'details'=>$_POST['details'],
	'data'=>$_POST['data'],
	'size'=>$_POST['size'],
	'calcSetting'=>$calcSettings->settings
]);
$header = view('includes/view/pdf/template-pdf-header', []);

$footer = view('includes/view/pdf/template-pdf-footer', [
	'setting'=>$calcSettings->settings
]);

//Instantiate the class
$html2pdf = new pdflayer();
$apiKey = $calcSettings->settings['pdflayer-api-key'];
if (!$apiKey)
	$apiKey = 'a59c204abcd8861afc2d77d5b4f49b5b';

$html2pdf->set_param('access_key', $apiKey);
//set the URL to convert
//$html2pdf->set_param('page_size', 'A4');
if ($calcSettings->settings['pdflayer-test']=='on'){
	$html2pdf->set_param('test', 1);
}

$html2pdf->set_param('margin_top', 0);
$html2pdf->set_param('margin_bottom', 60);
$html2pdf->set_param('margin_left', 0);
$html2pdf->set_param('margin_right', 0);
/*
$html2pdf->set_param('header_html', $header);
$html2pdf->set_param('header_spacing', 150);*/
$html2pdf->set_param('footer_html', $footer);
$html2pdf->set_param('footer_spacing', 10);

$html2pdf->set_param('document_html', $html);
//start the conversion
try{
	$html2pdf->convert();
}
catch (Exception $e){
	return ['error'=>$e->getMessage()];
}


//display the PDF file
ob_start();
$html2pdf->display_pdf();
$pdf = ob_get_clean();

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

file_put_contents($fileFullName, $pdf);
return ['file_url'=>$fileURL, 'file_path'=>$filePath];
?>