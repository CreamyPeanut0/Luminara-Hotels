<?php
session_start();

// Anslut till databasen
$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";
$conn = mysqli_connect($host, $user, $pass, $db);

// Om formuläret har skickats in
if (isset($_POST['btnLogin'])) {
    // Hämta användarnamn och lösenord från formuläret
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hämta användaren från databasen som matchar inloggningsuppgifterna
    $strQuery = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $strQuery);

    // Om exakt en användare hittas
    if (mysqli_num_rows($result) == 1) {
        $raden = mysqli_fetch_assoc($result);

        // Spara information i sessionen
        $_SESSION['user_id'] = $raden['id'];              // Tidigare '5sp'
        $_SESSION['admin_status'] = $raden['userlevel'];  // Tidigare '5ddf'
        $_SESSION['name'] = $raden['username'];           // Användarnamn

        // Skicka vidare till startsidan
        header("Location: Luminara.php");
    } else {
        // Inloggningen misslyckades – skicka tillbaka till login
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Logga in</title>
    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css'); ?>">
</head>
<body>

<div class="header">  
    <h1>Luminara Hotels</h1>  
    <div class="knappar">
        <a href="om.php">Om oss</a> 
        <a href="Luminara.php">Hem</a>
        <a href="boka.php">Boka</a>

        <!-- Visa adminlänk om användaren är admin -->
        <?php if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 10): ?>
            <a href="admin.php">Admin</a>
        <?php endif; ?>

        <!-- Visa utloggningslänk om användaren är inloggad -->
        <?php if (isset($_SESSION['name'])): ?>
            <a href="logout.php">Logga ut (<?php echo $_SESSION['name']; ?>)</a>
        <?php endif; ?>
    </div>
</div>

<div class="main-content">
    <form action="login.php" method="post" class="formulär">
        <label for="username">Användarnamn:</label><br>
        <input type="text" name="username" required><br>

        <label for="password">Lösenord:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="btnLogin">Logga in</button>
    </form>
</div>

<footer>
    <div class="box4">
        <p>Kontakt: info@hotelluminara.se | Tel: 0123-456 789</p>
        <p>&copy; 2025 Hotel Luminara</p>
    </div>
</footer>

</body>
</html>
