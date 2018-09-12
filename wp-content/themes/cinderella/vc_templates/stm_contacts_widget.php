<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( isset( $atts['address'] ) ) {
	$atts['address'] = strip_tags( $atts['address'] );
}
if ( isset( $atts['phone'] ) ) {
	$atts['phone'] = strip_tags( $atts['phone'] );
}
if ( isset( $atts['fax'] ) ) {
	$atts['fax'] = strip_tags( $atts['fax'] );
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$type      = 'Stm_Contacts_Widget';
$args      = array(
	'before_widget' => '<aside class="widget widget_contacts wpb_content_element vc_widgets' . esc_attr( $css_class ) . '">',
	'after_widget'  => '</aside>',
	'before_title'  => '<div class="widget_title"><h4>',
	'after_title'   => '</h4></div>'
);
?>

<?php the_widget( $type, $atts, $args ); ?>