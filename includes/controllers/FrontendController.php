<?php

class FrontendController{

	public function __construct($freecalc = 'freecalc')
	{
		$this->freecalc = $freecalc;
	}


	public function enqueue_styles()
	{
		wp_enqueue_style( $this->freecalc.'-fancybox', FREECALC_URL.'plugins/fancybox-master/jquery.fancybox.min.css');
		wp_enqueue_style_version($this->freecalc,'front/css/style.css');
		wp_enqueue_style( $this->freecalc.'-font-awesome',  FREECALC_URL.'admin/plugins/fontawesome-pro-5.15.1-web/css/all.min.css' );
	}


	public function enqueue_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script( $this->freecalc.'-fancybox', FREECALC_URL.'plugins/fancybox-master/jquery.fancybox.min.js', ['jquery'], '1', true);
		wp_enqueue_script_version( $this->freecalc, 'front/js/main.js', ['jquery'], true);
		/*wp_enqueue_script( $this->freecalc.'-tingle',  FREECALC_URL.'admin/plugins/tingle-master/tingle.min.js' );*/

		wp_localize_script( $this->freecalc, 'freeCalcName',
			array(
				'url' => admin_url('admin-ajax.php'),
				//'url' => admin_url() . 'admin.php?page=freecalc-make',
				'nonce' => wp_create_nonce('freecalc-nonce')
			)
		);
	}


	public function frontAjax(){
		add_action( 'wp_ajax_freecalc_interactive', [$this, 'interactive' ]);
		add_action( 'wp_ajax_nopriv_freecalc_interactive', [$this, 'interactive' ]);
	}

	public function interactive(){

		if( empty($_POST['nonce']) )
			wp_die();
		$nonce_outside = $_POST['nonce'];
		$nonce_inside = wp_create_nonce('freecalc-nonce');
		if($nonce_outside !== $nonce_inside){
			echo json_encode(['error'=>'ok']);
			wp_die('','','403');
		}

		echo 11;
		wp_die();
	}

}