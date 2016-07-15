<?php
	include("../header.html"); 
	include("../banner.html"); 
	include_once("../application/libraries/config.php"); 
	include_once("../application/libraries/pagination.php"); 

	?>
<div class="container post">
	<div class="col-xs-12 col-md-9 ">
	<?php
		if(isset( $_GET['level'])){
			$level = (isset( $_GET['level'] ) ) ? $_GET['level'] : 1;	
			$list= (isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
			$sql = "select a.id, a.title, a.like , a.time, a.level_id, d.username from post a, level_post b, category_post c , user d where a.user_id=d.id and b.id = a.level_id and c.id = a.category_id and a.level_id=".$level;
			$listPost = new pagination($sql,"5");
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
			 
			$listPages = $listPost->listPages();
			echo $listPages;	
			$listPost->closeConn();
		}
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$conn=connectDb();
			$conn->exec("set names utf8");
			$sql = "select a.id, a.title, a.like , a.time, a.level_id, d.username from post a, level_post b, category_post c , user d where a.user_id=d.id and b.id = a.level_id and c.id = a.category_id and a.id=".$id;
			$query = $conn->prepare($sql);
			$query->execute();
			if($query->rowCount()>0)
	    	{
	            while($row=$query->fetch(PDO::FETCH_ASSOC))
	            {
	            	include("post-detail.html");
	            }
		    }
		    else
		        echo "<div class='notice'>No find data!</div>";
		    disconnectDb($conn);
		}
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
