<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class   = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$button      = vc_build_link( $button );
$stm_classes = $css_class;

if ( $label_state == 'enable' && $label_text != '' ) {
	$stm_classes .= ' has-label';
}
?>

<div class="stm_pricing-table<?php echo esc_attr( $stm_classes ); ?>">
	<div class="pricing-table_inner">

		<div class="pricing-table_head">

			<?php if ( $title ) { ?>
				<h4><?php echo esc_html( $title ); ?></h4>
			<?php } ?>

			<div class="pricing_price_wrap">
				<?php echo( ( $price != '' ) ? '<span class="pricing_price">' . esc_html( $price_prefix . $price ) . ( ( $price_postfix != '' ) ? '<span class="pricing_price_postfix">' . esc_html( $price_separator . $price_postfix ) . '</span>' : '' ) . '</span>' : '' ); ?>
			</div>

		</div>

		<div class="pricing-table_content">
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>

		<div class="pricing-table_footer">
			<?php if ( $button['url'] != '' ) { ?>
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="button" target="<?php echo( ( $button['target'] == '' ) ? '_self' : $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
			<?php } ?>
		</div>

		<?php if ( $stm_classes != '' ) { ?>
			<span class="pricing-table_label"><?php echo esc_html( $label_text ); ?></span>
		<?php } ?>

	</div>
</div>