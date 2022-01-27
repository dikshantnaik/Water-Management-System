<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "water-managment";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function alert_box($msg)
{
  echo "<script>alert(\"".$msg."\")</script>";

}
?>