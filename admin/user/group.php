<?php
	include_once("../../application/libraries/config.php");
	//CHECK ADMIN
	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: ../login.php");
	//ADD
	if(isset($_POST["btn_add"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("insert into `group`(name, description) values('".$_POST["txt_name"]."','".$_POST["txt_description"]."')"); 
        $result->execute();
	    header('Location: group.php');
		disconnectDb($conn);
	}
	//EDIT
	if(isset($_POST["btn_edit"])){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("update `group` set name ='".$_POST["txt_name"]."', description = '".$_POST["txt_description"]."' where id = '".$_POST["btn_edit"]."'"); 
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
	//DEL >1
		if(isset($_GET["btn_delete"])==True ){
		$conn=connectDb();
		$check = $_GET["checkfunc"];
		if($check!=null){
			foreach ($check as $id) {
				$result = $conn->prepare("delete from function where id =".$id."");
				$result->execute();
			}
		}
		header('Location: function.php');
		disconnectDb($conn);
	}
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?php include("../../head.html"); ?>
	</head>
	<body class="admin-page">
		<aside class="menu-bar">
			<ul class="nav nav-pills nav-stacked">
			    <li class="active"><a href="<?php echo $home.'admin' ?>">Home</a></li>
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
		<div class="page-content">
			<!-- Phần form thêm được ẩn -->
			<div class="content hide" id="add-group">
				<form  action ="group.php" method="post" class="form-horizontal" role="form" >
					<h3> ADD GROUP </h3>
					<div class="form-group">
						<label class="control-label col-sm-3">Name:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-fit" name="txt_name" placeholder="Enter group's name" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Description:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-fit" name="txt_description" placeholder="Enter group's description" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" >Function:</label>
						<div class="col-sm-6"> 
					  	<?php 
					  		$conn=connectDb();
							$result2 = $conn->prepare("SELECT * FROM function");
							$result2->execute();
							if($result2->rowCount()>0) {
								while($row=$result2->fetch(PDO::FETCH_ASSOC)){
									echo '<label class="checkbox-inline"><input name="function[]" type="checkbox" value="'.$row['id'].'">'.$row['name'].'</label>';
								}
							}
							disconnectDb($conn);
					  	?>
						</div>
					</div>

					<div class="form-group"> 
						<label class="control-label col-sm-3"></label>
						<div class="col-sm-6">
							<button type="submit" class="btn-fit btn-pri" name="btn_add">Submit</button>
							<a href="group.php" class="btn-fit btn-dan">Cancel</a>
						</div>
					</div>
				</form>
			</div>
			<!-- Phần form edit cho group có id= được ẩn -->
			<?php 
				if(isset($_GET["edit"])){	?>
				<div class="content" id="edit-group">
				<?php
					$conn=connectDb();
					$conn->exec("set names utf8");
					$result = $conn->prepare("select * from `group` where id =".$_GET["edit"].""); 
					$result->execute();
					if($result->rowCount()>0) {
						while($row=$result->fetch(PDO::FETCH_ASSOC))
						{
							?>
								<form action ="group.php" method="post" class="form-horizontal " role="form" >
									<h3> EDIT GROUP </h3>
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
										  <a href="group.php" class="btn-fit btn-dan" >Cancel</a>
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
				<h3>LIST GROUP </h3>
				<form action="group.php" method="get">
					<table class="table table-hover">
				    	<thead>
							<tr>
								<th>
									<div class="btn-group">
										<button type="button" class="btn-fit btn-inf" onclick="showformadd()">
											<span class="fa fa-plus-square"></span>
										</button>
										<button type="submit" name ="btn_delete" class="btn-fit btn-dan" onclick="javascript: return confirm('Bạn muốn xóa các group này?');">
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
										echo "<td>$row[description]</th>";
										/*echo "<td>";
										$result2 = $conn->prepare("select b.name from `user_group` as a, `group` as b where a.group_id=b.id and a.user_id='".$row['id']."'"); 
				            			$result2->execute();
				            			$list_gr;
				            			$x=0;
				            			while($row2=$result2->fetch(PDO::FETCH_ASSOC)){
				            				$list_gr[$x++]=$row2["name"];
				            				$list_gr[$x++]=", ";
				            			}
				            			for($i=0;$i<$x-1;$i++) echo $list_gr[$i];
										echo "</td>"; */
										echo '<td><div class="btn-group"><button type="submit" class="btn-fit btn-inf" name="edit" value="'.$row['id'].'" formaction="group.php"><span class="fa fa-pencil-square-o"></span></button>';
										echo '<button type="submit" class="btn-fit btn-dan" name="delete" onclick="javascript: return confirm(\'Bạn muốn xóa group này?\');" value="'.$row['id'].'" formaction="group.php"><span class="fa fa-trash"></span></button></div></td>';									
										echo '</tr>';
						            }
							    }
							    else
							        echo "No data!";
								disconnectDb($conn);
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>