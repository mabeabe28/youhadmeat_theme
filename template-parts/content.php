<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package youhadmeat_theme
 */

?>

<article style="margin-bottom:0;" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'youhadmeat_theme' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		/*wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'youhadmeat_theme' ),
			'after'  => '</div>',
		) );*/
		?>
	</div><!-- .entry-content -->
	<style>
	.entry-footer{
		background-color: white;
		width: 100%;
		height: auto;
		margin-bottom: 0;
		position:relative;
		/*display: flex;*/
		/*justify-content: center;*/
	}

	.card-deck{
		margin-bottom:0px ;
	}

	.author-box{
		color:black;
		text-align: center;
	}



	.author-name .leading{
		font-style: italic;
		font-weight: bold;
		display: inline-block;
		padding: 8px;
	}

	.author-name .trailing{
		font-family: "Gloss-and-Bloom";
		display: inline-block;
		padding: 8px;

	}



	</style>


	<footer class="entry-footer">


			<?php
			echo '<div class="author-box" style="background-image:linear-gradient(rgba(0, 0, 0, 0.6),rgba(0, 0, 0, 0.6)), url('.get_the_post_thumbnail_url().');
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
			background-color: black;">';

			echo '<div class="card-deck" >';
		 	echo '<div class="card-deck-header">
							<div class="card-deck-header-title"></div>
						</div>';
			echo '<div class="card-container" >';

			$authorUrl = ''.get_site_url().'/'.get_the_author_meta('user_nicename').'';

			echo '<div class="card-wrapper">
								<a href="'.$authorUrl.'">
									<div class="card-header">
									</div>
									'.get_wp_user_avatar(get_the_author_id(),'large').'
									<div class="card-content">
										<div class="card-content-container">
											<div class="card-content-pre" style="text-align:center;padding-left:0;padding-right:0;width:100%;font-size:0.8vw;">Written by:</div>
											<div class="card-content-title" style="text-align:center;padding-left:0;padding-right:0;width:100%;">You had me at '.get_the_author_meta('user_firstname').'</div>
											<div class="card-content-excerpt" style="text-align:center;padding-left:0;padding-right:0;width:100%;">
												'.get_the_author_meta('description').'
											</div>
										</div>
									</div>
								</a>
						</div>';

						echo 		'</div>';//card-container
						echo '</div>';//card-deck

			?>
		</div><!-- Author box -->

		<div class="related-box" style:"background-color:white;">
			<?php

			/*Related*/
			$orig_post = $post;
			global $post;

			$tags = wp_get_post_tags($post->ID);
			if ($tags) {
				$tag_ids = array();

				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

				$args=array(
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=>3, // Number of related posts that will be shown.
				'caller_get_posts'=>1
				);

				$my_query = new wp_query( $args );
				if( $my_query->have_posts() ) {

					echo '<div class="card-deck" >';
					echo '<div class="card-deck-header">
									<div class="card-deck-header-title"><h3>Related Posts:</h3></div>
								</div>';
					echo '<ul class="card-container"  >';


					while( $my_query->have_posts() ) {
					$my_query->the_post();



					$ParentCategory = "";
					$category = get_the_category();
					foreach($category as $curcat){
						if($curcat->parent == 0){
							$ParentCategory = $curcat;
						}
					}
					$excerptStr = (strlen(get_the_excerpt()) > 40) ? substr(get_the_excerpt(),0,40).'...' :get_the_excerpt();

					$comingsoon = get_post_meta( get_the_id(),'comingsoon', true );
					$pageTitle = get_the_title();
					$postUrl = get_permalink(get_the_id());
					if($comingsoon){
						$pageTitle = 'Coming Soon';
						$excerptStr = 'Content Coming Soon';
						$postUrl = '##';
					}

					echo '<li class="card-wrapper category--'.$ParentCategory->slug.'">
										<a href="'.$postUrl.'">
											<div class="card-header"><div class="card-header-category category--'.$ParentCategory->slug.'">
												<div class="category-title">'.$ParentCategory->name.'</div>
												<div class="category-icon"></div>
											</div></div>
											<img src="'.get_the_post_thumbnail_url(get_the_id(), 'medium').'" />
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

					echo 		'</ul>';//category-content
					echo '</div>';//category-wrapper
				}
			}

			$post = $orig_post;
			wp_reset_query();
			?>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
