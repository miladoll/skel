<?php
class skel_shortcode_johnson extends skel_shortcode {

    public function HTML_TEMPLATE() {
        $shortcode_name = $this->SHORTCODE_NAME();
        $string =  <<< _EOF_
<section
    class="skel--gui--shortcode-{$shortcode_name}-blocks"
>
    <header>%%title|html%%</header>
    <div>
        %%content%%
    </div>
</section>
_EOF_;
        return( $string );
    }

    public function ADD_TO_HEAD() {
        $shortcode_name = $this->SHORTCODE_NAME();
        $string = <<< _EOF_
<style>
.skel--gui--shortcode-{$shortcode_name}-blocks {
    position: relative;
    font-weight: bold;
}
.skel--gui--shortcode-{$shortcode_name}-blocks > header {
    position: absolute;
    border: 1px solid rgba( 204, 204, 204, .5 );
    top: -.7em;
    left: 2.5em;
    font-size: 180%;
    padding: .3em .5em;
    background-color: white;
    box-shadow: 0 8px 8px -6px #333;
}
.skel--gui--shortcode-{$shortcode_name}-blocks > div {
    padding: 2em;
    width: 90%;
    margin: 2em auto 1.5em auto;
    box-shadow: 0 8px 8px -6px #333;
    background-color: rgb( 243, 244, 245 );
}
.skel--gui--shortcode-{$shortcode_name}-blocks > div > dl > dt {
    font-size: 116%;
}
.skel--gui--shortcode-{$shortcode_name}-blocks > div > dl > dt:before {
    font-family: Icons;
    content: "\\f046";
    font-size: 140%;
    margin-right: .4em;
    vertical-align: middle;
}
.skel--gui--shortcode-{$shortcode_name}-blocks > div > dl > dd + dt {
    margin-top: .4em;
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
