<?php
class skel_widget_tagcloud extends skel_widget {
    public function WIDGET_TITLE() {
        return( __('Tag Cloud', 'skel') );
    }
    public function WIDGET_DESCRIPTION() {
        return( __('Tag Cloud for This Site Articles', 'skel') );
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
        return( 'skel--gui--widgets-tagcloud' );
    }
    public function CONTENT( $instance = [] ) {
        echo '<ul class="skel--gui--tagclouds">';
        foreach ( skel::get_tagcloud_array() as $tag ) {
?>
    <li>
        <a
            href="<?php echo esc_attr( $tag['link'] ); ?>"
            title="<?php echo esc_attr( $tag['title'] ); ?>"
        >
            <?php echo esc_html( $tag['title'] ); ?>
        </a>
        <span>
            <?php echo esc_html( $tag['count'] ); ?>
        </span>
    </li>
<?php
        }
        echo '</ul>';
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
