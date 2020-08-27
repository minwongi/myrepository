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
<div class="main_page">
    <section class="main_images" id="main">
        <div class="item_title">
            <img src="<?php echo G5_IMG_URL;?>/main_txt.png" alt="">
        </div>
        <div class="owl-carousel" id="main_slide">
            <div class="item" style="background-image:url('<?php echo G5_IMG_URL;?>/main_bg.jpg');background-size:cover;background-position:center;background-repeat:no-repeat;"></div>
            <!-- <div class="item" style="background-image:url('<?php echo G5_IMG_URL;?>/main_bg.jpg');background-size:cover;background-position:center;background-repeat:no-repeat;">
            </div> -->
        </div>
		<div class="width-fixed">
			<div class="scroll">
				<img src="<?php echo G5_IMG_URL;?>/main_scroll.png" alt="">
			</div>
		</div>
    </section>
    <section class="main_page2" id="menu1">
        <div class="width-fixed">
			<div class="intros_logo">
				<img src="<?php echo G5_IMG_URL;?>/logo.png" alt="">
			</div>
            <div class="intros">
                <div class="left">
                    <iframe width="980" height="550" src="https://www.youtube.com/embed/ywrbBafv6Pg?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="right">
                    <p class="intro_text">문화체육관광부가 선정한 문화관광유망축제, <img src="<?php echo G5_IMG_URL;?>/logo.png" alt="">가 <br class="pc"><span>8월 29일</span><span class="small">(목) ~</span> <span>9월 1일</span><span class="small">(일)</span>개최됩니다.</p>
					<p class="intro_text2"><span>괴산청결고추</span>를 비롯한 농ㆍ특산물과 다양한 <span>체험거리</span>, <span>볼거리</span>, <span>먹거리</span>도 <br class="pc">즐기고 좋은 추억도 만드시기 바랍니다. </p>
                </div>
            </div>
        </div>
    </section>

    <section class="main_page7" id="menu7">
		<img src="<?php echo G5_IMG_URL;?>/page7_img.png" alt="">
        <div class="width-fixed">
		</div>
	</section>

    <section class="main_page6" id="menu6">
        <div class="width-fixed">
            <div class="main_title">
                <h2 ><span>2019괴산고추축제</span> 응원 한마디</h2>
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


    <section class="main_page5" id="menu5">
        <div class="width-fixed">
            <div class="main_title">
                <h2 style="border-bottom:none;"><img src="<?php echo G5_IMG_URL;?>/main_event_txt.png" alt=""></h2>
            </div>
            <div class="gold_title">
                <img src="<?php echo G5_IMG_URL;?>/gold_title.png" alt="">
            </div>
            <div class="page_info">
                1회당 총 참여인원 <span>500명</span>, 사전접수 <span>100명</span>, 인터넷접수 <span>100명</span>, <br class="pc">현장신청 <span>300명</span>신청자에 한에 이벤트에 참가하실 수 있습니다.
                <br>
                문의사항 <span>043-830-3332</span>로 문의 바랍니다.
            </div>
            <div class="inquiry_form">
                <form action="<?php echo G5_URL;?>/page/inquiry_update.php" method="post" onsubmit="return fninquiry();">
                    <table>
                        <tr>
							<th>이&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;름</th>
                            <td><input type="text" name="inquiry_name" id="inquiry_name"  ></td>
                        </tr>
                        <tr>
							<th>휴 대 폰</th>
                            <td><input type="text" name="hp" id="hp"  maxlength="12" onkeyup="number_only(this);"></td>
                        </tr>
                        <tr>
                            <th>신 청 일</th>
                            <td>
                                <select name="in_date" id="in_date" onchange="fnGetTime(this.value);" >
                                    <option value="">선택하세요.</option>
                                    <option value="2019-08-29">8월 29일 (목)</option>
                                    <option value="2019-08-30">8월 30일 (금)</option>
                                    <option value="2019-08-31">8월 31일 (토)</option>
                                    <option value="2019-09-01">9월 01일 (일)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>회&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;차</th>
                            <td>
                                <select name="in_time" id="in_time" >
                                    <option value="">신청날짜를 선택하세요.</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="agree" style="text-align:right" colspan="2">
                                <input type="checkbox" name="agrees1" id="agree1" ><label for="agree1">개인정보 처리방침 동의</label>
                            </td>
                        </tr>
						<tr>
							<td colspan="2" class="last2">
								<div style="text-align:left">
									목적 <br>
									- 이용자 식별 및 본인여부 확인 <br>
									- 고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별<br><br>

									보유 항목<br>
									- 이름, 전화번호<br><br>
								
									보유기간<br>
									- 행사 종료 전까지
								</div>
							</td>
						</tr>
                        <tr>
                            <td colspan="2" class="last">
                                <img src="<?php echo G5_IMG_URL;?>/gold_infos.png" alt="">
                            </td>
                        </tr>
                    </table>
                    <div class="cancel_info">
                        <p>신청 후 1일 이내 미입금 시 자동 취소됩니다.</p>
                    </div>
                    <div class="price_info">
                        <img src="<?php echo G5_IMG_URL;?>/gold_price_info.png" alt="">
                    </div>
                    <table>
                        <tr>
                            <td colspan="2" >
                                <input type="submit" value="사전예약 신청하기">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </section>


    <section class="main_page5" id="menu8">
        <div class="width-fixed">
            <div class="main_title">
                <h2 style="border-bottom:none;"><img src="<?php echo G5_IMG_URL;?>/nanta_txt.png" alt=""></h2>
            </div>
            <div class="gold_title">
                <img src="<?php echo G5_IMG_URL;?>/nanta_title.png" alt="">
            </div>
            <div class="page_info">
                선착순 <span>150명</span>, 사전접수 <span>80명</span> 신청자에 한에 <br class="pc">이벤트에 참가하실 수 있습니다.
                <br>
                문의사항 <span>043-830-3485</span>로 문의 바랍니다.
            </div>
            <div class="inquiry_form">
                <form action="<?php echo G5_URL;?>/page/inquiry_update2.php" method="post" onsubmit="return fninquiry2();">
                    <table>
                        <tr>
							<th>이&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;름</th>
                            <td><input type="text" name="inquiry_name2" id="inquiry_name2"  ></td>
                        </tr>
                        <tr>
							<th>휴 대 폰</th>
                            <td><input type="text" name="hp2" id="hp2"  maxlength="12" onkeyup="number_only(this);"></td>
                        </tr>
                        <tr>
                            <th>신 청 일</th>
                            <td>
                                <select name="in_date2" id="in_date2" onchange="fnGetTime2(this.value);" >
                                    <option value="">선택하세요.</option>
                                    <option value="2019-08-29">8월 29일 (목)</option>
                                    <option value="2019-08-30">8월 30일 (금)</option>
                                    <option value="2019-08-31">8월 31일 (토)</option>
                                    <option value="2019-09-01">9월 01일 (일)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>회&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;차</th>
                            <td>
                                <select name="in_time2" id="in_time2" >
                                    <option value="">신청날짜를 선택하세요.</option>
                                </select>
                            </td>
                        </tr
                        <tr>
                            <td class="agree" style="text-align:right" colspan="2">
                                <input type="checkbox" name="agrees2" id="agree2" ><label for="agree2">개인정보 처리방침 동의</label>
                            </td>
                        </tr>
						<tr>
							<td colspan="2" class="last2">
								<div style="text-align:left">
									목적 <br>
									- 이용자 식별 및 본인여부 확인 <br>
									- 고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별<br><br>

									보유 항목<br>
									- 이름, 전화번호<br><br>
								
									보유기간<br>
									- 행사 종료 전까지
								</div>
							</td>
						</tr>
                        <tr>
                            <td colspan="2" class="last">
                                <img src="<?php echo G5_IMG_URL;?>/nanta_infos.png" alt="">
                            </td>
                        </tr>
                    </table>
                    <div class="cancel_info">
                        <p>신청 후 1일 이내 미입금 시 자동 취소됩니다.</p>
                    </div>
                    <div class="price_info">
                        <img src="<?php echo G5_IMG_URL;?>/nanta_price_info.png" alt="">
                    </div>
                    <table>
                        <tr>
                            <td colspan="2" >
                                <input type="submit" value="사전예약 신청하기">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </section>

    <section class="main_page4" id="menu3">
        <div class="width-fixed">
            <div class="main_title">
                <h2><span>2019괴산고추축제</span> 갤러리</h2>
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
                <h2><span>축제일정 &</span> 프로그램 안내</h2>
            </div>
            <div class="main_tab">
                <ul>
                    <li id="tab1" class="active">주요행사</li>
                    <li id="tab2">전시행사</li>
                    <li id="tab3">체험행사</li>
                </ul>
            </div>
            <div class="tab_content">
                <div class="tab1 active">
					<table>
						<thead>
							<tr>
								<th>행사일자</th>
								<th>행사시간</th>
								<th>프로그램</th>
								<th>장소</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>08.29 (목)</td>
								<td>10:00 ~ 11:00</td>
								<td>군민안녕 및 풍년기원제</td>
								<td>주무대</td>
							</tr>
							<tr>
								<td>08.29 (목)</td>
								<td>18:30 ~ 20:30</td>
								<td>개막식 및 축하음악회</td>
								<td>주무대</td>
							</tr>
							<tr>
								<td>08.29 (목)</td>
								<td>21:00 ~ 22:00</td>
								<td>지역문화공연</td>
								<td>주무대</td>
							</tr>
							<tr>
								<td>08.30 (금)</td>
								<td>19:00 ~ 20:30</td>
								<td>임꺽정선발대회</td>
								<td>주무대</td>
							</tr>
							<tr>
								<td>08.31 (토)</td>
								<td>13:50 ~ 17:00</td>
								<td>전국고추요리경연대회</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>08.31 (토)</td>
								<td>19:00 ~ 21:00</td>
								<td>고추거리퍼레이드</td>
								<td>주무대</td>
							</tr>	
							<tr>
								<td>09.01 (일)</td>
								<td>14:00 ~ 17:00</td>
								<td>읍면화합민속경기</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>09.01 (일)</td>
								<td>18:00 ~ 21:00</td>
								<td>괴강가요제 및 폐막식</td>
								<td>주무대</td>
							</tr>
						</tbody>
					</table>
				</div>
                <div class="tab2">
					<table>
						<thead>
							<tr>
								<th>행사일자</th>
								<th>행사시간</th>
								<th>프로그램</th>
								<th>장소</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>상시</td>
								<td>09:00 ~ 18:00</td>
								<td>세계고추전시</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>09:00 ~ 18:00</td>
								<td>고추요리전시</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>09:00 ~ 18:00</td>
								<td>아름다운괴산사진전시</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>09:00 ~ 18:00</td>
								<td>노인전통공예품전시</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>09:00 ~ 18:00</td>
								<td>규방공예품전시</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>09:00 ~ 18:00</td>
								<td>괴산문화단체전시</td>
								<td>기타장소</td>
							</tr>
						</tbody>
					</table>
				</div>
                <div class="tab3">
					<table>
						<thead>
							<tr>
								<th>행사일자</th>
								<th>행사시간</th>
								<th>프로그램</th>
								<th>장소</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>상시</td>
								<td>12:00 ~ 13:00</td>
								<td>고추속체험</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>상시</td>
								<td>고추음식체험</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>하루 2회</td>
								<td>속풀이고추난타</td>
								<td>잔디광장</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>총 5회</td>
								<td>황금고추를찾아라</td>
								<td>잔디광장</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>13:00 ~ 15:00</td>
								<td>고추달린물고기를잡아라</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>16:00 ~ 17:00</td>
								<td>민속놀이올림피아드</td>
								<td>주무대</td>
							</tr>	
							<tr>
								<td>상시</td>
								<td>상시</td>
								<td>어린이물놀이장</td>
								<td>기타장소</td>
							</tr>
							<tr>
								<td>상시</td>
								<td>상시</td>
								<td>어린이모래놀이터</td>
								<td>주무대</td>
							</tr>
						</tbody>
					</table>
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
            data:{page:page}
        }).done(function(data){
            $(".cheering_list").html(data);
        });
    }

    function fnGetTime(date){
        var item = '';
        switch(date){
            case "2019-08-29":
                item = "<option value='1회차/12:30~13:30'>1회차(12:30 ~ 13:30)</option>";
                break;
            case "2019-08-30":
                item = "<option value='2회차/12:30~13:30'>2회차(12:30 ~ 13:30)</option>";
                break;
            case "2019-08-31":
                item = "<option value='3회차/14:00~14:50'>3회차(12:30 ~ 13:30)</option>";
                item += "<option value='4회차/17:00~17:50'>4회차(17:00 ~ 18:00)</option>";
                break;
            case "2019-09-01":
                item = "<option value='5회차/12:30~13:30'>5회차(12:30 ~ 13:30)</option>";
                break;
            case "":
                item = "<option value=''>신청날짜를 선택하세요.</option>";
                break;
        }
        $("#in_time").html(item);
    }

    function fnGetTime2(date){
        var item = '';
        switch(date){
            case "2019-08-29":
                item = "<option value='1회차/11:00~11:30'>1회차(11:00 ~ 11:30)</option>";
                item += "<option value='2회차/15:00~15:30'>2회차(15:00 ~ 15:30)</option>";
                break;
            case "2019-08-30":
                item = "<option value='3회차/11:00~11:30'>3회차(11:00 ~ 11:30)</option>";
                item += "<option value='4회차/15:00~15:30'>4회차(15:00 ~ 15:30)</option>";
                break;
            case "2019-08-31":
                item = "<option value='5회차/11:00~11:30'>5회차(11:00 ~ 11:30)</option>";
                item += "<option value='6회차/15:00~15:30'>6회차(15:00 ~ 15:30)</option>";
                item += "<option value='7회차/21:00~21:30'>7회차(21:00 ~ 21:30)</option>";
                break;
            case "2019-09-01":
                item = "<option value='8회차/11:00~11:30'>8회차(11:00 ~ 11:30)</option>";
                item += "<option value='9회차/15:00~15:30'>9회차(15:00 ~ 15:30)</option>";
                break;
            case "":
                item = "<option value=''>신청날짜를 선택하세요.</option>";
                break;
        }
        $("#in_time2").html(item);
    }
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>