<!--
    PREV NEXT
-->
<nav class="skel--gui--nav-prev-nexts">
    <?php
        call_user_func( function() {
            $echo_post_url = function ( $the_post ) {
                echo esc_url(
                    get_permalink( $the_post, true )
                );
            };
            $previous_post = get_next_post();
            $next_post = get_previous_post();
            if ( !empty( $previous_post )  ) :
    ?>
                <a
                    href="<?php $echo_post_url( $previous_post ); ?>"
                    title="<?php echo esc_html( $previous_post->post_title ); ?>"
                    class="ui left floated left labeled basic icon compact button"
                >
                    <i class="chevron circle left icon"></i>
                    <span><?php _e('Next Article', 'skel'); ?></span><br>
                    <span><?php echo esc_html( $previous_post->post_title ); ?></span>
                </a>
    <?php
            endif;
    ?>
    <?php
            if ( !empty( $previous_post ) && !empty( $next_post )  ) :
    ?>
                <span>|</span>
    <?php
            endif;
    ?>
    <?php
            if ( !empty( $next_post )  ) :
    ?>
                <a
                    href="<?php $echo_post_url( $next_post ); ?>"
                    title="<?php echo esc_html( $next_post->post_title ); ?>"
                    class="ui right floated right labeled basic icon compact button"
                >
                    <span><?php _e('Previous Article', 'skel'); ?></span><br>
                    <span><?php echo esc_html( $next_post->post_title ); ?></span>
                    <i class="chevron circle right icon"></i>
                </a>
    <?php
            endif;
        } );
    ?>
</nav><!-- class="skel--gui--nav-prev-nexts" -->
