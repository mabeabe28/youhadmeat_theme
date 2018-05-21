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
 * @package YouHadMeAtV1
 */

get_header('home');
?>

			<section>

				<div class="slideshow-container">

				<?php
					$args = array(
						'numberposts' => 5,
						'offset' => 0,
						'category' => 0,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'include' => '',
						'exclude' => '',
						'meta_key' => '',
						'meta_value' =>'',
						'post_type' => 'post',
						'post_status' => 'draft, publish, future, pending, private',
						'suppress_filters' => true
					);

					$recent_posts = wp_get_recent_posts( $args );
					//print_r($recent_posts);
					foreach( $recent_posts as $recent ){
							//echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> Excerpt:'.$recent["post_excerpt"] .'</li> ';
							//echo	$recent["ID"];
							//echo get_the_post_thumbnail_url($recent["ID"], 'thumbnail');
							//echo wp_get_post_categories($recent["ID"][0]);
							//echo '<div stlye="height:100;background-image:url('.get_the_post_thumbnail_url($recent["ID"], 'full').');background-position:cover;">
							//</div>';
							$category = get_the_category($recent["ID"]);
							$firstCategory = $category[0]->cat_name;
							//print_r($firstCategory);
							echo '<div class="mySlides fade">';

							if(has_post_thumbnail($recent["ID"])){
								// use one of these
								//echo get_the_post_thumbnail( $post_id, array(80, 80), array('class' => 'post_thumbnail') );
								echo '

								<div class="hero" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('.get_the_post_thumbnail_url($recent["ID"], 'full').');">
										<!--load image before hand,but hide display to prevent blank flashes when changing slide since background-image still be loading image-->
										<div style="display:none;">
											<img src="'.get_the_post_thumbnail_url($recent["ID"], 'full').'">
										</div>

										<div id="youhadmeatHeroText">
												<div id="leading">You Had Me At</div>
												<div id="trailing">'.$firstCategory.'</div>
												<!--<h2>'.$recent["post_excerpt"].'</h2>-->
										</div>
								</div>
								</div>

								';


							}
							/*echo '<img src="img1.jpg" style="width:100%">
								<div class="text">'.$recent["post_excerpt"].'</div>
							</div>';*/
						}
					wp_reset_query();
				?>

				<!-- Next and previous buttons -->
   <!--<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
   <a class="next" onclick="plusSlides(1)">&#10095;</a>-->
			</div>
			</section>


			<style>
			.hero {
			    /* Sizing */
		width: 100vw;
		height: 100vh;
					/* Flexbox stuff */
    display: flex;
    justify-content: center;
    align-items: center;
		/* Text styles */
    text-align: center;
		color: white;

		/* Background styles */
    /*background-image: url(http://localhost:8888/youhadmeat/wp-content/uploads/2018/05/DSCF6505.jpg);*/
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
		background-color: black;
			}

			.hero h1 {
    /* Text styles */
    font-size: 5em;
		/* Margins */
    margin-top: 0;
    margin-bottom: 0.5em;



}
			</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">


<style>

/* The hero image */
.hero-image {
    /* The image used */

    /* Set a specific height */
    /*height: 50%;*/

    /* Position and center the image to scale nicely on all screens */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}

/* Place text in the middle of the image */


#youhadmeatHeroText {
    position: absolute;
    top: 40%;
    color: white;
		font-size: 6vw;
		display: block;
		width: 100%;
}

#youhadmeatHeroText #leading{
	font-family: "Avenir";
	font-style: italic;
	font-weight: bold;
	word-spacing: 30px;
	display: inline-block;
}

#youhadmeatHeroText #trailing{
	font-family: "Jullian-Regular", Arial, sans-serif;
	display: inline-block;
	margin-left: 5%;
}


/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Fading animation */
/*.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 3s;
  animation-name: fade;
  animation-duration: 3s;
}*/
		/* Slideshow container */
		/*.slideshow-container {
		  max-width: 100%;
			height:50%;
		  position: relative;
		  margin: auto;
		}*/


		/* Hide the images by default */
		.mySlides {
		    display: none;
		}




@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

</style>
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

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?> </h1>
				</header>
				<?php
			endif;

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



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
