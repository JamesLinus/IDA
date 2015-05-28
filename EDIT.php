<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $target, $baseline, $strategies, $milestoneq1, $milestoneq2, $milestoneq3, $milestoneq4, $error)
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
 <strong>Target: *</strong> <textarea name="target" value="<?php echo $target; ?>"/><?php echo $target; ?></textarea><br/>
 <strong>Baseline: </strong> <textarea name="baseline" value="<?php echo $baseline; ?>"/><?php echo $baseline; ?></textarea><br/>
 <strong>Strategies: </strong> <textarea type="text" name="strategies" value="<?php echo $strategies; ?>"/><?php echo $strategies; ?></textarea><br/>
 <strong>Milestone quarter 1</strong> <textarea type="text" name="milestoneq1" value="<?php echo $milestoneq1; ?>"/><?php echo $milestoneq1; ?></textarea><br/>
 <strong>Milestone quarter 2</strong> <textarea type="text" name="milestoneq2" value="<?php echo $milestoneq2; ?>"/><?php echo $milestoneq2; ?></textarea><br/>
 <strong>Milestone quarter 3</strong> <textarea type="text" name="milestoneq3" value="<?php echo $milestoneq3; ?>"/><?php echo $milestoneq3; ?></textarea><br/>
 <strong>Milestone quarter 4</strong> <textarea type="text" name="milestoneq4" value="<?php echo $milestoneq4; ?>"/><?php echo $milestoneq4; ?></textarea><br/>
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
 $target = $_POST['target'];
 $baseline = $_POST['baseline'];
 $strategies = $_POST['strategies'];
 $milestoneq1 = $_POST['milestoneq1'];
 $milestoneq2 = $_POST['milestoneq2'];
 $milestoneq3 = $_POST['milestoneq3'];
 $milestoneq4 = $_POST['milestoneq4'];
 
 // check that target field is filled in
 if ($target == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $target, $baseline, $strategies, $milestoneq1, $milestoneq2, $milestoneq3, $milestoneq4, $error);
 }
 else
 {
 // save the data to the database
  
 mysqli_query($con, "UPDATE Main SET main_target='$target', main_baseline='$baseline', main_strategies='$strategies', quarter_1='$milestoneq1', quarter_2='$milestoneq2', quarter_3='$milestoneq3', quarter_4='$milestoneq4' WHERE main_id='$id'")
 or die(mysqli_error($con)); 
 
 // once saved, redirect back to the view page
 header("Location: http://scorecard.interdys.org/view.php"); 
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
 $result = mysqli_query($con, "SELECT * FROM Main WHERE main_id=$id")
 or die(mysqli_error($con)); 
 
 $row = mysqli_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $target = $row['main_target'];
 $baseline = $row['main_baseline'];
 $strategies = $row['main_strategies'];
 $milestoneq1 = $row['quarter_1'];
 $milestoneq2 = $row['quarter_2'];
 $milestoneq3 = $row['quarter_3'];
 $milestoneq4 = $row['quarter_4'];
 
 // show form
 renderForm($id, $target, $baseline, $strategies, $milestoneq1, $milestoneq2, $milestoneq3, $milestoneq4, '');
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