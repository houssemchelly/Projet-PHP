<?php
include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id_categories = $_POST['id_categories'];
    $type = $_POST['type'];

    $update = $bd->prepare("UPDATE animal SET id_categories = :id_categories, type = :type WHERE id = :id");
    $update->bindParam(':id_categories', $id_categories);
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
