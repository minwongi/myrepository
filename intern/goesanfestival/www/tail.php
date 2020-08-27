<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/tail.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
?>
<footer class="ft">
    <div class="width-fixed">
        <div class="ft_logo">
            <div class="img">
                <div>
                    <img src="<?php echo G5_IMG_URL;?>/2020img/footer_img.png" alt="">
                </div>
            </div>
        </div>
        <div class="ft_infos">
            <!--<ul>
                <li>개인정보처리방침</li>
                <li>저작권 정책</li>
            </ul>-->
            <div class="homes">
                [28026] 충북 괴산군 괴산읍 임꺽정로 90&nbsp;&nbsp;&nbsp;<span class="td_hidden">|</span><br class="pc">&nbsp;&nbsp;&nbsp;대표전화 : 043-830-3114&nbsp;&nbsp;&nbsp;<span class="td_hidden">|</span><br class="pc">&nbsp;&nbsp;&nbsp;야간당직실 : 043-830-3221~3&nbsp;&nbsp;&nbsp;<span class="td_hidden">|</span><br class="pc">&nbsp;&nbsp;&nbsp;팩스 : 043-832-8929
            </div>
            <div class="copys">
                COPYRIGHT &copy; 2020 GOESAN ALL RIGHTES RESERVED. <?php if($is_admin){?><a href="<?php echo G5_URL;?>/page/inquiry_list.php">신청목록</a><?php } if(!$is_member){?>
                    <a href="<?php echo G5_BBS_URL;?>/login.php">관리자로그인</a><?php }?>
            </div>
        </div>
    </div>
</footer>
<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));

    $('a[href*=#]').on('click', function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
    });
});


</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>