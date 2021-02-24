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
			$commonSettings = $this->cAdmin->getSettings();
			if(!$calc)
				return '';
			$contents = $calc->content;
			$settings = $calc->settings;


			if ($_GET['tmp-pdf'] ==1){
				return view("includes/view/actions-front/template-pdf");
			}
			else{
				return view("front/partials/view-calc-id", [
					'contents'=>$contents,
					'settings'=>$settings,
					'commonSettings'=>$commonSettings->settings, ]);
			}

		});
	}
}