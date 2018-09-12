<?php
$output = $title = $el_class = $sortby = $exclude = $css = '';
extract( shortcode_atts( array(
	'title'    => '',
	'sortby'   => 'menu_order',
	'include'  => null,
	'el_class' => '',
	'css'      => ''
), $atts ) );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$type = 'STM_Widget_Pages';
$args = array(
	'before_widget' => '<aside class="widget widget_pages wpb_content_element vc_widgets' . esc_attr( $css_class ) . ' ' . esc_attr( $el_class ) . '">',
	'after_widget'  => '</aside>',
	'before_title'  => '<div class="widget_title"><h5>',
	'after_title'   => '</h5></div>'
);

the_widget( $type, $atts, $args );