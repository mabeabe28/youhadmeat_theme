<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package youhadmeat_theme
 */

?>

<article style="margin-bottom:0;" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'youhadmeat_theme' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		/*wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'youhadmeat_theme' ),
			'after'  => '</div>',
		) );*/
		?>
	</div><!-- .entry-content -->
	<style>
	.entry-footer{
		/*background-color: black;*/
		width: 100%;
		height: auto;
		margin-bottom: 0;
		display: flex;
		justify-content: center;
	}

	.author-box{
		color:black;
	}
	</style>
	<footer class="entry-footer">
		<div class="author-box">
			<?php
			echo 'hello '.get_author_name().'.';
			?>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
