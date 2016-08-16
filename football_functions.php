<?php

function pairsimFB($comps) {

		$posF_list = "All";
		if($_SESSION['pFQB']==1) {  $posF_list = $posF_list.'|QB'; }
		if($_SESSION['pFRB']==1) {  $posF_list = $posF_list.'|RB|FB|HB'; }
		if($_SESSION['pFWR']==1) {  $posF_list = $posF_list.'|WR'; }
		if($_SESSION['pFTE']==1) {  $posF_list = $posF_list.'|TE'; }
		if($_SESSION['pFOL']==1) {  $posF_list = $posF_list.'|OT|OG|OC'; }
		if($_SESSION['pFDL']==1) {  $posF_list = $posF_list.'|DL|DE|DT|NT'; }
		if($_SESSION['pFLB']==1) {  $posF_list = $posF_list.'|IB|ILB|LB|MLB|OB|OLB|OL'; }
		if($_SESSION['pFS_CB']==1) {  $posF_list = $posF_list.'|CB|FS|SS|S'; }
		if($_SESSION['pFSpec']==1) {  $posF_list = $posF_list.'|PK|K|P|LS'; }
	
		if($posF_list=="All") {
		   $posF_list = "QB|RB|FB|HB|WR|TE|OT|OG|OC|OL|DL|DE|DT|NT|IB|ILB|LB|MLB|OB|OLB|CB|FS|SS|S|PPK|K|P|LS";
		}



		$teamF_list = "All";
			if($_SESSION['tFBUF']==1) {  $teamF_list = $teamF_list.'|BUF'; }
			if($_SESSION['tFARZ']==1) {  $teamF_list = $teamF_list.'|ARZ'; }
			if($_SESSION['tFATL']==1) {  $teamF_list = $teamF_list.'|ATL'; }
			if($_SESSION['tFBAL']==1) {  $teamF_list = $teamF_list.'|BAL'; }
			if($_SESSION['tFCAR']==1) {  $teamF_list = $teamF_list.'|CAR'; }
			if($_SESSION['tFCHI']==1) {  $teamF_list = $teamF_list.'|CHI'; }
			if($_SESSION['tFCIN']==1) {  $teamF_list = $teamF_list.'|CIN'; }
			if($_SESSION['tFCLE']==1) {  $teamF_list = $teamF_list.'|CLE'; }
			if($_SESSION['tFDAL']==1) {  $teamF_list = $teamF_list.'|DAL'; }
			if($_SESSION['tFDEN']==1) {  $teamF_list = $teamF_list.'|DEN'; }
			if($_SESSION['tFDET']==1) {  $teamF_list = $teamF_list.'|DET'; }
			if($_SESSION['tFGB']==1) {  $teamF_list = $teamF_list.'|GB'; }
			if($_SESSION['tFHOU']==1) {  $teamF_list = $teamF_list.'|HOU'; }
			if($_SESSION['tFIND']==1) {  $teamF_list = $teamF_list.'|IND'; }
			if($_SESSION['tFJAX']==1) {  $teamF_list = $teamF_list.'|JAX'; }
			if($_SESSION['tFKC']==1) {  $teamF_list = $teamF_list.'|KC'; }
			if($_SESSION['tFMIA']==1) {  $teamF_list = $teamF_list.'|MIA'; }
			if($_SESSION['tFMIN']==1) {  $teamF_list = $teamF_list.'|MIN'; }
			if($_SESSION['tFNE']==1) {  $teamF_list = $teamF_list.'|NE'; }
			if($_SESSION['tFNO']==1) {  $teamF_list = $teamF_list.'|NO'; }
			if($_SESSION['tFNYG']==1) {  $teamF_list = $teamF_list.'|NYG'; }
			if($_SESSION['tFNYJ']==1) {  $teamF_list = $teamF_list.'|NYJ'; }
			if($_SESSION['tFOAK']==1) {  $teamF_list = $teamF_list.'|OAK'; }
			if($_SESSION['tFPHI']==1) {  $teamF_list = $teamF_list.'|PHI'; }
			if($_SESSION['tFPIT']==1) {  $teamF_list = $teamF_list.'|PIT'; }
			if($_SESSION['tFSD']==1) {  $teamF_list = $teamF_list.'|SD'; }
			if($_SESSION['tFSEA']==1) {  $teamF_list = $teamF_list.'|SEA'; }
			if($_SESSION['tFSF']==1) {  $teamF_list = $teamF_list.'|SF'; }
			if($_SESSION['tFLA']==1) {  $teamF_list = $teamF_list.'|STL|RAM|LA'; }
			if($_SESSION['tFTB']==1) {  $teamF_list = $teamF_list.'|TB'; }
			if($_SESSION['tFTEN']==1) {  $teamF_list = $teamF_list.'|TEN'; }
			if($_SESSION['tFWSH']==1) {  $teamF_list = $teamF_list.'|WSH'; }

			if($teamF_list=="All") {
				$teamF_list="BUF|ARZ|ATL|BAL|CAR|CHI|CIN|CLE|DAL|DEN|DET|GB|HOU|IND|JAX|KC|MIA|MIN|NE|NO|NYG|NYJ|OAK|PHI|PIT|SD|SEA|SF|LA|TB|TEN|WSH";
		}


	$mysqli = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","football_all");
	// Check connection
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	} 
	
//	$p1 = '' ;
//	$p2 = '' ;
	//call player 1
	$q1 = $mysqli->query("SELECT player_id1, player1, player_name AS player2, cs_id AS player_id2, (
				(CASE WHEN pos = pos1
				THEN 10 
				ELSE 0 
				END) 
				+ (CASE WHEN pos REGEXP  ('CB|FS|SS|S') and pos1 REGEXP ('CB|FS|SS|S') THEN 7 ELSE 0 END) 
				+ (CASE WHEN pos REGEXP  ('DE|DT|IB|ILB|LB|MLB|NT|OB|OLB') and pos1 REGEXP ('DE|DT|IB|ILB|LB|MLB|NT|OB|OLB') THEN 7	ELSE 0 END) 
				+ (CASE WHEN pos REGEXP  ('OT|OG|OC') and pos1 REGEXP ('OT|OG|OC') THEN 7 ELSE 0 END) 
				+ (CASE WHEN pos REGEXP  ('FB|HB|RB') and pos1 REGEXP ('FB|HB|RB') THEN 7 ELSE 0 END) 
				+ (CASE WHEN pos REGEXP  ('WR|TE') and pos1 REGEXP ('WR|TE') THEN 7 ELSE 0 END) 
				+ (CASE WHEN pos REGEXP  ('QB') and pos1 REGEXP ('QB') THEN 7 ELSE 0 END) 
			
				- ( ABS( DATEDIFF( dob1, dob ) ) / 365.25 ) + ( 
				CASE WHEN team = team1
				THEN 12 
				ELSE 0 
				END )) AS SIM, pos as pos2, pos1, team as team2, team1, dob as dob2, dob1
				
				FROM 

				(SELECT * 
				FROM football_roster_R
				ORDER BY RAND( ) 
				LIMIT $comps	) AS A

				JOIN 
				(SELECT cs_id AS player_id1, player_name AS player1,  `pos` AS pos1,  `team` AS team1,  `dob` AS dob1
				FROM football_roster_R

				WHERE `pos` REGEXP ('$posF_list')
				AND `team` REGEXP ('$teamF_list')

 				ORDER BY RAND( ) 				
				LIMIT 1
				) AS B

				WHERE A.cs_id <> B.player_id1
				ORDER BY SIM DESC
				LIMIT 1") or die($mysqli->error.__LINE__);

				$pair = $q1->fetch_assoc();

			$p1 = $pair['player_id1'] ;
			$p2 = $pair['player_id2'] ;

		echo "'football_form.php?p1=$p1&p2=$p2'" ; 		//AND `team` REGEXP ('$teamF_list')

$mysqli->close();
}

?>