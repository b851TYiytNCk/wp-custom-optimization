<?php

use Automattic\WooCommerce\Admin\API\Init;

/**
 * Plugin Name: WP Optimizations
 */
class WP_Optimization {
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ), 20 );
	}

	public function on_plugins_loaded(): void {
		$is_target = $_SERVER['REQUEST_URI'] === '/'
		             || str_starts_with( $_SERVER['REQUEST_URI'], '/members/' )
		             || str_starts_with( $_SERVER['REQUEST_URI'], '/courses/' )
		             || str_starts_with( $_SERVER['REQUEST_URI'], '/lessons/' ) ;

		if ( $is_target ) {
			if ( class_exists( 'WooCommerce' ) ) {
				remove_action( 'init', array( WC(), 'load_rest_api' ), 10 );
			}

			if ( class_exists( Init::class ) ) {
				remove_action( 'rest_api_init', array(
					Init::instance(),
					'rest_api_init'
				) );
			}
		}
	}
}

new \WP_Optimization();