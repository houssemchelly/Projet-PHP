<?php
    include '../../connection.php';

    $s_animal=$bd->query("select s.id, type_id, name, image, prix, type from animal a, soustype s where a.id=s.type_id");
    echo "<h1>Liste des sous animeaux</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Numéro </th><th>type</th><th>name</th><th>image</th><th>prix</th></tr>";

    while ($row = $s_animal->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . ($row['id']) . "</td>";
        echo "<td>" . ($row['type_id']) .", ".($row['type']). "</td>";
        echo "<td>" . ($row['name']) . " </td>";
        echo "<td><img src='" . ($row['image']) . "' style='max-width: 75px'> </td>";
        echo "<td>" . ($row['prix']) . " </td>";
        echo "<td><a href='supp_animal.php?id=" . $row['id'] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer ce produit ?');\">Supprimer</a> 
        <a href='modif_animal.php?id=" . $row['id'] . "'>modifier</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br><a href='ajouter_animal.php'><button>Ajouter</button></a>";?>