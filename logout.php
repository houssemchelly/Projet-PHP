<?php
// Fichier : logout.php
session_start();
session_destroy();
header("Location: login1.php");
exit;
?>
