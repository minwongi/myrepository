<?php
include_once ("../common.php");

if($inquiry_name2==""){
    alert("성함을 입력해주세요.");
}

if($hp2==""){
    alert("전화번호를 입력해주세요.");
}

$userhp = hyphen_hp_number($hp2);

$sql = "select * from `inquirys2` where user_name = '{$inquiry_name2}' and user_hp = '{$userhp}'";
$chk = sql_fetch($sql);
if($chk!=null){
    alert("이미 신청하셨습니다.");
}

/*$sql = "select count(*)as cnt from `inquirys2` where inquiry_status = 1 and inquiry_date = '{$in_date2}' and inquiry_time = '{$in_time2}' ";
$chkcount = sql_fetch($sql);
if($chkcount["cnt"]>=80){
    alert("해당일에 사전예약 인원이 마감되었습니다.");
}*/

$sql = "insert into `inquirys2` set user_name = '{$inquiry_name2}', user_hp = '{$userhp}', user_date = now(), user_time = now(), inquiry_status = 0,inquiry_date = '{$in_date2}',inquiry_time = '{$in_time2}'";

if(sql_query($sql)){
    alert("신청이 완료 되었습니다.\\r\\신청후 1일이내에 미입금시 자동 취소됩니다.");
}else{
    alert("신청 오류입니다. 다시 시도해 주세요.");
}
?>