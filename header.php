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

</head>

<body <?php body_class(); ?>>



<div id="page" class="site">
	<!---<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'youhadmeat_theme' ); ?></a>-->

	<header id="masthead" class="site-header">

		<!--<div id="searchOverlay" class="overlay fade">
			<span class="closebtn" onclick="closeSearch()" title="Close Overlay"><i class="fas fa-times fa-xs">
			</i></span>
			<div class="overlay-content">
				<?php get_search_form() ?>
			</div>
		</div>-->



		<nav id="site-navigation">

			<!--<div id="side-navigation">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'sidenav',
					'menu_id'        => 'sideNav-menu',
				) );
				?>

				<div class="logo">
					<div class="text">
						You Had Me At
					</div>
				</div>
			</div>-->

			<span class="menu-toggle" onclick="openNav()">
				<i class="fas fa-bars fa-lg">
				</i>
			</span>

		<?php
		global $post;
		$post_type = get_post_type($post->ID);
		$logo_text = "";
		$logo_text_link = get_home_url();
		$logo_text_class = "";

		if($post_type == 'post' && !is_archive() && !is_search() ){
			$category = get_the_category($post->ID);
			//get top level parent only
			foreach($category as $curcat){
				if($curcat->parent == 0){
					$logo_text = $curcat->cat_name;
					$logo_text_link = ''.get_site_url().'/'.$curcat->slug.'';
					$logo_text_class = 'category--'.$curcat->slug.'';
				}
			}
		}elseif($post_type == 'page' && !is_front_page()){
			$logo_text = get_the_title($post->ID);
			$logo_text_link = get_permalink($post->ID);
			$logo_text_class = 'page--'.strtolower($logo_text).'';
		}

		echo '<div id="logo">
			<a href="'.get_home_url().'">
				<strong><i>You Had Me At</i></strong>
			</a>
			<div id="logo-item" class="'.$logo_text_class.'" style="display:inline-block;margin-left:5px;font-family:MontserratBlack">
				<a href="'.$logo_text_link.'">
					'.$logo_text.'
				</a>
			</div>
		</div>';

		 ?>


		<!--<div id="navigation-buttons">
				<a href="<?php echo get_home_url()?>">
					<i class="fas fa-home fa-lg">
					</i>
				</a>
			</div>-->

		<div class="search-toggle" onclick="openSearch()">
			 	<i class="fas fa-search fa-lg">
			 	</i>
		 	</div>

			<div class="main-navigation">


			 </div>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->


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
