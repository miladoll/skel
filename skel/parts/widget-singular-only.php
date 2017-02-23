<?php
    if (
        skel::is_our_widgets_area_active( $skel_widget_area )
        && is_singular()
        ) :
?>
    <div
        class="ui clearing basic segment skel--gui--widgets-wrappers"
        data-skel-area="<?php echo $skel_widget_area; ?>"
    >
        <aside
            class="ui stackable equal width grid skel--gui--widgets"
            data-skel-area="<?php echo $skel_widget_area; ?>"
        >
            <?php
                skel::show_widgets_area( $skel_widget_area );
            ?>
        </aside>
    </div>
<?php
    endif;
?>
