<?php 
	include_once("../../application/libraries/config.php"); 
	include_once("../../application/libraries/pagination.php"); 
	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: ../login.php");
	if(isset($_POST["btn_add"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("insert into user(username,password,email) values('".$_POST["txt_username"]."','".password_hash($_POST["txt_pass"], PASSWORD_BCRYPT)."','".$_POST["txt_email"]."')"); 
        $result->execute();
        $result = $conn->prepare("select id from user where username='".$_POST["txt_username"]."'"); 
        $result->execute();
        $user_id=$result->fetchAll()[0]['id'];
        $list_group=$_POST['group'];
        foreach ($list_group as $id) {
        	$result = $conn->prepare("insert into user_group(user_id,group_id) values('".$user_id."','".$id."')"); 
        	$result->execute();
        }
	    header('Location: user.php');
		disconnectDb($conn);
	}

	if(isset($_POST["btn_edit"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		if($_POST["txt_pass"]!="") $pass="password='".password_hash($_POST["txt_pass"], PASSWORD_BCRYPT)."',";
		else $pass="";
		$result = $conn->prepare("update user set username ='".$_POST["txt_username"]."',".$pass." email ='".$_POST["txt_email"]."' where id='".$_POST['btn_edit']."' "); 
        $result->execute();
        $result = $conn->prepare("delete from user_group where user_id =".$_POST["btn_edit"]);
		$result->execute();
        $list_group=$_POST['group'];
        foreach ($list_group as $id) {
        	$result = $conn->prepare("insert into user_group(user_id,group_id) values('".$_POST["btn_edit"]."','".$id."')"); 
        	$result->execute();
        }
	    header('Location: user.php');
		disconnectDb($conn);
	}

	if(isset($_GET["delete"])){
		$conn=connectDb();
		$result = $conn->prepare("delete from user where id =".$_GET["delete"]);
		$result->execute();
		header('Location: user.php');
		disconnectDb($conn);
	}
	if(isset($_GET["btn_delete"])==True ){
		$conn=connectDb();
		$check = $_GET["checkfunc"];
		if($check!=null){
			foreach ($check as $id) {
				$result = $conn->prepare("delete from user where id =".$id."");
				$result->execute();
			}
		}
		header('Location: user.php');
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
				    <li id="menu-user" class="has-sub active">
				    	<a href="javascript:void(0)">User<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu" style="display:block">
				    		<li class="active"><a href="<?php echo $home;?>admin/user/user.php"><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href="<?php echo $home;?>admin/user/group.php"><span class="fa fa-angle-right"></span>Group</a></li>
				    		<li><a href="<?php echo $home;?>admin/user/function.php"><span class="fa fa-angle-right"></span>Function</a></li>
				    	</ul>
				    </li>
				    <li id="menu-post" class="has-sub">
				    	<a href="javascript:void(0)">Post<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu">
				    		<li><a href="<?php echo $home;?>admin/post/index.php"><span class="fa fa-angle-right"></span>Infomation</a></li>
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
			<form  action ="user.php" method="post" class="form-horizontal" role="form" >
				<h3> ADD USER </h3>
				<div class="form-group">
					<label class="control-label col-sm-3">Username:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control input-fit " name="txt_username" placeholder="Enter username" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Password:</label>
					<div class="col-sm-6"> 
					  	<input type="password" class="form-control input-fit " name="txt_pass" placeholder="Enter password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Email:</label>
					<div class="col-sm-6"> 
					  	<input type="email" class="form-control input-fit" name="txt_email" placeholder="Enter email" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Group:</label>
					<div class="col-sm-6"> 
					  	<?php 
					  		$conn=connectDb();
							$result2 = $conn->prepare("SELECT * FROM `group`");
							$result2->execute();
							if($result2->rowCount()>0) {
								while($row=$result2->fetch(PDO::FETCH_ASSOC)){
									echo '<label class="checkbox-inline"><input name="group[]" type="checkbox" value="'.$row['id'].'">'.$row['name'].'</label>';
								}
							}
							disconnectDb($conn);
					  	?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" ></label>
					<div class="col-sm-6"> 
					  	<button type="submit" class="btn-fit btn-pri"  name="btn_add">Submit</button>
						<a href="user.php" class="btn-fit btn-dan">Cancel</a>
					</div>
				</div>
			</form>
		</div>
		<?php if(isset($_GET["edit"])){ ?>
		<div class="content" id="edit-user">
			<?php
				$conn=connectDb();
				$result = $conn->prepare("select * from user where id =".$_GET["edit"].""); 
				$result->execute();
				if($result->rowCount()>0) {
					while($row=$result->fetch(PDO::FETCH_ASSOC))
					{
			?>
						<form action ="user.php" method="post" class="form-horizontal" role="form" >
							<h3> EDIT USER </h3>
							<div class="form-group">
								<label class="control-label col-sm-3">Username:</label>
								<div class="col-sm-6">
									<input type="text" class="form-control input-fit" name="txt_username" value="<?php echo $row['username']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" >New password:</label>
								<div class="col-sm-6"> 
								  	<input type="password" class="form-control input-fit" name="txt_pass" placeholder="Enter new password" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" >Email:</label>
								<div class="col-sm-6"> 
								  	<input type="email" class="form-control input-fit" name="txt_email" value="<?php echo $row['email']; ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" >Group:</label>
								<div class="col-sm-6"> 
								  	<?php 
								  		$conn=connectDb();
										$result2 = $conn->prepare("SELECT * FROM `group`");
										$result2->execute();
										if($result2->rowCount()>0) {
											while($row2=$result2->fetch(PDO::FETCH_ASSOC)){
												$result3 = $conn->prepare("SELECT group_id FROM `user_group` where user_id='".$_GET["edit"]."' and group_id='".$row2['id']."'");
												$result3->execute();
												$str="";
												if($result3->rowCount()>0){ $str="checked"; }
												echo '<label class="checkbox-inline"><input name="group[]" type="checkbox" value="'.$row2['id'].'" '.$str.'>'.$row2['name'].'</label>';
											}
										}
										disconnectDb($conn);
								  	?>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" ></label>
								<div class="col-sm-6"> 
										<button type="submit" class="btn-fit btn-pri"  name="btn_edit" value ="<?php echo $row['id']; ?>" >Submit
										</button>
										<a href="user.php" class="btn-fit btn-dan">Cancel</a>
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
				<form action="user.php" method="get">
					<h3>LIST USER </h3>
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
								<th>ID</th>
								<th>USERNAME</th>
								<th>EMAIL</th>
								<th>GROUP</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								// $conn=connectDb();
								// $conn->exec("set names utf8");
								// $result = $conn->prepare("select * from user");
								$page   = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; 
								$listUser = new pagination("select * from user","10");
					            $result = $listUser->getData($page);
								if($result->rowCount()>0)
						    	{
						            while($row=$result->fetch(PDO::FETCH_ASSOC))
						            {
						            	echo '<td> <input  name="checkfunc[]" type="checkbox" value="'.$row['id'].'"> </td>';
										echo "<td>$row[id]</td>";
										echo "<td>$row[username]</td>";
										echo "<td>$row[email]</td>";
										echo "<td>";
										$result2 = $conn->prepare("select b.name from `user_group` as a, `group` as b where a.group_id=b.id and a.user_id='".$row['id']."'"); 
					            		$result2->execute();
					            		$list_gr;
					            		$x=0;
					            		while($row2=$result2->fetch(PDO::FETCH_ASSOC)){
					            			$list_gr[$x++]=$row2["name"];
					            			$list_gr[$x++]=", ";
					            		}
					            		for($i=0;$i<$x-1;$i++) echo $list_gr[$i];
										echo "</td>";
										echo '<td><div class="btn-group"><button type="submit" class="btn-fit btn-inf" name="edit" value="'.$row['id'].'" formaction="user.php"><span class="fa fa-pencil-square-o"></span></button>';
										echo '<button type="submit" class="btn-fit btn-dan" name="delete" onclick="javascript: return confirm(\'Bạn muốn xóa user này?\');" value="'.$row['id'].'" formaction="user.php"><span class="fa fa-trash"></span></button></div></td>';									
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
					$listPage = $listUser->listPages();
					echo $listPage;	
					$listUser->closeConn();
				?>
			</div>

		</div>
	</body>
</html>