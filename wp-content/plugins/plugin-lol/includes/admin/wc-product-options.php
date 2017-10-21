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


add_action( 'plugins_loaded', array( 'WC_Product_Options_Template', 'init' ));

class WC_Product_Options_Template {

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
		
		$label = array(
			'name'                => _x( 'Product Options', 'Post Type General Name', 'twentythirteen' ),
			'singular_name'       => _x( 'Product Options', 'Post Type Singular Name', 'twentythirteen' ),
			'menu_name'           => __( 'Options', 'twentythirteen' ),
			'parent_item_colon'   => __( 'Parent Product Options', 'twentythirteen' ),
			'all_items'           => __( 'All Product Options', 'twentythirteen' ),
			'view_item'           => __( 'View Product Options', 'twentythirteen' ),
			'add_new_item'        => __( 'Add New Product Options', 'twentythirteen' ),
			'add_new'             => __( 'Add New', 'twentythirteen' ),
			'edit_item'           => __( 'Edit Product Options', 'twentythirteen' ),
			'update_item'         => __( 'Update Product Options', 'twentythirteen' ),
			'search_items'        => __( 'Search Product Options', 'twentythirteen' ),
			'not_found'           => __( 'Not Found Product Options', 'twentythirteen' ),
			'not_found_in_trash'  => __( 'Not found Product Options in Trash', 'twentythirteen' ),
		);

		$args = array(
			'labels' => $label, 
			'description' => '', 
			'supports' => array(
				'title',
				'editor',
			), 
			'hierarchical' => false, 
			'public' => false,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'show_in_admin_bar' => true, 
			'menu_position' => 58, 
			'menu_icon' => 'dashicons-admin-post', 
			'can_export' => true, 
			'has_archive' => true, 
			'exclude_from_search' => false, 
			'publicly_queryable' => true,
			'capability_type' => 'post'
		);

		register_post_type('product_options', $args); 
	 
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