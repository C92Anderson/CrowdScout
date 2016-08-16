<?php
session_start();


	//Pull down session varaibles
	$scout = $_SESSION['login_user'] ;
	$user_id = $_SESSION['user_id'] ;
	// Create connection
	include('includes/database.php'); 


$mysqli->close();

		

 ?>




<!doctype html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta name="google-site-verification" content="Zq3wnZjPy7XD54ZlMrmn3jYlyxtGR-cY_OyRLCBCtYc" />
	<meta name="description" content="Crowd Scouting Player Rankings">
	<meta name="keywords" content="Football,Player,Rankings,Scout,Scouting">
		<title>Football Player Rankings</title>

		<?php include('header.php');?>
	
		<!-- csLogo2 (all blue font) has font of 8514oem-->
		<div class="container">
	
		</div>
	</head>
	

	<body>
		<!--facebook-->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<div class="container">
	
		
		<h2>Football Current Elo Ratings
					<!--facebook-->
					<div class="fb-share-button" data-href="http://www.crowdscoutsports.com/football_rankings.php" data-layout="button_count"></div>

					<!--twitter  			 data-size="large"-->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="crowdscoutsports.com/football_rankings.php" 
					data-text="CrowdScout Sports - if you really like sports: crowdscoutsports.com/football_rankings.php"  
					data-via="CrowdScoutSprts" data-hashtags="scouting">Share
					</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		 </h2>

		 <h3><?php if(isset($scout)){
						echo ' Thanks for contributing to these rankings, '.$scout.'! Enjoy!';
					} else {
						echo ' These rankings are based on the collective intelligence and diligence of our community. Be sure to join and contribute to help make them even more accurate and dynamic. 
						Please <a href="signin.php">Sign-In</a> or <a href="register.php">Register</a> now!';
					} ?> 
		 <h3>


		 <div clas="container">
		
		<iframe src="https://crowdscoutsports.shinyapps.io/Football_Table" style="border: none; width:100%; height:2500px;"></iframe>
		
		</div>
		</div>	

		<?php include('footer.php'); ?>		
		
			
	</body>
</html>