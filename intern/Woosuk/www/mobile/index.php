<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

include_once(G5_MOBILE_PATH.'/head.php');

if(!$is_member){
    goto_url(G5_BBS_URL."/login.php");
}
?>
<div class="wrap08">
    <div class="box">
        <h3>40년의 기록, 역사가 있는 글로벌우석</h3>
        <h1>우석대학교<br><span>글로벌 최고경영자과정</span></h1>
        <p>국가와 사회에 기여할 수 있는 우수 경영자를 양성하고<br>
            학교와 기업과 지역사회가 강력한 네트워크를 형성함으로써<br>경제활성화에 기여할 수 있습니다 </p>
    </div>
    <div>
        진행중..
    </div>
</div>
<?php
include_once(G5_MOBILE_PATH.'/tail.php');
?>