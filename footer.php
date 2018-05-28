<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package youhadmeat_theme
 */

?>

</div> <!--#content -->

	<footer id="footer" >
		<div class="footer-main">
			<div class="site-logo">
				<div class="leading">
					You Had Me At
				</div>
				<div class="trailing">
					Blog
				</div>
			</div>
			<div class="site-info">
				<h3><strong>About</strong></h3>
				<p>
					You had me at hello. The <i><strong>You Had Me At</strong></i> blog is a communal blog between a group of friends,
					looking to share each others wealth of information
					and experience to the rest of the world.
				</p>
			</div>
			<div class="contact-info">
				<h3><strong>Contact</strong></h3>
					Feel free to contact us about anything!
				</br>
				<i class="fas fa-envelope fa-sm">
				</i> Email: contact.youhadme@gmail.com
				</br>
				<i class="fab fa-instagram fa-sm">
				</i> Instagram: @youhadme.at
			</div>
			<div class="menu-info">
				<h3><strong>Navigation</strong></h3>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
				) );
				?>
			</div>
		</div>
		<div class="copyright-info">
			 &copy; <?php echo date('Y'); ?> You Had Me At
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div> <!--#page -->
<style>

#footer {
	font-family: "Avenir", "Open Sans";
	color: white;
	font-size: 12px;
}

#footer .footer-main{
	width: 100%;
	display: flex;
	justify-content: space-around;
	flex-flow: row wrap;
}

#footer .copyright-info{
	width: 100%;
	display: block;
	text-align: center;
}

#footer .site-logo{
	text-align: center;
	font-size: 20px;
	color: white;
	margin: 40px;
	width: 300px;
	display: inline-block;
}

#footer  .site-logo .leading{
	font-style: italic;
	font-weight: bold;
}

#footer .site-logo .trailing{
	font-family: "Gloss-and-Bloom";
	padding:10px;
}
#footer .site-info{
	margin: 20px;
	width: 300px;
	display: inline-block;
}
#footer .contact-info{
	margin: 20px;
	width: 300px;
	display: inline-block;
}
#footer .menu-info{
	margin: 20px;
	width: 300px;
	display: inline-block;
}
#footer-menu{
	margin: 0;
	width: 300px;
	display: inline-block;
	list-style: none;
	overflow:hidden;
}

#footer-menu li{
	float:left;
	display:inline;
	width:50%;
}

#footer-menu .menu-main-container{
	padding: 0px;
	margin: 0px;
}

ul#footer-menu.menu{
	padding-left: 0;
}

/* Links */
#footer-menu a{text-decoration:underline;color:white;}
#footer-menu a:visited { text-decoration: none; color:white; }
#footer-menu a:hover { text-decoration: none;color:white; }
#footer-menu a:focus { text-decoration: none; color:white;}
#footer-menu a:hover, a:active { text-decoration: none; color:white;}


</style>
<?php wp_footer(); ?>

</body>
</html>
