<?php 
	include_once("../application/libraries/config.php"); 

	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?php include_once("../head.html"); ?>
	</head>
	<body class="admin-page">
		<aside class="main-bar">
			<div class="sidebar">
				<div class="user-panel">
					<div class="avatar">
						<img src="<?php echo $home.'img/mem1.jpg'; ?>"/>
					</div>
					<div class="user-info">
						<span><?php echo $_SESSION['username'];?></span>
						<a href="logout.php">Logout</a>
					</div>
				</div>
				<ul class="menu-bar">
					<li class="label-header">Management</li>
					<li class="active"><a href="<?php echo $home.'admin' ?>">Home</a></li>
				    <li><a href="user/user.php">User</a></li>
				    <li><a href="user/group.php">Group</a></li>
				    <li><a href="user/function.php">Function</a></li>
				</ul>
			</div>	
		</aside>
		<div class="page-content">
			<div class="content">
				<h2>QUẢN TRỊ HỆ THỐNG</h2>				
				<div class="row">
				  <div class="col-xs-6 col-md-4 admin-banner"> 
				  	<h3>Quản trị User </h3>
				  	<div class="user-banner">
				  		<p>Nội dung</p>
				  	</div>
				  </div>
				  <div class="col-xs-6 col-md-4"> 
				  	<h3>Quản trị Group	</h3>
				  </div>
				  <div class="col-xs-6 col-md-4"> 
				  	<h3>Quản trị Function </h3>
				  </div>
				</div>
			</div>
		</div>
	</body>
</html>