<?php
    if ( skel::is_our_widgets_area_active( 'footer-full-width' ) ) :
?>
    <!--
        WIDGET AREA FULL WIDTH FOOTER
    -->
    <div
        class="ui basic segment skel--gui--widgets-wrappers"
        data-skel-area="footer-full-width"
    >
        <aside
            class="skel--gui--widgets"
            data-skel-area="footer-full-width"
        >
            <?php
                skel::show_widgets_area('footer-full-width');
            ?>
        </aside>
    </div><!-- class="ui basic segment" -->
<?php
    endif;
?>
