<?php
	include("../header.html"); 
	include("../banner.html"); ?>
<div class="container post">
	<div class="col-xs-12 col-md-9 ">
	<?php
		$list=!isset($_GET["id"]);
		if(!$list)	include("product-detail.html");
		else{
			for($i=0;$i<10;$i++){
	?>
		<div class="list-items col-xs-12 col-sm-4 col-md-4 col-lg-3">
		<?php include("product.html");?>
		</div>
	<?php }} ?>
	</div>
	<div class="block-right col-md-3">
		<div class="categories">
			<div class="title-categories">
				<a href="#" ><h2>MẶT HÀNG</h2></a>
			</div>
			<div class="tag-categories">
				<ul>
					<li><a href="#"><span class="fa fa-check-square-o "></span>TRANG PHỤC</a></li>
					<li><a href="#"><span class="fa fa-check-square-o "></span>DỤNG CỤ</a></li>
					<li><a href="#"><span class="fa fa-check-square-o "></span>THỰC PHẨM</a></li>
				</ul>
			</div>
		</div>
	<?php
		include("../statistical.html");
	?>
	</div>
</div>
<?php include("../footer.html"); ?>
