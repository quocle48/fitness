<?php 
	include_once("../application/libraries/config.php"); 
	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?php include("../head.html"); ?>
	</head>
	<body>
		<h2>QUẢN TRỊ HỆ THỐNG</h2>
		<div class="sidebar col-sx-3"></div>
		<div class="admin-content"></div>
	</body>
</html>