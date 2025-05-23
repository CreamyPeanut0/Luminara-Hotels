<?php
// Startar session för att hålla koll på inloggning
session_start();

// Kollar om användaren är inloggad som administratör
// Vi använder session-variabeln 'admin_status' för att kontrollera rättighet
if (!isset($_SESSION['admin_status']) || $_SESSION['admin_status'] != 10) {
    // Om man inte är admin, skickas man till inloggningssidan
    header("Location: login.php");
    exit;
}

// Anslut till databasen
$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";
$conn = mysqli_connect($host, $user, $pass, $db);

// Kontrollera om anslutningen lyckades
if (!$conn) {
    die("Kunde inte ansluta till databasen: " . mysqli_connect_error());
}

// Om admin klickat på "ta bort bokning"
if (isset($_GET['tabort_id'])) {
    $id = intval($_GET['tabort_id']); // omvandla till heltal för säkerhet
    mysqli_query($conn, "DELETE FROM bokningar WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Om admin klickat på "ta bort klagomål"
if (isset($_GET['tabort_klagomal_id'])) {
    $id = intval($_GET['tabort_klagomal_id']);
    mysqli_query($conn, "DELETE FROM klagomal WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Om admin klickat på "åtgärda klagomål"
if (isset($_GET['atgarda_klagomal_id'])) {
    $id = intval($_GET['atgarda_klagomal_id']);
    mysqli_query($conn, "UPDATE klagomal SET status = 'Åtgärdat' WHERE id = $id");
    header("Location: admin.php");
    exit;
}

// Hämta alla bokningar från databasen
$bokningar = mysqli_query($conn, "SELECT * FROM bokningar");

// Hämta alla klagomål från databasen
$klagomal = mysqli_query($conn, "SELECT * FROM klagomal");
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Adminpanel - Luminara Hotels</title>
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
        <a href="admin.php">Admin</a>
        <a href="logout.php">Logga ut (<?php echo $_SESSION['name']; ?>)</a>
    </div>
</div>

<div class="main-content">

    <h2>Bokningar</h2>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 40px;">
        <thead>
            <tr style="background-color: #3E2723; color: white;">
                <th>ID</th>
                <th>Namn</th>
                <th>Datum</th>
                <th>Rum</th>
                <th>Ta bort</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($bokningar)): ?>
            <tr style="background-color: #f9f9f9; text-align: center;">
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['namn']); ?></td>
                <td><?php echo htmlspecialchars($row['datum']); ?></td>
                <td><?php echo htmlspecialchars($row['rum']); ?></td>
                <td><a href="admin.php?tabort_id=<?php echo $row['id']; ?>" style="color: red; text-decoration: none; font-weight: bold;">Ta bort</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Klagomål</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #3E2723; color: white;">
                <th>ID</th>
                <th>Användare</th>
                <th>Klagomål</th>
                <th>Datum</th>
                <th>Status</th>
                <th>Åtgärda</th>
                <th>Ta bort</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($klagomal)): ?>
            <tr style="background-color: #f9f9f9; text-align: center;">
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['klagomal_text'])); ?></td>
                <td><?php echo $row['datum']; ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td><a href="admin.php?atgarda_klagomal_id=<?php echo $row['id']; ?>" style="color: #D4AF37; font-weight: bold; text-decoration: none;">Åtgärda</a></td>
                <td><a href="admin.php?tabort_klagomal_id=<?php echo $row['id']; ?>" style="color: red; font-weight: bold; text-decoration: none;">Ta bort</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

<footer>
    <div class="box4">
        <p>Kontakt: info@hotelluminara.se | Tel: 0123-456 789</p>
        <p>&copy; 2025 Hotel Luminara</p>
    </div>
</footer>

</body>
</html>
