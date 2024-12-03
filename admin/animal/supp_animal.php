<?php
include '../../connection.php';

$id = $_GET['id'];

// Supprimer les enregistrements dépendants dans la table soustype
$supp_soustype = $bd->prepare('DELETE FROM soustype WHERE type_id = :id');
$supp_soustype->bindParam(':id', $id, PDO::PARAM_INT);
$supp_soustype->execute();

// Ensuite, supprimer l'enregistrement dans la table animal
$supp_animal = $bd->prepare('DELETE FROM animal WHERE id = :id');
$supp_animal->bindParam(':id', $id, PDO::PARAM_INT);

if ($supp_animal->execute()) {
    header("Location: liste_animals.php");
    exit();
}
?>
