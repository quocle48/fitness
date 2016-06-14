<?php
	$servername = "localhost";
	$dbname = "fitness";
	$conn=mysqli_connect($servername,"root","",$dbname);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>User</title>
		<script src="../js/jquery-1.12.0.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
		<link rel="stylesheet" type="text/css" href="../css/fitness.css">
	</head>
	<body>
	<div class="container">
		<form  method="POST" role="form">
			<h1 style="text-align: center">THÔNG TIN USER</h1>
			<table id="list-user" class="table table-hover">
				<thead>
					<tr>
						<th>NAME</th>
						<th>USERNAME</th>
						<th>EMAIL</th>
						<th>DATE CREATE</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql="SELECT * FROM user";
						$result = $conn->query($sql);
						while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
							echo '<tr class="user_'.$row[5].'">';
							echo "<td>$row[0]</td>";
							echo "<td>$row[1]</td>";
							echo "<td>$row[3]</td>";
							echo "<td>$row[4]</td>";
							echo '<td><input type="radio" name="choose_user" onclick="setvalue('.$row[5].')" value="'.$row[5].'"></td>';
							echo '</tr>';
						}
					?>
				</tbody>
			</table>
			<div style="text-align:center;margin-bottom: 10px">
				<a class="btn btn-primary" onclick="showformadd()" >THÊM</a>
				<a class="btn btn-primary" onclick="showformedit()" >SỬA</a>
				<button type="submit" class="btn btn-primary" name="btndel" onclick="javascript: return confirm('Bạn muốn xóa user này?');" formaction="del.php">XÓA</button>
			</div>
			<script type="text/javascript">
				function showformadd(){
					$("#add_user").toggleClass("hide");
					if(!$("#edit_user").hasClass("hide")) $("#edit_user").addClass("hide");
				}
				function showformedit(){
					$("#edit_user").toggleClass("hide");
					if(!$("#add_user").hasClass("hide")) $("#add_user").addClass("hide");
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
		</form>
		
		<form id="add_user" action ="add.php" method="post" class="form-horizontal hide" role="form" >
			<div class="form-group">
				<label class="control-label col-sm-3">Name:</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="txtname" placeholder="Enter your name" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Username:</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="txtusername" placeholder="Enter username" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="pwd">Password:</label>
				<div class="col-sm-6"> 
				  	<input type="password" class="form-control" name="txtpass" placeholder="Enter password" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="email">Email:</label>
				<div class="col-sm-6">
					<input type="email" class="form-control" name="txtemail" placeholder="Enter email" required>
				</div>
			</div>
			<div class="form-group"> 
				<div class="col-sm-offset-3 col-sm-4">
				  <button type="submit" class="btn btn-default" name="btnadd">Submit</button>
				</div>
			</div>
		</form>
		<form id="edit_user" action ="edit.php" method="post" class="form-horizontal hide" role="form" >
			<div class="form-group">
				<label class="control-label col-sm-3">Name:</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="inp_name" name="txtname" value="">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Username:</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="inp_username" name="txtusername" disabled value="">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="pwd">New Password:</label>
				<div class="col-sm-6"> 
				  	<input type="password" class="form-control" name="txtpass">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="email">Email:</label>
				<div class="col-sm-6">
					<input type="email" class="form-control" id="inp_email" name="txtemail" value="">
				</div>
			</div>
			<div class="form-group"> 
				<div class="col-sm-offset-3 col-sm-4">
				  <button type="submit" class="btn btn-default" name="btnadd">Submit</button>
				</div>
			</div>
		</form>
	</div>
	</body>
</html>