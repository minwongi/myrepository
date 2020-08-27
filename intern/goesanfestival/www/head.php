<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>

<header class="header">
    <div class="logo">
<!--        <a href="#main"><img src="--><?php //echo G5_IMG_URL;?><!--/logo.png" alt=""></a>-->
    </div>
    <!--<div class="menu">
        <ul>
            <li><a href="#menu1">행사소개</a></li>
            <li><a href="#menu2">프로그램</a></li>
            <li><a href="#menu3">포토갤러리</a></li>
            <li><a href="#menu4">커뮤니티</a></li>
            <li><a href="#menu5">황금고추를찾아라</a></li>
            <li><a href="#menu6">오시는길</a></li>
        </ul>
    </div>-->
</header>