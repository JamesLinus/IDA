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

$userid = $_GET['id'];

	$db_handle = mysqli_connect($dbhost, $dbuser, $dbpass, $dbsel);


$sql = "SELECT `users`.*, `roles`.`role_name`\n"
    . "FROM `users`\n"
    . " LEFT JOIN `IDA`.`roles` ON `users`.`role_id` = `roles`.`roleID` \n"
    . "WHERE (`users`.`userID` = ".$userid.")\n"
    . " LIMIT 0, 30 ";
$result = mysqli_query($db_handle, $sql); 
$row = mysqli_fetch_assoc($result);

//print_r($row);
$uname = $row["username"];
$pword = "";
$first_name = $row["firstn"];
$last_name = $row["lastn"];
$email = $row['email'];
$branch = $row["branchid"];
$role = $row["role_id"];
$errorMessage = "";
$num_rows = 0;

function quote_smart($handle, $value) {

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
    $branch = $_POST['branch'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
    $role = $_POST['role'];

	$uname = htmlspecialchars($uname);
	$pword = htmlspecialchars($pword);

	//====================================================================
	//	CHECK TO SEE IF U AND P ARE OF THE CORRECT LENGTH
	//	A MALICIOUS USER MIGHT TRY TO PASS A STRING THAT IS TOO LONG
	//	if no errors occur, then $errorMessage will be blank
	//====================================================================

	$uLength = strlen($uname);
	

	if ($uLength >= 3 && $uLength <= 20) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Username must be between 3 and 20 characters" . "<BR>";
	}
    if ($pword != null){
        $pLength = strlen($pword);
        if ($pLength >= 3 && $pLength <= 16) {
            $errorMessage = "";
        }
        else {
            $errorMessage = $errorMessage . "Password must be between 3 and 16 characters" . "<BR>";
        }
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

		$uname = quote_smart($db_handle, $uname);
		$pword = quote_smart($db_handle, $pword);
		$email = quote_smart($db_handle, $email);
		$first_name = quote_smart($db_handle, $first_name);
		$last_name = quote_smart($db_handle, $last_name);

	//====================================================================
	//	CHECK THAT THE USERNAME IS NOT TAKEN
	//====================================================================

		$SQL = "SELECT * FROM users WHERE username = $uname AND userID != ".$userid. "";
		$result = mysqli_query($db_handle, $SQL);
		$num_rows = mysqli_num_rows($result);

		if ($num_rows > 0) {
			$errorMessage = "Username already taken";
		}
		
		else {
                if ($pword != "''"){
			$SQL = "UPDATE users SET username = $uname, password = MD5($pword), firstn = $first_name, lastn = $last_name, email = $email, branchid = $branch, role_id = $role WHERE userID = $userid";
                    }
                    else{
                    $SQL = "UPDATE users SET username = $uname, branchid = $branch, firstn = $first_name, lastn = $last_name, email = $email, role_id = $role WHERE userID = $userid";
                    }
			$result = mysqli_query($db_handle, $SQL) or die("Error: ".mysqli_error($db_handle));

			mysqli_close($db_handle);

		//=================================================================================
		//	START THE SESSION AND PUT SOMETHING INTO THE SESSION VARIABLE CALLED login
		//	SEND USER TO A DIFFERENT PAGE AFTER SIGN UP
		//=================================================================================

		
			//session_start();
			//$_SESSION['login'] = "1";

			header ("Location: usermanagement.php");

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
		<title>Edit User</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">Edit User</div>
			<div class="panel-body">
				<FORM NAME ="form1" METHOD ="POST" ACTION ="useredit.php?id=<?echo $userid?>">
					<div class="form-group">
						<LABEL FOR="username">Username</label>
						<INPUT class="form-control" TYPE = 'TEXT' id ='username' Name ='username'  value="<?PHP print $uname;?>" maxlength="20" placeholder="Username">
					</div>
					<div class="form-group">
						<LABEL FOR="password">New Password</label>
						<INPUT class="form-control" id = 'password' TYPE = 'TEXT' Name ='password'  value="<?PHP print $pword;?>" maxlength="16" placeholder="New Password">
					</div>
					<div class="form-group">
						<LABEL FOR="first_name">First Name</label>
						<INPUT class="form-control" id='firstname' TYPE = 'TEXT' Name ='first_name'  value="<?PHP print $first_name;?>" maxlength="20" placeholder="First Name">
					</div>
					<div class="form-group">
						<LABEL FOR="last_name">Last Name</label>
						<INPUT class="form-control" TYPE = 'TEXT' id='last_name' Name ='last_name'  value="<?PHP print $last_name;?>" maxlength="20" placeholder="Last name">
					</div>
					<div class="form-group">
						<LABEL FOR="email">Email</label>
						<INPUT class="form-control" id ='email' TYPE = 'EMAIL' Name ='email'  value="<?PHP print $email;?>" maxlength="100" placeholder="email">
					</div>
					<div class="form-group">
						<LABEL FOR="branch">Branch</label>
						<? user_branch_dropdown($dbhost, $dbuser, $dbpass, $branch)?>
					</div>
					<div class="form-group">
						<LABEL FOR="role">Permission Level</label>
						<select id='role' class="form-control" name='role' id='role'/>
							<option value=3 <?php if ($role == 3) echo "selected"; ?> >Branch</option>
							<option value=2 <?php if ($role == 2) echo "selected"; ?>>Headquarters</option>
							<?php if ($rolelvl == 1){?> <option value=1 <?php if ($role == 1)  echo 'selected';?>>Developer</option>; <?php ; }?>
					</div>					
					<input TYPE = "Submit"  class='btn btn-primary' Name = "Submit1"  VALUE = "Save Changes"></input>
				</FORM>
			</div>
		</div>
	</div>


<?PHP print $errorMessage;?>

	</body>
	</html>
