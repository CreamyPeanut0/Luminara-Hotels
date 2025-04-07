<?php
$host = "localhost";
$user = "root";      // standard i XAMPP
$pass = "";          // inget lösenord i XAMPP
$dbname = "luminara";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Kunde inte ansluta till databasen: " . $conn->connect_error);
}
?>
