<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');
	require("../db.php");
	$msgnotifsid = $_POST['id'];
	mysqli_query($con,"UPDATE msgnotifs SET status = 1 WHERE msgnotifsid = '$msgnotifsid'") or die (mysqli_error());
?>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$con=mysqli_connect('localhost', 'root', '', 'biddingsystemdb');ss
	$msgnum = mysqli_query($con,"SELECT * FROM msgnotifs WHERE (toid = 'admin' AND status = 0)") or die(mysqli_error());
	$counter = 0;
	WHILE($stat = mysqli_fetch_array($msgnum)){
	$counter++;
	}
?>