<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";
$conn = mysqli_connect($host, $user, $pass, $db);

if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $strQuery = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $strQuery);

    if (mysqli_num_rows($result) == 1) {
        $raden = mysqli_fetch_assoc($result);
        $_SESSION['5sp'] = $raden['id'];
        $_SESSION['5ddf'] = $raden['userlevel'];
        $_SESSION['name'] = $raden['username'];
        header("Location: Luminara.php");
    } else {
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

        <?php if (isset($_SESSION['5ddf']) && $_SESSION['5ddf'] == 10): ?>
            <a href="admin.php">Admin</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['name'])): ?>
    <a href="logout.php">Logga ut (<?php echo $_SESSION['name']; ?>)</a>
<?php endif; ?>
    </div>
</div>




<<div class="main-content">
    <form action="login.php" method="post" class="formulär">
        <label for="username">Användarnamn:</label><br>
        <input type="text" name="username" required><br>

        <label for="password">Lösenord:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="btnLogin">Logga in</button>
    </form>
</div>

</body>
</html>
