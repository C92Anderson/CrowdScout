<?php 
session_start();

include('football_functions.php'); 

$scout = $_SESSION['login_user'] ;

//set variable to decline insert
$_SESSION['no_insert'] = True ;

//TOP TOP HOCKEY PLAYERS
	$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","football_all");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

		$football_topQB = $conn->query("SELECT player_name, score
				FROM `football_toplists` A
					WHERE class = 'QB'
				ORDER BY cron_ts - to_seconds(cron_ts) DESC, score DESC 
				limit 10");
		$_POST['football_topQB'] = $football_topQB ;

		$football_topRB = $conn->query("SELECT player_name, score
				FROM `football_toplists` A
					WHERE class = 'RB'
				ORDER BY cron_ts - to_seconds(cron_ts) DESC, score DESC 
				limit 10");
		$_POST['football_topRB'] = $football_topRB ;
	 
		$football_topWR = $conn->query("SELECT player_name, score
				FROM `football_toplists` A
					WHERE class = 'WR'
				ORDER BY cron_ts - to_seconds(cron_ts) DESC, score DESC 
				LIMIT 10");
		$_POST['football_topWR'] = $football_topWR ;
	
		$football_topOL = $conn->query("SELECT player_name, score
				FROM `football_toplists` A
					WHERE class = 'OL'
				ORDER BY cron_ts - to_seconds(cron_ts) DESC, score DESC
				LIMIT 10");
		$_POST['football_topOL'] = $football_topOL ;

		$football_topF7 = $conn->query("SELECT player_name, score
				FROM `football_toplists` A
					WHERE class = 'Front7'
				ORDER BY cron_ts - to_seconds(cron_ts) DESC, score DESC
				LIMIT 10");
		$_POST['football_topF7'] = $football_topF7 ;
		
		$football_top2nd = $conn->query("SELECT player_name, score
				FROM `football_toplists` A
					WHERE class = 'Secondar'
				ORDER BY cron_ts - to_seconds(cron_ts) DESC, score DESC
				LIMIT 10");
		$_POST['football_top2nd'] = $football_top2nd ;	

		$football_topKP = $conn->query("SELECT player_name, score
				FROM `football_toplists` A
					WHERE class = 'Special'
				ORDER BY cron_ts - to_seconds(cron_ts) DESC, score DESC
				LIMIT 10");
		$_POST['football_topKP'] = $football_topKP ;		

	$football_risers = $conn->query("SELECT player_name, elo2
			FROM `football_toplists` A
					WHERE class = 'RISERS'
				ORDER BY cron_ts - to_seconds(cron_ts) DESC, elo DESC
				LIMIT 10");
	$_POST['football_risers'] = $football_risers ; 

	
	$football_fallers = $conn->query("SELECT player_name, elo2
				FROM `football_toplists` A
					WHERE class = 'FALLERS'
				ORDER BY cron_ts - to_seconds(cron_ts) DESC, elo
				LIMIT 10");
	$_POST['football_fallers'] = $football_fallers ;

	$football_org_strengthF = $conn->query("SELECT class, team
			FROM  `football_org_strength` A
			    where class='OFF'
			 ORDER BY cron_ts - to_seconds(cron_ts) DESC, ORG_ELO DESC
			 LIMIT 32");
		$_POST['football_org_strengthF'] = $football_org_strengthF ;	

	$football_org_strengthD = $conn->query("SELECT class, team
			FROM  `football_org_strength` A
			    where class='DEF'
			 ORDER BY cron_ts - to_seconds(cron_ts) DESC, ORG_ELO DESC
			 LIMIT 32");
		$_POST['football_org_strengthD'] = $football_org_strengthD ;	
			
		$conn->close();

?>

<html>
	<head>
	<meta charset="UTF-8">
	<meta name="description" content="CrowdScout Football Player Ratings">
	<meta name="keywords" content="Football,Player,Ratings,Scout,Scouting">
		<title>CrowdScout Football</title>
	
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


	<div class="container">
		<div class="jumbotron">
			<h3>CrowdScout Football

				<div class="fb-share-button" data-href="http://www.crowdscoutsports.com/football_home.php" data-layout="button_count"></div>
	

				<a href="https://twitter.com/share" class="twitter-share-button" data-url="crowdscoutsports.com/football_home.php" 
				data-text="CrowdScouted Top Football Players crowdscoutsports.com/football_home.php"
				data-related="CrowdScoutSprts" data-hashtags="football" data-hashtags="rankings">Share if you disagree</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</h3>
			<br>
			<p>Welcome<?php if(isset($scout)){
						echo ' back, '.$scout.'!';
					} else {
						echo ' stranger! Please <a href="signin.php">Sign-In</a> or <a href="register.php">Register</a> now!';
					} ?> 
					<p>Help connect football fantasy to football reality.</p>
					<br>
					<p>A football team is only as good as its weakest link. Skill positions may deliver the fantasy points and capture headlines
					 but their work is predicated on the ability of those around them.  
					 <br>
					 Player performance is difficult to measure - football is extremely dynamic, often dependent on systems and assignments. If you know, love, and watch the game, then 
					 contribute to the CrowdScout community and help create a comprehensive inter-positional player rating.</p> 

					<p>Explore current rankings?
						<a class="btn btn-success btn-lg" href="https://crowdscoutsports.shinyapps.io/footballcomp2" target="_tab" role="button">Compare Players</a>
					</p>
					<p>Can you improve the rankings below? <a class="btn btn-primary btn-lg" href=<?php pairsimFB(200) ; ?> role="button">Start Scouting</a></p>
		</div>
	
	<div class="purple col-sm-8">
	<div class="row">	
		<div class="purple col-sm-4">
			<div class="panel panel-primary">

			<div class="panel-heading">Top 10 Quarterbacks<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
					$football_topQB = $_POST['football_topQB'];
					if ($football_topQB->num_rows > 0) {
						    // output data of each row
						    //$rank = 0;
						    while($row = $football_topQB->fetch_assoc()) {
							//$rank ++ ;
							echo "<li>" . $row["player_name"]. " (" . round($row["score"],0) . ")</li>";
							}
						} else {
						echo "Error:<br>I am not top 10 programmer";
					}
				?>
				</ol>	
			</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-primary">
			<div class="panel-heading">Top 10 Running Backs<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$football_topRB = $_POST['football_topRB'];
				if ($football_topRB->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $football_topRB->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (" . round($row["score"],0) . ")</li>";
						}
					} else {
					    echo "Error:<br>I am bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-primary">
			<div class="panel-heading">Top 10 Receivers<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$football_topWR = $_POST['football_topWR'];
				if ($football_topWR->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $football_topWR->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (" . round($row["score"],0) . ")</li>";
						}
					} else {
					    echo "Error:<br>I am bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>

	</div>

	<div class="row">	
		<div class="purple col-sm-4">
			<div class="panel panel-primary">

			<div class="panel-heading">Top 10 OLineman<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
					$football_topOL = $_POST['football_topOL'];
					if ($football_topOL->num_rows > 0) {
						    // output data of each row
						    //$rank = 0;
						    while($row = $football_topOL->fetch_assoc()) {
							//$rank ++ ;
							echo "<li>" . $row["player_name"]. " (" . round($row["score"],0) . ")</li>";
							}
						} else {
						echo "Error:<br>I am not top 10 programmer";
					}
				?>
				</ol>	
			</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-primary">
			<div class="panel-heading">Top 10 Front 7<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$football_topF7 = $_POST['football_topF7'];
				if ($football_topF7->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $football_topF7->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (" . round($row["score"],0) . ")</li>";
						}
					} else {
					    echo "Error:<br>I am bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-primary">
			<div class="panel-heading">Top 10 Secondary<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$football_top2nd = $_POST['football_top2nd'];
				if ($football_top2nd->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $football_top2nd->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (" . round($row["score"],0) . ")</li>";
						}
					} else {
					    echo "Error:<br>I am bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>

	</div>


	<div class="row">
		<div class="col-sm-4">
			<div class="panel panel-primary">
			<div class="panel-heading">Trending Up<br>(Last Week Elo)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$football_risers = $_POST['football_risers'];
				if ($football_risers->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $football_risers->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (+" . round($row['elo2'],1) . ")</li>";
						}
					} else {
					    echo "Error:<br>I am bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>
		
		<div class="col-sm-4">
			<div class="panel panel-primary">
			<div class="panel-heading">Trending Down<br>(Last Week Elo)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$football_fallers = $_POST['football_fallers'];
				if ($football_fallers->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $football_fallers->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (" . round($row['elo2'],1) . ")</li>";
						}
					} else {
					    echo "Error:<br>I am bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-primary">
			<div class="panel-heading">Top 10 Special Teams<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$football_topKP = $_POST['football_topKP'];
				if ($football_topKP->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $football_topKP->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (" . round($row["score"],0) . ")</li>";
						}
					} else {
					    echo "Error:<br>I am bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>
	</div>
	</div>

	<!--RIGHT HAND SIDE PANELS-->
	<div class="col-sm-2">
			<div class="panel panel-primary">
			<div class="panel-heading">Offensive Org Strength</div>
			<div class="panel-body">
				<ol>
				<?php 
				$football_org_strengthF = $_POST['football_org_strengthF'];
				if ($football_org_strengthF->num_rows > 0) {
				// output data of each row
					    //$rank = 0;
					    while($row = $football_org_strengthF->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["team"]. "</li>";
						}
					} else {
					    echo "Error:<br>I am bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>
		
		<div class="col-sm-2">
			<div class="panel panel-primary">
			<div class="panel-heading">Defensive Org Strength</div>
			<div class="panel-body">
				<ol>
				<?php 
				$football_org_strengthD = $_POST['football_org_strengthD'];
				if ($football_org_strengthD->num_rows > 0) {
				// output data of each row
					    //$rank = 0;
					    while($row = $football_org_strengthD->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["team"]. "</li>";
						}
					} else {
					    echo "Error:<br>I am bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>
</div>

		</div> <!-- /container -->
	

	<?php include('footer.php'); ?>
		
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>

