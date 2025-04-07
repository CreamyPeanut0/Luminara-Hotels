<
<?php
session_start();
require 'db.php';
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anv = $_POST['användare'];
    $los = $_POST['lösenord'];
    $sql = "SELECT * FROM användare WHERE användarnamn = '$anv' AND lösenord = '$los'";
    $resultat = $conn->query($sql);
    if ($resultat->num_rows > 0) {
        $_SESSION['användare'] = $anv;
        header("Location: loggain.php");
    } else {
        $error = "Fel användarnamn eller lösenord!";
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
  <meta charset="UTF-8">
  <title>Logga in - Luminara</title>
  <link rel="stylesheet" href="main.css">
</head>
<body>
  <div class="header">
    <h1>Luminara Hotels</h1>
    <div class="knappar">
      <a href="index.php">Hem</a> 
      <a href="boka.php">Boka</a>
      <a href="kontakta.php">Kontakta</a>
    </div>
  </div>

  <div class="main-content">
    <h2>Logga in</h2>
    <form method="POST" class="formulär">
      <input type="text" name="användare" placeholder="Användarnamn" required><br>
      <input type="password" name="lösenord" placeholder="Lösenord" required><br>
      <input type="submit" value="Logga in">
    </form>
    <p style="color:red;"><?php echo $error; ?></p>
  </div>
</body>
</html>
