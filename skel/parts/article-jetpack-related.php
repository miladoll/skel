<?php
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
?>
        <nav class="skel--gui--article-jetpack-relateds">
            <?php
                echo do_shortcode( '[jetpack-related-posts]' );
            ?>
        </nav>
<?php
    }
?>
