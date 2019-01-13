<?php
/**
 * Template Name: Portrait
 * Template Post Type:  page, post
 *
 * @package youhadmeat_theme
 */

get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
  <?php

  $featuredTheme = get_post_meta( get_the_id(),'featured-theme', true );
  $featuredPosition = get_post_meta( get_the_id(),'featured-position', true );

  $darkThemeClass = '';
  if($featuredTheme == 'dark'){
    $darkThemeClass = 'pt-portrait--dark';
  }


  $positionOneClass = "pt-left";
  $positionTwoClass = "pt-right";

  if($featuredPosition == 'right'){
    $positionOneClass = "pt-right";
    $positionTwoClass = "pt-left";
  }
  while ( have_posts() ) :
    the_post();

    $nightMode = get_post_meta( get_the_id(),'nightMode', true );
    if($nightMode){
      echo '<style>
        body{
          background-color: rgb(35,35,35);
          color: white;
        }
      </style>';
    }

    echo '<div class="pt-portrait '.$darkThemeClass.'">
      <div class="pt-portrait-wrapper">';
          echo  '<div class="pt-section-one '.$positionOneClass.'" style="background-image:url('.get_the_post_thumbnail_url().');">
              <div class="pt-section-one__overlay">
              </div>
            </div>
            <div class="pt-section-two '.$positionTwoClass.' fade-slow">
              <div class="pt-section-two-container">
                <div class="title">
                  <div>
                  '.get_the_title().'
                  </div>
                  <div class="post-meta" style="font-size:0.25em;">
                    '.get_the_date().' | '.get_the_author_meta('nickname').'
                  </div>
                </div>
                <div class="excerpt">
                  '.get_the_excerpt().'
                </div>
              </div>
            </div>';
        //}

      echo '</div>
    </div>';

    get_template_part( 'template-parts/content', get_post_type() );

    /*the_post_navigation();*/

    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
      comments_template();
    endif;

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
