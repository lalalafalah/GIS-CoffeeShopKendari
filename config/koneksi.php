<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "gis_coffee";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$con = new mysqli("localhost", "root", "", "gis_coffee");

?>