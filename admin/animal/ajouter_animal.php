<?php
include '../../connection.php';

    echo "<!DOCTYPE html>";
    echo "<html lang='fr'>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <title>Ajouter animal</title>";
    echo "    <style>";
    echo "        body {";
    echo "            font-family: Arial, sans-serif;";
    echo "            background-color: #f4f4f4;";
    echo "            display: flex;";
    echo "            justify-content: center;";
    echo "            align-items: center;";
    echo "            height: 100vh;";
    echo "            margin: 0;";
    echo "        }";
    echo "        .form-container {";
    echo "            background-color: #fff;";
    echo "            padding: 20px;";
    echo "            border-radius: 8px;";
    echo "            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);";
    echo "            width: 300px;";
    echo "            text-align: center;";
    echo "        }";
    echo "        h1 {";
    echo "            margin-bottom: 20px;";
    echo "            color: #333;";
    echo "        }";
    echo "        input[type='text'], select {";
    echo "            width: 100%;";
    echo "            padding: 10px;";
    echo "            margin: 10px 0;";
    echo "            border: 1px solid #ccc;";
    echo "            border-radius: 4px;";
    echo "        }";
    echo "        input[type='submit'] {";
    echo "            width: 100%;";
    echo "            padding: 10px;";
    echo "            background-color: #4CAF50;";
    echo "            border: none;";
    echo "            border-radius: 4px;";
    echo "            color: white;";
    echo "            font-size: 16px;";
    echo "            cursor: pointer;";
    echo "        }";
    echo "        input[type='submit']:hover {";
    echo "            background-color: #45a049;";
    echo "        }";
    echo "    </style>";
    echo "</head>";
    echo "<body>";
    echo "    <div class='form-container'>";
    echo "        <h1>Ajouter animal</h1>";
    echo "        <form action='' method='post'>";
    
    $animal = $bd->query("SELECT * FROM categories");
    echo "            <select name='id_categories'>";
    foreach ($animal->fetchAll() as $line) {
        echo "<option value='".$line['id']."'>".$line['nom']."</option>";      
    }
    echo "            </select>";
    echo "            <input type='text' name='type' placeholder='Type'>";
    echo "            <input type='submit' value='Ajouter'>";
    echo "        </form>";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_categories = $_POST["id_categories"];
        $type = $_POST["type"];

        $insert = $bd->prepare("INSERT INTO animal (id_categories, type) VALUES (:id_categories, :type)");
        $insert->bindParam(':id_categories', $id_categories);
        $insert->bindParam(':type', $type);
        if ($insert->execute()) {
            header("Location: liste_animals.php");
            exit(); 
        } 
    }

    echo "    </div>";
    echo "</body>";
    echo "</html>";
?>
