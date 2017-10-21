<?php 


// Add a nonce field so we can check for it later.
wp_nonce_field( 'select_option_save_meta_box_data', 'select_option_meta_box_nonce' );


$get_options_product = get_posts([
  'post_type' => 'product_options',
  'post_status' => 'publish'
  // 'order'    => 'ASC'
]);
?>



<label for="select_option_new_field">
 <?php _e( 'Select Product Options', 'select_option_textdomain' ); ?>
</label>

 <div id="custom_variation">
              
	<select multiple="multiple" data-placeholder="<?php esc_attr_e( 'Select Option', 'woocommerce' ); ?>" class="multiselect wc-enhanced-select-option-set" name="select_option_new_field[]" >

		<?php 
		foreach ($get_options_product as $key => $value) {

		?> 

			<option value="<?php echo $value->ID ?>" <?php echo selected( has_option_product( $post->ID , $value->ID ), true ) ?>><?php echo $value->post_title ?></option>

		<?php 
		}

		?>

	</select>
</div>