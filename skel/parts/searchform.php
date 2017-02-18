<form
    action="<?php echo esc_url( home_url( '/' ) ); ?>"
    method="get"
    role="search"
    class="ui small action input widget-parts-site-search skel--gui--forms searchform search-form"
>
    <input
        type="text"
        name="s"
        value="<?php the_search_query(); ?>"
        placeholder="<?php _e('keywords', 'skel'); ?>"
    >
    <button
        type="button"
        class="ui button"
    >
        <?php _e('Search', 'skel'); ?>
    </button>
</form><!-- class="widget-parts-site-search" -->
