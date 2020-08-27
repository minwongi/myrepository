<?php
include_once ("../../common.php");
include_once (G5_PATH."/head.sub.php");
?>
<html>
	<head>
		<meta name="viewport" content="width=1.0, initial-scale=0.5, maximum-scale=0.5, user-scalable=no">

		<meta charset="UTF-8">
	</head>
<style>
	body{
		background-image: url('../../img/background_phone.png');
		background-repeat: no-repeat;
		background-size: 100% 100%;
    }
	.custom {
		-webkit-tap-highlight-color :transparent;
		width:100%;
		display: inline-block;
		padding: 6px 8px;
		cursor: pointer;
		text-align: center;
		text-decoration: none;
		outline: none;
		color: #fff;
		background-color: #4CAF50;
		border: none;
		border-radius: 30px;
		box-shadow: 12px 12px #999;
	}

	.custom:active {
		background-color: #3e8e41;
		box-shadow: 0 0px #666;
		transform: translate(5px,5px);
	}

	.style1{
		font:italic bold;
		font-size: 3em;
		color: green;
		padding-top: 35%;
		padding-bottom: 10%;
	}
	.style2{
		font:noto "Gmarket Sans", "Nanum Gothic", Dotum, Sans-serif;
		font-size:5em;
		color: red;
		padding-top: 5%;
		padding-bottom: 5%;
	}

	div{
		text-align: center;
		font-size: small;
		font-weight: bold;
	}
	#pop{
		position:absolute;
		left:0px;
		top:0px;
		width:100%;
		height:100%;
		z-index:10;
		background-color:#000000;
		filter:alpha
		(opacity=80);
		vertical-align:middle;
		text-align:center;
		display:block;
	}
	#pop1{
		width: 100%;
	}
	#td1{
		height: 400px;
	}
	@media (min-width: 1024px){
		.custom {width: 50%;}
		.style1{padding-top: 8%;padding-bottom: 3%;}
		#pop1{width: 50%;}
		#td1{height: 200px}
		body{background-image: url('../../img/background.png')}
	}

</style>

	<!-- 레이어 내용 -->
	<!--<div id="pop">
		<center>
			<table id="table1" cellpadding="0" cellspacing="0">
				<tr>
					<td id="td1">
					</td>
				<tr>
					<td width="10%" valign="center" align="middle">
						<embed id="pop1" src="3.png" loop="-1" ShowControls="false"
							   >
					</td>
				</tr>
			</table>
		</center>
	</div>
-->
<div>
	<p class="style1">점수 : <a id="clicks">0</a> &emsp;&emsp;&emsp;&emsp; 남은시간 : <a id="time">33</a></p>
	<img id="image" class="custom" onclick="imgtoggle()" src="../../img/game_bg1.png" style="opacity: 1;" >
	<div class="rank_insert"></div>

	<script>

		function imgtoggle(){
		    if(clicks%2==1) {
				document.getElementById('image').src="game_bg1.png";
            }else{
				document.getElementById('image').src="game_bg2.png";
			}
		}

        function doNotReload(){
            if( (event.ctrlKey == true && (event.keyCode == 78 || event.keyCode == 82)) || (event.keyCode == 116) ) {
                event.keyCode = 0;
               	event.cancelBubble = true;
                event.returnValue = false;
            }
        }
        document.onkeydown = doNotReload;

		function start(){
			var button = document.getElementById("button");
			image.addEventListener("click", onClick, false);

		};

		var clicks = 0;
		var time = 33;

		function onClick() {
		   clicks++;
		   if(time>30)
		       clicks--;
		   document.getElementById("clicks").innerHTML = clicks;
	   }

	   function countdown() {
		   document.getElementById("time").innerHTML = time;
		   time--;

		   if(time==32){
               document.getElementById('pop1').src="2.png";
		   }else if(time==31){
               document.getElementById('pop1').src="1.png";
		   }else{
               document.getElementById('pop1').src="start.png";
		   }
		   if(time==29){
               $('#pop').hide();
		   }

		   if(time<-1){
			   clearInterval(tid);
				$('.custom').hide();
               	$('.style1').hide();
			   //ajax로 정보 보내서 디비 저장
			   $.ajax({
					url:g5_url+'/page/event/rank_insert.php',
				    type:"post",
				    data:{score:clicks,name:"<?php echo $name;?>",phone:"<?php echo $phone;?>"},
				    dataType:"json"
			   }).done(function(data){
			       console.log(data);

			       var item = '';
			       if(data.msg==1) {
						for(var i = 0 ; i < data.rank.length ; i++) {
                            item += (i + 1) + "위 " + "이름 : " + data.rank[i]['name'] + "&emsp; &emsp; &emsp;" + "휴대폰번호 : " + data.rank[i]['phone'] + "&emsp; &emsp; &emsp;" + "점수 : " + data.rank[i]['score'] + "<br><br>";
                        }

						$(".rank_insert").html("<p class=style2>속풀이 고추난타!!!<br>TOP20<p>"+item);
                   }else{
			           alert('결과를 저장하지 못하였습니다.');
				   }
			   });
               alert(clicks+"회 클릭하셨습니다.");

		   }


	   }

		//window.onload=function TimerStart(){tid=setInterval('countdown()',1000)}
		window.addEventListener("load", start, false);
	</script>
</div>
<?php
include_once (G5_PATH."/tail.sub.php");
?>