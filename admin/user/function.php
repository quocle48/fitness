<?php 
	include_once("../../application/libraries/config.php"); 
	//if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: login.php");
	if(isset($_POST["btn_addfunc"])==True){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("insert into function(name,description) values('".$_POST["txt_funcname"]."','".$_POST["txt_desc"]."')"); 
        $result->execute();
	    header('Location: function.php');
		disconnectDb($conn);
	}

	if(isset($_POST["btn_editfunc"])==True){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("update function set name ='".$_POST["txt_funcname"]."', description='".$_POST["txt_desc"]."' where id='".$_POST['btn_editfunc']."' "); 
        $result->execute();
	    header('Location: function.php');
		disconnectDb($conn);

	}
	if(isset($_GET["delete"])){
		$conn=connectDb();
		$result = $conn->prepare("delete from function where id =".$_GET["delete"]);
		$result->execute();
		header('Location: function.php');
		disconnectDb($conn);
	}
	if(isset($_GET["btn_delete"])==True ){
		$conn=connectDb();
		$check = $_GET["checkfunc"];
		if($check!=null){
			foreach ($check as $id) {
				$result = $conn->prepare("delete from function where id =".$id."");
				$result->execute();
			}

		    echo "Delete successfully";
		}
		else echo "Chọn một function mà bạn muốn xóa";
		header('Location: function.php');
		disconnectDb($conn);
	}
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?php include_once("../../head.html"); ?>
	</head>
	<body>
		<aside class="menu-bar">
			<ul class="nav nav-pills nav-stacked">
			    <li class="active"><a href="#">Home</a></li>
			    <li><a onclick="showformadd()" >THÊM</a></li>
			    <li><a href="#">Logout</a></li>
		  	</ul>
		</aside>
		
		<script type="text/javascript">
			function showformadd(){
				$("#add_function").toggleClass("hide");
				if(!$("#edit_function").hasClass("hide")) $("#edit_function").addClass("hide");
			}
			function showformedit(){
				$("#edit_function").toggleClass("hide");
				if(!$("#add_function").hasClass("hide")) $("#add_function").addClass("hide");
			}
		</script>
		<!-- FORM THÊM -->
		<div class="admin-content">
			<!-- Phần form thêm được ẩn -->
			<form id="add_function" action ="function.php" method="post" class="form-horizontal hide" role="form" >
				<h3> ADD FUNCTION </h3>
				
				<div class="row form-admin">
					<label class="control-label col-sm-3">Function name:</label>
					<div class="col-sm-6">
						<input type="text" class="input-admin" name="txt_funcname" placeholder="Enter function name" required>
					</div>
				</div>
				<div class="row form-admin">
					<label class="control-label col-sm-3" >Description:</label>
					<div class="col-sm-6"> 
					  	<input type="text" class="input-admin" name="txt_desc" placeholder="Enter description" >
					</div>
				</div>
				<div class="row form-admin"> 
					<label class="control-label col-sm-3" ></label>
					<div class="col-sm-6"> 
						<div class="col-xs-6">
					  		<button type="submit" class="btnadd" name="btn_addfunc"> ADD  </button>
					  	</div>
					  	<div class="col-xs-6">
					  		<button type="button" class="btncancel" onclick="showformadd()">Cancel</button>
						</div>
					</div>
				</div>
				<div class="form-end "> 
				</div>
			</form>


			<?php 
				if(isset($_GET["btn_edit"])==True){
					$conn=connectDb();
					$conn->exec("set names utf8");
					$result = $conn->prepare("select * from function where id =".$_GET["btn_edit"].""); 
					$result->execute();
					if($result->rowCount()>0) {
						while($row=$result->fetch(PDO::FETCH_ASSOC))
						     {
							?>
							<form id="edit_function" action ="function.php" method="post" class="form-horizontal " role="form" >
								<h3> EDIT FUNCTION </h3>
								<div class="row form-admin">
									<label class="control-label col-sm-3">Function name:</label>
									<div class="col-sm-6">
										<input type="text" class="input-admin" name="txt_funcname" value="<?php echo $row['name']; ?>">
									</div>
								</div>
								<div class="row form-admin">
									<label class="control-label col-sm-3" >Description:</label>
									<div class="col-sm-6"> 
									  	<input type="text" class="input-admin" name="txt_desc" value="<?php echo $row['description']; ?>" >
									</div>
								</div>
								
								<div class="row form-admin"> 
									<label class="control-label col-sm-3" ></label>
									<div class="col-sm-6"> 
										<div class="col-xs-6">
											<button type="submit" class="btnadd" style="width:100px; float:right;" name="btn_editfunc" value ="<?php echo $row['id']; ?>" >OK </button>
										</div>
  										<div class="col-xs-6"><div class="btncancel"> 
									  		<a href="function.php">Cancel</a></div>
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

			<h2>LIST FUNCTION </h2>
			<div class="content">
				<table class="table table-hover ">
					<form action="function.php" method="GET">
				    	<thead>
							<tr>
								<th>
									<div class="btn-group">
										<button type="button" class="btnedit" onclick="showformadd()">
											<span class="fa fa-plus-square"></span>
										</button>
										<button type="submit" name ="btn_delete" class="btndelete" formaction="function.php">
											<span class="fa fa-trash-o"></span>
										</button>  	
									</div>
								</th>

								<th>ID</th>
								<th>FUNCTION NAME</th>
								<th>DESCRIPTION</th>
								<th> ACTION	</th>	
							</tr>
						</thead>
						<tbody>
							<?php
								$conn=connectDb();
								$conn->exec("set names utf8");
								$result = $conn->prepare("select * from function"); 
					            $result->execute();
					          
								if($result->rowCount()>0)
						    	{
						            while($row=$result->fetch(PDO::FETCH_ASSOC))
						            {
						            	echo '<td> <input  name="checkfunc[]" type="checkbox" style="text-align: center;" value="'.$row['id'].'"> </td>';
										echo "<td>$row[id]</td>";
										echo "<td>$row[name]</td>";
										echo "<td>$row[description]</td>";
										echo '<td><div class="btn-group"><button type="submit" class="btnedit" name="btn_edit" value="'.$row['id'].'" formaction="function.php"><span class="fa fa-pencil-square-o"></span></button>';
										echo '<button type="submit" class="btndelete" name="delete" onclick="javascript: return confirm(\'Bạn muốn xóa user này?\');" value="'.$row['id'].'" formaction="function.php"><span class="fa fa-trash"></span></button></div></td>';	

										echo '</tr>';
		   
						            }
							    }
							    else
							        echo "No data!";
								disconnectDb($conn);
							?>
						</tbody>
					</form>
				
				</table>
			</div>
		
	
		
	</body>
</html>