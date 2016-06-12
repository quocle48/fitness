<?php 
	if(isset($_POST["btnadd"])==True)
	{
		$error = array();
		if($_POST["txtname"]==NULL)
		{
			$error["name"] = "Xin vui long nhap vao name! " ;
			echo $error["username"] ;
		}
		if($_POST["txtusername"]==NULL)
		{
			$error["username"] = "Xin vui long nhap vao username! " ;
			echo $error["username"] ;
		}
	
		if($_POST["txtpass"]==NULL)
		{
			$error["password"] = "Xin vui long nhap password! "; 
			echo $error["password"] ;
		}
		if($_POST["txtemail"]==NULL)
		{
			$error["email"] = "Xin vui long nhap vao email! " ;
			echo $error["email"] ;
		}
	
		if($_POST["txtname"]!=NULL && $_POST["txtusername"] !=NULL&& $_POST["txtpass"]!=NULL && $_POST["txtemail"] != NULL) 
		{
			$n = $_POST["txtname"];
			$u = $_POST["txtusername"];
			$p = $_POST["txtpass"];
			$e = $_POST["txtemail"];
			 if($u & $p & $e)
			 {
				$servername = "localhost";
				$dbname = "fitness";
				$conn=mysqli_connect($servername,"root","",$dbname);
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
				else {
					
					   $sql="select * from user where username='".$u."'";
					   $result=$conn->query($sql);
					   
					   if( mysqli_num_rows($result) >0 )
					   {
						echo "Username nay da ton tai roi<br />";
					   }
					   else
					   {
						   $sql2="insert into user(name,username,password,email) values('".$n."','".$u."','".$p."','".$e."')";
							$result2=$conn->query($sql2);
						   if ($result2) {
								echo "New record created successfully";
							} else {
								echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}

							mysqli_close($conn);
						
					   }
				}
			   
			 }
		}
	}
?>