<!DOCTYPE html>
<?php 
	$user_id = $_SESSION['user_id'] ;
	$getid = $user_id + 12000 ;




//require_once 'openid.php';
//$openid = new LightOpenID("crowdscoutsports.com");

//$openid->identity = 'https://www.google.com/accounts/o8/id';
//$openid->required = array(
 // 'namePerson/first',
  //'namePerson/last',
  //'contact/email',
//);
//$openid->returnUrl = 'http://crowdscoutsports/logauto.php'

?>


<html>

<link rel="icon" type="image/png" href="images/logo_sm_v4.ico" sizes="32x32" />
<!--link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />

	
<!-- Latest compiled and minified CSS - Responsive and Mobile Friendly-->
<!--link href="../css/main.css" rel="stylesheet"-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> 
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!--link href="../css-responsive/bootstrap-responsive.css" rel="stylesheet">
<link href="../css-responsive/bootstrap-responsive.min.css" rel="stylesheet"-->

		
<div class="container">	
	<header class="navbar-primary" role="banner">
		<nav class="navbar navbar-default" role="navigation">
	  		<!--div class="container-fluid">
	    			<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">  
					
					<a class="navbar-brand" href="index.php">
						<img src="images/logo_v4.png" height="30" width="111">
					</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	  			   		<span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					 </button>
				</div>
	
				<!-- Collect the nav links, forms, and other content for toggling--> 				  
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"  style="height: 12px;">
					<!--Left navigation bar-->
					<ul class="nav navbar-nav navbar-left">

						<li>
							<div class="dropdown navbar-left">
							  <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							    Sport
							    <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							    <li><a class="btn btn-default btn-lg" href="football_home.php">Football Home</a></li>
							    <li><a class="btn btn-default btn-lg" href="hockey_home.php">Hockey Home</a></li>
							  </ul>
							</div>
						</li>

						<li>
							<div class="dropdown navbar-left">
							  <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							    Scout Now
							    <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
							    <li><a class="btn btn-default btn-lg" href=<?php
							    	include_once('football_functions.php'); 		
							    	pairsimFB(200) ; 
							    ?>  >Scout Football</a></li>
							    <li><a class="btn btn-default btn-lg" href=<?php
							      	include_once('hockey_functions.php');
							  		pairsimHKY(200) ; 
							  	?> >Scout Hockey</a></li>
							  </ul>
							</div>
						</li>
						
						<li>
							<div class="dropdown navbar-left">
							  <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							    View Rankings
							    <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
							    <li><a class="btn btn-default btn-lg" href="football_p_compare.php">Football Compare Tool</a></li>
							    <li><a class="btn btn-default btn-lg" href="hockey_p_compare.php">Hockey Compare Tool</a></li>
							    <li role="separator" class="divider"></li>
								<li><a class="btn btn-default btn-lg" href="football_rankings.php">Current Football Rankings</a></li>
							    <li><a class="btn btn-default btn-lg" href="hockey_rankings.php">Current Hockey Rankings</a></li>
							  </ul>
							</div>
						</li>

					</ul>
					<!--Right navigation bar-->
					 <ul class="nav navbar-nav navbar-right">
					 	<li>
					 	 <a class="btn btn-default btn-lg" href="game-theory/">Game Theory Blog</a></li>
						
					 	 <li><a href="about.php">About</a></li>
				
						<?php 
							if(isset($scout)){
							echo "<li class='active'><a href='profile.php?scout=" . $getid . "'>". $scout . "'s Scouting HQ<span class='sr-only'>(current)</span></a></li>" ;  
							echo '<li><a href="logout.php">LogOut</a></li>' ;  
							//echo '<button type="button" class="btn btn-default navbar-btn">LogOut</button>' ;  
							} else {
							echo '<li class="active"><a href="register.php">Register<span class="sr-only">(current)</span></a></li>' ; 
							echo '<li><a href="signin.php">SignIn</a></li>' ; 
						}?>
					</ul>
				</div>

				<!--Compare Players Tool-->
								
			
					
		</nav>
	</header>
</div>



</html>