<?php 
	include_once("../../application/libraries/config.php"); 
	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: ../login.php");
	if(isset($_POST["btn_add"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("insert into user(username,password,email) values('".$_POST["txt_username"]."','".password_hash($_POST["txt_pass"], PASSWORD_BCRYPT)."','".$_POST["txt_email"]."')"); 
        $result->execute();
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
			
			<form id="add-user" action ="user.php" method="post" class="form-horizontal hide " role="form" >
				<h3> ADD USER </h3>
				<div class="row form-admin">
					<label class="control-label col-sm-3">Username:</label>
					<div class="col-sm-6">
						<input type="text" class="input-admin " name="txt_username" placeholder="Enter username" required>
					</div>
				</div>
				<div class="row form-admin">
					<label class="control-label col-sm-3" >Password:</label>
					<div class="col-sm-6"> 
					  	<input type="password" class="input-admin " name="txt_pass" placeholder="Enter password" required>
					</div>
				</div>
				<div class="row form-admin">
					<label class="control-label col-sm-3" >Email:</label>
					<div class="col-sm-6"> 
					  	<input type="email" class="input-admin" name="txt_email" placeholder="Enter email" required>
					</div>
				</div>
				<div class="row form-admin">
					<label class="control-label col-sm-3" ></label>
					<div class="col-sm-6"> 
					  	<button type="submit" class="btnadd" name="btn_add">ADD</button>
					</div>
				</div>
				<div class="form-end "> 
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
								<div class="row form-admin">
									<label class="control-label col-sm-3">Username:</label>
									<div class="col-sm-6">
										<input type="text" class="input-admin" name="txt_username" value="<?php echo $row['username']; ?>">
									</div>
								</div>
								<div class="row form-admin">
									<label class="control-label col-sm-3" >New password:</label>
									<div class="col-sm-6"> 
									  	<input type="password" class="input-admin" name="txt_pass" placeholder="Enter new password" >
									</div>
								</div>
								<div class="row form-admin">
									<label class="control-label col-sm-3" >Email:</label>
									<div class="col-sm-6"> 
									  	<input type="email" class="input-admin" name="txt_email" value="<?php echo $row['email']; ?>" required>
									</div>
								</div>
								<div class="row form-admin">
									<label class="control-label col-sm-3" ></label>
									<div class="col-sm-6"> 
										<div class="col-xs-6">
											<button type="submit" class="btnadd" style="width:100px; float:right;" name="btn_edit" value ="<?php echo $row['id']; ?>" >OK
											</button></div>
  										<div class="col-xs-6"><div class="btncancel"> 
									  		<a href="user.php">Cancel</a></div>
										</div>
									</div> 	
								</div>
								<div class="form-end "> 
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
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$conn=connectDb();
								$conn->exec("set names utf8");
								$result = $conn->prepare("select * from user"); 
					            $result->execute();
								if($result->rowCount()>0)
						    	{
						            while($row=$result->fetch(PDO::FETCH_ASSOC))
						            {
						            	echo '<td> <input  name="checkfunc[]" type="checkbox" value="'.$row['id'].'"> </td>';
										echo "<td>$row[id]</td>";
										echo "<td>$row[username]</td>";
										echo "<td>$row[email]</td>";
										echo '<td><div class="btn-group"><button type="submit" class="btnedit" name="edit" value="'.$row['id'].'" formaction="user.php"><span class="fa fa-pencil-square-o"></span></button>';
										echo '<button type="submit" class="btndelete" name="delete" onclick="javascript: return confirm(\'Bạn muốn xóa user này?\');" value="'.$row['id'].'" formaction="user.php"><span class="fa fa-trash"></span></button></div></td>';									
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