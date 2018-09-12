<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( empty( $image_size ) ) {
	$image_size = 'thumb-82x82';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$image     = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $image_size ) );
?>

<div class="stm_contact<?php echo esc_attr( $css_class ); ?> clearfix">

	<?php if ( ! empty( $image['thumbnail'] ) ) { ?>
		<div class="stm_contact_image">
			<?php echo $image['thumbnail']; ?>
		</div>
	<?php } ?>

	<div class="stm_contact_info">
		<h4><?php echo esc_html( $name ); ?></h4>
		<?php if ( $phone ) { ?>
			<div class="stm_contact_row"><?php _e( 'Phone: ', 'cinderella' ); ?><?php echo esc_html( $phone ); ?></div>
		<?php } ?>
		<?php if ( $email ) { ?>
			<div class="stm_contact_row"><?php _e( 'Email: ', 'cinderella' ); ?><?php echo esc_html( $email ); ?></div>
		<?php } ?>
		<?php if ( $skype ) { ?>
			<div class="stm_contact_row"><?php _e( 'Skype: ', 'cinderella' ); ?><?php echo esc_html( $skype ); ?></div>
		<?php } ?>
	</div>

</div>