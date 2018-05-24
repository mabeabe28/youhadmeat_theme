<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package youhadmeat_theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		the_content();

		?>
	</div><!-- .entry-content -->
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<!--<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'youhadmeat_theme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>-->
		</footer><!-- .entry-footer -->
	<?php endif; ?>

	<?php
	$pagetype = get_post_meta( the_ID(),'page-type', true );
	if($pagetype = "category"){
		echo "This is a category page";
	}else if($pagetype = "author"){
		echo "This is a author page";
	}

	?>

</article><!-- #post-<?php the_ID(); ?> -->
