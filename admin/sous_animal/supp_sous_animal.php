<?php
include '../../connection.php';

$id = $_GET['id'];

$supp_animal = $bd->prepare('DELETE FROM soustype WHERE id = :id');
$supp_animal->bindParam(':id', $id, PDO::PARAM_INT);

if ($supp_animal->execute()) {
    header("Location: liste_sous_animal.php");
    exit();
}
?>
