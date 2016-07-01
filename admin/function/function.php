<?php 
	include_once("../../application/libraries/config.php"); 
	//if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: login.php");
	if(isset($_POST["btn_addfunc"])==True){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("insert into function(name,description) values('".$_POST["txt_funcname"]."','".$_POST["txt_desc"]."')"); 
        $result->execute();
	    echo "New records created successfully";
		disconnectDb($conn);
	}

	if(isset($_POST["btn_editfunc"])==True){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("update function set name ='".$_POST["txt_funcname"]."', description='".$_POST["txt_desc"]."' where id='".$_POST['btn_editfunc']."' "); 
        $result->execute();
	    echo "Updated successfully";
		disconnectDb($conn);

	}


	if(isset($_POST["btn_delete"])==True ){
		$conn=connectDb();
		$check = $_POST["checkfunc"];
		if($check!=null){
			foreach ($check as $id) {
				$result = $conn->prepare("delete from function where id =".$id."");
				$result->execute();
			}

		    echo "Delete successfully";
		}
		else echo "Chọn một function mà bạn muốn xóa";
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
		
		<div class="admin-content">
			<!-- Phần form thêm được ẩn -->
			<form id="add_function" action ="function.php" method="post" class="form-horizontal hide" role="form" >
				<h3> ADD FUNCTION </h3>
				
				<div class="form-group">
					<label class="control-label col-sm-3">Function name:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="txt_funcname" placeholder="Enter function name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Description:</label>
					<div class="col-sm-6"> 
					  	<input type="text" class="form-control" name="txt_desc" placeholder="Enter description" >
					</div>
				</div>
				<div class="form-group"> 
					<div class="col-sm-offset-3 col-sm-4">
					  <button type="submit" class="buy-now" name="btn_addfunc"> ADD  </button>
					</div>
				</div>
				<div class="form-end "> 
				</div>
			</form>


			<?php 
				if(isset($_POST["btn_edit"])==True){
					$conn=connectDb();
					$conn->exec("set names utf8");
					$result = $conn->prepare("select * from function where id =".$_POST["btn_edit"].""); 
					$result->execute();
					if($result->rowCount()>0) {
						while($row=$result->fetch(PDO::FETCH_ASSOC))
						     {
							?>
							<form id="edit_function" action ="function.php" method="post" class="form-horizontal " role="form" >
								<h3> EDIT FUNCTION </h3>
								<div class="form-group">
									<label class="control-label col-sm-3">Function name:</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="txt_funcname" value="<?php echo $row['name']; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3" >Description:</label>
									<div class="col-sm-6"> 
									  	<input type="text" class="form-control" name="txt_desc" placeholder="<?php echo $row['description']; ?>" >
									</div>
								</div>
								
								<div class="form-group"> 
									<div class="col-sm-offset-3 col-sm-4">
									  <button type="submit" class="buy-now" name="btn_editfunc" value ="<?php echo $row['id']; ?>" >Edit </button>
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
					<form action="function.php" method="post">
				    	<thead>
							<tr>
								<th>ID</th>
								<th>FUNCTION NAME</th>
								<th>DESCRIPTION</th>
								<th></th>
								<th>
									<input type="submit" name ="btn_delete" class="btnedit btndelete" value="Delete" />	
								</th>	
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
										echo "<td>$row[id]</td>";
										echo "<td>$row[name]</td>";
										echo "<td>$row[description]</td>";
										echo '<td><button type="submit" class="btnedit" name="btn_edit" value="'.$row['id'].'" >Edit</button></td>';
										echo '<td> <input  name="checkfunc[]" type="checkbox" style="text-align: center;" value="'.$row['id'].'"> </td>';
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
		
		

		

		<script type="text/javascript">
				function showformadd(){
					$("#add_function").toggleClass("hide");
					if(!$("#edit_function").hasClass("hide")) $("#edit_funtion").addClass("hide");
				}
				function showformedit(){
					$("#edit_function").toggleClass("hide");
					if(!$("#add_function").hasClass("hide")) $("#add_function").addClass("hide");
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
		
		
	</body>
</html>