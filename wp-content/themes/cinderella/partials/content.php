<?php $vc_status = get_post_meta( get_the_ID() , '_wpb_vc_js_status', true); ?>
<?php if( $vc_status != 'false' && $vc_status == true ){ ?>
	<div class="content-area">
		<?php get_template_part( 'partials/title_box' ); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
		    <div class="entry-content">
		        <?php the_content(); ?>
		        <?php
		        wp_link_pages( array(
		            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cinderella' ) . '</span>',
		            'after'       => '</div>',
		            'link_before' => '<span>',
		            'link_after'  => '</span>',
		            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'cinderella' ) . ' </span>%',
		            'separator'   => '<span class="screen-reader-text">, </span>',
		        ) );
		        ?>
		    </div>
		
		</article>
	</div>
<?php }else{ ?>
	<?php 
		$blog_sidebar_id = stm_option( 'blog_sidebar' );
		$blog_sidebar_position = stm_option( 'blog_sidebar_position', 'none' );
		$content_before = $content_after =  $sidebar_before = $sidebar_after = '';
		
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
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			    <div class="entry-content">
				    <div class="wp_content">
					    <div class="stm_post_info">
						    <div class="post_info">
							    <?php if( has_post_thumbnail() ){ ?>
								    <div class="post_thumbnail">
									    <?php the_post_thumbnail( 'thumb-9999x360' ); ?>
								    </div>
								<?php } ?>
							    <ul class="post_details">
								    <li><?php echo get_the_date(); ?></li>
								    <li><span><?php _e( 'Comments:', 'cinderella' ); ?></span> <a href="<?php comments_link(); ?>"><?php comments_number( 0 ); ?> </a></li>
								    <li><span><?php _e( 'Posted by:', 'cinderella' ); ?></span> <?php the_author(); ?></li>
							    </ul>
						    </div>
					    </div>
						<?php if( get_the_content() ){ ?>
							<div class="text_block clearfix">
								<?php the_content(); ?>
							</div>
						<?php } ?>
						<?php
					        wp_link_pages( array(
					            'before'      => '<div class="page-links"><label>' . __( 'Pages:', 'cinderella' ) . '</label>',
					            'after'       => '</div>',
					            'link_before' => '<span>',
					            'link_after'  => '</span>',
					            'pagelink'    => '%',
					            'separator'   => '',
					        ) );
				        ?>
					    <?php if( has_tag() ){ ?>
						    <div class="tagcloud">
							    <?php the_tags( '', '' ); ?>
						    </div>
					    <?php } ?>
					    <?php if ( comments_open() || get_comments_number() ) { ?>
						    <div class="stm_post_comments">
							    <?php comments_template(); ?>
						    </div>
					    <?php } ?>
				    </div>
			    </div>
			
			</article>
		<?php echo $content_after; ?>
		<?php echo $sidebar_before; ?>
			<?php if( isset( $blog_sidebar ) && $blog_sidebar_position != 'none' ) { ?>
				<div class="sidebar-area">
					<?php echo apply_filters( 'the_content' , $blog_sidebar->post_content);	?>
				</div>
			<?php } ?>
		<?php echo $sidebar_after; ?>
	</div>
<?php } ?>