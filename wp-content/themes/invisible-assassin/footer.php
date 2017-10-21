<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package invisible_assassin
 */
?>

	</div><!-- #content -->

	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php printf( __( 'Theme Designed by %1$s.', 'invisible_assassin' ), '<a href="'.esc_url("http://rohitink.com").'" rel="nofollow">Rohit</a>' ); ?>
			<span class="sep"></span>
			<?php echo ( get_theme_mod('invisible_assassin_footer_text') == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').__('. All Rights Reserved. ','invisible_assassin') ) : get_theme_mod('invisible_assassin_footer_text'); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
