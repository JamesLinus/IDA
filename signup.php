<?PHP


//session_start();
//if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	//header ("Location: login.php");
//}
include "includes/userdata.php";
//include statements
include "includes/dbconnect.php";
include "includes/functions.php";
//set the session variable to 1, if the user signs up. That way, they can use the site straight away
//do you want to send the user a confirmation email?
//does the user need to validate an email address, before they can use the site?
//do you want to display a message for the user that a particular username is already taken?
//test to see if the u and p are long enough
//you might also want to test if the users is already logged in. That way, they can't sign up repeatedly without closing down the browser
//other login methods - set a cookie, and read that back for every page
//collect other information: date and time of login, ip address, etc
//don't store passwords without encrypting them
if (isset($_POST['username']))

$uname = "";
$fname = "";
$lname = "";
$email = "";
$pword = "";
$branch = "";
$fystart = "";
$errorMessage = "";
$num_rows = 0;

function quote_smart($value, $handle) {

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }

   if (!is_numeric($value)) {
       $value = "'" . mysqli_real_escape_string($handle, $value) . "'";
   }
   return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//====================================================================
	//	GET THE CHOSEN U AND P, AND CHECK IT FOR DANGEROUS CHARCTERS
	//====================================================================
	$uname = $_POST['username'];
	$pword = $_POST['password'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $branch = $_POST['branch'];
    $role = $_POST['role'];
	
	$uname = htmlspecialchars($uname);
	$pword = htmlspecialchars($pword);

	//====================================================================
	//	CHECK TO SEE IF U AND P ARE OF THE CORRECT LENGTH
	//	A MALICIOUS USER MIGHT TRY TO PASS A STRING THAT IS TOO LONG
	//	if no errors occur, then $errorMessage will be blank
	//====================================================================

	$uLength = strlen($uname);
	$pLength = strlen($pword);

	if ($uLength >= 4 && $uLength <= 20) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "<span class='alert alert-danger'>Username must be between 10 and 20 characters</span>";
	}

	if ($pLength >= 4 && $pLength <= 16) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "<span class='alert alert-danger'>Password must be between 8 and 16 characters</span>";
	}
	if (FILTER_VAR($email, FILTER_VALIDATE_EMAIL)) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "<span class='alert alert-danger'>Email is not valid</span>";
	}


//test to see if $errorMessage is blank
//if it is, then we can go ahead with the rest of the code
//if it's not, we can display the error

	//====================================================================
	//	Write to the database
	//====================================================================
	if ($errorMessage == "") {

	$db_handle = mysqli_connect($dbhost, $dbuser, $dbpass);
	$db_found = mysqli_select_db($db_handle, $dbsel);

	if ($db_found) {

		$uname = quote_smart($uname, $db_handle);
		$pword = quote_smart($pword, $db_handle);
        $fname = quote_smart($fname, $db_handle);
        $lname = quote_smart($lname, $db_handle);
        $email = quote_smart($email, $db_handle);

	//====================================================================
	//	CHECK THAT THE USERNAME IS NOT TAKEN
	//====================================================================

		$SQL = "SELECT * FROM users WHERE username = $uname";
		$result = mysqli_query($db_handle, $SQL);
		$num_rows = mysqli_num_rows($result);

		if ($num_rows > 0) {
			$errorMessage = "<span class='alert alert-danger'>Username already taken</span>";
		}
		
		else {
            
			$SQL = "INSERT INTO `users` (`username`, `firstn`, `lastn`, `email`, `password`, `branchid`, `role_id`) VALUES ($uname, $fname, $lname, $email, md5($pword), $branch, $role)";

			$result = mysqli_query($db_handle, $SQL) or die("Error: ".mysqli_error($db_handle));
            
			mysqli_close($db_handle);

		//=================================================================================
		//	START THE SESSION AND PUT SOMETHING INTO THE SESSION VARIABLE CALLED login
		//	SEND USER TO A DIFFERENT PAGE AFTER SIGN UP
		//=================================================================================

			
                //echo mysqli_error($db_handle);
			$errorMessage = "<div class='alert alert-success'>User Successfully added</div>";

		}

	}
	else {
		$errorMessage = "<div class='alert alert-danger'>Database Not Found</div>";
	}


		

	}

}
	$_SESSION['status'] = $errorMessage

?>

