<?php
extract( shortcode_atts( array(
	'title'       => '',
	'link'        => '',
	'description' => '',
	'height'      => '310',
	'css'         => ''
), $atts ) );

$link = vc_build_link( $link );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>
<div class="promo_block<?php echo esc_attr( $css_class ); ?>" style="height: <?php echo esc_attr( $height ); ?>px;">
	<div class="promo_block_wr">

		<div class="promo_title">

			<div class="promo_title-separator_wrap">
				<span class="promo_title-separator"></span>
			</div>

			<div class="title"><?php echo esc_html( $title ); ?></div>

			<div class="promo_title-separator_wrap">
				<span class="promo_title-separator"></span>
			</div>

		</div>

		<div class="promo_description"><h3 class="h1"><?php echo esc_html( $description ); ?></h3></div>
		<?php
		if ( $link['url'] ) {
			if ( ! $link['target'] ) {
				$link['target'] = '_self';
			}
			echo '<a class="promo_link" target="' . esc_attr( $link['target'] ) . '" href="' . esc_url( $link['url'] ) . '"></a>';
		}
		?>
	</div>
</div>