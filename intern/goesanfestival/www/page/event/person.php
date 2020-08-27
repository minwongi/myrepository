<?php
include_once ("../../common.php");
    $sql="insert into pocket_button (`name`, `phone`) values ('{$name}','{$phone}') ";
    if(sql_query($sql)){
        alert("게임을 시작합니다!",G5_URL."/page/event/game.php?name=".urlencode($name)."&phone=".$phone);
    }else{
        alert("이미 참가하셨습니다. 점수가 초기화되고 새로측정됩니다.",G5_URL."/page/event/game.php?name=".urlencode($name)."&phone=".$phone);
    }
?>

