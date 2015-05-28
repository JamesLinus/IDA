<?php 
// Start session 
session_start(); 
  
// Include required functions file 
require_once('includes/functions.inc.php'); 
  
// Check login status... if not logged in, redirect to login screen 
if (check_login_status() == false) { 
              redirect('login.php'); 
} 
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
              <meta http-equiv="Content-type" content="text/html;charset=utf-8" /> 
              <title>Admin</title> 
</head> 
<body> 
              <h1>Administration Panel</h1> 
              <p>This is a second admin page.</p> 
              <p><a href="includes/logout.inc.php">Log Out</a></p> 
</body> 
</html> 