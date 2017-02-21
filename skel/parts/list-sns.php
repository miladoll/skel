<?php
    if ( skel::prop('sns__facebook') != '' ) :
?>
    <li>
        <a
            href="https://twitter.com/<?php echo skel::prop( 'sns__twitter', 'none' ); ?>"
            title="<?php
                echo esc_html( sprintf( __('Visit Facebook page of %s'), $owner_name ) );
            ?>"
            target="_blank"
        >
            <i class="ui facebook icon"></i>
            <?php echo skel::prop( 'sns__facebook', 'none' ); ?>
        </a>
    </li>
<?php
    endif;
?>
<?php
    if ( skel::prop('sns__twitter') != '' ) :
?>
    <li>
        <a
            href="https://twitter.com/<?php echo skel::prop( 'sns__twitter', 'none' ); ?>"
            title="<?php
                echo esc_html( sprintf( __('Check tweets of %s'), $owner_name ) );
            ?>"
            target="_blank"
        >
            <i class="ui twitter icon"></i>
            @<?php echo skel::prop( 'sns__twitter', 'none' ); ?>
        </a>
    </li>
<?php
    endif;
?>
<?php
    if ( skel::prop('sns__instagram') != '' ) :
?>
    <li>
        <a
            href="<?php echo skel::prop( 'sns__instagram', 'none' ); ?>"
            title="<?php
                echo esc_html( sprintf( __('Check photos took by %s'), $owner_name ) );
            ?>"
            target="_blank"
        >
            <i class="ui instagram icon"></i>
            Instagram
        </a>
    </li>
<?php
    endif;
?>
<?php
    if ( skel::prop('sns__github') != '' ) :
?>
    <li>
        <a
            href="<?php echo skel::prop( 'sns__github', 'none' ); ?>"
            title="<?php
                echo esc_html( sprintf( __('Check GitHub page of %s'), $owner_name ) );
            ?>"
            target="_blank"
        >
            <i class="ui github icon"></i>
            GitHub
        </a>
    </li>
<?php
    endif;
?>
