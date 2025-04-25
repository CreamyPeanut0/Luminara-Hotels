<?php
session_start();

if (!isset($_SESSION['5ddf']) || $_SESSION['5ddf'] != 10) {
    header("Location: Luminara.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";
$conn = mysqli_connect($host, $user, $pass, $db);

$id = $_POST['id'];
$query = "DELETE FROM bokningar WHERE id=$id";
mysqli_query($conn, $query);

header("Location: admin.php");
exit;
?>
