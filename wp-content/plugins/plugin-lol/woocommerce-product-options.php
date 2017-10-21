<?php
/**
 * Plugin Name: LOL plugins
 * Plugin URI:  
 * Description: 
 * Version: 1.0 
 * Author: 
 * License: GPLv2 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_action( 'plugins_loaded', array( 'WC_Product_Options', 'init' ));

class WC_Product_Options {

	public static function init() {
		$class = __CLASS__;
		new $class;
	}

	public function __construct() {
		$this->includes();
		$this->script();
		$this->declare_class();
	}

	public function includes(){
		
		//Menu Product Option in Admin Panel
		require_once plugin_dir_path( __FILE__ ).'includes/admin/'.'wc-product-options.php';
		//Menu Product Option set in Admin panel
		require_once plugin_dir_path( __FILE__ ).'includes/admin/'.'wc-product-options-set.php';
		//Public function in plugin
		require_once plugin_dir_path( __FILE__ ).'includes/'.'wc-options-function.php';	
		//Add new tab to Product Tabs
		// require_once plugin_dir_path( __FILE__ ).'includes/admin/'.'wc-product-tabs-option.php';
		// //Store all ajax function in plugin
		// require_once plugin_dir_path( __FILE__ ).'includes/admin/ajax/'.'wc-product-options-ajax.php';
		// //Check out
		// require_once plugin_dir_path( __FILE__ ).'includes/admin/check-out/'.'wc-product-options-checkout.php';
		// //Show option price in product page
		// require_once plugin_dir_path( __FILE__ ).'includes/frontend/'.'wc-product-options-frontend.php';
		
	}
	
	public function script(){
		//Get js/css from Woocommerce ( path : ../plugin/woocommerce/includes/admin/class-wc-admin-assets.php )
		add_action( 'admin_enqueue_scripts', array( $this, 'woocommerce_scripts_css' ) );
		//Call js/css in admin from plugin
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_css' ) );
		//Call js//css in frontend from plugin
		add_action( 'wp_enqueue_scripts', array($this, 'frontend_script_css' ) );
	}

	public function admin_scripts_css(){
		$plugin_url = plugin_dir_path( __FILE__ );
		wp_enqueue_style('admin_css_option_style',  untrailingslashit( plugins_url( '/', __FILE__ ) ). '/assets/css/admin/admin.css');
		wp_enqueue_script( 'admin_product_load',  untrailingslashit( plugins_url( '/', __FILE__ ) )."/assets/js/admin/admin_product_tabs.js" );
	}

	public function frontend_script_css(){
		
		if(is_product()){
			wp_enqueue_style('frontend_css_option_style',  untrailingslashit( plugins_url( '/', __FILE__ ) ). '/assets/css/frontend/style.css');
			wp_enqueue_script( 'single_product_load',  untrailingslashit( plugins_url( '/', __FILE__ ) )."/assets/js/frontend/option_product.js" );
		}

		if(is_cart()){
			wp_enqueue_style('cart_css_option_style',  untrailingslashit( plugins_url( '/', __FILE__ ) ). '/assets/css/frontend/cart.css');
		}
	}

	public function woocommerce_scripts_css(){
		$suffix       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_script( 'select2', WC()->plugin_url() . '/assets/js/select2/select2' . $suffix . '.js', array( 'jquery' ), '3.5.4' );
		wp_register_script( 'wc-enhanced-select', WC()->plugin_url() . '/assets/js/admin/wc-enhanced-select.js', array( 'jquery', 'select2' ), WC_VERSION );
		wp_enqueue_script( 'woocommerce_admin' );
		wp_enqueue_script( 'wc-enhanced-select' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_style('woocommerce_admin_styles', WC()->plugin_url() . '/assets/css/admin.css');
		

	}
	public function declare_class(){
		//Declare class
		$declare_class_option = new WC_Product_Options_Template();
		$declare_class_option_set = new WC_Product_Options_Set_Template();
		$declare_class_tab = new WC_Product_Tab_Options_Set();
		$declare_class_frontend = new WC_Product_Options_Frontend();
		$declare_class_checkout = new WC_Product_Options_Checkout();
	}
	
}

?>