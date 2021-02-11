<?php // Silence is golden
add_action( 'wp_ajax_nopriv_freecalc_interactive',  ['FrontendController','freecalc_interactive']);
add_action( 'wp_ajax_freecalc_interactive',  ['FrontendController', 'freecalc_interactive']);

function freecalc_interactive(){
	echo 'slkdfjd';
}

