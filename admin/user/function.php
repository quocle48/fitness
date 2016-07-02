<?php 
	include_once("../../application/libraries/config.php"); 
	//if(!isset($_SESSION['username']) || $_SESSION['level']==0) header("Location: login.php");
	if(isset($_POST["btn_addfunc"])==True){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("insert into function(name,description) values('".$_POST["txt_funcname"]."','".$_POST["txt_desc"]."')"); 
        $result->execute();
	    header('Location: function.php');
		disconnectDb($conn);
	}

	if(isset($_POST["btn_editfunc"])==True){
		$conn=connectDb();
		$conn->exec("set names utf8");
		$result = $conn->prepare("update function set name ='".$_POST["txt_funcname"]."', description='".$_POST["txt_desc"]."' where id='".$_POST['btn_editfunc']."' "); 
        $result->execute();
	    header('Location: function.php');
		disconnectDb($conn);

	}
	if(isset($_GET["delete"])){
		$conn=connectDb();
		$result = $conn->prepare("delete from function where id =".$_GET["delete"]);
		$result->execute();
		header('Location: function.php');
		disconnectDb($conn);
	}
	if(isset($_GET["btn_delete"])==True ){
		$conn=connectDb();
		$check = $_GET["checkfunc"];
		if($check!=null){
			foreach ($check as $id) {
				$result = $conn->prepare("delete from function where id =".$id."");
				$result->execute();
			}
		}
		header('Location: function.php');
		disconnectDb($conn);
	}
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<?php include_once("../../head.html"); ?>
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
				    <li id="menu-user" class="has-sub active">
				    	<a href="javascript:void(0)">User<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu" style="display:block">
				    		<li ><a href="<?php echo $home;?>admin/user/user.php"><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href="<?php echo $home;?>admin/user/group.php"><span class="fa fa-angle-right"></span>Group</a></li>
				    		<li class="active"><a href="<?php echo $home;?>admin/user/function.php"><span class="fa fa-angle-right"></span>Function</a></li>
				    	</ul>
				    </li>
				    <li id="menu-post" class="has-sub">
				    	<a href="javascript:void(0)">Post<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu">
				    		<li><a href=""><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href=""><span class="fa fa-angle-right"></span>Type</a></li>
				    	</ul>
				    </li>
				    <li id="menu-product" class="has-sub">
				    	<a href="javascript:void(0)">Product<span class="fa fa-angle-left"></span></a>
				    	<ul class="sub-menu">
				    		<li><a href=""><span class="fa fa-angle-right"></span>Infomation</a></li>
				    		<li><a href=""><span class="fa fa-angle-right"></span>Type</a></li>
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
		
		<script type="text/javascript">
			function showformadd(){
				$("#add_function").toggleClass("hide");
				if(!$("#edit_function").hasClass("hide")) $("#edit_function").addClass("hide");
			}
			function showformedit(){
				$("#edit_function").toggleClass("hide");
				if(!$("#add_function").hasClass("hide")) $("#add_function").addClass("hide");
			}
		</script>
		<div class="page-content">
		<!-- FORM THÊM -->
		<div class="content hide" id="add_function">
			<!-- Phần form thêm được ẩn -->
			<form  action ="function.php" method="post" class="form-horizontal" role="form" >
				<h3> ADD FUNCTION </h3>
				
				<div class="form-group">
					<label class="control-label col-sm-3">Function name:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control input-fit" name="txt_funcname" placeholder="Enter function name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" >Description:</label>
					<div class="col-sm-6"> 
					  	<input type="text" class="form-control input-fit" name="txt_desc" placeholder="Enter description" >
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" ></label>
					<div class="col-sm-6"> 
						<button type="submit" class="btn-fit btn-pri"  name="btn_addfunc" value ="<?php echo $row['id']; ?>" >Submit</button>
						<a href="function.php" class="btn-fit btn-dan">Cancel</a>
					</div>
				</div>
			</form>
		</div>
		<?php 
			if(isset($_GET["btn_edit"])==True){
		?>
		<div class="content" id="edit_function">
		<?php 
			$conn=connectDb();
			$conn->exec("set names utf8");
			$result = $conn->prepare("select * from function where id =".$_GET["btn_edit"].""); 
			$result->execute();
			if($result->rowCount()>0) {
				while($row=$result->fetch(PDO::FETCH_ASSOC))
			    {
		?>
					<form action ="function.php" method="post" class="form-horizontal " role="form" >
						<h3> EDIT FUNCTION </h3>
						<div class="form-group">
							<label class="control-label col-sm-3">Function name:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control input-fit" name="txt_funcname" value="<?php echo $row['name']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" >Description:</label>
							<div class="col-sm-6"> 
							  	<input type="text" class="form-control input-fit" name="txt_desc" value="<?php echo $row['description']; ?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" ></label>
							<div class="col-sm-6"> 
								<button type="submit" class="btn-fit btn-pri"  name="btn_editfunc" value ="<?php echo $row['id']; ?>" >Submit
								</button>
								<a href="function.php" class="btn-fit btn-dan">Cancel</a>
							</div> 	
							
						</div>
					</form>
			<?php
				}
			}
			disconnectDb($conn);
			echo "</div>";
			}
		 ?>
		<div class="content">
			<h3>LIST FUNCTION </h3>
				<form action="function.php" method="GET">
				<table class="table table-hover ">
				    	<thead>
							<tr>
								<th>
									<div class="btn-group">
										<button type="button" class="btn-fit btn-inf" onclick="showformadd()">
											<span class="fa fa-plus-square"></span>
										</button>
										<button type="submit" name ="btn_delete" class="btn-fit btn-dan" onclick="javascript: return confirm('Bạn muốn xóa function này?');">
											<span class="fa fa-trash-o"></span>
										</button>  	
									</div>
								</th>

								<th>ID</th>
								<th>FUNCTION NAME</th>
								<th>DESCRIPTION</th>
								<th> ACTION	</th>	
							</tr>
						</thead>
						<tbody>
							<?php
								$conn=connectDb();
								$conn->exec("set names utf8");
								$result = $conn->prepare("select * from function"); 
					            $result->execute();
					          
								if($result->rowCount()>0)
						    	{
						            while($row=$result->fetch(PDO::FETCH_ASSOC))
						            {
						            	echo '<td> <input  name="checkfunc[]" type="checkbox" style="text-align: center;" value="'.$row['id'].'"> </td>';
										echo "<td>$row[id]</td>";
										echo "<td>$row[name]</td>";
										echo "<td>$row[description]</td>";
										echo '<td><div class="btn-group"><button type="submit" class="btn-fit btn-inf" name="btn_edit" value="'.$row['id'].'" formaction="function.php"><span class="fa fa-pencil-square-o"></span></button>';
										echo '<button type="submit" class="btn-fit btn-dan" name="delete" onclick="javascript: return confirm(\'Bạn muốn xóa function này?\');" value="'.$row['id'].'" formaction="function.php"><span class="fa fa-trash"></span></button></div></td>';	

										echo '</tr>';
		   
						            }
							    }
							    else
							        echo "<div class='notice'>No data!</div>";
								disconnectDb($conn);
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
		
	</body>
</html>