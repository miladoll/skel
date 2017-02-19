<?php

/*
TODO:
[] nav_menu 'menu' => 'menu_site_global' がなかったらつくる、みたいな
[] タイトル・日付のリンク先をページ内リンクにする
[] テーマロケーション表示
[] SMARTPHONE DISPLAY/NON-DISPLAY
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
