<?php
session_start();

//Set time variables 

$year = time() + 31536000;

if($_POST['remember-me']) {
setcookie('remember_me', $_POST['user_name'], $year);
}
elseif(!$_POST['remember-me']) {
	if(isset($_COOKIE['remember_me'])) {
		$past = time() - 10;
		setcookie(remember_me, gone, $past);
	}
}

//If already logged in, back to index
if(isset($_SESSION['login_user'])){

	header("location: profile.php");

//Not already logged in
} else {
	
	include('login.php'); // Includes Login Script

}
?>

<html>
	<head>
	<meta charset="UTF-8">
	<meta name="description" content="Crowd Scouting Player Rankings">
	<meta name="keywords" content="Football,Hockey,Baseball,Basketball,Player,Rankings,Scout,Scouting">
		<title>LogIn CrowdScout</title>
		
		<?php include('header.php');?>

	</head>	
<!--Log In Form-->

<div class="container">

    <br>
 	<div class="jumbotron">
		<h3>Howdy, partner! Welcome Back!</h3>
		<p>Not Part of the Crowd?</p>
		<p><a class="btn btn-success btn-lg" href="register.php" role="button">Join Now!</a></p>

	</div>
		
    <br>
	    <div class="col-md-6 col-md-offset-3">
		<div class="card card-container">
		   <form class="form-signin" action="" method="post">
		    
			<span id="reauth-email" class="reauth-email"></span>
			<input id="name" name="user_name" placeholder="Enter User Name" type="text" id="inputEmail" class="form-control" required autofocus
				value="<?php echo $_COOKIE['remember_me']; ?>">
			<input id="password" name="password" placeholder="Enter Password" type="password" id="inputPassword" class="form-control" required>
			<div id="remember" class="checkbox">
			    <label>
				<input type="checkbox" value="remember-me"<?php if(isset($_COOKIE['remember_me'])) {
							echo 'checked="checked"';
								} else {
							echo '';
							} ?> >Remember me
			  </label>
			</div>
			<button class="btn btn-lg btn-primary btn-block btn-signin" name="submit" type="submit" value=" Login ">Sign in</button>
		    </form><!-- /form -->
		    

			    <form action="forgot.php" method="post">
			    				
						<input type="hidden" name="user_name" value="Send">
						<button class="btn btn-lg btn-default btn-block" name="pword" type="pword" value="pword">Forgot password?</button>
				</form>
			
		    
		</div><!-- /card-container -->
    	</div><!-- /card-container -->
</div><!-- /container -->
       
       <br>

	<div class="footer container" align="middle">
        	<p>&copy; CrowdScout 2015</p>
        </div>

		
   