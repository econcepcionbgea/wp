<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( has_post_thumbnail() ){ ?>
		<div class="service_thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumb-370x280' ); ?></a>
		</div>
	<?php } ?>
	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	<?php the_excerpt(); ?>
</li>