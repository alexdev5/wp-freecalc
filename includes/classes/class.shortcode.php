<?php
class Shortcode{
	public function __construct()
	{
		$this->cAdmin = new AdminController();
		//
		$this->createShorcode();
	}

	public function createShorcode(){
		add_shortcode( 'free_calc', function( $atts ) {
			$atts = shortcode_atts( array(
				'id' => ''
			), $atts );

			if (!$atts['id'])
				return '';

			$calc = $this->cAdmin->getCalc($atts['id']);
			if(!$calc)
				return '';
			$contents = $calc->content;
			$settings = $calc->settings;


			return view("front/partials/view-calc-id", ['contents'=>$contents, 'settings'=>$settings, ]);
		});
	}
}