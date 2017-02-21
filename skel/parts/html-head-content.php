<?php if ( skel::prop('site_administration__google_tag_manager') != '' ) : ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo skel::prop('site_administration__google_tag_manager');?>');</script>
<!-- End Google Tag Manager -->
<?php endif ?>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
<!--
    FOR RESPONSIVE FUNCTIONALITY
-->
<meta name="HandheldFriendly" content="True" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--
    ICON DEFINITIONS FOR FAVORITES 
-->
<?php if ( get_option( 'site_icon' ) ) : ?>
    <link rel="shortcut icon" href="<?php echo wp_get_attachment_url( get_option( 'site_icon' ) ); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo wp_get_attachment_url( get_option( 'site_icon' ) ); ?>" />
    <meta name="msapplication-TileImage" content="<?php echo wp_get_attachment_url( get_option( 'site_icon' ) ); ?>" />
<?php endif ?>
<!--
    WEB SYNDICATION
-->
<link rel="alternate" type="application/rss+xml" href="<?php echo skel::get_uri_only_path( get_bloginfo( 'rdf_url' ) ); ?>" >
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php echo skel::get_uri_only_path( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<!--
    SNS RELATED
-->
<?php skel::include_parts('/skel/parts/html-head-content-sns-facebook.php'); ?>
<?php skel::include_parts('/skel/parts/html-head-content-sns-twitter.php'); ?>
<!--
    SITE ADMINISTRATION
-->
<?php if ( skel::prop('site_administration__google_search_console') != '' ) : ?>
<meta
    name="google-site-verification"
    content="<?php echo skel::prop('site_administration__google_search_console'); ?>"
/>
<?php endif ?>
