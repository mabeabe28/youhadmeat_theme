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

	

	<script type="text/javascript">

	/*side nav drop down*/
	/*$('#sideNav-menu .menu-item-has-children').prepend('<div class="sidenav-dropdown fas fa-caret-down"></div>');

	$('.sidenav-dropdown').click(function(event) {
		//console.log(event);
		$(event.target).siblings('.sub-menu').toggle();
	});*/

	/* Set the width of the side navigation to 250px */
	function openNav() {
			$('#side-navigation').addClass('navOpen');
			$('#side-navigation').removeClass('navClose');
	    //document.getElementById("side-navigation").style.width = "300px";
	}

	/* Set the width of the side navigation to 0 */
	function closeNav() {
			$('#side-navigation').removeClass('navOpen');
			$('#side-navigation').addClass('navClose');
	}

	/*side nav sub menus*/
	function showSideNavSub() {
	    $('#sideNav-menu .menu-item .sub-menu').toggle();
	}

	/*$(document).on('scroll', function (e) {
	  //  $('.navbar').css('opacity', ($(document).scrollTop() / 50));
	    var rgba = $(document).scrollTop() / 250;
	    $('#site-navigation').css('background-color', 'rgba(0,0,0,' + (rgba) + ')');
	    if(rgba >= 1){
	      $('#site-navigation').css('color', 'white');
	    }else{
	      $('#site-navigation').css('color', 'white');
	    }

			$(".featured-fade").css("opacity", 1 - $(document).scrollTop() / screen.height);
	});*/

		/*search*/
			// Open the full screen search box
		function openSearch() {
		  document.getElementById("searchOverlay").style.display = "block";
		}

		// Close the full screen search box
		function closeSearch() {
		  document.getElementById("searchOverlay").style.display = "none";
		}
	</script>

	<?php if ( is_admin_bar_showing() ) { ?>
	    <style>
	        #site-navigation {
	            top: 30px;
	        }
	    </style>
	<?php } ?>
	<div id="content" class="site-content">
