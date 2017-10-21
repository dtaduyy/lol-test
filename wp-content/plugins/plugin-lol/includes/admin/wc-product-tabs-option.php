<?php 
/**
 * WooCommerce Custom field
 *
 * Add more field to product/product category
 *
 * @author   WooThemes
 * @category API
 * @package  WooCommerce/API
 * @since    2.4.0
 */


add_action( 'plugins_loaded', array( 'WC_Product_Tab_Options_Set', 'init' ));

class WC_Product_Tab_Options_Set {

	public static function init() {
		$class = __CLASS__;
		new $class;
	}

	public function __construct() {
		//Add action here
		$this->hook();
	}

	public function hook(){
		add_filter( 'woocommerce_product_data_tabs', array($this,'add_my_custom_product_data_tab' ) );

		add_action('woocommerce_product_data_panels', array($this,'woocom_custom_product_data_fields') );	

		add_action('save_post_product', array($this , 'save_customizable_custom_variation') );  
	}


	// First Register the Tab by hooking into the 'woocommerce_product_data_tabs' filter
	public function add_my_custom_product_data_tab( $product_data_tabs ) {
		$product_data_tabs['my-custom-tab'] = array(
			'label' => __( 'Product Options', 'woocommerce' ),
			'target' => 'select_option_set',
			'class'     => array( 'show_if_simple' ),
		);
		return $product_data_tabs;
	}

	// functions you can call to output text boxes, select boxes, etc.
	function woocom_custom_product_data_fields() {
		include_once(WP_PLUGIN_DIR.'\woocommerce-product-options\templates\admin\wc-product-select-tabs.php' );
	}


	public function save_customizable_custom_variation($post_id){
	       	if(isset($_POST['select_option_set_new_field'])){
	           	$get_count = count_option_in_option_set($_POST['id_option_set']);
	           	$array_price = [];
	           	for ( $i = 0 ; $i < $get_count ; $i++){
	           		
	           			$array_price[ $_POST['name_option_'.$i.''] ] = $_POST['price_option_'.$i.''];
	           		
	           	}
	           	update_post_meta($post_id,'_frequently_bought_together',$array_price);
			update_post_meta($post_id,'_name_option_selected',$_POST['select_option_set_new_field']);
	       	}else{
	       		update_post_meta($post_id,'_frequently_bought_together','');
			update_post_meta($post_id,'_name_option_selected','');
	       	}
	}

}

?>