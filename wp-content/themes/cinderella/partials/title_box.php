<?php

global $woocommerce;

$post_id = get_the_ID();

$is_shop = false;
$is_product = false;

if( function_exists( 'is_shop' ) && is_shop() ){
	$is_shop = true;
}

if( function_exists( 'is_product' ) && is_product() ){
	$is_product = true;
}

if( is_home() || is_category() || is_search() ){
    $post_id = get_option( 'page_for_posts' );
}

if( $is_shop ) {
	$post_id = get_option( 'woocommerce_shop_page_id' );
}

$title = '';

if( is_home() ){
    if( ! get_option( 'page_for_posts' ) ){
        $title = __( 'Blog', 'cinderella' );
    }else{
        $title = get_the_title( $post_id );
    }
}elseif( $is_product ){
	$title = get_the_title( $post_id );
}elseif( is_category() || is_tax() ){
    $title = single_cat_title( '', false );
}elseif( is_tag() ) {
	$title = single_tag_title( '', false );
}elseif( is_archive() ){
    $title = post_type_archive_title( '', false );
}elseif( is_search() ) {
	$title = __( 'Search', 'cinderella' );
}elseif ( is_day() ) {
	$title = get_the_time('d');
} elseif ( is_month() ) {
	$title = get_the_time('F');
} elseif ( is_year() ) {
	$title = get_the_time('Y');
}elseif( is_404() ) {
	$title = __( 'Sorry, this page doesn`t exist.', 'cinderella' );
}else{
    $title = get_the_title( $post_id );
}

if ( get_post_meta( $post_id, 'title', true ) != 'hide' ) {

    $title_style                         = array();
    $title_style_h1                      = array();
    $title_box_bg_color                  = get_post_meta( $post_id, 'title_box_bg_color', true );
    $title_box_font_color                = get_post_meta( $post_id, 'title_box_font_color', true );
    $title_box_line_color                = get_post_meta( $post_id, 'title_box_line_color', true );
    $title_box_custom_bg_image           = get_post_meta( $post_id, 'title_box_custom_bg_image', true );
    $title_box_bg_position               = get_post_meta( $post_id, 'title_box_bg_position', true );
    $title_box_bg_size                   = get_post_meta( $post_id, 'title_box_bg_size', true );
    $title_box_bg_repeat                 = get_post_meta( $post_id, 'title_box_bg_repeat', true );
    $breadcrumbs                         = get_post_meta( $post_id, 'breadcrumbs', true );
    $breadcrumbs_font_color              = get_post_meta( $post_id, 'breadcrumbs_font_color', true );
    $title_box_button_url                = get_post_meta( $post_id, 'title_box_button_url', true );
    $title_box_button_text               = get_post_meta( $post_id, 'title_box_button_text', true );
    $title_box_button_border_color       = get_post_meta( $post_id, 'title_box_button_border_color', true );
    $title_box_button_font_color         = get_post_meta( $post_id, 'title_box_button_font_color', true );
    $title_box_button_font_color_hover   = get_post_meta( $post_id, 'title_box_button_font_color_hover', true );
	$title_box_button_font_arrow_color   = get_post_meta( $post_id, 'title_box_button_font_arrow_color', true );

	if( is_404() || is_archive() || is_front_page() ){
		$title_box_bg_color                  = stm_option( 'page_title_box_bg_color' );
		$title_box_font_color                = stm_option( 'page_title_box_font_color' );
		$title_box_line_color                = stm_option( 'page_title_box_line_color' );
		$title_box_custom_bg           		 = stm_option( 'page_title_box_bg_image' );
		if( !empty($title_box_custom_bg['id']) ) $title_box_custom_bg_image = $title_box_custom_bg['id'];
		$title_box_bg_position               = stm_option( 'page_title_box_bg_position' );
		$title_box_bg_size                   = stm_option( 'page_title_box_bg_size' );
		$title_box_bg_repeat                 = stm_option( 'page_title_box_bg_repeat' );
		$breadcrumbs_font_color              = stm_option( 'page_breadcrumbs_color' );
		$title_box_button_border_color       = stm_option( 'title_box_button_border_color' );
		$title_box_button_font_color         = stm_option( 'title_box_button_font_color' );
		$title_box_button_font_color_hover   = stm_option( 'title_box_button_font_color_hover' );
		$title_box_button_font_arrow_color   = stm_option( 'title_box_button_arrow_color' );
	}

    if ( $title_box_bg_color ) {
        $title_style['bg_color'] = 'background-color: ' . esc_attr( $title_box_bg_color ) . ';';
    }

    if ( $title_box_font_color ) {
        $title_style_h1['font_color'] = 'color: ' . esc_attr( $title_box_font_color ) . ';';
    }

    if ( $title_box_custom_bg_image = wp_get_attachment_image_src( $title_box_custom_bg_image, 'full' ) ) {

        $title_style['bg_image']   = 'background-image: url(' . esc_url( $title_box_custom_bg_image[0] ) . ');';

        if ( $title_box_bg_position ) {
            $title_style['bg_position'] = 'background-position: ' . esc_attr( $title_box_bg_position ) . ';';
        }

        if ( $title_box_bg_size ) {
            $title_style['bg_size'] = 'background-size: ' . esc_attr( $title_box_bg_size ) . ';';
        }

        if ( $title_box_bg_repeat ) {
            $title_style['bg_repeat'] = 'background-repeat: ' . esc_attr( $title_box_bg_repeat ) . ';';
        }

    }
    ?>
    <div class="entry-header clearfix" <?php if( get_header_style() != 'header_style_transparent' ){ echo 'style="' . implode( ' ', $title_style ) . '"'; }; ?>>
        <div class="entry-title-left">
            <div class="entry-title">
                <h1 style="<?php echo esc_attr( implode( ' ', $title_style_h1 ) ); ?>"><?php echo wp_kses_data( $title ); ?></h1>
                <?php
                    if( $breadcrumbs != 'hide' ){
                        if( $is_shop || $is_product ){
	                        woocommerce_breadcrumb( array(
		                        'delimiter'   => '<span class="separator">/</span>',
		                        'wrap_before' => '<div class="breadcrumbs">',
		                        'wrap_after'  => '</div>',
		                        'before'      => '',
		                        'after'       => '',
		                        'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' )
	                        ) );
                        }else{
	                        if( is_404() ){ ?>
		                        <p class="title_box_secondary_text"><?php _e( 'The page you requested was not found.', 'cinderella' ); ?></p>
	                        <?php }else{
		                        if( function_exists('bcn_display') ) { ?>
			                        <div class="breadcrumbs">
				                        <?php bcn_display(); ?>
			                        </div>
		                        <?php }
	                        }
                        }
                    }
                ?>
            </div>
        </div>

	        <?php if( is_404() ){ ?>
	            <div class="entry-title-right">
		            <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="button"><span><?php _e( 'CONTACT US', 'cinderella' ); ?></span> <i class="fa fa-chevron-right"></i></a>
	            </div>
			<?php }else{ ?>
		        <?php if( $title_box_button_url ){ ?>
			        <div class="entry-title-right">
			            <a href="<?php echo esc_url( $title_box_button_url ); ?>" class="button"><span><?php echo esc_html( $title_box_button_text ); ?></span> <i class="fa fa-chevron-right"></i></a>
			        </div>
		        <?php } ?>
			<?php } ?>
        <?php if( $title_box_line_color || $breadcrumbs_font_color || $title_box_button_border_color || $title_box_button_font_color || $title_box_button_font_color_hover || $title_box_button_font_arrow_color ){ ?>
            <style type="text/css">
	            <?php if( $title_box_line_color ){ ?>
		            .entry-header .entry-title h1.h2:before{
			            background: <?php echo esc_attr( $title_box_line_color ); ?>;
		            }
	            <?php } ?>
	            <?php if( $breadcrumbs_font_color ){ ?>
	                .breadcrumbs a, .breadcrumbs, .title_box_secondary_text{
			            color: <?php echo esc_attr( $breadcrumbs_font_color ); ?>;
		            }
	            <?php } ?>
                <?php if( $title_box_button_border_color ){ ?>
	                .entry-header .entry-title-right .button{
		                border: 3px solid <?php echo esc_attr( $title_box_button_border_color ); ?>;
	                }
		            .entry-header .entry-title-right .button:hover,
		            .entry-header .entry-title-right .button:active,
		            .entry-header .entry-title-right .button:focus{
			            background: <?php echo esc_attr( $title_box_button_border_color ); ?>;
		            }
	            <?php } ?>
                <?php if( $title_box_button_font_color ){ ?>
	                .entry-header .entry-title-right .button{
		                color: <?php echo esc_attr( $title_box_button_font_color ); ?>;
	                }
	            <?php } ?>
	            <?php if( $title_box_button_font_color_hover ){ ?>
		            .entry-header .entry-title-right .button:hover,
		            .entry-header .entry-title-right .button:active,
		            .entry-header .entry-title-right .button:focus,
		            .entry-header .entry-title-right .button:hover .fa,
		            .entry-header .entry-title-right .button:active .fa,
		            .entry-header .entry-title-right .button:focus .fa
		            {
		                color: <?php echo esc_attr( $title_box_button_font_color_hover ); ?>;
	                }
	            <?php } ?>
	            <?php if( $title_box_button_font_arrow_color ){ ?>
                    .entry-header .entry-title-right .button .fa{
		                color: <?php echo esc_attr( $title_box_button_font_arrow_color ); ?>;
	                }
	            <?php } ?>
				<?php if( get_header_style() == 'header_style_transparent' ){ ?>
					body.header_style_transparent #header{
						<?php echo implode( "\n", $title_style ); ?>
					}
				<?php } ?>
	        </style>
	    <?php } ?>
    </div>
<?php } ?>