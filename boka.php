<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boka rum</title>
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
        <form method="POST" class="formulär">
            <h2>Boka ditt rum</h2>
            <input type="text" name="namn" placeholder="Ditt namn" required><br>
            <input type="date" name="datum" required><br>
            <select name="rum" id="rumSelect">
                <option value="Standard">Standard</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Svit">Svit</option>
            </select><br>
            <div id="rumImage" class="rum-image-container">
                
            </div>
            <input type="submit" value="Boka">
        </form>
    </div>

    <footer>
        <div class="box4">
            <p>Kontakt: info@hotelluminara.se | Tel: 0123-456 789</p>
            <p>&copy; 2025 Hotel Luminara</p>
        </div>
    </footer>

    <script>
        
        document.getElementById('rumSelect').addEventListener('change', function() {
            var rumVal = this.value;
            var rumImageContainer = document.getElementById('rumImage');
            var image = '';

            
            if (rumVal === 'Standard') {
                image = '<img src="standard.png" alt="Standardrum" class="rum-bild">';
            } else if (rumVal === 'Deluxe') {
                image = '<img src="deluxe.png" alt="Deluxerum" class="rum-bild">';
            } else if (rumVal === 'Svit') {
                image = '<img src="svit.png" alt="Svit" class="rum-bild">';
            }

            
            rumImageContainer.innerHTML = image;
        });

    
        document.getElementById('rumSelect').dispatchEvent(new Event('change'));
    </script>

</body>
</html>
