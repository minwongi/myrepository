<?php
include_once ("../../common.php");
include_once (G5_PATH."/head.sub.php");
?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
	<title> prototype about roulette </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="./js/jQueryRotateCompressed.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<style>
         #wraps {
            background-image:url('img/back.png');
            background-repeat:no-repeat;
            background-position:center center;
            background-size:cover;
            padding-bottom:120px;
        }

        #second { 
            position: relative;
            width:700px;
            height:700px;
            margin: 0 auto;
            padding-top: 42px;
        }

        #title {
			position: relative;
			z-index: 10;
            top:20px;
			width:650px;
            height:30%;
			margin:0 auto;
        }

		#roulette {
            /* 돌림판 위치 */
			position: relative;
			z-index: 10;
			width:700px;
			margin:0 auto;
        }
        
        #n_id {
			/*계기판 바늘 위치*/
			position: absolute;
			left: 50%;
			top: 20px;
            width:5vh;
            height:6vh;
			z-index: 20;
            transform: translateX(-50%);
		}

        .result_pop{
            width:0;
            height:0;
            opacity:0;
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            transition:all 0.2s ease-in-out;
        }
        .result_pop.active{
            width:30%;
            height:30%;
            opacity:1;
            z-index:99999
        }
        #wraps.on #wrap img {
            opacity:0.5;
            /* 0=> 완전히 투명인단계 */
        }

        #icon span{
            vertical-align:middle;
        }
        
        /*@media all and (max-width: 480px) {
            .result_pop.active{
                width:calc(100% - 20px);
            }
            #second { 
                width:calc(100vw - 20vw);
                height:calc(100vw - 20vw);
            }
            
        }*/
	</style>

</head>
<body>
<div id="wraps" class="parent_wrap">
        <div style="text-align : center;" id="wrap" class="child_wrap">
            <img src="img/title.png" id="title">
            <div id="second">
                <img src="img/roulette.png" style="transform-origin:50% 49%" id="roulette"> 
                <img src="img/needle.png" id="n_id">
                <img src="img/img_kkuck.png" id="im1" style="position: absolute; top: 50px; left: 10px; transform: rotate(-30deg);" width="150px" height="150px">
                <img src="img/img_eunchong1.png" id="im2" style="position: absolute; left: 540px; bottom: 500px; transform: rotate(30deg)" width="150px" height="150px">
                <img src="img/img_purple.png" id="im3" style="position: absolute; left: -150px; bottom: -70px;">
                <img src="img/img_red.png" id="im4" style="position: absolute; bottom: -70px; right: -140px;">
                <img src="img/roulette_effect.png" id="roullet_effect" style="position: absolute; bottom: -20px; left: -20px;" width="750" height="400">
                <img src="img/roulette_start.png" id="roulette_start" style="cursor: pointer; position: absolute; top:56.22%;left:51%; z-index:11;transform:translate(-50%,-50%);" width="200" height="200">

                <div id="icon">
                    <img src="img/icon_1.png" style="padding-left:55px; padding-right:55px;">
                    <span style="font-size:32px; color:white;">>></span>
                    <img src="img/icon_2.png" style="padding-left:55px; padding-right:55px;">
                    <span style="font-size:32px; color:white;">>></span>
                    <img src="img/icon_3.png" style="padding-left:55px; padding-right:55px;">
                </div>
                <span style="font-size:16px; color:white;">
                    <span style="padding-left:30px; padding-right:50px;">연락처 입력후</span>
                    <span style="padding-left:50px; padding-right:50px;">룰렛 돌리기</span>
                    <span style="padding-left:50px; ">당첨 여부 즉시 확인</span>
                </span>
                <p>
                <span>[TIP]</span>
                <span>연락처 당 1회씩만 참여할 수 있어요.</span>
                <span>꽝</span>
                <span>당첨자에 한해서만 매일 1회씩 추가 기회 제공!</span>
                <span>경품은 축제가 끝난 뒤</span>
                <span>9월 15일</span>
                <span>에 일괄 배송 됩니다.</span>
                </p>
            </div>
        </div>
        
        <br>
    </div>
        
        <br>
    </div>
    <div class="result_pop">
        <div>
        </div>
    </div>
	<script>
        var flag=10;
        function endAnimate() {
                console.log("flag");
                console.log(flag);
                if(flag==5){
                    $(".result_pop div").html('<img src="img/result_coffee.png" style="max-width:100%; height:auto; cursor:pointer;">');
                    $(".result_pop").addClass('active');
                    $("#wraps").addClass("on");
                }else if(flag==4){
                    $(".result_pop div").html('<img src="img/result_icecream.png" style="max-width:100%; height:auto; cursor:pointer;">');
                    $(".result_pop").addClass('active');
                    $("#wraps").addClass("on");
                }else if(flag==2){
                    $(".result_pop div").html('<img src="img/result_corn.png" style="max-width:100%; height:auto; cursor:pointer;">');
                    $(".result_pop").addClass('active');
                    $("#wraps").addClass("on");
                }else if(flag==7){
                    $(".result_pop div").html('<img src="img/result_chili.png" style="max-width:100%; height:auto; cursor:pointer;">');
                    $(".result_pop").addClass('active');
                    $("#wraps").addClass("on");
                }else if(flag==1){
                    $(".result_pop div").html('<img src="img/result_grain.png" style="max-width:100%; height:auto; cursor:pointer;">');
                    $(".result_pop").addClass('active');
                    $("#wraps").addClass("on");
                }else if(flag==0){
                    $(".result_pop div").html('<img src="img/result_gold.png" style="max-width:100%; height:auto; cursor:pointer;">');
                    $(".result_pop").addClass('active');
                    $("#wraps").addClass("on");
                }else if(flag==3){
                    $(".result_pop div").html('<img src="img/result_failed.png" style="max-width:100%; height:auto; cursor:pointer;">');
                    $(".result_pop").addClass('active');
                    $("#wraps").addClass("on");
                }
                $(".result_pop div img").click(function(){
                    $(".result_pop").removeClass('active');
                    $("#wraps").removeClass("on");
                });
			}
            function turn() {
				$.ajax({
					url:g5_url+'/page/event2/rank_insert.php',
				    type:"post",
				    data:{name:"<?php echo $name;?>",phone:"<?php echo $phone;?>"},
				    dataType:"json"
			   }).done(function(data){
			       console.log(data);
                   console.log("들어옴?");
			       if(data.msg=="COFFEE") {
                        flag=5;
                        rotation(5);
                    } else if(data.msg=="ICECREAM"){
                        flag=4;
                        rotation(4);
                    } else if(data.msg=="CORN"){
                        flag=2;
                        rotation(2);
                    } else if(data.msg=="CHILIPOWDER"){
                        flag=7;
                        rotation(7);
                    } else if(data.msg=="GRAIN"){
                        flag=1;
                        rotation(1);
                    } else if(data.msg=="GOLD"){
                        flag=0;
                        rotation(0);
                    } else if(data.msg=="FAILED"){
                        flag=3;
                        rotation(3);
                    }
			   });
			}

			$('#roulette_start').on('click', function () {
                if(flag!=10)
                    alert("더이상 참여하실 수 없습니다.")
                else 
                    turn();
            });

			function rotation(data) {
                var angle=0;
                if(data==1){
                    angle=45;
                }else if(data==2){
                    angle=45*2;
                }else if(data==3){
                    angle=45*3;
                }else if(data==4){
                    angle=45*4;
                }else if(data==5){
                    angle=45*5;
                }else if(data==6){
                    angle=45*6;
                }else if(data==7){
                    angle=45*7;
                }else{
                    angle=45*8;
                }
                console.log(angle);
				$("#roulette").rotate({
                    animateTo: 360*10 + angle,
					center: ["50%", "49%"],
					easing: $.easing.easeInOutElastic,
					callback: function () {
						endAnimate();
					},
					duration: 10000 // *100
				});
			}
            

            $('#close').on('click', function () {
                location.replace('result.html');
            });

			function randomize($min, $max) {
				return Math.floor(Math.random() * ($max - $min + 1)) + $min;
			}
			
		// function noEvent() { // 새로 고침 방지
        //     if (event.keyCode == 116) {
        //         while(1){
        //         alert("새로고침을 할 수 없습니다.");
        //         event.keyCode = 2;
        //         return false;
        //         }
        //     } else if (event.ctrlKey
        //             && (event.keyCode == 78 || event.keyCode == 82)) {
        //         return false;
        //     }
        // }
    	// document.onkeydown = noEvent;
	</script>
</body>
</html>