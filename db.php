<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "filmoteka_db";

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Konekcija sa bazom podataka je neuspješna: " . $conn->connect_error);
}
?>