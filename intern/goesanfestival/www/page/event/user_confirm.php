<?php
include_once ("../../common.php");
?>
<html>
    <head>
		<meta name="viewport" content="width=1.0, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>속풀이 고추난타</title>
		<link rel="stylesheet" href="index.css">
    </head>
	<style>
		body{
			background-image: url('../../img/background.png');
			background-repeat: no-repeat;
			background-size: 100% 100%;
		}
		button{
			-webkit-tap-highlight-color :transparent;
			padding: 0;
			border: none;
			background: none;
			margin: 0 auto;

		}
		button:active {
			-webkit-tap-highlight-color :transparent;
			padding: 0;
			border: none;
			background: none;
		}
		*:focus { outline:none; }
	</style>
    <body>
	<script>
        var clearChk=true;

        function clearMessage(frm){

            if(clearChk){
                frm.name.value="";
                clearChk=false;
            }

        }

        function check_key() { // 한글을 쳤을때 이 함수 자체를 실행을 안함
            var char_ASCII = event.keyCode;
            if ((char_ASCII >= 65 && char_ASCII <= 90) || (char_ASCII >= 97 && char_ASCII <= 122)) {
            return 1;
            }

            else if ((char_ASCII >= 12593) && (char_ASCII <= 12687)) {
                return 2;
            }
            else if ((char_ASCII >= 48) && (char_ASCII <= 57)) {
                return 3;
            }
            else
                return 0;
        }

		function HangulAndEnglish() {
            if(check_key() !=1 && check_key() !=2) {
                event.returnValue = false;
                alert("한글과 영문자만 입력하세요!");
                return;
            }
        }
        function numberKey() {
            if(check_key() !=3) {
                event.returnValue = false;
                alert("숫자만 입력할 수 있습니다.");
                return;
            }
        }
        function fn_press(event, type){
            if(type =="numbers"){
                if(event.keyCode<48 || event.keyCode>57)
                    return false;
			}
		}
		function fn_press_han(obj){
            if(event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46)
                return;
            obj.value = obj.value.replace(/[ㄱ-ㅎㅏ-ㅣ가-힣]/g, '');

		}
	</script>
        	<form action="<?php echo G5_URL;?>/page/event/person.php" method="post" id="nap">
				<section class="sec_01">
					<div class="fixed">
						<div class="box">
							<h2>개인정보입력</h2>
							<input type="text" name="name"value="이름"onkeypress="HangulAndEnglish()" onFocus="clearMessage(this.form);">
							<input type="text" name="phone"value="전화번호"onkeypress="return fn_press(event, 'numbers');"onkeydown="fn_press_han(this);" minlength="10" maxlength="11">
							<p>게임은 중복참여가 가능합니다.<br>하지만 최고점수가 아닌<br> 참여한 <span>게임의 마지막 점수</span>가 랭킹에 등록됩니다.</p>
							<button type="submit" ><img src="../../img/okbt.png"></button>
						</div>
					</div>
				</section>
        	</form>
	</body>
<html>