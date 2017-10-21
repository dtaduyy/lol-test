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


add_action( 'plugins_loaded', array( 'WC_Product_Options_Frontend', 'init' ));

class WC_Product_Options_Frontend {

	public static function init() {
		$class = __CLASS__;
		new $class;
	}

	public function __construct() {
		//Add action here
		$this->hook();
	}

	public function hook(){
		 add_action( 'woocommerce_before_add_to_cart_button', array($this,'add_custom_options_field' ) );
	}

	public function add_custom_options_field() {
		global $product;
		$id = $product->id;
		$get_all_options = get_post_meta($id,'_frequently_bought_together',true);
		$get_name_option = get_post_meta($id,'_name_option_selected',true);
		if(!empty($get_all_options)){
			echo '<div class="custom_option_checkbox">';
			echo '<div class="option_set_name"> Frequently Bought Together </div>';
			foreach ($get_all_options as $id => $price) {
				$name = get_the_title_by_id($id);
				echo '<div class="checkbox_value">';
				echo '<input class="select_product_options" type="checkbox" price="'.$price.'" name="'.$id.'" value="'.$id.'" /> '.$name. ' <span class="price_option">[ $'.$price. ' ]</span> ';
				echo '</div>';
			}
	          		echo '</div>';
	        }
	}


}

?>