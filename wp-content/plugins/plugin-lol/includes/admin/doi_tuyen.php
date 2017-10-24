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


add_action( 'plugins_loaded', array( 'doi_tuyen', 'init' ));

class doi_tuyen {

	public static function init() {
		$class = __CLASS__;
		new $class;
	}

	public function __construct() {
		$this->hook();
	}

	public function hook(){
		// Add custom type
		add_action('init', array( $this, 'add_custom_product_option_type' ) );
		// Modify button save post
		add_action( 'save_post', array( $this , 'option_price_save_meta_box_data' ) );

	}

	public function add_custom_product_option_type(){
		
	$labels = array(
		'name' => _x( 'Khu Vực / Đội Tuyển', 'taxonomy general name' ),
		'singular_name' => _x( 'Khu Vực / Đội Tuyển', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Khu Vực / Đội Tuyển' ),
		'all_items' => __( 'All Khu Vực / Đội Tuyển' ),
		'parent_item' => __( 'Parent Topic' ),
		'parent_item_colon' => __( 'Parent Topic:' ),
		'edit_item' => __( 'Edit Topic' ), 
		'update_item' => __( 'Update Topic' ),
		'add_new_item' => __( 'Add New Topic' ),
		'new_item_name' => __( 'New Topic Name' ),
		'menu_name' => __( 'Khu Vực / Đội Tuyển' ),
	);    

	// Now register the taxonomy

	register_taxonomy('khu_vuc',array('tuyen_thu'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_menu' =>true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'topic' ),
	));
	 
	}

	/**
	 * When the post is saved, saves our custom data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function option_price_save_meta_box_data( $post_id ) {

		if ( ! isset( $_POST['price_meta_box_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['price_meta_box_nonce'], 'price_save_meta_box_data' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

	}

}

?>