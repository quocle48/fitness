<?php
	include("../header.html"); 
	include("banner.html"); ?>
<div class="container">
	<div class="row ">
		<div class="col-xs-12 col-md-8 ">
		
		<?php
			for($i=0;$i<4;$i++)
				include("thum-post.html");
		?>
		</div>
		<div class="col-xs-6 col-md-4">
		<?php
			include("categories.html");
			include("statistical.html");
		?>
		</div>
	</div>
	
</div>
<?php include("../footer.html"); ?>