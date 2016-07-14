<?php 
	include_once("../../application/libraries/config.php"); 
	include_once("../../application/libraries/pagination.php"); 
	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: ../login.php");
	if(isset($_POST["btn_add"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$today = date("Y-m-d H:i:s");   
		$result = $conn->prepare("insert into post(title,user_id,tag,time, level_id, category_id, content) values('".$_POST["txt_title"]."','".$_SESSION['id']."','".$_POST["txt_tag"]."','".$today."','".$_POST["level"]."','".$_POST['category']."','".$_POST['add_editor']."')"); 
        $result->execute();
	    header('Location: index.php');
		disconnectDb($conn);
	}

	if(isset($_POST["btn_edit"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("update post set title ='".$_POST["txt_title"]."', tag ='".$_POST["txt_tag"]."', level_id ='".$_POST["level"]."', category_id ='".$_POST["category"]."' where id='".$_POST['btn_edit']."' "); 
        $result->execute();
      
	    header('Location: index.php');
		disconnectDb($conn);
	}

	if(isset($_GET["delete"])){
		$conn=connectDb();
		$result = $conn->prepare("delete from post where id =".$_GET["delete"]);
		$result->execute();
		header('Location: index.php');
		disconnectDb($conn);
	}
	if(isset($_GET["btn_delete"])==True ){
		$conn=connectDb();
		$check = $_GET["checkfunc"];
		if($check!=null){
			foreach ($check as $id) {
				$result = $conn->prepare("delete from post where id =".$id."");
				$result->execute();
			}
		}
		header('Location: index.php');
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
				    <li id="menu-post" class="has-sub active" >
				    	<a href="javascript:void(0)">Post<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu" style="display:block">
				    		<li class="active"> <a href="<?php echo $home;?>admin/post/index.php"><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href="<?php echo $home;?>admin/post/category.php"><span class="fa fa-angle-right"></span>Category</a></li>
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
					$("#add-user").toggleClass("hide");
					if(!$("#edit-user").hasClass("hide")) $("#edit-user").addClass("hide");
				}
				function showformedit(){
					$("#edit-user").toggleClass("hide");
					if(!$("#add-user").hasClass("hide")) $("#add-user").addClass("hide");
				}
			</script>
		<!-- FORM THÊM -->
		<div class="page-content">
		<div class="content hide" id="add-user">

			<!-- Phần form thêm được ẩn -->
			<form  action ="index.php" method="post" class="form-horizontal" role="form" >
				<h3> ADD POST </h3>
				<div class="form-group">
					<label class="control-label col-sm-3" >Title:</label>
					<div class="col-sm-6"> 
					  	<input type="text" class="form-control input-fit " name="txt_title" placeholder="Enter title post" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Tag:</label>
					<div class="col-sm-6"> 
					  	<input type="text" class="form-control input-fit" name="txt_tag"  placeholder="Enter tag post" >
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Level:</label>
					<div class="col-sm-6"> 
					<!--   	<input type="text" class="form-control input-fit" name="txt_img"  > -->
					  	<select class="form-control" name="level">
					  		<?php 
					  		$conn=connectDb();
							$result1 = $conn->prepare("SELECT * FROM level_post");
							$result1->execute();
							if($result1->rowCount()>0) {
								while($row=$result1->fetch(PDO::FETCH_ASSOC)){
									echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
								}
							}
							disconnectDb($conn);
					  	?>
			 
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Category:</label>
					<div class="col-sm-6"> 
					<!--   	<input type="text" class="form-control input-fit" name="txt_img"  > -->
					  	<select class="form-control" name="category">
					  		<?php 
					  		$conn=connectDb();
							$result = $conn->prepare("SELECT * FROM category_post");
							$result->execute();
							if($result->rowCount()>0) {
								while($row=$result->fetch(PDO::FETCH_ASSOC)){
									echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
								}
							}
							disconnectDb($conn);
					  	?>
			 
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Content:</label>
					<div class="col-sm-8"> 
					  	<textarea name="add_editor"></textarea>
					  	<script>
			            	CKEDITOR.replace('add_editor');
			        	</script>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" ></label>
					<div class="col-sm-6"> 
					  	<button type="submit" class="btn-fit btn-pri"  name="btn_add">Submit</button>
						<a href="index.php" class="btn-fit btn-dan">Cancel</a>
					</div>
				</div>
			</form>
		</div>
		<?php if(isset($_GET["edit"])){ ?>
		<div class="content" id="edit-user">
			<?php
				$conn=connectDb();
				$result = $conn->prepare("select * from post where id =".$_GET["edit"].""); 
				$result->execute();
				if($result->rowCount()>0) {
					while($row=$result->fetch(PDO::FETCH_ASSOC))
					{
			?>
						<form action ="index.php" method="post" class="form-horizontal" role="form" >
							<h3> EDIT POST </h3>
							<div class="form-group">
								<label class="control-label col-sm-3">ID Post:</label>
								<div class="col-sm-6">
									<input type="text" class="form-control input-fit" name="txt_id" value="<?php echo $row['id']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" >Title:</label>
								<div class="col-sm-6"> 
								  	<input type="text" class="form-control input-fit " name="txt_title" value=" <?php echo $row['title']; ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" >Tag:</label>
								<div class="col-sm-6"> 
								  	<input type="text" class="form-control input-fit" name="txt_tag"  value="<?php echo $row['tag']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" >Level:</label>
								<div class="col-sm-6"> 
								<!--   	<input type="text" class="form-control input-fit" name="txt_img"  > -->
								  	<select class="form-control" name="level">
								  		<?php 
								  		$conn=connectDb();
										$result1 = $conn->prepare("SELECT * FROM level_post");
										$result1->execute();
										if($result1->rowCount()>0) {
											while($row2=$result1->fetch(PDO::FETCH_ASSOC)){
												$select="";
												if($row['level_id']==$row2['id']) $select="selected";
												echo '<option value="'.$row2['id'].'"'.$select.'>'.$row2['name'].'</option>';
											}
										}
										disconnectDb($conn);
								  	?>
						 
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" >Category:</label>
								<div class="col-sm-6"> 
								<!--   	<input type="text" class="form-control input-fit" name="txt_img"  > -->
								  	<select class="form-control" name="category">
								  		<?php 
								  		$conn=connectDb();
										$result = $conn->prepare("SELECT * FROM category_post");
										$result->execute();
										if($result->rowCount()>0) {
											while($row2=$result->fetch(PDO::FETCH_ASSOC)){
												$select="";
												if($row['category_id']==$row2['id']) $select="selected";
												echo '<option value="'.$row2['id'].'"'.$select.'>'.$row2['name'].'</option>';
											}
										}
										disconnectDb($conn);
								  	?>
						 
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" >Content:</label>
								<div class="col-sm-8"> 
								  	<textarea name="edit_editor"></textarea>
									<script>
						            	CKEDITOR.replace('edit_editor');
						        	</script>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" ></label>
								<div class="col-sm-6"> 
										<button type="submit" class="btn-fit btn-pri"  name="btn_edit" value ="<?php echo $row['id']; ?>" >Submit
										</button>
										<a href="index.php" class="btn-fit btn-dan">Cancel</a>
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
				<form action="index.php" method="get">
					<h3>LIST POST </h3>
					<table class="table table-hover">
				    	<thead>
							<tr>
								<th>
									<div class="btn-group">
										<button type="button" class="btn-fit btn-inf" onclick="showformadd()">
											<span class="fa fa-plus-square"></span>
										</button>
										<button type="submit" name ="btn_delete" class="btn-fit btn-dan" onclick="javascript: return confirm('Bạn muốn xóa các user này?');">
											<span class="fa fa-trash-o"></span>
										</button>  	
									</div>
								</th>
								<th>ID post</th>
								<th>POSTNAME</th>
								<th>USERNAME</th>
								<th>LEVEL</th>
								<th>CATEGORY</th>
							</tr>
						</thead>
						<tbody>
							<?php
								// $conn=connectDb();
								// $conn->exec("set names utf8");
								// $result = $conn->prepare("select * from user");
								$page   = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; 
								$listPost = new pagination("select a.id, a.title, d.username , b.name as levelname, c.name from post a, level_post b, category_post c , user d where a.user_id=d.id and b.id = a.level_id and c.id = a.category_id",10);
					            $result = $listPost->getData($page);
								if($result->rowCount()>0)
						    	{
						            while($row=$result->fetch(PDO::FETCH_ASSOC))
						            {
						            	echo '<td> <input  name="checkfunc[]" type="checkbox" value="'.$row['id'].'"> </td>';
										echo "<td>$row[id]</td>";
										echo "<td>$row[title]</td>";
										echo "<td>$row[username]</td>";
										echo "<td>$row[levelname]</td>";
										echo "<td>$row[name]</td>";
										echo "<td>";
											
										echo "</td>";
										echo '<td><div class="btn-group"><button type="submit" class="btn-fit btn-inf" name="edit" value="'.$row['id'].'" formaction="index.php"><span class="fa fa-pencil-square-o"></span></button>';
										echo '<button type="submit" class="btn-fit btn-dan" name="delete" onclick="javascript: return confirm(\'Bạn muốn xóa post này?\');" value="'.$row['id'].'" formaction="index.php"><span class="fa fa-trash"></span></button></div></td>';									
										echo '</tr>';
						            }
						     
							    }
							    else
							        echo "<div class='notice'>No data!</div>";

							?>

						</tbody>	

					</table>
				</form>
				<?php   
					$listPage = $listPost->listPages();
					echo $listPage;	
					$listPost->closeConn();
				?>
			</div>

		</div>
		<script>
            CKEDITOR.replace('editor');
        </script>
	</body>
</html>