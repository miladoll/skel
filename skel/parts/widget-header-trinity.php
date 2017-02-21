<?php
    if (
        skel::is_our_widgets_area_active( 'header-left' )
        || skel::is_our_widgets_area_active( 'header-center' )
        || skel::is_our_widgets_area_active( 'header-right' )
    ) :
?>
    <!--
        WIDGET AREA UNDER TOP COLUMN
    -->
    <div
        class="ui clearing basic segment skel--gui--widgets-wrappers"
        data-skel-area="header-trinity"
    >
        <aside
            class="ui stackable equal width grid skel--gui--widgets"
            data-skel-area="header-trinity"
        >
            <div
                class="column skel--gui--widgets"
                data-skel-area="header-left"
            >
                <?php
                    skel::show_widgets_area('header-left');
                ?>
            </div>
            <div
                class="column skel--gui--widgets"
                data-skel-area="header-center"
            >
                <?php
                    skel::show_widgets_area('header-center');
                ?>
            </div>
            <div
                class="column skel--gui--widgets"
                data-skel-area="header-right"
            >
                <?php
                    skel::show_widgets_area('header-right');
                ?>
            </div>
        </aside>
    </div>
<?php
    endif;
?>
