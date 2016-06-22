<?php
	session_start();
    include("../../header.html"); 
    include("../../banner.html");
    if(isset($_POST['log-click'])){
        $Err=false;
        $user = $mail = $pass = "";
        if (strlen($_POST["user"])>=4 && !empty($_POST["user"]))
            $user = $_POST["user"];
        else $Err=true;
       
        if(strlen($_POST["pass"])>=6 && !empty($_POST["pass"]))
			$pass=$_POST["pass"];
        else $Err=true;
        if($Err) echo "<div class='notice'>Thông tin tài khoản khởi tạo chưa chính xác. Xin vui lòng thử lại.";
        else{
            $conn=connectDb();
            $sql="select password from user where username='".$user."' ";
            $result= $conn->query($sql);
            if( password_verify($pass, $result->fetchColumn())){
				$_SESSION["username"]=$user;
			}
                
            else{
                echo "<div class='notice'> Đăng nhập thất bại, Xin vui lòng kiểm tra lại mật khẩu! ";
            }
            disconnectDb($conn);
            
        } 
       
    }
    else{
        echo "<div class='notice'>Có lỗi trong quá trình tạo tài khoản. Xin vui lòng thử lại.";
        echo '<a href = "javascript:history.back()" style="font-size: 20px;display:block;margin-top: 10px">Back to previous page (auto after 5s)</a>';
        echo '</div>';
        echo "<script>window.setTimeout('history.back()',5000);</script>";
    }
    include("../../footer.html");
?>