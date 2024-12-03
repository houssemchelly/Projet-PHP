<?php
include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $type_id = $_POST['type_id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $prix = $_POST['prix'];

    $update = $bd->prepare("UPDATE soustype SET type_id = :type_id, name = :name, image=:image, prix=:prix WHERE id = :id");
    $update->bindParam(':type_id', $type_id);
    $update->bindParam(':name', $name);
    $update->bindParam(':image', $image);
    $update->bindParam(':prix', $prix);
    $update->bindParam(':id', $id, PDO::PARAM_INT);

    if ($update->execute()) {
        header("Location: liste_sous_animal.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour du produit.";
    }
}
?>
