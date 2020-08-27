<?php
include_once ("../common.php");

if($type==1) {
    $sql = "delete from `inquirys` where id = '{$id}'";

    if(sql_query($sql)){
        alert("취소되었습니다.");
    }else{
        alert("잘못된 정보입니다.");
    }
}else{
    $sql = "update `inquirys` set inquiry_status = 1 where id = '{$id}'";
    if(sql_query($sql)){
        alert("신청완료 처리되었습니다.");
    }else{
        alert("잘못된 요청입니다.");
    }
}

?>