<?php

/*
TODO:
[] 固定ページってちゃんとできるの？
[] 他プラグインの翻訳入れられないかなあ
[] COMMENT SUBMIT PAGE
[] COMMENT LIST PAGE
[] TRACKBACK PAGE
[] FIXED FRONT PAGE
*/

require_once 'lib/skel.php';
call_user_func( function() {
    $skel = new skel();
} );

require_once 'lib/skel_widget.php';
require_once 'lib/skel_widget_search.php';
require_once 'lib/skel_widget_tagcloud.php';
require_once 'lib/skel_widget_profile.php';

require_once 'lib/skel_bundle_plugin.php';
