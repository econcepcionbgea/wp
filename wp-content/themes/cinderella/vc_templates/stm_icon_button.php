<?php
extract( shortcode_atts( array(
	'icon'        => '',
	'style'       => '',
	'sub_text'    => '',
	'icon_size'   => '19',
	'icon_height' => '29',
	'link'        => '',
	'css'         => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$link      = vc_build_link( $link );
?>

<div class="icon_button<?php echo esc_attr( $css_class, true ); ?>">
	<?php
	if ( $link['url'] ) {
		if ( ! $link['target'] ) {
			$link['target'] = '_self';
		}
		echo '<a class="button ' . esc_attr( $style ) . '" target="' . esc_attr( $link['target'] ) . '" href="' . esc_url( $link['url'] ) . '">';
		echo '<i style="font-size: ' . esc_attr( $icon_size ) . 'px; line-height: ' . esc_attr( $icon_height ) . 'px; height: ' . esc_attr( $icon_height ) . 'px;" class="' . esc_attr( $icon ) . '"></i>';
		echo '<span>';
		echo esc_html( $link['title'] );
		if ( $sub_text ) {
			echo '<br/><em>' . esc_html( $sub_text ) . '</em>';
		}
		echo '</span>';
		echo '</a>';
	}
	?>
</div>