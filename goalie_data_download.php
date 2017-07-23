<?php

include('includes/database.php'); 

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}

$result = $mysqli->query('SELECT * FROM `nhl_all`.`goalie_season_stats`');
if (!$result) die('Couldn\'t fetch records');
$num_fields = $result->field_count;

$headers = array();
for ($i = 0; $i < $num_fields; $i++) {
    $headers[] = mysqli_field_name($result , $i);
}
$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="crowdscout_goalie_data_download.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}

?>