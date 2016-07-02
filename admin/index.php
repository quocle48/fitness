<?php 
	include_once("../application/libraries/config.php"); 

	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="">
	<head>
		
	</head>
	<body>
		<?php include("../head.html"); ?>
		<aside class="menu-bar">
			<ul class="nav nav-pills nav-stacked">

			    <li class="active"><a href="#">Home</a></li>
			    <li><a href="user/user.php">User</a></li>
			    <li><a href="#">Group</a></li>
			    <li><a href="function/function.php">Function</a></li>
			    <li><a href="logout.php">Logout</a></li>
			  </ul>
		</aside>
		<div class="page-content">
			<h2>QUẢN TRỊ HỆ THỐNG</h2>
			
			<div class="content">
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