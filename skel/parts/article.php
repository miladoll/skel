<article
    <?php post_class( 'skel--gui--articles' ); ?>
    itemscope
    itemtype="http://schema.org/Article"
    id="post-<?php the_ID(); ?>"
>

    <!--
        ARTICLE HEADER
    -->
    <header class="ui basic skel--gui--article-headers">

        <h1 class="ui huge header" itemprop="headline">
            <a
                href="<?php the_permalink(); ?><?php skel::show_the_post_ID_fragment();?>"
                title="<?php the_title(); ?>"
            >
                <?php the_title(); ?>
            </a>
        </h1>

        <!--
            ARTICE SPEC
        -->
        <?php
            call_user_func( function() {
                skel::include_parts(
                    '/skel/parts/article-spec.php',
                    [
                        'skel_location_tag' => 'preface',
                        'skel_visual_align' => 'right'
                    ]
                );
            } );
        ?>

    </header><!-- class="skel--gui--article-headers" -->

    <!--
        SOCIAL BUTTONS
    -->
    <?php
        call_user_func( function() {
            if ( !is_single() && !is_page() ) {
                return;
            }
            skel::include_parts(
                '/skel/parts/article-social-button.php',
                [
                    'skel_location_tag' => 'preface',
                    'skel_visual_align' => 'right'
                ]
            );
        } );
    ?>

    <!-- 
        EYE CATCH (THUMBNAIL)
    -->
    <?php if ( has_post_thumbnail() ) : ?>
        <?php
            the_post_thumbnail(
                'full',
                array( 'class' => 'ui centered rounded image skel--gui--post-thumbnail' )
            );
        ?>
    <?php endif ?>

    <?php
        skel::include_parts(
            '/skel/parts/widget-singular-only.php',
            [
                'skel_widget_area' => 'article-header-under'
            ]
        );
    ?>

    <div itemprop="articleBody">
        <?php
            call_user_func( function() {
                if (
                    ( is_category() || is_archive() )
                    && ( has_excerpt() )
                ) {
                    the_excerpt();
                    return;
                }
                the_content();
            } );
        ?>
    </div><!-- itemprop="articleBody" -->

    <footer class="ui basic segment skel--gui--article-footers">

        <!--
            ARTICE SPEC
        -->
        <?php
            call_user_func( function() {
                skel::include_parts(
                    '/skel/parts/article-spec.php',
                    [
                        'skel_location_tag' => 'postface',
                        'skel_visual_align' => 'right'
                    ]
                );
            } );
        ?>

        <!--
            SOCIAL BUTTONS
        -->
        <?php
            call_user_func( function() {
                if ( !is_single() && !is_page() ) {
                    return;
                }
                skel::include_parts(
                    '/skel/parts/article-social-button.php',
                    [
                        'skel_location_tag' => 'postface',
                        'skel_visual_align' => 'right'
                    ]
                );
            } );
        ?>

    </footer><!-- class="skel--gui--article-footers" -->

</article><!-- class="skel--gui--articles" -->

<?php
    skel::include_parts(
        '/skel/parts/widget-singular-only.php',
        [
            'skel_widget_area' => 'article-footer-under'
        ]
    );
?>

<!--
    PREV NEXT
-->
<?php
    call_user_func( function() {
        if ( ! is_single() ) {
            return;
        }
        skel::include_parts( '/skel/parts/article-prev-nexts.php' );
    } );
?>

<!--
    RELATED POSTS (JETPACK)
-->
<?php
    call_user_func( function() {
        if ( ! is_single() ) {
            return;
        }
        skel::include_parts( '/skel/parts/article-jetpack-related.php' );
    } );
?>

<hr class="ui hidden divider">

