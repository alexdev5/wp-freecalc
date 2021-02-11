<?php

class FrontendController{

	public function __construct($freecalc = 'freecalc')
	{
		$this->freecalc = $freecalc;
		$this->frontAjax();
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
		wp_enqueue_script( $this->freecalc.'-tingle',  FREECALC_URL.'admin/plugins/tingle-master/tingle.min.js' );
		wp_enqueue_script_version( $this->freecalc, 'front/js/main.js', ['jquery'], true);

		//
		wp_enqueue_script_version( $this->freecalc.'-actions', 'front/js/main-actions.js', ['jquery'], true);
		wp_localize_script( $this->freecalc.'-actions', 'freeCalcName',
			array(
				'url' => admin_url('admin-ajax.php'),
				//'url' => admin_url() . 'admin.php?page=freecalc-make',
				'nonce' => wp_create_nonce('ajax-nonce')
			)
		);
		//
	}


	public function frontAjax(){
		add_action( 'wp_ajax_nopriv_freecalc_interactive', [&$this, 'userAction'] );
		add_action( 'wp_ajax_freecalc_interactive', [&$this, 'userAction'] );
	}

	public function userAction(){
		if( empty($_POST['nonce']) )
			wp_die();
		$nonce_outside = $_POST['nonce'];
		$nonce_inside = wp_create_nonce('ajax-nonce');
		// проверяем nonce код, если проверка не пройдена прерываем обработку
		//check_ajax_referer( 'myajax-nonce', 'nonce_code' );

		if($nonce_outside !== $nonce_inside){
			echo json_encode(['error'=>'ok']);
			wp_die('','','403');
		}

		if ($_POST['action_user'] === 'save'){
			$fileURL = include FREECALC_PATH . "includes/view/actions-front/js-action-save.php";
		}
		elseif ($_POST['action_user'] === 'save'){

		}
		elseif ($_POST['action_user'] === 'save'){

		}

		echo json_encode([
			'url'=>$fileURL
		]);
		wp_die();
	}

}