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
	$postdisplay = get_post_meta( get_the_id(),'post-display', true );


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
			//echo '<div class="card-deck-header"></div>';
			echo '<ul class="card-deck__container">';
	    foreach($recent_posts as $curpost){
				$ParentCategory = "";
				$ChildCategory = "";

				$cat = get_the_category($curpost["ID"]);
				foreach($cat as $curcat){
					if($curcat->parent == 0){
						$ParentCategory = $curcat;
					}else{
						$ChildCategory = $curcat;
					}
				}

				if($ChildCategory == ""){
					$ChildCategory = $ParentCategory;
				}
				$excerptStr = (strlen($curpost["post_excerpt"]) > 40) ? substr($curpost["post_excerpt"],0,40).'...' :$curpost["post_excerpt"];
				$pageTitle = $curpost["post_title"];
				$comingsoon = get_post_meta( $curpost["ID"],'comingsoon', true );
				$postUrl = get_permalink($curpost["ID"]);

				if($comingsoon){
					$pageTitle = 'Coming Soon';
					$excerptStr = '';
					$postUrl = '##';
				}
				$authorUrl = ''.get_site_url().'/'.get_the_author_meta('user_nicename',$curpost["post_author"]).'';



				echo'	<li class="card category--'.$ParentCategory->slug.'">
					<a href="'.$postUrl.'">
								<div class="card__header"><div class="card__header-category category--'.$ParentCategory->slug.'">
									<div class="card__header-category__title">'.strtoupper($ChildCategory->name).'</div>
									<div class="card__header-category__icon"></div>
								</div></div>
								<img class="a-card-image-zoom" src="'.get_the_post_thumbnail_url($curpost["ID"], 'medium').'" />
								<div class="card__content">
										<div class="card__content-title category--'.$ParentCategory->slug.'">'.$pageTitle.'</div>
										<div class="card__content-excerpt">
											'.$excerptStr.'
										</div>
										<div class="card__author">
											<a href="'.$authorUrl.'">
												'.get_wp_user_avatar($curpost["post_author"],'small').'
											</a>
										</div>
								</div>
							</a>
					</li>';

			}

			echo 		'</ul>';//card-container
			$archivelink = ''.get_site_url().'/category/'.$category->slug.'';

			echo '<div class="archive-cta" style="display:block;margin: 0 auto;text-align:center;">
				<a href="'.$archivelink.'" class="ghost-button-black category--'.$category->slug.'">
					View '.$category->name.' Archive
				</a>
			</div>';
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


		if($postdisplay == 'cards'){
			echo '<div class="card-deck">';
			echo '<ul class="card-deck__container">';
			foreach($recent_posts as $curpost){
				$ParentCategory = "";

				$cat = get_the_category($curpost["ID"]);
				foreach($cat as $curcat){
					if($curcat->parent == 0){
						$ParentCategory = $curcat;
					}
				}

				$excerptStr = (strlen($curpost["post_excerpt"]) > 40) ? substr($curpost["post_excerpt"],0,40).'...' :$curpost["post_excerpt"];
				$pageTitle = $curpost["post_title"];
				$postUrl = get_permalink($curpost["ID"]);
				$comingsoon = get_post_meta( $curpost["ID"],'comingsoon', true );
				if($comingsoon){
					$pageTitle = 'Coming Soon';
					$excerptStr = '';
					$postUrl = '##';
				}

				echo'	<li class="card category--'.$curcat->slug.'">
					<a href="'.$postUrl.'">
								<div class="card__header"><div class="card__header-category category--'.$ParentCategory->slug.'">
									<div class="card__header-category__title">'.strtoupper($ParentCategory->name).'</div>
									<div class="card__header-category__icon"></div>
								</div></div>
								<img class="a-card-image-zoom" src="'.get_the_post_thumbnail_url($curpost["ID"], 'medium').'" />
								<div class="card__content">
										<div class="card__content-title category--'.$ParentCategory->slug.'">'.$pageTitle.'</div>
										<div class="card__content-excerpt">
											'.$excerptStr.'
										</div>
								</div>
							</a>
					</li>';


			}

			echo 		'</ul>';//card-container
			$archivelink = ''.get_site_url().'/author/'.$user->user_nicename.'';
			echo '<div class="archive-cta" style="display:block;margin: 0 auto;text-align:center;">
				<a class="button--black" href="'.$archivelink.'">
					View Posts Archive of '.$user->display_name.'
				</a>
			</div>';
			echo '</div>';//card-deck
		}elseif($postdisplay == 'previews'){
			echo '<div class="post-previews-wrapper">';

			foreach($recent_posts as $curpost){
				$postUrl = get_permalink($curpost["ID"]);
				$post_content = get_post($curpost["ID"],'object','display');
				$pageTitle = $curpost["post_title"];
				$content = $post_content->post_content;
				$excerptStr = substr(strip_tags($content,'<p><br><a><span>'),0,600);

				$comingsoon = get_post_meta( $curpost["ID"],'comingsoon', true );
				if($comingsoon){
					$pageTitle = 'Coming Soon';
					$excerptStr = '';
					$postUrl = '##';
				}

				echo '<div class="post-preview post--'.$curpost["ID"].'">
				<div class="post-image">
					<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'" />
				</div>
					<div class="post-content-box-wrapper">
						<div class="post-content-box">
							<div class="post-header">
								<div class="post-title">
									'.$pageTitle.'
								</div>
							</div>
							<div class="post-content">
							'.$excerptStr.'...'.'
							</div>
							<div class="read-more">
								<a href="'.$postUrl.'" class="ghost-button-black">
								Continue Reading
								</a>
							</div>
						</div>
					</div>
				</div>';
			}


			$archivelink = ''.get_site_url().'/author/'.$user->user_nicename.'';
			echo '<div class="archive-cta" style="display:block;margin: 0 auto;text-align:center;">
				<a class="button--black" href="'.$archivelink.'">
					View Posts Archive of '.$user->display_name.'
				</a>
			</div>';

			echo '</div>';
		}


	}

	?>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Page -->
	<ins class="adsbygoogle"
	     style="display:block"
	     data-ad-client="ca-pub-7101197309332352"
	     data-ad-slot="1515861801"
	     data-ad-format="auto"
	     data-full-width-responsive="true"></ins>
	<script>
	     (adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	<style>
	.archive-cta{
		font-family: 'Montserrat';
		/*display: none;*/
		font-size:18px;
		margin-top:10px;
	}
	.archive-cta a{
		padding: 10px;
	}
	.archive-cta a { text-decoration: none; color: black;}
  .archive-cta a:visited { text-decoration: none; color: black;  }
  .archive-cta a:hover { text-decoration: none; color: black;  }
  .archive-cta a:focus { text-decoration: none; color: black;  }
  .archive-cta a:hover, a:active { text-decoration: none; color: black;}

.post-preview{
	width:100%;
	display: block;
	text-align: center;
}
.post-image{
	margin: 20px 20px 0px 20px;
}
.post-image img{
		object-fit: cover;
		height: 700px;
		width: 100%;
}

.post-content-box-wrapper{
width:100%;
display: flex;
justify-content: center;
}
.post-content-box{
background-color: white;
display: block;
position: relative;
width: 80%;
top:-100px;
}

.post-header{
height:100px;
font-size: 42px;
font-family: "Merriweather";

display: flex;
flex-direction: column;
justify-content: center;
}

.post-title{

}

.post-content{
		 width: 70%;
		margin: 0 auto;
		 text-align: justify;
     text-justify: inter-word;
}

.post-previews-wrapper .archive-cta{
margin:30px;
}

.read-more{
	margin: 30px;
}
@media screen and (max-width: 500px) {

.ghost-button-black{
	width: auto;
}

.post-content-box{
width: 100%;
}

}

	</style>
</article><!-- #post-<?php the_ID(); ?> -->
