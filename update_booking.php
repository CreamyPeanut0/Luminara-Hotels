<?php
session_start();

if (!isset($_SESSION['5ddf']) || $_SESSION['5ddf'] != 10) {
    header("Location: index.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";
$conn = mysqli_connect($host, $user, $pass, $db);

$id = $_POST['id'];
$namn = $_POST['namn'];
$datum = $_POST['datum'];
$rum = $_POST['rum'];

$query = "UPDATE bokningar SET namn='$namn', datum='$datum', rum='$rum' WHERE id=$id";
mysqli_query($conn, $query);

header("Location: admin.php");
exit;
?>
