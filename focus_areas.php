
<?
//required includes
include 'includes/dbconnect.php';
include 'includes/functions.php';
include 'includes/userdata.php';
?>
<html>
<head>
<link rel="stylesheet" href="styles.css" type="text/css">
<style>
table
{
border-collapse:collapse;
}
table, th, td
{
border: 1px solid black;
min-width:300px;
min-Height:100px;
}
.target
{
background-color:#99CCFF
}
.headers
{
background-color:#FFFF99;
}
</style>
</head>
<body>
<article>
<header>
<h1>Edit Focus Areas</h1>
<?
navigation($dbhost, $dbuser, $dbpass, $access_level);
?>

</header>
<section style="float:left">
<h1 style="text-align:center">View/ Edit Focus Areas</h1>
<table>
	<tr>
		<th>Focus Area</th>
		<th>Edit</th>
	</tr>
	
	<?
	$sql = "SELECT * FROM Focus_areas";
	$result = mysqli_query($con, $sql);

	$row=mysqli_fetch_array($result);
	while($row=mysqli_fetch_array($result))
	{
	?>

	
	<tr>
		<td><?php echo $row['foc_area'] ?></td>
		<td><a href ="foc_area_edit.php?id=<? echo $row['focus_id']?>">Edit</a>
	</tr>

	<?
	}
	?>
</table>
</section>
</article>
</body>
</html>