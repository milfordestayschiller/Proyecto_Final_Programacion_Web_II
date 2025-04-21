<?php
$host = "localhost";
$user = "root";
$password = "master333";
$database = "LIBRERIA";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
  die("Conexión fallida: " . mysqli_connect_error());
}
?>
