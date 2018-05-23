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

get_header('home');
?>

			<section>

				<!-- get most recent post from each category -->
				<div class="slideshow-container">

				<?php
				//get all cats
				$categories=get_categories();
				//for each category
		  	foreach($categories as $category) {

					$args = array(
						'numberposts' => 1,
						'offset' => 0,
						'category' => $category->term_id,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'include' => '',
						'exclude' => '',
						'meta_key' => '',
						'meta_value' =>'',
						'post_type' => 'post',
						'post_status' => 'publish',
						'suppress_filters' => true
					);

					//get one recent post
					$recent_post = wp_get_recent_posts( $args );
					//get the categories for the post
					$category = get_the_category($recent_post[0]["ID"]);
					$firstCategory = $category[0]->cat_name;

					if($category[0]->count > 0){
						echo '<div class="mySlides">';

						if(has_post_thumbnail($recent_post[0]["ID"])){
							// use one of these
							//echo get_the_post_thumbnail( $post_id, array(80, 80), array('class' => 'post_thumbnail') );
							echo '
							<div class="hero" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('.get_the_post_thumbnail_url($recent_post[0]["ID"], 'full').');">
									<!--load image before hand,but hide display to prevent blank flashes when changing slide since background-image still be loading image-->
									<div style="display:none;">
										<img src="'.get_the_post_thumbnail_url($recent_post[0]["ID"], 'full').'">
									</div>

									<div id="youhadmeatHeroText">
											<div id="leading">You Had Me At</div>
											<div id="trailing" class="fade">'.$firstCategory.'
												<div id="recentPost">
													<div style="font-size:12px;">Latest Post:</div>
													<div class="recentPost_detail">
														<a href="'.get_permalink($recent_post[0]["ID"]).'">'.get_the_title($recent_post[0]["ID"]).'</a>
													</div>
													<div class="recentPost_excerpt">
														<a href="'.get_permalink($recent_post[0]["ID"]).'">'.$recent_post[0]["post_excerpt"].'</a>
													</div>
													<div class="cta" style="font-size: 15px;"><a href="'.get_permalink($recent_post[0]["ID"]).'">Read More</a></div>
												</div>
											</div>
									</div>

							</div>
							';
						}

						echo '</div>';
				 }
				} // foreach($categories

				?>

				<!-- Next and previous buttons -->
   <!--<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
   <a class="next" onclick="plusSlides(1)">&#10095;</a>-->
			</div>
			</section>


	<div id="primary" class="content-area">
		<main id="main" class="site-main">

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
		    setTimeout(showSlides, 6000); // Change image every 2 seconds
		}
		</script>
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
			echo '<div class="category-wrapper category--'.$curcat->slug.'">';
		 	echo '<div class="category-header">'.$curcat->name.'</div>';
			echo '<ul class="category-content">';

			echo '<li class="category-post-wrapper">
							<div class="category-post-header">Title 1</div>
							<div class="category-post-content">Description 1</div>
						</li>';

			echo '<li class="category-post-wrapper">
							<div class="category-post-header">Title 2</div>
							<div class="category-post-content">Description 2</div>
						</li>';

			echo '<li class="category-post-wrapper">
								<div class="category-post-header">Title 3</div>
								<div class="category-post-content">Description 3</div>
						</li>';



			echo 		'</ul>';//category-content
			echo '</div>';//category-wrapper
		}//for each category

		wp_reset_query();
		?>
		<style>
			.category-wrapper{
				width: 100%;
				margin-top:20px;
				margin-bottom:20px ;

			}

			.category-wrapper .category-header{
				font-family:Gloss-and-Bloom;
			}

			.category-wrapper .category-content{
				display:flex;
				flex-wrap:wrap;
				position: relative;
				justify-content: space-evenly;

			}

			.category-content .category-post-wrapper{
				position: absolute;
				width: 33%;
				background-color: red;
				height: 200px;
			}

			.category-content .category-post-wrapper .category-post-header{
				height: 60px;
				background-color: blue;
			}
		</style>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
/*get_sidebar();*/
get_footer();
