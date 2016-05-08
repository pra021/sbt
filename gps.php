<?php

$dbhost = 'localhost';
$dbuser = 'gps';
$dbpass = 'abcd4321';
$dbtable = 'route';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbtable);
if(! $conn )
{
  die('Could not connect: ' . mysqli_error());
}

date_default_timezone_set("Asia/Kolkata");

$atime = date("g:i A");
$rid = "1";
$rloc = $_GET['cloc'];

$sql = " UPDATE routes SET  atime = '$atime',  rid = '$rid' WHERE rloc = '$rloc' "; 

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>