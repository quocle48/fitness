<?php include_once("../application/libraries/config.php");
	$Err="";
	if(isset($_SESSION['username']) && $_SESSION['level']>0) header("Location: index.php");
	if(isset($_POST['log-admin'])){
        $user = $pass = "";
        if (strlen($_POST["user"])>=4 && !empty($_POST["user"]))
            $user = $_POST["user"];
        else $Err="Username";
        if(strlen($_POST["pass"])>=6 && !empty($_POST["pass"]))
			$pass=$_POST["pass"];
        else $Err="Password";
        if($Err=="")
        {	
        	$conn=connectDb();
            $sql="select password,level from user where username='".$user."' ";
            $result= $conn->query($sql)->fetchAll();
            disconnectDb($conn);
            if(count($result)>0){
                $account=$result[0];
                $pw=$account['password'];
                $lv=$account['level'];
                if(password_verify($pass, $pw)){
                	if($lv>0){
	    				$_SESSION['username']=$user;
	                    $_SESSION['level']=$lv;
	                    header("Location: index.php");
                	}
                	else
                		$Err="Tài khoản không có quyền truy cập.";
                	
    			}
                else $Err="Mật khẩu chưa đúng.";  
            }
            else $Err="Tài khoản chưa đúng.";
        }
    }
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
						if($Err!="") echo $Err." Xin vui lòng thử lại.";
				?>
				</p>
				<button type="submit" name="log-admin">Login</button>
			</form>
			<a href="">Forgot your password?</a>
		</div>
	</body>
</html>