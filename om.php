
<!DOCTYPE html>
<html lang="sv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Om Oss</title>
  <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css'); ?>">
</head>
<body>
<div class="header">  
    <h1>Luminara Hotels</h1>  
    <div class="knappar">
        <a href="luminara.php">Hem</a> 
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




<div class="main-content">
  
    <div class="box4">
      
      <div class="text">
        <h2>Om Oss</h2>
        <p>
          Välkommen till Hotel Luminara – ditt andra hem i hjärtat av staden. 
          Vi erbjuder eleganta rum, förstklassig service och en unik upplevelse 
          som du sent kommer att glömma. Vårt team strävar alltid efter att göra 
          din vistelse minnesvärd.
        </p>
        <p>
          Oavsett om du reser för affärer eller nöje, är Hotel Harmony det perfekta valet.
        </p>
      </div>
    </div>
    </div>

  <footer>
    <div class="box4">
      <p>Kontakt: info@hotelluminara.se | Tel: 0123-456 789</p>
      <p>&copy; 2025 Hotel Luminara</p>
    </div>
  </footer>
</body>
</html>
