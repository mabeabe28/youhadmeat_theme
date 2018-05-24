<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package youhadmeat_theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		the_content();

		?>
	</div><!-- .entry-content -->
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<!--<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'youhadmeat_theme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>-->
		</footer><!-- .entry-footer -->
	<?php endif; ?>

	<?php
	$pagetype = get_post_meta( the_ID(),'page-type', true );
	if($pagetype == "category"){


		global $post;
	  $post_slug=$post->post_name;

	  $category=get_category_by_slug($post_slug);

	    $args = array(
	      'numberposts' => 12,
	      'category' => $category->term_id,
	      'orderby' => 'post_date',
	      'order' => 'DESC',
	      'post_type' => 'post',
	      'post_status' => 'publish',
	      'suppress_filters' => true
	    );

	    //get one recent post
	    $recent_posts = wp_get_recent_posts( $args );
	    //get the categories for the post
	    //$category = get_the_category($recent_post[0]["ID"]);
	    //$firstCategory = $category[0]->cat_name;

	    //if($category[0]->count > 0){
		/*	echo '<div class="category-wrapper">';
			echo '<div class="category-header">
							Recent Posts:
						</div>';
			echo '<ul class="category-content">';
	    foreach($recent_posts as $curpost){
				//print_r($curpost);
				echo '<li class="category-post-wrapper">
									<a href="'.get_permalink($curpost["ID"]).'">
										<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'" />
										<div class="category-post-header"></div>
										<div class="category-post-content">
											<div class="category-post-content-title">'.$curpost["post_title"].'</div>
											<div class="category-post-content-excerpt">
												'.$curpost["post_excerpt"].'
											</div>
										</div>
									</a>
							</li>';
			}

			echo 		'</ul>';//category-content
			echo '</div>';//category-wrapper
*/
			echo "This is a category page";
	}else if($pagetype == "author"){
		echo "This is a author page";
	}

	?>

	<style>
		.category-wrapper{
			width: 100%;
			margin-top:20px;
			margin-bottom:20px ;

		}

		.category-wrapper .category-header{
			text-align: center;
		}

		.category-wrapper .category-header .category-header-title{
			font-family:Gloss-and-Bloom;
			font-size: 28px;
			text-align: center;
			padding-top: 20px;
		}

		.category-wrapper .category-content{
			display:flex;
			flex-wrap:wrap;
			position: relative;
			justify-content: space-evenly;
			margin-left: 0;
			margin-right: 0;
			padding-left: 0;
			padding-right: 0;
			list-style: none;
		}

		.category-content .category-post-wrapper{
			position: relative;
			width: 300px;
			height: 520px;
			background-color: black;
			margin-bottom: 20px;

			-webkit-box-shadow: 3px 10px 69px -24px rgba(36,32,36,1);
			-moz-box-shadow: 3px 10px 69px -24px rgba(36,32,36,1);
			box-shadow: 3px 10px 69px -24px rgba(36,32,36,1);

			display: block;
			overflow: hidden;



		}


			.category-content .category-post-wrapper img {
			object-fit: cover;
			height: 100%;
			width: 100%;
			}



		.category-content .category-post-wrapper .category-post-header{
			position: relative;
			color:white;
		}

		.category-content .category-post-wrapper .category-post-content{
			bottom:0;
			position: absolute;
			color:black;
			background-color:white;
			width: 100%;
			text-align: center;
			height: 20%;
			padding: 5px;

		}

		.category-post-content .category-post-content-title{
			font-size: 18px;
			font-weight:300;
		}

		.category-post-content .category-post-content-excerpt{
			font-size: 14px;
			font-weight: lighter;
			text-overflow: ellipsis;
			display: flex;
			align-items: center;
			justify-content: center;
			padding-top: 5px;
			font-style: italic;
		}

		/*small screens*/
		@media screen and (max-width: 450px) {

			.category-content .category-post-wrapper{
				width: 100vw;
				height: 100vh;
			}

			.category-post-content .category-post-content-title{
				font-size: 2em;
			}

			.category-post-content .category-post-content-excerpt{
				font-size: 1em;
			}

		}


	</style>
</article><!-- #post-<?php the_ID(); ?> -->
