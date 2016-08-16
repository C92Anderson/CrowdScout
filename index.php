<?php
session_start();


	//Pull down session varaibles
	$scout = $_SESSION['login_user'] ;
	$user_id = $_SESSION['user_id'] ;
	// Create connection
	include('includes/database.php'); 
	/*
	//Pull User Information
	$sql= "SELECT member_id, user_name FROM members_v0 where user_name = '$scout'";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $id = $result->fetch_assoc();
	    $_SESSION['user_id'] = $id['member_id'];
	}*/ 
	//Calculate top scouts
	$top_hockey_scouts = $mysqli->query("SELECT `user_name`,hockey_game_count, hockey_fav_strength, hockey_bash_strength, hockey_scout_strength
										FROM `crowdscout_main`.`user_stats` as a
											INNER JOIN `crowdscout_main`.`members_v0` as b
												ON a.user_id=b.member_id
										order by hockey_scout_strength desc
										limit 20");
				
		$_POST['top_hockey_scouts'] = $top_hockey_scouts ;	 
		 
	//Calculate top scouts
	$top_football_scouts = $mysqli->query("SELECT `user_name`,football_game_count, football_fav_strength, football_bash_strength, football_scout_strength
										FROM `crowdscout_main`.`user_stats` as a
											INNER JOIN `crowdscout_main`.`members_v0` as b
												ON a.user_id=b.member_id
										order by football_scout_strength desc
										limit 20");
				
		$_POST['top_football_scouts'] = $top_football_scouts ;	 



		if ($scout_skill->num_rows > 0) {
			
			$scout_skill = $scout_skill->fetch_assoc();
				
			$k_hockey=$scout_skill['hockey_scout_strength'];
			}

$mysqli->close();

		

 ?>




<!doctype html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta name="google-site-verification" content="Zq3wnZjPy7XD54ZlMrmn3jYlyxtGR-cY_OyRLCBCtYc" />
	<meta name="description" content="Crowd Scouting Player Rankings">
	<meta name="keywords" content="Football,Hockey,Baseball,Basketball,Player,Rankings,Scout,Scouting">
		<title>CrowdScout</title>

		<?php include('header.php');?>
	
		<!-- csLogo2 (all blue font) has font of 8514oem-->
		<div class="container">
		<h2><img src="images/logo_v4.png" height="90" width="333"></h2>
		<h3>Combining Quantitative and Qualitative Analysis</h3 role="banner">
		</div>
	</head>
	

	<body>
		<div class="container">
		
		<?php if ($_GET['msg'] == 'thanks4joining'){
			echo    "<div class='jumbotron'>
					<h3>Thanks for joining $scout!</h3>
				</div>";
		} else if($_GET['msg'] == 'welcomeback'){
			echo    "<div class='jumbotron'>
					<h3>Welcome Back!</h3>
				</div>";
		}
		?>

		</br>
			<div class="jumbotron">
			<!--div class="purple col-sm-12"-->
			<!--h3>The CrowdScout Manifesto</h3-->
				<p>CrowdScout is a platform to combine qualitative (eyes) and quantitative (algos) information by aggregating user input to create a quantified player-rating system that tracks performance across time.
				<br></br>
				Sports analytics have grown tremendously in recent years - thanks to publicly scrapable data and focused, inquisitive minds - to the benefit of (rational) fans everywhere.
				However, the first generation of available data has only really lent itself to macro, team-level analysis and very specific micro, player-level analysis.
				<br><br>
				CrowdScout transforms in-depth micro analyses and educated judgments into a comprehensive player rating metric by harnessing <a href="https://en.wikipedia.org/wiki/Elo_rating_system"  target="_tab">Elo Ratings</a>
				 - generating dynamic, 'crowd-sourced' player rankings.</p>
				<!--h3>Strength in Numbers  Terras Irradient</h3>
				<p>Predictive modeling in data science relies on the use of emsemble models - a diverse array of models combined will out-perform any single model.
				Extending this method to player evaluation, CrowdScout is configured to combine quantitative and qualitative analysis to obtain a stronger, quantifiable performance metric that can be tracked over time.</p-->
				<!--p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p-->
			</div>
			
	
		<div class="col-sm-6">
			<div class="jumbotron">
			<h3>Beat the Crowd - Create Unique, Powerful Data</h3>
				<p>Join the Crowd and have your voice heard! Users or 'scouts' are encouraged to sign-up and contribute to the community.
				As the crowd grows adept scouts will have more influence over ratings, while weaker or heavily biased scouts will see their input nullified.  				
				Players that the scout champions prior to their ascent will also see their importance grow.</p>	
  			</div>
  		</div>

		<div class="purple col-sm-3">
			<div class="panel panel-default">
					<div class="panel-heading">
						 <a href="football_home.php">Top Football Scouts <br>(Scout Strength)</a>
					</div>
  					<div class="panel-body">
	  					<ol>
							<?php 
								$top_football_scouts = $_POST['top_football_scouts'];
								if ($top_football_scouts->num_rows > 0) {
									    // output data of each row
									    $rank = 0;
									    while($row = $top_football_scouts->fetch_assoc()) {
										echo "<li>" . $row['user_name'] . " (". round($row['football_scout_strength'],3).")</li>";
										}
									} else {
									echo "Error:<br>I am not a top 10 programmer";
								}
							?>
	  					</ol>
	  				</div>
	  		</div>
	  	</div>
		<div class="purple col-sm-3">
			<div class="panel panel-default">
					<div class="panel-heading">
						<a href="hockey_home.php">Top Hockey Scouts <br>(Scout Strength)</a>
					</div>
  					<div class="panel-body">
	  						<ol>
									<?php 
										$top_hockey_scouts = $_POST['top_hockey_scouts'];
										if ($top_hockey_scouts->num_rows > 0) {
											    // output data of each row
											    $rank = 0;
											    while($row = $top_hockey_scouts->fetch_assoc()) {
												echo "<li>" . $row['user_name'] . " (".round($row['hockey_scout_strength'],3).")</li>";
												}
											} else {
											echo "Error:<br>I am not a top 10 programmer";
										}
									?>
			  					</ol>
	  				</div>
	  		</div>
	  	</div>
		
	</div>

		<?php include('footer.php'); ?>
			   			

			   			 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) ->
   						 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
						<!-- Latest compiled and minified JavaScript ->
						<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
						<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
						<!--script>	
							$('#header h1').html('CrowdScout');
						</script-->
			
						
	</body>
</html>