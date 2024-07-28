<?php
// namespace ElementorPro\Modules\DisplayConditions\Conditions;

use Elementor\Controls_Manager;
use ElementorPro\Modules\DisplayConditions\Classes\Comparator_Provider;
use ElementorPro\Modules\DisplayConditions\Classes\Comparators_Checker;
use ElementorPro\Modules\DisplayConditions\Conditions\Base\Condition_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class Thirdparty_Cookies_Accepted_Condition extends Condition_Base {

	public function get_name() {
		return 'thirdparty_cookies_accepted';
	}

	public function get_label() {
		return esc_html__( 'Thirdparty Cookies Accepted', 'el-func-ext' );
	}

	public function get_group() {
		return 'other';
	}

	public function check( $args ) : bool {
		$value = $this->get_condition_value( $args );
		
		if ( false === $value ) {
			return false;
		}
		
		if ( empty( $args['thirdparty_cookies_accepted'] ) ) {
			return false;
		}
		
		return Comparators_Checker::check_string_contains_and_empty( $args['comparator'], $args['thirdparty_cookies_accepted'], $value );
	}
	
	public function get_options() {
		$comparators = Comparator_Provider::get_comparators(
			[
				Comparator_Provider::COMPARATOR_IS,
				Comparator_Provider::COMPARATOR_IS_NOT,
			]
		);

		$this->add_control(
			'comparator',
			[
				'type' => Controls_Manager::SELECT,
				'options' => $comparators,
				'default' => Comparator_Provider::COMPARATOR_IS,
			]
		);

		$options = 
		[
			'true' => 'true',
			'false' => 'false'
		];
		
		$this->add_control(
			'thirdparty_cookies_accepted',
			[
				'label' => esc_html__( 'Thirdparty cookies accepted', 'el-func-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => $options,
				'required' => true,
			]
		);
	}
	
	/**
	 * Conditionally retrieve the value of a dynamic tag or custom field.
	 *
	 * @return string | bool
	 */
	private function get_condition_value( array $args ) {
		
		$thirdpartyCookiesAccepted = 'true';
		if(function_exists('gdpr_cookie_is_accepted'))
		{
			$thirdpartyCookiesAccepted = 'false';
			if(gdpr_cookie_is_accepted('thirdparty' /* 'strict', 'thirdparty', 'advanced' */))
			{
				$thirdpartyCookiesAccepted = 'true';
			}
		}
		return $thirdpartyCookiesAccepted;
	}

}
