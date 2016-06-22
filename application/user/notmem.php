<a href='javascript:void(0)' id='account'>Login or Register</a>
<div class="form-account">
	<div class="toggle-account glyphicon glyphicon-pencil">
	</div>
	<form method="post" action="<?php echo $home.'application/user/login.php'; ?>" class="login">
		<span>Login to your account</span>
		<input type="text" placeholder="Username" name="user" required/>
		<input type="password" placeholder="Password" name="pass" required/>
		<button type="submit" name='log-click'>Login</button>
	</form>
	<form method="post" action="<?php echo $home.'application/user/register.php'; ?>" class="register">
		<span>Create an account</span>
		<input type="text" placeholder="Username" name="user"  required/>
		<input type="password" placeholder="Password" name="pass"  required/>
		<input type="email" placeholder="Email Address" name="mail" required/>
		<p class="error"></p>
		<button type="submit" name="reg-click">Register</button>
	</form>
	<a href="#">Forgot your password?</a>
</div>
<script type="text/javascript">
	$('.toggle-account').click(function(){
		$(this).toggleClass('glyphicon-log-in');
		$('.form-account form').animate({
			height: "toggle",
			'padding-top': 'toggle',
			'padding-bottom': 'toggle',
			opacity: "toggle"
		  }, 400);
	});
	$('#account').click(function(){
		$('.form-account').slideToggle();
	});
	$(document).click(function(event){
		if(!$(event.target).closest('.account').length)
			$('.form-account').slideUp();
	});
</script>