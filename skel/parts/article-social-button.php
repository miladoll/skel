<div
    class="skel--gui--social-buttons"
    data-skel-location-tag="<?php echo $skel_location_tag ?>"
    data-skel-visual-align="<?php echo $skel_visual_align ?>"
>
    <?php
        call_user_func( function() {
            $post_url = urlencode( get_permalink() );
            $post_title = urlencode( get_the_title() );
    ?>
            <nav
                class="ui basic buttons"
            >
                <a
                    href="http://twitter.com/share?url=<?php echo $post_url; ?>&amp;text=<?php echo $post_title; ?>"
                    target="_blank"
                    title="Twitter でシェアする"
                    class="ui button skel--sns-twitters"
                >
                    <i class="twitter icon">
                        <span>Twitter</span>
                    </i>
                    <span
                        class="skel--social-shared-points"
                    ></span>
                </a><!-- class="skel--twitters" -->
                <span>|</span>
                <a
                    href="http://facebook.com/sharer.php?u=<?php echo $post_url; ?>&amp;t=<?php echo $post_title; ?>"
                    target="_blank"
                    title="Facebook でシェアする"
                    class="ui button skel--sns-facebooks"
                >
                    <i class="facebook f icon">
                        <span>Facebook</span>
                    </i>
                    <span
                        class="skel--social-shared-points"
                    ></span>
                </a><!-- class="skel--facebooks" -->
                <span>|</span>
                <a
                    href="http://b.hatena.ne.jp/add?mode=confirm&amp;url=<?php echo $post_url; ?>"
                    target="_blank"
                    title="はてなブックマーク でシェアする"
                    class="ui button skel--sns-hatenas"
                >
                    <i class="skel--icons skel--icon-hatena-bookmark icon">
                        <span>Hatena Bookmark</span>
                    </i>
                    <span
                        class="skel--social-shared-points"
                    ></span>
                </a><!-- class="skel--hatenas" -->
                <span>|</span>
                <!-- 
                <a
                    href="https://plus.google.com/share?url=<?php echo $post_url; ?>"
                    target="_blank"
                    title="Google+ でシェアする"
                    class="ui button skel--sns-gplus"
                >
                    <i class="google plus icon">
                        <span>Google+</span>
                    </i>
                    <span
                        class="skel--social-shared-points"
                    ></span>
                </a> --><!-- class="skel--gplus" -->
                <span>|</span>
                <a
                    href="http://line.me/R/msg/text/?<?php echo $post_url; ?>"
                    target="_blank"
                    title="LINE でシェアする"
                    class="ui button skel--sns-line"
                >
                    <i class="skel--icons skel--icon-line icon">
                        <span>LINE</span>
                    </i>
                    <span
                        class="skel--social-shared-points"
                    ></span>
                </a><!-- class="skel--gplus" -->
            </nav><!-- class="skel--social-buttons" -->
    <?php
        } );
    ?>
</div>
