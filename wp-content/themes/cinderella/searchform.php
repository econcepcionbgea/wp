<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" placeholder="<?php _e( 'Search...', 'cinderella' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="button"><i class="fa fa-search"></i></button>
</form>