<?php

include('includes/database.php'); 



if(isset($_POST['search'])){ 
	
	$search=strtoupper($_POST['search']);

	$player_id = $mysqli->query("SELECT distinct nhl_id from hockey_roster_v1 WHERE upper(player_name) = '$search'") or die($mysqli->error.__LINE__);

	$player_id = $player_id->fetch_assoc();

	echo strlen($player_id['nhl_id']);

	if(strlen($player_id['nhl_id'])>0) {
		$url = 'hockey_player_chart.php?playerID='.$player_id['nhl_id'];
		header("Location: $url");
	} else {
	//	echo "Not a NHL Player";
		$_GET['msg'] = 'notplayer';
		header("Location: index.php");
	}

	

}


if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql =  $mysqli->query("SELECT distinct nhl_id, player_name from hockey_roster_v1 WHERE upper(player_name) = LIKE '%{$query}%'");
	$array = array();
    while ($row = $sql->fetch_assoc()){
        $array[] = array (
            'label' => $row['player_name'].', '.$row['nhl_id'],
            'value' => $row['player_name'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}
?>

<script>
        $(document).ready(function() {

            $('input.search').typeahead({
                name: 'search',
                remote: 'search.php?query=%QUERY'

            });

        })
    </script>