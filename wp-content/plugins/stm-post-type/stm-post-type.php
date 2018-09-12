<?php
/*
Plugin Name: STM Post Type
Plugin URI: http://stylemixthemes.com/
Description: STM Post Type
Author: Stylemix Themes
Author URI: http://stylemixthemes.com/
Text Domain: stm_post_type
Version: 2.2
*/

define( 'STM_POST_TYPE', 'stm_post_type' );
$plugin_path = dirname(__FILE__);

require_once $plugin_path . '/post_type.class.php';

$options = get_option('stm_post_types_options');

$defaultPostTypesOptions = array(
	'service' => array(
		'title' => __( 'Service', STM_POST_TYPE ),
		'plural_title' => __( 'Services', STM_POST_TYPE ),
		'rewrite' => 'service'
	),
	'testimonial' => array(
		'title' => __( 'Testimonial', STM_POST_TYPE ),
		'plural_title' => __( 'Testimonials', STM_POST_TYPE ),
		'rewrite' => 'testimonial'
	),
	'sidebar' => array(
		'title' => __( 'Sidebar', STM_POST_TYPE ),
		'plural_title' => __( 'Sidebars', STM_POST_TYPE ),
		'rewrite' => 'sidebar'
	),
	'vacancy' => array(
		'title' => __( 'Vacancy', STM_POST_TYPE ),
		'plural_title' => __( 'Vacancies', STM_POST_TYPE ),
		'rewrite' => 'vacancy'
	)
);

$stm_post_types_options = wp_parse_args( $options, $defaultPostTypesOptions );

STM_PostType::registerPostType( 'service', $stm_post_types_options['service']['title'], array( 'pluralTitle' => $stm_post_types_options['service']['plural_title'], 'menu_icon' => 'dashicons-clipboard', 'rewrite' => array( 'slug' => $stm_post_types_options['service']['rewrite'] ), 'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail' ) ) );
STM_PostType::addTaxonomy( 'service_category', __( 'Categories', STM_POST_TYPE ), 'service' );
STM_PostType::registerPostType( 'testimonial', $stm_post_types_options['testimonial']['title'], array( 'pluralTitle' => $stm_post_types_options['testimonial']['plural_title'], 'menu_icon' => 'dashicons-testimonial', 'rewrite' => array( 'slug' => $stm_post_types_options['testimonial']['rewrite'] ), 'supports' => array( 'title', 'thumbnail', 'excerpt' ), 'exclude_from_search' => true, 'publicly_queryable' => false ) );
STM_PostType::registerPostType( 'sidebar', $stm_post_types_options['sidebar']['title'], array( 'pluralTitle' => $stm_post_types_options['sidebar']['plural_title'], 'menu_icon' => 'dashicons-schedule', 'rewrite' => array( 'slug' => $stm_post_types_options['sidebar']['rewrite'] ), 'supports' => array( 'title', 'editor' ), 'exclude_from_search' => true, 'publicly_queryable' => false ) );
STM_PostType::registerPostType( 'vacancy', $stm_post_types_options['vacancy']['title'], array( 'pluralTitle' => $stm_post_types_options['vacancy']['plural_title'], 'menu_icon' => 'dashicons-id', 'rewrite' => array( 'slug' => $stm_post_types_options['vacancy']['rewrite'] ), 'supports' => array( 'title', 'editor' ) ) );


function stm_plugin_styles() {
    $plugin_url =  plugins_url('', __FILE__);

    wp_enqueue_style( 'admin-styles', $plugin_url . '/assets/css/admin.css', null, null, 'all' );

    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker');

    wp_enqueue_style( 'stmcss-datetimepicker', $plugin_url . '/assets/css/jquery.stmdatetimepicker.css', null, null, 'all' );
    wp_enqueue_script( 'stmjs-datetimepicker', $plugin_url . '/assets/js/jquery.stmdatetimepicker.js', array( 'jquery' ), null, true );

    wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'stm_plugin_styles' );

add_action('plugins_loaded', 'stm_plugin_setup');

function stm_plugin_setup(){

    $plugin_url =  plugins_url('', __FILE__);

    load_plugin_textdomain( 'stm_post_type', false, $plugin_url . '/languages' );

}

add_action( 'admin_menu', 'stm_register_post_types_options_menu' );

if( ! function_exists( 'stm_register_post_types_options_menu' ) ){
	function stm_register_post_types_options_menu(){
		add_submenu_page( 'tools.php', __('STM Post Types', STM_POST_TYPE), __('STM Post Types', STM_POST_TYPE), 'manage_options', 'stm_post_types', 'stm_post_types_options' );
	}
}

if( ! function_exists( 'stm_post_types_options' ) ){
	function stm_post_types_options(){

		if ( ! empty( $_POST['stm_post_types_options'] ) ) {
			update_option( 'stm_post_types_options', $_POST['stm_post_types_options'] );
		}

		$options = get_option('stm_post_types_options');

		$defaultPostTypesOptions = array(
			'service' => array(
				'title' => __( 'Service', STM_POST_TYPE ),
				'plural_title' => __( 'Services', STM_POST_TYPE ),
				'rewrite' => 'service'
			),
			'testimonial' => array(
				'title' => __( 'Testimonial', STM_POST_TYPE ),
				'plural_title' => __( 'Testimonials', STM_POST_TYPE ),
				'rewrite' => 'testimonial'
			),
			'sidebar' => array(
				'title' => __( 'Sidebar', STM_POST_TYPE ),
				'plural_title' => __( 'Sidebars', STM_POST_TYPE ),
				'rewrite' => 'sidebar'
			),
			'vacancy' => array(
				'title' => __( 'Vacancy', STM_POST_TYPE ),
				'plural_title' => __( 'Vacancies', STM_POST_TYPE ),
				'rewrite' => 'vacancy'
			)
		);

		$options = wp_parse_args( $options, $defaultPostTypesOptions );

		echo '
			<div class="wrap">
		        <h2>' . __( 'Custom Post Type Renaming Settings', STM_POST_TYPE ) . '</h2>

		        <form method="POST" action="">
		            <table class="form-table">
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="service_title">' . __( '"Service" title (admin panel tab name)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="service_title" name="stm_post_types_options[service][title]" value="' . $options['service']['title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="service_plural_title">' . __( '"Services" plural title', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="service_plural_title" name="stm_post_types_options[service][plural_title]" value="' . $options['service']['plural_title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="service_rewrite">' . __( '"Services" rewrite (URL text)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="service_rewrite" name="stm_post_types_options[service][rewrite]" value="' . $options['service']['rewrite'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top"><th scope="row"></th></tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="testimonial_title">' . __( '"Testimonials" title (admin panel tab name)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="testimonial_title" name="stm_post_types_options[testimonial][title]" value="' . $options['testimonial']['title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="testimonial_plural_title">' . __( '"Testimonials" plural title', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="testimonial_plural_title" name="stm_post_types_options[testimonial][plural_title]" value="' . $options['testimonial']['plural_title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="testimonial_rewrite">' . __( '"Testimonials" rewrite (URL text)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="testimonial_rewrite" name="stm_post_types_options[testimonial][rewrite]" value="' . $options['testimonial']['rewrite'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top"><th scope="row"></th></tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="sidebar_title">' . __( '"Sidebars" title (admin panel tab name)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="sidebar_title" name="stm_post_types_options[sidebar][title]" value="' . $options['sidebar']['title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="sidebar_plural_title">' . __( '"Sidebars" plural title', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="sidebar_plural_title" name="stm_post_types_options[sidebar][plural_title]" value="' . $options['sidebar']['plural_title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="sidebar_rewrite">' . __( '"Sidebars" rewrite (URL text)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="sidebar_rewrite" name="stm_post_types_options[sidebar][rewrite]" value="' . $options['sidebar']['rewrite'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top"><th scope="row"></th></tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="vacancy_title">' . __( '"Vacancies" title (admin panel tab name)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="vacancy_title" name="stm_post_types_options[vacancy][title]" value="' . $options['vacancy']['title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="vacancy_plural_title">' . __( '"Vacancies" plural title', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="vacancy_plural_title" name="stm_post_types_options[vacancy][plural_title]" value="' . $options['vacancy']['plural_title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="vacancy_rewrite">' . __( '"Vacancies" rewrite (URL text)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="vacancy_rewrite" name="stm_post_types_options[vacancy][rewrite]" value="' . $options['vacancy']['rewrite'] . '"  size="25" />
		                    </td>
		                </tr>
		            </table>
		            <p>' . __( "NOTE: After you change the rewrite field values, you'll need to refresh permalinks under Settings -> Permalinks", STM_POST_TYPE ) . '</p>
		            <br/>
		            <p>
						<input type="submit" value="' . __( 'Save settings', STM_POST_TYPE ) . '" class="button-primary"/>
					</p>
		        </form>
		    </div>
		';
	}
}