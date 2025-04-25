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
        header("Location: index.php");
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

<form action="login.php" method="post" style="text-align:center; margin-top: 100px;">
    <label for="username">Användarnamn:</label><br>
    <input type="text" name="username" required><br>

    <label for="password">Lösenord:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="btnLogin">Logga in</button>
</form>

</body>
</html>
