<?php
	include("../header.html"); 
	include("banner.html"); ?>
<div class="container post">
	<div class="col-xs-12 col-md-8 ">
	<?php
		$list=!isset($_GET["id"]);
		if($list){
			for($i=0;$i<4;$i++)
				include("thum-post.html");
			include("page-number.html");
		}
		else{
			include("post-detail-1.html");
		}
	?>
	</div>
	<div class="col-xs-6 col-md-4">
	<?php
		include("categories.html");
		include("practice.html");
		include("statistical.html");
		
	?>
	</div>
</div>
<?php include("../footer.html"); ?>