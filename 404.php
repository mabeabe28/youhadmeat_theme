<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

	<style>
		.page-header{
			top: 40%;
			display: flex;
			justify-content: center;
			flex-flow: row wrap;
		}

		.text-404-leading{
			padding-left: 10px;
			padding-right: 10px;
			margin-left: 20px;
			margin-right: 20px;
			font-family: "Avenir","Open Sans","Calibri", sans-serif;
			font-style: italic;
			font-weight:bold;
			text-align: center;
			display: inline-block;
			padding-bottom: 20px;
			padding-top: 30px;
			font-size: 5vw;

			margin-bottom: 10px;

		}

		.text-404-trailing{
			padding-left: 10px;
			padding-right: 10px;
			margin-left: 20px;
			margin-right: 20px;
			width: 400px;
			font-family: "Gloss-and-Bloom", Arial, sans-serif;
			display: inline-block;
			text-align: center;
			font-size: 7vw;
			padding-top: 10px;
			margin-bottom: 10px;

		}


		.page-content p{
			text-align: center;
		}

		.error-404{
			background-color: black;
			color: white;
			height: 100vh;
			width: 100%;
		}

	</style>


	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="text-404-leading"><?php esc_html_e( 'You had me at ', 'youhadmeat_theme' ); ?></h1>
					<h1 class="text-404-trailing"><?php esc_html_e( 'Oops', 'youhadmeat_theme' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'youhadmeat_theme' ); ?></p>

					<?php
					get_search_form();

					/*the_widget( 'WP_Widget_Recent_Posts' );*/
					?>

					<!--<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'youhadmeat_theme' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div>--><!-- .widget -->

					<?php
					/* translators: %1$s: smiley */
					/*$youhadmeat_theme_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'youhadmeat_theme' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$youhadmeat_theme_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );*/
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
