<?php
include_once ("../common.php");

$userHp = implode("-",$userHp);
$userHpBase = base64_encode($userHp);

$sql = "select * from `user_info` where userName = '{$userName}' ";
$res = sql_query($sql);
while($row = sql_fetch_array($res)){
    $userHpChk = base64_decode($row["userHp"]);

    if($userHpChk == $userHp){
        //세션 저장 처리
        $_SESSION["userName"] = $row["userName"];
        $_SESSION["user_id"] = $row["user_id"];
    }
}

if($_SESSION["userName"]){
    goto_url(G5_URL."/indexs.php");
}else{
    $sql = "insert into `user_info` set userName = '{$userName}', userHp = '{$userHpBase}', userZipcode = '{$userZipcode}', userAddr1 = '{$userAddr1}', userAddr2 = '{$userAddr2}' ";
    if(sql_query($sql)){
        $_SESSION["userName"] = $row["userName"];
        $_SESSION["user_id"] = $row["user_id"];
        alert("정보가 등록되었습니다.",G5_URL."/indexs.php");
    }else{
        alert("입력한 데이터가 등록되지 않았습니다. \\r\\n다시 시도해 주세요.");
    }
}

?>