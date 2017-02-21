<?php

class skel {
    const IAM = 'skel';
    const DEFAULT_HEADER_BACKGROUND_IMG = '/skel/css/img/1080x180.png';

    public static function DEFAULT_CUSTOM_HEADER() {
        return(
            [
                'default-image'
                    => get_template_directory_uri()
                        . self::DEFAULT_HEADER_BACKGROUND_IMG,
                'width' => 1080,
                'height' => 180,
                'uploads' => true
            ]
        );
    }

    public static function DIR_ROOT() {
        // return( dirname( __FILE__ ) );
        return( get_template_directory() );
    }

    public static function DIR_STEM_ROOT() {
        // return( dirname( __FILE__ ) );
        return(
            get_template_directory()
            . '/'
            . self::IAM
        );
    }

    public static function DIR_ROOT_URI() {
        // return( dirname( __FILE__ ) );
        return( get_template_directory_uri() );
    }

    public static function FQDN() {
        $arr = explode( '//', home_url() );
        $fqdn = array_shift( explode( '/', $arr[1] ) );
        return( $fqdn );
    }

    public static function PREG_QUOTED_FQDN() {
        return( preg_quote( self::FQDN() ) );
    }

    public static function PREFIX_CUSTOMIZER() {
        return( self::IAM );
    }

    public function DEFAULT_READ_MORE_TRAILING_TEXT() {
        return( __('...', 'skel') );
    }

    public function DEFAULT_READ_MORE_LINK_TEXT() {
        return( __('read more', 'skel') );
    }

    public function DEFAULT_TITLE_SEPARATOR() {
        return( '-' );
    }

    public function GET_TITLE_SEPARATOR() {
        return(
            self::prop(
                'title_separator',
                self::DEFAULT_TITLE_SEPARATOR()
            )
        );
    }

    const DEFAULT_EXCERPT_LENGTH = 128;

    public function WIDGET_AREAS() {
        require( 'skel_config_widget_areas.php' );
        return( $confs );
    }

    public static function CUSTOMIZER_CONFS () {
        require( 'skel_config_customizer_confs.php' );
        return( $confs );
    }

    public static function include_parts( $relative_path_from_this_file = '', $vars = [] ) {
        if ( strpos( $relative_path_from_this_file, '/' ) !== 0 ) {
            $relative_path_from_this_file = '/' . $relative_path_from_this_file;
        }
        $absolute_path = self::DIR_ROOT() . $relative_path_from_this_file;
        if ( ! file_exists( $absolute_path ) ) {
            return( false );
        }
        extract( $vars );
        include( $absolute_path );
    }

    public static function prop( $name = '', $default = '' ) {
        if ( ! $name ) {
            return( $default );
        }
        return(
            get_theme_mod(
                self::PREFIX_CUSTOMIZER() . '__' . $name,
                $default
            )
        );
    }

    public static function get_uri_only_path($uri) {
        $uri = preg_replace( '/^https?:/', '', $uri );
        $uri = preg_replace( '/^\/\/' . self::PREG_QUOTED_FQDN() .  '/', '', $uri );
        return( $uri );
    }

    public static function get_crumb ( $opt = [] ) {
        $crumbs = [];
        $this_category =
            ( is_category() )
            ? get_queried_object()
            :
                ( is_single() )
                ? array_shift( get_the_category($post->ID) )
                : ''
        ;
        if (
            ( is_home() )
            || ( ( is_category() ) && ( $this_category->parent == 0 ) )
            || ( ( is_page() ) && ( $post->post_parent == 0 ) )
        ) {
            // home or top-level
            return( $crumbs );
        }
        if ( $this_category ) { // single post page or category
            $ids = array_reverse(
                get_ancestors( $this_category->cat_ID, 'category' )
            );
            if ( is_single() ) {
                array_push( $ids, $this_category->cat_ID );
            }
            foreach ( $ids as $id ) {
                array_push(
                    $crumbs,
                    [
                        'id' => $id,
                        'link' => get_category_link( $id ),
                        'title' => get_cat_name( $id )
                    ]
                );
            }
        }
        if ( is_page() ) {
            $ids = array_reverse(
                get_post_ancestors( $post->ID )
            );
            foreach ( $ids as $id ) {
                array_push(
                    $crumbs,
                    [
                        'id' => $id,
                        'link' => get_permalink( $id ),
                        'title' => get_the_title( $id )
                    ]
                );
            }
        }
        return( $crumbs );
    }

    public static function get_paginator( $opt ) {
        $opt['type'] = @$opt['type'] ?: 'array';
        $paginator = paginate_links( $opt );
        if ( ! is_array( $paginator) ) {
            return( [] );
        }
        $sane_paginator = [];
        foreach ( $paginator as $page ) {
            preg_match(
                "/^<[^\s]+\s+class=['\"]([^'\"]+)['\"][^>]{0,}>([^<]+)<.*$/i",
                $page,
                $matches
            );
            $class = array_shift(
                preg_grep(
                    "/^page-numbers$/",
                    preg_split( "/\s+/", $matches[1] ),
                    PREG_GREP_INVERT
                )
            );
            $number = $matches[2];
            if ( ! preg_match( "/^[0-9]+$/", $number ) ) {
                $number = '';
            }
            preg_match(
                "/^<a\s+.*href=['\"]([^'\"]+)['\"].*$/i",
                $page,
                $matches
            );
            $link = $matches[1];
            array_push(
                $sane_paginator,
                [
                    'class' => $class,
                    'number' => $number,
                    'link' => $link
                ]
            );
        }
        if ( $sane_paginator[0]['class'] != 'prev' ) {
            array_unshift( $sane_paginator, $sane_paginator[0] );
            $sane_paginator[0]['class'] = 'prev';
        }
        $end = end( $sane_paginator );
        if ( $end['class'] != 'next' ) {
            $end['class'] = 'next';
            array_push( $sane_paginator, $end );
        }
        return( $sane_paginator );
    }

    public static function get_tagcloud_array() {
        $tags = [];
        $base_html = wp_tag_cloud( 'format=array' );
        if ( !$base_html ) return( $tags );
        foreach ( $base_html as $tag ) {
            preg_match( '/^<a.*?href=[\'"]([^\'"]+)[\'"].*title=[\'"]([0-9]+).*?[\'"]>([^<]+)<.*$/i', $tag, $matches );
            array_push(
                $tags,
                [
                    link => $matches[1],
                    count => $matches[2],
                    title => $matches[3],
                ]
            );
        }
        return( $tags );
    }

    public static function show_the_post_ID_fragment() {
        $id = get_the_ID();
        if ( empty( $id ) ) return;
        echo
            '#post-'
            . esc_attr( $id )
        ;
    }

    public static function get_archive_title_and_icon () {
        if ( is_single() || is_page() || is_home() ) {
            return;
        }
        $icon = 'folder open outline';
        $title = __( 'Articles', 'skel' );
        if ( is_category() ) {
            $icon = 'folder open outline';
            $title = __( 'Category: ', 'skel' ) . single_cat_title('', false);
        }
        if ( is_search() ) {
            $icon = 'search';
            $title = __( 'Search: ', 'skel' ) . get_query_var('s');
        }
        if ( is_date() ) {
            $m = get_query_var('m');
            $year = substr( $m, 0, 4 );
            $month = intval( substr($m, 4, 2) );
            $day = intval( substr($m, 6, 2) );
            if ( !$m ) {
                $year = get_query_var( 'year' );
                $month = get_query_var( 'monthnum' );
                $day = get_query_var( 'day' );
            }
            $m =
                sprintf( '%04d', $year )
                . ( $month > 0 ? sprintf( '/%02d', $month )  : '' )
                . ( $day > 0 ? sprintf( '/%02d', $day )  : '' )
            ;
            $icon = 'calendar';
            $title = __( 'Date: ', 'skel' ) . $m;
        }
        if ( is_tag() ) {
            $icon = 'tags';
            $title = __( 'Tag: ', 'skel' ) . single_tag_title();
        }
        if ( is_author() ) {
            $icon = 'user';
            $title = __( 'Author: ', 'skel' ) . get_the_author();
        }
        return([
            'icon' => $icon,
            'title' => $title
        ]);
    }

    public static function get_nav_menu_arrays ( $opt ) {
        $opt['echo'] =
            ( $opt['echo'] != '' )
            ? $opt['echo']
            : false
        ;
        $menu = wp_nav_menu( $opt );
        $items = [];
        foreach ( ( preg_split( '/<\/li>/', $menu ) ) as $raw_item ) {
            $matches = explode( '>', $raw_item );
            $id_class = preg_replace( '/^<[^\s]+\s+/im', '', $matches[0] );
            $link = preg_replace( '/^<[^\s]+\s+href=\"/im', '', $matches[1] );
            $link = preg_replace( '/"/', '', $link );
            $label = preg_replace(
                '/^.*<a\s{0,}.*?>(.*?)<\/a>.{0,}$/im',
                "$1",
                $raw_item
            );
            $esc_label = esc_html( $label );
            if ( ! $link ) continue;
            array_push( $items, [
                'id_class' => $id_class,
                'link' => $link,
                'esc_label' => $esc_label,
                'label' => $label
            ]);
        }
        return( $items );
    }

    public static function get_user_avatar_url( $ID ) {
        $avatar_html = get_avatar( $ID, 96 );
        preg_match( '/^.*src=[\'"]([^\'"]+)[\'"].*$/', $avatar_html, $matches );
        $url = $matches[1];
        return( $url );
    }

    public static function get_proper_excerpt() {
        $this_post = get_post( get_the_ID() );
        $content = get_the_excerpt();
        if ( strlen( $content ) < 1 ) {
            $content = $this_post->post_content;
        }
        $content = preg_replace( '/\[[^\]]{0,}\]/m', '', $content );
        $content = wp_strip_all_tags( $content );
        $content = preg_replace( '/\s+/m', ' ', $content );
        $content = substr(
            $content, 0, self::DEFAULT_EXCERPT_LENGTH
        );
        return( $content );
    }

    public static function get_current_post_data() {
        $q = new WP_Query($GLOBALS['wp_query']);
        $data = [
            'flourish_title' => wp_get_document_title(),
        ];
        if ( $q->have_posts() ) {
            $data = array_merge(
                $data,
                 [
                    'title' => get_the_title(),
                    'url' => get_permalink(),
                    'description' => skel::get_proper_excerpt(),
                ]
            );
            $data['eyecatch'] = has_post_thumbnail();
            if ( $data['eyecatch'] ) {
                // $data['eyecatch'] = array_shift( wp_get_attachment_image_src() );
                // -_-;; ?
                $html_img_src_and_trash = array_pop( preg_split( '/^.*?\s{0,}src=[\"\']/', get_the_post_thumbnail() ) );
                $html_img_src = array_shift( preg_split( '/[\"\']/', $html_img_src_and_trash ) );
                $data['eyecatch'] = $html_img_src;
            }
        }
        if ( is_home() ) {
            $data = array_merge(
                $data,
                [
                    'title' => get_bloginfo( 'name' ),
                    'url' => home_url(),
                    'description' => get_bloginfo( 'description' ),
                ]
            );
            $data['eyecatch'] = false;
        }
        if ( !$data['title'] ) {
            $data['title'] = $data['flourish_title'];
        }
        wp_reset_postdata();
        return( $data );
    }

    public static function PREFIX_WIDGET_AREA_NAME() {
        return(
            self::IAM . '-widget-'
        );
    }

    public static function WIDGETS_BASIC_CONFIG() {
        return([
            'before_widget'
                => '<aside class="widgets">',
            'after_widget'
                => '</aside><!-- class="widgets" -->',
            'before_title'
                => '<h4 class="ui horizontal divider header"><span class="skel--gui--icons"></span>',
            'after_title'
                => '</h4>',
        ]);
    }

    public static function get_our_widgets_area_name ( $widgets_area ) {
        return(
            self::PREFIX_WIDGET_AREA_NAME() . $widgets_area
        );
    }

    public static function is_our_widgets_area_active ( $widgets_area ) {
        $name = self::get_our_widgets_area_name( $widgets_area );
        if ( !is_active_sidebar( $name ) ) {
            return( false );
        }
        return( true );
    }

    public static function show_widgets_area ( $widgets_area ) {
        if ( !self::is_our_widgets_area_active( $widgets_area ) ) {
            return;
        }
        $name = self::get_our_widgets_area_name( $widgets_area );
        ob_start();
        dynamic_sidebar( $name );
        $text = ob_get_clean();
        $text = preg_replace( '/(<\/h[1-9]>)/', "$1<div class=\"widget-bodies\">", $text );
        $text = preg_replace( '/(<\/aside>)$/', "</div>$1", $text );
        echo $text;
    }

    private static function _init__i18n() {
        // I18N
        $do_load_textdomain = function() {
            if ( is_textdomain_loaded( self::IAM ) ) {
                return;
            }
            load_theme_textdomain(
                self::IAM,
                // // My Convention
                self::DIR_STEM_ROOT()
                // // Normal WordPress Convention
                // get_template_directory()
                . '/languages'
            );
        };
        /*
            I don't know why add_action to 'ater_setup_theme' does not work
            for /wp-admin/customize.php?return=%2Fwp-admin%2Fthemes.php
            So I call itself here.
        */
        $do_load_textdomain();
        add_action(
            'wp_dashboard_setup',
            $do_load_textdomain
        );
        add_action(
            'after_setup_theme',
            $do_load_textdomain
        );
    }

    private static function _init__widgets() {
        // WIDGETS
        add_action(
            'widgets_init',
            function() {
                load_theme_textdomain(
                    'skel',
                    get_template_directory() . '/languages'
                );
                $widgets_areas = self::WIDGET_AREAS();
                foreach ( $widgets_areas as $config ) {
                    $config['id'] =
                        self::PREFIX_WIDGET_AREA_NAME()
                        . $config['id']
                    ;
                    $merged_config = array_merge(
                        $config,
                        self::WIDGETS_BASIC_CONFIG()
                    );
                    register_sidebar( $merged_config );
                }
            }
        );
    }

    private static function _init__jetpack_filters() {
        // ADJUST JET-PACK RELATED FUNCTIONS
        add_filter(
            'wp',
            function () {
                if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
                    $jprp = Jetpack_RelatedPosts::init();
                    $callback = array( $jprp, 'filter_add_target_to_dom' );
                    remove_filter( 'the_content', $callback, 40 );
                }
            },
            20
        );
        add_filter(
            'jetpack_relatedposts_filter_headline',
            function ( $headline ) {
                $headline = sprintf(
                    '<h3 class="jp-relatedposts-headline"><em><i class="ui unordered list
        icon"></i>%s</em></h3>',
                    esc_html( __('Related Posts', 'skel') )
                );
                return( $headline );
            }
        );
    }

    private static function _init__title_separator() {
        // TITLE SEPARATOR
        add_filter(
            'document_title_separator',
            function ( $sep ) {
                return( self::GET_TITLE_SEPARATOR() );
            }
        );
    }

    private static function _init__excerpt() {
        // FOR EXCERPT TEXT
        add_filter( 'excerpt_more',
            function () {
                return(
                    self::DEFAULT_READ_MORE_TRAILING_TEXT()
                    . '<a'
                    . ' href="'. get_permalink( get_the_ID() ) . '"'
                    . ' class="skel--readmores"'
                    . '>'
                    . self::DEFAULT_READ_MORE_LINK_TEXT()
                    . '</a>'
                );
            }
        );
        add_filter( 'excerpt_mblength',
            function ($length) {
                return( skel::DEFAULT_EXCERPT_LENGTH );
            }
        );
    }

    private static function _init__sane_imager() {
        // Remove `width` `height` attr from <img> tag
        add_filter(
            'get_image_tag',
            function (
                $html, $id, $alt, $title, $align, $size
            ) {
                $html =
                    str_replace(
                        '/>',
                        '>',
                        $html
                    )
                ;
                $html =
                    preg_replace(
                        '/(?:width|height)=(?:"|\')[0-9]{1,}(?:"|\')/',
                        '',
                        $html
                    )
                ;
                return $html;
            },
            10,
            6
        );
    }

    private static function _get_mixed_content_sanitized($buffer) {
        $home_url = trailingslashit( get_home_url('/') );
        $preg_quoted_url = preg_quote( $home_url, '/' );
        $buffer =
            preg_replace_callback(
                "/(<[^<>]{1,}(?:src|href|action)=[\"'])($preg_quoted_url{0,1})/i",
                function( $matches ) {
                    $m = $matches[1];
                    $original_url = $matches[2];
                    if ( preg_match( '/(canonical|og:url)/i', $m ) ) {
                        $m = "$m$original_url";
                    }
                    return( "$m/" );
                },
                $buffer
            )
        ;
        $buffer =
            preg_replace(
                '/(<link\s+rel=["\']canonical["\'][^>]+)\/\//',
                "$1/",
                $buffer
            )
        ;
        // for crayon syntax higlighter
        $buffer = preg_replace(
             '/(<script[^>]+>[^>]+var CrayonSyntaxSettings.*"ajaxurl":")https?:\\\\\/\\\\\/'
                . self::PREG_QUOTED_FQDN()
                . '/i',
             "$1",
             $buffer
        );
        // for usces shopping cart
        $buffer = preg_replace(
             '/(<script[^>]+>[^>]+uscesL10n[^\}]+\'ajaxurl\':\s{0,}\")https?:\/\/'
                . self::PREG_QUOTED_FQDN()
                . '/i',
             "$1",
             $buffer
        );
        $buffer = preg_replace(
             '/(<script[^>]+>[^>]+uscesL10n[^\}]+\'loaderurl\':\s{0,}\")https?:\/\/'
                . self::PREG_QUOTED_FQDN()
                . '/i',
             "$1",
             $buffer
        );
        return( $buffer );
    }

    private static function _get_attachments_url_path_part_only ( $url ) {
        $regex = '/^http(s)?:\/\/[^\/\s]+(.*)$/';
        if ( preg_match( $regex, $url, $matches ) ) {
            $url = $matches[2];
        }
        return( $url );
    }

    private static function _init__sane_relative_uri() {
        // for output of attachments
        add_filter(
            'wp_get_attachment_url',
            function ($url) {
                return( self::_get_attachments_url_path_part_only($url) );
            }
        );
        add_filter(
            'attachment_link',
            function ($url) {
                return( self::_get_attachments_url_path_part_only($url) );
            }
        );

        // for HTML 
        add_action(
            'wp_head',
            function () {
                ob_start(
                    function($buffer) {
                        return( self::_get_mixed_content_sanitized($buffer) );
                    }
                );
            },
            0
        );
        add_action(
            'wp_footer',
            function () {
                ob_end_flush();
            },
            99999
        );

    }

    private static function _init__custom_menu() {
        // CUSTOM MENU
        register_nav_menus([
            'location__menu_site_global' => __('Site Global Menu', 'skel'),
            'location__menu_site_global_aside' => __('Site Global Menu Aside', 'skel'),
            'location__menu_site_global_dropdown' => __('Site Global Menu Dropdown', 'skel'),
        ]);
        add_filter(
            'nav_menu_css_class',
            function ( $classes ) {
                $classes[] = 'item';
                return( $classes );
            },
            10,
            2
        );
    }

    private static function _init__theme_customizer() {
        // SUPPORT WORDPRESS THEME CUSTOMIZER
        add_action(
            'after_setup_theme',
            function () {
                add_theme_support( 'custom-header', self::DEFAULT_CUSTOM_HEADER() );
                add_theme_support( 'html5' );
                add_theme_support( 'post-thumbnails' );
                add_theme_support( 'menus' );
                add_theme_support( 'title-tag' );
            }
        );
    }

    private static function ___add_customizer_section (array $conf) {
        global $wp_customize;
        $prefix = self::PREFIX_CUSTOMIZER();
        $wp_customize->add_section(
            $prefix . '__' . $conf['name'],
            [
                'title' => $conf['title'],
                'priority' => $conf['priority']
            ]
        );
    }

    private static function ___add_customizer_setting_to_section (array $conf) {
        global $wp_customize;
        $prefix = self::PREFIX_CUSTOMIZER();
        $prefixed_name = $prefix . '__' . $conf['name'];
        $prefixed_section = $prefix . '__' . $conf['section'];
        /*
            :section_name means built-in sections
                :title_tagline, :colors, :header_image, :background_image,
                :nav, :static_front_page
        */
        if ( strpos( $conf['section'], ':' ) === 0 ) {
            $prefixed_section = substr( $conf['section'], 1 );
        }
        $wp_customize->add_setting(
            $prefixed_name,
            [
                'default' => $conf['default'],
                // 'type' => 'option'
            ]
        );
        $conf_ary = [
            'label' => $conf['label'],
            'section'  => $prefixed_section,
            'settings' => $prefixed_name,
            'type' => $conf['type'],
            'description' => $conf['description']
        ];
        $control = '';
        /*
            `type` can be:
                'text', 'textarea'
                'email', 'url', 'number', 'hidden', 'date'
                'checkbox', 'radio', 'select', 'dropdown-pages' (with supplemental option)
                'color' (custom control)
        */
        switch ($conf['type']) {
            case 'color' :
                $control = new WP_Customize_Color_Control(
                    $wp_customize, $prefixed_name, $conf_ary
                );
                break;
            case 'radio' :
                $conf_ary['choices'] = $conf['choices'];
                $control = new WP_Customize_Control(
                    $wp_customize, $prefixed_name, $conf_ary
                );
                break;
            default:
                $control = new WP_Customize_Control(
                    $wp_customize, $prefixed_name, $conf_ary
                );
        }
        $wp_customize->add_control( $control );
    }

    private static function _init__customizer() {
        global $wp_customize;
        // ORIGINAL THEME CUSTOMIZER
        add_action(
            'customize_register',
            function ( $wp_customize ) use ( $wp_customize ) {
                // Wrapper Functions
                $add_customizer_set = function ($confs) use ($wp_customize) {
                    while ( $item = array_shift( $confs ) ) {
                        $conf_name = array_shift( array_keys( $item ) );
                        $conf = $item[$conf_name];
                        switch ( $conf_name ) {
                            case 'section' :
                                self::___add_customizer_section( $conf );
                                break;
                            case 'setting' :
                                self::___add_customizer_setting_to_section( $conf );
                                break;
                            default:
                                break;
                        }
                    }
                };
                $add_customizer_set( self::CUSTOMIZER_CONFS() );
            }
        );
    }

    private static function _init__enqueue_files() {
        // ADD STYLE SHEETS AND SCRIPTS
        add_action( 'wp_enqueue_scripts',
            function () {
                // FOR SEMANTIC UI
                wp_deregister_script( 'jquery' );
                wp_enqueue_script(
                    'jquery',
                    get_template_directory_uri() . '/skel/vendor/jquery/jquery-3.1.1.min.js',
                    array(),
                    '3.1.1'
                );
                wp_enqueue_script(
                    'jquery-migrate',
                    get_template_directory_uri() . '/skel/vendor/jquery/jquery-migrate-1.4.1.min.js',
                    array(),
                    '1.4.1'
                );
                if (
                    self::prop('basis_of_design__disable_pretty_css')
                    !== 'disable'
                ) {
                    // SEMANTIC UI RELATED
                    wp_enqueue_style(
                        'skel-semantic-ui',
                        get_template_directory_uri() . '/skel/vendor/semantic/semantic.min.css'
                    );
                }
                wp_enqueue_script(
                    'skel-semantic-ui',
                    get_template_directory_uri() . '/skel/vendor/semantic/semantic.min.js',
                    array('jquery-migrate'),
                    '2.2.7'
                );
                // SKEL STEM
                wp_enqueue_style(
                    'skel',
                    get_template_directory_uri() . '/skel/skel-style.css'
                );
                if (
                    self::prop('basis_of_design__disable_pretty_css')
                    !== 'disable'
                ) {
                    // SKEL ICONS
                    wp_enqueue_style(
                        'skel-icons',
                        get_template_directory_uri() . '/skel/vendor/skel-icons/style.css'
                    );
                    // GOOGLE MATERIAL ICONS
                    wp_enqueue_style(
                        'skel-material-icons',
                        get_template_directory_uri() . '/skel/vendor/material-iconfont/material-icons.css'
                    );
                    wp_enqueue_style(
                        'skel-material-icons-shorthand',
                        get_template_directory_uri() . '/skel/css/material-icons.css',
                        array('skel-material-icons')
                    );
                    // SKEL GUI
                    wp_enqueue_style(
                        'skel-gui',
                        get_template_directory_uri() . '/skel/css/skel-gui.css'
                    );
                }
                // COMMON PAGE UTILITY FILE
                wp_enqueue_script(
                    'page-common-postamble',
                    get_template_directory_uri() . '/skel/js/page-common-postamble.js',
                    array(),
                    '',
                    true
                );
            }
        );
    }

    public static function _init__cleanup_header() {
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
    }

    public static function _init__tweek_adminpage() {
        // disable quick post
        add_action(
            'wp_dashboard_setup',
            function () {
                remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side');
            }
        );
    }

    //

    private static function _init() {
        self::_init__i18n();
        self::_init__excerpt();
        self::_init__title_separator();
        self::_init__sane_imager();
        self::_init__sane_relative_uri();
        self::_init__jetpack_filters();
        self::_init__custom_menu();
        self::_init__theme_customizer();
        self::_init__widgets();
        self::_init__customizer();
        self::_init__cleanup_header();
        self::_init__tweek_adminpage();
        self::_init__enqueue_files();
    }

    public function __construct() {
        self::_init();
    }
}
