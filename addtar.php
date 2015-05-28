<?
//required includes
include 'includes/dbconnect.php';
include 'includes/userdata.php';
?>

<link rel="stylesheet" href="styles.css" type="text/css">
<style>
th{
padding:5px;
}
</style>




<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/wysiwyg.js"></script>
<script type="text/javascript">
function hideselect(value)
{
document.getElementByClass('textentry').disabled=false;
}
</script>

<body onload='loadCategories()'>
<H1>Enter a New Target</H1>

	<form method="post" action="insert.php">
	<input type="hidden" id="fid" name="fid" value="<? echo intval($_GET['fid']);?>">
	<input type="hidden" id="tid" name="tid" value="<? echo intval($_GET['tid']);?>">
    
	<table class="ctable" style=" min-width:100%;" cellspacing="1" cellpadding="0">
	<tr>
	<td>
		<?
		 $branchid = intval($_GET['bid']);			//get the Branch ID
				echo "<input type='hidden' value='".$branchid."' name='branch' id='branch'>";
				
		?>
		<input type="hidden" value=<? echo $fy ?> name="fiscal_year">
		</td>
</tr>
		
			
			<tr style="background-color:#FFFF99">
			  <th class="ctable">Annual Projected Target</th>
			  <th class="ctable">Baseline</th>
			  <th class="ctable">Strategies</th>		
			</tr>
			<tr>
			  <td class="ctable" style="padding-top:0 px;">
				<textarea class="textentry" name="target"></textarea>
			  </td>
			  <td class="ctable" style="padding-top:0 px;">
				<textarea class="textentry" name="baseline"></textarea>
			  </td >
			  <td class="ctable" style="padding-top:0 px;" >
				<textarea class="textentry" name="strategies"></textarea>
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
