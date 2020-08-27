<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>
<?php if (count($list) > 0) { //게시물이 없을 때  
?>
<div class="owl-carousel" id="gall_slide">
    <?php for ($i=0; $i<count($list); $i++) {  
	$file = get_file("gallery",$list[$i]["wr_id"]);
	?>
        <div class="item" style="background-size:cover;background-position:center;background-repeat:no-repeat;background-image:url('<?php echo $file[0]["path"]."/".$file[0]["file"];?>')">
			<img src="<?php echo $file[0]["path"]."/".$file[0]["file"];?>" alt="" style="opacity:0;">
        </div>
    <?php }  ?>
</div>
<?php }else{ ?>
<div class="no_slide">
    <div>게시물이 없습니다.</div>
</div>
<?php } ?>
<script>
    var owls = $("#gall_slide");
    owls.owlCarousel({
        autoplay: true,
		margin:20,
        autoplayTimeout: 8000,
        autoplaySpeed: 2000,
        smartSpeed: 2000,
        loop: true,
        dots: false,
		center:true,
		nav:true,
		navText:['',''],
        items: 3,
        responsive:{
            0 : {
                items:1,
                nav:false
            },
            480 : {
                items:1,
                nav:false
            },
            768 : {
                items:3,
                nav:true
            }
        }
    });
</script>