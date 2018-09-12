<?php
extract( shortcode_atts( array(
	'loop'         => '',
	'posts_in_row' => 3,
	'css'          => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if ( empty( $loop ) ) {
	return;
}

$query = false;

list( $loop_args, $query ) = vc_build_loop_query( $loop, get_the_ID() );

if ( ! $query ) {
	return;
}
?>

<?php if ( $query->have_posts() ) { ?>

	<div class="posts_grid<?php echo esc_attr( $css_class ); ?> <?php echo 'posts_in_row_' . esc_attr( $posts_in_row ); ?>">
		<ul>
			<?php while ( $query->have_posts() ) { $query->the_post(); ?>

				<li>
					<div class="post_date">
						<div class="post_date_day"><?php echo get_the_date( 'd' ); ?></div>
						<div class="post_date_month"><?php echo get_the_date( 'M' ); ?></div>
						<div class="post_date_year"><?php echo get_the_date( 'Y' ); ?></div>
					</div>
					<div class="post_info">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="post_thumbnail">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumb-292x162' ); ?></a>
							</div>
						<?php } ?>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
					</div>
				</li>

			<?php } wp_reset_postdata(); ?>
		</ul>
	</div>

<?php } ?>