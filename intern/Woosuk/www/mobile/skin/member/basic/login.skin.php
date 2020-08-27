<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<div id="mb_login" class="wrap02">
    <h1><?php echo $g5['title'] ?></h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post" id="flogin">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">
    <div id="login_frm" class="box">
        <input type="text" name="mb_id" id="login_id" placeholder="아이디" required class="frm_input " maxLength="20">
        <input type="password" name="mb_password" id="login_pw" placeholder="비밀번호" required class="frm_input " maxLength="20">
        
        <!--<div id="login_info" class="chk_box">
            <input type="checkbox" name="auto_login" id="login_auto_login" class="selec_chk">
            <label for="login_auto_login"><span></span> 자동로그인</label>
        </div>-->
		<button type="submit" class="btn_submit">로그인</button>

        <div class="text">
            <a href=""><span>아이디 찾기</span></a>
            <a href=""><span>비밀번호</span></a>
            <a href="./register_form.php"><span>회원가입</span></a>
        </div>
    </div>

    <?php
    // 소셜로그인 사용시 소셜로그인 버튼
    //@include_once(get_social_skin_path().'/social_login.skin.php');
    ?>
    <!--<section class="mb_login_join">
        <div>
            <a href="#" target="_blank" id="login_password_lost">회원정보찾기</a>
            <a href="./register.php">회원 가입</a>
        </div>
    </section>-->
    </form>
</div>

<script>
jQuery(function($){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
        return true;
    }
    return false;
}
</script>
