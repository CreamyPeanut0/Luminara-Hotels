
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>grg</title>
    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css'); ?>">
</head>
<body>




</body>
</html>



<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Kunde inte ansluta till databasen: " . mysqli_connect_error());
}

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
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



<div class="header">  
    <h1>Luminara Hotels</h1>  
    <div class="knappar">
        <a href="om.php">Om oss</a> 
        <a href="login.php">Logga in</a>
        <a href="kontakta.php">Kontakta oss</a>
        <a href="boka.php">Boka</a>

        <?php if (isset($_SESSION['5ddf']) && $_SESSION['5ddf'] == 10): ?>
            <a href="admin.php">Admin</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['name'])): ?>
    <a href="logout.php">Logga ut (<?php echo $_SESSION['name']; ?>)</a>
<?php endif; ?>
    </div>
</div>


<div class="main-content">
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
</div>