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
	<style>
		#site-navigation{
			background-color: black;
		}
	</style>
	<script>

	$(document).on('scroll', function () {
			event.stopPropagation();
			event.preventDefault();
			$('#site-navigation').css('background-color', 'rgba(0,0,0,100)');

	});

	</script>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php

				the_archive_title( '<h1 class="archivetitle">', '</h1>' );
				the_archive_description( '<div class="archivedesc">', '</div>' );
				?>
			</header><!-- .page-header -->
			<style>
				.archivetitle{
					position: block;
					text-align: center;
					margin-top: 50px;
				}

				.archivedesc{
					position: block;
					text-align: center;
				}

				.archivedesc p{
					text-align: center;
				}
			</style>
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
				$ParentCategory = "";
				$category = get_the_category();
				foreach($category as $curcat){
					if($curcat->parent == 0){
						$ParentCategory = $curcat;
					}
				}
				$excerptStr = (strlen(get_the_excerpt()) > 70) ? substr(get_the_excerpt(),0,70).'...' :get_the_excerpt();
				$pageTitle = get_the_title();
				$comingsoon = get_post_meta( get_the_id(),'comingsoon', true );
				if($comingsoon){
					$pageTitle = 'Coming Soon';
					$excerptStr = '##';
					$postUrl = get_permalink(get_the_id());
				}
				echo '<li class="card-wrapper category--'.$ParentCategory->slug.'">
									<a href="'.$postUrl.'">
										<div class="card-header"><div class="card-header-category category--'.$ParentCategory->slug.'">
											<div class="category-title">'.$ParentCategory->name.'</div>
										</div></div>
										<img src="'.get_the_post_thumbnail_url(get_the_id(), 'large').'" />
										<div class="card-content">
											<div class="card-content-container">
												<div class="card-content-title">'.$pageTitle.'</div>
												<div class="card-content-excerpt">
													'.$excerptStr.'
												</div>
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
/*get_sidebar();*/
get_footer();
