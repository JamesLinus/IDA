<?
//required includes
include '../wp-config.php';
include 'includes/dbconnect.php';
include 'includes/userdata.php';
?>

<script type='text/javascript'>
function edit(str)
{
//alert(str);

if (str=="")
{
document.getElementById("txtHint").innerHTML="";
return;
} 
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","EDIT.php?id="+str,true);
xmlhttp.send();
}
</script>


<?php
$bid = intval($_GET['id']);
//$q = $_POST["quarter"];
$t = intval($_GET['t']);

$sql = "SELECT `Main`.*\n"
    . "FROM `Main`\n"
    . "WHERE ((`Main`.`branch_id` = '".$bid."') AND (`Main`.`target_id` = '".$t."'))\n"
    . " LIMIT 0, 30 ";
$result = mysqli_query($con,$sql);
if ($role == 'administrator' || $role = "branchadmin"){
echo "<table border='1' width='1000px'>
<tr>
<th colspan='2'>Target</th>
<th>Baseline</th>
<th>Strategies</th>
<th>Milestones</th>
</tr>";
}else {
echo "<table border='1' width='1000px'>
<tr>
<th >Target</th>
<th>Baseline</th>
<th>Strategies</th>
<th>Milestones</th>
</tr>";}
if (!$result){
	die(mysql_error());
	}

while($row=mysqli_fetch_array($result))
{
$id=$row['main_id'];
$advtar=$row['main_target'];
$advbase=$row['main_baseline'];
$advstrat=$row['main_strategies'];
$ms1=$row['quarter_1'];
$ms2=$row['quarter_2'];
$ms3=$row['quarter_3'];
$ms4=$row['quarter_4'];
?>
<tr id="<?php echo $id; ?>" class="edit_tr" >
<?
if ($user_role == 'branchadmin' || $user_role == 'administrator'){
?>
<td rowspan="4">
<!--<button type="button" onclick="edit(<? echo $id; ?>)">Edit</button>-->
<a style="background:buttonface" href="EDIT.php?id=<? echo $id ?>">Edit</a></br>
<a href="delete.php?id=<? echo $id?>" onclick="return confirm('Are you sure want to delete');">Delete</a>
</td>

<?
} else
echo "<td rowspan='4'></td>";
?>

<td class="edit_td" width="500px" rowspan="4">
<span id="tar_<?php echo $id; ?>" class="text"><?php echo $advtar; ?></span>
<!--<input type="text" value="<?php echo $advtar; ?>" class="editbox" id="first_input_<?php echo $id; ?>" /&gt;-->
</td>

<td class="edit_td" width="500px" rowspan="4">
<span id="base_<?php echo $id; ?>" class="text"><?php echo $advbase; ?></span> 
<!--<input type="text" value="<?php echo $advbase; ?>" class="editbox" id="last_input_<?php echo $id; ?>"/>-->
</td>

<td class="edit_td" width="500px" rowspan="4">
<span id="strat_<?php echo $id; ?>" class="text"><?php echo $advstrat; ?></span> 
<!--<input type="text" value="<?php echo $advstrat; ?>" class="editbox" id="last_input_<?php echo $id; ?>"/>-->
</td>


<td><span class="text" width="500px">Quarter 1: </br> <?php echo $ms1; ?></span></td>
<tr>
<td><span class="text" width="500px">Quarter 2: </br><?php echo $ms2; ?></span></td>
</tr>
<tr>
<td><span class="text" width="500px">Quarter 3: </br><?php echo $ms3; ?></span></td>
</tr>
<tr>
<td><span class="text" width="500px">Quarter 4: </br><?php echo $ms4; ?></span></td>
</tr>



</tr>

<?php
}
echo $bid;
?>
<a href="printerfriendly.php" target="_blank" onclick="location.href=this.href+'?bid='+branch.value+'&fid='+focarea.value;return false;">Printer Friendly</a>
</table>