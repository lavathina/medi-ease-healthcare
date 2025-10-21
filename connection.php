<?php
$host_name = "localhost";
$sql_username = "root";
$sql_password = "";
$dbname = "medi EASE";   // ✅ fixed (no space)

$conn = mysqli_connect($host_name, $sql_username, $sql_password, $dbname);

if (!$conn) {
    die("Connection to the database failed! " . mysqli_connect_error());
}
?>
