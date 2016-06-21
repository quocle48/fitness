<?php
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
if($Err) echo "Có lỗi trong quá trình tạo tài khoản. Xin vui lòng thử lại.";
else echo "Tạo tài khoản thành công";
?>