<?php
    include_once("../libraries/config.php");
    if(isset($_POST['log-click'])){
        $Err="";
        $user = $mail = $pass = "";
        if (strlen($_POST["user"])>=4 && !empty($_POST["user"]))
            $user = $_POST["user"];
        else $Err="Tài khoản";
        if(strlen($_POST["pass"])>=6 && !empty($_POST["pass"]))
			$pass=$_POST["pass"];
        else $Err="Mật khẩu";
        if($Err=="")
        {
            $conn=connectDb();
            $stmt = $conn->prepare("SELECT password,level FROM user where username='".$user."' "); 
            $stmt->execute();
            $result = $stmt->fetchAll();
            if(count($result)>0){
                $account=$result[0];
                $p=$account['password'];
                if(password_verify($pass, $p)){
    				$_SESSION['username']=$user;
                    $_SESSION['level']=$account['level'];
    			}
                else $Err="Mật khẩu";  
            }
            else $Err="Tài khoản"; 
            disconnectDb($conn);
        }
        include("../../header.html"); 
        include("../../banner.html");
        if($Err!="") echo "<div class='notice'>".$Err." không chính xác. Xin vui lòng thử lại! ";
        else echo "<div class='notice'> Đăng nhập thành công. ";
        echo '<a href = "javascript:history.back()" style="font-size: 20px;display:block;margin-top: 10px">Back to previous page (auto after 3s)</a>';
        echo '</div>';
        echo "<script>window.setTimeout('history.back()',3000);</script>";
       
    }
    else{
        include("../../header.html"); 
        include("../../banner.html");
        echo "<div class='notice'>Có lỗi trong quá trình tạo tài khoản. Xin vui lòng thử lại.";
        echo '<a href = "javascript:history.back()" style="font-size: 20px;display:block;margin-top: 10px">Back to previous page (auto after 3s)</a>';
        echo '</div>';
        echo "<script>window.setTimeout('history.back()',3000);</script>";
    }
    include("../../footer.html");
?>