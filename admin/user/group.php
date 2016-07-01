<?php
	include_once("../../application/libraries/config.php");
	//CHECK ADMIN
	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: ../login.php");
	//ADD
	if(isset($_POST["btn_add"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("insert into `group`(name) values('".$_POST["txt_name"]."')"); 
        $result->execute();
	    header('Location: group.php');
		disconnectDb($conn);
	}
	//EDIT
	if(isset($_POST["btn_edit"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("update `group` set name ='".$_POST["txt_name"]."'"); 
        $result->execute();
	    header('Location: group.php');
		disconnectDb($conn);
	}
	//DEL
	if(isset($_GET["delete"])){
		$conn=connectDb();
		$result = $conn->prepare("delete from `group` where id =".$_GET["delete"]);
		$result->execute();
		header('Location: group.php');
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
			    <li class="active"><a href="group.php">Home</a></li>
			    <li><a onclick="showformadd()" >THÊM</a></li>
			    <li><a href="#">Logout</a></li>
			  </ul>
		</aside>

		<script type="text/javascript">
				function showformadd(){
					$("#add-group").toggleClass("hide");
					if(!$("#edit-group").hasClass("hide")) $("#edit-group").addClass("hide");
				}
				function showformedit(){
					$("#edit-group").toggleClass("hide");
					if(!$("#add-group").hasClass("hide")) $("#add-group").addClass("hide");
				}
		</script>
		
		<!-- FORM THÊM -->
		<div class="admin-content">

			<!-- Phần form thêm được ẩn -->
			<form id="add-group" action ="group.php" method="post" class="form-horizontal hide" role="form" >
				<h3> ADD GROUP </h3>
				<div class="form-group">
					<label class="control-label col-sm-3">Name:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="txt_name" placeholder="Enter group's name" required>
					</div>
				</div>

				<div class="form-group"> 
					<div class="col-sm-offset-3 col-sm-4">
					  <button type="submit" class="btn btn-default" name="btn_add">ADD</button>
					</div>
				</div>
			</form>
	
			<!-- Phần form edit cho group có id= được ẩn -->
			<?php 
				if(isset($_GET["edit"])){
					$conn=connectDb();
					$result = $conn->prepare("select * from `group` where id =".$_GET["edit"].""); 
					$result->execute();
					if($result->rowCount()>0) {
						while($row=$result->fetch(PDO::FETCH_ASSOC))
						{
							?>
							<form id="edit-group" action ="group.php" method="post" class="form-horizontal " role="form" >
								<h3> EDIT GROUP </h3>
								<div class="form-group">
									<label class="control-label col-sm-3">Name:</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="txt_name" value="<?php echo $row['name']; ?>">
									</div>
								</div>
						
								<div class="form-group"> 
									<div class="col-sm-offset-3 col-sm-4">
									  <button type="submit" class="btn btn-primary" name="btn_edit" value ="<?php echo $row['id']; ?>" >Submit</button>
									  <a href="group.php" class="btn btn-default" >Cancel</a>
									</div>
								</div>
							</form>
							<?php
						}
					}	    
					disconnectDb($conn);
				}
			?>

			<h3>LIST GROUP </h3>
			<div class="content">
				<table class="table table-hover">
					<form action="group.php" method="get">
				    	<thead>
							<tr>
								<th></th>
								<th>ID</th>
								<th>NAME</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$conn=connectDb();
								$conn->exec("set names utf8");
								$result = $conn->prepare("select * from `group`"); 
					            $result->execute();
								if($result->rowCount()>0)
						    	{
						            while($row=$result->fetch(PDO::FETCH_ASSOC))
						            {
						            	echo '<td> <input  name="checkfunc[]" type="checkbox" value="'.$row['id'].'"> </td>';
										echo "<td>$row[id]</td>";
										echo "<td>$row[name]</td>";
										echo '<td><div class="btn-group"><button type="submit" class="btn btn-default" name="edit" value="'.$row['id'].'" formaction="group.php">Edit</button>';
										echo '<button type="submit" class="btn btn-danger" name="delete" onclick="javascript: return confirm(\'Bạn muốn xóa group này?\');" value="'.$row['id'].'" formaction="group.php">Delete</button></div></td>';									
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