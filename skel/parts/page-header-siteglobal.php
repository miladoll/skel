<!--
    SITE GLOBAL HEADER
-->
<header id="skel--page-header" role="banner">
    <!--
        SITE TITLE HEADING
    -->
    <h1 class="ui header">
        <span>
            <?php if ( get_option( 'site_icon' ) ) : ?>
                <a
                    href="<?php echo home_url(); ?>"
                    title="<?php _e('Home', 'skel'); ?>"
                >
                    <img
                        class="ui rounded tiny image skel--site-icons"
                        src="<?php echo wp_get_attachment_url( get_option( 'site_icon' ) ); ?>"
                    >
                </a>
            <?php endif ?>
            <a
                href="<?php echo home_url(); ?>"
                title="<?php _e('Home', 'skel'); ?>"
                id="skel--page-header-content"
            >
                <span id="site-name"><?php bloginfo( 'name' ); ?></span>
                <div id="site-description" class="sub header">
                    <?php bloginfo( 'description' ); ?>
                </div>
            </a><!-- id="skel--page-header-content" -->
        </span>
    </h1>
</header><!-- id="skel--page-header" role="banner" -->
