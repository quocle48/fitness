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
		<form  method="GET" role="form">
			<h1 style="text-align: center">THÔNG TIN USER</h1>
			<table class="table table-hover">
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
							echo '<td><input type="radio" name="user" value="'.$row[5].'"></td>';
							echo '</tr>';
						}
					?>
				</tbody>
			</table>
			<div style="text-align:center">
				<button type="submit" class="btn btn-primary">THÊM</button>
				<button type="submit" class="btn btn-primary">SỬA</button>
				<button type="submit" class="btn btn-primary">XÓA</button>
			</div>	
		</form>
		<h2>
			<?php
				if(isset($_GET["user"])) {
					echo $_GET["user"];
				}
			?>
		</h2>
	</div>
	</body>
</html>