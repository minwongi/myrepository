<?php
include_once ("../../common.php");
?>
<div id="rank">
    <div id="rankview" >
        <div class="top_img"></div>
        <div class="bottom_img"></div>
        <div class="rank_list">
    <?php
    $sql = "select * from `game_user_info` as g left join `user_info` as u on g.user_id = u.user_id where g.score > 0  order by g.score desc limit 0 , 20";
    $res = sql_query($sql);
    $i=0;
    while($row=sql_fetch_array($res)){
        $str ="";
        for($j=0;$j< mb_strlen($row["userName"])-2 ;$j++){
            $str .= "*";
        }
        $num = mb_strlen($row["userName"]);
        $name = mb_substr($row["userName"],0,1);
        $name .= $str;
        $name .= mb_substr($row["userName"],name-1,1);
        $userHp = str_replace("-","",base64_decode($row["userHp"]));


        //$result['rank'][$i]["userName"] = $name;
        $hp = substr($userHp,0,3)." - **** - ".substr($userHp,7,4);
        $score = $row["score"];
    ?>
        <div class="item">
            <div><?php /*if($i==0){*/?><img src="<?php echo G5_IMG_URL;?>/img4.png" alt=""><?php /*}else{*/?><!--<img src="" alt="">--><?php /*}*/?></div><span><?php echo $name;?></span><span><?php echo $hp;?></span><span>점수 : <?php echo $score;?></span>
        </div>
    <?php
        $i++;
    }
    ?>
        </div>
    </div>

    <div class="modal_btn">
        <input type="button" value="닫기" onclick="fnHideModal();">
    </div>
</div>