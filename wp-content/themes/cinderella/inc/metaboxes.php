<?php

function add_metaboxes(){
	STM_PostType::addMetaBox( 'page_options', __( 'Page Options', 'cinderella' ), array( 'page', 'post', 'vacancy', 'service' ), '', '', '', array(
		'fields' => array(
			'separator_page_header' => array(
				'label'   => __( 'Page Header', 'cinderella' ),
				'type'    => 'separator'
			),
			'header_transparent' => array(
				'label'   => __( 'Transparent Header', 'cinderella' ),
				'type'    => 'checkbox'
			),
			'separator_page_background' => array(
				'label'   => __( 'Page Background', 'cinderella' ),
				'type'    => 'separator'
			),
			'page_bg_color' => array(
				'label' => __( 'Background Color', 'cinderella' ),
				'type'  => 'color_picker'
			),
			'page_bg_image' => array(
				'label' => __( 'Background Image', 'cinderella' ),
				'type'  => 'image',
				'default' => stm_option( 'page_background_bg_image', false, 'id' )
			),
			'page_bg_position' => array(
				'label'   => __( 'Background Position', 'cinderella' ),
				'type'    => 'text',
				'default' => stm_option( 'page_background_bg_position' )
			),
			'page_bg_repeat' => array(
				'label'   => __( 'Background Repeat', 'cinderella' ),
				'type'    => 'select',
				'options' => array(
					'repeat' => __( 'Repeat', 'cinderella' ),
					'no-repeat' => __( 'No Repeat', 'cinderella' ),
					'repeat-x' => __( 'Repeat-X', 'cinderella' ),
					'repeat-y' => __( 'Repeat-Y', 'cinderella' )
				),
				'default' => stm_option( 'page_background_bg_repeat' )
			),
			'separator_title_box' => array(
				'label'   => __( 'Title Box', 'cinderella' ),
				'type'    => 'separator'
			),
			'title' => array(
				'label'   => __( 'Title', 'cinderella' ),
				'type'    => 'select',
				'options' => array(
					'show' => __( 'Show', 'cinderella' ),
					'hide' => __( 'Hide', 'cinderella' )
				),
				'default' => stm_option( 'page_title_box_title', 'show' )
			),
			'title_box_bg_color' => array(
				'label' => __( 'Background Color', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'page_title_box_bg_color' )
			),
			'title_box_font_color' => array(
				'label' => __( 'Font Color', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'page_title_box_font_color' )
			),
			'title_box_line_color' => array(
				'label' => __( 'Line Color', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'page_title_box_line_color' )
			),
			'title_box_custom_bg_image' => array(
				'label' => __( 'Custom Background Image', 'cinderella' ),
				'type'  => 'image',
				'default' => stm_option( 'page_title_box_bg_image', false, 'id' )
			),
			'title_box_bg_position' => array(
				'label'   => __( 'Background Position', 'cinderella' ),
				'type'    => 'text',
				'default' => stm_option( 'page_title_box_bg_position' )
			),
			'title_box_bg_size' => array(
				'label'   => __( 'Background Size', 'cinderella' ),
				'type'    => 'text',
				'default' => stm_option( 'page_title_box_bg_size' )
			),
			'title_box_bg_repeat' => array(
				'label'   => __( 'Background Repeat', 'cinderella' ),
				'type'    => 'select',
				'options' => array(
					'repeat' => __( 'Repeat', 'cinderella' ),
					'no-repeat' => __( 'No Repeat', 'cinderella' ),
					'repeat-x' => __( 'Repeat-X', 'cinderella' ),
					'repeat-y' => __( 'Repeat-Y', 'cinderella' )
				),
				'default' => stm_option( 'page_title_box_bg_repeat' )
			),
			'separator_breadcrumbs' => array(
				'label'   => __( 'Breadcrumbs', 'cinderella' ),
				'type'    => 'separator'
			),
			'breadcrumbs' => array(
				'label'   => __( 'Breadcrumbs', 'cinderella' ),
				'type'    => 'select',
				'options' => array(
					'show' => __( 'Show', 'cinderella' ),
					'hide' => __( 'Hide', 'cinderella' )
				),
				'default' => stm_option( 'page_breadcrumbs' )
			),
			'breadcrumbs_font_color' => array(
				'label' => __( 'Breadcrumbs Color', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'page_breadcrumbs_color' )
			),
			'separator_title_box_button' => array(
				'label'   => __( 'Title Box Button', 'cinderella' ),
				'type'    => 'separator'
			),
			'title_box_button_text' => array(
				'label'   => __( 'Button Text', 'cinderella' ),
				'type'    => 'text',
				'default' => stm_option( 'title_box_button_text' )
			),
			'title_box_button_url' => array(
				'label'   => __( 'Button URL', 'cinderella' ),
				'type'    => 'text',
				'default' => stm_option( 'title_box_button_url' )
			),
			'title_box_button_border_color' => array(
				'label' => __( 'Border Color', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'title_box_button_border_color' )
			),
			'title_box_button_font_color' => array(
				'label' => __( 'Font Color', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'title_box_button_font_color' )
			),
			'title_box_button_font_color_hover' => array(
				'label' => __( 'Font Color (hover)', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'title_box_button_font_color_hover' )
			),
			'title_box_button_font_arrow_color' => array(
				'label' => __( 'Arrow Color', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'title_box_button_arrow_color' )
			),
			'prev_next_buttons' => array(
				'label'   => __( 'Enable', 'cinderella' ),
				'type'    => 'checkbox',
				'default' => stm_option( 'prev_next_buttons', false, 'enable' )
			),
			'prev_next_buttons_border_color' => array(
				'label' => __( 'Border Color', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'prev_next_buttons_border_color' )
			),
			'prev_next_buttons_arrow_color_hover' => array(
				'label' => __( 'Arrow Color (hover)', 'cinderella' ),
				'type'  => 'color_picker',
				'default' => stm_option( 'prev_next_buttons_border_color_hover' )
			)
		)
	) );

	STM_PostType::addMetaBox( 'service_options', __( 'Options', 'cinderella' ), array( 'service' ), '', '', '', array(
		'fields' => array(
			'cost' => array(
				'label' => __( 'Cost', 'cinderella' ),
				'type'  => 'text'
			),
			'sticky_text' => array(
				'label' => __( 'Sticky Text', 'cinderella' ),
				'type'  => 'text'
			)
		)
	) );

	STM_PostType::addMetaBox( 'vacancy_info', __( 'Options', 'cinderella' ), array( 'vacancy' ), '', '', '', array(
		'fields' => array(
			'vacancy_location'   => array(
				'label' => __( 'Location', 'cinderella' ),
				'type'  => 'text'
			),
			'vacancy_department'   => array(
				'label' => __( 'Department', 'cinderella' ),
				'type'  => 'text'
			),
			'vacancy_job_type'   => array(
				'label' => __( 'Job Type', 'cinderella' ),
				'type'  => 'text'
			),
			'vacancy_education'   => array(
				'label' => __( 'Education', 'cinderella' ),
				'type'  => 'text'
			),
			'vacancy_compensation'   => array(
				'label' => __( 'Compensation', 'cinderella' ),
				'type'  => 'text'
			)
		)
	) );

}

if( class_exists( 'STM_PostType' ) ){
	add_action( 'admin_init', 'add_metaboxes' );
}