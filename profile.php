<?php
session_start();

$scout = $_SESSION['login_user'] ;
$user_id = $_SESSION['user_id'] ;

	if (isset($_GET['scout'])) {
		$_POST['getid'] = $_GET['scout'] ; 
		$getid = $_POST['getid'] - 12000 ;

	} else {
		$getid = $user_id ;
	}


//Grab user profile
	$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","crowdscout_main");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 


////////////////////////////////////////////
	$user_profile = "select *
				from members_v0 
				where member_id = $getid";
		 
		$user_profile = $conn->query($user_profile);
		
		if ($user_profile->num_rows > 0) {
		$user_profile = $user_profile->fetch_assoc();	
		
		$user_name = $user_profile['user_name'];
		$email = $user_profile['email'];
		$city = $user_profile['city'];
		$state = $user_profile['state'];
		$country = $user_profile['country'];
		$zip = $user_profile['zip'];
		}
	 
	$conn->close();
 
//////////HOCKEY
	$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "xxxx!","crowdscout_main");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 


	$user_stats = $conn->query("SELECT * 
								FROM `crowdscout_main`.`user_stats`
								where user_id = $getid") or die($conn->error.__LINE__);

		if ($user_stats->num_rows > 0) {
					$user_stats = $user_stats->fetch_assoc();	
			

					$_POST['hockey_game_count'] = $user_stats['hockey_game_count'] ;
					$_POST['football_game_count'] = $user_stats['football_game_count'] ;

					$_POST['hockey_fav_strength'] = $user_stats['hockey_fav_strength'] ;
					$_POST['football_fav_strength'] = $user_stats['football_fav_strength'] ;
					$_POST['hockey_bash_strength'] = $user_stats['hockey_bash_strength'] ;
					$_POST['football_bash_strength'] = $user_stats['football_bash_strength'] ;	
	
					$_POST['hockey_scout_strength'] = $user_stats['hockey_scout_strength'] ;
					$_POST['football_scout_strength'] = $user_stats['football_scout_strength'] ;	

				}

	//user rank of NHL teams
	$Quser_nhl_ranks = "SELECT *
							FROM `crowdscout_main`.`user_team_ranks`
							WHERE user_id = $getid
								AND sport = 'hockey'
								ORDER BY team_elo_mean desc";

	$user_nhl_ranks = $conn->query($Quser_nhl_ranks) or die($conn->error.__LINE__);
	$user_nhl_ranks2 = $conn->query($Quser_nhl_ranks) or die($conn->error.__LINE__);
  
	$_POST['user_nhl_ranks'] = $user_nhl_ranks ;
	$_POST['user_nhl_ranks2'] = $user_nhl_ranks2 ;
	
	//user favorite players
	$Quser_hockey_favs = "SELECT player_name, sum(ELO_DIFF) as ELO_DIFF, max(last_game) as last_game
			FROM  
			((select player_name, sum( `curr_elo_1` - `prior_elo_1` ) as ELO_DIFF, max(game_ts) as last_game
			FROM `nhl_all`.`hockey_games_v1` as a
			LEFT JOIN `nhl_all`.`hockey_roster_v1` as b
			ON a.player_id1 = b.nhl_id
			GROUP BY 1) 
			UNION ALL
			(select player_name, sum( `curr_elo_2` - `prior_elo_2` ) as ELO_DIFF, max(game_ts) as last_game 
			FROM `nhl_all`.`hockey_games_v1` as c
			LEFT JOIN `nhl_all`.`hockey_roster_v1` as d
			ON c.player_id2 = d.nhl_id
			WHERE user_id = $getid
			GROUP BY 1)) as x
			where player_name <> ''
			Group by player_name
			order by elo_diff desc, last_game desc
			limit 30" ;
	$user_hockey_favs = $conn->query($Quser_hockey_favs) or die($conn->error.__LINE__);
	$user_hockey_favs2 = $conn->query($Quser_hockey_favs) or die($conn->error.__LINE__);
	$_POST['user_hockey_favs'] = $user_hockey_favs ;
	$_POST['user_hockey_favs2'] = $user_hockey_favs2 ;

	//user favorite players
	$Quser_hockey_hated = "SELECT player_name, last_game, sum(ELO_DIFF) as ELO_DIFF, max(last_game) as last_game
			FROM  
			((select player_name, sum( `curr_elo_1` - `prior_elo_1` ) as ELO_DIFF, max(game_ts) as last_game
			FROM `nhl_all`.`hockey_games_v1` as a
			LEFT JOIN `nhl_all`.`hockey_roster_v1` as b
			ON a.player_id1 = b.nhl_id
			WHERE user_id = $getid
			GROUP BY 1) 
			UNION ALL
			(select player_name, sum( `curr_elo_2` - `prior_elo_2` ) as ELO_DIFF, max(game_ts) as last_game 
			FROM `nhl_all`.`hockey_games_v1` as c
			LEFT JOIN `nhl_all`.`hockey_roster_v1` as d
			ON c.player_id2 = d.nhl_id
			WHERE user_id = $getid
			GROUP BY 1)) as x
			where player_name <> ''
			Group by player_name
			order by elo_diff asc, last_game desc
			limit 30";

	$user_hockey_hated = $conn->query($Quser_hockey_hated) or die($conn->error.__LINE__);
	$user_hockey_hated2 = $conn->query($Quser_hockey_hated) or die($conn->error.__LINE__);
	$_POST['user_hockey_hated'] = $user_hockey_hated ;
	$_POST['user_hockey_hated2'] = $user_hockey_hated2 ;
	
	$conn->close();

	///////////////////FOOTBALL
	$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","football_all");

	//user rank of football teams	
	$Quser_football_ranks = "SELECT *
							FROM `crowdscout_main`.`user_team_ranks`
							WHERE user_id = $getid
								AND sport = 'football'
								ORDER BY team_elo_mean desc";
	$user_football_ranks = $conn->query($Quser_football_ranks) or die($conn->error.__LINE__);
	$user_football_ranks2 = $conn->query($Quser_football_ranks) or die($conn->error.__LINE__);
  
		$_POST['user_football_ranks'] = $user_football_ranks ;	
		$_POST['user_football_ranks2'] = $user_football_ranks2 ;	

	//user favorite players
		$Quser_football_favs = "SELECT player_name, last_game, sum(ELO_DIFF) as ELO_DIFF
			FROM  
			((select player_name, sum( `curr_elo_1` - `prior_elo_1` ) as ELO_DIFF, max(game_ts) as last_game
			FROM `football_all`.`football_games_v1` as a
			LEFT JOIN `football_all`.`football_roster_v1` as b
			ON a.player_id1 = b.cs_id
			WHERE user_id = $getid
			GROUP BY 1) 
			UNION ALL
			(select player_name, sum( `curr_elo_2` - `prior_elo_2` ) as ELO_DIFF, max(game_ts) as last_game 
			FROM `football_all`.`football_games_v1` as c
			LEFT JOIN `football_all`.`football_roster_v1` as d
			ON c.player_id2 = d.cs_id
			WHERE user_id = $getid
			GROUP BY 1)) as x
			where player_name <> ''
			Group by player_name
			order by elo_diff desc, last_game desc
			limit 30"; 
		$user_football_favs = $conn->query($Quser_football_favs) or die($conn->error.__LINE__);
		$user_football_favs2 = $conn->query($Quser_football_favs) or die($conn->error.__LINE__);
		$_POST['user_football_favs'] = $user_football_favs ;
		$_POST['user_football_favs2'] = $user_football_favs2 ;
	
	//user favorite players
	$Quser_football_hated = "SELECT player_name, last_game, sum(ELO_DIFF) as ELO_DIFF
			FROM  
			((select player_name, sum( `curr_elo_1` - `prior_elo_1` ) as ELO_DIFF, max(game_ts) as last_game
			FROM `football_all`.`football_games_v1` as a
			LEFT JOIN `football_all`.`football_roster_v1` as b
			ON a.player_id1 = b.cs_id
			WHERE user_id = $getid
			GROUP BY 1) 
			UNION ALL
			(select player_name, sum( `curr_elo_2` - `prior_elo_2` ) as ELO_DIFF, max(game_ts) as last_game 
			FROM `football_all`.`football_games_v1` as c
			LEFT JOIN `football_all`.`football_roster_v1` as d
			ON c.player_id2 = d.cs_id
			WHERE user_id = $getid
			GROUP BY 1)) as x
			where player_name <> ''
			Group by player_name
			order by elo_diff asc, last_game desc
			limit 30";
	$user_football_hated = $conn->query($Quser_football_hated) or die($conn->error.__LINE__);
	$user_football_hated2 = $conn->query($Quser_football_hated) or die($conn->error.__LINE__);
	$_POST['user_football_hated'] = $user_football_hated ;
	$_POST['user_football_hated2'] = $user_football_hated2 ;

	$conn->close();

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","crowdscout_main");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=$conn->query("select user_name from members_v0 where user_name='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['user_name'];

//if NOT login_user (from login page, rather than register page) 
if(!isset($login_user)){
$conn->close(); // Closing Connection
//header('Location: index.php'); // Redirecting To Home Page
} 
?>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Crowd Scout Player Ratings">
		<meta name="keywords" content="Player,Ratings,Rankings,Scout,Scouting">
		<title>My CrowdScout HQ</title>
	
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
			<p><?php if(isset($thanks4joining)){
					echo "Welcome ".$user_name."! Thanks for joining! Now let's get down to business. Select a sport...";
				} else {
					echo "Welcome to " . $user_name . "'s Scouting HQ! Scout a sport below...";
				}
				?>
			</p>
		
			<br>		

			<div class="row">
				<div class="col-lg-6"><a href="football_home.php"><button class="btn btn-primary btn-lg btn-block">Football Home</button></a></div>		
				<div class="col-lg-6"><a href="hockey_home.php"><button class="btn btn-primary btn-lg btn-block">Hockey Home</button></a></div>		
			</div>
			<div class="row">
				<div class="col-lg-6"><a href=<?php
							      	include_once('football_functions.php');
							  		pairsimFB(200) ; 
							  	?>><button class="btn btn-default btn-lg btn-block">Scout Football</button></a></div>		
				<div class="col-lg-6"><a href=<?php
							      	include_once('hockey_functions.php');
							  		pairsimHKY(200) ; 
							  	?>><button class="btn btn-default btn-lg btn-block">Scout Hockey</button></a></div>			
			</div>
			<div class="row">
				<div class="col-lg-6"><a href="football_rankings.php"><button class="btn btn-primary btn-lg btn-block">Current Football Rankings</button></a></div>		
				<div class="col-lg-6"><a href="hockey_rankings.php"><button class="btn btn-primary btn-lg btn-block">Current Hockey Rankings</button></a></div>		
			</div>

			<div class="row">
				<div class="col-lg-6"><a href="football_p_compare.php"><button class="btn btn-default btn-lg btn-block">Football Player Compare</button></a></div>		
				<div class="col-lg-6"><a href="hockey_p_compare.php"><button class="btn btn-default btn-lg btn-block">Hockey Player Compare</button></a></div>		
			</div>
		</div>
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">	
					<h4><?php echo $user_name.' Statistics';?>
						
					<!--facebook-->
					<div class="fb-share-button" data-href="http://www.crowdscoutsports.com/profile.php?scout=<?php echo $_POST['getid'] ;?>" data-layout="button_count"></div>

					<!--twitter  			 data-size="large"-->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="crowdscoutsports.com/profile.php?scout=<?php echo $_POST['getid'] ;?>" 
					data-text="Showing off my sports knowledge on CrowdScout Sports: crowdscoutsports.com/profile.php?scout=<?php echo $_POST['getid'] ;?>"  
					data-via="CrowdScoutSprts" data-hashtags="scouting">Share Scouting HQ 
					</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</h4>
				</div>

				<div class="purple col-sm-6">
					<table class="table table-striped">
							<thead>
								<tr>
								<a href="#collapsefootball">
									<button class="btn btn-primary btn-lg btn-block" type="button" data-toggle="collapse" data-target="#collapsefootball" aria-expanded="false" aria-controls="collapsefootball">
											Football (Expand My Indicies Below)
									</button>
								</a>
								</tr>
							</thead>
		  					
		  					<tbody>
								<tr>
									<td>
										<h4><b>Scout Strength <br>(Games Played):</b></h4>
									</td>
			  						<td><?php if(isset($_POST['football_scout_strength']) && isset($_POST['football_game_count'])) {
			  								echo "<h4><span class='label label-info'>" . round($_POST['football_scout_strength'],3) . "</span></h4>(" . $_POST['football_game_count'] . ")";
			  								} else {
			  								echo 'No games' ;
			  								}	
			  								?>
			  								</td>
			  					</tr>

		  						<tr>
		  							<td>
										<h4><b>Favored Teams:</b></h4>
									</td>
									<td>
											<?php
												$user_football_ranks = $_POST['user_football_ranks'];
											 	if ($user_football_ranks->num_rows > 0) {
											 		
											 		$order = 0 ;
												    // output data of each row
											 	    while( ( $row = $user_football_ranks->fetch_assoc() ) && ( $order < 3) ) {

											 	    $order ++ ;		
													 echo $order . ") ". $row['team'] . "<br>";
												}
												} else { echo "Start scouting and I'll tell ya..";}
											?>
									</td>
		  						</tr>

		  						<tr>
		  							<td>
										<h4><b>Championed Players:</b></h4>
										<h5><?php if(isset($_POST['football_fav_strength'])) {
			  									echo "(" . round($_POST['football_fav_strength'],2) . " Mean Elo)" ;
			  								} 	
			  								?></h5>
									</td>
									<td>
										<?php
												$user_football_favs = $_POST['user_football_favs'];
											 	if ($user_football_favs->num_rows > 0) {
											 		
											 		$order = 0 ;
												    // output data of each row
											 	    while( ( $row = $user_football_favs->fetch_assoc() ) && ( $order < 3) ) {

											 	    $order ++ ;		
													 echo $order . ") ". $row['player_name'] . "<br>";
												}
												} else { echo "Start scouting and I'll tell ya..";}
											?>
									</td>
		  						</tr>
		  						<tr>
		  							<td>
										<h4><b>Bashed Players:</b></h4>
										<h5><?php if(isset($_POST['football_bash_strength'])) {
			  									echo "(" . round($_POST['football_bash_strength'],2) . " Mean Elo)" ;
			  								} 	
			  								?></h5>
									</td>
									<td>
										<?php
										$user_football_hated = $_POST['user_football_hated'];
									 	if ($user_football_hated->num_rows > 0) {
									 		
									 		$order = 0 ;
										    // output data of each row
									 	    while( ( $row = $user_football_hated->fetch_assoc() ) && ( $order < 3) ) {

									 	    $order ++ ;		
											 echo $order . ") ". $row['player_name'] . "<br>";
										}
										} else { echo "Start scouting and I'll tell ya..";}
										?>
									</td>
		  						</tr>
					  		</tbody>
					  	</table>
		  			</div>

				<div class="purple col-sm-6">
					<table class="table table-striped">
							<thead>
								<tr>
									<a href="#collapsehockey">
									<button class="btn btn-default btn-lg btn-block" type="button" data-toggle="collapse" data-target="#collapsehockey" aria-expanded="false" aria-controls="collapsehockey">
											Hockey (Expand My Indicies Below)
									</button>
									</a>
								</tr>
							</thead>
		  					
		  					<tbody>
		<tr>
									<td>
										<h4><b>Scout Strength <br>(Games Played):</b></h4>
									</td>
			  						<td><?php if(isset($_POST['hockey_scout_strength']) && isset($_POST['hockey_game_count'])) {
			  								echo  "<h4><span class='label label-info'>" . round($_POST['hockey_scout_strength'],3) . "</span></h4>(" . $_POST['hockey_game_count'] . ")";
			  								} else {
			  								echo 'No games' ;
			  								}	
			  								?>
			  								</td>
			  					</tr>

		  						<tr>
		  							<td>
										<h4><b>Favored Teams:</b></h4>
									</td>
									<td>
									<?php
										$user_nhl_ranks = $_POST['user_nhl_ranks'];
									 	if ($user_nhl_ranks->num_rows > 0) {
									 		
									 		$order = 0 ;
										    // output data of each row
									 	    while( ( $row = $user_nhl_ranks->fetch_assoc() ) && ( $order < 3) ) {

									 	    $order ++ ;		
											 echo $order . ") ". $row['team'] . "<br>";
										}
										} else { echo "Start scouting and I'll tell ya..";}
									?>
									</td>
		  						</tr>

		  						<tr>
		  							<td>
										<h4><b>Championed Players:</b></h4>
										<h5><?php if(isset($_POST['hockey_fav_strength'])) {
			  									echo "(" . round($_POST['hockey_fav_strength'],2) . " Mean Elo)" ;
			  								} 	
			  								?></h5>
									</td>
									<td>
									<?php
										$user_hockey_favs = $_POST['user_hockey_favs'];
									 	if ($user_hockey_favs->num_rows > 0) {
									 		
									 		$order = 0 ;
										    // output data of each row
									 	    while( ( $row = $user_hockey_favs->fetch_assoc() ) && ( $order < 3) ) {

									 	    $order ++ ;		
											 echo $order . ") ". $row['player_name'] ."<br>";
										}
										} else { echo "Start scouting and I'll tell ya..";}
									?>
									</td>
		  						</tr>
		  						<tr>
		  							<td>
									<h4><b>Bash Players:</b></h4>
										<h5><?php if(isset($_POST['hockey_bash_strength'])) {
			  									echo "(" . round($_POST['hockey_bash_strength'],2) . " Mean Elo)";
			  								} 	
			  								?></h5>
									</td>
									<td>
									<?php
										$user_hockey_hated = $_POST['user_hockey_hated'];
									 	if ($user_hockey_hated->num_rows > 0) {
									 		
									 		$order = 0 ;
										    // output data of each row
									 	    while( ( $row = $user_hockey_hated->fetch_assoc() ) && ( $order < 3) ) {

									 	    $order ++ ;		
											 echo $order . ") ". $row['player_name'] ."<br>";
										}
										} else { echo "Start scouting and I'll tell ya..";}
									?>
									</td>
		  						</tr>
					  		</tbody>
					  	</table>
		  			</div>
			</div>
		</div>
	
		

		
<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">	
					<tr>
					<h4><?php echo $user_name. 's Expanded Indices';?></h4>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapsefootball" aria-expanded="false" aria-controls="collapsefootball">
						Show Football
					</button>
					<button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapsehockey" aria-expanded="false" aria-controls="collapsehockey">
						Show Hockey
					</button>
					</tr>
				</div>
	
			</div>

	<!----------------------HOCKEY------------------------>
	<div class="collapse container-fluid" id="collapsehockey">
	  <div class="well">
			
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">Favored Hockey Teams</div>
				<div class="panel-body">
					<ol>
					<?php 
					$user_nhl_ranks = $_POST['user_nhl_ranks2'];
					if ($user_nhl_ranks->num_rows > 0) {
						    // output data of each row
						    //$rank = 0;
						    while($row = $user_nhl_ranks->fetch_assoc()) {
							//$rank ++ ;
							echo "<li>" . $row["team"]. "</li>";
							}
						} else {
						    echo "Start scouting and I'll tell ya..";
						}
						?>
					</ol>	
				
				</div>
  			</div>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">Championed Hockey Players</div>
				<div class="panel-body">
					<ol>
					<?php 
					$user_hockey_favs2  = $_POST['user_hockey_favs2'];
					if ($user_hockey_favs2->num_rows > 0) {
						    // output data of each row
						    //$rank = 0;
						    while($row = $user_hockey_favs2->fetch_assoc()) {
							//$rank ++ ;
							echo "<li>" . $row["player_name"]. "</li>";
							}
						} else {
						    echo "Start scouting and I'll tell ya..";
						}
						?>
					</ol>	
				
				</div>
  			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">Bashed Hockey Players</div>
				<div class="panel-body">
					<ol>
					<?php 
					$user_hockey_hated2  = $_POST['user_hockey_hated2'];
					if ($user_hockey_hated2->num_rows > 0) {
						    // output data of each row
						    //$rank = 0;
						    while($row = $user_hockey_hated2->fetch_assoc()) {
							//$rank ++ ;
							echo "<li>" . $row["player_name"]. "</li>";
							}
						} else {
						    echo "Start scouting and I'll tell ya..";
						}
						?>
					</ol>	
				
				</div>
  			</div>
		</div>
	</div>
	</div>

	<!----------------------FOOTBAL------------------------>
	<div class="collapse container-fluid" id="collapsefootball">
	  <div class="well">
			
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">Favored Football Teams</div>
				<div class="panel-body">
					<ol>
					<?php 
					$user_football_ranks2 = $_POST['user_football_ranks2'];
					if ($user_football_ranks2->num_rows > 0) {
						    // output data of each row
						    //$rank = 0;
						    while($row = $user_football_ranks2->fetch_assoc()) {
							//$rank ++ ;
							echo "<li>" . $row["team"]. "</li>";
							}
						} else {
						    echo "Start scouting and I'll tell ya..";
						}
						?>
					</ol>	
				
				</div>
  			</div>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">Championed Football Players</div>
				<div class="panel-body">
					<ol>
					<?php 
					$user_football_favs2  = $_POST['user_football_favs2'];
					if ($user_football_favs2->num_rows > 0) {
						    // output data of each row
						    //$rank = 0;
						    while($row = $user_football_favs2->fetch_assoc()) {
							//$rank ++ ;
							echo "<li>" . $row["player_name"]. "</li>";
							}
						} else {
						    echo "Start scouting and I'll tell ya..";
						}
						?>
					</ol>	
				
				</div>
  			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading">Bashed Football Players</div>
				<div class="panel-body">
					<ol>
					<?php 
					$user_football_hated2  = $_POST['user_football_hated2'];
					if ($user_football_hated2->num_rows > 0) {
						    // output data of each row
						    //$rank = 0;
						    while($row = $user_football_hated2->fetch_assoc()) {
							//$rank ++ ;
							echo "<li>" . $row["player_name"]. "</li>";
							}
						} else {
						    echo "Start scouting and I'll tell ya..";
						}
						?>
					</ol>	
				
				</div>
  			</div>
		</div>



	</div>
	</div>
	</div>
	</div><!--container-->
	
	<?php include('footer.php'); ?>

  </body>
</html>

	
