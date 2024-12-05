<?php
include '../../connection.php';

echo "<!DOCTYPE html>";
echo "<html lang='fr'>";
echo "<head>";
echo "    <meta charset='UTF-8'>";
echo "    <title>Ajouter sous animal</title>";
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
echo "        input[type='text'], input[type='url'], input[type='number'], select {";
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
echo "        <h1>Ajouter sous animal</h1>";
echo "        <form action='' method='post'>";
    
$animal = $bd->query("SELECT * FROM animal");
echo "            <select name='type_id'>";
foreach ($animal->fetchAll() as $line) {
    echo "<option value='".$line['id']."'>".$line['type']."</option>";      
}
echo "            </select><br/>";
echo "            <input type='text' name='name' placeholder='Nom'><br/>";
echo "            <input type='url' name='image' placeholder='URL de l'image'><br/>";
echo "            <input type='number' name='prix' placeholder='Prix'><br/>";
echo "            <input type='submit' value='Ajouter'>";
echo "        </form>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type_id = $_POST["type_id"];
    $name = $_POST["name"];
    $image = $_POST["image"];
    $prix = $_POST["prix"];

    $insert = $bd->prepare("INSERT INTO soustype (type_id, name, image, prix) VALUES (:type_id, :name, :image, :prix)");
    $insert->bindParam(':type_id', $type_id);
    $insert->bindParam(':name', $name);
    $insert->bindParam(':image', $image);
    $insert->bindParam(':prix', $prix);
    if ($insert->execute()) {
        header("Location: liste_sous_animal.php");
        exit(); 
    } 
}

echo "    </div>";
echo "</body>";
echo "</html>";
?>
