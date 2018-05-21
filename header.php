<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package YouHadMeAtV1
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">


	<script src="http://code.jquery.com/jquery-git.min.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>



<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'youhadmeatv1' ); ?></a>

	<header id="masthead" class="site-header">
		<!---<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$youhadmeatv1_description = get_bloginfo( 'description', 'display' );
			if ( $youhadmeatv1_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $youhadmeatv1_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>

			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'youhadmeatv1' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</div>---><!-- .site-branding -->

		<nav id="site-navigation">

			<div id="side-navigation">
				<!--<div id="logo">You Had Me At</div>-->
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'sideNav-menu',
				) );
				?>
			</div>


			<span class="menu-toggle" onclick="openNav()">
				<i class="fas fa-bars fa-lg">
				</i>
			</span>


			<div id="logo">
				You Had Me At
			</div>


			<div class="main-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			 </div>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->


	<script type="text/javascript">
	$(document).ready(function(){
	  console.log("hello")
	});

	/*side nav drop down*/
	$('#sideNav-menu .menu-item-has-children').prepend('<span class="sidenav-dropdown fas fa-caret-down"></span>');

	$('.sidenav-dropdown').click(function(event) {
		//console.log(event);
		$(event.target).siblings('.sub-menu').toggle();
	});

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

	$(document).on('scroll', function (e) {
	  //  $('.navbar').css('opacity', ($(document).scrollTop() / 50));
	    var rgba = $(document).scrollTop() / 250;
	    $('#site-navigation').css('background-color', 'rgba(0,0,0,' + (rgba) + ')');
	    if(rgba >= 1){
	      $('#site-navigation').css('color', 'white');
	    }else{
	      $('#site-navigation').css('color', 'white');
	    }
	});
	</script>

	<?php if ( is_admin_bar_showing() ) { ?>
	    <style>
	        #site-navigation {
	            top: 30px;
	        }
	    </style>
	<?php } ?>
	<div id="content" class="site-content">
