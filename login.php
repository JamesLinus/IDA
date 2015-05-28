<?php
session_start();
if(!empty($_SESSION['login_user']))
{
header('Location: index.php');
}
include "includes/functions.php";
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>The International Dyslexia Association</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	
	<!-- Application JS -->
	<script src="/assets/javascript/application.js"></script>


<script src="/assets/javascript/jquery.min.js"></script>
<script src="/assets/javascript/jquery.ui.shake.js"></script>
<script>
	$(document).ready(function() {
	
	$('#login').click(function()
	{
		var username=$("#username").val();
		var password=$("#password").val();
    	var dataString = 'username='+username+'&password='+password;
		if($.trim(username).length>0 && $.trim(password).length>0)
		{
		

			$.ajax({
	            type: "POST",
	            url: "ajaxLogin.php",
	            data: dataString,
	            cache: false,
	            beforeSend: function(){ $("#login").val('Connecting...');},
	            success: function(data){
		            if(data)
		            {
		            	$("body").load("index.php").hide().fadeIn(1500).delay(6000);
		            }
		            else
		            {
			            $('#box').shake();
						$("#login").val('Login')
						$("#error").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span> Invalid username and/  or password.</span></div> ");
		            }
		            }
	        });
		
		}
	return false;
	});
	
		
	});
</script>
</head>

<body onload="checkVersion()">
	<div class="container">
		<div class='row center-block'>
			<img src='/assets/images/IDA_Logo.png' class='img-responsive center-block logo'>
			<h2 class='text-center'>Annual Business Plan</h2>
		</div>
		<div class='row'>
			<div class='well center-block' style='max-width:500px;' id='box'>
				<form class ="form-signin" action="" method="post" autocomplete="off">
					<label class="sr-only" for="username">Username</label> 
					<input class="form-control input-lg" type="text" name="username" class="input" id="username" autocomplete="off" placeholder="Username"/>
					<br class='visible-xs visible-sm'>
					<label class="sr-only" for="password">Password </label>
					<input class ="form-control input-lg"type="password" name="password" class="input" id="password" autocomplete="off" placeholder="Password"/><br/>
					<input type="submit" class="btn btn-lg btn-primary btn-block" value="Log In" id="login"/> 
					<span class='msg'></span> 

					<div id="error">

					</div>	
				</form>
			</div>		
		</div>

		<p style="text-align:center"><?php echo $version ?></p>
		<div class="panel panel-primary">
			<div class="panel-heading">System Announcements</div>
			<div class="panel-body">
			 <?
			 admin_announcements(3);
			 ?>
			</div>
		</div>
	</div>
</body>
</html>