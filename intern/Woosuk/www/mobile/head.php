<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
    return;
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>
<header>
    <div class="wrap">
        <div class="my"><a href="./login.html"></a></div>
        <a href="./main.html" class="logo"><div class="logo"></div></a>
        <div class="nav">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="menu">
            <div class="menubox">
                <div class="top">
                    <a href="<?php echo G5_URL;?>"><div></div></a>
                </div>
                <div class="list0">
                    <select name="" id="">
                        <option value="1">1기</option>
                        <option value="2">2기</option>
                        <option value="3">3기</option>
                        <option value="4">4기</option>
                        <option value="5">5기</option>
                        <option value="6">6기</option>
                    </select>
                </div>
                <div class="list">
                    <ul>
                        <li class="no1">
                            <span class="icon"></span>
                            <a href="./list.html"><span>운영개요</span></a>
                        </li>
                        <li class="no2">
                            <span class="icon"></span>
                            <a href="./list_1.html"><span>원우회 회칙</span></a>
                        </li>
                        <li class="no3">
                            <span class="icon"></span>
                            <a href="./main_2.html"><span>주요 프로그램</span></a>
                        </li>
                        <li class="no4">
                            <span class="icon"></span>
                            <a href="#"><span>과정 특전</span></a>
                        </li>
                        <li class="no5">
                            <span class="icon"></span>
                            <a href="#"><span>2020년도 학사 일정</span></a>
                        </li>
                        <li class="no6">
                            <span class="icon"></span>
                            <a href="#"><span>공지사항</span></a>
                        </li>
                    </ul>
                </div>
                <div class="menufooter">
                    <div>국가와 사회에 기여할 수 있는 우수 경영자 양성</div>
                    <div>우석대학교 글로벌 최고경영자과정</div>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    $(".nav").click(function(){
        $(".menu").toggleClass("active");
        $(".nav").toggleClass("active");
        $(".nav").css("z-index","9");
    });
</script>


<div id="wrapper">

    <div id="container">
    <?php if (!defined("_INDEX_")) { ?>
    	<h2 id="container_title" class="top" title="<?php echo get_text($g5['title']); ?>">
    		<a href="javascript:history.back();"><i class="fa fa-chevron-left" aria-hidden="true"></i><span class="sound_only">뒤로가기</span></a> <?php echo get_head_title($g5['title']); ?>
    	</h2>
    <?php } ?>
