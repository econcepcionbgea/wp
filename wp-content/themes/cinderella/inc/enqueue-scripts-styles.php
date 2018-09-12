<?php

global $theme_info;
$theme_info = wp_get_theme();
define('STM_THEME_VERSION', ( WP_DEBUG ) ? time() : $theme_info->get( 'Version' ));

add_action( 'wp_enqueue_scripts', 'stm_load_theme_scripts_and_styles' );

function stm_load_theme_scripts_and_styles() {

	wp_dequeue_style( 'select2' );
	wp_dequeue_script( 'select2' );

	if ( ! is_admin() ) {

		/* Register Styles */
		wp_register_style( 'theme-style', get_stylesheet_uri(), null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'normalize.css', get_template_directory_uri() . '/assets/css/normalize.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'bootstrap.min.css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'font-awesome.min.css', get_template_directory_uri() . '/assets/css/font-awesome.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm-icomoon.css', get_template_directory_uri() . '/assets/css/stm-icomoon.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'mobile.css', get_template_directory_uri() . '/assets/css/mobile.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'slick.css', get_template_directory_uri() . '/assets/css/slick.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'frontend_customizer', get_template_directory_uri() . '/assets/css/frontend_customizer.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'woocommerce-layout.css', get_template_directory_uri() . '/assets/css/woocommerce-layout.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'woocommerce-smallscreen.css', get_template_directory_uri() . '/assets/css/woocommerce-smallscreen.css', null, STM_THEME_VERSION, 'only screen and (max-width: 768px)' );
		wp_register_style( 'woocommerce.css', get_template_directory_uri() . '/assets/css/woocommerce.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'select2.css', get_template_directory_uri() . '/assets/css/select2.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'uniform.default.css', get_template_directory_uri() . '/assets/css/uniform.default.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'skin_beach', get_template_directory_uri() . '/assets/css/skin_beach.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'skin_provence', get_template_directory_uri() . '/assets/css/skin_provence.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'skin_yogurt', get_template_directory_uri() . '/assets/css/skin_yogurt.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'skin_custom_color', get_template_directory_uri() . '/assets/css/skin_custom_color.css', null, STM_THEME_VERSION, 'all' );

		/* Register Scripts */
		wp_register_script( 'bootstrap.min.js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'slick.min.js', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'jquery.tablesorter.min.js', get_template_directory_uri() . '/assets/js/jquery.tablesorter.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'select2.min.js', get_template_directory_uri() . '/assets/js/select2.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'jquery.uniform.min.js', get_template_directory_uri() . '/assets/js/jquery.uniform.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'custom.js', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), STM_THEME_VERSION, true );

		/* Enqueue Styles */
		wp_enqueue_style( 'normalize.css' );
		wp_enqueue_style( 'bootstrap.min.css' );
		wp_enqueue_style( 'font-awesome.min.css' );
		wp_enqueue_style( 'stm-icomoon.css' );
		wp_enqueue_style( 'select2.css' );
		wp_enqueue_style( 'uniform.default.css' );
		wp_enqueue_style( 'theme-style' );
		wp_enqueue_style( 'mobile.css' );
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			wp_enqueue_style( 'woocommerce-layout.css' );
			wp_enqueue_style( 'woocommerce-smallscreen.css' );
			wp_enqueue_style( 'woocommerce.css' );
		}

		if( is_stm() ) {
			wp_enqueue_style( 'frontend_customizer' );
			wp_enqueue_style( 'skin_beach' );
			wp_enqueue_style( 'skin_provence' );
			wp_enqueue_style( 'skin_yogurt' );
		}else{
			if( stm_option( 'color_skin' ) ){
				wp_enqueue_style( stm_option( 'color_skin' ) );
			}
		}

		/* Enqueue Scripts */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'bootstrap.min.js' );
		wp_enqueue_script( 'select2.min.js' );
		wp_enqueue_script( 'jquery.uniform.min.js' );
        wp_enqueue_script( 'custom.js' );
	}

}

function admin_styles() {
	wp_enqueue_style( 'stm-icomoon.css', get_template_directory_uri() . '/assets/css/stm-icomoon.css', null, STM_THEME_VERSION, 'all' );
}

add_action( 'admin_enqueue_scripts', 'admin_styles' );