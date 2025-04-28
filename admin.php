<?php
session_start();

// Kontrollera att användaren är admin (userlevel 10)
if (!isset($_SESSION['5ddf']) || $_SESSION['5ddf'] != 10) {
    header("Location: index.php");
    exit;
}

// Databasanslutning
$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";
$conn = mysqli_connect($host, $user, $pass, $db);

// Hämta bokningar
$query = "SELECT * FROM bokningar";
$result = mysqli_query($conn, $query);

// Hämta klagomål
$klagomal_query = "SELECT * FROM klagomal ORDER BY datum DESC";
$klagomal_result = mysqli_query($conn, $klagomal_query);
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Adminpanel</title>
    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css'); ?>">
</head>
<body>

<!-- Header börjar här -->
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
<!-- Header slutar här -->

<div class="main-content">
    <h2>Adminpanel – Bokningar</h2>

    <!-- Bokningar -->
    <table border="1" cellpadding="10" style="margin: auto; background-color: #fff;">
        <tr>
            <th>ID</th>
            <th>Namn</th>
            <th>Datum</th>
            <th>Rum</th>
            <th>Ändra</th>
            <th>Ta bort</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <!-- Formulär för att uppdatera -->
            <form action="update_booking.php" method="post">
                <td><?php echo $row['id']; ?>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                </td>
                <td><input type="text" name="namn" value="<?php echo htmlspecialchars($row['namn']); ?>"></td>
                <td><input type="date" name="datum" value="<?php echo htmlspecialchars($row['datum']); ?>"></td>
                <td><input type="text" name="rum" value="<?php echo htmlspecialchars($row['rum']); ?>"></td>
                <td><input type="submit" value="Spara"></td>
            </form>

            <!-- Formulär för att ta bort -->
            <form action="delete_booking.php" method="post" onsubmit="return confirm('Är du säker på att du vill ta bort bokningen?');">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <td><input type="submit" value="Ta bort" style="background-color:red; color:white;"></td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Klagomål -->
    <hr><br>

    <h2>Inkomna Klagomål</h2>

    <?php if (mysqli_num_rows($klagomal_result) > 0): ?>
        <table border="1" cellpadding="10" style="margin: auto; background-color: #fff;">
            <tr>
                <th>ID</th>
                <th>Användare</th>
                <th>Klagomål</th>
                <th>Datum</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($klagomal_result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['klagomal_text'])); ?></td>
                <td><?php echo $row['datum']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center;">Inga klagomål ännu.</p>
    <?php endif; ?>

</div>

<!-- Footer börjar här -->
<footer>
    <div class="box4">
        <p>Kontakt: info@hotelluminara.se | Tel: 0123-456 789</p>
        <p>&copy; 2025 Hotel Luminara</p>
    </div>
</footer>
<!-- Footer slutar här -->

</body>
</html>
