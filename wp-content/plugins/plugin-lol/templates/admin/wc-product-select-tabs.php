<?php

global $post;
$get_options_product = get_posts([
	'post_type' => 'product_options_set',
	'post_status' => 'publish'
	// 'order'    => 'ASC'
]);
?>

<div id = 'select_option_set' class = 'panel woocommerce_options_panel' > 
	<div class="options_group">
		<p class="form-field">
			<label for="label_options">
				Select Option Set :
			</label>
	  		<select multiple="multiple" data-placeholder="<?php esc_attr_e( 'Select Option Set', 'woocommerce' ); ?>" class="multiselect select_option wc-enhanced-select-product-tab" name="select_option_set_new_field" >
				<?php 
				foreach ($get_options_product as $key => $value) {
				?> 
					<option value="<?php echo $value->ID ?>" <?php echo selected( has_option_product_tabs( $post->ID , $value->ID ), true ) ?>><?php echo $value->post_title ?></option>
				<?php 
				}
				?>
			</select>
		</p>
	</div>

	<div class="wr_name_option_set options_group">
			
	</div>
	<input type="hidden" value="<?php echo $post->ID ?>" class="post_id" />
</div>