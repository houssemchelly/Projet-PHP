<?php
// Fichier : index.php
require 'connection.php';

// Récupérer tous les animaux
$stmt = $bd->query("
    SELECT s.id AS sousType_id, s.name, s.image, s.prix, c.nom AS categorie
    FROM soustype s
    INNER JOIN animal a ON s.type_id = a.id
    INNER JOIN categories c ON a.id_categories = c.id
");
$animaux = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des animaux</title>
</head>
<body>
    <h1>Liste des animaux</h1><a href="logout.php">logout</a>*
    <?php echo $_SESSION['id'] ?>
    <?php foreach ($animaux as $animal): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <h2><?php echo htmlspecialchars($animal['name']); ?></h2>
            <img src="<?php echo htmlspecialchars($animal['image']); ?>" alt="<?php echo htmlspecialchars($animal['name']); ?>" style="max-width: 150px;">
            <p>Prix : <?php echo htmlspecialchars($animal['prix']); ?> €</p>
            <p>Catégorie : <?php echo htmlspecialchars($animal['categorie']); ?></p>
            <a href="animal_details.php?id=<?php echo $animal['sousType_id']; ?>">Voir les détails</a>
        </div>
    <?php endforeach; ?>
</body>
</html>
