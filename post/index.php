<?php
	include("../header.html"); 
	include("../banner.html"); 
	include_once("../application/libraries/config.php"); 
	include_once("../application/libraries/pagination.php"); 

	?>
<div class="container post">
	<div class="col-xs-12 col-md-9 ">
	<?php
		
		
		$list= (isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$listPost = new pagination("select a.id, a.title, a.like , a.time, d.username from post a, level_post b, category_post c , user d where a.user_id=d.id and b.id = a.level_id and c.id = a.category_id","10");
		$result = $listPost->getData($list);

		if($result->rowCount()>0)
    	{
            while($row=$result->fetch(PDO::FETCH_ASSOC))
            {
            	include("thum-post.html");
            }
     
	    }
	    else
	        echo "<div class='notice'>No data!</div>";
		
	?>
	</div>
	<div class="col-xs-6 col-md-3">
	<?php
		include("../categories.html");
		include("../practice.html");
		include("../statistical.html");
	?>
	</div>
</div>
<?php include("../footer.html"); ?>
