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

$focus = "";
$indicators = "";
$type = "";
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
	$focus = $_POST['focus'];
	$indicators = $_POST['indicators'];
    $type = $_POST['type'];
    
	
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
     
			$SQL = "INSERT INTO `Focus_areas` (`foc_area`, `indicators`, `type`) VALUES ('$focus', '$indicators', '$type')";

			
				$result = mysqli_query($db_handle, $SQL) or die("Error: ".mysqli_error($db_handle));
				$last_id = mysqli_insert_id($db_handle);
				if(!empty($_POST['target'])) {
					foreach($_POST['target'] as $cnt => $target) {
						$SQL = "INSERT INTO `target_area` (target_area, focus_id) VALUES ('".$_POST['target'][$cnt]."','".$last_id."');";
						$result = mysqli_query($db_handle, $SQL) or die("Error: ".mysqli_error($db_handle));
					}
				}
			
			
            
			mysqli_close($db_handle);

		//=================================================================================
		//	START THE SESSION AND PUT SOMETHING INTO THE SESSION VARIABLE CALLED login
		//	SEND USER TO A DIFFERENT PAGE AFTER SIGN UP
		//=================================================================================

			
                //echo mysqli_error($db_handle);
			//header ("Location: usermanagement.php");
			//echo"<script>window.close()</script>";
		}

	
	else {
		$errorMessage = "Database Not Found";
	}




	}

}


?>

	<html>
	<head>
	<title>Add a Focus Area</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
	<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/wysiwyg.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<script type="text/javascript">
function hideselect(value)
{
document.getElementByClass('textentry').disabled=false;
}
</script>
<script type="text/javascript">
var rowNum = 0;
function addRow(frm) {
rowNum ++;
var row = '<p id="rowNum'+rowNum+'"><input type="text" name="target[]" value="'+frm.add_target.value+'"><input type="button" value="Remove" onclick="removeRow('+rowNum+');"></p>';
jQuery('#targetRows').append(row);
frm.add_target.value = '';
}
function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>
	</head>
	<body>


<FORM NAME ="form1" METHOD ="POST" ACTION ="addfoc.php">
<table class="usertable">
<tr>
<th colspan="2" style="background:white; color:black; text-align:center;">
<h1>Add New Focus Area</h1>
</th>
</tr>
<tr>
<th>
Focus Area:
</th>
<td>
<INPUT TYPE = 'TEXT' Name ='focus'  value="<?PHP print $focus;?>" maxlength="20">
</td>
</tr>
<tr>
<th>
Indicators:
</th>
<td>
<textarea Name ='indicators'  value="<?PHP print $indicators;?>"></textarea>
</td>
</tr>
<tr>
</tr>
<th>
Target Areas:
</th>
<td id = "targetRows">
<input type="text" name="add_target"/> <input onclick="addRow(this.form);" type="button"  value="Add row" /> (This row will not be saved unless you click on "Add row" first)
</td>
<tr>
<th>
Type:
</th>
<td>
<Select name = "type">
<option value="All">All</option>
<option value="Branch">Branch</option>
<option value="National">National</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:center;">
<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Add">
<td>
</tr>
</FORM>

<tr>
<td colspan="2">
<span class="errormessage"><?PHP print $errorMessage;?></span>
</td>
</tr>
	</body>
	</html>
