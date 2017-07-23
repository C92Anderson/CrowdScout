<?php 
session_start();
//pull down player and user ids
$playerID = $_GET[playerID];
	
include('includes/database.php'); 

$player_info = $mysqli->query("SELECT a.nhl_id as player_id1, a.player_name as player_name1, a.pos as player_position1, a.team as player_team1, round(DATEDIFF(current_date(),a.dob)/365.25,1) as age1,
		a.height, a.weight, coalesce(b.draft_info, 'Undrafted') as draft_info, 

		coalesce(round(s17.ixG60_EV,3), '--') as ixG60_EV_1617, 
		coalesce(round(s17.ixG60_PP,3), '--') as ixG60_PP_1617, 

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

		coalesce(round(s16.ixG60_EV,3), '--') as ixG60_EV_1516, 
		coalesce(round(s16.ixG60_PP,3), '--') as ixG60_PP_1516, 

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
		 where a.nhl_id = $playerID") or die($mysqli->error.__LINE__);


	 
//Get results
$player_info_all = $player_info->fetch_assoc();

$mysqli->close();
	
?>

<!doctype html>
<html>

	<head>
	<meta charset="UTF-8">
	<meta name="description" content="CrowdScout Player Charts">
	<meta name="keywords" content="Hockey,Charts,Stats,Player,Scout,Scouting">
		<title>CrowdScout Player Charts</title>
	
		<?php include('header.php');?>

	 	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
	
	</head>

<body>

<div class="container">

	<div class="col-lg-12">
	<div class="panel panel-primary"-->
		<div class="panel-heading">	
			<h4><?php echo $player_info_all['player_name1'];?>, <?php echo $player_info_all['age1'];?>yo <?php echo $player_info_all['player_position1'];?> (<?php echo $player_info_all['player_team1'];?>) - <?php echo $player_info_all['draft_info'];?> <?php echo $player_info_all['height'];?> <?php echo $player_info_all['weight'];?>lbs</h4>
		</div>

		<!--div class="panel-body table table-striped">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><span class="glyphicon glyphicon-user" aria-hidden="true"></span></th>
						<th><?php echo $player_info_all['player_name1'];?></th>
					</tr>
				</thead>
						
				<tbody>
					<tr>
						<td><span class="glyphicon glyphicon-text-background" aria-hidden="true"></span></td>
						<td><?php echo $player_info_all['player_team1'];?></td>
					</tr>				
					<!--tr> 
						<td><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> Elo</td>
						<td><?php echo round($p1_elo,1);?></td>
					</tr-->
					<!--tr>
						<td><span class="glyphicon glyphicon-knight" aria-hidden="true"></span></td>
						<td><?php echo $player_info_all['player_position1'];?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></td>
						<td><?php echo $player_info_all['draft_info'];?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></td>
						<td><?php echo $player_info_all['height'];?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-scale" aria-hidden="true"></span></td>
						<td><?php echo $player_info_all['weight'];?></td>
						</tr>
					<tr>
						<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></td>
						<td><?php echo $player_info_all['age1'];?></td>
					</tr>
					<tr>
						<td><span class='glyphicon glyphicon-wrench' aria-hidden='true'></span></a> GP</td>
						<td><b><?php echo $player_info_all['Gm_1617'] . "</b> / " . $player_info_all['Gm_1516'] ; ?></td>
					</tr>

					<?php if($player_info_all['player_position1'] == "G") {
						echo "<tr>
							<td><span class='glyphicon glyphicon-tasks' aria-hidden='true'></span> xG Lift (xGA-GA)</td>
							<td><b>". $player_info_all['xGLift_1617'] ."</b> / ". $player_info_all['xGLift_1516'] ."</td>
						</tr>
						<tr>
							<td><span class='glyphicon glyphicon-flash' aria-hidden='true'></span>Surplus Points</td>
							<td><b>". $player_info_all['SurplusPts_1617'] ."</b> / ". $player_info_all['SurplusPts_1516'] ."</td>
						</tr>";
						} else { }?>							
				</tbody>	
			</table>
		</div-->


<?php if($player_info_all['player_position1'] != "G") {
			echo "<div>
				<div id='p1_prod' style='width:99%; display:inline-table;text-align:center;'></div>
				<div id='p1_xG_EV' style='width:99%; display:inline-table;text-align:center;'></div>
				<div>
				<div id='ice_share' style='width:100%; display:inline-table;text-align:center;'></div>
				
				</div>
				<div>
				<div id='usage' style='width:100%; display:inline-table;text-align:center;'></div>
				
				</div>";
	} elseif($player_info_all['player_position1'] == "G" or $echo2['player_position2'] == "G") {
			echo "<!--div>
				<div id='xglift1617' style='width:100%; display:inline-table;text-align:center;'></div>
				<div id='xglift1516' style='width:100%; display:inline-table;text-align:center;'></div>
				</div>

				<div>
				<div id='surpluspts1617' style='width:100%; display:inline-table;text-align:center;'></div>
				<div id='surpluspts1516' style='width:100%; display:inline-table;text-align:center;'></div>
				</div-->";
		}
?>


 <script type="text/javascript">
    var player_name1 = <?php echo json_encode($player_info_all['player_name1']); ?>; 
    var player_position1 = <?php echo json_encode($player_info_all['player_position1']); ?>; 
   //pull games
    var p1_Gm_1617 = <?php echo json_encode($player_info_all['Gm_1617']); ?>; 
    var p1_Gm_1516 = <?php echo json_encode($player_info_all['Gm_1516']); ?>; 
    //pull goals
    var p1_G60_EV_1617 = <?php echo json_encode($player_info_all['G60_EV_1617']); ?>; 
    var p1_G60_EV_1516 = <?php echo json_encode($player_info_all['G60_EV_1516']); ?>; 
    var p1_G60_PP_1617 = <?php echo json_encode($player_info_all['G60_PP_1617']); ?>; 
    var p1_G60_PP_1516 = <?php echo json_encode($player_info_all['G60_PP_1516']); ?>; 

   //pull individual expected goals
    var p1_ixG60_EV_1617 = <?php echo json_encode($player_info_all['ixG60_EV_1617']); ?>; 
    var p1_ixG60_PP_1617 = <?php echo json_encode($player_info_all['ixG60_PP_1617']); ?>; 
    var p1_ixG60_EV_1516 = <?php echo json_encode($player_info_all['ixG60_EV_1516']); ?>; 
    var p1_ixG60_PP_1516 = <?php echo json_encode($player_info_all['ixG60_PP_1516']); ?>; 

    //pull primary assists
    var p1_A160_EV_1617 = <?php echo json_encode($player_info_all['A160_EV_1617']); ?>; 
    var p1_A160_EV_1516 = <?php echo json_encode($player_info_all['A160_EV_1516']); ?>; 
    var p1_A160_PP_1617 = <?php echo json_encode($player_info_all['A160_PP_1617']); ?>; 
    var p1_A160_PP_1516 = <?php echo json_encode($player_info_all['A160_PP_1516']); ?>; 

    //pull secondary assists
    var p1_A260_EV_1617 = <?php echo json_encode($player_info_all['A260_EV_1617']); ?>; 
    var p1_A260_EV_1516 = <?php echo json_encode($player_info_all['A260_EV_1516']); ?>; 
    var p1_A260_PP_1617 = <?php echo json_encode($player_info_all['A260_PP_1617']); ?>; 
    var p1_A260_PP_1516 = <?php echo json_encode($player_info_all['A260_PP_1516']); ?>; 

    //pull expected goals for
    var p1_xGF60_EV_1617 = <?php echo json_encode($player_info_all['xGF60_EV_1617']); ?>; 
    var p1_xGF60_EV_1516 = <?php echo json_encode($player_info_all['xGF60_EV_1516']); ?>; 
    //pull expected goals against
    var p1_xGA60_EV_1617 = <?php echo json_encode($player_info_all['xGA60_EV_1617']); ?>; 
    var p1_xGA60_EV_1516 = <?php echo json_encode($player_info_all['xGA60_EV_1516']); ?>; 
    //pull expected goals for team without
    var p1_xGF60_TmWO_EV_1617 = <?php echo json_encode($player_info_all['xGF60_TmWO_EV_1617']); ?>; 
    var p1_xGF60_TmWO_EV_1516 = <?php echo json_encode($player_info_all['xGF60_TmWO_EV_1516']); ?>; 
    //pull expected goals for team without
    var p1_xGA60_TmWO_EV_1617 = <?php echo json_encode($player_info_all['xGA60_TmWO_EV_1617']); ?>; 
    var p1_xGA60_TmWO_EV_1516 = <?php echo json_encode($player_info_all['xGA60_TmWO_EV_1516']); ?>; 

    //ice time by team
    var p1_ShareIce_EV_1617 = <?php echo json_encode($player_info_all['ShareIce_EV_1617']); ?>; 
    var p1_ShareIce_EV_1516 = <?php echo json_encode($player_info_all['ShareIce_EV_1516']); ?>; 
    //ice time by team
    var p1_ShareIce_PP_1617 = <?php echo json_encode($player_info_all['ShareIce_PP_1617']); ?>; 
    var p1_ShareIce_PP_1516 = <?php echo json_encode($player_info_all['ShareIce_PP_1516']); ?>; 
    //ice time by team
    var p1_ShareIce_SH_1617 = <?php echo json_encode($player_info_all['ShareIce_SH_1617']); ?>; 
    var p1_ShareIce_SH_1516 = <?php echo json_encode($player_info_all['ShareIce_SH_1516']); ?>; 

    //even strength usage
    var p1_OTFShift_1617 = <?php echo json_encode($player_info_all['OTFShift_1617']); ?>; 
    var p1_OTFShift_1516 = <?php echo json_encode($player_info_all['OTFShift_1516']); ?>; 
   //even strength usage
    var p1_FOOffShift_1617 = <?php echo json_encode($player_info_all['FOOffShift_1617']); ?>; 
    var p1_FOOffShift_1516 = <?php echo json_encode($player_info_all['FOOffShift_1516']); ?>; 
   //even strength usage
    var p1_FODefShift_1617 = <?php echo json_encode($player_info_all['FODefShift_1617']); ?>; 
    var p1_FODefShift_1516 = <?php echo json_encode($player_info_all['FODefShift_1516']); ?>; 
    //even strength usage
    var p1_FONeuShift_1617 = <?php echo json_encode($player_info_all['FONeuShift_1617']); ?>; 
    var p1_FONeuShift_1516 = <?php echo json_encode($player_info_all['FONeuShift_1516']); ?>; 

    //GOALIES
    //xG Lift
    var p1_xGLift_1617 = <?php echo json_encode($player_info_all['xGLift_1617']); ?>; 
    var p1_xGLift_1516 = <?php echo json_encode($player_info_all['xGLift_1516']); ?>; 
    //surplus points
    var p1_SurplusPts_1617 = <?php echo json_encode($player_info_all['SurplusPts_1617']); ?>; 
    var p1_SurplusPts_1516 = <?php echo json_encode($player_info_all['SurplusPts_1516']); ?>; 

	//PLAYER 1 PRODUCTION


/*
G60_EV_P33 <- summarise(group_by(crowdscout_data_predictions[crowdscout_data_predictions$TOI_EV > 6000, ],Pos), G60_EV_P33 = quantile(G60_EV, probs = 0.33))
G60_EV_P66 <- summarise(group_by(crowdscout_data_predictions[crowdscout_data_predictions$TOI_EV > 6000, ],Pos), G60_EV_P66 = quantile(G60_EV, probs = 0.66))

G60_PP_P33 <- summarise(group_by(crowdscout_data_predictions[crowdscout_data_predictions$TOI_PP > 600, ],Pos), G60_PP_P33 = quantile(G60_PP, probs = 0.33))
G60_PP_P66 <- summarise(group_by(crowdscout_data_predictions[crowdscout_data_predictions$TOI_PP > 600, ],Pos), G60_PP_P66 = quantile(G60_PP, probs = 0.66))

P60_EV_P33 <- summarise(group_by(crowdscout_data_predictions[crowdscout_data_predictions$TOI_EV > 6000, ],Pos), P60_EV_P33 = quantile(P60_EV, probs = 0.33))
P60_EV_P66 <- summarise(group_by(crowdscout_data_predictions[crowdscout_data_predictions$TOI_EV > 6000, ],Pos), P60_EV_P66 = quantile(P60_EV, probs = 0.66))

P60_PP_P33 <- summarise(group_by(crowdscout_data_predictions[crowdscout_data_predictions$TOI_PP > 600, ],Pos), P60_PP_P33 = quantile(P60_PP, probs = 0.33))
P60_PP_P66 <- summarise(group_by(crowdscout_data_predictions[crowdscout_data_predictions$TOI_PP > 600, ],Pos), P60_PP_P66 = quantile(P60_PP, probs = 0.66))

  Pos G60_EV_P33 G60_EV_P66 G60_PP_P33 G60_PP_P66 P60_EV_P33 P60_EV_P66 P60_PP_P33 P60_PP_P66
1   D 0.08269131  0.1840345  0.0000000  0.8027496  0.5242706  0.7448472   2.171704   3.639305
2   F 0.47343636  0.7365397  0.7549532  1.7200488  1.2132062  1.6888405   2.617703   4.171417
*/

if(player_position1 == "D") {

	G60_P33 = [0.082,0.082,0,0]
	G60_P66 = [0.184,0.184,0.80,0.80]
	P60_P33 = [0.524,0.524,2.17,2.17]
	P60_P66 = [0.744,0.744,3.639,3.639]
} else {
	G60_P33 = [0.473,0.473,0.755,0.755]
	G60_P66 = [0.737,0.737,1.720,1.720]
	P60_P33 = [1.213,1.213,2.617,2.617]
	P60_P66 = [1.688,1.688,4.171,4.171]

}

	var G60_P33 = {
		  x: ['EV 2015-16','EV 2016-17','PP 2015-16','PP 2016-17'],
		  y: G60_P33,
		  name: 'G60 33th Pctl (by Position)',
		  //showlegend: false,
		  line: {shape: 'hvh'},
	  	  mode: 'lines'

  	};

	var G60_P66 = {
		  x: ['EV 2015-16','EV 2016-17','PP 2015-16','PP 2016-17'],
		  y: G60_P66,
		  name: 'G60 66th Pctl (by Position)',
		  line: {shape: 'hvh'},
	  	  mode: 'lines'
  	};

	var P60_P33 = {
		  x: ['EV 2015-16','EV 2016-17','PP 2015-16','PP 2016-17'],
		  y: P60_P33,
		  name: 'P60 33th Pctl (by Position)',
		  line: {shape: 'hvh'},
	  	  mode: 'lines'
  	};

	var P60_P66 = {
		  x: ['EV 2015-16','EV 2016-17','PP 2015-16','PP 2016-17'],
		  y: P60_P66,
		  name: 'P60 66th Pctl (by Position)',
		  line: {shape: 'hvh'},
	  	  mode: 'lines'
  	};

	var p1_A160 = {
		  x: ['EV 2015-16','EV 2016-17','PP 2015-16','PP 2016-17'],
		  y: [p1_A160_EV_1516, p1_A160_EV_1617,p1_A160_PP_1516, p1_A160_PP_1617],
		  name: 'Primary Assists/60',
		  type: 'bar'
		};

	var p1_A260 = {
		  x: ['EV 2015-16','EV 2016-17','PP 2015-16','PP 2016-17'],
		  y: [p1_A260_EV_1516, p1_A260_EV_1617,p1_A260_PP_1516, p1_A260_PP_1617],
		  name: 'Secondary Assists/60',
		  type: 'bar'
		};

	var p1_G60 = {
		  x: ['EV 2015-16','EV 2016-17','PP 2015-16','PP 2016-17'],
		  y: [p1_G60_EV_1516, p1_G60_EV_1617, p1_G60_PP_1516, p1_G60_PP_1617],
		  name: 'Goals/60',
		  type: 'bar'
		};

	var p1_ixG60 = {
		  x: ['EV 2015-16','EV 2016-17','PP 2015-16','PP 2016-17'],
		  y: [p1_ixG60_EV_1516, p1_ixG60_EV_1617,p1_ixG60_PP_1516, p1_ixG60_PP_1617],
		  name: 'Individual Expected Goals/60',
		  mode: 'markers',
		  type: 'scatter',
		  marker: { size: 10 }
		};


	var p1_prod = [p1_G60,p1_A160,p1_A260,p1_ixG60,G60_P33,G60_P66,P60_P33,P60_P66]; 

	var layout = {
			title: player_name1 + ' Offensive Production - @CrowdScoutSprts',
			  yaxis: {
		    title: 'Scoring/60 minutes',
		    	    },
				   	  width: 1000,

		barmode:'stack'}; //STACK

	Plotly.newPlot('p1_prod', p1_prod, layout);



	//PLAYER 1 XG IMPACTS
	xGF_EV_p90 = 2.60;
	xGF_EV_p66 = 2.24;
	xGF_EV_p33 = 1.88;
	xGF_EV_p10 = 1.05;
//     10%      33%      50%      66%      90% 
//1.054007 1.875843 2.070491 2.236984 2.600643 
//      10%       33%       50%       66%       90% 
//-2.523485 -2.265240 -2.128735 -1.994394 -1.384833 

	xGA_EV_p90 = -1.38;
	xGA_EV_p66 = -1.99;
	xGA_EV_p33 = -2.27;
	xGA_EV_p10 = -2.52;

	var labels = {
		  x: [xGA_EV_p10-0.1, xGA_EV_p10-0.1, xGA_EV_p90+0.1, xGA_EV_p90+0.1],
		  y: [xGF_EV_p10-0.1, xGF_EV_p90+0.1, xGF_EV_p90+0.1, xGF_EV_p10-0.1],
		  text: ['Bad', 'Exciting', 'Good','Dull'],
		  name: '',
		  showlegend: false,
		  mode: 'text'
		};

	var p10_D = {
		  x: [xGA_EV_p10, xGA_EV_p10],
		  y: [xGF_EV_p10, xGF_EV_p90],
		  name: 'Def 10th Pctl',
		  showlegend: false,
	  	  mode: 'lines',
		  line: {color: 'grey', width: 1.5 }
  	};

	var p90_D = {
		  x: [xGA_EV_p90, xGA_EV_p90],
		  y: [xGF_EV_p10, xGF_EV_p90],
		  name: 'Def 90th Pctl',
		  showlegend: false,
	  	  mode: 'lines',
		  line: {color: 'grey', width: 1.5 }
  	};

	var p10_O = {
		  x: [xGA_EV_p10, xGA_EV_p90],
		  y: [xGF_EV_p10, xGF_EV_p10],
		  name: 'Off 10th Pctl',
		  showlegend: false,
	  	  mode: 'lines',
		  line: {color: 'grey', width: 1.5 }
  	};

	var p90_O = {
		  x: [xGA_EV_p10, xGA_EV_p90],
		  y: [xGF_EV_p90, xGF_EV_p90],
		  name: 'Off 90th Pctl',
		  showlegend: false,
	  	  mode: 'lines',
		  line: {color: 'grey', width: 1.5 }
  	};


	var p33_D = {
		  x: [xGA_EV_p33, xGA_EV_p33],
		  y: [xGF_EV_p33, xGF_EV_p66],
		  name: 'Def 33th Pctl',
		  showlegend: false,
	  	  mode: 'lines',
		  line: {color: 'grey', width: 1.5 }
  	};

	var p66_D = {
		  x: [xGA_EV_p66, xGA_EV_p66],
		  y: [xGF_EV_p33, xGF_EV_p66],
		  name: 'Def 66th Pctl',
		  showlegend: false,
	  	  mode: 'lines',
		  line: {color: 'grey', width: 1.5 }
  	};

	var p33_O = {
		  x: [xGA_EV_p33, xGA_EV_p66],
		  y: [xGF_EV_p33, xGF_EV_p33],
		  name: 'Off 33th Pctl',
		  showlegend: false,
	  	  mode: 'lines',
		  line: {color: 'grey', width: 1.5 }
  	};

	var p66_O = {
		  x: [xGA_EV_p33, xGA_EV_p66],
		  y: [xGF_EV_p66, xGF_EV_p66],
		  name: 'Off 66th Pctl',
		  showlegend: false,
	  	  mode: 'lines',
		  line: {color: 'grey', width: 1.5 }
  	};


	var diagonal = {
		  x: [xGA_EV_p90+0.05, xGA_EV_p10-0.05],
		  y: [xGF_EV_p10-0.05, xGF_EV_p90+0.05],
		  showlegend: false,
	  	  name: '',
	  	  mode: 'lines',
		  line: {color: 'grey', width: 1 }

  	};

	var p1_xG_On = {
		  x: [p1_xGA60_EV_1516,p1_xGA60_EV_1617],
		  y: [p1_xGF60_EV_1516,p1_xGF60_EV_1617],
		  mode: 'markers',
		  name: 'Player On',
		  //text: ['Player On 201516','Player On 201617'],
  		  marker: { size: [10,15]  },
		  type: 'scatter'
		};

	var p1_xG_Off = {
		  x: [p1_xGA60_TmWO_EV_1516, p1_xGA60_TmWO_EV_1617],
		  y: [p1_xGF60_TmWO_EV_1516, p1_xGF60_TmWO_EV_1617],
		  mode: 'markers',
		  name: 'Player Off',
 		  //text: ['Player Off 201516','Player Off 201617'],
  		  marker: { size: [6,9] },
		  type: 'scatter'
		};

	var p1_xG_impact16 = {
		  x: [p1_xGA60_TmWO_EV_1516, p1_xGA60_EV_1516],
		  y: [p1_xGF60_TmWO_EV_1516, p1_xGF60_EV_1516],
		  mode: 'lines+markers',
		 //text: ['Player Off 201516','Player On 201516'],
		  name: 'xG 1516 Impact',
  		  marker: { size: [10,20] },
		  type: 'scatter'
		};

	var p1_xG_impact17 = {
		  x: [p1_xGA60_TmWO_EV_1617, p1_xGA60_EV_1617],
		  y: [p1_xGF60_TmWO_EV_1617, p1_xGF60_EV_1617],
		  mode: 'lines+markers',
		  //text: ['Player Off 201617','Player On 201617'],
		  name: 'xG 1617 Impact',
  		  marker: { size: [15,30] },
		  type: 'scatter'
		};

	var p1_xG_EV = [labels,p10_D,p90_D,p10_O,p90_O,p33_D,p66_D,p33_O,p66_O, 
	p1_xG_impact17,p1_xG_impact16, p1_xG_On, p1_xG_Off]; 

	var layout = {showlegend: true,
			//legend: {"orientation": "h"},
			title: player_name1 + ' EV xG Impact - @CrowdScoutSprts',
			  yaxis: {title: 'Team Expected Goals For / 60 mins',
		 },
			  xaxis: {title: 'Team Expected Goals Against / 60 mins',
		 },

  

		   	  width: 1000,
			  height: 1000,
			  shapes: [
			    {
			      type: 'line',
			      x0: xGA_EV_p90, y0: xGF_EV_p10, x1: xGA_EV_p10, y1: xGF_EV_p90,
			      line: { color: 'grey', width: 1 }
			      }
			  ]
			};


	Plotly.newPlot('p1_xG_EV', p1_xG_EV, layout);


	//Ice Time
	var share_iceEV = {
		  x: ['2015-16','2016-17'],
		  y: [p1_ShareIce_EV_1516,p1_ShareIce_EV_1617],
		  name: 'EV',
		  type: 'bar'
		};

	var share_icePP = {
		  x: ['2015-16','2016-17'],
		  y: [p1_ShareIce_PP_1516,p1_ShareIce_PP_1617],
		  name: 'PP',
		  type: 'bar'
		};

	var share_iceSH = {
		  x: ['2015-16','2016-17'],
		  y: [p1_ShareIce_SH_1516,p1_ShareIce_SH_1617],
		  name: 'SH',
		  type: 'bar'
		};

	var ice_share = [share_iceEV,share_icePP,share_iceSH]; 

	var layout = {
			title: player_name1 + ' Share of Team Icetime' + ' - @CrowdScoutSprts',
			  yaxis: {
		    title: 'Share of Time Player On-Ice in Games Played',
		    tickformat: ',.0%'
		    	    },
			 width: 1000,	
		barmode:'group'}; //STACK

	Plotly.newPlot('ice_share', ice_share, layout);



	///Player Usages
	var PlayerUsage_OTF = {
		  y: ['2015-16','2016-17'],
		  x: [p1_OTFShift_1516, p1_OTFShift_1617],
		  name: 'On The Fly',
		  type: 'bar',
		  orientation: 'h'
		};

	var PlayerUsage_Off = {
		  y: ['2015-16','2016-17'],
		  x: [p1_FOOffShift_1516, p1_FOOffShift_1617],
		  name: 'Offensive Zone Faceoff',
		  type: 'bar',
		  orientation: 'h'
		};

	var PlayerUsage_Def = {
		  y: ['2015-16','2016-17'],
		  x: [p1_FODefShift_1516, p1_FODefShift_1617],
		  name: 'Defensive Zone Faceoff',
		  type: 'bar',
		  orientation: 'h'
		};

	var PlayerUsage_Neu = {
		  y: ['2015-16','2016-17'],
		  x: [p1_FONeuShift_1516, p1_FONeuShift_1617],
		  name: 'Neutral Zone Faceoff',
		  type: 'bar',
		  orientation: 'h'

		};


	var usage = [PlayerUsage_Off, PlayerUsage_Def, PlayerUsage_Neu, PlayerUsage_OTF]; 

	var layout = {
			title: player_name1 + ' Even Strength Shift Starts - @CrowdScoutSprts',
			xaxis: {
		    title: 'Share of Shift Starts',
		    tickformat: ',.0%',
		    range: [0,1]
		    	    },
			width: 1000,
	
		barmode:'stack'}; //STACK

	Plotly.newPlot('usage', usage, layout);


  </script>

 
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
						      							      							      							     
					</tbody>	
				</table>
	
			</div>
	


<?php include('footer.php'); ?>
