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

$branch_id = $_GET['id'];    

	$db_handle = mysqli_connect($dbhost, $dbuser, $dbpass, $dbsel);


$sql = "SELECT * \n"
    . "FROM `branch`\n"
    . "WHERE (`branch`.`branchid` = ".$branch_id.")\n"
    . " LIMIT 0, 30 ";
$result = mysqli_query($db_handle, $sql); 
$row = mysqli_fetch_assoc($result);

//print_r($row);
$branch = $row["branch"];
$pword = "";
$fystart = $row["FY_start"];
$branch_head = $row["branch_head"];
$phone = $row["branch_phone"];
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
	//$pword = $_POST['password'];
    $fystart = $_POST['fystart'];
    $branch_head = $_POST['branch_head'];
    $phone = $_POST['phone'];

	$branch = htmlspecialchars($branch);
	$pword = htmlspecialchars($pword);
	$branch_head = htmlspecialchars($branch_head);	
	$phone = htmlspecialchars($phone);

	//====================================================================
	//	CHECK TO SEE IF U AND P ARE OF THE CORRECT LENGTH
	//	A MALICIOUS USER MIGHT TRY TO PASS A STRING THAT IS TOO LONG
	//	if no errors occur, then $errorMessage will be blank
	//====================================================================

	$uLength = strlen($branch);
	

	if ($uLength >= 4 && $uLength <= 20) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Branch must be between 4 and 20 characters" . "<BR>";
	}
    if ($pword != null){
        $pLength = strlen($pword);
        if ($pLength >= 0 && $pLength <= 16) {
            $errorMessage = "";
        }
        else {
            $errorMessage = $errorMessage . "Password must be between 4 and 16 characters" . "<BR>";
        }
    }

//test to see if $errorMessage is blank
//if it is, then we can go ahead with the rest of the code
//if it's not, we can display the error

	//====================================================================
	//	Write to the database
	//====================================================================
	if ($errorMessage == "") {	

	$db_handle = mysqli_connect($dbhost, $dbuser, $dbpass, $dbsel);
	$db_found = mysqli_select_db($db_handle, $dbsel);

	if ($db_found) {

		$branch = quote_smart($branch, $db_handle);
		$pword = quote_smart($pword, $db_handle);
		$branch_head = quote_smart($branch_head, $db_handle);
		$phone = quote_smart($phone, $db_handle);

	//====================================================================
	//	CHECK THAT THE USERNAME IS NOT TAKEN
	//====================================================================

		$SQL = "SELECT * FROM branch WHERE branch = $branch AND branchid != '".$branch_id."'";
		$result = mysqli_query($db_handle, $SQL);
		$num_rows = mysqli_num_rows($result);

		if ($num_rows > 0) {
			$errorMessage = "Branch already exists";
		}
		
		else {
                if ($pword != ""){
			$SQL = "UPDATE branch SET branch = $branch, branch_password = MD5($pword), FY_start = $fystart, branch_head = $branch_head, branch_phone = $phone WHERE branchid = $branch_id";
                    }
                    else{
                    $SQL = "UPDATE branch SET branch = $branch, FY_start = $fystart, branch_head = $branch_head, branch_phone = $phone WHERE branchid = $branch_id";
                    }
			$result = mysqli_query($db_handle, $SQL);			

		//=================================================================================
		//	START THE SESSION AND PUT SOMETHING INTO THE SESSION VARIABLE CALLED login
		//	SEND USER TO A DIFFERENT PAGE AFTER SIGN UP
		//=================================================================================

			
			//echo mysqli_error($db_handle);
			mysqli_close($db_handle);
			header ("Location: branchlist.php");

		}

	}
	else {
		$errorMessage = "Database Not Found";
	}




	}

}


?>

	<html>
	<head>
	<title>Branch Edit</title>
	<!--Datatables css-->
	<link rel="stylesheet" href="assets/css/datatables.css" type="text/css">

	<!--Dashboard CSS-->
	<link rel="stylesheet" href="/css/dashboard.css"/>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- Datatables JS-->
	<script src='/assets/javascript/datatables.js'></script>

	<!-- Latest application JS -->
	<script src="/assets/javascript/application.js"></script>

	<!-- Latest branchlist JS -->
	<script src='/assets/javascript/branchlist.js'></script>

	</head>
	<body>
		<div class='container'>
			<FORM NAME ="form1" METHOD ="POST" ACTION ="branchedit.php?id=<?echo $branch_id?>">
			<div class='form-group'>
				<label for='branch'>Branch:</label>
			 <INPUT class='form-control input-lg' TYPE = 'TEXT' Name ='branch'  value="<?PHP print $branch;?>" maxlength="20">
			</div>
			<div class='form-group'>
				<label for='fystart'>Fiscal Year Start:</label>
				<INPUT class='form-control input-lg' TYPE='NUMBER' NAME='fystart' MIN='1' MAX='12' value="<?PHP print $fystart;?>">
			</div>
			<div class='form-group'>
				<label for='branch_head'>Branch Head</label>
				<input class='form-control input-lg' type='text' name='branch_head' id='branch_head' value="<?PHP print $branch_head;?>">
			</div>
			<div class='form-group'>
				<label for='phone'>Phone</label>
				<input class='form-control input-lg' type='text' name='phone' id='phone' value="<?PHP print $phone;?>">
			</div>


			<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Save Changes">


			</FORM>
		</div>

<?PHP print $errorMessage;?>

	</body>
	</html>
