

jQuery(document).ready(function(){
	var current_price = jQuery('meta[itemprop="price"]').attr('content');
	var current_currency = jQuery('.woocommerce-Price-currencySymbol').html();
	jQuery('.select_product_options').on('change',function(){
		var additional_price = jQuery(this).attr('price');
		if(jQuery(this).is(':checked')){
			var totalprice = parseFloat(current_price,2) + parseFloat(additional_price,2);
		}
	  	else{
			var totalprice = parseFloat(current_price,2) - parseFloat(additional_price,2);
	  	}
	  	totalprice = roundNumber(totalprice,2);
	  	current_price = totalprice;
	  	var data ='<span class="woocommerce-Price-currencySymbol">'+current_currency+'</span>' + totalprice ;
	  	if(jQuery('.price').find('del').length != 0){
			jQuery('.price').find('strong').find('.woocommerce-Price-amount').html(data);
		}else{

			jQuery('.price').find('.woocommerce-Price-amount').html(data);
		}

	});
	function roundNumber(num, dec) {
		var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
		return result;
	}
});
