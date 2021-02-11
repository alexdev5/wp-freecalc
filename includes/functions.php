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
