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
				</i> Email: hello@youhadme.at
				</br>
				<i class="fab fa-instagram fa-sm">
		</i> Instagram: <a href="https://www.instagram.com/youhadme.at">@youhadme.at</a> <!-- Comment Life-->
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

<?php wp_footer(); ?>

</body>
</html>
