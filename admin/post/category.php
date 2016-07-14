<?php
	include_once("../../application/libraries/config.php");
	include_once("../../application/libraries/pagination.php"); 
	//CHECK ADMIN
	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: ../login.php");
	//ADD
	if(isset($_POST["btn_add"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("insert into category_post(name, description) values('".$_POST["txt_name"]."','".$_POST["txt_description"]."')"); 
        $result->execute();
	    header('Location: category.php');
		disconnectDb($conn);
	}
	//EDIT
	if(isset($_POST["btn_edit"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("update category_post set name ='".$_POST["txt_name"]."', description = '".$_POST["txt_description"]."' where id = '".$_POST["btn_edit"]."'"); 
        $result->execute();
        /*$result = $conn->prepare("delete from group_function where group_id =".$_POST["btn_edit"]);
		$result->execute();
        $list_fc=$_POST['function'];
        foreach ($list_fc as $id) {
        	$result = $conn->prepare("insert into group_function(group_id, function_id) values('".$_POST["btn_edit"]."','".$id."')"); 
        	$result->execute();
        }*/
	    header('Location: category.php');
		disconnectDb($conn);
	}
	//DEL
	if(isset($_GET["delete"])){
		$conn=connectDb();
		$result = $conn->prepare("delete from category_post where id =".$_GET["delete"]);
		$result->execute();
		header('Location: category.php');
		disconnectDb($conn);
	}
	//DEL >1
		if(isset($_GET["btn_delete"])==True ){
		$conn=connectDb();
		$check = $_GET["checkfunc"];
		if($check!=null){
			foreach ($check as $id) {
				$result = $conn->prepare("delete from category_post where id =".$id."");
				$result->execute();
			}
		}
		header('Location: category.php');
		disconnectDb($conn);
	}
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?php include("../../head.html"); ?>
	</head>
	<body class="admin-page">
		<aside class="main-bar">
			<div class="sidebar">
				<a href="<?php echo $home;?>admin" class="admin-home">HOME</a>
				<div class="user-panel">
					<div class="avatar">
						<img src="<?php echo $home.'img/mem1.jpg'; ?>"/>
					</div>
					<div class="user-info">
						<div><?php echo $_SESSION['username'];?></div>
						<a href="logout.php">Logout</a>
					</div>
				</div>
				<ul class="menu-bar">
					<li class="label-header">Management</li>
				    <li id="menu-user" class="has-sub">
				    	<a href="javascript:void(0)">User<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu">
				    		<li><a href="<?php echo $home;?>admin/user/user.php"><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href="<?php echo $home;?>admin/user/group.php"><span class="fa fa-angle-right"></span>Group</a></li>
				    		<li><a href="<?php echo $home;?>admin/user/function.php"><span class="fa fa-angle-right"></span>Function</a></li>
				    	</ul>
				    </li>
				    <li id="menu-post" class="has-sub active">
				    	<a href="javascript:void(0)">Post<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu" style="display:block">
				    		<li><a href="<?php echo $home;?>admin/post/index.php"><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li class="active"><a href="<?php echo $home;?>admin/post/category.php"><span class="fa fa-angle-right"></span>Category</a></li>
				    	</ul>
				    </li>
				    <li id="menu-product" class="has-sub">
				    	<a href="javascript:void(0)">Product<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu">
				    		<li><a href="<?php echo $home;?>admin/product/index.php"><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href="<?php echo $home;?>admin/product/category.php"><span class="fa fa-angle-right"></span>Category</a></li>
				    	</ul>
				    </li>
				    <li class="label-header">Layout</li>
				    <li>
				    	<a href="user/function.php">Themes</a>
				    </li>
				</ul>
				<script type="text/javascript">
					$('.has-sub>a').click(function(){
						if(!$(this).parent().hasClass('active')){
							$('.has-sub').removeClass('active');
							$('.has-sub .sub-menu').slideUp(300);
						}
						$(this).parent().toggleClass('active');
						$(this).next().slideToggle(300);
					});
					
				</script>
			</div>	
		</aside>

		<script type="text/javascript">
				function showformadd(){
					$("#add-cate").toggleClass("hide");
					if(!$("#edit-cate").hasClass("hide")) $("#edit-cate").addClass("hide");
				}
				function showformedit(){
					$("#edit-cate").toggleClass("hide");
					if(!$("#add-cate").hasClass("hide")) $("#add-cate").addClass("hide");
				}
		</script>
		
		<!-- FORM THÊM -->
		<div class="page-content">
			<!-- Phần form thêm được ẩn -->
			<div class="content hide" id="add-cate">
				<form  action ="category.php" method="post" class="form-horizontal" role="form" >
					<h3> ADD CATEGORY </h3>
					<div class="form-group">
						<label class="control-label col-sm-3">Name:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-fit" name="txt_name" placeholder="Enter category's name" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Description:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-fit" name="txt_description" placeholder="Enter category's description" required>
						</div>
					</div>

					<div class="form-group"> 
						<label class="control-label col-sm-3"></label>
						<div class="col-sm-6">
							<button type="submit" class="btn-fit btn-pri" name="btn_add">Submit</button>
							<a href="category.php" class="btn-fit btn-dan">Cancel</a>
						</div>
					</div>
				</form>
			</div>
			<!-- Phần form edit cho category có id= được ẩn -->
			<?php 
				if(isset($_GET["edit"])){	?>
				<div class="content" id="edit-cate">
				<?php
					$conn=connectDb();
					$conn->exec("set names utf8");
					$result = $conn->prepare("select * from category_post where id =".$_GET["edit"].""); 
					$result->execute();
					if($result->rowCount()>0) {
						while($row=$result->fetch(PDO::FETCH_ASSOC))
						{
							?>
								<form action ="category.php" method="post" class="form-horizontal " role="form" >
									<h3> EDIT CATEGORY </h3>
									<div class="form-group">
										<label class="control-label col-sm-3">Name:</label>
										<div class="col-sm-6">
											<input type="text" class="form-control input-fit" name="txt_name" value="<?php echo $row['name']; ?>">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-3">Description:</label>
										<div class="col-sm-6">
											<input type="text" class="form-control input-fit" name="txt_description" value="<?php echo $row['description']; ?>">
										</div>
									</div>

									<div class="form-group"> 
										<div class="col-sm-offset-4 col-sm-4">
										  <button type="submit" class="btn-fit btn-pri" name="btn_edit" value ="<?php echo $row['id']; ?>" >Submit</button>
										  <a href="category.php" class="btn-fit btn-dan" >Cancel</a>
										</div>
									</div>
								</form>
								<?php
							}
						}	    
						disconnectDb($conn);
						echo "</div>";
					}
			?>
			<div class="content">
				<h3>LIST CATEGORY </h3>
				<form action="category.php" method="get">
					<table class="table table-hover">
				    	<thead>
							<tr>
								<th>
									<div class="btn-cate">
										<button type="button" class="btn-fit btn-inf" onclick="showformadd()">
											<span class="fa fa-plus-square"></span>
										</button>
										<button type="submit" name ="btn_delete" class="btn-fit btn-dan" onclick="javascript: return confirm('Bạn muốn xóa các category này?');">
											<span class="fa fa-trash-o"></span>
										</button>  	
									</div>
								</th>
								<th>ID</th>
								<th>NAME</th>
								<th>DESCRIPTION</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php

					          	$page   = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; 
								$listCate = new pagination("select * from category_post","10");
					            $result = $listCate->getData($page);
								if($result->rowCount()>0)
						    	{
						            while($row=$result->fetch(PDO::FETCH_ASSOC))
						            {
						            	echo '<td> <input  name="checkfunc[]" type="checkbox" value="'.$row['id'].'"> </td>';
										echo "<td>$row[id]</td>";
										echo "<td>$row[name]</td>";
										echo "<td>$row[description]</th>";
								
										echo '<td><div class="btn-cate"><button type="submit" class="btn-fit btn-inf" name="edit" value="'.$row['id'].'" formaction="category.php"><span class="fa fa-pencil-square-o"></span></button>';
										echo '<button type="submit" class="btn-fit btn-dan" name="delete" onclick="javascript: return confirm(\'Bạn muốn xóa category này?\');" value="'.$row['id'].'" formaction="category.php"><span class="fa fa-trash"></span></button></div></td>';									
										echo '</tr>';
						            }
							    }
							    else
							        echo "No data!";
								
							?>
						</tbody>
					</table>
				</form>
				<?php   
					echo $listCate->listPages();	
					$listCate->closeConn();
				?>
			</div>
		</div>
	</body>
</html>