<?php
//initialiseren en declareren voor database//
$servername = "localhost";
$dbname = "flowerpower3";
$username = "root";
$password = "";

//verbinding met database//
$conn = mysqli_connect($servername,$username,$password,$dbname);

//als er geen connectie is met database krijg je error te zien//
if(!$conn) {
    die("Could not connect. ".mysqli_connect_error());
}

?>