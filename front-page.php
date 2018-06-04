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
					'parent' => 0,
					'orderby' => 'name',
					'order' => 'DESC',
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
							$excerptStr = (strlen($recent_post[0]["post_excerpt"]) > 140) ? substr($recent_post[0]["post_excerpt"],0,140).'...' :$recent_post[0]["post_excerpt"];
							$comingsoon = get_post_meta( $recent_post[0]["ID"],'comingsoon', true );
							$pageTitle = get_the_title($recent_post[0]["ID"]);
							$postUrl = get_permalink($recent_post[0]["ID"]);
							$ctaText = 'Read More';
							if($comingsoon){
								$pageTitle = '';
								$excerptStr = '';
								$postUrl = '##';
								$ctaText = 'Coming Soon';
							}
							$catLink = ''.get_site_url().'/'.$curcat->slug.'';


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
											<div id="trailing" class="category-link fade">
												<!--<a href="'.$catLink.'" class="category--'.$ParentCategory->slug.'">-->
													'.$ParentCategory->cat_name.'
												<!--</a>-->

												<div id="recentPost">
													<div style="font-size:12px;">Latest Post:</div>
													<div class="recentPost_detail">
														'.$pageTitle.'
													</div>
													<div class="recentPost_excerpt">
														'.$excerptStr.'
													</div>
													<div class="cta" style="font-size: 15px;"><a class="ghost-button category--'.$ParentCategory->slug.'" href="'.$postUrl.'">'.$ctaText.'</a></div>
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
   <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
   <a class="next" onclick="plusSlides(1)">&#10095;</a>
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
			echo '<div class="card-deck" cat-attr="'.$curcat->name.'" >';
		 	/*echo '<div class="card-deck-header">
							<div class="card-deck-header-title"><h1>'.$curcat->name.'</h1></div>
						</div>';*/
			echo '<div id="divider" class="category--'.$curcat->slug.'">
						  <div id="divider-content">
						    <div class="text">
						        '.$curcat->name.'
						    </div>
						  </div>
						</div>
						';
			echo '<ul class="card-container">';

			$args = array(
				'numberposts' => 4,
				'category' => $curcat->term_id,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'suppress_filters' => true
			);

			//get four recent post
			$recent_three = wp_get_recent_posts( $args );
			foreach($recent_three as $curpost){

				//print_r($curpost);
				$excerptStr = (strlen($curpost["post_excerpt"]) > 40) ? substr($curpost["post_excerpt"],0,40).'...' :$curpost["post_excerpt"];
				$pageTitle = $curpost["post_title"];
				$postUrl = get_permalink($curpost["ID"]);
				$comingsoon = get_post_meta( $curpost["ID"],'comingsoon', true );
				if($comingsoon){
					$pageTitle = 'Coming Soon';
					$excerptStr = '';
					$postUrl = '##';
				}

				echo '<li class="card-wrapper post--'.$curpost["ID"].' category--'.$curcat->slug.'">
									<a href="'.$postUrl.'">
										<div class="card-header"></div>
										<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'" />
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
		var slideIndex = 1;
		showSlides(slideIndex);

		// Next/previous controls
		function plusSlides(n) {
		  showSlides(slideIndex += n);
		}

		function showSlides(n) {
		  var i;
		  var slides = document.getElementsByClassName("mySlides");
		  if (n > slides.length) {slideIndex = 1}
		  if (n < 1) {slideIndex = slides.length}
		  for (i = 0; i < slides.length; i++) {
		      slides[i].style.display = "none";
		  }
 		  slides[slideIndex-1].style.display = "block";
		}

		autoSlide();
		function autoSlide(){
			var i;
		  var slides = document.getElementsByClassName("mySlides");

			for (i = 0; i < slides.length; i++) {
		      slides[i].style.display = "none";
		  }
			if(slideIndex > slides.length){
				slideIndex =  1;
			}
 		  slides[slideIndex-1].style.display = "block";
			slideIndex++;

			setTimeout(autoSlide,4000);

		}


		</script>
		</main><!-- #main -->
	</div><!-- #primary -->
	<style>

	#divider{
	height: 95px;
	}
#divider-content {
	border-bottom: 80px solid #2fc4c4;
	border-right: 80px solid transparent;
	height: 0;
	width: 390px;
  color:white;
  display:flex;
  justify-content:center;
}

#divider-content .text {
padding-top: 15px;
font-size: 40px;
font-family: "Gloss-and-Bloom";
display:block;
position:relative;
z-index: 1;
}

#divider:after {
    content:"";
    display:inline-block;
    position:relative;
    border-bottom: 15px solid #2fc4c4;
    width:100%;
    top: -15px;
}

@media screen and (max-width:800px){
	#divider-content{
		width: 100%;
		border: 0;
	}
}
	</style>
<?php
/*get_sidebar();*/
get_footer();
