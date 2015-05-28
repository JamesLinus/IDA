<?php
include("db.php");
session_start();
if(isSet($_POST['username']) && isSet($_POST['password']))
{
// username and password sent from Form
$username=mysqli_real_escape_string($db,$_POST['username']); 
$password=md5(mysqli_real_escape_string($db,$_POST['password'])); 

$result=mysqli_query($db,"SELECT uid FROM users WHERE username='$username' and password='$password'");
$count=mysqli_num_rows($result);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
$_SESSION['login_user']=$row['uid'];
session_regenerate_id(true);
$sessionid = session_id();
$sql = "UPDATE users SET session ='". $sessionid . "', last_login = now() WHERE username ='" . $username . "'";
$result = $mysqli->query($sql);
// Set session variable for login status to true 
$_SESSION['logged_in'] = true;
$_SESSION['session_ID']= $sessionid;
echo $row['uid'];
}

}
?>