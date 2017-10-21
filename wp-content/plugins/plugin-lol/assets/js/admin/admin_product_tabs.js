
jQuery(document).ready(function(){

	function getEnhancedSelectFormatString() {
		var formatString = {
			formatMatches: function( matches ) {
				if ( 1 === matches ) {
					return wc_enhanced_select_params.i18n_matches_1;
				}

				return wc_enhanced_select_params.i18n_matches_n.replace( '%qty%', matches );
			},
			formatNoMatches: function() {
				return wc_enhanced_select_params.i18n_no_matches;
			},
			formatAjaxError: function() {
				return wc_enhanced_select_params.i18n_ajax_error;
			},
			formatInputTooShort: function( input, min ) {
				var number = min - input.length;

				if ( 1 === number ) {
					return wc_enhanced_select_params.i18n_input_too_short_1;
				}

				return wc_enhanced_select_params.i18n_input_too_short_n.replace( '%qty%', number );
			},
			formatInputTooLong: function( input, max ) {
				var number = input.length - max;

				if ( 1 === number ) {
					return wc_enhanced_select_params.i18n_input_too_long_1;
				}

				return wc_enhanced_select_params.i18n_input_too_long_n.replace( '%qty%', number );
			},
			formatSelectionTooBig: function( limit ) {
				if ( 1 === limit ) {
					return wc_enhanced_select_params.i18n_selection_too_long_1;
				}

				return wc_enhanced_select_params.i18n_selection_too_long_n.replace( '%qty%', limit );
			},
			formatLoadMore: function() {
				return wc_enhanced_select_params.i18n_load_more;
			},
			formatSearching: function() {
				return wc_enhanced_select_params.i18n_searching;
			}
		};

		return formatString;
	}


	jQuery(".wc-enhanced-select-product-tab").filter( ':not(.enhanced)' ).each( function() {
		var select2_args = jQuery.extend({
			minimumResultsForSearch: 10,
		 	maximumSelectionSize: 1,
			allowClear:  jQuery( this ).data( 'allow_clear' ) ? true : false,
			placeholder: jQuery( this ).data( 'placeholder' )
		}, getEnhancedSelectFormatString() );

		jQuery( this ).select2( select2_args ).addClass( 'enhanced' ).on('select2-selecting',function(e){		
			var id_select = e.val;
			var url = ajax_object.ajax_url;
			setTimeout(function(){
				jQuery.ajax({
					type: "POST",
					url: url,
					data: { action:'add_price_option',id:id_select},
					async:false,
					success: function (data) {
						
						jQuery('.wr_name_option_set').html(data);
					}
				});
			},100);
		}).on("select2-removing", function(e) {
			jQuery('.wr_name_option_set').empty();
		});

	});


	var selected_option = jQuery('.wc-enhanced-select-product-tab option:selected');
	if(selected_option){
		var id_select = selected_option.val();
		var post_id = jQuery('.post_id').val();
		var url = ajax_object.ajax_url;
		setTimeout(function(){
			jQuery.ajax({
				type: "POST",
				url: url,
				data: { action:'show_price_option',id:id_select,post_id:post_id},
				async:false,
				success: function (data) {
					jQuery('.wr_name_option_set').html(data);
				}
			});
		},100);
	}



	jQuery('.wc-enhanced-select-option-set').filter( ':not(.enhanced)' ).each( function() {
		var select2_args = jQuery.extend({
			minimumResultsForSearch: 10,
			allowClear:  jQuery( this ).data( 'allow_clear' ) ? true : false,
			placeholder: jQuery( this ).data( 'placeholder' )
		}, getEnhancedSelectFormatString() );

		jQuery( this ).select2( select2_args ).addClass( 'enhanced' );
	});

});
