
<?
include 'header.php';
?>
<head>
<title>IDA PBMS</title>

<!--Dashboard CSS-->
<link rel="stylesheet" href="/css/dashboard.css"/>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>
<body>
	<div class="container-fluid">
		<header>
			<h1>The International Dyslexia Association</h1>
			<h2>Performance Based Measure System</h2>
		</header>
		<?php
		include "includes/navigation.php"
		?> 
		<div class="row">
			<div class="panel panel-primary col-md-6">
				<div class="panel-heading">PBMS Announcements</div>
				<div class="panel-body">
					<?php PBMS_announcements($pbms_limit); ?>
				</div>
			</div>
			
			<div class="panel panel-primary col-md-5 col-md-offset-1">
				<div class="panel-heading">System Announcements</div>
				<div class="panel-body">
					<?php admin_announcements($sys_limit); ?>
				</div>
			</div>
		</div>
	</div>
</body>