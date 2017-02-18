<?php
// class name must be started with 'skel_widget_'
class skel_widget extends WP_Widget {
    public function WIDGET_TITLE() {
        return( __('Widget', 'skel') );
    }
    public function WIDGET_DEFAULT_HTML_TITLE() {
        return( $this->WIDGET_TITLE() );
    }
    public function WIDGET_DESCRIPTION() {
        return( __('Widget Description', 'skel') );
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
        return( 'skel--gui--widgets-any' );
    }
    public function CONTENT( $instance = [] ) {
        return;
    }
    //

    public function THIS_CLASS() {
        return( get_class($this) );
    }
    public function PREFIX_NAME() {
        return( array_shift( explode( '_', self::THIS_CLASS() ) ) );
    }
    public function PREFIX_WIDGET_NAME() {
        return(
            self::PREFIX_NAME() . '_widget_'
        );
    }

    function __construct(
        $widget_html_id = false,
        $widget_title = '',
        $widget_ops = []
    ) {
        $widget_ops = array_merge(
            [
                'classname' => $this->THIS_CLASS(),
                'description' =>
                    sprintf(
                        "[%s] %s",
                            $this->PREFIX_NAME(),
                            $this->WIDGET_DESCRIPTION()
                    )
            ],
            $widget_ops
        );
        WP_Widget::__construct(
            ( empty( $widget_html_id ) ? false : $widget_html_id ),
            (
                $widget_title == ''
                ? sprintf(
                        "[%s] %s",
                            $this->PREFIX_NAME(),
                            $this->WIDGET_TITLE()
                )
                : $widget_title
            ),
            $widget_ops
        );
        // $this->alt_option_name = 'widget_users_entries';
        $class_name = $this->THIS_CLASS();
        if ( substr_count( $class_name, '_' ) < 2 ) {
            return;
        }
        add_action(
            'widgets_init',
            function () use ( $class_name ) {
                return( register_widget($class_name) );
            }
        );
        add_action(
            'admin_print_scripts-widgets.php',
            array( $this, 'admin_scripts' )
        );
    }

    public function admin_scripts() {
        wp_enqueue_media();
        $path_to_media_uploader =
            skel::DIR_ROOT_URI()
            . '/skel/js/media-uploader.js'
        ;
        wp_enqueue_script(
            'skel-media-uploader',
            $path_to_media_uploader,
            array('jquery'),
            filemtime( $path_to_media_uploader ),
            false
        );
    }

    protected function show_field_image( $opt, $instance = [] ) {
        if ( empty( $opt ) ) {
            return;
        }
        $opt['name'] = $this->get_field_name($opt['field_name']);
        $opt['id'] = $this->get_field_id($opt['field_name']);
        $images = $instance[ $opt['field_name'] ];
        if ( $images && !is_array($images) ) {
            $images = [ $images ];
        }
        ?>
<style>
/* SKEL: GUI: ADM
    image uploader
*/
.skel--adm--image-uploader-image-lists {
    display: block;
    margin-top: 0.8em;
    margin-left: 2em;
    margin-bottom: 1em;
}
.skel--adm--image-uploader-image-lists img {
    width: 64px;
}
.skel--adm--image-uploader-image-lists:after {
    content: "";
    display: block;
    clear: both;
}
.skel--adm--image-uploader-image-items {
    float: left;
}
.skel--adm--image-uploader-image-items + .skel--adm--image-uploader-image-items {
    margin-left: 1em;
}
.skel--adm--image-uploader-image-items a {
    position: relative;
    display: block;
    padding: 1em;
    border: 1px solid gray;
    background-color: #f8f8f8;
    border-radius: 0.25em;
}
.skel--adm--image-uploader-image-items a button {
    position: absolute;
    right: 0.25em;
    bottom: 0.25em;
    z-index: 10;
}
.skel--adm--fields-textarea {
    height: 5em;
}
</style>
        <p>
            <label
                for="<?php echo esc_attr( $opt['id'] ); ?>"
            >
                <?php echo esc_html( $opt['title'] ); ?>
                :
            </label>
            <button
                type="button"
                name="<?php echo esc_attr( $opt['name'] ) ?>"
                id="<?php echo esc_attr( $opt['id'] ) ?>"
                class="skel--adm--image-uploaders"
                data-skel-image-multiple="false"
                data-skel-gettextdict="skel-admin-media-uploader"
                data-skel-gettext-choose-image="<?php echo __( 'Choose Image', 'skel' ); ?>"
                data-skel-gettext-show-in-new-window="<?php echo __( 'show in new window', 'skel' ); ?>"
                data-skel-gettext-dismiss="<?php echo __( 'Dismisss', 'skel' ); ?>"
            >
                <?php echo __( 'Choose Image', 'skel' ); ?>
                <ul
                    style="display: none;"
                >
                    <?php
                        foreach ( $images as $image ) :
                    ?>
                        <li
                            data-skel-image-url="<?php echo esc_attr( $image ); ?>"
                        ></li>
                    <?php
                        endforeach;
                    ?>
                </ul>
            </button>
            <script>
                jQuery(document).ready( function(){
                    skel.set_dict();
                    skel.admin.media_uploader.set_html_of_registered_images(
                        '#<?php echo esc_attr( $opt['id'] ) ?>'
                    );
                    skel.admin.media_uploader.on_ready();
                } );
            </script>
            <span
                id="skel--adm--image-uploader-<?php echo $opt['id']; ?>"
                class="skel--adm--image-uploader-image-lists"
            ></span>
        </p>
        <?php
    }

    protected function show_field( $opt, $instance = [] ) {
        if ( empty( $opt ) ) {
            return;
        }
        $opt['name'] = $this->get_field_name($opt['field_name']);
        $opt['id'] = $this->get_field_id($opt['field_name']);
?>
    <p>
        <label
            for="<?php echo $opt['id']; ?>"
        >
            <?php echo esc_html( $opt['title'] ); ?>
            :
        </label>
        <input
            class="widefat"
            id="<?php echo $opt['id']; ?>"
            name="<?php echo $opt['name']; ?>"
            type="text"
            value="<?php echo esc_attr( $opt['value'] ); ?>"
        >
    </p>
<?php
    }

    protected function show_field_textarea( $opt, $instance = [] ) {
        if ( empty( $opt ) ) {
            return;
        }
        $opt['name'] = $this->get_field_name($opt['field_name']);
        $opt['id'] = $this->get_field_id($opt['field_name']);
?>
    <p>
        <label
            for="<?php echo $opt['id']; ?>"
        >
            <?php echo esc_html( $opt['title'] ); ?>
            :
        </label>
        <textarea
            class="widefat skel--adm--fields-textarea"
            id="<?php echo $opt['id']; ?>"
            name="<?php echo $opt['name']; ?>"
        ><?php echo esc_html( $opt['value'] ); ?></textarea>
    </p>
<?php
    }

    public function form ( $instance ) {
        foreach ( $this->CONFIG_FIELDS() as $conf ) {
            $conf['value'] = $instance[ $conf['field_name'] ];
            $prefix_of_field_name = array_shift( preg_split( '/_/', $conf['field_name']) );
            switch ( $prefix_of_field_name ) {
                case 'image' :
                    $this->show_field_image( $conf, $instance );
                    break;
                case 'textarea' :
                    $this->show_field_textarea( $conf, $instance );
                    break;
                default:
                    $this->show_field( $conf, $instance );
            }
        }
    }

    public function update ( $new_instance, $old_instance ) {
        // if ( error ) { return false; }
        return( $new_instance );
    }

    public function widget( $args, $instance ) {
        $cache = array();
        if ( ! $this->is_preview() ) {
            $cache = wp_cache_get( $this->THIS_CLASS(), 'widget' );
        }
        if ( ! is_array( $cache ) ) {
            $cache = array();
        }
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        // if ( isset( $cache[ $args['widget_id'] ] ) ) {
        //     echo $cache[ $args['widget_id'] ];
        //     return;
        // }
        extract( $args );
        $before_widget = preg_replace(
            "/^(<[^\s]+\s+class=\")/",
            "$1" . $this->WIDGET_CSS_CLASS() . ' ',
            $before_widget
        );
        $title =
            apply_filters(
                'widget_title',
                (
                    $instance['title']
                    ? $instance['title']
                    :
                        (
                            $this->WIDGET_DEFAULT_HTML_TITLE()
                            ? $this->WIDGET_DEFAULT_HTML_TITLE()
                            : ''
                        )
                )
            )
        ;
        $title = ( !empty( $title ) )
            ? ( $before_title . $title . $after_title )
            : ''
        ;
        echo $before_widget;
        echo $title;
        $this->CONTENT( $instance );
        echo $after_widget;
    }
}
call_user_func( function() {
    $klass = basename( __FILE__, '.php' );
    $skel = new $klass();
} );
