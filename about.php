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
		<title>About CrowdScout</title>

		<?php include('header.php');?>

</head>
			<!-- csLogo2 (all blue font) has font of 8514oem-->
<body>
<div class="container">

			<!--facebook-->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

	<div  class="purple col-sm-12">
		
		<h2>About CrowdScout
					<!--facebook-->
					<div class="fb-share-button" data-href="http://www.crowdscoutsports.com/about.php" data-layout="button_count"></div>

					<!--twitter  			 data-size="large"-->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="crowdscoutsports.com/about.php" 
					data-text="CrowdScout Sports - if you really like sports: crowdscoutsports.com/about.php"  
					data-via="CrowdScoutSprts" data-hashtags="scouting">Share
					</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		 </h2>

		<h4>What is CrowdScout?
		</h4>

		<p>CrowdScout is a platform to combine qualitative (eyes) and quantitative (aglos) information by aggregating user input to create a quantified player-rating system that tracks performance across time. 
		You are helping create cool, unique data measuring player performance.</p>
		
		<h4>Why should you contribute?</h4>
		<p>Do you like sports? Watch? Opine? Great, then your opinion matters. No judgment, no arguing. Ideally be as unbiased as possible, but the diversity of opinion is critical. 
		Your scouting skill can then be calculated and you will have bragging-rights over everyone.</p>
	
	</div>

	<div class="purple col-sm-6">
    
	<h4>How does it work?</h4>
		<p>You are given 2 similar players and provided useful information - biographical and statistical (still adding those). You can select either player, abstain by declaring it too close, 
		OR admit you don't know those scrubs. By selecting 'Don't Know,' the chance you receiving either player will drop for a week.</p>
		<h4>How does this create data?</h4>
		<p>Prior to each 'game' a win probability is calculated based on their prior elo ratings using the <a href="https://en.wikipedia.org/wiki/Elo_rating_system" target="_tab">Elo formula.</a> 
		Selecting a favorite over an underdog - think Aaron Rodgers over his back-up - will give Rodgers a slight boost (and equal loss to the back-up), but selecting the back-up will result in 
		a HUGE boost to the back-up and symmetric loss to Rodgers. The post-game elo is then passed on to the next scout in ad infinitum (see grapic).</p>
		</p>

      <a href="images/elographic.PNG" class="thumbnail">
        <p><b>Algo with the underdog...</b></p>
        <img src="images/elographic.PNG" alt="elo explained" style="width:100%;">
      </a>
 	
	
	</div>

	 <div class="purple col-sm-6">
      <a href="images/comps.PNG" class="thumbnail">
        <p><b>Let's put our heads together...</b></p>
        <img src="images/comps.PNG" alt="h2h explained" style="width:100%;">
      </a>
    </div>


  <div  class="purple col-sm-12">

		<h4>So what happens if you pick the underdog?</h4>
		<p>That's cool - by selecting a heavy underdog you are mathematically contributing a good chunk of elo to that player. You will 'Champion' the 30 players you cumulatively contribute the most elo to. 
		Similarly, those you take the most elo from will end up on your 'Bashed' list. A 'Favored Team' list is also calculated for you.</p>
			
		<h4>What happens if you're an unabashed homer?</h4>
		<p>The elo scores of your 'Championed' and 'Bashed' lists are taken at various times, adjusted by the number of your games played to provide a user scouting strength (your k-factor).
		 Selecting your favorite team's rookie WR over Tom Brady will drop your scouting strength quickly, and if you continute this your future games will fail to move needle. 
		 Alternatively, by being ahead of the curve on 
		 rising or falling players, you will end up a top scout whose decision will matter a lot, so the community is harnessing the best of the crowd.
		</p>
		<h4>Can you use this data for my own analytics or fantasy?</h4>
		<p>Yes and yes. The goal is to build an engaged, diverse community of scouts influenced by the exciting world of sports analytics. 
		Users that contribute 10,000 games over the course of the season are entitled to that season's data. Skin in the game and all that.
		<br>
		During the season you can compare players relative elo ratings with a compare player tool. Or check the strength of an Oline and a Dline before starting that rookie RB in fantasy. 
		</p>
		<h4>Have you heard of fantasy sports? Those seem better.</h4>
		<p>Yes, I once saw a DraftKings&copy; commercial - seems fun. It's also stressful when your dude does all the work and the 3DRB punches it in from the 1 EVERY TIME. CrowdScout only 
		measures your ability to spot talent and stay ahead of the crowd. No Monday night garbage time points against you. 
		CrowdScout 2.0 will include an option to compete against your peers, but for now see if you can reach the top scouts list. 
		So, ya, I'll concede fantasy sports are more exciting now, but this is for the sports PURISTS. And we give linemen some love.</p>


		<!--The world of sports analytics grown tremendously in recent years - thanks to publicly scrapable data and focused, inquisitive  minds - to the benefit of (rational) fans everywhere.
				However, the first generation of available data has only really lent itself to macro, team-level analysis and very specific micro, player-level analysis.
				<br><br>
				CrowdScout transforms in-depth micro analyses and educated judgments into a comprehensive player rating metric by harnessing <a href="https://en.wikipedia.org/wiki/Elo_rating_system">Elo Ratings</a>
				 - generating dynamic, 'crowd-sourced' player rankings.</p>
				<!--h4>Strength in Numbers  Terras Irradient</h4>
				<p>Predictive modeling in data science relies on the use of emsemble models - a diverse array of models combined will out-perform any single model.
				Extending this method to player evaluation, CrowdScout is configured to combine quantitative and qualitative analysis to obtain a stronger, quantifiable performance metric that can be tracked over time.</p-->
				<!--p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p-->
	</div>
</div>

</body>
			
		<?php include('footer.php'); ?>		
						
</html>