<?
//Start Session
session_start();

//Include Required functions file
require_once('includes/functions.inc.php');

//CHeck Login Status... if not Logged in user will be redirected to login screen
if (check_login_status() == false) {
		redirect('login.php');
		}
?>

<?
echo $_SESSION['session_ID'];
echo $_SESSION['username'];
?>

<p><a href="includes/logout.inc.php">Log Out</a></p>