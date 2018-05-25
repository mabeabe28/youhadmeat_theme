<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package youhadmeat_theme
 */

get_header();
?>
zsfafas
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			echo '<div class="card-deck">';
			echo '<div class="card-deck-header">
						 <div class="card-deck-header-title"></div>
					 </div>';
			echo '<ul class="card-container">';

			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				/*get_template_part( 'template-parts/content', get_post_type() );*/
				echo '<li class="card-wrapper">
									<a href="'.get_permalink(get_the_id()).'">
										<img src="'.get_the_post_thumbnail_url(get_the_id(), 'large').'" />
										<div class="card-header"></div>
										<div class="card-content">
											<div class="card-content-title">'.get_the_title().'</div>
											<div class="card-content-excerpt">
												'.$curpost["post_excerpt"].'
											</div>
										</div>
									</a>
							</li>';



			endwhile;
			echo 		'</ul>';//category-content
			echo '</div>';//category-wrapper
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
