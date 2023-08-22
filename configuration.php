<?php
$servername ="localhost";
$username ="username";
$password ="password";
$dbname ="portfolio";


//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//connection check
if ($conn->connect_error) {
	die("Connection failed". $conn->connect_error);
}
?>