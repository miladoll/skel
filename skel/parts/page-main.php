<!--
    BREADCRUMB
-->
<?php
    call_user_func( function() {
        skel::include_parts(
            '/skel/parts/breadcrumb.php',
            [
                'skel_location_tag' => 'preface'
            ]
        );
    } );
?>

<!--
    PAGE ROLE TITLE
-->
<?php
    call_user_func( function() {
        $r = skel::get_archive_title_and_icon();
        if ( !$r ) { return; }
?>
        <h1 class="ui header skel--gui--page-role-titles">
            <i class="ui <?php echo $r['icon']; ?> icon"></i>
            <?php echo esc_html( $r['title'] ); ?>
        </h1>
<?php
    } );
?>

<!--
    PAGER
-->
<?php
    call_user_func( function() use ( $paged ) {
        if (
            is_single()
            || is_page()
            || ( is_home() && ( $paged == 0 ) )
        ) {
            return;
        }
        skel::include_parts(
            '/skel/parts/pager.php',
            [
                'skel_location_tag' => 'preface'
            ]
        );
    } );
?>

<!--
    ARTICLES
-->
<?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
?>
    <!--
        AN ARTICLE
    -->
    <?php
        call_user_func( function() {
            skel::include_parts( '/skel/parts/article.php' );
        } );
    ?>
<?php
        endwhile;
    endif;
?>

<nav id="infinites-articles" class="infinites">
</nav>

<!--
    PAGER
-->
<?php
    call_user_func( function() {
        if ( is_single() || is_page() ) {
            return;
        }
        skel::include_parts(
            '/skel/parts/pager.php',
            [
                'skel_location_tag' => 'postface'
            ]
        );
    } );
?>

<!--
    BREADCRUMB
-->
<?php
    call_user_func( function() {
        skel::include_parts(
            '/skel/parts/breadcrumb.php',
            [
                'skel_location_tag' => 'postface'
            ]
        );
    } );
?>
