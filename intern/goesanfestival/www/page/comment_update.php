<?php
include_once ("../common.php");

$sql = "select * from `cheerup_comment` where user_password = '{$cheering_pw}'";
$chk = sql_fetch($sql);
if($chk!=null){
    alert("이미 등록된 정보입니다.");
}

$sql = "insert into `cheerup_comment` set user_name = '{$cheering_name}', user_password = '{$cheering_pw}', user_comment = '{$cheering_cmt}' , user_date = now(), user_time = now()";
if(sql_query($sql)){
    alert("응원한마디가 등록되었습니다. \\r\\n응원에 보답하는 고추축제가 되겠습니다.");
}else{
    alert("등록 오류이입니다. 다시 시도해 주세요.");
}

?>