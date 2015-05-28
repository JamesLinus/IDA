<?
//User Maintenance Add, Delete Edit
//Access Level HQ, Admin
?>
<?
//required includes
include '../includes/dbconnect.php';
include '../includes/userdata.php';
include '../includes/functions.php';
?>

<link rel="stylesheet" href="../styles.css" type="text/css">

<h1>User Maintenance</h1>
<h3>Here you can Add, Edit, and Delete Users</h3>
<?
include '../includes/navigation.php';
?>
<div>
<?
require 'usermanagement.php';
?>
</div>