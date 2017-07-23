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
	<meta name="description" content="Player Head to Head Matchups">
	<meta name="keywords" content="Hockey,Game,Results">
		<title>Head to Head Shot Matrix</title>

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
	
		
		<h2>Head to Head Shot Matrix
					<!--facebook-->
					<div class="fb-share-button" data-href="http://www.crowdscoutsports.com/h2hshotmatrix.php" data-layout="button_count"></div>

					<!--twitter  			 data-size="large"-->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="crowdscoutsports.com/h2hshotmatrix.php" 
					data-text="Head to Head Shot Matrix: crowdscoutsports.com/h2hshotmatrix.php"  
					data-via="CrowdScoutSprts">Share
					</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		 </h2>



		 <div clas="container">
		
		<iframe src="https://crowdscoutsports.shinyapps.io/D3HeatmapsHead2Head/" style="border: none; width:100%; height:800px"></iframe>
		

		</div>
		</div>	

		<?php include('footer.php'); ?>		
		
			
	</body>
</html>