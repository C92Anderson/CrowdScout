<?php include('includes/database.php'); ?>

<?php

function pairsimHKY($select) {

	include('includes/database.php');


$pos_list = "All";
if($_SESSION['pC']==1) {  $pos_list = $pos_list."|C"; }
if($_SESSION['pW']==1) {  $pos_list = $pos_list."|W"; }
if($_SESSION['pD']==1) {  $pos_list = $pos_list."|D"; }
if($_SESSION['pG']==1) {  $pos_list = $pos_list."|G"; }
if($pos_list=="All") {
	$pos_list = "C|W|D|G" ;
}


$team_list = "All";
if($_SESSION['tANA']==1) {  $team_list = $team_list.'|ANA'; }
if($_SESSION['tARI']==1) {  $team_list = $team_list.'|ARI'; }
if($_SESSION['tBOS']==1) {  $team_list = $team_list.'|BOS'; }
if($_SESSION['tBUF']==1) {  $team_list = $team_list.'|BUF'; }
if($_SESSION['tCAR']==1) {  $team_list = $team_list.'|CAR'; }
if($_SESSION['tCBJ']==1) {  $team_list = $team_list.'|CBJ'; }
if($_SESSION['tCGY']==1) {  $team_list = $team_list.'|CGY'; }
if($_SESSION['tCHI']==1) {  $team_list = $team_list.'|CHI'; }
if($_SESSION['tCOL']==1) {  $team_list = $team_list.'|COL'; }
if($_SESSION['tDAL']==1) {  $team_list = $team_list.'|DAL'; }
if($_SESSION['tDET']==1) {  $team_list = $team_list.'|DET'; }
if($_SESSION['tEDM']==1) {  $team_list = $team_list.'|EDM'; }
if($_SESSION['tFLA']==1) {  $team_list = $team_list.'|FLA'; }
if($_SESSION['tLAK']==1) {  $team_list = $team_list.'|LAK'; }
if($_SESSION['tMIN']==1) {  $team_list = $team_list.'|MIN'; }
if($_SESSION['tMTL']==1) {  $team_list = $team_list.'|MTL'; }
if($_SESSION['tNJD']==1) {  $team_list = $team_list.'|NJD'; }
if($_SESSION['tNSH']==1) {  $team_list = $team_list.'|NSH'; }
if($_SESSION['tNYI']==1) {  $team_list = $team_list.'|NYI'; }
if($_SESSION['tNYR']==1) {  $team_list = $team_list.'|NYR'; }
if($_SESSION['tOTT']==1) {  $team_list = $team_list.'|OTT'; }
if($_SESSION['tPHI']==1) {  $team_list = $team_list.'|PHI'; }
if($_SESSION['tPIT']==1) {  $team_list = $team_list.'|PIT'; }
if($_SESSION['tSJS']==1) {  $team_list = $team_list.'|SJS'; }
if($_SESSION['tSTL']==1) {  $team_list = $team_list.'|STL'; }
if($_SESSION['tTBL']==1) {  $team_list = $team_list.'|TBL'; }
if($_SESSION['tTOR']==1) {  $team_list = $team_list.'|TOR'; }
if($_SESSION['tVAN']==1) {  $team_list = $team_list.'|VAN'; }
if($_SESSION['tWPG']==1) {  $team_list = $team_list.'|WPG'; }
if($_SESSION['tWSH']==1) {  $team_list = $team_list.'|WSH'; }
if($team_list=="All") {
		$team_list = "ANA|ARI|BOS|BUF|CAR|CBJ|CGY|CHI|COL|DAL|DET|EDM|FLA|LAK|MIN|MTL|NJD|NSH|NYI|NYR|OTT|PHI|PIT|SJS|STL|TBL|TOR|VAN|WPG|WSH";
}


	//call player 1
	$q1 = $mysqli->query("SELECT player_id1, player1, player_name AS player2, nhl_id AS player_id2, (
			(CASE WHEN pos = pos1
				THEN 13 
				ELSE 0 
				END) +
				(CASE WHEN (pos REGEXP ('C|W') and pos1 REGEXP ('C|W') )
				THEN 5 
				ELSE 0
				END)
				- ( ABS( DATEDIFF( dob1, dob ) ) / 365.25 ) + ( 
				CASE WHEN team = team1
				THEN 10 
				ELSE 0 
				END )) AS SIM	
				FROM 
				(SELECT * 
				FROM hockey_roster_v1
				ORDER BY RAND( ) 
				LIMIT $select) AS A
				JOIN (

				SELECT nhl_id AS player_id1, player_name AS player1,  `pos` AS pos1,  `team` AS team1,  `dob` AS dob1
				FROM hockey_roster_v1
				WHERE pos REGEXP ('$pos_list')
				AND team REGEXP ('$team_list')
				ORDER BY RAND( ) 
				LIMIT 1
				) AS B
				WHERE nhl_id <> player_id1
				ORDER BY SIM DESC
				LIMIT 1") or die($mysqli->error.__LINE__);
					
			$pair = $q1->fetch_assoc();
					
			$p1 = $pair['player_id1'] ;
			$p2 = $pair['player_id2'] ;

			echo "'hockey_form.php?p1=$p1&p2=$p2'" ;  

$mysqli->close();
}

		

?>