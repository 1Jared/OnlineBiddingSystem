<?php
	require("../db.php");
	ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
	$bidid = $_POST['id'];
	mysqli_query($con,"UPDATE bidreport SET status = 1 WHERE bidid = '$bidid'") or die (mysqli_error());
?>