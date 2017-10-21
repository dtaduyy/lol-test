--------------Plugin Product Options--------------
- Add Product Options
	+ Add to table wp_posts with post_types = "product_options"
- Add Product Options Set
	+ Add to table wp_posts with post_types = "product_options_set"
	+ Add to table wp_postmeta with metakey = "_select_option"
- Add Product Options Set to Product
	+ Add to table wp_postmeta with two new metakey "_name_option_selected" and "_frequently_bought_together" 


=== WooCommerce Product Options ===
Contributors: Duy
Tags: Options,Product Options,Woocommerce,Add Options
Requires at least : 3.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The plugin add "Options" and "Option Set" on WooCommerce cart page and in Admin Page.

== Description ==

The plugin allow buyer to select the purchased product with other option set on Product page. And the additional price will be added with order total.

Admin should add Options, then add Options Set in Admin. Then add Options set to Product in Product Options tab


Default cost will be 50 in the local currency as per set for wooCommerce settings.


Any problems? [Contact Us](http://aheadzen.com/contact/)

== Installation ==
1. Unzip and upload plugin folder to your /wp-content/plugins/ directory  OR Go to wp-admin > plugins > Add new Plugin & Upload plugin zip.
2. Go to wp-admin > Plugins(left menu) > Activate the plugin
3. Go to wp-admin > WooCommerce Settings > Checkout (tab) > "Gift Packing Cost" set the packing cost.

== Screenshots ==
1. Checkout gift packing option
2. Admin gift packing cost settings
3. Gift packing charge on checkout and order detail


== Changelog ==

= 1.0.0.0 =
* Fresh Public Release.
