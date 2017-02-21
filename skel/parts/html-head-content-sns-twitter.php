<?php
    if ( skel::prop('sns__twitter') != '' ) :
        call_user_func( function() {
            $dat = skel::get_current_post_data();
?>
            <meta name="twitter:card" content="summary_large_image" />
            <meta
                name="twitter:title"
                content="<?php echo esc_attr( mb_substr( $dat['flourish_title'], 0, 80 ) ); ?>"
            />
            <meta
                name="twitter:description"
                content="<?php echo esc_attr( $dat['description'] ); ?>"
            />
            <meta
                name="twitter:site"
                content="@<?php echo skel::prop( 'sns__twitter', 'none' ); ?>"
            />
            <meta
                name="twitter:image"
                <?php
                    if ( $dat['eyecatch'] ) {

                ?>
                        content="<?php echo esc_attr( $dat['eyecatch'] ); ?>"
                <?php
                    } else {
                ?>
                        content="https://s.wordpress.com/mshots/v1/<?php echo urlencode( $dat['url'] ); ?>?w=100"
                <?php
                    }
                ?>
            />
<?php
        } );
    endif;
?>
