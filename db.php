<?php  
	/*$conn = mysqli_connect('localhost', 'root', '');
	 if (!$conn)
    {
	 die('Could not connect: ' . mysql_error());
	}
	mysqli_select_db("biddingsystemdb", $conn);*/
	$servername = "localhost";
$username = "root";
$password = "";
$database="biddingsystemdb";


$conn = new mysqli($servername, $username, $password,$database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>