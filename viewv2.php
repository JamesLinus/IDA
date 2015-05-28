<?
//required includes
include 'includes/dbconnect.php';
include 'includes/userdata.php';
?>
<style>						/*CSS for table*/
	table
	{
	border-collapse:collapse;
	width:100%;
	}
	table,th, td
	{
	border: 1px solid black;
	min-Height:50px;
	vertical-align: top;
	}
	.target
	{
	background-color:#99CCFF
	}
	.headers
	{
	background-color:#FFFF99;
	}
</style>

<?php
$bid = intval($_GET['bid']);			//get the Branch ID
$fid = intval($_GET['fid']);			//Get the Focus Area ID

mysqli_select_db($con,$dbsel);									//Retrieve the Target Areas to display
$sql = "SELECT `target_area`.*\n"
    . "FROM `target_area`\n"
    . "WHERE (`target_area`.`focus_id` = '".$fid."')\n"
    . " LIMIT 0, 30 ";
$resultt = mysqli_query($con,$sql);


$sqlf = "SELECT `Focus_areas`.*, `branch`.`branch`\n"
    . "FROM `branch`, `Focus_areas`\n"
    . "WHERE (`branch`.`branchid` = $bid) AND (`Focus_areas`.`focus_id` = $fid)\n"
    . "";
$resultf = mysqli_query($con,$sqlf);



while($rowf=mysqli_fetch_array($resultf)){
echo "<h1 style='text-align:center'>".$rowf['branch']." - ".$rowf['foc_area']."</h1>";							//echo the Focus area title
echo "<span>".$rowf['indicators']."</span>";															//and indicators
}	
	
echo "<table class='table-border'>";				


if (!$resultt){
	die(mysql_error());
	}
echo "<div id='body' >";

while($rowt=mysqli_fetch_array($resultt)){					//build table rows with Target Area
?>
<tr>
<th class="target" colspan="4" style="text-align:left";><? echo $rowt['target_area']?></th>
</tr>

<?
$sql = "SELECT `Main`.*\n"
    . "FROM `Main`\n"
    . "WHERE ((`Main`.`branch_id` = '".$bid."') AND (`Main`.`target_id` = '".$rowt['target_id']."'))\n"
    . " LIMIT 0, 30 ";
$result = mysqli_query($con,$sql);

echo "<tr>										
<th class='headers' width='25%'>Target</th>
<th class='headers' width='25%'>Baseline</th>
<th class='headers' width='25%'>Strategies</th>
<th class='headers' width='25%'>Milestones</th>
</tr>";

if (!$result){
	die(mysql_error());
	}

while($row=mysqli_fetch_array($result))
{
$id=$row['main_id'];
$advtar=$row['main_target'];
$advbase=$row['main_baseline'];
$advstrat=$row['main_strategies'];
//$ms1=$row['quarter_1'];
//$ms2=$row['quarter_2'];
//$ms3=$row['quarter_3'];
//$ms4=$row['quarter_4'];
?>
<tr id="<?php echo $id; ?>" class="edit_tr" >

<td class="" width='25%' rowspan="4">
<span id="tar_<?php echo $id; ?>" class="text"><?php echo $advtar; ?></span>

</td>

<td class="" width='25%' rowspan="4">
<span id="base_<?php echo $id; ?>" class="text"><?php echo $advbase; ?></span> 

</td>

<td class="" rowspan="4">
<span id="strat_<?php echo $id; ?>" class="text"><?php echo $advstrat; ?></span> 

</td>
<td><span class="text">Quarter 1: </br> <?php //echo $ms1; ?></span>
<?
$sqlm = "SELECT `Milestones`.*\n"
    . "FROM `Milestones`\n"
    . "WHERE ((`Milestones`.`main_id` ='".$id."') AND (`Milestones`.`quarter` =1))\n"
    . " LIMIT 0, 30 ";
	$msresult = mysqli_query($con,$sqlm);
	while($rowms = mysqli_fetch_array($msresult))
	{
?>
<span id="ms_<? echo $rowms['ms_id']?>" class="text"><? echo $rowms['milestone']?></span>
<?
}
?>
</br><!--<a href="addms.php" target="_blank" onclick="location.href=this.href+'?mid='+<?echo $id; ?>+'&quarter=1';return false;">Add Milestone</a></td>-->
<a class="btn btn-info btn-sm" target="_blank" onclick="javascript:window.open('addms.php?mid=<? echo $id;?>&quarter=1','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")"">Add New Milestone</a></td>
<tr>
<td><span class="text">Quarter 2: </br><?php //echo $ms2; ?></span>
<?
$sqlm = "SELECT `Milestones`.*\n"
    . "FROM `Milestones`\n"
    . "WHERE ((`Milestones`.`main_id` ='".$id."') AND (`Milestones`.`quarter` =2))\n"
    . " LIMIT 0, 30 ";
	$msresult = mysqli_query($con,$sqlm);
	while($rowms = mysqli_fetch_array($msresult))
	{
?>
<span id="ms_<? echo $rowms['ms_id']?>" class="text"><? echo $rowms['milestone']?></span>
<?
}
?>
</br><!--<a href="addms.php" target="_blank" onclick="location.href=this.href+'?mid='+<?echo $id; ?>+'&quarter=2';return false;">Add Milestone</a></td>-->
<a class="btn btn-info btn-sm" target="_blank" onclick="javascript:window.open('addms.php?mid=<? echo $id;?>&quarter=2','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")"">Add New Milestone</a></td>
</tr>
<tr>
<td><span class="text">Quarter 3: </br><?php //echo $ms3; ?></span>
<?
$sqlm = "SELECT `Milestones`.*\n"
    . "FROM `Milestones`\n"
    . "WHERE ((`Milestones`.`main_id` ='".$id."') AND (`Milestones`.`quarter` =3))\n"
    . " LIMIT 0, 30 ";
	$msresult = mysqli_query($con,$sqlm);
	while($rowms = mysqli_fetch_array($msresult))
	{
?>
<span id="ms_<? echo $rowms['ms_id']?>" class="text"><? echo $rowms['milestone']?></span>
<?
}
?>
</br><!--<a href="addms.php" target="_blank" onclick="location.href=this.href+'?mid='+<?echo $id; ?>+'&quarter=3';return false;">Add Milestone</a></td>-->
<a class="btn btn-info btn-sm" target="_blank" onclick="javascript:window.open('addms.php?mid=<? echo $id;?>&quarter=3','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")"">Add New Milestone</a></td>
</tr>
<tr>
<td><span class="text">Quarter 4: </br><?php //echo $ms4; ?></span>
<?
$sqlm = "SELECT `Milestones`.*\n"
    . "FROM `Milestones`\n"
    . "WHERE ((`Milestones`.`main_id` ='".$id."') AND (`Milestones`.`quarter` =4))\n"
    . " LIMIT 0, 30 ";
	$msresult = mysqli_query($con,$sqlm);
	echo "<UL>";
	while($rowms = mysqli_fetch_array($msresult))
	{
?>
<li id="ms_<? echo $rowms['ms_id']?>" class="text"><? echo $rowms['milestone']?></li>
<?
}
echo "</ul>";
?>
</br><!--<a href="addms.php" target="_blank" onclick="location.href=this.href+'?mid='+<?echo $id; ?>+'&quarter=4';return false;">Add Milestone</a></td>-->
<a class="btn btn-info btn-sm" target="_blank" onclick="javascript:window.open('addms.php?mid=<? echo $id;?>&quarter=4','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")"">Add New Milestone</a></td>
</tr>


</tr>

<?php
}
?>
<tr>
<!--<td colspan="4"><a href="addtar.php" target="_blank" onclick="location.href=this.href+'?fid='+<? echo $fid;?>+'&tid='+<? echo $rowt["target_id"];?>+'&bid='+<? echo $bid?>;return false;">Add New Target</a></td>-->
<td colspan="4"><a class="btn btn-info btn-sm" target="_blank" onclick="javascript:window.open('addtar.php?fid=<? echo $fid;?>&tid=<? echo $rowt["target_id"];?>&bid=<? echo $bid?>','Windows','width=1000,height=450,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")"">Add New Target</a></td>
</tr>
</div>
<?
}
?>


</table>
<!--<a href="printerfriendly.php" target="_blank" onclick="location.href=this.href+'?bid='+branch.value+'&fid='+focarea.value;return false;">Printer Friendly</a>-->
