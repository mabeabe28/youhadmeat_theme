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
  <div class="hero-wrapper">

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



  //for each category
  foreach($recent_posts as $curpost) {


    //get the categories for the post
    $category = get_the_category($curpost["ID"]);
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

    //todo amend this.
    if($ParentCategory->count > 0){

      if(has_post_thumbnail($curpost["ID"])){
        $excerptStr = (strlen($curpost["post_excerpt"]) > 100) ? substr($curpost["post_excerpt"],0,100).'...' :$curpost["post_excerpt"];
        $comingsoon = get_post_meta( $curpost["ID"],'comingsoon', true );
        $pageTitle = get_the_title($curpost["ID"]);
        $postUrl = get_permalink($curpost["ID"]);
        $ctaText = 'Read More';
        if($comingsoon){
          $pageTitle = '';
          $excerptStr = 'Content Coming Soon';
          $postUrl = '##';
          $ctaText = 'Coming Soon';
        }
        $catLink = ''.get_site_url().'/'.$curcat->slug.'';

        $featuredWord = $ChildCategory->cat_name;
        $queryFeaturedWord = get_post_meta( $curpost["ID"],'featured-word', true );
        if(strlen($queryFeaturedWord)){
          $featuredWord = $queryFeaturedWord;
        }

        echo '  <div class="slide__container js-slider" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)), url('.get_the_post_thumbnail_url($curpost["ID"], 'large').');">
        <div style="display:none;">
          <!--load image before hand,but hide display to prevent blank flashes when changing slide since background-image still be loading image-->
          <img src="'.get_the_post_thumbnail_url($curpost["ID"], 'large').'">
        </div>
        </div>

      ';

      echo '<div class="slide-wrapper">';
        echo '<div class="slide-title category--'.$ParentCategory->slug.'">
          <div class="slide-title__leading">
            <h1>YOU HAD ME AT</h1>
          </div>
          <div class="slide-title__trailing js-slide-title">
            <h1>'.strtoupper($featuredWord).'</h1>
          </div>
        </div>';



        echo '<div class="slide-excerpt">
          <div class="slide-excerpt__container js-slide-excerpt" >
            <div class="slide-excerpt__text">
              '.$excerptStr.'
            </div>

            <div class="slide-excerpt__cta">
              <div class="slide-excerpt__cta-container" >
                <a class="button category--'.$ParentCategory->slug.'" href="'.$postUrl.'">'.$ctaText.'</a>
              </div>
            </div>

          </div>';

          //echo '<div class="slider-scroll-down anmt-scroll-down"></div>';
          echo '</div>';

        echo '</div>';

      }

   }
  } // foreach($categories
  ?>

  <!-- Next and previous buttons-->
<a class="slider-button slider-button__previous" onclick="minusSlides(-1)">&#10094;</a>
<a class=" slider-button slider-button__next" onclick="plusSlides(1)">&#10095;</a>

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
<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    document.getElementById("site-navigation").style.top = "0";
  } else {
    document.getElementById("site-navigation").style.top = "-50px";
  }
}
</script>
<?php
/*get_sidebar();*/
get_footer();
