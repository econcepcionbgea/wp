</div> <!--.container-->
</div> <!--#main-->
</div> <!--.content_wrapper-->
<footer id="footer">
	<?php get_sidebar( 'footer' ); ?>

	<div class="footer_wrapper">

		<div class="container">

			<?php if ( $copyright = stm_option( 'copyright' ) ) { ?>

				<div class="copyright">

					<?php _e( wp_kses_data( $copyright ) ); ?>

				</div>

			<?php } ?>

		</div>

	</div>
</footer>
<?php if( $appointment_button = stm_option( 'make_an_appointment' ) ){ ?>
	<div class="make_an_appointment">
		<a href="<?php echo get_permalink( $appointment_button ); ?>" class="button"><?php echo stm_option( 'make_an_appointment_text', __( 'Make an appointment button', 'cinderella' ) ) ?></a>
	</div>
<?php } ?>
<?php
global $wp_customize;
if( is_stm() && ! $wp_customize ){
	get_template_part( 'partials/frontend_customizer' );
}
?>
</div> <!--#wrapper-->
<?php wp_footer(); ?>
</body>
</html>