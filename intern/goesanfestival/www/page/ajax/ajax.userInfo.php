<?php
include_once ("../../common.php");
?>
<div class="register">
    <h2>개인정보입력</h2>
    <div>
        <form action="<?php echo G5_URL;?>/page/user_info_update.php" name="userform" id="userform" method="post" onsubmit="return fnSubmit();">
            <div>
                <label for="">이름</label>
                <input type="text" name="userName" id="userName" required placeholder="이름">
                <label for="">연락처</label>
                <div class="user_hp_wrap">
                    <input type="text" name="userHp[]" id="userHp1" required placeholder="전화번호 앞자리" maxlength="3"><input
                            type="text" value="-" readonly class="input_hypen"><input type="text" name="userHp[]" id="userHp2" required placeholder="전화번호 중간자리" maxlength="4"><input
                            type="text" value="-" readonly class="input_hypen"><input type="text" name="userHp[]" id="userHp3" required placeholder="전화번호 뒷자리" maxlength="4">
                </div>
                <label for="">이벤트당첨 수령지</label>
                <input type="text" name="userZipcode" id="userZipcode" readonly placeholder="우편번호" required onclick="win_zip('userform', 'userZipcode', 'userAddr1', 'userAddr2', 'mb_addr3', 'mb_addr_jibeon')"> <input type="button" value="주소검색" id="find_addr" onclick="win_zip('userform', 'userZipcode', 'userAddr1', 'userAddr2', 'mb_addr3', 'mb_addr_jibeon')">
                <input type="text" name="userAddr1" id="userAddr1" readonly placeholder="기본주소" onclick="win_zip('userform', 'userZipcode', 'userAddr1', 'userAddr2', 'mb_addr3', 'mb_addr_jibeon')" required>
                <input type="text" name="userAddr2" id="userAddr2" placeholder="상세주소" required>
                <input type="hidden" name="mb_addr3" id="mb_addr3" >
                <input type="hidden" name="mb_addr_jibeon" id="mb_addr_jibeon" >
            </div>
            <div class="agree">
                <h3>개인정보 수집 및 이용약관</h3>
                <div class="agree_chk">
                    <input type="checkbox" name="agree" id="agree" value="1" >
                    <label for="agree">개인정보 수집 및 이용에 동의합니다.</label>
                </div>
                <div class="agree_box">
                    [개인정보 수집 및 이용 동의 ]
                    <ul>
                        <li>1. 개인정보를 제공받는 자. : 이벤트 배송 택배사</li>
                        <li>2. 개인정보를 제공받는 자의 이용 목적: 이벤트 진행 및 경품 배송</li>
                        <li>3. 제공하는 개인정보의 항목: 이름, 휴대폰번호, 주소</li>
                        <li>4. 개인정보를 제공받는 자의 보유·이용 기간:  이벤트 종료 후 즉시 파기</li>
                        <li>5. 개인정보의 제3자 제공에 대한 동의를 거부할 수 있으며, 이 경우 이벤트 참여가 제한됩니다.</li>
                        <li>6. 개인정보는 보안처리되어 저장됩니다.</li>
                    </ul>
                </div>
            </div>
            <div class="btn_sub">
                <input type="submit" value="등록하기" >
                <input type="button" value="닫기" onclick="fnHideModal();">
            </div>
        </form>
    </div>
</div>
<script>
function fnSubmit(){
    if($("#agree").prop("checked")!=true) {
        alert("개인정보 수집 및 이용에 동의 하셔야 합니다.");
        return false;
    }
    return true;
}
</script>