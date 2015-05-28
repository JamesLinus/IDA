<?
//required includes
include 'includes/dbconnect.php';
include 'includes/userdata.php';
?>

<link rel="stylesheet" href="styles.css" type="text/css">

<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/wysiwyg.js"></script>
<script type="text/javascript">
function hideselect(value)
{
document.getElementByClass('textentry').disabled=false;
}
</script>
<style>
td{
padding-top:0;
}
</style>
<body>
	<form method="post" action="insertms.php">
	<input type='hidden' name='submitted' id='submitted' value='1'/>
	<input type="hidden" id="mid" name="mid" value="<? echo intval($_GET['mid']);?>">
	<input type="hidden" id="quarter" name="quarter" value="<? echo intval($_GET['quarter']);?>">
    
	<table class="ctable" style=" min-width:75%; margin:auto" cellspacing="1">
				
			<tr style="background-color:#FFFF99">
			  <th class="ctable" style=>Milestone</th>
			  </tr>
			<tr>
			 <td class="ctable">
				<textarea class="textentry" name="milestone"></textarea>
			  </td>			  
			</tr>
			<tr>
			  <td colspan="4">
				<input name="add" type="submit" id="add" value="Submit" />
			  </td>
			</tr>
		</table>
	</form>

	
</body>
