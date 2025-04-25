<?php
session_start();

// 🛡 Skydda adminpanelen
if (!isset($_SESSION['5ddf']) || $_SESSION['5ddf'] != 1) {
    header("Location: login.php");
    exit();
}

// 🧷 Databasanslutning
$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";
$conn = mysqli_connect($host, $user, $pass, $db);

// 🧹 Checka ut
if (isset($_POST['checkout'])) {
    $id = intval($_POST['id']);
    mysqli_query($conn, "UPDATE bokningar SET utcheckad = 1 WHERE id = $id");
    header("Location: admin.php");
    exit();
}

// 🗑 Radera
if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    mysqli_query($conn, "DELETE FROM bokningar WHERE id = $id");
    header("Location: admin.php");
    exit();
}

// ✏️ Redigera
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $namn = $_POST['namn'];
    $datum = $_POST['datum'];
    $rum = $_POST['rum'];
    mysqli_query($conn, "UPDATE bokningar SET namn='$namn', datum='$datum', rum='$rum' WHERE id = $id");
    header("Location: admin.php");
    exit();
}

// 🔍 Filtr
