<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'stm_services_tabs ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
wp_enqueue_script( 'jquery-effects-core' );
wp_enqueue_script( 'jquery-ui-tabs' );

$categories = get_terms( array( 'service_category' ) );

?>
<?php if ( $categories ) { ?>
	<div class="<?php echo esc_attr( $css_class ); ?>">

		<div class="services_categories">
			<ul class="clearfix">
				<?php foreach ( $categories as $category ) { ?>
					<li>
						<a href="#service-tab-<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
					</li>
				<?php } ?>
			</ul>
		</div>

		<?php foreach ( $categories as $category ) { ?>
			<?php
			$args  = array(
				'post_type'        => 'service',
				'service_category' => $category->slug
			);
			$posts = new WP_Query( $args );
			?>
			<?php if ( $posts->have_posts() ) { ?>
				<div class="services_tabs" id="service-tab-<?php echo esc_attr( $category->slug ); ?>">

					<?php while ( $posts->have_posts() ) { $posts->the_post(); ?>

						<div class="service_tab_item">
							<?php if ( $sticky = get_post_meta( get_the_ID(), 'sticky_text', true ) ) { ?>
								<div class="service_sticker"><?php echo esc_html( $sticky ); ?></div>
							<?php } ?>

							<div class="service_header">
								<div class="service_name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
								<div class="service_dots"><span class="separator_dots"></span></div>
								<div class="service_cost"><?php echo esc_html( get_post_meta( get_the_ID(), 'cost', true ) ); ?></div>
							</div>

							<div class="service_text">
								<?php the_excerpt(); ?>
							</div>
						</div>

					<?php } wp_reset_postdata(); ?>

				</div>
			<?php } ?>
		<?php } ?>

		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				"use strict";
				$(".stm_services_tabs").tabs({
					hide: 'fadeOut',
					show: 'fadeIn'
				});
			});
		</script>

	</div>
<?php } ?>