<?php
include_once ("../../common.php");

$sql = "select * from `game_user_info` where user_id = '{$user_id}' and game_type = '{$game_type}'";
$res = sql_query($sql);
while($row = sql_fetch_array($res)){
    if($row["score"]!="FAILED"){
        $result["msg"]="2";
    }
}

if($result["msg"]){
    echo json_encode($result);
    return false;
}


$today = date("Y-m-d");
$sql = "select * from `game_user_info` where user_id = '{$user_id}' and game_type = '{$game_type}' and insertdate like '{$today}%'";
$res = sql_query($sql);
$cnt = 0;
$failCnt = 0;
while($row = sql_fetch_array($res)){
    $cnt++;
}

/*if($cnt==2){
    $result["msg"] = "1";
    echo json_encode($result);
    return false;
}*/

if($cnt==1){
    $result["msg"] = "1";
    echo json_encode($result);
    return false;
}


$sql = "select * from score_table";
$row = sql_fetch($sql);

$coffee = $row["coffee"];
$icecream = $row["icecream"];
$corn = $row["corn"];
$chilipowder = $row["chilipowder"];
$grain = $row["grain"];
$gold = $row["gold"];
$failed = $row["failed"];

$items = array("coffee","icecream","corn","chilipowder","grain","gold","failed");

$itempercent = array(20,20,9,10,10,1,30);

$n = Percent_draw($items,$itempercent);

if ($n == 0 && $coffee < 50){
    $new_coffee = $coffee + 1;
    $sql = "update score_table set coffee=$new_coffee";
    $result["msg"] = "COFFEE";
    //sql_query("update `turning_table` set score = 'COFFEE' where `name` = '{$name}' and `phone` = '{$phone}'");
} elseif ($n == 1 && $icecream < 50) {
    $new_icecream = $icecream + 1;
    $sql = "update score_table set icecream=$new_icecream";
    $result["msg"] = "ICECREAM";
    //sql_query("update `turning_table` set score = 'ICECREAM' where `name` = '{$name}' and `phone` = '{$phone}'");
} elseif ($n == 2 && $corn < 10) {
    $new_corn = $corn + 1;
    $sql = "update score_table set corn=$new_corn";
    $result["msg"] = "CORN";
    //sql_query("update `turning_table` set score = 'CORN' where `name` = '{$name}' and `phone` = '{$phone}'");
} elseif ($n == 3 && $chilipowder < 10) {
    $new_chilipowder = $chilipowder + 1;
    $sql = "update score_table set chilipowder=$new_chilipowder";
    $result["msg"] = "CHILIPOWDER";
    //sql_query("update `turning_table` set score = 'CHILIPOWDER' where `name` = '{$name}' and `phone` = '{$phone}'");
} elseif ($n == 4 && $grain < 10) {
    $new_grain = $grain + 1;
    $sql = "update score_table set grain=$new_grain";
    $result["msg"] = "GRAIN";
    //sql_query("update `turning_table` set score = 'GRAIN' where `name` = '{$name}' and `phone` = '{$phone}'");
} elseif ($n == 5 && $gold < 1) {
    $new_gold = $gold + 1;
    $sql = "update score_table set gold=$new_gold";
    $result["msg"] = "GOLD";
    //sql_query("update `turning_table` set score = 'GOLD' where `name` = '{$name}' and `phone` = '{$phone}'");
} else {
    $new_failed = $failed + 1;
    $sql = "update score_table set failed=$new_failed";
    $result["msg"] = "FAILED";
    //sql_query("update `turning_table` set score = 'FAILED' where `name` = '{$name}' and `phone` = '{$phone}'");
}
//상품 갯수 업데이트
sql_query($sql);

$sql = "insert into `game_user_info` set user_id = '{$user_id}', score = '{$result['msg']}', insertdate = now(), game_type = '{$game_type}'";
sql_query($sql);

function Percent_draw($items_list,$percent_list) {
    $range_now = 0;
    $range_last = 0;
    $decimal = 4;
    if(count($percent_list) != count($items_list)) return false;
    $draw = mt_rand(1,pow(10,$decimal)*array_sum($percent_list));

    for($sequence=0; $sequence<count($percent_list); $sequence++) {
        $range_now += pow(10,$decimal)*$percent_list[$sequence];
        if($range_now >= $draw && $range_last < $draw) {
            return $sequence;
        }else{
            $range_last = $range_now;
        }
    }
}

echo json_encode($result);
?>