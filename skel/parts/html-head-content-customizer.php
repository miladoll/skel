<!--
    FOR WORDPRESS THEME CUSTOMIZER
-->
<style>
/* WORDPRESS: CUSTOMIZER:
    HEADER
*/
#skel--page-header .skel--site-icons {
    border-color: #ededed;
}
<?php if ( get_header_textcolor() != "" ) : ?>
#skel--page-header h1 #site-name {
    color: #<?php echo get_header_textcolor(); ?>;
}
<?php endif; ?>
#skel--page-header h1 #site-name {
    text-shadow: 1px 1px 2px rgb( 51, 51, 51 );
}
#site-description {
    color: rgba(68, 68, 68, 0.701961);
    text-shadow: 0px 1px 0.5px rgb( 200, 200, 200 );
}
#skel--page-header {
    background-image: url( <?php echo skel::get_uri_only_path( get_header_image() ); ?> );
}
</style>
