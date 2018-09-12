<?php
extract( shortcode_atts( array(
	'css'   => '',
	'count' => 1
), $atts ) );

$css_class    = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$testimonials = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => $count ) );

wp_enqueue_script( 'slick.min.js' );
wp_enqueue_style( 'slick.css' );
?>

<?php if ( $testimonials->have_posts() ) { $id = time(); ?>

	<div id="testimonials_carousel-<?php echo esc_attr( $id ) ?>" class="testimonials_carousel">

		<?php while ( $testimonials->have_posts() ) { $testimonials->the_post(); ?>

			<div class="testimonials_module<?php echo esc_attr( $css_class ); ?>">
				<div class="testimonial-image"><?php echo get_the_post_thumbnail( get_the_ID(), 'thumb-350x350' ); ?></div>
				<div class="testimonial-text"><?php the_excerpt(); ?></div>
				<div class="testimonial-name"><?php the_title(); ?></div>
			</div>

		<?php } wp_reset_postdata(); ?>

	</div>

	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			"use strict";
			var slick_<?php echo esc_js( $id ) ?> = $("#testimonials_carousel-<?php echo esc_js( $id ) ?>");
			slick_<?php echo esc_js( $id ) ?>.slick({
				dots: true,
				infinite: true,
				arrows: false,
				autoplaySpeed: 5000,
				autoplay: true,
				slidesToShow: 1,
				cssEase: "cubic-bezier(0.455, 0.030, 0.515, 0.955)"
			});
		});
	</script>

<?php } ?>