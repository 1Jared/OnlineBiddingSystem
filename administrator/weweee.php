<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
	require("../db.php");
	$productid = $_POST['id'];
	mysqli_query($con,"UPDATE products SET status = 1 WHERE productid = '$productid' ") or die (mysqli_error());
?>
<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
	$datenow = date('l,F d,Y');
	$endedsum = mysqli_query($con,"SELECT * FROM products WHERE duedate < '$datenow' AND status = 0") or die(mysqli_error());
	$counters = 0;
	WHILE($stat = mysqli_fetch_array($endedsum)){
		$counters++;
	}
	echo $counters;
	
?>