<?php
/**
 * Template name: --Category and Product
 */


get_header();


global $logo_team;


?>


        <div class="main">
                <?php 
		$taxonomy_name = 'khu_vuc';
		$term_children = get_term_children( 83,$taxonomy_name);
		$term_children_8 = array_merge($term_children,$term_children);
		shuffle($term_children_8);
		shuffle($term_children);

		// echo '<div class="round_robin">';
		// foreach ( $term_children as $key=>$child ) {
		// 	$term = get_term_by( 'id', $child, $taxonomy_name );
		// 	echo '<div class="team"><img src="'.$logo_team.$term->slug.'.png" />' . $term->name . '</div>';
		// }
		// echo '</div>';

	?>

	<table border="1">
		<tr>
			<td>a</td>
		</tr>
		<tr>
			<td>b</td>
		</tr>
	</table>


        </div>

        



        <?php
get_footer();
?>