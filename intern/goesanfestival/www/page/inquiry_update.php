<?php
include_once ("../common.php");

if($inquiry_name==""){
    alert("성함을 입력해주세요.");
}

if($hp==""){
    alert("전화번호를 입력해주세요.");
}

$sms = 0;
if($agrees2=="on"){
    $sms = 1;
}

$userhp = hyphen_hp_number($hp);

$sql = "select * from `inquirys` where user_name = '{$inquiry_name}' and user_hp = '{$userhp}'";
$chk = sql_fetch($sql);
if($chk!=null){
    alert("이미 신청하셨습니다.");
}

/*$sql = "select count(*)as cnt from `inquirys` where inquiry_status = 1";
$chkcount = sql_fetch($sql);
if($chkcount["cnt"]>=100){
    alert("사전예약 인원이 마감되었습니다.");
}*/

$sql = "insert into `inquirys` set user_name = '{$inquiry_name}', user_hp = '{$userhp}', user_date = now(), user_time = now(), inquiry_status = 0, inquiry_date = '{$in_date}',inquiry_time = '{$in_time}'";

if(sql_query($sql)){
    alert("신청이 완료 되었습니다.\\r\\신청후 1일이내에 미입금시 자동 취소됩니다.");
}else{
    alert("신청 오류입니다. 다시 시도해 주세요.");
}
?>