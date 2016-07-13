<?php 
	include_once("../application/libraries/config.php"); 

	if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: login.php");

	$conn=connectDb();
	$conn->exec("set names utf8");
	$result1 = $conn->prepare("select * from user "); 
	$result2 = $conn->prepare("select * from `group`"); 
	$result3 = $conn->prepare("select * from function"); 
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?php include_once("../head.html"); ?>
	</head>
	<body class="admin-page">
		<aside class="main-bar">
			<div class="sidebar">
				<a href="<?php echo $home;?>admin" class="admin-home">HOME</a>
				<div class="user-panel">
					<div class="avatar">
						<img src="<?php echo $home.'img/mem1.jpg'; ?>"/>
					</div>
					<div class="user-info">
						<div><?php echo $_SESSION['username'];?></div>
						<a href="logout.php">Logout</a>
					</div>
				</div>
				<ul class="menu-bar">
					<li class="label-header">Management</li>
				    <li id="menu-user" class="has-sub">
				    	<a href="javascript:void(0)">User<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu">
				    		<li><a href="<?php echo $home;?>admin/user/user.php"><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href="<?php echo $home;?>admin/user/group.php"><span class="fa fa-angle-right"></span>Group</a></li>
				    		<li><a href="<?php echo $home;?>admin/user/function.php"><span class="fa fa-angle-right"></span>Function</a></li>
				    	</ul>
				    </li>
				    <li id="menu-post" class="has-sub">
				    	<a href="javascript:void(0)">Post<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu">
				    		<li><a href="<?php echo $home;?>admin/post"><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href=<?php echo $home;?>admin/post/type.php"><span class="fa fa-angle-right"></span>Type</a></li>
				    	</ul>
				    </li>
				    <li id="menu-product" class="has-sub">
				    	<a href="javascript:void(0)">Product<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu">
				    		<li><a href="<?php echo $home;?>admin/product"><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href="<?php echo $home;?>admin/product/category.php"><span class="fa fa-angle-right"></span>Category</a></li>
				    	</ul>
				    </li>
				    <li class="label-header">Layout</li>
				    <li>
				    	<a href="user/function.php">Themes</a>
				    </li>
				</ul>
				<script type="text/javascript">
					$('.has-sub>a').click(function(){
						if(!$(this).parent().hasClass('active')){
							$('.has-sub').removeClass('active');
							$('.has-sub .sub-menu').slideUp(300);
						}
						$(this).parent().toggleClass('active');
						$(this).next().slideToggle(300);
					});
					
				</script>
			</div>	
		</aside>
		<div class="page-content">
			<h2>QUẢN TRỊ HỆ THỐNG</h2>
			<div class="content">		
				<div class="row">
					<div class="col-xs-6 col-md-4"> 
				  		<div class="admin-banner user-banner">
				  			<div class="admin-inner">
				  				<h4>
				  					<?php 
				  						$result1->execute();
				  						echo $result1->rowCount() ;
				  					 ?>
				  				</h4>
				  				<p>User</p>
				  			</div>
				  			<div class="icon icon-admin">
				  				<i class="fa fa-user" ></i>
				  			</div>
		            		<a href="user/user.php" class="admin-box-footer" >More info <i class="fa fa-arrow-circle-right"></i></a>
				  		</div>
				  	</div>
				  	<div class="col-xs-6 col-md-4"> 
				  		<div class="admin-banner group-banner">
				  			<div class="admin-inner">
				  				<h4>
				  					<?php 
				  						$result2->execute();
				  						echo $result2->rowCount() ;
				  					 ?>
				  				</h4>
				  				<p>Group</p>
				  			</div>
				  			<div class="icon icon-admin">
				  				<i class="fa fa-users" ></i>
				  			</div>
		            		<a href="user/group.php" class="admin-box-footer" >More info <i class="fa fa-arrow-circle-right"></i></a>
				  		</div>	
					 </div>
					<div class="col-xs-6 col-md-4"> 
				  		<div class="admin-banner function-banner">
				  			<div class="admin-inner">
				  				<h4>
				  					<?php 
				  						$result3->execute();
				  						echo $result3->rowCount() ;
				  					 ?>
				  				</h4>
				  				<p>Function</p>
				  			</div>
				  			<div class="icon icon-admin">
				  				<i class="fa fa-magic" ></i>
				  			</div>
		            		<a href="user/function.php" class="admin-box-footer" >More info <i class="fa fa-arrow-circle-right"></i></a>
				  		</div>
					</div>
					<?php    
						disconnectDb($conn);
					?>
				</div>
				 
			</div>
		</div>
	</body>
</html>