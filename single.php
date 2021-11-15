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


	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		
		<?php
		while ( have_posts() ) :
			the_post();
	
			echo '
			<div class="page-title"><h1>'.get_the_title().'</h1></div>
			';
			// echo '<div id="featured-image" class="featured-fade" style="'.$backgroundStyle.'">
			// 	<div id="featured-wrapper">
			// 		<div id="featured-text">';

			// 		if($textOnImage){
			// 			if(!$hideTitle){
			// 				echo ''.get_the_title().'';
			// 			}

			// 			if(!$hideExcerpt){
			// 				echo	'<div class="excerpt">
			// 						'.get_the_excerpt().'
			// 					</div>';
			// 			}

			// 			if(!$hideMeta){
			// 				echo '<div class="meta">
			// 						'.get_the_date().' |
			// 						'.get_the_author_meta('nickname').'
			// 					</div>';
			// 			}
			// 		}

			// echo '</div>
			// 	</div>
			// </div>';

			// if(!$textOnImage){
			// 		echo '	<div id="featured-wrapper--bottom">
			// 							<div id="featured-text--bottom">';

			// 		if(!$hideTitle){
			// 			echo ''.get_the_title().'';
			// 		}

			// 							if(!$hideExcerpt){
			// 							echo '	<div class="excerpt">
			// 									'.get_the_excerpt().'
			// 								</div>';
			// 							}

			// 							if(!$hideMeta){
			// 							echo '	<div class="meta">
			// 									'.get_the_date().' |
			// 									'.get_the_author_meta('nickname').'
			// 								</div>';
			// 							}

			// 					echo'		</div>
			// 						</div>';
			// }

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
