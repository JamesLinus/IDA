<?PHP
require_once("includes/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("thank-you.html");
   }
}
?>
<body>
<?
//required includes
include 'includes/dbconnect.php';
include 'includes/userdata.php';
include 'includes/functions.php';
?>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <link rel="STYLESHEET" type="text/css" href="css/fg_membersite.css" />
    <script type='text/javascript' src='js/gen_validatorv31.js'></script>
    <link rel="STYLESHEET" type="text/css" href="css/pwdwidget.css" />
    <script src="js/pwdwidget.js" type="text/javascript"></script>      
  

<link rel="stylesheet" href="styles.css" type="text/css">

<h1>Add New User</h1>
<?
include 'includes/navigation.php';
?>

<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post'	accept-charset='UTF-8'>
	<fieldset style="width:50%; margin:auto">
		<legend>Register New User</legend>
		<input type='hidden' name='submitted' id='submitted' value='1'/>
		<div class='short_explanation'>* required fields</div>
		
		<table>
			<tr>
				<td>
					<label for='username' >User Name*:</label>
				</td>
				<td>
					<input type='text' name='username' id='username' maxlength="50" />
				</td>
			</tr>
			<tr>
				<td>
					<label for='password' >Password*:</label>
				</td>
				<td>
					<div class='pwdwidgetdiv' id='thepwddiv' ></div>
					<noscript>
						<input type='password' name='password' id='password' maxlength="50" />
					</noscript>    
					<div id='register_password_errorloc' class='error' style='clear:both'></div>
				</td>
			</tr>
			<tr>
				<td>
					<label for='password'>Confirm Password*:</label>
				</td>
				<td>
					<input type='password' name='confirm_password' id='confirm_password' onChange="checkPasswordMatch();"/>
				</td>
				<td>
					<p class="registrationFormAlert" id="divCheckPasswordMatch"></p>
				</td>
			</tr>
			<tr>
				<td>
					<label for='role' >Role*:</label>
				</td>
				<td>
					<select name='role' id='role'/>
						<option value=0>Branch</option>
						<option value=1>HeadQuarters</option>
				</td>
			</tr>
			<tr>
				<td>
					<label for='fystart'>Fiscal Year Start Month*:</label>
				</td>
				<td>
					<input type='number' name='fystart' min='1' max='12'>
				</td>
			</tr>
			<tr>
				<td>
					<input type='submit' name='Submit' value='Submit' />
				</td>
			</tr>
		</table>
		<div class='container' style='height:80px;'>
    
</div>
	</fieldset>
</form>

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide a username");
    
    frmvalidator.addValidation("password","req","Please provide a password");
	
	frmvalidator.addValidation("fystart","req","Please provide a Fiscal year Start Month");

// ]]>
</script>
