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


add_action( 'plugins_loaded', array( 'WC_Product_Options_Set_Template', 'init' ));

class WC_Product_Options_Set_Template {

	public static function init() {
		$class = __CLASS__;
		new $class;
	}

	public function __construct() {
		//Add action here
		$this->hook();
	}

	public function hook(){
		// Add custom type
		add_action('init', array( $this, 'add_custom_product_option_set_type' ) );
		// Add meta box
		add_action( 'add_meta_boxes', array( $this , 'option_select_option_add_meta_box' ) );
		// Modify button save post
		add_action( 'save_post', array( $this , 'option_select_option_save_meta_box_data' ) );

		//Add custom column to Menu Product option set
		add_filter('manage_product_options_set_posts_columns', array($this,'product_option_select_option_column_head') , 10);
		add_action('manage_product_options_set_posts_custom_column', array($this, 'product_option_select_option_column_content') , 10);

	}


	public function product_option_select_option_column_head($columns) {
		$columns['_select_option'] = 'Options';
		
		$new = array();
		foreach($columns as $key => $title) {
			if ($key=='date') // Put the Thumbnail column before the Author column
				$new['_select_option'] = 'Options';
			$new[$key] = $title;
		}
		return $new;
	}

	public function product_option_select_option_column_content($column) {
		if ( '_select_option' != $column ) {
			return;
		}
		$_select_option = unserialize( get_post_meta( get_the_ID(), '_select_option', true ) );
		$array_select = [];
		foreach ($_select_option as $key => $value) {
			$array_select[] = get_the_title_by_id($value);
		}
		$name_option = implode(', ', $array_select);
		echo $name_option;
	}

	

	public function add_custom_product_option_set_type(){
		
		$label = array(
			'name'                => _x( 'Product Options Set', 'Post Type General Name', 'twentythirteen' ),
			'singular_name'       => _x( 'Product Options Set', 'Post Type Singular Name', 'twentythirteen' ),
			'menu_name'           => __( 'Options Set', 'twentythirteen' ),
			'parent_item_colon'   => __( 'Parent Product Options Set', 'twentythirteen' ),
			'all_items'           => __( 'All Product Options Set', 'twentythirteen' ),
			'view_item'           => __( 'View Product Options Set', 'twentythirteen' ),
			'add_new_item'        => __( 'Add New Product Options Set', 'twentythirteen' ),
			'add_new'             => __( 'Add New', 'twentythirteen' ),
			'edit_item'           => __( 'Edit Product Options Set', 'twentythirteen' ),
			'update_item'         => __( 'Update Product Options Set', 'twentythirteen' ),
			'search_items'        => __( 'Search Product Options Set', 'twentythirteen' ),
			'not_found'           => __( 'Not Found Product Options Set', 'twentythirteen' ),
			'not_found_in_trash'  => __( 'Not found Product Options Set in Trash', 'twentythirteen' ),
		);

		
		$args = array(
			'labels' => $label, 
			
			'supports' => array(
				'title',
				'editor',
			), 
			'hierarchical' => false, 
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => true, 
			'menu_position' => 56, 
			'menu_icon' => 'dashicons-admin-post',
			'can_export' => true, 
			'has_archive' => true, 
			'exclude_from_search' => false, 
			'publicly_queryable' => true, 
			'capability_type' => 'post' 
		);

		register_post_type('product_options_set', $args); 
	 
	}

	public function option_select_option_add_meta_box() {
		//this will add the metabox for the member post type
		$screens = array( 'product_options_set' );

		foreach ( $screens as $screen ) {
			add_meta_box(
				'select_option_sectionid',
				__( 'Select Product Options', 'select_option_textdomain' ),
				array($this,'select_option_meta_box_callback'),
				$screen
			);
		}
	}

	/**
	 * Prints the box content.
	 *
	 * @param WP_Post $post The object for the current post/page.
	 */
	public function select_option_meta_box_callback( $post ) {
		include_once(WP_PLUGIN_DIR.'\woocommerce-product-options\templates\admin\wc-product-option-set-meta-box.php' );
		
	}

	/**
	 * When the post is saved, saves our custom data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function option_select_option_save_meta_box_data( $post_id ) {

		if ( ! isset( $_POST['select_option_meta_box_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['select_option_meta_box_nonce'], 'select_option_save_meta_box_data' ) ) {
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

		if ( ! isset( $_POST['select_option_new_field'] ) ) {
			return;
		}

		// $my_data = sanitize_text_field( $_POST['select_option_new_field'] );
		$my_data = serialize( $_POST['select_option_new_field']);
		update_post_meta( $post_id, '_select_option', $my_data );
	}

}

?>