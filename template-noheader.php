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
    echo '<div class="title">
      <div>
      '.get_the_title().'
      </div>
      <div style="font-size:0.25em;">
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
