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
$branchID = $_POST['branch'];
$focus_id = addslashes ($_POST['fid']);
$target_id = addslashes ($_POST['tid']);
$target = ($_POST['target']);
$baseline = ($_POST['baseline']);
$strategies = addslashes($_POST['strategies']);
}
else
{
$branchID = $_POST['branch'];
$focus_id = $_GET['fid'];
$target_id = $_GET['tid'];
$target = $_POST['target'];
$baseline = $_POST['baseline'];
$strategies = $_POST['strategies'];
}


$sql = "INSERT INTO Main ".
 "(focus_id, target_id, branch_id, main_target, main_baseline, main_strategies, IP, fiscal_year) ".
 "VALUES('$focus_id', '$target_id', '$branchID', '$target', '$baseline', '$strategies', '$ip', '$fy')";
mysqli_select_db($conn, $dbsel);
$retval = mysqli_query($conn , $sql);
if(! $retval )
{
die('Could not enter data: ' . mysqli_error($conn));
}
$quarter = 2;
$main_id = mysqli_insert_id($conn);

$sql = "INSERT INTO Milestones2".
"(main_id, quarter, milestone)".
"VALUES('$main_id', '$quarter', '$milestone')";
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
