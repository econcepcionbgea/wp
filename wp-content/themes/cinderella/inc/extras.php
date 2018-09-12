<?php

add_filter( 'upload_mimes', 'stm_custom_mime' );

function stm_custom_mime( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['ico'] = 'image/icon';

	return $mimes;
}

if ( ! function_exists( 'stm_updater' ) ) {
	function stm_updater() {
		global $stm_option;
		if( isset( $stm_option['envato_username'] ) && isset( $stm_option['envato_api'] ) ){
			$envato_username = trim( $stm_option['envato_username'] );
			$envato_api_key  = trim( $stm_option['envato_api'] );
			if ( ! empty( $envato_username ) && ! empty( $envato_api_key ) ) {
				load_template( get_template_directory() . '/inc/updater/envato-theme-update.php' );

				if ( class_exists( 'Envato_Theme_Updater' ) ) {
					Envato_Theme_Updater::init( $envato_username, $envato_api_key, 'StylemixThemes' );
				}
			}
		}
	}
	add_action( 'after_setup_theme', 'stm_updater' );
}

if ( !function_exists( 'stm_after_content_import' ) ) {

	function stm_after_content_import( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		$locations = get_theme_mod('nav_menu_locations');
		$menus  = wp_get_nav_menus();

		if(!empty($menus))
		{
			foreach($menus as $menu)
			{
				if(is_object($menu) && $menu->name == 'Main Menu')
				{
					$locations['primary_menu'] = $menu->term_id;
				}
			}
		}

		set_theme_mod('nav_menu_locations', $locations);

		update_option( 'show_on_front', 'page' );

		$front_page = get_page_by_title( 'Home' );
		if ( isset( $front_page->ID ) ) {
			update_option( 'page_on_front', $front_page->ID );
		}
		$blog_page = get_page_by_title( 'Blog' );
		if ( isset( $blog_page->ID ) ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}

		$shop_page = get_page_by_title( 'Shop' );
		if ( isset( $shop_page->ID ) ) {
			update_option( 'woocommerce_shop_page_id', $shop_page->ID );
		}

		$cart_page = get_page_by_title( 'Cart' );
		if ( isset( $cart_page->ID ) ) {
			update_option( 'woocommerce_cart_page_id', $cart_page->ID );
		}

		$checkout_page = get_page_by_title( 'Checkout' );
		if ( isset( $checkout_page->ID ) ) {
			update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
		}

		$myaccount_page = get_page_by_title( 'My Account' );
		if ( isset( $myaccount_page->ID ) ) {
			update_option( 'woocommerce_myaccount_page_id', $myaccount_page->ID );
		}

		if ( class_exists( 'RevSlider' ) ) {

			$wbc_sliders_array = array(
				'demo' => 'rev_slider_main_slider.zip'
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
			
			$wbc_sliders_array = array(
				'demo' => 'rev_slider_full_screen_slider.zip'
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}

	}

	add_action( 'wbc_importer_after_content_import', 'stm_after_content_import', 10, 2 );
}

function stm_print_styles() {

	$post_id = get_the_ID();

	if( is_home() || is_category() || is_search() ){
		$post_id = get_option( 'page_for_posts' );
	}

	$page_background_color = $page_bg_image = $page_bg_position = $page_bg_repeat = '';

	if( $page_bg_image_array = wp_get_attachment_image_src( get_post_meta( $post_id, 'page_bg_image', true ), 'full' ) ){
		$page_bg_image = 'background-image: url(' . esc_attr( $page_bg_image_array[0] ) . ');';
	}
	if( $bg_color = get_post_meta( $post_id, 'page_bg_color', true ) ){
		$page_background_color = 'background-color: ' . esc_attr( $bg_color ) . ';';
	}
	if( $bg_position = get_post_meta( $post_id, 'page_bg_position', true ) ){
		$page_bg_position = 'background-position: ' . esc_attr( $bg_position ) . ';';
	}
	if( $bg_repeat = get_post_meta( $post_id, 'page_bg_repeat', true ) ){
		$page_bg_repeat = 'background-repeat: ' . esc_attr( $bg_repeat ) . ';';
	}

	$site_color_1 = stm_option( 'site_color_1' );
	$site_color_2 = stm_option( 'site_color_2' );
	$site_color_3 = stm_option( 'site_color_3' );
	$footer_bg = stm_option( 'footer_bg' );
	$footer_text_color = stm_option( 'footer_text_color' );
	$site_color_4 = hex2rgba($site_color_3, 0.9);

	$site_css = stm_option( 'site_css' );

	$css = <<<CSS
		body {
			{$page_background_color}
			{$page_bg_image}
			{$page_bg_position}
			{$page_bg_repeat}
		}
CSS;
	if( $site_css ){
		$css .= preg_replace( '/\s+/', ' ', $site_css );
	}

	if( stm_option( 'color_skin' ) == 'skin_custom_color' ){
		$css .= <<<CSS
			body.skin_custom_color h1:after,
			body.skin_custom_color .h1:after,
			body.skin_custom_color h2:after,
			body.skin_custom_color .h2:after,
			body.skin_custom_color h3:after,
			body.skin_custom_color .h3:after,
			body.skin_custom_color h4:after,
			body.skin_custom_color .h4:after,
			body.skin_custom_color h5:after,
			body.skin_custom_color .h5:after,
			body.skin_custom_color h6:after,
			body.skin_custom_color .h6:after,
			body.skin_custom_color .top_nav .top_nav_wrapper,
			body.skin_custom_color .top_nav .top_nav_wrapper > ul > li ul li:hover > a,
			body.skin_custom_color .top_nav .top_nav_wrapper > ul > li ul li.current-menu-item > a,
			body.skin_custom_color .top_nav .main_menu_nav > ul > li ul li:hover > a,
			body.skin_custom_color .top_nav .main_menu_nav > ul > li ul li.current-menu-item > a,
			body.skin_custom_color .icon_box .icon:before,
			body.skin_custom_color .icon_box h4:after,
			body.skin_custom_color .stm_services_tabs .services_categories ul li.ui-state-active a,
			body.skin_custom_color .stm_services_tabs .service_tab_item .service_sticker,
			body.skin_custom_color .dropcarps_circle:before,
			body.skin_custom_color .vc_progress_bar .vc_single_bar.bar_red .vc_bar,
			body.skin_custom_color ul.page-numbers .page-numbers.current,
			body.skin_custom_color ul.page-numbers .page-numbers:hover,
			body.skin_custom_color ul.page-numbers .page-numbers:active,
			body.skin_custom_color ul.page-numbers .page-numbers:focus,
			body.skin_custom_color .page-links > span,
			body.skin_custom_color .page-links > a:hover,
			body.skin_custom_color .page-links > a:active,
			body.skin_custom_color .page-links > a:focus,
			body.skin_custom_color .not_found_block li:before,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:hover,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:focus,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab.vc_active > a,
			body.skin_custom_color .pricing-table_label,
			body.skin_custom_color .vacancy_table th.headerSortDown,
			body.skin_custom_color .vacancy_table th.headerSortUp,
			body.skin_custom_color .stm_staff .job:after,
			body.skin_custom_color .stm_staff_2 .job:after,
			body.skin_custom_color .gallery_grid_filter ul li.active a,
			body.skin_custom_color .gallery_grid_filter ul li a:hover,
			body.skin_custom_color .top_bar_info_switcher .active,
			body.skin_custom_color .top_bar_info_switcher ul,
			body.skin_custom_color .stm_pricing_list_block .service_tab_item .service_sticker,
			body.skin_custom_color #frontend_customizer_button,
			body.skin_custom_color.woocommerce span.onsale,
			body.skin_custom_color.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{
			    background-color: {$site_color_1};
			}

			body.skin_custom_color .vc_row.colored_1{
			    background-color: {$site_color_1} !important;
			}

			body.skin_custom_color .icon_text .icon,
			body.skin_custom_color .icon_box .icon,
			body.skin_custom_color .stm_services_tabs .service_tab_item .service_cost,
			body.skin_custom_color .posts_grid .post_date .post_date_day,
			body.skin_custom_color .posts_grid .post_info h3 a:hover,
			body.skin_custom_color .posts_grid li.sticky .post_info h3 a,
			body.skin_custom_color .widget_contacts .icon,
			body.skin_custom_color .dropcarps_circle:first-letter,
			body.skin_custom_color .wpb_content_element ul li:before,
			body.skin_custom_color .posts_list .post_date .post_date_day,
			body.skin_custom_color .posts_list .post_info h3 a:hover,
			body.skin_custom_color .vc_tta-tabs.vc_tta-tabs-position-left.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab.vc_active > a,
			body.skin_custom_color .pricing-table_content ul li:before,
			body.skin_custom_color .widget_pages.vc_widgets li a:hover,
			body.skin_custom_color .widget_pages.vc_widgets li.current_page_item a,
			body.skin_custom_color .widget_pages.vc_widgets li:hover:before,
			body.skin_custom_color .widget_pages.vc_widgets li.current_page_item:before,
			body.skin_custom_color .vc_widgets.widget_contacts .text a:hover,
			body.skin_custom_color .vacancy_table th:hover:after,
			body.skin_custom_color .company_history .year,
			body.skin_custom_color ul.comment-list .comment .comment-meta a:hover,
			body.skin_custom_color .widget_categories ul li:before,
			body.skin_custom_color .widget_archive ul li:before,
			body.skin_custom_color .widget_pages ul li:before,
			body.skin_custom_color .widget_meta ul li:before,
			body.skin_custom_color .widget_recent_entries ul li:before,
			body.skin_custom_color .widget_rss ul li:before,
			body.skin_custom_color .widget_nav_menu ul li:before,
			body.skin_custom_color .widget_categories li a:hover,
			body.skin_custom_color .widget_archive li a:hover,
			body.skin_custom_color .widget_pages li a:hover,
			body.skin_custom_color .widget_meta li a:hover,
			body.skin_custom_color .widget_recent_entries li a:hover,
			body.skin_custom_color .widget_rss li a:hover,
			body.skin_custom_color .widget_nav_menu li a:hover,
			body.skin_custom_color .stm_widget_recent_entries ul li .post_info a:hover,
			body.skin_custom_color .widget_recent_comments ul li a:hover,
			body.skin_custom_color .tp_recent_tweets ul li a:hover,
			body.skin_custom_color .gallery_grid_wrapper.white .gallery_grid_filter ul li.active a,
			body.skin_custom_color .gallery_grid_wrapper.white .gallery_grid_filter ul li a:hover,
			body.skin_custom_color #stm_wpml_lang_switcher li a:hover,
			body.skin_custom_color .top_bar .top_bar_info li .fa,
			body.skin_custom_color .top_bar .top_bar_socials a:hover,
			body.skin_custom_color .widget_categories.footer_widgets li a:hover,
			body.skin_custom_color .widget_archive.footer_widgets li a:hover,
			body.skin_custom_color .widget_pages.footer_widgets li a:hover,
			body.skin_custom_color .widget_meta.footer_widgets li a:hover,
			body.skin_custom_color .widget_recent_entries.footer_widgets li a:hover,
			body.skin_custom_color .widget_rss.footer_widgets li a:hover,
			body.skin_custom_color .widget_nav_menu.footer_widgets li a:hover,
			body.skin_custom_color .widget_recent_comments.footer_widgets ul li a:hover,
			body.skin_custom_color .stm_pricing_list_block .service_tab_item .service_cost,
			body.skin_custom_color.woocommerce .star-rating span{
			    color: {$site_color_1};
			}

			body.skin_custom_color .breadcrumbs a:hover,
			body.skin_custom_color .gallery_grid_switcher:hover{
			    color: {$site_color_1} !important;
			}

			body.skin_custom_color ul.page-numbers .page-numbers.current,
			body.skin_custom_color ul.page-numbers .page-numbers:hover,
			body.skin_custom_color ul.page-numbers .page-numbers:active,
			body.skin_custom_color ul.page-numbers .page-numbers:focus,
			body.skin_custom_color .page-links > span,
			body.skin_custom_color .page-links > a:hover,
			body.skin_custom_color .page-links > a:active,
			body.skin_custom_color .page-links > a:focus,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:hover,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:focus,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab.vc_active > a,
			body.skin_custom_color .stm_pricing-table.has-label,
			body.skin_custom_color .widget_pages.vc_widgets,
			body.skin_custom_color .vacancy_table th.headerSortDown,
			body.skin_custom_color .vacancy_table th.headerSortUp,
			body.skin_custom_color .widget_categories,
			body.skin_custom_color .widget_archive,
			body.skin_custom_color .widget_calendar,
			body.skin_custom_color .widget_pages,
			body.skin_custom_color .widget_meta,
			body.skin_custom_color .widget_recent_entries,
			body.skin_custom_color .widget_rss,
			body.skin_custom_color .widget_nav_menu,
			body.skin_custom_color .gallery_grid_switcher:hover{
			    border-color: {$site_color_1};
			}

			body.skin_custom_color blockquote,
			body.skin_custom_color .vc_tta-tabs.vc_tta-tabs-position-left.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab.vc_active > a{
			    border-left-color: {$site_color_1};
			}

			body.skin_custom_color #frontend_customizer_button:before{
			    border-right-color: {$site_color_1};
			}

			body.skin_custom_color .stm_services_tabs .service_tab_item .service_dots .separator_dots,
			body.skin_custom_color .stm_pricing_list_block .service_tab_item .service_dots .separator_dots,
			body.skin_custom_color.woocommerce ul.products li.product .price:after{
			    border-bottom-color: {$site_color_1};
			}

			@media only screen and (max-width: 768px) {
			    body.skin_custom_color .mobile_header .header_info,
			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav > li > a{
			        background-color: {$site_color_1};
			    }

			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav ul li:active > a,
			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav li.current_page_item > a,
			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav > li.current_page_item.menu-item-has-children .arrow,
			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav li.current-menu-parent > a,
			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav > li.current-menu-parent.menu-item-has-children .arrow{
			        color: {$site_color_1};
			    }

			    body.skin_custom_color .icon_text .icon{
			        color: #ffffff;
			    }

			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav li.current_page_item > a,
			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav > li.current_page_item.menu-item-has-children .arrow,
			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav li.current-menu-parent > a,
			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav > li.current-menu-parent.menu-item-has-children .arrow{
			        background: #ffffff;
			    }

			    body.skin_custom_color .mobile_header .top_nav_mobile .main_menu_nav > li{
			        border-bottom-color: #ffffff;
			    }

			}

			body.skin_custom_color #magic-line,
			body.skin_custom_color .slick_carousel .slick_item:hover a:before{
			    background-color: {$site_color_2};
			}
			
			body.skin_custom_color #footer{
				color: {$footer_text_color};
				background-color: {$footer_bg};
			}

			body.skin_custom_color a:hover,
			body.skin_custom_color a:active,
			body.skin_custom_color .company_history h3,
			body.skin_custom_color .stm_pricing_list_block h3{
			    color: {$site_color_2};
			}

			body.skin_custom_color.woocommerce #respond input#submit,
			body.skin_custom_color.woocommerce a.button,
			body.skin_custom_color.woocommerce button.button,
			body.skin_custom_color.woocommerce input.button{
			    background-color: transparent;
			}

			body.skin_custom_color a.button,
			body.skin_custom_color .button,
			body.skin_custom_color .form-submit .submit,
			body.skin_custom_color .post-password-form input[type="submit"],
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-flat,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab > a:hover,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab > a:focus,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab.vc_active > a,
			body.skin_custom_color .stm_staff_2 .staff_socials li a:hover,
			body.skin_custom_color .tagcloud a:hover,
			body.skin_custom_color .vc_images_carousel .vc_carousel-control,
			body.skin_custom_color .vc_images_carousel .vc_carousel-indicators .vc_active,
			body.skin_custom_color.woocommerce #respond input#submit:hover,
			body.skin_custom_color.woocommerce a.button:hover,
			body.skin_custom_color.woocommerce button.button:hover,
			body.skin_custom_color.woocommerce input.button:hover,
			body.skin_custom_color.woocommerce .quantity_actions span:hover,
			body.skin_custom_color.woocommerce #respond input#submit.alt,
			body.skin_custom_color.woocommerce a.button.alt,
			body.skin_custom_color.woocommerce button.button.alt,
			body.skin_custom_color.woocommerce input.button.alt,
			body.skin_custom_color.woocommercbody.skin_custom_colore #respond input#submit.alt.disabled,
			body.skin_custom_color.woocommerce #respond input#submit.alt.disabled:hover,
			body.skin_custom_color.woocommerce #respond input#submit.alt:disabled,
			body.skin_custom_color.woocommerce #respobody.skin_custom_colornd input#submit.alt:disabled:hover,
			body.skin_custom_color.woocommerce #respond input#submit.alt:disabled[disabled],
			body.skin_custom_color.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
			body.skin_custom_color.woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover,
			body.skin_custom_color.woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover,
			body.skin_custom_color.woocommerce a.button.alt:disabled[disabled],
			body.skin_custom_color.woocommerce a.button.alt:disabled[disabled]:hover,
			body.skin_custom_color.woocommerce button.button.alt.disabled,
			body.skin_custom_color.woocommerce button.button.alt.disabled:hover,
			body.skin_custom_color.woocommerce button.button.alt:disabled,
			body.skin_custom_color.woocommerce button.button.alt:disabled:hover,
			body.skin_custom_color.woocommerce button.button.alt:disabled[disabled],
			body.skin_custom_color.woocommerce button.button.alt:disabled[disabled]:hover,
			body.skin_custom_color.woocommerce input.button.alt.disabled,
			body.skin_custom_color.woocommerce input.button.alt.disabled:hover,
			body.skin_custom_color.woocommerce input.button.alt:disabled,
			body.skin_custom_color.woocommerce input.button.alt:disabled:hover,
			body.skin_custom_color.woocommerce input.button.alt:disabled[disabled],
			body.skin_custom_color.woocommerce input.button.alt:disabled[disabled]:hover,
			body.skin_custom_color.woocommerce #respond input#submit,
			body.skin_custom_color.woocommerce input.button.flat,
			body.skin_custom_color.woocommerce .search-form button.button,
			body.skin_custom_color .woocommerce #respond input#submit,
			body.skin_custom_color .woocommerce input.button.flat,
			body.skin_custom_color .woocommerce .search-form button.button,
			body.skin_custom_color .woocommerce #respond input#submit.alt,
			body.skin_custom_color .woocommerce a.button.alt,
			body.skin_custom_color .woocommerce button.button.alt,
			body.skin_custom_color .woocommerce input.button.alt{
			    background-color: {$site_color_3};
			}

			body.skin_custom_color a,
			body.skin_custom_color a.button.outline,
			body.skin_custom_color .button.outline,
			body.skin_custom_color .icon_box h4 a:hover,
			body.skin_custom_color .stm_services_tabs .service_tab_item .service_name a:hover,
			body.skin_custom_color .vc_btn3.vc_btn3-color-white,
			body.skin_custom_color .vc_btn3.vc_btn3-color-white.vc_btn3-style-flat,
			body.skin_custom_color .vc_btn3.vc_btn3-color-white:hover,
			body.skin_custom_color .vc_btn3.vc_btn3-color-white.vc_btn3-style-flat:hover,
			body.skin_custom_color .vc_btn3.vc_btn3-color-white:focus,
			body.skin_custom_color .vc_btn3.vc_btn3-color-white.vc_btn3-style-flat:focus,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-outline,
			body.skin_custom_color ul.post_details a:hover,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:hover a,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:focus a,
			body.skin_custom_color .vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab > a,
			body.skin_custom_color .stm_staff .staff_socials ul li a:hover,
			body.skin_custom_color .stm_staff_2 .staff_socials li a,
			body.skin_custom_color .service_list h4 a:hover,
			body.skin_custom_color .gallery_grid_filter ul li a,
			body.skin_custom_color .stm_pricing_list_block .service_tab_item .service_name a:hover,
			body.skin_custom_color.woocommerce ul.products li.product h4 a:hover,
			body.skin_custom_color.woocommerce #respond input#submit,
			body.skin_custom_color.woocommerce a.button,
			body.skin_custom_color.woocommerce button.button,
			body.skin_custom_color.woocommerce input.button,
			body.skin_custom_color.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			body.skin_custom_color .copyright a:hover{
			    color: {$site_color_3};
			}

			body.skin_custom_color .gallery_grid_switcher{
			    color: {$site_color_3} !important;
			}

			body.skin_custom_color .button,
			body.skin_custom_color .form-submit .submit,
			body.skin_custom_color .post-password-form input[type="submit"],
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-outline,
			body.skin_custom_color ul.page-numbers .page-numbers,
			body.skin_custom_color .page-links > a,
			body.skin_custom_color .page-links > span,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:hover .vc_tta-controls-icon::before,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:hover .vc_tta-controls-icon::after,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:focus .vc_tta-controls-icon::before,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:focus .vc_tta-controls-icon::after,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab > a:hover,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab > a:focus,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab.vc_active > a,
			body.skin_custom_color .our_partners > ul > li:hover .logo,
			body.skin_custom_color .stm_staff .staff_socials ul li a:hover,
			body.skin_custom_color .stm_staff_2 .staff_socials li a,
			body.skin_custom_color .vc_images_carousel .vc_carousel-indicators li,
			body.skin_custom_color .vc_images_carousel .vc_carousel-indicators .vc_active,
			body.skin_custom_color .gallery_grid_switcher,
			body.skin_custom_color .product_thumbnail:hover,
			body.skin_custom_color.woocommerce #respond input#submit:hover,
			body.skin_custom_color.woocommerce a.button:hover,
			body.skin_custom_color.woocommerce button.button:hover,
			body.skin_custom_color.woocommerce input.button:hover,
			body.skin_custom_color.woocommerce .quantity_actions span:hover,
			body.skin_custom_color.woocommerce #respond input#submit,
			body.skin_custom_color.woocommerce input.button.flat,
			body.skin_custom_color.woocommerce .search-form button.button,
			body.skin_custom_color .woocommerce #respond input#submit:hover,
			body.skin_custom_color .woocommerce input.button.flat:hover,
			body.skin_custom_color .woocommerce .search-form button.button:hover,
			body.skin_custom_color .woocommerce #respond input#submit.alt:hover,
			body.skin_custom_color .woocommerce a.button.alt:hover,
			body.skin_custom_color .woocommerce button.button.alt:hover,
			body.skin_custom_color .woocommerce input.button.alt:hover{
			    border-color: {$site_color_3};
			}

			body.skin_custom_color .icon_button .button.outline span{
			    border-left-color: {$site_color_3};
			}

			body.skin_custom_color .select2-container--default .select2-selection--single .select2-selection__arrow b{
			    border-top-color: {$site_color_3};
			}

			body.skin_custom_color .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b{
			    border-bottom-color: {$site_color_3};
			}

			body.skin_custom_color .top_nav .icon_text .icon,
			body.skin_custom_color a.button,
			body.skin_custom_color .button,
			body.skin_custom_color .form-submit .submit,
			body.skin_custom_color .post-password-form input[type="submit"],
			body.skin_custom_color .breadcrumbs a,
			body.skin_custom_color .breadcrumbs,
			body.skin_custom_color .title_box_secondary_text,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:hover a,
			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:focus a,
			body.skin_custom_color .vacancy_table th.headerSortDown:after,
			body.skin_custom_color .vacancy_table th.headerSortUp:after,
			body.skin_custom_color .vacancy_table th.headerSortDown:hover:after,
			body.skin_custom_color .vacancy_table th.headerSortUp:hover:after,
			body.skin_custom_color .stm_staff_2 .staff_socials li a:hover,
			body.skin_custom_color .gallery_grid_filter ul li.active a,
			body.skin_custom_color .gallery_grid_filter ul li a:hover,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-outline:hover,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-outline:focus,
			body.skin_custom_color .tagcloud a:hover,
			body.skin_custom_color.woocommerce #respond input#submit:hover,
			body.skin_custom_color.woocommerce a.button:hover,
			body.skin_custom_color.woocommerce button.button:hover,
			body.skin_custom_color.woocommerce input.button:hover,
			body.skin_custom_color.woocommerce #respond input#submit.alt,
			body.skin_custom_color.woocommerce a.button.alt,
			body.skin_custom_color.woocommerce button.button.alt,
			body.skin_custom_color.woocommerce input.button.alt,
			body.skin_custom_color.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
			body.skin_custom_color.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover,
			body.skin_custom_color.woocommerce #respond input#submit,
			body.skin_custom_color.woocommerce input.button.flat,
			body.skin_custom_color.woocommerce .search-form button.button,
			body.skin_custom_color .widget_contacts .text a:hover{
			    color: #ffffff;
			}

			body.skin_custom_color .icon_box h4 a,
			body.skin_custom_color .service_list h4 a,
			ul.post_details a
			{
			    color: #333333;
			}

			body.skin_custom_color .widget_categories li a,
			body.skin_custom_color .widget_archive li a,
			body.skin_custom_color .widget_pages li a,
			body.skin_custom_color .widget_meta li a,
			body.skin_custom_color .widget_recent_entries li a,
			body.skin_custom_color .widget_rss li a,
			body.skin_custom_color .widget_nav_menu li a {
			    color: #777777;
			}

			body.skin_custom_color .tagcloud a{
			    color: #999999;
			}

			body.skin_custom_color a.button:hover,
			body.skin_custom_color .button:hover,
			body.skin_custom_color .form-submit .submit:hover,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink:hover,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-flat:hover,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink:focus,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-flat:focus,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-outline:hover,
			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-outline:focus{
				background-color: {$site_color_4};
			    border-color: {$site_color_4};
			}

			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-tabs-position-left.vc_tta-style-classic .vc_tta-tab > a:hover,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-tabs-position-left.vc_tta-style-classic .vc_tta-tab > a:focus{
			    color: {$site_color_4};
			}

			body.skin_custom_color .vc_tta-color-white.vc_tta-style-classic .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::before, body .vc_tta-color-white.vc_tta-style-classic .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::after, body .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:hover .vc_tta-controls-icon::before, body .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:hover .vc_tta-controls-icon::after, body .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:focus .vc_tta-controls-icon::before, body .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading:focus .vc_tta-controls-icon::after{
			    border-color: #fff;
			}

			body.skin_custom_color .vc_btn3.vc_btn3-color-pink.vc_btn3-style-outline,
			body.skin_custom_color .vc_tta-tabs.vc_tta-tabs-position-left.vc_tta-color-pink.vc_tta-style-classic .vc_tta-tab.vc_active > a,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-tabs-position-left.vc_tta-style-classic .vc_tta-tab > a:hover,
			body.skin_custom_color .vc_tta-tabs.vc_tta-color-pink.vc_tta-tabs-position-left.vc_tta-style-classic .vc_tta-tab > a:focus{
			    background-color: transparent;
			}

			body.skin_custom_color.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover{
			    color: #6b6b6b;
			}
CSS;

	}

	wp_add_inline_style( 'theme-style', $css );
}
add_action( 'wp_enqueue_scripts', 'stm_print_styles' );

if( ! function_exists( 'get_header_style' ) ){
	function get_header_style(){
		$header_style = stm_option( 'header_style' );
		if( isset( $_REQUEST[ 'header_demo' ] ) && $_REQUEST[ 'header_demo' ] == 'transparent' ){
			$header_style = 'header_style_transparent';
		}
		return $header_style;
	}
}

if( ! function_exists( 'stm_comment' ) ){
	function stm_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		
		$rating = '';
		if( isset( $comment->post_type ) && $comment->post_type == 'product' && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ){
			$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
		}

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
		<?php } ?>
		<?php if ( $args['avatar_size'] != 0 ) { ?>
			<div class="vcard">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
		<?php } ?>
		<div class="comment-info clearfix">
			<div class="comment-author"><?php echo get_comment_author_link(); ?></div>
			<?php if( $rating ){ ?>
				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'woocommerce' ), $rating ) ?>">
					<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo esc_html( $rating ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
				</div>
			<?php } ?>
			<div class="comment-meta commentmetadata">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __( '%1$s at %2$s', 'cinderella' ), get_comment_date(),  get_comment_time() ); ?>
				</a>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="fa fa-reply"></i> Reply', 'cinderella' ), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( __( 'Edit', 'cinderella' ), '  ', '' ); ?>
			</div>
			<div class="comment-text">
				<?php comment_text(); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cinderella' ); ?></em>
			<?php } ?>
		</div>

		<?php if ( 'div' != $args['style'] ) { ?>
			</div>
		<?php } ?>
		<?php
	}
}

add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );

if( ! function_exists( 'bootstrap3_comment_form_fields' ) ){
	function bootstrap3_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
		$fields    = array(
			'author' => '<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="input-group comment-form-author">
		            			<input placeholder="' . esc_attr( __( 'Name', 'cinderella' ) . ( $req ? ' *' : '' ) ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
	                        </div>
	                    </div>',
			'email'  => '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="input-group comment-form-email">
							<input placeholder="' . esc_attr( __( 'E-mail', 'cinderella' ) . ( $req ? ' *' : '' ) ) . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
						</div>
					</div>',
			'url'    => '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="input-group comment-form-url">
							<input placeholder="' . esc_attr( __( 'Website', 'cinderella' ) ) . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
						</div>
					</div></div>'
		);

		return $fields;
	}
}

add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );

if( ! function_exists( 'bootstrap3_comment_form' ) ){
	function bootstrap3_comment_form( $args ) {
		$args['comment_field'] = '<div class="input-group comment-form-comment">
						        <textarea placeholder="' . esc_attr( _x( 'Message', 'noun', 'cinderella' ) ) . ' *" name="comment" rows="9" aria-required="true"></textarea>
							  </div>';

		return $args;
	}
}

if( ! function_exists( 'stm_wpml_lang_switcher' ) ){
	function stm_wpml_lang_switcher() {
		if( function_exists( 'icl_get_languages' ) ){
			$languages = icl_get_languages( 'skip_missing=0&orderby=code' );
			$output = '';
			if ( ! empty( $languages ) ) {
				$output .= '<div id="stm_wpml_lang_switcher">';
				$output .= '<div class="active_language">' . ICL_LANGUAGE_NAME_EN . ' <i class="fa fa-angle-down"></i></div>';
				$output .= '<ul>';
				foreach ( $languages as $l ) {
					if ( ! $l['active'] ) {
						$output .= '<li>';
						$output .= '<a href="' . esc_url( $l['url'] ) . '">';
						$output .= icl_disp_language( $l['native_name'] );
						$output .= '</a>';
						$output .= '</li>';
					}
				}
				$output .= '</ul>';
				$output .= '</div>';
				echo $output;
			}
		}
	}
}

function hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';

	if(empty($color))
		return $default;

	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	if (strlen($color) == 6) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	$rgb =  array_map('hexdec', $hex);

	if($opacity){
		if(abs($opacity) > 1)
			$opacity = 1.0;
		$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	} else {
		$output = 'rgb('.implode(",",$rgb).')';
	}
	return $output;
}

function is_top_bar() {
	$top_bar = stm_option( 'top_bar' );
	if( isset( $_REQUEST[ 'top_bar' ] ) && $_REQUEST[ 'top_bar' ] == 'show' ){
		$top_bar = true;
	}
	return $top_bar;
}

function is_stm(){
	$host = $_SERVER['HTTP_HOST'];
	if( $host == "www.cinderella.stm" || $host == "cinderella.stm" || $host == "www.cinderella.stylemixthemes.com" || $host == "cinderella.stylemixthemes.com" ) {
		return true;
	}else{
		return false;
	}
}

function get_top_bar_info(){
	global $stm_option;
	$top_bar_info = array();
	for($i=1; $i <= 10; $i++ ){
		if( ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
			$top_bar_info[$i]['office'] = $stm_option['top_bar_info_'. $i .'_office'];
		}
		if( ! empty( $stm_option['top_bar_info_'. $i .'_address'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
			$top_bar_info[$i]['address'] = $stm_option['top_bar_info_'. $i .'_address'];
		}
		if( ! empty( $stm_option['top_bar_info_'. $i .'_address'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_address_icon'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
			$top_bar_info[$i]['address_icon'] = $stm_option['top_bar_info_'. $i .'_address_icon'];
		}
		if( ! empty( $stm_option['top_bar_info_'. $i .'_hours'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
			$top_bar_info[$i]['hours'] = $stm_option['top_bar_info_'. $i .'_hours'];
		}
		if( ! empty( $stm_option['top_bar_info_'. $i .'_hours'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_hours_icon'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
			$top_bar_info[$i]['hours_icon'] = $stm_option['top_bar_info_'. $i .'_hours_icon'];
		}
		if( ! empty( $stm_option['top_bar_info_'. $i .'_phone'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
			$top_bar_info[$i]['phone'] = $stm_option['top_bar_info_'. $i .'_phone'];
		}
		if( ! empty( $stm_option['top_bar_info_'. $i .'_phone'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_phone_icon'] ) && ! empty( $stm_option['top_bar_info_'. $i .'_office'] ) ){
			$top_bar_info[$i]['phone_icon'] = $stm_option['top_bar_info_'. $i .'_phone_icon'];
		}
	}
	return $top_bar_info;
}

function stm_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'stm_move_comment_field_to_bottom' );