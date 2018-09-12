<?php

$shop_sidebar_id = stm_option( 'shop_sidebar' );
$shop_sidebar_position = stm_option( 'shop_sidebar_position', 'none' );
if( $shop_sidebar_id ) {
	$shop_sidebar = get_post( $shop_sidebar_id );
}

add_filter( 'woocommerce_enqueue_styles', '__return_false' );
if( ! defined( 'WOOCOMMERCE_USE_CSS' ) ) {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

add_filter( 'woocommerce_show_page_title', '__return_false' );

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return stm_option( "products_per_page" );' ), 20 );

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 5);

add_filter( 'woocommerce_output_related_products_args', 'stm_related_products_args' );
function stm_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns'] = 4;
	return $args;
}

if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3;
	}
}

add_action( 'after_setup_theme', 'stm_woo_setup' );
function stm_woo_setup() {
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}