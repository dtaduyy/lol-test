<?php 


/**
 *
 * Ajax replace content when click swatch image in product
 *
 */
add_action( 'wp_ajax_add_price_option', 'add_price_option' );
add_action( 'wp_ajax_nopriv_add_price_option', 'add_price_option' );
function add_price_option() {
	$id_post =  $_POST['id'];
	$get_all_id_option = unserialize( get_post_meta( $id_post, '_select_option', true ) );
	$html = '';
	foreach ($get_all_id_option as $key => $value) {
		
		$name_option = get_post_name( $value );
		$html .= "<p class='form-field'><label for='label_options'>$name_option (".get_woocommerce_currency_symbol().") : </label><input type='text' class='wc_input_price' name='price_option_$key' /><input type='hidden' name='name_option_$key' value='$value' /></p>";
	}
	$html .= "<input type='hidden' name='id_option_set' value='$id_post'/>";
	echo $html;
	die();
}


/**
 *
 * Ajax replace content when click swatch image in product
 *
 */
add_action( 'wp_ajax_show_price_option', 'show_price_option' );
add_action( 'wp_ajax_nopriv_show_price_option', 'show_price_option' );
function show_price_option() {
	$id_option = $_POST['id'];
	$post_id = $_POST['post_id'];
	$get_all_id_option = get_post_meta( $post_id, '_frequently_bought_together', true ) ;
	$html = '';
	$key = 0;
	foreach ($get_all_id_option as $id => $price) {
		$name_option = get_the_title_by_id( $id );
		$html .= "<p class='form-field'><label for='label_options'>$name_option (".get_woocommerce_currency_symbol().") : </label><input type='text'  class='wc_input_price' name='price_option_$key' value='$price'/><input type='hidden' name='name_option_$key' value='$id' /></p>";
		$key += 1;
	}
	$html .= "<input type='hidden' name='id_option_set' value='$id_option'/>";
	echo $html;
	die();
}





add_action( 'wp_ajax_change_price', 'change_price' );
// add_action( 'wp_ajax_nopriv_change_price', 'change_price' );
function change_price() {
	$product_id = $_POST['id'];
	$price = $_POST['price'];
	$products = new WC_Product($product_id);
	$total_price = (float)$products->get_price() + (float)$price;
	echo ''.$total_price.'<span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol().'</span>';
	die();
}
?>