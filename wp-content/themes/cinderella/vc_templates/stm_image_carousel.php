<?php
extract( shortcode_atts( array(
	'images'          => '',
	'img_size'        => 'image_carousel',
	'slides_per_view' => '4',
	'el_class'        => '',
	'css'             => ''
), $atts ) );

wp_enqueue_style( 'slick.css' );
wp_enqueue_script( 'slick.min.js' );
wp_enqueue_script( 'prettyphoto' );
wp_enqueue_style( 'prettyphoto' );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'stm_image_carousel ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

if ( $images == '' ) {
	$images = '-1,-2,-3';
}

$images      = explode( ',', $images );
$id          = rand();
$pretty_rand = 'rel="prettyPhoto[rel-' . get_the_ID() . '-' . $id . ']"';
?>

<div class="<?php echo esc_attr( $css_class ); ?>">
	<div class="slick_carousel" id="slick_carousel_<?php echo esc_attr( $id ); ?>">

		<?php foreach ( $images as $attach_id ) { ?>
			<?php
			if ( $attach_id > 0 ) {
				$post_thumbnail = wpb_getImageBySize( array(
					'attach_id'  => $attach_id,
					'thumb_size' => $img_size
				) );
			} else {
				$post_thumbnail                   = array();
				$post_thumbnail['thumbnail']      = '<img src="' . esc_url( vc_asset_url( 'vc/no_image.png' ) ) . '" />';
				$post_thumbnail['p_img_large'][0] = esc_url( vc_asset_url( 'vc/no_image.png' ) );
			}
			$thumbnail = $post_thumbnail['thumbnail'];
			?>
			<div class="slick_item">
				<?php $p_img_large = $post_thumbnail['p_img_large']; ?>
				<a class="prettyphoto" href="<?php echo esc_url( $p_img_large[0] ); ?>" <?php echo $pretty_rand; ?>>
					<?php echo $thumbnail; ?>
				</a>
			</div>
		<?php } ?>

	</div>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$('#slick_carousel_<?php echo esc_js( $id ); ?>').slick({
				infinite: true,
				slidesToShow: <?php echo esc_js( $slides_per_view ); ?>,
				slidesToScroll: 1,
				prevArrow: "<div class=\"slick_prev\"></div>",
				nextArrow: "<div class=\"slick_next\"></div>",
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
							infinite: true,
							dots: true
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		});
	</script>
</div>