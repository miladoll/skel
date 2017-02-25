<?php
class skel_shortcode {

    public function HTML_TEMPLATE() {
        $shortcode_name = $this->SHORTCODE_NAME();
        $string =  <<< _EOF_
<div
    class="skel--gui--shortcode-{$shortcode_name}-blocks"
>
    %%content%%
</div>
_EOF_;
        return( $string );
    }

    public function AVOID_WPAUTOP() {
        return( false );
    }

    public function TEMPLATE_DICT( $dict = [] ) {
        return( $dict );
    }

    public function OUTPUT( $opts ) {
        $opts['content'] =
            ( $opts['content'] !== '' )
            ? $opts['content']
            : ''
        ;
        if ( $this->AVOID_WPAUTOP() ) {
            $opts['content'] = base64_decode( $opts['content'] );
        }
        return self::_render(
            $this->HTML_TEMPLATE(),
            $this->TEMPLATE_DICT( $opts )
        );
    }

    public function ADD_TO_HEAD() {
        $shortcode_name = $this->SHORTCODE_NAME();
        $string = <<< _EOF_
_EOF_;
        return( $string );
    }

    const DEFAULT_PRIORITY_HEADER = 10000;

    public function THIS_CLASS() {
        return( get_class($this) );
    }

    public function SHORTCODE_NAME() {
        $class_name = $this->THIS_CLASS();
        $shortcode_name =
            preg_replace(
                '/^.*?_shortcode/',
                '',
                $class_name
            )
        ;
        $shortcode_name = preg_replace( '/^_/', '', $shortcode_name );
        if ( !$shortcode_name ) {
            $shortcode_name = 'myshortcode';
        }
        return( $shortcode_name );
    }

    // Tiny template engine
    public static function _render( $template, array $vars ) {
        return preg_replace_callback(
            '/%%([\w\|]+)%%/',
            function( $m ) use ( $vars ) {
                $name = $m[1];
                $value =
                    ( array_key_exists( $name, $vars ) )
                    ? $vars[ $name ]
                    : ''
                ;
                if ( preg_match( '/^(.*)\|(.*)$/', $name, $matches ) ) {
                    $name = $matches[1];
                    $filter = $matches[2];
                    $value = $vars[ $name ];
                    switch ( $filter ) {
                        case 'html' :
                            $value = htmlspecialchars( $value );
                            break;
                        case 'url' :
                            $value = htmlentities( $value );
                            break;
                    }
                }
                return $value;
            },
            $template
        );
    }

    public function do_shortcode( $attrs, $content = '' ) {
        $opts = $attrs;
        $opts['content'] = $content;
        return $this->OUTPUT( $opts );
    }

    public function do_head() {
        echo $this->ADD_TO_HEAD();
    }

    function __construct( $that = false, $opt = [] ) {
        if ( !$that ) $that = $this;
        $opt['name'] = ( $opt['name'] ) ? $opt['name'] : $that->SHORTCODE_NAME();
        $opt['priority_header'] = 
            ( $opt['priority_header'] )
            ? $opt['priority_header']
            : $that->DEFAULT_PRIORITY_HEADER
        ;
        add_shortcode(
            $opt['name'],
            array( $that, 'do_shortcode' )
        );
        add_action(
            'wp_head',
            array( $that, 'do_head' ),
            $opt['priority_header']
        );
        $shortcode_name = $that->SHORTCODE_NAME();
        if ( $that->AVOID_WPAUTOP() ) {
            add_filter(
                'the_content',
                function ( $content ) use ( $shortcode_name ) {
                    $content =
                        preg_replace_callback(
                            '/(\['
                                . $shortcode_name
                                . '[^\]]{0,}\])([\s\S]*?)(\[\/'
                                . $shortcode_name
                                . '\])/',
                            function ( $matches ) {
                                return(
                                    $matches[1]
                                    .  base64_encode( $matches[2] )
                                    . $matches[3]
                                );
                            },
                            $content
                        );
                    return( $content );
                },
                9
            );
        }
    }
}
call_user_func( function() {
    $klass = basename( __FILE__, '.php' );
    new $klass();
} );
