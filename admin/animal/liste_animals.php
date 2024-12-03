<?php
    require_once '../../connection.php';

    $animal=$bd->query("select a.id, id_categories, type, nom from animal a, categories c where a.id_categories=c.id");
    echo "<h1>Liste des animeaux</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Numéro animal</th><th>categorie</th><th>type</th></tr>";
    echo '<a href="../index.php">Home</a>' ;
    while ($row = $animal->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . ($row['id']) . "</td>";
        echo "<td>" . ($row['id_categories']) .", ".($row['nom']). "</td>";
        echo "<td>" . ($row['type']) . " </td>";
        echo "<td><a href='supp_animal.php?id=" . $row['id'] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer ce produit ?');\">Supprimer</a> 
        <a href='modif_animal.php?id=" . $row['id'] . "'>modifier</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br><a href='ajouter_animal.php'><button>Ajouter</button></a>";?>