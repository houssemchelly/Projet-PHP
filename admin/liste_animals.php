<?php
    include 'connection.php';

    $animal=$bd->query("select * from animal");
    echo "<h1>Liste des animeaux</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Numéro animal</th><th>categorie</th><th>type</th></tr>";

    while ($row = $animal->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . ($row['id']) . "</td>";
        echo "<td>" . ($row['id_categories']) . "</td>";
        echo "<td>" . ($row['type']) . " </td>";
        // echo "<td><a href='supp_produit.php?numP=" . $row['numP'] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer ce produit ?');\">Supprimer</a> 
        // <a href='modif_produit.php?numP=" . $row['numP'] . "'>modifier</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br><a href='ajouter_animal.php'><button>Ajouter</button></a>";?>