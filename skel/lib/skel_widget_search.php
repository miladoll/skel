<?php
class skel_widget_search extends skel_widget {
    public function WIDGET_TITLE() {
        return( __('Site Search', 'skel') );
    }
    public function WIDGET_DESCRIPTION() {
        return( __('Search Box for This Site', 'skel') );
    }
    public function CONFIG_FIELDS() {
        return([
            [
                'field_name' => 'title',
                'title' => __('title', 'skel')
            ]
        ]);
    }
    public function WIDGET_CSS_CLASS() {
        return( 'skel--gui--widgets-search' );
    }
    public function CONTENT( $instance = [] ) {
        skel::include_parts( '/skel/parts/searchform.php' );
    }
    //
    function __construct() {
        parent::__construct();
    }
}
call_user_func( function() {
    $klass = basename( __FILE__, '.php' );
    $skel = new $klass();
} );
