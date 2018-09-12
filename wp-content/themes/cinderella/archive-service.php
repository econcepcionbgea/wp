<?php get_header(); ?>
	<?php

		$blog_sidebar_id = stm_option( 'blog_sidebar' );
		$blog_sidebar_position = stm_option( 'blog_sidebar_position', 'none');
		$content_before = $content_after =  $sidebar_before = $sidebar_after = '';

		if( !empty( $_GET['sidebar_id'] ) ){
			$blog_sidebar_id = intval( $_GET['sidebar_id'] );
		}

		if( $blog_sidebar_id ) {
			$blog_sidebar = get_post( $blog_sidebar_id );
		}

		if( $blog_sidebar_position == 'right' && isset( $blog_sidebar ) ) {
			$content_before .= '<div class="row">';
			$content_before .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';
			$content_before .= '<div class="col_in __padd-right __three-cols">';

			$content_after .= '</div>'; // col_in
			$content_after .= '</div>'; // col
			$sidebar_before .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
			// .sidebar-area
			$sidebar_after .= '</div>'; // col
			$sidebar_after .= '</div>'; // row
		}

		if( $blog_sidebar_position == 'left' && isset( $blog_sidebar ) ) {
			$content_before .= '<div class="row">';
			$content_before .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';
			$content_before .= '<div class="col_in __padd-left __three-cols">';

			$content_after .= '</div>'; // col_in
			$content_after .= '</div>'; // col
			$sidebar_before .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
			// .sidebar-area
			$sidebar_after .= '</div>'; // col
			$sidebar_after .= '</div>'; // row
		}

	?>
	<div class="content-area">
		<?php get_template_part( 'partials/title_box' ); ?>
		<?php echo $content_before; ?>
			<?php if( have_posts() ){ ?>
				<div class="service_list">
					<ul>
						<?php
							while ( have_posts() ) { the_post();
								get_template_part( 'partials/content', 'loop_service' );
							}
						?>
					</ul>
				</div>
				<?php
				echo paginate_links( array(
					'type'      => 'list',
					'prev_text' => '<i class="fa fa-arrow-left"></i>',
					'next_text' => '<i class="fa fa-arrow-right"></i>',
				) );
				?>
			<?php }else{ ?>
				<?php get_template_part( 'partials/content', 'none' ); ?>
			<?php } ?>
		<?php echo $content_after; ?>
		<?php echo $sidebar_before; ?>

		<?php if( isset( $blog_sidebar ) && $blog_sidebar_position != 'none' ) { ?>
			<div class="sidebar-area">
				<?php
					echo apply_filters( 'the_content' , $blog_sidebar->post_content);
				?>
			</div>
		<?php } ?>

		<?php echo $sidebar_after; ?>
	</div>

<?php get_footer(); ?>