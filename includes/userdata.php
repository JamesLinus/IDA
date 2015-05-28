<?


//Check Login Status... if not Logged in user will be redirected to login screen
session_start();
if(empty($_SESSION['login_user']))
{
header('Location: login.php');
}
$conf = parse_ini_file("config.ini.php");
$dbhost = $conf['dbhost'];
$dbuser = $conf['dbuser'];
$dbpass = $conf['dbpass'];
$dbsel = $conf['dbsel'];
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbsel);
$sql = $sql = "SELECT `users`.*, `roles`.*, `branch`.*\n"
    . "FROM `users`\n"
    . " LEFT JOIN `IDA`.`branch` ON `users`.`branchid` = `branch`.`branchid` \n"
    . " LEFT JOIN `IDA`.`roles` ON `users`.`role_id` = `roles`.`roleID` \n"
	. " WHERE userID = '" . $_SESSION['login_user'] ."' \n"
    . " LIMIT 0, 30 ";
$result= mysqli_query($con,$sql);

while($row=mysqli_fetch_array($result)){
	$rolelvl = $row['roleID'];
	$user_role = $row['role_name'];
	$fystart = $row['FY_start'];
	$username = $row['username'];
	$userid = $row['userID'];
	$access_level=$row['permission_level'];
	$branchID = $row['branchid'];
	$assignedbranch = $row['branch'];
	$firstname = $row['firstn'];
	$lastname = $row['lastn'];

}

date_default_timezone_set('UTC');
//$date = 1;
$date=date("m");
//echo $current_user->fiscal_year . "<br>";
//echo date(m)."<br>";
if ($fystart > $date && $date >= 1){
$fy = date("Y") - 1;
$fy = "fy". $fy;
}
else{
$fy = "fy" . date("Y");
}
?>