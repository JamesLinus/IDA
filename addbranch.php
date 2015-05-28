<?PHP
//include statements
include "includes/userdata.php";
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
if (isset($_POST['branch']))

$branch ="";
$fystart="";
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
	$branch = $_POST['branch'];
	$fystart = $_POST['fy_start'];
	$branch_head = $_POST['branch_head'];
	$branch_phone = $_POST['phone'];
	$branch_scorecard = $_POST['scorecard'];
	$msg[] = 'POST Success';
	//====================================================================
	//	CHECK TO SEE IF U AND P ARE OF THE CORRECT LENGTH
	//	A MALICIOUS USER MIGHT TRY TO PASS A STRING THAT IS TOO LONG
	//	if no errors occur, then $errorMessage will be blank
	//====================================================================

	$bLength = strlen($branch);

	if ($bLength >= 4 && $bLength <= 20) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Branch name must be between 4 and 20 characters" . "<BR>";
	}
	$msg[] = 'Length Check Success';
	


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
			$branch = quote_smart($branch, $db_handle);
			$fystart = quote_smart($fystart, $db_handle);
			$branch_head = quote_smart($branch_head, $db_handle);;
			$branch_phone = quote_smart($branch_phone, $db_handle);;
			$branch_scorecard = quote_smart($branch_scorecard, $db_handle);;
			$msg[] = 'DB found Success';
		//====================================================================
		//	CHECK THAT THE Branch IS NOT TAKEN
		//====================================================================

			$SQL = "SELECT * FROM branch WHERE `branch` = ".$branch."";
			$result = mysqli_query($db_handle, $SQL);
			if(!$result)
				$errorMessage = mysqli_error($db_handle);
			
			$num_rows = mysqli_num_rows($result);

			if ($num_rows > 0) {
				$errorMessage = "Branch already exists";
			}
			
			else {

				$SQL = "INSERT INTO `branch` (`branch` , `branch_head` , `branch_phone` , `FY_start` , `typeID` ) VALUES ($branch , $branch_head , $branch_phone, $fystart , $branch_scorecard)";
				$msg[] = $SQL;
				$result = mysqli_query($db_handle, $SQL);
				$errorMessage = mysqli_error($db_handle);
				mysqli_close($db_handle);

				//header ("Location: branchlist.php");

			}

		}
		else {
			$errorMessage = "Database Not Found";
		}




	}
	$msg[] = $errorMessage;
	echo implode(',', $msg);
}
	
	$_SESSION['status'] = $errorMessage;

?>
	
