<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_PATH.'/head.php');

$total=sql_fetch("select count(*) as cnt from `cheerup_comment`");
if(!$page)
    $page=1;
$total=$total['cnt'];
$rows=10;
$start=($page-1)*$rows;
$total_page=ceil($total/$rows);
$sql="select * from `cheerup_comment` order by `id` desc limit {$start},{$rows}";
$query=sql_query($sql);
$j=0;
while($data=sql_fetch_array($query)){
    $list[$j]=$data;
    $list[$j]['num']=$total-($start)-$j;
    $j++;
}
?>
<script>
    $(function(){
        if(get_cookie("popup") != "done"){
            $("#popup").css("top","0");
        }
    });

    function fnClosePop(){
        if($("#close").prop("checked")==true) {
            set_cookie("popup", "done", 1);
        }
        $("#popup").css("top","-100vh");
    }
</script>
<div id="popup">
    <div class="pop" style="background:url('<?php echo G5_IMG_URL;?>/2020img/top_popup.png') center no-repeat; ">
        <div class="width-fixed">
            <div class="img">
                <img src="<?php echo G5_IMG_URL;?>/2020img/top_popup_text.png" alt="팝업이미지">
            </div>
            <div class="close_pop">
                <input type="checkbox" name="close" id="close"><a href="javascript:fnClosePop()">오늘하루 보지않기</a>
            </div>
        </div>
    </div>
</div>
<div class="main_page">
    <section class="main_images" id="main">
        <div class="width-fixed">
            <div class="item_title">
                <img src="<?php echo G5_IMG_URL;?>/2020img/main_top_img.png" alt="">
                <div class="main_sec01">
                  <!--<div class="sec01_tit01">
                        <span>코로나19를 넘어,</span>
                        <span>2020괴산순정농부 고추장터</span>
                    </div>
                    <div class="sec01_img01"></div>
                    <div class="sec01_img02"></div>
                    <div class="sec01_tit02">온라인 고추축제기간 : <span>2020년 8월 31일 ~ 9월 6일</span></div>
                    <div class="sec01_tit03">오프라인판매 : 2020년 9월 4일 ~ 9월 6일 <spna>장소</spna>괴산종합운동장</div>-->
                    <div class="sec01_tit04">
                        문화체육관광부가 선정한 예비문화관광축제,<img src="<?php echo G5_IMG_URL;?>/2020img/sec01_img3.png" alt="">가 <br class="mobile"><strong>8월 31일</strong>(목) ~ <strong>9월 6일</strong>(일) 온라인으로 개최됩니다.<br ><span>괴산청결고추</span>를 비롯한 <strong>괴산의 농특산물</strong>을
                        <strong>온라인</strong>에서 <strong>구매</strong>할 수 있으며, <br class="mobile"><strong>다양한 온라인 이벤트를 진행</strong>합니다.
                    </div>
                </div>
            </div>
        </div>

        <div class="owl-carousel" id="main_slide">
            <div class="item" style="background-image:url('<?php echo G5_IMG_URL;?>/2020img/se01_bg.jpg'); background-size:cover;background-position:center;background-repeat:no-repeat;"></div>
            <!-- <div class="item" style="background-image:url('<?php echo G5_IMG_URL;?>/main_bg.jpg');background-size:cover;background-position:center;background-repeat:no-repeat;">
            </div> -->
        </div>
        <div class="scroll">
            <img src="<?php echo G5_IMG_URL;?>/2020img/scroll.png" alt="">
        </div>
        <div class="scroll_2" >
            <a href="#menus8"><img src="<?php echo G5_IMG_URL;?>/2020img/scroll_2.png" alt=""></a>
        </div>
    </section>
    <section class="main_page2" id="menu1">
        <div class="width-fixed">
            <div class="sec03">
                <div class="sec03_tit">
                    <h2 ><span>2020 괴산고추축제</span></h2>
                    <img src="<?php echo G5_IMG_URL;?>/2020img/sec03_img1.png" alt="과산고추장터">
                </div>
            </div>
			<!--<div class="intros_logo">
				<img src="<?php /*echo G5_IMG_URL;*/?>/2020img/sec01_img1.svg" alt="">
			</div>-->
            <div class="intros">
                <div class="left">
                    <iframe width="980" height="550" src="https://www.youtube.com/embed/0kJiTp_3DwU?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <!--<div class="right">
                    <p class="intro_text">문화체육관광부가 선정한 문화관광유망축제, <img src="<?php /*echo G5_IMG_URL;*/?>/2020img/sec01_img3.png" alt="">가 <br class="pc"><span>8월 31일</span><span class="small">(월) ~</span> <span>9월 6일</span><span class="small">(일)</span>개최됩니다.</p>
                </div>-->
            </div>
        </div>
    </section>

    <section class="main_page7" id="menu7">
        <div class="width-fixed">

        <!--		<img src="--><?php //echo G5_IMG_URL;?><!--/page7_img.png" alt="">-->
	    <div class="sec03">

		    <div class="sec03_tit">
                <h2 ><span>2020 괴산고추축제</span></h2>
                <img src="<?php echo G5_IMG_URL;?>/2020img/sec03_img1.png" alt="과산고추장터">
            </div>
		    <div class="sec03_tit2">축제기간동안 온라인에서 괴산청결고추와 괴산의 농특산물을 만나보세요!</div>
		    <div class="sec03_img">
			    <div class="no1" onclick="window.open('https://www.gsjangter.go.kr/','_blank');">
                    <img src="<?php echo G5_IMG_URL;?>/2020img/sec03_img2.png" alt="괴산장터">
                </div>
			    <div class="no2" onclick="window.open('https://www.youtube.com/watch?v=UET7i1VRUAY&list=PLShrRmUwJCemrUJjmVEWR36NmG7pJ-foQ&index=2&t=0s','_blank');">
                    <img src="<?php echo G5_IMG_URL;?>/2020img/sec03_img3.png" alt="티비홈쇼핑">
                </div>
			    <div class="no3" onclick="alert('8월31일부터 생방으로 진행합니다..');//window.open('https://www.youtube.com/channel/UC_6fr45-rZKMusIE8lQcm6A/featured','_blank')">
                    <img src="<?php echo G5_IMG_URL;?>/2020img/sec03_img4.png" alt="온라인 스튜디오">
                </div>
		    </div>
		    <div class="sec03_tit3">코로나19를 넘어, 괴산고추축제가 <span class="point1">20주년</span>을 맞이하여 <br class="mobile">2020괴산고추축제가 <span class="point2">온라인</span>으로 진행됩니다.<br>오프라인축제와 동일하고 <span class="point3">다양한 혜택</span>과 <br class="mobile"><span class="point4">이벤트</span>로 성원에 보답하겠습니다.</div>
	    </div>
		</div>
	</section>
	<section class="main_page8" id="menus8">
        <div class="width-fixed">
            <div class="sec04"></div>
            <div class="text">
                <div class="in_text">
                    2020 온라인 고추축제를 맞이하여 <br class="mobile">다양한 <span class="point1">온라인 이벤트</span>를 준비중입니다!<br>
                    함께하면 더욱 즐거운 <span class="point2">2020 온라인 괴산고추축제</span> 기대해주세요!<br>
                    <span class="point3">이벤트 참여기간</span> : 2020년 8월 31일 ~ 9월 6일
                </div>
            </div>
        </div>
	</section>
	<section class="main_page9">
        <div class="width-fixed">
            <div class="sec05">
                <div class="sec05_img1">
                    <img src="<?php echo G5_IMG_URL;?>/2020img/sec05_img4.png" alt="함께하는">
                </div>
                <div class="sec05_tit1">
                    <img src="<?php echo G5_IMG_URL;?>/2020img/sec05_img3.png" alt="함께하는">
                </div>
                <div class="sec05_tit2">‘챌린지송’에 맞춰 율동 영상을 찍고 SNS에 공유해주세요. <br class="mobile">추첨을 통해 경품을 드립니다.</div>
                <div class="sec05_img2">
                        <img src="<?php echo G5_IMG_URL;?>/2020img/sec05_img2.png" alt="챌린지송">
                </div>
                <div class="sec05_link" onclick="window.open('https://youtu.be/kuW1kin5AoI','_blank')//alert('준비중입니다.');" style="cursor: pointer">
                    <img src="<?php echo G5_IMG_URL;?>/2020img/sec05_img1.png" alt="영상링크">
                </div>
                <div class="sec05_tit3"><span class="point1">틱톡<img src="<?php echo G5_IMG_URL;?>/2020img/tic.png" alt=""> 사운드</span>에서 <span class="point2">'괴산고추축제'</span>챌린지송을 검색한 후 음원에 맞춰 <br>신나는 <span class="point2">율동 영상을 촬영</span>하여 업로드 해주세요~ <br class="mobile"><img src="<?php echo G5_IMG_URL;?>/2020img/point.png" alt="">하트를 가장 많이 받으신 분께 <span class="point2">무선이어폰</span>을 드립니다!<br><span class="point1">해시태그</span> <strong>(#2020괴산고추축제, #괴산청결고추, #괴산고추축제송 필수!)</strong></div>
                <div class="sec05_tit4"><span>이벤트 참여기간</span> : 2020년 8월 19일 ~ 9월 6일</div>
            </div>
        </div>

    </section>

    <section class="main_page6" id="menu6">
        <div class="width-fixed">
            <div class="main_title">
                <h2 ><span>괴산순정농부 고추장터</span> 응원 한마디</h2>
            </div>
			<div class="page6_wt">
                <form action="<?php echo G5_URL;?>/page/comment_update.php" method="post" onsubmit="return fnComment();">
                    <table class="wt1">
                        <tr>
							<th>이름</th>
                            <td><input type="text" name="cheering_name" id="cheering_name" required placeholder='홍길동' ></td>
                        </tr>
                        <tr>
							<th>핸드폰번호</th>
                            <td><input type="text" name="cheering_pw" id="cheering_pw" maxlength="12" required placeholder='이벤트 수령을 위해 반드시 본인의 핸드폰을 입력바랍니다.' onkeyup="number_only(this)" ></td>
                        </tr>
                        <tr>
							<th>응원 한마디</th>
                            <td><input type="text" name="cheering_cmt" id="cheering_cmt" required maxlength="100" placeholder='응원 메시지는 100자 이내로 작성해주시길 바랍니다.' ></td>
                        </tr>
					</table>
                    <table class="wt2">
                        <tr>
							<td><input type="submit" value="응원하기"></td>
                        </tr>
                    </table>
                </form>
			</div>
            <div class="cheering_list">
				<h3>응원 한마디</h3>
				<table>
                    <colgroup>
                        <col width="15%">
                        <col width="*">
                        <col width="15%" class="td_hidden2">
                    </colgroup>
                    <?php for($i=0;$i<count($list);$i++){?>
					<tr>
						<td><?php echo iconv_substr($list[$i]["user_name"],0,1,'UTF-8')."**";?></td>
						<td title="<?php echo $list[$i]["user_comment"];?>"><?php echo $list[$i]["user_comment"];?></td>
						<td class="td_center td_hidden"><?php echo ($list[$i]["user_date"]==date("Y-m-d"))?$list[$i]["user_time"]:$list[$i]["user_date"];?></td>
					</tr>
                    <?php }
                    if(count($list)==0) {
                    ?>
                    <tr>
                        <td colspan="3" class="td_center">2019년 괴산 고추축제 첫 응원을 등록해보세요.</td>
                    </tr>
                    <?php
                    }?>
				</table>
                    <?php
                    if($total_page>1){
                        $start_page=1;
                        $end_page=$total_page;
                        if($total_page>5){
                            if($total_page<($page+2)){
                                $start_page=$total_page-4;
                                $end_page=$total_page;
                            }else if($page>3){
                                $start_page=$page-2;
                                $end_page=$page+2;
                            }else{
                                $start_page=1;
                                $end_page=5;
                            }
                        }
                        ?>
                        <div class="playing">
                            <?php if($page!=1){?>
                            <ul class="prev">
                                <li ><a href="javascript:fnPage(<?php echo ($page-1); ?>)"><img src="<?php echo G5_IMG_URL;?>/1page_btn.png" alt=""></a></li>
                            </ul>
                            <?php } ?>
                            <ul class="number">
                            <?php for($i=$start_page;$i<=$end_page;$i++){ ?>
                                <li class="<?php echo $page==$i?"active":""; ?>"><a href="javascript:fnPage(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                            <?php } ?>
                            </ul>
                            <?php if($page<$total_page){?>
                            <ul class="next">
                                <li ><a href="javascript:fnPage(<?php echo ($page+1); ?>)"><img src="<?php echo G5_IMG_URL;?>/1page_btn.png" alt=""></a></li>
                            </ul>
                            <?php } ?>
                        </div>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </section>

	
    <section class="main_page4" id="menu3">
        <div class="width-fixed">
            <div class="main_title">
                <h2><span>다시보는 2019고추축제</span> 갤러리</h2>
            </div>
            <div>
                <?php
                    $sql = "select * from `g5_write_gallery` order by wr_id desc limit 0, 10";
                    $res = sql_query($sql);
                    while($row = sql_fetch_array($res)){
                        $galllist[] = $row;
                    }
                ?>
                <?php if (count($galllist) > 0) { //게시물이 없을 때
                    ?>
                    <div class="owl-carousel" id="gall_slide">
                        <?php for ($i=0; $i<count($galllist); $i++) {
                            //$file = get_file("gallery",$galllist[$i]["wr_id"]);
                            $thumfile = get_list_thumbnail('gallery',$galllist[$i]["wr_id"],'500','');
                            ?>
                            <div class="item" style="background-size:cover;background-position:center;background-repeat:no-repeat;background-image:url('<?php echo $thumfile["src"];?>')">
                                <img src="<?php echo $thumfile["src"]?>" alt="" style="opacity:0;">
                            </div>
                        <?php }  ?>
                    </div>
                <?php }else{ ?>
                    <div class="no_slide">
                        <div>게시물이 없습니다.</div>
                    </div>
                <?php } ?>
                <?php //echo latest('slide','gallery','10');?>
            </div>
        </div>
    </section>
	<section class="main_page3" id="menu2">
        <div class="width-fixed">
            <div class="main_title">
                <h2><span>괴산순정농부 고추장터</span> 운영안내</h2>
            </div>
	        <div class="sec05_con">
		        <div class="left">
			        <div class="top_title">온라인<span>[2020.08.31.~09.06.]</span></div>
			        <div class="box">
				        <div class="in_box">
                            <div class="in_box_row">
                                <div class="box_title">군직영 쇼핑몰<br>괴산장터</div>
                                <div class="box_content">괴산청결고추, 괴산 농․특산물 판매</div>
                            </div>
				        </div>
				       <!-- <div class="in_box2">
                        </div>-->
                        <div class="caption">온라인 스튜디오 운영(매일 17시~18시)</div>
				        <div class="in_box bottoms tops">
                            <div class="in_box_row">
                                <div class="box_title">괴산군 <br>유튜브채널 운영</div>
                                <div class="box_content">인기가수와 함께하는 『치유의 숲, 괴산으로 가요』</div>
                            </div>
                        </div>
                        <div class="caption2">출연진(고정MC : 고정우)</div>
                        <div class="caption2 img">
                            <div>
                                <img src="<?php echo G5_IMG_URL;?>/2020img/onlin_img1.png" alt="">
                            </div>
                        </div>
                        <div class="in_box">
                            <div class="in_box_row">
                                <div class="box_title">내용</div>
                                <div class="box_content">
                                    <span>트로트 라이브, 괴산 농․특산물을 활용한 요리<br>시식, 실시간 댓글 읽기, 초대가수와 게임</span>
                                </div>
                            </div>
				        </div>
                        <div class="caption3">
                            <img src="<?php echo G5_IMG_URL;?>/2020img/noempty.png" alt="샘플이미지">
                        </div>
			        </div>
		        </div>
		        <div class="right">
			        <div class="top_title">오프라인</div>
			        <div class="box">
                        <div class="caption">
				            <div>2020 괴산고추축제 순정농부 고추장터(2020.09.04.~09.06.)</div>
                        </div>
                        <div class="in_box bottoms">
                            <div class="in_box_row">
                                <div class="box_title">장소</div>
				                <div class="box_content">괴산종합운동장(드라이브 스루, 워킹 스루 방식으로 운영)</div>
                            </div>
                        </div>
				        <div class="map2">
                            <img src="<?php echo G5_IMG_URL;?>/2020img/map.jpg" alt="지도" onclick="window.open(g5_url+'/image_view.php?url=<?php echo G5_IMG_URL;?>/2020img/map.png','_blank');">
                        </div>
				        <div class="in_box">
                            <div class="in_box_row">
					            <div class="box_title">드라이브 스루</div>
					            <div class="box_content">운동장 2번 게이트(입구)→<br>운동장 트랙 위→<br>1번 게이트(출구)</div>
                            </div>
                            <div class="in_box_row">
					            <div class="box_title">워킹스루</div>
					            <div class="box_content">동진천 하상 주차→<br>운동장 정문(입구)→<br>운동장 잔디밭→<br>운동장 정문(출구)</div>
                            </div>
                            <div class="in_box_row">
                                <div class="box_title">고추방앗간</div>
                                <div class="box_content">2개소(하상주차장, 1번 게이트 출구 쪽)</div>
                            </div>
                            <div class="in_box_row">
                                <div class="box_title">고추품평회 &<br>세계고추전시</div>
                                <div class="box_content">잔디밭 동선구획</div>
                            </div>
				        </div>
                        <div class="caption">
                            <div>미니멈 고추축제(2020.08.31.~09.06.)</div>
                        </div>
				        <div class="in_box">
                            <div class="in_box_row">
                                <div class="box_title">장소</div>
                                <div class="box_content">서울(양재․창동 하나로마트), 청주(농협물류센터)</div>
                            </div>
                            <div class="in_box_row">
                                <div class="box_title">내용</div>
                                <div class="box_content">고추 판매장 운영, 농․특산물 판매 및 이벤트 등</div>
                            </div>
				        </div>
			        </div>
	        </div>
         
        </div>
    </section>
</div>

<!--<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=609c55711a672c16cbd3ecb6281a1a46"></script>-->
<script>
    function number_only(t){
        t.value = t.value.replace(/[^0-9]/g, '');
    }

    var owl = $("#main_slide");
    owl.owlCarousel({
        autoplay: true,
        autoplayTimeout: 8000,
        autoplaySpeed: 2000,
        smartSpeed: 2000,
        loop: true,
        dots: false,
        items: 1
    });

    var owls = $("#gall_slide");
    owls.owlCarousel({
        autoplay: true,
        margin:20,
        autoplayTimeout: 8000,
        autoplaySpeed: 2000,
        smartSpeed: 2000,
        loop: true,
        dots: false,
        center:true,
        nav:true,
        navText:['',''],
        items: 3,
        responsive:{
            0 : {
                items:1,
                nav:false,
                dots:true
            },
            480 : {
                items:1,
                nav:false,
                dots:true
            },
            768 : {
                items:3,
                nav:true
            }
        }
    });

		$(function(){
        $(".main_tab li").click(function(){
            if(!$(this).hasClass("active")){
                $(this).addClass("active");
                $(".main_tab li").not($(this)).removeClass("active");
                if($(this).attr("id")=="tab1"){
                    $(".tab1").addClass("active");
                    $(".tab2").removeClass("active");
                    $(".tab3").removeClass("active");
                }
                if($(this).attr("id")=="tab2"){
                    $(".tab2").addClass("active");
                    $(".tab1").removeClass("active");
                    $(".tab3").removeClass("active");
                }
                if($(this).attr("id")=="tab3"){
                    $(".tab3").addClass("active");
                    $(".tab2").removeClass("active");
                    $(".tab1").removeClass("active");
                }
            }
        });

    })
	/*
    var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
    var options = { //지도를 생성할 때 필요한 기본 옵션
        center: new kakao.maps.LatLng(36.815324, 127.786663), //지도의 중심좌표.
        level: 3 //지도의 레벨(확대, 축소 정도)
    };
    var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴

    map.setZoomable(false);
    map.setDraggable(false);

    // 마커가 표시될 위치입니다
    var markerPosition  = new kakao.maps.LatLng(36.815324, 127.786663);

    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        position: markerPosition
    });

    // 마커가 지도 위에 표시되도록 설정합니다
    marker.setMap(map);

    
   
    var feed = new Instafeed({
        get: 'user',
        userId:'7262737200',
        limit:5,
        accessToken: '7262737200.b1ddb55.13d365e500564b35893a62726425a8f2'
    });
    feed.run();*/

	function fninquiry(){
        if($("#inquiry_name").val()==""){
            alert("신청이름을 입력해주세요.");
            $("#inquiry_name").focus();
            return false;
        }
        if($("#hp").val()==""){
            alert("휴대폰 번호를 입력해주세요.");
            $("#hp").focus();
            return false;
        }

        if($("#in_date").val()==""){
            alert("신청일을 선택해주세요.");
            $("#in_date").focus();
            return false;
        }

        if($("#in_time").val()==""){
            alert("회차를 선택해주세요.");
            $("#in_time").val();
            return false;
        }

        if($("#agree1").prop("checked")!=true){
            alert("개인정보 처리방침에 동의하셔야 합니다.");
            $("#agree1").focus();
            return false;
        }
    }

    function fninquiry2(){
        if($("#inquiry_name2").val()==""){
            alert("신청이름을 입력해주세요.");
            $("#inquiry_name2").focus();
            return false;
        }
        if($("#hp2").val()==""){
            alert("휴대폰 번호를 입력해주세요.");
            $("#hp2").focus();
            return false;
        }

        if($("#in_date2").val()==""){
            alert("신청일을 선택해주세요.");
            $("#in_date2").focus();
            return false;
        }

        if($("#in_time2").val()==""){
            alert("회차를 선택해주세요.");
            $("#in_time2").val();
            return false;
        }

        if($("#agree2").prop("checked")!=true){
            alert("개인정보 처리방침에 동의하셔야 합니다.");
            $("#agree2").focus();
            return false;
        }
    }

	function fnComment(){
	    if($("#cheering_name").val()==''){
	        alert("이름을 입력해주세요.");
	        $("#cheering_name").focus();
	        return false;
        }

        if($("#cheering_pw").val()==""){
            alert("핸드폰번호를 입력해주세요.");
            $("#cheering_pw").focus();
            return false;
        }

        if($("#cheering_cmt").val()==""){
            alert("응원내용을 입력해주세요.");
            $("#cheering_cmt").focus();
            return false;
        }


        var chkfilter = true;
        $.ajax({
            url: g5_url+"/page/ajax.filter.php",
            type: "POST",
            data: {
                "content": $("#cheering_cmt").val()
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                if(data.content!=""){
                    alert(data.content+"는 사용할 수 없는 단어입니다.");
                    $("#cheering_cmt").val('');
                    chkfilter = false;
                }
            }
        });
        if(chkfilter == false){
            return false;
        }
    }

    function fnPage(page){
        $.ajax({
            url:g5_url+'/page/ajax.comment_list.php',
            method:"post",
            data:{page:page},
            async:false
        }).done(function(data){
            $(".cheering_list").html(data);
        });
    }

</script>
<?php
include_once(G5_PATH.'/tail.php');
?>