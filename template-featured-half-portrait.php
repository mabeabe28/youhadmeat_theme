<?php
/**
 * Template Name: Featured Image Half Portrait
 * Template Post Type:  page, post
 *
 * @package youhadmeat_theme
 */

get_header();
?>

<style>

.featured-image {
  /* Sizing */
  width: 100vw;
  height: 100vh;
  /* Flexbox stuff */
  display: flex;
  justify-content: center;
  align-items: center;
  /* Text styles */
  text-align: center;
  color: black;
  /* Background styles */
  /*background-image: url(http://localhost:8888/youhadmeat/wp-content/uploads/2018/05/DSCF6505.jpg);*/

  background-color: white;
}

/*hero text wrapper stuff*/
.featured-wrapper {
    /*position: absolute;*/
    color: black;
    width: 100%;
    display: flex;
    justify-content: center;
    flex-flow: row wrap;

}

.section-one{
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  height: 100vh;
  width: 50%;
}
.section-two{
  height: 100vh;
  width: 50%;
}

.section-two .title{
  top:20%;
  position:relative;
  font-size:3em;
  font-family:"Crimson Text";
  letter-spacing:2px;
}

.section-two .excerpt{
  margin-left:75px;
  margin-right:75px;
  top:30%;
  position:relative;
  font-size:1em;
  font-style:italic;
  text-align:justify;
  text-justify:inter-word;
}


@media screen and (max-width:850px){
  .featured-image{
    height: auto;
  }

  .section-one{
    height: 100vh;
    width: 1000px;
    /*background-attachment: fixed;*/
  }
  .section-two{
    height: 100vh;
    width: 1000px;
  }

}
@media screen and (max-width:500px){
  .section-two .title{
    top:5%;
  }

  .section-two .excerpt{
    top:15%;
    margin-left:20px;
    margin-right:20px;
  }
}

</style>
<div id="primary" class="content-area">
  <main id="main" class="site-main">
  <?php

  $featuredTheme = get_post_meta( get_the_id(),'featured-theme', true );
  $featuredPosition = get_post_meta( get_the_id(),'featured-position', true );
  $featuredfixed = get_post_meta( get_the_id(),'featured-is-fixed', true );

  $backgroundColour = 'white';
  $textColour = 'black';

  if($featuredTheme == 'dark'){
    $backgroundColour = 'black';
    $textColour = 'white';

    echo '<style>
      .featured-image{
        background-color: '.$backgroundColour.';
      }

      .section-two{
        color: '.$textColour.';
      }
    </style>
    ';
  }


  if($featuredfixed == 'true'){

    if($featuredPosition == 'right'){
      $imgPosition = '50%';
      $excerptFloat = 'left';
    }else{
      $imgPosition = '0%';
      $excerptFloat = 'right';
    }

    echo '<style>
      @media screen and (min-width:850px){

        body{
          background-color:'.$backgroundColour.';
        }

        .entry-content{
          color: '.$textColour.';
        }

        .section-one{
          left:'.$imgPosition.';position:fixed;
        }

        .section-two{
          float:'.$excerptFloat.';
        }

        .featured-wrapper{
          display:block;
        }
      }
    </style>
    ';
  }



  while ( have_posts() ) :
    the_post();

    echo '<div class="featured-image">
      <div class="featured-wrapper">';

        if($featuredPosition == 'right'){
          echo  '
            <div class="section-two fade-slow">
              <div class="title">
                <div>
                '.get_the_title().'
                </div>
                <div style="font-size:0.25em;">
                  '.get_the_date().' | '.get_the_author_meta('nickname').'
                </div>
              </div>
              <div class="excerpt">
                '.get_the_excerpt().'
              </div>
            </div><div class="section-one" style="background-image:url('.get_the_post_thumbnail_url().');">
              </div>';
        }else{
          echo  '<div class="section-one" style="background-image:url('.get_the_post_thumbnail_url().');">
            </div>
            <div class="section-two fade-slow">
              <div class="title">
                <div>
                '.get_the_title().'
                </div>
                <div style="font-size:0.25em;">
                  '.get_the_date().' | '.get_the_author_meta('nickname').'
                </div>
              </div>
              <div class="excerpt">
                '.get_the_excerpt().'
              </div>
            </div>';
        }

      echo '</div>
    </div>';

    get_template_part( 'template-parts/content', get_post_type() );

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
