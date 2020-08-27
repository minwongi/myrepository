<?php
include_once ("../../common.php");

$sql = "select * from `game_user_info` where user_id = '{$user_id}' and game_type = 0";
$chkRnak = sql_fetch($sql);
if($chkRnak!=null) {
    if($chkRnak["score"] < $score) {
        $sql = "update `game_user_info` set score = '{$score}', insertdate = now() where `user_id` = '{$user_id}' and `game_type` = '{$game}'";
    }/*else{
        $sql = "insert into `game_user_info` set score = '{$score}', `user_id` = '{$user_id}', `game_type` = '{$game}' , insertdate = now()";
    }*/
}else{
    $sql = "insert into `game_user_info` set score = '{$score}', `user_id` = '{$user_id}', `game_type` = '{$game}' , insertdate = now()";
}
$result["sql"] = $sql;

if(sql_query($sql)){
    $result["msg"] = 1;
}else{
    $result['msg'] = 2;
}


echo json_encode($result);

?>