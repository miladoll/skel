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
        <?php endif; ?>
        <?php
            call_user_func( function() {
                $items = skel::get_nav_menu_arrays([
                    'theme_location' => 'location__menu_site_global',
                    'menu' => 'menu_site_global',
                    'fallback_cb' => function() { return; },
                    'container' => false,
                    'items_wrap' => '%3$s',
                ]);
                if ( $items ) :
                    foreach( $items as $item ) :
        ?>
                        <li
                            <?php echo $item['id_class']; ?>
                        >
                            <a
                                href="<?php echo $item['link']; ?>"
                            >
                                <?php echo $item['label']; ?>
                            </a>
                        </li>
        <?php
                    endforeach;
                endif;
            } );
        ?>
        <?php
            call_user_func( function() {
                $items = skel::get_nav_menu_arrays([
                    'theme_location' => 'location__menu_site_global_dropdown',
                    'menu' => 'menu_site_global_dropdown',
                    'fallback_cb' => function() { return; },
                    'container' => false,
                    'items_wrap' => '%3$s',
                ]);
                if ( $items ) :
                    $item = array_shift( $items );
        ?>
            <li class="ui dropdown item">
                <?php echo $item['label']; ?>
                <i class="dropdown icon"></i>
                <ul class="menu">
                    <?php
                        foreach( $items as $item ) :
                    ?>
                        <li
                            <?php echo $item['id_class']; ?>
                        >
                            <a
                                class="item"
                                href="<?php echo $item['link']; ?>"
                            >
                                <i class="ui folder outline icon"></i>
                                    <?php echo $item['label']; ?>
                            </a>
                        </li>
                    <?php
                        endforeach;
                    ?>
                </ul>
            </li>
        <?php
                endif;
            } );
        ?>
        <?php
            call_user_func( function() {
                $items = skel::get_nav_menu_arrays([
                    'theme_location' => 'location__menu_site_global_aside',
                    'menu' => 'menu_site_global_aside',
                    'fallback_cb' => function() { return; },
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'echo' => false
                ]);
                if ( $items ) :
        ?>
                    <ul class="right menu">
                        <?php
                            if (
                                self::prop('basis_of_design__disable_header_searchbox')
                                !== 'disable'
                            ) :
                        ?>
                            <li class="item skel--gui--global-search-in-headers">
                                <form
                                    action="<?php echo esc_url( home_url( '/' ) ); ?>"
                                    method="get"
                                    role="search"
                                >
                                    <div class="ui icon mini input">
                                        <input type="text" name="s" placeholder="<?php _e('Search', 'skel'); ?>">
                                        <i
                                            class="ui search link icon"
                                            onclick="this.parentNode.parentNode.submit();"
                                        ></i>
                                    </div>
                                </form>
                            </li>
                        <?php
                            endif;
                        ?>
                        <?php
                            foreach( $items as $item ) :
                        ?>
                            <li
                                <?php echo $item['id_class']; ?>
                            >
                                <a
                                    href="<?php echo $item['link']; ?>"
                                >
                                    <?php echo $item['label']; ?>
                                </a>
                            </li>
                        <?php
                            endforeach;
                        ?>
                    </ul>
        <?php
                endif;
            } );
        ?>
    </ul>
</nav>
