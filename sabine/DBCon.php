<?php
$server = '127.0.0.1';
$user = 'root';
$pass = 'root';
$db = 'project';

$conn = mysqli_connect($server, $user, $pass, $db);

if(!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

function closeDb() {
	global $conn;
	mysqli_close($conn);
}

?>
