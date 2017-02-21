<?php
    call_user_func( function() {
        $dat = skel::get_current_post_data();
?>
        <meta
            property="og:locale"
            content="<?php echo get_locale(); ?>"
        />
        <meta
            property="og:type"
            content="website"
        />
        <meta
            property="og:title"
            content="<?php echo esc_attr( $dat['flourish_title'] ); ?>"
        />
        <meta
            property="og:description"
            content="<?php echo esc_attr( $dat['description'] ); ?>"
        />
        <meta
            property="og:url"
            content="<?php echo esc_attr( $dat['url'] ); ?>"
        />
        <meta
            property="og:site_name"
            content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
        />
<?php
    } );
?>
