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
		.wrapper-404{
			background-color: black;
			height: 100vh;
			width: 100%;
			color: white;

			display: flex;
			flex-direction: column;
		  align-items: center;
		  justify-content: center;
			text-align: center;

			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
		}

		.wrapper-404 .title{
			width: 100%;
			text-align: center;
			font-family: 'Fjalla One', sans-serif;
			display: flex;
			justify-content: center;
			flex-flow: row wrap;
		}

		.wrapper-404 .page-content{
			text-align: center;
			margin-bottom: 30px;
		}

		.text-404-leading{
			padding-left: 10px;
			margin-left: 20px;
			font-family: 'Fjalla One', sans-serif;
			font-weight:bold;
			text-align: center;
			display: inline-block;
			padding-bottom: 20px;
			padding-top: 30px;
			font-size: 4vw;

			margin-bottom: 10px;

		}

		.text-404-trailing{
			padding-right: 10px;
			margin-right: 20px;
			width: 400px;
			font-family: 'Fjalla One', sans-serif;
			display: inline-block;
			text-align: center;
			font-size: 6vw;
			padding-top: 10px;
			margin-bottom: 10px;

		}

	</style>

	<section class="wrapper-404" style="background-image:linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.4)), url(<?php echo ''.get_template_directory_uri().'/includes/images/404.jpg'; ?>);">
		<header class="title">
			<div class="text-404-leading"><?php esc_html_e( 'You had me at ', 'youhadmeat_theme' ); ?></div>
			<div class="text-404-trailing"><?php esc_html_e( 'OOPS', 'youhadmeat_theme' ); ?></div>
		</header><!-- .page-header -->

		<div class="page-content">
			<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'youhadmeat_theme' ); ?>
		</div><!-- .page-content -->
		<?php get_search_form(); ?>

	</section><!-- .no-results -->

<?php
get_footer();
