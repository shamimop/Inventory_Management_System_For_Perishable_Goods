<?php


$servername = "localhost";

$username = "root";

$password = "";


$dbname = "inventory_management_sys";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}


?>

