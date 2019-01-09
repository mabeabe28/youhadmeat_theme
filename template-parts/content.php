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
		font-family: "MontserratBlack";
		display: inline-block;
		padding: 8px;

	}


	.card-author-social{
		position: absolute;
		top: 90%;

		/*display: flex;
		align-items: center;*/
		/*justify-content: center;*/
		padding-top: 1.02880658436214vw;
		font-style: italic;
		width: 100%;
		z-index: 1;

	}
	.card-author-social-wrapper{
		width: 100%;
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		position: relative;
	}
	.card-social-item{
		position: relative;
		display: block;
		margin-left: 10px;
		margin-right: 10px;
	}

	.author-box a{text-decoration:none;color:white;}
	.author-box	a:visited { text-decoration: none; color:white; }
	.author-box	a:hover { text-decoration: none;color:pink; }
	.author-box	a:focus { text-decoration: none;  color:white;}
	.author-box a:hover,.author-box a:active { text-decoration: none; color:pink;}

	a{text-decoration:none;color:pink}
	a:visited { text-decoration: none; color:pink; }
	a:hover { text-decoration: none;color:pink; }
	a:focus { text-decoration: none;  color:pink;}
	a:hover, a:active { text-decoration: none; color:pink;}


	</style>


	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<ins class="adsbygoogle"
			 style="display:block; text-align:center;background: #ffffff00;"
			 data-ad-layout="in-article"
			 data-ad-format="fluid"
			 data-ad-client="ca-pub-5329286116812288"
			 data-ad-slot="7318134937"></ins>
	<script>
			 (adsbygoogle = window.adsbygoogle || []).push({});
	</script>

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





			echo '<div class="card">
								<a href="'.$authorUrl.'">
									<div class="card__header">
									</div>
									'.get_wp_user_avatar(get_the_author_id(),'large').'
									<div class="card__content">
											<div class="card__content-title" style="text-align:center;padding-left:0;padding-right:0;width:100%;">You had me at '.get_the_author_meta('user_firstname').'</div>
											<div class="card__content-excerpt" style="text-align:center;padding-left:0;padding-right:0;width:100%;">
												'.get_the_author_meta('description').'
											</div>';


											if (strlen(get_the_author_meta('social_instagram')) || strlen(get_the_author_meta('social_twitter')) || strlen(get_the_author_meta('social_facebook'))){

																	echo '<div class="card-author-social" style="color:white;">
																		<div class="card-author-social-wrapper">';

																	if (strlen(get_the_author_meta('social_instagram'))){
																		echo '<div class="card-social-item">
																			<a class="card-social-item--link" href="'.get_the_author_meta('social_instagram').'" target="_blank">
																				<i class="fab fa-instagram fa-lg"></i>
																			</a>
																		</div>';
																	}
																	if (strlen(get_the_author_meta('social_twitter'))){
																		echo '<div class="card-social-item">
																			<a class="card-social-item--link" href="'.get_the_author_meta('social_twitter').'" target="_blank">
																				<i class="fab fa-twitter fa-lg"></i>
																			</a>
																		</div>';
																	}
																	if (strlen(get_the_author_meta('social_facebook'))){
																		echo '<div class="card-social-item">
																			<a class="card-social-item--link" href="'.get_the_author_meta('social_facebook').'" target="_blank">
																				<i class="fab fa-facebook-square fa-lg"></i>
																			</a>
																		</div>';
																	}


																	echo '</div>
																	</div>';
											}

									echo'
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
					echo '<ul class="card-deck__container"  >';


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


					echo'	<li class="card category--'.$ParentCategory->slug.'">
						<a href="'.$postUrl.'">
									<div class="card__header"><div class="card__header-category category--'.$ParentCategory->slug.'">
										<div class="card__header-category__title">'.strtoupper($ParentCategory->name).'</div>
										<div class="card__header-category__icon"></div>
									</div></div>
									<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'medium').'" />
									<div class="card__content">
											<div class="card__content-title">'.$pageTitle.'</div>
											<div class="card__content-excerpt">
												'.$excerptStr.'
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
