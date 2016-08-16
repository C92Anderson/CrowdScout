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
	<meta name="description" content="CrowdScout Game Theory Blog">
	<meta name="keywords" content="Football,Hockey,Baseball,Basketball,Player,Rankings,Game,Theory,Blog">
		<title>Game Theory Blog</title>

		<?php include('header.php');?>
	
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

		 <!--div clas="container">
	
		
		<h2>Game Theory Blog
					<div class="fb-share-button" data-href="http://crowdscoutsports.blogspot.com" data-layout="button_count"></div>

					<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://crowdscoutsports.blogspot.com" 
					data-text="CrowdScout Sports - Game Theory Blog: http://crowdscoutsports.blogspot.com"  
					data-via="CrowdScoutSprts">Share
					</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		 </h2>

		 </div-->

		<div class="container">
		
		<iframe src="http://crowdscoutsports.blogspot.com" style="border: none; width:100%; height:700px"></iframe>
		
		</div>	

		<?php include('footer.php'); ?>		
		
			
	</body>
</html>