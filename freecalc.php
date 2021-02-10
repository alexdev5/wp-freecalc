<?php

/**
 	* Plugin Name: Free Calc - Расчет стоимости изделия
	* Plugin URI:
	* Description: Калькулятор для расчета стоимости изделия в зависимости от указаных связей.
	* Author: Alexandr Karakay
	* Version: 1.0
	* Author URI: https://yooh.tech/
 */


if ( ! defined( 'WPINC' ) ) {
	die;
}

define('FREECALC_VERSION', '1.0.0');
define('FREECALC_TABLE', 'freecalc_make');

define('FREECALC_URL', plugins_url('', __FILE__) .'/' );
define('FREECALC_PATH', plugin_dir_path(__FILE__) );
define('FREECALC_INC', plugin_dir_path(__FILE__).'includes/' );

define('FREECALC_JS_ADMIN', plugins_url('', __FILE__) . '/admin/js/');
define('FREECALC_CSS_ADMIN', plugins_url('', __FILE__) . '/admin/css/');
define('FREECALC_ADMIN', plugins_url('', __FILE__) . '/admin/');


function activate_freecalc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/classes/class.activator.php';
	FreecalcActivator::activate();
}
function deactivate_freecalc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/classes/class.deactivator.php';
	FreecalcDeactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_freecalc' );
register_deactivation_hook( __FILE__, 'deactivate_freecalc' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/classes/class.freecalc.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_freecalc() {
	$plugin = new Freecalc();
	$plugin->run();
}
run_freecalc();
