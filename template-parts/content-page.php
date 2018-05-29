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

			$showMap = get_post_meta( $post->ID,'showMap', true );

				if($showMap == 'true'){
					echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
							  <script>
							    google.charts.load("current", { "packages": ["map"] });
							    google.charts.setOnLoadCallback(drawMap);

							    function drawMap() {
							      var data = google.visualization.arrayToDataTable([
							        ["Country", "Population"],
							        ["China", "China: 1,363,800,000"],
							        ["India", "India: 1,242,620,000"],
							        ["US", "US: 317,842,000"],
							        ["Indonesia", "Indonesia: 247,424,598"],
							        ["Brazil", "Brazil: 201,032,714"],
							        ["Pakistan", "Pakistan: 186,134,000"],
							        ["Nigeria", "Nigeria: 173,615,000"],
							        ["Bangladesh", "Bangladesh: 152,518,015"],
							        ["Russia", "Russia: 146,019,512"],
							        ["Japan", "Japan: 127,120,000"]
							      ]);

							    var options = {
							      showTooltip: true,
							      showInfoWindow: true
							    };

							    var map = new google.visualization.Map(document.getElementById("chart_div"));

							    map.draw(data, options);
									};

									<div id="chart_div"></div>';
				}

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
				echo '<li class="card-wrapper category--'.$ParentCategory->slug.'">
									<a href="'.get_permalink($curpost["ID"]).'">
										<div class="card-header"><div class="card-header-category category--'.$ParentCategory->slug.'">
											<div class="category-title">'.$ChildCategory->name.'</div>
										</div></div>
										<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'" />
										<div class="card-content">
											<div class="card-content-container">
												<div class="card-content-title">'.$curpost["post_title"].'</div>
												<div class="card-content-excerpt">
													'.$curpost["post_excerpt"].'
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


			echo '<li class="card-wrapper category--'.$curcat->slug.'">
								<a href="'.get_permalink($curpost["ID"]).'">
									<div class="card-header"><div class="card-header-category category--'.$ParentCategory->slug.'">
										<div class="category-title">'.$ParentCategory->name.'</div>
									</div></div>
									<img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'" />
									<div class="card-content">
										<div class="card-content-container">
											<div class="card-content-title">'.$curpost["post_title"].'</div>
											<div class="card-content-excerpt">
												'.$curpost["post_excerpt"].'
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



	}

	?>

	<style>





	</style>
</article><!-- #post-<?php the_ID(); ?> -->
