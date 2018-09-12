<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post_date">
		<div class="post_date_day"><?php echo get_the_date( 'd' ); ?></div>
		<div class="post_date_month"><?php echo get_the_date( 'M' ); ?></div>
		<div class="post_date_year"><?php echo get_the_date( 'Y' ); ?></div>
	</div>
	<div class="post_info">
		<?php if( has_post_thumbnail() ){ ?>
			<div class="post_thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumb-292x162' ); ?></a>
			</div>
		<?php } ?>
		<?php if( get_the_title() ){ ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php } ?>
		<p><?php echo get_the_excerpt(); ?></p>
		<a class="button" href="<?php the_permalink(); ?>"><?php _e( 'READ MORE', 'cinderella' ); ?></a>
	</div>
</li>