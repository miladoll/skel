<?php
    if ( skel::is_our_widgets_area_active( 'between-articles' ) ) :
?>
    <!--
        WIDGET AREA BETWEEN ARTICLES
    -->
    <div
        class="ui basic segment skel--gui--widgets-wrappers"
        data-skel-area="between-articles"
    >
        <aside
            class="skel--gui--widgets"
            data-skel-area="between-articles"
        >
            <?php
                skel::show_widgets_area('between-articles');
            ?>
        </aside>
    </div><!-- class="ui basic segment" -->
<?php
    endif;
?>
