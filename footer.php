<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package YouHadMeAtV1
 */

?>

<!--	</div> #content -->

	<footer id="footer" >
		<div class="site-info">
			You Had Me At 
			<!--<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'youhadmeatv1' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'youhadmeatv1' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'youhadmeatv1' ), 'youhadmeatv1', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>-->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
<!--</div> #page -->

<?php wp_footer(); ?>

</body>
</html>
