<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>

<?php if ( get_the_author_meta( 'description' ) ) { ?>

	<div class="stm_author_box<?php echo esc_attr( $css_class ); ?> clearfix">

		<div class="author_avatar">
			<?php echo get_avatar( get_the_author_meta( 'email' ), 244 ); ?>
		</div>

		<div class="author_info">
			<div class="author_name">
				<?php _e( 'Author:', 'cinderella' ); ?> <strong><?php the_author_meta( 'nickname' ); ?></strong>
			</div>
			<div class="author_content"><?php the_author_meta( 'description' ); ?></div>
		</div>

	</div>

<?php } ?>