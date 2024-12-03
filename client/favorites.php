<?php
// Fichier : favorites.php
session_start();
require '../connection.php';

if (!isset($_SESSION['id'])) {
    echo "Connectez-vous pour gérer vos favoris.";
    exit;
}

$utilisateur_id = $_SESSION['utilisateur_id'];
$sousType_id = $_POST['sousType_id'];
$action = $_POST['action'];

if ($action === 'add') {
    $stmt = $bd->prepare("INSERT INTO favoris (utilisateur_id, sousType_id) VALUES (?, ?)");
    $stmt->execute([$utilisateur_id, $sousType_id]);
} elseif ($action === 'remove') {
    $stmt = $bd->prepare("DELETE FROM favoris WHERE utilisateur_id = ? AND sousType_id = ?");
    $stmt->execute([$utilisateur_id, $sousType_id]);
}
header("Location: index.php");
exit;
?>
