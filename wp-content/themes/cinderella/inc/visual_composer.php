<?php

if( function_exists( 'vc_set_default_editor_post_types' ) ){
	vc_set_default_editor_post_types( array( 'page', 'post', 'sidebar', 'vacancy', 'service' ) );
}

add_action( 'vc_before_init', 'stm_vc_set_as_theme' );

function stm_vc_set_as_theme() {
	vc_set_as_theme( true );
}

if ( is_admin() ) {
	if ( ! function_exists( 'stm_vc_remove_teaser_metabox' ) ) {
		function stm_vc_remove_teaser_metabox() {
			$post_types = get_post_types( '', 'names' );
			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'vc_teaser', $post_type, 'side' );
			}
		}
		add_action( 'do_meta_boxes', 'stm_vc_remove_teaser_metabox' );
	}
}

if( function_exists( 'vc_add_shortcode_param' ) ){
	vc_add_shortcode_param('stm_animator', 'stm_animator_param' );
}

function stm_animator_param( $settings, $value ){
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$class = isset($settings['class']) ? $settings['class'] : '';
	$animations = json_decode( file_get_contents( get_template_directory() . '/assets/js/animate-config.json' ), true );
	if( $animations ){
		$output = '<select name="'.$param_name.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '">';
		foreach ( $animations as $key => $val ) {
			if ( is_array( $val ) ) {
				$labels = str_replace( '_', ' ', $key );
				$output .= '<optgroup label="' . ucwords( __( $labels, 'cinderella' ) ) . '">';
				foreach ( $val as $label => $style ) {
					$label = str_replace( '_', ' ', $label );
					if ( $label == $value ) {
						$output .= '<option selected value="' . $label . '">' . __( $label, 'cinderella' ) . '</option>';
					} else {
						$output .= '<option value="' . $label . '">' . __( $label, 'cinderella' ) . '</option>';
					}
				}
			} else {
				if ( $key == $value ) {
					$output .= "<option selected value=" . $key . ">" . __( $key, 'cinderella' ) . "</option>";
				} else {
					$output .= "<option value=" . $key . ">" . __( $key, 'cinderella' ) . "</option>";
				}
			}
		}

		$output .= '</select>';
	}
	return $output;
}

add_action( 'admin_init', 'stm_update_existing_shortcodes' );

function stm_update_existing_shortcodes(){

	if ( function_exists( 'vc_add_params' ) ) {

		vc_add_params( 'vc_custom_heading', array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Type', 'cinderella' ),
				'param_name' => 'type',
				'value' => array(
					__( 'Default', 'cinderella' ) => 'default',
					__( 'Icon Bottom', 'cinderella' ) => 'icon_bottom',
					__( 'Theme Style', 'cinderella' ) => 'theme_style',
				),
				'weight' => 1
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'cinderella' ),
				'param_name' 		=> 'icon',
				'value'				=> 'stm-icon-flower',
				'weight'            => 1,
				'dependency' => array(
					'element' => 'type',
					'value' => array( 'icon_bottom' )
				)
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Size', 'cinderella' ),
				'param_name' 		=> 'icon_size',
				'value'				=> '16',
				'description'       => __( 'Enter icon size in px', 'cinderella' ),
				'weight'            => 1,
				'dependency' => array(
					'element' => 'type',
					'value' => array( 'icon_bottom' )
				)
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Icon Color', 'cinderella' ),
				'param_name' => 'icon_color',
				'weight' => 1,
				'dependency' => array(
					'element' => 'type',
					'value' => array( 'icon_bottom' )
				)
			),
		) );

		vc_add_params( 'vc_row', array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Background Position', 'cinderella' ),
				'param_name' => 'bg_position',
				'group' => __( 'Design Options', 'cinderella' )
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Background Size', 'cinderella' ),
				'param_name' => 'bg_size',
				'group' => __( 'Design Options', 'cinderella' )
			)
		) );

		vc_add_params( 'vc_progress_bar', array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Style', 'cinderella' ),
				'param_name' => 'progress_bar_style',
				'value' => array(
					__( 'Style 1', 'cinderella' ) => '',
					__( 'Style 2', 'cinderella' ) => 'style_2',
				),
				'weight' => 1
			),
		) );

		vc_add_params( 'vc_separator', array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'cinderella' )
			),
		) );

	}

}

if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'vc_stm_elements' );
}

function vc_stm_elements(){

	vc_map( array(
		'name'        => __( 'Icon Box', 'cinderella' ),
		'base'        => 'stm_icon_box',
		'icon'        => 'stm_icon_box',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Title', 'cinderella' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link', 'cinderella' ),
				'param_name' => 'link'
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'cinderella' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Style', 'cinderella' ),
				'param_name' 		=> 'style',
				'value'				=> array(
					__( 'Icon Top', 'cinderella' ) => 'icon_top',
					__( 'Icon Left', 'cinderella' ) => 'icon_left'
				)
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Size', 'cinderella' ),
				'param_name' 		=> 'icon_size',
				'value'				=> '49',
				'description'       => __( 'Enter icon size in px', 'cinderella' )
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Height', 'cinderella' ),
				'param_name' 		=> 'icon_height',
				'value'				=> '65',
				'description'       => __( 'Enter icon height in px', 'cinderella' ),
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'icon_top' )
				)
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Width', 'cinderella' ),
				'param_name' 		=> 'icon_width',
				'value'				=> '50',
				'description'       => __( 'Enter icon width in px', 'cinderella' ),
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'icon_left' )
				)
			),
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Text', 'cinderella' ),
				'param_name' => 'content'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Image Carousel', 'cinderella' ),
		'base'        => 'stm_image_carousel',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'attach_images',
				'heading' => __( 'Images', 'cinderella' ),
				'param_name' => 'images',
				'value' => '',
				'description' => __( 'Select images from media library.', 'cinderella' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image size', 'cinderella' ),
				'param_name' => 'img_size',
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "image_carousel" size.', 'cinderella' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Slides per view', 'cinderella' ),
				'param_name' => 'slides_per_view',
				'value' => '4',
				'description' => __( 'Enter number of slides to display at the same time.', 'cinderella' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'cinderella' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'cinderella' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Services With Tabs', 'cinderella' ),
		'base'        => 'stm_services_tabs',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'cinderella' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'cinderella' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Testimonials', 'cinderella' ),
		'base'        => 'stm_testimonials',
		'icon'        => 'stm_testimonials',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Count', 'cinderella' ),
				'param_name' => 'count',
				'value' => 1
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Posts', 'cinderella' ),
		'base'        => 'stm_posts',
		'icon'        => 'stm_posts',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				"type"        => "loop",
				"heading"     => __( "Content", 'cinderella' ),
				"param_name"  => "loop",
				'settings'    => array(
					'size'      => array( 'hidden' => false, 'value' => 3 ),
					'order_by'  => array( 'value' => 'date' ),
					'post_type' => array( 'value' => 'post' )
				),
				"description" => __( "Create WordPress loop.", 'cinderella' )
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Posts in a row', 'cinderella' ),
				'param_name' 		=> 'posts_in_row',
				'value'				=> array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4
				)
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Promo Block', 'cinderella' ),
		'base'        => 'stm_promo',
		'icon'        => 'stm_promo',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'cinderella' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link', 'cinderella' ),
				'param_name' => 'link'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Description', 'cinderella' ),
				'param_name' => 'description'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Height (px)', 'cinderella' ),
				'param_name' => 'height'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Bookly', 'cinderella' ),
		'base'        => 'stm_bookly',
		'icon'        => 'stm_bookly',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Icon Button', 'cinderella' ),
		'base'        => 'stm_icon_button',
		'icon'        => 'stm_icon_button',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link', 'cinderella' ),
				'param_name' => 'link'
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Sub Text', 'cinderella' ),
				'param_name' 		=> 'sub_text',
				'value'				=> ''
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'cinderella' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Style', 'cinderella' ),
				'param_name' => 'style',
				'value' => array(
					__( 'Flat', 'cinderella' ) => 'flat',
					__( 'Outline', 'cinderella' ) => 'outline'
				)
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Size', 'cinderella' ),
				'param_name' 		=> 'icon_size',
				'value'				=> '19',
				'description'       => __( 'Enter icon size in px', 'cinderella' )
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Height', 'cinderella' ),
				'param_name' 		=> 'icon_height',
				'value'				=> '29',
				'description'       => __( 'Enter icon height in px', 'cinderella' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Pricing Tables', 'cinderella' ),
		'base'        => 'stm_pricing_tables',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Title', 'cinderella' ),
				'param_name' => 'title'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Prefix', 'cinderella' ),
				'param_name' => 'price_prefix'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Price', 'cinderella' ),
				'param_name' => 'price'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Separator', 'cinderella' ),
				'param_name' => 'price_separator'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Postfix', 'cinderella' ),
				'param_name' => 'price_postfix'
			),
			array(
				'type'       => 'vc_link',
				'heading'    => __( 'Button', 'cinderella' ),
				'param_name' => 'button'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Label State', 'cinderella' ),
				'param_name' => 'label_state',
				'value'      => array(
					__( 'Enable', 'cinderella' ) => 'enable'
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Label Text', 'cinderella' ),
				'param_name' => 'label_text'
			),
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Text', 'cinderella' ),
				'param_name' => 'content'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name' => 'STM ' . __( 'Pages', 'cinderella' ),
		'base' => 'stm_pages',
		'icon' => 'icon-wpb-wp',
		'category' => __( 'STM Widgets', 'cinderella' ),
		'class' => 'wpb_vc_stm_widget',
		'weight' => - 50,
		'description' => __( 'Your sites WordPress Pages', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Order by', 'js_composer' ),
				'param_name' => 'sortby',
				'value' => array(
					__( 'Page title', 'js_composer' ) => 'post_title',
					__( 'Page order', 'js_composer' ) => 'menu_order',
					__( 'Page ID', 'js_composer' ) => 'ID'
				),
				'description' => __( 'Select how to sort pages.', 'js_composer' ),
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Include', 'cinderella' ),
				'param_name' => 'include',
				'description' => __( 'Enter page IDs to be excluded (Note: separate values by commas (,)).', 'js_composer' ),
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Contacts', 'cinderella' ),
		'base'        => 'stm_contacts_widget',
		'icon'        => 'icon-wpb-wp',
		'category'    => __( 'STM Widgets', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Title', 'cinderella' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Address', 'cinderella' ),
				'param_name' => 'address'
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Phone', 'cinderella' ),
				'param_name' => 'phone'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Fax', 'cinderella' ),
				'param_name' => 'fax'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Email', 'cinderella' ),
				'param_name' => 'email'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'cinderella' )
			)
		)
	) );

	$stm_sidebars_array = get_posts( array( 'post_type' => 'sidebar', 'posts_per_page' => -1 ) );
	$stm_sidebars = array( __( 'Select', 'cinderella' ) => 0 );
	if( $stm_sidebars_array ){
		foreach( $stm_sidebars_array as $val ){
			$stm_sidebars[ get_the_title( $val ) ] = $val->ID;
		}
	}

	vc_map( array(
		'name'        => __( 'STM Sidebar', 'cinderella' ),
		'base'        => 'stm_sidebar',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Sidebar', 'cinderella' ),
				'param_name' => 'sidebar',
				'value'      => $stm_sidebars
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Vacancies', 'cinderella' ),
		'base'        => 'stm_vacancies',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Vacancy Details', 'cinderella' ),
		'base'        => 'stm_vacancy_details',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Company History', 'cinderella' ),
		'base'        => 'stm_company_history',
		'as_parent'   => array('only' => 'stm_company_history_item'),
		'show_settings_on_create' => false,
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'cinderella' ),
				'param_name' => 'title'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'cinderella' )
			)
		),
		'js_view' => 'VcColumnView'
	) );

	vc_map( array(
		'name'        => __( 'Item', 'cinderella' ),
		'base'        => 'stm_company_history_item',
		'as_child' => array('only' => 'stm_company_history'),
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Year', 'cinderella' ),
				'param_name' => 'year'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'cinderella' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Description', 'cinderella' ),
				'param_name' => 'description'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Our Partners', 'cinderella' ),
		'base'        => 'stm_partners',
		'as_parent'   => array('only' => 'stm_partners_item'),
		'show_settings_on_create' => false,
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css'
			)
		),
		'js_view' => 'VcColumnView'
	) );

	vc_map( array(
		'name'        => __( 'Item', 'cinderella' ),
		'base'        => 'stm_partners_item',
		'as_child' => array('only' => 'stm_partners'),
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'cinderella' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Logo', 'cinderella' ),
				'param_name' => 'logo'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'cinderella' ),
				'param_name' => 'img_size',
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.', 'cinderella' )
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Description', 'cinderella' ),
				'param_name' => 'description'
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link', 'cinderella' ),
				'param_name' => 'link'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Staff', 'cinderella' ),
		'base'        => 'stm_staff',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Name', 'cinderella' ),
				'param_name' => 'name'
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Staff Image', 'cinderella' ),
				'param_name' => 'image'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'cinderella' ),
				'param_name' => 'image_size',
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "staff_image" size.', 'cinderella' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Job Title', 'cinderella' ),
				'param_name' => 'job'
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Description', 'cinderella' ),
				'param_name' => 'description'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Style', 'cinderella' ),
				'param_name' => 'style',
				'value' => array(
					__( 'Style 1', 'cinderella' ) => 'style_1',
					__( 'Style 2', 'cinderella' ) => 'style_2'
				)
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Facebook', 'cinderella' ),
				'param_name' => 'facebook',
				'group'      => __( 'Socials', 'cinderella' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Twitter', 'cinderella' ),
				'param_name' => 'twitter',
				'group'      => __( 'Socials', 'cinderella' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Linkedin', 'cinderella' ),
				'param_name' => 'linkedin',
				'group'      => __( 'Socials', 'cinderella' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Post Info', 'cinderella' ),
		'base'        => 'stm_post_info',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Post Tags', 'cinderella' ),
		'base'        => 'stm_post_tags',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Share', 'cinderella' ),
		'base'        => 'stm_share',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Title', 'cinderella' ),
				'param_name' => 'title'
			),
			array(
				'type'       => 'textarea_raw_html',
				'heading'    => __( 'Code', 'cinderella' ),
				'param_name' => 'code',
				'value'      => "<span class='st_facebook_large' displayText=''></span>
<span class='st_twitter_large' displayText=''></span>
<span class='st_googleplus_large' displayText=''></span>
<span class='st_sharethis_large' displayText=''></span>"
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Post Author Box', 'cinderella' ),
		'base'        => 'stm_post_author_box',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Post Comments', 'cinderella' ),
		'base'        => 'stm_post_comments',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'STM Gallery', 'cinderella' ),
		'base'        => 'stm_gallery',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type' => 'attach_images',
				'heading' => __( 'Images', 'cinderella' ),
				'param_name' => 'images'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'cinderella' )
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Contact', 'cinderella' ),
		'base'        => 'stm_contact',
		'category'    => __( 'STM', 'cinderella' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Name', 'cinderella' ),
				'param_name' => 'name'
			),
			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Image', 'cinderella' ),
				'param_name' => 'image'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'cinderella' ),
				'param_name' => 'image_size',
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.', 'cinderella' )
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Phone', 'cinderella' ),
				'param_name' => 'phone'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Email', 'cinderella' ),
				'param_name' => 'email'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Skype', 'cinderella' ),
				'param_name' => 'skype'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'cinderella' )
			)
		)
	) );



	vc_map( array(
		'name' => __( 'STM Pricing - Anchor', 'cinderella' ),
		'base' => 'stm_pricing_anchor',
		'category' => __( 'STM', 'cinderella' ),
		'params' => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'cinderella' ),
				'param_name' => 'css'
			)
		)
	) );


}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Stm_Company_History extends WPBakeryShortCodesContainer {
	}
	class WPBakeryShortCode_Stm_Partners extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Stm_Icon_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Image_Carousel extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Services_Tabs extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Testimonials extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Posts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Promo extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Bookly extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Icon_Button extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Pricing_Tables extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Pages extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Contacts_Widget extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Vacancies extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Vacancy_Details extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Company_History_Item extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Partners_Item extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Staff extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Info extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Tags extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Share extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Author_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Comments extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Gallery extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Contact extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Pricing_Anchor extends WPBakeryShortCode {
	}
}

add_filter( 'vc_iconpicker-type-fontawesome', 'vc_stm_icons' );

function vc_stm_icons( $fonts ){

	$icons = json_decode( file_get_contents( get_template_directory() . '/assets/js/selection.json' ), true );

	foreach( $icons['icons'] as $icon ){
		$fonts['Cinderella Icons'][] = array(
			"stm-icon-".$icon['properties']['name'] => 'STM ' . $icon['properties']['name']
		);
	}

	return $fonts;
}