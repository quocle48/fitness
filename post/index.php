<?php include("header.html"); ?>
<?php include("banner.html"); ?>
<div class="container">
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		<?php
			for($i=0;$i<5;$i++)
				include("thum-post.html");
		?>
	</div>
	<div class="col-xs-0 col-sm-0 col-md-4 col-lg-4">
		<?php
			include("categories.html");
			include("categories.html");
		?>
	</div>
</div>
<?php include("../footer.html"); ?>