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
			echo '<div class="card-deck-header"></div>';
			echo '<ul class="card-container">';
	    foreach($recent_posts as $curpost){
				//print_r($curpost);
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
				echo '<li class="card-wrapper category--'.$ParentCategory->slug.'">
									<a href="'.$postUrl.'">
										<div class="card-header"><div class="card-header-category category--'.$ParentCategory->slug.'">
											<div class="category-title">'.$ChildCategory->name.'</div>
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
			echo '<div class="card-deck-header"></div>';
			echo '<ul class="card-container">';
			foreach($recent_posts as $curpost){
				//print_r($curpost);
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
				echo '<li class="card-wrapper category--'.$curcat->slug.'">
									<a href="'.$postUrl.'">
										<div class="card-header"><div class="card-header-category category--'.$ParentCategory->slug.'">
											<div class="category-title">'.$ParentCategory->name.'</div>
											<div class="category-icon"></div>
										</div></div>
										<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'" />
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

			echo 		'</ul>';//card-container
			$archivelink = ''.get_site_url().'/author/'.$user->user_nicename.'';
			echo '<div class="archive-cta" style="display:block;margin: 0 auto;text-align:center;">
				<a class="ghost-button-black" href="'.$archivelink.'">
					View Posts Archive of '.$user->display_name.'
				</a>
			</div>';
			echo '</div>';//card-deck
		}elseif($postdisplay == 'previews'){
			echo '<div class="post-previews-wrapper">';

			foreach($recent_posts as $curpost){
				$postUrl = get_permalink($curpost["ID"]);
				$post_content = get_post($curpost["ID"]);
				$pageTitle = $curpost["post_title"];
				$content = $post_content->post_content;
				$excerptStr = substr($content,0,600);

				$comingsoon = get_post_meta( $curpost["ID"],'comingsoon', true );
				if($comingsoon){
					$pageTitle = 'Coming Soon';
					$excerptStr = '';
					$postUrl = '##';
				}

				echo '<div class="post-preview post--'.$curpost["ID"].'">
				<div class="post-image">
					<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'medium').'" />
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
				<a class="ghost-button-black" href="'.$archivelink.'">
					View Posts Archive of '.$user->display_name.'
				</a>
			</div>';

			echo '</div>';
		}


	}

	?>

	<style>
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
font-family: "Crimson Text";

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


	</style>
</article><!-- #post-<?php the_ID(); ?> -->
