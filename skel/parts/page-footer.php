<footer
    id="page-footer"
    class="ui padded vertical top attached secondary segment"
    role="contentinfo"
>

    <!--
        WIDGET AREA FOOTER TRINITY
    -->
    <?php
        skel::include_parts( '/skel/parts/widget-footer-trinity.php' );
    ?>

    <hr class="ui hidden divider">

    <div class="ui stackable two column centered grid">
        <div id="skel--gui--footer-credit-aside" class="column skel--centers">
            <ul
                class="skel--gui--credit-aside-sns"
            >
                <?php
                    call_user_func( function() {
                        skel::include_parts(
                            '/skel/parts/list-sns.php',
                            [
                                'owner_name' => skel::prop('sns__ownername', '')
                            ]
                        );
                    } );
                ?>
            </ul>
        </div>
    </div>

    <div class="ui stackable two column centered grid">
        <div id="site-credit" class="column skel--centers">
            &copy; <a href=""><?php bloginfo( 'name' ); ?></a>
        </div>
    </div>

    <hr class="ui hidden divider">

</footer><!-- id="page-footer" role="contentinfo" -->
