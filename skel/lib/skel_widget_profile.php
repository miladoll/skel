<?php
class skel_widget_profile extends skel_widget {
    public function WIDGET_TITLE() {
        return( __('Profile', 'skel') );
    }
    public function WIDGET_DESCRIPTION() {
        return( __('Profile of Site Owner', 'skel') );
    }
    public function CONFIG_FIELDS() {
        return([
            [
                'field_name' => 'title',
                'title' => __('title', 'skel')
            ],
            [
                'field_name' => 'owner_name',
                'title' => __('Owner Name', 'skel')
            ],
            [
                'field_name' => 'textarea_profile',
                'title' => __('Profile Text', 'skel')
            ],
            [
                'field_name' => 'image_profile',
                'title' => __('Profile Image', 'skel')
            ]
        ]);
    }
    public function WIDGET_CSS_CLASS() {
        return( 'skel--gui--widgets-profile' );
    }
    public function CONTENT( $instance = [] ) {
?>
<div class="ui card">
    <div class="image">
        <img
            src="<?php echo esc_attr($instance['image_profile']); ?>"
            alt=""
        >
    </div>
    <div
        class="content"
    >
        <div
            class="header"
        >
            <?php echo esc_html($instance['owner_name']); ?>
        </div>
        <div
            class="description"
        >
            <?php echo $instance['textarea_profile']; ?>
        </div>
    </div>
    <?php if ( skel::prop('sns__twitter') != '' ) : ?>
        <div
            class="extra content"
        >
            <a
                href="https://twitter.com/<?php echo skel::prop( 'sns__twitter', 'none' ); ?>"
                title="<?php
                    echo esc_html( sprintf( __('Check tweets of %s'), $instance['owner_name']) );
                ?>"
                target="_blank"
            >
                <i class="ui twitter icon"></i>
                @<?php echo skel::prop( 'sns__twitter', 'none' ); ?>
            </a>
        </div>
    <?php endif ?>
</div>
<?php
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
