<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $categorie = $_POST['categorie'];
    $type = $_POST['type'];

    $update = $dbh->prepare("UPDATE animal SET categorie = :categorie, type = :type WHERE id = :id");
    $update->bindParam(':categorie', $categorie);
    $update->bindParam(':type', $type);
    $update->bindParam(':id', $id, PDO::PARAM_INT);

    if ($update->execute()) {
        header("Location: liste_animals.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour du produit.";
    }
}
?>
