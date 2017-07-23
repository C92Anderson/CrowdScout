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
	<meta name="keywords" content="Football,Hockey,Baseball,Basketball,Player,Rankings,Scout,Scouting">
		<title>Goalie Compare Tool</title>

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
	
		
		<h2>Hockey Goalie Compare Tool
					<!--facebook-->
					<div class="fb-share-button" data-href="http://www.crowdscoutsports.com/hockey_g_compare.php" data-layout="button_count"></div>

					<!--twitter  			 data-size="large"-->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="crowdscoutsports.com/hockey_g_compare.php" 
					data-text="NHL Player Compare app, using expected goals, player vs team without player crowdscoutsports.com/hockey_g_compare.php"  
					data-via="CrowdScoutSprts" data-hashtags="scouting">Share
					</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		 </h2>
<a class="btn btn-success btn-lg" href="goalie_data_download.php">Download Goalie Hockey Data</a>
</div>

		 <div>
				<!--p>Warning: App may be down due to server usage limits. Please use 'Player Search' in toolbar for single player statistic or request from @crowdscoutsprts on Twitter. Thanks for the patience!</p-->

		<iframe src="https://crowdscoutsports2.shinyapps.io/GoalieCompare" style="border: none; width:100%; height:2050px"></iframe>
		

		</div>
		

		<?php include('footer.php'); ?>		
		
			
	</body>
</html>