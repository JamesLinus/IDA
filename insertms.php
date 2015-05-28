<link rel="stylesheet" href="styles.css" type="text/css">
 <?
//required includes
include 'includes/dbconnect.php';
include 'includes/userdata.php';
?>
<?
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_POST['add']))
{
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
die('Could not connect: ' . mysqli_error($conn));
}

if(! get_magic_quotes_gpc() )
{
$mid = $_POST['mid'];
$quarter = ($_POST['quarter']);
$milestone = ($_POST['milestone']);
}
else
{
$mid = $_POST['mid'];
$quarter = ($_POST['quarter']);
$milestone = ($_POST['milestone']);
}


$sql = "INSERT INTO Milestones ".
 "(main_id, quarter, milestone) ".
 "VALUES('$mid', '$quarter', '$milestone')";
mysqli_select_db($conn, $dbsel);
$retval = mysqli_query($conn , $sql);
if(! $retval )
{
die('Could not enter data: ' . mysqli_error($conn));
}

include 'includes/navigation.php';
echo "</br>";
echo "Entered data successfully\n";
mysqli_close($conn);
echo"<script>window.close()</script>";
}
?>
<script type="text/javascript">
settimeout
