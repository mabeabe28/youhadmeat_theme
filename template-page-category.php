<?php
/**
 * Template Name: Category Page
 * Template Post Type:  page
 *
 * @package youhadmeat_theme
 */

get_header();
?>

<section>

  <!-- get most recent post from each category -->
  <div class="slideshow-container">

  <?php
  global $post;
  $post_slug=$post->post_name;

  $category=get_category_by_slug($post_slug);

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
        $excerptStr = (strlen($curpost["post_excerpt"]) > 140) ? substr($curpost["post_excerpt"],0,140).'...' :$curpost["post_excerpt"];
        $comingsoon = get_post_meta( $curpost["ID"],'comingsoon', true );
        $pageTitle = get_the_title($curpost["ID"]);
        $postUrl = get_permalink($curpost["ID"]);
        $ctaText = 'Read More';
        if($comingsoon == 'true'){
          $pageTitle = '';
          $excerptStr = '';
          $postUrl = '##';
          $ctaText = 'Coming Soon';
        }

        echo '
        <div class="hero" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url('.get_the_post_thumbnail_url($curpost["ID"], 'full').');">
            <!--load image before hand,but hide display to prevent blank flashes when changing slide since background-image still be loading image-->
            <div style="display:none;">
              <img src="'.get_the_post_thumbnail_url($curpost["ID"], 'full').'">
            </div>

            <div id="youhadmeatHeroText">
                <div id="leading">You Had Me At</div>
                <div id="trailing">'.$category->cat_name.'
                  <div id="recentPost" class="fade">
                    <div style="font-size:12px;">Latest Post:</div>
                    <div class="recentPost_detail">
                      '.$pageTitle.'
                    </div>
                    <div class="recentPost_excerpt">
                     '.$excerptStr.'
                    </div>
                    <div class="cta" style="font-size: 15px;"><a class="ghost-button category--'.$category->slug.'" href="'.$postUrl.'">'.$ctaText.'</a></div>
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
  <script>
  var slideIndex = 0;
  showSlides();

  // Next/previous controls
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }


  function showSlides() {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {slideIndex = 1}
      slides[slideIndex-1].style.display = "block";
      setTimeout(showSlides, 6000); // Change image every 2 seconds
  }
  </script>
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

<?php
/*get_sidebar();*/
get_footer();
