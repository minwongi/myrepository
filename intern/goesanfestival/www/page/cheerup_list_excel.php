<?php
include_once ("../common.php");

$sql="select * from `cheerup_comment` {$where} order by `user_date` ,`user_time`  ";
$query=sql_query($sql);
$j=0;
while($data=sql_fetch_array($query)){
    $list[$j]=$data;
    $j++;
}

$userAgent = $_SERVER["HTTP_USER_AGENT"];
if ( preg_match("/MSIE*/", $userAgent) ) {
    // 익스플로러
    $ie = "ie";
} elseif ( preg_match("/Trident*/", $userAgent) &&  preg_match("/rv:11.0*/", $userAgent) &&  preg_match("/Gecko*/", $userAgent)) {
    $ie = "ie 11";
}



if($ie){
    $filename = iconv("utf-8","euc-kr","응원한마디 등록 목록.xls");
}else{
    $filename = "응원한마디 등록 목록.xls";
}

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$filename );
header( "Content-Description: PHP4 Generated Data" );
?>
<style>
    table th{border:1pt solid #000;}
    table td{border:1pt solid #000;text-align: center;}
</style>
<table>
    <tr>
        <th colspan="5">응원한마디 등록 목록</th>
    </tr>
    <tr>
        <th>번호</th>
        <th>이름</th>
        <th>전화번호</th>
        <th>접수일</th>
        <th>내용</th>
    </tr>
    <?php for($i=0;$i<count($list);$i++){?>
        <tr>
            <td><?php echo $i+1;?></td>
            <td><?php echo $list[$i]["user_name"];?></td>
            <td><?php echo hyphen_hp_number($list[$i]["user_password"]);?></td>
            <td><?php echo ($list[$i]["user_date"]==date("Y-m-d"))?$list[$i]["user_time"]:$list[$i]["user_date"];?></td>
            <td><?php echo $list[$i]["user_comment"];?></td>
        </tr>
    <?php }?>
</table>


