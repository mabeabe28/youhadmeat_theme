<?php
/**
 * Template Name: No Header
 * Template Post Type:  page, post
 *
 * @package youhadmeat_theme
 */

get_header();
?>
<style>
  #site-navigation{
    background-color: black;
  }

.featured-text{
      padding-top: 50px;
      text-align: center;
      padding-bottom:10px;
}

.title{
  font-size: 3.4722222222222223vw;
  font-family: 'Montserrat', sans-serif;
}

.excerpt{
  font-size: 1.6666666666666665vw;
  font-weight: 300;
  font-family: "Raleway","Calibri", sans-serif;
}

.meta{
  font-size: 1.1111111111111112vw;
  font-style: italic;
  font-family: "Raleway","Calibri", sans-serif;
}

@media screen and (max-width: 800px) {
  .title{
    font-size: 6.4722222222222223vw;
  }

  .excerpt{
    font-size: 2.9411764705882355vw;
  }

  .meta{
    font-size: 1.8823529411764706vw;
  }
}
</style>
<script>

$(document).on('scroll', function () {
    event.stopPropagation();
    event.preventDefault();
    $('#site-navigation').css('background-color', 'rgba(0,0,0,100)');

});

</script>
<div id="primary" class="content-area">
  <main id="main" class="site-main">
  <?php

  while ( have_posts() ) :
    the_post();
    $hideTitle = get_post_meta( get_the_id(),'hideTitle', true );
    $hideExcerpt = get_post_meta( get_the_id(),'hideExcerpt', true );
    $hideMeta = get_post_meta( get_the_id(),'hideMeta', true );

    if(!$hideTitle || !$hideExcerpt || !$hideMeta){
      echo '<div class="featured-text">';
    }

      if(!$hideTitle){
      echo '<div class="title">
        '.get_the_title().'
        </div>';
      }


      if(!$hideExcerpt){
      echo '  <div class="excerpt">
          '.get_the_excerpt().'
        </div>';
      }

      if(!$hideMeta){
      echo '  <div class="meta">
          '.get_the_date().' | '.get_the_author_meta('nickname').'
        </div>';
      }

    if(!$hideTitle || !$hideExcerpt || !$hideMeta){
      echo '  </div>';
    }
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

<?php
/*get_sidebar();*/
get_footer();
