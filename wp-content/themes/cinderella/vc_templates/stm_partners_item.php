<?php
extract( shortcode_atts( array(
	'title'       => '',
	'logo'        => 'thumbnail',
	'img_size'    => '',
	'description' => '',
	'link'        => '',
), $atts ) );

$logo = wpb_getImageBySize( array( 'attach_id' => $logo, 'thumb_size' => $img_size ) );
$link = vc_build_link( $link );

if ( $link['url'] ) {
	if ( ! $link['target'] ) {
		$link['target'] = '_self';
	}
}
?>

<li>

	<?php if ( $logo['thumbnail'] ) { ?>
		<div class="logo">
			<?php
			if ( $link['url'] ) {
				echo '<a target="' . esc_attr( $link['target'] ) . '" href="' . esc_url( $link['url'] ) . '">';
			}

			echo $logo['thumbnail'];

			if ( $link['url'] ) {
				echo '</a>';
			}
			?>
		</div>
	<?php } ?>

	<div class="text">
		<h4>
			<?php
			if ( $link['url'] ) {
				echo '<a target="' . esc_attr( $link['target'] ) . '" href="' . esc_url( $link['url'] ) . '">';
			}

			echo esc_html( $title );

			if ( $link['url'] ) {
				echo '</a>';
			}
			?>
		</h4>
		<?php echo wpb_js_remove_wpautop( $description, true ); ?>
	</div>

</li>