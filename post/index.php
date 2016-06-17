<?php
	include("../header.html"); 
	include("banner.html"); ?>
<div class="container post">
	<div class="col-xs-12 col-md-8 ">
	<?php
		$t=1;
		if($t==1){
			for($i=0;$i<4;$i++)
				include("thum-post.html");
			include("page-number.html");
		}
		if($t==2){
			include("post-detail-1.html");
		}
	?>
	</div>
	<div class="col-xs-6 col-md-4">
	<?php
		include("categories.html");
		include("practice.html");
		include("statistical.html");
		if($t==2){
			include("interested.html");
		}
		
	?>
	</div>
</div>
<?php include("../footer.html"); ?>