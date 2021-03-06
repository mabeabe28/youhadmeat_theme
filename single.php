<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package youhadmeat_theme
 */

get_header();
?>

	<style>

	#featured-image {
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
		/*background-attachment: fixed;*/
		background-color: black;
	}

	/*hero text wrapper stuff*/
	#featured-wrapper {
			/*position: absolute;*/
			top: 40%;
			color: white;
			width: 100%;
			display: flex;
			justify-content: center;
			flex-flow: row wrap;
	}

	/*hero text wrapper stuff*/
	#featured-text {
		padding-left: 10px;
		padding-right: 10px;
		margin-left: 20px;
		margin-right: 20px;
		text-align: center;
		display: inline-block;
		padding-bottom: 20px;
		font-size: 3.4722222222222223vw;
		width:80%;
		font-family:"Merriweather";
	}

	/*hero text wrapper stuff*/
	#featured-wrapper--bottom {
			/*position: absolute;*/
			margin-top: 40px;
			width: 100%;
			display: flex;
			justify-content: center;
			flex-flow: row wrap;
	}

	/*hero text wrapper stuff*/
	#featured-text--bottom {
		padding-top: 20px;
		margin-top: : 20px;
		margin-bottom: : 5px;

		text-align: center;
		display: inline-block;
		padding-bottom: 20px;
		font-size: 3.4722222222222223vw;
		width:80%;
		font-family:"Merriweather";

	}

	.entry-content{
		padding-top: 0px;
		margin-top: 0px;
	}

	.excerpt{
		font-size: 1.6666666666666665vw;
		font-weight: 300;
		font-family:"Montserrat";
	}

	.meta{
		font-size: 1.1111111111111112vw;
		font-style: italic;
		font-family:"Montserrat";

	}

	@media screen and (max-width:500px){
		#featured-text {
			font-size: 4.8vw;
		}
		#featured-text--bottom{
			font-size: 4.8vw;
		}
		.excerpt{
			font-size: 4vw;
		}
		.meta{
			font-size: 2.8vw;
		}
	}

	@media screen and (max-width:850px) and (min-width: 501px){
		#featured-text{
			font-size: 5.882352941176471vw;
		}
		#featured-text--bottom{
			font-size: 5.882352941176471vw;
		}
		.excerpt{
			font-size: 2.9411764705882355vw;
		}
		.meta{
			font-size: 1.8823529411764706vw;
		}
	}
	</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			$textOnImage = get_post_meta( get_the_id(),'text-on-image', true );
			$backgroundStyle = 'background-image:linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.4)), url('.get_the_post_thumbnail_url().');';
			if(!$textOnImage){
				$backgroundStyle = 'background-image: url('.get_the_post_thumbnail_url().');';
			}
			$hideTitle = get_post_meta( get_the_id(),'hideTitle', true );
			$hideExcerpt = get_post_meta( get_the_id(),'hideExcerpt', true );
			$hideMeta = get_post_meta( get_the_id(),'hideMeta', true );
			$nightMode = get_post_meta( get_the_id(),'nightMode', true );
			if($nightMode){
				echo '<style>
					body{
					  background-color: rgb(35,35,35);
					  color: white;
					}
				</style>';
			}
			echo '<div id="featured-image" class="featured-fade" style="'.$backgroundStyle.'">
				<div id="featured-wrapper">
					<div id="featured-text">';

					if($textOnImage){
						if(!$hideTitle){
							echo ''.get_the_title().'';
						}

						if(!$hideExcerpt){
							echo	'<div class="excerpt">
									'.get_the_excerpt().'
								</div>';
						}

						if(!$hideMeta){
							echo '<div class="meta">
									'.get_the_date().' |
									'.get_the_author_meta('nickname').'
								</div>';
						}
					}

			echo '</div>
				</div>
			</div>';

			if(!$textOnImage){
					echo '	<div id="featured-wrapper--bottom">
										<div id="featured-text--bottom">';

					if(!$hideTitle){
						echo ''.get_the_title().'';
					}

										if(!$hideExcerpt){
										echo '	<div class="excerpt">
												'.get_the_excerpt().'
											</div>';
										}

										if(!$hideMeta){
										echo '	<div class="meta">
												'.get_the_date().' |
												'.get_the_author_meta('nickname').'
											</div>';
										}

								echo'		</div>
									</div>';
			}

			get_template_part( 'template-parts/content', get_post_type() );

			/*the_post_navigation();*/

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
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
