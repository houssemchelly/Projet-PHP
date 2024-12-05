<?php
    require_once '../../connection.php';

    $animal = $bd->query("select a.id, id_categories, type, nom from animal a, categories c where a.id_categories=c.id");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des animaux</title>
    <style>
        /* Style général */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
        }
        .center-link {
            text-align: center;
            margin: 20px 0;
        }
        .center-link a {
            text-decoration: none;
            color: #007bff;
        }
        .center-link a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        /* Table styles */
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
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
        .action-buttons a {
            margin-right: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }
        .action-buttons a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Liste des animaux</h1>
    <div class="center-link">
        <a href="../index.php">Home</a>
    </div>
    <?php
    echo "<table>";
    echo "<tr><th>Numéro animal</th><th>Catégorie</th><th>Type</th><th>Actions</th></tr>";
    while ($row = $animal->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id_categories']) .", ". htmlspecialchars($row['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
        echo "<td class='action-buttons'><a href='supp_animal.php?id=" . $row['id'] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer ce produit ?');\">Supprimer</a> 
              <a href='modif_animal.php?id=" . $row['id'] . "'>Modifier</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <br>
    <div style="text-align: center;">
        <a href='ajouter_animal.php'><button>Ajouter</button></a>
    </div>
</body>
</html>
