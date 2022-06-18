<?php
$servername = "localhost";
$dbname = "flowerpower1";
$username = "root";
$password = "";

// try {
//   $conn = new PDO("mysql:host=$servername;dbname=flowerpower1", $username, $password);
//   // set the PDO error mode to exception
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn) {
    die("Could not connect. ".mysqli_connect_error());
}


?>