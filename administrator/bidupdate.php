
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
	require("../db.php");
	$bidid = $_POST['id'];
	mysql_query($con,"UPDATE bidreport SET status = 1 WHERE bidid = '$bidid'") or die (mysqli_error());
	
?>
<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
$bidnum = mysqli_query($con,"SELECT * FROM bidreport LEFT JOIN member ON member.memberid = bidreport.bidder LEFT JOIN products ON products.productid = bidreport.productid WHERE bidreport.status = 0") or die(mysqli_error());
			$count = 0;
			WHILE($stat = mysqli_fetch_array($bidnum)){
				$count++;
			}
			echo $count;
	
?>