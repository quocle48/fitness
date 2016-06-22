<?php echo "<a href='#' id='user' class='dropdown-toggle' data-toggle='dropdown'>".$_SESSION['username']."<b class='caret'></b></a>";
$logout=$home."application/user/logout.php";
?>
<ul class="dropdown-menu">
	<li><a href="#">Profile</a></li>
	<li><a href="#">Setting</a></li>
	<li><a href="javascript:window.location.href='<?php echo $logout; ?>'" id="logout">Logout</a></li>
</ul>
