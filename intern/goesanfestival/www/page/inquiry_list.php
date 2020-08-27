<?php
include_once ("../common.php");

if(!$is_admin){
    alert("관리자만 접근 가능합니다.");
}

$total=sql_fetch("select count(*) as cnt from `inquirys`");
if(!$page)
    $page=1;
$total=$total['cnt'];
$rows=10;
$start=($page-1)*$rows;
$total_page=ceil($total/$rows);
$sql="select * from `inquirys` order by `id` desc limit {$start},{$rows}";
$query=sql_query($sql);
$j=0;
while($data=sql_fetch_array($query)){
    $list[$j]=$data;
    $list[$j]['num']=$total-($start)-$j;
    $j++;
}

include_once (G5_PATH.'/head.sub.php');
?>
<style>
    html,body{height:auto}
    .inquiry_width{width:800px;margin:0 auto}
    .inquiry_width h2{background-color:#fff;margin-top:20px;text-align: center;font-size:30px;padding:20px;-webkit-border-radius:6px 6px 0 0;-moz-border-radius:6px 6px 0 0;border-radius:6px 6px 0 0;border:1px solid #000;}
    .inquiry_list{width:100%;padding:20px;background-color:#fff;-webkit-border-radius:0 0 6px 6px;-moz-border-radius:0 0 6px 6px;border-radius:0 0 6px 6px;border:1px solid #000;border-top:none;}
    .inquiry_list table {width:100%;border-spacing: 0;}
    .inquiry_list table th{background-color:#444;color:#eee;padding:10px;font-size:16px;}
    .inquiry_list table td{border-bottom:1px solid #444;color:#000;font-size:16px;padding:10px;text-align: center;background-color:#fff;}
    .inquiry_list table td input[type=button]{padding:5px;background-color:#000;color:#fff;font-size:15px;border:none;}
    .num_list01{margin:30px auto 0 auto;text-align: center}
    .num_list01 li{width:30px;height:30px;display:inline-block;border:1px solid #eee;font-size:16px;line-height:28px;cursor: pointer;}
    .num_list01 li.active, .num_list01 li:hover{background-color:#000;color:#fff;border:1px solid #000;}
    .num_list01 li.active a, .num_list01 li:hover a{color:#fff;}
    .tab li{float:left;width:50%;text-align: center;padding:10px 0;color:#000;font-size:16px;border-bottom:1px solid #000;margin-bottom:20px;cursor: pointer;}
    .tab li:hover ,.tab li.active{background-color:#000;color:#fff;}
    .inquiry_width h2 input{font-size:14px;background-color:#000;color:#fff;border:none;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;padding:10px;}
    @media all and (max-width: 800px){
        .inquiry_width{width:calc(100% - 4vw);margin:0 2vw}
        .inquiry_width h2{font-size:6vw;}
        .inquiry_list table th{font-size:3vw;padding:1vw;}
        .inquiry_list table td{font-size:3vw;padding:1vw;}
        .inquiry_list table td input[type=button]{font-size:2.5vw;padding:1vw}
        .num_list01 li{font-size:3vw;padding:1vw;line-height:5vw;}
    }
</style>
<div class="inquiry_width">
    <h2>황금고추를 찾아라 사전접수 목록 
        <input type="button" value="전체저장" onclick="location.href=g5_url+'/page/inquiry_list_excel.php?type=all'">
        <input type="button" value="승인저장" onclick="location.href=g5_url+'/page/inquiry_list_excel.php?type=confirm'">
    </h2>
    <div class="tab">
        <ul>
            <li class="active">황금고추를 찾아라</li>
            <li onclick="location.href=g5_url+'/page/inquiry_list2.php'">속풀이 고추난타</li>
        </ul>
    </div>    <div class="inquiry_list">
        <table>
            <tr>
                <!--<th>번호</th>-->
                <th>이름</th>
                <th>전화번호</th>
                <th>접수일</th>
                <th>참여일/회차</th>
                <th>상태</th>
                <th>관리</th>
            </tr>
            <?php for($i=0;$i<count($list);$i++){?>
                <tr>
                    <!--<td><?php /*echo $list[$i]["num"];*/?></td>-->
                    <td><?php echo $list[$i]["user_name"];?></td>
                    <td><?php echo $list[$i]["user_hp"];?></td>
                    <td><?php echo ($list[$i]["user_date"]==date("Y-m-d"))?$list[$i]["user_time"]:$list[$i]["user_date"];?></td>
                    <td><?php echo $list[$i]["inquiry_date"]."<br>".$list[$i]["inquiry_time"];?></td>
                    <td><?php echo ($list[$i]["inquiry_status"]==0)?"접수대기":"접수확인";?></td>
                    <td>
                        <?php if($list[$i]["inquiry_status"]==0){?>
                            <input type="button" value="접수확인" onclick="fninquiryUpdate(0,'<?php echo $list[$i]["id"];?>');">
                            <input type="button" value="접수취소" onclick="fninquiryUpdate(1,'<?php echo $list[$i]["id"];?>');">
                        <?php }?>
                    </td>
                </tr>
            <?php }
            if(count($list)==0){?>
                <tr>
                    <td colspan="6" class="td_center">목록이 없습니다.</td>
                </tr>
            <?php }?>
        </table>
        <?php
        if($total_page>1){
            $start_page=1;
            $end_page=$total_page;
            if($total_page>5){
                if($total_page<($page+2)){
                    $start_page=$total_page-4;
                    $end_page=$total_page;
                }else if($page>3){
                    $start_page=$page-2;
                    $end_page=$page+2;
                }else{
                    $start_page=1;
                    $end_page=5;
                }
            }
            ?>
            <div class="num_list01">
                <ul>
                    <?php if($page!=1){?>
                        <li class="prev"><a href="<?php echo G5_URL."/page/inquiry_list.php?page=".($page-1); ?>">&lt;</a></li>
                    <?php } ?>
                    <?php for($i=$start_page;$i<=$end_page;$i++){ ?>
                        <li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/page/inquiry_list.php?page=".$i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <?php if($page<$total_page){?>
                        <li class="next"><a href="<?php echo G5_URL."/page/inquiry_list.php?page=".($page+1); ?>">&gt;</a></li>
                    <?php } ?>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script>
    function fninquiryUpdate(type,id){
        var msg = "해당 신청을 접수상태로 변경하시겠습니까?";
        if(type==1){
            msg = "해당 접수상태를 변경 하시겠습니까?\r\n접수 취소시 해당 기록은 삭제됩니다.";
        }
        if(confirm(msg)){
            location.href=g5_url+'/page/inquiry_edit.php?type='+type+"&id="+id;
        }
        
    }
</script>
<?php
include_once (G5_PATH.'/tail.sub.php');
?>
