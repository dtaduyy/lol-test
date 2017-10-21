<?php
/**
 * WooCommerce Admin Functions
 *
 * @author   WooThemes
 * @category Core
 * @package  WooCommerce/Admin/Functions
 * @version  2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Check Option set already has option
 *
 * @param string $post_id, string $option_id
 * @return boolean
 */
function has_option_product( $post_id , $option_id ) {

	$post = get_post($post_id);

	if ( !$post )
		return false;

	$r = is_exist_in_option( $post_id , $option_id);
	if ( is_wp_error( $r ) )
		return false;

	return $r;
}

/**
 * Check Option set
 *
 * @param string $post_id, $option_id
 * @return boolean
 */
function is_exist_in_option($post_id , $option_id){
	$get_option = get_post_meta( $post_id, '_select_option', true );
	$get_option = unserialize( $get_option ) ;
	if(!empty($get_option)){
		foreach ($get_option as $key => $value) {
			if($value == $option_id)
				return true;
		}
	}
	return false;
}

/**
 * Returns post title.
 *
 * @param string $post_id
 * @return string
 */
function get_post_name($post_id){
	global $wpdb;
	$sql_code = "SELECT post_title FROM wp_posts WHERE ID = $post_id ";
	$get_post_name = $wpdb->get_var($sql_code) ;
	return $get_post_name;

}

/**
 * Returns slug.
 *
 * @param string $post_id
 * @return string
 */
function get_slug($post_id){
	global $wpdb;
	$sql_code = "SELECT post_name FROM wp_posts WHERE ID = $post_id ";
	$get_post_name = $wpdb->get_var($sql_code) ;
	return $get_post_name;
}


function get_post_id($post_id){
	global $wpdb;
	$sql_code = "SELECT ID FROM wp_posts WHERE ID = $post_id ";
	$get_post_name = $wpdb->get_var($sql_code) ;
	return $get_post_name;

}

/**
 * Returns post title by name.
 *
 * @param string $post_name
 * @return string
 */
function get_the_title_by_name($post_name){
	global $wpdb;
	$sql_code = "SELECT post_title FROM wp_posts WHERE post_name = '$post_name' ";
	$get_post_title = $wpdb->get_var($sql_code) ;
	return $get_post_title;
}


function get_the_title_by_id($ID){
	global $wpdb;
	$sql_code = "SELECT post_title FROM wp_posts WHERE ID = '$ID' ";
	$get_post_title = $wpdb->get_var($sql_code) ;
	return $get_post_title;
}

/**
 * Returns count option.
 *
 * @param string $id
 * @return string
 */
function count_option_in_option_set($id){
	$get_count = count( unserialize( get_post_meta( $id, '_select_option', true ) ) );
	return $get_count;
}

function get_name_by_slug($slug){
	global $wpdb;
	$sql_code = "SELECT post_title FROM wp_posts WHERE post_name = '$slug' ";
	$get_post_title = $wpdb->get_var($sql_code) ;
	return $get_post_title;
}

function has_option_product_tabs( $post_id , $option_id ) {

	$post = get_post($post_id);

	if ( !$post )
		return false;

	$r = is_exist_in_tabs( $post_id , $option_id);
	if ( is_wp_error( $r ) )
		return false;

	return $r;
}

function is_exist_in_tabs($post_id , $option_id){
	$get_option = get_post_meta( $post_id, '_name_option_selected', true );
	if(!empty($get_option)){
		if($get_option == $option_id)
			return true;
	}
	return false;
}

?>