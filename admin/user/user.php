<?php 
	include_once("../../application/libraries/config.php"); 
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
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?php include("../../head.html"); ?>
	</head>
	<body>
		<aside class="menu-bar">
			<ul class="nav nav-pills nav-stacked">
			    <li class="active"><a href="user.php">Home</a></li>
			    <li><a onclick="showformadd()" >THÊM</a></li>
			    <li><a href="#">Logout</a></li>
			  </ul>
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
				function setvalue(id){
					var data=$('tr.user_'+id);
					var name=data.find(':nth-child(1)').text();
					var username=data.find(':nth-child(2)').text();
					var email=data.find(':nth-child(3)').text();
					$('#inp_name').val(name)
					$('#inp_username').val(username);
					$('#inp_email').val(email);
				}
			</script>
		<!-- FORM THÊM -->
		
		<div class="admin-content">

			<!-- Phần form thêm được ẩn -->
			
			<form id="add-user" action ="user.php" method="post" class="form-horizontal hide" role="form" >
				<h3> ADD USER </h3>
				<div class="form-group">
					<label class="control-label col-sm-3">Username:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="txt_username" placeholder="Enter username" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Password:</label>
					<div class="col-sm-6"> 
					  	<input type="password" class="form-control" name="txt_pass" placeholder="Enter password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Email:</label>
					<div class="col-sm-6"> 
					  	<input type="email" class="form-control" name="txt_email" placeholder="Enter email" required>
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
					<div class="col-sm-offset-3 col-sm-4">
					  <button type="submit" class="btn btn-default" name="btn_add">Submit</button>
					</div>
				</div>
			</form>


			<?php 
				if(isset($_GET["edit"])){
					$conn=connectDb();
					$result = $conn->prepare("select * from user where id =".$_GET["edit"].""); 
					$result->execute();
					if($result->rowCount()>0) {
						while($row=$result->fetch(PDO::FETCH_ASSOC))
						{
							?>
							<form id="edit-user" action ="user.php" method="post" class="form-horizontal " role="form" >
								<h3> EDIT USER </h3>
								<div class="form-group">
									<label class="control-label col-sm-3">Username:</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="txt_username" value="<?php echo $row['username']; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3" >New password:</label>
									<div class="col-sm-6"> 
									  	<input type="password" class="form-control" name="txt_pass" placeholder="Enter new password" >
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3" >Email:</label>
									<div class="col-sm-6"> 
									  	<input type="email" class="form-control" name="txt_email" value="<?php echo $row['email']; ?>" required>
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
									<div class="col-sm-offset-3 col-sm-4">
									  <button type="submit" class="btn btn-primary" name="btn_edit" value ="<?php echo $row['id']; ?>" >Submit</button>
									  <a href="user.php" class="btn btn-default" >Cancel</a>
									</div>
								</div>
								
							</form>
							<?php
						}
					}	    
					disconnectDb($conn);
				}
			?>

			<h3>LIST USER </h3>
			<div class="content">
				<table class="table table-hover">
					<form action="user.php" method="get">
				    	<thead>
							<tr>
								<th></th>
								<th>ID</th>
								<th>USERNAME</th>
								<th>EMAIL</th>
								<th>GROUP</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$conn=connectDb();
								$conn->exec("set names utf8");
								$result = $conn->prepare("select * from user order by id"); 
					            $result->execute();
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
										echo '<td><div class="btn-group"><button type="submit" class="btn btn-default" name="edit" value="'.$row['id'].'" formaction="user.php">Edit</button>';
										echo '<button type="submit" class="btn btn-danger" name="delete" onclick="javascript: return confirm(\'Bạn muốn xóa user này?\');" value="'.$row['id'].'" formaction="user.php">Delete</button></div></td>';									
										echo '</tr>';
						            }
							    }
							    else
							        echo "No data!";
								disconnectDb($conn);
							?>
						</tbody>
				
				</table>
			</div>
		</div>
	</body>
</html>