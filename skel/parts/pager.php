<?php
    call_user_func( function() use ( $skel_location_tag ) {
        // http://bit.ly/2lu4nCP
        $paginator = skel::get_paginator([]);
        if ( count( $paginator ) < 3 ) { return; }
?>
        <nav
            class="ui center aligned basic segment skel--gui--pagers"
            data-skel-location-tag="<?php echo $skel_location_tag ?>"
        >
            <div class="ui pagination menu">
                <?php
                    // prev
                    $item = array_shift( $paginator );
                ?>
                <a
                    class="item <?php echo ( $item['link'] == '' ) ? 'disabled' : ''; ?>"
                    href="<?php echo $item['link']; ?>"
                >
                    <i class="chevron left icon"></i>
                    <?php _e('Previous', 'skel'); ?>
                </a>
                <span>|</span>
                <?php
                    // mid
                    while ( count( $paginator ) > 1 ) {
                        $item = array_shift( $paginator );
                ?>
                        <a
                            class="<?php
                                echo
                                    ( $item['class'] == 'current' )
                                        ? 'active'
                                        : (
                                            ( $item['link'] == '' )
                                                ? 'disabled'
                                                : ''
                                        )
                                ;
                            ?> item"
                            href="<?php echo $item['link']; ?>"
                        >
                            <?php
                                echo
                                    ( preg_match( "/^[0-9]+$/", $item['number'] ) )
                                        ? $item['number']
                                        : '...'
                                ;
                            ?>
                        </a>
                        <span>|</span>
                <?php
                    }
                ?>
                <?php
                    // next
                    $item = array_shift( $paginator );
                ?>
                <a
                    class="item <?php echo ( $item['link'] == '' ) ? 'disabled' : ''; ?>"
                    href="<?php echo $item['link']; ?>"
                >
                    <?php _e('Next', 'skel'); ?>
                    <i class="chevron right icon"></i>
                </a>
            </div>
        </nav>
<?php
    } );
?>
