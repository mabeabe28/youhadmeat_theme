<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package youhadmeat_theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">


	<script src="https://code.jquery.com/jquery-git.min.js"></script>

	<?php wp_head(); ?>

	<!-- Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123741580-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-123741580-1');
	</script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "ca-pub-7101197309332352",
			enable_page_level_ads: true
		});
	</script>
</head>

<body <?php body_class(); ?>>



<div id="page" class="site">
	<!---<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'youhadmeat_theme' ); ?></a>-->

	<header class="header-container" id="masthead">

		<!-- <div id="searchOverlay" class="search-overlay fade">
			<span class="closebtn" onclick="closeSearch()" title="Close Overlay"><i class="fas fa-times fa-xs">
			</i></span>
			<div class="overlay-content">
				<?php get_search_form() ?>
			</div>
		</div> -->

		
		<nav id="navigation">

		
			<div id="menu">
					<i class="fas fa-bars fa-lg">
					</i>
					<!-- <?php
						wp_nav_menu( array(
							'theme_location' => 'main',
							'menu_id'        => 'primary-menu',
						) );
					?> -->
				
			</div>
			<div id="title">
				YOU HAD ME AT
			</div>

			<div id="links">
				<a class="button" href="/here">
					OUR LINKS
				</a>
			</div>
		

		</nav><!-- #site-navigation -->
	
	</header><!-- #masthead -->


	<div id="content" class="site-content">
