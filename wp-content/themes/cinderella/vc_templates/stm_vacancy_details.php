<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>

<div class="stm_vacancy_details<?php echo esc_attr( $css_class ); ?>">

	<?php if ( $vacancy_department = get_post_meta( get_the_ID(), 'vacancy_department', true ) ) { ?>
		<dl>
			<dt><?php _e( 'Department:', 'cinderella' ); ?></dt>
			<dd><?php echo esc_html( $vacancy_department ); ?></dd>
		</dl>
	<?php } ?>

	<?php if ( $vacancy_location = get_post_meta( get_the_ID(), 'vacancy_location', true ) ) { ?>
		<dl>
			<dt><?php _e( 'Project Location(s):', 'cinderella' ); ?></dt>
			<dd><?php echo esc_html( $vacancy_location ); ?></dd>
		</dl>
	<?php } ?>

	<?php if ( $vacancy_job = get_post_meta( get_the_ID(), 'vacancy_job_type', true ) ) { ?>
		<dl>
			<dt><?php _e( 'Job Type:', 'cinderella' ); ?></dt>
			<dd><?php echo esc_html( $vacancy_job ); ?></dd>
		</dl>
	<?php } ?>

	<?php if ( $vacancy_education = get_post_meta( get_the_ID(), 'vacancy_education', true ) ) { ?>
		<dl>
			<dt><?php _e( 'Education:', 'cinderella' ); ?></dt>
			<dd><?php echo esc_html( $vacancy_education ); ?></dd>
		</dl>
	<?php } ?>

	<?php if ( $vacancy_compensation = get_post_meta( get_the_ID(), 'vacancy_compensation', true ) ) { ?>
		<dl>
			<dt><?php _e( 'Compensation:', 'cinderella' ); ?></dt>
			<dd><?php echo esc_html( $vacancy_compensation ); ?></dd>
		</dl>
	<?php } ?>
</div>