<?php

$servername = "localhost"; 
$username = "dewbxcak_admin1";  
$password = "mg9pO%V)fj-]";  
$dbname = "dewbxcak_zeneviaexpressEcom";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";