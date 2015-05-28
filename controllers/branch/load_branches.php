<?php
	include($_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php');

	$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbsel);
	$myArray = array();
	if ($result = $mysqli->query("SELECT * FROM branch")) {

	    while($row = $result->fetch_array(MYSQL_ASSOC)) {
	            $myArray['data'][] = $row;
	    }
	    $myArray['status'] = 'Success';
	    echo json_encode($myArray);
	}

	$result->close();
	$mysqli->close();

?>