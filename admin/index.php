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
			<h2>QUẢN TRỊ HỆ THỐNG</h2>
			<div class="content">
				<h2>QUẢN TRỊ HỆ THỐNG</h2>				
				<div class="row">
					<div class="col-xs-6 col-md-4"> 
				  		<h3>Quản trị User </h3>
				  		<div class="admin-banner user-banner">
				  			<div class="admin-inner">
				  				<h4>1050</h4>
				  				<p>User</p>
				  			</div>
				  			<div class="icon icon-admin">
				  				<i class="fa fa-user" ></i>
				  			</div>
		            		<a href="#" class="admin-box-footer" >More info <i class="fa fa-arrow-circle-right"></i></a>
		   
				  		</div>
				  		
				  		
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