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
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link href="https://fonts.googleapis.com/css?family=Crimson+Text|Open+Sans" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-git.min.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>



<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'youhadmeat_theme' ); ?></a>

	<header id="masthead" class="site-header">

		<div id="side-navigation">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'sideNav-menu',
			) );
			?>
		</div>

		<nav id="site-navigation">

			<span class="menu-toggle" onclick="openNav()">
				<i class="fas fa-bars fa-lg">
				</i>
			</span>

		<?php
		global $post;
		$post_type = get_post_type($post->ID);
		$logo_text = "Blog";

		if($post_type == 'post'){
			$category = get_the_category($post->ID);

			foreach($category as $curcat){
				if($curcat->parent == 0){
					$logo_text = $curcat->cat_name;
				}
			}
		}elseif($post_type == 'page'){
			$logo_text = get_the_title($post->ID);
		}

		echo '<div id="logo">
			<a href="'.get_home_url().'">
				You Had Me At
			</a>
			<span id="logo-item" style="margin-left:5px;font-family:Gloss-and-Bloom">'.$logo_text.'</span>
		</div>';

		 ?>


			<!--<div id="navigation-buttons">
				<a href="<?php echo get_home_url()?>">
					<i class="fas fa-home fa-lg">
					</i>
				</a>
			</div>-->


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
