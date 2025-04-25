<?php
session_start();


if (!isset($_SESSION['5ddf']) || $_SESSION['5ddf'] != 10) {
    header("Location: Luminara.php");
    exit;
}


$host = "localhost";
$user = "root";
$pass = "";
$db = "luminarareal";
$conn = mysqli_connect($host, $user, $pass, $db);


$query = "SELECT * FROM bokningar";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Adminpanel</title>
    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css'); ?>">
</head>
<body>

<div class="main-content">
    <h2>Adminpanel – Bokningar</h2>
    
    <p style="text-align:center;">
        <a href="Luminara.php">Tillbaka till startsidan</a> | 
        <a href="logout.php">Logga ut</a>
    </p>

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
            
            <form action="update_booking.php" method="post">
                <td><?php echo $row['id']; ?>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                </td>
                <td><input type="text" name="namn" value="<?php echo $row['namn']; ?>"></td>
                <td><input type="date" name="datum" value="<?php echo $row['datum']; ?>"></td>
                <td><input type="text" name="rum" value="<?php echo $row['rum']; ?>"></td>
                <td><input type="submit" value="Spara"></td>
            </form>

            
            <form action="delete_booking.php" method="post" onsubmit="return confirm('Är du säker på att du vill ta bort bokningen?');">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <td><input type="submit" value="Ta bort" style="background-color:red; color:white;"></td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
