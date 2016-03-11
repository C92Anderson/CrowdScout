<?php 
session_start();

//marke sure user is signedin
if(!isset($_SESSION['login_user'])){
header("Location: signin.php");
}

include('football_functions.php');

	$mysqli = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","football_all");
		// Check connection
		if ($mysqli->connect_error) {
			die("Connection failed: " . $mysqli->connect_error);
		} 

$scout = $_SESSION['login_user'] ;

	//pull down player and user ids
	$player1 = $_GET[p1];
	$player2 = $_GET[p2];
	$user_id = $_SESSION['user_id'];
	
	$query1 ="SELECT cs_id as player_id1, a.player_name as player_name1, a.pos as player_position1, team as player_team1, round(DATEDIFF(current_date(),DOB)/365.25,1) as age1,
			a.height, a.weight, draft_info, school
			 FROM football_roster_v1 as a
			 where cs_id = '$player1'";
	$query2 ="SELECT cs_id as player_id2, a.player_name as player_name2, a.pos as player_position2, team as player_team2, round(DATEDIFF(current_date(),DOB)/365.25,1) as age2,
			 a.height, a.weight, draft_info, school
			 FROM football_roster_v1 as a
			 where cs_id = '$player2'";

			
	//Get results
	$pull1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
	$pull2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);

	$echo1 = $pull1->fetch_assoc();
	$echo2 = $pull2->fetch_assoc();
	
	
	//find prior elo ratings from games
		
		$p1_elo = "select cs_id as player_id, player_name, elo as prior_elo from football_elo_v1 where cs_id = '$player1' order by cs_id, game_ts DESC limit 1";
		$p2_elo = "select cs_id as player_id, player_name, elo as prior_elo from football_elo_v1 where cs_id = '$player2' order by cs_id, game_ts DESC limit 1";
		 
		$p1_elo = $mysqli->query($p1_elo) or die($mysqli->error.__LINE__);
		$p2_elo = $mysqli->query($p2_elo) or die($mysqli->error.__LINE__);

		$p1_elo = $p1_elo->fetch_assoc();	
		$p2_elo = $p2_elo->fetch_assoc();
	
	if(!isset($p1_elo['prior_elo'])){
		$p1_elo['prior_elo'] = 1500;
		} 
		
	if(!isset($p2_elo['prior_elo'])){
		$p2_elo['prior_elo'] = 1500;
		} 		
		
	
//check to see if page is coming from football_home, otherwise insert into mysqldb

	$p1_elo = $p1_elo['prior_elo'];
	$p2_elo = $p2_elo['prior_elo'];
		
	//calculate expected probabilities of winning
	$p1_elo_E = 1 / (1+ pow(10,(( $p2_elo - $p1_elo ) / 600)));	
	$p2_elo_E = 1 - $p1_elo_E;
	
	//user power ranking - used as multiplier

		$scout_skill = $mysqli->query("SELECT COALESCE(hockey_scout_strength,.5) as hockey_scout_strength,
											COALESCE(football_scout_strength,.5) as football_scout_strength
										FROM `crowdscout_main`.`user_stats` where user_id=$user_id");

		if ($scout_skill->num_rows > 0) {
			
			$scout_skill = $scout_skill->fetch_assoc();
				
			$k_football=$scout_skill['football_scout_strength'];
		}

if(isset($_POST['result'])){

	//make calculations based on result
	$game_result = 	$_POST['result'];

	/////ADD TO MYSQL DATABASE
	$mysqli = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","football_all");
		// Check connection
		if ($mysqli->connect_error) {
			die("Connection failed: " . $mysqli->connect_error);
		} 


		//clean up player names		
		$player_name1 = $mysqli->real_escape_string(trim($_POST['pnm1']));
		$player_name2 = $mysqli->real_escape_string(trim($_POST['pnm2']));

		//add data into games data
		$game = $mysqli->query("INSERT INTO football_games_v1 (player_id1,player_id2,pnm1,pnm2,user_id,result,prior_elo_1,prior_elo_2,curr_elo_1,curr_elo_2,p1_team,p2_team,football_scout_strength)
					VALUES('".$_POST["p1"]."','".$_POST["p2"]."','".$player_name1."','".$player_name2."','".$_POST['user_id']."','"
							.$_POST["result"]."','".$_POST["prior_elo1"]."','".$_POST["prior_elo2"]."','".$_POST["post_elo1"]."','"
							.$_POST["post_elo2"]."','".$_POST["p1_team"]."','".$_POST["p2_team"]."','".$k_football."')");

				
		//add data into elo tables - need to update elo
		if($game_result="p1" || $game_result="p2"){
					
			$elo1 = $mysqli->query("INSERT INTO football_elo_v1 (cs_id,player_name,elo)
						VALUES('".$_POST['p1']."','".$player_name1."','".$_POST["post_elo1"]."')");			
			$elo2 = $mysqli->query("INSERT INTO football_elo_v1 (cs_id,player_name,elo)
						VALUES('".$_POST['p2']."','".$player_name2."','".$_POST["post_elo2"]."')");
		}
	$mysqli->close();
}	
?>

<!doctype html>
<html>

	<head>
	<meta charset="UTF-8">
	<meta name="description" content="Crowd Scouting Player Rankings">
	<meta name="keywords" content="Football,Player,Rankings,Scout,Scouting">
		<title>CrowdScout Football</title>
	
		<?php include('header.php');?>
	
	</head>

<body>


<div class="container">
	<div class="header container-fluid">
		<?php if(isset($msg_error)){
				echo "<h3 class='text-muted'>Sorry, there was an error. Please try again!</h3>";
			} else {				
				echo "<h3 class='text-muted'>Football Head-to-Head - Select Preferred Player";
				include('football_select.php') ;
				echo "</h3><h4>Current Football Scouting Strength: <span class='label label-info'>".round($k_football,3)."</span></h4>";
		} ?>
	</div>


	<!--select candidate 1-->
	<div class="row container-fluid">
		<div class="col-sm-6">
			<form name="football_game" action="football_form.php" method="POST">
				<input type="hidden" name="p1" value="<?php echo $echo1['player_id1'];?>">
				<input type="hidden" name="p2" value="<?php echo $echo2['player_id2'];?>">
				<input type="hidden" name="pnm1" value="<?php echo $echo1['player_name1'];?>">
				<input type="hidden" name="pnm2" value="<?php echo $echo2['player_name2'];?>">
				<input type="hidden" name="p1_team" value="<?php echo $echo1['player_team1'];?>">
				<input type="hidden" name="p2_team" value="<?php echo $echo2['player_team2'];?>">
				<input type="hidden" name="result" value="p1">
				<input type="hidden" name="user_id" value="<?php echo $user_id ;?>">
				<input type="hidden" name="prior_elo1" value="<?php echo $p1_elo ;?>">
				<input type="hidden" name="prior_elo2" value="<?php echo $p2_elo ;?>">
				<?php 		
				
				$p1_elo_post = $p1_elo + ($k_football * (1 - $p1_elo_E ));
				$p2_elo_post = $p2_elo + ($k_football * (0 - $p2_elo_E ));

				echo   '<input type="hidden" name="post_elo1" value="'. $p1_elo_post .'">
					<input type="hidden" name="post_elo2" value="'. $p2_elo_post .'">'
				?>
				<button type="submit" class="btn btn-primary btn-lg btn-block"  
				formaction=<?php pairsimFB(25) ; ?> >
				<?php echo $echo1['player_name1']." (".$echo1['player_team1'].")";?>
				</button>
			</form>
		</div>
		<!--select candidate 2-->
		<div class="col-sm-6">
			<form name="football_game" action="football_form.php" method="POST">
				<input type="hidden" name="p1" value="<?php echo $echo1['player_id1'];?>">
				<input type="hidden" name="p2" value="<?php echo $echo2['player_id2'];?>">
				<input type="hidden" name="pnm1" value="<?php echo $echo1['player_name1'];?>">
				<input type="hidden" name="pnm2" value="<?php echo $echo2['player_name2'];?>">
				<input type="hidden" name="p1_team" value="<?php echo $echo1['player_team1'];?>">
				<input type="hidden" name="p2_team" value="<?php echo $echo2['player_team2'];?>">
				<input type="hidden" name="result" value="p2">
				<input type="hidden" name="user_id" value="<?php echo $user_id ;?>">
				<input type="hidden" name="prior_elo1" value="<?php echo $p1_elo ;?>">
				<input type="hidden" name="prior_elo2" value="<?php echo $p2_elo ;?>">
				<?php 		
				$p1_elo_post = $p1_elo + ($k_football * (0 - $p1_elo_E ));
				$p2_elo_post = $p2_elo + ($k_football * (1 - $p2_elo_E ));

				echo   '<input type="hidden" name="post_elo1" value="'. $p1_elo_post .'">
					<input type="hidden" name="post_elo2" value="'. $p2_elo_post .'">'
				?>
				<button type="submit" class="btn btn-primary btn-lg btn-block" 
				formaction=<?php pairsimFB(25) ; ?> >
				<?php echo $echo2['player_name2']." (".$echo2['player_team2'].")";?>
				</button>
			</form>
		</div>
	</div>
	<br>
	<div class="container-fluid">
		<!--select neither, reload page with 2 new options-->
		<div class="row">
		<div class="col-lg-12">
			<form name="football_game" action="football_form.php" method="POST">
				<input type="hidden" name="p1" value="<?php echo $echo1['player_id1'];?>">
				<input type="hidden" name="p2" value="<?php echo $echo2['player_id2'];?>">
				<input type="hidden" name="pnm1" value="<?php echo $echo1['player_name1'];?>">
				<input type="hidden" name="pnm2" value="<?php echo $echo2['player_name2'];?>">
				<input type="hidden" name="p1_team" value="<?php echo $echo1['player_team1'];?>">
				<input type="hidden" name="p2_team" value="<?php echo $echo2['player_team2'];?>">
				<input type="hidden" name="result" value="draw">
				<input type="hidden" name="user_id" value="<?php echo $user_id ;?>">
				<input type="hidden" name="prior_elo1" value="<?php echo $p1_elo ;?>">
				<input type="hidden" name="prior_elo2" value="<?php echo $p2_elo ;?>">
				<input type="hidden" name="post_elo1" value="<?php echo $p1_elo ;?>">
				<input type="hidden" name="post_elo2" value="<?php echo $p2_elo ;?>">
				<button type="submit" class="btn btn-default btn-lg btn-block" 
				formaction=<?php pairsimFB(50) ; ?> >
					<?php if(isset($echo2['player_name2'])){
						echo "Too Close (Next)";
					} else {
						echo "Try Again - New Matchup";
					} ?>
				</button>
			</form>
		</div>
		</div>
		<div class="row">
		<div class="col-lg-12">
			<form name="football_game" action="football_form.php" method="POST">
				<input type="hidden" name="p1" value="<?php echo $echo1['player_id1'];?>">
				<input type="hidden" name="p2" value="<?php echo $echo2['player_id2'];?>">
				<input type="hidden" name="pnm1" value="<?php echo $echo1['player_name1'];?>">
				<input type="hidden" name="pnm2" value="<?php echo $echo2['player_name2'];?>">
				<input type="hidden" name="p1_team" value="<?php echo $echo1['player_team1'];?>">
				<input type="hidden" name="p2_team" value="<?php echo $echo2['player_team2'];?>">
				<input type="hidden" name="result" value="unknown">
				<input type="hidden" name="user_id" value="<?php echo $user_id ;?>">
				<input type="hidden" name="prior_elo1" value="<?php echo $p1_elo ;?>">
				<input type="hidden" name="prior_elo2" value="<?php echo $p2_elo ;?>">
				<input type="hidden" name="post_elo1" value="<?php echo $p1_elo ;?>">
				<input type="hidden" name="post_elo2" value="<?php echo $p2_elo ;?>">
				<button type="submit" class="btn btn-primary btn-lg btn-block"
				formaction=<?php pairsimFB(50) ; ?> >
					<?php if(isset($echo2['player_name2'])){
						echo "Don't Know (Next)";
					} else {
						echo "Try Again - New Matchup";
					} ?>
				</button>
			</form>
		</div>
		</div>
	</div>
	<br>

	<!--BODY OF TABLE-->
	<div class="col-lg-12">
	<div class="panel panel-primary">
		<div class="panel-heading">	
			<h4>Select player who you feel would best give you a chance to win a championship, if the season started today</h4>
		</div>

		<div class="panel-body table table-striped">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><span class="glyphicon glyphicon-user" aria-hidden="true"></span></th>
						<th><?php echo $echo1['player_name1'];?></th>
						<th><?php echo $echo2['player_name2'];?></th>
					</tr>
				</thead>
						
				<tbody>
					<tr>
						<td><span class="glyphicon glyphicon-text-background" aria-hidden="true"></span></td>
						<td><?php echo $echo1['player_team1'];?></td>
						<td><?php echo $echo2['player_team2'];?></td>
					</tr>
					<tr> 
						<td><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> Elo</td>
						<td><?php echo round($p1_elo,1);?></td>
						<td><?php echo round($p2_elo,1);?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-knight" aria-hidden="true"></span></td>
						<td><?php echo $echo1['player_position1'];?></td>
						<td><?php echo $echo2['player_position2'];?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></td>
						<td><?php echo $echo1['draft_info'];?></td>
						<td><?php echo $echo2['draft_info'];?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></td>
						<td><?php echo $echo1['height'];?></td>
						<td><?php echo $echo2['height'];?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-scale" aria-hidden="true"></span></td>
						<td><?php echo $echo1['weight'];?></td>
						<td><?php echo $echo2['weight'];?></td>
						</tr>
					<tr>
						<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></td>
						<td><?php echo $echo1['age1'];?></td>
						<td><?php echo $echo2['age2'];?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-book" aria-hidden="true"></span></td>
						<td><?php echo $echo1['school'];?></td>
						<td><?php echo $echo2['school'];?></td>
					</tr>		
							
				</tbody>	
			</table>
		</div>
	</div>
	</div>


	<div class="container-fluid">
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
	  Show Legend
	</button>
	</div>
	<div class="collapse container-fluid" id="collapseExample">
	  <div class="well">

	 <div class="container-fluid">
		<p><b>Note:</b>"Too Close" is used when both players are known, but can't be discerned. "Don't Know" will decrease the odds of receiving either player for a week.</p>
	 </div>

	    <div class="panel-body table table-striped">
				<table class="table table-striped">
					<tbody>
											<tr>
						<td><span class="glyphicon glyphicon-user" aria-hidden="true"></span></td>
						<td>Player Name</th>
						</tr>
						<tr>
						<td><span class="glyphicon glyphicon-text-background" aria-hidden="true"></span></td>
						<td>Current Team</td>
						</tr>					
						<tr>
						<td><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></td>
						<td>Current CrowdScout Elo Rating</td>
						</tr>
						<tr>
						<td><span class="glyphicon glyphicon-knight" aria-hidden="true"></span></td>
						<td>Position</td>
						</tr>
						<tr>
						<td><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></td>
						<td>Draft Information</td>
						</tr>
						<tr>
						<td><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></td>
						<td>Height</td>
						</tr>
						<tr>
						<td><span class="glyphicon glyphicon-scale" aria-hidden="true"></span></td>
						<td>Weight</td>					 
						</tr>
						<tr>
						<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></td>
						<td>Current Age</td>
						</tr>	
						<tr>
						<td><span class="glyphicon glyphicon-book" aria-hidden="true"></span></td>
						<td>School</td>
						</tr>						      							      							      							     
					</tbody>	
				</table>
			</div>
						
							
	  </div>
	</div>

	<?php include('footer.php'); ?>

</body>
</html>