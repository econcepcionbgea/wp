<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>

<div class="stm_post_info<?php echo esc_attr( $css_class ); ?>">
	<div class="post_info">

		<div class="post_thumbnail">
			<?php the_post_thumbnail( 'thumb-9999x360' ); ?>
		</div>

		<ul class="post_details">
			<li><?php echo get_the_date(); ?></li>
			<li><span><?php _e( 'Comments:', 'cinderella' ); ?></span> <a href="<?php comments_link(); ?>"><?php comments_number( 0 ); ?> </a></li>
			<li><span><?php _e( 'Posted by:', 'cinderella' ); ?></span> <?php the_author(); ?></li>
		</ul>

	</div>
</div>