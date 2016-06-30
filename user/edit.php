<?php 
	if(isset($_POST["btnedit"])==True)
	{
		if(isset($_POST["choose_user"])!=true)
		{
			echo "<script>alert('Chua chon tai khoan');</script>";
		}
		else 
		{
			$servername = "localhost";
			$dbname = "fitness";
			$conn=mysqli_connect($servername,"root","",$dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			else{
				$n = $_POST["txtname"];
				$p = $_POST["txtpass"];
				$e = $_POST["txtemail"];
				if($n & $p & $e){
					$servername = "localhost";
					$dbname = "fitness";
					$conn=mysqli_connect($servername,"root","",$dbname);
					if (!$conn) {
						die("Connection failed: " . mysqli_connect_error());
					}
					else{
						$sql2="update user(name, password, email) values('".$n."','".$p."','".$e."')";
						$result2=$conn->query($sql2);
						if ($result2) {
							 echo "<script>alert('Chinh sua tai khoan thanh cong');</script>";
						} else {	
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						mysqli_close($conn);
					}
				}
			}
		}
	}
	header('Refresh: 0.1; URL=main.php');
?>