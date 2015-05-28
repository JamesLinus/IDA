<?php
include "../../includes/functions.php";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbsel);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$ID = $_GET['id'];
$tbl = $_GET['tbl'];
if ($tbl == 'users'){
$sql = 'DELETE FROM '.$tbl.'
        WHERE userID = '.$ID.'';
} else if ($tbl == 'branch'){
$sql = 'DELETE FROM '.$tbl.'
        WHERE branchID = '.$ID.'';
 }
$retval = mysqli_query($conn, $sql);
if(! $retval )
{
  die('Could not delete data: ' . mysql_error());
}
echo "Deleted data successfully\n";

mysqli_close($conn);
?>
<p>You will be redirected in <span id="counter">5</span> second(s) or you may click 
<script>document.write('<a href="' + document.referrer + '">here</a>');</script></p>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=1) {
        location.href = document.referrer;
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);
</script>