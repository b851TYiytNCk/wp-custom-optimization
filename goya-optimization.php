<?php
/**
 * Plugin Name: WP Optimizations
 */

class Goya_Optimization {
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ), 20 );
	}

	public function on_plugins_loaded(): void {
		if ( class_exists( 'WooCommerce' ) ) {
			// Remove the 'load_rest_api' action from WooCommerce
			remove_action( 'init', array( WC(), 'load_rest_api' ), 10 );
		}

		remove_action( 'rest_api_init', array( \Automattic\WooCommerce\Admin\API\Init::instance(), 'rest_api_init' ) );
	}
}

new \Goya_Optimization();