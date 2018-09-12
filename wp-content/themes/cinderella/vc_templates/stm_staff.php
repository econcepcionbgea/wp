<?php
extract( shortcode_atts( array(
	'name'             => '',
	'image'            => '',
	'image_size'       => 'thumb-350x350',
	'job'              => '',
	'description'      => '',
	'full_description' => '',
	'style'            => '',
	'facebook'         => '',
	'twitter'          => '',
	'linkedin'         => '',
	'css'              => '',
), $atts ) );

$css_class   = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$staff_image = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $image_size ) );
?>

<?php if ( $style == 'style_2' ) { ?>

	<div class="stm_staff_2<?php echo esc_attr( $css_class ); ?>">

		<?php if ( $staff_image['thumbnail'] ) { ?>
			<div class="staff_image">
				<?php echo $staff_image['thumbnail']; ?>
			</div>
		<?php } ?>

		<div class="staff_info">

			<?php if ( $name ) { ?>
				<h4><?php echo esc_html( $name ); ?></h4>
			<?php } ?>

			<?php if ( $job ) { ?>
				<div class="job"><?php echo esc_html( $job ); ?></div>
			<?php } ?>

			<?php echo wpb_js_remove_wpautop( $description, true ); ?>

			<?php if ( $facebook || $twitter || $linkedin ) { ?>
				<div class="staff_socials">
					<ul>
						<?php if ( $facebook ) { ?>
							<li><a href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook"></i></a></li>
						<?php } ?>
						<?php if ( $twitter ) { ?>
							<li><a href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter"></i></a></li>
						<?php } ?>
						<?php if ( $linkedin ) { ?>
							<li><a href="<?php echo esc_url( $linkedin ); ?>"><i class="fa fa-linkedin"></i></a></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
		</div>
	</div>

<?php } else { ?>

	<div class="stm_staff<?php echo esc_attr( $css_class ); ?>">
		<?php if ( $staff_image['thumbnail'] ) { ?>
			<div class="staff_image">
				<?php echo $staff_image['thumbnail']; ?>
				<?php if ( $facebook || $twitter || $linkedin ) { ?>
					<div class="staff_socials">
						<ul>
							<?php if ( $facebook ) { ?>
								<li><a href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook"></i></a></li>
							<?php } ?>
							<?php if ( $twitter ) { ?>
								<li><a href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter"></i></a></li>
							<?php } ?>
							<?php if ( $linkedin ) { ?>
								<li><a href="<?php echo esc_url( $linkedin ); ?>"><i class="fa fa-linkedin"></i></a></li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if ( $name ) { ?>
			<h4><?php echo esc_html( $name ); ?></h4>
		<?php } ?>

		<?php if ( $job ) { ?>
			<div class="job"><?php echo esc_html( $job ); ?></div>
		<?php } ?>

		<?php echo wpb_js_remove_wpautop( $description, true ); ?>
	</div>

<?php } ?>