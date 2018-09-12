<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$categories = get_terms( array( 'service_category' ) );

?>
<?php if ( $categories ) { ?>
	<div class="stm_pricing_list<?php echo esc_attr( $css_class ); ?>">

		<div class="stm_pricing_list_categories">
			<ul>
				<?php foreach ( $categories as $category ) { ?>
					<li><a class="js-anchor-link" href="#service-price-<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
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

				<div class="stm_pricing_list_block">
					<h3 id="service-price-<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></h3>

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

			<?php }
		} ?>
	</div>
<?php } ?>