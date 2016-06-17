<?php
	include("../header.html"); 
	include("../banner.html"); ?>
<div class="container post">
	<?php
		$list=!isset($_GET["id"]);
		if(!$list)	include("product-detail.html");
		else{
			for($i=0;$i<10;$i++){
	?>
	<div class="list-items col-xs-12 col-sm-6 col-md-6 col-lg-3">
	<?php include("product.html");?>
	</div>
	<?php		
			}
		}
	?>
</div>
<?php include("../footer.html"); ?>
