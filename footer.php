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
		<div class="site-info">
			 &copy; <?php echo date('Y'); ?> You Had Me At
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div> <!--#page -->
<style>

#footer {
	height: 10vw;
	font-family: "Avenir", "Open Sans";
	color: white;
}


</style>
<?php wp_footer(); ?>

</body>
</html>
