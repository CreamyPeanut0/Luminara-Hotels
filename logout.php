<?php
session_start();
session_destroy();
header("Location: Luminara.php");
exit;
?>
