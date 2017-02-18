<?php
    if ( skel::is_our_widgets_area_active( 'header-full-width' ) ) :
?>
    <!--
        WIDGET AREA FULL WIDTH HEADER
    -->
    <div
        class="ui basic segment skel--gui--widgets-wrappers"
        data-skel-area="header-full-width"
    >
        <aside
            class="skel--gui--widgets"
            data-skel-area="header-full-width"
        >
            <?php
                skel::show_widgets_area('header-full-width');
            ?>
        </aside>
    </div><!-- class="ui basic segment" -->
<?php
    endif;
?>
