<section class="panel panel-primary">
	<div class="panel-heading">View/ Edit Template<select name='fy' id='fy' class='pull-right'></select></div>
	<table class="table">
		<tr>
			<th>Focus Area</th>
			<th>Indicators</th>
			<th>Target Areas</th>
			<th style="max-width:50px;">Type</th>				
			<th style="max-width:100px;">Edit</th>
		</tr>
		
		<?
		$sql = "SELECT * FROM Focus_areas";
		$result = mysqli_query($con, $sql);

		$row=mysqli_fetch_array($result);
		while($row=mysqli_fetch_array($result))
		{
		$tar = mysqli_query($con, "SELECT * FROM target_area WHERE focus_id = '".$row['focus_id']."'");
		?>

		
		<tr>
			<td style="width: 3%"><?php echo $row['foc_area'] ?></td>
			<td style="width: 45%"><?php echo $row['indicators'] ?></td>        
			<td style="width: 46%"><ul><?php while($rowt=mysqli_fetch_array($tar)){echo "<li>". $rowt['target_area'] ."</li>"; }?></ul></td>
			<td style="text-align:center; max-width:50px"><?php echo $row['type'] ?></td>				
			<td  style="max-width: 100px"><a class="btn btn-primary" href ="incedit.php?id=<? echo $row['focus_id']?>">Edit</a>
		</tr>

		<?
		}
		?>
	</table>
	<div style="margin:auto"><a class="btn btn-primary" onClick="javascript:window.open('addfoc.php','Windows','width=650,height=850,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")"">Add Focus Area</a></div>
</section>