<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	include($root."/includes/functions.php");
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbsel);
	if(! $conn )
	{
	  die('Could not connect: ' . mysqli_error($conn));
	}
	
	$tbl = $_POST['table'];
	
	if ($tbl == 'users'){
		$id = $_POST['userid'];
		$sql = 'DELETE FROM '.$tbl.'
			WHERE `userID` = '.$id.'';
	} else if ($tbl == 'branch'){
		$id = $_POST['branchid'];
		$sql = 'DELETE FROM '.$tbl.'
			WHERE `branchID` = '.$id.'';
	 }
	$retval = mysqli_query($conn, $sql);
	if(! $retval )
	{
	  $msg = "<div class='alert alert-danger alert-dismissible' role='alert'>
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<i class='glyphicon glyphicon-exclamation-sign'></i> Could not delete data: " . mysqli_error($conn)."</div>";
	}
	$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
		<button type='button' class='close' data-dismiss=alert aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		Deleted record successfully<div>";
		echo $msg;
		$_SESSION['status'] = $msg;

	mysqli_close($conn);
?>