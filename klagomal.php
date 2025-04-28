<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";
$conn = mysqli_connect($host, $user, $pass, $db);

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['5sp'];
    $username = $_SESSION['name'];
    $klagomal_text = mysqli_real_escape_string($conn, $_POST['klagomal_text']);

    $query = "INSERT INTO klagomal (user_id, username, klagomal_text) VALUES ('$user_id', '$username', '$klagomal_text')";
    mysqli_query($conn, $query);

    $message = "Tack! Ditt klagomål har skickats.";
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Lämna klagomål</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css'); ?>">
</head>
<body>

<div class="header">
    <h1>Luminara Hotels</h1>
    <div class="knappar">
        <a href="om.php">Om oss</a>
        <a href="login.php">Logga in</a>
        <a href="Luminara.php">Hem</a>

        <?php if (isset($_SESSION['5ddf']) && $_SESSION['5ddf'] == 10): ?>
            <a href="admin.php">Admin</a>
        <?php endif; ?>

        <?php if (isset($_SESSION['name'])): ?>
            <a href="logout.php">Logga ut (<?php echo $_SESSION['name']; ?>)</a>
        <?php endif; ?>
    </div>
</div>

<div class="main-content">
    <h2>Lämna klagomål</h2>

    <?php if (isset($message)): ?>
        <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form class="formulär" action="klagomal.php" method="post">
        <textarea name="klagomal_text" rows="6" placeholder="Vänligen skriv ditt klagomål här" required></textarea><br>
        <input type="submit" name="submit" value="Skicka">
    </form>

    <p><a href="Luminara.php">Tillbaka till startsidan</a></p>
</div>

<footer>
    <div class="box4">
        <p>Kontakt: info@hotelluminara.se | Tel: 0123-456 789</p>
        <p>&copy; 2025 Hotel Luminara</p>
    </div>
</footer>

</body>
</html>
