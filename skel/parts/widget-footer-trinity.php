<?php
    if (
        skel::is_our_widgets_area_active( 'footer-left' )
        || skel::is_our_widgets_area_active( 'footer-center' )
        || skel::is_our_widgets_area_active( 'footer-right' )
    ) :
?>
    <!--
        WIDGET AREA FOOTER TRINITY
    -->
    <div
        class="ui basic segment skel--gui--widgets-wrappers"
        data-skel-area="footer-trinity"
    >
        <aside
            class="ui stackable equal width grid skel--gui--widgets"
            data-skel-area="footer-trinity"
        >
            <div
                class="column skel--gui--widgets"
                data-skel-area="footer-left"
            >
                <?php
                    skel::show_widgets_area('footer-left');
                ?>
            </div>
            <div
                class="column skel--gui--widgets"
                data-skel-area="footer-center"
            >
                <?php
                    skel::show_widgets_area('footer-center');
                ?>
            </div>
            <div
                class="column skel--gui--widgets"
                data-skel-area="footer-right"
            >
                <?php
                    skel::show_widgets_area('footer-right');
                ?>
            </div>
        </aside>
    </div>
<?php
    endif;
?>
