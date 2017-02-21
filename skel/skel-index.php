<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
    <?php
        skel::include_parts( '/skel/parts/html-head-content.php' );
    ?>
    <!--
        WORDPRESS PROPER HEADERS
    -->
    <?php wp_head(); ?>
    <?php
        skel::include_parts( '/skel/parts/html-head-content-customizer.php' );
    ?>
</head>

<body <?php body_class(); ?> class="ui rail">

<?php
    skel::include_parts( '/skel/parts/html-post-body-start-tag.php' );
?>

<div id="page-whole" class="ui vertical segment">

    <!--
        SITE GLOBAL MENU : STICKY WHEN SEMANTIC UI IS VALID
    -->
    <?php
        skel::include_parts( '/skel/parts/menu-siteglobal.php' );
    ?>

    <!--
        SITE GLOBAL HEADER
    -->
    <?php
        skel::include_parts( '/skel/parts/page-header-siteglobal.php' );
    ?>

    <!--
        WIDGET AREA FULL WIDTH HEADER
    -->
    <?php
        skel::include_parts( '/skel/parts/widget-header-full-width.php' );
    ?>

    <!--
        WIDGET AREA UNDER TOP COLUMN
    -->
    <?php
        skel::include_parts( '/skel/parts/widget-header-trinity.php' );
    ?>

    <div class="ui clearing basic segment">

        <div id="page-body" class="ui clearing stackable not-divided grid">

            <?php
                if (
                    skel::prop('basis_of_design__set_sidebar_right')
                    !== 'right'
                ) :
            ?>
                <!-- five wide column -->
                <aside
                    class="ui five wide column skel--gui--widgets"
                    data-skel-area="articles-asides"
                    data-skel-location-tag="preface"
                >
                    <?php
                        skel::show_widgets_area('body-aside');
                    ?>
                </aside><!-- class="skel--gui--widget-articles-asides" -->
            <?php
                endif;
            ?>

            <main class="ui clearing eleven wide column">
                <?php
                    skel::include_parts( '/skel/parts/page-main.php' );
                ?>
            </main>

            <?php
                if (
                    skel::prop('basis_of_design__set_sidebar_right')
                    === 'right'
                ) :
            ?>
                <!-- five wide column -->
                <aside
                    class="ui five wide column skel--gui--widgets"
                    data-skel-area="articles-asides"
                    data-skel-location-tag="postface"
                >
                    <?php
                        skel::show_widgets_area('body-aside');
                    ?>
                </aside><!-- class="skel--gui--widget-articles-asides" -->
            <?php
                endif;
            ?>

        </div><!-- id="page-body" -->

    </div><!-- class="ui basic segment" -->

    <!--
        WIDGET AREA FULL WIDTH FOOTER
    -->
    <?php
        skel::include_parts( '/skel/parts/widget-footer-full-width.php' );
    ?>

    <?php
        skel::include_parts( '/skel/parts/jumptotop.php' );
    ?>

    <hr class="ui hidden divider">

    <?php
        skel::include_parts( '/skel/parts/page-footer.php' );
    ?>

</div><!-- id="page-whole" -->

<!--
    WORDPRESS PROPER FOOTERS
-->
<?php wp_footer(); ?>
</body>
</html>
