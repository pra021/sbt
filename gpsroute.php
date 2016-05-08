<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="refresh" content="15">
<body>

<?php
$dbhost = 'localhost';
$dbuser = 'gps';
$dbpass = 'abcd4321';
$db = 'route';

date_default_timezone_set("Asia/Kolkata");

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
   
   if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
   
   $sql = 'SELECT * FROM routes ORDER BY id';
   $sql2 = 'SELECT * FROM currentloc';
   
   $retval = $conn->query($sql);
   $retval2 = $conn->query($sql2);
   
   while($rowl = mysqli_fetch_array($retval2)) {
	   $cloc = $rowl['cloc'];
   }
   
   if(! $retval ) {
      die('Could not get data: ' . mysqli_error());
   }
   echo "<table>";
   while($row = mysqli_fetch_array($retval)) {
	   $rloc = $row['rloc'];
	   $stime = $row['stime'];
	   $atime = $row['atime'];
	   $to_time = strtotime($atime);
$from_time = strtotime($stime);
$late = "";
if($from_time>$to_time && $atime !== '-')
{
	$late = "On time";
}
else if($atime !== '-')
{
$late = round(abs($to_time - $from_time) / 60,2)." min late";
}
      ?>
	  <tr><td align=center bgcolor=yellow COLSPAN=2 <?php if($cloc==$rloc){ echo "class='active'"; }?>><?php echo $rloc; ?> </td></tr><tr><td bgcolor=skyblue>Schedule:<?php echo $stime; ?></td><td bgcolor=palegreen rowspan=2><?php echo $late; ?></td></tr><tr><td bgcolor=orange>Arrived:<?php echo $atime; ?></td></tr>
	  <?php
	  
   }

   
   mysqli_close($conn);
?>
<tr><td> </td></tr></table>

</body>
</html>