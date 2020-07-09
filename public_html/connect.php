<?php

$servername = "localhost";
$username = "id12585906_adil";
$password = "Adil9444";
$database = "id12585906_tapin";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

