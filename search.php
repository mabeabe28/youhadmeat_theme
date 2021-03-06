<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package youhadmeat_theme
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<style>
				.searchtext{
					position: block;
					text-align: center;
					margin-top: 50px;
				}

				.search-leading{
					position: block;
					text-align: center;
				}

				.search-trailing{
					text-align: center;
				}

				.page-content p{
					text-align: center;
				}
			</style>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="searchtext">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'youhadmeat_theme' ), '<div class="search-trailing">' . get_search_query() . '</div>' );
					?>
				</h1>
			</header><!-- .page-header -->



			<?php
			echo '<div class="card-deck">';
			/*echo '<div class="card-deck-header">
						 <div class="card-deck-header-title"></div>
					 </div>';*/
			echo '<ul class="card-deck__container">';

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				$ParentCategory = "";
				$category = get_the_category();
				foreach($category as $curcat){
					if($curcat->parent == 0){
						$ParentCategory = $curcat;
					}
				}
				$excerptStr = (strlen(get_the_excerpt()) > 40) ? substr(get_the_excerpt(),0,40).'...' :get_the_excerpt();
				$pageTitle = get_the_title();
				$comingsoon = get_post_meta( get_the_id(),'comingsoon', true );
				$postUrl = get_permalink(get_the_id());

				if($comingsoon){
					$pageTitle = 'Coming Soon';
					$excerptStr = '';
					$postUrl = '##';
				}
				$authorUrl = ''.get_site_url().'/'.get_the_author_meta('user_nicename').'';


				echo'	<li class="card category--'.$curcat->slug.'">
					<a href="'.$postUrl.'">
								<div class="card__header">';

								if(get_post_type() == 'post'){
										echo'<div class="card__header-category category--'.$ParentCategory->slug.'">
															<div class="card__header-category__title">'.strtoupper($ParentCategory->name).'</div>
															<div class="card__header-category__icon"></div>
														</div>';//'</div>
								}
				echo '</div>
				<img class="a-card-image-zoom" src="'.get_the_post_thumbnail_url(get_the_id(), 'medium').'" />
								<div class="card__content">
										<div class="card__content-title category--'.$ParentCategory->slug.'">'.$pageTitle.'</div>
										<div class="card__content-excerpt">
											'.$excerptStr.'
										</div>
										<div class="card__author">
											<a href="'.$authorUrl.'">
												'.get_wp_user_avatar(get_the_author_meta('ID'),'small').'
											</a>
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
	</section><!-- #primary -->
	<script>
	    document.getElementById("site-navigation").style.top = "0";
	</script>
<?php
get_footer();
