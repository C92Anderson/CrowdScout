<?php 
session_start();

include('includes/database.php'); 
include('hockey_functions.php');


$scout = $_SESSION['login_user'] ;

//set variable to decline insert
$_SESSION['no_insert'] = True ;

//TOP TOP NHL PLAYERS
	$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","nhl_all");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$hockey_top10F = $conn->query("SELECT player_name, score
										FROM  `hockey_topcounts` A
										WHERE class =  'FWDTOP10'
										ORDER BY cron_ts - to_seconds(cron_ts) DESC , score DESC");
		$_POST['hockey_top10F'] = $hockey_top10F ;


		$hockey_topD = $conn->query("SELECT player_name, score
										FROM  `hockey_topcounts` A
										WHERE class =  'DEFTOP10'
										ORDER BY cron_ts - to_seconds(cron_ts) DESC , score DESC");
		$_POST['hockey_topD'] = $hockey_topD ;
	

		$hockey_topG = $conn->query("SELECT player_name, score
										FROM  `hockey_topcounts` A
										WHERE class =  'GLTOP10'
										ORDER BY cron_ts - to_seconds(cron_ts) DESC , score DESC");
		$_POST['hockey_topG'] = $hockey_topG ;
	

		$hockey_topU23 = $conn->query("SELECT player_name, score
										FROM  `hockey_topcounts` A
										WHERE class =  'U23TOP10'
										ORDER BY cron_ts - to_seconds(cron_ts) DESC , score DESC");
		$_POST['hockey_topU23'] = $hockey_topU23 ;
	
		$hockey_risers = $conn->query("SELECT player_name, elo2
										FROM  `hockey_topcounts` A
										WHERE class =  'RISERS'
										ORDER BY cron_ts - to_seconds(cron_ts) DESC , elo DESC");
		$_POST['hockey_risers'] = $hockey_risers ;	
		
		$hockey_fallers = $conn->query("SELECT player_name, elo2
										FROM  `hockey_topcounts` A
										WHERE class =  'FALLERS'
										ORDER BY cron_ts - to_seconds(cron_ts) DESC , elo");
		$_POST['hockey_fallers'] = $hockey_fallers ;
				

		$hockey_org_strengthF = $conn->query("SELECT list, team
									FROM  `hockey_org_strength` A
									    where list='FOR'
									 ORDER BY cron_ts - to_seconds(cron_ts) DESC, ORG_ELO DESC
									 LIMIT 30");
		$_POST['hockey_org_strengthF'] = $hockey_org_strengthF ;	

		$hockey_org_strengthD = $conn->query("SELECT list, team
									FROM  `hockey_org_strength` A
									    where list='DEF'
									 ORDER BY cron_ts - to_seconds(cron_ts) DESC, ORG_ELO DESC
									 LIMIT 30");
		$_POST['hockey_org_strengthD'] = $hockey_org_strengthD ;	
			
		$conn->close();

?>

<html>
	<head>
	<meta charset="UTF-8">
	<meta name="description" content="CrowdScout Hockey Ratings">
	<meta name="keywords" content="Hockey,Player,Rankings,Scout,Scouting">
		<title>CrowdScout Hockey</title>
	
		<?php include('header.php');?>
	
	</head>


	<body>  
	<div class="container">
		<div class="jumbotron">
			<h3>CrowdScout Hockey</h3>
			<br>
			<p>Welcome<?php if(isset($scout)){
						echo ' back, '.$scout.'!';
					} else {
						echo ' stranger! Please <a href="signin.php">Sign-In</a> or <a href="register.php">Register</a> now!';
					} ?> 
			
			<!--br>
				<blockquote>
					<p>"Stats are like a lamppost to a drunk, useful for support but not illumination."
					<br>-Brian Burke</p>
				</blockquote>
			<br-->
			<p>
			Hockey analytics have made the best out of a messy situation. The game of hockey is ferociously dynamic and extremely difficult to measure. 
				The aggregation of information - watching games and running numbers - is necessary to a comprehensive player rating system.</p> 
			<p>Can you improve the rankings below? <a class="btn btn-primary btn-lg" href=<?php pairsimHKY(200) ; ?> role="button">Start Scouting</a></p>
		</div>
	
	<div class="purple col-sm-8">
	<div class="row">	
		<div class="purple col-sm-4">
			<div class="panel panel-primary">

			<div class="panel-heading">Top 10 Forwards<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
					$hockey_top10F = $_POST['hockey_top10F'];
					if ($hockey_top10F->num_rows > 0) {
						    // output data of each row
						    //$rank = 0;
						    while($row = $hockey_top10F->fetch_assoc()) {
							//$rank ++ ;
							echo "<li>" . $row["player_name"]. " (" .round($row["score"],1) . ")</li>";
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
			<div class="panel-heading">Top 10 Defensemen<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$hockey_topD = $_POST['hockey_topD'];
				if ($hockey_topD->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $hockey_topD->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (" . round($row["score"],1) . ")</li>";
						}
					} else {
					    echo "Error:<br>I'm a bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-primary">
			<div class="panel-heading">Top 10 Goalies<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$hockey_topG = $_POST['hockey_topG'];
				if ($hockey_topG->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $hockey_topG->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (" . round($row["score"],1) . ")</li>";
						}
					} else {
					    echo "Error:<br>I'm a bottom 10 programmer";
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
				$hockey_risers = $_POST['hockey_risers'];
				if ($hockey_risers->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;	
					    while($row = $hockey_risers->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"]. " (+". round($row['elo2'] , 1) . ")</li>";
						}
					} else {
					    echo "Error:<br>I'm a bottom 10 programmer";
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
				$hockey_fallers = $_POST['hockey_fallers'];
				if ($hockey_fallers->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $hockey_fallers->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"]. " (". round($row['elo2'], 1) . ")</li>";
						}
					} else {
					    echo "Error:<br>I'm a bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-primary">
			<div class="panel-heading">Top 10 Under-23<br>CS Score (0-100)</div>
			<div class="panel-body">
				<ol>
				<?php 
				$hockey_topU23 = $_POST['hockey_topU23'];
				if ($hockey_topU23->num_rows > 0) {
					    // output data of each row
					    //$rank = 0;
					    while($row = $hockey_topU23->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["player_name"] . " (" . round($row["score"],1) . ")</li>";
						}
					} else {
					    echo "Error:<br>I'm a bottom 10 programmer";
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
			<div class="panel-heading">Offensive Strength</div>
			<div class="panel-body">
				<ol>
				<?php 
				$hockey_org_strengthF = $_POST['hockey_org_strengthF'];
				if ($hockey_org_strengthF->num_rows > 0) {
				// output data of each row
					    //$rank = 0;
					    while($row = $hockey_org_strengthF->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["team"]. "</li>";
						}
					} else {
					    echo "Error:<br>I'm a bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>
		
		<div class="col-sm-2">
			<div class="panel panel-primary">
			<div class="panel-heading">Defensive Strength</div>
			<div class="panel-body">
				<ol>
				<?php 
				$hockey_org_strengthD = $_POST['hockey_org_strengthD'];
				if ($hockey_org_strengthD->num_rows > 0) {
				// output data of each row
					    //$rank = 0;
					    while($row = $hockey_org_strengthD->fetch_assoc()) {
						//$rank ++ ;
						echo "<li>" . $row["team"]. "</li>";
						}
					} else {
					    echo "Error:<br>I'm a bottom 10 programmer";
					}
					?>
				</ol>						
			</div>
		</div>
		</div>
</div>

		</div> <!-- /container -->
	<br>
	
 	<?php include('footer.php'); ?>
		
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>

