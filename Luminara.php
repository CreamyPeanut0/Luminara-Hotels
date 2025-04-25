<?php
session_start();
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luminara Hotels</title>
    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css'); ?>">
</head>
<body>

<div class="header">  
    <h1>Luminara Hotels</h1>  
    <div class="knappar">
        <a href="om.php">Om oss</a> 
        <a href="login.php">Logga in</a>
       
        <a href="boka.php">Boka</a>

        <?php if (isset($_SESSION['5ddf']) && $_SESSION['5ddf'] == 10): ?>
            <a href="admin.php">Admin</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['name'])): ?>
    <a href="logout.php">Logga ut (<?php echo $_SESSION['name']; ?>)</a>
<?php endif; ?>
    </div>
</div>

<div class="main"></div>

<div class="sektion">
    <h2>Våra rum</h2>
    <div class="rumrutor">
        <div class="rum">
            <img src="standard.png" alt="Standardrum">
            <div class="info">Standard<br>Bekvämt, stilrent och prisvärt boende.</div>
        </div>
        <div class="rum">
            <img src="deluxe.png" alt="Deluxerum">
            <div class="info">Deluxe<br>Rymligt, elegant med extra komfort.</div>
        </div>
        <div class="rum">
            <img src="svit.png" alt="Svit">
            <div class="info">Svit<br>Lyxig upplevelse med fantastisk utsikt</div>
        </div>
    </div>
</div>

</body>
</html>
