<?php
include 'connection.php';
    $user=$_GET["utilisateur_id"];
    $subtype=$_GET["sousType_id"];

    $insert=$bd->prepare("insert into favoris (utilisateur_id, sousType_id) values (:user, :subtype)");
    $insert->bindParam(':libelle',$libelle);
    $insert->bindParam(':prix',$prix);
    $insert->bindParam(':codeF',$codeF);
    if ($insert->execute()) {
        header("Location: liste_produits.php");
        exit(); 
    } 
?>