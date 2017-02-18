<ul
    class="skel--gui--article-specs skel--gui--flat-lists"
    data-skel-location-tag="<?php echo $skel_location_tag ?>"
    data-skel-visual-align="<?php echo $skel_visual_align ?>"
>
    <li
        class="skel--gui--article-spec-dates"
    >
        <i class="ui calendar icon">
            <span><?php _e('Date', 'skel'); ?></span>
        </i>
        <span>
            <time 
                datetime="<?php echo get_the_date('c'); ?>"
                itemprop="datePublished"
            >
                <a
                    href="<?php the_permalink(); ?>"
                    title="<?php the_title(); ?>"
                >
                    <?php
                        the_time(
                            skel::prop(
                                'basis_of_design__format_datetime_article_body',
                                get_option('date_format') . ' ' . get_option('time_format')
                            )
                        );
                    ?>
                </a>
            </time>
        </span>
    </li>
    <li
        class="skel--gui--article-spec-authors"
    >
        <i class="ui user icon">
            <span><?php _e('Author', 'skel'); ?></span>
        </i>
        <span>
            <data itemprop="author">
                <a
                    title="<?php
                        echo
                            __('Author', 'skel')
                            . ':'
                            . get_the_author()
                        ;
                    ?>"
                    href="<?php echo get_author_posts_url( false, '' ); ?>"
                ><?php the_author(); ?></a>
            </data>
        </span>
    </li>
    <li
        class="skel--gui--article-spec-categories"
    >
        <i class="ui folder open outline icon">
            <span><?php _e('Categories', 'skel'); ?></span>
        </i>
        <span>
            <data itemprop="genre">
                <ul>
                    <?php
                        the_category( '</li><li>' );
                    ?>
                </ul>
            </data>
        </span>
    </li>
    <li
        class="skel--gui--article-spec-tags<?php if ( !get_the_tags() ) { echo ' skel--no-contents'; } ?>"
    >
        <i class="ui tags icon">
            <span><?php _e('Tags', 'skel'); ?></span>
        </i>
        <span>
            <data itemprop="keywords">
                <?php
                    the_tags(
                        '<ul><li>',
                        '</li><li>',
                        '</li></ul>'
                    );
                ?>
            </data>
        </span>
    </li>
    <?php
        if ( comments_open() ) :
    ?>
        <li
            class="skel--gui--article-spec-comments"
        >
            <i class="comments outline icon">
                <span><?php _e('Comments', 'skel'); ?></span>
            </i>
            <span>
                <a
                    title="<?php _e('Comments', 'skel'); ?>"
                    href=""
                >
                    <data><?php
                        echo get_comments([
                            'status' => 'approve',
                            'post_id'=> get_the_ID(),
                            'type'=> 'comment',
                            'count' => true
                        ]);
                    ?></data>
                </a>
            </span>
        </li>
    <?php
        endif;
    ?>
    <?php
        if ( pings_open() ) :
    ?>
        <li
            class="skel--gui--article-spec-trackbacks"
        >
            <i class="browser icon">
                <span><?php _e('Trackbacks', 'skel'); ?></span>
            </i>
            <span>
                <a
                    title="<?php _e('Trackbacks', 'skel'); ?>"
                    href=""
                >
                    <data><?php
                        echo get_comments([
                            'status' => 'approve',
                            'post_id'=> get_the_ID(),
                            'type'=> 'pings',
                            'count' => true
                        ]);
                    ?></data>
                </a>
            </span>
        </li>
    <?php
        endif;
    ?>
</ul><!-- class="skel--gui--article-specs skel--gui--flat-lists" -->
<div class="skel--tag">
</div>
