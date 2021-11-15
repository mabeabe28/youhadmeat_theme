<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package youhadmeat_theme
 */

?>

<style>
	.no-results{
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

	.no-results .title{
		width: 100%;
		text-align: center;
		font-family: 'Fjalla One', sans-serif;
	}

</style>

<section class="no-results not-found" style="background-image:linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.4)), url(<?php echo ''.get_template_directory_uri().'/includes/images/404.jpg'; ?>);">

	<header class="title">
		<h1><?php esc_html_e( 'Nothing Found', 'youhadmeat_theme' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'youhadmeat_theme' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'youhadmeat_theme' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'youhadmeat_theme' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
