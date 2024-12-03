<?php
// Fichier : animal_details.php
session_start();
require '../connection.php';

// Vérifier si un ID d'animal est passé
if (!isset($_GET['idAnim'])) {
    die("Animal non spécifié.");
}

$animal_id = intval($_GET['idAnim']); // Récupérer l'ID de l'animal depuis l'URL

// Récupérer les détails de l'animal depuis la base de données
$stmt = $bd->prepare("
    SELECT s.id AS sousType_id, s.name, s.image, s.prix, a.type, c.nom AS categorie
    FROM soustype s
    INNER JOIN animal a ON s.type_id = a.id
    INNER JOIN categories c ON a.id_categories = c.id
    WHERE s.id = ?
");
$stmt->execute([$animal_id]);
$animal = $stmt->fetch();

if (!$animal) {
    die("Animal introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($animal['name']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($animal['name']); ?></h1>
    <img src="<?php echo htmlspecialchars($animal['image']); ?>" alt="<?php echo htmlspecialchars($animal['name']); ?>" style="max-width: 300px;">
    <p>Prix : <?php echo htmlspecialchars($animal['prix']); ?> €</p>
    <p>Type : <?php echo htmlspecialchars($animal['type']); ?></p>
    <p>Catégorie : <?php echo htmlspecialchars($animal['categorie']); ?></p>

    <!-- Bouton pour ajouter aux favoris -->
    <?php if (isset($_SESSION['id'])): ?>
    <form method="POST" action="favorites.php">
        <input type="hidden" name="sousType_id" value="<?php echo htmlspecialchars($animal['sousType_id'], ENT_QUOTES, 'UTF-8'); ?>">
        <?php 
        $st = $bd->prepare("SELECT COUNT(*) FROM favoris WHERE utilisateur_id = ? AND sousType_id = ?");
        $st->execute([$_SESSION['id'], $animal['sousType_id']]);
        if ($st->fetchColumn() > 0){ ?>
            <button type="submit" name="action" value="remove">Supp du favoris</button>
        <?php }else{ ?>
            <button type="submit" name="action" value="add">Ajouter aux favoris</button>
        <?php } ?>
    </form>
    <?php else: ?>
    <p><a href="login1.php">Connectez-vous</a> pour ajouter cet animal aux favoris.</p>
    <?php endif; ?>

    <a href="index.php?user=<?php $_GET['user'] ?>&id=<?php $_SESSION['id'] ?>">Retour à la liste des animaux</a>
</body>
</html>
