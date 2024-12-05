<?php
include '../../connection.php';

$s_animal = $bd->query("select s.id, type_id, name, image, prix, type from animal a, soustype s where a.id=s.type_id");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des sous-animaux</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #333;
            margin-top: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }
        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .action-buttons a {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
        }
        .action-buttons a:hover {
            background-color: #0056b3;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Liste des sous-animaux</h1>
    <?php
    echo '<a href="../index.php">Home</a>';
    echo "<table>";
    echo "<tr><th>Numéro</th><th>Type</th><th>Name</th><th>Image</th><th>Prix</th><th>Actions</th></tr>";
    while ($row = $s_animal->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['type_id']) . ", " . htmlspecialchars($row['type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td><img src='" . htmlspecialchars($row['image']) . "' style='max-width: 75px'></td>";
        echo "<td>" . htmlspecialchars($row['prix']) . "</td>";
        echo "<td class='action-buttons'><a href='supp_sous_animal.php?id=" . $row['id'] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer ce produit ?');\">Supprimer</a> 
              <a href='modif_sous_animal.php?id=" . $row['id'] . "'>Modifier</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <br>
    <button onclick="window.location.href='ajouter_sous_animal.php'">Ajouter</button>
</body>
</html>
