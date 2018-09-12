<?php

$inc_path = get_template_directory() . '/inc';
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

add_action( 'after_setup_theme', 'stm_theme_setup' );

if ( ! function_exists( 'stm_theme_setup' ) ) {

	function stm_theme_setup() {

		load_theme_textdomain( 'cinderella', get_template_directory() . '/languages' );

		add_image_size( 'image_carousel', 270, 240, true );
		add_image_size( 'thumb-350x350', 350, 350, true );
		add_image_size( 'thumb-292x162', 292, 162, true );
		add_image_size( 'thumb-800x370', 800, 370, true );
		add_image_size( 'thumb-370x280', 370, 280, true );
		add_image_size( 'thumb-9999x360', 9999, 360, true );
		add_image_size( 'thumb-740x560', 740, 560, true );
		add_image_size( 'thumb-82x82', 82, 82, true );

		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		register_nav_menus(
			array(
				'primary_menu' => __( 'Top Menu', 'cinderella' )
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Left Sidebar', 'cinderella' ),
				'id'            => 'left_sidebar',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s primary_widgets left">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Right Sidebar', 'cinderella' ),
				'id'            => 'right_sidebar',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s primary_widgets right">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer', 'cinderella' ),
				'id'            => 'footer',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widgets">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

	}

}

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}

function stm_wp_head() {
	if ( $favicon = stm_option( 'favicon', false, 'url' ) ) {
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( $favicon ) . '" />' . "\n";
	} else {
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_template_directory_uri() . '/favicon.ico" />' . "\n";
	}
}

add_action( 'wp_head', 'stm_wp_head' );

function stm_body_class( $classes ) {
	$classes[] = stm_option( 'color_skin' );
	$classes[] = get_header_style();
	if( stm_option( 'sticky_header' ) ){
		$classes[] = 'sticky_header';
	}
	if( stm_option( 'site_boxed' ) ){
		$classes[] = 'boxed_layout';
	}
	if( stm_option( 'boxed_background_image_type' ) ){
		$classes[] = stm_option( 'boxed_background_image_type' );
	}
	if( get_post_meta( get_the_ID(), 'header_transparent', true ) ){
		$classes[] = 'header_transparent';
	}
	if( is_stm() ){
		$classes[] = 'demo';
	}
	return $classes;
}

add_filter( 'body_class', 'stm_body_class' );

require_once( $inc_path . '/redux-framework/admin-init.php' );
require_once( $inc_path . '/enqueue-scripts-styles.php' );
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once( $inc_path . '/woocommerce_configuration.php' );
}
require_once( $inc_path . '/metaboxes.php' );
require_once( $inc_path . '/extras.php' );
require_once( $inc_path . '/tgm/tgm-plugin-registration.php' );
require_once( $inc_path . '/visual_composer.php' );
require_once( $inc_path . '/widgets/contacts.php' );
require_once( $inc_path . '/widgets/instagram.php' );
require_once( $inc_path . '/widgets/schedule-table.php' );
require_once( $inc_path . '/widgets/pages.php' );
require_once( $inc_path . '/widgets/posts.php' );

//Announcement banner
if(is_admin()) {
	require_once( $inc_path . '/announcement/main.php' );
}