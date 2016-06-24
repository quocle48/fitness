<?php include("../application/config.php");
	$Err="";
	if(isset($_POST['log-admin'])){
        $user = $pass = "";
        if (strlen($_POST["user"])>=4 && !empty($_POST["user"]))
            $user = $_POST["user"];
        else $Err="Username";
        if(strlen($_POST["pass"])>=6 && !empty($_POST["pass"]))
			$pass=$_POST["pass"];
        else $Err="Password";
        if($Err=="")
        {	 $conn=connectDb();
            $sql="select password from user where username='".$user."' ";
            $result= $conn->query($sql);
            disconnectDb($conn);
            if( password_verify($pass, $result->fetchColumn())){
				$_SESSION['username']=$user;
                header("Location: index.php");
			}
            else
                $Err="Username hoặc Password";
        }}
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?php include("../head.html"); ?>
	</head>
	<body class="login-admin container">
		<div class="login-box form-account">
			<form action="login.php" method="POST" role="form">
				<legend><h2>QUẢN TRỊ VIÊN</h2></legend>
				<input type="text" name="user" placeholder="Username">
				<input type="password" name="pass" placeholder="Password">
				<p class="error">
				<?php
						if($Err!="") echo $Err." chưa đúng. Xin vui lòng thử lại.";
				?>
				</p>
				<button type="submit" name="log-admin">Login</button>
			</form>
			<a href="">Forgot your password?</a>
		</div>
	</body>
</html>