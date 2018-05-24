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
	$pagetype = get_post_meta( get_the_id(),'page-type', true );


	global $post;
	$post_slug=$post->post_name;

	if($pagetype == "category"){


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
			echo '<div class="card-deck">';
			echo '<div class="card-deck-header"></div>';
			echo '<ul class="card-container">';
	    foreach($recent_posts as $curpost){
				//print_r($curpost);
				echo '<li class="card-wrapper">
									<a href="'.get_permalink($curpost["ID"]).'">
										<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'" />
										<div class="card-header"></div>
										<div class="card-content">
											<div class="card-content-title">'.$curpost["post_title"].'</div>
											<div class="card-content-excerpt">
												'.$curpost["post_excerpt"].'
											</div>
										</div>
									</a>
							</li>';
			}

			echo 		'</ul>';//card-container
			echo '</div>';//card-deck

	}elseif($pagetype == "author"){
		$user = get_user_by('slug',$post_slug);
		$args = array(
			'numberposts' => 12,
			'category' => $category->term_id,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'post',
			'author' => $user->ID,
			'post_status' => 'publish',
			'suppress_filters' => true
		);

		//get one recent post
		$recent_posts = wp_get_recent_posts( $args );

		echo '<div class="card-deck">';
		echo '<div class="card-deck-header"></div>';
		echo '<ul class="card-container">';
		foreach($recent_posts as $curpost){
			//print_r($curpost);
			echo '<li class="card-wrapper">
								<a href="'.get_permalink($curpost["ID"]).'">
									<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'" />
									<div class="card-header"></div>
									<div class="card-content">
										<div class="card-content-title">'.$curpost["post_title"].'</div>
										<div class="card-content-excerpt">
											'.$curpost["post_excerpt"].'
										</div>
									</div>
								</a>
						</li>';
		}

		echo 		'</ul>';//card-container
		echo '</div>';//card-deck
	}

	?>

	<style>





	</style>
</article><!-- #post-<?php the_ID(); ?> -->
