<?php
$subTitle = "login";
require_once('head.php');
$pro = getProfInfo();
$reviews = listReviewsByProfID();
$count =0;
// do some math
$rating = 0;
$homework = 0;
$test = 0;
$helpful = 0;
foreach($reviews as $k=>$v){
	$count++;
	$rating+=$v["OVERALL"];
	$homework+=$v["HW"];
	$test += $v["TEST"];
	$helpful += $v["HELPFUL"];
}
$pro["reviewCount"] = $count;
if($count == 0){
	$pro["rating"] = 0;
	$pro["homework"] = 0;
	$pro["helpful"] = 0;
	$pro["test"] = 0;
}else{
	$pro["rating"] = floatval($rating)/floatval($count);
	$pro["homework"] = floatval($homework)/floatval($count);
	$pro["helpful"] = floatval($helpful)/floatval($count);
	$pro["test"] = floatval($test)/floatval($count);
}

?>
<div>
	<h3 style="text-align:left">Professor Review Info</h3>
	<!-- professor info -->
    <div class="row" style="margin-top: 30px;">
		<div class="col-sm-6" >
			<div class="info">
				<p><span class="title">Name</span>:<span> <?php echo $pro["profName"]?></span></p>
				<p><span class="title">Review Vount</span>:<span> <?php echo $pro["reviewCount"]?></span></p>
				<p><span class="title">Average Rating</span>:<span> <?php echo round($pro["rating"],2)?></span></p>
				<p><span class="title">Average HW</span>:<span> <?php echo round($pro["homework"],2)?></span></p>
				<p><span class="title">Average Test</span>:<span> <?php echo round($pro["test"],2)?></span></p>
				<p><span class="title">Average Helpful</span>:<span> <?php echo round($pro["helpful"],2)?></span></p>
			</div>
		</div>
		<div class="col-sm-6">
			<?php if($u_name === FALSE){ ?>
			<?php }else{ ?>
 			<button class="button" data-toggle="modal" data-target="#reviewModal">Write a Review</button>
            <button class="button" data-toggle="modal" data-target="#reportModal">Report</button>
            
 			<?php } ?>
		</div>
    </div>
    <hr>
    <!-- reviews -->
	<h3 style="text-align:left">Newest Reviews</h3>
    <div class="row">
		<div class="col-sm-12">
		<?php foreach($reviews as $k=>$v){ ?>
			<hr>
			<div class="info">
				<p><span class="title">UserName</span>:<span> <?php echo $v["userName"]?></span></p>
				<p><span class="title">ClassName</span>:<span> <?php echo $v["className"]?></span></p>
				<p><span class="title">Rating</span>:<span> <?php echo $v["OVERALL"]?></span></p>
				<p><span class="title">Homework</span>:<span> <?php echo $v["HW"]?></span></p>
				<p><span class="title">Test</span>:<span> <?php echo $v["TEST"]?></span></p>
				<p><span class="title">Helpful</span>:<span> <?php echo $v["HELPFUL"]?></span></p>
				<p><span class="title">Time</span>:<span> <?php echo $v["date"]?></span></p>
				<p><span class="title">Comment</span>:<span> <?php echo $v["comment"]?></span></p>
			</div>
		<?php } ?>
		
		</div>
	</div>
</div>
<?php require_once('foot.php'); ?>