<nav
    class="ui aligned basic compact segment skel--gui--breadcrumbs"
    data-skel-location-tag="<?php echo $skel_location_tag ?>"
>
    <ul class="ui breadcrumb">
        <li
            class="section"
            itemscope
            itemtype="http://data-vocabulary.org/Breadcrumb"
        >
            <a
                href="<?php echo esc_url( home_url() ); ?>"
                itemprop="url"
            >
                <i class="home icon"></i>
                <span
                    itemprop="title"
                >
                    <?php _e('Home', 'skel'); ?>
                </span>
            </a>
            <i class="right angle icon divider"></i>
        </li>
        <?php
            call_user_func( function() {
                $crumbs = skel::get_crumb();
                foreach ( $crumbs as $crumb ) {
        ?>
                    <li
                        class="section"
                        itemscope
                        itemtype="http://data-vocabulary.org/Breadcrumb"
                    >
                        <a
                            href="<?php echo esc_url($crumb['link']); ?>"
                            itemprop="url"
                            title="<?php echo esc_html($crumb['title']); ?>"
                        >
                            <span
                                itemprop="title"
                            >
                                <?php echo esc_html($crumb['title']); ?>
                            </span>
                        </a>
                        <i class="right angle icon divider"></i>
                    </li>
        <?php
                }
            } );
        ?>
    </ul>
</nav>
