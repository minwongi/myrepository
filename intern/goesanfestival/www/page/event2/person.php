<?php
include_once ("../../common.php");
$sql="insert into turning_table (`name`, `phone`) values ('{$name}','{$phone}') ";
$sql2 = "select * from turning_table";
$row = sql_fetch($sql2);

$score = $row["score"];
$name = $row["name"];
$phone = $row["phone"];

if(sql_query($sql)){
    alert("돌려돌려 돌림판~!",G5_URL."/page/event2/game.php?name=".urlencode($name)."&phone=".$phone); //겟방식으로 처리, 쿼리가 아니라 이동주소를 설정해준거고 alert함수에서 처리하여 스크립트 주소로 이동시켜주는것.
}else if($score == "FAILED"){ //실패한 사람은 다시 참여할 수 있도록하게 한다.
    echo $name; 
    echo $score;
    echo $phone; 
    alert("꽝이 나오면 한번 더 할 수 있습니다.",G5_URL."/page/event2/game.php?name=".urlencode($name)."&phone=".$phone);
}else{
    echo $name; 
    echo $score;
    echo $phone; 
    alert("이미 참여하셨습니다.");
}
?>