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
<!--Background for Front Page only-->
<style>
body{
  background-color: #ebebeb;
  margin: 0;
}
</style>

<div class="post-grid">
<?php
				$args = array(
					'numberposts' => 10,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true
				);
				$recent_posts_all = wp_get_recent_posts( $args );
				
				foreach($recent_posts_all as $post){
					$curPostTitle = $post["post_title"];
					$curExcerptStr = (strlen($post["post_excerpt"]) > 500) ? substr($post["post_excerpt"],0,500).'...' :$post["post_excerpt"];
					$curPostUrl = get_permalink($post["ID"]);
					
					$curCategory = get_the_category($post["ID"]);
					$curParentCategory = "";
	
					foreach($curCategory as $cat){
						if($cat->parent == 0){
							$curParentCategory = $cat;
						}
					}
					$authorName = get_the_author_meta('user_nicename',$post["post_author"]);
					$authorUrl = ''.get_site_url().'/'.get_the_author_meta('user_nicename',$post["post_author"]).'';
					$date = date_create($post["post_date"]);

	
					

					echo '
						<div class="item" style="background-image:url('.get_the_post_thumbnail_url($post["ID"], 'large').');">

							<div class="hero__content__information">
								<div class="hero__content__information__items">
									<div class="pre-head">
										<div class="latest">LATEST</div>
									</div>
									<div class="title" >'.$curPostTitle.'</div>
									<div class="excerpt">'.$curExcerptStr.'</div>
									<div class="meta">
										<div class="category">'.strtoupper($curParentCategory->name).'</div>
										<div class="author"><i class="fa fa-user"></i>'.strtoupper($authorName).'</div>
										<div class="date"><i class="fa fa-calendar"></i>'.date_format($date , 'd F Y').'</div>
									</div>
									<div class="read-more"> <a href="'.$curPostUrl.'"> View Post </a> </div>
								</div>
							</div>
						</div>
					';
	
	
				}
				
			?>
</div>


<div class="main">
	
</div>


<div>

	
	




</div>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Front Page -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7101197309332352"
     data-ad-slot="4859855228"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php
/*get_sidebar();*/
get_footer();
