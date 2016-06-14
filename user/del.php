<?php 
	if(isset($_POST["btndel"])==True)
	{
		if(isset($_POST["choose_user"])!=true)
		{
			echo "<script>alert('Chưa chọn tài khoản');</script>";
		}
		else 
		{
			$servername = "localhost";
			$dbname = "fitness";
			$conn=mysqli_connect($servername,"root","",$dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			else {
				$sql="DELETE FROM user WHERE id_user =".$_POST["choose_user"];
				$result=$conn->query($sql);
				if ($result) echo "<script>alert('Xóa tài khoản thành công');</script>";
				else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
	header('Refresh: 0.1; URL=main.php');
?>