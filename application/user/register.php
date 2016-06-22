<?php
    include("../../header.html"); 
    include("../../banner.html");
    if(isset($_POST['reg-click'])){
        $Err=false;
        $user = $mail = $pass = "";
        if (strlen($_POST["user"])>=4 && !empty($_POST["user"]))
            $user = $_POST["user"];
        else $Err=true;
        if (strcspn($_POST["mail"],".")!=strlen($_POST["mail"]) && !empty($_POST["mail"]) && strcspn($_POST["mail"],"@")!=strlen($_POST["mail"]))
            $mail = $_POST["mail"];
        else $Err=true;
        if(strlen($_POST["pass"])>=6 && !empty($_POST["pass"]))
            $pass= $_POST["pass"];
        else $Err=true;
        if($Err) echo "<div class='notice'>Thông tin tài khoản khởi tạo chưa chính xác. Xin vui lòng thử lại.";
        else{
            $conn=connectDb();
            $sql="select * from user where username='".$user."' OR email='".$mail."'";
            $result=$conn->query($sql);
            if(mysqli_num_rows($result) >0)
                echo "<div class='notice'>Username hoặc Email đã được sử dụng. Xin vui lòng thử lại.";
            else{
                $sql2="insert into user(username,password,email) values('".$user."','".$pass."','".$mail."')";
                $result2=$conn->query($sql2);
                if($result2)
                    echo "<div class='notice'>Tạo tài khoản thành công.";
                else echo "<div class='notice'>Tạo tài khoản không thành công.";
            }
            disconnectDb($conn);
            
        } 
        echo '<a href = "javascript:history.back()" style="font-size: 20px;display:block;margin-top: 10px">Back to previous page (auto after 5s)</a>';
        echo '</div>';
        echo "<script>window.setTimeout('history.back()',5000);</script>";
    }
    else{
        echo "<div class='notice'>Có lỗi trong quá trình tạo tài khoản. Xin vui lòng thử lại.";
        echo '<a href = "javascript:history.back()" style="font-size: 20px;display:block;margin-top: 10px">Back to previous page (auto after 5s)</a>';
        echo '</div>';
        echo "<script>window.setTimeout('history.back()',5000);</script>";
    }
    include("../../footer.html");
?>