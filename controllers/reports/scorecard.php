<?php

include ($_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php');

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbsel);

if ($mysqli->connect_errno){
	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$fid = INTVAL($_POST['fid']);
$bid = INTVAL($_POST['bid']);

$query = "SELECT `Focus_areas`.*, `branch`.`branch` FROM `branch`, `Focus_areas` WHERE (`branch`.`branchid` = '".$bid."') AND (`Focus_areas`.`focus_id` = '".$fid."');";

if ($result = $mysqli->query($query)) {

    while($row = $result->fetch_array(MYSQL_ASSOC)) {
            $myArray['data']['focus_area'][] = $row;
    }
    
}

$query = "SELECT a.target_area as 'target area',
			 a.target_id as 'targetId',
			 t.main_target as 'target',
			 t.main_baseline as 'baseline',
			 t.main_strategies as 'strategies'
		FROM `target_area` as a 
		LEFT JOIN (
			SELECT `Main`.*
			 FROM `Main`
			  WHERE ((`Main`.`branch_id` = '".$bid."'))) as t on t.target_id = a.target_id
			  WHERE a.focus_id = '".$fid."';";

if ($result = $mysqli->query($query)) {

    while($row = $result->fetch_array(MYSQL_ASSOC)) {
            $myArray['data'][$row['targetId']][] = $row;

    }    
} echo $mysqli->error;

echo json_encode($myArray);
?>