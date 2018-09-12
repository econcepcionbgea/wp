<?php

require_once dirname( __FILE__ ) . '/tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'stm_require_plugins' );

function stm_require_plugins() {
	$plugins_path = get_template_directory() . '/inc/tgm/plugins';
	$plugins = array(
		array(
			'name'             => 'STM Post Type',
			'slug'             => 'stm-post-type',
			'source'           => $plugins_path . '/stm-post-type.zip',
			'required'         => true,
			'force_activation' => true,
			'version'		   => '2.2'
		),
		array(
			'name'         => 'WPBakery Visual Composer',
			'slug'         => 'js_composer',
			'source'       => $plugins_path . '/js_composer.zip',
			'required'     => true,
			'external_url' => 'http://vc.wpbakery.com',
			'version'	   => '5.4.7'
		),
		array(
			'name'         => 'Revolution Slider',
			'slug'         => 'revslider',
			'source'       => $plugins_path . '/revslider.zip',
			'required'     => false,
			'external_url' => 'http://www.themepunch.com/revolution/',
			'version'	   => '5.4.7.3'
		),
		array(
			'name'      => 'WooCommerce - excelling eCommerce',
			'slug'      => 'woocommerce',
			'required'  => false
		),
		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'required' => true
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => true
		),
		array(
			'name'      => 'Force Regenerate Thumbnails',
			'slug'      => 'force-regenerate-thumbnails',
			'required'  => false
		),
		array(
			'name'     => 'Bookly Lite',
			'slug'     => 'bookly-responsive-appointment-booking-tool',
			'required' => true
		),
		array(
			'name'      => 'TinyMCE Advanced',
			'slug'      => 'tinymce-advanced',
			'required'  => false
		)
	);

	tgmpa( $plugins, array( 'is_automatic' => true ) );

}