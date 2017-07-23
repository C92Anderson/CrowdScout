<?php 

$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","crowdscout_main");
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

date_default_timezone_set('US/Eastern');
$current_ts = time();

////////////////////////////////////
///LEAGUE ENDED EMAIL
////////////////////////////////////

//check to see if league warning email has been sent
//UTC time converted to EST (+3 hours) has passed the comp_end_ts
//where competition start is within 10 mins
$start_lg_alert = $conn->query("SELECT DISTINCT league_name
									from `crowdscout_main`.`fantasy_leagues_v0`
									where ( current_time() + INTERVAL '3' HOUR - INTERVAL '10' MINUTES ) <comp_start_ts < ( current_time() + INTERVAL '3' HOUR )
									and league_name not in (select distinct league_name from `crowdscout_main`.`fantasy_alert_v0`)");

//////FETCH ASSOCATION??

if(isset($start_lg_alert)) {

	foreach($start_lg_alert as $league_alert) {

		//pull league name
		$league_alert = $league_alert['league_name'];
		$_POST['league_alert'] = $league_alert;

		//find league emails
		$lg_email = $conn->query("SELECT DISTINCT comp_email
											from `crowdscout_main`.`fantasy_competitors_v0`
											where league_name = '$league_alert'");



		//league display information
		$leagues_info = $conn->query("SELECT distinct a.league_name, a.comp_email, a.comp_start_ts, a.comp_start_ts_raw, a.comp_end_ts, a.comp_end_ts_raw, b.hockey_on, b.football_on, b.gp_bonus, length,length_units FROM fantasy_competitors_v0 as a INNER JOIN fantasy_leagues_v0 as b ON a.league_name=b.league_name WHERE a.league_name = $league_alert");

			//make sure email is in a league, else send to fantasy new page
		$league_check = $leagues_info->fetch_assoc();	
		$league_check = count($league_check);

		$leagues_info = $leagues_info->fetch_assoc();	
		$league_name = $leagues_info['league_name'];
		$user_name = $leagues_info['user_name'];
		$length = $leagues_info['length'];
		$length_units = $leagues_info['length_units'];
		$gp_bonus = $leagues_info['gp_bonus'];
		
		$football_on = $leagues_info['football_on'];
		$hockey_on = $leagues_info['hockey_on'];

		if($football_on == 1 & $hockey_on == 1) {
			$game_type = "Both Football and Hockey";
		} elseif ($football_on == 1 & $hockey_on == 0) {
			$game_type = "Football";
		} elseif ($football_on == 0 & $hockey_on == 1) {
			$game_type = "Hockey";
		}
		//email each users
		foreach ($lg_email as $email) {

			$email = trim($email['comp_email']);
			$league_alert = $_POST['league_alert'];


			//register competition as over
			$complete_insert = $conn->query("INSERT INTO `crowdscout_main`.`fantasy_alert_v0`
								(league_name, email, comp_start_ts, comp_end_ts)
										VALUES ('$league_alert','$email','$comp_start_ts','$comp_end_ts')");



			$to = trim($email); // send to commissioner
		   	$from = "info@crowdscoutsports.com"; // this is the sender's Email address
		    $subject = "Your CrowdScout Sports Fantasy League " . strtoupper($league_alert) . "Begins in " . ($leagues_info['comp_start_ts_raw'] - current_ts()) / (1000 * 60) . "Minutes!";
		    $headers .= "From: CrowdScout Sports <info@crowdscoutsports.com> \r\n";
			$headers .= "Reply-To: info@crowdscoutsports.com \r\n";
			//$headers .= "CC: info@crowdscoutsports.com \r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		    
		    $message = '<html><body><img src="http://crowdscoutsports.com/images/logo_v4.png" height="90" width="333" alt="CrowdScout Sports"><h3>Saddle Up ' . strtoupper($user_name). '! You are </h3>
		    	<p>Get ready to demonstrate your superiority scouting  <b>' . $game_type . '</b>! You have ' . $length ' ' . $length_units . '  to separate yourself from the rest of the pack. You will receive a <b>' . $gp_bonus . '</b> Games Played Bonus.</p><br>
				<h4>
		    	<a href="crowdscoutsports.com/signin.php" target="_blank">Sign In to your current account here</a><br>   
		    	<a href="crowdscoutsports.com/register.php" target="_blank">Not yet registered?! Do it now!</a><br>

		    	<a href="crowdscoutsports.com/fantasy.php" target="_blank">View fanatasy leagues here</a><br>
		    	<a href="crowdscoutsports.com/fantasy_new.php" target="_blank">Start a league</a><br>

		    	<br>
		    	</h4>
		    	<h3>CrowdScout Sports Fantasy Details</h3>
		    	<p><li>Overview: Commissioners have complete flexibility in competition length, number of teams, and user scoring</li>
		    		<li>Scoring: You will be asked to choose between 2 similar athletes (known as a "game"), and effectively betting on the player you select. The 30 players that you bet on cumulatively the most will make up your favorites team. Conversely, those you bet against will be on your bashed team. You will receive a score based on the how the rest well the rest of the crowd perceives those players at the end of the competition.</li>
		    		<li>Games Played Bonus: You can choose to add a bonus for the number games each user plays throughout the competition - a game being selecting between two players (or deferring). A "Low" bonus rewards 1/100th of a point for each game, "Medium" rewards 1/50th of a point for each game, and "High" 1/10th of a point for each game. A "High" Bonus also users to effectively hustle their way to victory.</li>
		    		</p>

		    	<h3>What is CrowdScout Sports Fantasy?</h3>
			    	<p>Ever disagreed with an "expert" player evaluation?

						CrowdScout Sports is a platform designed to aggregate user opinions to create dynamic and comprehensive player ratings. It also identifies the best and most knowledgeable contributors giving them more influence the ratings.


						CrowdScout Fantasy rewards those users that can consistently and accurately gauge player talent. Points are rewarded whenever the crowd begins to agree with you, not just a few arbitrary plays on Sundays.

						Give it a try - not only will you be helping create unique and powerful data, you will be able to demonstrate an ability for identifying talent and deep knowledge of the game.
		    	</p>
		    	<p>Thanks and good luck! If you have any questions please reach out to <a href="mailto:info@crowdscoutsports.com?Subject=CrowdScout Comment" target="_top"> info@crowdscoutsports.com</a></p>
		    	</body></html>';


				mail($to,$subject,$message,$headers);	

   			    echo 'to: ' . $to . '<br>message: ' . $message ;


		}
	}	
}