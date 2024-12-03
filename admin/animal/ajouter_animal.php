<?php
include '../../connection.php';

    echo"<h1>Ajouter animal</h1>";
    echo"<form action='' method='post'>";

    $animal=$bd->query("SELECT * FROM categories");
    echo"<select name='id_categories'>";
    foreach($animal->fetchAll()as $line)
    {
        echo"<option value='".$line['id']."'>".$line['nom']."</option>";      
    }
    echo"</select></br>
    <input type='text' name='type'>";
    echo "<input type='submit' value='Ajouter'>
    </form>";  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_categories=$_POST["id_categories"];
        $type=$_POST["type"];

        $insert=$bd->prepare("insert into animal (id_categories, type) values (:id_categories, :type)");
        $insert->bindParam(':id_categories',$id_categories);
        $insert->bindParam(':type',$type);
        if ($insert->execute()) {
            header("Location: liste_animals.php");
            exit(); 
        } 
    }
?>