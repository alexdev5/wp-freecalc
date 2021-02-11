<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Freecalc
 * @subpackage Freecalc/includes
 */

class Freecalc {

	protected $loader;
	protected $freecalc;

	public function __construct() {
		$this->freecalc = 'freecalc';

		$this->load_dependencies();
		$this->loader = new Loader();
		$this->loadAdmin();
		$this->commonAction();
		if (is_admin()){
			$this->define_admin_hooks();
		}
		$this->includesFiles();
		$this->shortcode = new Shortcode();

		$this->loadFrontend();
	}


	private function load_dependencies()
	{
		require_once FREECALC_PATH . 'includes/functions.php';
		require_once FREECALC_PATH . 'includes/classes/class.loader.php';
	}

	public function includesFiles(){
		require_once FREECALC_PATH . 'includes/classes/class.shortcode.php';
		require_once FREECALC_PATH.'includes/update-curr.php';
	}

	private function loadAdmin(){
		require_once FREECALC_PATH . 'includes/controllers/PageController.php';
		require_once FREECALC_PATH . 'includes/controllers/AdminController.php';
	}

	private function commonAction(){
		$ac = new AdminController( $this->get_freecalc());

		//if( ! wp_next_scheduled( 'update_bal_curr' ) ) {
			wp_schedule_event( time()+60, 'daily', 'update_bal_curr');
		//}
		add_action( 'update_bal_curr', [$ac, 'getUpdateBalRate'] );
	}

	private function define_admin_hooks()
	{
		$plugin_admin = new AdminController( $this->get_freecalc());
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		// Страница плагина
		$this->loader->add_action( 'admin_menu', new PageController($this->get_freecalc()), 'createMenu' );

		$plugin_admin->adminAjax();
	}

	public function loadFrontend(){
		require_once FREECALC_PATH . 'includes/controllers/FrontendController.php';
		$cFornt = new FrontendController($this->get_freecalc());

		if (!is_admin()){
			$this->loader->add_action( 'wp_enqueue_scripts', $cFornt, 'enqueue_styles' );
			$this->loader->add_action( 'wp_enqueue_scripts', $cFornt, 'enqueue_scripts' );
		}

		$cFornt->frontAjax();
	}

	public function run(){
		$this->loader->run();
	}

	public function get_freecalc(){
		return $this->freecalc;
	}

}

