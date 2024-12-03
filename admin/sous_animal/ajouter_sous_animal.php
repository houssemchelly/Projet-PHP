<?php
include '../../connection.php';

    echo"<h1>Ajouter sous animal</h1>";
    echo"<form action='' method='post'>";

    $animal=$bd->query("SELECT * FROM animal");
    echo"<select name='type_id'>";
    foreach($animal->fetchAll()as $line)
    {
        echo"<option value='".$line['id']."'>".$line['type']."</option>";      
    }
    echo"</select></br>
    name: <input type='text' name='name'><br/>
    image: <input type='url' name='image'>
    prix: <input type='number' name='prix'>";
    echo "<input type='submit' value='Ajouter'>
    </form>";  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $type_id=$_POST["type_id"];
        $name=$_POST["name"];
        $image=$_POST["image"];
        $prix=$_POST["prix"];

        $insert=$bd->prepare("insert into soustype (type_id, name, image, prix) values (:type_id, :name, :image, :prix)");
        $insert->bindParam(':type_id',$type_id);
        $insert->bindParam(':name',$name);
        $insert->bindParam(':image',$image);
        $insert->bindParam(':prix',$prix);
        if ($insert->execute()) {
            header("Location: liste_sous_animal.php");
            exit(); 
        } 
    }
?>