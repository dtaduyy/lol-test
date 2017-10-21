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


add_action( 'plugins_loaded', array( 'WC_Product_Options_Checkout', 'init' ));

class WC_Product_Options_Checkout {

	public static function init() {
		$class = __CLASS__;
		new $class;
	}

	public function __construct() {
		//Add action here
		$this->hook();
	}

	public function hook(){
		add_filter( 'woocommerce_add_cart_item_data', array($this,'save_gift_wrap_fee'), 99, 2 );

		add_action( 'woocommerce_before_calculate_totals', array($this,'calculate_gift_wrap_fee') , 99 );

		add_filter( 'woocommerce_get_item_data', array($this,'render_meta_on_cart_and_checkout' ), 99, 2 );

		add_action( 'woocommerce_add_order_item_meta', array($this,'gift_wrap_order_meta_handler'), 99, 3 );

		add_action( "woocommerce_email_after_order_table", array($this,"custom_woocommerce_email_after_order_table"), 10, 2);
	}



	public function custom_woocommerce_email_after_order_table( $order,$haha ) {
		echo $order->ID;
		echo $haha;
	
	}

	public function save_gift_wrap_fee( $cart_item_data, $product_id ) {
		$get_all_attribute = get_post_meta($product_id,'_frequently_bought_together',true);
		if(!empty($get_all_attribute)){
			foreach ($get_all_attribute as $id => $price) {
				if( isset( $_POST[''.$id.''] ) && intval($_POST[''.$id.'']) === $id ) {
					$cart_item_data['additional_option'][$_POST[''.$id.'']] = $price;
				}
			}
			return $cart_item_data;
		}
	}

	public function calculate_gift_wrap_fee( $cart_object ) {
		if( !WC()->session->__isset( "reload_checkout" )) {
			foreach ( $cart_object->cart_contents as $key => $value ) {
				$product_id = $value["product_id"];
				$get_all_attribute = get_post_meta($product_id,'_frequently_bought_together',true);
				if(!empty($get_all_attribute)){
					if(isset($value['additional_option'])){
						foreach ($get_all_attribute as $id => $price) {
							foreach ($value['additional_option'] as $id_cart => $price_cart) {
								if($id == $id_cart){
									if( isset( $value['data']->price ) ) {
										/* Version before 3.0 */
										$orgPrice = floatval( $value['data']->price );
										$value['data']->price = ( $orgPrice + $price );
									} else {
										/* Woocommerce 3.0 + */
										$orgPrice = floatval( $value['data']->get_price() );
										$value['data']->set_price( $orgPrice + $price );
									}           
								}
							}					        				
						}
					}
				}				
			}
		}
	}

	//Cart
	public function render_meta_on_cart_and_checkout( $cart_data, $cart_item = null ) {
		$meta_items = array();
		/* Woo 2.4.2 updates */
		if( !empty( $cart_data ) ) {
	    		$meta_items = $cart_data;
		}
		if( isset( $cart_item['additional_option'] ) ){
			foreach ( $cart_item['additional_option'] as $key => $value ) {
				$meta_items[] = array( "name" => get_post_name($key), "value" => "Yes" );
			}
		}
		return $meta_items;
	}


	//Checkout
	public function gift_wrap_order_meta_handler( $item_id, $values, $cart_item_key ) {
		$array_save = [];
		$get_data = get_post_meta($values['product_id'],'_frequently_bought_together',true);

		if( isset( $values['additional_option'] ) ){
			foreach ( $values['additional_option'] as $key => $value ) {
				wc_add_order_item_meta( $item_id, get_post_name($key), 'Yes' );
				$i = 0;
				foreach ($get_data as $id => $price) {
					$check_id = 'no';
					if($key == $id){
						$check_id = 'yes';
						$array_save[$i] = ['id'=>$id,'value'=>$check_id];
					}else{
						if(empty($array_save[$i]))
							$array_save[$i] = ['id' => $id,'value' => 'no'];
					}
					$i++;
				}	
			}
			wc_add_order_item_meta( $item_id, 'get_options',  $array_save);
		}elseif(!empty($get_data)){
			foreach ($get_data as $id => $price) {
				$array_save[] = ['id'=>$id,'value'=>'no'];
			}
			wc_add_order_item_meta( $item_id, 'get_options',  $array_save);
		}
	}
	

}

?>