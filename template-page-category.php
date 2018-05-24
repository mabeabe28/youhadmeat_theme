<?php
/**
 * Template Name: Category Page
 * Template Post Type:  page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header();
?>

<section>

  <!-- get most recent post from each category -->
  <div class="slideshow-container">

  <?php
  global $post;
  $post_slug=$post->post_name;
  echo $post_slug;
  $category=get_category_by_slug('travel');

    $args = array(
      'numberposts' => 3,
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
    foreach($recent_posts as $curpost){
      echo '<div class="mySlides">';

      if(has_post_thumbnail($curpost["ID"])){
        // use one of these
        //echo get_the_post_thumbnail( $post_id, array(80, 80), array('class' => 'post_thumbnail') );
        echo '
        <div class="hero" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('.get_the_post_thumbnail_url($curpost["ID"], 'full').');">
            <!--load image before hand,but hide display to prevent blank flashes when changing slide since background-image still be loading image-->
            <div style="display:none;">
              <img src="'.get_the_post_thumbnail_url($curpost["ID"], 'full').'">
            </div>

            <div id="youhadmeatHeroText">
                <div id="leading">You Had Me At</div>
                <div id="trailing" class="fade">'.$category->cat_name.'
                  <div id="recentPost">
                    <div style="font-size:12px;">Latest Post:</div>
                    <div class="recentPost_detail">
                      <a href="'.get_permalink($curpost["ID"]).'">'.get_the_title($curpost["ID"]).'</a>
                    </div>
                    <div class="recentPost_excerpt">
                      <a href="'.get_permalink($curpost["ID"]).'">'.$curpost["post_excerpt"].'</a>
                    </div>
                    <div class="cta" style="font-size: 15px;"><a href="'.get_permalink($curpost["ID"]).'">Read More</a></div>
                  </div>
                </div>
            </div>

        </div>
        ';
      }

      echo '</div>';

    }//end for each

   //}
  ?>

  <!-- Next and previous buttons -->
<!--<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>-->
</div>
</section>



<div id="primary" class="content-area">
  <main id="main" class="site-main">

  <?php
  while ( have_posts() ) :
    the_post();

    /*echo '<div id="featured-image" style="background-image:linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.4)), url('.get_the_post_thumbnail_url().');">
      <div id="featured-wrapper">
        <div id="featured-text">
        '.get_the_title().'
        </div>
      </div>
    </div>';*/

    get_template_part( 'template-parts/content', 'page' );

    /*the_post_navigation();*/

    // If comments are open or we have at least one comment, load up the comment template.
    /*if ( comments_open() || get_comments_number() ) :
      comments_template();
    endif;*/

  endwhile; // End of the loop.
  ?>



  </main><!-- #main -->
</div><!-- #primary -->
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
  font-family: "Gloss-and-Bloom";
  text-align: center;
  display: inline-block;
  padding-bottom: 20px;
  font-size: 5vw;
  width:80%;
}

</style>
<?php
/*get_sidebar();*/
get_footer();
