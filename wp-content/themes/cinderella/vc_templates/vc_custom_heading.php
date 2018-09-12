<?php
/**
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$output = $output_text = $css_class = $style = '';
$link   = $text = $google_fonts = $font_container = $el_class = $css = $font_container_data = $google_fonts_data = '';
extract( $this->getAttributes( $atts ) );
extract( shortcode_atts( array(
	'type'  => '',
	'icon'  => '',
	'icon_size'  => '',
	'icon_color'  => '',
), $atts ) );
extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets  = '';
$style    = '';

if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}

if ( ! empty( $google_fonts_data ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

$output .= '<div class="' . esc_attr( $css_class ) . '" >';

if ( ! empty( $styles ) ) {
	$style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
}

if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$text = '<a href="' . esc_attr( $link['url'] ) . '"'
		. ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
		. ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
		. '>' . $text . '</a>';
}

$output .= '<' . esc_attr( $font_container_data['values']['tag'] ) . ' ' . $style . ' class="' . esc_attr( $type ) . '" >';

if ( $type == 'icon_bottom' ) {
	if ( $icon_color ) {
		$icon_style['color'] = 'color: ' . esc_attr( $icon_color ) . ';';
	} else {
		$icon_style['color'] = 'color: #ced2da;';
	}
	$icon_style['size'] = 'font-size: ' . esc_attr( $icon_size ) . 'px;';
	$output .= '<span>';
	$output .= esc_html( $text );
	$output .= '<br/><i style="' . esc_attr( implode( ' ', $icon_style ) ) . '" class="' . esc_attr( $icon ) . '"></i>';
	$output .= '</span>';

} else {
	$output .= $text;
}

$output .= '</' . esc_attr( $font_container_data['values']['tag'] ) . '>';
$output .= '</div>';

echo $output;