<?php

/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 *
 * For a more extensive sample-config file, you may look at:
 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
 *
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "stm_option";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	'opt_name'              => 'stm_option',
	'display_name'          => $theme->get( 'Name' ),
	'display_version'       => 'v.' . $theme->get( 'Version' ),
	'page_title'            => __( 'Theme Options', 'cinderella' ),
	'menu_title'            => __( 'Theme Options', 'cinderella' ),
	'update_notice'         => false,
	'system_info'           => false,
	'admin_bar'             => true,
	'use_cdn'               => true,
	'dev_mode'              => false,
	'menu_icon'             => 'dashicons-hammer',
	'menu_type'             => 'menu',
	'allow_sub_menu'        => true,
	'page_parent_post_type' => '',
	'default_mark'          => '',
	'hints'                 => array(
		'icon_position' => 'right',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color' => 'light',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'duration' => '500',
				'event'    => 'mouseleave unfocus',
			),
		),
	),
	'output'                => true,
	'output_tag'            => true,
	'compiler'              => true,
	'page_permissions'      => 'manage_options',
	'save_defaults'         => true,
	'database'              => 'options',
	'transient_time'        => '3600',
	'show_import_export'    => true,
	'network_sites'         => true
);

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

Redux::setSection( $opt_name, array(
	'title'   => __( 'General', 'cinderella' ),
	'desc'    => '',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'logo',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Site Logo', 'cinderella' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/logo_default.png' ),
			'subtitle' => __( 'Upload your logo file here.', 'cinderella' ),
		),
		array(
			'id'       => 'logo_transparent',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'White-text Logo', 'cinderella' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/logo_white.png' ),
			'subtitle' => __( 'Upload it here if you choose our transparent header options', 'cinderella' ),
		),
		array(
			'id'             => 'logo_margin',
			'type'           => 'spacing',
			'output'         => array('.logo'),
			'mode'           => 'margin',
			'units'          => array('px'),
			'units_extended' => 'false',
			'title'          => __('Logo Margin', 'cinderella'),
			'subtitle'       => '',
			'desc'           => __('Set your logo margin in px. Just use the number', 'cinderella'),
			'default'        => array(
				'units'          => 'px',
			)

		),
		array(
			'id'      => 'logo_dimensions',
			'type'    => 'dimensions',
			'title'   => __( 'Logo Dimensions (px)', 'cinderella' ),
			'output'  => array( '.logo img' ),
			'units'   => 'px',
			'default'  => array(
				'width'   => '267',
				'height'  => '52'
			),
		),
		array(
			'id'       => 'favicon',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Site Favicon', 'cinderella' ),
			'default'  => '',
			'subtitle' => __( 'Upload a 16px x 16px .png or .gif image here', 'cinderella' ),
		),
		array(
			'id'    => 'make_an_appointment',
			'type'  => 'select',
			'data'  => 'pages',
			'title' => __( 'Make an appointment button', 'cinderella' )
		),
		array(
			'id'    => 'make_an_appointment_text',
			'type'  => 'text',
			'title' => __( 'Make an appointment button', 'cinderella' ),
			'default' => __( 'Book an appointment', 'cinderella' )
		),
		array(
			'id'       => 'site_boxed',
			'type'     => 'switch',
			'title'    => __('Boxed Version', 'cinderella'),
			'default'  => false,
		),
		array(
			'id'       => 'boxed_background_image_type',
			'type'     => 'button_set',
			'title'    => __( 'Background Image Type', 'cinderella' ),
			'options'  => array(
				'boxed_bg_image_default'     => __( 'Default', 'cinderella' ),
				'boxed_bg_image_custom'        => __( 'Custom', 'cinderella' )
			),
			'default'  => 'boxed_bg_image_default',
			'required' => array( 'site_boxed', '=', true, ),
		),
		array(
			'id'       => 'boxed_background_image',
			'type'     => 'image_select',
			'title'    => __('Background Image', 'cinderella'),
			'tiles'    => true,
			'options'  => array(
				get_template_directory_uri() . '/assets/images/bg/img_1.jpg'      => array(
					'img'   => get_template_directory_uri() . '/assets/images/bg/img_1.jpg'
				),
				get_template_directory_uri() . '/assets/images/bg/img_2.jpg'      => array(
					'img'   => get_template_directory_uri() . '/assets/images/bg/img_2.jpg'
				),
				get_template_directory_uri() . '/assets/images/bg/img_3.jpg'      => array(
					'img'   => get_template_directory_uri() . '/assets/images/bg/img_3.jpg'
				),
				get_template_directory_uri() . '/assets/images/bg/img_4.jpg'      => array(
					'img'   => get_template_directory_uri() . '/assets/images/bg/img_4.jpg'
				)
			),
			'default'  => get_template_directory_uri() . '/assets/images/bg/img_1.jpg',
			'required' => array(
				array( 'boxed_background_image_type', '=', 'boxed_bg_image_default' ),
				array( 'site_boxed', '=', true, )
			),
			'output'   => array(
				'background-image' => 'body'
			)
		),
		array(
			'id'       => 'boxed_background_custom_image',
			'type'     => 'background',
			'title'    => __('Custom Background', 'cinderella'),
			'required' => array(
				array( 'boxed_background_image_type', '=', 'boxed_bg_image_custom', ),
				array( 'site_boxed', '=', true, )
			),
			'output'   => array(
				'background-image' => 'body'
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Header', 'cinderella' ),
	'desc'    => '',
	'icon'    => 'el-icon-file',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'header_style',
			'type'     => 'button_set',
			'title'    => __( 'Header Style Options', 'cinderella' ),
			'subtitle' => __( 'Select your header style option', 'cinderella' ),
			'options'  => array(
				'header_style_default'     => __( 'Default', 'cinderella' ),
				'header_style_transparent' => __( 'Transparent', 'cinderella' )
			),
			'default'  => 'header_style_default'
		),
		array(
			'id'      => 'sticky_header',
			'type'    => 'switch',
			'title'   => __( 'Enable fixed header on scroll.', 'cinderella' ),
			'default' => false
		),
		array(
			'id'      => 'header_wpml',
			'type'    => 'switch',
			'title'   => __( 'Enable Header WPML Switcher', 'cinderella' ),
			'default' => false
		),
		array(
			'id'      => 'header_social',
			'type'    => 'switch',
			'title'   => __( 'Enable header social media icons', 'cinderella' ),
			'default' => true
		),
		array(
			'id'       => 'header_use_social',
			'type'     => 'checkbox',
			'title'    => __( 'Select Social Media icons to display', 'cinderella' ),
			'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', 'cinderella' ),
			'required' => array( 'header_social', '=', true, ),
			'default'  => array(
				'facebook' => '1',
				'twitter' => '1',
				'instagram' => '1'
			),
			'options'  => array(
				'facebook'   => 'Facebook',
				'twitter'    => 'Twitter',
				'instagram'  => 'Instagram',
				'behance'    => 'Behance',
				'dribbble'   => 'Dribbble',
				'flickr'     => 'Flickr',
				'git'        => 'Git',
				'linkedin'   => 'Linkedin',
				'pinterest'  => 'Pinterest',
				'yahoo'      => 'Yahoo',
				'delicious'  => 'Delicious',
				'dropbox'    => 'Dropbox',
				'reddit'     => 'Reddit',
				'soundcloud' => 'Soundcloud',
				'google'     => 'Google',
				'skype'      => 'Skype',
				'youtube'    => 'Youtube',
				'tumblr'     => 'Tumblr',
				'whatsapp'   => 'Whatsapp',
			),
		),
		array(
			'id'      => 'header_address',
			'type'    => 'textarea',
			'title'   => __( 'Address', 'cinderella' ),
			'default' => __( "8008 Zurich, Switzerland\nZollikerstrasse 82", 'cinderella' ),
		),
		array(
			'id'      => 'header_address_icon',
			'type'    => 'button_set',
			'title'   => __( 'Address Icon', 'cinderella' ),
			'options' => array(
				'stm-icon-map'  => __( 'Address', 'cinderella' ),
				'stm-icon-phone'  => __( 'Phone', 'cinderella' ),
				'stm-icon-clock' => __( 'Hours', 'cinderella' )
			),
			'default' => 'stm-icon-map'
		),
		array(
			'id'      => 'working_hours',
			'type'    => 'textarea',
			'title'   => __( 'Working Hours', 'cinderella' ),
			'default' => __( "Tuesday - Sunday 9.00 am - 7.00 pm\nSaturday & Monday Closed", 'cinderella' ),
		),
		array(
			'id'      => 'header_working_hours_icon',
			'type'    => 'button_set',
			'title'   => __( 'Working Hours Icon', 'cinderella' ),
			'options' => array(
				'stm-icon-map'  => __( 'Address', 'cinderella' ),
				'stm-icon-phone'  => __( 'Phone', 'cinderella' ),
				'stm-icon-clock' => __( 'Hours', 'cinderella' )
			),
			'default' => 'stm-icon-clock'
		),
		array(
			'id'      => 'header_phone',
			'type'    => 'text',
			'title'   => __( 'Phone number', 'cinderella' ),
			'default' => __( '555 222 53 42', 'cinderella' ),
		),
		array(
			'id'      => 'header_phone_label',
			'type'    => 'text',
			'title'   => __( 'Phone number Label', 'cinderella' ),
			'default' => __( 'Free call', 'cinderella' ),
		),
		array(
			'id'      => 'header_phone_icon',
			'type'    => 'button_set',
			'title'   => __( 'Phone number Icon', 'cinderella' ),
			'options' => array(
				'stm-icon-map'  => __( 'Address', 'cinderella' ),
				'stm-icon-phone'  => __( 'Phone', 'cinderella' ),
				'stm-icon-clock' => __( 'Hours', 'cinderella' )
			),
			'default' => 'stm-icon-phone'
		),
	)
) );

$top_bar_fields = array(
	array(
		'title'   => __( 'Enable Top Bar', 'cinderella' ),
		'id'      => 'top_bar',
		'type'    => 'switch',
		'default' => false
	),
	array(
		'id'      => 'top_bar_wpml',
		'type'    => 'switch',
		'title'   => __( 'Enable Top Bar WPML Switcher', 'cinderella' ),
		'default' => false
	),
	array(
		'id'      => 'top_bar_social',
		'type'    => 'switch',
		'title'   => __( 'Enable Top Bar Social Media icons', 'cinderella' ),
		'default' => true
	),
	array(
		'id'       => 'top_bar_use_social',
		'type'     => 'checkbox',
		'title'    => __( 'Select Social Media Icons to display', 'cinderella' ),
		'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', 'cinderella' ),
		'required' => array(
			array( 'top_bar_social', '=', true, )
		),
		'options'  => array(
			'facebook'   => 'Facebook',
			'twitter'    => 'Twitter',
			'instagram'  => 'Instagram',
			'behance'    => 'Behance',
			'dribbble'   => 'Dribbble',
			'flickr'     => 'Flickr',
			'git'        => 'Git',
			'linkedin'   => 'Linkedin',
			'pinterest'  => 'Pinterest',
			'yahoo'      => 'Yahoo',
			'delicious'  => 'Delicious',
			'dropbox'    => 'Dropbox',
			'reddit'     => 'Reddit',
			'soundcloud' => 'Soundcloud',
			'google'     => 'Google',
			'skype'      => 'Skype',
			'youtube'    => 'Youtube',
			'tumblr'     => 'Tumblr',
			'whatsapp'   => 'Whatsapp',
		),
	),
	array(
		'id'      => 'top_bar_info_1_section_start',
		'type'    => 'section',
		'title'   => __( 'Location 1', 'cinderella' ),
		'indent'  => true
	),
	array(
		'id'      => 'top_bar_info_1_office',
		'type'    => 'text',
		'title'   => __( 'Office (for dropdown options)', 'cinderella' ),
		'default' => __( 'New York Office', 'cinderella' ),
	),
	array(
		'id'      => 'top_bar_info_1_address',
		'type'    => 'text',
		'title'   => __( 'Address', 'cinderella' ),
		'default' => __( '1010 Moon ave, New York, NY US', 'cinderella' ),
	),
	array(
		'id'      => 'top_bar_info_1_address_icon',
		'type'    => 'button_set',
		'title'   => __( 'Address Icon', 'cinderella' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'cinderella' ),
			'fa-phone'  => __( 'Phone', 'cinderella' ),
			'fa-clock-o' => __( 'Hours', 'cinderella' )
		),
		'default' => 'fa-map-marker'
	),
	array(
		'id'      => 'top_bar_info_1_hours',
		'type'    => 'text',
		'title'   => __( 'Working Hours', 'cinderella' ),
		'default' => __( 'Mon - Sat 8.00 - 18.00', 'cinderella' ),
	),
	array(
		'id'      => 'top_bar_info_1_hours_icon',
		'type'    => 'button_set',
		'title'   => __( 'Hours Icon', 'cinderella' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'cinderella' ),
			'fa-phone'  => __( 'Phone', 'cinderella' ),
			'fa-clock-o' => __( 'Hours', 'cinderella' )
		),
		'default' => 'fa-clock-o'
	),
	array(
		'id'      => 'top_bar_info_1_phone',
		'type'    => 'text',
		'title'   => __( 'Phone number', 'cinderella' ),
		'default' => __( 'Call Free:  +1 212-226-3126', 'cinderella' ),
	),
	array(
		'id'      => 'top_bar_info_1_phone_icon',
		'type'    => 'button_set',
		'title'   => __( 'Phone Icon', 'cinderella' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'cinderella' ),
			'fa-phone'  => __( 'Phone', 'cinderella' ),
			'fa-clock-o' => __( 'Hours', 'cinderella' )
		),
		'default' => 'fa-phone'
	),
	array(
		'id'      => 'top_bar_info_1_section_end',
		'type'   => 'section',
		'indent' => false
	)
);

for($i=2; $i <= 10; $i++ ){
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_section_start',
		'type'    => 'section',
		'title'   => sprintf( __( 'Location %s', 'cinderella' ), $i ),
		'indent'  => true
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_office',
		'type'    => 'text',
		'title'   => __( 'Office (for dropdown options)', 'cinderella' )
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_address',
		'type'    => 'text',
		'title'   => __( 'Address', 'cinderella' )
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_address_icon',
		'type'    => 'button_set',
		'title'   => __( 'Address Icon', 'cinderella' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'cinderella' ),
			'fa-phone'  => __( 'Phone', 'cinderella' ),
			'fa-clock-o' => __( 'Hours', 'cinderella' )
		),
		'default' => 'fa-map-marker'
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_hours',
		'type'    => 'text',
		'title'   => __( 'Working Hours', 'cinderella' )
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_hours_icon',
		'type'    => 'button_set',
		'title'   => __( 'Hours Icon', 'cinderella' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'cinderella' ),
			'fa-phone'  => __( 'Phone', 'cinderella' ),
			'fa-clock-o' => __( 'Hours', 'cinderella' )
		),
		'default' => 'fa-clock-o'
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_phone',
		'type'    => 'text',
		'title'   => __( 'Phone number', 'cinderella' )
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_phone_icon',
		'type'    => 'button_set',
		'title'   => __( 'Phone Icon', 'cinderella' ),
		'options' => array(
			'fa-map-marker'  => __( 'Address', 'cinderella' ),
			'fa-phone'  => __( 'Phone', 'cinderella' ),
			'fa-clock-o' => __( 'Hours', 'cinderella' )
		),
		'default' => 'fa-phone'
	);
	$top_bar_fields[] = array(
		'id'      => 'top_bar_info_' . $i . '_section_end',
		'type'   => 'section',
		'indent' => false
	);
}

Redux::setSection( $opt_name, array(
	'title'   => __( 'Top Bar', 'cinderella' ),
	'desc'    => '',
	'icon'    => 'el el-website',
	'submenu' => true,
	'fields'  => $top_bar_fields
));

Redux::setSection( $opt_name, array(
	'title'   => __( 'Blog', 'cinderella' ),
	'desc'    => '',
	'icon'    => 'el-icon-pencil',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'blog_layout',
			'type'    => 'button_set',
			'options' => array(
				'grid' => __( 'Grid view', 'cinderella' ),
				'list' => __( 'List view', 'cinderella' )
			),
			'default' => 'grid',
			'title'   => __( 'Blog Layout', 'cinderella' )
		),
		array(
			'id'    => 'blog_sidebar',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'sidebar' ), 'posts_per_page' => - 1 ),
			'title' => __( 'Sidebar', 'cinderella' )
		),
		array(
			'id'      => 'blog_sidebar_position',
			'type'    => 'button_set',
			'title'   => __( 'Sidebar - Position', 'cinderella' ),
			'options' => array(
				'left'  => __( 'Left', 'cinderella' ),
				'none'  => __( 'No Sidebar', 'cinderella' ),
				'right' => __( 'Right', 'cinderella' )
			),
			'default' => 'right'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Styling', 'cinderella' ),
	'desc'    => '',
	'icon'    => 'el-icon-tint',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'color_skin',
			'type'    => 'button_set',
			'title'   => __( 'Color Skin', 'cinderella' ),
			'options' => array(
				''                  => __( 'Default', 'cinderella' ),
				'skin_beach'          => __( 'Beach', 'cinderella' ),
				'skin_provence'       => __( 'Provence', 'cinderella' ),
				'skin_yogurt'       => __( 'Yogurt', 'cinderella' ),
				'skin_custom_color' => __( 'Custom color', 'cinderella' )
			),
			'default' => ''
		),
		array(
			'id'       => 'site_color_1',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Color 1', 'cinderella' ),
			'default'  => '#c41d54',
			'required' => array( 'color_skin', '=', 'skin_custom_color' )
		),
		array(
			'id'       => 'site_color_2',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Color 2', 'cinderella' ),
			'default'  => '#0a2045',
			'required' => array( 'color_skin', '=', 'skin_custom_color' )
		),
		array(
			'id'       => 'site_color_3',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Color 3', 'cinderella' ),
			'default'  => '#d26659',
			'required' => array( 'color_skin', '=', 'skin_custom_color' )
		),
		array(
			'id'       => 'footer_bg',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Footer Background', 'cinderella' ),
			'default'  => '#0a2045',
			'output'   => array( 'background-color' => '
body #magic-line,
body .slick_carousel .slick_item:hover a:before,
body #footer
			' )
		),
		array(
			'id'       => 'footer_text_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Footer Text Color', 'cinderella' ),
			'default'  => '#9aacbd',
			'output'   => array( 'color' => '
body .copyright,
body .footer_socials a:hover,
body .copyright a,
body .widget_stm_schedule .stm_schedule_list .schedule_day,
body .footer_widgets_wrapper .widgets aside,
body .footer_widgets .widget_title h4,
body .widget_contacts .text,
body .widget_contacts .text a
			', 'border-left-color' => '
body .widget_stm_schedule_wr
			', 'border-right-color' => '
body .widget_stm_schedule_wr
			', 'border-bottom-color' => '
body .widget_stm_schedule_wr
			', 'background-color' => '
body .widget_stm_schedule .stm_schedule_title_separator span
			' )
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Shop', 'cinderella' ),
	'desc'    => '',
	'icon'    => 'el el-shopping-cart',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'    => 'products_per_page',
			'type'  => 'spinner',
			'default' => 8,
			'title' => __( 'Products per page', 'cinderella' )
		),
		array(
			'id'    => 'shop_sidebar',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'sidebar' ), 'posts_per_page' => - 1 ),
			'title' => __( 'Sidebar', 'cinderella' )
		),
		array(
			'id'      => 'shop_sidebar_position',
			'type'    => 'button_set',
			'title'   => __( 'Sidebar - Position', 'cinderella' ),
			'options' => array(
				'left'  => __( 'Left', 'cinderella' ),
				'none'  => __( 'No Sidebar', 'cinderella' ),
				'right' => __( 'Right', 'cinderella' )
			),
			'default' => 'none'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Typography', 'cinderella' ),
	'icon'    => 'el-icon-font',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'             => 'base_font_1',
			'type'           => 'typography',
			'title'          => __( 'Base Font 1', 'cinderella' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => false,
			'all_styles'     => true,
			'font-style'     => false,
			'text-align'     => false,
			'subsets'        => true,
			'font-size'      => false,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( '.woocommerce form.login h3,
.woocommerce form.register h3,
.woocommerce ul.products li.product h4,
.related.products h3,
.woocommerce table.shop_table .product-name .h4,
.woocommerce .cart-collaterals .cart_totals h4,
.woocommerce-page .cart-collaterals .cart_totals h4,
.woocommerce-billing-fields h3,
.woocommerce-shipping-fields h3,
#order_review_heading,
#order_payment_heading,
.icon_box h4,
.footer_widgets .widget_title h4,
.not_found_block h3,
.vc_tta.vc_general .vc_tta-panel-title,
.pricing-table_head h4,
.vc_widgets .widget_title h4,
.company_history h3,
.our_partners .text h4,
.stm_staff h4,
.stm_staff_2 h4,
.service_list h4,
.comments-title,
.comment-reply-title,
.primary_widgets .widget_title h4,
.gallery_grid .gallery h4,
.stm_contact_info h4,
.stm_pricing_list_block h3' ),
			'units'          => 'px',
			'default'        => array(
				'font-family' => 'Arimo'
			)
		),
		array(
			'id'             => 'base_font_2',
			'type'           => 'typography',
			'title'          => __( 'Base Font 2', 'cinderella' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => false,
			'all_styles'     => true,
			'font-style'     => false,
			'text-align'     => false,
			'subsets'        => true,
			'font-size'      => false,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( '.woocommerce span.onsale,
			.dropcarps_circle:first-letter,
			.dropcarps:first-letter,
			.pricing-table_label' ),
			'units'          => 'px',
			'default'        => array(
				'font-family' => 'Playfair Display'
			)
		),
		array(
			'id'             => 'font_body',
			'type'           => 'typography',
			'title'          => __( 'Body', 'cinderella' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => false,
			'all_styles'     => true,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'body' ),
			'units'          => 'px',
			'subtitle'       => __( 'Select custom font for your main body text.', 'cinderella' ),
			'default'        => array(
				'color'       => "#555555",
				'font-family' => 'Arimo',
				'font-size'   => '14px',
			)
		),
		array(
			'id'             => 'font_heading',
			'type'           => 'typography',
			'title'          => __( 'Heading', 'cinderella' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => false,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => false,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6' ),
			'units'          => 'px',
			'subtitle'       => __( 'Select custom font for headings', 'cinderella' ),
			'default'        => array(
				'color'       => "#333333",
				'font-family' => 'Playfair Display'
			)
		),
		array(
			'id'             => 'h1_params',
			'type'           => 'typography',
			'title'          => __( 'H1', 'cinderella' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h1,.h1' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '36px',
				'font-weight' => '400',
			)
		),
		array(
			'id'             => 'h2_params',
			'type'           => 'typography',
			'title'          => __( 'H2', 'cinderella' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h2,.h2' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '30px',
				'font-weight' => '400',
			)
		),
		array(
			'id'             => 'h3_params',
			'type'           => 'typography',
			'title'          => __( 'H3', 'cinderella' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h3,.h3' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '24px',
				'font-weight' => '400',
			)
		),
		array(
			'id'             => 'h4_params',
			'type'           => 'typography',
			'title'          => __( 'H4', 'cinderella' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h4,.h4' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '18px',
				'font-weight' => '700',
			)
		),
		array(
			'id'             => 'h5_params',
			'type'           => 'typography',
			'title'          => __( 'H5', 'cinderella' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h5,.h5' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '15px',
				'font-weight' => '700',
			)
		),
		array(
			'id'             => 'h6_params',
			'type'           => 'typography',
			'title'          => __( 'H6', 'cinderella' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h6,.h6' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '13px',
				'font-weight' => '700',
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Page Options', 'cinderella' ),
	'icon'    => 'el-icon-file-new',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'page_background_section_start',
			'type'    => 'section',
			'title'   => __( 'Page Background Default Settings', 'cinderella' ),
			'indent'  => true
		),
		array(
			'id'       => 'page_background_bg_image',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Background Image', 'cinderella' )
		),
		array(
			'id'       => 'page_background_bg_position',
			'type'     => 'text',
			'title'    => __( 'Background Position', 'cinderella' )
		),
		array(
			'id'       => 'page_background_bg_repeat',
			'type'     => 'button_set',
			'title'    => __( 'Background Repeat', 'cinderella' ),
			'default'  => 'no-repeat',
			'options'  => array(
				'repeat' => __( 'Repeat', 'cinderella' ),
				'no-repeat' => __( 'No Repeat', 'cinderella' ),
				'repeat-x' => __( 'Repeat-X', 'cinderella' ),
				'repeat-y' => __( 'Repeat-Y', 'cinderella' )
			)
		),
		array(
			'id'      => 'page_background_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'      => 'page_title_box_section_start',
			'type'    => 'section',
			'title'   => __( 'Title Box Default Settings', 'cinderella' ),
			'indent'  => true
		),
		array(
			'id'       => 'page_title_box_title',
			'type'     => 'button_set',
			'title'    => __( 'Title', 'cinderella' ),
			'default'  => 'show',
			'options'  => array(
				'show' => __( 'Show', 'cinderella' ),
				'hide' => __( 'Hide', 'cinderella' )
			),
		),
		array(
			'id'       => 'page_title_box_bg_color',
			'type'     => 'color',
			'compiler' => true,
			'default'  => '#0a1f44',
			'title'    => __( 'Background Color', 'cinderella' )
		),
		array(
			'id'       => 'page_title_box_font_color',
			'type'     => 'color',
			'compiler' => true,
			'default'  => '#ffffff',
			'title'    => __( 'Font Color', 'cinderella' )
		),
		array(
			'id'       => 'page_title_box_line_color',
			'type'     => 'color',
			'compiler' => true,
			'default'  => '#c41d54',
			'title'    => __( 'Line Color', 'cinderella' )
		),
		array(
			'id'       => 'page_title_box_bg_image',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Background Image', 'cinderella' )
		),
		array(
			'id'       => 'page_title_box_bg_size',
			'type'     => 'text',
			'title'    => __( 'Background Size', 'cinderella' )
		),
		array(
			'id'       => 'page_title_box_bg_position',
			'type'     => 'text',
			'title'    => __( 'Background Position', 'cinderella' )
		),
		array(
			'id'       => 'page_title_box_bg_repeat',
			'type'     => 'button_set',
			'title'    => __( 'Background Repeat', 'cinderella' ),
			'default'  => 'repeat',
			'options'  => array(
				'repeat' => __( 'Repeat', 'cinderella' ),
				'no-repeat' => __( 'No Repeat', 'cinderella' ),
				'repeat-x' => __( 'Repeat-X', 'cinderella' ),
				'repeat-y' => __( 'Repeat-Y', 'cinderella' )
			)
		),
		array(
			'id'      => 'page_title_box_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'      => 'page_breadcrumbs_section_start',
			'type'    => 'section',
			'title'   => __( 'Page Breadcrumbs Default Settings', 'cinderella' ),
			'indent'  => true
		),
		array(
			'id'       => 'page_breadcrumbs',
			'type'     => 'button_set',
			'title'    => __( 'Breadcrumbs', 'cinderella' ),
			'default'  => 'show',
			'options'  => array(
				'show' => __( 'Show', 'cinderella' ),
				'hide' => __( 'Hide', 'cinderella' )
			),
		),
		array(
			'id'       => 'page_breadcrumbs_color',
			'type'     => 'color',
			'compiler' => true,
			'default'  => '#ffffff',
			'title'    => __( 'Breadcrumbs Color', 'cinderella' )
		),
		array(
			'id'      => 'page_breadcrumbs_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'      => 'title_box_button_section_start',
			'type'    => 'section',
			'title'   => __( 'Title Box Button Default Settings', 'cinderella' ),
			'indent'  => true
		),
		array(
			'id'       => 'title_box_button_text',
			'type'     => 'text',
			'title'    => __( 'Button Text', 'cinderella' )
		),
		array(
			'id'       => 'title_box_button_url',
			'type'     => 'text',
			'title'    => __( 'Button URL', 'cinderella' )
		),
		array(
			'id'       => 'title_box_button_border_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Border Color', 'cinderella' ),
			'default' => '#ffffff'
		),
		array(
			'id'       => 'title_box_button_font_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Font Color', 'cinderella' ),
			'default' => '#d26659'
		),
		array(
			'id'       => 'title_box_button_font_color_hover',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Font Color (hover)', 'cinderella' ),
			'default' => '#d26659'
		),
		array(
			'id'       => 'title_box_button_arrow_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Arrow Color', 'cinderella' ),
			'default' => '#ffffff'
		),
		array(
			'id'      => 'title_box_button_section_end',
			'type'   => 'section',
			'indent' => false
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Footer', 'cinderella' ),
	'desc'    => '',
	'icon'    => 'el-icon-photo',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'footer_widgets',
			'type'    => 'switch',
			'title'   => __( 'Enable footer widgets area.', 'cinderella' ),
			'default' => true,
		),
		array(
			'id'       => 'footer_columns',
			'type'     => 'button_set',
			'title'    => __( 'Footer Columns', 'cinderella' ),
			'desc'     => __( 'Select the number of columns to display in the footer.', 'cinderella' ),
			'type'     => 'button_set',
			'default'  => '4',
			'required' => array( 'footer_widgets', '=', true, ),
			'options'  => array(
				'1' => __( '1 Columns', 'cinderella' ),
				'2' => __( '2 Columns', 'cinderella' ),
				'3' => __( '3 Columns', 'cinderella' ),
				'4' => __( '4 Columns', 'cinderella' ),
			),
		),
		array(
			'id'       => 'copyright',
			'type'     => 'textarea',
			'title'    => __( 'Footer Copyright', 'cinderella' ),
			'subtitle' => __( 'Enter the copyright text.', 'cinderella' ),
			'default'  => __( 'Copyright &copy; 2015 Cinderella Theme by <a target="_blank" href="http://www.stylemixthemes.com/">Stylemix Themes</a>', 'cinderella' )
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Social Media', 'cinderella' ),
	'icon'    => 'el-icon-address-book',
	'desc'    => __( 'Enter social media urls here and then you can enable them for footer or header. Please add full URLs including "http://".', 'cinderella' ),
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'facebook',
			'type'     => 'text',
			'title'    => __( 'Facebook', 'cinderella' ),
			'subtitle' => '',
			'default' => 'https://www.facebook.com/',
			'desc'     => __( 'Enter your Facebook URL.', 'cinderella' ),
		),
		array(
			'id'       => 'twitter',
			'type'     => 'text',
			'title'    => __( 'Twitter', 'cinderella' ),
			'subtitle' => '',
			'default' => 'https://www.twitter.com/',
			'desc'     => __( 'Enter your Twitter URL.', 'cinderella' ),
		),
		array(
			'id'       => 'instagram',
			'type'     => 'text',
			'title'    => __( 'Instagram', 'cinderella' ),
			'subtitle' => '',
			'default' => 'https://www.instagram.com/',
			'desc'     => __( 'Enter your Instagram URL.', 'cinderella' ),
		),
		array(
			'id'       => 'behance',
			'type'     => 'text',
			'title'    => __( 'Behance', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Behance URL.', 'cinderella' ),
		),
		array(
			'id'       => 'dribbble',
			'type'     => 'text',
			'title'    => __( 'Dribbble', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Dribbble URL.', 'cinderella' ),
		),
		array(
			'id'       => 'flickr',
			'type'     => 'text',
			'title'    => __( 'Flickr', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Flickr URL.', 'cinderella' ),
		),
		array(
			'id'       => 'git',
			'type'     => 'text',
			'title'    => __( 'Git', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Git URL.', 'cinderella' ),
		),
		array(
			'id'       => 'linkedin',
			'type'     => 'text',
			'title'    => __( 'Linkedin', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Linkedin URL.', 'cinderella' ),
		),
		array(
			'id'       => 'pinterest',
			'type'     => 'text',
			'title'    => __( 'Pinterest', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Pinterest URL.', 'cinderella' ),
		),
		array(
			'id'       => 'yahoo',
			'type'     => 'text',
			'title'    => __( 'Yahoo', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Yahoo URL.', 'cinderella' ),
		),
		array(
			'id'       => 'delicious',
			'type'     => 'text',
			'title'    => __( 'Delicious', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Delicious URL.', 'cinderella' ),
		),
		array(
			'id'       => 'dropbox',
			'type'     => 'text',
			'title'    => __( 'Dropbox', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Dropbox URL.', 'cinderella' ),
		),
		array(
			'id'       => 'reddit',
			'type'     => 'text',
			'title'    => __( 'Reddit', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Reddit URL.', 'cinderella' ),
		),
		array(
			'id'       => 'soundcloud',
			'type'     => 'text',
			'title'    => __( 'Soundcloud', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Soundcloud URL.', 'cinderella' ),
		),
		array(
			'id'       => 'google',
			'type'     => 'text',
			'title'    => __( 'Google', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Google URL.', 'cinderella' ),
		),
		array(
			'id'       => 'skype',
			'type'     => 'text',
			'title'    => __( 'Skype', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Skype URL.', 'cinderella' ),
		),
		array(
			'id'       => 'youtube',
			'type'     => 'text',
			'title'    => __( 'Youtube', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Youtube URL.', 'cinderella' ),
		),
		array(
			'id'       => 'tumblr',
			'type'     => 'text',
			'title'    => __( 'Tumblr', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Tumblr URL.', 'cinderella' ),
		),
		array(
			'id'       => 'whatsapp',
			'type'     => 'text',
			'title'    => __( 'Whatsapp', 'cinderella' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Whatsapp URL.', 'cinderella' ),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Custom CSS', 'cinderella' ),
	'icon'    => 'el-icon-css',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'site_css',
			'type'     => 'ace_editor',
			'title'    => __( 'CSS Code', 'cinderella' ),
			'subtitle' => __( 'Paste your custom CSS code here.', 'cinderella' ),
			'mode'     => 'css',
			'default'  => ""
		)
	)
));

Redux::setSection( $opt_name, array(
	'icon'       => 'el-refresh',
	'icon_class' => 'el-icon-large',
	'title'      => __('One Click Update', 'cinderella'),
	'desc'    => __( 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click and forget about manual updates!<br> If you have any troubles while using auto update ( It is likely to be a permissions issue ) then you may want to manually update the theme as normal.', 'cinderella' ),
	'submenu'    => true,
	'fields'     => array(
		array(
			'id'       =>'envato_username',
			'type'     => 'text',
			'title'    => __('ThemeForest Username', 'cinderella'),
			'subtitle' => '',
			'desc'     => __('Enter here your ThemeForest (or Envato) username account (i.e. Stylemixthemes).', 'cinderella'),
		),
		array(
			'id'       =>'envato_api',
			'type'     => 'text',
			'title'    => __('ThemeForest Secret API Key', 'cinderella'),
			'subtitle' => '',
			'desc'     => __('Enter here the secret api key you have created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', 'cinderella'),
		),
	)
));

/*
 * <--- END SECTIONS
 */

if ( ! function_exists( 'stm_option' ) ) {
	function stm_option( $id, $fallback = false, $key = false ) {
		global $stm_option;
		if ( $fallback == false ) {
			$fallback = '';
		}
		$output = ( isset( $stm_option[ $id ] ) && $stm_option[ $id ] !== '' ) ? $stm_option[ $id ] : $fallback;
		if ( ! empty( $stm_option[ $id ] ) && $key ) {
			$output = $stm_option[ $id ][ $key ];
		}

		return $output;
	}
}