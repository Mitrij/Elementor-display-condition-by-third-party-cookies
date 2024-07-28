<?php

use ElementorPro\Core\Isolation\Wordpress_Adapter;

//  Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


function efe_add_elementor_thirdparty_cookies_condition($conditionsManager)
{
	require_once(EL_FUNC_EXT_BASE . '/inc/thirdparty-cookies-elementor-condition.php');
	$args[] = new Wordpress_Adapter();
	$condition = new \Thirdparty_Cookies_Accepted_Condition($args);
    $conditionsManager->register_condition_instance( $condition );
}
add_action('elementor/display_conditions/register', 'efe_add_elementor_thirdparty_cookies_condition', 10, 1);
