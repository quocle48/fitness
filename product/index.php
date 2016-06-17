<?php
	include("../header.html"); 
	include("../banner.html"); ?>
<div class="container post">
<<<<<<< HEAD
	<div class="col-xs-12 col-md-9 ">
=======
>>>>>>> 24905e5085e4592aae5ceff559e79080caf681e0
	<?php
		$list=!isset($_GET["id"]);
		if(!$list)	include("product-detail.html");
		else{
<<<<<<< HEAD
			include("product-detail.html");
		}
=======
			for($i=0;$i<10;$i++){
>>>>>>> 24905e5085e4592aae5ceff559e79080caf681e0
	?>
	<div class="list-items col-xs-12 col-sm-6 col-md-6 col-lg-3">
	<?php include("product.html");?>
	</div>
<<<<<<< HEAD
	<div class="col-xs-6 col-md-3">
	<?php
		include("../categories.html");
		include("../practice.html");
		include("../statistical.html");
=======
	<?php		
			}
		}
>>>>>>> 24905e5085e4592aae5ceff559e79080caf681e0
	?>
</div>
<?php include("../footer.html"); ?>
