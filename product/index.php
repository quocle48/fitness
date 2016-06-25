<?php
	include("../header.html"); 
	include("../banner.html"); ?>
<div class="container post">
	<div class="col-xs-12 col-md-9 ">
		<div class="row"> 
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
		<div class="page-number">
		<ul class="pagination">
			<li ><a href="#"  > <span class="fa fa-chevron-left" aria-hidden="true"></span></a></li>
			<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
			<li ><a href="#">2 </a></li>
			<li ><a href="#">3 </a></li>
			<li ><a href="#">.. </a></li>
			<li ><a href="#">10 </a></li>
			<li ><a href="#">12 </a></li>
			<li ><a href="#"  > <span class="fa fa-chevron-right"  aria-hidden="true"></span></a></li>
		  </ul>
		</div>
		
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
