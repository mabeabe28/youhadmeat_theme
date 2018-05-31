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

			<section>

				<!-- get most recent post from each category -->
				<div class="slideshow-container">

				<?php
				//get all cats
				$catargs = array(
					'parent' => 0
				);
				$categories=get_categories($catargs);
				//for each category
		  	foreach($categories as $category) {

					$args = array(
						'numberposts' => 1,
						'category' => $category->term_id,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'suppress_filters' => true
					);

					//get one recent post
					$recent_post = wp_get_recent_posts( $args );
					//get the categories for the post
					$category = get_the_category($recent_post[0]["ID"]);
					$ParentCategory = "";

					foreach($category as $curcat){
						if($curcat->parent == 0){
							$ParentCategory = $curcat;
						}
					}

					//todo amend this.
					if($ParentCategory->count > 0){
						echo '<div class="mySlides">';

						if(has_post_thumbnail($recent_post[0]["ID"])){
							$excerptStr = (strlen($recent_post[0]["post_excerpt"]) > 140) ? substr($recent_post[0]["post_excerpt"],0,200).'...' :$recent_post[0]["post_excerpt"];

							// use one of these
							//echo get_the_post_thumbnail( $post_id, array(80, 80), array('class' => 'post_thumbnail') );
							echo '
							<div class="hero featured-fade" style="background-image:linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.4)), url('.get_the_post_thumbnail_url($recent_post[0]["ID"], 'full').');">
									<!--load image before hand,but hide display to prevent blank flashes when changing slide since background-image still be loading image-->
									<div style="display:none;">
										<img src="'.get_the_post_thumbnail_url($recent_post[0]["ID"], 'full').'">
									</div>


									<div id="youhadmeatHeroText">
											<div id="leading">You Had Me At</div>
											<div id="trailing" class="fade">'.$ParentCategory->cat_name.'
												<div id="recentPost">
													<div style="font-size:12px;">Latest Post:</div>
													<div class="recentPost_detail">
														'.get_the_title($recent_post[0]["ID"]).'
													</div>
													<div class="recentPost_excerpt">
														'.$excerptStr.'
													</div>
													<div class="cta" style="font-size: 15px;"><a class="ghost-button category--'.$ParentCategory->slug.'" href="'.get_permalink($recent_post[0]["ID"]).'">Read More</a></div>
												</div>
											</div>
									</div>

							</div>
							';
						}
						echo '<div class="scroll-down"></div>';
						echo '</div>';
				 }
				} // foreach($categories
				?>

				<!-- Next and previous buttons -->
   <!--<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
   <a class="next" onclick="plusSlides(1)">&#10095;</a>-->
			</div>
			</section>
			<style>

.scroll-down {
	position: absolute;
	bottom: 10px;
	display: block;
	text-align: center;
	z-index: 100;
	text-decoration: none;
	text-shadow: 0;
  width: 30px;
  height: 30px;
  border-bottom: 2px solid #fff;
  border-right: 2px solid #fff;
  z-index: 9;
  right: 2%;
  -webkit-transform: translate(-50%, 0%) rotate(45deg);
  -moz-transform: translate(-50%, 0%) rotate(45deg);
  transform: translate(-50%, 0%) rotate(45deg);
	-webkit-animation: fade_move_down 3s ease-in-out infinite;
	-moz-animation:    fade_move_down 3s ease-in-out infinite;
	animation:         fade_move_down 3s ease-in-out infinite;
}


/*animated scroll arrow animation*/
@-webkit-keyframes fade_move_down {
  0%   { -webkit-transform:translate(0,-10px) rotate(45deg); opacity: 0;  }
  50%  { opacity: 1;  }
  100% { -webkit-transform:translate(0,10px) rotate(45deg); opacity: 0; }
}
@-moz-keyframes fade_move_down {
  0%   { -moz-transform:translate(0,-10px) rotate(45deg); opacity: 0;  }
  50%  { opacity: 1;  }
  100% { -moz-transform:translate(0,10px) rotate(45deg); opacity: 0; }
}
@keyframes fade_move_down {
  0%   { transform:translate(0,-10px) rotate(45deg); opacity: 0;  }
  50%  { opacity: 1;  }
  100% { transform:translate(0,10px) rotate(45deg); opacity: 0; }
}</style>
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
		//for each category
		foreach($categories as $curcat) {
			//print_r($curcat);
			echo '<div class="card-deck category--'.$curcat->slug.'" cat-attr="'.$curcat->name.'" >';
		 	echo '<div class="card-deck-header">
							<div class="card-deck-header-title"><h1>'.$curcat->name.'<h1></div>
						</div>';
			echo '<ul class="card-container">';

			$args = array(
				'numberposts' => 3,
				'category' => $curcat->term_id,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'suppress_filters' => true
			);

			//get three recent post
			$recent_three = wp_get_recent_posts( $args );
			foreach($recent_three as $curpost){

				//print_r($curpost);
				echo '<li class="card-wrapper category--'.$curcat->slug.'">
									<a href="'.get_permalink($curpost["ID"]).'">
										<div class="card-header"><div class="card-header-category category--'.$curcat->slug.'">
											<div class="category-title">'.$curcat->name.'</div>
										</div></div>
										<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'" />
										<div class="card-content">
											<div class="card-content-container">
												<div class="card-content-title">'.$curpost["post_title"].'</div>
												<div class="card-content-excerpt">
													'.$curpost["post_excerpt"].'
												</div>
											</div>
										</div>
									</a>
							</li>';
			}

			$catLink = ''.get_site_url().'/'.$curcat->slug.'';
			echo 		'</ul>';//category-content
				echo '<div class="cta" style="margin-top:20px;text-align:center;">
								<a href="'.$catLink.'" class="ghost-button-black category--'.$curcat->slug.'">
								  View more in '.$curcat->name.'
								</a>
							</div>';
			echo '</div>';//category-wrapper
		}//for each category

		wp_reset_query();
		?>

		<script>
		var slideIndex = 0;
		showSlides();

		// Next/previous controls
		function plusSlides(n) {
			showSlides(slideIndex += n);
		}


		function showSlides() {
				var i;
				var slides = document.getElementsByClassName("mySlides");
				for (i = 0; i < slides.length; i++) {
						slides[i].style.display = "none";
				}
				slideIndex++;
				if (slideIndex > slides.length) {slideIndex = 1}
				slides[slideIndex-1].style.display = "block";
				setTimeout(showSlides, 4000); // Change image every 4 seconds
		}


		</script>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
/*get_sidebar();*/
get_footer();
