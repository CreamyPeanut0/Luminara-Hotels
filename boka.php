<?php
session_start();
require 'db.php';

if (!isset($_SESSION['användare'])) {
    header("Location: loggain.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namn = $_POST['namn'];
    $datum = $_POST['datum'];
    $rum = $_POST['rum'];

    $stmt = $conn->prepare("INSERT INTO bokningar (namn, datum, rum) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $namn, $datum, $rum);
    $stmt->execute();
    echo "<p>Bokning sparad för $namn ($rum, $datum)</p>";
}
?>

<form method="POST">
    <h2>Boka Rum</h2>
    <input type="text" name="namn" placeholder="Ditt namn" required><br>
    <input type="date" name="datum" required><br>
    <select name="rum">
        <option value="Standard">Standard</option>
        <option value="Deluxe">Deluxe</option>
        <option value="Svit">Svit</option>
    </select><br>
    <input type="submit" value="Boka">
</form>
