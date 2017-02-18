<!--
    SITE GLOBAL MENU : STICKY WHEN SEMANTIC UI IS VALID
-->
<nav id="menu-site-global" class="ui sticky menus skel--sticky-menus">
    <ul class="ui mini menu">
        <?php if ( get_option( 'site_icon' ) ) : ?>
            <li class="item">
                <a
                    href="<?php echo home_url(); ?>"
                    title="<?php _e('Home', 'skel'); ?>"
                >
                    <img
                        class="ui image"
                        src="<?php echo wp_get_attachment_url( get_option( 'site_icon' ) ); ?>"
                    >
                </a>
            </li>
        <?php endif ?>
        <?php
            wp_nav_menu([
                'theme_location' => 'location__menu_site_global',
                'menu' => 'menu_site_global',
                'fallback_cb' => function() { return; },
                'container' => false,
                'items_wrap' => '%3$s',
            ]);
        ?>
        <?php
            call_user_func( function() {
                $menu = wp_nav_menu([
                    'theme_location' => 'location__menu_site_global_aside',
                    'menu' => 'menu_site_global_aside',
                    'fallback_cb' => function() { return; },
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'echo' => false
                ]);
                if ( $menu ) {
                    echo preg_replace( '/(class=")/', '${1}right aligned ', $menu );
                }
            } );
        ?>
    </ul>
</nav>
