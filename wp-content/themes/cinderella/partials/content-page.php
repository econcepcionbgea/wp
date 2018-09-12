<?php get_template_part( 'partials/title_box' ); ?>
<?php $vc_status = get_post_meta( get_the_ID() , '_wpb_vc_js_status', true); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content">
	    <?php if( $vc_status != 'false' && $vc_status == true ){ ?>
	        <?php the_content(); ?>
        <?php }else{ ?>
        	<div class="text_block clearfix">
				<?php the_content(); ?>
			</div>
        <?php } ?>
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
    <?php
	    if ( comments_open() || get_comments_number() ) {
	        comments_template();
	    }
    ?>

</article>
