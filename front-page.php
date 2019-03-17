<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package youhadmeat_theme
 */

get_header();
?>
<!--Background for Front Page only-->
<style>
body{
  background-color: rgb(35,35,35);
  color: white;
}
</style>
			<section>

				<!-- get most recent post from each category -->
				<div class="hero-wrapper">

				<!--Show the Featured Post First-->
				<?php
					$ignoreCats = array("blog", "uncategorised","uncategorized","community");

					//Get the latest feature post only
					$featuredargs = array(
					'numberposts' => 1,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true,
					'meta_query' => array(
					        array(
					            'key' => 'featured',
					            'value' => '1',
					            'compare' => '='
					        )
					));
					$featuredpost=wp_get_recent_posts($featuredargs);
					if(sizeOf($featuredpost) > 0){
						$category = get_the_category($featuredpost[0]["ID"]);
						$ParentCategory = "";
						foreach($category as $curcat){
							if($curcat->parent == 0){
								$ParentCategory = $curcat;
							}
						}

						$featuredWord = $ParentCategory->cat_name;
						$queryFeaturedWord = get_post_meta( $featuredpost[0]["ID"],'featured-word', true );
						if(strlen($queryFeaturedWord)){
							$featuredWord = $queryFeaturedWord;
						}

						$excerptStr = (strlen($featuredpost[0]["post_excerpt"]) > 100) ? substr($featuredpost[0]["post_excerpt"],0,100).'...' :$featuredpost[0]["post_excerpt"];
						$postUrl = get_permalink($featuredpost[0]["ID"]);
						$ctaText = 'Read More';

						echo '<div class="slide__container js-slider" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)), url('.get_the_post_thumbnail_url($featuredpost[0]["ID"], 'large').');">
										<div style="display:none;">
											<!--load image before hand,but hide display to prevent blank flashes when changing slide since background-image still be loading image-->
											<img src="'.get_the_post_thumbnail_url($featuredpost[0]["ID"], 'large').'">
										</div>
								  </div>
									<div class="slide-wrapper">
										<div class="slide-title category--'.$ParentCategory->slug.'">
											<div class="slide-title__leading">
												<h1>YOU HAD ME AT</h1>
											</div>
											<div class="slide-title__trailing js-slide-title">
												<h1>'.strtoupper($featuredWord).'</h1>
											</div>
										</div>
										<div class="slide-excerpt">
											<div class="slide-excerpt__container js-slide-excerpt" >
												<div class="slide-excerpt__text">
													'.$excerptStr.'
												</div>
												<div class="slide-excerpt__cta">
													<div class="slide-excerpt__cta-container" >
														<a class="button category--'.$ParentCategory->slug.'" href="'.$postUrl.'">'.$ctaText.'</a>
													</div>
												</div>
											</div>
										</div>
									</div>';
					}
				?>

				<?php
				//get all top level categories
				$catargs = array(
					'parent' => 0,
					'category__not_in' => array(96,104,1)
				);
				$categories=get_categories($catargs);

				//get posts categoryies in order of latest post overall
		    $recent_posts = array();
		    foreach ($categories as $key=>$category) {
		        // get latest post from the current $category - and make sure its not the same as featured
		        $args = array(
		            'numberposts' => 1,
		            'category' => $category->term_id,
								'post__not_in' => array($featuredpost[0]["ID"])
		        );
		        $post = get_posts($args)[0];
		        // save category id & post date in an array
		        $recent_posts[ $category->term_id ] = strtotime($post->post_date);
		    }
		    // sort that array in order by post date, preserve category_id
		    arsort($recent_posts);
		    // get $limit most recent category ids
		    $recent_categories = array_slice(array_keys($recent_posts), 0, $limit);

				//for each category, now in correct order
		  	foreach($recent_categories as $category) {

					$args = array(
						'numberposts' => 1,
						'category' => $category,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'suppress_filters' => true,
						'post__not_in' => array($featuredpost[0]["ID"])
					);

					//get one recent post from that category and thats not the featured post. This will be used as the object
					$recent_post = wp_get_recent_posts( $args );

					//get the categories for the post, then we have to loop it to get the top level category which we will display
					$category = get_the_category($recent_post[0]["ID"]);
					$ParentCategory = "";
					foreach($category as $curcat){
						if($curcat->parent == 0){
							$ParentCategory = $curcat;
						}
					}


					if($ParentCategory->count > 0){
						if(has_post_thumbnail($recent_post[0]["ID"])){
							$excerptStr = (strlen($recent_post[0]["post_excerpt"]) > 100) ? substr($recent_post[0]["post_excerpt"],0,100).'...' :$recent_post[0]["post_excerpt"];
							$comingsoon = get_post_meta( $recent_post[0]["ID"],'comingsoon', true );
							$pageTitle = get_the_title($recent_post[0]["ID"]);
							$postUrl = get_permalink($recent_post[0]["ID"]);
							$ctaText = 'Read More';
							if($comingsoon){
								$pageTitle = '';
								$excerptStr = 'Content Coming Soon';
								$postUrl = '##';
								$ctaText = 'Coming Soon';
							}
							$catLink = ''.get_site_url().'/'.$curcat->slug.'';

							$featuredWord = $ParentCategory->cat_name;
							$queryFeaturedWord = get_post_meta( $recent_post[0]["ID"],'featured-word', true );
							if(strlen($queryFeaturedWord)){
								$featuredWord = $queryFeaturedWord;
							}
							echo '  <div class="slide__container js-slider" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)), url('.get_the_post_thumbnail_url($recent_post[0]["ID"], 'large').');">
							<div style="display:none;">
								<!--load image before hand,but hide display to prevent blank flashes when changing slide since background-image still be loading image-->
								<img src="'.get_the_post_thumbnail_url($recent_post[0]["ID"], 'large').'">
							</div>
							</div>

						';

						echo '<div class="slide-wrapper">';
							echo '<div class="slide-title category--'.$ParentCategory->slug.'">
								<div class="slide-title__leading">
									<h1>YOU HAD ME AT</h1>
								</div>
								<div class="slide-title__trailing js-slide-title">
									<h1>'.strtoupper($featuredWord).'</h1>
								</div>
							</div>';

							echo '<div class="slide-excerpt">
								<div class="slide-excerpt__container js-slide-excerpt" >
									<div class="slide-excerpt__text">
										'.$excerptStr.'
									</div>

									<div class="slide-excerpt__cta">
										<div class="slide-excerpt__cta-container" >
											<a class="button category--'.$ParentCategory->slug.'" href="'.$postUrl.'">'.$ctaText.'</a>
										</div>
									</div>

								</div>';
								//echo '<div class="slider-scroll-down anmt-scroll-down"></div>';
								echo '</div>';
							echo '</div>';

						}
				 	}
				} // foreach($categories
				?>

				<!-- Next and previous buttons-->
   <a class="slider-button slider-button__previous" onclick="minusSlides(-1)">&#10094;</a>
   <a class=" slider-button slider-button__next" onclick="plusSlides(1)">&#10095;</a>

			</div>
			</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


		<?php
		if ( have_posts() ) :

			/*if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?> </h1>
				</header>
				<?php
			endif;*/

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		endif;
		?>

		<?php
		//get all cats
		//$categories_all=get_categories();
		echo '<div class="card-deck">
			<div class="card-deck__latest">
				<h1>
					LATEST POSTS
				</h1>
			</div>
			<ul class="card-deck__container">';


			$args = array(
				'numberposts' => 4,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'suppress_filters' => true
			);

			//get four recent post
			$recent_posts_all = wp_get_recent_posts( $args );
			foreach($recent_posts_all as $post){
				$curPostTitle = $post["post_title"];
				$curExcerptStr = (strlen($post["post_excerpt"]) > 40) ? substr($post["post_excerpt"],0,40).'...' :$post["post_excerpt"];
				$curPostUrl = get_permalink($post["ID"]);
				$comingsoon = get_post_meta( $post["ID"],'comingsoon', true );
				if($comingsoon){
					$curPostTitle = 'Coming Soon';
					$curExcerptStr = 'Content Coming Soon';
					$curPostUrl = '##';
				}
				$curCategory = get_the_category($post["ID"]);
				$curParentCategory = "";

				foreach($curCategory as $cat){
					if($cat->parent == 0){
						$curParentCategory = $cat;
					}
				}
				$authorUrl = ''.get_site_url().'/'.get_the_author_meta('user_nicename',$post["post_author"]).'';


				echo'	<li class="card post--'.$post["ID"].' category--'.$curParentCategory->slug.'">
					<a href="'.$curPostUrl.'">
								<div class="card__header"><div class="card__header-category category--'.$curParentCategory->slug.'">
									<div class="card__header-category__title">'.strtoupper($curParentCategory->name).'</div>
									<div class="card__header-category__icon"></div>
								</div></div>
								<img class="a-card-image-zoom" src="'.get_the_post_thumbnail_url($post["ID"], 'medium').'" />
								<div class="card__content">
										<div class="card__content-title category--'.$curParentCategory->slug.'">'.$curPostTitle.'</div>
										<div class="card__content-excerpt">
											'.$curExcerptStr.'
										</div>
										<div class="card__author">
											<a href="'.$authorUrl.'">
												'.get_wp_user_avatar($post["post_author"],'small').'
											</a>
										</div>
								</div>
							</a>
					</li>';
			}



		echo'	</ul>
		</div>';
		//for each category
		foreach($recent_categories as $catID) {
				//set category object
			$curcat = get_category($catID);
			if(!in_array($curcat->slug, $ignoreCats)){
				$catLink = ''.get_site_url().'/'.$curcat->slug.'';
				echo '<div class="card-deck" cat-attr="'.$curcat->name.'" >';
			 	/*echo '<div class="card-deck-header">
								<div class="card-deck-header-title"><h1>'.$curcat->name.'</h1></div>
							</div>';*/
				echo '<div class="card-deck__divider category--'.$curcat->slug.'">
							    <div class="card-deck__divider-text">
							        '.strtoupper($curcat->name).'
							    </div>
									<div class="card-deck__divider-cta button">
							        <a href="'.$catLink.'">MORE '.strtoupper($curcat->name).'</a>
							    </div>
							</div>
							';
				echo '<ul class="card-deck__container">';

				$args = array(
					'numberposts' => 4,
					'category' => $catID,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true
				);

				//get four recent post
				$recent_three = wp_get_recent_posts( $args );
				foreach($recent_three as $curpost){

					$excerptStr = (strlen($curpost["post_excerpt"]) > 40) ? substr($curpost["post_excerpt"],0,40).'...' :$curpost["post_excerpt"];
					$pageTitle = $curpost["post_title"];
					$postUrl = get_permalink($curpost["ID"]);
					$comingsoon = get_post_meta( $curpost["ID"],'comingsoon', true );
					if($comingsoon){
						$pageTitle = 'Coming Soon';
						$excerptStr = 'Content Coming Soon';
						$postUrl = '##';
					}

					$authorUrl = ''.get_site_url().'/'.get_the_author_meta('user_nicename',$curpost["post_author"]).'';

					echo'	<li class="card post--'.$curpost["ID"].' category--'.$curcat->slug.'">
						<a href="'.$postUrl.'">
									<div class="card__header"><div class="card__header-category category--'.$curcat->slug.'">
										<div class="card__header-category__title">'.strtoupper($curcat->name).'</div>
										<div class="card__header-category__icon"></div>
									</div></div>
									<img class="a-card-image-zoom" src="'.get_the_post_thumbnail_url($curpost["ID"], 'medium').'" />
									<div class="card__content">
											<div class="card__content-title category--'.$curcat->slug.'">'.$pageTitle.'</div>
											<div class="card__content-excerpt">
												'.$excerptStr.'
											</div>
											<div class="card__author">
												<a href="'.$authorUrl.'">
													'.get_wp_user_avatar($curpost["post_author"],'small').'
												</a>
											</div>
									</div>
								</a>
						</li>';

				}


				echo 		'</ul>';//category-content
					echo '<div class="card-deck__cta">
									<a href="'.$catLink.'" class="button button category--'.$curcat->slug.'">
									  View more in '.$curcat->name.'
									</a>
								</div>';
				echo '</div>';//category-wrapper
			}
		}//for each category

		wp_reset_query();
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    document.getElementById("site-navigation").style.top = "0";
  } else {
    document.getElementById("site-navigation").style.top = "-50px";
  }
}
</script>
<?php
/*get_sidebar();*/
get_footer();
