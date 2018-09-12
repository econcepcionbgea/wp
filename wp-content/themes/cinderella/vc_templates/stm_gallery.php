<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'prettyphoto' );
wp_enqueue_style( 'prettyphoto' );

$css_class   = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$id          = rand();
$pretty_rand = ' data-gal="prettyPhoto[rel-' . get_the_ID() . '-' . $id . ']"';

if ( '' === $images ) {
	$images = '-1,-2,-3';
}
$images = explode( ',', $images );

$cats = array();

foreach ( $images as $attach_id ) {
	$post   = get_post( $attach_id );
	$cat_id = str_replace( array(" ", "/", "#", "'"), "_" , $post->post_excerpt );

	if ( ! isset( $cats[ $cat_id ] ) ) {
		$cats[ $cat_id ]['title'] = $post->post_excerpt;
	}

	if ( $attach_id > 0 ) {
		$post_thumbnail = wpb_getImageBySize( array(
			'attach_id'  => $attach_id,
			'thumb_size' => 'thumb-740x560'
		) );

	} else {
		$post_thumbnail                   = array();
		$post_thumbnail['thumbnail']      = '<img src="' . esc_url( vc_asset_url( 'vc/no_image.png' ) ) . '" />';
		$post_thumbnail['p_img_large'][0] = esc_url( vc_asset_url( 'vc/no_image.png' ) );

	}

	$cats[ $cat_id ]['images'][ $attach_id ] = array(
		'thumbnail'    => $post_thumbnail['thumbnail'],
		'p_img_large'  => $post_thumbnail['p_img_large'],
		'post_title'   => $post->post_title,
		'post_content' => $post->post_content
	);

}

?>

<?php if ( $cats ) { ?>

	<div
		class="gallery_grid_wrapper container<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $el_class ); ?>">
		<div id="gallery_grid_filter_<?php echo esc_attr( $id ); ?>" class="gallery_grid_filter clearfix">

			<ul class="clearfix">
				<li class="active"><a href="#all"><?php _e( 'All', 'cinderella' ); ?></a></li>

				<?php if ( $cats ) { ?>
					<?php foreach ( $cats as $key => $val ) { ?>
						<li><a href="#<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val['title'] ); ?></a></li>
					<?php } ?>
				<?php } ?>

			</ul>

			<a href="#" class="gallery_grid_switcher">
				<i class="fa fa-arrow-left left"></i>
				<i class="fa fa-arrow-right right"></i>
			</a>

		</div>
		<div id="gallery_grid_<?php echo esc_attr( $id ); ?>" class="gallery_grid clearfix">
			<?php foreach ( $cats as $key => $val ) { ?>
				<?php foreach ( $val['images'] as $attach_id => $image ) { ?>

					<div class="gallery all <?php echo esc_attr( $key ); ?>">
						<div class="gallery_wr">
							<?php echo $image['thumbnail']; ?>
							<div class="overlay"></div>
							<h4><?php echo esc_html( $image['post_title'] ); ?></h4>

							<p><?php echo esc_html( $image['post_content'] ); ?></p>
							<a href="<?php echo esc_url( $image['p_img_large'][0] ); ?>"<?php echo $pretty_rand; ?> class="prettyphoto"></a>
						</div>
					</div>


				<?php } ?>
			<?php } ?>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				var $container = $('#gallery_grid_<?php echo esc_js( $id ); ?>');
				$(window).load(function () {
					$container.isotope({
						itemSelector: '.gallery',
						transitionDuration: '0.7s'
					});
					$(".gallery_grid_switcher").live('click', function () {
						$(this).toggleClass('active');
						var $container_wrapper = $(this).closest('.gallery_grid_wrapper');
						if ($('body').hasClass('boxed_layout')) {
							$container_wrapper.toggleClass('wide');
						} else {
							$container_wrapper.toggleClass('wide container');
						}
						$container_wrapper.find('.gallery_grid_filter').toggleClass('container');
						$container.isotope('layout');
						$container.closest('.gallery_grid_wrapper').animate({'height': $container.height() + $('#gallery_grid_filter_<?php echo esc_js( $id ); ?>').height() + 60}, 300);
						return false;
					});

					var $container_filter = $('#gallery_grid_filter_<?php echo esc_js( $id ); ?> ul a').live('click', function () {
						$(this).closest('ul').find('li.active').removeClass('active');
						$(this).parent().addClass('active');
						var sort = $(this).attr('href');
						var sort = sort.substring(1);
						$container.isotope({
							filter: '.' + sort
						});
						$container.closest('.gallery_grid_wrapper').animate({'height': $container.height() + $('#gallery_grid_filter_<?php echo esc_js( $id ); ?>').height() + 60}, 300);
						return false;
					});
					$container.closest('.gallery_grid_wrapper').animate({'height': $container.height() + $('#gallery_grid_filter_<?php echo esc_js( $id ); ?>').height() + 60}, 300);
					$container.closest('.gallery_grid_wrapper').find('.gallery_preloader').fadeOut(300);
				});
			});
		</script>
		<div class="gallery_preloader"></div>
	</div>
<?php } ?>