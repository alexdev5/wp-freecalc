<?php


if (!function_exists('wp_enqueue_script_version')){
	function wp_enqueue_script_version($handle, $src, $depend = [], $in_footer=false){
		wp_enqueue_script( $handle, FREECALC_URL . $src, $depend, filemtime(FREECALC_PATH . $src), $in_footer );
	}
}


if (!function_exists('wp_enqueue_style_version')){
	function wp_enqueue_style_version($handle, $src, $depend = [], $in_footer=false){
		wp_enqueue_style( $handle, FREECALC_URL . $src, $depend, filemtime(FREECALC_PATH . $src), $in_footer );
	}
}

function var_dump_pre($args){
	echo '<pre>';
		var_dump($args);
	echo '</pre>';
}

if (!function_exists('print_r_pre')){
	function print_r_pre($args){
		echo '<pre>';
		print_r($args);
		echo '</pre>';
	}
}


if (!function_exists('viewComponents')){
	function viewComponents($template, $args = []){
		return view("includes/view/$template.html", $args);
	}
}

if (!function_exists('view')){
	function view($file, $args = []){
		if (is_array($args) && count($args))
			extract($args);

		ob_start();
		include FREECALC_PATH . "$file.php";
		return ob_get_clean();
	}
}

/* Шаблоны в папке компонента */
if (!function_exists('view2')){
	function view2($file, $args=[]){
		if (is_array($args) && count($args))
			extract($args);

		// $eachRequared
		ob_start();
		include FREECALC_PATH . "includes/view/components/$file.php";
		return ob_get_clean();
	}
}



if (!function_exists('valueIf')){
	function valueIf($if, $value='', $else=''){
		if($if){
			if($value)
				return $value;
			else
				return $if;
		}
		else{
			return $else;
		}
	}
}


if (!function_exists('fis_admin')){
	function fis_admin($if, $else = ''){
		if (is_admin())
			return $if;
		return $else;
	}
}

if (!function_exists('fchangeText')){
	function fchangeText($is_data = true){
		if (is_admin()){
			$text = 'contenteditable=true';
			if ($is_data)
				$text.=' data-text';
			return $text;
		}

		return '';
	}
}

if (!function_exists('get_svg_content')){
	function get_svg_content($uri)
	{
		$dir = FREECALC_PATH . '';
		$full_url = $dir . $uri;
		if (!file_exists($full_url))
			return '';

		return file_get_contents($full_url);
	}
}

if (!function_exists('base64_encoded_image')) {
	function base64_encoded_image($img, $echo = false)
	{
		$imageSize = getimagesize($img);
		$imageData = base64_encode(file_get_contents($img));
		$imageHTML = "<img src='data:{$imageSize['mime']};base64,{$imageData}' {$imageSize[3]} />";
		if ($echo == true) {
			echo $imageHTML;
		} else {
			return $imageHTML;
		}
	}
}

function getImgBase64($src){
	$imgtype = pathinfo($src, PATHINFO_EXTENSION);
	$imgtext = file_get_contents($src);
	$base64 = base64_encode($imgtext);
	return "data:image/{$imgtype};base64,{$base64}";
}



function createThumbnail($filename, $thname, $width=100, $height=100, $cdn=null)
{
	try {
		$extension = substr($filename, (strrpos($filename, '.')) + 1 - strlen($filename));
		$fallback_save_path = "images/designs";

		if ($extension == "svg") {
			$im = new Imagick();
			$svgdata = file_get_contents($filename);
			$svgdata = svgScaleHack($svgdata, $width, $height);

			//$im->setBackgroundColor(new ImagickPixel('transparent'));
			$im->readImageBlob($svgdata);

			$im->setImageFormat("jpg");
			$im->resizeImage($width, $height, imagick::FILTER_LANCZOS, 1);

			$raw_data = $im->getImageBlob();

			(is_null($cdn)) ? file_put_contents($fallback_save_path . '/' . $thname, $im->getImageBlob()) : '';
		} else if ($extension == "jpg") {
			$im = new Imagick($filename);
			$im->stripImage();

			// Save as progressive JPEG
			$im->setInterlaceScheme(Imagick::INTERLACE_PLANE);
			$raw_data = $im->resizeImage($width, $height, imagick::FILTER_LANCZOS, 1);

			// Set quality
			// $im->setImageCompressionQuality(85);

			(is_null($cdn)) ? $im->writeImage($fallback_save_path . '/' . $thname) : '';
		}

		if (!is_null($cdn)) {
			$imageObject = $cdn->DataObject();
			$imageObject->SetData( $raw_data );
			$imageObject->name = $thname;
			$imageObject->content_type = 'image/jpg';
			$imageObject->Create();
		}

		$im->clear();
		$im->destroy();
		return true;
	}
	catch(Exception $e) {
		return false;
	}
}

function svgScaleHack($svg, $minWidth, $minHeight)
{
	$reW = '/(.*<svg[^>]* width=")([\d.]+px)(.*)/si';
	$reH = '/(.*<svg[^>]* height=")([\d.]+px)(.*)/si';
	preg_match($reW, $svg, $mw);
	preg_match($reH, $svg, $mh);
	$width = floatval($mw[2]);
	$height = floatval($mh[2]);
	if (!$width || !$height) return false;

	// scale to make width and height big enough
	$scale = 1;
	if ($width < $minWidth)
		$scale = $minWidth/$width;
	if ($height < $minHeight)
		$scale = max($scale, ($minHeight/$height));

	$width *= $scale*2;
	$height *= $scale*2;

	$svg = preg_replace($reW, "\${1}{$width}px\${3}", $svg);
	$svg = preg_replace($reH, "\${1}{$height}px\${3}", $svg);

	return $svg;
}