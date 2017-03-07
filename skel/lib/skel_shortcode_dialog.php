<?php
class skel_shortcode_dialog extends skel_shortcode {

    public function HTML_TEMPLATE() {
        $shortcode_name = $this->SHORTCODE_NAME();
        $string =  <<< _EOF_
<section
    class="skel--gui--shortcode-{$shortcode_name}-blocks"
>
    %%content%%
</section>
_EOF_;
        return( $string );
    }

    public function ADD_TO_HEAD() {
        $shortcode_name = $this->SHORTCODE_NAME();
        $string = <<< _EOF_
<style>
.skel--gui--shortcode-{$shortcode_name}-blocks {
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl {
    margin: 1em 3em;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dt:before {
    clear: both;
    content: "";
    display: block;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dt {
    margin: 0;
    width: 64px;
    display: block;
    float: left;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dt:nth-of-type(even) {
    float: right;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dt {
    font-size: 80%;
    line-height: 1.3;
    text-align: center;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dt > img {
    display: block;
    margin: 0;
    padding: 0;
    width: 60px;
    border-radius: .4em;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dd {
    display: block;
    position: relative;
    padding: 1.2em;
    border: 1px solid #666;
    border-radius: 10px;
    width: calc( 100% - 168px );
    margin: 0;
    margin-left: 20px;
    float: left;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dd:nth-of-type(even) {
    float: right;
    margin-left: 0;
    margin-right: 20px;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dd:nth-of-type(odd):before {
    position: absolute;
    content: "";
    border: 10px solid transparent;
    border-right: 10px solid #666;
    top: .6em;
    left: -20px;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dd:nth-of-type(odd):after {
    position: absolute;
    content: "";
    border: 10px solid transparent;
    border-right: 10px solid #fff;
    top: .6em;
    left: -19px;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dd:nth-of-type(even):before {
    position: absolute;
    content: "";
    border: 10px solid transparent;
    border-left: 10px solid #666;
    top: .6em;
    right: -20px;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > dd:nth-of-type(even):after {
    position: absolute;
    content: "";
    border: 10px solid transparent;
    border-left: 10px solid #fff;
    top: .6em;
    right: -19px;
}
.skel--gui--shortcode-{$shortcode_name}-blocks dl > span {
    clear: both;
    content: "";
    display: block;
    margin-bottom: 1em;
}
</style>
_EOF_;
        return( $string );
    }

    public function AVOID_WPAUTOP() {
        return( true );
    }

    public function TEMPLATE_DICT( $dict ) {
        $content = $dict['content'];
        if (
            class_exists( 'Jetpack' ) 
            && Jetpack::is_module_active( 'markdown' )
        ) {
            jetpack_require_lib( 'markdown' );
            $content =
                WPCom_Markdown::get_instance()
                    ->transform(
                        $content,
                        [
                            'id'      => false,
                            'unslash' => false,
                        ]
                    )
            ;
        }
        $content = preg_replace( '/<\/dd>/', '</dd><span></span>', $content );
        $dict['content'] = $content;
        return( $dict );
    }

    function __construct( $opt = [] ) {
        $that = $this;
        parent::__construct( $that, $opt );
    }
}
call_user_func( function() {
    $klass = basename( __FILE__, '.php' );
    new $klass();
} );
