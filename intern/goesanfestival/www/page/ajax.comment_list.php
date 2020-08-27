<?php
include_once ("../common.php");

$total=sql_fetch("select count(*) as cnt from `cheerup_comment`");
if(!$page)
    $page=1;
$total=$total['cnt'];
$rows=10;
$start=($page-1)*$rows;
$total_page=ceil($total/$rows);
$sql="select * from `cheerup_comment` order by `id` desc limit {$start},{$rows}";
$query=sql_query($sql);
$j=0;
while($data=sql_fetch_array($query)){
    $list[$j]=$data;
    $list[$j]['num']=$total-($start)-$j;
    $j++;
}

?>
<h3>응원 한마디</h3>
<table>
    <colgroup>
        <col width="15%">
        <col width="*">
        <col width="15%">
    </colgroup>
    <?php for($i=0;$i<count($list);$i++){?>
        <tr>
            <td><?php echo iconv_substr($list[$i]["user_name"],0,1,'UTF-8')."**";?></td>
            <td title="<?php echo $list[$i]["user_comment"];?>"><?php echo $list[$i]["user_comment"];?></td>
            <td class="td_center"><?php echo ($list[$i]["user_date"]==date("Y-m-d"))?$list[$i]["user_time"]:$list[$i]["user_date"];?></td>
        </tr>
    <?php }
    if(count($list)==0) {
        ?>
        <tr>
            <td colspan="3" class="td_center">2019년 괴산 고추축제 첫 응원을 등록해보세요.</td>
        </tr>
        <?php
    }?>
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
    <div class="playing">
        <?php if($page!=1){?>
            <ul class="prev">
                <li ><a href="javascript:fnPage(<?php echo ($page-1); ?>)"><img src="<?php echo G5_IMG_URL;?>/1page_btn.png" alt=""></a></li>
            </ul>
        <?php } ?>
        <ul class="number">
            <?php for($i=$start_page;$i<=$end_page;$i++){ ?>
                <li class="<?php echo $page==$i?"active":""; ?>"><a href="javascript:fnPage(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
            <?php } ?>
        </ul>
        <?php if($page<$total_page){?>
            <ul class="next">
                <li ><a href="javascript:fnPage(<?php echo ($page+1); ?>)"><img src="<?php echo G5_IMG_URL;?>/1page_btn.png" alt=""></a></li>
            </ul>
        <?php } ?>
    </div>
    <?php
}
?>
