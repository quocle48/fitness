<?php
	include("../header.html"); 
	include_once("../application/libraries/config.php"); 
	include_once("../application/libraries/pagination.php"); 

	?>
<div class="container post">
	<div class="col-xs-12 col-lg-8 ">
	<?php
		if(isset( $_GET['level'])){
			$level = (isset( $_GET['level'] ) ) ? $_GET['level'] : 1;	
			$list= (isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
			$sql = "select  *,a.id as id_post, a.description as description_post from post a, level_post b, category_post c , user d where a.user_id=d.id and b.id = a.level_id and c.id = a.category_id and a.status=0 and a.level_id=".$level;
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
		else if(isset($_GET['id'])){
			$id = $_GET['id'];
			$conn=connectDb();
			$conn->exec("set names utf8");
			$sql = "select  *,a.id as id_post, a.description as description_post from post a, level_post b, category_post c , user d where a.user_id=d.id and b.id = a.level_id and c.id = a.category_id and a.id=".$id;
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
		else
		{
			$list= (isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
			$sql = "select  *,a.id as id_post, a.description as description_post from post a, level_post b, category_post c , user d where a.user_id=d.id and b.id = a.level_id and c.id = a.category_id";
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
	?>
	</div>
	<div class="col-xs-6 col-lg-4 ">
	<?php
		include("../categories.html");
		include("../right_favorite.html");
	?>
	</div>
</div>
<?php include("../footer.html"); ?>
