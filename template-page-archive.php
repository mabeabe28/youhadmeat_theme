<?php
/* Template Name: Custom Archive Template */
get_header();
?>
<?php if ( have_posts() ) {
while ( have_posts() ) {
the_post(); ?>




          <h1 class="page-title"><?php echo esc_html( get_the_title() ); ?></h1>
         
          <?php the_content(); ?>
          <?php }
          wp_reset_postdata();
          } ?>
          <!-- <div class="archive-sidebar">
          <div class="archive-categories">
          <p><strong><?php echo esc_html__( 'Categories', 'textdomain' ); ?></strong></p>
          <ul class="category-list">
          <?php wp_list_categories(
          array(
          'title_li' => '',
          'hide_title_if_empty' => true
          ) ); ?>
          </ul>
          </div>
          <div class="archive-tags">
          <p><strong><?php echo esc_html__( 'Tags', 'textdomain' ); ?></strong></p>
          <?php wp_tag_cloud(); ?>
          </div>
          <div class="archive-authors">
          <p><strong><?php echo esc_html__( 'Authors', 'textdomain' ); ?></strong></p>
          <?php wp_list_authors(
          array(
          'hide_empty' => 'true',
          'optioncount' => 'true'
          ) ); ?>
          </div>
          </div>
          </div> -->

          <?php $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
          $posts_query = new WP_Query(
          array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' => 15,
          'paged' => $paged
          ) ); ?>

          <div class="posts-section">
          <?php if ( $posts_query->have_posts() ) { ?>
       



          <div class="post-grid">
            <?php $index = 0; ?>
            <?php while ( $posts_query->have_posts() ) {
              $posts_query->the_post(); 

              $imageUrl = get_the_post_thumbnail_url(get_the_ID(), 'large');
              $excerpt = get_the_excerpt(get_the_ID());
					    $curExcerptStr = (strlen($excerpt) > 200) ? substr($excerpt,0,200).'...' :$excerpt;

              ?>
              

              <div class="item item-<?php echo $index; ?>">
                  <div class="post-grid-image" style="background-image:url('<?php echo $imageUrl;?>');">
                  </div>
                  
                  <div class="post-grid-content">
                    <div class="title" ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    <div class="excerpt"><?php echo $curExcerptStr; ?> </div>
                    <div class="read-more-wrapper">
                    <div class="read-more button"> <a href="<?php the_permalink(); ?>"> Read More </a> </div>
                    </div>
                    
                  </div>
              </div>
            <?php $index++; } ?>

          </div>

    
          <?php
          $total_pages = $posts_query->max_num_pages;
          if ( $total_pages > 1 ) {
          $current_page = max( 1, get_query_var( 'paged' ) ); ?>
          <div class="cta-banner">
          <?php echo paginate_links( array(
          'base' => get_pagenum_link( 1 ) . '%_%',
          'format' => 'page/%#%',
          'current' => $current_page,
          'total' => $total_pages
          ) ); ?>
          </div>
          <?php }
          wp_reset_postdata();
          } else { ?>
          <div class="archived-posts"><?php echo esc_html__( 'No posts matching the query were found.', 'textdomain' ); ?></div>
          <?php } ?>
          </div>


<?php
get_footer();