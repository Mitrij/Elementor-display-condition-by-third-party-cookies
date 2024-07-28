<?php
/*
Plugin Name: Elementor functionality extension
Plugin URI: 
Description: Extends elementor functionality
Version: 0.0.1
Author: ...
Text Domain: el-func-ext
Domain Path: /locale
*/

//  Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define('EL_FUNC_EXT_VERSION', '0.0.1');
define('EL_FUNC_EXT_BASE', plugin_dir_path( __FILE__ )  );
define('EL_FUNC_EXT_DIR_URI', trailingslashit(plugins_url('', __FILE__)) );


if(defined( 'DOING_AJAX' ) && DOING_AJAX)
{
	load_plugin_textdomain('el-func-ext', false,  dirname( plugin_basename( __FILE__ ) ) . '/languages/');
}
else
{
	function el_func_ext_set_locale()
	{
		load_plugin_textdomain('el-func-ext', false,  dirname( plugin_basename( __FILE__ ) ) . '/languages/');
	}
	add_action('init', 'el_func_ext_set_locale');
}


// ini_set('serialize_precision', -1);
require_once EL_FUNC_EXT_BASE . '/inc/common.php';
// require_once EL_FUNC_EXT_BASE . '/inc/ajax.php';
// require_once EL_FUNC_EXT_BASE . '/inc/enqueue.php';
