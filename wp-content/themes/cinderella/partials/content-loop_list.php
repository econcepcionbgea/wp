<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post_date">
		<div class="post_date_day"><?php echo get_the_date( 'd' ); ?></div>
		<div class="post_date_month"><?php echo get_the_date( 'M' ); ?></div>
		<div class="post_date_year"><?php echo get_the_date( 'Y' ); ?></div>
	</div>
	<div class="post_info">
		<div class="post_thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumb-800x370' ); ?></a>
		</div>
		<?php if( get_the_title() ){ ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php } ?>
		<?php the_excerpt(); ?>
		<ul class="post_details">
			<?php if( has_tag() ){ ?>
				<li>
					<?php the_tags(); ?>
				</li>
			<?php } ?>
			<li><span><?php _e( 'Comments:', 'cinderella' ); ?></span> <a href="<?php comments_link(); ?>"><?php comments_number( 0 ); ?> </a></li>
			<li><span><?php _e( 'Posted by:', 'cinderella' ); ?></span> <?php the_author(); ?></li>
		</ul>
		<a class="button" href="<?php the_permalink(); ?>"><?php _e( 'READ MORE', 'cinderella' ); ?></a>
	</div>
</li>