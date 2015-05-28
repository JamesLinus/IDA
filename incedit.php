<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?
//required includes
include 'includes/dbconnect.php';
include 'includes/userdata.php';
?>

<link rel="stylesheet" href="styles.css" type="text/css">

<nav>
 <? include 'includes/navigation.php';?>
 </nav>
 <br>
 <br>
 
<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $foc_area, $indicators, $error)
 {
 
 ?>
  
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 
 ?> 
<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/wysiwyg.js"></script>
 
 <form action="<?$_PHP_SELF?>" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <div>
 <p><strong>ID:</strong> <?php echo $id; ?></p>
 <strong>Focus Area:* </strong><input type="text" name="foc_area" value="<? echo $foc_area ?>"></input><br/>
 <strong>Indicators:*</strong> <textarea name="indicators" /><?php echo $indicators ?></textarea><br/>
 <strong>Type:</strong><select name="type" id="type">
 <option value="All">All</option>
 <option Value="Branch">Branch</option>
 <option value="National">National</option>
 </select>
  <p>* Required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 <?php
 }

 // connect to the database
 
$con = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_select_db($con, $dbsel);
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
 $foc_area = $_POST['foc_area'];
 $indicators = $_POST['indicators'];
 $type = $_POST['type'];
  
 // check that target field is filled in
 if ($indicators == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $foc_area, $indicators, $error);
 }
 else
 {
 // save the data to the database
  
 mysqli_query($con, "UPDATE Focus_areas SET indicators='$indicators', foc_area='$foc_area', type = '$type' WHERE focus_id='$id'")
 or die(mysqli_error($con)); 
 
 // once saved, redirect back to the view page
 header("Location: http:/scorecard.interdys.org/indicators.php"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
 $id = $_GET['id'];
 $result = mysqli_query($con, "SELECT * FROM Focus_areas WHERE focus_id=$id")
 or die(mysqli_error($con)); 
 
 $row = mysqli_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $foc_area = $row['foc_area'];
 $indicators = $row['indicators'];
  
 // show form
 renderForm($id, $foc_area, $indicators, '');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>