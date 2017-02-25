<?php
class skel_shortcode_centered extends skel_shortcode {

    public function HTML_TEMPLATE() {
        $shortcode_name = $this->SHORTCODE_NAME();
        $string =  <<< _EOF_
<div
    class="skel--gui--shortcode-{$shortcode_name}-blocks"
>
    %%CONTENT%%
</div>
_EOF_;
        return( $string );
    }

    public function ADD_TO_HEAD() {
        $shortcode_name = $this->SHORTCODE_NAME();
        $string = <<< _EOF_
<style>
.skel--gui--shortcode-{$shortcode_name}-blocks {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 1em;
}
</style>
_EOF_;
        return( $string );
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
