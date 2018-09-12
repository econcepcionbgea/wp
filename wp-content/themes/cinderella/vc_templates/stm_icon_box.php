<?php
extract( shortcode_atts( array(
	'title'       => '',
	'link'        => '',
	'icon'        => '',
	'icon_size'   => '65',
	'icon_height' => '65',
	'icon_width'  => '50',
	'style'       => 'icon_top',
	'css'         => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$link      = vc_build_link( $link );
?>

<?php if ( $style == 'icon_left' ) { ?>

	<div class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">

		<?php if ( $icon ) { ?>
			<div class="icon" style="width: <?php echo esc_attr( $icon_width ); ?>px;"><i style="font-size: <?php echo esc_attr( $icon_size ); ?>px;" class="<?php echo esc_attr( $icon ); ?>"></i></div>
		<?php } ?>

		<div class="icon_text">
			<?php if ( $title ) { ?>

				<?php if ( $link['url'] ) {

					if ( ! $link['target'] ) {
						$link['target'] = '_self';
					} ?>
					<h4><a target="<?php echo esc_attr( $link['target'] ); ?>" href="<?php echo esc_attr( $link['url'] ); ?>"><?php echo esc_html( $title ); ?></a></h4>

				<?php } else { ?>
					<h4><?php echo esc_html( $title ); ?></h4>
				<?php } ?>

			<?php } ?>
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>
	</div>

<?php } else { ?>

	<div class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">

		<?php if ( $icon ) { ?>
			<div class="icon" style="height: <?php echo esc_attr( $icon_height ); ?>px;"><i style="font-size: <?php echo esc_attr( $icon_size ); ?>px;" class="<?php echo esc_attr( $icon ); ?>"></i></div>
		<?php } ?>

		<div class="icon_text">
			<?php if ( $title ) { ?>

				<?php if ( $link['url'] ) {
					if ( ! $link['target'] ) {
						$link['target'] = '_self';
					} ?>
					<h4><a target="<?php echo esc_attr( $link['target'] ); ?>" href="<?php echo esc_attr( $link['url'] ); ?>"><?php echo esc_html( $title ); ?></a></h4>

				<?php } else { ?>
					<h4><?php echo esc_html( $title ); ?></h4>
				<?php } ?>

			<?php } ?>
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>
	</div>

<?php } ?>