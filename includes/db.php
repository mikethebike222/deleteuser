<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$servername = 'localhost';
$salt = "rbrfbrfbuffbu5offjnfjnk"; 

try {
	$conn = new PDO("mysql:host=$servername;dbname=mikedata", $username, 
															$password);
	  // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	} catch(PDOException $e) {
	  echo "Connection failed: " . $e->getMessage();
	}


// INSERT INTO `mvn_users` (`email`, `password`, `age`, `username`) VALUES ('haku@haku.com', 'hakuhaku', '17', 'haku1')

function register(string $email, string $password, int $age, string $username){
	global $conn;
   global	$salt;

$password = hash('sha256', $password . $salt);

$sql = "INSERT INTO `mvn_users` (`email`, `password`, `age`, `username`) VALUES (?, ?, ?, ?);" ;
//prepare the sql statement
$stmt = $conn->prepare($sql);
// execute teh query with the values
$stmt->execute([$email, $password, $age, $username]);

	/* $count = $del->rowCount(); */
}




?>
