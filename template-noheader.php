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
font-family: "Crimson Text";
}

.excerpt {
    font-size: 1.6666666666666665vw;
    font-weight: 300;
    font-family: "Avenir","Open Sans";
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
    echo '<div class="featured-text">
      <div class="title">
      '.get_the_title().'
      </div>
      <div class="excerpt">
        '.get_the_date().' | '.get_the_author_meta('nickname').'
      </div>
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

<?php
/*get_sidebar();*/
get_footer();
