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
				<div class="wrapper">

				<?php
				//get all cats
				$catargs = array(
					'parent' => 0
				);
				$categories=get_categories($catargs);

		    $recent_posts = array();
		    foreach ($categories as $key=>$category) {
		        // get latest post from $category
		        $args = array(
		            'numberposts' => 1,
		            'category' => $category->term_id,
		        );
		        $post = get_posts($args)[0];
		        // save category id & post date in an array
		        $recent_posts[ $category->term_id ] = strtotime($post->post_date);
		    }

		    // order by post date, preserve category_id
		    arsort($recent_posts);

		    // get $limit most recent category ids
		    $recent_categories = array_slice(array_keys($recent_posts), 0, $limit);



				//for each category
		  	foreach($recent_categories as $category) {

					$args = array(
						'numberposts' => 1,
						'category' => $category,
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
						/*echo '<div class="mySlides">';*/

						if(has_post_thumbnail($recent_post[0]["ID"])){
							$excerptStr = (strlen($recent_post[0]["post_excerpt"]) > 70) ? substr($recent_post[0]["post_excerpt"],0,70).'...' :$recent_post[0]["post_excerpt"];
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

							echo '  <div class="slide" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('.get_the_post_thumbnail_url($recent_post[0]["ID"], 'large').');"">
							<div style="display:none;">
								<!--load image before hand,but hide display to prevent blank flashes when changing slide since background-image still be loading image-->
								<img src="'.get_the_post_thumbnail_url($recent_post[0]["ID"], 'large').'">
							</div>
							</div>

						';


							echo '<div class="slideTitleWrapper category--'.$ParentCategory->slug.'">
								<div class="slideTitleLeading">
									<h1>You Had Me At</h1>
								</div>
								<div class="slideTitle">
									<h1>'.$ParentCategory->cat_name.'</h1>
								</div>
							</div>';


							echo '<div class="slideExcerptWrapper">
								<div class="slideExcerpt" >
									<div class="latestText">
										Latest '.$ParentCategory->cat_name.' Post
									</div>
									<div class="latestExcerpt">
										'.$excerptStr.'
									</div>

									<div class="latestCtaWrapper">
										<div class="latestCta" >
											<a class="ghost-button category--'.$ParentCategory->slug.'" href="'.$postUrl.'">'.$ctaText.'</a>
										</div>
									</div>

								</div>';

								echo '<div class="scroll-down"></div>';

							echo '</div>';
							// use one of these
							//echo get_the_post_thumbnail( $post_id, array(80, 80), array('class' => 'post_thumbnail') );
							/*echo '
							<div class="hero featured-fade" style="background-image:linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.4)), url('.get_the_post_thumbnail_url($recent_post[0]["ID"], 'full').');">
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
													<div class="latestCta" style="font-size: 15px;"><a class="ghost-button category--'.$ParentCategory->slug.'" href="'.$postUrl.'">'.$ctaText.'</a></div>
												</div>
											</div>
									</div>

							</div>
							';*/
						}
						/*echo '<div class="scroll-down"></div>';
						echo '</div>';*/
				 }
				} // foreach($categories
				?>

				<!-- Next and previous buttons
				<div id="youhadmeat">
					<h1>You Had Me At</h1>
				</div> -->
   <a class="prev" onclick="minusSlides(-1)">&#10094;</a>
   <a class="next" onclick="plusSlides(1)">&#10095;</a>
			</div>
			</section>
			<style>
			/*hero text wrapper stuff*/
			.slideExcerptWrapper {
					/*position: absolute;*/
					color: white;
					width: 100%;
					display: flex;
					justify-content: center;
					flex-flow: row wrap;

			}

			.slideExcerpt{
				top: 60%;
				z-index: 100;
				position: absolute;
				color: white;
				width: 300px;
				text-align: center;
				display: none;

			}
			.latestText{
				/*display: none;*/
				font-weight: 300;
				text-decoration: underline;
			}

			.latestExcerpt{
				/*display: none;*/
				font-style: italic;
			}

			.latestCtaWrapper{
				width:100%;
				display:flex;
				flex-wrap:wrap;
				position: relative;
				justify-content: center;
			}
			.latestCta{
				z-index: 100;
				/*display: none;*/
				position: absolute;
				font-size:15px;
				margin-top:20px;
			}



			.slideTitleWrapper{
				z-index: 100;
				top: 28%;
				color: white;

				width:100%;
				display:flex;
				flex-wrap:wrap;
				position: absolute;
				justify-content: center;

			}





			.slideTitleLeading{
				z-index: 100;
				color: white;
				font-weight: bold;
				font-style: italic;
				position:absolute;
				left:11%;

				font-size: 3vw;
				padding: 1px 20px 1px 20px;
				-webkit-font-smoothing: antialiased;

			}
			.slideTitle{
				font-family: "Gloss-and-Bloom";
				position: absolute;
				font-size: 3.2vw;
				margin-left: 22vw;
				padding: 1px 20px 1px 20px;
				left: 40%;
			}


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
  z-index: 100;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.prev {
  left: 0;
  border-radius: 3px 0 0 3px;
}

			.slide{
			  height:100vh;
			  width:100%;
			  position:absolute;
			  top:0;
			  left:0;
			  background-size:cover;
				background-position: center center;
				background-repeat: no-repeat;
			  overflow: hidden;
				background-color: black;
			}

			.slideTitle{
				display: none;
			}

			.wrapper{
			  height:100vh;
			  width:100%;
			  display:block;
				position: relative;
				overflow: hidden;
				margin-bottom: 100px;

			}

			/* LATEST EXCERPTtext slide  in*/
			.textslide-side-opposite {
				animation:  textslide-side-opposite  1.2s ease-in-out forwards;
				-webkit-animation: textslide-side-opposite  1.2s ease-in-out forwards;
				-moz-animation: textslide-side-opposite  1.2s ease-in-out forwards;
			}

			@keyframes textslide-side-opposite  {
				0% { opacity: 0; transform: translateX(-100%);}
				100% {opacity: 1;transform: translateX(0);}
			}

			@-webkit-keyframes textslide-side-opposite  {
				0%   { -webkit-transform:translateX(-100%); opacity: 0; }
				100% { -webkit-transform:translateX(0); opacity: 1;}
			}

			@-moz-keyframes textslide-side-opposite  {
				0%   { -moz-transform:translateX(-100%); opacity: 0;}
				100% { -moz-transform:translateX(0); opacity: 1;}
			}

			/*LATEST EXCERPTtext slide previous out*/

			.textslide-side-out-opposite {
				animation:  textslide-side-out-opposite 1.2s ease-in-out forwards;
				-webkit-animation: textslide-side-out-opposite 1.2s ease-in-out forwards;
				-moz-animation: textslide-side-out-opposite 1.2s ease-in-out forwards;

			}

			@keyframes textslide-side-out-opposite {
				0% {opacity: 1;transform: translateX(0);}
				100% {opacity: 0;transform: translateX(100%);}
			}

			@-webkit-keyframes textslide-side-out-opposite {
				0%   { -webkit-transform:translateX(0); opacity: 1; }
				100% { -webkit-transform:translateX(100%); opacity: 0;}
			}

			@-moz-keyframes textslide-side-out-opposite {
				0%   { -moz-transform:translateX(0); opacity: 1;   }
				100% { -moz-transform:translateX(100%); opacity: 0; }
			}


			/* LATEST TEXTtext slide  in*/
			.textslide-side {
				animation:  textslide-side 1.2s ease-in-out forwards;
				-webkit-animation: textslide-side 1.2s ease-in-out forwards;
				-moz-animation: textslide-side 1.2s ease-in-out forwards;
			}

			@keyframes textslide-side {
				0% { opacity: 0; transform: translateX(100%);}
				100% {opacity: 1;transform: translateX(0);}
			}

			@-webkit-keyframes textslide-side {
				0%   { -webkit-transform:translateX(100%); opacity: 0; }
				100% { -webkit-transform:translateX(0); opacity: 1;}
			}

			@-moz-keyframes textslide-side {
			  0%   { -moz-transform:translateX(100%); opacity: 0;}
			  100% { -moz-transform:translateX(0); opacity: 1;}
			}

			/*LATEST TEXTtext slide previous out*/

			.textslide-side-out {
				animation:  textslide-side-out 1.2s ease-in-out forwards;
				-webkit-animation: textslide-side-out 1.2s ease-in-out forwards;
				-moz-animation: textslide-side-out 1.2s ease-in-out forwards;

			}

			@keyframes textslide-side-out {
				0% {opacity: 1;transform: translateX(0);}
				100% {opacity: 0;transform: translateX(-100%);}
			}

			@-webkit-keyframes textslide-side-out {
				0%   { -webkit-transform:translateX(0); opacity: 1; }
				100% { -webkit-transform:translateX(-100%); opacity: 0;}
			}

			@-moz-keyframes textslide-side-out {
			  0%   { -moz-transform:translateX(0); opacity: 1;   }
			  100% { -moz-transform:translateX(-100%); opacity: 2; }
			}




			/*text slide  in*/
			.textslide {
				animation:  textslide 1.2s ease-in-out forwards;
				-webkit-animation: textslide 1.2s ease-in-out forwards;
				-moz-animation: textslide 1.2s ease-in-out forwards ;
			}

			@keyframes textslide {
				0% { opacity: 0; transform: translateY(50%);}
				100% {opacity: 1;transform: translateY(0);}
			}

			@-webkit-keyframes textslide {
				0%   { -webkit-transform:translateY(50%); opacity: 0; }
				100% { -webkit-transform:translateY(0); opacity: 1;}
			}

			@-moz-keyframes textslide {
			  0%   { -moz-transform:translateY(50%); opacity: 0;}
			  100% { -moz-transform:translateY(0); opacity: 1;}
			}

			/*text slide previous out*/

			.textslide-out {
				animation:  textslide-out 1.2s ease-in-out forwards;
				-webkit-animation: textslide-out 1.2s ease-in-out forwards;
				-moz-animation: textslide-out 1.2s ease-in-out forwards;

			}

			@keyframes textslide-out {
				0% {opacity: 1;transform: translateY(0);}
				100% {opacity: 0;transform: translateY(-50%);}
			}

			@-webkit-keyframes textslide-out {
				0%   { -webkit-transform:translateY(0); opacity: 1; }
				100% { -webkit-transform:translateY(-50%); opacity: 0;}
			}

			@-moz-keyframes textslide-out {
			  0%   { -moz-transform:translateY(0); opacity: 1;   }
			  100% { -moz-transform:translateY(-50%); opacity: 0; }
			}

			/*next button- slide in from right*/

			.slide-in {
			  animation-name: slide-in;
			  animation-duration: 1.2s;
				-webkit-animation: slide-in 1.2s ;
				-moz-animation:    slide-in 1.2s ;
			}

			@keyframes slide-in {
				0% {
					transform: translateX(100%);
				}
				100% {
					transform: translateX(0);
				}
			}


		@-webkit-keyframes slide-in {
			0%   { -webkit-transform:translateX(100%); }
			100% { -webkit-transform:translateX(0); }
		}

		@-moz-keyframes slide-in {
		  0%   { -moz-transform:translateX(100%);  }
		  100% { -moz-transform:translateX(0); }
		}


		/*next button. previous item scale left*/

		.scale {
			animation: scale 1.2s;
			-webkit-animation: scale 1.2s ;
			-moz-animation:    scale 1.2s ;

		}

		@keyframes scale {
			0% {transform: scale(1);}
			100% {transform: scale(1.2); }
		}

		@-webkit-keyframes scale {
			0%   { -webkit-transform:scale(1); }
			100% { -webkit-transform:scale(1.2); }
		}

		@-moz-keyframes scale {
		  0%   { -moz-transform:scale(1);  }
		  100% { -moz-transform:scale(1.2); }
		}




		/*previous button- slide back in from left*/
			.slide-back {
			  animation-name: slide-back;
			  animation-duration: 1.2s;
				-webkit-animation: slide-back 1.2s ;
				-moz-animation:    slide-back 1.2s ;
			}

			@keyframes slide-back {
			  from {left: -100%;transform: scale(1.2);}
				to { transform: scale(1);}

			}

			@-webkit-keyframes slide-back {
				0%   { -webkit-transform:translateX(-100%); }
				100% { -webkit-transform:translateX(0); }
			}

			@-moz-keyframes slide-back  {
				0%   { -moz-transform:translateX(-100%);  }
				100% { -moz-transform:translateX(0); }
			}



			/*previous button. previous item go back to left*/
			.scale-back {
			  animation: scale-back 1.2s;
				-webkit-animation: scale-back 1.2s ;
				-moz-animation:    scale-back 2.2s ;
			}

			@keyframes scale-back {
				0% {transform: translateX(0);}
				100% {transform: translateX(100%);}
			}

			@-webkit-keyframes scale-back {
				0%   { -webkit-transform:translateX(0); }
				100% { -webkit-transform:translateX(100%); }
			}

			@-moz-keyframes scale-back {
				0%   { -moz-transform:translateX(0);  }
				100% { -moz-transform:translateX(100%); }
			}




			</style>
			<script>
			var slideIndex = 0;
			var slides = $(".slide");
			var slideTitles = $(".slideTitle");
			var slideExcerptDiv = $('.slideExcerpt');


			showSlides(slideIndex)

			function plusSlides(n) {
			  slideIndex += n;
			  showSlides(slideIndex,'forward');
			}
			function minusSlides(n) {
			  slideIndex += n;
			  showSlides(slideIndex,'backward');
			}

			function showSlides(n,direction) {
			  	if (typeof direction === 'undefined') direction = 'forward';
					//console.log(direction);

					  var i;
					  if (n >= slides.length){
			        slideIndex = 0;
			      }

					  if (n < 0){
			        slideIndex = slides.length-1;
			      }

			  if(direction == 'backward'){
			    var previous = slideIndex+1;

			     if (previous > slides.length-1){
			        previous = 0;
			      }

					  if (previous < 0){
			        previous = slides.length-1;
			      }
			    //console.log('current',slideIndex);
			    //console.log('previous',previous);

			  }else{
			   var previous = slideIndex-1;

			    if (previous > slides.length){
			        previous = 0;
			      }

					  if (previous < 0){
			        previous = slides.length-1;
			      }

			  }


			      //console.log('current',slideIndex);
			      //console.log('previous',previous);
			      for (i = 0; i < slides.length; i++) {
					    slides[i].style.display = "none";
							slideTitles[i].style.display = "none";
							slideExcerptDiv[i].style.display = "none";


			        $(slides[i]).removeClass('slide-in');
			        $(slides[i]).removeClass('slide-back');
							$(slides[i]).removeClass('scale');
						 	$(slides[i]).removeClass('scale-back');


							$(slideTitles[slideIndex]).removeClass('textslide');
							$(slideTitles[slideIndex]).removeClass('textslide-out');
							$(slideTitles[slideIndex]).removeClass('textslide-side');
							$(slideTitles[slideIndex]).removeClass('textslide-side-out');

							$(slideExcerptDiv[slideIndex]).removeClass('textslide-side-opposite');
							$(slideExcerptDiv[slideIndex]).removeClass('textslide-side-out-opposite');


					  }

				/*bring previous post behind*/
			  slides[previous].style["z-index"] = "-1";
				slideExcerptDiv[previous].style["z-index"] = "-1";

				if(direction == 'backward'){
			   $(slides[previous]).addClass('scale-back');
			  }else{
			    $(slides[previous]).addClass('scale');
			  }
				$(slideTitles[previous]).addClass('textslide-side-out');
				$(slideExcerptDiv[previous]).addClass('textslide-side-out-opposite');


			  slides[previous].style.display = "block";
				slideTitles[previous].style.display = "block";
				slideExcerptDiv[previous].style.display = "block";


				/*bring current post forward*/
			  slides[slideIndex].style["z-index"] = "1";
				slideExcerptDiv[slideIndex].style["z-index"] = "100";

			  if(direction == 'backward'){
			   $(slides[slideIndex]).addClass('slide-back');
			  }else{
			   $(slides[slideIndex]).addClass('slide-in');
			  }
				$(slideTitles[slideIndex]).addClass('textslide-side');
				$(slideExcerptDiv[slideIndex]).addClass('textslide-side-opposite');


				slides[slideIndex].style.display = "block";
				slideTitles[slideIndex].style.display = "block";
				slideExcerptDiv[slideIndex].style.display = "block";


			}

			autoSlide();
			function autoSlide() {
				//console.log(direction);

					var i;
					if (slideIndex >= slides.length){
						slideIndex = 0;
					}

					if (slideIndex < 0){
						slideIndex = slides.length-1;
					}


			 var previous = slideIndex-1;

				if (previous > slides.length){
						previous = 0;
					}

					if (previous < 0){
						previous = slides.length-1;
					}




					//console.log('current',slideIndex);
					//console.log('previous',previous);
					for (i = 0; i < slides.length; i++) {
						slides[i].style.display = "none";
						slideTitles[i].style.display = "none";
						slideExcerptDiv[i].style.display = "none";

						$(slides[i]).removeClass('slide-in');
						$(slides[i]).removeClass('slide-back');
						$(slides[i]).removeClass('scale');
						$(slides[i]).removeClass('scale-back');

						$(slideTitles[slideIndex]).removeClass('textslide-side');
						$(slideTitles[slideIndex]).removeClass('textslide-side-out');

						$(slideExcerptDiv[slideIndex]).removeClass('textslide-side-opposite');
						$(slideExcerptDiv[slideIndex]).removeClass('textslide-side-out-opposite');

					}

			/*bring previous post behind*/
			slides[previous].style["z-index"] = "-1";
			slideExcerptDiv[previous].style["z-index"] = "-1";


			$(slides[previous]).addClass('scale');
			$(slideTitles[previous]).addClass('textslide-side-out');
			$(slideExcerptDiv[previous]).addClass('textslide-side-out-opposite');


			slides[previous].style.display = "block";
			slideTitles[previous].style.display = "block";
			slideExcerptDiv[previous].style.display = "block";






			/*bring current post forward*/
			 slides[slideIndex].style["z-index"] = "1";
			 slideExcerptDiv[slideIndex].style["z-index"] = "1";

			 $(slides[slideIndex]).addClass('slide-in');
			 $(slideTitles[slideIndex]).addClass('textslide-side');
			 $(slideExcerptDiv[slideIndex]).addClass('textslide-side-opposite');

			slides[slideIndex].style.display = "block";
			slideTitles[slideIndex].style.display = "block";
			slideExcerptDiv[slideIndex].style.display = "block";


			      console.log('current',slideIndex);
			      console.log('previous',previous);
			      slideIndex++;
						setTimeout(autoSlide,7000);
			}
			</script>

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
  z-index: 100;
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
		foreach($recent_categories as $catID) {
			$curcat = get_category($catID);
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

				//print_r($curpost);
				$excerptStr = (strlen($curpost["post_excerpt"]) > 40) ? substr($curpost["post_excerpt"],0,40).'...' :$curpost["post_excerpt"];
				$pageTitle = $curpost["post_title"];
				$postUrl = get_permalink($curpost["ID"]);
				$comingsoon = get_post_meta( $curpost["ID"],'comingsoon', true );
				if($comingsoon){
					$pageTitle = 'Coming Soon';
					$excerptStr = 'Content Coming Soon';
					$postUrl = '##';
				}

				echo '<li class="card-wrapper post--'.$curpost["ID"].' category--'.$curcat->slug.'">
				<a href="'.$postUrl.'">

										<div class="card-header"><div class="card-header-category category--'.$curcat->slug.'">
											<div class="category-title">'.$curcat->name.'</div>
											<div class="category-icon"></div>

										</div></div>
										<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'medium').'" />
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
		/*var slideIndex = 1;
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

*/
		</script>
		</main><!-- #main -->
	</div><!-- #primary -->
	<style>

	#divider{
	height: 6.444444444444445vw;
	margin-left: 5.829903978052126vw;
	margin-right: 5.829903978052126vw;
	}
#divider-content {
	border-bottom: 4.861111111111111vw solid #2fc4c4;
	border-right: 5.555555555555555vw solid transparent;
	height: 0;
	width: 20.5761316872428vw;
  color:white;
  display:flex;
  justify-content:center;
}
#divider-content .text {

width: 100%;
padding: 0.8vw 1.22880658436214vw 1.42880658436214vw 1.22880658436214vw;
font-size: 2.2434842249657065vw;
font-family: "Gloss-and-Bloom";
display:block;
position:relative;
z-index: 1;
}




#divider:after {
    content:"";
    display:inline-block;
    position:relative;
    border-bottom: 1.0416666666666667vw solid #2fc4c4;
    width:100%;
    top: -15px;
}

@media screen and (max-width:500px){

#divider-content{
		border-bottom: 80px solid #2fc4c4;
		width: 100%;
		border-right:0;
	}

	#divider{
		height: 100px;
		margin-left: 0;
		margin-right: 0;
	}

	#divider-content .text {
		text-align: center;
		padding: 14px 18px 18px 18px;
		font-size: 40px;
	}
}




	</style>

<?php
/*get_sidebar();*/
get_footer();
