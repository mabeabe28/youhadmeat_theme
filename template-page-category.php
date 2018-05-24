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

<div id="primary" class="content-area">
  <main id="main" class="site-main">

  <?php
  while ( have_posts() ) :
    the_post();

    echo '<div id="featured-image" style="background-image:linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.4)), url('.get_the_post_thumbnail_url().');">
      <div id="featured-wrapper">
        <div id="featured-text">
        '.get_the_title().'
        </div>
      </div>
    </div>';

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
