<?php
class skel_widget_recent_articles extends skel_widget {
    public function WIDGET_TITLE() {
        return( __('Recent Articles', 'skel') );
    }
    public function WIDGET_DESCRIPTION() {
        return( __('Recent Articles', 'skel') );
    }
    public function CONFIG_FIELDS() {
        return([
            [
                'field_name' => 'title',
                'title' => __('title', 'skel')
            ],
            [
                'field_name' => 'number_posts',
                'title' => __('Number of Posts', 'skel'),
                'description' => __('How many posts to be shown in this widget', 'skel')
            ],
            [
                'field_name' => 'radio_visual_type',
                'title' => __('Visual Type', 'skel'),
                'choice' => [
                    [
                        'name' => __('default', 'skel'),
                        'description' => '',
                        'value' => '',
                        'is_default' => true
                    ],
                    [
                        'name' => __('three columned', 'skel'),
                        'description' => __('Items are horlizontally displayed. But only three recent articles', 'skel'),
                        'value' => 'three-columned',
                        'is_default' => false
                    ],
                ]
            ],
        ]);
    }
    public function WIDGET_CSS_CLASS() {
        return( 'skel--gui--widgets-recent-articles' );
    }
    public function CONTENT( $instance = [] ) {
        // $instance['image_profile']
        $visual_type = '';
        $number_posts =
            ( $instance['number_posts'] > 0 )
            ? $instance['number_posts']
            : 5
        ;
        if ( $instance['radio_visual_type'] == 'three-columned' ) {
            $visual_type = 'three-columned';
            $number_posts = 3;
        }
        $posts = get_posts(
            'numberposts=' . $number_posts
            . '&orderby=post_date'
            . '&order=DESC'
        );
?>
<ul
    class="ui list"
    data-skel-visual-type="<?php echo $visual_type; ?>"
>
    <?php
        $cur_number_posts = 0;
        foreach( $posts as $post ) :
            $cur_number_posts = $cur_number_posts + 1;
            if ( $cur_number_posts > $number_posts ) {
                break;
            }
            $id = $post->ID;
            $url = get_the_permalink( $id );
            $title = $post->post_title;
            $date = $post->post_date;
            $excerpt = skel::get_proper_excerpt( $id );
            $img_src = skel::get_proper_thumbnail_path_of_article( $id );
    ?>
            <li
                class="item"
            >
                <a
                    href="<?php echo esc_attr( $url ) . '#post-' . $id; ?>"
                    title="<?php esc_attr( $title ); ?>"
                >
                    <?php
                        if ( strlen( $img_src ) > 0 ) :
                    ?>
                        <div>
                            <img
                                class="ui top aligned tiny image"
                                src="<?php echo esc_attr( $img_src ); ?>"
                            >
                        </div>
                    <?php
                        endif;
                    ?>
                    <section>
                        <header>
                            <?php echo esc_html( $title ); ?>
                        </header>
                        <time>
                            <?php
                                echo esc_html(
                                    get_the_time(
                                        skel::prop(
                                            'basis_of_design__format_datetime_article_body',
                                            get_option('date_format')
                                        ),
                                        $id
                                    )
                                );
                            ?>
                        </time>
                        <span>
                            <?php echo esc_html( $excerpt ); ?>
                        </span>
                    </section>
                </a>
            </li>
    <?php
        endforeach;
    ?>
</ul>
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
