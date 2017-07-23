<?php 
session_start();

//marke sure user is signedin
if(!isset($_SESSION['login_user'])){
header("Location: signin.php");
}

include('hockey_functions.php');

$scout = $_SESSION['login_user'] ;

	//pull down player and user ids
	$player1 = $_GET[p1];
	$player2 = $_GET[p2];
	$user_id = $_SESSION['user_id'];
	
	$query1 ="SELECT a.nhl_id as player_id1, a.player_name as player_name1, a.pos as player_position1, a.team as player_team1, round(DATEDIFF(current_date(),a.dob)/365.25,1) as age1,
			a.height, a.weight, coalesce(b.draft_info, 'Undrafted') as draft_info, 
			coalesce(round(s17.G60_EV,3), '--') as G60_EV_1617, 
			coalesce(round(s17.A160_EV,3), '--') as A160_EV_1617, 
			coalesce(round(s17.A260_EV,3), '--') as A260_EV_1617, 
			coalesce(round(s17.G60_PP,3), '--') as G60_PP_1617, 
			coalesce(round(s17.A160_PP,3), '--') as A160_PP_1617, 
			coalesce(round(s17.A260_PP,3), '--') as A260_PP_1617, 
			coalesce(round(s17.`Games.Played_EV`,0), '--') as Gm_1617,
			coalesce(round(s17.`Share.of.Ice_EV`,3),'--') as ShareIce_EV_1617, 
			coalesce(round(s17.`Share.of.Ice_PP`,3),'--') as ShareIce_PP_1617, 
			coalesce(round(s17.`Share.of.Ice_SH`,3),'--') as ShareIce_SH_1617, 
			coalesce(round(s17.`OTF.Shift.Share_EV`,3), '--') as OTFShift_1617, 
			coalesce(round(s17.`Off.FO.Shift.Share_EV`,3), '--') as FOOffShift_1617, 
			coalesce(round(s17.`Def.FO.Shift.Share_EV`,3), '--') as FODefShift_1617, 
			coalesce(round(s17.`Neu.FO.Shift.Share_EV`,3), '--') as FONeuShift_1617, 

			coalesce(round(s17.`xGF60_EV`,3), '--') as xGF60_EV_1617,
			coalesce(round(s17.`xGA60_EV`,3), '--') as xGA60_EV_1617,
			coalesce(round(s17.`xGF60_teamWO_EV`,3), '--') as xGF60_TmWO_EV_1617,
			coalesce(round(s17.`xGA60_teamWO_EV`,3), '--') as xGA60_TmWO_EV_1617,

			coalesce(round(s16.G60_EV,3), '--') as G60_EV_1516, 
			coalesce(round(s16.A160_EV,3), '--') as A160_EV_1516, 
			coalesce(round(s16.A260_EV,3), '--') as A260_EV_1516, 
			coalesce(round(s16.G60_PP,3), '--') as G60_PP_1516, 
			coalesce(round(s16.A160_PP,3), '--') as A160_PP_1516, 
			coalesce(round(s16.A260_PP,3), '--') as A260_PP_1516, 
			coalesce(round(s16.`Games.Played_EV`,0), '--') as Gm_1516,
			coalesce(round(s16.`Share.of.Ice_EV`,3),'--') as ShareIce_EV_1516, 
			coalesce(round(s16.`Share.of.Ice_PP`,3),'--') as ShareIce_PP_1516, 
			coalesce(round(s16.`Share.of.Ice_SH`,3),'--') as ShareIce_SH_1516, 
			coalesce(round(s16.`OTF.Shift.Share_EV`,3), '--') as OTFShift_1516, 
			coalesce(round(s16.`Off.FO.Shift.Share_EV`,3), '--') as FOOffShift_1516, 
			coalesce(round(s16.`Def.FO.Shift.Share_EV`,3), '--') as FODefShift_1516, 
			coalesce(round(s16.`Neu.FO.Shift.Share_EV`,3), '--') as FONeuShift_1516, 

			coalesce(round(s16.`xGF60_EV`,3), '--') as xGF60_EV_1516,
			coalesce(round(s16.`xGA60_EV`,3), '--') as xGA60_EV_1516,
			coalesce(round(s16.`xGF60_teamWO_EV`,3), '--') as xGF60_TmWO_EV_1516,
			coalesce(round(s16.`xGA60_teamWO_EV`,3), '--') as xGA60_TmWO_EV_1516,

			coalesce(round(g17.`xG.Lift.100Shots`,3), '--') as xGLift_1617, 
			coalesce(round(g17.`Surplus.Pts`,3), '--') as SurplusPts_1617,
			coalesce(round(g16.`xG.Lift.100Shots`,3), '--') as xGLift_1516, 
			coalesce(round(g16.`Surplus.Pts`,3), '--') as SurplusPts_1516
			
			 FROM hockey_roster_v1 as a
			 LEFT JOIN hockey_roster_info as b
				on a.nhl_id = b.playerId
			 LEFT JOIN 
			 (SELECT shooterID, `Games.Played_EV`, 
			 `Share.of.Ice_EV`, `Share.of.Ice_PP`, `Share.of.Ice_SH`,
			 `OTF.Shift.Share_EV`,`Off.FO.Shift.Share_EV`,`Def.FO.Shift.Share_EV`,`Neu.FO.Shift.Share_EV`,
			 ixG60_EV, G60_EV, ixG60_PP, G60_PP,
			 A160_EV, A160_PP, A260_EV, A260_PP, 
			 xGF60_EV, xGA60_EV, xGF60_teamWO_EV, xGA60_teamWO_EV,
			 xGF60_PP, xGA60_PP, xGF60_teamWO_PP, xGA60_teamWO_PP
			 from crowdscout_data_predictions as a
			 where season = '20162017') as s17
			 	on a.nhl_id = s17.shooterID
			 LEFT JOIN 
			 (SELECT shooterID, `Games.Played_EV`, 
			 `Share.of.Ice_EV`, `Share.of.Ice_PP`, `Share.of.Ice_SH`,
			 `OTF.Shift.Share_EV`,`Off.FO.Shift.Share_EV`,`Def.FO.Shift.Share_EV`,`Neu.FO.Shift.Share_EV`,
			 ixG60_EV, G60_EV, ixG60_PP, G60_PP,
			 A160_EV, A160_PP, A260_EV, A260_PP, 
			 xGF60_EV, xGA60_EV, xGF60_teamWO_EV, xGA60_teamWO_EV,
			 xGF60_PP, xGA60_PP, xGF60_teamWO_PP, xGA60_teamWO_PP
			 from crowdscout_data_predictions as a
			 where season = '20152016') as s16
			 	on a.nhl_id = s16.shooterID
			 LEFT JOIN
			 (SELECT nhl_id, `xG.Lift.100Shots`, `Surplus.Pts`, SA
			 FROM goalie_season_stats
			 WHERE season = '20162017') as g17
			 on a.nhl_id = g17.nhl_id
			 LEFT JOIN
			 (SELECT nhl_id, `xG.Lift.100Shots`, `Surplus.Pts`, SA
			 FROM goalie_season_stats
			 WHERE season = '20152016') as g16
			 on a.nhl_id = g16.nhl_id
			 where a.nhl_id = $player1";
	$query2 ="SELECT a.nhl_id as player_id2, a.player_name as player_name2, a.pos as player_position2, a.team as player_team2, round(DATEDIFF(current_date(),a.dob)/365.25,1) as age2,
			a.height, a.weight, coalesce(b.draft_info, 'Undrafted') as draft_info, 
			coalesce(round(s17.G60_EV,3), '--') as G60_EV_1617, 
			coalesce(round(s17.A160_EV,3), '--') as A160_EV_1617, 
			coalesce(round(s17.A260_EV,3), '--') as A260_EV_1617, 
			coalesce(round(s17.G60_PP,3), '--') as G60_PP_1617, 
			coalesce(round(s17.A160_PP,3), '--') as A160_PP_1617, 
			coalesce(round(s17.A260_PP,3), '--') as A260_PP_1617, 
			coalesce(round(s17.`Games.Played_EV`,0), '--') as Gm_1617,
			coalesce(round(s17.`Share.of.Ice_EV`,3),'--') as ShareIce_EV_1617, 
			coalesce(round(s17.`Share.of.Ice_PP`,3),'--') as ShareIce_PP_1617, 
			coalesce(round(s17.`Share.of.Ice_SH`,3),'--') as ShareIce_SH_1617, 
			coalesce(round(s17.`OTF.Shift.Share_EV`,3), '--') as OTFShift_1617, 
			coalesce(round(s17.`Off.FO.Shift.Share_EV`,3), '--') as FOOffShift_1617, 
			coalesce(round(s17.`Def.FO.Shift.Share_EV`,3), '--') as FODefShift_1617, 
			coalesce(round(s17.`Neu.FO.Shift.Share_EV`,3), '--') as FONeuShift_1617, 

			coalesce(round(s17.`xGF60_EV`,3), '--') as xGF60_EV_1617,
			coalesce(round(s17.`xGA60_EV`,3), '--') as xGA60_EV_1617,
			coalesce(round(s17.`xGF60_teamWO_EV`,3), '--') as xGF60_TmWO_EV_1617,
			coalesce(round(s17.`xGA60_teamWO_EV`,3), '--') as xGA60_TmWO_EV_1617,

			coalesce(round(s16.G60_EV,3), '--') as G60_EV_1516, 
			coalesce(round(s16.A160_EV,3), '--') as A160_EV_1516, 
			coalesce(round(s16.A260_EV,3), '--') as A260_EV_1516, 
			coalesce(round(s16.G60_PP,3), '--') as G60_PP_1516, 
			coalesce(round(s16.A160_PP,3), '--') as A160_PP_1516, 
			coalesce(round(s16.A260_PP,3), '--') as A260_PP_1516, 
			coalesce(round(s16.`Games.Played_EV`,0), '--') as Gm_1516,
			coalesce(round(s16.`Share.of.Ice_EV`,3),'--') as ShareIce_EV_1516, 
			coalesce(round(s16.`Share.of.Ice_PP`,3),'--') as ShareIce_PP_1516, 
			coalesce(round(s16.`Share.of.Ice_SH`,3),'--') as ShareIce_SH_1516, 
			coalesce(round(s16.`OTF.Shift.Share_EV`,3), '--') as OTFShift_1516, 
			coalesce(round(s16.`Off.FO.Shift.Share_EV`,3), '--') as FOOffShift_1516, 
			coalesce(round(s16.`Def.FO.Shift.Share_EV`,3), '--') as FODefShift_1516, 
			coalesce(round(s16.`Neu.FO.Shift.Share_EV`,3), '--') as FONeuShift_1516, 

			coalesce(round(s16.`xGF60_EV`,3), '--') as xGF60_EV_1516,
			coalesce(round(s16.`xGA60_EV`,3), '--') as xGA60_EV_1516,
			coalesce(round(s16.`xGF60_teamWO_EV`,3), '--') as xGF60_TmWO_EV_1516,
			coalesce(round(s16.`xGA60_teamWO_EV`,3), '--') as xGA60_TmWO_EV_1516,

			coalesce(round(g17.`xG.Lift.100Shots`,3), '--') as xGLift_1617, 
			coalesce(round(g17.`Surplus.Pts`,3), '--') as SurplusPts_1617,
			coalesce(round(g16.`xG.Lift.100Shots`,3), '--') as xGLift_1516, 
			coalesce(round(g16.`Surplus.Pts`,3), '--') as SurplusPts_1516
			
			 FROM hockey_roster_v1 as a
			 LEFT JOIN hockey_roster_info as b
				on a.nhl_id = b.playerId
			 LEFT JOIN 
			 (SELECT shooterID, `Games.Played_EV`, 
			 `Share.of.Ice_EV`, `Share.of.Ice_PP`, `Share.of.Ice_SH`,
			 `OTF.Shift.Share_EV`,`Off.FO.Shift.Share_EV`,`Def.FO.Shift.Share_EV`,`Neu.FO.Shift.Share_EV`,
			 ixG60_EV, G60_EV, ixG60_PP, G60_PP,
			 A160_EV, A160_PP, A260_EV, A260_PP, 
			 xGF60_EV, xGA60_EV, xGF60_teamWO_EV, xGA60_teamWO_EV,
			 xGF60_PP, xGA60_PP, xGF60_teamWO_PP, xGA60_teamWO_PP
			 from crowdscout_data_predictions as a
			 where season = '20162017') as s17
			 	on a.nhl_id = s17.shooterID
			 LEFT JOIN 
			 (SELECT shooterID, `Games.Played_EV`, 
			 `Share.of.Ice_EV`, `Share.of.Ice_PP`, `Share.of.Ice_SH`,
			 `OTF.Shift.Share_EV`,`Off.FO.Shift.Share_EV`,`Def.FO.Shift.Share_EV`,`Neu.FO.Shift.Share_EV`,
			 ixG60_EV, G60_EV, ixG60_PP, G60_PP,
			 A160_EV, A160_PP, A260_EV, A260_PP, 
			 xGF60_EV, xGA60_EV, xGF60_teamWO_EV, xGA60_teamWO_EV,
			 xGF60_PP, xGA60_PP, xGF60_teamWO_PP, xGA60_teamWO_PP
			 from crowdscout_data_predictions as a
			 where season = '20152016') as s16
			 	on a.nhl_id = s16.shooterID
			 LEFT JOIN
			 (SELECT nhl_id, `xG.Lift.100Shots`, `Surplus.Pts`, SA
			 FROM goalie_season_stats
			 WHERE season = '20162017') as g17
			 on a.nhl_id = g17.nhl_id
			 LEFT JOIN
			 (SELECT nhl_id, `xG.Lift.100Shots`, `Surplus.Pts`, SA
			 FROM goalie_season_stats
			 WHERE season = '20152016') as g16
			 on a.nhl_id = g16.nhl_id
			 where a.nhl_id = $player2";

			 
	include('includes/database.php'); 
		 
	//Get results
	$pull1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
	$pull2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);

	$echo1 = $pull1->fetch_assoc();
	$echo2 = $pull2->fetch_assoc();
	
	//initialize the array to store the processed data
	$jsonArray = array();
	//check if there is any data returned by the SQL Query
	if ($query1->num_rows > 0) {
  	//Converting the results into an associative array
  		while($row = $query1->fetch_assoc()) {
		    $jsonArrayItem = array();
		    $jsonArrayItem['label'] = $row['player_name1'];
		    $jsonArrayItem['value'] = $row['G60_1617'];
		    $jsonArrayItem['value'] = $row['G60_1516'];
	    //append the above created object into the main array.
   	 	array_push($jsonArray, $jsonArrayItem);
  		}
	}

	//set the response content type as JSON
	//header('Content-type: application/json');
	//output the return value of json encode using the echo function. 
	//echo json_encode($jsonArray);
	
	//find prior elo ratings from games
		
		$p1_elo = "select player_id, player_name, elo as prior_elo from hockey_elo_v1 where player_id = $player1 order by player_id, game_ts DESC limit 1";
		$p2_elo = "select player_id, player_name, elo as prior_elo from hockey_elo_v1 where player_id = $player2 order by player_id, game_ts DESC limit 1";
		 
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
		
	
//check to see if page is coming from hockey_home, otherwise insert into mysqldb

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
				
			$k_hockey = $scout_skill['hockey_scout_strength'];

			if($k_hockey == 0) {
				$k_hockey = 1;
			}

			}
	
if(isset($_POST['result'])){

	//make calculations based on result
	$game_result = 	$_POST['result'];

	/////ADD TO MYSQL DATABASE
		include('includes/database.php'); 
		
		//clean up player names		
		$player_name1 = $mysqli->real_escape_string(trim($_POST['pnm1']));
		$player_name2 = $mysqli->real_escape_string(trim($_POST['pnm2']));

		//add data into games data
		$game = $mysqli->query("INSERT INTO hockey_games_v1 (player_id1,player_id2,pnm1,pnm2,user_id,result,prior_elo_1,prior_elo_2,curr_elo_1,curr_elo_2,p1_team,p2_team,hockey_scout_strength)
					VALUES('".$_POST["p1"]."','".$_POST["p2"]."','".$player_name1."','".$player_name2."','".$_POST['user_id']."','"
							 .$_POST["result"]."','".$_POST["prior_elo1"]."','".$_POST["prior_elo2"]."','".$_POST["post_elo1"]."','"
							 .$_POST["post_elo2"]."','".$_POST["p1_team"]."','".$_POST["p2_team"]."','".$k_hockey."')");

				
		//add data into elo tables - need to update elo
		if($game_result="p1" || $game_result="p2"){
					
			$elo1 = $mysqli->query("INSERT INTO hockey_elo_v1 (player_id,player_name,elo)
						VALUES('".$_POST['p1']."','".$player_name1."','".$_POST["post_elo1"]."')");			
			$elo2 = $mysqli->query("INSERT INTO hockey_elo_v1 (player_id,player_name,elo)
						VALUES('".$_POST['p2']."','".$player_name2."','".$_POST["post_elo2"]."')");
		}
	$mysqli->close();
}	
?>

<!doctype html>
<html>

	<head>
	<meta charset="UTF-8">
	<meta name="description" content="CrowdScout Player Scouting">
	<meta name="keywords" content="Hockey,Player,Scout,Scouting">
		<title>CrowdScout Hockey</title>
	
		<?php include('header.php');?>

	 	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
	
	</head>

<body>

<div class="container">
	<div class="header container-fluid">
		<?php if(isset($msg_error)){
				echo "<h3 class='text-muted'>Sorry, there was an error. Please try again!</h3>";
			} else {				
				echo "<h3 class='text-muted'>Hockey Head-to-Head - Select Preferred Player";  
				include('hockey_select.php') ;
				echo "</h3><h4>Current Hockey Scouting Strength: <span class='label label-info'>".round($k_hockey,3)."</span></h4>";
		} ?>
		</div>


	<!--select candidate 1-->
	<div class="row container-fluid">
		<div class="col-sm-6">
			<form name="hockey_game" action="hockey_form.php" method="POST">
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
				
				$p1_elo_post = $p1_elo + ($k_hockey * (1 - $p1_elo_E ));
				$p2_elo_post = $p2_elo + ($k_hockey * (0 - $p2_elo_E ));

				echo   '<input type="hidden" name="post_elo1" value="'. $p1_elo_post .'">
					<input type="hidden" name="post_elo2" value="'. $p2_elo_post .'">'
				?>
				<button type="submit" class="btn btn-primary btn-lg btn-block"  
				formaction=<?php pairsimHKY(15) ; ?> >
					<?php echo $echo1['player_name1']." (".$echo1['player_team1'].")";?>
				</button>
			</form>
		</div>
		<!--select candidate 2-->
		<div class="col-sm-6">
			<form name="hockey_game" action="hockey_form.php" method="POST">
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
				$p1_elo_post = $p1_elo + ($k_hockey * (0 - $p1_elo_E ));
				$p2_elo_post = $p2_elo + ($k_hockey * (1 - $p2_elo_E ));

				echo   '<input type="hidden" name="post_elo1" value="'. $p1_elo_post .'">
					<input type="hidden" name="post_elo2" value="'. $p2_elo_post .'">'
				?>
				<button type="submit" class="btn btn-primary btn-lg btn-block" 
				formaction=<?php pairsimHKY(15) ; ?> >
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
			<form name="hockey_game" action="hockey_form.php" method="POST">
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
				formaction=<?php pairsimHKY(15) ; ?> >
					<?php if(isset($echo2['player_name2'])){
						echo "Not Sure (Next)";
					} else {
						echo "Try Again - New Matchup";
					} ?>
				</button>
			</form>
		</div>
		</div>
		<!--div class="row">
		<div class="col-lg-12">
			<form name="hockey_game" action="hockey_form.php" method="POST">
				<input type="hidden" name="p1" value="<?php// echo $echo1['player_id1'];?>">
				<input type="hidden" name="p2" value="<?php// echo $echo2['player_id2'];?>">
				<input type="hidden" name="pnm1" value="<?php// echo $echo1['player_name1'];?>">
				<input type="hidden" name="pnm2" value="<?php// echo $echo2['player_name2'];?>">
				<input type="hidden" name="p1_team" value="<?php// echo $echo1['player_team1'];?>">
				<input type="hidden" name="p2_team" value="<?php// echo $echo2['player_team2'];?>">
				<input type="hidden" name="result" value="unknown">
				<input type="hidden" name="user_id" value="<?php// echo $user_id ;?>">
				<input type="hidden" name="prior_elo1" value="<?php// echo $p1_elo ;?>">
				<input type="hidden" name="prior_elo2" value="<?php// echo $p2_elo ;?>">
				<input type="hidden" name="post_elo1" value="<?php// echo $p1_elo ;?>">
				<input type="hidden" name="post_elo2" value="<?php// echo $p2_elo ;?>">
				<button type="submit" class="btn btn-primary btn-lg btn-block"
				formaction=<?php// pairsimHKY(15) ; ?> >
					<//?php if(isset($echo2['player_name2'])){
					//	echo "Don't Know (Next)";
					//} else {
					//	echo "Try Again - New Matchup";
					} ?>
				</button>
			</form>
		</div>
		</div-->
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
					<!--tr> Current League
						<td><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></td>
						<td>NHL1</td>
						<td>NHL2</td>Goal Production - Goals per 60 Minutes at ES, PP, SH Compared to League Averages, weighted by Player Useage
					</tr-->		
					<tr>
						<td><span class='glyphicon glyphicon-wrench' aria-hidden='true'></span></a> GP</td>
						<td><b><?php echo $echo1['Gm_1617'] . "</b> / " . $echo1['Gm_1516'] ; ?></td>
						<td><b><?php echo $echo2['Gm_1617'] . "</b> / " . $echo2['Gm_1516'] ; ?></td>
					</tr>

					<?php if($echo1['player_position1'] != "G" or $echo2['player_position2'] != "G") {
						echo "<!--tr>
						<td><a href='#nhlstatspage' title='Goal Production - Goals per 60 Minutes' style='background-color:#FFFFFF;color:#000000;text-decoration:none'>
									<span class='glyphicon glyphicon-stats' aria-hidden='true'></span></a> G60</td>
						<td><b>".  $echo1['G60_EV_1617'] ."</b> / ". $echo1['G60_EV_1516'] . "</td>
						<td><b>".  $echo2['G60_EV_1617'] ."</b> / ". $echo2['G60_EV_1516'] . "</td>
					</tr>	
					<tr>
						<td><span class='glyphicon glyphicon-apple' aria-hidden='true'></span> A60</td>
						<td><b>".  $echo1['A60_EV_1617'] ."</b> / ". $echo1['A60_EV_1516'] . "</td>
						<td><b>".  $echo2['A60_EV_1617'] ."</b> / ". $echo2['A60_EV_1516'] . "</td>
					</tr>					
					<tr>
						<td><span class='glyphicon glyphicon-dashboard' aria-hidden='true'></span> P60</td>
						<td><b>".  $echo1['P60_1617'] ."</b> / ". $echo1['P60_1516'] . "</td>
						<td><b>".  $echo2['P60_1617'] ."</b> / ". $echo2['P60_1516'] . "</td>
					</tr>
					<tr>
						<td><span class='glyphicon glyphicon-record' aria-hidden='true'></span> SCF%</td>
						<td><b>".  $echo1['SCF_1617'] ."</b> / ". $echo1['SCF_1516'] ."</td>
						<td><b>".  $echo2['SCF_1617'] ."</b> / ". $echo2['SCF_1516'] ."</td>
					</tr>		
					<tr>
						<td><span class='glyphicon glyphicon-map-marker' aria-hidden='true'></span> CF%</td>
						<td><b>".  $echo1['CFPct_1617'] ."</b> / ". $echo1['CFPct_1516'] ."</td>
						<td><b>".  $echo2['CFPct_1617'] ."</b> / ". $echo2['CFPct_1516'] ."</td>
					</tr>
					<tr>
						<td><span class='glyphicon glyphicon-indent-left' aria-hidden='true'></span> CF% Rel</td>
						<td><b>".  $echo1['CFRel_1617'] ."</b> / ". $echo1['CFRel_1516'] ."</td>
						<td><b>".  $echo2['CFRel_1617'] ."</b> / ". $echo2['CFRel_1516'] ."</td>
					</tr>
					<tr>
						<td><span class='glyphicon glyphicon-triangle-top' aria-hidden='true'></span> CF/60</td>
						<td><b>".  $echo1['CF60_1617'] ."</b> / ". $echo1['CF60_1516'] ."</td>
						<td><b>".  $echo2['CF60_1617'] ."</b> / ". $echo2['CF60_1516'] ."</td>
					</tr>
					<tr>
						<td><span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true'></span> CA/60</td>
						<td><b>".  $echo1['CA60_1617'] ."</b> / ". $echo1['CA60_1516'] ."</td>
						<td><b>".  $echo2['CA60_1617'] ."</b> / ". $echo2['CA60_1516'] ."</td>
					</tr>
					<tr>
						<td><span class='lyphicon glyphicon-hourglass' aria-hidden='true'></span> TOI/Gm</td>
						<td><b>".  $echo1['TOI_1617'] ."</b> / ". $echo1['TOI_1516'] ."</td>
						<td><b>".  $echo2['TOI_1617'] ."</b> / ". $echo2['TOI_1516'] ."</td>
					</tr-->"; 
					} else { }?>	
					<?php if($echo1['player_position1'] == "G" or $echo2['player_position2'] == "G") {
						echo "<tr>
							<td><span class='glyphicon glyphicon-tasks' aria-hidden='true'></span> xG Lift (xGA-GA)</td>
							<td><b>". $echo1['xGLift_1617'] ."</b> / ". $echo1['xGLift_1516'] ."</td>
							<td><b>". $echo2['xGLift_1617'] ."</b> / ". $echo2['xGLift_1516'] ."</td>
						</tr>
						<tr>
							<td><span class='glyphicon glyphicon-flash' aria-hidden='true'></span>Surplus Points</td>
							<td><b>". $echo1['SurplusPts_1617'] ."</b> / ". $echo1['SurplusPts_1516'] ."</td>
							<td><b>". $echo2['SurplusPts_1617'] ."</b> / ". $echo2['SurplusPts_1516'] ."</td>
						</tr>";
						} else { }?>							
				</tbody>	
			</table>
		</div>


<?php if($echo1['player_position1'] != "G" or $echo2['player_position2'] != "G") {
			echo "<div>
				<div id='p1_prod' style='width:49%; display:inline-table;text-align:center;'></div>
				<div id='p2_prod' style='width:49%; display:inline-table;text-align:center;'></div>
				</div>

				<div>
				<div id='p1_xG_EV' style='width:49%; display:inline-table;text-align:center;'></div>
				<div id='p2_xG_EV' style='width:49%; display:inline-table;text-align:center;'></div>
				</div>
				<!--div>
				<div id='strength17' style='width:49%; display:inline-table;text-align:center;'></div>
				<div id='strength17' style='width:49%; display:inline-table;text-align:center;'></div>
				</div>
				<div>
				<div id='usage17' style='width:49%; display:inline-table;text-align:center;'></div>
				<div id='usage16' style='width:49%; display:inline-table;text-align:center;'></div>
				</div-->";
	} elseif($echo1['player_position1'] == "G" or $echo2['player_position2'] == "G") {
			echo "<!--div>
				<div id='xglift1617' style='width:50%; display:inline-table;text-align:center;'></div>
				<div id='xglift1516' style='width:50%; display:inline-table;text-align:center;'></div>
				</div>

				<div>
				<div id='surpluspts1617' style='width:50%; display:inline-table;text-align:center;'></div>
				<div id='surpluspts1516' style='width:50%; display:inline-table;text-align:center;'></div>
				</div-->";
		}
?>

<?php include('hockey_form_viz.js');?>
 
	<div class="container">
		
	</div>	

	<div class="container">
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
	  Show Legend
	</button> 	
	<br>
	<!--p><b>2015-2016 in Bold</b></p-->
	<p>Source: <a href="https://github.com/C92Anderson/xG-Model" target="_blank">@CrowdScoutSprts - all statistics calculated xG Model built using nhlscrapr</a></p-->
	</div>
	<div class="collapse container-fluid" id="collapseExample"
	  <div class="well">

		<!--div class="container-fluid">
			<p><b>Note:</b> "Too Close" is used when both players are known, but can't be discerned. "Don't Know" will decrease the odds of receiving either player for a week.</p>
		</div-->

	    <div class="panel-body table table-striped">
				<table class="table table-striped">
					<tbody>
						<tr>
						<td><span class="glyphicon glyphicon-user" aria-hidden="true"></span></td>
						<td>Player Name</td>
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
						<td><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> GP</td>
						<td>Games Played, <b>2016-17</b> / 2015-16 Season - Source: <a href="https://github.com/war-on-ice/nhlscrapr" target="_blank">war-on-ice/nhlscrapr</a></td>
						</tr>
						<!--tr>
						<td><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> G60</td>
						<td>Goals/60 Minutes, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>						
						<td><span class="glyphicon glyphicon-apple" aria-hidden="true"></span> A60</td>
						<td>Assists/60 Minutes, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>						
						<td><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> P60</td>
						<td>Points/60 Minutes, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>
						<tr>			
						<td><span class="glyphicon glyphicon-record" aria-hidden="true"></span> SCF%</td>
						<td>Scoring Chance For %, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>
						<tr>	
						<td><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> CF%</td>
						<td>Corsi For %, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>
						<tr>	
						<td><span class="glyphicon glyphicon-indent-left" aria-hidden="true"></span> CF% Rel</td>
						<td>Corsi For % Relative, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>
						<tr>
						<td><span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span> CF/60</td>
						<td>Corsi For per 60 minutes, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>						
						<tr>
						<td><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span> CA/60</td>
						<td>Corsi Against per 60 minutes, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>						
						<tr>
						<td><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span> CA/60</td>
						<td>Corsi Against per 60 minutes, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>			

						<td><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Adj Sv%</td>
						<td>Adjusted Save %, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr>			
						<td><span class="glyphicon glyphicon-flash" aria-hidden="true"></span> HD Sv%</td>
						<td>High Danger Save %, <b>2015-16</b> / 2014-15 Season - Source: <a href="http://www.war-on-ice.com" target="_blank">www.war-on-ice.com</a></td>
						</tr-->							      							      							      							     
					</tbody>	
				</table>
	
			</div>
													
	  </div>
	</div>



<?php include('footer.php'); ?>

<!--type="text/javascript" language="JavaScript">
<script >
   

function ratingchange() {
     var player_name = <?php //echo json_encode($player_name1); ?>; 
     alert("Second box: " + player_name);
    setTimeout(function() {
    window.close();
    }, 3);
}
//
//window.onload = ratingchange();
 
/*function divpopup() {
    popup.show(null,null,null,{'content':'This DIV was created dynamically!',
                                                'width':200,'height':200,
                                                'style':{'border':'1px solid black','backgroundColor':'cyan'}});return false;"
}

 function closeWindow() {
    setTimeout(function() {
    window.close();
    }, 3000);
    }

    window.onload = closeWindow();
 */


</body>
</html>